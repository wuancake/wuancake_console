<?php
namespace app\index\controller;
use think\Controller;
use think\helper\Time;
use think\Request;
use think\Session;
use app\index\model\User AS UserModel;
class Index extends Controller
{
    // 浏览周报&&请假理由
    public function index()
    {
        if (!session('token'))
            $this->error('非法访问！请先登录','user/log');
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
            $this->error('非法访问！请先登录','user/log');
        $data['id']=session('token');
        //$userres=db('user')->where('id','1')->select();
        $userres=\think\Db::name('user')->where('id',$data['id'])->find();
        $UserModel = new UserModel();
        $userres['group_id'] = $UserModel->exist_user_group($data['id']);
        //获得当前周数  向上取整
        $userres['week_num'] = ceil((time()-strtotime('2015-11-02'))/604800);
        //获得当前周，该用户的当前状态
        $reportres = \think\Db::name('report')->where('user_id','eq',$data['id'])->where('week_num','eq',$userres['week_num'])->find();
        //statue 为 2 表示已经提交周报，status 为 3 表示已经请假，status 为 4 表示可以请假，4为前端提交临时判断参数，不提交数据库
        //判断：如果学员处于0状态，已经提交过周报
        $userres['status'] = is_null($reportres['status']) ? 4 : $reportres['status'];
        $this->assign('userres',$userres);
        return $this->fetch();
    }
    // 添加请假理由
    public function addleave()
    {
        if (!session('token'))
            $this->error('非法访问！请先登录','user/log');
        $data['id']=session('token');
        $userres = \think\Db::name('user')->where('id',$data['id'])->find();
        $UserModel = new UserModel();
        $userres['group_id'] = $UserModel->exist_user_group($data['id']);
        //获得当前周数  向上取整
        $userres['week_num'] = ceil((time()-strtotime('2015-11-02'))/604800);

        $reportres = \think\Db::name('report')->where('user_id','eq',$data['id'])->where('week_num','eq',$userres['week_num'])->find();
        //statue 为 2 表示已经提交周报，status 为 3 表示已经请假，status 为 4 表示可以请假，4为前端提交临时判断参数，不提交数据库
        //判断：如果学员处于2或者3状态，不能请假
        $userres['status'] = is_null($reportres['status']) ? 4 : $reportres['status'];

        $va_num = 0;//统计最近三周请假次数
        for ($i=0,$num = $userres['week_num'];$i<3;$i++){

            $vacation = \think\Db::name('report')->where('user_id','eq',$data['id'])->where('week_num','eq',$num)->find();
            if($vacation['status'] == 3){$va_num++;}
            $num--;
        }
        if($va_num == 3){$userres['status'] = 5;};//如果该数为3，则不能继续请假;用5代替连续请假3周传回前端，不写入数据库。
        $this->assign('userres',$userres);
        return $this->fetch();
    }
    //提交请假申请
    public function add()
    {
        if (!session('token'))
            $this->error('非法访问！请先登录','user/log');
        if(request()->isPost()){
            $data=[
                'user_id'=>input('user_id'),
                'group_id'=>input('group_id'),
                'status'=>3,//提交状态3为请假状态
                'week_num'=>input('week_num'),
                'text'=>input('text'),
                // 'reply_time'=>time(),
                'reply_time'=>date('Y-m-d H:i:s'),//提交时间
                //'leave_num'=>,//请假周数
            ];
            $leave_num = input('leave_num');//请假周数
            $leaveres = \think\Db::name('report')->where('week_num','eq',$data['week_num'])->where('user_id','eq','1')->count();
            if(!$leaveres){
                //请假3周，添加3次，本周及未来的2周也同时添加status为3
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
                return $this->error('本周已请假！');
            }

        }
    }

    //更新周报或者提交新周报
    public function update()
    {
        if (!session('token'))
            $this->error('非法访问！请先登录','user/log');
        if(request()->isPost()){
            $data=[
                'user_id'=>input('user_id'),
                'group_id'=>input('group_id'),
                'status'=>input('status'),
                'week_num'=>input('week_num'),
                //'text'=>input('text'),
                'text'=>'本周完成：'.input('text1').'<br>所遇问题：'.input('text2').'<br>下周计划：'.input('text3'),
                // 'reply_time'=>time(),
                'reply_time'=>date('Y-m-d H:i:s'),
            ];
            $data2=[
                'text1'=>input('text1'),
                'text2'=>input('text2'),
                'text3'=>input('text3'),
            ];
            $validate = \think\Loader::validate('report');
            if($validate->check($data2)){
                if(input('text4'))$data['text'] = $data['text'].'<br>作品链接：'.input('text4');
                $leaveres = \think\Db::name('report')->where('week_num','eq',$data['week_num'])->where('user_id','eq',$data['user_id'])->count();
                if(!$leaveres){
                    $db= \think\Db::name('report')->insert($data);
                    if($db){
                        return $this->success('提交周报成功！','addreport');
                    }else{
                        return $this->error('提交周报失败！');
                    }
                }else{
                    $db= \think\Db::name('report')->update($data);
                    if($db){
                        return $this->success('提交周报成功！','addreport');
                    }else{
                        return $this->error('提交周报失败！');
                    }
                }
            }else{
                return $this->error($validate->getError());
            }
    
        }
    }



}
