<?php

$s = 'hello world'; //GBK =》 转换为二进制

var_dump(strlen($s));

var_dump($s);

$len = pack('n', $s); // N n

$new = $len . $s;

var_dump($new);

var_dump(unpack('n',$new,1));