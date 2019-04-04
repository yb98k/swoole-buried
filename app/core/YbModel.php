<?php
/**
 * Created by PhpStorm.
 * User: yk
 * Date: 19-4-4
 * Time: 上午8:50
 */

namespace buried\core;


class YbModel
{
    //model的命名空间
    private $namespace;

    //model的数据库链接句柄
    private $connect;

    //model对应的表
    private $table;

    //model的class名称
    private $modelName;

    public function __construct($namespace, $connect, $table, $modelName)
    {
        $this->namespace = $namespace;
        $this->connect = $connect;
        $this->table = $table;
        $this->modelName = $modelName;
    }

    /**
     * 生成model文件
     * @return bool|int
     */
    public function createModel()
    {
        $fileContent = '<?php' . PHP_EOL . PHP_EOL;

        $fileContent .= 'namespace ' . $this->namespace . ';' . PHP_EOL . PHP_EOL . PHP_EOL;
        $fileContent .= 'use Illuminate\Database\Eloquent\Model;' . PHP_EOL . PHP_EOL;
        $fileContent .= 'class ' . $this->modelName . ' extends Model' . PHP_EOL;
        $fileContent .= '{' . PHP_EOL;
        $fileContent .= '    public $timestamps = false;' . PHP_EOL . PHP_EOL;
        $fileContent .= '    protected $connection = \'' . $this->connect . '\';' . PHP_EOL . PHP_EOL;
        $fileContent .= '    protected $table = \'' . $this->table . '\';' . PHP_EOL;
        $fileContent .= '}';

        $namespaces = explode('\\', $this->namespace);
        array_shift($namespaces);
        array_shift($namespaces);
        $paths = $namespaces;
        if(count($paths) > 0) {
            $dir = array_shift($paths);
            $filePath = YB_PATH . '/models/' . $dir;
            while(!empty($dir) && !is_dir($filePath)) {
                mkdir($filePath, 0777, true);

                $dir = array_shift($paths);
                $filePath = '/' . $dir;
            }
        }

        $file = YB_PATH . '/models/' . implode('/', $namespaces) . '/' . $this->modelName . '.php';

        return file_put_contents($file, $fileContent);
    }
}