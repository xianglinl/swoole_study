<?php
$host = "tcp://0.0.0.0:9001";
// 创建socket服务
$server = stream_socket_server("tcp://0.0.0.0:9001");
echo $host . "\n";

//$client = stream_socket_accept($server); //加上@符号 就不会输出错误 如@stream_socket_accept($server);
//var_dump($client);

// 建立与客户端的连接
// 服务就处于一个挂起的状态 -》 等待连接进来并且呢创建连接
// stream_socket_accept 是阻塞
// 监听连接 -》 可以重复监听
while (true) {
    $client = @stream_socket_accept($server);
    sleep(3);
    $data = (fread($client, 65535));
    var_dump("接收的数据是：" . $data);
    fwrite($client, $data . '当前时间 ' . date('Y-m-d H:i:s'));
    fclose($client);
    var_dump($client);
}

/*
**Blocking IO - 阻塞IO**

 **NoneBlocking IO - 非阻塞IO**

**IO multiplexing - IO 多路复用**

**signal driven IO 信号驱动IO**

**asynchronous IO 异步IO**
 */
