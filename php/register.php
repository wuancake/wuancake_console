<?php

require_once './User.php';

$user = new User();

empty($_POST['username']) || empty($_POST['email']) || empty($_POST['nickname']) || empty($_POST['password']) || empty($_POST['qq']) || empty($_POST['repassword'])
and
$user->jump('','非法请求来源，缺少必要信息');

$user->register($_POST['username'],$_POST['email'],$_POST['nickname'], $_POST['password'],$_POST['qq'],$_POST['repassword']);