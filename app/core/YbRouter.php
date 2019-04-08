<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午2:37
 */

namespace buried\core;


class YbRouter
{
    private static $_instance = null;

    private static $_actionMap = [];

    public static function getInstance()
    {
        if(!(self::$_instance instanceof self)) {
             self::$_instance = new self();
             self::$_actionMap = require (__DIR__.'/../../config/actions/map.php');
        }

        return self::$_instance;
    }

    /**
     * 执行路由解析和结果
     * @param $action
     * @param $data
     * @return bool|mixed
     */
    public function getRouteHandle($action, $data)
    {
        $routeInfo = self::parseRoute($action);

        if($routeInfo === false)
            return false;

        $needDo = new $routeInfo['controller']();

        return call_user_func_array([$needDo, $routeInfo['action']], [$data]);
    }

    /**
     * 解析路由
     * @param $action
     * @return array|bool|mixed
     */
    public static function parseRoute($action)
    {
        if(strpos($action, '/') === false) {
            if(!isset(self::$_actionMap[$action]))
                return false;

            return self::parseRoute(self::$_actionMap[$action]);
        } else {
            $action = trim($action, '/');

            if(empty($action))
                return false;

            $routeInfo = explode('/', $action);

            $action = 'on' . self::formatCA(array_pop($routeInfo));
            $controller = array_pop($routeInfo);
            $namespace = count($routeInfo) > 0 ? implode('\\', $routeInfo) . '\\' : '';

            $controllerRoute = 'buried\controllers\\' . $namespace . self::formatCA($controller) . 'Controller';

            return [
                'controller' => $controllerRoute,
                'action'     => $action
            ];
        }
    }

    /**
     * 格式化动作或控制器命名
     * @param $name
     * @return string
     */
    public static function formatCA($name)
    {
        if(strpos($name, '-') !== false) {
            $info = explode('-', $name);
            $info = array_map(function ($item) {
                return ucfirst($item);
            }, $info);

            return implode('', $info);
        }

        return ucfirst($name);
    }
}
