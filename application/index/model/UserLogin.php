<?php

namespace app\index\model;

use think\Model;

class UserLogin extends Model
{
    protected $table = 'user';

    //password修改器
    protected function setPasswordAttr($value){
        return md5($value);
    }
}