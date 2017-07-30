<?php
/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/26 0026
 * Time: 23:30
 */

class Viewer extends Tracer
{

    public function __construct() {
        parent::__construct();
        $this->database('user');
    }


    //显示部分界面之前，需要验证用户权限
    public function check_state() {
        if (isset($_SESSION['token'])) {
            return 1;
        }
        elseif (isset($_COOKIE['token'])) {
            $message = explode('*', $_COOKIE['token']);
            if (count($message) !== 4) {
                //cookie被篡改，删除用户登录凭证
                $this->delToken();
                return 0;
            }
            $str = "$message[0]*$message[1]*$message[2]";
            if (password_verify($str, $message[3])) {
                //cookie文件存在且合法，设置session令牌
                $_SESSION['token'] = array('id' => $message[0], 'username' => $message[1], 'nickname' => $message[2]);
                return 1;
            }
        }
        //cookie和session均不存在
        return 0;
    }


    /**
     * 登录界面
     */
    public function index() {
        if ($this->check_state()) {
            $data = $_SESSION['token'];

            $data['week_num'] = ceil((time() - strtotime('2015-11-02')) / 604800);
            $data['group']    = $this->db->connect->query("SELECT group_id FROM user_group WHERE user_id = {$_SESSION['token']['id']}")->fetch_assoc()['group_id'];
            $this->view('homepage', $data);
        }
        else
            $this->jump('login');
    }


    /**
     * 注册界面
     */
    public function signup() {
        $this->jump('signup');
    }


    /**
     * 加入分组界面
     */
    public function join_group() {
        $this->check_state() or $this->jump('login', '请先登录', 'viewer/index');
        $this->jump('grouping');
    }


    /**
     * 更改密码界面
     */
    public function change_psd() {
        $this->check_state() or $this->jump('login', '请先登录', 'viewer/index');
        $this->jump('ChangePassWord');
    }


    /**
     * 找回密码界面
     */
    public function recover_psd() {
        $this->jump('ForgetPass');
    }


    /**
     * 撰写周报界面
     */
    public function write_weekly() {

    }
}