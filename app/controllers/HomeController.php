<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午3:05
 */

namespace buried\controllers;


use buried\core\Yb;
use buried\models\UserModel;

class HomeController
{

    public function onIndex($info)
    {
        $sort = json_decode($info, true)['sort'] ?? 1;

        $res = UserModel::query()->where('sort', (int)$sort)->first()->toArray();

//        $redisContent = Yb::$app->redis->get('test');

        Yb::$app->log->info('test', 'this is a error record info fro test');

        return $res;
    }
}