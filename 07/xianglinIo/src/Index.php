<?php
/**
 * Created by YupaoWang
 * User：liubo
 * Date：2020/11/26
 * Time：22:27
 */
namespace xianglin\io;

class Index
{
    public function index()
    {
        echo date('Y-m-d H:i:s').PHP_EOL;
        return "这个是一个测试信息";
    }
}