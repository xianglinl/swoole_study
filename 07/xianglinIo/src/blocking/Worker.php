<?php
/**
 * Created by YupaoWang
 * User：liubo
 * Date：2020/11/26
 * Time：22:35
 */

namespace xianglin\io\blocking;

class Worker
{

    public $onReceive;  //接收
    public $onConnect;  //连接
    public $onClose;    //关闭
    /**
     * @var false|resource
     */
    private $socket;

    /**
     * Worker constructor.
     * @param $socket_address
     */
    public function __construct($socket_address)
    {
        $this->socket = stream_socket_server($socket_address);
        echo $socket_address . PHP_EOL;
    }

    public function accept()
    {
        while (true) {
            $client = @stream_socket_accept($this->socket);
            if (is_callable($this->onConnect)) {
                ($this->onConnect)($this->socket, $client);
            }
            /**
             * @var  $buffer string 就是数据 所谓的data
             */
            $buffer = fread($client, 65535);
//            var_dump("接收的数据======》" . $buffer);
            if (is_callable($this->onReceive)) {
                //调用闭包函数进行数据发送
                ($this->onReceive)($this, $client, $buffer);
                //调用send进行数据发送..
                $this->send($client, '这个是一个测试信息 。。。');
            }
            //处理完成 就 关闭连接
            if (is_callable($this->onClose)) {
                ($this->onClose)($this->socket);
            }
//            fclose($client);
        }
    }

    /**
     * 响应头
     * @param $client
     * @param $data
     * @author liubo 2020-11-27 08:26:08
     */
    public function send($client, $data)
    {
        $data .= "----当前时间 " . date('Y-m-d H:i:s') . PHP_EOL;
        $response = "HTTP/1.1 200 OK\r\n";
        $response .= "Content-Type: text/html;charset=UTF-8\r\n";
        $response .= "Connection: keep-alive\r\n";
        $response .= "Content-length: ".strlen($data)."\r\n\r\n";
        $response .= $data;
        fwrite($client, $response);
//        fwrite($client, "{$data}----当前时间 " . date('Y-m-d H:i:s') . PHP_EOL);
    }

    /**
     * @author liubo 2020-11-26 22:36:28
     */
    public function start(): void
    {
        $this->accept();
    }
}