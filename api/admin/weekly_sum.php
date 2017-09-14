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

//从前一周开始，记录四周
$week_num1 = ceil((time() - strtotime('2015-11-02')) / 604800)-1;
$week_num2 = $week_num1-1;
$week_num3 = $week_num2-1;
$week_num4 = $week_num3-1;

$data['data'] = array();

if (empty($_GET['week'])) {
    if (empty($_GET['group'])) {

        //返回前4周，所有分组的周报提交情况
        ($_SESSION['admin']['auth'] == 1)
        and json(['error' => '权限不足，导师只能查看本组学员的考勤汇总']);

        $res = $connect->query("
             SELECT user.id,a.group_id,user.user_name,user.qq,a.status AS week1,b.status AS week2,c.status AS week3,d.status AS week4
             FROM 
             (((report AS a INNER JOIN user ON a.user_id = user.id AND a.week_num = $week_num1) 
             INNER JOIN report AS b ON a.user_id = b.user_id AND b.week_num = $week_num2)
             INNER JOIN report AS c ON a.user_id = c.user_id AND c.week_num = $week_num3)
             INNER JOIN report AS d ON a.user_id = d.user_id AND d.week_num = $week_num4
             INNER JOIN user_group ON a.user_id = user_group.user_id AND user_group.deleteFlg = 0;");

        while ($foo = $res->fetch_assoc()) { $data['data'][] = $foo;}

        json($data);

    } else {

        //返回前4周，指定分组的周报提交情况
        ($_SESSION['admin']['auth'] == 1) && ($_SESSION['admin']['group'] !== $_GET['group'])
        and json(['error' => '权限不足，导师只能查看本组学员的考勤汇总']);

        $res = $connect->query("SELECT user.id,a.group_id,user.user_name,user.qq,a.status AS week1,b.status AS week2,c.status AS week3,d.status AS week4
             FROM 
             (((report AS a INNER JOIN user ON a.user_id = user.id AND a.week_num = $week_num1) 
             INNER JOIN report AS b ON a.user_id = b.user_id AND b.week_num = $week_num2)
             INNER JOIN report AS c ON a.user_id = c.user_id AND c.week_num = $week_num3)
             INNER JOIN report AS d ON a.user_id = d.user_id AND d.week_num = $week_num4
             INNER JOIN user_group ON a.user_id = user_group.user_id AND user_group.deleteFlg = 0 AND a.group_id = {$_GET['group']};");

        while ($foo = $res->fetch_assoc()) { $data['data'][] = $foo; }

        json($data);
    }
} else {

    if (empty($_GET['group'])) {
        //返回指定周数，所有分组的周报提交情况
        ($_SESSION['admin']['auth'] == 1)
        and json(['error' => '权限不足，导师只能查看本组学员的考勤汇总']);

        $week_num1 = $_GET['week'];
        $week_num1 > (ceil((time() - strtotime('2015-11-02')) / 604800) - 1) and json(['error' => '不能获取到本周或本周之后']);
        $week_num2 = $week_num1 - 1;
        $week_num3 = $week_num2 - 1;
        $week_num4 = $week_num3 - 1;

        $res = $connect->query("SELECT user.id,a.group_id,user.user_name,user.qq,a.status AS week1,b.status AS week2,c.status AS week3,d.status AS week4
             FROM 
             (((report AS a INNER JOIN user ON a.user_id = user.id AND a.week_num = $week_num1) 
             INNER JOIN report AS b ON a.user_id = b.user_id AND b.week_num = $week_num2)
             INNER JOIN report AS c ON a.user_id = c.user_id AND c.week_num = $week_num3)
             INNER JOIN report AS d ON a.user_id = d.user_id AND d.week_num = $week_num4
             INNER JOIN user_group ON a.user_id = user_group.user_id AND user_group.deleteFlg = 0;");

        while ($foo = $res->fetch_assoc()) {
            $data['data'][] = $foo;
        }
        json($data);
    }else {
        //返回指定周数，指定分组的周报提交情况
        ($_SESSION['admin']['auth'] == 1) && ($_SESSION['admin']['group'] !== $_GET['group'])
        and json(['error' => '权限不足，导师只能查看本组学员的考勤汇总']);

        $week_num1 = $_GET['week'];
        $week_num1 > (ceil((time() - strtotime('2015-11-02')) / 604800) - 1) and json(['error' => '不能获取到本周或本周之后']);
        $week_num2 = $week_num1 - 1;
        $week_num3 = $week_num2 - 1;
        $week_num4 = $week_num3 - 1;

        $res = $connect->query("SELECT user.id,a.group_id,user.user_name,user.qq,a.status AS week1,b.status AS week2,c.status AS week3,d.status AS week4
             FROM 
             (((report AS a INNER JOIN user ON a.user_id = user.id AND a.week_num = $week_num1) 
             INNER JOIN report AS b ON a.user_id = b.user_id AND b.week_num = $week_num2)
             INNER JOIN report AS c ON a.user_id = c.user_id AND c.week_num = $week_num3)
             INNER JOIN report AS d ON a.user_id = d.user_id AND d.week_num = $week_num4 
             INNER JOIN user_group ON a.user_id = user_group.user_id AND user_group.deleteFlg = 0 AND a.group_id = {$_GET['group']};");

        while ($foo = $res->fetch_assoc()) {
            $data['data'][] = $foo;
        }
        json($data);
    }
}