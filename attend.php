<?php
/**
 * Created by PhpStorm.
 * User: 小超
 * Time: 2017/07/31 15:47
 */

class Attend {

    /**
     * @return mysqli
     */
    public function connect(){
        require './application/config/Databases.php';
        // 创建连接
        $conn = new mysqli($config['host'], $config['username'], $config['passwd'] ,$config['dbname']);
        $conn->set_charset('utf8');
        //检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        return $conn;
    }

    public function check_old_user($user_id){
        $conn = $this->connect();
        $sql = "SELECT create_time FROM `user` WHERE id = {$user_id}";
        $result = $conn->query($sql);
        return time()-strtotime($result->fetch_assoc()['create_time'])<1209600?FALSE:TRUE;
    }
    public function get_current_week(){
        $conn = $this->connect();
        $sql = 'SELECT `week`.num FROM `week`';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
//            var_dump($result->fetch_assoc());
        }else{
            echo '您尚未设置当前周数！';exit;
        }
        $conn->close();
        return $result->fetch_assoc()['num'];
    }
    public function auto_attend(){
        $conn = $this->connect();

        $first_week = ceil((time()-strtotime('2015-11-02'))/604800);
        $current_week = $this->get_current_week();
        if($first_week!=$current_week){
            echo '本周已考勤';
            exit;
        }
        $second_week = $first_week-1;
        $third_week = $first_week-2;
        $fourth_week = $first_week-3;
        $sql = 'SELECT `u`.`id` AS `user_id`,IFNULL(r1.`status`,1) AS `first`,ug.group_id,'
            .'IFNULL(r2.`status`,1) AS `second`,IFNULL(r3.`status`,1) AS `third`,IFNULL(r4.`status`,1) AS `fourth` '
            .'FROM `user` `u` '
            .'LEFT JOIN `report` `r1` ON `r1`.`user_id` = `u`.id '
            ."AND r1.week_num = {$first_week} "
            .'LEFT JOIN `report` `r2` ON `r2`.`user_id` = `u`.id '
            ."AND r2.week_num = {$second_week} "
            .'LEFT JOIN `report` `r3` ON `r3`.`user_id` = `u`.id '
            ."AND r3.week_num = {$third_week} "
            .'LEFT JOIN user_group AS ug ON ug.user_id = u.id '
            .'AND ug.deleteFlg = 0 '
            .'LEFT JOIN `report` `r4` ON `r4`.`user_id` = `u`.id '
            ."AND r4.week_num = {$fourth_week} ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // 输出数据
            $re = $result->fetch_all(MYSQLI_ASSOC);
//    var_dump($re);
//    echo json_encode($re);
            foreach ($re as $k => $v){
                if($this->check_old_user($v['user_id'])&&$v['group_id']!=0&&$v['first']==1&&$v['first']==$v['second'])
                {
                    $this->delete_user_group($v['user_id']);
                    echo '连续两周不提交，取消分组权限<br>';
                    echo $v['user_id'];
                }
                //连续四周请假，取消分组权限
                if($v['group_id']!=0&&$v['first']==3&&$v['first']==$v['second']&&$v['second']==$v['third']&&$v['third']==$v['fourth'])
                {
                    $this->delete_user_group($v['user_id']);
                    echo '<br>连续四周请假，取消分组权限<br>';
                    echo $v['user_id'];

                }
            }
        } else {
            echo "0 结果";
        }
        $conn->close();
        $this->add_current_week($first_week);
    }
    public function delete_user_group($user_id){
        $conn = $this->connect();
        $time = date('Y-m-d H:i:s');
        $sql = "UPDATE user_group SET deleteFlg = 1, modify_time = ? WHERE user_id = ? AND deleteFlg = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si',$time,$user_id);
        $stmt->execute();
        $stmt->close();
    }
    public function add_current_week($week){
        $conn = $this->connect();
        $week = $week+1;
        $sql = "UPDATE week SET num = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i',$week);
        $stmt->execute();
        $stmt->close();
    }
}
if ( ! function_exists('is_cli'))
{

    /**
     * Is CLI?
     *
     * Test to see if a request was made from the command line.
     *
     * @return 	bool
     */
    function is_cli()
    {
        return (PHP_SAPI === 'cli' OR defined('STDIN'));
    }
}
if (defined('STDIN'))
{
    chdir(dirname(__FILE__));
}
if(is_cli()){
    $attend = new Attend();
    $attend->auto_attend();
}else{
    echo '请用命令行运行';
}


