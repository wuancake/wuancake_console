<?php
/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/26 0026
 * Time: 23:30
 */

class Viewer extends Tracer
{
    //显示部分界面之前，需要验证用户权限
    public function check_state() {
        if (isset($_SESSION['token'])) {
            return 1;
        }
        elseif (isset($_COOKIE['token'])) {
            $message = explode('*', $_COOKIE['token']);
            if (count($message) !== 4) {
                //cookie被篡改，删除用户登录凭证
                session_destroy();
                foreach ($_COOKIE as $key => $val) {
                    setcookie($key, '', time() - 1);
                }
                return 0;
            }
            $str = "$message[0]*$message[1]*$message[2]";
            if (password_verify($str, $message[3])) {
                //cookie文件存在且合法，设置session令牌
                $_SESSION['token'] = $message[0];
                return 1;
            }
        }
        //cookie和session均不存在，返回0
        return 0;
    }

    public function index() {
        $this->check_state() and $this->jump('homepage');
        $this->jump('login');
    }

    /** 学员端页面 */

    /**
     * 注册界面
     */
    public function signup() {
        $this->jump('signup');
    }


    /**
     * 登录界面
     */
    public function login() {
        $this->check_state() and $this->jump('homepage');
        $this->jump('login');
    }


    /**
     * 加入分组界面
     */
    public function join_group() {
        $this->check_state() or $this->jump('login','请先登录','viewer/login');
        $this->jump('grouping');
    }


    /**
     * 更改密码界面
     */
    public function change_psd() {
        $this->check_state() or $this->jump('login','请先登录','viewer/login');
        $this->jump('ChangePassWord');
    }


    /**
     * 找回密码界面
     */
    public function recover_psd() {
        $this->jump('ForgetPass');
    }


    /**
     * 用户主页
     */
    public function homepage() {
        $this->check_state() or $this->jump('login','请先登录','viewer/login');
        $this->jump('HomePage');
    }


}