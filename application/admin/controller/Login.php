<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Adm;
use think\Request;
use think\Session;

class Login extends Controller
{
    /********************** 登录功能 ***********************/
    //登录界面
    public function log(){
        return view();
    }

    //登陆成功后显示界面
    //判断用户权限，显示审批界面和管理界面入口
    public function station()
    {
        //判断用户是否登录
        if (Session::get('adm_token')){
            return view('station',Session::get('adm_token'));
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
                Session::set('adm_token',$data);
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
        Session::delete('adm_token');
        $this->success('已退出登录！','login/log');
    }

/********************** 账号添加 **********************/

    //注册
    public function signin()
    {
        if (!Session::get('adm_token'))
            $this->error('非法访问，请先登录');
        $User = new Adm($_POST);

        //判断用户名是否存在
        $name = Request::instance()->post('name');
        if ($User->where('username',$name)->find())
            $this->error('该用户名已存在');

        //判断电子邮箱是否存在
        $email = Request::instance()->post('email');
        if ($User->where('email',$email)->find())
            $this->error('该电子邮箱已被占用');

        //判断两次输入密码是否相同
        if ( Request::instance()->post('password') != Request::instance()->post('repassword'))
            $this->error('两次输入的密码不同，请确认后重试');

        //信息合法，写入数据库
        //重写密码，触发修改器
        $User->password = Request::instance()->post('password');

        //判断是创建导师还是管理员
        $type = Request::instance()->post('type');
        switch ($type){
            case 'tutor':
                //创建导师
                //如果用户为导师权限，企图创建导师，则报错
                if (Session::get('adm_token')['auth'] == 1)
                    $this->error('你没有此权限！');
                //判断分组信息是否合法
                $group = Request::instance()->post('group_id');
                if ($group < 1 || $group > 7)
                    $this->error('请选择正确的分组');
                $User->auth = 1;
                break;
            case 'admin':
                //创建管理员
                //如果用户为导师或管理权限，企图创建管理员，则报错
                if (Session::get('adm_token')['auth'] != 3)
                    $this->error('你没有此权限！');
                $User->auth = 2;
                break;
            default:
                $this->error('参数有误，请按照正常的流程操作');
                break;
        }

        //将帐号信息写入数据库
        if ($User->allowField(true)->save()) {
            //写入成功
            $this->success('创建帐号成功');
        }
        else{
            //写入失败返回-1
            $this->error('创建失败，请稍候重试');
        }

    }
}