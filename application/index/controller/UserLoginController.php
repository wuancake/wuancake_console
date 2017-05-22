<?php

namespace app\index\controller;

use app\index\model\Attend;
use app\index\model\UserLogin;
use think\Controller;
use think\Request;
use think\captcha\Captcha;
use think\Session;

class UserLoginController extends Controller
{
    public function test(){
        return view();
    }
//    //注册界面
//    public function register(){
//        return view();
//    }

    //登录界面
    public function log(){
        if (session('token'))
            $this->error('你已登录！','user_login_controller/login');
        else
            return view();
    }

    public function uploader(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->rule('md5_file($file)')->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            echo $info->getExtension().'<br>';
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getSaveName().'<br>';
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename().'<br>';
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

    public function group(){
        if (!session('token'))
            $this->error('非法访问！请先登录','user_login_controller/log');
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
        $User = new UserLogin();
        $captcha = new Captcha();
        $Attend = new Attend();

//        //判断验证码是否正确
//        $code = Request::instance()->param('code');
//        if (!$captcha->check($code))
//            $this->error('验证码错误！');

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
        if( $User->allowField(true)->save(input('post.'))){
            $Attend->user_id = $User->id;
            $Attend->group_id = 0;
            $Attend->save();
            $this->success('注册成功,即将转向登陆界面','user_login_controller/log');
        }
        else
            $this->error($User->getError());
    }

    //登录
    public function login(){
        //如果session文件存在，则跳转到用户界面(地址未确定)！！！！！！
        if (session('token')){
            $this->redirect('index/index');
        }
        $User = new UserLogin();
        $captcha = new Captcha();

//        //判断验证码是否正确
//        $code = Request::instance()->param('code');
//        if (!$captcha->check($code))
//            $this->error('验证码错误！','user_login_controller/log');

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
            //如果分组为0，即为没有分组，转向选择分组界面
            if ($info->group_id == 0) {
                $this->success('登录成功！', "user_login_controller/group");
            }
            //如果有分组，转向用户主页 (地址未确定)！！！！！！
            else{
                $this->success('登陆成功','index/index');
            }
        }
        else
            $this->error('邮箱或密码错误！');
    }

    //未加入分组的用户通过此方法选择分组
    //****此方法不进行用户是否已加入分组的判断***
    public function join(){
        if (!session('token'))
            $this->error('非法访问！请先登录','user_login_controller/log');
        //通过session获取用户id，获取用户要加入的分组
        $id = session('token');
        $group = $_GET['group'];
        //防止用户通过修改地址传递非法参数
        if ($group > 7 || $group <1)
            $this->error('非法参数！');
        //将数据更新到数据库
        $User = new UserLogin();
        $res = $User->where('id',"$id")->setField('group_id',$group);
        if ($res){
            //跳转到用户主页(地址未确定)！！！！！！！！！！
            $this->success('你已成功加入！', "index/index");
        }
        else{
            $this->error('加入分组失败或你已是该组成员！');
        }
    }

    //登出功能 临时增加 20170521 by CC
    public function logout(){
        Session::clear();
        $this->success('退出成功','user_login_controller/log');
    }


}