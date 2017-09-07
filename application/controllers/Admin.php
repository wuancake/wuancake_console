<?php

class Admin extends Tracer
{

    private $auth = null;
    private $group = null;

    public function __construct(){
        parent::__construct();
        $this->setClass('Admin');
        $this->database('admin');
    }


    /**
     * 登录
     * $name string 用户名
     * $psd mixed 密码
     */
    public function login() {
        $this->db->check_state() and $this->jump('skip','你已登录','viewer/?');

        $email = $this->post('email','viewer/login');
        $psd = $this->post('password','viewer/login');

        $this->db->check_sole($email) === 0 and $this->jump('skip', '该邮箱尚未在本网站注册', 'viewer/?');

        $sql  = "SELECT id,username,password,auth,group_id FROM user WHERE email = ?";
        $stmt = $this->db->connect->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->bind_result($id, $username, $true_psd, $auth,$group_id);
        $stmt->execute() or $this->jump('skip', '未知错误，请稍后重试', 'viewer/?');
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();

        $true_psd == md5($psd) or $this->jump('skip', '用户名或密码错误！', 'viewer/?');

        //验证成功,储存session&cookie信息
        $this->db->setToken($id, $username, $auth,$group_id);

        $this->jump('skip', '登陆成功,即将转向主页', 'viewer/?');
    }


    /**
     * 退出登录
     */
    public function quit(){
        $this->db->delToken();
        $this->jump('skip', '你已退出登录！', 'viewer/index');
    }


    /**
     * 创建管理员帐号
     * $email string 用户邮箱
     * $name string 昵称
     * $psd string 密码
     * $auth int 权限，1:导师；2:管理员；3:最高管理员；
     * $group int 分组，最高管理员和管理员分组为0
     */
    public function create_admin() {
        $this->db->check_state() or $this->jump('skip','请先登录','viewer/?');

        $email = $this->post('email','viewer/?');
        $name = htmlspecialchars($this->post('name','viewer/?'));
        $psd = $this->post('password','viewer/?');
        $auth = (int)$this->post('auth','viewer/?');
        $group = (int)$this->post('group','viewer/?');

        $auth >= $_SESSION['token']['auth'] and $this->jump('skip','权限不足，无法操作','viewer/?');

        $sql = "INSERT INTO adm VALUE (DEFAULT,?,?,?,?,?)";
        $stmt = $this->db->connect->prepare($sql);
        $stmt->bind_param('sssii',$name,$email,$psd,$auth,$group);
        $stmt->execute() or $this->jump('skip','操作失败','viewer/?');
        $stmt->close();

        $this->jump('skip','创建账号成功','viewer/?');
    }


    /**
     * 踢人
     */
    public function fuck_someone(){
        $this->db->check_state() or $this->jump('skip','请先登录','viewer/?');

        $user_id = (int)$this->post('user_id','viewer/?');
        $user_group = $this->db->connect->query("SELECT group_id FROM user_group WHERE user_id = $user_id")->fetch_assoc()['group_id'];

        $headsman = $_SESSION['token']['name'];
        $_SESSION['token']['auth'] === 1 && $_SESSION['token']['group'] !== $user_group
            and $this->jump('skip','非法请求，导师只能踢出本组的人','viewer/?');

        $time = date('Y-m-d H:m:s');
        $this->db->connect->query("UPDATE user_group SET deleteFlg = 1 , headsman = $headsman ,modify_time = $time
                                    WHERE user_id = $user_id AND create_time IN 
                                    (SELECT value FROM 
                                    (SELECT max(create_time) AS value FROM user_group WHERE user_id = $user_id ORDER BY create_time)
                                    AS gp);");

        echo "<script></script>";

    }



}