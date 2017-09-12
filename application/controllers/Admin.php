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

        $this->jump('skip', '登陆成功,即将转向主页', 'viewerb/checkWeekly');
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
     * 踢人
     */
    public function fuck_someone()
    {
        $this->db->check_state() or $this->jump('skip', '请先登录', 'viewer/login');

        $user_id = (int)$this->post('user_id', 'viewer/gatherAttend');
        $user_group = $this->db->connect->query("SELECT group_id FROM user_group WHERE user_id = $user_id")->fetch_assoc()['group_id'];

        $headsman = $_SESSION['admin']['name'];
        $_SESSION['admin']['auth'] === 1 && $_SESSION['admin']['group'] !== $user_group
        and $this->jump('skip', '非法请求，导师只能踢出本组的人', 'viewer/gatherAttend');

        $time = date('Y-m-d H:m:s');
        $this->db->connect->query("UPDATE user_group SET deleteFlg = 1 , headsman = $headsman ,modify_time = $time
                                    WHERE user_id = $user_id AND create_time IN 
                                    (SELECT value FROM 
                                    (SELECT max(create_time) AS value FROM user_group WHERE user_id = $user_id ORDER BY create_time)
                                    AS gp);");

        echo "<script>alert('踢人成功')</script>";

    }


    /**
     * 考勤，检索数据库，向数据库中的report表增加用户跷周报的数据
     * 本方法会在每次导师、管理员登录后自动执行
     */
    private function attend(){
        //统计截止到此周数的周报未提交人数
        $last_week = ceil((time() - strtotime('2015-11-02')) / 604800) - 1;
        $time = date('Y-m-d H:m:s');

        for ($week = 83; $week <= $last_week; $week++) {
            $sql = "SELECT user_id,group_id FROM user_group WHERE deleteFlg != 1 AND
                    user_id NOT IN (SELECT user_id AS id FROM report WHERE week_num = $week);";

            //获取当前循环周数未提交周报的学员id
            $res = $this->db->connect->query($sql);
            if ($res->num_rows === 0) continue;

            while ($arr = $res->fetch_assoc()) {
                $list[] = ['user_id' => $arr['user_id'],
                            'group' => $arr['group_id']];
            }

            foreach ($list as $value) {

//                if ($value['group'] === 0) continue;

                $this->db->connect->query("INSERT INTO report VALUE ($week,{$value['user_id']},{$value['group']},'未提交',1,'$time')");
            }
        }
    }


}