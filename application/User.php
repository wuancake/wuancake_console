<?php

require_once './Tool.php';
/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/21 0021
 * Time: 17:02
 */
class User extends Tool
{
    private $id = '';
    private $token = '';


    public function __construct(){
        count($this->db()) === 1 or $this->jump('','数据库连接出错');
        session_start();
    }


    /**
     * 注册
     * @param $username string 用户名
     * @param $email string 电子邮箱，用来登录
     * @param $nickname string 午安昵称
     * @param $psd string 密码
     * @param $qq string QQ号
     * @param $rpsd string 确认输入的密码
     */
    public function register($username,$email,$nickname,$psd,$qq,$rpsd){
        $psd === $rpsd or $this->jump('wrong_psd','两次输入密码不一致');
        is_numeric($qq) or $this->jump('wrong_qq','请输入正确的QQ号码');
        $date = date('Y-m-d H:m:s');
        $password = password_hash($psd,PASSWORD_DEFAULT);

        ($message = $this->check_sole($username,$email,$nickname)) === 1 or $this->jump('',$message);

        $sql = "INSERT INTO user VALUE (DEFAULT,?,?,?,?,?,0,0,'$date','$date')";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param('ssssi',$username,$email,$nickname,$password,$qq);
        $stmt->execute() or $this->jump('wrong_sql','注册失败，可能含有非法信息');
        $stmt->close();

        $this->jump('','注册成功');
    }


    /**
     * 登录
     * @param $email string 电子邮箱
     * @param $psd string 密码
     */
    public function login($email,$psd){
        $this->check_sole($email) === 1 and $this->jump('','该邮箱尚未在本网站注册');

        $sql = "SELECT id,user_name,wuan_name,password FROM user WHERE email = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param('s',$email);
        $stmt->bind_result($id,$username,$wuan_name,$hash);
        $stmt->execute() or $this->jump('','未知错误，请稍后重试');

        $stmt->fetch();
        password_verify($psd,$hash) or $this->jump('','用户名或密码错误！');

        //验证成功，储存session和cookie信息
        $this->setToken($id,$username,$wuan_name);


    }


    /**
     * 退出登录
     */
    public function quit(){
        $this->delToken();
        $this->jump('','你已退出登录！');
    }


    /**
     * 修改密码*/
    public function reset_psd(){

    }


    /**
     * 找回密码
     *
     */
    public function recover_psd(){

    }
}
