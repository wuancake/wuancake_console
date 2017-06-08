<?php
namespace app\admin\controller;
use think\Controller;
use think\helper\Time;
use think\Request;
use think\Session;
class Index extends Controller
{
    public function index()
    {
        //判断管理员或导师是否登录
        if (!(Session::get('adm_token'))){
            $this->error('非法访问，请先登录','login/log');
        }
        $data['adm'] = Session::get('adm_token');
        $admres = \think\Db::name('adm') ->find($data['adm']['id']);
        if($admres['auth'] == 0){
            $this->error('您没有权限操作，请联系管理员','login/log');
        }
        $userres = \think\Db::name('user') -> field('id,user_name') -> select();
        $weekres = \think\Db::name('report') -> distinct('ture') -> field('week_num') -> select();
        $this->assign('userres',$userres);
        $this->assign('weekres',$weekres);
        return $this->fetch();
    }

    // 查看某一学员的所有考勤
    public function onestu()
    {
        //判断管理员或导师是否登录
        if (!(Session::get('adm_token'))){
            $this->error('非法访问，请先登录','login/log');
        }
        $data['adm'] = Session::get('adm_token'); 
        $admres = \think\Db::name('adm') ->find($data['adm']['id']);
        if($admres['auth'] == 0){
            $this->error('您没有权限操作，请联系管理员','login/log');
        }
        if(request()->isGet()){
            $data = [
                'user_id' => input('user_id'),
            ];

        }
        $userres = \think\Db::name('user')->where('id',$data['user_id'])->find();
        $reportres= \think\Db::name('report')->where('user_id',$data['user_id'])->paginate(10);
        $data['user_name']= $userres['user_name'];
        $this->assign('data',$data);
        $this->assign('reportres',$reportres);
        return $this->fetch(); 
    }

    // 查看某一周的所有学员考勤
    public function oneweek()
    {
        //判断管理员或导师是否登录
        if (!(Session::get('adm_token'))){
            $this->error('非法访问，请先登录','login/log');
        }
        $data['adm'] = Session::get('adm_token');
        $admres = \think\Db::name('adm') ->find($data['adm']['id']);
        if($admres['auth'] == 0){
            $this->error('您没有权限操作，请联系管理员','login/log');
        }
        if(request()->isPost()){
            $data = [
                'week_num' => input('week_num'),
            ];

        }
        $reportres= \think\Db::name('report')
        ->join('user','user.id = report.user_id')
        ->field('user.id AS user_id , user.user_name AS user_name , report.week_num AS week_num , report.group_id AS group_id , report.text AS text , report.status AS status , report.reply_time AS reply_time')
        ->where('week_num',$data['week_num'])        
        ->paginate(10);
        $this->assign('reportres',$reportres);
        return $this->fetch(); 
    }


}
