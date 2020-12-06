<?php
//创建一个tcp连接
$host = 'tcp://127.0.0.1:9001';
var_dump("开始----" . date('Y-m-d H:i:s'));
$client = stream_socket_client($host);
stream_set_blocking($client, 0);
echo $host . PHP_EOL;

$time = time();
//while (true) {
//给socket 发送信息
fwrite($client, 'hello world !' . date('Y-m-d H:i:s'));
var_dump(fread($client, 65535) . '----------' . __LINE__);
sleep(2);
//}
fclose($client);
//sleep(10);
var_dump("其他事件====》" . (time() - $time));
//
//$n = 0;
//while (!feof($client)) {
//    var_dump(fread($client, 65535) . "while----" . date('Y-m-d H:i:s'));
//    sleep(1);
//    echo ++$n . PHP_EOL;
//}