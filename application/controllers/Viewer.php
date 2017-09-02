<?php
/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/26 0026
 * Time: 23:30
 */

class Viewer extends Tracer
{

    public function __construct() {
        parent::__construct();
        $this->database('user');
    }


    //显示部分界面之前，需要验证用户权限
    public function check_state() {
        if (isset($_SESSION['token'])) {
            return 1;
        }
        elseif (isset($_COOKIE['token'])) {
            $message = explode('*', $_COOKIE['token']);
            if (count($message) !== 4) {
                //cookie被篡改，删除用户登录凭证
                $this->delToken();
                return 0;
            }
            $str = "$message[0]*$message[1]*$message[2]";
            if (password_verify($str, $message[3])) {
                //cookie文件存在且合法，设置session令牌
                $_SESSION['token'] = array('id' => $message[0], 'username' => $message[1], 'nickname' => $message[2]);
                return 1;
            }
        }
        //cookie和session均不存在
        return 0;
    }


    /**
     * 返回试图所需要的信息，包含用户分组，用户id，用户昵称，当前周数等
     */
    public function info() {
        $data             = $_SESSION['token'];
        $data['week_num'] = ceil((time() - strtotime('2015-11-02')) / 604800);
        $data['group']    = $this->db->sel_group();
        return $data;
    }


    /**
     * 登录界面
     */
    public function index() {
        if ($this->check_state()) {
            $this->db->exist_group() or $this->jump('skip', '你尚未加入分组，请先加入分组', 'viewer/join_group');
            $data = $this->info();

            $res = $this->db->connect->query("SELECT status FROM report WHERE week_num = {$data['week_num']} AND user_id = {$data['id']}");
            if ($res->num_rows){

                $state = $res->fetch_assoc()['status'];
                if($state == 2)
                    $this->view('subWeeklySuccess',$data);
                elseif ($state == 3)
                    $this->view('askLeaveSuccess',$data);
                else
                    $this->view('HomePage',$data);

            }else {
                $this->view('HomePage', $data);
            }
        }
        else
            $this->jump('Login');
    }


    /**
     * 注册界面
     */
    public function signup() {
        $this->jump('Signup');
    }


    /**
     * 加入分组界面
     */
    public function join_group() {
        $this->check_state() or $this->jump('login', '请先登录', 'viewer/index');
        $this->jump('Grouping');
    }


    /**
     * 更改密码界面
     */
    public function change_psd() {
        $this->check_state() or $this->jump('login', '请先登录', 'viewer/index');
        $this->jump('ChangePassWord');
    }


    /**
     * 找回密码界面
     */
    public function recover_psd() {
        $this->jump('ForgetPass');
    }


    /**
     * 撰写周报界面
     */
    public function write_weekly() {

        if ($this->check_state() && $this->db->exist_group()) {
            $data = $this->info();
            $data['status'] = $this->db->connect->query("SELECT status FROM report WHERE week_num = {$data['week_num']} AND user_id = {$data['id']}")->fetch_assoc()['status'];
            $data['status'] == '' and $data['status'] = 1;
            $this->view('WriteWeekly', $data);
        }
        else {
            $this->jump('skip', '你未登录或未加入分组', 'viewer/index');
        }

    }


    /**
     * 请假界面
     */
    public function vacate(){
        $data = $this->info();
        $res = $this->db->connect->query("SELECT status FROM report WHERE week_num = {$data['week_num']} AND user_id = {$data['id']}");

        if (!$res->num_rows) {
            $data['status'] = '未请假';
        }
        else if ($res->fetch_assoc()['status'] == 3) {
            $data['status'] = '已请假';
        }
        else{
            $data['status'] = '未请假';
        }
        $this->view('Leave',$data);
    }

    /** 显示已提交周报界面
     *
     */
    public function show_weekly(){
        if ($this->check_state() && $this->db->exist_group()) {
            $this->view('MyWeekly',array('session_id'=>session_id()));
        }
        else {
            $this->jump('skip', '你未登录或未加入分组', 'viewer/index');
        }
    }



}