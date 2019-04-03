<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 上午11:23
 */

return [
    'tcp' => [
        'host' => '0.0.0.0',
        'port' => 9092,
        'setting' => [
            'worker_num' => 100,
            'task_worker_num' => 10,
            'daemonize' => false,
        ],
        'serverName' => 'yb_buried_tcp'
    ],
    'udp' => [
        'host' => '0.0.0.0',
        'port' => 9091,
        'setting' => [
            'worker_num' => 100,
            'task_worker_num' => 10,
            'daemonize' => false,
        ],
        'serverName' => 'yb_buried_udp'
    ],
];