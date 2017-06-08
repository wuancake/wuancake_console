<?php

namespace app\index\controller;

use app\index\model\Attend as AttendModel;
use think\Controller;
use think\Log;


class Attend extends Controller
{

    public function attend()
    {
        //当前周数  向下取整
        $week_num = floor((time()-strtotime('2015-11-02'))/604800);
        $attend = new AttendModel();
        $max_week = $attend->get_max_week()['num'];
        if($week_num<$max_week)
        {
            echo '本周已考勤';
            //Log::write('本周已考勤','notice');
            //$this->redirect('user/log');
            exit;
        }
        //查询所有注册用户上周的考勤情况
        $all = $attend->get_all_user($week_num-1);
        //合并之前的考勤情况并自动踢人
        foreach($all as $key => $value)
        {
            $value['status'] = $value['status']?$value['status']:1;
            $list_attend = $attend->get_list_attend($value['user_id']);
            $list_attend = $value['status'].$list_attend;
            $attend->update_now_attend($value['user_id'],$value['group_id'],$list_attend);
            $list_attend = str_split(substr($list_attend,0,5), 1);
            for($i=0;$i<=4;$i++)
            {
                if(empty($list_attend[$i]))
                {
                    $list_attend[$i] = 0;
                }
            }
            //连续两周不提交，取消分组权限
            if($value['group_id']!=0&&$list_attend[0]==1&&$list_attend[1]==$list_attend[0])
            {
                $attend->delete_user_group($value['user_id']);
            }
            //连续四周请假，取消分组权限
            if($value['group_id']!=0&&$list_attend[0]==3&&$list_attend[0]==$list_attend[1]&&$list_attend[1]==$list_attend[2]&&$list_attend[2]==$list_attend[3])
            {
                $attend->delete_user_group($value['user_id']);
            }

        }
        $attend->add_max_week($week_num);
        echo '自动考勤成功！';
        //Log::record('自动考勤成功！');
    }
}