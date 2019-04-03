<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 上午11:04
 */

namespace buried\servers;


use buried\core\Yb;
use buried\core\YbRouter;
use Illuminate\Database\Capsule\Manager;
use Swoole\Server;
use yb\app\Component;
use yb\servers\AbstractServer;

class TcpServer extends AbstractServer
{
    protected $serverType = SWOOLE_SOCK_TCP;

    /**
     * work回调进行初始化部分资源
     * @param Server $server
     * @param $workId
     */
    public function onWorkerStart(Server $server, $workId)
    {
        $com = include ( __DIR__ . '/../../config/main.php' );
        $app = new Component($com);
        Yb::init($app);

        $capsule = new Manager();
        include ( __DIR__ . '/../../config/dbConfig.php' );
        $capsule->bootEloquent();
    }

    /**
     * tcp协议的请求收到回调
     * @param Server $server
     * @param $fd
     * @param $fromId
     * @param $data
     */
    public function onReceive(Server $server, $fd, $fromId, $data)
    {
        $data = json_decode($data, true);
        if(empty($data['action']) || empty($data['info'])) {
            $server->send($fd, 'unknown action or info');
            return ;
        }

        if(isset($data['async']) && $data['async'] == true) {
            $server->task(json_encode($data));
            $server->send($fd, 1);
        } else {
            $result = $server->taskwait(json_encode($data));

            $server->send($fd, !$result ? 0 : 1);
        }
    }

    /**
     * task任务
     * @param Server $server
     * @param $taskId
     * @param $fromId
     * @param $data
     */
    public function onTask(Server $server, $taskId, $fromId, $data)
    {
        $data = json_decode($data, true);
        $res = YbRouter::getInstance()->getRouteHandle($data['action'], $data['info']);

        $server->finish($res);
    }

    public function onFinish(Server $server, $data)
    {
        // TODO: Implement onFinish() method.
    }

    public function onClose(Server $server)
    {
        // TODO: Implement onClose() method.
    }
}