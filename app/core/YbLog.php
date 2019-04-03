<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午4:42
 */

namespace buried\core;


use yb\tools\SwLog;

class YbLog extends SwLog
{
    //TODO: Implement your's methods


    /**
     * 重载记录信息日志方法
     * @param $title
     * @param $content
     */
    public function info($title, $content)
    {
        $logPath = $this->logPath;
        $filename = $this->logPath . '/info-buried.log';

        if(file_exists($filename) && filesize($filename) >= 1048576) {
            shell_exec('mv ' . $filename . ' ' . $logPath . '/info-' . md5(date('Ymd')) . '.log');
        }

        $logInfo = $title . ':' . PHP_EOL . $content;

        file_put_contents($filename, $logInfo, FILE_APPEND);
    }

    /**
     * 重载记录错误日志方法
     * @param $title
     * @param $errorMsg
     */
    public function error($title, $errorMsg)
    {
        $logPath = $this->logPath;
        $filename = $this->logPath . '/error-buried.log';

        if(file_exists($filename) && filesize($filename) >= 1048576) {
            shell_exec('mv ' . $filename . ' ' . $logPath . '/error-' . md5(date('Ymd')) . '.log');
        }

        $logInfo = $title . ':' . PHP_EOL . $errorMsg;

        file_put_contents($filename, $logInfo, FILE_APPEND);
    }
}