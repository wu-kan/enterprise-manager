# enterprise-manager

一个基于 [thinkphp](http://thinkphp.cn) 6.0 开发的企业管理系统，使用 MVC 架构。

[Demo](http://server.wu-kan.cn:8080)。

| 小组成员 |   学号   |
| :------: | :------: |
|   吴飚   | 17341160 |
|   吴坎   | 17341163 |
|  吴思越  | 17341164 |
|  张德龙  | 17341193 |

## 部署方式

### 后端

后端服务器的环境配置如下：

- mysql >= 5.5.65-MariaDB MariaDB Server

在后端服务器上安装 SQL 数据库，然后运行下述指令将其启动：

```bash
systemctl start mysqld.service
```

然后在 sql 终端内输入以下内容创建数据库。

```sql
CREATE TABLE `manager_clerk` (
  `name` varchar(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(5) NOT NULL ,
  `age` int(10) NOT NULL ,
  `address` varchar(50) NOT NULL ,
  `phone` int(20) NOT NULL ,
  `email` varchar(50) NOT NULL ,
  `department` varchar(50) NOT NULL ,
  `wage` int(20) NOT NULL ,
  `bonus` int(15)  DEFAULT '0' ,
  `authority` int(5) DEFAULT '0' ,
  `password` varchar(20) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;


CREATE TABLE `manager_candidate_clerk` (
  `name` varchar(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(5) NOT NULL ,
  `age` int(10) NOT NULL ,
  `address` varchar(50) NOT NULL ,
  `phone` int(20) NOT NULL ,
  `email` varchar(50) NOT NULL ,
  `department` varchar(50) NOT NULL ,
  `wage` int(20) NOT NULL ,
  `bonus` int(15)  DEFAULT '0' ,
  `authority` int(5) DEFAULT '0' ,
  `password` varchar(20) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

CREATE TABLE `manager_department` (
  `name` varchar(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `set_time` varchar(20) NOT NULL ,
  `size` int(10) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;


DROP TRIGGER IF EXISTS `auto_size1`;
create trigger auto_size1 after insert on `manager_clerk`
 for each row
	begin
		update `manager_department`
		set `size` =
			(select count(`id`)
			from `manager_clerk`
			where `manager_clerk`.`department`=new.`department`)
		where `manager_department`.`name`=new.`department`;
	end;


DROP TRIGGER IF EXISTS `auto_size2`;
create trigger auto_size2 after delete on `manager_clerk`
 for each row
	begin
		update `manager_department`
		set `size` =
			(select count(`id`)
			from `manager_clerk`
			where `manager_clerk`.`department`=old.`department`)
		where `manager_department`.`name`=old.`department`;
	end;

DROP TRIGGER IF EXISTS `auto_size3`;
create trigger auto_size3 after update on `manager_clerk`
 for each row
	begin
		update `manager_department`
		set `size` =
			(select count(`id`)
			from `manager_clerk`
			where `manager_clerk`.`department`=new.`department`)
		where `manager_department`.`name`=new.`department`;
		update `manager_department`
		set `size` =
			(select count(`id`)
			from `manager_clerk`
			where `manager_clerk`.`department`=old.`department`)
		where `manager_department`.`name`=old.`department`;
	end;
```

### 前端

前端服务器的环境配置如下：

- php >= 7.1

可以使用 git 获取项目文件：

```bash
git clone https://github.com/wu-kan/enterprise-manager
```

修改项目目录下 `.env` 环境配置文件中后端数据库服务器的配置（如果没有做特殊设置，只需要修改 `*` 号的部分）：

```bash
[DATABASE]
TYPE = mysql
HOSTNAME = *****
DATABASE = manager
USERNAME = ***
PASSWORD = ******
HOSTPORT = 3306
CHARSET = utf8
DEBUG = true
prefix = manager_
```

在当前目录下运行

```bash
php think run -p 8080
```

然后浏览器访问服务器对应端口号即可运行！如果是本地运行的话，直接访问 <http://localhost:8080> 即可；我们也在自己的服务器上搭建了企业管理系统，可以直接访问 <http://server.wu-kan.cn:8080> 查看效果。
