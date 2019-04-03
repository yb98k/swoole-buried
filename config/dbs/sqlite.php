<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午3:19
 */


/*
 * var $capsule Illuminate\Database\Capsule\Manager
 * can config multiple configure
 */

$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => ':memory:',
    'prefix' => '',
], 'sqlite_01');