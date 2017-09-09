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
        $this->view('AddAdmin');
    }


    /**
     * 增加导师界面
     */
    public function addMentor(){
        $this->view('AddMentor');
    }


    /**
     * 查看周报汇总界面
     */
    public function checkWeekly(){
        $this->view('CheckWeekly');
    }


    /**
     * 考勤汇总界面
     */
    public function gatherAttendance(){
        $this->view('GatherAttendance');
    }


    /**
     * 清人汇总界面
     */
    public function gatherClear(){
        $this->view('GatherClear');
    }


    /**
     * 登录界面
     */
    public function login(){
        $this->view('Login');
    }

}