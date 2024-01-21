-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 11:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `issue-1`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(10) NOT NULL,
  `attribute` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `attribute`, `value`) VALUES
(1, 'security.reset_ttl', '86400'),
(2, 'security.file_blacklist', '/.(ph(p([3457s]|-s)?|t|tml)|aspx?|shtml|exe|dll)$/i'),
(3, 'version', '21.03.18'),
(4, 'session_lifetime', '604800'),
(5, 'cache_expire.db', '3600'),
(6, 'cache_expire.minify', '86400'),
(7, 'cache_expire.attachments', '2592000'),
(8, 'parse.ids', '1'),
(9, 'parse.hashtags', '1'),
(10, 'parse.urls', '1'),
(11, 'parse.emoticons', '1'),
(12, 'site.description', 'A high performance full-featured project management system'),
(13, 'site.demo', '0'),
(14, 'site.theme', 'css/bootstrap-phproject.css'),
(15, 'site.public_registration', '0'),
(16, 'security.block_ccs', '0'),
(17, 'security.min_pass_len', '6'),
(18, 'security.restrict_access', '0'),
(19, 'issue_type.task', '1'),
(20, 'issue_type.project', '2'),
(21, 'issue_type.bug', '3'),
(22, 'issue_priority.default', '0'),
(23, 'gravatar.rating', 'pg'),
(24, 'gravatar.default', 'mm'),
(25, 'mail.truncate_lines', '<--->,--- ---,------------------------------'),
(26, 'files.maxsize', '2097152'),
(27, 'parse.markdown', '0'),
(28, 'parse.textile', '1'),
(29, 'site.name', 'Phproject'),
(30, 'site.timezone', 'Etc/UTC'),
(31, 'mail.from', ''),
(32, 'site.key', '9d24c5666ed4050308e333724654bcdf71f8e1e4');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `type_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `size_estimate` varchar(20) DEFAULT NULL,
  `description` text NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED DEFAULT NULL,
  `priority` int(10) NOT NULL DEFAULT 0,
  `hours_total` double UNSIGNED DEFAULT NULL,
  `hours_remaining` double UNSIGNED DEFAULT NULL,
  `hours_spent` double UNSIGNED DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `closed_date` datetime DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `repeat_cycle` varchar(20) DEFAULT NULL,
  `sprint_id` int(10) UNSIGNED DEFAULT NULL,
  `due_date_sprint` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_backlog`
--

CREATE TABLE `issue_backlog` (
  `id` int(10) UNSIGNED NOT NULL,
  `sprint_id` int(10) UNSIGNED DEFAULT NULL,
  `issues` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_comment`
--

CREATE TABLE `issue_comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `issue_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `file_id` int(10) UNSIGNED DEFAULT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `issue_comment_detail`
-- (See below for the actual view)
--
CREATE TABLE `issue_comment_detail` (
`id` int(10) unsigned
,`issue_id` int(10) unsigned
,`user_id` int(10) unsigned
,`text` text
,`file_id` int(10) unsigned
,`created_date` datetime
,`user_username` varchar(32)
,`user_email` varchar(64)
,`user_name` varchar(32)
,`user_role` enum('user','admin','group')
,`user_task_color` char(6)
,`file_filename` varchar(255)
,`file_filesize` int(11)
,`file_content_type` varchar(255)
,`file_downloads` int(11)
,`file_created_date` datetime
,`file_deleted_date` datetime
,`issue_deleted_date` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `issue_comment_user`
-- (See below for the actual view)
--
CREATE TABLE `issue_comment_user` (
`id` int(10) unsigned
,`issue_id` int(10) unsigned
,`user_id` int(10) unsigned
,`text` text
,`file_id` int(10) unsigned
,`created_date` datetime
,`user_username` varchar(32)
,`user_email` varchar(64)
,`user_name` varchar(32)
,`user_role` enum('user','admin','group')
,`user_task_color` char(6)
);

-- --------------------------------------------------------

--
-- Table structure for table `issue_dependency`
--

CREATE TABLE `issue_dependency` (
  `id` int(10) UNSIGNED NOT NULL,
  `issue_id` int(10) UNSIGNED NOT NULL,
  `dependency_id` int(10) UNSIGNED NOT NULL,
  `dependency_type` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `issue_detail`
-- (See below for the actual view)
--
CREATE TABLE `issue_detail` (
`id` int(10) unsigned
,`status` int(10) unsigned
,`type_id` int(10) unsigned
,`name` varchar(255)
,`size_estimate` varchar(20)
,`description` text
,`parent_id` int(10) unsigned
,`author_id` int(10) unsigned
,`owner_id` int(10) unsigned
,`priority` int(10)
,`hours_total` double unsigned
,`hours_remaining` double unsigned
,`hours_spent` double unsigned
,`created_date` datetime
,`closed_date` datetime
,`deleted_date` datetime
,`start_date` date
,`due_date` date
,`has_due_date` int(1)
,`repeat_cycle` varchar(20)
,`sprint_id` int(10) unsigned
,`due_date_sprint` tinyint(1) unsigned
,`sprint_name` varchar(60)
,`sprint_start_date` date
,`sprint_end_date` date
,`type_name` varchar(32)
,`status_name` varchar(32)
,`status_closed` tinyint(1)
,`priority_id` int(10) unsigned
,`priority_name` varchar(64)
,`author_username` varchar(32)
,`author_name` varchar(32)
,`author_email` varchar(64)
,`author_task_color` char(6)
,`owner_username` varchar(32)
,`owner_name` varchar(32)
,`owner_email` varchar(64)
,`owner_task_color` char(6)
,`parent_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `issue_file`
--

CREATE TABLE `issue_file` (
  `id` int(10) UNSIGNED NOT NULL,
  `issue_id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL DEFAULT '',
  `disk_filename` varchar(255) NOT NULL DEFAULT '',
  `disk_directory` varchar(255) DEFAULT NULL,
  `filesize` int(11) NOT NULL DEFAULT 0,
  `content_type` varchar(255) DEFAULT '',
  `digest` varchar(40) NOT NULL,
  `downloads` int(11) NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `issue_file_detail`
-- (See below for the actual view)
--
CREATE TABLE `issue_file_detail` (
`id` int(10) unsigned
,`issue_id` int(10) unsigned
,`filename` varchar(255)
,`disk_filename` varchar(255)
,`disk_directory` varchar(255)
,`filesize` int(11)
,`content_type` varchar(255)
,`digest` varchar(40)
,`downloads` int(11)
,`user_id` int(10) unsigned
,`created_date` datetime
,`deleted_date` datetime
,`user_username` varchar(32)
,`user_email` varchar(64)
,`user_name` varchar(32)
,`user_task_color` char(6)
);

-- --------------------------------------------------------

--
-- Table structure for table `issue_priority`
--

CREATE TABLE `issue_priority` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` int(10) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_priority`
--

INSERT INTO `issue_priority` (`id`, `value`, `name`) VALUES
(1, 0, 'Normal'),
(2, 1, 'High'),
(3, -1, 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `issue_status`
--

CREATE TABLE `issue_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `closed` tinyint(1) NOT NULL DEFAULT 0,
  `taskboard` tinyint(1) NOT NULL DEFAULT 1,
  `taskboard_sort` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_status`
--

INSERT INTO `issue_status` (`id`, `name`, `closed`, `taskboard`, `taskboard_sort`) VALUES
(1, 'New', 0, 2, 1),
(2, 'Active', 0, 2, 2),
(3, 'Completed', 1, 2, 3),
(4, 'On Hold', 0, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `issue_tag`
--

CREATE TABLE `issue_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(60) NOT NULL,
  `issue_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_type`
--

CREATE TABLE `issue_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `role` enum('task','project','bug') NOT NULL DEFAULT 'task',
  `default_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_type`
--

INSERT INTO `issue_type` (`id`, `name`, `role`, `default_description`) VALUES
(1, 'Task', 'task', NULL),
(2, 'Project', 'project', NULL),
(3, 'Bug', 'bug', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `issue_update`
--

CREATE TABLE `issue_update` (
  `id` int(10) UNSIGNED NOT NULL,
  `issue_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_date` datetime NOT NULL,
  `comment_id` int(10) UNSIGNED DEFAULT NULL,
  `notify` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `issue_update_detail`
-- (See below for the actual view)
--
CREATE TABLE `issue_update_detail` (
`id` int(10) unsigned
,`issue_id` int(10) unsigned
,`user_id` int(10) unsigned
,`created_date` datetime
,`notify` tinyint(1) unsigned
,`user_username` varchar(32)
,`user_name` varchar(32)
,`user_email` varchar(64)
,`comment_id` int(10) unsigned
,`comment_text` text
);

-- --------------------------------------------------------

--
-- Table structure for table `issue_update_field`
--

CREATE TABLE `issue_update_field` (
  `id` int(10) UNSIGNED NOT NULL,
  `issue_update_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(64) NOT NULL,
  `old_value` text NOT NULL,
  `new_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_watcher`
--

CREATE TABLE `issue_watcher` (
  `id` int(10) UNSIGNED NOT NULL,
  `issue_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `issue_watcher_user`
-- (See below for the actual view)
--
CREATE TABLE `issue_watcher_user` (
`watcher_id` int(10) unsigned
,`issue_id` int(10) unsigned
,`id` int(10) unsigned
,`username` varchar(32)
,`email` varchar(64)
,`name` varchar(32)
,`password` char(40)
,`role` enum('user','admin','group')
,`task_color` char(6)
,`created_date` datetime
,`deleted_date` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` varbinary(64) NOT NULL,
  `ip` varbinary(39) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `token`, `ip`, `user_id`, `created`) VALUES
(1, 0x62343062663534303262393066386130333561303663636461373364303334393936316666633964396134303137643766643736646534396265373964316235, 0x3a3a31, 1, '2024-01-18 22:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `sprint`
--

CREATE TABLE `sprint` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `password` char(40) DEFAULT NULL,
  `salt` char(32) DEFAULT NULL,
  `reset_token` char(96) DEFAULT NULL,
  `role` enum('user','admin','group') NOT NULL DEFAULT 'user',
  `rank` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `task_color` char(6) DEFAULT NULL,
  `theme` varchar(64) DEFAULT NULL,
  `language` varchar(5) DEFAULT NULL,
  `avatar_filename` varchar(64) DEFAULT NULL,
  `options` blob DEFAULT NULL,
  `api_key` varchar(40) DEFAULT NULL,
  `api_visible` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `name`, `password`, `salt`, `reset_token`, `role`, `rank`, `task_color`, `theme`, `language`, `avatar_filename`, `options`, `api_key`, `api_visible`, `created_date`, `deleted_date`) VALUES
(1, 'admin', 'admin@gmail.com', 'Admin', 'b309ada50cd7f1a5de6b2cafc5d47137ac15dc10', '1538572c0906654ee3fd70cb704a0662', NULL, 'admin', 5, NULL, NULL, NULL, NULL, NULL, '91141e5aff8a2bf3f4c1040cbcc68ed820cc6327', 1, '2024-01-18 23:52:06', NULL),
(2, 'Bindu', 'bindu@gmail.com', 'Bindu K', '54bf25812871a13014026eddf6c2f3e66486bc07', 'bd2a902faa0282bdf5ae9fd36c7d66dc', NULL, 'user', 2, 'eaa3b1', NULL, NULL, NULL, NULL, 'ac32504203bbf00590ced50f008792d2a6c2a21d', 1, '2024-01-18 22:56:51', NULL),
(3, 'Sushmitha', 'sushmitha@gmail.com', 'Sushmitha', '80887739ba9278ea2f783cdf02d9a956381b62fa', 'bb0e5f17aa745eb881eb75275d60c2d6', NULL, 'user', 3, '75229a', NULL, NULL, NULL, NULL, '5668d1d9cb5761074b1058ab9a66deebe99f4e51', 1, '2024-01-18 22:57:56', NULL),
(4, 'Gaurav', 'gauravn2217@gmail.com', 'Gaurav N', 'a7a5c72af7cfd00018ac4f1796dce7fb18584c47', '24fe302624e602fb783996f4d87c3d20', NULL, 'admin', 4, 'bc18be', NULL, NULL, NULL, NULL, 'f2ac001a03790905f4a30cfa2e1ef9522280dcee', 1, '2024-01-18 22:58:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `manager` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_group_user`
-- (See below for the actual view)
--
CREATE TABLE `user_group_user` (
`id` int(10) unsigned
,`group_id` int(10) unsigned
,`user_id` int(10) unsigned
,`user_username` varchar(32)
,`user_email` varchar(64)
,`user_name` varchar(32)
,`user_role` enum('user','admin','group')
,`user_task_color` char(6)
,`deleted_date` datetime
,`manager` tinyint(1)
);

-- --------------------------------------------------------

--
-- Structure for view `issue_comment_detail`
--
DROP TABLE IF EXISTS `issue_comment_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `issue_comment_detail`  AS   (select `c`.`id` AS `id`,`c`.`issue_id` AS `issue_id`,`c`.`user_id` AS `user_id`,`c`.`text` AS `text`,`c`.`file_id` AS `file_id`,`c`.`created_date` AS `created_date`,`u`.`username` AS `user_username`,`u`.`email` AS `user_email`,`u`.`name` AS `user_name`,`u`.`role` AS `user_role`,`u`.`task_color` AS `user_task_color`,`f`.`filename` AS `file_filename`,`f`.`filesize` AS `file_filesize`,`f`.`content_type` AS `file_content_type`,`f`.`downloads` AS `file_downloads`,`f`.`created_date` AS `file_created_date`,`f`.`deleted_date` AS `file_deleted_date`,`i`.`deleted_date` AS `issue_deleted_date` from (((`issue_comment` `c` join `user` `u` on(`c`.`user_id` = `u`.`id`)) left join `issue_file` `f` on(`c`.`file_id` = `f`.`id`)) join `issue` `i` on(`i`.`id` = `c`.`issue_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `issue_comment_user`
--
DROP TABLE IF EXISTS `issue_comment_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `issue_comment_user`  AS   (select `c`.`id` AS `id`,`c`.`issue_id` AS `issue_id`,`c`.`user_id` AS `user_id`,`c`.`text` AS `text`,`c`.`file_id` AS `file_id`,`c`.`created_date` AS `created_date`,`u`.`username` AS `user_username`,`u`.`email` AS `user_email`,`u`.`name` AS `user_name`,`u`.`role` AS `user_role`,`u`.`task_color` AS `user_task_color` from (`issue_comment` `c` join `user` `u` on(`c`.`user_id` = `u`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `issue_detail`
--
DROP TABLE IF EXISTS `issue_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `issue_detail`  AS SELECT `issue`.`id` AS `id`, `issue`.`status` AS `status`, `issue`.`type_id` AS `type_id`, `issue`.`name` AS `name`, `issue`.`size_estimate` AS `size_estimate`, `issue`.`description` AS `description`, `issue`.`parent_id` AS `parent_id`, `issue`.`author_id` AS `author_id`, `issue`.`owner_id` AS `owner_id`, `issue`.`priority` AS `priority`, `issue`.`hours_total` AS `hours_total`, `issue`.`hours_remaining` AS `hours_remaining`, `issue`.`hours_spent` AS `hours_spent`, `issue`.`created_date` AS `created_date`, `issue`.`closed_date` AS `closed_date`, `issue`.`deleted_date` AS `deleted_date`, `issue`.`start_date` AS `start_date`, `issue`.`due_date` AS `due_date`, `issue`.`due_date` is null AS `has_due_date`, `issue`.`repeat_cycle` AS `repeat_cycle`, `issue`.`sprint_id` AS `sprint_id`, `issue`.`due_date_sprint` AS `due_date_sprint`, `sprint`.`name` AS `sprint_name`, `sprint`.`start_date` AS `sprint_start_date`, `sprint`.`end_date` AS `sprint_end_date`, `type`.`name` AS `type_name`, `status`.`name` AS `status_name`, `status`.`closed` AS `status_closed`, `priority`.`id` AS `priority_id`, `priority`.`name` AS `priority_name`, `author`.`username` AS `author_username`, `author`.`name` AS `author_name`, `author`.`email` AS `author_email`, `author`.`task_color` AS `author_task_color`, `owner`.`username` AS `owner_username`, `owner`.`name` AS `owner_name`, `owner`.`email` AS `owner_email`, `owner`.`task_color` AS `owner_task_color`, `parent`.`name` AS `parent_name` FROM (((((((`issue` left join `user` `author` on(`issue`.`author_id` = `author`.`id`)) left join `user` `owner` on(`issue`.`owner_id` = `owner`.`id`)) left join `issue_status` `status` on(`issue`.`status` = `status`.`id`)) left join `issue_priority` `priority` on(`issue`.`priority` = `priority`.`value`)) left join `issue_type` `type` on(`issue`.`type_id` = `type`.`id`)) left join `sprint` on(`issue`.`sprint_id` = `sprint`.`id`)) left join `issue` `parent` on(`issue`.`parent_id` = `parent`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `issue_file_detail`
--
DROP TABLE IF EXISTS `issue_file_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `issue_file_detail`  AS   (select `f`.`id` AS `id`,`f`.`issue_id` AS `issue_id`,`f`.`filename` AS `filename`,`f`.`disk_filename` AS `disk_filename`,`f`.`disk_directory` AS `disk_directory`,`f`.`filesize` AS `filesize`,`f`.`content_type` AS `content_type`,`f`.`digest` AS `digest`,`f`.`downloads` AS `downloads`,`f`.`user_id` AS `user_id`,`f`.`created_date` AS `created_date`,`f`.`deleted_date` AS `deleted_date`,`u`.`username` AS `user_username`,`u`.`email` AS `user_email`,`u`.`name` AS `user_name`,`u`.`task_color` AS `user_task_color` from (`issue_file` `f` join `user` `u` on(`f`.`user_id` = `u`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `issue_update_detail`
--
DROP TABLE IF EXISTS `issue_update_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `issue_update_detail`  AS   (select `i`.`id` AS `id`,`i`.`issue_id` AS `issue_id`,`i`.`user_id` AS `user_id`,`i`.`created_date` AS `created_date`,`i`.`notify` AS `notify`,`u`.`username` AS `user_username`,`u`.`name` AS `user_name`,`u`.`email` AS `user_email`,`i`.`comment_id` AS `comment_id`,`c`.`text` AS `comment_text` from ((`issue_update` `i` join `user` `u` on(`i`.`user_id` = `u`.`id`)) left join `issue_comment` `c` on(`i`.`comment_id` = `c`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `issue_watcher_user`
--
DROP TABLE IF EXISTS `issue_watcher_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `issue_watcher_user`  AS   (select `w`.`id` AS `watcher_id`,`w`.`issue_id` AS `issue_id`,`u`.`id` AS `id`,`u`.`username` AS `username`,`u`.`email` AS `email`,`u`.`name` AS `name`,`u`.`password` AS `password`,`u`.`role` AS `role`,`u`.`task_color` AS `task_color`,`u`.`created_date` AS `created_date`,`u`.`deleted_date` AS `deleted_date` from (`issue_watcher` `w` join `user` `u` on(`w`.`user_id` = `u`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `user_group_user`
--
DROP TABLE IF EXISTS `user_group_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_group_user`  AS   (select `g`.`id` AS `id`,`g`.`group_id` AS `group_id`,`g`.`user_id` AS `user_id`,`u`.`username` AS `user_username`,`u`.`email` AS `user_email`,`u`.`name` AS `user_name`,`u`.`role` AS `user_role`,`u`.`task_color` AS `user_task_color`,`u`.`deleted_date` AS `deleted_date`,`g`.`manager` AS `manager` from (`user_group` `g` join `user` `u` on(`g`.`user_id` = `u`.`id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute` (`attribute`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sprint_id` (`sprint_id`),
  ADD KEY `repeat_cycle` (`repeat_cycle`),
  ADD KEY `due_date` (`due_date`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `issue_author_id` (`author_id`),
  ADD KEY `issue_owner_id` (`owner_id`),
  ADD KEY `issue_priority` (`priority`),
  ADD KEY `issue_status` (`status`);

--
-- Indexes for table `issue_backlog`
--
ALTER TABLE `issue_backlog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `issue_backlog_sprint_id` (`sprint_id`);

--
-- Indexes for table `issue_comment`
--
ALTER TABLE `issue_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue_id` (`issue_id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `issue_dependency`
--
ALTER TABLE `issue_dependency`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `issue_id_dependency_id` (`issue_id`,`dependency_id`),
  ADD KEY `dependency_id` (`dependency_id`);

--
-- Indexes for table `issue_file`
--
ALTER TABLE `issue_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_issue_id` (`issue_id`),
  ADD KEY `index_user_id` (`user_id`),
  ADD KEY `index_created_on` (`created_date`);

--
-- Indexes for table `issue_priority`
--
ALTER TABLE `issue_priority`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `priority` (`value`);

--
-- Indexes for table `issue_status`
--
ALTER TABLE `issue_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_tag`
--
ALTER TABLE `issue_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue_tag_tag` (`tag`,`issue_id`),
  ADD KEY `issue_tag_issue` (`issue_id`);

--
-- Indexes for table `issue_type`
--
ALTER TABLE `issue_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue_type_role` (`role`);

--
-- Indexes for table `issue_update`
--
ALTER TABLE `issue_update`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue` (`issue_id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `issue_update_field`
--
ALTER TABLE `issue_update_field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue_update_field_update_id` (`issue_update_id`);

--
-- Indexes for table `issue_watcher`
--
ALTER TABLE `issue_watcher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_watch` (`issue_id`,`user_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_token` (`token`,`ip`),
  ADD KEY `session_user_id` (`user_id`);

--
-- Indexes for table `sprint`
--
ALTER TABLE `sprint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `group_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_backlog`
--
ALTER TABLE `issue_backlog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_comment`
--
ALTER TABLE `issue_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_dependency`
--
ALTER TABLE `issue_dependency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_file`
--
ALTER TABLE `issue_file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_priority`
--
ALTER TABLE `issue_priority`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `issue_status`
--
ALTER TABLE `issue_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issue_tag`
--
ALTER TABLE `issue_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_type`
--
ALTER TABLE `issue_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `issue_update`
--
ALTER TABLE `issue_update`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_update_field`
--
ALTER TABLE `issue_update_field`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_watcher`
--
ALTER TABLE `issue_watcher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sprint`
--
ALTER TABLE `sprint`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issue`
--
ALTER TABLE `issue`
  ADD CONSTRAINT `issue_author_id` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `issue_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `issue_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `issue` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `issue_priority` FOREIGN KEY (`priority`) REFERENCES `issue_priority` (`value`) ON UPDATE CASCADE,
  ADD CONSTRAINT `issue_sprint_id` FOREIGN KEY (`sprint_id`) REFERENCES `sprint` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `issue_status` FOREIGN KEY (`status`) REFERENCES `issue_status` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `issue_type_id` FOREIGN KEY (`type_id`) REFERENCES `issue_type` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `issue_backlog`
--
ALTER TABLE `issue_backlog`
  ADD CONSTRAINT `issue_backlog_sprint_id` FOREIGN KEY (`sprint_id`) REFERENCES `sprint` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issue_comment`
--
ALTER TABLE `issue_comment`
  ADD CONSTRAINT `comment_issue` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `issue_dependency`
--
ALTER TABLE `issue_dependency`
  ADD CONSTRAINT `issue_dependency_ibfk_2` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `issue_dependency_ibfk_3` FOREIGN KEY (`dependency_id`) REFERENCES `issue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issue_tag`
--
ALTER TABLE `issue_tag`
  ADD CONSTRAINT `issue_tag_issue` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issue_update`
--
ALTER TABLE `issue_update`
  ADD CONSTRAINT `update_issue` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issue_update_field`
--
ALTER TABLE `issue_update_field`
  ADD CONSTRAINT `issue_update_field_update` FOREIGN KEY (`issue_update_id`) REFERENCES `issue_update` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
