<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午3:53
 */

namespace buried\core;


class Yb
{
    public static $app;

    /**
     * 初始化全局静态组件变量
     * @param $app
     */
    public static function init($app)
    {
        self::$app = $app;
    }
}