<?php
declare(ticks=1);

pcntl_signal(SIGIO, 'sig_handler');

//这个是信号处理的一个数据
function sig_handler($signo)
{
    sleep(2);
    echo "{$signo}------这个是一个测试类\n";
    switch ($signo) {
        case SIGTERM:
            // 处理SIGTERM信号
            echo "处理SIGTERM信号\n";
            exit;
            break;
        case SIGHUP:
            //处理SIGHUP信号
            echo "处理SIGHUP信号\n";
            break;
        case SIGUSR1:
            echo "Caught SIGUSR1...\n";
            break;
        default:
            // 处理所有其他信号
    }
    echo "睡眠120s...\n";
    sleep(120);

}
var_dump(time()); //

//是一个安装信号的操作
//pid-> 进程id 要设置信号
//根据进程 设置信号
var_dump(posix_getpid());
posix_kill(posix_getpid(), SIGIO);

//分发
pcntl_signal_dispatch();