<?php

require_once '../User.php';

$user = new User();

empty($_POST['password']) || empty($_POST['newpsd']) || empty($_POST['renewpsd'])
and
$user->jump('','非法请求来源，缺少必要信息');

$user->reset_psd($_POST['password'],$_POST['newpsd'],$_POST['renewpsd']);