<?php

namespace app\index\model;

use think\Db;
use think\Model;

class Attend extends Model
{
    public function get_max_week()
    {
        return Db::table('week')->find();
    }
    public function get_all_user($week_num)
    {
        $rs= Db::name('user')
            ->join('report','user.id = report.user_id AND report.week_num = :week_num','LEFT')
            ->field('id AS user_id,user_name,email AS user_email,user.group_id,status')
            ->bind(['week_num'=>$week_num])
            ->order('status DESC')
            ->select();
        return $rs;
    }
    public function get_list_attend($user_id)
    {
        $rs = Db::name('attend')
            ->where('user_id',':user_id')
            ->bind(['user_id'=>$user_id])
            ->value('status');
        return $rs;
    }
    public function update_now_attend($user_id,$group_id,$status)
    {
        Db::name('attend')
            ->where('user_id', ':user_id')
            ->bind(['user_id'=>$user_id])
            ->update([
                'group_id'  => $group_id,
                'status' => $status,
            ]);
    }
    public function delete_user_group($user_id)
    {
        Db::name('user')
            ->where('id', ':user_id')
            ->bind(['user_id'=>$user_id])
            ->update([
                'group_id'  => 0,
            ]);
    }
    public function add_max_week($week)
    {
        Db::name('week')
            ->where('num', ':week')
            ->bind(['week'=>$week])
            ->update([
                'num'  => $week+1,
            ]);
    }
}