<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午3:14
 */

return [
    'component' => [
        'redis' => [
            'class' => 'Predis\Client',
            'parameters' => [
                'scheme' => 'tcp',
                'host'   => '127.0.0.1',
                'port'   => 6379,
            ]
        ],
        'log' => [
            'class' => 'buried\core\YbLog',
            'path'  => __DIR__ . '/../runtime'
        ],
        'fileCache' => [
            'class' => 'Symfony\Component\Cache\Simple\FilesystemCache',
            'namespace' => '',
            'defaultLifetime' => 0,
            'directory' => __DIR__ . '/../runtime/cache'
        ],
    ],
];