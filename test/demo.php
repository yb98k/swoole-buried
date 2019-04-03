<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午6:04
 */

include __DIR__ . '/sdk/SwClient.php';
include __DIR__ . '/sdk/SocketClient.php';

//swoole客户端
$client = new BuriedClient('127.0.0.1', 9091, 'udp', 'swoole');
//socket客户端
//$client = new BuriedClient('127.0.0.1', 9091, 'udp', 'socket');

$data = [
    'action' => 'homepage',
    'info'   => 'asdasdasdadas',
    'async'  => false
];

var_dump($client->sendMsg(json_encode($data)));
$client->close();