
CREATE TABLE IF NOT EXISTS `program_user` (
  `uid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(100) NOT NULL COMMENT '邮箱账户',
  `password` char(60) NOT NULL COMMENT '密码',
  `nickname` varchar(50) NOT NULL COMMENT '用户昵称',
  `real_name` varchar(30) NOT NULL DEFAULT '' COMMENT '姓名',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别[0:保密,1:男士,2:女士]',
  `avatar` varchar(200) NOT NULL DEFAULT '' COMMENT '头像',
  `mobile` varchar(15) NOT NULL DEFAULT '' COMMENT '手机号码',
  `phone` varchar(15) NOT NULL DEFAULT '' COMMENT '固定电话',
  `qq` varchar(15) NOT NULL DEFAULT '' COMMENT 'QQ',
  `id_card` varchar(18) NOT NULL DEFAULT '' COMMENT '身份证号',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '联系地址',
  `zip_code` char(6) NOT NULL DEFAULT '' COMMENT '邮政编码',
  `is_enable` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户启用状态',
  `is_super` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否超级程序员',
  `refer_uid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '引荐人或添加人UID',
  `login_times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_at` datetime  DEFAULT NULL COMMENT '最后登录时间',
  `register_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '注册或添加IP',
  `register_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册或添加时间',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后数据更新时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uk_username` (`username`),
  UNIQUE KEY `uk_nickname` (`nickname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='开发人员表';

--
-- 转存表中的数据 `program_user`
--
insert into `laravel`.`program_user` ( `uid`,  `username`, `password`, `nickname`, `real_name`, `sex`, `avatar`, `mobile`, `phone`, `qq`, `id_card`, `birthday`, `address`, `zip_code`, `is_enable`, `is_super`, `refer_uid`, `login_times`, `last_login_ip`, `last_login_at`, `register_ip`, `register_at`, `updated_at`) values
('1',  'top-world@qq.com', '$2y$10$UODSBjSYly/uURnfdgtKEeWg4nJyWRPFUKT1mrBv5UX2O6Fbu9xgK', 'Charles', '超级程序员', '1', '', '', '', '', '', null, '', '', '1', '1', '0', '1', '192.168.146.1', '2020-07-24 14:16:29', '127.0.0.1', '2020-07-24 06:15:44', '2020-07-26 01:11:19');
