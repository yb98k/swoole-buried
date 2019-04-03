<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午5:49
 */

class BuriedClient
{
    protected $client;

    public function __construct($host, $port, $protocol, $way = 'swoole')
    {
        if($way == 'swoole') {
            $protocol = strtolower($protocol) == 'udp' ? SWOOLE_SOCK_UDP : SWOOLE_SOCK_TCP;
            $this->client = new SwClient($host, $port, $protocol);
        } elseif ($way == 'socket') {
            $protocol = strtolower($protocol) == 'udp' ? SOL_UDP : SOL_TCP;
            $this->client = new SocketClient($host, $port, $protocol);
        } else {
            $this->client = null;
        }
    }

    public function sendMsg(String $msg)
    {
        if(!$this->client)
            return false;

        return $this->client->sendMsg($msg);
    }

    public function close()
    {
        $this->client->close();
    }
}