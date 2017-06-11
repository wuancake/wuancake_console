<?php

namespace app\index\controller;

use app\index\model\Attend as AttendModel;
use think\Controller;
use think\Db;
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
        //dump($all);exit;
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
    public function test1()
    {
        $week_num = floor((time()-strtotime('2015-11-02'))/604800)+1;
        $sql = 'SELECT user_name,week_num,`status` '
            .'FROM `user` LEFT JOIN report ON user_id=id AND week_num = :thisweek';

        for($i=$week_num;$i>=$week_num-3;$i--)
        {
            $paras = [
                'thisweek' =>$i
            ];
            $rs = Db::query($sql,$paras);
            $re[] = $rs;

        }
        $rs = Db::table('user')->column('user_name');
        $user_num = count($rs)-1;
        for($j=0;$j<=3;$j++){
            for($k=0;$k<=$user_num;$k++){
                $v = $re["$j"]["$k"]['status'];
                if(empty($v)){
                    $v=0;
                }
                $ni["$k"]["$j"] = $v;
                $ww["$k"] = $re["$j"]["$k"]['user_name'];


            }
        }
        $this->assign('user_name',$ww);
        $this->assign('week',$week_num);
        $this->assign('userinfo',$ni);
        return view('/test1');


    }
    public function test2(){
//        Db::listen(function($sql, $time, $explain){
//            // 记录SQL
//            echo $sql. ' ['.$time.'s]';
//            // 查看性能分析结果
//            dump($explain);
//        });
        $week_num = ceil((time()-strtotime('2015-11-02'))/604800);
        $rs = Db::table('user')
            ->alias('u')
            ->join('user_group ug','ug.user_id = `u`.id AND ug.deleteFlg = 0','LEFT')
            ->join('wa_group wg','wg.id = ug.group_id','LEFT')
            ->join('report r1','r1.user_id = `u`.id AND r1.week_num = :s1','LEFT')
            ->join('report r2','r2.user_id = `u`.id AND r2.week_num = :s2','LEFT')
            ->join('report r3','r3.user_id = `u`.id AND r3.week_num = :s3','LEFT')
            ->join('report r4','r4.user_id = `u`.id AND r4.week_num = :s4','LEFT')
            ->join('report r5','r5.user_id = `u`.id AND r5.week_num = :s5','LEFT')
            ->bind([
                's1'=>$week_num,
                's2'=>$week_num-1,
                's3'=>$week_num-2,
                's4'=>$week_num-3,
                's5'=>$week_num-4,
            ])
//            ->select('wg.group_name AS `0`');
            ->column('wg.group_name AS `0`,user_name,QQ AS `2`,r1.`status` AS `3`,r2.`status` AS `4`,r3.`status` AS `5`,r4.`status` AS `6`,r5.`status` AS `7`','user_name');
//        dump($rs);
        $this->assign('week',$week_num);
        $this->assign('users',$rs);
        return view('/test2');
    }
    public function test(){

        $in = Db::table('user_group')
            ->join('user','`user`.id = user_group.user_id')
            ->join('wa_group','user_group.group_id = wa_group.id')
            ->where('user_group.create_time','IN',function($query){
                $query->table('user_group')->field('max(create_time)')->group('user_id');
            })
            ->group('user_id')
            ->field('user_group.deleteFlg,user_group.create_time,user_group.modify_time,user_name,user.id,QQ,group_id,group_name')
            ->select();
        $this->assign('users',$in);
        return view('/test');
    }
}