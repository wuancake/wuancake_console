<?php
/**
 * Created by PhpStorm.
 * User: tacer
 * Date: 2017/6/2
 * Time: 18:54
 */

namespace app\admin\model;

use think\Model;
class Adm extends Model
{
    public function setPasswordAttr($value)
    {
        return md5($value);
    }
}