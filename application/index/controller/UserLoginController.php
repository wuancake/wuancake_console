<?php

namespace app\index\controller;

use app\index\model\UserLogin;
use think\Controller;
use think\Request;
use think\captcha\Captcha;

class UserLoginController extends Controller
{
    //注册界面
    public function register(){
        return view();
    }

    //登录界面
    public function log(){
        return view();
    }

    public function group(){
        return view();
    }

    //注册
    public function add(){
        $User = new UserLogin();
        $captcha = new Captcha();

        //判断验证码是否正确
        $code = Request::instance()->param('code');
        if (!$captcha->check($code))
            $this->error('验证码错误！');

        //获取数据
        $username = Request::instance()->param('user_name');
        $email = Request::instance()->param('email');
        $result1 = $User->where('user_name',"$username")->find();
        $result2 = $User->where('email',"$email")->find();

        //判断两次输入的密码是否一致
        if (Request::instance()->param('password') != Request::instance()->param('repassword'))
            $this->error('两次输入的密码不一致！请检查并重新输入！');

        //判断用户名是否存在
        if (isset($result1))
            $this->error('该用户名已被注册！');

        //判断邮箱是否已注册
        if (isset($result2))
            $this->error('该邮箱已经注册，请使用邮箱账户登录');

        //将用户数据写入数据库
        if( $User->allowField(true)->save(input('post.')))
            $this->success('注册成功,即将转向登陆界面','user_login_controller/log');
        else
            $this->error($User->getError());
    }

    //登录
    public function login(){
        $User = new UserLogin();
        $captcha = new Captcha();

        //判断验证码是否正确
        $code = Request::instance()->param('code');
        if (!$captcha->check($code))
            $this->error('验证码错误！');

        //判断输入的邮箱是否已注册
        $email = Request::instance()->param('email');
        $resemail = $User->where('email',"$email")->find();
        if (!isset($resemail))
            $this->error('该邮箱尚未注册网站');

        //判断密码是否正确
        $password = Request::instance()->param('password');
        $repassword = $User->where('email',"$email")->find();
        if ($repassword->password == md5($password))
            $this->success('登录成功！','user_login_controller/group');
        else
            $this->error('邮箱或密码错误！');
    }



}