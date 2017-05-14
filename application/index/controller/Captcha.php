<?php
/**
 * Created by PhpStorm.
 * User: tacer
 * Date: 2017/5/11
 * Time: 15:53
 * 提供验证码支持
 */

namespace app\index\controller;


class Captcha extends \think\Controller
{
    public function index(){
        return $this->fetch();
    }
}