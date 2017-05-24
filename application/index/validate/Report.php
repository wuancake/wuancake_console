<?php
namespace app\index\validate;

use think\Validate;

class Report extends Validate
{
    protected $rule = [
    	'text1' => 'require',
    	'text2' => 'require',
    	'text3' => 'require',
    ];

    protected $message  =   [
    	'text1.require' => '“本周完成内容”为必填项',
    	'text2.require' => '“本周遇到问题”为必填项',
    	'text3.require' => '“下周计划”为必填项',
    ];



}