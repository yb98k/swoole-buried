<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-3
 * Time: 下午3:22
 */

namespace buried\models;


use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    public $timestamps = false;

    protected $connection = 'mysql_01';

    protected $table = 'user';
}