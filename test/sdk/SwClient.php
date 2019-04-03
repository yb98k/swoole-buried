<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午5:53
 */

class SwClient
{
    private $client;

    public function __construct($host, $port, $protocol)
    {

        $this->client = new \Swoole\Client($protocol);

        $this->client->connect($host, $port);
    }

    public function sendMsg(String $msg)
    {

        $this->client->send($msg);

        return $this->client->recv();
    }

    public function close()
    {
        $this->client->close();
    }
}