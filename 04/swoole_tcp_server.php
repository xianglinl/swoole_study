<?php

// 1. 创建swoole 默认创建的是一个同步的阻塞tcp服务
$host = "0.0.0.0"; // 0.0.0.0 代表接听所有
// 创建Server对象，监听 127.0.0.1:9501端口
// 默认是tcp
$serv = new Swoole\Server($host, 9500);
// 添加配置
$serv->set([
    'open_length_check' => true,
    'package_max_length' => 81920,
    'package_length_type' => 'N',
    //数据从0开始解析
    'package_length_offset' => 0,
    'package_body_offset' => 4,
]);
// 2. 注册事件
$serv->on('Start', function ($serv) {
    echo "启动swoole 监听的信息tcp:9500\n";
});

//监听连接进入事件
$serv->on('Connect', function ($serv, $fd) {
    echo "Client: Connect.\n";
});

//监听数据接收事件
$serv->on('Receive', function ($serv, $fd, $from_id, $data) {
     echo  $data.PHP_EOL;
//    $pack = (unpack('N', $data, 0));
//    $content = $pack[1];
//    var_dump($content); //字符串总长度。 N = 4 , n = 2 .
//    //原生需要对数据进行 foreach/while/for 操作,否则会丢失数据.
//    //swoole可以在服务端代码进行适配。package相关操作 package_length_offset是N/n相关
//    var_dump(substr($data, 4, $content));
    $serv->send($fd, "Server: " . date("y-m-d H:i:s"));
});

//监听连接关闭事件
$serv->on('Close', function ($serv, $fd) {
    echo "QQ离线.\n";
});
// 3. 启动服务器
// 阻塞
$serv->start(); // 阻塞与非阻塞
