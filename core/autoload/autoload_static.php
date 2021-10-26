<?php
/**
 * @author: Xiao Nian
 * @contact: xiaonian030@163.com
 * @datetime: 2021-09-14 10:00
 */
namespace Composer\Autoload;

class ComposerStaticInit
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Workerman\\' => 10,
        ),
        'R' =>
        array (
            'React\\EventLoop\\' => 16,
        ),
        'G' => 
        array (
            'GatewayWorker\\' => 14,
            'GatewayClient\\' => 14,
        ),
        'A' =>
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Workerman\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core/framework/workerman',
        ),
        'React\\EventLoop\\' =>
        array (
            0 => __DIR__ . '/../..' . '/core/react/event-loop/src',
        ),
        'GatewayWorker\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core/framework/gatewayworker',
        ),
        'GatewayClient\\' =>
        array (
            0 => __DIR__ . '/../..' . '/core/framework/gatewayclient',
        ),
        'App\\' =>
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
