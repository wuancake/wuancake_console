<?php
require_once  '../config.php';

function json(array $info)
{
    echo json_encode($info);
    die();
}

empty($_GET['session']) and json(['error' => '缺少必要的参数:session_id']);
session_id($_GET['session']);
session_start();
empty($_SESSION['admin']) and json(['error' => '错误的session_id']);
empty($_GET['user_id']) and json(['error' => '缺少必要的参数:user_id']);

$connect = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
if ($connect->connect_error) {
    json(['error' => '数据库连接出错']);
}

$user_id = $_GET['user_id'];
$user_group = $connect->query("SELECT group_id FROM user_group WHERE user_id = $user_id")->fetch_assoc()['group_id'];

$headsman = $_SESSION['admin']['username'];
$_SESSION['admin']['auth'] === 1 && $_SESSION['admin']['group'] !== $user_group and json( ['error'=>'非法请求，导师只能踢出本组的人']);

$time = date('Y-m-d H:m:s');

$res = $connect->query("UPDATE user_group SET deleteFlg = 1 , headsman = '$headsman' ,modify_time = '$time'
                                    WHERE user_id = $user_id AND create_time IN 
                                    (SELECT value FROM 
                                    (SELECT max(modify_time) AS value FROM user_group WHERE user_id = $user_id ORDER BY modify_time DESC)
                                    AS gp);");

$res or json(['error'=>'踢人失败']);

json(['success'=>'踢人成功']);