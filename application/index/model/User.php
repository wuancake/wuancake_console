<?php

namespace app\index\model;

use think\Db;
use think\Model;

class User extends Model
{
    protected $table = 'user';

    //password修改器
    protected function setPasswordAttr($value){
        return md5($value);
    }
//    public function get_user_group($user_id)
//    {
//        $rs = Db::name('user_group')
//            ->where('user_id',':user_id')
//            ->bind(['user_id'=>$user_id])
//            ->value('group_id');
//        return $rs;
//    }
    public function join_group($data)
    {
        $rs = Db::name('user_group')->insert($data);
        return $rs;
    }
    public function exist_user_group($id)
    {
        $rs = Db::name('user_group')
            ->where('deleteFlg',0)
            ->where('user_id',':user_id')
            ->bind(['user_id'=>$id])
            ->value('group_id');
        if($rs)
        {
            return $rs;
        }else{
            return false;
        }
    }
}