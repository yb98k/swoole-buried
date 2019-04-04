<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午5:43
 */


/**
 * 获取一个不可解加密串
 */
if(!function_exists('getPassword')) {
    function getPassword($password_text, $key)
    {
        return md5(base64_encode(hash_hmac('sha1', $password_text, $key, true)));
    }

}

/**
 *  获取外网ip (临时用用)
 * @return string
 */
if(!function_exists('getIPAddress')) {
    function getIPAddress()
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $ipAddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $ipAddress = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $ipAddress = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $ipAddress = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $ipAddress = getenv("HTTP_CLIENT_IP");
            } else {
                $ipAddress = getenv("REMOTE_ADDR");
            }
        }
        return $ipAddress;
    }
}

/**
 * 格式化Model类名称
 */
if(!function_exists('formatModelClass')) {
    function formatModelClass($name)
    {
        if(strpos($name, '_') === false) {
            return ucfirst($name) . 'Model';
        } else {
            $names = explode('_', $name);
            $names = array_map(function ($name) {
                return ucfirst($name);
            }, $names);

            return implode('', $names) . 'Model';
        }
    }
}