<?php
/**
 *
 */
class Http
{

    protected $http;
    protected $r ;
    protected $events = [
      //...
    ];
    protected $config = [
         'worker_num' => 10, //worker进程个数
    ];

    public function __construct($ip, $port)
    {
        $this->http = new Swoole\Http\Server($ip, $port);
        $this->http->set($this->config);
         echo $ip.":".$port."\n";
        $this->http->on('request', [$this, 'yy']);
        $this->r = "pppppp";
    }

    

    public function yy($request, $response)
    {

        $response->header("Content-Type", "text/html; charset=utf-8");
        var_dump(0);
        var_dump($request->get, $request->post);
        $response->end("<h1>Hello Swoole. #".$this->r."</h1>");
    }

    public function start()
    {
        $this->http->start();
    }
}
$http = new Http('0.0.0.0', 1234);
$http->start();


// $http = new Swoole\Http\Server("0.0.0.0", 9501);
//
// $http->on('request', function ($request, $response) {
//     var_dump($request->get, $request->post);
//     $response->header("Content-Type", "text/html; charset=utf-8");
//     $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
// });
//
// $http->start();
