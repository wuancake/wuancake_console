<?php
function json(array $info)
{
    echo json_encode($info);
    die();
}

empty($_GET['session']) and json(['error' => '缺少必要的参数:session_id']);
session_id($_GET['session']);
session_start();
empty($_SESSION['admin']) and json(['error' => '错误的session_id']);


$connect = new mysqli('localhost', 'root', 'root', 'weekly');
if ($connect->connect_error) {
    json(['error' => '数据库连接出错']);
}

$data['data'] = array();

$res = $connect->query("
        SELECT g.user_id,g.group_id,u.user_name,u.qq,g.headsman,g.modify_time FROM
        user_group AS g INNER JOIN user AS u ON g.user_id = u.id AND g.deleteFlg=1;");

while ($foo = $res->fetch_assoc()) { $data['data'][] = $foo;}

json($data);