/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentable_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` json DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_login_attempts`;
CREATE TABLE `failed_login_attempts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `faththinks`;
CREATE TABLE `faththinks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `humidity` double(8,2) NOT NULL,
  `temperature` double(8,2) NOT NULL,
  `soil_moisture` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `mail_templates`;
CREATE TABLE `mail_templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_to_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bcc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `medias`;
CREATE TABLE `medias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint unsigned DEFAULT NULL,
  `collection` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint unsigned DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medias_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `medias_user_id_foreign` (`user_id`),
  CONSTRAINT `medias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `options_parent_id_foreign` (`parent_id`),
  CONSTRAINT `options_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `options` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `post_categories`;
CREATE TABLE `post_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_category_id` bigint DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_category_id` bigint DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `taggables`;
CREATE TABLE `taggables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` bigint unsigned NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `taggables_tag_id_foreign` (`tag_id`),
  KEY `taggables_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`),
  CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `telescope_entries`;
CREATE TABLE `telescope_entries` (
  `sequence` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sequence`),
  UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  KEY `telescope_entries_batch_id_index` (`batch_id`),
  KEY `telescope_entries_family_hash_index` (`family_hash`),
  KEY `telescope_entries_created_at_index` (`created_at`),
  KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `telescope_entries_tags`;
CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  KEY `telescope_entries_tags_tag_index` (`tag`),
  CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `telescope_monitoring`;
CREATE TABLE `telescope_monitoring` (
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `todos`;
CREATE TABLE `todos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `list_id` bigint unsigned DEFAULT NULL,
  `position` int NOT NULL DEFAULT '0',
  `due_date` date DEFAULT NULL,
  `due_time` time DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `archived_at` datetime DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `todos_list_id_foreign` (`list_id`),
  KEY `todos_user_id_foreign` (`user_id`),
  CONSTRAINT `todos_list_id_foreign` FOREIGN KEY (`list_id`) REFERENCES `options` (`id`) ON DELETE SET NULL,
  CONSTRAINT `todos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preference` json DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_update` json DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `event`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'mail_template', 'created', 'App\\Models\\Config\\MailTemplate', 1, 'created', NULL, NULL, '{\"ip\": \"127.0.0.1\", \"attributes\": {\"cc\": null, \"id\": 1, \"bcc\": null, \"code\": \"reset-password-confirmation\", \"from\": null, \"meta\": null, \"name\": \"Reset Password Confirmation\", \"uuid\": \"ec6db792-9658-45bd-93ac-3071eddd952b\", \"content\": \"<p>Hi ##NAME##,</p><p>You are receiving this email because we received a password reset request for your account.</p><p>Your password reset code is ##CODE##. This code is valid for next ##TOKEN_LIFETIME## minutes.</p><p>If you did not request a password reset, no further action is required.</p><p>Thank you!</p>\", \"subject\": \"Reset Password Confirmation\", \"reply_to\": null, \"from_name\": null, \"created_at\": \"2024-07-22T07:57:46.000000Z\", \"reply_to_name\": null}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `event`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(2, 'mail_template', 'created', 'App\\Models\\Config\\MailTemplate', 2, 'created', NULL, NULL, '{\"ip\": \"127.0.0.1\", \"attributes\": {\"cc\": null, \"id\": 2, \"bcc\": null, \"code\": \"email-change-confirmation\", \"from\": null, \"meta\": null, \"name\": \"Email Change Confirmation\", \"uuid\": \"6a6059f9-e91c-49da-a221-5eceeef9988c\", \"content\": \"<p>Hi ##NAME##,</p><p>We have recevied email change request from you!</p><p>Your one time verification code is ##CODE##.</p><p>This code is valid for ##TOKEN_LIFETIME## minutes.</p><p>If you haven\'t requested for email change, please ignore this email.</p><p>Thank you!</p>\", \"subject\": \"Email Change Confirmation\", \"reply_to\": null, \"from_name\": null, \"created_at\": \"2024-07-22T07:57:46.000000Z\", \"reply_to_name\": null}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `event`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(3, 'mail_template', 'created', 'App\\Models\\Config\\MailTemplate', 3, 'created', NULL, NULL, '{\"ip\": \"127.0.0.1\", \"attributes\": {\"cc\": null, \"id\": 3, \"bcc\": null, \"code\": \"reset-password-alert\", \"from\": null, \"meta\": null, \"name\": \"Reset Password Alert\", \"uuid\": \"67993c9a-78d6-4e30-a058-02f41770f0a4\", \"content\": \"<p>Hi ##NAME##,</p><p>Your password has been reset successfully!</p><p>Click on the below link to continue login.</p>[Login Now](##URL##)<p>If you haven\'t changed your password, please contact administrator.</p><p>Thank you!</p>\", \"subject\": \"Reset Password Alert\", \"reply_to\": null, \"from_name\": null, \"created_at\": \"2024-07-22T07:57:46.000000Z\", \"reply_to_name\": null}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `event`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(4, 'mail_template', 'created', 'App\\Models\\Config\\MailTemplate', 4, 'created', NULL, NULL, '{\"ip\": \"127.0.0.1\", \"attributes\": {\"cc\": null, \"id\": 4, \"bcc\": null, \"code\": \"send-email-otp\", \"from\": null, \"meta\": null, \"name\": \"Email OTP\", \"uuid\": \"c809071e-d2eb-40af-a158-e0b13444757a\", \"content\": \"<p>Hi ##NAME##,</p><p>Your one time password is: ##CODE##</p><p>This code is valid for the next ##TOKEN_LIFETIME## minutes!</p><p>Do not share this code with anyone else.</p><p>Thank you!</p>\", \"subject\": \"Email OTP\", \"reply_to\": null, \"from_name\": null, \"created_at\": \"2024-07-22T07:57:46.000000Z\", \"reply_to_name\": null}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(5, 'mail_template', 'created', 'App\\Models\\Config\\MailTemplate', 5, 'created', NULL, NULL, '{\"ip\": \"127.0.0.1\", \"attributes\": {\"cc\": null, \"id\": 5, \"bcc\": null, \"code\": \"two-factor-security\", \"from\": null, \"meta\": null, \"name\": \"Two Factor Security\", \"uuid\": \"d7d5496b-2f15-4fb7-a217-40ee69e4d5f4\", \"content\": \"<p>Hi ##NAME##,</p><p>Your one time two factor security code is: ##CODE##</p><p>This code is valid for the next ##TOKEN_LIFETIME## minutes!</p><p>Do not share this code with anyone else.</p><p>Thank you!</p>\", \"subject\": \"Two Factor Security\", \"reply_to\": null, \"from_name\": null, \"created_at\": \"2024-07-22T07:57:46.000000Z\", \"reply_to_name\": null}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(6, 'mail_template', 'created', 'App\\Models\\Config\\MailTemplate', 6, 'created', NULL, NULL, '{\"ip\": \"127.0.0.1\", \"attributes\": {\"cc\": null, \"id\": 6, \"bcc\": null, \"code\": \"user-email-verification\", \"from\": null, \"meta\": null, \"name\": \"Email Verification\", \"uuid\": \"b2c945e9-a376-4d78-9bab-e741d82ee1a9\", \"content\": \"<p>Hi ##NAME##,</p><p>Thank you for registering an account with us.</p><p>Click on the below link to verify your account.</p>[Verify my Email](##URL##)<p>If you haven\'t registered with us, please ignore this email.</p><p>Thank you!</p>\", \"subject\": \"Email Verification\", \"reply_to\": null, \"from_name\": null, \"created_at\": \"2024-07-22T07:57:46.000000Z\", \"reply_to_name\": null}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(7, 'mail_template', 'created', 'App\\Models\\Config\\MailTemplate', 7, 'created', NULL, NULL, '{\"ip\": \"127.0.0.1\", \"attributes\": {\"cc\": null, \"id\": 7, \"bcc\": null, \"code\": \"username-change-confirmation\", \"from\": null, \"meta\": null, \"name\": \"Username Change Confirmation\", \"uuid\": \"bd9dc311-fc28-4dc5-bf6c-dc198a20dd01\", \"content\": \"<p>Hi ##NAME##,</p><p>We have recevied username change request from you!</p><p>Your one time verification code is ##CODE##</p><p>This code is valid for the next ##TOKEN_LIFETIME## minutes!</p><p>If you haven\'t requested for username change, please ignore this email.</p><p>Thank you!</p>\", \"subject\": \"Username Change Confirmation\", \"reply_to\": null, \"from_name\": null, \"created_at\": \"2024-07-22T07:57:46.000000Z\", \"reply_to_name\": null}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(8, 'mail_template', 'created', 'App\\Models\\Config\\MailTemplate', 8, 'created', NULL, NULL, '{\"ip\": \"127.0.0.1\", \"attributes\": {\"cc\": null, \"id\": 8, \"bcc\": null, \"code\": \"account-registered\", \"from\": null, \"meta\": null, \"name\": \"Account Registered\", \"uuid\": \"7a1e4e27-1c8e-47f3-ba82-8e727c5911ce\", \"content\": \"<p>Hi ##NAME##,</p><p>Thank you for registering an account with us.</p><p>Click on the below link to login.</p>[Login Now](##URL##)<p>If you haven\'t registered with us, please ignore this email.</p><p>Thank you!</p>\", \"subject\": \"Account Registered\", \"reply_to\": null, \"from_name\": null, \"created_at\": \"2024-07-22T07:57:46.000000Z\", \"reply_to_name\": null}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(9, 'user', 'created', 'User', 1, 'created', NULL, NULL, '{\"ip\": \"127.0.0.1\", \"attributes\": {\"id\": 1, \"meta\": null, \"name\": \"cecep\", \"uuid\": \"1c0ffd0f-9f89-4b75-be5b-26f118a4361a\", \"email\": \"cecep@fathforce.com\", \"status\": \"activated\", \"password\": \"$2y$10$xbgkEx9Q/0D3XidBvheq3OCuhTtuOAiGDxzqcTixuJHDjzlvefhey\", \"username\": \"admin\", \"created_at\": \"2024-07-22T07:57:47.000000Z\", \"preference\": null, \"pending_update\": null, \"remember_token\": null, \"email_verified_at\": \"2024-07-22 07:57:47\"}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 07:57:47', '2024-07-22 07:57:47'),
(10, 'user', 'updated', 'User', 1, 'updated', NULL, NULL, '{\"ip\": \"127.0.0.1\", \"old\": {\"meta\": null}, \"attributes\": {\"meta\": {\"is_default\": true}}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 07:57:47', '2024-07-22 07:57:47'),
(11, 'user', 'logged_in', NULL, NULL, NULL, 'User', 1, '{\"ip\": \"127.0.0.1\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 07:58:21', '2024-07-22 07:58:21'),
(12, 'user', 'updated', 'User', 1, 'updated', 'User', 1, '{\"ip\": \"127.0.0.1\", \"old\": {\"preference\": null}, \"attributes\": {\"preference\": {\"layout\": {\"display\": \"light\", \"sidebar\": \"pinned\"}, \"system\": {\"locale\": \"id\", \"timezone\": \"Asia/Kolkata\", \"date_format\": \"MMMM D, YYYY\", \"time_format\": \"h:mm A\"}}}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36\"}', NULL, '2024-07-22 09:17:28', '2024-07-22 09:17:28'),
(13, 'user', 'logged_in', NULL, NULL, NULL, 'User', 1, '{\"ip\": \"127.0.0.1\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36\"}', NULL, '2024-09-17 04:16:53', '2024-09-17 04:16:53'),
(14, 'user', 'updated', 'User', 1, 'updated', 'User', 1, '{\"ip\": \"127.0.0.1\", \"old\": {\"preference\": {\"layout\": {\"display\": \"light\", \"sidebar\": \"pinned\"}, \"system\": {\"locale\": \"id\", \"timezone\": \"Asia/Kolkata\", \"date_format\": \"MMMM D, YYYY\", \"time_format\": \"h:mm A\"}}}, \"attributes\": {\"preference\": {\"layout\": {\"display\": \"light\", \"sidebar\": \"mini\"}, \"system\": {\"locale\": \"id\", \"timezone\": \"Asia/Kolkata\", \"date_format\": \"MMMM D, YYYY\", \"time_format\": \"h:mm A\"}}}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36\"}', NULL, '2024-09-17 04:17:21', '2024-09-17 04:17:21'),
(15, 'user', 'updated', 'User', 1, 'updated', 'User', 1, '{\"ip\": \"127.0.0.1\", \"old\": {\"preference\": {\"layout\": {\"display\": \"light\", \"sidebar\": \"mini\"}, \"system\": {\"locale\": \"id\", \"timezone\": \"Asia/Kolkata\", \"date_format\": \"MMMM D, YYYY\", \"time_format\": \"h:mm A\"}}}, \"attributes\": {\"preference\": {\"layout\": {\"display\": \"light\", \"sidebar\": \"pinned\"}, \"system\": {\"locale\": \"id\", \"timezone\": \"Asia/Kolkata\", \"date_format\": \"MMMM D, YYYY\", \"time_format\": \"h:mm A\"}}}, \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36\"}', NULL, '2024-09-17 04:17:23', '2024-09-17 04:17:23');













INSERT INTO `mail_templates` (`id`, `uuid`, `name`, `code`, `subject`, `content`, `from`, `from_name`, `reply_to`, `reply_to_name`, `cc`, `bcc`, `meta`, `created_at`, `updated_at`) VALUES
(1, 'ec6db792-9658-45bd-93ac-3071eddd952b', 'Reset Password Confirmation', 'reset-password-confirmation', 'Reset Password Confirmation', '<p>Hi ##NAME##,</p><p>You are receiving this email because we received a password reset request for your account.</p><p>Your password reset code is ##CODE##. This code is valid for next ##TOKEN_LIFETIME## minutes.</p><p>If you did not request a password reset, no further action is required.</p><p>Thank you!</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46');
INSERT INTO `mail_templates` (`id`, `uuid`, `name`, `code`, `subject`, `content`, `from`, `from_name`, `reply_to`, `reply_to_name`, `cc`, `bcc`, `meta`, `created_at`, `updated_at`) VALUES
(2, '6a6059f9-e91c-49da-a221-5eceeef9988c', 'Email Change Confirmation', 'email-change-confirmation', 'Email Change Confirmation', '<p>Hi ##NAME##,</p><p>We have recevied email change request from you!</p><p>Your one time verification code is ##CODE##.</p><p>This code is valid for ##TOKEN_LIFETIME## minutes.</p><p>If you haven\'t requested for email change, please ignore this email.</p><p>Thank you!</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46');
INSERT INTO `mail_templates` (`id`, `uuid`, `name`, `code`, `subject`, `content`, `from`, `from_name`, `reply_to`, `reply_to_name`, `cc`, `bcc`, `meta`, `created_at`, `updated_at`) VALUES
(3, '67993c9a-78d6-4e30-a058-02f41770f0a4', 'Reset Password Alert', 'reset-password-alert', 'Reset Password Alert', '<p>Hi ##NAME##,</p><p>Your password has been reset successfully!</p><p>Click on the below link to continue login.</p>[Login Now](##URL##)<p>If you haven\'t changed your password, please contact administrator.</p><p>Thank you!</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46');
INSERT INTO `mail_templates` (`id`, `uuid`, `name`, `code`, `subject`, `content`, `from`, `from_name`, `reply_to`, `reply_to_name`, `cc`, `bcc`, `meta`, `created_at`, `updated_at`) VALUES
(4, 'c809071e-d2eb-40af-a158-e0b13444757a', 'Email OTP', 'send-email-otp', 'Email OTP', '<p>Hi ##NAME##,</p><p>Your one time password is: ##CODE##</p><p>This code is valid for the next ##TOKEN_LIFETIME## minutes!</p><p>Do not share this code with anyone else.</p><p>Thank you!</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(5, 'd7d5496b-2f15-4fb7-a217-40ee69e4d5f4', 'Two Factor Security', 'two-factor-security', 'Two Factor Security', '<p>Hi ##NAME##,</p><p>Your one time two factor security code is: ##CODE##</p><p>This code is valid for the next ##TOKEN_LIFETIME## minutes!</p><p>Do not share this code with anyone else.</p><p>Thank you!</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(6, 'b2c945e9-a376-4d78-9bab-e741d82ee1a9', 'Email Verification', 'user-email-verification', 'Email Verification', '<p>Hi ##NAME##,</p><p>Thank you for registering an account with us.</p><p>Click on the below link to verify your account.</p>[Verify my Email](##URL##)<p>If you haven\'t registered with us, please ignore this email.</p><p>Thank you!</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(7, 'bd9dc311-fc28-4dc5-bf6c-dc198a20dd01', 'Username Change Confirmation', 'username-change-confirmation', 'Username Change Confirmation', '<p>Hi ##NAME##,</p><p>We have recevied username change request from you!</p><p>Your one time verification code is ##CODE##</p><p>This code is valid for the next ##TOKEN_LIFETIME## minutes!</p><p>If you haven\'t requested for username change, please ignore this email.</p><p>Thank you!</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(8, '7a1e4e27-1c8e-47f3-ba82-8e727c5911ce', 'Account Registered', 'account-registered', 'Account Registered', '<p>Hi ##NAME##,</p><p>Thank you for registering an account with us.</p><p>Click on the below link to login.</p>[Login Now](##URL##)<p>If you haven\'t registered with us, please ignore this email.</p><p>Thank you!</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-22 07:57:46', '2024-07-22 07:57:46');



INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2018_08_08_100000_create_telescope_entries_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_04_02_133851_create_activity_log_table', 1),
(7, '2021_04_02_134344_create_permission_tables', 1),
(8, '2021_04_02_135516_create_jobs_table', 1),
(9, '2021_04_03_133553_create_tags_table', 1),
(10, '2021_04_03_133628_create_taggables_table', 1),
(11, '2021_04_03_133705_create_comments_table', 1),
(12, '2021_04_04_100237_create_configs_table', 1),
(13, '2021_04_07_133811_create_medias_table', 1),
(14, '2021_10_03_133737_create_options_table', 1),
(15, '2021_10_03_133823_create_todos_table', 1),
(16, '2022_10_15_095734_create_mail_templates_table', 1),
(17, '2022_11_27_110101_create_projects_table', 1),
(18, '2022_12_28_025905_create_failed_login_attempts_table', 1),
(19, '2024_01_11_021518_create_product_categories_table', 1),
(20, '2024_01_11_033743_create_products_table', 1),
(21, '2024_01_13_060336_create_post_categories_table', 1),
(22, '2024_01_13_060345_create_posts_table', 1),
(23, '2024_02_02_073755_create_faththinks_table', 1);



INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'User', 1);






INSERT INTO `permissions` (`id`, `uuid`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'aa442070-e411-4b3b-a36e-7da2a3e2265e', 'login:action', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46');
INSERT INTO `permissions` (`id`, `uuid`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, '3e813eec-94b6-4ad0-86bf-f6f342151adc', 'config:store', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46');
INSERT INTO `permissions` (`id`, `uuid`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'af892a0d-c1cc-4310-a25a-d4cb71ac117e', 'locale:read', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46');
INSERT INTO `permissions` (`id`, `uuid`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(4, '9112e061-aa78-461f-ba3f-96d1a95f541c', 'locale:create', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(5, 'b603be29-20b3-4a57-b916-c8380c4fc1e5', 'locale:edit', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(6, '0528997f-60a3-4779-8563-9f95dde67e28', 'locale:delete', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(7, '6ab29562-d675-48a2-a8bb-409a8d354736', 'backup:manage', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(8, '256a4cee-061b-4b76-99e8-9af9e0a1b01c', 'activity-log:manage', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(9, '65d15da8-04a4-4fe0-93bd-0c95ce181725', 'activity-log:export', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(10, 'fcc7bca0-813e-4a4c-abc0-dcb3d79f463b', 'utility:config', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(11, '6d58d8e9-ca8c-4a1d-b062-412d06b36a5e', 'todo:manage', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(12, '74262e48-1753-4f82-aaea-a0826cdd62f6', 'todo:export', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(13, 'a7ae4c4b-e6a3-4fb5-ab6c-ce7e9b7f1e59', 'user:read', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(14, 'a3e1af93-bb4e-4da0-ae10-965772401e18', 'user:create', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(15, '96abd929-90c2-481d-873c-4c0d9c273849', 'user:edit', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(16, '14044f2f-234e-484e-89fa-6ae096ef803d', 'user:delete', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(17, 'bd276963-88ea-49d5-8d31-dd246e34808e', 'user:export', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(18, 'cf327b58-0714-4eb7-a313-ad0fcb365f14', 'project:read', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(19, '7dc8d3ae-00a0-444f-9f94-55f88429b927', 'project:create', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(20, '0c105585-6452-4398-9238-b995bb0fe644', 'project:edit', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(21, '2c8fae2f-aff0-4419-8c5d-f2393ad50019', 'project:delete', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(22, 'f5b77e9f-303b-4187-a7d9-7f76f48c5732', 'project:export', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(23, '8abf1042-0e8c-4d6d-9a70-a95c05782bf5', 'product:read', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(24, '0a8a1c1f-6a02-4390-8835-0a10e651914b', 'product:create', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(25, '1354ec89-e5a1-46f9-9139-8f40e9ee450a', 'product:edit', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(26, 'ca2b24a3-ef29-4612-9acf-95088e6c70c9', 'product:delete', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(27, '0819d59a-a57b-4135-8911-1ed92d845291', 'product:export', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(28, 'dfc2d2a1-3926-482d-be60-68d3032a67e6', 'productcategory:read', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(29, '49438eb5-5634-40ad-b140-f7231c7ceb0c', 'productcategory:create', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(30, 'dfe79edf-72f4-40b4-968f-2fb3af09149b', 'productcategory:edit', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(31, 'd188323a-7970-4921-a865-23f9e1dbe19b', 'productcategory:delete', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(32, '9f6d2cc9-33ea-4190-8619-c1c68f02c6bb', 'productcategory:export', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(33, '34525302-aa4b-46ec-b1a2-9a836214f6f5', 'post:read', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(34, '68c07253-f784-467a-993b-417ff0235d56', 'post:create', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(35, 'a7909986-da7e-43aa-bcd9-68d774051f2f', 'post:edit', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(36, 'f49187d9-e567-4009-be21-99a8d1e71f60', 'post:delete', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(37, '033e182d-f857-4284-8d9a-fe49424b0599', 'post:export', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(38, 'f9f174da-8ce3-4d78-9546-d84a34186bd8', 'postcategory:read', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(39, '6553651e-c7e2-4c06-99c4-cf164d81b3a8', 'postcategory:create', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(40, '7164c9df-6eef-4262-bc0b-40f28b28e373', 'postcategory:edit', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(41, 'e83d5819-7e8a-4350-8b86-e1451f63be13', 'postcategory:delete', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46'),
(42, 'adb0aca8-0e6f-4b23-91b2-6b669c2eadfd', 'postcategory:export', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46');



INSERT INTO `post_categories` (`id`, `uuid`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, '0ecf4ae7-8c36-42cd-900d-9514cfd4ac31', 'Sample', 'sample', '2024-07-22 08:16:08', '2024-07-22 08:16:08');










INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2);
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(11, 2);


INSERT INTO `roles` (`id`, `uuid`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, '79c45fe2-fecd-4781-8818-6792cb527d98', 'admin', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46');
INSERT INTO `roles` (`id`, `uuid`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, '78b07293-c8f6-4ad1-a4d4-9ba28cd239ec', 'user', 'web', '2024-07-22 07:57:46', '2024-07-22 07:57:46');














INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `username`, `email_verified_at`, `password`, `status`, `preference`, `remember_token`, `pending_update`, `meta`, `created_at`, `updated_at`) VALUES
(1, '1c0ffd0f-9f89-4b75-be5b-26f118a4361a', 'cecep', 'cecep@fathforce.com', 'admin', '2024-07-22 07:57:47', '$2y$10$xbgkEx9Q/0D3XidBvheq3OCuhTtuOAiGDxzqcTixuJHDjzlvefhey', 'activated', '{\"layout\": {\"display\": \"light\", \"sidebar\": \"pinned\"}, \"system\": {\"locale\": \"id\", \"timezone\": \"Asia/Kolkata\", \"date_format\": \"MMMM D, YYYY\", \"time_format\": \"h:mm A\"}}', NULL, NULL, '{\"is_default\": true}', '2024-07-22 07:57:47', '2024-09-17 04:17:23');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;