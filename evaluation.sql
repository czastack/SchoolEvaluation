-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 05 月 09 日 10:50
-- 服务器版本: 5.5.49-cll-lve
-- PHP 版本: 5.6.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `evaluation`
--

-- --------------------------------------------------------

--
-- 表的结构 `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `idx-auth_item-type` (`type`),
  KEY `auth_item_ibfk_1` (`rule_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `auth_item_child_ibfk_2` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `class_id` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='班级';

--
-- 转存表中的数据 `class`
--

INSERT INTO `class` (`class_id`, `name`) VALUES
(141, '计网141'),
(143, '计网143'),
(1421, '计网142'),
(1426, '网络131');

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL COMMENT '课程名称',
  PRIMARY KEY (`course_id`),
  UNIQUE KEY `course_id` (`course_id`),
  UNIQUE KEY `course_id_2` (`course_id`),
  UNIQUE KEY `course_id_3` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='课程';

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`course_id`, `name`) VALUES
(1001, '数据库原理'),
(1002, '汇编语言'),
(1003, '计算机网络原理'),
(1004, '计算方法'),
(1005, '数据结构'),
(1006, '面向对象程序设计'),
(1007, '插画艺术'),
(1008, '跆拳道'),
(1009, '形式与政策');

-- --------------------------------------------------------

--
-- 表的结构 `eval_class`
--

CREATE TABLE IF NOT EXISTS `eval_class` (
  `teacher_id` int(11) NOT NULL COMMENT '教师工号',
  `class_id` int(11) NOT NULL COMMENT '班级号',
  `classroom_discipline` tinyint(4) NOT NULL COMMENT '课堂纪律',
  `homework_quality` tinyint(4) NOT NULL COMMENT '作业情况',
  `study_atmosphere` tinyint(4) NOT NULL COMMENT '学习氛围',
  `student_potential` tinyint(4) NOT NULL COMMENT '学生潜力',
  `text_eval` varchar(200) NOT NULL COMMENT '可选文字评价'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='教师->班级评价';

-- --------------------------------------------------------

--
-- 表的结构 `eval_org`
--

CREATE TABLE IF NOT EXISTS `eval_org` (
  `id` int(11) NOT NULL COMMENT '用户id',
  `text` varchar(200) NOT NULL COMMENT '部门评价',
  `org_ids` varchar(50) NOT NULL COMMENT '收到该评价的部门id列表'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='机构评价';

-- --------------------------------------------------------

--
-- 表的结构 `eval_teaching_prog`
--

CREATE TABLE IF NOT EXISTS `eval_teaching_prog` (
  `teacher_id` int(11) NOT NULL COMMENT '教师工号',
  `course_id` int(11) NOT NULL COMMENT '课程号',
  `text` varchar(200) NOT NULL COMMENT '文字评价'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='教师->教学计划评价';

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1456329627),
('m140209_132017_init', 1456330074),
('m140403_174025_create_account_table', 1456330075),
('m140504_113157_update_tables', 1456330081),
('m140504_130429_create_token_table', 1456330082),
('m140506_102106_rbac_init', 1456331776),
('m140830_171933_fix_ip_field', 1456330083),
('m140830_172703_change_account_table_name', 1456330084),
('m141222_110026_update_ip_field', 1456330085);

-- --------------------------------------------------------

--
-- 表的结构 `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
  `org_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `name` varchar(30) NOT NULL COMMENT '部门名称',
  PRIMARY KEY (`org_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='职能部门' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `organization`
--

INSERT INTO `organization` (`org_id`, `name`) VALUES
(1, '教务处'),
(2, '保卫处'),
(3, '财务处'),
(4, '校团委'),
(5, '后勤基建处'),
(6, '发展规划处');

-- --------------------------------------------------------

--
-- 表的结构 `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`) VALUES
(1, NULL, NULL, '2464851375@qq.com', '914ec1bc44babadefaee554c1b474f67', NULL, NULL, NULL),
(2, NULL, NULL, '18977957251@189.cn', '830a5e12b101f33bce66b1a30624f9bb', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `social_account`
--

CREATE TABLE IF NOT EXISTS `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  KEY `fk_user_account` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `user_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `sex` char(2) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`user_id`, `student_id`, `name`, `sex`, `dept`, `class`) VALUES
(3, 1407300244, '陈振', '男', '计算机与电子信息学院', '计算机-网络-信息安全类142班');

-- --------------------------------------------------------

--
-- 表的结构 `studentmark1`
--

CREATE TABLE IF NOT EXISTS `studentmark1` (
  `student_id` int(11) NOT NULL,
  `zt` smallint(6) DEFAULT NULL,
  `jxhj` smallint(6) DEFAULT NULL,
  `zshj` smallint(6) DEFAULT NULL,
  `yshj` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `studentmark2`
--

CREATE TABLE IF NOT EXISTS `studentmark2` (
  `student_id` int(11) NOT NULL,
  `jxhjw` varchar(300) DEFAULT NULL,
  `jxhjr` varchar(300) DEFAULT NULL,
  `zshjw` varchar(300) DEFAULT NULL,
  `zshjr` varchar(300) DEFAULT NULL,
  `yshjw` varchar(300) DEFAULT NULL,
  `yshjr` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `studentmarkt`
--

CREATE TABLE IF NOT EXISTS `studentmarkt` (
  `student_id` int(11) NOT NULL,
  `ktfc` smallint(6) DEFAULT NULL COMMENT '课堂风采',
  `khfd` smallint(6) DEFAULT NULL COMMENT '课后辅导',
  `rwml` smallint(6) DEFAULT NULL COMMENT '人物魅力',
  `totw` varchar(300) DEFAULT NULL COMMENT '文字评价',
  `ottr` varchar(300) DEFAULT NULL COMMENT '热词',
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `student_class`
--

CREATE TABLE IF NOT EXISTS `student_class` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='学生班级关系';

--
-- 转存表中的数据 `student_class`
--

INSERT INTO `student_class` (`student_id`, `class_id`) VALUES
(1407300244, 1421),
(1407300244, 1422),
(1407300244, 1423),
(1407300244, 1425),
(1407300244, 1426),
(1407300244, 1424),
(1407300244, 1427),
(1407300244, 1428);

-- --------------------------------------------------------

--
-- 表的结构 `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `user_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL COMMENT '教师工号',
  `name` varchar(10) NOT NULL COMMENT '姓名',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `teacher_id` (`teacher_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher`
--

INSERT INTO `teacher` (`user_id`, `teacher_id`, `name`) VALUES
(2, 98014, '付中原'),
(3, 98015, '彭飞'),
(4, 98016, '张力'),
(5, 98017, '戴霖'),
(6, 98018, '莫少银'),
(9, 98019, '张伟'),
(10, 98020, '林风'),
(11, 98021, '刘庆'),
(12, 98022, '梁可');

-- --------------------------------------------------------

--
-- 表的结构 `teacher_course_class`
--

CREATE TABLE IF NOT EXISTS `teacher_course_class` (
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher_course_class`
--

INSERT INTO `teacher_course_class` (`teacher_id`, `course_id`, `class_id`) VALUES
(98014, 1001, 141),
(98014, 1001, 1421),
(98014, 1001, 143),
(98015, 1002, 1422),
(98016, 1003, 1423),
(98018, 1007, 1424),
(98017, 1005, 1425),
(98019, 1004, 1426),
(98020, 1006, 1427),
(98021, 1009, 1428),
(98014, 1004, 1426);

-- --------------------------------------------------------

--
-- 表的结构 `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(1, 'KInA0POS9ey9eYaa56H0vSNGWNIdoKxQ', 1456651652, 0),
(2, 'ezapjXk-xtvuRcO1RaTiMJVopqo1swJ7', 1461510460, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`) VALUES
(1, 'admin', '2464851375@qq.com', '$2y$10$JxhCZt9jrXQ42QXJk.x/1u0znp.SGUGJpRtCh/RkiQW8yBtwZ2b2m', 'u4cL3t5ZP0nL45FT3027WTccHBt9MnKI', 1456651660, NULL, NULL, '::1', 1456651652, 1456651652, 1),
(2, 'teacher', '18977957251@189.cn', '$2y$10$OHIYPb8rT4Ymd/LUj5eg/.fX78KccCzfY0kppIDnrK0TgV74jylZy', 'H3sPOBvSeXNGh0iYDjium9NbzIP5o3cC', 1456652660, NULL, NULL, '::1', 1461510460, 1461510460, 1),
(3, 'student', '1432969079@qq.com', '$2y$10$OHIYPb8rT4Ymd/LUj5eg/.fX78KccCzfY0kppIDnrK0TgV74jylZy', 'H3sPOBvSeXNGh0iYDjium9NbzIP5o3cC', 1456652660, '', NULL, '::1', 1461510460, 1461510460, 1);

--
-- 限制导出的表
--

--
-- 限制表 `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- 限制表 `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- 限制表 `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
