<?php
require_once  'config.php';

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


$connect = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
if ($connect->connect_error) {
    json(['error' => '数据库连接出错']);
}

!empty($_GET['week']) and is_numeric($_GET['week']) or json(['error' => '缺少必要的week参数或week参数为非数字']);
!empty($_GET['session']) or json(['error' => '缺少必要的参数:id']);

session_id($_GET['session']);
session_start();

empty($_SESSION['token']) and json(['error' => '错误的session_id']);

$num = $_GET['week'];
$id = $_SESSION['token']['id'];

exist_group($id, $connect) or json(array('error' => '用户未加入分组'));

$res = $connect->query("SELECT * FROM report WHERE user_id = $id AND week_num = $num") or $this->json(['error' => '获取信息出错，请检查参数是否合法']);

$res->num_rows or json(['status' => '未提交',
    'week' => $num]);

$data = $res->fetch_assoc();
$data['status'] == 1 and json(['status' => "未提交",
                                "week" => $data['week_num'],
                                "time" => $data['reply_time'],
                                "reason" => $data['text']]);

$data['status'] == 3 and json(['status' => "本周已请假",
                                "week" => $num,
                                "time" => $data['reply_time']]);

$message = $data['text'];
$message = explode('<br>', $message);

$done = str_replace('本周完成：', '', $message['0']);
$problem = str_replace('所遇问题：', '', $message['1']);
$todo = str_replace('下周计划：', '', $message['2']);
$url = empty(str_replace('作品链接：', '', $message['3'])) ? '无' : str_replace('作品链接：', '', $message['3']);

json(['status' => "已提交",
    "week" => $num,
    "time" => $data['reply_time'],
    "finished" => $done,
    "problem" => $problem,
    "plan" => $todo,
    "url" => $url]);