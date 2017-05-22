<?php

namespace app\index\model;

use think\Db;
use think\Model;

class UserLogin extends Model
{
    protected $table = 'user';

    //password修改器
    protected function setPasswordAttr($value){
        return md5($value);
    }
    public function get_user_group($user_id)
    {
        $rs = Db::name('user')
            ->where('user_id',':user_id')
            ->bind(['user_id'=>$user_id])
            ->value('group_id');
        return $rs;
    }
}