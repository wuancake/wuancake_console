<?php
/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/22 0022
 * Time: 3:02
 */
require_once './User.php';

$user = new User();

$user->login($_POST['email'],$_POST['password']);