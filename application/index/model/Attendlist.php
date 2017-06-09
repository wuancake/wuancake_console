<?php 
namespace app\index\model;

use think\Db;
use think\Model;

class Attendlist extends Model
{
	public function getlist()
	{
		//获取十周考勤状态
//        Db::listen(function($sql, $time, $explain){
//             记录SQL
//            echo $sql. ' ['.$time.'s]';
//             查看性能分析结果
//            dump($explain);
//        });
		$rs= Db::name('attend')
            ->join('user','attend.user_id = user.id','LEFT')
            ->join('user_group','user.id = user_group.user_id AND user_group.deleteFlg = 0','LEFT')
            ->join('wa_group','user_group.group_id = wa_group.id','LEFT')
            ->field('user_group.group_id AS gid,wa_group.group_name AS gname,attend.user_id as uid,user.user_name AS uname,user.wuan_name AS wname,user.QQ AS QQ,attend.status AS status')
            ->select();
        return $rs;
		// $sql = "SELECT attend.group_id gid,wa_group.group_name gname,attend.user_id uid,user.user_name uname,user.wuan_name wname,user.QQ QQ, attend.status status from attend,user,wa_group where attend.user_id =user.id and attend.group_id = wa_group.id";
		// $rs = Db::query($sql);
  //       return $rs;
	}
	

//	public function getgroupid()
//	{
//		$sql = "SELECT wa_group.group_name gname,user.group_id gid,user.id uid,user.user_name uname FROM user,wa_group  where wa_group.id = user.group_id order by gid ";
//		$rs = Db::query($sql);
//		return $rs;
//	}


}
 ?>