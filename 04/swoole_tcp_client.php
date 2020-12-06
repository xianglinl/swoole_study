<?php
$client = new swoole_client(SWOOLE_SOCK_TCP);

//连接到服务器
if (!$client->connect('127.0.0.1', 9500, 0.5))
{
    die("connect failed.");
}
//向服务器发送数据
//连续又快速的发送信息
for ($i=0; $i < 10; $i++) {
     sleep(1);
     var_dump($i);
    $client->send($i);
}

//从服务器接收数据
$data = $client->recv();
if (!$data)
{
    die("recv failed.");
}
var_dump($data);

$client->send('马上就要QQ离线-----');
echo '马上就要QQ离线-----';
//关闭连接
$client->close();

echo "<br>同步客户端<br>\n";
