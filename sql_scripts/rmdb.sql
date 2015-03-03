-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2012 at 06:33 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cast`
--

CREATE TABLE IF NOT EXISTS `cast` (
  `actor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `show_id` int(11) NOT NULL,
  UNIQUE KEY `actor_id` (`actor_id`,`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cast`
--

INSERT INTO `cast` (`actor_id`, `name`, `show_id`) VALUES
(1, 'Paul Newman', 3),
(2, 'Denzel Washington', 4),
(3, 'Will Smith', 4),
(4, 'Zoe Saldana', 4),
(5, 'Betty White', 5),
(6, 'Ashton Kutcher', 5),
(7, 'Rooney Mara', 2),
(8, 'Daniel Craig', 2),
(9, 'Christopher Plummer', 2),
(10, 'Stellan Skarsgard', 2),
(11, 'Steven Berkoff', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cast_and_crew`
--

CREATE TABLE IF NOT EXISTS `cast_and_crew` (
  `show_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  KEY `show_id` (`show_id`),
  KEY `person_id` (`person_id`,`job_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
  `ch_id` int(11) NOT NULL AUTO_INCREMENT,
  `ch_name` varchar(4) NOT NULL,
  PRIMARY KEY (`ch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`ch_id`, `ch_name`) VALUES
(1, 'CH01'),
(2, 'NBC'),
(3, 'CH03');

-- --------------------------------------------------------

--
-- Table structure for table `goofs`
--

CREATE TABLE IF NOT EXISTS `goofs` (
  `goof_id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) NOT NULL,
  `goof` text NOT NULL,
  UNIQUE KEY `g_id` (`goof_id`,`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------
--
-- Table structure for table `celeb_goofs`
--

CREATE TABLE IF NOT EXISTS `celeb_goofs` (
  `goof_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `goof` text NOT NULL,
  UNIQUE KEY `g_id` (`goof_id`,`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE IF NOT EXISTS `listing` (
  `ch_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `min` varchar(2) NOT NULL,
  `am_pm` varchar(2) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`ch_id`, `show_id`, `hour`, `min`, `am_pm`, `day`, `month`, `year`) VALUES
(4, 3, 1, '30', 'am', 12, 2, 2012),
(4, 3, 1, '30', 'am', 12, 2, 2012),
(1, 23, 6, '00', 'pm', 16, 2, 2012),
(1, 23, 7, '00', 'pm', 16, 2, 2012),
(2, 20, 6, '00', 'pm', 16, 2, 2012),
(2, 21, 6, '30', 'pm', 16, 2, 2012),
(3, 16, 6, '00', 'pm', 16, 2, 2012),
(3, 17, 6, '30', 'pm', 16, 2, 2012),
(3, 19, 7, '00', 'pm', 16, 2, 2012),
(2, 22, 7, '00', 'pm', 16, 2, 2012),
(1, 23, 7, '30', 'pm', 16, 2, 2012),
(2, 22, 7, '30', 'pm', 16, 2, 2012),
(3, 16, 7, '30', 'pm', 16, 2, 2012),
(1, 18, 11, '30', 'pm', 16, 2, 2012),
(2, 22, 11, '00', 'pm', 2, 16, 2012),
(1, 20, 3, '00', 'pm', 17, 2, 2012),
(3, 19, 3, '00', 'pm', 17, 2, 2012),
(2, 18, 3, '00', 'pm', 17, 2, 2012),
(2, 21, 10, '30', 'pm', 16, 2, 2012),
(2, 21, 11, '30', 'pm', 16, 2, 2012),
(3, 16, 11, '00', 'pm', 16, 2, 2012),
(3, 16, 11, '30', 'pm', 16, 2, 2012),
(2, 21, 11, '00', 'pm', 16, 2, 2012),
(3, 17, 10, '30', 'pm', 16, 2, 2012),
(1, 18, 11, '00', 'pm', 16, 2, 2012),
(1, 23, 10, '30', 'pm', 16, 2, 2012),
(1, 23, 9, '00', 'pm', 15, 2, 2012),
(1, 23, 9, '30', 'pm', 15, 2, 2012),
(2, 20, 9, '00', 'pm', 15, 2, 2012),
(2, 43, 8, '00', 'pm', 16, 2, 2012),
(4, 3, 1, '30', 'am', 12, 2, 2012),
(4, 3, 1, '30', 'am', 12, 2, 2012),
(1, 23, 6, '00', 'pm', 16, 2, 2012),
(1, 23, 7, '00', 'pm', 16, 2, 2012),
(2, 20, 6, '00', 'pm', 16, 2, 2012),
(2, 21, 6, '30', 'pm', 16, 2, 2012),
(3, 16, 6, '00', 'pm', 16, 2, 2012),
(3, 17, 6, '30', 'pm', 16, 2, 2012),
(3, 19, 7, '00', 'pm', 16, 2, 2012),
(2, 22, 7, '00', 'pm', 16, 2, 2012),
(1, 23, 7, '30', 'pm', 16, 2, 2012),
(2, 22, 7, '30', 'pm', 16, 2, 2012),
(3, 16, 7, '30', 'pm', 16, 2, 2012),
(1, 18, 11, '30', 'pm', 16, 2, 2012),
(2, 22, 11, '00', 'pm', 2, 16, 2012),
(1, 20, 3, '00', 'pm', 17, 2, 2012),
(3, 19, 3, '00', 'pm', 17, 2, 2012),
(2, 18, 3, '00', 'pm', 17, 2, 2012),
(2, 21, 10, '30', 'pm', 16, 2, 2012),
(2, 21, 11, '30', 'pm', 16, 2, 2012),
(3, 16, 11, '00', 'pm', 16, 2, 2012),
(3, 16, 11, '30', 'pm', 16, 2, 2012),
(2, 21, 11, '00', 'pm', 16, 2, 2012),
(3, 17, 10, '30', 'pm', 16, 2, 2012),
(1, 18, 11, '00', 'pm', 16, 2, 2012),
(1, 23, 10, '30', 'pm', 16, 2, 2012),
(1, 23, 9, '00', 'pm', 15, 2, 2012),
(1, 23, 9, '30', 'pm', 15, 2, 2012),
(2, 20, 9, '00', 'pm', 15, 2, 2012);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page` varchar(40) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`creation_time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`creation_time`, `page`, `message`) VALUES
('2012-02-14 08:46:04', '/login.php', 'User (1) logged in.'),
('2012-02-14 08:49:15', '/login.php', 'User (1) logged in.'),
('2012-02-14 08:49:59', '/login.php', 'User (1) logged in.'),
('2012-02-14 08:50:46', '/logout.php', 'User (1) logged out.'),
('2012-02-14 08:52:43', '/signup.php', 'New user (test) signed up.'),
('2012-02-14 08:52:54', '/login.php', 'User (6) logged in.'),
('2012-02-14 09:01:41', '/logout.php', 'User (6) logged out.'),
('2012-02-14 09:01:48', '/login.php', 'User (5) logged in.'),
('2012-02-14 09:42:05', '/logout.php', 'User (5) logged out.'),
('2012-02-14 09:43:28', '/login.php', 'User (5) logged in.'),
('2012-02-14 09:43:33', '/logout.php', 'User (5) logged out.'),
('2012-02-14 09:43:44', '/login.php', 'User (1) logged in.'),
('2012-02-15 19:23:37', '/rmdb/signup.php', 'New user (Dexter7188) signed up.'),
('2012-02-15 19:24:04', '/rmdb/login.php', 'User (6) logged in.'),
('2012-02-16 07:33:58', '/rmdb/signup.php', 'New user (dexter) signed up.'),
('2012-02-16 07:34:07', '/rmdb/login.php', 'User (7) logged in.'),
('2012-02-16 19:33:33', '/rmdb/login.php', 'User (6) logged in.'),
('2012-02-17 00:43:10', '/rmdb/login.php', 'User (6) logged in.'),
('2012-02-24 00:51:03', '/rmdb/login.php', 'User (6) logged in.'),
('2012-02-28 04:45:10', '/rmdb/login.php', 'User (6) logged in.'),
('2012-03-03 05:20:50', '/signup.php', 'New user (omega) signed up.'),
('2012-03-03 05:24:09', '/signup.php', 'New user (gama) signed up.'),
('2012-03-03 05:27:25', '/signup.php', 'New user (burst) signed up.'),
('2012-03-03 05:30:03', '/signup.php', 'New user (nature) signed up.'),
('2012-03-03 08:16:16', '/signup.php', 'New user (test) signed up.'),
('2012-03-03 09:57:45', '/login.php', 'User (12) logged in.'),
('2012-03-03 09:58:01', '/logout.php', 'User (12) logged out.'),
('2012-03-03 10:10:41', '/login.php', 'User (12) logged in.'),
('2012-03-03 10:10:46', '/logout.php', 'User (12) logged out.'),
('2012-03-03 10:10:55', '/login.php', 'User (12) logged in.'),
('2012-03-03 10:15:27', '/logout.php', 'User (12) logged out.'),
('2012-03-03 10:15:44', '/login.php', 'User (12) logged in.'),
('2012-03-03 10:17:25', '/logout.php', 'User (12) logged out.'),
('2012-03-03 10:17:30', '/login.php', 'User (12) logged in.'),
('2012-03-03 10:18:22', '/logout.php', 'User (12) logged out.'),
('2012-03-03 11:51:45', '/login.php', 'User (12) logged in.'),
('2012-03-03 11:51:57', '/logout.php', 'User (12) logged out.'),
('2012-03-03 11:52:26', '/login.php', 'User (12) logged in.'),
('2012-03-03 11:52:31', '/logout.php', 'User (12) logged out.'),
('2012-03-03 12:02:12', '/login.php', 'User (12) logged in.'),
('2012-03-03 12:17:20', '/logout.php', 'User (12) logged out.'),
('2012-03-04 02:17:16', '/login.php', 'User (12) logged in.'),
('2012-03-04 02:24:00', '/logout.php', 'User (12) logged out.'),
('2012-03-04 04:36:39', '/signup.php', 'New user (sxenog) signed up.'),
('2012-03-04 04:36:47', '/login.php', 'User (14) logged in.'),
('2012-03-04 04:37:34', '/logout.php', 'User (14) logged out.'),
('2012-03-04 04:37:47', '/login.php', 'User (14) logged in.'),
('2012-03-04 04:38:11', '/logout.php', 'User (14) logged out.'),
('2012-03-04 04:49:22', '/login.php', 'User (14) logged in.'),
('2012-03-04 05:01:08', '/logout.php', 'User (14) logged out.'),
('2012-03-04 05:02:18', '/login.php', 'User (14) logged in.'),
('2012-03-04 05:04:12', '/logout.php', 'User (14) logged out.'),
('2012-03-04 05:04:18', '/login.php', 'User (14) logged in.'),
('2012-03-04 05:08:07', '/logout.php', 'User (14) logged out.'),
('2012-03-04 05:09:42', '/login.php', 'User (14) logged in.'),
('2012-03-04 05:09:45', '/logout.php', 'User (14) logged out.'),
('2012-03-04 05:10:21', '/signup.php', 'New user (Alpha) signed up.'),
('2012-03-04 05:10:30', '/login.php', 'User (15) logged in.'),
('2012-03-04 05:28:36', '/logout.php', 'User (15) logged out.'),
('2012-03-04 05:28:41', '/login.php', 'User (14) logged in.'),
('2012-03-04 05:31:03', '/logout.php', 'User (14) logged out.');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `date_of_birth` date NOT NULL,
  `job` enum('ACTOR','DIRECTOR','WRITER','PRODUCER') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `people_quotes`
--

CREATE TABLE IF NOT EXISTS `people_quotes` (
  `person_id` int(11) NOT NULL,
  `quote` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) NOT NULL,
  `url` varchar(60) NOT NULL,
  UNIQUE KEY `photo_id` (`pid`,`show_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table `popularity`
--

CREATE TABLE IF NOT EXISTS `popularity` (
  `show_id` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `popularity`
--

INSERT INTO `popularity` (`show_id`, `views`, `date`) VALUES
(43, 4, '2012-02-28'),
(23, 5, '2012-02-28'),
(22, 6, '2012-02-28'),
(22, 7, '2012-02-27'),
(3, 3, '2012-02-27'),
(40, 2, '2012-02-27'),
(1, 6, '2012-02-27'),
(5, 4, '2012-02-27'),
(12, 3, '2012-02-27'),
(43, 2, '2012-02-27'),
(43, 3, '2012-02-29'),
(1, 5, '2012-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `punbb_bans`
--

CREATE TABLE IF NOT EXISTS `punbb_bans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `expire` int(10) unsigned DEFAULT NULL,
  `ban_creator` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `punbb_categories`
--

CREATE TABLE IF NOT EXISTS `punbb_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(80) NOT NULL DEFAULT 'New Category',
  `disp_position` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `punbb_categories`
--

INSERT INTO `punbb_categories` (`id`, `cat_name`, `disp_position`) VALUES
(1, 'Test category', 1);

-- --------------------------------------------------------

--
-- Table structure for table `punbb_censoring`
--

CREATE TABLE IF NOT EXISTS `punbb_censoring` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `search_for` varchar(60) NOT NULL DEFAULT '',
  `replace_with` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `punbb_config`
--

CREATE TABLE IF NOT EXISTS `punbb_config` (
  `conf_name` varchar(255) NOT NULL DEFAULT '',
  `conf_value` text,
  PRIMARY KEY (`conf_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `punbb_config`
--

INSERT INTO `punbb_config` (`conf_name`, `conf_value`) VALUES
('o_cur_version', '1.4.2'),
('o_database_revision', '5'),
('o_board_title', 'My PunBB forum'),
('o_board_desc', 'Unfortunately no one can be told what PunBB is — you have to see it for yourself'),
('o_default_timezone', '0'),
('o_time_format', 'H:i:s'),
('o_date_format', 'Y-m-d'),
('o_check_for_updates', '1'),
('o_check_for_versions', '1'),
('o_timeout_visit', '5400'),
('o_timeout_online', '300'),
('o_redirect_delay', '0'),
('o_show_version', '0'),
('o_show_user_info', '1'),
('o_show_post_count', '1'),
('o_signatures', '1'),
('o_smilies', '1'),
('o_smilies_sig', '1'),
('o_make_links', '1'),
('o_default_lang', 'English'),
('o_default_style', 'Oxygen'),
('o_default_user_group', '3'),
('o_topic_review', '15'),
('o_disp_topics_default', '30'),
('o_disp_posts_default', '25'),
('o_indent_num_spaces', '4'),
('o_quote_depth', '3'),
('o_quickpost', '1'),
('o_users_online', '1'),
('o_censoring', '0'),
('o_ranks', '1'),
('o_show_dot', '0'),
('o_topic_views', '1'),
('o_quickjump', '1'),
('o_gzip', '0'),
('o_additional_navlinks', ''),
('o_report_method', '0'),
('o_regs_report', '0'),
('o_default_email_setting', '1'),
('o_mailing_list', 'sxenog@gmail.com'),
('o_avatars', '1'),
('o_avatars_dir', 'img/avatars'),
('o_avatars_width', '60'),
('o_avatars_height', '60'),
('o_avatars_size', '15360'),
('o_search_all_forums', '1'),
('o_sef', 'Default'),
('o_admin_email', 'sxenog@gmail.com'),
('o_webmaster_email', 'sxenog@gmail.com'),
('o_subscriptions', '1'),
('o_smtp_host', NULL),
('o_smtp_user', NULL),
('o_smtp_pass', NULL),
('o_smtp_ssl', '0'),
('o_regs_allow', '1'),
('o_regs_verify', '0'),
('o_announcement', '0'),
('o_announcement_heading', 'Sample announcement'),
('o_announcement_message', '<p>Enter your announcement here.</p>'),
('o_rules', '0'),
('o_rules_message', 'Enter your rules here.'),
('o_maintenance', '0'),
('o_maintenance_message', 'The forums are temporarily down for maintenance. Please try again in a few minutes.<br /><br />Administrator'),
('o_default_dst', '0'),
('p_message_bbcode', '1'),
('p_message_img_tag', '1'),
('p_message_all_caps', '1'),
('p_subject_all_caps', '1'),
('p_sig_all_caps', '1'),
('p_sig_bbcode', '1'),
('p_sig_img_tag', '0'),
('p_sig_length', '400'),
('p_sig_lines', '4'),
('p_allow_banned_email', '1'),
('p_allow_dupe_email', '0'),
('p_force_guest_email', '1'),
('o_show_moderators', '0'),
('o_mask_passwords', '1');

-- --------------------------------------------------------

--
-- Table structure for table `punbb_extensions`
--

CREATE TABLE IF NOT EXISTS `punbb_extensions` (
  `id` varchar(150) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `version` varchar(25) NOT NULL DEFAULT '',
  `description` text,
  `author` varchar(50) NOT NULL DEFAULT '',
  `uninstall` text,
  `uninstall_note` text,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `dependencies` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `punbb_extension_hooks`
--

CREATE TABLE IF NOT EXISTS `punbb_extension_hooks` (
  `id` varchar(150) NOT NULL DEFAULT '',
  `extension_id` varchar(50) NOT NULL DEFAULT '',
  `code` text,
  `installed` int(10) unsigned NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`,`extension_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `punbb_forums`
--

CREATE TABLE IF NOT EXISTS `punbb_forums` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `forum_name` varchar(80) NOT NULL DEFAULT 'New forum',
  `forum_desc` text,
  `redirect_url` varchar(100) DEFAULT NULL,
  `moderators` text,
  `num_topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `num_posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `last_post` int(10) unsigned DEFAULT NULL,
  `last_post_id` int(10) unsigned DEFAULT NULL,
  `last_poster` varchar(200) DEFAULT NULL,
  `sort_by` tinyint(1) NOT NULL DEFAULT '0',
  `disp_position` int(10) NOT NULL DEFAULT '0',
  `cat_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `punbb_forums`
--

INSERT INTO `punbb_forums` (`id`, `forum_name`, `forum_desc`, `redirect_url`, `moderators`, `num_topics`, `num_posts`, `last_post`, `last_post_id`, `last_poster`, `sort_by`, `disp_position`, `cat_id`) VALUES
(1, 'Test forum', 'This is just a test forum', NULL, NULL, 3, 7, 1330837859, 7, 'Alpha', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `punbb_forum_perms`
--

CREATE TABLE IF NOT EXISTS `punbb_forum_perms` (
  `group_id` int(10) NOT NULL DEFAULT '0',
  `forum_id` int(10) NOT NULL DEFAULT '0',
  `read_forum` tinyint(1) NOT NULL DEFAULT '1',
  `post_replies` tinyint(1) NOT NULL DEFAULT '1',
  `post_topics` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`group_id`,`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `punbb_forum_subscriptions`
--

CREATE TABLE IF NOT EXISTS `punbb_forum_subscriptions` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `punbb_groups`
--

CREATE TABLE IF NOT EXISTS `punbb_groups` (
  `g_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g_title` varchar(50) NOT NULL DEFAULT '',
  `g_user_title` varchar(50) DEFAULT NULL,
  `g_moderator` tinyint(1) NOT NULL DEFAULT '0',
  `g_mod_edit_users` tinyint(1) NOT NULL DEFAULT '0',
  `g_mod_rename_users` tinyint(1) NOT NULL DEFAULT '0',
  `g_mod_change_passwords` tinyint(1) NOT NULL DEFAULT '0',
  `g_mod_ban_users` tinyint(1) NOT NULL DEFAULT '0',
  `g_read_board` tinyint(1) NOT NULL DEFAULT '1',
  `g_view_users` tinyint(1) NOT NULL DEFAULT '1',
  `g_post_replies` tinyint(1) NOT NULL DEFAULT '1',
  `g_post_topics` tinyint(1) NOT NULL DEFAULT '1',
  `g_edit_posts` tinyint(1) NOT NULL DEFAULT '1',
  `g_delete_posts` tinyint(1) NOT NULL DEFAULT '1',
  `g_delete_topics` tinyint(1) NOT NULL DEFAULT '1',
  `g_set_title` tinyint(1) NOT NULL DEFAULT '1',
  `g_search` tinyint(1) NOT NULL DEFAULT '1',
  `g_search_users` tinyint(1) NOT NULL DEFAULT '1',
  `g_send_email` tinyint(1) NOT NULL DEFAULT '1',
  `g_post_flood` smallint(6) NOT NULL DEFAULT '30',
  `g_search_flood` smallint(6) NOT NULL DEFAULT '30',
  `g_email_flood` smallint(6) NOT NULL DEFAULT '60',
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `punbb_groups`
--

INSERT INTO `punbb_groups` (`g_id`, `g_title`, `g_user_title`, `g_moderator`, `g_mod_edit_users`, `g_mod_rename_users`, `g_mod_change_passwords`, `g_mod_ban_users`, `g_read_board`, `g_view_users`, `g_post_replies`, `g_post_topics`, `g_edit_posts`, `g_delete_posts`, `g_delete_topics`, `g_set_title`, `g_search`, `g_search_users`, `g_send_email`, `g_post_flood`, `g_search_flood`, `g_email_flood`) VALUES
(1, 'Administrators', 'Administrator', 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0),
(2, 'Guest', NULL, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 60, 30, 0),
(3, 'Members', NULL, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 60, 30, 60),
(4, 'Moderators', 'Moderator', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `punbb_online`
--

CREATE TABLE IF NOT EXISTS `punbb_online` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `ident` varchar(200) NOT NULL DEFAULT '',
  `logged` int(10) unsigned NOT NULL DEFAULT '0',
  `idle` tinyint(1) NOT NULL DEFAULT '0',
  `csrf_token` varchar(40) NOT NULL DEFAULT '',
  `prev_url` varchar(255) DEFAULT NULL,
  `last_post` int(10) unsigned DEFAULT NULL,
  `last_search` int(10) unsigned DEFAULT NULL,
  UNIQUE KEY `punbb_online_user_id_ident_idx` (`user_id`,`ident`(25)),
  KEY `punbb_online_ident_idx` (`ident`(25)),
  KEY `punbb_online_logged_idx` (`logged`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

--
-- Dumping data for table `punbb_online`
--

INSERT INTO `punbb_online` (`user_id`, `ident`, `logged`, `idle`, `csrf_token`, `prev_url`, `last_post`, `last_search`) VALUES
(1, '::1', 1330839063, 0, '1f11d21300040c02cf85552ddfc54af71f92fe1a', 'http://localhost/punbb/viewtopic.php?id=3', NULL, NULL),
(2, 'sxenog', 1330835312, 1, 'e2f08f8f2869aefe452f56c0cddf54e50dd825ad', 'http://localhost/punbb/viewtopic.php?pid=2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `punbb_posts`
--

CREATE TABLE IF NOT EXISTS `punbb_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `poster` varchar(200) NOT NULL DEFAULT '',
  `poster_id` int(10) unsigned NOT NULL DEFAULT '1',
  `poster_ip` varchar(39) DEFAULT NULL,
  `poster_email` varchar(80) DEFAULT NULL,
  `message` text,
  `hide_smilies` tinyint(1) NOT NULL DEFAULT '0',
  `posted` int(10) unsigned NOT NULL DEFAULT '0',
  `edited` int(10) unsigned DEFAULT NULL,
  `edited_by` varchar(200) DEFAULT NULL,
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `punbb_posts_topic_id_idx` (`topic_id`),
  KEY `punbb_posts_multi_idx` (`poster_id`,`topic_id`),
  KEY `punbb_posts_posted_idx` (`posted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `punbb_posts`
--

INSERT INTO `punbb_posts` (`id`, `poster`, `poster_id`, `poster_ip`, `poster_email`, `message`, `hide_smilies`, `posted`, `edited`, `edited_by`, `topic_id`) VALUES
(1, 'sxenog', 2, '127.0.0.1', NULL, 'If you are looking at this (which I guess you are), the install of PunBB appears to have worked! Now log in and head over to the administration control panel to configure your forum.', 0, 1330664199, NULL, NULL, 1),
(2, 'sxenog', 2, '::1', NULL, 'I WIN', 0, 1330834317, NULL, NULL, 2),
(3, 'sxenog', 14, '::1', NULL, 'test', 0, 1330837567, NULL, NULL, 2),
(4, 'sxenog', 14, '::1', NULL, 'ZOMG WOOSH', 0, 1330837648, NULL, NULL, 3),
(5, 'sxenog', 14, '::1', NULL, 'I dont really know what just happened.', 0, 1330837663, NULL, NULL, 3),
(6, 'sxenog', 14, '::1', NULL, 'help me!', 0, 1330837681, NULL, NULL, 3),
(7, 'Alpha', 15, '::1', NULL, 'I''ll join the party too.', 0, 1330837859, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `punbb_ranks`
--

CREATE TABLE IF NOT EXISTS `punbb_ranks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rank` varchar(50) NOT NULL DEFAULT '',
  `min_posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `punbb_ranks`
--

INSERT INTO `punbb_ranks` (`id`, `rank`, `min_posts`) VALUES
(1, 'New member', 0),
(2, 'Member', 10);

-- --------------------------------------------------------

--
-- Table structure for table `punbb_reports`
--

CREATE TABLE IF NOT EXISTS `punbb_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_id` int(10) unsigned NOT NULL DEFAULT '0',
  `reported_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `message` text,
  `zapped` int(10) unsigned DEFAULT NULL,
  `zapped_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `punbb_reports_zapped_idx` (`zapped`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `punbb_search_cache`
--

CREATE TABLE IF NOT EXISTS `punbb_search_cache` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `ident` varchar(200) NOT NULL DEFAULT '',
  `search_data` text,
  PRIMARY KEY (`id`),
  KEY `punbb_search_cache_ident_idx` (`ident`(8))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `punbb_search_cache`
--

INSERT INTO `punbb_search_cache` (`id`, `ident`, `search_data`) VALUES
(1582248464, 'sxenog', 'a:4:{s:14:"search_results";s:3:"1,2";s:7:"sort_by";N;s:8:"sort_dir";s:4:"DESC";s:7:"show_as";s:5:"posts";}');

-- --------------------------------------------------------

--
-- Table structure for table `punbb_search_matches`
--

CREATE TABLE IF NOT EXISTS `punbb_search_matches` (
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `word_id` int(10) unsigned NOT NULL DEFAULT '0',
  `subject_match` tinyint(1) NOT NULL DEFAULT '0',
  KEY `punbb_search_matches_word_id_idx` (`word_id`),
  KEY `punbb_search_matches_post_id_idx` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `punbb_search_matches`
--

INSERT INTO `punbb_search_matches` (`post_id`, `word_id`, `subject_match`) VALUES
(1, 1, 0),
(1, 2, 0),
(1, 3, 0),
(1, 4, 0),
(1, 5, 0),
(1, 6, 0),
(1, 7, 0),
(1, 8, 0),
(1, 9, 0),
(1, 10, 0),
(1, 11, 0),
(1, 12, 0),
(1, 13, 0),
(1, 14, 0),
(1, 15, 0),
(1, 16, 0),
(1, 17, 0),
(1, 18, 0),
(1, 19, 0),
(1, 20, 0),
(1, 21, 0),
(1, 22, 0),
(1, 23, 0),
(1, 25, 1),
(1, 24, 1),
(2, 26, 0),
(2, 24, 1),
(2, 27, 1),
(3, 24, 0),
(4, 29, 0),
(4, 28, 0),
(4, 24, 1),
(4, 27, 1),
(5, 30, 0),
(6, 31, 0),
(7, 32, 0),
(7, 33, 0),
(7, 34, 0);

-- --------------------------------------------------------

--
-- Table structure for table `punbb_search_words`
--

CREATE TABLE IF NOT EXISTS `punbb_search_words` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`word`),
  KEY `punbb_search_words_id_idx` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `punbb_search_words`
--

INSERT INTO `punbb_search_words` (`id`, `word`) VALUES
(1, 'you'),
(2, 'are'),
(3, 'looking'),
(4, 'this'),
(5, 'which'),
(6, 'guess'),
(7, 'the'),
(8, 'install'),
(9, 'punbb'),
(10, 'appears'),
(11, 'have'),
(12, 'worked'),
(13, 'now'),
(14, 'log'),
(15, 'and'),
(16, 'head'),
(17, 'over'),
(18, 'administration'),
(19, 'control'),
(20, 'panel'),
(21, 'configure'),
(22, 'your'),
(23, 'forum'),
(24, 'test'),
(25, 'post'),
(26, 'win'),
(27, 'topic'),
(28, 'zomg'),
(29, 'woosh'),
(30, 'happened'),
(31, 'help'),
(32, 'i''ll'),
(33, 'join'),
(34, 'party');

-- --------------------------------------------------------

--
-- Table structure for table `punbb_subscriptions`
--

CREATE TABLE IF NOT EXISTS `punbb_subscriptions` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `punbb_topics`
--

CREATE TABLE IF NOT EXISTS `punbb_topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `poster` varchar(200) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `posted` int(10) unsigned NOT NULL DEFAULT '0',
  `first_post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `last_post` int(10) unsigned NOT NULL DEFAULT '0',
  `last_post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `last_poster` varchar(200) DEFAULT NULL,
  `num_views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `num_replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `moved_to` int(10) unsigned DEFAULT NULL,
  `forum_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `punbb_topics_forum_id_idx` (`forum_id`),
  KEY `punbb_topics_moved_to_idx` (`moved_to`),
  KEY `punbb_topics_last_post_idx` (`last_post`),
  KEY `punbb_topics_first_post_id_idx` (`first_post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `punbb_topics`
--

INSERT INTO `punbb_topics` (`id`, `poster`, `subject`, `posted`, `first_post_id`, `last_post`, `last_post_id`, `last_poster`, `num_views`, `num_replies`, `closed`, `sticky`, `moved_to`, `forum_id`) VALUES
(1, 'sxenog', 'Test post', 1330664199, 1, 1330664199, 1, 'sxenog', 8, 0, 0, 0, NULL, 1),
(2, 'sxenog', 'Test Topic 2', 1330834317, 2, 1330837567, 3, 'sxenog', 25, 1, 0, 0, NULL, 1),
(3, 'sxenog', 'Test Topic 3', 1330837648, 4, 1330837859, 7, 'Alpha', 16, 3, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `punbb_users`
--

CREATE TABLE IF NOT EXISTS `punbb_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL DEFAULT '3',
  `username` varchar(200) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `salt` varchar(12) DEFAULT NULL,
  `email` varchar(80) NOT NULL DEFAULT '',
  `title` varchar(50) DEFAULT NULL,
  `realname` varchar(40) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `skype` varchar(100) DEFAULT NULL,
  `jabber` varchar(80) DEFAULT NULL,
  `icq` varchar(12) DEFAULT NULL,
  `msn` varchar(80) DEFAULT NULL,
  `aim` varchar(30) DEFAULT NULL,
  `yahoo` varchar(30) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `signature` text,
  `disp_topics` tinyint(3) unsigned DEFAULT NULL,
  `disp_posts` tinyint(3) unsigned DEFAULT NULL,
  `email_setting` tinyint(1) NOT NULL DEFAULT '1',
  `notify_with_post` tinyint(1) NOT NULL DEFAULT '0',
  `auto_notify` tinyint(1) NOT NULL DEFAULT '0',
  `show_smilies` tinyint(1) NOT NULL DEFAULT '1',
  `show_img` tinyint(1) NOT NULL DEFAULT '1',
  `show_img_sig` tinyint(1) NOT NULL DEFAULT '1',
  `show_avatars` tinyint(1) NOT NULL DEFAULT '1',
  `show_sig` tinyint(1) NOT NULL DEFAULT '1',
  `access_keys` tinyint(1) NOT NULL DEFAULT '0',
  `timezone` float NOT NULL DEFAULT '0',
  `dst` tinyint(1) NOT NULL DEFAULT '0',
  `time_format` int(10) unsigned NOT NULL DEFAULT '0',
  `date_format` int(10) unsigned NOT NULL DEFAULT '0',
  `language` varchar(25) NOT NULL DEFAULT 'English',
  `style` varchar(25) NOT NULL DEFAULT 'Oxygen',
  `num_posts` int(10) unsigned NOT NULL DEFAULT '0',
  `last_post` int(10) unsigned DEFAULT NULL,
  `last_search` int(10) unsigned DEFAULT NULL,
  `last_email_sent` int(10) unsigned DEFAULT NULL,
  `registered` int(10) unsigned NOT NULL DEFAULT '0',
  `registration_ip` varchar(39) NOT NULL DEFAULT '0.0.0.0',
  `last_visit` int(10) unsigned NOT NULL DEFAULT '0',
  `admin_note` varchar(30) DEFAULT NULL,
  `activate_string` varchar(80) DEFAULT NULL,
  `activate_key` varchar(8) DEFAULT NULL,
  `avatar` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `avatar_width` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `avatar_height` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `punbb_users_registered_idx` (`registered`),
  KEY `punbb_users_username_idx` (`username`(8))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `punbb_users`
--

INSERT INTO `punbb_users` (`id`, `group_id`, `username`, `password`, `salt`, `email`, `title`, `realname`, `url`, `facebook`, `twitter`, `linkedin`, `skype`, `jabber`, `icq`, `msn`, `aim`, `yahoo`, `location`, `signature`, `disp_topics`, `disp_posts`, `email_setting`, `notify_with_post`, `auto_notify`, `show_smilies`, `show_img`, `show_img_sig`, `show_avatars`, `show_sig`, `access_keys`, `timezone`, `dst`, `time_format`, `date_format`, `language`, `style`, `num_posts`, `last_post`, `last_search`, `last_email_sent`, `registered`, `registration_ip`, `last_visit`, `admin_note`, `activate_string`, `activate_key`, `avatar`, `avatar_width`, `avatar_height`) VALUES
(1, 2, 'Guest', 'Guest', NULL, 'Guest', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 'English', 'Oxygen', 0, NULL, NULL, NULL, 0, '0.0.0.0', 0, NULL, NULL, NULL, 0, 0, 0),
(15, 3, 'Alpha', '90fb34b28319c707f0f5f82aad29d0d1243d8d83', '/?j(#U:E^-EF', 'alpha@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 'English', 'Oxygen', 1, 1330837859, NULL, NULL, 1330837821, '::1', 1330837821, NULL, NULL, '', 0, 0, 0),
(14, 1, 'sxenog', '03dbe2a0457e51a04f3a3aaefd846e475b810ad7', '-eZoa:t&"_&j', 'sxenog@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 'English', 'Oxygen', 4, 1330837681, 1330837472, NULL, 1330835799, '::1', 1330835799, NULL, NULL, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE IF NOT EXISTS `quotes` (
  `qid` int(11) NOT NULL  AUTO_INCREMENT,
  `show_id` int(11) NOT NULL,
  `quote` text NOT NULL,
  UNIQUE KEY `quote_id` (`qid`,`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`user_id`, `show_id`, `rating`) VALUES
(6, 40, 5),
(6, 1, 3),
(6, 7, 4),
(6, 5, 5),
(6, 43, 5);

-- --------------------------------------------------------

--
-- Table structure for table `recaps`
--

CREATE TABLE IF NOT EXISTS `recaps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `recaps`
--

INSERT INTO `recaps` (`id`, `show_id`, `user_id`, `content`) VALUES
(1, 16, 1, 'The last episode was really great. All of the main characters managed to stay alive, so there was very little to be disappointed about.'),
(2, 16, 3, 'All of the main characters died, as was expected at the end of the previous episode.'),
(3, 17, 1, 'In this week''s episode, Terrance and Phillip face heart wrenching difficulties as their doctor tells them they have colon cancer.'),
(5, 17, 6, 'Terrance and Phillip got cancer. Will they ever be able to fart again?');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `review` text NOT NULL,
  UNIQUE KEY `user_id` (`user_id`,`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`user_id`, `show_id`, `review`) VALUES
(6, 40, 'Fucking delicious.');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE IF NOT EXISTS `shows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `release_date` date NOT NULL,
  `popularity` int(11) NOT NULL,
  `url` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL,
  `studio` varchar(30) NOT NULL,
  `type` enum('MOVIE','TV') NOT NULL,
  `avg_rating` int(11) NOT NULL,
  `genre` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `name_2` (`name`,`release_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`id`, `name`, `release_date`, `popularity`, `url`, `description`, `studio`, `type`, `avg_rating`, `genre`) VALUES
(1, 'The Grey', '2012-01-27', 5, 'img/thegrey.jpg', 'In Alaska, an oil drilling team struggle to survive after a plane crash strands them in the wild. Hunting the humans are a pack of wolves who see them as intruders. ', 'Mr. Studio', 'MOVIE', 3, ''),
(2, 'The Girl with the Dragon Tattoo', '2011-12-20', 5, 'img/girldragontattoo.jpg', 'Journalist Mikael Blomkvist is aided in his search for a woman who has been missing for forty years by Lisbeth Salander, a young computer hacker. ', 'Mr. Studio', 'MOVIE', 0, ''),
(3, 'MovieA', '2012-01-27', 5, 'img/MovieA.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(4, 'MovieB', '2012-02-27', 3, 'img/MovieB.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(5, 'MovieC', '2012-03-27', 5, 'img/MovieC.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 5, ''),
(6, 'MovieD', '2012-04-27', 5, 'img/MovieD.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(7, 'MovieE', '2012-05-27', 5, 'img/MovieE.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 4, ''),
(8, 'MovieF', '2012-06-27', 5, 'img/MovieF.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(9, 'MovieG', '2012-07-27', 3, 'img/MovieG.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(10, 'MovieH', '2012-04-27', 5, 'img/MovieD.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(11, 'MovieI', '2012-05-27', 5, 'img/MovieE.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(12, 'MovieJ', '2012-06-27', 5, 'img/MovieF.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(13, 'MovieK', '2012-07-27', 5, 'img/MovieG.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(14, 'MovieL', '2012-02-27', 2, 'img/MovieB.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(15, 'MovieM', '2012-03-27', 5, 'img/MovieC.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'MOVIE', 0, ''),
(16, 'ShowA', '2012-01-27', 5, 'img/MovieA.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(17, 'ShowB', '2012-01-27', 5, 'img/MovieB.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(18, 'The IT Crowd', '2012-06-27', 5, 'img/MovieF.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(19, 'How I Met Your Mother', '2012-07-27', 5, 'img/MovieG.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(20, 'The Big Bang Theory', '2012-02-27', 2, 'img/MovieB.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(21, 'That 70s Show', '2012-03-27', 5, 'img/MovieC.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(22, 'Desperate Housewives', '2012-04-27', 5, 'img/MovieD.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(23, 'Arrested Development', '2012-05-27', 5, 'img/MovieE.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eget purus est, quis ullamcorper urna. ', 'Mr. Studio', 'TV', 0, ''),
(40, 'Game of Thrones', '2011-04-17', 0, 'img/MovieA.png', 'Game of Thrones is an American medieval fantasy television series created for HBO by David Benioff and D. B. Weiss. ', 'HBO', 'TV', 5, ''),
(43, 'Bakemonogatari', '2009-07-03', 0, 'img/thegrey.jpg', 'Bakemonogatari centers on Koyomi Araragi, a third year high school student who is almost human again after briefly becoming a vampire.', 'SHAFT', 'TV', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `show_info`
--

CREATE TABLE IF NOT EXISTS `show_info` (
  `show_id` int(11) NOT NULL,
  `director` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `show_times`
--

CREATE TABLE IF NOT EXISTS `show_times` (
  `theater_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `day` date NOT NULL,
  `time` time NOT NULL,
  UNIQUE KEY `theater_id` (`theater_id`,`show_id`,`day`,`time`),
  UNIQUE KEY `theater_id_2` (`theater_id`,`show_id`,`day`,`time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `show_times`
--

INSERT INTO `show_times` (`theater_id`, `show_id`, `day`, `time`) VALUES
(1, 1, '2012-02-16', '00:00:00'),
(1, 1, '2012-02-16', '10:00:00'),
(1, 1, '2012-02-16', '11:00:00'),
(1, 1, '2012-02-17', '00:00:00'),
(1, 1, '2012-02-17', '01:00:00'),
(1, 1, '2012-02-17', '02:00:00'),
(1, 1, '2012-02-17', '03:00:00'),
(1, 1, '2012-02-17', '04:00:00'),
(1, 1, '2012-02-17', '05:00:00'),
(1, 1, '2012-02-18', '06:30:00'),
(1, 1, '2012-02-18', '07:30:00'),
(1, 1, '2012-02-18', '08:30:00'),
(1, 1, '2012-02-18', '09:30:00'),
(1, 1, '2012-02-18', '10:30:00'),
(1, 1, '2012-02-18', '11:30:00'),
(1, 1, '2012-02-19', '07:30:00'),
(1, 1, '2012-02-19', '12:30:00'),
(1, 1, '2012-02-19', '20:30:00'),
(1, 1, '2012-02-19', '23:30:00'),
(1, 1, '2012-02-20', '12:30:00'),
(1, 1, '2012-02-20', '13:30:00'),
(1, 1, '2012-02-20', '14:30:00'),
(1, 1, '2012-02-20', '15:30:00'),
(1, 1, '2012-02-20', '16:30:00'),
(1, 1, '2012-02-20', '17:30:00'),
(1, 2, '2012-02-16', '00:30:00'),
(1, 2, '2012-02-16', '11:30:00'),
(1, 2, '2012-02-16', '13:30:00'),
(1, 2, '2012-02-17', '06:00:00'),
(1, 2, '2012-02-17', '07:00:00'),
(1, 2, '2012-02-17', '08:00:00'),
(1, 2, '2012-02-17', '09:00:00'),
(1, 2, '2012-02-17', '10:00:00'),
(1, 2, '2012-02-18', '06:30:00'),
(1, 2, '2012-02-18', '07:30:00'),
(1, 2, '2012-02-18', '08:30:00'),
(1, 2, '2012-02-18', '09:30:00'),
(1, 2, '2012-02-18', '10:30:00'),
(1, 2, '2012-02-18', '11:30:00'),
(1, 2, '2012-02-19', '07:30:00'),
(1, 2, '2012-02-19', '08:30:00'),
(1, 2, '2012-02-19', '09:30:00'),
(1, 2, '2012-02-19', '10:30:00'),
(1, 2, '2012-02-19', '11:30:00'),
(1, 2, '2012-02-20', '13:30:00'),
(1, 2, '2012-02-20', '14:30:00'),
(1, 2, '2012-02-20', '15:30:00'),
(1, 2, '2012-02-20', '16:30:00'),
(1, 2, '2012-02-20', '17:30:00'),
(2, 1, '2012-02-16', '15:30:00'),
(2, 1, '2012-02-16', '16:30:00'),
(2, 1, '2012-02-16', '17:30:00'),
(2, 1, '2012-02-16', '18:30:00'),
(2, 1, '2012-02-16', '19:30:00'),
(2, 1, '2012-02-16', '20:30:00'),
(2, 1, '2012-02-17', '09:05:00'),
(2, 1, '2012-02-17', '10:05:00'),
(2, 1, '2012-02-17', '11:05:00'),
(2, 1, '2012-02-17', '12:05:00'),
(2, 1, '2012-02-17', '13:05:00'),
(2, 1, '2012-02-17', '14:05:00'),
(2, 1, '2012-02-17', '15:05:00'),
(2, 1, '2012-02-18', '13:05:00'),
(2, 1, '2012-02-18', '14:05:00'),
(2, 1, '2012-02-18', '15:05:00'),
(2, 1, '2012-02-18', '16:05:00'),
(2, 1, '2012-02-18', '17:05:00'),
(2, 1, '2012-02-18', '18:05:00'),
(2, 1, '2012-02-19', '00:05:00'),
(2, 1, '2012-02-19', '01:05:00'),
(2, 1, '2012-02-19', '12:05:00'),
(2, 1, '2012-02-19', '19:05:00'),
(2, 1, '2012-02-19', '20:05:00'),
(2, 1, '2012-02-19', '21:05:00'),
(2, 1, '2012-02-19', '22:05:00'),
(2, 1, '2012-02-19', '23:05:00'),
(2, 1, '2012-02-20', '11:05:00'),
(2, 1, '2012-02-20', '12:05:00'),
(2, 1, '2012-02-20', '13:05:00'),
(2, 1, '2012-02-20', '14:05:00'),
(2, 1, '2012-02-20', '15:05:00'),
(2, 1, '2012-02-20', '16:05:00'),
(2, 1, '2012-02-20', '17:05:00'),
(2, 2, '2012-02-16', '09:30:00'),
(2, 2, '2012-02-16', '10:30:00'),
(2, 2, '2012-02-16', '11:30:00'),
(2, 2, '2012-02-16', '12:30:00'),
(2, 2, '2012-02-16', '13:30:00'),
(2, 2, '2012-02-16', '14:30:00'),
(2, 2, '2012-02-17', '15:05:00'),
(2, 2, '2012-02-17', '16:05:00'),
(2, 2, '2012-02-17', '17:05:00'),
(2, 2, '2012-02-17', '18:05:00'),
(2, 2, '2012-02-18', '07:05:00'),
(2, 2, '2012-02-18', '08:05:00'),
(2, 2, '2012-02-18', '09:05:00'),
(2, 2, '2012-02-18', '10:05:00'),
(2, 2, '2012-02-18', '11:05:00'),
(2, 2, '2012-02-18', '12:05:00'),
(2, 2, '2012-02-19', '00:05:00'),
(2, 2, '2012-02-19', '01:05:00'),
(2, 2, '2012-02-19', '02:05:00'),
(2, 2, '2012-02-19', '03:05:00'),
(2, 2, '2012-02-19', '04:05:00'),
(2, 2, '2012-02-19', '05:05:00'),
(2, 2, '2012-02-19', '06:05:00'),
(2, 2, '2012-02-20', '06:05:00'),
(2, 2, '2012-02-20', '07:05:00'),
(2, 2, '2012-02-20', '08:05:00'),
(2, 2, '2012-02-20', '09:05:00'),
(2, 2, '2012-02-20', '10:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE IF NOT EXISTS `social` (
  `show_id` int(11) NOT NULL,
  `google` tinyint(1) NOT NULL,
  `twitter` tinyint(1) NOT NULL,
  `facebook` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`show_id`, `google`, `twitter`, `facebook`) VALUES
(3, 1, 0, 0),
(5, 1, 1, 1),
(23, 1, 0, 0),
(43, 1, 1, 1),
(40, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE IF NOT EXISTS `theaters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL DEFAULT '-1',
  `name` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `city` varchar(60) NOT NULL,
  `state` varchar(2) NOT NULL,
  `address` varchar(80) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`id`, `owner_id`, `name`, `phone_number`, `city`, `state`, `address`, `zipcode`, `lat`, `lng`) VALUES
(1, 1, 'Harkins Moreno Valley 16', '', 'Moreno Valley', 'CA', ' 22500 Town Circle', 92553, 33.938606, -117.271416),
(2, -1, 'Mission Grove Theaters', '', 'Riverside', 'CA', '121 East Alessandro', 92508, 33.914715, -117.329994);

-- --------------------------------------------------------

--
-- Table structure for table `trailers`
--

CREATE TABLE IF NOT EXISTS `trailers` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) NOT NULL,
  `url` varchar(60) NOT NULL,
  UNIQUE KEY `trailer_id` (`tid`,`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Dumping data for table `trailers`
--

INSERT INTO `trailers` (`tid`, `show_id`, `url`) VALUES
(1, 1, 'http://www.youtube.com/embed/eUP5Vr0lBvY'),
(1, 2, 'http://www.youtube.com/embed/RL8LI-h2WFc');

-- --------------------------------------------------------

--
-- Table structure for table `trivia`
--

CREATE TABLE IF NOT EXISTS `trivia` (
  `trivia_id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` int(11) NOT NULL,
  `fact` text NOT NULL,
  UNIQUE KEY `t_id` (`trivia_id`,`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------
--
-- Table structure for table `celeb_trivia`
--

CREATE TABLE IF NOT EXISTS `celeb_trivia` (
  `trivia_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `fact` text NOT NULL,
  UNIQUE KEY `t_id` (`trivia_id`,`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- --------------------------------------------------------
--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `alias` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `critic` enum('Y','N') NOT NULL DEFAULT 'N',
  `level` enum('USER','SUPER_USER','ADMINISTRATOR') NOT NULL DEFAULT 'USER',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `alias`, `password`, `critic`, `level`) VALUES
(13, 'guest@guest.com', 'Guest', 'kjhkhjhjhhjgjkhhjkhjkhkjjk', 'N', 'USER'),
(14, 'sxenog@gmail.com', 'sxenog', '6b7a4d7820dd1335cfcfa9fe064139dd4ce3a7aa', 'Y', 'USER'),
(15, 'alpha@gmail.com', 'Alpha', 'c9dee8cb6d7b303e6860229aa6dd6bab4227ed64', 'Y', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `watchlists`
--

CREATE TABLE IF NOT EXISTS `watchlists` (
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `watchlists`
--

INSERT INTO `watchlists` (`user_id`, `show_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(6, 6),
(6, 4),
(6, 1),
(6, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cast_and_crew`
--
ALTER TABLE `cast_and_crew`
  ADD CONSTRAINT `cast_and_crew_ibfk_1` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cast_and_crew_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cast_and_crew_ibfk_3` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
