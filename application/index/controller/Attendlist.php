<?php
namespace app\index\Controller;

use app\index\model\Attendlist as AttendlistModel;
use think\Controller;
use think\Log;

class Attendlist extends Controller
{
	public function index()
	{

	}
	public function getlist()
	{
		$g = new AttendlistModel();

		//获取用户id、user_name、group_id
		$userinfo = $g->getlist();

		//	print_r($userinfo);

		for($j=0;$j<count($userinfo);$j++)
		{
			if($userinfo[$j]['status']){    //此处加了一个attend.status为空时的判断  by CC 20170522
				if(strlen($userinfo[$j]['status'])<10)
				{
					$limet = strlen($userinfo[$j]['status']);
				}
				else
				{
					$limet = 10;
				}
				for($i=0;$i<$limet;$i++)
				{
                    $arr[$j][$i]='异常 ';
					if(substr($userinfo[$j]['status'],$i,1) == '1')
					{
						$arr[$j][$i]='未提交 ';
					}
					if(substr($userinfo[$j]['status'],$i,1) == '2')
					{
						$arr[$j][$i]='提交 ';
					}
					if(substr($userinfo[$j]['status'],$i,1) == '3')
					{
						$arr[$j][$i]='请假 ';
					}
					$userinfo[$j]['s'] = $arr[$j];
				}
			}else{
				$userinfo[$j]['s'] = '首次登陆';
			}
		}
		//print_r($userinfo);

		$this->assign('userinfo',$userinfo);

		$week_num = floor((time()-strtotime('2015-11-02'))/604800);
		$this->assign('week',$week_num);

		return $this->fetch('/attendlist');
	}
}




?>