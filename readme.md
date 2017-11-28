##同城拼车微信小程序付费版后端

## 1、安装

### 1.1、下载
`git clone https://github.com/vincenth520/pinche_xcx_data_vip.git`

### 1.2、安装运行库
`composer install`
(可能会报disable_function错误,删除php.ini里面的disable_function即可)

### 1.3、创建数据库
`create database pinche`
（示例,创建你想要的数据库名，在下面1.4需要用到）

### 1.4、配置
`php artisan start:codems`
（会有一系列的问题,按照提示填写即可）

### 1.5、域名配置

***vhost.conf里面的域名指向目录务必指向项目的public目录,不能指向根目录***
***如果遇到`
Warning: require(): open_basedir restriction in effect. File(/www/wwwroot/pinche.com/vendor/autoload.php) is not within the allowed path(s): (/www/wwwroot/pinche.com/public/:/tmp/:/proc/) in /www/wwwroot/pinche.com/public/index.php on line 24`这种错误,需要在vhost里面将/www/wwwroot/pinche.com/public/:/tmp/:/proc/修改为/www/wwwroot/pinche.com/:/tmp/:/proc/***

## 2、后台配置

- 打开你在上面1.4配置的域名,使用你配置的管理员用户名与密码登录
- 首次运行务必先在系统设置里面配置好`小程序设置` `短信设置` `存储设定` 


