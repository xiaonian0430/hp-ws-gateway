<?php
/**
 * gateway进程
 * @author: Xiao Nian
 * @contact: xiaonian030@163.com
 * @datetime: 2021-09-14 10:00
 */
use \Workerman\Worker;
use \GatewayWorker\Gateway;

$conf = require_once SERVER_ROOT . '/config/'.GLOBAL_MODE.'.php';

// gateway 进程
$address=$conf['GATEWAY']['PROTOCOL'].'://'.$conf['GATEWAY']['LISTEN_ADDRESS'].':'.$conf['GATEWAY']['PORT'];
$gateway = new Gateway($address);

// 设置名称，方便status时查看
$gateway->name = $conf['GATEWAY']['SERVER_NAME'];

// 设置进程数，gateway进程数建议与cpu核数相同
$gateway->count = 4;

// 分布式部署时请设置成内网ip（非127.0.0.1）
$gateway->lanIp = $conf['GATEWAY']['LAN_IP'];

// 内部通讯起始端口。假如$gateway->count=4，起始端口为2300
// 则一般会使用2300 2301 2302 2303 4个端口作为内部通讯端口 
$gateway->startPort = 2300;

// 心跳间隔
$gateway->pingInterval = 10;

// 心跳数据
$gateway->pingData = '{"type":"ping"}';

// 服务注册地址
$registerAddress=$conf['REGISTER']['LAN_IP'].':'.$conf['REGISTER']['LAN_PORT'];
$gateway->registerAddress = $registerAddress;

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START')) {
    Worker::runAll();
}

