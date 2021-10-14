# hp-ws-gateway
一款高性能支持分布式部署的实时通信框架。

## 服务器环境要求：

最低配置：
- 至少4G内存
- 至少40G磁盘
- 至少2v CPU

## 系统和软件

- centos v7.0 或更高版本
- php v7.0 或更高版本
  - 安装 event 扩展
  - 安装 pcntl 和 posix 扩展
  - 安装 redis 扩展

```
# 1、安装event扩展依赖的libevent-devel包，命令行运行
yum install libevent-devel -y

# https://pecl.php.net/get/event-3.0.5.tgz
```


## 启动停止

```
#以debug方式启动
php run.php start -mode=produce

#以daemon方式启动
php run.php start -mode=produce -d
```
