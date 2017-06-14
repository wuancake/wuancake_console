<?php

namespace app\index\controller;

use app\index\model\Attend;
use app\index\model\User AS UserModel;
use think\Controller;
use think\Db;
use think\Request;
//use think\captcha\Captcha;
use think\Session;

class User extends Controller
{

    //登录界面
    public function test()
    {
        return view('log');
    }

    public function log(){
        if (session('token'))
            $this->error('你已登录！','user/login');
        else
            return view();
    }

    public function group(){
        if (!session('token'))
            $this->error('非法访问！请先登录','user/log');
        return view();
    }

    //注册
    public function add(){
        $UserModel = new UserModel();
        $Attend = new Attend();

        //获取数据
        $username = Request::instance()->param('user_name');
        $email = Request::instance()->param('email');
        $qq = Request::instance()->param('QQ');
        $wuan_name = Request::instance()->param('wuan_name');
        $psd = Request::instance()->param('password');
        $result1 = $UserModel->where('user_name',"$username")->find();
        $result2 = $UserModel->where('email',"$email")->find();

        //判断用户名是否为空
        if ($username == ''){
            $this->error('用户民不能为空！');
        }

        //检测用户名中是否存在空格
        if (strpos($username,' ') !== false){
            $this->error('用户名中不能包含空格');
        }

        //检测邮箱是否合法
        if ($email == '' || strpos($email,' ') !== false){
            $this->error('邮箱帐号不能为空或存在空格');
        }

        //判断QQ号是否合法
        if ($qq == '' || strpos($qq,' ') !== false){
            $this->error('QQ号不能为空或存在空格');
        }
        elseif (!is_numeric($qq)){
            $this->error('QQ号必须是纯数字字符串');
        }

        //判断午安昵称是否合法
        if ($wuan_name == '' || strpos($wuan_name,' ') !== false){
            $this->error('午安昵称不能为空或存在空格');
        }

        //判断密码是否合法
        if ($psd == '' || strpos($psd,' ') !== false){
            $this->error('密码不能为空或存在空格');
        }

        //判断两次输入的密码是否一致
        if ($psd != Request::instance()->param('repassword'))
            $this->error('两次输入的密码不一致！请检查并重新输入！');

        //判断用户名是否存在
        if (isset($result1))
            $this->error('该用户名已被注册！');

        //判断邮箱是否已注册
        if (isset($result2))
            $this->error('该邮箱已经注册，请使用邮箱账户登录');

        //将用户数据写入数据库
        if( $UserModel->allowField(true)->save(input('post.'))){
            $Attend->user_id = $UserModel->id;
            $Attend->group_id = 0;
            $Attend->save();

            //新注册用户无须在此时选择分组 201706091254 xiaochao
            $this->success('注册成功,即将转向登录界面','user/log');
        }
        else
            $this->error($UserModel->getError());
    }

    //登录
    public function login(){
        //如果session文件存在，则跳转到用户界面
        if (session('token')){
            $this->redirect('index/index');
        }
        $User = new UserModel();

        $email = Request::instance()->param('email');
        //判断邮箱是否为空或存在空格
        if ($email == '' || strpos($email,' ') !== false){
            $this->error('输入的邮箱格式有误，请检查后重新输入');
        }

        //判断输入的邮箱是否已注册
        $resemail = $User->where('email',"$email")->find();
        if (!isset($resemail))
            $this->error('该邮箱尚未注册网站');

        //判断密码是否正确
        $password = Request::instance()->param('password');

        //判断密码是否格式正确
        if ($password == '' || strpos($password,' ') !== false){
            $this->error('密码不能为空或存在空格');
        }

        $info = $User->where('email',"$email")->find();
        if ($info->password == md5($password)) {
            session('token',"$info->id");
            //如果没有分组，转向选择分组界面
            if ($User->exist_user_group($info->id)) {
                $this->success('登录成功！','index/index');
            }
            //如果有分组，转向用户主页
            else{
                $this->success('登录成功！', "user/group");
            }
        }
        else
            $this->error('邮箱或密码错误！');
    }

    //未加入分组的用户通过此方法选择分组
    public function join(){
        if (!session('token'))
            $this->error('非法访问！请先登录','user/log');
        //通过session获取用户id，获取用户要加入的分组
        $id = session('token');
        $group = $_GET['group'];
        //防止用户通过修改地址传递非法参数
        if ($group > 7 || $group <1)
            $this->error('非法参数！');
        //防止用户通过修改地址重新加入分组
        $UserModel = new UserModel();
        //判断用户是否加入分组 20170609 新增
        if ($UserModel->exist_user_group($id))
            $this->error('你已加入分组！');
        //将数据更新到数据库
        //$res = $UserModel->where('id',"$id")->setField('group_id',$group);
        $data = [
            'user_id' => $id,
            'group_id' => $group,
            'deleteFlg' =>0,
            'create_time' =>date('Y-m-d H:i:s'),
            'modify_time' =>date('Y-m-d H:i:s'),
        ];
        $res = $UserModel->join_group($data);
        if ($res){
            $this->success('你已成功加入！', "index/index");
        }
        else{
            $this->error('加入分组失败或你已是该组成员！');
        }
    }

    //登出功能 临时增加 20170521 by CC
    public function logout(){
        Session::clear();
        $this->success('退出成功','user/log');
    }


}