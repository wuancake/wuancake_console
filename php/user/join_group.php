<?php

require_once '../User.php';

$user = new User();

$user->check_state()
or
$this->jump('', '请先登录！');

empty($_GET['group_id'])
and
$user->jump('', '非法请求来源，缺少必要信息');

$user->login($_POST['email'], $_POST['password']);