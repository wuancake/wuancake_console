<?php

/**
 * Created by PhpStorm.
 * User: ccc
 * Date: 2017/7/12 0012
 * Time: 17:51
 */
class TracerModels
{
    public $connect;

    protected $host     = '';
    protected $username = '';
    protected $passwd   = '';
    protected $dbname   = '';
    protected $port     = null;
    protected $socket   = null;

    public function __construct() {
        $this->loadConfig();
        $this->connect = new mysqli($this->host, $this->username, $this->passwd, $this->dbname, $this->port, $this->socket);
        if ($this->connect->connect_error)
            die($this->connect->connect_error);
    }

    //执行sql语句,对 SELECT，SHOW，EXPLAIN 或 DESCRIBE 语句返回一个资源标识符，如果查询执行不正确则返回 FALSE。
    //对于其它类型的 SQL 语句，在执行成功时返回 TRUE，出错时返回 FALSE。
    protected function query($query) {
        $res  = $this->connect->query($query);
        $data = array(array());
        $num  = 0;
        if ($res !== false && $res !== true)
            while ($info = $res->fetch_assoc()) {
                foreach ($info as $key => $value) {
                    $data[$num][$key] = $value;
                }
                $num++;
            }
        else {
            return $res;
        }
        return $data;
    }


    //返回指定id的用户信息
    protected function id($table, $id) {
        $data = array();
        $res  = $this->connect->query("SELECT * FROM {$table} WHERE id = {$id}");
        if ($res)
            while ($info = $res->fetch_assoc()) {
                foreach ($info as $key => $value) {
                    $data[$key] = $value;
                }
            }
        else
            return false;

        return $data;
    }


    //读取配置文件
    private function loadConfig() {
        require_once './application/config/Databases' . '.php';
        foreach ($config as $key => $value) {
            if ($value === '') continue;
            $this->{$key} = $value;
        }
    }
}