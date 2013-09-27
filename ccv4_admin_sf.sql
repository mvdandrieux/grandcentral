-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2013 at 02:28 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ccv4_admin_sf`
--

-- --------------------------------------------------------

--
-- Table structure for table `const`
--

CREATE TABLE `const` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'title',
  `version` mediumint(3) unsigned NOT NULL,
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`),
  KEY `version` (`version`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=62 ;

--
-- Dumping data for table `const`
--

INSERT INTO `const` (`id`, `key`, `title`, `version`, `created`, `updated`, `status`) VALUES
(1, 'OPENALL', 'Open all', 1, '0000-00-00 00:00:00', '2013-05-17 11:29:44', 'trash'),
(2, 'NAVCC_SEARCH_NODATA', 'Try searching something, I''m ready.', 1, '0000-00-00 00:00:00', '2013-03-27 15:08:29', 'live'),
(3, 'NAVCC_SEARCH_PLACEHOLDER', 'Search for items, people, anything.', 1, '0000-00-00 00:00:00', '2013-08-14 01:10:33', 'live'),
(4, 'OPTION_FILTER_REFINE', 'Refine', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(6, 'MULTIPLESELECT_AVAILABLE_LABEL', 'Available', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(7, 'MULTIPLESELECT_SELECTED_LABEL', 'Selected', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(8, 'MULTIPLESELECT_SELECTED_NODATA', 'Why don''t you try and drag something here?', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(9, 'ADMIN_ZONING_ZONE_NODATA', 'Dammit, no zone. That''s impossimpible!', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(10, 'ZONING_SELECTED_NODATA', 'This zone has no section', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(11, 'ZONING_SELECTED_BUBBLE', 'Mine! Mine!', 1, '0000-00-00 00:00:00', '2013-03-22 14:49:01', 'live'),
(12, 'ZONING_AVAILABLE_LABEL', 'Apps', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(13, 'ZONING_LEGEND', 'This zoning shows the zones and sections. Change your code, this preview will follow.', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(14, 'ZONING_AVAILABLE_SEARCH_PLACEHOLDER', 'Search', 1, '2013-01-23 11:13:49', '2013-01-23 11:13:49', 'live'),
(15, 'OPTION_DATE_YESTERDAY_NIGHT', 'Yesterday night', 1, '2013-03-18 11:33:04', '2013-03-18 11:33:04', 'live'),
(16, 'DATE_YEAR', 'year', 1, '2013-03-22 12:41:48', '2013-03-22 17:47:09', 'live'),
(17, 'DATE_MONTH', 'month', 1, '2013-03-22 12:42:00', '2013-03-22 12:42:00', 'live'),
(18, 'DATE_WEEK', 'week', 1, '2013-03-22 12:42:09', '2013-03-22 12:42:09', 'live'),
(19, 'DATE_DAY', 'day', 1, '2013-03-22 12:42:19', '2013-03-22 12:42:19', 'live'),
(20, 'DATE_HOUR', 'hour', 1, '2013-03-22 12:42:26', '2013-03-22 12:42:26', 'live'),
(21, 'DATE_MINUTE', 'minute', 1, '2013-03-22 12:42:37', '2013-03-22 12:42:37', 'live'),
(22, 'DATE_SECOND', 'second', 1, '2013-03-22 12:42:43', '2013-03-22 12:42:43', 'live'),
(23, 'TIMELINE_EVENT_UPDATE', 'updated', 1, '2013-03-22 14:37:46', '2013-03-24 23:53:56', 'live'),
(24, 'TIMELINE_EVENT_INSERT', 'added', 1, '2013-03-22 14:37:54', '2013-03-22 15:04:09', 'live'),
(25, 'TIMELINE_PERIOD_NIGHT', 'Instead of sleeping', 1, '2013-03-22 15:11:45', '2013-03-22 15:11:45', 'live'),
(26, 'TIMELINE_PERIOD_DUSK', 'After diner', 1, '2013-03-22 15:12:02', '2013-03-22 15:12:02', 'live'),
(27, 'TIMELINE_PERIOD_EVENING', 'This evening', 1, '2013-03-22 15:12:36', '2013-03-22 15:16:15', 'live'),
(28, 'TIMELINE_PERIOD_AFTERNOON', 'This afternoon', 1, '2013-03-22 15:13:13', '2013-03-22 15:13:13', 'live'),
(29, 'TIMELINE_PERIOD_NOON', 'At lunchtime', 1, '2013-03-22 15:13:50', '2013-03-22 15:13:50', 'live'),
(30, 'TIMELINE_PERIOD_MORNING', 'This morning', 1, '2013-03-22 15:14:25', '2013-03-22 15:14:25', 'live'),
(31, 'TIMELINE_PERIOD_DAWN', 'At dawn', 1, '2013-03-22 15:14:48', '2013-03-22 15:14:48', 'live'),
(32, 'DATE_NOW', 'Just now', 1, '2013-03-22 17:48:55', '2013-03-22 17:48:55', 'live'),
(39, 'FIELD_VALIDATION_ERROR_REQUIRED', 'This field is compulsory', 1, '2013-03-22 17:48:55', '2013-03-22 17:48:55', 'live'),
(54, 'TIMELINE_PERIOD_YESTERDAY_DAWN', 'Yesterday very early', 1, '2013-03-23 19:53:53', '2013-03-23 19:53:53', 'live'),
(55, 'TIMELINE_PERIOD_YESTERDAY_MORNING', 'Yesterday morning', 1, '2013-03-23 19:54:03', '2013-03-23 19:54:03', 'live'),
(56, 'TIMELINE_PERIOD_YESTERDAY_NOON', 'Yesterday at noon', 1, '2013-03-23 19:54:28', '2013-03-23 19:54:28', 'live'),
(57, 'TIMELINE_PERIOD_YESTERDAY_AFTERNOON', 'Yesterday afternoon', 1, '2013-03-23 19:54:39', '2013-03-23 19:54:39', 'live'),
(58, 'TIMELINE_PERIOD_YESTERDAY_EVENING', 'Yesterday evening', 1, '2013-03-23 19:54:46', '2013-03-23 19:54:46', 'live'),
(59, 'TIMELINE_PERIOD_YESTERDAY_DUSK', 'Yesterday quite late', 1, '2013-03-23 19:55:04', '2013-03-23 19:55:04', 'live'),
(60, 'TIMELINE_PERIOD_YESTERDAY_NIGHT', 'Yesterday night', 1, '2013-03-23 19:55:14', '2013-03-23 19:55:14', 'live'),
(61, 'TIMELINE_EVENT_DELETE', 'deleted', 1, '2013-04-05 16:02:39', '2013-04-05 16:02:39', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short description',
  `template` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Template',
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Action / routine',
  `method` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Method',
  `target` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Target',
  `enctype` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Enctype',
  `field` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The fields',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `key`, `title`, `descr`, `template`, `action`, `method`, `target`, `enctype`, `field`, `created`, `updated`, `status`) VALUES
(1, 'login', 'Login', '', 'login', 'login', 'post', '', '', '{"login":{"type":"text","key":"login","label":"Login","placeholder":"Your login","required":true},"password":{"type":"password","key":"password","label":"Password","placeholder":"Password","required":true},"save":{"type":"button","buttontype":"submit","key":"save","label":"submit"}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', '');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short description',
  `text` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The text content',
  `http_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The http status',
  `template` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The template',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The url',
  `system` tinyint(1) NOT NULL COMMENT 'System',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `key`, `title`, `descr`, `text`, `http_status`, `template`, `url`, `system`, `created`, `updated`, `status`) VALUES
(1, 'home', 'Digest', 'Welcome home', '', '200 OK', '{"type":"html","key":"master"}', '/', 0, '0000-00-00 00:00:00', '2013-08-30 01:19:17', 'live'),
(2, 'error_404', 'Oups, that 404 thing again!', '', '', '404 Not Found', '{"type":"html","key":"master"}', '/404', 1, '0000-00-00 00:00:00', '2013-08-26 01:28:27', 'live'),
(3, 'post', 'Post', 'Receives all the posts from the forms.', '', '200 OK', '{"type":"routine","key":"post"}', '/routine', 1, '0000-00-00 00:00:00', '2013-08-25 19:33:38', 'live'),
(4, 'ajax', 'Page ajax', 'Receives all the ajax requests.', '', '200 OK', '{"type":"html","key":"ajax"}', '/ajax', 1, '0000-00-00 00:00:00', '2013-03-06 06:21:38', 'live'),
(5, 'list', 'List', '', '', '200 OK', '{"type":"html","key":"master"}', '/list', 0, '0000-00-00 00:00:00', '2013-08-28 17:32:19', 'live'),
(6, 'edit', 'Edit', '', '', '200 OK', '{"type":"html","key":"master"}', '/edit', 0, '0000-00-00 00:00:00', '2013-08-27 14:58:31', 'live'),
(7, 'doc', 'Doc', 'About classes, methods and functions available to you, kind developer.', '', '200 OK', '{"type":"html","key":"master"}', '/doc', 0, '0000-00-00 00:00:00', '2013-03-10 23:07:24', 'live'),
(9, 'env', 'Environment', 'Structure', '', '200 OK', '{"type":"html","key":"master"}', '/site', 0, '0000-00-00 00:00:00', '2013-08-30 01:19:18', 'live'),
(10, 'item', 'Content', 'Publish', '', '200 OK', '{"type":"html","key":"master"}', '/item', 0, '0000-00-00 00:00:00', '2013-08-30 01:19:18', 'live'),
(11, 'app', 'Apps', 'Tweak', '', '200 OK', '{"type":"html","key":"master"}', '/app', 0, '0000-00-00 00:00:00', '2013-08-30 11:56:02', 'live'),
(12, 'social', 'Socialise', 'Chinwag', '', '200 OK', '{"type":"html","key":"master"}', '/social', 0, '0000-00-00 00:00:00', '2013-03-10 23:03:28', 'live'),
(29, 'logbook', 'Logbook', '', '', '200 OK', '{"type":"html","key":"master"}', '/logbook', 0, '0000-00-00 00:00:00', '2013-03-06 06:21:38', 'live'),
(30, 'login', 'Login', '', '', '200 OK', '{"type":"html","key":"login"}', '/login', 1, '0000-00-00 00:00:00', '2013-08-28 12:39:41', 'live'),
(31, 'api-json', 'API (json)', '', '', '200 OK', '{"type":"json","key":"api"}', '/api-json', 1, '2013-03-06 03:21:46', '2013-03-22 12:56:52', 'live'),
(32, 'me', 'My profile', 'dfsdf', '', '200 OK', '{"type":"html","key":"master"}', '/me', 0, '0000-00-00 00:00:00', '2013-03-13 14:04:08', 'live'),
(33, 'api-eventstream', 'API (event-stream)', '', '', '200 OK', '{"type":"eventstream","key":"api"}', '/api-eventstream', 1, '2013-03-06 03:21:46', '2013-03-22 13:22:05', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short description',
  `zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The zone',
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The css classes',
  `template` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The template',
  `data` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The HTML5 custom data',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `key`, `title`, `descr`, `zone`, `class`, `template`, `data`, `created`, `updated`, `status`) VALUES
(2, 'form', 'Form', 'General form', 'content', '', '{"app":"section","template":"edit"}', '{"display":"in2col"}', '0000-00-00 00:00:00', '2013-04-02 14:02:45', 'live'),
(3, 'php', 'PHP classes, methods & functions', 'lorem Lorem ipsum', 'content', '', '{"app":"section","template":"code"}', '{"display":"in2col"}', '0000-00-00 00:00:00', '2013-08-30 01:16:18', 'live'),
(4, 'doc', 'The doc', 'Lorem ipsum', 'content', '', '{"app":"section","template":"doc"}', '{"display":"in2col"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(5, 'splash', 'Ressource not found', 'Lorem ipsum', 'content', '', '{"app":"section","template":"error"}', '{"display":"inlandscape"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(9, 'live', 'Live', 'Everything here is up and running, published on your website.', 'content', '', '{"app":"section","template":"infinite"}', '{"display":"in2col","status":"live"}', '0000-00-00 00:00:00', '2013-02-07 11:42:53', 'live'),
(11, 'asleep', 'Asleep', 'Items here are not accessible to the Internet, they''re idle, asleep. You can wake them up at anytime though.', 'content', '', '{"app":"section","template":"infinite"}', '{"display":"in2col","status":"asleep"}', '0000-00-00 00:00:00', '2013-02-07 11:42:27', 'live'),
(12, 'treemap', 'The site tree', '', 'content', '', '{"app":"section","template":"sitetree"}', '{"display":"inlandscape"}', '0000-00-00 00:00:00', '2013-08-23 02:19:47', 'live'),
(17, 'zoning', 'Zoning', 'Zoning', 'content', '', '{"app":"section","template":"zoning"}', '{"display":"inlandscape"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(19, 'appstore', 'App store', '', 'content', '', '{"app":"section","template":"appmanager"}', '', '0000-00-00 00:00:00', '2013-03-22 08:58:52', 'live'),
(20, 'appini', 'About this app', '', 'content', '', '{"app":"section","template":"appini"}', '{"display":"in2col"}', '0000-00-00 00:00:00', '2013-02-07 10:47:37', 'live'),
(21, 'appconfig', 'Config', '', 'content', '', '{"app":"section","template":"appconfig"}', '{"display":"inlandscape"}', '0000-00-00 00:00:00', '2013-02-01 02:05:55', 'live'),
(23, 'draft', 'My drafts', 'Everything here is personal: doodles, first attempts, unfinished documents. Noone else than you can see that.', 'content', '', '{"app":"section","template":"infinite"}', '{"display":"in2col","status":"draft"}', '2013-02-07 06:08:49', '2013-06-24 14:09:22', 'live'),
(25, 'carousel_test', 'Carousel de test', '', 'content', '', '{"app":"jquery_carousel","template":"jquery_carousel","param":{"direction":"horizontal","autoSlideInterval":"3000","dispItems":"1","paginationPosition":"inside","nextBtn":"<span>next<\\/span>","prevBtn":"<span>previous<\\/span>","btnsPosition":"inside","nextBtnInsert":"appendTo","prevBtnInsert":"prependTo","delayAutoSlide":"0","effect":"slide","slideEasing":"swing","animSpeed":"normal"}}', '', '2013-02-08 10:22:45', '2013-02-08 10:22:45', 'live'),
(26, 'timeline', 'Timeline', 'Keep in touch with everything.', 'content', '', '{"app":"section","template":"timeline"}', '{"display":"in2col"}', '2013-02-24 06:33:01', '2013-03-10 19:29:31', 'live'),
(27, 'notes', 'Discussion', '', 'content', '', '{"app":"section","template":"notes"}', '{"display":"in2col"}', '2013-03-11 01:20:51', '2013-04-02 13:10:52', 'live'),
(28, 'login', 'Login Form', '', 'content', '', '{"app":"form","template":"login"}', '', '2013-04-07 15:55:22', '2013-04-07 15:55:22', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  `defaultversion` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `key`, `title`, `created`, `updated`, `status`, `defaultversion`) VALUES
(1, 'admin', 'Grandcentral Administration', '2013-05-21 14:52:00', '2013-05-21 14:52:00', 'live', 1);

-- --------------------------------------------------------

--
-- Table structure for table `structure`
--

CREATE TABLE `structure` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short description',
  `system` tinyint(1) NOT NULL COMMENT 'Is system',
  `attr` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Attributes',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `structure`
--

INSERT INTO `structure` (`id`, `key`, `title`, `descr`, `system`, `attr`, `created`, `updated`, `status`) VALUES
(1, 'structure', 'Structures', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"descr":{"key":"descr","title":"A short description","type":"string","min":"0","max":"500"},"system":{"key":"system","title":"Is system","type":"bool"},"attr":{"key":"attr","title":"Attributes","type":"array"},"fitsinsitetree":{"key":"fitsinsitetree","title":"Can fit in the Site Tree","type":"bool"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status"}}', '0000-00-00 00:00:00', '2013-04-05 12:39:48', 'live'),
(2, 'site', 'Your websites', 'Manage your website basics, and the apps that will be opened at all time.', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"defaultversion":{"key":"defaultversion","type":"int","title":"Default Version"}}', '0000-00-00 00:00:00', '2013-04-05 12:41:29', 'live'),
(3, 'page', 'Page', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","min":"0","max":"255","required":"1"},"descr":{"key":"descr","type":"string","title":"A short description","min":"0","max":"500"},"text":{"key":"text","type":"string","title":"The text content","min":"0","max":"65035"},"http_status":{"key":"http_status","type":"string","title":"The http status","min":"0","max":"255"},"template":{"key":"template","type":"array","title":"The template"},"url":{"key":"url","type":"string","title":"The url","min":"0","max":"255","required":"1"},"system":{"key":"system","type":"bool","title":"System"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"child":{"key":"child","param":[{"item":"structure_3"}],"min":"","max":"","type":"rel"},"section":{"key":"section","param":{"1":{"item":"structure_5"}},"min":"","max":"","type":"rel"}}', '0000-00-00 00:00:00', '2013-08-20 18:57:03', 'live'),
(4, 'version', 'Versions', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"lang":{"key":"lang","title":"Language","type":"string","min":"0","max":"32","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"}}', '0000-00-00 00:00:00', '2013-04-05 12:43:36', 'live'),
(5, 'const', 'Text constants', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"Title","min":"","max":"","required":"1"},"version":{"key":"version","type":"version"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"}}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(6, 'form', 'Forms', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"Title","min":"","max":"","required":"1"},"descr":{"key":"descr","title":"A short description","type":"string","min":"0","max":"500"},"template":{"key":"template","type":"string","title":"Template","min":"","max":"","required":"1"},"action":{"key":"action","type":"string","title":"Action","min":"","max":"","required":"1"},"method":{"key":"method","type":"list","option":"post,get","title":"Method","required":"1"},"target":{"key":"target","type":"string","title":"Target"},"enctype":{"key":"enctype","type":"list","option":"application/x-www-form-urlencoded,multipart/form-data","title":"Enctype","required":"1"},"field":{"key":"field","type":"array","title":"The Fields"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"}}', '2013-09-27 08:33:31', '2013-09-27 08:33:31', 'live'),
(7, 'section', 'Sections', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","min":"0","max":"255","required":"1"},"descr":{"key":"descr","type":"string","title":"A short description","min":"0","max":"500"},"zone":{"key":"zone","type":"string","title":"The zone","min":"0","max":"255"},"class":{"key":"class","type":"string","title":"The css classes","min":"0","max":"255"},"template":{"key":"template","type":"array","title":"The template","required":"1"},"data":{"key":"data","type":"array","title":"The HTML5 custom data"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"}}', '2013-09-25 08:33:09', '2013-09-25 08:33:09', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `lang` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `key`, `title`, `lang`, `created`, `updated`, `status`) VALUES
(1, 'en', 'English', 'en', '2013-04-05 17:02:34', '2013-04-05 17:02:34', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `_rel`
--

CREATE TABLE `_rel` (
  `item` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'undefined',
  `itemid` int(10) unsigned NOT NULL,
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `rel` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'undefined',
  `relid` int(10) unsigned NOT NULL,
  `position` int(4) unsigned NOT NULL DEFAULT '0',
  KEY `position` (`position`),
  KEY `object` (`item`),
  KEY `rel` (`rel`),
  KEY `relid` (`relid`),
  KEY `objectid` (`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Relations of page';

--
-- Dumping data for table `_rel`
--

INSERT INTO `_rel` (`item`, `itemid`, `key`, `rel`, `relid`, `position`) VALUES
('page', 5, 'section', 'section', 9, 0),
('page', 5, 'section', 'section', 11, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
