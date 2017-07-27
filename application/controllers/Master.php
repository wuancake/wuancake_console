<?php
/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/26 0026
 * Time: 15:15
 */

class Master extends User
{

    /**
     * 登录
     * $name string 用户名
     * $psd mixed 密码
     */
    public function login() {
        $name = $this->post('name','viewer/m_login');
        $psd = $this->post('password','viewer/m_login');
    }


    /**
     * 创建帐号
     * $email string 用户邮箱
     * $name string 昵称
     * $psd string 密码
     * $auth int 权限，1:导师；2:管理员；3:最高管理员；
     * $group int 分组，最高管理员分组为0
     */
    public function create_acc() {
        $email = $this->post('email','viewer/m_create');
        $name = $this->post('name','viewer/m_create');
        $psd = $this->post('password','viewer/m_create');
        $auth = $this->post('auth','viewer/m_create');
        $group = $this->post('group','viewer/m_create');
    }



}