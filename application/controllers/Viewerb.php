<?php

class Viewerb extends Tracer
{

    public function __construct() {
        parent::__construct();
        $this->setClass('Admin');
        $this->database('admin');
    }


    /**
     * 增加管理员界面
     */
    public function addAdmin(){
        $this->db->check_state() or $this->jump('skip','请登录后操作','viewerb/login');
        $this->view('AddAdmin');
    }


    /**
     * 增加导师界面
     */
    public function addMentor(){
        $this->db->check_state() or $this->jump('skip','请登录后操作','viewerb/login');
        $this->view('AddMentor');
    }


    /**
     * 查看周报汇总界面
     */
    public function checkWeekly(){
        $this->db->check_state() or $this->jump('skip','请登录后操作','viewerb/login');

        $this->view('CheckWeekly',['session_id'=>session_id()]);
    }


    /**
     * 考勤汇总界面
     */
    public function gatherAttendance(){
        $this->db->check_state() or $this->jump('skip','请登录后操作','viewerb/login');
        $this->view('GatherAttendance',['session_id'=>session_id()]);
    }


    /**
     * 清人汇总界面
     */
    public function gatherClear(){
        $this->db->check_state() or $this->jump('skip','请登录后操作','viewerb/login');
        $this->view('GatherClear',['session_id'=>session_id()]);
    }


    /**
     * 登录界面
     */
    public function login(){
        $this->db->check_state() and $this->view('CheckWeekly');
        $this->view('Login');
    }


    /**
     * 查询界面
     */

    public function check(){
        $this->db->check_state() or $this->jump('skip','请登录后操作','viewerb/login');
        $this->view('check');
    }

}