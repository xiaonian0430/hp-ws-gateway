<?php
/**
 * @author: Xiao Nian
 * @contact: xiaonian030@163.com
 * @datetime: 2019-12-01 14:01
 */
return [
    //本机内网ip，非127.0.0.1
    'LAN_IP'=>'192.168.101.12',
    'REGISTER'    => [
        'SERVER_NAME'    => 'RegisterCenter',
        'LISTEN_ADDRESS' => '192.168.21.21', //服务注册中心内网IP
        'PORT'           => 1236,
        'PROTOCOL'      => 'text'
    ],
    'GATEWAY'    => [
        'SERVER_NAME'    => 'ChatGateway',
        'LISTEN_ADDRESS' => '0.0.0.0',
        'PORT'           => 7272,
        'PROTOCOL'      => 'Websocket'
    ]
];
