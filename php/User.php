<?php

require_once './Tool.php';

class User extends Tool
{
    private $id       = '';
    private $name     = '';
    private $nickname = '';
    private $group    = 0;
    private $token    = '';


    public function __construct() {
        count($this->db()) === 1 or $this->jump('', '数据库连接出错');
        session_start();
    }


    /**
     * 注册
     * @param $username string 用户名
     * @param $email string 电子邮箱，用来登录
     * @param $nickname string 午安昵称
     * @param $psd string 密码
     * @param $qq string QQ号
     * @param $rpsd string 确认输入的密码
     */
    public function register($username, $email, $nickname, $psd, $qq, $rpsd) {
        $psd === $rpsd or $this->jump('wrong_psd', '两次输入密码不一致');
        is_numeric($qq) or $this->jump('wrong_qq', '请输入正确的QQ号码');
        $date     = date('Y-m-d H:m:s');
        $password = md5($psd);

        ($message = $this->check_sole($email, $username, $nickname)) === 1 or $this->jump('', $message);

        $sql  = "INSERT INTO user VALUE (DEFAULT,?,?,?,?,?,0,0,'$date','$date')";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param('ssssi', $username, $email, $nickname, $password, $qq);
        $stmt->execute() or $this->jump('wrong_sql', '注册失败，可能含有非法信息');
        $stmt->close();

        $this->jump('', '注册成功');
    }


    /**
     * 登录
     * @param $email string 电子邮箱
     * @param $psd string 密码
     */
    public function login($email, $psd) {
        $this->check_state() and $this->jump('', '你已经登录');

        $this->check_sole($email) === 1 and $this->jump('', '该邮箱尚未在本网站注册');

        $sql  = "SELECT id,user_name,wuan_name,password FROM user WHERE email = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->bind_result($id, $username, $wuan_name, $true_psd);
        $stmt->execute() or $this->jump('', '未知错误，请稍后重试');
        $stmt->fetch();

        $sql = "SELECT group_id FROM user_grouo WHERE user_id = $id";
        $res = $this->connect->query($sql);
        $res->num_rows() or $this->jump('', '你尚未加入分组，请先选择分组');

        $true_psd == md5($psd) or $this->jump('', '用户名或密码错误！');

        //验证成功，储存session和cookie信息
        $this->setToken($id, $username, $wuan_name);

        $this->jump('', '登陆成功,即将转向主页');
    }


    public function join_group($group_id) {
        $group_id >= 1 && $group_id <= 7 or $this->jump('', '非法操作，请返回后重试');

        $id   = $_SESSION['token']['id'];
        $time = date('Y-m-d H:m:s');

        $this->connect->query("INSERT INTO user_group VALUE ($id,$group_id,0,$time,$time)")
        or $this->jump('', '加入分组失败，请稍后再试');

        $this->jump('', '加入分组成功');
    }


    /**
     * 退出登录
     */
    public function quit() {
        $this->delToken();
        $this->jump('', '你已退出登录！');
    }


    /**
     * 修改密码
     * @param $psd string 用户当前密码
     * @param $newpsd string 用户想要设置的新密码
     * @param $renewpsd string 确认新密码
     */
    public function reset_psd($psd, $newpsd, $renewpsd) {
        $newpsd === $renewpsd or $this->jump('', '两次输入的密码不同');

        $this->check_state() or $this->jump('', '请先登录');
        $id = $_SESSION['token']['id'];

        $sql  = "SELECT password FROM user WHERE id = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->bind_result($now_psd);
        $stmt->execute() or $this->jump('', '操作失败，请稍后重试');
        $stmt->fetch();
        $stmt->close();

        $now_psd == $psd or $this->jump('', '密码错误');
        $newpsd = md5($newpsd);

        $sql  = "UPDATE user SET password = ? WHERE id = ?";
        $stmt = $this->connect->prepare($sql);

        $stmt->bind_param('si', $newpsd, $id);
        $stmt->execute() or $this->jump('', '操作失败，请稍后重试');

        $stmt->free_result();
        $stmt->close();

        $this->jump('', '修改密码成功');
    }


    /**
     * 找回密码
     * @param $email string email地址
     */
    public function recover_psd($email) {
        $info = 'url字符串';
        $this->send_mail($email, $info);
    }
}
