<?php
/**
 * Created by xianglinl
 * User：liubo
 * Date：2020/11/26
 * Time：22:27
 */

namespace xianglin\io;

class Index
{
    public function index()
    {
        echo 'PPID====>' . posix_getppid() . PHP_EOL;
        echo 'PID=====>' . posix_getpid() . PHP_EOL;
        sleep(10);
        echo date('Y-m-d H:i:s') . PHP_EOL;
        return "这个是一个测试信息";
    }
}