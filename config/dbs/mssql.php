<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午3:17
 */

/*
 * var $capsule Illuminate\Database\Capsule\Manager
 * can config multiple configure
 */

$capsule->addConnection([
    'driver' => 'sqlsrv',
    'host' => '127.0.0.1',
    'port' => 1433,
    'database' => 'dbName',
    'username' => 'admin',
    'password' => '',
    'prefix' => '',
], 'mssql_01');