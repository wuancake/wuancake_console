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
        return view();
    }

    //登陆成功后显示界面
    //判断用户权限，显示审批界面和管理界面入口
    public function station()
    {
        //判断用户是否登录
        if (Session::get('token')){
            return view('station',Session::get('token'));
        }
        else{
            $this->error('非法访问，请先登录','login/log');
        }
    }

    //登录
    public function login()
    {
        $User = new Adm();
        $email = Request::instance()->param('email');
        $psd = Request::instance()->param('password');

        if ($info = $User->where('email',$email)->find()){
            if ($info->password == md5($psd)){
                //登录成功
                //将用户id、用户名、用户权限、用户分组 存储session中，页面跳转
                $data = ['id'=>$info->id,'name'=>$info->username,'auth'=>$info->auth,'group'=>$info->group_id];
                Session::set('token',$data);
                $this->success('登陆成功，即将转向后台页面','login/station');
            }
            else{
                //密码错误
                $this->error('用户名或密码错误，请检查后重试');
            }
        }
        else {
            //用户不存在，请重新输入
            $this->error('用户不存在，请检查后重试');
        }
    }

    //注销登陆
    public function logout(){
        Session::delete('token');
        $this->success('已退出登录！','login/log');
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
    {   $type = Request::instance()->post('type');
        switch ($type){
            case 'tutor':
                //创建导师
                break;
            case 'admin':
                //创建管理员
                break;
            default:
                $this->error('参数有误，请按照正常的流程操作');
                break;
        }
//        $User = new Adm($_POST);
//        if ($User->allowField(true)->save()) {
//            $this->success('');
//        }
//        else{
//            $this->error($User->getError());
//        }
    }
}