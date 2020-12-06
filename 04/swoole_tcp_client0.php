<?php
$client = new swoole_client(SWOOLE_SOCK_TCP);

//连接到服务器
if (!$client->connect('127.0.0.1', 9500, 0.5)) {
    die("connect failed.");
}
// 向服务器发送数据
// 连续而又快速的向服务端发送很多个信息
// for ($i=0; $i < 100; $i++) {
//     $client->send("00000000");
// }

//$client->send("00000000");

$content = "我是刘博";

$len = pack('N', strlen($content));

$sendString = $len . $content;
$client->send($sendString);

for ($i = 50; $i; $i--) {
    $client->send($sendString);
}

//$client->send(str_repeat('0oo', 1024 * 1024 * 1));

//从服务器接收数据
$data = $client->recv();
if (!$data) {
    die("recv failed.");
}
echo $data;
//关闭连接
$client->close();

echo "<br>同步客户端<br>\n";
