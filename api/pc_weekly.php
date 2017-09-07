<?php
define('SIZE', 5);

function json(array $info)
{
    echo json_encode($info);
    die();
}

function exist_group($id, $connect)
{
    $sql = "SELECT group_id FROM user_group WHERE user_id = $id";
    $res = $connect->query($sql)->num_rows;

    return $res != 0;
}


$connect = new mysqli('localhost', 'root', 'root', 'weekly');
if ($connect->connect_error) {
    json(['error' => '数据库连接出错']);
}


isset($_GET['session']) or json(['error' => '缺少必要的参数:id']);
isset($_GET['page']) and is_numeric($_GET['page']) or json(['error' => '缺少必要的page参数或者page为非数字']);

session_id($_GET['session']);
session_start();

empty($_SESSION['token']) and json(['error' => '错误的session_id']);

$page = $_GET['page'];
$id = $_SESSION['token']['id'];

exist_group($id, $connect) or json(array('error' => '用户未加入分组'));


$offset = ($page - 1) * SIZE;
$res = $connect->query("SELECT * FROM report WHERE user_id = $id ORDER BY week_num DESC LIMIT $offset," . SIZE);

$res->num_rows or json(['error' => '该用户当前未提交任何周报']);

$info = ['data' => []];

while ($data = $res->fetch_assoc()) {
    switch ($data['status']) {
        case 2:
            $message = $data['text'];
            $message = explode('<br>', $message);

            $done = str_replace('本周完成：', '', $message['0']);
            $problem = str_replace('所遇问题：', '', $message['1']);
            $todo = str_replace('下周计划：', '', $message['2']);
            $url = isset($message['3']) ? $message['3'] : '无';

            $info['data'][] = [
                'status' => "已提交",
                "week" => $data['week_num'],
                "time" => $data['reply_time'],
                "finished" => $done,
                "problem" => $problem,
                "plan" => $todo,
                "url" => $url];
            break;

        case 3:
            $info['data'][] = [
                'status' => "已请假",
                "week" => $data['week_num'],
                "time" => $data['reply_time'],
                "reason" => $data['text']];
            break;

        default:
            //程序进行到此处时，一般为有人恶意手动向数据库添加脏数据
            $info = ['error' => '遭遇未知错误'];
            break 2;
    }
}

json($info);