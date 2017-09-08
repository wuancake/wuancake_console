<?php

function json(array $info)
{
    echo json_encode($info);
    die();
}

empty($_GET['session']) and json(['error' => '缺少必要的参数:id']);
session_id($_GET['session']);
session_start();
empty($_SESSION['token']) and json(['error' => '错误的session_id']);


$connect = new mysqli('localhost', 'root', 'root', 'weekly');
if ($connect->connect_error) {
    json(['error' => '数据库连接出错']);
}

//当前
$week_num = ceil((time() - strtotime('2015-11-02')) / 604800)-1;
$data['data'] = array();

if (empty($_GET['week'])) {
    if (empty($_GET['group'])) {
        //返回前一周，所有分组的周报提交情况
        ($_SESSION['token']['auth'] == 1) and json(['error' => '权限不足，导师只能查看本组学员的周报提交情况']);

        $res = $connect->query("SELECT report.*,user.user_name AS name FROM report 
                                        INNER JOIN user WHERE report.user_id = user.id 
                                        AND week_num = $week_num");
        while ($foo = $res->fetch_assoc()) {
            $data['data'][] = $foo;
        }
        json($data);
    } else {
        //返回前一周，指定分组的周报提交情况
        ($_SESSION['token']['auth'] == 1) && ($_SESSION['token']['group'] !== $_GET['group'])
        and json(['error' => '权限不足，导师只能查看本组学员的周报提交情况']);

        $res = $connect->query("SELECT report.*,user.user_name AS name FROM report 
                                        INNER JOIN user WHERE report.user_id = user.id 
                                        AND week_num = $week_num AND group_id = {$_GET['group']};");

        while ($foo = $res->fetch_assoc()) {
            $data['data'][] = $foo;
        }
        json($data);
    }
} else {
    //返回指定周数，指定分组的周报提交情况
    ($_SESSION['token']['auth'] == 1) && ($_SESSION['token']['group'] !== $_GET['group'])
    and json(['error' => '权限不足，导师只能查看本组学员的周报提交情况']);

    $res = $connect->query("SELECT report.*,user.user_name AS name FROM report 
                                        INNER JOIN user WHERE report.user_id = user.id 
                                        AND week_num = {$_GET['week']} AND group_id = {$_GET['group']};");

    while ($foo = $res->fetch_assoc()) {
        $data['data'][] = $foo;
    }
    json($data);

}