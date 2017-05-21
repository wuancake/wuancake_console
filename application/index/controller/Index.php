<?php
namespace app\index\controller;
use think\Controller;
use think\helper\Time;
use think\Request;
use think\Session;
class Index extends Controller
{
    // 浏览周报&&请假理由
    public function index()
    {
        if (!session('token'))
            $this->error('非法访问！请先登录','user_login_controller/log');
        $userres = \think\Db::name('user')->where('id',$_SESSION["think"]['token'])->find();
        $_SESSION["think"]['username'] = $userres['user_name'];
        $reportres= \think\Db::name('report')->where('user_id',$_SESSION["think"]['token'])->paginate(10);
        $this->assign('reportres',$reportres);
        return $this->fetch();
    }
    // 添加周报
    public function addreport()
    {
        if (!session('token'))
            $this->error('非法访问！请先登录','user_login_controller/log');
        $data['id']=session('token');
        //$userres=db('user')->where('id','1')->select();
        $userres=\think\Db::name('user')->where('id',$data['id'])->find();
        $userres['week_num'] = floor((time()-strtotime('2015-11-02'))/604800);
        //获得当前周，该用户的当前状态
        $reportres = \think\Db::name('report')->where('user_id','eq',$data['id'])->where('week_num','eq',$userres['week_num'])->find();
        //statue 为 0 表示已经提交周报，status 为 1 表示已经请假，status 为 2 表示可以请假
        //判断：如果学员处于0状态，已经提交过周报
        $userres['status'] = is_null($reportres['status']) ? 2 : $reportres['status'];
        $this->assign('userres',$userres);
        return $this->fetch();
    }
    // 添加请假理由
    public function addleave()
    {
        if (!session('token'))
            $this->error('非法访问！请先登录','user_login_controller/log');
        $data['id']=session('token');
        $userres = \think\Db::name('user')->where('id',$data['id'])->find();
        //获得当前周数
        $userres['week_num'] = floor((time()-strtotime('2015-11-02'))/604800);

        $reportres = \think\Db::name('report')->where('user_id','eq',$data['id'])->where('week_num','eq',$userres['week_num'])->find();
        //statue 为 0 表示已经提交周报，status 为 1 表示已经请假，status 为 2 表示可以请假，status 为 3 表示已请假3周，不能继续请假
        //判断：如果学员处于0或者1状态，不能请假
        $userres['status'] = is_null($reportres['status']) ? 2 : $reportres['status'];

        $va_num = 0;//统计最近三周请假次数
        for ($i=0,$num = $userres['week_num'];$i<3;$i++){

            $vacation = \think\Db::name('report')->where('user_id','eq',$data['id'])->where('week_num','eq',$num)->find();
            if($vacation['status'] == 1){$va_num++;}
            $num--;
        }
        if($va_num == 3){$userres['status'] = 3;};//如果该数为3，则不能继续请假;
        $this->assign('userres',$userres);
        return $this->fetch();
    }
    //提交请假申请
    public function add()
    {
        if (!session('token'))
            $this->error('非法访问！请先登录','user_login_controller/log');
        if(request()->isPost()){
            $data=[
                'user_id'=>input('user_id'),
                'group_id'=>input('group_id'),
                'status'=>1,
                'week_num'=>input('week_num'),
                'text'=>input('text'),
                // 'reply_time'=>time(),
                'reply_time'=>date('Y-m-d H:i:s'),//提交时间
                //'leave_num'=>,//请假周数
            ];
            $leave_num = input('leave_num');//请假周数
            $leaveres = \think\Db::name('report')->where('week_num','eq',$data['week_num'])->where('user_id','eq','1')->count();
            if(!$leaveres){
                //请假3周，添加3次，本周及未来的2周也同时添加status为1
                for($i=0;$i<$leave_num;$i++){
                    $db= \think\Db::name('report')->insert($data);
                    $data['week_num']++;
                }
                if($db){
                    return $this->success('提交请假成功！','addleave');
                }else{
                    return $this->error('提交请假失败！');
                }
            }else{
                return $this->error($validate->getError());
            }

        }
    }

    //更新周报或者提交新周报
    public function update()
    {
        if (!session('token'))
            $this->error('非法访问！请先登录','user_login_controller/log');
        if(request()->isPost()){
            $data=[
                'user_id'=>input('user_id'),
                'group_id'=>input('group_id'),
                'status'=>input('status'),
                'week_num'=>input('week_num'),
                'text'=>input('text'),
                // 'reply_time'=>time(),
                'reply_time'=>date('Y-m-d H:i:s'),
            ];
            $leaveres = \think\Db::name('report')->where('week_num','eq',$data['week_num'])->where('user_id','eq',$data['user_id'])->count();
            if(!$leaveres){
                $validate = \think\Loader::validate('report');
                if($validate->check($data)){
                    $db= \think\Db::name('report')->insert($data);
                    if($db){
                        return $this->success('提交周报成功！','addreport');
                    }else{
                        return $this->error('提交周报失败！');
                    }
                }else{
                    return $this->error($validate->getError());
                }
            }else{
                $db= \think\Db::name('report')->update($data);
                if($db){
                    return $this->success('提交周报成功！','addreport');
                }else{
                    return $this->error('提交周报失败！0');
                }
            }
        }
    }

    public function logout(){
        Session::clear();
        $this->success('登出成功','index/index');
    }


}
