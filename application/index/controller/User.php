<?php

namespace app\index\controller;

use app\index\model\Attend;
use app\index\model\User AS UserModel;
use app\index\model\UserGroup;
use think\Controller;
use think\Db;
use think\Request;
//use think\captcha\Captcha;
use think\Session;

class User extends Controller
{
//    public function test(){
//        return view();
//    }

    //登录界面
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
//    public function check_cap()
//    {
//        $captcha = new Captcha();
//        $code = Request::instance()->param('code');
//        if (!$captcha->check($code)){
//            echo '验证码不正确';
//        }else{
//            echo '验证码正确!';
//        }
//    }

    //注册
    public function add(){
        $UserModel = new UserModel();
//        $captcha = new Captcha();
        $Attend = new Attend();
        $Group = new UserGroup();

//        //判断验证码是否正确
//        $code = Request::instance()->param('code');
//        if (!$captcha->check($code))
//            $this->error('验证码错误！');

        //获取数据
        $username = Request::instance()->param('user_name');
        $email = Request::instance()->param('email');
        $result1 = $UserModel->where('user_name',"$username")->find();
        $result2 = $UserModel->where('email',"$email")->find();

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
        if( $UserModel->allowField(true)->save(input('post.'))){
            $Attend->user_id = $UserModel->id;
            $Attend->group_id = 0;
            $Attend->save();

            //将用户分组信息写入分组表
            $Group->user_id = $UserModel->id;
            $Group->group_id = 0;
            $Group->save();
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
        $Group = new UserGroup();
//        $captcha = new Captcha();

//        //判断验证码是否正确
//        $code = Request::instance()->param('code');
//        if (!$captcha->check($code))
//            $this->error('验证码错误！','user/log');

        //判断输入的邮箱是否已注册
        $email = Request::instance()->param('email');
        $resemail = $User->where('email',"$email")->find();
        if (!isset($resemail))
            $this->error('该邮箱尚未注册网站');

        //判断密码是否正确
        $password = Request::instance()->param('password');
        $info = $User->where('email',"$email")->find();
        if ($info->password == md5($password)) {
            session('token',"$info->id");
            //如果没有分组，转向选择分组界面
            if ($UserModel->exist_user_group($info->id)) {
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
        $Group = new UserGroup();
        //判断用户是否加入分组 20170609 新增
        if ($UserModel->exist_user_group($id))
        //if ($UserModel->where('id',session('token'))->find()->group_id)
        if ($Group ->where('user_id',session('token'))->find()->group_id)
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