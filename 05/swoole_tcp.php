<?php

// 1. 创建swoole 默认创建的是一个同步的阻塞tcp服务
$host = "0.0.0.0"; // 0.0.0.0 代表接听所有
$post = 9500;

$serv = new Swoole\Server($host, $post);

// 2. 注册事件
$serv->on('Start', function(){
    // sleep(1); // 这个函数不推荐在swoole中直接使用
    // swoole_set_process_name("swoole:start ");
    // 修改进程的名称
    echo "=== >>> on start \n";
});
$serv->on('managerStart', function(){
    // swoole_set_process_name("swoole:managerStart ");
    // 修改进程的名称
    echo "=== >>> on managerStart \n";
});
$serv->on('workerStart', function(){
     swoole_set_process_name("swoole:workerStart "); //修改进程的名称 （mac安全问题 禁用）
    // 修改进程的名称
    echo "=== >>> on workerStart \n";
});

//监听连接进入事件
$serv->on('Connect', function ($serv, $fd) {
    echo "Client: Connect.\n";
});

$serv->on('Receive', function ($serv, $fd, $from_id, $data) {
      $serv->send($fd, "Server: ");
});

//监听连接关闭事件
$serv->on('Close', function ($serv, $fd) {
    echo "QQ离线.\n";
});

$serv->start(); // 阻塞与非阻塞
