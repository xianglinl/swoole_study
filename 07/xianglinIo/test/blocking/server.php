<?php
require __DIR__ . "/../../vendor/autoload.php";

use xianglin\io\blocking\Worker;


$host = "tcp://0.0.0.0:9001";
$server = new Worker($host);

$server->onConnect = static function ($socket, $client) {
    echo date("Y-m-d H:i:s") . "有一个连接，连接上了....😸" . PHP_EOL;
};
// 接收和处理信息
$server->onReceive = static function ($socket, $client, $data) {
    echo "给连接发送信息 =====> hello world client  \n";
    $socket->send($client, "hello world client ");
    // fwrite($client, "server hellow");
};
$server->onClose = static function ($socket) {
    echo "关闭了....哭" . PHP_EOL;
};
var_dump("这里才是最开始打印的！！");
$server->start();