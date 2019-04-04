# swoole-buried


#### frame built with swoole,can use synchronous blocking or asynchronous non-blocking.

[1] Installation tutorial : 

(1) first method:

1、clone this project:
```
$ git clone https://github.com/ybscript/swoole-buried.git
```
2、load vendor：
```
$ composer install
```
3、cd root path:
```
$ cd swoole-buried
```

4、init project:
```
$ php init
```

(2) second method:

1、create project:
```
$ composer create-project ybscript/swoole-buried xxx
```
2、init project:
```
$ cd xxx
$ php init
```

Go here, this project is init.

[2] server

1、start tcp server：
```
$ php buried -t tcp
```
2、start udp server：
```
$ php buried -t udp
```

[3] coding

1、Use 'onAction' for business processing in the controller:
```
class HomeController
{

    public function onIndex($info)
    {
        $sort = json_decode($info, true)['sort'] ?? 1;

        $res = UserModel::query()->where('sort', (int)$sort)->first()->toArray();

        //组件使用 所有组件都可以使用Yb::$app取获取使用 单例模式
//        $redisContent = Yb::$app->redis->get('test');

        Yb::$app->log->info('test', 'this is a error record info fro test');

        return $res;
    }
}
```

2、The model layer uses the same 'illuminate/database' as laravel;

3、create model:
```
$ php buried --table xxx 
```


