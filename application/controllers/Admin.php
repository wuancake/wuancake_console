<?php

class Admin extends Tracer
{

    private $auth = null;
    private $group = null;

    public function __construct()
    {
        parent::__construct();
        $this->setClass('Admin');
        $this->database('admin');
    }


    /**
     * 登录
     * $name string 用户名
     * $psd mixed 密码
     */
    public function login()
    {
        $this->db->check_state() and $this->jump('skip', '你已登录', 'viewerb/checkWeekly');

        $email = $this->post('email', 'viewerb/login');
        $psd = $this->post('password', 'viewerb/login');

        ($res = $this->db->check_sole(addslashes($email))) === 0 and $this->jump('skip', '该邮箱尚未在本网站注册', 'viewerb/login');

        $res['password'] == md5($psd) or $this->jump('skip', '用户名或密码错误！', 'viewerb/login');

        //验证成功,储存session&cookie信息
        $this->db->setToken($res['id'], $res['username'], $res['auth'], $res['group_id']);
        //对数据库数据进行考勤操作
        $this->attend();

        if ($this->terminal == 'mobile'){
            $this->jump('skip', '登录成功,即将转向主页', 'viewerb/check');
        }else {
            $this->jump('skip', '登录成功,即将转向主页', 'viewerb/checkWeekly');
        }
    }


    /**
     * 退出登录
     */
    public function quit()
    {
        $this->db->delToken();
        $this->jump('skip', '你已退出登录！', 'viewerb/login');
    }


    /**
     * 创建管理员帐号
     * $email string 用户邮箱
     * $name string 昵称
     * $psd string 密码
     * $auth int 权限，1:导师；2:管理员；3:最高管理员；
     * $group int 分组，最高管理员和管理员分组为0
     */
    public function create_admin()
    {
        $this->db->check_state() or $this->jump('skip', '请先登录', 'viewerb/login');

        $email = $this->post('email', 'viewerb/addAdmin');
        $name = htmlspecialchars($this->post('name', 'viewerb/addAdmin'));
        $psd = md5($this->post('password', 'viewebr/addAdmin'));
        $auth = (int)$this->post('auth', 'viewerb/addAdmin');
        $group = !empty($_POST['group']) ? $_POST['group'] : 0;

        $auth >= $_SESSION['admin']['auth'] and $this->jump('skip', '权限不足，无法操作', 'viewerb/addAdmin');

        $sql = "INSERT INTO adm VALUE (DEFAULT,?,?,?,?,?)";
        $stmt = $this->db->connect->prepare($sql);
        $stmt->bind_param('sssii', $name, $email, $psd, $auth, $group);
        $stmt->execute() or $this->jump('skip', '操作失败', 'viewerb/addAdmin');
        $stmt->close();

        $this->jump('skip', '创建账号成功', 'viewerb/addAdmin');
    }


    /**
     * 根据QQ查询用户信息
     */
    public function check(){
        $this->db->check_state() or $this->jump('skip', '请先登录', 'viewerb/login');
        empty($_POST['qq']) and $this->jump('check','请输入QQ！');
        $_SESSION['admin']['auth'] < 2 and $this->jump('skip', '权限不足，无法操作', 'viewerb/check');

        $qq = $_POST['qq'];
        $res = $this->db->connect->query("
                                            SELECT u.user_name,case
                                            WHEN g.group_id = 1 THEN 'PHP组'
                                            WHEN g.group_id = 2 THEN 'Web前端组'
                                            WHEN g.group_id = 3 THEN 'UI设计组'
                                            WHEN g.group_id = 4 THEN 'Android组'
                                            WHEN g.group_id = 5 THEN '产品经理组'
                                            WHEN g.group_id = 6 THEN '软件测试组'
                                            WHEN g.group_id = 7 THEN 'Java组'
                                            ELSE '其他组'
                                            END 'group'
                                            FROM
                                            user AS u INNER JOIN user_group AS g ON u.id=g.user_id AND u.QQ='$qq'
                                            AND g.deleteFlg = 0;
        ");

        if (!$res->num_rows) $this->view('check',['message'=>'此QQ暂未在网站注册']);

        $data = array();
        while ($info = $res->fetch_assoc()){
            $data[] = [
                'qq'=>$qq,
                "name"=>$info['user_name'],
                'group'=>$info['group']
            ];
        }
        $this->view('check',['info'=>$data]);

    }


    /**
     * 修改密码
     */
    public function resetPsd(){
        $this->db->check_state() or $this->jump('skip','请登录后操作','viewerb/login');

        $psd      = $this->post('password', 'viewerb/change_psd');
        $newpsd   = $this->post('newpsd', 'viewerb/change_psd');
        $renewpsd = $this->post('repassword', 'viewerb/change_psd');

        $newpsd === $renewpsd or $this->jump('skip', '两次输入的密码不同', 'viewerb/change_psd');

        $this->db->check_state() or $this->jump('skip', '请先登录', 'viewerb/change_psd');
        $id = $_SESSION['admin']['id'];

        $sql  = "SELECT password FROM adm WHERE id = ?";
        $stmt = $this->db->connect->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->bind_result($now_psd);
        $stmt->execute() or $this->jump('skip', '操作失败，请稍后重试', 'viewerb/change_psd');
        $stmt->fetch();
        $stmt->close();

        $now_psd == md5($psd) or $this->jump('skip', '密码错误', 'viewerb/change_psd');
        $newpsd = md5($newpsd);

        $sql  = "UPDATE adm SET password = ? WHERE id = ?";
        $stmt = $this->db->connect->prepare($sql);

        $stmt->bind_param('si', $newpsd, $id);
        $stmt->execute() or $this->jump('skip', '操作失败，请稍后重试', 'viewerb/change_psd');

        $stmt->free_result();
        $stmt->close();

        $this->jump('skip', '修改密码成功', 'viewerb/change_psd');
    }


    /**
     * 考勤，检索数据库，向数据库中的report表增加用户跷周报的数据
     * 本方法会在每次导师、管理员登录后自动执行
     */
    private function attend(){
        //统计截止到此周数的周报未提交人数
        $last_week = ceil((time() - strtotime('2015-11-02')) / 604800) - 1;
        $time = date('Y-m-d H:i:s');

        $sql_query = "SELECT user_id,group_id,create_time FROM user_group WHERE deleteFlg != 1 AND
                    user_id NOT IN (SELECT user_id AS id FROM report WHERE week_num = ?);";

        $sql_insert = "INSERT INTO report VALUE (?,?,?,'未提交',1,'$time')";

        $stmt_query = $this->db->connect->prepare($sql_query);
        $stmt_insert = $this->db->connect->prepare($sql_insert);

        for ($week = 83; $week <= $last_week; $week++) {

            $stmt_query->bind_param('i',$week);
            $stmt_query->bind_result($user_id,$group_id,$ctime);
            $stmt_query->execute() or die('查询失败');

            while ($stmt_query->fetch()) {
                if (empty($user_id)) continue 2;
                $list[] = [
                    'user_id' => $user_id,
                    'group' => $group_id,
                    'ctime'=>$ctime
                ];
            }
            $stmt_query->free_result();

            foreach ($list as $info){

                $stmt_insert->bind_param('iii', $week, $info['user_id'], $info['group']);

                $stmt_insert->execute() or die('操作失败'.$stmt_insert->error);
            }
            unset($list);

        }

        $stmt_query->close();
        $stmt_insert->close();
    }


}