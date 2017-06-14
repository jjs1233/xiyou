-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 05 月 31 日 15:04
-- 服务器版本: 5.6.36
-- PHP 版本: 5.5.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `ghs_session`
--

CREATE TABLE IF NOT EXISTS `ghs_session` (
  `user_id` bigint(20) NOT NULL,
  `mobile` char(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `session_id` char(32) NOT NULL,
  `auth_sign` char(32) DEFAULT NULL,
  `last_action` int(10) NOT NULL DEFAULT '0' COMMENT '最后活动时间',
  `last_ip` varchar(20) NOT NULL,
  `agent` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户登录session';

--
-- 转存表中的数据 `ghs_session`
--

INSERT INTO `ghs_session` (`user_id`, `mobile`, `user_name`, `session_id`, `auth_sign`, `last_action`, `last_ip`, `agent`) VALUES
(2, '18000000000', '18000000000', 'de7194f5d0636fe9f0ad745a083517ad', '41978d3b7f973000a46d7c2488416a00', 1496214241, '127.0.0.1', 's:133:"Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1";');

-- --------------------------------------------------------

--
-- 表的结构 `ghs_smscode`
--

CREATE TABLE IF NOT EXISTS `ghs_smscode` (
  `sid` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '流水号',
  `mobile` char(11) NOT NULL COMMENT '手机号',
  `code` char(6) NOT NULL COMMENT '验证码',
  `idtype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1注册2找回密码3修改密码',
  `created` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下发时间',
  `expire` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '到期时间',
  `ip` char(15) NOT NULL COMMENT 'ip地址',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态0可用1已使用',
  PRIMARY KEY (`sid`),
  KEY `mobile` (`mobile`,`code`,`idtype`),
  KEY `mobile_2` (`mobile`,`idtype`),
  KEY `created` (`created`,`ip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='短信码表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `ghs_smscode`
--

INSERT INTO `ghs_smscode` (`sid`, `mobile`, `code`, `idtype`, `created`, `expire`, `ip`, `status`) VALUES
(1, '18686440000', '828703', 1, 1496209108, 1496210308, '127.0.0.1', 0),
(2, '18684668000', '929789', 1, 1496209223, 1496210423, '127.0.0.1', 0),
(3, '18000000000', '206630', 1, 1496209568, 1496210768, '127.0.0.1', 1),
(4, '18000000001', '533355', 1, 1496211470, 1496212670, '127.0.0.1', 1),
(5, '18000000002', '408585', 1, 1496211831, 1496213031, '127.0.0.1', 1),
(6, '18000000003', '494948', 1, 1496212992, 1496214192, '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ghs_user`
--

CREATE TABLE IF NOT EXISTS `ghs_user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `u_type` smallint(2) NOT NULL DEFAULT '0' COMMENT '用户类型',
  `mobile` char(11) NOT NULL COMMENT '手机号',
  `user_name` varchar(60) NOT NULL COMMENT '昵称',
  `real_name` varchar(60) NOT NULL COMMENT '真实姓名',
  `password` char(32) NOT NULL COMMENT '密码',
  `fans_num` mediumint(8) NOT NULL DEFAULT '0' COMMENT '粉丝数',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1男2女0未知',
  `role_id` int(6) NOT NULL DEFAULT '0' COMMENT '用户角色',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `exp_lower` mediumint(8) NOT NULL DEFAULT '0' COMMENT '经验值',
  `salt` char(6) NOT NULL COMMENT '加盐',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0待审1激活2锁定',
  `avatar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '头像0无1有',
  `last_login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_action` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后操作时间',
  `last_login_ip` varchar(20) NOT NULL COMMENT '最后登录ip',
  `logins` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `registered` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` varchar(20) NOT NULL COMMENT '注册ip',
  `protected` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否保护1不能删除',
  `inviter_mobile` bigint(20) NOT NULL DEFAULT '0' COMMENT '邀请人手机',
  `source` varchar(15) NOT NULL DEFAULT 'pc' COMMENT '来源',
  PRIMARY KEY (`user_id`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `ghs_user`
--

INSERT INTO `ghs_user` (`user_id`, `u_type`, `mobile`, `user_name`, `real_name`, `password`, `fans_num`, `sex`, `role_id`, `balance`, `exp_lower`, `salt`, `status`, `avatar`, `last_login`, `last_action`, `last_login_ip`, `logins`, `registered`, `reg_ip`, `protected`, `inviter_mobile`, `source`) VALUES
(2, 0, '18000000000', '18000000000', '', '1deeabb9eb3fa1434de24b1e9fca158b', 1, 1, 0, 0.00, 0, 'aVEnBg', 1, 0, 1496214241, 1496214241, '127.0.0.1', 4, 1496209602, '127.0.0.1', 0, 0, 'pc'),
(3, 0, '18000000001', '18000000001', '真实的我', '6210532816608b71aff94c4e44576302', 0, 1, 0, 0.00, 0, 'GjVp4g', 1, 0, 1496211503, 1496211503, '127.0.0.1', 0, 1496211503, '127.0.0.1', 0, 0, 'pc'),
(4, 0, '18000000002', '你啊好', '李明', '17d4360e15aa8ca0b265e555ddeab758', 0, 1, 0, 0.00, 0, 'Zudr9A', 1, 0, 1496211957, 1496211957, '127.0.0.1', 0, 1496211957, '127.0.0.1', 0, 18000000000, 'pc'),
(5, 2, '18000000003', '电视剧阿里', '马云', 'c9d44fa4e68a5ed516cc7515f907f0b4', 0, 1, 0, 0.00, 0, '2mKQx5', 1, 0, 1496213316, 1496213316, '127.0.0.1', 0, 1496213316, '127.0.0.1', 0, 0, 'pc');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
