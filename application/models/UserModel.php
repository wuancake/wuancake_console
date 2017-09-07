<?php

class UserModel extends TracerModels
{

    protected  $terminal = '';

    public function __construct() {
        parent::__construct();
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if (strpos($agent, 'iphone') || strpos($agent, 'android'))
            $this->terminal = 'mobile';
        else
            $this->terminal = 'computer';
//        if (strpos($agent, 'windows nt') || strpos($agent, 'macintosh'))
//            $this->terminal = 'computer';
//        else
//            $this->terminal = 'mobile';
    }


    /**
     * 跳转到指定页面
     * @param $page string 要跳转到的页面
     * @param $message mixed 错误信息
     * @param $url mixed 要跳转的链接，形如 类名/方法名
     */
    public function jump($page, $message = '', $url = '') {
        ob_end_clean();
        require_once "./application/views/$this->terminal/" . $page . '.php';
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
    public function check_sole($email, $username = null, $nickname = null) {
        $sql  = "SELECT email FROM user WHERE email = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute() or $this->jump('skip', '查询出错');
        if ($stmt->fetch())
            return '该邮箱已注册本网站';
        $stmt->free_result();

        if (isset($username)) {
            $sql  = "SELECT user_name FROM user WHERE user_name = ?";
            $stmt = $this->connect->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute() or $this->jump('skip', '查询出错');
            if ($stmt->fetch())
                return '用户名已存在';
            $stmt->free_result();
        }

        if (isset($nickname)) {
            $sql  = "SELECT wuan_name FROM user WHERE wuan_name = ?";
            $stmt = $this->connect->prepare($sql);
            $stmt->bind_param('s', $nickname);
            $stmt->execute() or $this->jump('skip', '查询出错');
            if ($stmt->fetch())
                return '该昵称已被注册';
            $stmt->free_result();
        }
        $stmt->close();

        return 1;
    }


    /**
     * 设置session和cookie
     * @param $id integer 用户id
     * @param $username string 用户名
     * @param $nickname string 午安网昵称
     * session中token数组存放的信息：id=>用户id,username=>用户名,nickname=>用户昵称
     * cookie中token字符串存放的信息：用户id*用户名*用户昵称*令牌
     */
    public function setToken($id, $username, $nickname) {
        $message = "$id*$username*$nickname";
        $token   = "$message*" . password_hash($message, PASSWORD_DEFAULT);

        $_SESSION['token'] = array('id' => $id, 'username' => $username, 'nickname' => $nickname);
        setcookie('token', $token, time() + 3600 * 24 * 7, '/');
    }


    /**
     * 删除session和cookie
     */
    public function delToken() {
        session_unset();
        session_destroy();

        foreach ($_COOKIE as $key => $val) {
            setcookie($key, '', time() - 10000,'/');
            unset($_COOKIE[$key]);
        }
    }


    /**
     * 检测用户是否已经登录
     * @return integer 如果已登录返回1，如果未登录返回0
     */
    public function check_state() {
        if (isset($_SESSION['token'])) {
            return 1;
        }
        elseif (isset($_COOKIE['token'])) {
            $message = explode('*', $_COOKIE['token']);
            if (count($message) !== 4) {
                //cookie被篡改，删除用户登录凭证
                $this->delToken();
                $this->jump('skip', '请先登录', 'viewer/index');
            }
            $str = "$message[0]*$message[1]*$message[2]";
            if (password_verify($str, $message[3])) {
                //cookie文件存在且合法，设置session令牌
                $_SESSION['token'] = array('id' => $message[0], 'username' => $message[1], 'nickname' => $message[2]);
                return 1;
            }
        }
        //cookie和session均不存在
        $this->jump('skip', '请先登录', 'viewer/index');
    }


    /**
     * 发送邮件
     * @param $email string 电子邮箱地址
     * @param $info mixed 要发送的信息
     */
    public function send_mail($email, $info) {
        require './library/mailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host       = 'smtp.qq.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '459472218@qq.com';
        $mail->Password   = 'qpqzmxasigvzbhef';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        $mail->setFrom('459472218@qq.com', 'wuan');
        $mail->addAddress($email, 'user');     // Add a recipient
//        $mail->addAddress('ellen@example.com');               // Name is optional
//        $mail->addReplyTo('info@example.com', 'Information');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');
        $mail->isHTML(false);

        $mail->Subject = 'reset password';
        $mail->Body    = '请访问以下链接进行重置密码操作：' . $info;

        if (!$mail->send()) {
            echo 'Message could not be sent.' . 'Mailer Error: ' . $mail->ErrorInfo;
            die();
        }

    }


    /**
     * 检测用户是否加入分组
     * @return integer 已加入返回1，未加入返回2
     */
    public function exist_group() {
        $id = @$_SESSION['token']['id'];

        $sql = "SELECT group_id FROM user_group WHERE user_id = $id";
        $res = $this->connect->query($sql)->num_rows;

        return $res != 0;
    }


    /**
     * 查询用户的分组代号
     * 需要登陆后使用
     * @return integer 用户的分组代号
     */
    public function sel_group(){
        $id       = @$_SESSION['token']['id'];
        $id = (int)$id;
        return $this->connect->query("SELECT group_id FROM user_group WHERE user_id = $id")->fetch_assoc()['group_id'];

    }
}