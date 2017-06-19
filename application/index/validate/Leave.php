<?php
namespace app\index\validate;

use think\Validate;

class Leave extends Validate
{
    protected $rule = [
        'text' => 'require',
    ];

    protected $message  =   [
        'text.require' => '“请假理由”为必填项',
    ];



}