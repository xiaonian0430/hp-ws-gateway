<?php
/**
 * 启动文件
 * @author: Xiao Nian
 * @contact: xiaonian030@163.com
 * @datetime: 2021-09-14 10:00
 */
use Workerman\Worker;
use GatewayWorker\Gateway;

ini_set('display_errors', 'on');
defined('IN_PHAR') or define('IN_PHAR', boolval(\Phar::running(false)));
defined('SERVER_ROOT') or define('SERVER_ROOT', IN_PHAR ? \Phar::running() : realpath(getcwd()));

// 检查扩展或环境
if(strpos(strtolower(PHP_OS), 'win') === 0) {
    exit("start.php not support windows.\n");
}
if(!extension_loaded('pcntl')) {
    exit("Please install pcntl extension.\n");
}
if(!extension_loaded('posix')) {
    exit("Please install posix extension.\n");
}

//自动加载文件
require_once SERVER_ROOT . '/core/autoload.php';

$mode='produce';
foreach ($argv as $item){
    $item_val=explode('=', $item);
    if(count($item_val)==2 && $item_val[0]=='-mode'){
        $mode=$item_val[1];
    }
}
if (!file_exists(SERVER_ROOT . '/config/'.$mode.'.php')) {
    $conf = require_once SERVER_ROOT . '/config/'.$mode.'.php';
}else{
    exit('/config/'.$mode.".php not set\n");
}
defined('CONFIG') or define('CONFIG', $conf);

Worker::$stdoutFile = './tmp/log/error.log';
Worker::$logFile = './tmp/log/workerman.log';

// gateway 进程
$address=CONFIG['GATEWAY']['PROTOCOL'].'://'.CONFIG['GATEWAY']['LISTEN_ADDRESS'].':'.CONFIG['GATEWAY']['PORT'];
$gateway = new Gateway($address);

// 设置名称，方便status时查看
$gateway->name = CONFIG['GATEWAY']['SERVER_NAME'];

// 设置进程数，gateway进程数建议与cpu核数相同
$gateway->count = CONFIG['GATEWAY']['PROCESS_COUNT'];

// 分布式部署时请设置成内网ip（非127.0.0.1）
$gateway->lanIp = CONFIG['GATEWAY']['LAN_IP'];

// 内部通讯起始端口。假如$gateway->count=4，起始端口为2300
// 则一般会使用2300 2301 2302 2303 4个端口作为内部通讯端口
$gateway->startPort = CONFIG['GATEWAY']['START_PORT'];

// 心跳间隔
$gateway->pingInterval = CONFIG['GATEWAY']['PING_INTERVAL'];

$gateway->pingNotResponseLimit = 1;

// 心跳数据
$gateway->pingData = '';

// 服务注册地址
$registerAddress=CONFIG['REGISTER']['LAN_IP'].':'.CONFIG['REGISTER']['LAN_PORT'];
$gateway->registerAddress = $registerAddress;

// 运行所有服务
Worker::runAll();
