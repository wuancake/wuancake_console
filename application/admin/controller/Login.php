<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Adm;
use think\Request;
use think\Session;

class Login extends Controller
{
    //登录界面
    public function log(){
//        return view('log');
        echo 13123;
    }
    //注册界面
    public function sig(){
        return view('sig');
    }
    //用户名是否重复判断
    public function name_judge()
    {
        $User = new Adm();
        $name = Request::instance()->post('name');
        //用户存在返回-1，不存在返回1
        if ($User->where('name',$name)->find())
            return -1;
        else
            return 1;
    }

    //email是否重复注册判断
    public function email_judge()
    {
        $User = new Adm();
        $email = Request::instance()->post('email');
        //邮箱存在返回-1，不存在返回1
        if ($User->where('name',$email)->find())
            return -1;
        else
            return 1;
    }

    //注册，执行此方法时数据已经由js和ajax做判断处理
    public function signin()
    {
        $User = new Adm($_POST);
        if ($User->allowField(true)->save()) {
            $this->success('');
        }
        else{
            $this->error($User->getError());
        }
    }

    //登录
    public function login()
    {
        $User = new Adm();
        $email = Request::instance()->param('email');
        $psd = Request::instance()->param('password');

        if ($info = $User->where('name',$email)->find()){
            if ($info->password == md5($psd)){
                //登录成功
                //存储session，页面跳转
            }
            else{
                //密码错误，页面跳转
            }
        }
        else{
            //用户不存在，请重新输入，页面跳转
        }
    }

    //登陆成功后显示界面
    //判断用户权限，显示审批界面和管理界面入口
    public function auth_approve()
    {

    }
}