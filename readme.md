<p align="center">
  <br>
  <b>Ucer-admin</b>
  <br>
  <a href="https://www.codehaoshi.com">
    <img src="http://ovdt3w8zp.bkt.clouddn.com/2017-09-05%2010-59-03%E5%B1%8F%E5%B9%95%E6%88%AA%E5%9B%BE.png" width=800>
  </a>
  <br>
  <a href="https://www.codehaoshi.com">
    <img src="http://ovdt3w8zp.bkt.clouddn.com/2017-09-05%2011-23-07%E5%B1%8F%E5%B9%95%E6%88%AA%E5%9B%BE.png" width=800>
  </a>
</p>

---
# Code 好事

## 项目描述
该项目用来记录日常开发的笔记，用 laravel 与 vue 构建。后台使用 [ucer-admin](https://github.com/Ucer/ucer-admin) 管理系统开发。代码完全开源。

* 产品名称：Code 好事
* 项目代码：Code 好事
* 官方地址：https://codehaoshi.com
* vue& laravel 开发的后台管理系统：请移歨 [lucms](https://gitee.com/zhjaa/lucms)
## 功能清单

- 用户注册登录
- 权限系统
- 修改 & 找回密码
- 推文 & 发表问题
- 文章点告赞 & 评论
- 用户关注
- 数据备份

## 运行环境

- Laravel5.5.*
- Nginx 1.8+
- PHP 7.1+
- Mysql 5.7+

## 开发环境部署/安装

### 1. 克隆源代码

克隆源代码到本地：

    > git clone https://github.com/Ucer/codehaoshi.git

### 2. 配置本地的环境


- 修改 .env 
```
APP_NAME=Code好事 //网站名称
APP_ENV=production //生产环境
APP_DEBUG=false
APP_LOG_LEVEL=debug
APP_URL=http://codehaoshi.app/ // 注意最后 加 /

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=codehaoshi
DB_USERNAME=homestead
DB_PASSWORD=secret

CLIENT_ID= // github id
CLIENT_SECRET= // github secret
UPLOAD_PATH=uploads //文件上传路径 
YOUDAO_APP_KEY=
YOUDAO_APP_SECRET=
BACKUP_DISK=/srv/www/data-back // 目录不存在则手动创建
```

- 修改app 配置文件
config/app.php
```php
<?php
// . . .
'log' => env('APP_LOG', 'daily'), // 每天记录一个文件
'log_max_files' => 30,
'timezone' => 'PRC',
```

- 文件权限问题
```text
chmod 777 -R public ;
chmod 777 -R storage/log storage/framework;
```

- 安装
```text
composer install
cnpm install
php artisan passport:install
```


### 3.php 配置
- 开启 phpinfo


### 4.运行安装命令
```text
composer dump-autoload
php artisan codehaoshi:install
用 github 注册第一个用户或者自己注册一个账号,
绑定第一个用户为超级管理员.
php artisan bindAdmin:Ucer

```

如果在使用过程中碰到任何问题，请在本站对 [开源项目问答](https://codehaoshi.com/q/opensource_project) 的问题专区进行提问

## 任务调度

- 每天 24点 备份一次数据库
- 每周备份一次 整个项目代码
- 备份成功与否结果以邮件形式通知
- 请手动清理备份文件

## Contributors

- [Code 好事](https://codehaoshi.com)



