<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-4
 * Time: 上午8:08
 */

$longOpts = array(
    'table:',
);

$param = getopt('', $longOpts);

if(isset($param['table'])) {
    //get and validate db handle
    //todo validate -- v2.0.0
    fwrite(STDOUT, '请输入数据库连接别名：');
    $connect = trim(fgets(STDIN));

    //get and validate namespace
    fwrite(STDOUT, '请输入数据库命名空间：');
    $namespace = trim(fgets(STDIN)) ?: 'buried\models';
    if(mb_substr($namespace, 0, mb_strlen('buried\models')) != 'buried\models')
        throw new \Exception('this model\'s namespace is illicit');

    $table = strtolower($param['table']);
    $modelName = formatModelClass($param['table']);

    $ybModel = new buried\core\YbModel($namespace, $connect, $table, $modelName);
    $ybModel->createModel();

    fwrite(STDOUT, '创建成功！' . PHP_EOL);

    exit(0);
}

