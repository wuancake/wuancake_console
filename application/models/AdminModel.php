<?php

class AdminModel extends TracerModels
{

    /**
     * 查询email是否存在
     * @param $email string 要查询的邮箱地址
     * @return integer 如果存在返回1，如果不存在返回0
     */
    public function check_sole($email){
        $sql  = "SELECT email FROM adm WHERE email = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param('s', $email);
        if ($stmt->execute()){
            echo '系统错误，请稍后再试';
            exit();
        }

        if ($stmt->fetch()){
            $stmt->free_result();
            return 1;
        }
        else{
            $stmt->free_result();
            return 0;
        }

    }


    /**
     * 储存session和cookie信息
     * @param $id mixed 用户id
     * @param $username mixed 用户姓名
     * @param $auth mixed 用户权限
     * @param $group_id mixed 用户分组
     */
    public function setToken($id, $username, $auth,$group_id){
        $message = "$id*$username*$auth*$group_id";
        $token   = "$message*" . password_hash($message, PASSWORD_DEFAULT);

        $_SESSION['token'] = array('id' => $id, 'username' => $username, 'auth' => $auth,'group'=>$group_id);
        setcookie('token', $token, time() + 3600 * 24 * 7, '/');
    }


    /**
     * 查看登录状态
     */
    public function check_state(){
        if (isset($_SESSION['token'])) {
            return 1;
        }
        elseif (isset($_COOKIE['token'])) {
            $message = explode('*', $_COOKIE['token']);
            if (count($message) !== 5) {
                //cookie被篡改，删除用户登录凭证
                $this->delToken();
                return 0;
            }
            $str = "$message[0]*$message[1]*$message[2]*$message[3]";
            if (password_verify($str, $message[4])) {
                //cookie文件存在且合法，设置session令牌
                $_SESSION['token'] = array('id' => $message[0], 'username' => $message[1], 'auth' => $message[2],'group'=>$message[3]);
                return 1;
            }
        }
        //cookie和session均不存在
        return 0;
    }


    /**
     * 删除session和cookie
     */
    public function delToken(){
        session_unset();
        session_destroy();

        foreach ($_COOKIE as $key => $val) {
            setcookie($key, '', time() - 10000,'/');
            unset($_COOKIE[$key]);
        }

    }


}