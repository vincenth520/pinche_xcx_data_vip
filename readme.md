##同城拼车微信小程序付费版后端

## 1、安装

### 1.1、下载
`git clone https://github.com/vincenth520/pinche_xcx_data_vip.git`

### 1.2、安装php扩展
`sh ./install_ext.sh`
(输入php所在文件夹,安装完毕重启即可)


### 1.3、安装运行库
`composer install`
(可能会报disable_function错误,删除php.ini里面的disable_function即可)

### 1.4、创建数据库
`create database pinche`
（示例,创建你想要的数据库名，在下面1.4需要用到）

### 1.5、配置
`php artisan start:codems`
（会有一系列的问题,按照提示填写即可）

### 1.6、域名配置

***vhost.conf里面的域名指向目录务必指向项目的public目录,不能指向根目录***
***如果遇到`
Warning: require(): open_basedir restriction in effect. File(/www/wwwroot/pinche.com/vendor/autoload.php) is not within the allowed path(s): (/www/wwwroot/pinche.com/public/:/tmp/:/proc/) in /www/wwwroot/pinche.com/public/index.php on line 24`这种错误,需要在vhost(或者项目根目录下面的.user.ini`编辑之前需要执行chattr -i .user.ini将权限去掉`)里面将/www/wwwroot/pinche.com/public/:/tmp/:/proc/修改为/www/wwwroot/pinche.com/:/tmp/:/proc/***

## 2、后台配置

- 打开你在上面1.5配置的域名,使用你配置的管理员用户名与密码登录
- 首次运行务必先在系统设置里面配置好`小程序设置` `短信设置` `存储设定` 


## 预览
!(效果演示)[http://cloud.video.taobao.com//play/u/1798224346/p/1/e/6/t/1/50052294422.mp4]
