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


$connect = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
if ($connect->connect_error) {
    json(['error' => '数据库连接出错']);
}

//默认前一周
$week_num = ceil((time() - strtotime('2015-11-02')) / 604800)-1;
$data['data'] = array();

if (empty($_GET['week'])) {
    if (empty($_GET['group'])) {
        //返回前一周，所有分组的周报提交情况
        ($_SESSION['admin']['auth'] == 1) and json(['error' => '权限不足，导师只能查看本组学员的周报提交情况']);

        $res = $connect->query("SELECT r.*,user.user_name AS name FROM 
                                        (report as r INNER JOIN user ON r.user_id = user.id AND r.week_num = $week_num)
                                        INNER JOIN user_group AS g ON g.user_id = r.user_id AND g.deleteFlg = 0");
        while ($foo = $res->fetch_assoc()) {
            $data['data'][] = $foo;
        }
        json($data);
    } else {
        //返回前一周，指定分组的周报提交情况
        ($_SESSION['admin']['auth'] == 1) && ($_SESSION['admin']['group'] !== $_GET['group'])
        and json(['error' => '权限不足，导师只能查看本组学员的周报提交情况']);

        $res = $connect->query("SELECT r.*,user.user_name AS name FROM 
                                        (report as r INNER JOIN user ON r.user_id = user.id AND r.week_num = $week_num AND r.group_id = {$_GET['group']})
                                        INNER JOIN user_group AS g ON g.user_id = r.user_id AND g.deleteFlg = 0;");

        while ($foo = $res->fetch_assoc()) {
            $data['data'][] = $foo;
        }
        json($data);
    }
} else {
    if(!empty($_GET['group'])) {
        //返回指定周数，指定分组的周报提交情况
        ($_SESSION['admin']['auth'] == 1) && ($_SESSION['admin']['group'] !== $_GET['group'])
        and json(['error' => '权限不足，导师只能查看本组学员的周报提交情况']);

        $res = $connect->query("SELECT r.*,user.user_name AS name FROM 
                                        (report AS r INNER JOIN user ON r.user_id = user.id 
                                        AND r.week_num = {$_GET['week']} AND r.group_id = {$_GET['group']})
                                        INNER JOIN user_group AS g ON g.user_id = r.user_id AND g.deleteFlg = 0;");

        while ($foo = $res->fetch_assoc()) {
            $data['data'][] = $foo;
        }
        json($data);
    }else{
        //返回指定周数，所有分组的周报提交情况
        ($_SESSION['admin']['auth'] == 1)
        and json(['error' => '权限不足，导师只能查看本组学员的周报提交情况']);

        $res = $connect->query("SELECT r.*,user.user_name AS name FROM 
                                        (report AS r INNER JOIN user ON r.user_id = user.id AND r.week_num = {$_GET['week']})
                                        INNER JOIN user_group AS g ON g.user_id = r.user_id AND g.deleteFlg = 0;");

        while ($foo = $res->fetch_assoc()) {
            $data['data'][] = $foo;
        }
        json($data);
    }
}