<?php


class User extends Tracer
{
    private $id       = '';
    private $name     = '';
    private $nickname = '';
    private $group    = 0;
    private $token    = '';


    public function __construct() {
        parent::__construct();
        $this->setClass('User');
        $this->database('user');
    }


    /**
     * 注册
     * $username string 用户名
     * $email string 电子邮箱，用来登录
     * $nickname string 午安昵称
     * $psd string 密码
     * $qq string QQ号
     * $rpsd string 确认输入的密码
     */
    public function register() {
        $username = $this->post('username', 'viewer/signup');
        $email    = $this->post('email', 'viewer/signup');
        $nickname = $this->post('nickname', 'viewer/signup');
        $psd      = $this->post('password', 'viewer/signup');
        $qq       = $this->post('qq', 'viewer/signup');
        $rpsd     = $this->post('repassword', 'viewer/signup');

        $psd === $rpsd or $this->jump('skip', '两次输入密码不一致', 'viewer/signup');
        is_numeric($qq) or $this->jump('skip', '请输入正确的QQ号码', 'viewer/signup');
        $date     = date('Y-m-d H:m:s');
        $password = md5($psd);

        ($message = $this->db->check_sole($email, $username, $nickname)) === 1 or $this->jump('skip', $message);

        $sql  = "INSERT INTO user VALUE (DEFAULT,?,?,?,?,?,0,0,'$date','$date')";
        $stmt = $this->db->connect->prepare($sql);
        $stmt->bind_param('ssssi', $username, $email, $nickname, $password, $qq);
        $stmt->execute() or $this->jump('skip', '注册失败，可能含有非法信息', 'viewer/signup');
        $stmt->close();

        $this->jump('skip', '注册成功,即将转向登陆界面', 'viewer/index');
    }


    /**
     * 登录
     * $email string 电子邮箱
     * $psd string 密码
     */
    public function login() {
        $email = $this->post('email', 'viewer/index');
        $psd   = $this->post('password', 'viewer/index');

        $this->db->check_sole($email) === 1 and $this->jump('skip', '该邮箱尚未在本网站注册', 'viewer/index');

        $sql  = "SELECT id,user_name,wuan_name,password FROM user WHERE email = ?";
        $stmt = $this->db->connect->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->bind_result($id, $username, $wuan_name, $true_psd);
        $stmt->execute() or $this->jump('skip', '未知错误，请稍后重试', 'viewer/index');
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();

        $true_psd == md5($psd) or $this->jump('skip', '用户名或密码错误！', 'viewer/index');

        //验证成功，储存session和cookie信息
        $this->db->setToken($id, $username, $wuan_name);

        //判断用户是否加入分组
//        $sql = "SELECT group_id FROM user_group WHERE user_id = $id";
//        $res = $this->db->connect->query($sql);
//        @$res->num_rows or $this->jump('skip', '你尚未加入分组，请先选择分组', 'viewer/join_group');
        $this->db->exist_group() or $this->jump('skip', '你尚未加入分组，请先加入分组', 'viewer/join_group');


        $this->jump('skip', '登陆成功,即将转向主页', 'viewer/index');
    }


    /**
     * 加入分组
     * $group_id mixed 分组id
     */
    public function join_group() {
        $this->db->check_state();

        $this->db->exist_group() and $this->jump('skip', '你已加入分组，即将转向主页', 'viewer/index');

        $group_id = $this->post('genre', 'viewer/join_group');

        $group_id >= 1 && $group_id <= 7 or $this->jump('skip', '非法操作，请返回后重试', 'viewer/join_group');

        $id   = $_SESSION['token']['id'];
        $time = date('Y-m-d H:m:s');

        $this->db->connect->query("INSERT INTO user_group VALUE ($id,$group_id,0,'$time','$time')");

        $this->jump('skip', '加入分组成功', 'viewer/index');
    }


    /**
     * 退出登录
     */
    public function quit() {
        $this->db->delToken();
        $this->jump('skip', '你已退出登录！', 'viewer/index');
    }


    /**
     * 通过旧密码修改密码
     * $psd string 用户当前密码
     * $newpsd string 用户想要设置的新密码
     * $renewpsd string 确认新密码
     */
    public function reset_psd() {
        $this->db->check_state();

        $psd      = $this->post('password', 'viewer/reset_psd');
        $newpsd   = $this->post('newpsd', 'viewer/reset_psd');
        $renewpsd = $this->post('repassword', 'viewer/reset_psd');

        $newpsd === $renewpsd or $this->jump('skip', '两次输入的密码不同', 'viewer/change_psd');

        $this->db->check_state() or $this->jump('skip', '请先登录', 'viewer/change_psd');
        $id = $_SESSION['token']['id'];

        $sql  = "SELECT password FROM user WHERE id = ?";
        $stmt = $this->db->connect->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->bind_result($now_psd);
        $stmt->execute() or $this->jump('skip', '操作失败，请稍后重试', 'viewer/change_psd');
        $stmt->fetch();
        $stmt->close();

        $now_psd == md5($psd) or $this->jump('skip', '密码错误', 'viewer/change_psd');
        $newpsd = md5($newpsd);

        $sql  = "UPDATE user SET password = ? WHERE id = ?";
        $stmt = $this->db->connect->prepare($sql);

        $stmt->bind_param('si', $newpsd, $id);
        $stmt->execute() or $this->jump('skip', '操作失败，请稍后重试', 'viewer/change_psd');

        $stmt->free_result();
        $stmt->close();

        $this->jump('skip', '修改密码成功', 'viewer/index');
    }


    /**
     * 找回密码
     * $email string email地址
     * !!!!!!!!!正式上线前需要更改公钥!!!!!!!!!!!!!!!!!!!!
     */
    public function recover_psd() {
        $email = $this->post('email', 'viewer/recover_psd');

        //key值的构成为：base64(用户email).base64(url过期时间).base64(令牌)
        $body = $email . '*' . (time() + 600);
        $key  = $body . '*' . hash_hmac('sha256', $body, 'foo');

        $info = 'http://' . $_SERVER['SERVER_NAME'] . "/index.php/user/verify_psdtoken?key=$key";
        $this->db->send_mail($email, $info);
        $this->jump('skip', '邮件发送成功，请查收邮件', 'viewer/index');
    }


    /**
     * 验证url合法性，如果合法，跳转到修改密码界面
     */
    public function verify_psdtoken() {
        //key值的构成为：base64(用户email).base64(url过期时间).base64(令牌)
        isset($_GET['key']) or $this->jump('skip', '非法访问', 'viewer/index');

        $info = explode('*', $_GET['key']);

        sizeof($info) === 3 or $this->jump('skip', '无效的url');

        $body = $info[0] . '*' . $info[1];

        hash_hmac('sha256', $body, 'foo') == $info[2]
        or
        $this->jump('skip', '无效的url', 'viewer/login');

        $email = $info[0];
        $time  = $info[1];

        $time >= time() or $this->jump('skip', '该链接已过期', 'viewer/index');

        $_SESSION['psd_token'] = $email;
        $this->view('resetPsd');

    }


    /**
     * 通过验证邮箱修改密码
     */
    public function set_new_psd() {
        isset($_SESSION['psd_token']) or $this->jump('skip', '非法访问', 'viewer/index');

        $email    = $_SESSION['psd_token'];
        $password = md5($this->post('password', 'viewer/index'));

        $stmt = $this->db->connect->prepare("UPDATE user SET password = ? WHERE email = ?");
        $stmt->bind_param('ss', $password, $email);
        $stmt->execute() or $this->jump('skip', '未知错误，请稍后重试', 'viewer/index');
        $stmt->close();

        $this->jump('skip', '修改密码成功，请用新密码登录', 'viewer/index');
    }



    /** 周报相关 */

    /**
     * 查看周报提交状态
     */
    public function show_state() {
        $this->db->check_state();
        $this->db->exist_group() or $this->jump('skip', '请先加入分组', 'viewer/index');

        $data             = $_SESSION['token'];
        $data['group']    = $this->db->sel_group();
        $data['week_num'] = ceil((time() - strtotime('2015-11-02')) / 604800);

        $res = $this->db->connect->query("SELECT status FROM report WHERE week_num = {$data['week_num']} AND user_id = {$data['id']}");

        $status = @$res->fetch_assoc()['status'];
        if (!$res->num_rows) {
            $data['status'] = '未提交周报';
        }
        else if ($status == '2') {
            $data['status'] = '已提交周报';
        }
        else if ($status == '3') {
            $data['status'] = '已请假';
        }
        else if ($status == '4') {
            $data['status'] = '可以请假';
        }

        if ($data['status'] == '已请假')
            $this->view('askLeaveSuccess', $data);
        else
            $this->view('subWeeklySuccess', $data);

    }


//    /**
//     * 查看周报
//     * 该方法返回json格式的信息
//     * @param $num integer 要查看的周数
//     */
//    public function show_weekly($num) {
//        !is_numeric($num) and $this->json(array('error' => '缺少必要的参数或参数为非数字'));
//        isset($_SESSION['token']) or $this->json(array('error' => '用户未登录'));
//        $this->db->exist_group() or $this->json(array('error' => '用户未加入分组'));
//
//        $id = $_SESSION['token']['id'];
//        $res = $this->db->connect->query("SELECT * FROM report WHERE user_id = $id AND week_num = $num") or $this->json(array('error' => '获取信息出错，请检查参数是否合法'));
//
//        $res->num_rows or $this->json(array('status' => '未提交',
//                                          'week'=>$num));
//
//        $data = $res->fetch_assoc();
//        $data['status'] == 3 and $this->json(array('status' => "本周已请假",
//                                                 "week" => $num,
//                                                 "time" => $data['reply_time']));
//
//        $message = $data['text'];
//        $message = explode('<br>', $message);
//
//        $done = str_replace('本周完成：', '', $message['0']);
//        $problem = str_replace('所遇问题：','',$message['1']);
//        $todo = str_replace('下周计划：','',$message['2']);
//        $this->json(array('status'=>"未提交",
//                        "week"=>$num,
//                        "time"=>$data['reply_time'],
//                        "finished"=>$done,
//                        "problem"=>$problem,
//                        "plan"=>$todo));
//    }


    /**
     * 撰写周报
     */
    public function write_weekly() {
        $this->db->check_state();
        $this->db->exist_group() or $this->jump('skip', '请先加入分组', 'viewer/index');

        $id    = $_SESSION['token']['id'];
        $group = $this->db->sel_group();

        $week_num = ceil((time() - strtotime('2015-11-02')) / 604800);
        $time     = date('Y-m-d H:m:s');

        $res = $this->db->connect->query("SELECT status FROM report WHERE week_num = $week_num AND user_id = $id");
        if (@$res->num_rows) {
            $this->jump('skip', '错误的操作，你已提交本周周报或请假', 'viewer/index');
        }

        $info = $this->post();
        $done = addslashes(htmlspecialchars(@$info['done'])) or $this->jump('skip', '非法请求，缺少必要参数', 'viewer/write_weekly');;
        $problem = addslashes(htmlspecialchars(@$info['problem'])) or $this->jump('skip', '非法请求，缺少必要参数', 'viewer/write_weekly');;
        $todo = addslashes(htmlspecialchars(@$info['todo'])) or $this->jump('skip', '非法请求，缺少必要参数', 'viewer/write_weekly');;
        $url = isset($info['url']) ? addslashes(htmlspecialchars($info['url'])) : '';

        $str = "本周完成：$done<br>所遇问题：$problem<br>下周计划：$todo<br>作品链接：$url";

        //status 为 2 表示已经提交周报，status 为 3 表示已经请假，status 为 4 表示可以请假，4为前端提交临时判断参数，不提交数据库
        //判断：如果学员处于2或者3状态，不能请假
        $sql = "INSERT INTO report VALUE ($week_num,$id,$group,'$str',2,'$time')";
        $this->db->connect->query($sql) or $this->jump('skip', '添加失败，请检查输入是否正确后重试', 'viewer/index');

        $this->jump('skip', '回复成功！页面即将跳转', 'user/show_state');
    }


    /**
     * 请假
     */
    public function vacate() {
        $this->db->check_state();
        $this->db->exist_group() or $this->jump('skip', '请先加入分组', 'viewer/index');

        $id    = $_SESSION['token']['id'];
        $group = $this->db->sel_group();

        $week_num = ceil((time() - strtotime('2015-11-02')) / 604800);
        $time     = date('Y-m-d H:m:s');

        $res = $this->db->connect->query("SELECT status FROM report WHERE week_num = $week_num AND user_id = $id");
        if (@$res->num_rows) {
            $this->jump('skip', '错误的操作，你已提交本周周报或请假', 'viewer/index');
        }

        $info = $this->post();
        $num = @$info['num'] or $this->jump('skip', '非法请求，缺少必要参数num', 'viewer/vacate');
        $reason = addslashes(htmlspecialchars(@$info['reason'])) or $this->jump('skip', '非法请求，缺少必要参数reason', 'viewer/vacate');

        while ($num--) {
            $sql = "INSERT INTO report VALUE ($week_num,$id,$group,'$reason',3,'$time')";
            $this->db->connect->query($sql) or $this->jump('skip', '添加失败，请检查输入是否正确后重试', 'viewer/index');
            $week_num++;
        }
        $this->jump('skip', '请假成功！页面即将跳转', 'user/show_state');
    }


    /**
     * 取消请假
     */
    public function vacate_off() {
        $this->db->check_state();
        $this->db->exist_group() or $this->jump('skip', '请先加入分组', 'viewer/index');

        $id       = $_SESSION['token']['id'];
        $week_num = ceil((time() - strtotime('2015-11-02')) / 604800);

        $res = $this->db->connect->query("SELECT status FROM report WHERE user_id = $id");

        if (!$res->num_rows || $res->fetch_assoc()['status'] != 3) {
            $this->jump('skip', '你尚未请假', 'viewer/vacate');
        }
        else {
            $this->db->connect->query("DELETE FROM report WHERE user_id = $id AND week_num >= $week_num");
            $this->jump('skip', '取消请假成功，正在转向主页', 'viewer/index');
        }

    }

}
