<?php

class Tool
{
    protected $connect = '';


    /**
     * 跳转到指定页面
     * @param $page string 要跳转到的页面
     * @param $message string 错误信息
     */
    public function jump($page,$message){
        echo '信息：'.$message;
        //head跳转
        exit();
    }


    /**
     * 检测用户是否存在
     * @param $username mixed 用户名
     * @param $email mixed 电子邮箱
     * @param $nickname mixed 用户昵称
     * @return string 如果用户名、电子邮箱或用户昵称存在，则返回存在字符串
     * @return integer 如果以上三项都未被注册，则返回整型数值1
     */
    public function check_sole($email,$username = null,$nickname = null){
        $sql = "SELECT email FROM user WHERE email = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param('s',$email);
        $stmt->execute() or $this->jump('','查询出错');
        if ($stmt->fetch())
            return '该邮箱已注册本网站';
        $stmt->free_result();

        if (isset($username)) {
            $sql = "SELECT user_name FROM user WHERE user_name = ?";
            $stmt = $this->connect->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute() or $this->jump('', '查询出错');
            if ($stmt->fetch())
                return '用户名已存在';
            $stmt->free_result();
        }

        if (isset($nickname)) {
            $sql = "SELECT wuan_name FROM user WHERE wuan_name = ?";
            $stmt = $this->connect->prepare($sql);
            $stmt->bind_param('s', $nickname);
            $stmt->execute() or $this->jump('', '查询出错');
            if ($stmt->fetch())
                return '该昵称已被注册';
            $stmt->free_result();
        }
        $stmt->close();

        return 1;
    }


    /**
     * 建立数据库连接
     * @param $host string MySQL服务器地址
     * @param $username mixed MySQL登录用户名
     * @param $psd mixed MySQL登录密码
     * @param $dbname string 设置执行查询语句的默认数据库
     * @param $port mixed 指定MySQL服务器的端口
     * @return array 返回连接是否成功的信息
     */
    public function db($host='localhost',$username='root',$psd='root',$dbname='weekly',$port='3306'){
        $this->connect = new mysqli($host,$username,$psd,$dbname,$port);
        if ($this->connect->connect_error)
            return array('mark'=>'error','message'=>$this->connect->connect_error);
        else
            return array('mark'=>'success');
    }


    /**
     * 设置session和cookie
     * @param $id integer 用户id
     * @param $username string 用户名
     * @param $nickname string 午安网昵称
     * session中token字符串存放的信息：用户id*用户名*用户昵称
     * cookie中token字符串存放的信息：用户id*用户名*用户昵称*令牌
     */
    public function setToken($id,$username,$nickname){
        $message = "$id*$username*$nickname";
        $token = "$message*".password_hash($message,PASSWORD_DEFAULT);

        $_SESSION['token'] = $message;
        setcookie('token',$token,time()+3600*24*7);
    }


    /**
     * 删除session和cookie */
    public function delToken(){
        session_destroy();

        foreach($_COOKIE as $key=>$val){
            setcookie($key,'',time()-1);
        }
    }


    /**
     * 检测用户是否已经登录
     * @return integer 如果已登录返回1，如果未登录返回0
     */
    public function check_state(){
        if (isset($_SESSION['token'])){
            return 1;
        }
        elseif (isset($_COOKIE['token'])){
            $message = explode('*',$_COOKIE['token']);
            if (count($message) !== 4){
                //cookie被篡改，删除用户登录凭证
                $this->delToken();
                return 0;
            }
            $str = "$message[0]*$message[1]*$message[2]";
            if (password_verify($str,$message[3])){
                //cookie文件存在且合法，设置session令牌
                $_SESSION['token'] = $message[0];
                return 1;
            }
        }
        //cookie和session均不存在，返回0
        return 0;
    }


}