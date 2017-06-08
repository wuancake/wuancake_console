<?php
/**
 * Created by PhpStorm.
 * User: tacer
 * Date: 2017/6/2
 * Time: 18:54
 */

namespace app\admin\model;

use think\Model;
use think\Session;
class Adm extends Model
{
    public function setPasswordAttr($value)
    {
        return md5($value);
    }

    //检查密码是否正确
    public function checkPsd($psd){
        $info = Session::get('adm_token');
        $tru_psd = $this->where('id',$info['id'])->field('password')->find()->password;
        if (md5($psd) == $tru_psd){
            //密码正确
            return 1;
        }
        else{
            //密码错误
            return 0;
        }
    }

    //修改新密码
    public function newPsd($password){
        $info = Session::get('adm_token');
        $res = $this->where('id',$info['id'])->setField('password',md5($password));
        if ($res === false)
            return -1;  //修改密码成功
        elseif ($res == 0)
            return 0;   //没有记录受影响，即新旧密码一样
        else
            return 1;   //修改密码失败
    }
}