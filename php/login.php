<?php

require_once './User.php';

$user = new User();

empty($_POST['email']) || empty($_POST['password'])
and
$user->jump('','非法请求来源，缺少必要信息');

$user->login($_POST['email'],$_POST['password']);