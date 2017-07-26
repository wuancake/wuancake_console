<form method="post" action="login.php">
    <input type="text" name="email">
    <input type="password" name="password">
    <input type="submit" value="login">
</form>
<?php
//session_start();
//var_dump($_SESSION['token']);
//printf($_COOKIE['token']);
////var_dump($_SESSION['token']);
//var_dump($_COOKIE['token']);
//require_once 'User.php';
//$user = new User();
//$user->quit();
//$user->check_state() and $user->jump('','你已登陆');

//if (!empty($_SESSION['token']))
//    echo '存在session'."<br/>******".var_dump($_SESSION['token']);
//
//if (!empty($_COOKIE['token']))
//    echo '***存在cookie'.$_COOKIE['token'];