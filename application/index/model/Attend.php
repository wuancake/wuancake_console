<?php

namespace app\index\model;

use think\Db;
use think\Model;

class Attend extends Model
{
    /**
     * @desc 获取当前最大周数
     * @return array|false|\PDOStatement|string|Model
     *
     */
    public function get_max_week()
    {
        return Db::table('week')->find();
    }

    /**
     * @desc  查询所有注册用户上周的考勤情况
     * @param $week_num int
     * @return false|\PDOStatement|string|\think\Collection
     */
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

    /**
     * @desc 获取用户未考勤前的考勤情况
     * @param $user_id int
     * @return mixed
     */
    public function get_list_attend($user_id)
    {
        $rs = Db::name('attend')
            ->where('user_id',':user_id')
            ->bind(['user_id'=>$user_id])
            ->value('status');
        return $rs;
    }

    /**
     * @desc 更新周户的考勤情况
     * @param $user_id int
     * @param $group_id int
     * @param $status string
     * @throws \think\Exception
     */
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

    /**
     * @desc 删除用户的分组权限
     * @param $user_id int
     * @throws \think\Exception
     */
    public function delete_user_group($user_id)
    {
        Db::name('user')
            ->where('id', ':user_id')
            ->bind(['user_id'=>$user_id])
            ->update([
                'group_id'  => 0,
            ]);
    }

    /**
     * @desc 考勤之后，当前最大周数+1，防止重复考勤
     * @param $week
     * @throws \think\Exception
     */
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