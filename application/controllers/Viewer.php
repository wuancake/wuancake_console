<?php
/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/26 0026
 * Time: 23:30
 */

class Viewer extends Tracer
{
    public function signup() {
        $this->jump('signup');
    }


    public function login() {
        $this->jump('login');
    }


    public function join_group() {
        $this->jump('group');
    }


    public function change_psd() {
        $this->jump('ChangePassWord');
    }
}