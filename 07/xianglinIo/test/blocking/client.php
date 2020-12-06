<?php
//创建一个tcp连接
$host = 'tcp://127.0.0.1:9001';
$client = stream_socket_client($host);
echo $host . PHP_EOL;

while (true) {
    //给socket 发送信息
    fwrite($client, 'hello world !' . date('Y-m-d H:i:s'));
    var_dump(fread($client, 65535));
    sleep(2);
}
fclose($client);
