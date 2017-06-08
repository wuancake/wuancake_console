<?php 
namespace app\admin\model;

use think\Db;
use think\Model;

class Index extends Model
{
	public function getlist()
	{
		//获取十周考勤状态

		$rs= Db::name('attend')
            ->join('user','attend.user_id = user.id')
            ->join('wa_group','user.group_id = wa_group.id')
            ->field('attend.group_id AS gid,wa_group.group_name AS gname,attend.user_id as uid,user.user_name AS uname,user.wuan_name AS wname,user.QQ AS QQ,attend.status AS status')
            ->select();
        return $rs;

	}
	


}
 ?>