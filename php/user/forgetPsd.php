<?php

require_once '../User.php';

$user = new User();

empty($_POST['email'])
and
$user->jump('', '非法请求来源，缺少必要信息');

$user->recover_psd($_POST['email']);
