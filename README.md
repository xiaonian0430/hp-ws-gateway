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


## 启动停止(Linux系统)

```
#以debug方式启动
php run.php start -mode=produce

#以daemon方式启动
php run.php start -mode=produce -d
```
