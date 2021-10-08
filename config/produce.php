<?php
/**
 * @author: Xiao Nian
 * @contact: xiaonian030@163.com
 * @datetime: 2019-12-01 14:01
 */
return [
    'LAN_IP'=>'127.0.0.1',
    'REGISTER'    => [
        'SERVER_NAME'    => 'RegisterCenter',
        'LISTEN_ADDRESS' => '0.0.0.0',
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
