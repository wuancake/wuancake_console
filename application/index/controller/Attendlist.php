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
		//print_r($userinfo);
	//	print_r($userinfo);
		
	for($j=0;$j<count($userinfo);$j++)
	{
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
	    $userinfo[$j]['s'] = implode($arr[$j]);
		}
	}
		//echo ($userinfo[0]['status']);
		
		 $this->assign('userinfo',$userinfo);

		return $this->fetch('/attendlist');
	}
}




 ?>