/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 5.7.41-log : Database - rwrd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rwrd` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `rwrd`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `name_slug` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `block_type` varchar(255) DEFAULT NULL,
  `category_order` int(11) DEFAULT '0',
  `show_at_homepage` tinyint(1) DEFAULT '1',
  `show_on_menu` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `comment` varchar(5000) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `like_count` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_parent_id` (`parent_id`),
  KEY `idx_post_id` (`post_id`),
  KEY `idx_status` (`status`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `contacts` */

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(5000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `corp` */

DROP TABLE IF EXISTS `corp`;

CREATE TABLE `corp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `order` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `files` */

DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `storage` varchar(20) DEFAULT 'local',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `followers` */

DROP TABLE IF EXISTS `followers`;

CREATE TABLE `followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `following_id` int(11) DEFAULT NULL,
  `follower_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_following_id` (`following_id`),
  KEY `idx_follower_id` (`follower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `fonts` */

DROP TABLE IF EXISTS `fonts`;

CREATE TABLE `fonts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `font_name` varchar(255) DEFAULT NULL,
  `font_key` varchar(255) DEFAULT NULL,
  `font_url` varchar(2000) DEFAULT NULL,
  `font_family` varchar(500) DEFAULT NULL,
  `font_source` varchar(50) DEFAULT 'google',
  `has_local_file` tinyint(1) DEFAULT '0',
  `is_default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Table structure for table `general_settings` */

DROP TABLE IF EXISTS `general_settings`;

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_lang` int(11) NOT NULL DEFAULT '1',
  `multilingual_system` tinyint(1) DEFAULT '1',
  `theme_mode` varchar(25) DEFAULT 'light',
  `logo` varchar(255) DEFAULT NULL,
  `logo_footer` varchar(255) DEFAULT NULL,
  `logo_email` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `show_hits` tinyint(1) DEFAULT '1',
  `show_rss` tinyint(1) DEFAULT '1',
  `rss_content_type` varchar(50) DEFAULT '''summary''',
  `show_newsticker` tinyint(1) DEFAULT '1',
  `pagination_per_page` smallint(6) DEFAULT '10',
  `google_analytics` text,
  `mail_service` varchar(100) DEFAULT 'swift',
  `mail_protocol` varchar(100) DEFAULT 'smtp',
  `mail_encryption` varchar(100) DEFAULT 'tls',
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT '587',
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_title` varchar(255) DEFAULT NULL,
  `mail_reply_to` varchar(255) DEFAULT 'noreply@domain.com',
  `mailjet_api_key` varchar(255) DEFAULT NULL,
  `mailjet_secret_key` varchar(255) DEFAULT NULL,
  `mailjet_email_address` varchar(255) DEFAULT NULL,
  `google_client_id` varchar(500) DEFAULT NULL,
  `google_client_secret` varchar(500) DEFAULT NULL,
  `vk_app_id` varchar(500) DEFAULT NULL,
  `vk_secure_key` varchar(500) DEFAULT NULL,
  `facebook_app_id` varchar(500) DEFAULT NULL,
  `facebook_app_secret` varchar(500) DEFAULT NULL,
  `facebook_comment` text,
  `facebook_comment_active` tinyint(1) DEFAULT '1',
  `show_featured_section` tinyint(1) DEFAULT '1',
  `show_latest_posts` tinyint(1) DEFAULT '1',
  `pwa_status` tinyint(1) DEFAULT '0',
  `registration_system` tinyint(1) DEFAULT '1',
  `post_url_structure` varchar(50) DEFAULT '''slug''',
  `comment_system` tinyint(1) DEFAULT '1',
  `comment_approval_system` tinyint(1) DEFAULT '1',
  `show_post_author` tinyint(1) DEFAULT '1',
  `show_post_date` tinyint(1) DEFAULT '1',
  `menu_limit` tinyint(4) DEFAULT '8',
  `custom_header_codes` mediumtext,
  `custom_footer_codes` mediumtext,
  `adsense_activation_code` text,
  `recaptcha_site_key` varchar(255) DEFAULT NULL,
  `recaptcha_secret_key` varchar(255) DEFAULT NULL,
  `emoji_reactions` tinyint(1) DEFAULT '1',
  `mail_contact_status` tinyint(1) DEFAULT '0',
  `mail_contact` varchar(255) DEFAULT NULL,
  `cache_system` tinyint(1) DEFAULT '0',
  `cache_refresh_time` int(11) DEFAULT '1800',
  `refresh_cache_database_changes` tinyint(1) DEFAULT '0',
  `email_verification` tinyint(1) DEFAULT '0',
  `file_manager_show_files` tinyint(1) DEFAULT '1',
  `audio_download_button` tinyint(1) DEFAULT '1',
  `approve_added_user_posts` tinyint(1) DEFAULT '1',
  `approve_updated_user_posts` tinyint(1) DEFAULT '1',
  `timezone` varchar(255) DEFAULT 'America/New_York',
  `show_latest_posts_on_slider` tinyint(1) DEFAULT '0',
  `show_latest_posts_on_featured` tinyint(1) DEFAULT '0',
  `sort_slider_posts` varchar(100) DEFAULT 'by_slider_order',
  `sort_featured_posts` varchar(100) DEFAULT 'by_featured_order',
  `newsletter_status` tinyint(1) DEFAULT '1',
  `newsletter_popup` tinyint(1) DEFAULT '0',
  `show_home_link` tinyint(1) DEFAULT '1',
  `post_format_article` tinyint(1) DEFAULT '1',
  `post_format_gallery` tinyint(1) DEFAULT '1',
  `post_format_sorted_list` tinyint(1) DEFAULT '1',
  `post_format_video` tinyint(1) DEFAULT '1',
  `post_format_audio` tinyint(1) DEFAULT '1',
  `post_format_trivia_quiz` tinyint(1) DEFAULT '1',
  `post_format_personality_quiz` tinyint(1) DEFAULT '1',
  `post_format_poll` tinyint(1) DEFAULT '1',
  `maintenance_mode_title` varchar(500) DEFAULT 'Coming Soon!',
  `maintenance_mode_description` varchar(5000) DEFAULT NULL,
  `maintenance_mode_status` tinyint(1) DEFAULT '0',
  `sitemap_frequency` varchar(30) DEFAULT 'monthly',
  `sitemap_last_modification` varchar(30) DEFAULT 'server_response',
  `sitemap_priority` varchar(30) DEFAULT 'automatically',
  `show_user_email_on_profile` tinyint(1) DEFAULT '1',
  `reward_system_status` tinyint(1) DEFAULT '0',
  `reward_amount` double DEFAULT '1',
  `currency_name` varchar(100) DEFAULT 'US Dollar',
  `currency_symbol` varchar(10) DEFAULT '$',
  `currency_format` varchar(10) DEFAULT 'us',
  `currency_symbol_format` varchar(10) DEFAULT 'left',
  `payout_paypal_status` tinyint(1) DEFAULT '1',
  `payout_iban_status` tinyint(1) DEFAULT '1',
  `payout_swift_status` tinyint(1) DEFAULT '1',
  `storage` varchar(20) DEFAULT 'local',
  `aws_key` varchar(255) DEFAULT NULL,
  `aws_secret` varchar(255) DEFAULT NULL,
  `aws_bucket` varchar(255) DEFAULT NULL,
  `aws_region` varchar(255) DEFAULT NULL,
  `auto_post_deletion` tinyint(1) DEFAULT '0',
  `auto_post_deletion_days` smallint(6) DEFAULT '30',
  `auto_post_deletion_delete_all` tinyint(1) DEFAULT '0',
  `redirect_rss_posts_to_original` tinyint(1) DEFAULT '0',
  `image_file_format` varchar(30) DEFAULT '''JPG''',
  `allowed_file_extensions` varchar(500) DEFAULT '''jpg,jpeg,png,gif,svg,csv,doc,docx,pdf,ppt,psd,mp4,mp3,zip''',
  `google_news` tinyint(1) DEFAULT '0',
  `last_cron_update` timestamp NULL DEFAULT NULL,
  `version` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_big` varchar(255) DEFAULT NULL,
  `image_default` varchar(255) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL,
  `image_mid` varchar(255) DEFAULT NULL,
  `image_small` varchar(255) DEFAULT NULL,
  `image_mime` varchar(50) DEFAULT 'jpg',
  `file_name` varchar(255) DEFAULT NULL,
  `storage` varchar(20) DEFAULT 'local',
  `user_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `language_translations` */

DROP TABLE IF EXISTS `language_translations`;

CREATE TABLE `language_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` smallint(6) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `translation` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_lang_id` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=952 DEFAULT CHARSET=utf8;

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_form` varchar(255) NOT NULL,
  `language_code` varchar(100) NOT NULL,
  `text_direction` varchar(50) NOT NULL,
  `text_editor_lang` varchar(30) DEFAULT 'en',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `language_order` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `mst_member` */

DROP TABLE IF EXISTS `mst_member`;

CREATE TABLE `mst_member` (
  `id_member` varchar(20) NOT NULL COMMENT 'Membership Number',
  `id_guest` varchar(20) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `id_hotel` int(11) NOT NULL DEFAULT '1',
  `id_tipe_member` int(11) NOT NULL DEFAULT '1',
  `is_print_card` enum('Yes','No') DEFAULT 'No',
  `initial_point` int(11) DEFAULT NULL,
  `initial_number_of_stays` int(11) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `jenis_identitas` enum('ID Card','Driving License','Passport','Other') DEFAULT NULL,
  `no_identitas` varchar(20) DEFAULT NULL,
  `title` enum('Mr.','Mrs.','Miss.') DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `name_on_card` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `id_negara` varchar(50) DEFAULT NULL,
  `propinsi` varchar(50) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  `handphone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('Aktif','Non Aktif') DEFAULT 'Non Aktif',
  `perusahaan` varchar(50) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(100) DEFAULT 'user',
  `last_seen` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `reward_system_enabled` tinyint(1) DEFAULT '1',
  `balance` double DEFAULT '0',
  `email_status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_member`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `mst_member_saved` */

DROP TABLE IF EXISTS `mst_member_saved`;

CREATE TABLE `mst_member_saved` (
  `id_member` varchar(20) NOT NULL COMMENT 'Membership Number',
  `id_guest` varchar(20) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `id_hotel` int(11) NOT NULL DEFAULT '1',
  `id_tipe_member` int(11) NOT NULL DEFAULT '1',
  `initial_point` int(11) DEFAULT NULL,
  `initial_number_of_stays` int(11) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `jenis_identitas` enum('KTP','SIM','Paspor','Lainnya') DEFAULT NULL,
  `no_identitas` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `id_negara` varchar(50) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `status` enum('Aktif','Non Aktif') DEFAULT 'Non Aktif',
  `perusahaan` varchar(50) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_member`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `telepon` (`telepon`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `mst_user` */

DROP TABLE IF EXISTS `mst_user`;

CREATE TABLE `mst_user` (
  `username` varchar(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('Administrator','Front Office','House Keeping','Viewer') NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT '1',
  `title` varchar(500) DEFAULT NULL,
  `slug` varchar(500) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `is_custom` tinyint(1) DEFAULT '1',
  `page_default_name` varchar(100) DEFAULT NULL,
  `page_content` mediumtext,
  `page_order` smallint(6) DEFAULT '1',
  `visibility` tinyint(1) DEFAULT '1',
  `title_active` tinyint(1) DEFAULT '1',
  `breadcrumb_active` tinyint(1) DEFAULT '1',
  `right_column_active` tinyint(1) DEFAULT '1',
  `need_auth` tinyint(1) DEFAULT '0',
  `location` varchar(255) DEFAULT 'top',
  `link` varchar(1000) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `page_type` varchar(50) DEFAULT 'page',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `payouts` */

DROP TABLE IF EXISTS `payouts`;

CREATE TABLE `payouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `amount` double NOT NULL,
  `payout_method` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `post_files` */

DROP TABLE IF EXISTS `post_files`;

CREATE TABLE `post_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_post_id` (`post_id`),
  KEY `idx_file_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `post_pageviews_month` */

DROP TABLE IF EXISTS `post_pageviews_month`;

CREATE TABLE `post_pageviews_month` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `post_user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `reward_amount` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_post_id` (`post_id`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_post_user_id` (`post_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT '1',
  `title` varchar(500) DEFAULT NULL,
  `title_slug` varchar(500) DEFAULT NULL,
  `title_hash` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `summary` varchar(5000) DEFAULT NULL,
  `content` longtext,
  `category_id` int(11) DEFAULT NULL,
  `image_big` varchar(255) DEFAULT NULL,
  `image_default` varchar(255) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL,
  `image_mid` varchar(255) DEFAULT NULL,
  `image_small` varchar(255) DEFAULT NULL,
  `image_mime` varchar(20) DEFAULT 'jpg',
  `image_storage` varchar(20) DEFAULT 'local',
  `optional_url` varchar(1000) DEFAULT NULL,
  `pageviews` int(11) DEFAULT '0',
  `need_auth` tinyint(1) DEFAULT '0',
  `is_slider` tinyint(1) DEFAULT '0',
  `slider_order` tinyint(1) DEFAULT '1',
  `is_featured` tinyint(1) DEFAULT '0',
  `featured_order` tinyint(1) DEFAULT '1',
  `is_recommended` tinyint(1) DEFAULT '0',
  `is_breaking` tinyint(1) DEFAULT '1',
  `is_scheduled` tinyint(1) DEFAULT '0',
  `visibility` tinyint(1) DEFAULT '1',
  `show_right_column` tinyint(1) DEFAULT '1',
  `post_type` varchar(50) DEFAULT 'post',
  `video_path` varchar(255) DEFAULT NULL,
  `video_storage` varchar(20) DEFAULT 'local',
  `image_url` varchar(2000) DEFAULT NULL,
  `video_url` varchar(2000) DEFAULT NULL,
  `video_embed_code` varchar(2000) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `feed_id` int(11) DEFAULT NULL,
  `post_url` varchar(1000) DEFAULT NULL,
  `show_post_url` tinyint(1) DEFAULT '1',
  `image_description` varchar(500) DEFAULT NULL,
  `show_item_numbers` tinyint(1) DEFAULT '1',
  `is_poll_public` tinyint(1) DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_category_id` (`category_id`),
  KEY `idx_is_slider` (`is_slider`),
  KEY `idx_is_featured` (`is_featured`),
  KEY `idx_is_recommended` (`is_recommended`),
  KEY `idx_is_breaking` (`is_breaking`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_lang_id` (`lang_id`),
  KEY `idx_is_scheduled` (`is_scheduled`),
  KEY `idx_visibility` (`visibility`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `reading_lists` */

DROP TABLE IF EXISTS `reading_lists`;

CREATE TABLE `reading_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_post_id` (`post_id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ref_hotel` */

DROP TABLE IF EXISTS `ref_hotel`;

CREATE TABLE `ref_hotel` (
  `id_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `kode_hotel` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_hotel`),
  UNIQUE KEY `kode_hotel` (`kode_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `ref_konversi` */

DROP TABLE IF EXISTS `ref_konversi`;

CREATE TABLE `ref_konversi` (
  `id_ref_konversi` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `tipe` enum('FIT','GRP') NOT NULL,
  PRIMARY KEY (`id_ref_konversi`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Table structure for table `ref_kota` */

DROP TABLE IF EXISTS `ref_kota`;

CREATE TABLE `ref_kota` (
  `id_kota` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `id_negara` varchar(2) NOT NULL,
  PRIMARY KEY (`id_kota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ref_kota';

/*Table structure for table `ref_negara` */

DROP TABLE IF EXISTS `ref_negara`;

CREATE TABLE `ref_negara` (
  `id_negara` varchar(3) CHARACTER SET latin1 NOT NULL,
  `nama` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_negara`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1257;

/*Table structure for table `ref_negara_saved` */

DROP TABLE IF EXISTS `ref_negara_saved`;

CREATE TABLE `ref_negara_saved` (
  `id_negara` varchar(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id_negara`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `ref_reward` */

DROP TABLE IF EXISTS `ref_reward`;

CREATE TABLE `ref_reward` (
  `id_reward` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(200) NOT NULL,
  `tipe` enum('Direct','Non Direct') DEFAULT NULL,
  PRIMARY KEY (`id_reward`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

/*Table structure for table `ref_tipe_member` */

DROP TABLE IF EXISTS `ref_tipe_member`;

CREATE TABLE `ref_tipe_member` (
  `id_tipe_member` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `index` decimal(4,2) NOT NULL,
  `min_stays` int(11) NOT NULL,
  `max_stays` int(11) NOT NULL,
  `benefit` text NOT NULL,
  PRIMARY KEY (`id_tipe_member`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `roles_permissions` */

DROP TABLE IF EXISTS `roles_permissions`;

CREATE TABLE `roles_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `admin_panel` tinyint(1) DEFAULT NULL,
  `add_post` tinyint(1) DEFAULT NULL,
  `manage_all_posts` tinyint(1) DEFAULT NULL,
  `navigation` tinyint(1) DEFAULT NULL,
  `pages` tinyint(1) DEFAULT NULL,
  `rss_feeds` tinyint(1) DEFAULT NULL,
  `categories` tinyint(1) DEFAULT NULL,
  `widgets` tinyint(1) DEFAULT NULL,
  `polls` tinyint(1) DEFAULT NULL,
  `gallery` tinyint(1) DEFAULT NULL,
  `comments_contact` tinyint(1) DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `ad_spaces` tinyint(1) DEFAULT NULL,
  `users` tinyint(1) DEFAULT NULL,
  `seo_tools` tinyint(1) DEFAULT NULL,
  `settings` tinyint(1) DEFAULT NULL,
  `reward_system` tinyint(1) DEFAULT NULL,
  `members` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `routes` */

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(100) DEFAULT 'admin',
  `profile` varchar(100) DEFAULT 'profile',
  `tag` varchar(100) DEFAULT 'tag',
  `reading_list` varchar(100) DEFAULT 'reading-list',
  `settings` varchar(100) DEFAULT 'settings',
  `social_accounts` varchar(100) DEFAULT 'social-accounts',
  `preferences` varchar(100) DEFAULT 'preferences',
  `change_password` varchar(100) DEFAULT 'change-password',
  `forgot_password` varchar(100) DEFAULT 'forgot-password',
  `reset_password` varchar(100) DEFAULT 'reset-password',
  `delete_account` varchar(100) DEFAULT 'delete-account',
  `register` varchar(100) DEFAULT 'register',
  `posts` varchar(100) DEFAULT 'posts',
  `search` varchar(100) DEFAULT 'search',
  `rss_feeds` varchar(100) DEFAULT 'rss-feeds',
  `gallery_album` varchar(100) DEFAULT 'gallery-album',
  `earnings` varchar(100) DEFAULT 'earnings',
  `payouts` varchar(100) DEFAULT 'payouts',
  `pointhist` varchar(100) DEFAULT 'pointhist',
  `redemptsta` varchar(100) DEFAULT 'redemptsta',
  `gfy` varchar(100) DEFAULT 'gfy',
  `set_payout_account` varchar(100) DEFAULT 'set-payout-account',
  `logout` varchar(100) DEFAULT 'logout',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) NOT NULL DEFAULT '1',
  `site_title` varchar(255) DEFAULT NULL,
  `home_title` varchar(255) DEFAULT 'Index',
  `site_description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `application_name` varchar(255) DEFAULT NULL,
  `primary_font` smallint(6) DEFAULT '19',
  `secondary_font` smallint(6) DEFAULT '25',
  `tertiary_font` smallint(6) DEFAULT '32',
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_url` varchar(500) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `pinterest_url` varchar(500) DEFAULT NULL,
  `linkedin_url` varchar(500) DEFAULT NULL,
  `vk_url` varchar(500) DEFAULT NULL,
  `telegram_url` varchar(500) DEFAULT NULL,
  `youtube_url` varchar(500) DEFAULT NULL,
  `tiktok_url` varchar(500) DEFAULT NULL,
  `optional_url_button_name` varchar(500) DEFAULT 'Click Here To See More',
  `about_footer` varchar(1000) DEFAULT NULL,
  `contact_text` text,
  `contact_address` varchar(500) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `copyright` varchar(500) DEFAULT NULL,
  `cookies_warning` tinyint(1) DEFAULT '0',
  `cookies_warning_text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `subscribers` */

DROP TABLE IF EXISTS `subscribers`;

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_setting` */

DROP TABLE IF EXISTS `tbl_setting`;

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `nilai` decimal(10,8) NOT NULL DEFAULT '0.00000000',
  `tgl_berlaku` date NOT NULL,
  PRIMARY KEY (`id_setting`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `themes` */

DROP TABLE IF EXISTS `themes`;

CREATE TABLE `themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(255) DEFAULT NULL,
  `theme_folder` varchar(255) NOT NULL,
  `theme_name` varchar(255) DEFAULT NULL,
  `theme_color` varchar(100) DEFAULT NULL,
  `block_color` varchar(100) DEFAULT NULL,
  `mega_menu_color` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `trn_hotel` */

DROP TABLE IF EXISTS `trn_hotel`;

CREATE TABLE `trn_hotel` (
  `id_trn` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(30) NOT NULL,
  `hotel_code` varchar(15) DEFAULT NULL,
  `id_member` varchar(20) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `room_type` varchar(10) NOT NULL,
  `room_code` varchar(10) NOT NULL,
  `market_code` varchar(10) NOT NULL,
  `market_code_converted` varchar(20) NOT NULL,
  `source_code` varchar(10) NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `number_of_nights` int(11) NOT NULL,
  `room_revenue` int(11) NOT NULL,
  `fnb_revenue` int(11) NOT NULL,
  `other_revenue` int(11) NOT NULL,
  `total_revenue` int(11) NOT NULL,
  `room_revenue_converted` int(11) NOT NULL,
  `fnb_revenue_converted` int(11) NOT NULL,
  `other_revenue_converted` int(11) NOT NULL,
  `total_revenue_converted` int(11) NOT NULL,
  `point_type` enum('Member','Booker') NOT NULL DEFAULT 'Member',
  `status` enum('Draft','Converted','Void','Expired') DEFAULT 'Draft',
  `waktu_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `exp_date` date DEFAULT NULL,
  PRIMARY KEY (`id_trn`)
) ENGINE=InnoDB AUTO_INCREMENT=39319 DEFAULT CHARSET=latin1;

/*Table structure for table `trn_log` */

DROP TABLE IF EXISTS `trn_log`;

CREATE TABLE `trn_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `feature` varchar(50) NOT NULL,
  `action` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`)
) ENGINE=MyISAM AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;

/*Table structure for table `trn_point_in_saved` */

DROP TABLE IF EXISTS `trn_point_in_saved`;

CREATE TABLE `trn_point_in_saved` (
  `id_point_in` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` varchar(20) NOT NULL,
  `point` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_point_in`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `trn_point_konversi` */

DROP TABLE IF EXISTS `trn_point_konversi`;

CREATE TABLE `trn_point_konversi` (
  `id_point_konversi` int(11) NOT NULL AUTO_INCREMENT,
  `id_reward` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `tanggal_buka` date NOT NULL,
  `tanggal_tutup` date NOT NULL,
  PRIMARY KEY (`id_point_konversi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `trn_point_out` */

DROP TABLE IF EXISTS `trn_point_out`;

CREATE TABLE `trn_point_out` (
  `id_point_out` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` varchar(20) NOT NULL,
  `id_reward` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `status` enum('Canceled','On Process','Approved','Claimed') NOT NULL DEFAULT 'On Process',
  `tanggal_proses` date DEFAULT NULL,
  `tanggal_claim` date DEFAULT NULL,
  PRIMARY KEY (`id_point_out`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

/*Table structure for table `trn_point_out_saved` */

DROP TABLE IF EXISTS `trn_point_out_saved`;

CREATE TABLE `trn_point_out_saved` (
  `id_point_out` int(11) NOT NULL AUTO_INCREMENT,
  `id_trn_reward` int(11) NOT NULL,
  `id_member` varchar(20) NOT NULL,
  `point` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Canceled','On Process','Approved','Claimed') NOT NULL DEFAULT 'On Process',
  PRIMARY KEY (`id_point_out`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `trn_reward` */

DROP TABLE IF EXISTS `trn_reward`;

CREATE TABLE `trn_reward` (
  `id_trn_reward` int(11) NOT NULL AUTO_INCREMENT,
  `id_reward` int(11) NOT NULL,
  `index_point` int(11) NOT NULL,
  `tanggal_mulai_berlaku` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  PRIMARY KEY (`id_trn_reward`),
  KEY `FK_trn_reward_ref_reward` (`id_reward`),
  CONSTRAINT `FK_trn_reward_ref_reward` FOREIGN KEY (`id_reward`) REFERENCES `ref_reward` (`id_reward`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `hotel_id` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT 'name@domain.com',
  `email_status` tinyint(1) DEFAULT '0',
  `token` varchar(500) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT 'moderator',
  `user_type` varchar(50) DEFAULT 'registered',
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `vk_id` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `about_me` varchar(5000) DEFAULT NULL,
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_url` varchar(500) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `pinterest_url` varchar(500) DEFAULT NULL,
  `linkedin_url` varchar(500) DEFAULT NULL,
  `vk_url` varchar(500) DEFAULT NULL,
  `telegram_url` varchar(500) DEFAULT NULL,
  `youtube_url` varchar(500) DEFAULT NULL,
  `tiktok_url` varchar(500) DEFAULT NULL,
  `personal_website_url` varchar(500) DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `show_email_on_profile` tinyint(1) DEFAULT '1',
  `show_rss_feeds` tinyint(1) DEFAULT '1',
  `reward_system_enabled` tinyint(1) DEFAULT '0',
  `balance` double DEFAULT '0',
  `total_pageviews` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `videos` */

DROP TABLE IF EXISTS `videos`;

CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_name` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `storage` varchar(20) DEFAULT 'local',
  `user_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `widgets` */

DROP TABLE IF EXISTS `widgets`;

CREATE TABLE `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) DEFAULT '1',
  `title` varchar(500) DEFAULT NULL,
  `content` text,
  `type` varchar(100) DEFAULT NULL,
  `widget_order` int(11) DEFAULT '1',
  `visibility` int(11) DEFAULT '1',
  `is_custom` int(11) DEFAULT '1',
  `display_category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `trn_point_exp` */

DROP TABLE IF EXISTS `trn_point_exp`;

/*!50001 DROP VIEW IF EXISTS `trn_point_exp` */;
/*!50001 DROP TABLE IF EXISTS `trn_point_exp` */;

/*!50001 CREATE TABLE  `trn_point_exp`(
 `id_member` varchar(20) ,
 `point_exp` decimal(32,0) 
)*/;

/*Table structure for table `trn_point_in` */

DROP TABLE IF EXISTS `trn_point_in`;

/*!50001 DROP VIEW IF EXISTS `trn_point_in` */;
/*!50001 DROP TABLE IF EXISTS `trn_point_in` */;

/*!50001 CREATE TABLE  `trn_point_in`(
 `id_member` varchar(20) ,
 `point` decimal(34,0) 
)*/;

/*Table structure for table `v_member_point` */

DROP TABLE IF EXISTS `v_member_point`;

/*!50001 DROP VIEW IF EXISTS `v_member_point` */;
/*!50001 DROP TABLE IF EXISTS `v_member_point` */;

/*!50001 CREATE TABLE  `v_member_point`(
 `id_member` varchar(20) ,
 `id_guest` varchar(20) ,
 `fullname` varchar(50) ,
 `name_on_card` varchar(100) ,
 `member_level` varchar(50) ,
 `total_point` decimal(56,0) ,
 `total_point_redeemed` decimal(42,0) ,
 `expired_point` decimal(54,0) ,
 `point_balance` decimal(58,0) 
)*/;

/*Table structure for table `v_member_point2` */

DROP TABLE IF EXISTS `v_member_point2`;

/*!50001 DROP VIEW IF EXISTS `v_member_point2` */;
/*!50001 DROP TABLE IF EXISTS `v_member_point2` */;

/*!50001 CREATE TABLE  `v_member_point2`(
 `id_member` varchar(20) ,
 `id_guest` varchar(20) ,
 `fullname` varchar(50) ,
 `name_on_card` varchar(100) ,
 `nama` varchar(50) ,
 `total_point` decimal(56,0) ,
 `total_point_redeemed` decimal(32,0) ,
 `expired_point` decimal(54,0) ,
 `point_balance` decimal(58,0) 
)*/;

/*Table structure for table `v_member_type` */

DROP TABLE IF EXISTS `v_member_type`;

/*!50001 DROP VIEW IF EXISTS `v_member_type` */;
/*!50001 DROP TABLE IF EXISTS `v_member_type` */;

/*!50001 CREATE TABLE  `v_member_type`(
 `id_member` varchar(20) ,
 `name_on_card` varchar(100) ,
 `is_print_card` varchar(3) ,
 `number_of_stays` decimal(65,0) ,
 `member_type_actual` varchar(50) ,
 `member_type_suggested` varchar(50) 
)*/;

/*Table structure for table `v_non` */

DROP TABLE IF EXISTS `v_non`;

/*!50001 DROP VIEW IF EXISTS `v_non` */;
/*!50001 DROP TABLE IF EXISTS `v_non` */;

/*!50001 CREATE TABLE  `v_non`(
 `id_member` varchar(20) ,
 `number_of_nights` decimal(32,0) 
)*/;

/*Table structure for table `v_nos` */

DROP TABLE IF EXISTS `v_nos`;

/*!50001 DROP VIEW IF EXISTS `v_nos` */;
/*!50001 DROP TABLE IF EXISTS `v_nos` */;

/*!50001 CREATE TABLE  `v_nos`(
 `id_member` varchar(20) ,
 `number_of_stays` decimal(64,0) 
)*/;

/*Table structure for table `v_nos_booker` */

DROP TABLE IF EXISTS `v_nos_booker`;

/*!50001 DROP VIEW IF EXISTS `v_nos_booker` */;
/*!50001 DROP TABLE IF EXISTS `v_nos_booker` */;

/*!50001 CREATE TABLE  `v_nos_booker`(
 `id_member` varchar(20) ,
 `point_type` varchar(6) ,
 `number_of_stays` decimal(42,0) 
)*/;

/*Table structure for table `v_nos_gabung` */

DROP TABLE IF EXISTS `v_nos_gabung`;

/*!50001 DROP VIEW IF EXISTS `v_nos_gabung` */;
/*!50001 DROP TABLE IF EXISTS `v_nos_gabung` */;

/*!50001 CREATE TABLE  `v_nos_gabung`(
 `id_member` varchar(20) ,
 `point_type` varchar(6) ,
 `number_of_stays` decimal(42,0) 
)*/;

/*Table structure for table `v_nos_member` */

DROP TABLE IF EXISTS `v_nos_member`;

/*!50001 DROP VIEW IF EXISTS `v_nos_member` */;
/*!50001 DROP TABLE IF EXISTS `v_nos_member` */;

/*!50001 CREATE TABLE  `v_nos_member`(
 `id_member` varchar(20) ,
 `arrival_date` date ,
 `number_of_stays` bigint(21) 
)*/;

/*Table structure for table `v_nos_raw` */

DROP TABLE IF EXISTS `v_nos_raw`;

/*!50001 DROP VIEW IF EXISTS `v_nos_raw` */;
/*!50001 DROP TABLE IF EXISTS `v_nos_raw` */;

/*!50001 CREATE TABLE  `v_nos_raw`(
 `id_member` varchar(20) ,
 `point_type` enum('Member','Booker') ,
 `arrival_date` date ,
 `room_code` varchar(10) ,
 `number_of_stays` bigint(21) 
)*/;

/*Table structure for table `v_point_source` */

DROP TABLE IF EXISTS `v_point_source`;

/*!50001 DROP VIEW IF EXISTS `v_point_source` */;
/*!50001 DROP TABLE IF EXISTS `v_point_source` */;

/*!50001 CREATE TABLE  `v_point_source`(
 `id_member` varchar(20) ,
 `fullname` varchar(50) ,
 `join_date` varchar(10) ,
 `expiry_date` varchar(7) ,
 `point_in` decimal(34,0) ,
 `point_out` decimal(42,0) ,
 `balance` decimal(43,0) ,
 `last_update_point` timestamp 
)*/;

/*View structure for view trn_point_exp */

/*!50001 DROP TABLE IF EXISTS `trn_point_exp` */;
/*!50001 DROP VIEW IF EXISTS `trn_point_exp` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `trn_point_exp` AS select `trn_hotel`.`id_member` AS `id_member`,sum(`trn_hotel`.`total_revenue_converted`) AS `point_exp` from `trn_hotel` where (`trn_hotel`.`status` = 'Expired') group by `trn_hotel`.`id_member` */;

/*View structure for view trn_point_in */

/*!50001 DROP TABLE IF EXISTS `trn_point_in` */;
/*!50001 DROP VIEW IF EXISTS `trn_point_in` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `trn_point_in` AS select `trn_hotel`.`id_member` AS `id_member`,sum(((`trn_hotel`.`room_revenue_converted` + `trn_hotel`.`fnb_revenue_converted`) + `trn_hotel`.`other_revenue_converted`)) AS `point` from `trn_hotel` where (`trn_hotel`.`status` = 'Converted') group by `trn_hotel`.`id_member` */;

/*View structure for view v_member_point */

/*!50001 DROP TABLE IF EXISTS `v_member_point` */;
/*!50001 DROP VIEW IF EXISTS `v_member_point` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_member_point` AS select `m`.`id_member` AS `id_member`,`m`.`id_guest` AS `id_guest`,`m`.`fullname` AS `fullname`,`m`.`name_on_card` AS `name_on_card`,`rtm`.`nama` AS `member_level`,ifnull((select sum(`trn_point_in`.`point`) from `trn_point_in` where (`trn_point_in`.`id_member` = `m`.`id_member`)),0) AS `total_point`,ifnull((select sum((`trn_point_out`.`point` * `trn_point_out`.`qty`)) from `trn_point_out` where ((`trn_point_out`.`status` <> 'Canceled') and (`trn_point_out`.`id_reward` <> 0) and (`trn_point_out`.`id_member` = `m`.`id_member`))),0) AS `total_point_redeemed`,ifnull((select sum(`trn_point_exp`.`point_exp`) from `trn_point_exp` where (`trn_point_exp`.`id_member` = `m`.`id_member`)),0) AS `expired_point`,((ifnull((select sum(`trn_point_in`.`point`) from `trn_point_in` where (`trn_point_in`.`id_member` = `m`.`id_member`)),0) - ifnull((select sum((`trn_point_out`.`point` * `trn_point_out`.`qty`)) from `trn_point_out` where ((`trn_point_out`.`status` <> 'Canceled') and (`trn_point_out`.`id_reward` <> 0) and (`trn_point_out`.`id_member` = `m`.`id_member`))),0)) - ifnull((select sum((`trn_point_out`.`point` * `trn_point_out`.`qty`)) from `trn_point_out` where ((`trn_point_out`.`id_reward` = 0) and (`trn_point_out`.`id_member` = `m`.`id_member`))),0)) AS `point_balance` from (`mst_member` `m` join `ref_tipe_member` `rtm`) where (`m`.`id_tipe_member` = `rtm`.`id_tipe_member`) */;

/*View structure for view v_member_point2 */

/*!50001 DROP TABLE IF EXISTS `v_member_point2` */;
/*!50001 DROP VIEW IF EXISTS `v_member_point2` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_member_point2` AS select `m`.`id_member` AS `id_member`,`m`.`id_guest` AS `id_guest`,`m`.`fullname` AS `fullname`,`m`.`name_on_card` AS `name_on_card`,`rtm`.`nama` AS `nama`,ifnull((select sum(`trn_point_in`.`point`) from `trn_point_in` where (`trn_point_in`.`id_member` = `m`.`id_member`)),0) AS `total_point`,ifnull((select sum(`trn_point_out`.`point`) from `trn_point_out` where (`trn_point_out`.`id_member` = `m`.`id_member`)),0) AS `total_point_redeemed`,ifnull((select sum(`trn_point_exp`.`point_exp`) from `trn_point_exp` where (`trn_point_exp`.`id_member` = `m`.`id_member`)),0) AS `expired_point`,if((((ifnull((select sum(`trn_point_in`.`point`) from `trn_point_in` where (`trn_point_in`.`id_member` = `m`.`id_member`)),0) - ifnull((select sum(`trn_point_out`.`point`) from `trn_point_out` where (`trn_point_out`.`id_member` = `m`.`id_member`)),0)) - ifnull((select sum((`trn_point_out`.`point` * `trn_point_out`.`qty`)) from `trn_point_out` where ((`trn_point_out`.`id_reward` = 0) and (`trn_point_out`.`id_member` = `m`.`id_member`))),0)) < -(1)),0,((ifnull((select sum(`trn_point_in`.`point`) from `trn_point_in` where (`trn_point_in`.`id_member` = `m`.`id_member`)),0) - ifnull((select sum(`trn_point_out`.`point`) from `trn_point_out` where (`trn_point_out`.`id_member` = `m`.`id_member`)),0)) - ifnull((select sum((`trn_point_out`.`point` * `trn_point_out`.`qty`)) from `trn_point_out` where ((`trn_point_out`.`id_reward` = 0) and (`trn_point_out`.`id_member` = `m`.`id_member`))),0))) AS `point_balance` from (`mst_member` `m` join `ref_tipe_member` `rtm`) where (`m`.`id_tipe_member` = `rtm`.`id_tipe_member`) */;

/*View structure for view v_member_type */

/*!50001 DROP TABLE IF EXISTS `v_member_type` */;
/*!50001 DROP VIEW IF EXISTS `v_member_type` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_member_type` AS select `v`.`id_member` AS `id_member`,(select `m`.`name_on_card` from `mst_member` `m` where (`m`.`id_member` = `v`.`id_member`)) AS `name_on_card`,(select `m`.`is_print_card` from `mst_member` `m` where (`m`.`id_member` = `v`.`id_member`)) AS `is_print_card`,(`v`.`number_of_stays` + ifnull((select `m`.`initial_number_of_stays` from `mst_member` `m` where (`m`.`id_member` = `v`.`id_member`)),0)) AS `number_of_stays`,(select `r`.`nama` from (`ref_tipe_member` `r` join `mst_member` `m`) where ((`r`.`id_tipe_member` = `m`.`id_tipe_member`) and (`m`.`id_member` = `v`.`id_member`))) AS `member_type_actual`,(select `ref_tipe_member`.`nama` from `ref_tipe_member` where ((`v`.`number_of_stays` + ifnull((select `m`.`initial_number_of_stays` from `mst_member` `m` where (`m`.`id_member` = `v`.`id_member`)),0)) between `ref_tipe_member`.`min_stays` and `ref_tipe_member`.`max_stays`)) AS `member_type_suggested` from `v_nos` `v` where ((select `ref_tipe_member`.`nama` from `ref_tipe_member` where ((`v`.`number_of_stays` + ifnull((select `m`.`initial_number_of_stays` from `mst_member` `m` where (`m`.`id_member` = `v`.`id_member`)),0)) between `ref_tipe_member`.`min_stays` and `ref_tipe_member`.`max_stays`)) <> (select `r`.`nama` from (`ref_tipe_member` `r` join `mst_member` `m`) where ((`r`.`id_tipe_member` = `m`.`id_tipe_member`) and (`m`.`id_member` = `v`.`id_member`)))) */;

/*View structure for view v_non */

/*!50001 DROP TABLE IF EXISTS `v_non` */;
/*!50001 DROP VIEW IF EXISTS `v_non` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_non` AS select `t`.`id_member` AS `id_member`,sum(`t`.`number_of_nights`) AS `number_of_nights` from `trn_hotel` `t` group by `t`.`id_member` */;

/*View structure for view v_nos */

/*!50001 DROP TABLE IF EXISTS `v_nos` */;
/*!50001 DROP VIEW IF EXISTS `v_nos` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_nos` AS select `v_nos_gabung`.`id_member` AS `id_member`,sum(`v_nos_gabung`.`number_of_stays`) AS `number_of_stays` from `v_nos_gabung` group by `v_nos_gabung`.`id_member` */;

/*View structure for view v_nos_booker */

/*!50001 DROP TABLE IF EXISTS `v_nos_booker` */;
/*!50001 DROP VIEW IF EXISTS `v_nos_booker` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_nos_booker` AS select `v_nos_raw`.`id_member` AS `id_member`,'Booker' AS `point_type`,sum(`v_nos_raw`.`number_of_stays`) AS `number_of_stays` from `v_nos_raw` where (`v_nos_raw`.`point_type` = 'Booker') group by `v_nos_raw`.`id_member` */;

/*View structure for view v_nos_gabung */

/*!50001 DROP TABLE IF EXISTS `v_nos_gabung` */;
/*!50001 DROP VIEW IF EXISTS `v_nos_gabung` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_nos_gabung` AS select `v_nos_booker`.`id_member` AS `id_member`,`v_nos_booker`.`point_type` AS `point_type`,`v_nos_booker`.`number_of_stays` AS `number_of_stays` from `v_nos_booker` union select `v_nos_member`.`id_member` AS `id_member`,'Member' AS `point`,sum(`v_nos_member`.`number_of_stays`) AS `sum(number_of_stays)` from `v_nos_member` group by `v_nos_member`.`id_member` */;

/*View structure for view v_nos_member */

/*!50001 DROP TABLE IF EXISTS `v_nos_member` */;
/*!50001 DROP VIEW IF EXISTS `v_nos_member` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_nos_member` AS select `t`.`id_member` AS `id_member`,`t`.`arrival_date` AS `arrival_date`,max(`t`.`number_of_stays`) AS `number_of_stays` from `v_nos_raw` `t` where (`t`.`point_type` = 'Member') group by `t`.`id_member`,`t`.`arrival_date` */;

/*View structure for view v_nos_raw */

/*!50001 DROP TABLE IF EXISTS `v_nos_raw` */;
/*!50001 DROP VIEW IF EXISTS `v_nos_raw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_nos_raw` AS select `t`.`id_member` AS `id_member`,`t`.`point_type` AS `point_type`,`t`.`arrival_date` AS `arrival_date`,`t`.`room_code` AS `room_code`,count(`t`.`number_of_nights`) AS `number_of_stays` from `trn_hotel` `t` group by `t`.`id_member`,`t`.`point_type`,`t`.`arrival_date`,`t`.`room_code` */;

/*View structure for view v_point_source */

/*!50001 DROP TABLE IF EXISTS `v_point_source` */;
/*!50001 DROP VIEW IF EXISTS `v_point_source` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_point_source` AS select `t`.`id_member` AS `id_member`,`m`.`fullname` AS `fullname`,date_format(`m`.`join_date`,'%Y-%m-%d') AS `join_date`,date_format((`m`.`join_date` + interval 13 month),'%Y-%m') AS `expiry_date`,`t`.`point` AS `point_in`,(select sum((`trn_point_out`.`qty` * `trn_point_out`.`point`)) from `trn_point_out` where (`trn_point_out`.`id_member` = `t`.`id_member`)) AS `point_out`,(`t`.`point` - (select sum((`trn_point_out`.`qty` * `trn_point_out`.`point`)) from `trn_point_out` where (`trn_point_out`.`id_member` = `t`.`id_member`))) AS `balance`,(select max(`trn_hotel`.`waktu_upload`) from `trn_hotel` where (`trn_hotel`.`id_member` = `m`.`id_member`)) AS `last_update_point` from (`trn_point_in` `t` join `mst_member` `m`) where ((`t`.`id_member` = `m`.`id_member`) and (`t`.`point` > 0)) order by `m`.`id_member` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
