<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午2:01
 */

class SocketClient
{
    private $socket;

    public function __construct($host, $port, $protocol)
    {
        $type = $protocol == SOL_UDP ? SOCK_DGRAM : SOCK_STREAM;

        // 创建 socket
        $this->socket = socket_create(AF_INET, $type, $protocol);

        //链接 socket
        socket_connect($this->socket, $host, $port);
    }

    public function sendMsg(String $msg)
    {
        $res = socket_write($this->socket, $msg, mb_strlen($msg));

        if(!$res) {
            return socket_strerror($this->socket);
        }

        return socket_read($this->socket, 1024);
    }

    public function close()
    {
        socket_close($this->socket);
    }
}