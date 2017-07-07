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
//        \think\Db::listen(function($sql, $time, $explain){
//            // 记录SQL
//            echo $sql. ' ['.$time.'s]';
//            // 查看性能分析结果
//            dump($explain);
//        });
        //判断管理员或导师是否登录
        if (!(Session::get('adm_token'))){
            $this->error('非法访问，请先登录','login/log');
        }
        $data['adm'] = Session::get('adm_token');
        $admres = \think\Db::name('adm') ->find($data['adm']['id']);
//        dump($admres);exit;
        if($admres['auth'] == 0){
            $this->error('您没有权限操作，请联系管理员','login/log');
        }
        //添加分组查询  管理员和超级管理员可以查看所有注册成员周报，导师可以查看所有分组成员周报
        //201707071602 小超
        if(empty($admres['group_id'])){
            $group_id = [1,2,3,4,5,6,7];
        }else{
            $group_id = [$admres['group_id']];
        }
        $map['group_id'] = array('in',$group_id);
        $userres = \think\Db::name('user')
            ->field('user.id,user.user_name,wa_group.group_name')
            ->join('user_group','user_group.user_id = user.id AND user_group.deleteFlg = 0','LEFT')
            ->join('wa_group','user_group.group_id = wa_group.id','LEFT')
            ->where($map)
            ->select();
//        dump($userres);exit;
        $weekres = \think\Db::name('report') -> distinct('ture') -> field('week_num') -> order('week_num desc') -> select();
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
        $reportres= \think\Db::name('report')->where('user_id',$data['user_id'])->order('week_num desc')->paginate(10 , false , ['query' => request() -> param(),]);
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
        //添加分组查询  管理员和超级管理员可以查看所有注册成员周报，导师可以查看所有分组成员周报
        //201707071602 小超
        if(empty($admres['group_id'])){
            $group_id = [1,2,3,4,5,6,7];
        }else{
            $group_id = [$admres['group_id']];
        }
        $map['group_id'] = array('in',$group_id);
        $reportres= \think\Db::name('report')
            ->join('user','user.id = report.user_id')
            ->field('user.id AS user_id , user.user_name AS user_name , report.week_num AS week_num , report.group_id AS group_id , report.text AS text , report.status AS status , report.reply_time AS reply_time')
            ->where('week_num',':week_num')
            ->where($map)
            ->bind(['week_num'=>$data['week_num']])
            ->paginate(10 , false , ['query' => request() -> param(),]);
        $this->assign('reportres',$reportres);
        return $this->fetch();
    }
    public function attendance(){
        if (!(Session::get('adm_token'))){
            $this->error('非法访问，请先登录','login/log');
        }
        $data['adm'] = Session::get('adm_token');
        $admres = \think\Db::name('adm') ->find($data['adm']['id']);
//        dump($admres);exit;
        if($admres['auth'] == 0){
            $this->error('您没有权限操作，请联系管理员','login/log');
        }
        //添加分组查询  管理员和超级管理员可以查看所有注册成员周报，导师可以查看所有分组成员周报
        //201707071602 小超
        if(empty($admres['group_id'])){
            $group_id = [1,2,3,4,5,6,7];
        }else{
            $group_id = [$admres['group_id']];
        }
        $map['group_id'] = array('in',$group_id);
        $userres = \think\Db::name('user')
            ->field('user.id,user.user_name,wa_group.group_name')
            ->join('user_group','user_group.user_id = user.id AND user_group.deleteFlg = 0','LEFT')
            ->join('wa_group','user_group.group_id = wa_group.id','LEFT')
            ->where($map)
            ->select();
//        dump($userres);exit;
        $weekres = \think\Db::name('report') -> distinct('ture') -> field('week_num') -> order('week_num desc') -> select();
        $this->assign('userres',$userres);
        $this->assign('weekres',$weekres);
        return $this->fetch();
    }
    public function attstu()
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
        if(request()->isGet()&&input('user_id')){
            $user_id =  input('user_id');
        }else{
            echo '当前分组没有成员';exit;
        }
        $week_num = floor((time()-strtotime('2015-11-02'))/604800);
        $rs = \think\Db::table('user')
            ->alias('u')
            ->join('user_group ug','ug.user_id = `u`.id AND ug.deleteFlg = 0','LEFT')
            ->join('wa_group wg','wg.id = ug.group_id','LEFT')
            ->join('report r1','r1.user_id = `u`.id AND r1.week_num = :s1','LEFT')
            ->join('report r2','r2.user_id = `u`.id AND r2.week_num = :s2','LEFT')
            ->join('report r3','r3.user_id = `u`.id AND r3.week_num = :s3','LEFT')
            ->join('report r4','r4.user_id = `u`.id AND r4.week_num = :s4','LEFT')
            ->join('report r5','r5.user_id = `u`.id AND r5.week_num = :s5','LEFT')
            ->join('report r6','r6.user_id = `u`.id AND r6.week_num = :s6','LEFT')
            ->where('u.id',':user_id')
            ->bind([
                'user_id'=>$user_id,
                's1'=>$week_num,
                's2'=>$week_num-1,
                's3'=>$week_num-2,
                's4'=>$week_num-3,
                's5'=>$week_num-4,
                's6'=>$week_num-5,
            ])
            ->field('wg.group_name AS `0`,user_name,wuan_name,QQ AS `2`,r1.`status` AS `4`,r2.`status` AS `5`,r3.`status` AS `6`,r4.`status` AS `7`,r5.`status` AS `8`,r6.`status` AS `9`')
            ->paginate(10 , false , ['query' => request() -> param(),]);

        //        dump($rs);
        $this->assign('week',$week_num);
        $this->assign('users',$rs);
        return $this->fetch();
    }
    public function attweek()
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
        //添加分组查询  管理员和超级管理员可以查看所有注册成员周报，导师可以查看所有分组成员周报
        //201707071649 小超
        if(empty($admres['group_id'])){
            $group_id = [1,2,3,4,5,6,7];
        }else{
            $group_id = [$admres['group_id']];
        }
        $map['ug.group_id'] = array('in',$group_id);
        $week_num = floor((time()-strtotime('2015-11-02'))/604800);
        $rs = \think\Db::table('user')
            ->alias('u')
            ->join('user_group ug','ug.user_id = `u`.id AND ug.deleteFlg = 0','LEFT')
            ->join('wa_group wg','wg.id = ug.group_id','LEFT')
            ->join('report r1','r1.user_id = `u`.id AND r1.week_num = :s1','LEFT')
            ->join('report r2','r2.user_id = `u`.id AND r2.week_num = :s2','LEFT')
            ->join('report r3','r3.user_id = `u`.id AND r3.week_num = :s3','LEFT')
            ->join('report r4','r4.user_id = `u`.id AND r4.week_num = :s4','LEFT')
            ->join('report r5','r5.user_id = `u`.id AND r5.week_num = :s5','LEFT')
            ->join('report r6','r6.user_id = `u`.id AND r6.week_num = :s6','LEFT')
            ->where($map)
            ->bind([
                's1'=>$week_num,
                's2'=>$week_num-1,
                's3'=>$week_num-2,
                's4'=>$week_num-3,
                's5'=>$week_num-4,
                's6'=>$week_num-5,
            ])
            ->field('wg.group_name AS `0`,user_name,wuan_name,QQ AS `2`,r1.`status` AS `4`,r2.`status` AS `5`,r3.`status` AS `6`,r4.`status` AS `7`,r5.`status` AS `8`,r6.`status` AS `9`')
            ->paginate(10 , false , ['query' => request() -> param(),]);
//        dump($rs);exit;
        if(empty($rs))
        {
            echo '当前分组没有成员';exit;
        }
        $this->assign('week',$week_num);
        $this->assign('users',$rs);
        return $this->fetch('attstu');
    }
    public function clearpe()
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
        //添加分组查询  管理员和超级管理员可以查看所有注册成员周报，导师可以查看所有分组成员周报
        //201707072053 小超
        if(empty($admres['group_id'])){
            $group_id = [1,2,3,4,5,6,7];
        }else{
            $group_id = [$admres['group_id']];
        }
        $map['user_group.group_id'] = array('in',$group_id);
        $in = \think\Db::table('user_group')
            ->join('user','`user`.id = user_group.user_id')
            ->join('wa_group','user_group.group_id = wa_group.id')
            ->where('user_group.create_time','IN',function($query){
                $query->table('user_group')->field('max(create_time)')->group('user_id');
            })
            ->where($map)
            ->group('user_id')
            ->field('user_group.deleteFlg,user_group.create_time,user_group.modify_time,user_name,wuan_name,user.id,QQ,group_id,group_name')
            ->paginate(10 , false , ['query' => request() -> param(),]);
        $this->assign('users',$in);
        return $this->fetch();
    }


}
