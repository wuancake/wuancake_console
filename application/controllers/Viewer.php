<?php
/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/26 0026
 * Time: 23:30
 */

class Viewer extends Tracer
{
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
        $this->jump('login');
    }


    /**
     * 加入分组界面
     */
    public function join_group() {
        $this->jump('group');
    }


    /**
     * 更改密码界面
     */
    public function change_psd() {
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
        $this->jump('HomePage');
    }


    /** 导师端页面 */

    /**
     * 注册界面
     */
    public function m_signup() {

    }


    /**
     * 登录界面
     */
    public function m_login() {

    }


    /**
     * 创建帐号界面
     */
    public function m_create() {

    }


}