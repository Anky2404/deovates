-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2026 at 02:08 PM
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
-- Database: `u875430199_dw`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_values`)),
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_values`)),
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `method` varchar(10) DEFAULT NULL,
  `level` enum('info','warning','error','critical') NOT NULL DEFAULT 'info',
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `is_system` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `uuid`, `user_id`, `user_role`, `action`, `module`, `subject_type`, `subject_id`, `old_values`, `new_values`, `description`, `ip_address`, `user_agent`, `url`, `method`, `level`, `meta`, `is_system`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '4d0f657d-4918-4137-bcd2-116db636628b', 1, 'Admin', 'DELETE', 'BLOG', 'App\\Models\\Blog', 11, NULL, '{\"id\":11,\"uuid\":\"a459248d-ee23-11f0-a0af-1860247b6ae0\",\"category_id\":2,\"author_id\":1,\"title\":\"How Digital Health Is Improving Patient Outcomes\",\"slug\":\"how-digital-health-is-improving-patient-outcomes\",\"excerpt\":\"<p>Digital health solutions are improving patient outcomes through better accessibility, data-driven care, and remote monitoring.<\\/p>\",\"content\":\"<p>Digital health technologies such as remote patient monitoring, mobile health apps, and electronic health records enable continuous and personalized care.<\\/p>\\r\\n\\r\\n<p>Healthcare providers leverage analytics and AI to reduce readmissions and improve treatment accuracy.<\\/p>\",\"featured_image\":\"blogs\\/a459248d-ee23-11f0-a0af-1860247b6ae0\\/1770038958_whatsapp-image-2026-01-17-at-105701-pm.jpeg\",\"og_image\":null,\"meta_title\":\"Digital Health Improving Patient Outcomes\",\"meta_description\":\"Learn how digital health solutions are improving patient outcomes through remote monitoring, analytics, and personalized care.\",\"meta_keywords\":null,\"canonical_url\":\"https:\\/\\/example.com\\/blogs\\/how-digital-health-is-improving-patient-outcomes\",\"status\":\"published\",\"published_at\":\"2026-01-10T18:25:00.000000Z\",\"is_featured\":false,\"is_active\":true,\"views\":260,\"reading_time\":5,\"comment_count\":2,\"created_at\":\"2026-01-10T18:25:29.000000Z\",\"updated_at\":\"2026-06-04T08:42:16.000000Z\",\"deleted_at\":\"2026-06-04T08:42:16.000000Z\"}', 'Blog \'How Digital Health Is Improving Patient Outcomes\' deleted.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/destroy/a459248d-ee23-11f0-a0af-1860247b6ae0', 'DELETE', 'warning', NULL, 0, '2026-06-04 03:12:16', '2026-06-04 03:12:16', NULL),
(2, '75f1d03b-3729-4890-85c8-515786949fe1', 1, 'Admin', 'UPDATE', 'BLOG', 'App\\Models\\Blog', 12, '{\"id\":12,\"uuid\":\"a459432c-ee23-11f0-a0af-1860247b6ae0\",\"category_id\":5,\"author_id\":1,\"title\":\"Modern Web Development Tools Every Developer Should Know\",\"slug\":\"modern-web-development-tools-every-developer-should-know\",\"excerpt\":\"<p>Modern web development depends on powerful tools that improve productivity, performance, and collaboration.<\\/p>\",\"content\":\"<p>Developers rely on frameworks, build tools, and performance monitoring solutions to create fast and scalable applications.<\\/p>\\r\\n\\r\\n<p>Choosing the right tools improves code quality and long-term maintainability.<\\/p>\",\"featured_image\":\"blogs\\/a459432c-ee23-11f0-a0af-1860247b6ae0\\/1770038996_whatsapp-image-2026-01-17-at-105702-pm-1.jpeg\",\"og_image\":null,\"meta_title\":\"Modern Web Development Tools & Frameworks\",\"meta_description\":\"Discover essential modern web development tools every developer should know to build scalable applications.\",\"meta_keywords\":null,\"canonical_url\":\"https:\\/\\/example.com\\/blogs\\/modern-web-development-tools-every-developer-should-know\",\"status\":\"published\",\"published_at\":\"2026-01-10T18:25:00.000000Z\",\"is_featured\":false,\"is_active\":true,\"views\":195,\"reading_time\":4,\"comment_count\":1,\"created_at\":\"2026-01-10T18:25:29.000000Z\",\"updated_at\":\"2026-02-02T13:29:56.000000Z\",\"deleted_at\":null}', '{\"id\":12,\"uuid\":\"a459432c-ee23-11f0-a0af-1860247b6ae0\",\"category_id\":5,\"author_id\":1,\"title\":\"Modern Web Development Tools Every Developer Should Know\",\"slug\":\"modern-web-development-tools-every-developer-should-know\",\"excerpt\":\"<p>Modern web development depends on powerful tools that improve productivity, performance, and collaboration.<\\/p>\",\"content\":\"<p>Developers rely on frameworks, build tools, and performance monitoring solutions to create fast and scalable applications.<\\/p>\\r\\n\\r\\n<p>Choosing the right tools improves code quality and long-term maintainability.<\\/p>\",\"featured_image\":\"blogs\\/a459432c-ee23-11f0-a0af-1860247b6ae0\\/1780638205_6.jpg\",\"og_image\":\"blogs\\/a459432c-ee23-11f0-a0af-1860247b6ae0\\/og_1780638206_7.jpg\",\"meta_title\":\"Modern Web Development Tools & Frameworks\",\"meta_description\":\"Discover essential modern web development tools every developer should know to build scalable applications.\",\"meta_keywords\":null,\"canonical_url\":\"https:\\/\\/example.com\\/blogs\\/modern-web-development-tools-every-developer-should-know\",\"status\":\"published\",\"published_at\":\"2026-01-10T18:25:00.000000Z\",\"is_featured\":false,\"is_active\":true,\"views\":195,\"reading_time\":4,\"comment_count\":1,\"created_at\":\"2026-01-10T18:25:29.000000Z\",\"updated_at\":\"2026-06-05T05:43:26.000000Z\",\"deleted_at\":null}', 'Blog \'Modern Web Development Tools Every Developer Should Know\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/saveorupdate/a459432c-ee23-11f0-a0af-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-06-05 00:13:26', '2026-06-05 00:13:26', NULL),
(3, '69148c1d-695e-4ceb-af6a-7c0b5b6931a3', 1, 'Admin', 'DEACTIVATE', 'BLOG', 'App\\Models\\Blog', 12, '{\"is_active\":true}', '{\"is_active\":false}', 'Blog \'Modern Web Development Tools Every Developer Should Know\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/togglestatus/a459432c-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-05 00:15:34', '2026-06-05 00:15:34', NULL),
(4, '6b7f02a9-bc2d-44dc-9b47-b687d4360b9a', 1, 'Super Admin', 'ACTIVATE', 'BlogCategory', 'App\\Models\\BlogCategory', 30, '{\"is_active\":false}', '{\"is_active\":true}', 'Blog Category \'Technology Trends\' activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/togglestatus/102c9055-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 00:28:31', '2026-06-08 00:28:31', NULL),
(5, 'c945b9a7-3f23-448e-8628-e74ceaab3ca6', 1, 'Super Admin', 'DEACTIVATE', 'BlogCategory', 'App\\Models\\BlogCategory', 30, '{\"is_active\":true}', '{\"is_active\":false}', 'Blog Category \'Technology Trends\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/togglestatus/102c9055-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 00:28:46', '2026-06-08 00:28:46', NULL),
(6, '902a84b5-b559-4708-9994-67bfecb7ef9b', 1, 'Super Admin', 'ACTIVATE', 'BlogCategory', 'App\\Models\\BlogCategory', 30, '{\"is_active\":false}', '{\"is_active\":true}', 'Blog Category \'Technology Trends\' activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/togglestatus/102c9055-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 00:29:16', '2026-06-08 00:29:16', NULL),
(7, '513d48cd-1449-4161-a312-69aa1ebdc3df', 1, 'Super Admin', 'DEACTIVATE', 'BlogCategory', 'App\\Models\\BlogCategory', 30, '{\"is_active\":true}', '{\"is_active\":false}', 'Blog Category \'Technology Trends\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/togglestatus/102c9055-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 00:29:27', '2026-06-08 00:29:27', NULL),
(8, '2ce2ad92-bc88-478f-9f67-74cf7b344fd6', 1, 'Super Admin', 'UPDATE', 'BlogCategory', 'App\\Models\\BlogCategory', 30, '{\"id\":30,\"uuid\":\"102c9055-ee23-11f0-a0af-1860247b6ae0\",\"name\":\"Technology Trends\",\"slug\":\"technology-trends\",\"icon\":\"bx bx-bulb\",\"image\":null,\"description\":\"Technology trend blogs covering emerging innovations, future tech, and digital transformation.\",\"meta_title\":\"Technology Trends Blogs, Future Tech & Innovation\",\"meta_description\":\"Explore technology trends blogs covering emerging innovations, future technologies, and digital transformation strategies.\",\"is_active\":false,\"created_at\":\"2026-01-10T18:21:21.000000Z\",\"updated_at\":\"2026-06-08T05:59:27.000000Z\",\"deleted_at\":null}', '{\"id\":30,\"uuid\":\"102c9055-ee23-11f0-a0af-1860247b6ae0\",\"name\":\"Technology Trends\",\"slug\":\"technology-trends\",\"icon\":\"bx bx-bulb\",\"image\":null,\"description\":\"<p>Technology trend blogs covering emerging innovations, future tech, and digital transformation.<\\/p>\",\"meta_title\":\"Technology Trends Blogs, Future Tech & Innovation\",\"meta_description\":\"Explore technology trends blogs covering emerging innovations, future technologies, and digital transformation strategies.\",\"is_active\":false,\"created_at\":\"2026-01-10T18:21:21.000000Z\",\"updated_at\":\"2026-06-08T06:00:49.000000Z\",\"deleted_at\":null}', 'Blog Category \'Technology Trends\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/saveorupdate/102c9055-ee23-11f0-a0af-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-06-08 00:30:49', '2026-06-08 00:30:49', NULL),
(9, '9729c167-8ed8-439d-b7fb-828799c57063', 1, 'Super Admin', 'ACTIVATE', 'BlogCategory', 'App\\Models\\BlogCategory', 30, '{\"is_active\":false}', '{\"is_active\":true}', 'Blog Category \'Technology Trends\' activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/togglestatus/102c9055-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 00:31:05', '2026-06-08 00:31:05', NULL),
(10, '5be71724-b99b-4ed6-978f-608019370078', 1, 'Super Admin', 'DEACTIVATE', 'BlogCategory', 'App\\Models\\BlogCategory', 30, '{\"is_active\":true}', '{\"is_active\":false}', 'Blog Category \'Technology Trends\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/togglestatus/102c9055-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 00:31:30', '2026-06-08 00:31:30', NULL),
(11, 'b7d8d16c-2dab-4cb8-ac54-4e2b84327077', 1, 'Super Admin', 'DELETE', 'BlogCategory', 'App\\Models\\BlogCategory', 30, NULL, '{\"id\":30,\"uuid\":\"102c9055-ee23-11f0-a0af-1860247b6ae0\",\"name\":\"Technology Trends\",\"slug\":\"technology-trends\",\"icon\":\"bx bx-bulb\",\"image\":null,\"description\":\"<p>Technology trend blogs covering emerging innovations, future tech, and digital transformation.<\\/p>\",\"meta_title\":\"Technology Trends Blogs, Future Tech & Innovation\",\"meta_description\":\"Explore technology trends blogs covering emerging innovations, future technologies, and digital transformation strategies.\",\"is_active\":false,\"created_at\":\"2026-01-10T18:21:21.000000Z\",\"updated_at\":\"2026-06-08T06:01:30.000000Z\",\"deleted_at\":null}', 'Blog Category \'Technology Trends\' deleted.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/destroy/102c9055-ee23-11f0-a0af-1860247b6ae0', 'DELETE', 'warning', NULL, 0, '2026-06-08 00:32:09', '2026-06-08 00:32:09', NULL),
(12, 'ee0207a6-857c-4c5a-9288-1ad43d67b0be', 1, 'Super Admin', 'DEACTIVATE', 'BlogCategory', 'App\\Models\\BlogCategory', 29, '{\"is_active\":true}', '{\"is_active\":false}', 'Blog Category \'Digital Payments\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/togglestatus/102c8fea-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 00:33:08', '2026-06-08 00:33:08', NULL),
(13, '4822b321-7ac8-44fb-95ba-704e4527fadf', 1, 'Super Admin', 'DELETE', 'Author', 'App\\Models\\Author', 20, '{\"is_active\":true}', '{\"is_active\":false}', 'Author \'\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/authors/togglestatus/951d842c-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 00:57:51', '2026-06-08 00:57:51', NULL),
(14, '20456f2e-1e7c-4000-8b1e-2a6b29d2ac20', 1, 'Super Admin', 'DELETE', 'Author', 'App\\Models\\Author', 20, '{\"is_active\":false}', '{\"is_active\":true}', 'Author \'\' activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/authors/togglestatus/951d842c-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 01:00:41', '2026-06-08 01:00:41', NULL),
(15, 'c30cdb1f-505b-4576-a63a-ddb3bb949b90', 1, 'Super Admin', 'DELETE', 'Author', 'App\\Models\\Author', 20, '{\"is_active\":true}', '{\"is_active\":false}', 'Author \'\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/authors/togglestatus/951d842c-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 01:00:44', '2026-06-08 01:00:44', NULL),
(16, '4e52f91f-b2c4-4206-a2a2-4dc1ec885ff2', 1, 'Super Admin', 'DELETE', 'Author', 'App\\Models\\Author', 19, '{\"is_active\":true}', '{\"is_active\":false}', 'Author \'\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/authors/togglestatus/951d8396-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 01:00:56', '2026-06-08 01:00:56', NULL),
(17, '631e3420-b3cd-461d-a429-06be1afb6bf8', 1, 'Super Admin', 'UPDATE', 'Author', 'App\\Models\\Author', 20, '{\"id\":20,\"uuid\":\"951d842c-ee23-11f0-a0af-1860247b6ae0\",\"user_id\":null,\"name\":\"Manish Gupta\",\"slug\":\"manish-gupta\",\"email\":\"manish.g@gmail.com\",\"phone\":\"9876543229\",\"profile_image\":null,\"cover_image\":null,\"bio\":\"Manish Gupta covers digital transformation, enterprise systems, and business automation.\",\"designation\":\"Digital Transformation Consultant\",\"company\":\"TransformX\",\"website\":\"https:\\/\\/transformx.io\",\"social_links\":{\"linkedin\":\"https:\\/\\/linkedin.com\\/in\\/manishgupta\"},\"meta_title\":\"Manish Gupta \\u2013 Digital Transformation Blogs\",\"meta_description\":\"Digital transformation and automation blogs by Manish Gupta.\",\"total_blogs\":29,\"is_featured\":true,\"is_active\":false,\"created_at\":\"2026-01-10T18:25:04.000000Z\",\"updated_at\":\"2026-06-08T06:30:44.000000Z\",\"deleted_at\":null}', '{\"id\":20,\"uuid\":\"951d842c-ee23-11f0-a0af-1860247b6ae0\",\"user_id\":null,\"name\":\"Manish Gupta1\",\"slug\":\"manish-gupta1\",\"email\":\"manish.g@gmail.com\",\"phone\":\"9876543229\",\"profile_image\":null,\"cover_image\":null,\"bio\":\"Manish Gupta covers digital transformation, enterprise systems, and business automation.\",\"designation\":\"Digital Transformation Consultant\",\"company\":\"TransformX\",\"website\":\"https:\\/\\/transformx.io\",\"social_links\":{\"linkedin\":\"https:\\/\\/linkedin.com\\/in\\/manishgupta\"},\"meta_title\":\"Manish Gupta \\u2013 Digital Transformation Blogs\",\"meta_description\":\"Digital transformation and automation blogs by Manish Gupta.\",\"total_blogs\":0,\"is_featured\":true,\"is_active\":false,\"created_at\":\"2026-01-10T18:25:04.000000Z\",\"updated_at\":\"2026-06-08T06:31:25.000000Z\",\"deleted_at\":null}', 'Author \'Manish Gupta1\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/authors/saveorupdate/951d842c-ee23-11f0-a0af-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-06-08 01:01:25', '2026-06-08 01:01:25', NULL),
(18, 'ece9eecd-05c7-4a4a-b4e2-9c00b4deed65', 1, 'Super Admin', 'DELETE', 'Author', 'App\\Models\\Author', 19, '{\"is_active\":false}', '{\"is_active\":true}', 'Author \'\' activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/authors/togglestatus/951d8396-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 01:01:31', '2026-06-08 01:01:31', NULL),
(19, 'c0587a26-42ea-4dd9-8a24-d5ba83978518', 1, 'Super Admin', 'DELETE', 'Author', 'App\\Models\\Author', 20, NULL, '{\"id\":20,\"uuid\":\"951d842c-ee23-11f0-a0af-1860247b6ae0\",\"user_id\":null,\"name\":\"Manish Gupta1\",\"slug\":\"manish-gupta1\",\"email\":\"manish.g@gmail.com\",\"phone\":\"9876543229\",\"profile_image\":null,\"cover_image\":null,\"bio\":\"Manish Gupta covers digital transformation, enterprise systems, and business automation.\",\"designation\":\"Digital Transformation Consultant\",\"company\":\"TransformX\",\"website\":\"https:\\/\\/transformx.io\",\"social_links\":{\"linkedin\":\"https:\\/\\/linkedin.com\\/in\\/manishgupta\"},\"meta_title\":\"Manish Gupta \\u2013 Digital Transformation Blogs\",\"meta_description\":\"Digital transformation and automation blogs by Manish Gupta.\",\"total_blogs\":0,\"is_featured\":true,\"is_active\":false,\"created_at\":\"2026-01-10T18:25:04.000000Z\",\"updated_at\":\"2026-06-08T06:31:52.000000Z\",\"deleted_at\":\"2026-06-08T06:31:52.000000Z\"}', 'Author \'Manish Gupta1\' deleted.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/authors/destroy/951d842c-ee23-11f0-a0af-1860247b6ae0', 'DELETE', 'warning', NULL, 0, '2026-06-08 01:01:52', '2026-06-08 01:01:52', NULL),
(20, 'c85266c1-86dd-4713-9b02-d2bf74e54227', 1, 'Super Admin', 'ACTIVATE', 'BlogCategory', 'App\\Models\\BlogCategory', 29, '{\"is_active\":false}', '{\"is_active\":true}', 'Blog Category \'Digital Payments\' activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/togglestatus/102c8fea-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 01:05:49', '2026-06-08 01:05:49', NULL),
(21, '414525ee-35de-4be8-9ed1-3f537a8b7093', 1, 'Super Admin', 'DEACTIVATE', 'BlogCategory', 'App\\Models\\BlogCategory', 29, '{\"is_active\":true}', '{\"is_active\":false}', 'Blog Category \'Digital Payments\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/togglestatus/102c8fea-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 01:06:00', '2026-06-08 01:06:00', NULL),
(22, '28d9a1bb-a326-41a8-8d47-37434bb91ead', 1, 'Super Admin', 'UPDATE', 'BlogCategory', 'App\\Models\\BlogCategory', 29, '{\"id\":29,\"uuid\":\"102c8fea-ee23-11f0-a0af-1860247b6ae0\",\"name\":\"Digital Payments\",\"slug\":\"digital-payments\",\"icon\":\"bx bx-wallet\",\"image\":null,\"description\":\"Digital payment blogs focused on UPI, wallets, online transactions, and payment security.\",\"meta_title\":\"Digital Payments Blogs, UPI & Online Transactions\",\"meta_description\":\"Read digital payments blogs covering UPI, wallets, online transactions, payment security, and fintech innovations.\",\"is_active\":false,\"created_at\":\"2026-01-10T18:21:21.000000Z\",\"updated_at\":\"2026-06-08T06:36:00.000000Z\",\"deleted_at\":null}', '{\"id\":29,\"uuid\":\"102c8fea-ee23-11f0-a0af-1860247b6ae0\",\"name\":\"Digital Payments1\",\"slug\":\"digital-payments1\",\"icon\":\"bx bx-wallet\",\"image\":null,\"description\":\"Digital payment blogs focused on UPI, wallets, online transactions, and payment security.\",\"meta_title\":\"Digital Payments Blogs, UPI & Online Transactions\",\"meta_description\":\"Read digital payments blogs covering UPI, wallets, online transactions, payment security, and fintech innovations.\",\"is_active\":false,\"created_at\":\"2026-01-10T18:21:21.000000Z\",\"updated_at\":\"2026-06-08T06:36:18.000000Z\",\"deleted_at\":null}', 'Blog Category \'Digital Payments1\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/saveorupdate/102c8fea-ee23-11f0-a0af-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-06-08 01:06:18', '2026-06-08 01:06:18', NULL),
(23, '4e582fe2-a612-4a6d-8f1f-e7d37d8dfe78', 1, 'Super Admin', 'DELETE', 'BlogCategory', 'App\\Models\\BlogCategory', 29, NULL, '{\"id\":29,\"uuid\":\"102c8fea-ee23-11f0-a0af-1860247b6ae0\",\"name\":\"Digital Payments1\",\"slug\":\"digital-payments1\",\"icon\":\"bx bx-wallet\",\"image\":null,\"description\":\"Digital payment blogs focused on UPI, wallets, online transactions, and payment security.\",\"meta_title\":\"Digital Payments Blogs, UPI & Online Transactions\",\"meta_description\":\"Read digital payments blogs covering UPI, wallets, online transactions, payment security, and fintech innovations.\",\"is_active\":false,\"created_at\":\"2026-01-10T18:21:21.000000Z\",\"updated_at\":\"2026-06-08T06:36:18.000000Z\",\"deleted_at\":null}', 'Blog Category \'Digital Payments1\' deleted.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/categories/destroy/102c8fea-ee23-11f0-a0af-1860247b6ae0', 'DELETE', 'warning', NULL, 0, '2026-06-08 01:06:24', '2026-06-08 01:06:24', NULL),
(24, '83d0f39c-6b8d-4049-8665-1a7d2b139bbc', 1, 'Super Admin', 'DEACTIVATE', 'Blog', 'App\\Models\\Blog', 20, '{\"is_active\":true}', '{\"is_active\":false}', 'Blog \'Startup Growth Strategies in a Competitive Market\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/togglestatus/a459e24b-ee23-11f0-a0af-1860247b6ae0', 'GET', 'info', NULL, 0, '2026-06-08 01:14:44', '2026-06-08 01:14:44', NULL),
(25, '246a7446-2656-4eb9-a8fd-393b9336ce77', 1, 'Super Admin', 'UPDATE', 'Blog', 'App\\Models\\Blog', 20, '{\"id\":20,\"uuid\":\"a459e24b-ee23-11f0-a0af-1860247b6ae0\",\"category_id\":21,\"author_id\":14,\"title\":\"Startup Growth Strategies in a Competitive Market\",\"slug\":\"startup-growth-strategies-in-a-competitive-market\",\"excerpt\":\"<p>Startups need smart growth strategies to scale in competitive markets.<\\/p>\",\"content\":\"<p>Successful startups focus on customer value, technology adoption, and execution.<\\/p>\\r\\n\\r\\n<p>Balancing innovation with scalability leads to long-term success.<\\/p>\",\"featured_image\":\"blogs\\/a459e24b-ee23-11f0-a0af-1860247b6ae0\\/1770039406_whatsapp-image-2026-01-17-at-111205-pm-1.jpeg\",\"og_image\":null,\"meta_title\":\"Startup Growth Strategies & Scaling\",\"meta_description\":\"Discover effective startup growth strategies to scale successfully in competitive markets.\",\"meta_keywords\":null,\"canonical_url\":\"https:\\/\\/example.com\\/blogs\\/startup-growth-strategies-in-a-competitive-market\",\"status\":\"published\",\"published_at\":\"2026-01-10T18:25:00.000000Z\",\"is_featured\":false,\"is_active\":false,\"views\":295,\"reading_time\":5,\"comment_count\":2,\"created_at\":\"2026-01-10T18:25:29.000000Z\",\"updated_at\":\"2026-06-08T06:44:44.000000Z\",\"deleted_at\":null}', '{\"id\":20,\"uuid\":\"a459e24b-ee23-11f0-a0af-1860247b6ae0\",\"category_id\":21,\"author_id\":14,\"title\":\"Startup Growth Strategies in a Competitive Market1\",\"slug\":\"startup-growth-strategies-in-a-competitive-market1\",\"excerpt\":\"<p>Startups need smart growth strategies to scale in competitive markets.<\\/p>\",\"content\":\"<p>Successful startups focus on customer value, technology adoption, and execution.<\\/p>\\r\\n\\r\\n<p>Balancing innovation with scalability leads to long-term success.<\\/p>\",\"featured_image\":\"blogs\\/a459e24b-ee23-11f0-a0af-1860247b6ae0\\/1770039406_whatsapp-image-2026-01-17-at-111205-pm-1.jpeg\",\"og_image\":\"blogs\\/a459e24b-ee23-11f0-a0af-1860247b6ae0\\/og_1780901105_pull-stud-pic.jpg\",\"meta_title\":\"Startup Growth Strategies & Scaling\",\"meta_description\":\"Discover effective startup growth strategies to scale successfully in competitive markets.\",\"meta_keywords\":null,\"canonical_url\":\"https:\\/\\/example.com\\/blogs\\/startup-growth-strategies-in-a-competitive-market\",\"status\":\"published\",\"published_at\":\"2026-01-10T18:25:00.000000Z\",\"is_featured\":false,\"is_active\":false,\"views\":295,\"reading_time\":5,\"comment_count\":2,\"created_at\":\"2026-01-10T18:25:29.000000Z\",\"updated_at\":\"2026-06-08T06:45:06.000000Z\",\"deleted_at\":null}', 'Blog \'Startup Growth Strategies in a Competitive Market1\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/saveorupdate/a459e24b-ee23-11f0-a0af-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-06-08 01:15:06', '2026-06-08 01:15:06', NULL),
(26, '9b305d1c-0f5d-4c75-9a3e-be2bde8d07a6', 1, 'Super Admin', 'DELETE', 'Blog', 'App\\Models\\Blog', 20, NULL, '{\"id\":20,\"uuid\":\"a459e24b-ee23-11f0-a0af-1860247b6ae0\",\"category_id\":21,\"author_id\":14,\"title\":\"Startup Growth Strategies in a Competitive Market1\",\"slug\":\"startup-growth-strategies-in-a-competitive-market1\",\"excerpt\":\"<p>Startups need smart growth strategies to scale in competitive markets.<\\/p>\",\"content\":\"<p>Successful startups focus on customer value, technology adoption, and execution.<\\/p>\\r\\n\\r\\n<p>Balancing innovation with scalability leads to long-term success.<\\/p>\",\"featured_image\":\"blogs\\/a459e24b-ee23-11f0-a0af-1860247b6ae0\\/1770039406_whatsapp-image-2026-01-17-at-111205-pm-1.jpeg\",\"og_image\":\"blogs\\/a459e24b-ee23-11f0-a0af-1860247b6ae0\\/og_1780901105_pull-stud-pic.jpg\",\"meta_title\":\"Startup Growth Strategies & Scaling\",\"meta_description\":\"Discover effective startup growth strategies to scale successfully in competitive markets.\",\"meta_keywords\":null,\"canonical_url\":\"https:\\/\\/example.com\\/blogs\\/startup-growth-strategies-in-a-competitive-market\",\"status\":\"published\",\"published_at\":\"2026-01-10T18:25:00.000000Z\",\"is_featured\":false,\"is_active\":false,\"views\":295,\"reading_time\":5,\"comment_count\":2,\"created_at\":\"2026-01-10T18:25:29.000000Z\",\"updated_at\":\"2026-06-08T06:45:06.000000Z\",\"deleted_at\":null}', 'Blog \'Startup Growth Strategies in a Competitive Market1\' deleted.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/destroy/a459e24b-ee23-11f0-a0af-1860247b6ae0', 'DELETE', 'warning', NULL, 0, '2026-06-08 01:15:14', '2026-06-08 01:15:14', NULL),
(27, '71afb317-9880-45a5-95dd-73bd4b077de1', 1, 'Super Admin', 'UPDATE', 'Blog', 'App\\Models\\Blog', 19, '{\"id\":19,\"uuid\":\"a459e163-ee23-11f0-a0af-1860247b6ae0\",\"category_id\":16,\"author_id\":8,\"title\":\"AI in Healthcare: Opportunities and Challenges\",\"slug\":\"ai-in-healthcare-opportunities-and-challenges\",\"excerpt\":\"<p>Artificial intelligence offers major opportunities and challenges in healthcare.<\\/p>\",\"content\":\"<p>AI improves diagnostics and automation but raises ethical and regulatory concerns.<\\/p>\\r\\n\\r\\n<p>Responsible adoption ensures patient safety and trust.<\\/p>\",\"featured_image\":\"blogs\\/a459e163-ee23-11f0-a0af-1860247b6ae0\\/1770039368_whatsapp-image-2026-01-17-at-110310-pm-1.jpeg\",\"og_image\":null,\"meta_title\":\"AI in Healthcare \\u2013 Opportunities & Challenges\",\"meta_description\":\"Understand the opportunities and challenges of AI in healthcare including ethics and regulation.\",\"meta_keywords\":null,\"canonical_url\":\"https:\\/\\/example.com\\/blogs\\/ai-in-healthcare-opportunities-and-challenges\",\"status\":\"published\",\"published_at\":\"2026-01-10T18:25:00.000000Z\",\"is_featured\":true,\"is_active\":true,\"views\":410,\"reading_time\":7,\"comment_count\":6,\"created_at\":\"2026-01-10T18:25:29.000000Z\",\"updated_at\":\"2026-02-02T13:36:08.000000Z\",\"deleted_at\":null}', '{\"id\":19,\"uuid\":\"a459e163-ee23-11f0-a0af-1860247b6ae0\",\"category_id\":16,\"author_id\":8,\"title\":\"AI in Healthcare: Opportunities and Challenges\",\"slug\":\"ai-in-healthcare-opportunities-and-challenges\",\"excerpt\":\"<p>Artificial intelligence offers major opportunities and challenges in healthcare.<\\/p>\",\"content\":\"<p>AI improves diagnostics and automation but raises ethical and regulatory concerns.<\\/p>\\r\\n\\r\\n<p>Responsible adoption ensures patient safety and trust.<\\/p>\",\"featured_image\":\"blogs\\/a459e163-ee23-11f0-a0af-1860247b6ae0\\/1780901151_pull-stud-pic.jpg\",\"og_image\":\"blogs\\/a459e163-ee23-11f0-a0af-1860247b6ae0\\/og_1780901151_n-1071.jpg\",\"meta_title\":\"AI in Healthcare \\u2013 Opportunities & Challenges\",\"meta_description\":\"Understand the opportunities and challenges of AI in healthcare including ethics and regulation.\",\"meta_keywords\":null,\"canonical_url\":\"https:\\/\\/example.com\\/blogs\\/ai-in-healthcare-opportunities-and-challenges\",\"status\":\"published\",\"published_at\":\"2026-01-10T18:25:00.000000Z\",\"is_featured\":true,\"is_active\":true,\"views\":410,\"reading_time\":7,\"comment_count\":6,\"created_at\":\"2026-01-10T18:25:29.000000Z\",\"updated_at\":\"2026-06-08T06:45:51.000000Z\",\"deleted_at\":null}', 'Blog \'AI in Healthcare: Opportunities and Challenges\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/saveorupdate/a459e163-ee23-11f0-a0af-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-06-08 01:15:51', '2026-06-08 01:15:51', NULL),
(28, 'c7bb7f3d-bd13-4496-a231-8f18927c8823', 1, 'Super Admin', 'UPDATE', 'CareerApplication', 'App\\Models\\CareerApplication', 1, '{\"status\":\"shortlisted\"}', '{\"status\":\"interview\",\"remarks\":\"gjhgjhgjhg\"}', 'Application status changed from \'shortlisted\' to \'interview\' for \'Abhishek Kumar Singh\'.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/careers/applications/update-status/7b5f6a86-1525-11f1-8033-544810ce699a', 'POST', 'info', NULL, 0, '2026-06-08 01:26:20', '2026-06-08 01:26:20', NULL),
(29, '1ae7fc3a-40de-40ea-8f8e-eba13a5ece1e', 1, 'Super Admin', 'UPDATE', 'CareerApplication', 'App\\Models\\CareerApplication', 1, '{\"status\":\"interview\"}', '{\"status\":\"rejected\",\"remarks\":\"not applicable for this position\"}', 'Application status changed from \'interview\' to \'rejected\' for \'Abhishek Kumar Singh\'.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/careers/applications/update-status/7b5f6a86-1525-11f1-8033-544810ce699a', 'POST', 'info', NULL, 0, '2026-06-08 01:28:05', '2026-06-08 01:28:05', NULL),
(30, '42296bf1-c997-43fc-a57b-7101463867c0', 1, 'Super Admin', 'INTERVIEW', 'CareerApplication', 'App\\Models\\CareerApplication', 1, '{\"status\":\"shortlisted\"}', '{\"status\":\"interview\",\"remarks\":\"asdfasd\"}', 'Application \'Abhishek Kumar Singh\' moved to Interview stage.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/careers/applications/update-status/7b5f6a86-1525-11f1-8033-544810ce699a', 'POST', 'info', NULL, 0, '2026-06-08 01:35:22', '2026-06-08 01:35:22', NULL),
(31, '9d013513-7707-4e8b-93de-37036974acf0', 1, 'Super Admin', 'REJECTED', 'CareerApplication', 'App\\Models\\CareerApplication', 1, '{\"status\":\"interview\"}', '{\"status\":\"rejected\",\"remarks\":\"asdf\"}', '\'Abhishek Kumar Singh\' marked as Rejected.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/careers/applications/update-status/7b5f6a86-1525-11f1-8033-544810ce699a', 'POST', 'info', NULL, 0, '2026-06-08 01:35:44', '2026-06-08 01:35:44', NULL),
(32, 'fa07bfed-43e6-47a7-be69-6e7d9cb9e4a2', 1, 'Super Admin', 'ACTIVATE', 'Career', 'App\\Models\\Career', 1, '{\"is_active\":false}', '{\"is_active\":true}', 'Career \'Hr Manager\' activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/careers/togglestatus/33c5232d-5009-4fed-b29c-b3cc811ce24d', 'GET', 'info', NULL, 0, '2026-06-08 01:46:49', '2026-06-08 01:46:49', NULL),
(33, '57b3e255-1003-4d3e-b7df-f49c2844b438', 1, 'Super Admin', 'UPDATE', 'Career', 'App\\Models\\Career', 1, '{\"id\":1,\"uuid\":\"33c5232d-5009-4fed-b29c-b3cc811ce24d\",\"department_id\":2,\"title\":\"Hr Manager\",\"slug\":\"hr-manager\",\"employment_type\":\"full-time\",\"experience_level\":\"lead\",\"location\":\"ludhiana\",\"is_remote\":true,\"openings\":1,\"salary_min\":30000,\"salary_max\":35000,\"salary_currency\":\"INR\",\"description\":\"asdfadsf\",\"responsibilities\":\"asdfdfadasfad\",\"requirements\":\"asdfadf\",\"benefits\":\"asdfadsf\",\"skills\":\"[\\\"english\\\",\\\"graduation\\\"]\",\"apply_url\":\"http:\\/\\/deovate.my-style.in\",\"apply_email\":\"abhiii2404@gmail.com\",\"application_deadline\":\"2026-02-21T00:00:00.000000Z\",\"meta_title\":\"asdfadfaadsf\",\"meta_description\":\"asdfadfasd\",\"is_active\":true,\"is_featured\":true,\"total_applications\":0,\"published_at\":\"2026-03-01T04:09:49.000000Z\",\"created_at\":\"2026-02-17T17:02:40.000000Z\",\"updated_at\":\"2026-06-08T07:16:49.000000Z\",\"deleted_at\":null}', '{\"id\":1,\"uuid\":\"33c5232d-5009-4fed-b29c-b3cc811ce24d\",\"department_id\":2,\"title\":\"Hr Manager1\",\"slug\":\"hr-manager1\",\"employment_type\":\"full-time\",\"experience_level\":\"lead\",\"location\":\"ludhiana\",\"is_remote\":true,\"openings\":1,\"salary_min\":30000,\"salary_max\":35000,\"salary_currency\":\"INR\",\"description\":\"asdfadsf\",\"responsibilities\":\"asdfdfadasfad\",\"requirements\":\"asdfadf\",\"benefits\":\"asdfadsf\",\"skills\":\"[\\\"english\\\",\\\"graduation\\\"]\",\"apply_url\":\"http:\\/\\/deovate.my-style.in\",\"apply_email\":\"abhiii2404@gmail.com\",\"application_deadline\":\"2026-02-21T00:00:00.000000Z\",\"meta_title\":\"asdfadfaadsf\",\"meta_description\":\"asdfadfasd\",\"is_active\":true,\"is_featured\":true,\"total_applications\":0,\"published_at\":\"2026-06-08T07:17:18.000000Z\",\"created_at\":\"2026-02-17T17:02:40.000000Z\",\"updated_at\":\"2026-06-08T07:17:18.000000Z\",\"deleted_at\":null}', 'Career \'Hr Manager1\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/careers/saveorupdate/33c5232d-5009-4fed-b29c-b3cc811ce24d', 'POST', 'info', NULL, 0, '2026-06-08 01:47:18', '2026-06-08 01:47:18', NULL),
(34, '7786874e-64f2-4fd0-a69a-c8051db3d25d', 1, 'Super Admin', 'DELETE', 'Career', 'App\\Models\\Career', 1, NULL, '{\"id\":1,\"uuid\":\"33c5232d-5009-4fed-b29c-b3cc811ce24d\",\"department_id\":2,\"title\":\"Hr Manager1\",\"slug\":\"hr-manager1\",\"employment_type\":\"full-time\",\"experience_level\":\"lead\",\"location\":\"ludhiana\",\"is_remote\":true,\"openings\":1,\"salary_min\":30000,\"salary_max\":35000,\"salary_currency\":\"INR\",\"description\":\"asdfadsf\",\"responsibilities\":\"asdfdfadasfad\",\"requirements\":\"asdfadf\",\"benefits\":\"asdfadsf\",\"skills\":\"[\\\"english\\\",\\\"graduation\\\"]\",\"apply_url\":\"http:\\/\\/deovate.my-style.in\",\"apply_email\":\"abhiii2404@gmail.com\",\"application_deadline\":\"2026-02-21T00:00:00.000000Z\",\"meta_title\":\"asdfadfaadsf\",\"meta_description\":\"asdfadfasd\",\"is_active\":true,\"is_featured\":true,\"total_applications\":0,\"published_at\":\"2026-06-08T07:17:18.000000Z\",\"created_at\":\"2026-02-17T17:02:40.000000Z\",\"updated_at\":\"2026-06-08T07:17:18.000000Z\",\"deleted_at\":null}', 'Career \'Hr Manager1\' deleted.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/careers/destroy/33c5232d-5009-4fed-b29c-b3cc811ce24d', 'DELETE', 'warning', NULL, 0, '2026-06-08 01:47:42', '2026-06-08 01:47:42', NULL),
(35, '231c2a09-640d-400e-a516-4e13f5cdedcb', 1, 'Super Admin', 'UPDATE', 'Career', 'App\\Models\\Career', 1, '{\"id\":1,\"uuid\":\"33c5232d-5009-4fed-b29c-b3cc811ce24d\",\"department_id\":2,\"title\":\"Hr Manager1\",\"slug\":\"hr-manager1\",\"employment_type\":\"full-time\",\"experience_level\":\"lead\",\"location\":\"ludhiana\",\"is_remote\":true,\"openings\":1,\"salary_min\":30000,\"salary_max\":35000,\"salary_currency\":\"INR\",\"description\":\"asdfadsf\",\"responsibilities\":\"asdfdfadasfad\",\"requirements\":\"asdfadf\",\"benefits\":\"asdfadsf\",\"skills\":\"[\\\"english\\\",\\\"graduation\\\"]\",\"apply_url\":\"http:\\/\\/deovate.my-style.in\",\"apply_email\":\"abhiii2404@gmail.com\",\"application_deadline\":\"2026-02-21T00:00:00.000000Z\",\"meta_title\":\"asdfadfaadsf\",\"meta_description\":\"asdfadfasd\",\"is_active\":true,\"is_featured\":true,\"total_applications\":0,\"published_at\":\"2026-06-08T07:17:18.000000Z\",\"created_at\":\"2026-02-17T17:02:40.000000Z\",\"updated_at\":\"2026-06-08T07:17:42.000000Z\",\"deleted_at\":null}', '{\"id\":1,\"uuid\":\"33c5232d-5009-4fed-b29c-b3cc811ce24d\",\"department_id\":2,\"title\":\"Hr Manager1\",\"slug\":\"hr-manager1\",\"employment_type\":\"full-time\",\"experience_level\":\"lead\",\"location\":\"ludhiana\",\"is_remote\":true,\"openings\":1,\"salary_min\":30000,\"salary_max\":35000,\"salary_currency\":\"INR\",\"description\":\"asdfadsf\",\"responsibilities\":\"asdfdfadasfad\",\"requirements\":\"asdfadf\",\"benefits\":\"asdfadsf\",\"skills\":\"[\\\"english\\\",\\\"graduation\\\"]\",\"apply_url\":\"http:\\/\\/deovate.my-style.in\",\"apply_email\":\"abhiii2404@gmail.com\",\"application_deadline\":\"2026-02-21T00:00:00.000000Z\",\"meta_title\":\"asdfadfaadsf\",\"meta_description\":\"asdfadfasd\",\"is_active\":true,\"is_featured\":true,\"total_applications\":0,\"published_at\":\"2026-06-09T05:46:50.000000Z\",\"created_at\":\"2026-02-17T17:02:40.000000Z\",\"updated_at\":\"2026-06-09T05:46:50.000000Z\",\"deleted_at\":null}', 'Career \'Hr Manager1\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/careers/saveorupdate/33c5232d-5009-4fed-b29c-b3cc811ce24d', 'POST', 'info', NULL, 0, '2026-06-09 00:16:50', '2026-06-09 00:16:50', NULL),
(36, '255c3e5e-18c3-45ff-ab6d-22947120d743', 1, 'Super Admin', 'UPDATE', 'Career', 'App\\Models\\Career', 1, '{\"id\":1,\"uuid\":\"33c5232d-5009-4fed-b29c-b3cc811ce24d\",\"department_id\":2,\"title\":\"Hr Manager1\",\"slug\":\"hr-manager1\",\"employment_type\":\"full-time\",\"experience_level\":\"lead\",\"location\":\"ludhiana\",\"is_remote\":true,\"openings\":1,\"salary_min\":30000,\"salary_max\":35000,\"salary_currency\":\"INR\",\"description\":\"asdfadsf\",\"responsibilities\":\"asdfdfadasfad\",\"requirements\":\"asdfadf\",\"benefits\":\"asdfadsf\",\"skills\":\"[\\\"english\\\",\\\"graduation\\\"]\",\"apply_url\":\"http:\\/\\/deovate.my-style.in\",\"apply_email\":\"abhiii2404@gmail.com\",\"application_deadline\":\"2026-02-21T00:00:00.000000Z\",\"meta_title\":\"asdfadfaadsf\",\"meta_description\":\"asdfadfasd\",\"is_active\":true,\"is_featured\":true,\"total_applications\":0,\"published_at\":\"2026-06-09T05:46:50.000000Z\",\"created_at\":\"2026-02-17T17:02:40.000000Z\",\"updated_at\":\"2026-06-09T05:46:50.000000Z\",\"deleted_at\":null}', '{\"id\":1,\"uuid\":\"33c5232d-5009-4fed-b29c-b3cc811ce24d\",\"department_id\":2,\"title\":\"Hr Manager1\",\"slug\":\"hr-manager1\",\"employment_type\":\"full-time\",\"experience_level\":\"lead\",\"location\":\"ludhiana\",\"is_remote\":true,\"openings\":1,\"salary_min\":30000,\"salary_max\":35000,\"salary_currency\":\"INR\",\"description\":\"asdfadsf\",\"responsibilities\":\"asdfdfadasfad\",\"requirements\":\"asdfadf\",\"benefits\":\"asdfadsf\",\"skills\":\"[\\\"english\\\",\\\"graduation\\\",\\\"abc\\\"]\",\"apply_url\":\"http:\\/\\/deovate.my-style.in\",\"apply_email\":\"abhiii2404@gmail.com\",\"application_deadline\":\"2026-02-21T00:00:00.000000Z\",\"meta_title\":\"asdfadfaadsf\",\"meta_description\":\"asdfadfasd\",\"is_active\":true,\"is_featured\":true,\"total_applications\":0,\"published_at\":\"2026-06-09T05:47:03.000000Z\",\"created_at\":\"2026-02-17T17:02:40.000000Z\",\"updated_at\":\"2026-06-09T05:47:03.000000Z\",\"deleted_at\":null}', 'Career \'Hr Manager1\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/careers/saveorupdate/33c5232d-5009-4fed-b29c-b3cc811ce24d', 'POST', 'info', NULL, 0, '2026-06-09 00:17:03', '2026-06-09 00:17:03', NULL),
(37, '131aec63-a7c2-4c40-b7ec-00357faeb0f5', 1, 'Super Admin', 'UPDATE', 'Career', 'App\\Models\\Career', 1, '{\"id\":1,\"uuid\":\"33c5232d-5009-4fed-b29c-b3cc811ce24d\",\"department_id\":2,\"title\":\"Hr Manager1\",\"slug\":\"hr-manager1\",\"employment_type\":\"full-time\",\"experience_level\":\"lead\",\"location\":\"ludhiana\",\"is_remote\":true,\"openings\":1,\"salary_min\":30000,\"salary_max\":35000,\"salary_currency\":\"INR\",\"description\":\"asdfadsf\",\"responsibilities\":\"asdfdfadasfad\",\"requirements\":\"asdfadf\",\"benefits\":\"asdfadsf\",\"skills\":\"[\\\"english\\\",\\\"graduation\\\",\\\"abc\\\"]\",\"apply_url\":\"http:\\/\\/deovate.my-style.in\",\"apply_email\":\"abhiii2404@gmail.com\",\"application_deadline\":\"2026-02-21T00:00:00.000000Z\",\"meta_title\":\"asdfadfaadsf\",\"meta_description\":\"asdfadfasd\",\"is_active\":true,\"is_featured\":true,\"total_applications\":0,\"published_at\":\"2026-06-09T05:47:03.000000Z\",\"created_at\":\"2026-02-17T17:02:40.000000Z\",\"updated_at\":\"2026-06-09T05:47:03.000000Z\",\"deleted_at\":null}', '{\"id\":1,\"uuid\":\"33c5232d-5009-4fed-b29c-b3cc811ce24d\",\"department_id\":2,\"title\":\"Hr Manager1\",\"slug\":\"hr-manager1\",\"employment_type\":\"full-time\",\"experience_level\":\"lead\",\"location\":\"ludhiana\",\"is_remote\":true,\"openings\":1,\"salary_min\":30000,\"salary_max\":35000,\"salary_currency\":\"INR\",\"description\":\"asdfadsf\",\"responsibilities\":\"asdfdfadasfad\",\"requirements\":\"asdfadf\",\"benefits\":\"asdfadsf\",\"skills\":\"[\\\"english\\\",\\\"graduation\\\",\\\"abc\\\"]\",\"apply_url\":\"http:\\/\\/deovate.my-style.in\",\"apply_email\":\"abhiii2404@gmail.com\",\"application_deadline\":\"2026-02-21T00:00:00.000000Z\",\"meta_title\":\"asdfadfaadsf\",\"meta_description\":\"asdfadfasd\",\"is_active\":true,\"is_featured\":true,\"total_applications\":0,\"published_at\":\"2026-06-09T05:48:23.000000Z\",\"created_at\":\"2026-02-17T17:02:40.000000Z\",\"updated_at\":\"2026-06-09T05:48:23.000000Z\",\"deleted_at\":null}', 'Career \'Hr Manager1\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/careers/saveorupdate/33c5232d-5009-4fed-b29c-b3cc811ce24d', 'POST', 'info', NULL, 0, '2026-06-09 00:18:23', '2026-06-09 00:18:23', NULL),
(38, 'e1ba6f0b-7147-4d67-9b9b-400bd36dadc1', 1, 'Super Admin', 'ACTIVATE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 1, '{\"is_active\":false}', '{\"is_active\":true}', 'Case Study Category \'Digital Marketing\' activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/togglestatus/b1b8bfcf-ee49-11f0-8dee-544810ce699a', 'GET', 'info', NULL, 0, '2026-06-09 00:55:54', '2026-06-09 00:55:54', NULL),
(39, 'f2443d52-be79-44b8-8e62-d821dd7a08cf', 1, 'Super Admin', 'DEACTIVATE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 1, '{\"is_active\":true}', '{\"is_active\":false}', 'Case Study Category \'Digital Marketing\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/togglestatus/b1b8bfcf-ee49-11f0-8dee-544810ce699a', 'GET', 'info', NULL, 0, '2026-06-09 00:58:11', '2026-06-09 00:58:11', NULL),
(40, '56c1f98d-c610-4795-8179-735dbf23d7ff', 1, 'Super Admin', 'DEACTIVATE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 2, '{\"is_active\":true}', '{\"is_active\":false}', 'Case Study Category \'Search Engine Optimization\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/togglestatus/b1b8c3c9-ee49-11f0-8dee-544810ce699a', 'GET', 'info', NULL, 0, '2026-06-09 00:58:28', '2026-06-09 00:58:28', NULL),
(41, 'e51ecf43-178d-4c2f-a0bf-467b37e5e514', 1, 'Super Admin', 'ACTIVATE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 2, '{\"is_active\":false}', '{\"is_active\":true}', 'Case Study Category \'Search Engine Optimization\' activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/togglestatus/b1b8c3c9-ee49-11f0-8dee-544810ce699a', 'GET', 'info', NULL, 0, '2026-06-09 00:58:42', '2026-06-09 00:58:42', NULL),
(42, 'f98be4e9-2e88-499e-87df-72e0773fa1c2', 1, 'Super Admin', 'ACTIVATE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 1, '{\"is_active\":false}', '{\"is_active\":true}', 'Case Study Category \'Digital Marketing\' activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/togglestatus/b1b8bfcf-ee49-11f0-8dee-544810ce699a', 'GET', 'info', NULL, 0, '2026-06-09 00:58:46', '2026-06-09 00:58:46', NULL),
(43, 'd07937f3-5742-42f4-b6ef-97742584c6bc', 1, 'Super Admin', 'DEACTIVATE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 1, '{\"is_active\":true}', '{\"is_active\":false}', 'Case Study Category \'Digital Marketing\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/togglestatus/b1b8bfcf-ee49-11f0-8dee-544810ce699a', 'GET', 'info', NULL, 0, '2026-06-09 00:59:30', '2026-06-09 00:59:30', NULL),
(44, '189bba6e-afc9-4dfc-807d-007636a35df2', 1, 'Super Admin', 'UPDATE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 1, '{\"id\":1,\"uuid\":\"b1b8bfcf-ee49-11f0-8dee-544810ce699a\",\"name\":\"Digital Marketing\",\"slug\":\"digital-marketing\",\"description\":\"<p>Case studies highlighting successful digital marketing campaigns and measurable growth.<\\/p>\",\"icon\":\"bx bx-line-chart\",\"image\":null,\"meta_title\":\"Digital Marketing Case Studies | Growth & ROI\",\"meta_description\":\"Proven digital marketing case studies covering SEO, PPC, and social media success.\",\"is_active\":false,\"is_featured\":true,\"display_order\":1,\"views\":0,\"created_at\":\"2026-01-10T22:57:23.000000Z\",\"updated_at\":\"2026-06-09T06:29:30.000000Z\",\"deleted_at\":null}', '{\"id\":1,\"uuid\":\"b1b8bfcf-ee49-11f0-8dee-544810ce699a\",\"name\":\"Digital Marketing1\",\"slug\":\"digital-marketing1\",\"description\":\"<p>Case studies highlighting successful digital marketing campaigns and measurable growth.<\\/p>\",\"icon\":\"bx bx-line-chart\",\"image\":null,\"meta_title\":\"Digital Marketing Case Studies | Growth & ROI\",\"meta_description\":\"Proven digital marketing case studies covering SEO, PPC, and social media success.\",\"is_active\":false,\"is_featured\":true,\"display_order\":1,\"views\":0,\"created_at\":\"2026-01-10T22:57:23.000000Z\",\"updated_at\":\"2026-06-09T06:30:03.000000Z\",\"deleted_at\":null}', 'Case Study Category \'Digital Marketing1\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/saveorupdate/b1b8bfcf-ee49-11f0-8dee-544810ce699a', 'POST', 'info', NULL, 0, '2026-06-09 01:00:03', '2026-06-09 01:00:03', NULL),
(45, 'fa0130ef-ddc3-49b6-96f9-ab143e66e744', 1, 'Super Admin', 'DELETE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 2, NULL, '{\"id\":2,\"uuid\":\"b1b8c3c9-ee49-11f0-8dee-544810ce699a\",\"name\":\"Search Engine Optimization\",\"slug\":\"seo\",\"description\":\"SEO case studies demonstrating higher rankings, traffic growth, and conversions.\",\"icon\":\"bx bx-search-alt\",\"image\":\"seo-case-studies.webp\",\"meta_title\":\"SEO Case Studies | Ranking & Traffic Growth\",\"meta_description\":\"Real SEO case studies showing keyword growth, backlinks, and organic traffic gains.\",\"is_active\":true,\"is_featured\":true,\"display_order\":2,\"views\":0,\"created_at\":\"2026-01-10T22:57:23.000000Z\",\"updated_at\":\"2026-06-09T06:28:42.000000Z\",\"deleted_at\":null}', 'Case Study Category \'Search Engine Optimization\' deleted.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/destroy/b1b8c3c9-ee49-11f0-8dee-544810ce699a', 'DELETE', 'warning', NULL, 0, '2026-06-09 01:02:03', '2026-06-09 01:02:03', NULL);
INSERT INTO `activity_logs` (`id`, `uuid`, `user_id`, `user_role`, `action`, `module`, `subject_type`, `subject_id`, `old_values`, `new_values`, `description`, `ip_address`, `user_agent`, `url`, `method`, `level`, `meta`, `is_system`, `created_at`, `updated_at`, `deleted_at`) VALUES
(46, 'e7b84672-e2ed-49a5-b7f3-a012668e26f7', 1, 'Super Admin', 'DEACTIVATE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 3, '{\"is_active\":true}', '{\"is_active\":false}', 'Case Study Category \'Pay Per Click Advertising\' deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/togglestatus/b1b8c4a6-ee49-11f0-8dee-544810ce699a', 'GET', 'info', NULL, 0, '2026-06-09 01:02:13', '2026-06-09 01:02:13', NULL),
(47, '9f8c8852-4859-4377-b75a-020391321a93', 1, 'Super Admin', 'DELETE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 3, NULL, '{\"id\":3,\"uuid\":\"b1b8c4a6-ee49-11f0-8dee-544810ce699a\",\"name\":\"Pay Per Click Advertising\",\"slug\":\"ppc-advertising\",\"description\":\"Paid advertising case studies focused on ROI-driven PPC campaigns.\",\"icon\":\"bx bx-dollar-circle\",\"image\":\"ppc-advertising.webp\",\"meta_title\":\"PPC Case Studies | High-Converting Ad Campaigns\",\"meta_description\":\"Explore PPC case studies delivering lower CPC, higher ROAS, and scalable growth.\",\"is_active\":false,\"is_featured\":false,\"display_order\":3,\"views\":0,\"created_at\":\"2026-01-10T22:57:23.000000Z\",\"updated_at\":\"2026-06-09T06:32:13.000000Z\",\"deleted_at\":null}', 'Case Study Category \'Pay Per Click Advertising\' deleted.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/destroy/b1b8c4a6-ee49-11f0-8dee-544810ce699a', 'DELETE', 'warning', NULL, 0, '2026-06-09 01:02:18', '2026-06-09 01:02:18', NULL),
(48, '5bbdcd86-e3ac-45d0-862e-5693a261664d', 1, 'Super Admin', 'UPDATE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 4, '{\"id\":4,\"uuid\":\"b1b8c551-ee49-11f0-8dee-544810ce699a\",\"name\":\"Social Media Marketing\",\"slug\":\"social-media-marketing\",\"description\":\"Case studies showcasing social media growth, engagement, and brand awareness.\",\"icon\":\"bx bx-share-alt\",\"image\":\"social-media.webp\",\"meta_title\":\"Social Media Marketing Case Studies\",\"meta_description\":\"Successful social media case studies driving engagement, leads, and followers.\",\"is_active\":true,\"is_featured\":false,\"display_order\":4,\"views\":0,\"created_at\":\"2026-01-10T22:57:23.000000Z\",\"updated_at\":\"2026-01-10T22:57:23.000000Z\",\"deleted_at\":null}', '{\"id\":4,\"uuid\":\"b1b8c551-ee49-11f0-8dee-544810ce699a\",\"name\":\"Social Media Marketing\",\"slug\":\"social-media-marketing\",\"description\":\"<p>Case studies showcasing social media growth, engagement, and brand awareness.<\\/p>\",\"icon\":\"bx bx-share-alt\",\"image\":\"social-media.webp\",\"meta_title\":\"Social Media Marketing Case Studies\",\"meta_description\":\"Successful social media case studies driving engagement, leads, and followers.\",\"is_active\":true,\"is_featured\":true,\"display_order\":4,\"views\":0,\"created_at\":\"2026-01-10T22:57:23.000000Z\",\"updated_at\":\"2026-06-09T06:33:27.000000Z\",\"deleted_at\":null}', 'Case Study Category \'Social Media Marketing\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/saveorupdate/b1b8c551-ee49-11f0-8dee-544810ce699a', 'POST', 'info', NULL, 0, '2026-06-09 01:03:27', '2026-06-09 01:03:27', NULL),
(49, '09b3fff6-113e-4391-9843-3ffc05456f21', 1, 'Super Admin', 'UPDATE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 4, '{\"id\":4,\"uuid\":\"b1b8c551-ee49-11f0-8dee-544810ce699a\",\"name\":\"Social Media Marketing\",\"slug\":\"social-media-marketing\",\"description\":\"<p>Case studies showcasing social media growth, engagement, and brand awareness.<\\/p>\",\"icon\":\"bx bx-share-alt\",\"image\":\"social-media.webp\",\"meta_title\":\"Social Media Marketing Case Studies\",\"meta_description\":\"Successful social media case studies driving engagement, leads, and followers.\",\"is_active\":true,\"is_featured\":true,\"display_order\":4,\"views\":0,\"created_at\":\"2026-01-10T22:57:23.000000Z\",\"updated_at\":\"2026-06-09T06:33:27.000000Z\",\"deleted_at\":null}', '{\"id\":4,\"uuid\":\"b1b8c551-ee49-11f0-8dee-544810ce699a\",\"name\":\"Social Media Marketing\",\"slug\":\"social-media-marketing\",\"description\":\"<p>Case studies showcasing social media growth, engagement, and brand awareness.<\\/p>\",\"icon\":\"bx bx-share-alt\",\"image\":\"casestudies\\/categories\\/b1b8c551-ee49-11f0-8dee-544810ce699a\\/1780987504_hacker-operating-laptop-cartoon-icon-illustration-technology-icon-concept-isolated-flat-cartoon-style-138676-2387.avif\",\"meta_title\":\"Social Media Marketing Case Studies\",\"meta_description\":\"Successful social media case studies driving engagement, leads, and followers.\",\"is_active\":true,\"is_featured\":true,\"display_order\":4,\"views\":0,\"created_at\":\"2026-01-10T22:57:23.000000Z\",\"updated_at\":\"2026-06-09T06:45:05.000000Z\",\"deleted_at\":null}', 'Case Study Category \'Social Media Marketing\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/categories/saveorupdate/b1b8c551-ee49-11f0-8dee-544810ce699a', 'POST', 'info', NULL, 0, '2026-06-09 01:15:05', '2026-06-09 01:15:05', NULL),
(50, '8b1e788f-f384-49c3-ae70-666f9f6b0a18', 1, 'Super Admin', 'UPDATE', 'CaseStudy', 'App\\Models\\CaseStudy', 1, '{\"id\":1,\"uuid\":\"e50f88cf-177b-11f1-ad9d-544810ce699a\",\"case_study_category_id\":1,\"title\":\"320% Organic Traffic Growth for SaaS Startup\",\"slug\":\"320-organic-traffic-growth-saas\",\"client_name\":\"GrowthLabs\",\"industry\":\"SaaS\",\"project_duration\":\"6 Months\",\"project_budget\":\"$25,000\",\"featured_image\":\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/1780560473_7.jpg\",\"banner_image\":\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/banner_1780560473.jpg\",\"gallery\":[\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_3OtLLd3n.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_ijcZNCbE.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_2INmdYRh.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_zmEEFWU9.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_6zuz4hBy.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_gFbNyUAK.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_buywwXJC.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_nR2Zy9yX.png\"],\"video_url\":null,\"overview\":\"<p>SEO-led growth strategy for a B2B SaaS company.<\\/p>\",\"challenges\":\"Low visibility and high CAC.\",\"solutions\":\"Technical SEO, content, backlinks.\",\"results\":\"Organic traffic surged and CPL dropped.\",\"testimonial\":\"Outstanding growth results.\",\"key_metrics\":[\"+320%\",\"-38%\"],\"meta_title\":\"SaaS SEO Case Study\",\"meta_description\":\"SaaS SEO success with 320% traffic growth.\",\"meta_keywords\":[\"saas seo\",\"organic traffic\",\"b2b marketing\",\"startup growth\",\"search optimization\"],\"canonical_url\":\"https:\\/\\/example.com\\/case-studies\\/320-organic-traffic-growth-saas\",\"is_featured\":true,\"is_active\":false,\"display_order\":1,\"views\":0,\"published_at\":\"2026-01-10T23:06:00.000000Z\",\"created_at\":\"2026-01-10T23:06:03.000000Z\",\"updated_at\":\"2026-06-04T08:15:19.000000Z\",\"deleted_at\":null}', '{\"id\":1,\"uuid\":\"e50f88cf-177b-11f1-ad9d-544810ce699a\",\"case_study_category_id\":null,\"title\":\"320% Organic Traffic Growth for SaaS Startup\",\"slug\":\"320-organic-traffic-growth-saas\",\"client_name\":\"GrowthLabs\",\"industry\":\"SaaS\",\"project_duration\":\"6 Months\",\"project_budget\":\"$25,000\",\"featured_image\":\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/1780560473_7.jpg\",\"banner_image\":\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/banner_1780560473.jpg\",\"gallery\":[\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_3OtLLd3n.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_ijcZNCbE.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_2INmdYRh.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_zmEEFWU9.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_6zuz4hBy.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_gFbNyUAK.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_buywwXJC.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_nR2Zy9yX.png\"],\"video_url\":null,\"overview\":\"<p>SEO-led growth strategy for a B2B SaaS company.<\\/p>\",\"challenges\":\"Low visibility and high CAC.\",\"solutions\":\"Technical SEO, content, backlinks.\",\"results\":\"Organic traffic surged and CPL dropped.\",\"testimonial\":\"Outstanding growth results.\",\"key_metrics\":[\"+320%\",\"-38%\"],\"meta_title\":\"SaaS SEO Case Study\",\"meta_description\":\"SaaS SEO success with 320% traffic growth.\",\"meta_keywords\":[\"saas seo\",\"organic traffic\",\"b2b marketing\",\"startup growth\",\"search optimization\"],\"canonical_url\":\"https:\\/\\/example.com\\/case-studies\\/320-organic-traffic-growth-saas\",\"is_featured\":true,\"is_active\":false,\"display_order\":1,\"views\":0,\"published_at\":\"2026-01-10T23:06:00.000000Z\",\"created_at\":\"2026-01-10T23:06:03.000000Z\",\"updated_at\":\"2026-06-09T07:05:48.000000Z\",\"deleted_at\":null}', 'Case Study \'320% Organic Traffic Growth for SaaS Startup\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/saveorupdate/e50f88cf-177b-11f1-ad9d-544810ce699a', 'POST', 'info', NULL, 0, '2026-06-09 01:35:48', '2026-06-09 01:35:48', NULL),
(51, '4579e7cb-8903-4ddc-ab05-901536c5ac88', 1, 'Super Admin', 'ACTIVATE', 'CaseStudy', 'App\\Models\\CaseStudy', 1, '{\"is_active\":false}', '{\"is_active\":true}', 'Case Study \'320% Organic Traffic Growth for SaaS Startup\' activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/togglestatus/e50f88cf-177b-11f1-ad9d-544810ce699a', 'GET', 'info', NULL, 0, '2026-06-09 01:37:20', '2026-06-09 01:37:20', NULL),
(52, '2f539ad6-a164-4e0a-8172-fb3b53e7de5f', 1, 'Super Admin', 'DELETE', 'CaseStudy', 'App\\Models\\CaseStudy', 1, NULL, '{\"id\":1,\"uuid\":\"e50f88cf-177b-11f1-ad9d-544810ce699a\",\"case_study_category_id\":null,\"title\":\"320% Organic Traffic Growth for SaaS Startup\",\"slug\":\"320-organic-traffic-growth-saas\",\"client_name\":\"GrowthLabs\",\"industry\":\"SaaS\",\"project_duration\":\"6 Months\",\"project_budget\":\"$25,000\",\"featured_image\":\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/1780560473_7.jpg\",\"banner_image\":\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/banner_1780560473.jpg\",\"gallery\":[\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_3OtLLd3n.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_ijcZNCbE.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_2INmdYRh.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_zmEEFWU9.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_6zuz4hBy.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_gFbNyUAK.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_buywwXJC.jpg\",\"casestudies\\/e50f88cf-177b-11f1-ad9d-544810ce699a\\/gallery\\/1780560473_nR2Zy9yX.png\"],\"video_url\":null,\"overview\":\"<p>SEO-led growth strategy for a B2B SaaS company.<\\/p>\",\"challenges\":\"Low visibility and high CAC.\",\"solutions\":\"Technical SEO, content, backlinks.\",\"results\":\"Organic traffic surged and CPL dropped.\",\"testimonial\":\"Outstanding growth results.\",\"key_metrics\":[\"+320%\",\"-38%\"],\"meta_title\":\"SaaS SEO Case Study\",\"meta_description\":\"SaaS SEO success with 320% traffic growth.\",\"meta_keywords\":[\"saas seo\",\"organic traffic\",\"b2b marketing\",\"startup growth\",\"search optimization\"],\"canonical_url\":\"https:\\/\\/example.com\\/case-studies\\/320-organic-traffic-growth-saas\",\"is_featured\":true,\"is_active\":true,\"display_order\":1,\"views\":0,\"published_at\":\"2026-01-10T23:06:00.000000Z\",\"created_at\":\"2026-01-10T23:06:03.000000Z\",\"updated_at\":\"2026-06-09T07:07:19.000000Z\",\"deleted_at\":null}', 'Case Study \'320% Organic Traffic Growth for SaaS Startup\' deleted.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/casestudies/destroy/e50f88cf-177b-11f1-ad9d-544810ce699a', 'DELETE', 'warning', NULL, 0, '2026-06-09 01:37:38', '2026-06-09 01:37:38', NULL),
(53, '8b200f68-00a1-410e-8473-f3d392417661', 1, 'Super Admin', 'UPDATE', 'Comment', 'App\\Models\\Comment', 10, '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"[simran@example.com](mailto:simran@example.com)\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"approved\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0\",\"is_reported\":false,\"likes\":9,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-10T05:36:12.000000Z\",\"deleted_at\":null}', '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"approved\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":false,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:13:56.000000Z\",\"deleted_at\":null}', 'Comment by \'Simran Kaur\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/comments/saveorupdate/4169a218-648d-11f1-b925-484d7ed9887c', 'POST', 'info', NULL, 0, '2026-06-11 00:43:56', '2026-06-11 00:43:56', NULL),
(54, '5e553921-01ab-4e81-b910-8547bb0f82d1', 1, 'Super Admin', 'UPDATE', 'Comment', 'App\\Models\\Comment', 10, '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"approved\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":false,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:13:56.000000Z\",\"deleted_at\":null}', '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"rejected\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":false,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:14:27.000000Z\",\"deleted_at\":null}', 'Comment by \'Simran Kaur\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/comments/saveorupdate/4169a218-648d-11f1-b925-484d7ed9887c', 'POST', 'info', NULL, 0, '2026-06-11 00:44:27', '2026-06-11 00:44:27', NULL),
(55, '858f9fa1-6fc9-4bce-8f0d-70979918ab02', 1, 'Super Admin', 'UPDATE', 'Comment', 'App\\Models\\Comment', 10, '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"rejected\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":false,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:14:27.000000Z\",\"deleted_at\":null}', '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"approved\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":false,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:16:42.000000Z\",\"deleted_at\":null}', 'Comment by \'Simran Kaur\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/comments/saveorupdate/4169a218-648d-11f1-b925-484d7ed9887c', 'POST', 'info', NULL, 0, '2026-06-11 00:46:42', '2026-06-11 00:46:42', NULL),
(56, '20637521-0bcc-4680-96ba-2fe11e96330c', 1, 'Super Admin', 'UPDATE', 'Comment', 'App\\Models\\Comment', 10, '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"approved\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":false,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:16:42.000000Z\",\"deleted_at\":null}', '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"rejected\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":false,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:16:55.000000Z\",\"deleted_at\":null}', 'Comment by \'Simran Kaur\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/comments/saveorupdate/4169a218-648d-11f1-b925-484d7ed9887c', 'POST', 'info', NULL, 0, '2026-06-11 00:46:55', '2026-06-11 00:46:55', NULL),
(57, '7099ac73-a54b-4a5f-bb63-f710031815c1', 1, 'Super Admin', 'UPDATE', 'Comment', 'App\\Models\\Comment', 10, '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"rejected\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":false,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:16:55.000000Z\",\"deleted_at\":null}', '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"rejected\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":true,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:17:54.000000Z\",\"deleted_at\":null}', 'Comment by \'Simran Kaur\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/comments/saveorupdate/4169a218-648d-11f1-b925-484d7ed9887c', 'POST', 'info', NULL, 0, '2026-06-11 00:47:54', '2026-06-11 00:47:54', NULL),
(58, '9b764844-a8d5-4701-bfa6-d2f28c359bc8', 1, 'Super Admin', 'UPDATE', 'Comment', 'App\\Models\\Comment', 10, '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"rejected\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":true,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:17:54.000000Z\",\"deleted_at\":null}', '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"rejected\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":true,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:17:54.000000Z\",\"deleted_at\":null}', 'Comment by \'Simran Kaur\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/comments/saveorupdate/4169a218-648d-11f1-b925-484d7ed9887c', 'POST', 'info', NULL, 0, '2026-06-11 00:48:03', '2026-06-11 00:48:03', NULL),
(59, 'a4ffc96d-e7e1-4c33-a0ac-c3ddc28f7275', 1, 'Super Admin', 'UPDATE', 'Comment', 'App\\Models\\Comment', 10, '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"rejected\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":true,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:17:54.000000Z\",\"deleted_at\":null}', '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"rejected\",\"is_active\":0,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":true,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:17:54.000000Z\",\"deleted_at\":null}', 'Comment by \'Simran Kaur\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/comments/saveorupdate/4169a218-648d-11f1-b925-484d7ed9887c', 'POST', 'info', NULL, 0, '2026-06-11 00:48:40', '2026-06-11 00:48:40', NULL),
(60, 'f0cd34f3-1c42-41f8-8447-bbf103985342', 1, 'Super Admin', 'ACTIVATE', 'Comment', 'App\\Models\\Comment', 10, '{\"is_active\":0}', '{\"is_active\":true}', 'Comment activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/comments/togglestatus/4169a218-648d-11f1-b925-484d7ed9887c', 'GET', 'info', NULL, 0, '2026-06-11 00:48:46', '2026-06-11 00:48:46', NULL),
(61, '376dd5c0-bc87-470f-866c-1ea114549b2d', 1, 'Super Admin', 'DEACTIVATE', 'Comment', 'App\\Models\\Comment', 10, '{\"is_active\":1}', '{\"is_active\":false}', 'Comment deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/comments/togglestatus/4169a218-648d-11f1-b925-484d7ed9887c', 'GET', 'info', NULL, 0, '2026-06-11 00:49:13', '2026-06-11 00:49:13', NULL),
(62, 'e9f6b7fe-5be4-4457-a612-4109fb2385ca', 1, 'Super Admin', 'ACTIVATE', 'Comment', 'App\\Models\\Comment', 10, '{\"is_active\":0}', '{\"is_active\":true}', 'Comment activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/comments/togglestatus/4169a218-648d-11f1-b925-484d7ed9887c', 'GET', 'info', NULL, 0, '2026-06-11 00:50:06', '2026-06-11 00:50:06', NULL),
(63, 'bb6e17d3-a356-4a8a-8ce2-5a487ffc36b5', 1, 'Super Admin', 'DEACTIVATE', 'Comment', 'App\\Models\\Comment', 10, '{\"is_active\":1}', '{\"is_active\":false}', 'Comment deactivated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/comments/togglestatus/4169a218-648d-11f1-b925-484d7ed9887c', 'GET', 'info', NULL, 0, '2026-06-11 00:50:51', '2026-06-11 00:50:51', NULL),
(64, '96f345d5-6efa-44cb-8b53-ec2a570acef7', 1, 'Super Admin', 'ACTIVATE', 'Comment', 'App\\Models\\Comment', 10, '{\"is_active\":0}', '{\"is_active\":true}', 'Comment activated.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'http://127.0.0.1:8000/admin/blogs/comments/togglestatus/4169a218-648d-11f1-b925-484d7ed9887c', 'GET', 'info', NULL, 0, '2026-06-11 00:51:22', '2026-06-11 00:51:22', NULL),
(65, '6a42bd2b-09f1-4a87-87b7-dba0be15e150', 1, 'Super Admin', 'UPDATE', 'Comment', 'App\\Models\\Comment', 10, '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.\",\"status\":\"rejected\",\"is_active\":1,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":true,\"likes\":0,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:21:22.000000Z\",\"deleted_at\":null}', '{\"id\":10,\"uuid\":\"4169a218-648d-11f1-b925-484d7ed9887c\",\"blog_id\":5,\"parent_id\":null,\"user_id\":null,\"name\":\"Simran Kaur\",\"email\":\"simran@example.com\",\"website\":null,\"comment\":\"Great insights. Thank you for sharing.anky\",\"status\":\"rejected\",\"is_active\":1,\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Code\\/1.123.2 Chrome\\/148.0.7778.97 Electron\\/42.2.0 Safari\\/537.36\",\"is_reported\":true,\"likes\":100,\"dislikes\":0,\"created_at\":\"2026-06-10T10:58:47.000000Z\",\"updated_at\":\"2026-06-11T06:27:10.000000Z\",\"deleted_at\":null}', 'Comment by \'Simran Kaur\' updated successfully.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'http://127.0.0.1:8000/admin/blogs/comments/saveorupdate/4169a218-648d-11f1-b925-484d7ed9887c', 'POST', 'info', NULL, 0, '2026-06-11 00:57:10', '2026-06-11 00:57:10', NULL),
(66, '7fca461a-47e2-40c7-a522-89b6e0a9124f', 1, 'Super Admin', 'LOGIN', 'User', 'App\\Models\\User', 1, NULL, NULL, 'System Admin logged in', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/login/submit/admin', 'POST', 'info', NULL, 0, '2026-07-14 23:23:20', '2026-07-14 23:23:20', NULL),
(67, '87a1e974-8068-47a2-ba55-1bdcc1c5d6ac', 1, 'Super Admin', 'UPDATE', 'Service', NULL, NULL, NULL, NULL, 'Reordered services', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/services/reorder', 'POST', 'info', NULL, 0, '2026-07-14 23:26:34', '2026-07-14 23:26:34', NULL),
(68, '7f06ed79-fbcb-47ed-b5ae-b40a5402bd33', 1, 'Super Admin', 'UPDATE', 'Service', 'App\\Models\\Service', 2, NULL, '{\"featured_image\":\"services\\/mobile-app-development.jpg\",\"featured_image_alt\":\"Mobile App Development\",\"meta_keywords\":\"[\\\"mobile app development\\\",\\\"android apps\\\",\\\"ios apps\\\",\\\"cross platform apps\\\"]\",\"updated_at\":\"2026-07-15 05:01:41\"}', 'Updated service Mobile App Development', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/services/saveorupdate/a1d1e1a2-ed70-11f0-bdd3-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-07-14 23:31:41', '2026-07-14 23:31:41', NULL),
(69, '7a41e4e9-0e4e-4081-bfbf-9ecf1edc03f2', 1, 'Super Admin', 'UPDATE', 'Blog', 'App\\Models\\Blog', 19, NULL, '{\"featured_image\":\"blogs\\/8645392f-0ce8-4445-88fc-4844b1409d4d.png\",\"gallery\":\"[{\\\"path\\\":\\\"blogs\\\\\\/gallery-image-one.jpg\\\",\\\"alt\\\":\\\"gallery image one\\\",\\\"title\\\":null}]\",\"meta_keywords\":\"[]\",\"updated_at\":\"2026-07-15 05:39:18\"}', 'Updated blog \"AI in Healthcare: Opportunities and Challenges\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/blogs/saveorupdate/a459e163-ee23-11f0-a0af-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-07-15 00:09:18', '2026-07-15 00:09:18', NULL),
(70, 'e86c1813-5236-4db5-a144-e0ddce878c78', 1, 'Super Admin', 'UPDATE', 'Blog', 'App\\Models\\Blog', 19, NULL, '{\"gallery\":\"[{\\\"path\\\":\\\"blogs\\\\\\/gallery-image-one.jpg\\\",\\\"alt\\\":\\\"gallery image one\\\",\\\"title\\\":null},{\\\"path\\\":\\\"blogs\\\\\\/363d6550-405e-4c2f-bc72-036bb653dfe2.jpg\\\",\\\"alt\\\":null,\\\"title\\\":null}]\",\"updated_at\":\"2026-07-15 05:41:19\"}', 'Updated blog \"AI in Healthcare: Opportunities and Challenges\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/blogs/saveorupdate/a459e163-ee23-11f0-a0af-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-07-15 00:11:19', '2026-07-15 00:11:19', NULL),
(71, '41d3bdce-f02a-45a6-b850-e7e11070e88b', 1, 'Super Admin', 'UPDATE', 'Blog', 'App\\Models\\Blog', 19, NULL, '[]', 'Updated blog \"AI in Healthcare: Opportunities and Challenges\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/blogs/saveorupdate/a459e163-ee23-11f0-a0af-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-07-15 00:12:41', '2026-07-15 00:12:41', NULL),
(72, '5d31c065-cdd3-48c8-a04a-be8955e9e583', 1, 'Super Admin', 'UPDATE', 'Blog', 'App\\Models\\Blog', 19, NULL, '{\"gallery\":\"[{\\\"path\\\":\\\"blogs\\\\\\/gallery-image-one.jpg\\\",\\\"alt\\\":\\\"gallery image one\\\",\\\"title\\\":null},{\\\"path\\\":\\\"blogs\\\\\\/363d6550-405e-4c2f-bc72-036bb653dfe2.jpg\\\",\\\"alt\\\":\\\"alt 2\\\",\\\"title\\\":null}]\",\"updated_at\":\"2026-07-15 05:43:17\"}', 'Updated blog \"AI in Healthcare: Opportunities and Challenges\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/blogs/saveorupdate/a459e163-ee23-11f0-a0af-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-07-15 00:13:17', '2026-07-15 00:13:17', NULL),
(73, '5fe4a10c-610a-4a97-a85e-0ca924a17b05', 1, 'Super Admin', 'UPDATE', 'Service', NULL, NULL, NULL, NULL, 'Reordered services', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/services/reorder', 'POST', 'info', NULL, 0, '2026-07-15 01:52:39', '2026-07-15 01:52:39', NULL),
(74, 'e8aa8374-5c5e-45bb-a5ea-ffc9497b2d89', 1, 'Super Admin', 'UPDATE', 'Service', NULL, NULL, NULL, NULL, 'Reordered services', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/services/reorder', 'POST', 'info', NULL, 0, '2026-07-15 01:52:39', '2026-07-15 01:52:39', NULL),
(75, 'c3b83aab-8f77-4d1f-8b2f-9b9f82d63a4f', 1, 'Super Admin', 'UPDATE', 'Service', NULL, NULL, NULL, NULL, 'Reordered services', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/services/reorder', 'POST', 'info', NULL, 0, '2026-07-15 01:53:31', '2026-07-15 01:53:31', NULL),
(76, 'c0785424-7cb7-4c49-bca7-c28f5456a0ed', 1, 'Super Admin', 'UPDATE', 'Blog', NULL, NULL, NULL, NULL, 'Reordered blogs', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/blogs/reorder', 'POST', 'info', NULL, 0, '2026-07-15 02:56:50', '2026-07-15 02:56:50', NULL),
(77, '23e51ca5-f91a-4aa8-9414-5449353500a4', 1, 'Super Admin', 'UPDATE', 'Blog', NULL, NULL, NULL, NULL, 'Reordered blogs', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/blogs/reorder', 'POST', 'info', NULL, 0, '2026-07-15 03:56:09', '2026-07-15 03:56:09', NULL),
(78, 'cdc73900-c3ac-41ad-a31c-0424d2b407e7', 1, 'Super Admin', 'CREATE', 'FaqCategory', 'App\\Models\\FaqCategory', 3, NULL, '[]', 'Created FAQ category \"home page faq\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/faqs/categories/saveorupdate', 'POST', 'info', NULL, 0, '2026-07-15 04:06:15', '2026-07-15 04:06:15', NULL),
(79, '1f876b39-e450-47c9-888f-e079b199a342', 1, 'Super Admin', 'DELETE', 'Faq', 'App\\Models\\Faq', 15, NULL, NULL, 'Deleted FAQ \"what is your name\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/faqs/destroy/15', 'DELETE', 'info', NULL, 0, '2026-07-15 04:06:29', '2026-07-15 04:06:29', NULL),
(80, '39219333-9cfe-4942-b465-96c6797c6bd0', 1, 'Super Admin', 'DELETE', 'Faq', 'App\\Models\\Faq', 16, NULL, NULL, 'Deleted FAQ \"What is your father name ?\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/faqs/destroy/16', 'DELETE', 'info', NULL, 0, '2026-07-15 04:12:39', '2026-07-15 04:12:39', NULL),
(81, 'bbbafeef-0fee-4562-877a-538a586063f4', 1, 'Super Admin', 'CREATE', 'Faq', 'App\\Models\\Faq', 17, NULL, '{\"faq_category_id\":\"3\",\"question\":\"faq1\",\"answer\":\"asdf\",\"display_order\":\"1\",\"is_active\":true,\"updated_at\":\"2026-07-15 09:54:31\",\"created_at\":\"2026-07-15 09:54:31\",\"id\":17}', 'Created FAQ \"faq1\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/faqs/saveorupdate', 'POST', 'info', NULL, 0, '2026-07-15 04:24:31', '2026-07-15 04:24:31', NULL),
(82, '78b296d8-f578-4473-b603-76ad2da55d9f', 1, 'Super Admin', 'CREATE', 'Faq', 'App\\Models\\Faq', 18, NULL, '{\"faq_category_id\":\"3\",\"question\":\"faq2\",\"answer\":\"asd\",\"display_order\":\"2\",\"is_active\":true,\"updated_at\":\"2026-07-15 09:54:31\",\"created_at\":\"2026-07-15 09:54:31\",\"id\":18}', 'Created FAQ \"faq2\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/faqs/saveorupdate', 'POST', 'info', NULL, 0, '2026-07-15 04:24:31', '2026-07-15 04:24:31', NULL),
(83, '2d4e2351-b022-4553-ae9c-9ea6baa737e1', 1, 'Super Admin', 'CREATE', 'Faq', 'App\\Models\\Faq', 19, NULL, '{\"faq_category_id\":\"3\",\"question\":\"faq3\",\"answer\":\"asdfa\",\"display_order\":\"3\",\"is_active\":true,\"updated_at\":\"2026-07-15 09:54:31\",\"created_at\":\"2026-07-15 09:54:31\",\"id\":19}', 'Created FAQ \"faq3\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/faqs/saveorupdate', 'POST', 'info', NULL, 0, '2026-07-15 04:24:31', '2026-07-15 04:24:31', NULL),
(84, 'f030d82d-3c26-40be-900a-2061bd3c960c', NULL, NULL, 'CREATE', 'Page', 'App\\Models\\Page', 2, NULL, '[]', 'Created page: Test Simplified Page', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-16 05:36:38', '2026-07-16 05:36:38', NULL),
(85, '7f09aaf3-9163-4ac7-b3ec-b7ccf29ec2f2', 1, 'Super Admin', 'UPDATE', 'Page', 'App\\Models\\Page', 1, NULL, '{\"title\":\"Home\",\"meta_title\":\"asdf\",\"meta_description\":\"asfd\",\"meta_keywords\":\"[]\",\"updated_by\":1,\"updated_at\":\"2026-07-16 11:18:53\"}', 'Updated page: Home', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:1001/admin/pages/saveorupdate/76a29d1a-9016-42b3-bf4f-535e0577594b', 'POST', 'info', NULL, 0, '2026-07-16 05:48:53', '2026-07-16 05:48:53', NULL),
(86, '4a0c9ea1-99bd-4253-81b0-ba7788b362c3', 1, 'Super Admin', 'UPDATE', 'Page', 'App\\Models\\Page', 1, NULL, '[]', 'Updated page: Home', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:1001/admin/pages/saveorupdate/76a29d1a-9016-42b3-bf4f-535e0577594b', 'POST', 'info', NULL, 0, '2026-07-16 05:49:05', '2026-07-16 05:49:05', NULL),
(87, '05d23d02-0ec0-4121-b966-9980803e4110', NULL, NULL, 'CREATE', 'Page', 'App\\Models\\Page', 3, NULL, '[]', 'Created page: Test Page With Sections', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-16 05:54:17', '2026-07-16 05:54:17', NULL),
(88, 'e9ef3c3d-a7c2-4dda-a01b-f431e6599b2f', NULL, NULL, 'CREATE', 'Form', 'App\\Models\\Form', 6, NULL, '[]', 'Created form: Test Section Form', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-16 06:24:10', '2026-07-16 06:24:10', NULL),
(89, 'c99aaf95-0056-4791-8341-82e3ca598083', NULL, NULL, 'UPDATE', 'Form', 'App\\Models\\Form', 6, NULL, '{\"form_type\":null,\"heading_align\":null,\"updated_at\":\"2026-07-16 11:54:11\"}', 'Updated form: Test Section Form', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-16 06:24:11', '2026-07-16 06:24:11', NULL),
(90, 'e8c337a5-9a5c-4fcb-95c5-3375c1de4568', NULL, NULL, 'CREATE', 'Section', 'App\\Models\\Section', 5, NULL, '[]', 'Created section Test Auto Form Section', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-16 06:34:35', '2026-07-16 06:34:35', NULL),
(91, 'c1cac33e-ae50-4f61-9e84-63a178636159', NULL, NULL, 'CREATE', 'Section', 'App\\Models\\Section', 6, NULL, '[]', 'Created section Test Extend Section', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-16 06:36:51', '2026-07-16 06:36:51', NULL),
(92, 'c7f1ae7a-6e6a-4205-b522-3cf2c94a9063', NULL, NULL, 'UPDATE', 'Form', 'App\\Models\\Form', 8, NULL, '{\"form_type\":null,\"heading_align\":null}', 'Updated form: Test Extend Section Section Form', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-16 06:36:51', '2026-07-16 06:36:51', NULL),
(93, '49cb9309-1ca6-4fa0-9560-805f19c1d20a', NULL, NULL, 'UPDATE', 'Section', 'App\\Models\\Section', 6, NULL, '{\"content\":\"{\\\"section_label\\\":\\\"L2\\\",\\\"section_title\\\":\\\"T2\\\",\\\"section_subtitle\\\":\\\"S2\\\",\\\"description\\\":\\\"<p>Extra rich text<\\\\\\/p>\\\"}\"}', 'Updated section Test Extend Section', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-16 06:36:51', '2026-07-16 06:36:51', NULL),
(94, '35f28473-1644-45d5-b0f8-6a6f7285b584', NULL, NULL, 'CREATE', 'EmailTemplate', 'App\\Models\\EmailTemplate', 31, NULL, '[]', 'Created email template Test Welcome Template', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-17 00:39:43', '2026-07-17 00:39:43', NULL),
(95, '4a9c6bae-d8c7-4969-8b27-aa33bbafbe8d', NULL, NULL, 'CREATE', 'Email', 'App\\Models\\Email', 1, NULL, NULL, 'Sent email to test@example.com (sent)', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-17 00:39:46', '2026-07-17 00:39:46', NULL),
(96, 'b9d093d2-15e4-4689-bcb7-d39d909d8b03', NULL, NULL, 'CREATE', 'EmailTemplate', 'App\\Models\\EmailTemplate', 32, NULL, '[]', 'Created email template Test Lang Fix', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-17 00:48:33', '2026-07-17 00:48:33', NULL),
(97, '9fc9843a-4fe8-4f06-95e9-12f55c075b45', 1, 'Super Admin', 'LOGOUT', 'User', 'App\\Models\\User', 1, NULL, NULL, 'System Admin logged out', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/logout/admin', 'POST', 'info', NULL, 0, '2026-07-17 00:59:47', '2026-07-17 00:59:47', NULL),
(98, '7917efe3-58f4-4ce9-8d58-1e1f946328e0', NULL, NULL, 'CREATE', 'Email', 'App\\Models\\Email', 2, NULL, NULL, 'Sent email to compose-test@example.com (sent)', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-17 01:25:00', '2026-07-17 01:25:00', NULL),
(99, '3fd2d4f3-abd5-4eb3-bc26-b79d12639439', NULL, NULL, 'CREATE', 'Email', 'App\\Models\\Email', 3, NULL, NULL, 'Sent email to blank-compose@example.com (sent)', '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-17 01:25:02', '2026-07-17 01:25:02', NULL),
(100, 'd2dce3ec-d5ae-49f5-b339-9377049f5c4b', 1, 'Super Admin', 'LOGIN', 'User', 'App\\Models\\User', 1, NULL, NULL, 'System Admin logged in', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/login/submit/admin', 'POST', 'info', NULL, 0, '2026-07-17 02:03:55', '2026-07-17 02:03:55', NULL),
(101, 'd69c398c-a535-470d-858f-7cdbf11f6b14', 1, 'Super Admin', 'LOGIN', 'User', 'App\\Models\\User', 1, NULL, NULL, 'System Admin logged in', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/login/submit/admin', 'POST', 'info', NULL, 0, '2026-07-17 06:07:58', '2026-07-17 06:07:58', NULL),
(102, '5192c88c-5d1b-4d3d-8b34-d2a804aacd4f', NULL, NULL, 'CREATE', 'CareerApplication', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 'Symfony', 'http://localhost', 'GET', 'info', NULL, 0, '2026-07-17 06:24:58', '2026-07-17 06:24:58', NULL),
(104, 'c3877023-880f-42dd-badc-0155ead2bee3', 1, 'Super Admin', 'UPDATE', 'Career', 'App\\Models\\Career', 1, NULL, NULL, 'Updated career \"Hr Manager1\".', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/careers/saveorupdate/33c5232d-5009-4fed-b29c-b3cc811ce24d', 'POST', 'info', NULL, 0, '2026-07-17 06:28:16', '2026-07-17 06:28:16', NULL),
(105, 'bfce5444-e7cf-4cee-9727-5296b536d5c8', 1, 'Super Admin', 'UPDATE', 'CaseStudy', 'App\\Models\\CaseStudy', 20, NULL, '{\"featured_image\":\"case-studies\\/e5111097-177b-11f1-ad9d-544810ce699a\\/45491f9e-1c6d-4081-8019-177592b3435b.jpg\",\"overview\":\"<p>MVP product launch.<\\/p>\",\"key_metrics\":\"[\\\"success\\\"]\",\"published_at\":\"2026-01-10 23:06:00\",\"updated_at\":\"2026-07-17 11:59:18\"}', 'Updated case study: Startup MVP Launch', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/casestudies/saveorupdate/e5111097-177b-11f1-ad9d-544810ce699a', 'POST', 'info', NULL, 0, '2026-07-17 06:29:18', '2026-07-17 06:29:18', NULL),
(106, '6959aff2-325e-4f1b-876e-193697944228', 1, 'Super Admin', 'UPDATE', 'CaseStudyCategory', 'App\\Models\\CaseStudyCategory', 20, NULL, '{\"description\":\"<p>Startup case studies covering MVPs, scaling, and funding readiness.<\\/p>\",\"image\":\"case-study-categories\\/b1cd2efc-ee49-11f0-8dee-544810ce699a\\/7b760952-3615-4242-84ce-c21186983d5a.jpg\",\"updated_at\":\"2026-07-17 12:00:19\"}', 'Updated case study category: Startup Growth', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/casestudies/categories/saveorupdate/b1cd2efc-ee49-11f0-8dee-544810ce699a', 'POST', 'info', NULL, 0, '2026-07-17 06:30:19', '2026-07-17 06:30:19', NULL),
(113, 'd038217f-4c34-4009-8b18-6e6896de56d3', 1, 'Super Admin', 'LOGIN', 'User', 'App\\Models\\User', 1, NULL, NULL, 'System Admin logged in', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/login/submit/admin', 'POST', 'info', NULL, 0, '2026-07-21 02:17:28', '2026-07-21 02:17:28', NULL),
(114, '3ec82cdf-6e57-44c2-9e1f-1c9348ca194a', 1, 'Super Admin', 'VIEW', 'Enquiry', 'App\\Models\\Enquiry', 10, NULL, NULL, 'Viewed enquiry from Abhishek Kumar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/enquiries/details/9b7e1b90-1a01-4d44-a001-101010101010', 'GET', 'info', NULL, 0, '2026-07-21 02:18:21', '2026-07-21 02:18:21', NULL),
(115, '6c2da980-a477-48f8-ac49-f741cfe6215f', 1, 'Super Admin', 'UPDATE', 'Department', 'App\\Models\\Department', 15, NULL, '[]', 'Updated department Research & Development', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/departments/saveorupdate/639fb6f2-ed6b-11f0-9e6e-1860247b6ae0', 'POST', 'info', NULL, 0, '2026-07-21 02:18:42', '2026-07-21 02:18:42', NULL),
(116, 'ea1d8947-e31c-4c69-8153-73c252d0bec1', 1, 'Super Admin', 'UPDATE', 'IndustryCategory', 'App\\Models\\IndustryCategory', 4, NULL, '[]', 'Updated industry category Manufacturing', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/marketing/industries/categories/saveorupdate/69dd168d-1fc4-11f1-8f70-544810ce699a', 'POST', 'info', NULL, 0, '2026-07-21 02:19:39', '2026-07-21 02:19:39', NULL),
(117, '2638963f-fd8a-46c7-a2bb-19392350c6e7', 1, 'Super Admin', 'DELETE', 'TechnologyCategory', 'App\\Models\\TechnologyCategory', 7, NULL, NULL, 'Deleted technology category: Misir ji', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/technologies/categories/destroy/a143cdd9-d5f6-4a3c-8f01-5027bf17e6f4', 'DELETE', 'info', NULL, 0, '2026-07-21 02:20:50', '2026-07-21 02:20:50', NULL);
INSERT INTO `activity_logs` (`id`, `uuid`, `user_id`, `user_role`, `action`, `module`, `subject_type`, `subject_id`, `old_values`, `new_values`, `description`, `ip_address`, `user_agent`, `url`, `method`, `level`, `meta`, `is_system`, `created_at`, `updated_at`, `deleted_at`) VALUES
(118, '4aa4214f-bd03-483e-b709-570a87d8e2d5', 1, 'Super Admin', 'UPDATE', 'Service', 'App\\Models\\Service', 21, NULL, '{\"short_description\":\"<p>We design and build websites that load fast, look intentional, and guide visitors toward a decision instead of leaving them to figure it out themselves.<\\/p>\",\"description\":\"<p>Your website is doing a job whether you designed it to or not. It is either building confidence in the first ten seconds or quietly pushing visitors back to a search results page. We design and build websites that work the way a good salesperson would: clear, fast, and focused on moving the visitor toward a decision instead of overwhelming them with everything at once.<\\/p>\\r\\n\\r\\n<h3>Why Businesses Need This<\\/h3>\\r\\n\\r\\n<p>Most website problems are not visible to the business owner, because they never see their own site the way a new visitor does. A slow load time, a confusing menu, or a homepage that talks about the company instead of the customer, all of these quietly cost leads every single day without ever showing up as an obvious complaint. Good web design fixes what you cannot see from the inside.<\\/p>\\r\\n\\r\\n<h3>Key Benefits<\\/h3>\\r\\n\\r\\n<ul>\\r\\n\\t<li>First impression built for trust, not just aesthetics<\\/li>\\r\\n\\t<li>Faster load times that keep visitors from bouncing before the page even finishes loading<\\/li>\\r\\n\\t<li>A structure that guides visitors toward contacting you or buying, instead of leaving them to wander<\\/li>\\r\\n\\t<li>A site your own team can update without needing a developer for every small change<\\/li>\\r\\n\\t<li>A foundation that supports SEO instead of working against it<\\/li>\\r\\n<\\/ul>\\r\\n\\r\\n<h3>Tools &amp; Technologies We Use<\\/h3>\\r\\n\\r\\n<p>HTML5, CSS3, JavaScript, React, Next.js, Tailwind CSS, WordPress, Figma for design, and performance tools like Lighthouse and GTmetrix to validate speed before launch.<\\/p>\",\"meta_keywords\":\"[\\\"web design\\\",\\\"web development\\\",\\\"website design company\\\",\\\"responsive website\\\"]\",\"updated_at\":\"2026-07-21 10:09:02\"}', 'Updated service Web Design & Development', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'http://127.0.0.1:8000/admin/services/saveorupdate/3e026be0-61dd-4243-8980-39fe38190d63', 'POST', 'info', NULL, 0, '2026-07-21 04:39:02', '2026-07-21 04:39:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `application_status_logs`
--

CREATE TABLE `application_status_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `career_application_id` bigint(20) UNSIGNED NOT NULL,
  `old_status` enum('new','shortlisted','interview','offered','hired','rejected') NOT NULL,
  `new_status` enum('new','shortlisted','interview','offered','hired','rejected') NOT NULL,
  `changed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_status_logs`
--

INSERT INTO `application_status_logs` (`id`, `uuid`, `career_application_id`, `old_status`, `new_status`, `changed_by`, `remarks`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '245b05eb-1529-11f1-8033-544810ce699a', 1, 'new', 'shortlisted', 1, 'Candidate shortlisted based on initial screening.', 2, '2026-03-01 04:43:07', '2026-03-01 04:43:07', NULL),
(10, '5f4c0f9d-ebcd-44e5-9b8d-81cf95c2fb3f', 2, 'shortlisted', 'interview', NULL, NULL, 1772564935, '2026-03-03 13:38:55', '2026-03-03 13:38:55', NULL),
(11, '2f9c28f4-d1c4-4479-b7d8-bf2a718d84e7', 2, 'interview', 'offered', NULL, NULL, 1772564945, '2026-03-03 13:39:05', '2026-03-03 13:39:05', NULL),
(12, '04edfde5-0adc-4391-83ce-4cc98fb47ba3', 2, 'offered', 'hired', NULL, NULL, 1772564951, '2026-03-03 13:39:11', '2026-03-03 13:39:11', NULL),
(15, 'cbd3c21a-4431-4c67-8f75-89723ee63202', 1, 'shortlisted', 'interview', NULL, 'asdfasd', 1780902322, '2026-06-08 01:35:22', '2026-06-08 01:35:22', NULL),
(16, '652506b7-6986-4f00-a1d8-137a8d05bbf2', 1, 'interview', 'rejected', NULL, 'asdf', 1780902344, '2026-06-08 01:35:44', '2026-06-08 01:35:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `profile_image_alt` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `cover_image_alt` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`)),
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `total_blogs` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `uuid`, `user_id`, `name`, `slug`, `email`, `phone`, `profile_image`, `profile_image_alt`, `cover_image`, `cover_image_alt`, `bio`, `designation`, `company`, `website`, `social_links`, `meta_title`, `meta_description`, `total_blogs`, `is_featured`, `is_active`, `display_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '951d44da-ee23-11f0-a0af-1860247b6ae0', NULL, 'Amit Sharma', 'amit-sharma', 'amit.sharma@gmail.com', '9876543210', NULL, NULL, NULL, NULL, 'Amit Sharma is a senior technology writer with over 10 years of experience covering software development, cloud computing, and digital transformation.', 'Senior Technology Writer', 'SecondMedic', 'https://secondmedic.com', '{\"linkedin\":\"https://linkedin.com/in/amitsharma\",\"twitter\":\"https://twitter.com/amitsharma\"}', 'Amit Sharma – Technology & Healthcare Writer', 'Read expert technology and healthcare blogs written by Amit Sharma covering digital health, software development, and innovation.', 25, 1, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(2, '951d75ed-ee23-11f0-a0af-1860247b6ae0', NULL, 'Neha Verma', 'neha-verma', 'neha.verma@gmail.com', '9876543211', NULL, NULL, NULL, NULL, 'Neha Verma specializes in healthcare content, patient engagement strategies, and medical technology trends.', 'Healthcare Content Strategist', 'SecondMedic', 'https://secondmedic.com', '{\"linkedin\":\"https://linkedin.com/in/nehaverma\",\"instagram\":\"https://instagram.com/nehaverma\"}', 'Neha Verma – Healthcare Content Expert', 'Explore healthcare-focused blogs by Neha Verma on patient care, telemedicine, and medical innovations.', 18, 1, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(3, '951d7799-ee23-11f0-a0af-1860247b6ae0', NULL, 'Rahul Mehta', 'rahul-mehta', 'rahul.mehta@gmail.com', '9876543212', NULL, NULL, NULL, NULL, 'Rahul Mehta writes in-depth articles on software engineering, backend systems, and scalable architectures.', 'Software Engineer & Blogger', 'TechInsights', 'https://techinsights.com', '{\"linkedin\":\"https://linkedin.com/in/rahulmehta\",\"github\":\"https://github.com/rahulmehta\"}', 'Rahul Mehta – Software Engineering Blogs', 'Read software engineering blogs by Rahul Mehta focusing on backend development and system design.', 30, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(4, '951d78fc-ee23-11f0-a0af-1860247b6ae0', NULL, 'Priya Singh', 'priya-singh', 'priya.singh@gmail.com', '9876543213', NULL, NULL, NULL, NULL, 'Priya Singh is a digital health researcher and content writer covering AI in healthcare and telemedicine.', 'Digital Health Researcher', 'HealthTech Labs', 'https://healthtechlabs.com', '{\"linkedin\":\"https://linkedin.com/in/priyasingh\"}', 'Priya Singh – Digital Health & AI Writer', 'Discover digital health and AI healthcare blogs written by Priya Singh.', 22, 1, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(5, '951d79f3-ee23-11f0-a0af-1860247b6ae0', NULL, 'Ankit Patel', 'ankit-patel', 'ankit.patel@gmail.com', '9876543214', NULL, NULL, NULL, NULL, 'Ankit Patel covers cloud computing, DevOps practices, and infrastructure automation.', 'Cloud & DevOps Consultant', 'CloudSphere', 'https://cloudsphere.io', '{\"linkedin\":\"https://linkedin.com/in/ankitpatel\",\"twitter\":\"https://twitter.com/ankitpatel\"}', 'Ankit Patel – Cloud & DevOps Expert', 'Read cloud computing and DevOps blogs by Ankit Patel.', 27, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(6, '951d7aa8-ee23-11f0-a0af-1860247b6ae0', NULL, 'Sneha Kapoor', 'sneha-kapoor', 'sneha.kapoor@gmail.com', '9876543215', NULL, NULL, NULL, NULL, 'Sneha Kapoor writes about UI/UX design, product usability, and digital experience.', 'UI/UX Designer', 'DesignCraft', 'https://designcraft.io', '{\"linkedin\":\"https://linkedin.com/in/snehakapoor\",\"behance\":\"https://behance.net/snehakapoor\"}', 'Sneha Kapoor – UI UX Design Writer', 'Explore UI/UX and product design blogs by Sneha Kapoor.', 15, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(7, '951d7b50-ee23-11f0-a0af-1860247b6ae0', NULL, 'Vikas Malhotra', 'vikas-malhotra', 'vikas.malhotra@gmail.com', '9876543216', NULL, NULL, NULL, NULL, 'Vikas Malhotra focuses on business technology, SaaS platforms, and enterprise software.', 'Business Technology Analyst', 'BizTech Solutions', 'https://biztechsolutions.com', '{\"linkedin\":\"https://linkedin.com/in/vikasm\"}', 'Vikas Malhotra – Business Technology Blogs', 'Read blogs on business technology and SaaS written by Vikas Malhotra.', 20, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(8, '951d7bf4-ee23-11f0-a0af-1860247b6ae0', NULL, 'Ritika Joshi', 'ritika-joshi', 'ritika.joshi@gmail.com', '9876543217', NULL, NULL, NULL, NULL, 'Ritika Joshi writes informative blogs on digital marketing, SEO, and content strategy.', 'Digital Marketing Specialist', 'MarketGrow', 'https://marketgrow.in', '{\"linkedin\":\"https://linkedin.com/in/ritikajoshi\",\"twitter\":\"https://twitter.com/ritikaj\"}', 'Ritika Joshi – Digital Marketing Writer', 'SEO and digital marketing blogs by Ritika Joshi.', 17, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(9, '951d7c9e-ee23-11f0-a0af-1860247b6ae0', NULL, 'Arjun Nair', 'arjun-nair', 'arjun.nair@gmail.com', '9876543218', NULL, NULL, NULL, NULL, 'Arjun Nair is an AI enthusiast writing about machine learning, automation, and data science.', 'AI & ML Writer', 'AI Nexus', 'https://ainexus.ai', '{\"linkedin\":\"https://linkedin.com/in/arjunnair\",\"github\":\"https://github.com/arjunnair\"}', 'Arjun Nair – AI & Machine Learning Blogs', 'Read AI and machine learning blogs by Arjun Nair.', 26, 1, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(10, '951d7d40-ee23-11f0-a0af-1860247b6ae0', NULL, 'Kavita Rao', 'kavita-rao', 'kavita.rao@gmail.com', '9876543219', NULL, NULL, NULL, NULL, 'Kavita Rao specializes in healthcare policy, medical software, and compliance topics.', 'Healthcare Policy Writer', 'MedPolicy Group', 'https://medpolicygroup.com', '{\"linkedin\":\"https://linkedin.com/in/kavitarao\"}', 'Kavita Rao – Healthcare Policy Blogs', 'Healthcare policy and medical compliance blogs by Kavita Rao.', 14, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(11, '951d7ddd-ee23-11f0-a0af-1860247b6ae0', NULL, 'Suresh Iyer', 'suresh-iyer', 'suresh.iyer@gmail.com', '9876543220', NULL, NULL, NULL, NULL, 'Suresh Iyer writes about enterprise IT systems, ERP, and digital transformation.', 'Enterprise IT Consultant', 'ITPro Systems', 'https://itprosystems.com', '{\"linkedin\":\"https://linkedin.com/in/sureshiyer\"}', 'Suresh Iyer – Enterprise IT Writer', 'Read enterprise IT and ERP blogs by Suresh Iyer.', 19, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(12, '951d7f11-ee23-11f0-a0af-1860247b6ae0', NULL, 'Mehul Jain', 'mehul-jain', 'mehul.jain@gmail.com', '9876543221', NULL, NULL, NULL, NULL, 'Mehul Jain focuses on startup technology, product development, and SaaS growth.', 'Startup Technology Writer', 'StartupEdge', 'https://startupedge.io', '{\"linkedin\":\"https://linkedin.com/in/mehuljain\",\"twitter\":\"https://twitter.com/mehulj\"}', 'Mehul Jain – Startup & SaaS Blogs', 'Startup technology and SaaS growth blogs by Mehul Jain.', 21, 1, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(13, '951d7fb6-ee23-11f0-a0af-1860247b6ae0', NULL, 'Pooja Kulkarni', 'pooja-kulkarni', 'pooja.k@gmail.com', '9876543222', NULL, NULL, NULL, NULL, 'Pooja Kulkarni writes patient-centric healthcare blogs and wellness content.', 'Healthcare Content Writer', 'WellnessCare', 'https://wellnesscare.in', '{\"linkedin\":\"https://linkedin.com/in/poojakulkarni\"}', 'Pooja Kulkarni – Healthcare & Wellness Blogs', 'Healthcare and wellness blogs written by Pooja Kulkarni.', 16, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(14, '951d8057-ee23-11f0-a0af-1860247b6ae0', NULL, 'Deepak Choudhary', 'deepak-choudhary', 'deepak.c@gmail.com', '9876543223', NULL, NULL, NULL, NULL, 'Deepak Choudhary covers cybersecurity, data privacy, and compliance.', 'Cyber Security Analyst', 'SecureNet', 'https://securenet.io', '{\"linkedin\":\"https://linkedin.com/in/deepakc\"}', 'Deepak Choudhary – Cyber Security Blogs', 'Cyber security and data privacy blogs by Deepak Choudhary.', 23, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(15, '951d80f4-ee23-11f0-a0af-1860247b6ae0', NULL, 'Anjali Deshmukh', 'anjali-deshmukh', 'anjali.d@gmail.com', '9876543224', NULL, NULL, NULL, NULL, 'Anjali Deshmukh writes about healthcare innovation, AI diagnostics, and digital care.', 'HealthTech Writer', 'DigitalCare', 'https://digitalcare.health', '{\"linkedin\":\"https://linkedin.com/in/anjalideshmukh\"}', 'Anjali Deshmukh – HealthTech Blogs', 'HealthTech innovation blogs written by Anjali Deshmukh.', 24, 1, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(16, '951d818c-ee23-11f0-a0af-1860247b6ae0', NULL, 'Rohit Bansal', 'rohit-bansal', 'rohit.b@gmail.com', '9876543225', NULL, NULL, NULL, NULL, 'Rohit Bansal focuses on performance optimization and scalable web applications.', 'Performance Engineer', 'WebScale', 'https://webscale.io', '{\"linkedin\":\"https://linkedin.com/in/rohitbansal\"}', 'Rohit Bansal – Web Performance Blogs', 'Web performance and scalability blogs by Rohit Bansal.', 12, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(17, '951d8226-ee23-11f0-a0af-1860247b6ae0', NULL, 'Swati Mishra', 'swati-mishra', 'swati.m@gmail.com', '9876543226', NULL, NULL, NULL, NULL, 'Swati Mishra writes educational content on healthcare awareness and digital health tools.', 'Healthcare Educator', 'HealthAware', 'https://healthaware.org', '{\"linkedin\":\"https://linkedin.com/in/swatimishra\"}', 'Swati Mishra – Healthcare Awareness Blogs', 'Healthcare awareness and digital health blogs by Swati Mishra.', 13, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(18, '951d82cd-ee23-11f0-a0af-1860247b6ae0', NULL, 'Kunal Arora', 'kunal-arora', 'kunal.a@gmail.com', '9876543227', NULL, NULL, NULL, NULL, 'Kunal Arora focuses on fintech, payment systems, and digital banking technologies.', 'FinTech Writer', 'FinNext', 'https://finnext.io', '{\"linkedin\":\"https://linkedin.com/in/kunalarora\"}', 'Kunal Arora – FinTech & Payments Blogs', 'FinTech and digital payments blogs written by Kunal Arora.', 20, 0, 1, 0, '2026-01-10 12:55:04', '2026-01-10 12:55:04', NULL),
(19, '951d8396-ee23-11f0-a0af-1860247b6ae0', NULL, 'Nidhi Saxena', 'nidhi-saxena', 'nidhi.s@gmail.com', '9876543228', NULL, NULL, NULL, NULL, 'Nidhi Saxena writes SEO-friendly healthcare and technology blogs.', 'SEO Content Specialist', 'ContentBoost', 'https://contentboost.in', '{\"linkedin\":\"https://linkedin.com/in/nidhisaxena\"}', 'Nidhi Saxena – SEO & Content Blogs', 'SEO-optimized healthcare and technology blogs by Nidhi Saxena.', 28, 1, 1, 0, '2026-01-10 12:55:04', '2026-06-08 01:01:31', NULL),
(20, '951d842c-ee23-11f0-a0af-1860247b6ae0', NULL, 'Manish Gupta1', 'manish-gupta1', 'manish.g@gmail.com', '9876543229', NULL, NULL, NULL, NULL, 'Manish Gupta covers digital transformation, enterprise systems, and business automation.', 'Digital Transformation Consultant', 'TransformX', 'https://transformx.io', '{\"linkedin\":\"https://linkedin.com/in/manishgupta\"}', 'Manish Gupta – Digital Transformation Blogs', 'Digital transformation and automation blogs by Manish Gupta.', 0, 1, 0, 0, '2026-01-10 12:55:04', '2026-06-08 01:01:52', '2026-06-08 01:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `auth_logs`
--

CREATE TABLE `auth_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `is_success` tinyint(1) NOT NULL DEFAULT 1,
  `failure_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth_logs`
--

INSERT INTO `auth_logs` (`id`, `uuid`, `user_id`, `event`, `ip_address`, `user_agent`, `device`, `platform`, `browser`, `location`, `is_success`, `failure_reason`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'b2a665d7-936d-4c42-888b-6a53a5de9207', 1, 'login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'Unknown', 'Windows', NULL, NULL, 1, NULL, '2026-01-10 12:54:55', '2026-01-10 12:54:55', NULL),
(2, '3add307d-e985-4195-9697-de6bf0e44a50', 1, 'login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'Unknown', 'Windows', NULL, NULL, 0, 'Invalid password', '2026-01-10 12:55:45', '2026-01-10 12:55:45', NULL),
(3, '10be6531-424c-4db8-bcb3-c18a366e4854', 1, 'login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'Unknown', 'Windows', NULL, NULL, 1, NULL, '2026-01-10 12:55:52', '2026-01-10 12:55:52', NULL),
(4, 'be320248-b25f-4078-95e0-c92b8611fdc1', 1, 'login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', NULL, NULL, NULL, NULL, 1, NULL, '2026-01-10 13:42:25', '2026-01-10 13:42:25', NULL),
(5, 'c6243bbb-4c84-4bb5-a303-968bea4a4931', 1, 'login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', NULL, NULL, NULL, NULL, 1, NULL, '2026-01-11 10:01:14', '2026-01-11 10:01:14', NULL),
(6, '36aa562f-517d-4b93-80a1-c2d0d9d031f5', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-02-25 11:29:32', '2026-02-25 11:29:32', NULL),
(7, 'd80ba3d0-7cc1-4ea8-91af-8d45c638dc9c', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-02-25 11:50:10', '2026-02-25 11:50:10', NULL),
(8, 'c0cea586-211c-431f-a6d2-6b3f1979af06', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-02-25 11:52:57', '2026-02-25 11:52:57', NULL),
(9, 'b447fa0e-55ba-45fc-afc7-7c2342795bac', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-02-25 11:55:04', '2026-02-25 11:55:04', NULL),
(10, 'be235874-1eeb-4336-a3c3-c9ec664b7fc6', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-02-25 11:55:31', '2026-02-25 11:55:31', NULL),
(11, 'fcbcd77b-d013-43e3-9891-55c5ac47e25b', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-02-28 21:05:12', '2026-02-28 21:05:12', NULL),
(12, '45e67cc1-550a-418e-9109-2b6c0ca3ca1d', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-03-01 01:35:32', '2026-03-01 01:35:32', NULL),
(13, '15d2c516-faae-47a2-821e-adcc2df86711', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-03-01 01:35:57', '2026-03-01 01:35:57', NULL),
(14, '0233857b-4533-436d-96f0-e2acd2b6e2e0', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-03-03 11:25:19', '2026-03-03 11:25:19', NULL),
(15, '5bb4b450-0fad-4015-b26e-55374160f984', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-03-03 20:25:34', '2026-03-03 20:25:34', NULL),
(16, '5dc9a688-2e95-497b-afac-4d9866832b55', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-03-04 08:28:11', '2026-03-04 08:28:11', NULL),
(17, 'a6591291-7844-4890-a606-43ae4c35f513', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-03-05 10:02:29', '2026-03-05 10:02:29', NULL),
(18, '97fbd1e3-bca3-46c7-911e-2dd461132f64', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-03-05 11:12:01', '2026-03-05 11:12:01', NULL),
(19, 'c7c42c32-692f-4434-89d2-b1fc40802f70', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-03-05 11:30:06', '2026-03-05 11:30:06', NULL),
(20, '8f2a3829-b379-4274-9b59-f78e633c04d7', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-03-06 10:16:04', '2026-03-06 10:16:04', NULL),
(21, 'edbac4ee-5842-463f-97dd-d0881780379f', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-03-07 00:43:35', '2026-03-07 00:43:35', NULL),
(22, 'dbdbb3a3-371e-426c-a9d9-03e5f8a31fb4', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-03-07 00:44:15', '2026-03-07 00:44:15', NULL),
(23, 'e4cbf204-563a-43bc-bc89-b9e0008d5c96', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-07 00:47:05', '2026-03-07 00:47:05', NULL),
(24, '00a062d4-92e8-4c25-ba1e-7281092f504e', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-03-07 11:08:15', '2026-03-07 11:08:15', NULL),
(25, '07eda930-4d26-4b42-808c-eaa624df7aa3', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-07 11:10:21', '2026-03-07 11:10:21', NULL),
(26, 'fa64f8aa-4ae2-4fcd-97f7-a2d5fa2a7457', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-07 22:00:14', '2026-03-07 22:00:14', NULL),
(27, 'a63809f1-9442-4f5f-a776-5748606e375c', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-03-12 10:52:32', '2026-03-12 10:52:32', NULL),
(28, '75ca6def-c333-4ae7-a299-79a3acbdad6b', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-12 10:52:39', '2026-03-12 10:52:39', NULL),
(29, '914c3c9c-f0d4-47d5-afdc-3252491fbd99', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-15 03:16:46', '2026-03-15 03:16:46', NULL),
(30, '90b8f36a-79e1-4a79-90c0-a091db5b5753', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-17 11:00:56', '2026-03-17 11:00:56', NULL),
(31, 'f900fbbe-4189-44c7-95f3-d8210fec877d', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-18 23:50:35', '2026-03-18 23:50:35', NULL),
(32, '62db1192-59c3-4158-84ab-f063b2de95fa', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-03-19 04:09:21', '2026-03-19 04:09:21', NULL),
(33, 'f286753e-23c8-4090-b9f1-9eccaed66698', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-19 04:09:41', '2026-03-19 04:09:41', NULL),
(34, '6f59bf0e-55ef-4393-8904-03047ae1bc3f', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-03-19 23:49:23', '2026-03-19 23:49:23', NULL),
(35, '3351b22b-061c-4dc2-b3aa-6e12bf2a20a8', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-19 23:49:49', '2026-03-19 23:49:49', NULL),
(36, '782b5b6a-bd71-41f2-aeea-814ac5b4ffe3', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-20 04:28:13', '2026-03-20 04:28:13', NULL),
(37, 'c143b9d6-44cd-447f-a34f-39e993fcd18b', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-03-20 23:31:30', '2026-03-20 23:31:30', NULL),
(38, 'efa2c0e1-7f15-407d-b8f2-8827a7a1ade6', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-20 23:32:02', '2026-03-20 23:32:02', NULL),
(39, 'ab8573ef-1074-4000-b929-f9bc1bc2c9ab', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-03-21 02:33:52', '2026-03-21 02:33:52', NULL),
(40, 'c4237d67-c4f5-4076-8e62-84b885a7c821', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.122.1 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'Desktop', 'Windows', 'Chrome', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-06-02 23:33:03', '2026-06-02 23:33:03', NULL),
(41, '4cd54a7d-7d3d-4622-b280-8dd115d10804', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-06-03 00:42:28', '2026-06-03 00:42:28', NULL),
(42, '37efe3a4-6b2e-43e3-b0de-ad05a6111b94', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-06-03 00:42:44', '2026-06-03 00:42:44', NULL),
(43, '23911d93-edae-4420-8ed7-ec159f6ceb9b', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'Desktop', 'Windows', 'Chrome', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-06-04 00:24:01', '2026-06-04 00:24:01', NULL),
(44, '47916cb3-d0ee-41e5-81a9-b7cfc29bc433', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'Desktop', 'Windows', 'Chrome', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-06-05 00:03:58', '2026-06-05 00:03:58', NULL),
(45, '665f6ad8-5211-4f1f-adf0-6d47fd852ee6', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-06-08 00:04:20', '2026-06-08 00:04:20', NULL),
(46, 'ee47f431-0924-424e-b2b0-2d10a70f311f', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-06-08 00:05:14', '2026-06-08 00:05:14', NULL),
(47, 'a874fc30-74ae-4aac-8c52-7b67d7cec456', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-06-08 00:05:38', '2026-06-08 00:05:38', NULL),
(48, 'c49df090-e9de-48dc-bd7a-8f7414cb9908', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-06-08 00:05:56', '2026-06-08 00:05:56', NULL),
(49, 'd0a01efe-51d4-44a0-9888-16c4587ff689', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-06-09 00:06:59', '2026-06-09 00:06:59', NULL),
(50, '3a99bf25-a128-4a2b-b207-3dcefe986b24', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-06-09 00:07:23', '2026-06-09 00:07:23', NULL),
(51, 'fd0467c0-ddff-4c27-ba33-65cbd475257a', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-06-09 00:07:33', '2026-06-09 00:07:33', NULL),
(52, 'f0ac61f8-2088-440d-bd4b-433bc945438a', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-06-09 00:08:05', '2026-06-09 00:08:05', NULL),
(53, '0e68617e-212e-44f5-b4d1-e6d0509c32bc', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'Desktop', 'Windows', 'Chrome', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-06-09 01:54:41', '2026-06-09 01:54:41', NULL),
(54, '69d398ec-89c5-4e7e-bab8-2de0dba8147b', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-06-09 23:48:35', '2026-06-09 23:48:35', NULL),
(55, '8a48af62-ea54-4a05-a895-d6f6a22adecf', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-06-09 23:48:55', '2026-06-09 23:48:55', NULL),
(56, '92613e23-2670-4d96-857c-90973812d954', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'Desktop', 'Windows', 'Chrome', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-06-11 00:02:26', '2026-06-11 00:02:26', NULL),
(57, 'ba5fb143-c8d7-49dc-8603-60dd3ae1ee02', NULL, 'login_error', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Class \"App\\Http\\Controllers\\SessionModel\" not found', '2026-06-11 00:49:47', '2026-06-11 00:49:47', NULL),
(58, '6f516f06-ec10-400f-a081-e2cee736daf0', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.128.0 Chrome/148.0.7778.271 Electron/42.5.0 Safari/537.36', 'Desktop', 'Windows', 'Chrome', NULL, 1, NULL, '2026-07-13 02:24:50', '2026-07-13 02:24:50', NULL),
(59, 'bdeddf48-71e7-40c3-9324-d9e8d7e14fd9', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-07-13 23:18:26', '2026-07-13 23:18:26', NULL),
(60, '10258a7b-8ac5-48b8-935a-e6ee9e8ac66c', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-13 23:18:56', '2026-07-13 23:18:56', NULL),
(61, 'b0822674-8594-47c4-932d-ab7965193cd4', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-07-14 01:58:28', '2026-07-14 01:58:28', NULL),
(62, '059167b3-9cf5-4a2c-b919-d6dfe2e78aac', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.128.0 Chrome/148.0.7778.271 Electron/42.5.0 Safari/537.36', 'Desktop', 'Windows', 'Chrome', NULL, 1, NULL, '2026-07-14 02:44:10', '2026-07-14 02:44:10', NULL),
(63, '96edf540-9413-4479-b206-ba89c5fe7d68', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-07-14 02:45:09', '2026-07-14 02:45:09', NULL),
(64, '27c6d732-bdda-47ae-a68c-2f6340ce1c97', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-14 02:45:28', '2026-07-14 02:45:28', NULL),
(65, '8dcb7064-1645-451a-b0ca-21d3431651a4', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-07-14 23:23:01', '2026-07-14 23:23:01', NULL),
(66, '810428d4-a2ec-4c84-8654-ada753aa8f21', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-14 23:23:20', '2026-07-14 23:23:20', NULL),
(67, 'd5db604e-9b5d-463a-b7c4-e3009514cf1b', 1, 'logout', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-17 00:59:46', '2026-07-17 00:59:46', NULL),
(68, '4b93ebac-9e09-4965-a234-f0b82a76b2fe', 1, 'password_reset_request', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-17 01:00:06', '2026-07-17 01:00:06', NULL),
(69, 'a86d1ac0-87b5-422d-a5c8-cddd6cc2ab02', 1, 'password_reset_request', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-17 01:02:46', '2026-07-17 01:02:46', NULL),
(70, '28bd5c3e-ad4f-429c-a503-4b77937fa31d', 1, 'password_reset_request', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-17 01:11:08', '2026-07-17 01:11:08', NULL),
(71, '3781180e-0c92-437a-b11c-c7be63d31ea8', 1, 'password_reset_request', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-17 01:28:08', '2026-07-17 01:28:08', NULL),
(72, '0ae06107-91dc-4548-bdeb-0ab4307be7ce', 1, 'password_reset_request', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-17 01:34:19', '2026-07-17 01:34:19', NULL),
(73, 'b1512d73-2c3a-4dad-b259-e2290608e489', 1, 'password_reset_request', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-17 02:02:23', '2026-07-17 02:02:23', NULL),
(74, '8f6c8149-fdac-43c1-96bd-d2ccc9193367', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-07-17 02:03:41', '2026-07-17 02:03:41', NULL),
(75, '91b5655d-7f55-4b1d-9f20-76132831db95', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-17 02:03:55', '2026-07-17 02:03:55', NULL),
(76, '97c0ca82-f2b7-4d24-9db3-e2a7dffdd7ad', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-17 06:07:57', '2026-07-17 06:07:57', NULL),
(77, '97aa7b9c-83f9-4449-b48b-c914e3e03887', 1, 'login_attempt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 0, 'Incorrect password', '2026-07-21 02:17:01', '2026-07-21 02:17:01', NULL),
(78, '94d01fed-af9e-45f9-b87f-8863d776feb6', 1, 'login_success', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Desktop', 'Windows', 'Firefox', NULL, 1, NULL, '2026-07-21 02:17:28', '2026-07-21 02:17:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `featured_image_alt` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `og_image_alt` varchar(255) DEFAULT NULL,
  `gallery` longtext DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_keywords`)),
  `canonical_url` varchar(255) DEFAULT NULL,
  `status` enum('draft','published','scheduled') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `reading_time` tinyint(3) UNSIGNED DEFAULT NULL,
  `comment_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `uuid`, `category_id`, `author_id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `featured_image_alt`, `og_image`, `og_image_alt`, `gallery`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `status`, `published_at`, `is_featured`, `is_active`, `views`, `display_order`, `reading_time`, `comment_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(23, 'f24dc7cc-e79f-472f-b924-8194e2831bc8', 31, 8, 'Why Your Website Is Losing Customers Without You Knowing', 'why-your-website-is-losing-customers-without-you-knowing', 'Most website owners never see their own site the way a stranger does. Here is the gap that quietly costs businesses customers every single day, and how to actually find and fix it.', '<p>Most website owners never see their own site the way a stranger does. They know where every button is, what every menu means, and why the homepage is structured the way it is, because they were there when it was built, they approved every decision, and they have looked at it hundreds of times since. A first-time visitor has none of that context. They land on the page cold, with zero patience, and a dozen other options a single tab-close away. The gap between what the owner sees and what a stranger sees is usually where customers quietly disappear, and it almost never shows up as a complaint. It shows up as a closed tab, a bounce, a number on a dashboard that nobody bothers to investigate.</p><h2>The Problem Nobody Reports</h2><p>Lost visitors do not leave feedback. They do not email you to explain that your homepage confused them, or that the checkout took too long, or that they simply did not trust the site enough to enter their card details. They just leave, and the business rarely finds out why. Analytics tools will show you a bounce rate percentage, an average session duration, an exit-page report, but none of that data explains the human reason behind the number. Understanding the actual cause requires sitting down and looking at your own website the way a stranger would, ideally with someone who has never seen it before sitting next to you, narrating exactly what confuses them and where they hesitate.</p><p>This is uncomfortable for a lot of business owners, because it means acknowledging that something they are proud of, something they spent real money building, might genuinely be working against them in ways they cannot see from the inside. But that discomfort is exactly where the useful insight lives. The businesses that grow fastest online are rarely the ones with the most polished-looking site, they are the ones willing to keep questioning whether their site is actually doing its job.</p><h2>Six Reasons Visitors Leave Before Converting</h2><p>After auditing enough websites across enough industries, the same handful of problems keep showing up, in different combinations, on nearly every underperforming site. None of them are exotic. All of them are fixable. The difficulty is rarely technical, it is that nobody inside the business noticed them, because familiarity blinds you to friction.</p><ol><li><strong>Load time over three seconds.</strong> Every additional second of load time measurably increases the chance a visitor leaves before the page even finishes rendering. This is not a soft preference, it is a hard behavioral pattern documented across every major study on web performance, and it gets worse on mobile connections.</li><li><strong>Unclear value proposition.</strong> If a visitor cannot tell what you actually do and why it matters to them within the first screen, before they scroll, they assume the site is not for them and move on. A clever tagline that requires context to understand is a liability, not a feature.</li><li><strong>Navigation that requires guessing.</strong> Menus with vague, clever, or internally-branded labels force visitors to click around hunting for what they need. Most will not bother. Clarity beats cleverness in navigation every single time.</li><li><strong>No real mobile optimization.</strong> More than half of most traffic now arrives on a phone, and a layout that was clearly designed desktop-first and merely squeezed to fit a smaller screen quietly turns away that majority.</li><li><strong>Weak or missing calls to action.</strong> A visitor who is genuinely ready to act needs an obvious, singular next step, not a vague \"learn more\" link buried at the bottom of a long page competing with six other links.</li><li><strong>A design that quietly signals an outdated business.</strong> Visitors judge credibility by visual polish within the first few seconds, often without realizing they are doing it. Fair or not, an outdated design reads as a business that might also be outdated in how it operates.</li></ol><h2>A Quick Self-Audit You Can Run Today</h2><p>You do not need an expensive audit to start finding these problems. Pull up your analytics and look at the following signals honestly, without explaining them away.</p><table><thead><tr><th>Signal to Check</th><th>What It Usually Means</th><th>Fix Priority</th></tr></thead><tbody><tr><td>Page load over 3 seconds</td><td>Heavy images, unoptimized code, or poor hosting</td><td>High</td></tr><tr><td>Bounce rate above 70% on homepage</td><td>Unclear value proposition or slow load</td><td>High</td></tr><tr><td>Low mobile session duration vs desktop</td><td>Broken or clunky mobile experience</td><td>High</td></tr><tr><td>Low click-through on main CTA</td><td>Weak, unclear, or poorly placed button</td><td>Medium</td></tr><tr><td>High exit rate on pricing or contact page</td><td>Confusing layout or missing trust signals</td><td>Medium</td></tr></tbody></table><h2>Why \"Just Redesign It\" Is the Wrong First Instinct</h2><p>When a website underperforms, the instinctive reaction is often to scrap it and start over. That instinct is usually wrong, and it is expensive. A full redesign without first understanding exactly which specific friction points are losing the most visitors is a gamble, not a fix. You might spend weeks and a meaningful budget rebuilding something, only to discover the new version has a different set of problems, because the underlying issue was never diagnosed, it was just assumed.</p><p>A more disciplined approach starts with identifying the two or three specific points of friction that are losing the most visitors, based on actual data rather than gut feeling, and fixing those first. Sometimes that means a full redesign is genuinely warranted. More often, it means a focused set of changes: rewriting the homepage headline, restructuring the main navigation, compressing images that are dragging load time, or rebuilding a single confusing page. Each change should be treated as a testable hypothesis, not a guess you commit to permanently.</p><h2>How to Test Changes Without Guessing</h2><p>The businesses that consistently improve their website performance over time share one habit: they change one meaningful thing at a time and measure what happens before changing the next thing. This is slower than redesigning everything at once, but it is the only way to actually know what worked. If you change the headline, the navigation, and the checkout flow simultaneously and conversions go up, you genuinely do not know which change caused the improvement, which means you cannot repeat that success intentionally next time.</p><p>Simple tools already available to most businesses, Google Analytics, heatmap software, session recording tools, are usually enough to run this kind of focused testing without needing an enterprise-level conversion optimization program. The goal is not perfection, it is a steady, compounding improvement built on actual evidence instead of internal opinion.</p><h2>The Trust Layer Most Sites Skip</h2><p>Beyond speed and clarity, there is a quieter factor that determines whether a hesitant visitor converts: trust signals. Real client logos, genuine testimonials with names attached, visible contact information, clear policies, security badges near payment fields, these all reduce the psychological friction of a stranger handing over money or personal information to a business they have never dealt with before. Many websites either skip these entirely or bury them somewhere nobody scrolls to. Placing trust signals near the exact moment a decision is being made, right next to a pricing table or a checkout button, is consistently more effective than a dedicated \"testimonials\" page nobody visits on their own.</p><h2>What This Actually Looks Like in Practice</h2><p>Picture a services business with a homepage that looks professional, loads reasonably fast, but has a bounce rate well above industry average. On closer inspection, the headline talks about the company\'s twenty years of experience instead of the specific problem it solves for visitors. The main navigation has seven items, three of which are internally meaningful but externally confusing. The call-to-action button says \"Submit\" instead of something specific like \"Get a Free Quote.\" None of these are catastrophic individually, but together they create enough friction that a meaningful share of visitors leave without ever engaging.</p><p>Fixing this rarely requires a new website. It requires rewriting the headline around the visitor\'s problem, trimming the navigation to what people actually search for, and replacing generic button text with something specific and low-risk sounding. Small, deliberate, evidence-based changes like this consistently outperform a full redesign built on assumption.</p><h2>Final Thought</h2><p>A website is never really \"done.\" It is a living asset that either keeps earning its keep or quietly leaks opportunity every day it goes unexamined. The businesses that treat their site as a continuously improving system, rather than a one-time project, are the ones that consistently outperform competitors with an objectively nicer-looking but less thoughtfully built website.</p>', NULL, NULL, NULL, NULL, NULL, 'Why Your Website Is Losing Customers Without You Knowing | Deovate Blog', 'Most website owners never see their own site the way a stranger does. Here is the gap that quietly costs businesses customers every single day, and how to actually find and fix it.', '\"[\\\"website conversion\\\",\\\"web design mistakes\\\",\\\"user experience\\\",\\\"bounce rate\\\"]\"', NULL, 'published', '2026-06-24 05:02:29', 1, 1, 2133, 1, 7, 0, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(24, 'e5fd682d-4492-4b62-a0ae-7da8e9fcb6ff', 32, 1, 'Custom Software vs Off-the-Shelf: How to Actually Decide', 'custom-software-vs-off-the-shelf-how-to-actually-decide', 'Almost every growing business hits this decision eventually. Here is a complete framework for deciding, based on what actually determines long-term cost and fit, not just the number on day one.', '<p>Almost every growing business hits this decision eventually: keep patching together off-the-shelf tools that mostly work, or invest in something built specifically around how the business actually operates. Both are legitimate choices in the right circumstances, but most businesses make this call based on upfront cost alone, which is exactly the wrong way to evaluate it. Upfront cost is the easiest number to compare and the least informative one, because it ignores everything that happens after the purchase decision is made.</p><h2>Why This Decision Gets Made Badly</h2><p>Off-the-shelf software always wins on day-one price. It is faster to set up, requires no development timeline, and comes with a support team already in place, so it becomes the default choice for most teams operating under time pressure or budget scrutiny. The real cost of that decision rarely shows up immediately. It shows up months or years later, in the accumulation of workarounds, manual data re-entry between disconnected systems, and the quiet normalization of \"we just do it this way because the tool cannot\" as an accepted part of daily operations.</p><p>By the time a business notices how much time and money those workarounds are actually costing, switching becomes its own expensive project, migrating data, retraining staff, untangling processes that were built around the tool\'s limitations rather than the business\'s actual needs. This is why the decision deserves more rigor upfront than most businesses give it.</p><h2>Five Questions That Actually Determine the Right Choice</h2><ol><li><strong>Is your workflow genuinely standard, or does it have real business-specific logic a generic tool cannot represent?</strong> Most accounting and generic HR functions are standard enough that off-the-shelf software fits well. Highly specific operational logic, custom pricing rules, unique approval chains, industry-specific compliance steps, often does not fit any generic tool cleanly.</li><li><strong>How many people will use this daily, and does per-seat licensing cost scale badly at that number?</strong> A tool that costs very little with five users can become surprisingly expensive at fifty, and that cost compounds every year going forward with no ceiling.</li><li><strong>Do you need this system to integrate deeply with two or more other tools you already depend on?</strong> Off-the-shelf tools vary wildly in how open and reliable their integration options actually are, and a system that needs to be the connective tissue between several other systems often benefits from custom-built integration logic.</li><li><strong>Is this process core to your competitive advantage, or is it a commodity task every business in your industry does the same way?</strong> Building custom software around a genuinely differentiating process can be a real advantage. Building custom software around something completely standard is usually wasted effort.</li><li><strong>Are you planning to scale significantly in the next two to three years in a way a generic plan tier might not support?</strong> Growth plans matter more than current size when evaluating long-term software fit.</li></ol><h2>Comparison at a Glance</h2><table><thead><tr><th>Factor</th><th>Off-the-Shelf Software</th><th>Custom Software</th></tr></thead><tbody><tr><td>Upfront Cost</td><td>Low</td><td>Higher</td></tr><tr><td>Long-Term Cost at Scale</td><td>Grows with per-seat fees</td><td>Fixed after build, no per-seat fees</td></tr><tr><td>Fit to Your Exact Workflow</td><td>Approximate, requires workarounds</td><td>Exact, built around your process</td></tr><tr><td>Ownership</td><td>You rent access</td><td>You own the system outright</td></tr><tr><td>Time to Launch</td><td>Immediate</td><td>Weeks to months depending on scope</td></tr></tbody></table><h2>The Hidden Cost of \"Good Enough\"</h2><p>Generic software rarely fails outright, it simply becomes \"good enough,\" and good enough has a way of quietly capping how efficiently a team can operate. Employees learn to work around limitations instead of flagging them, because raising the issue feels like more effort than just doing the extra manual step. Over time, this creates an invisible tax on productivity that never appears on any invoice, but shows up clearly in how much longer certain tasks take compared to a business with tooling actually built for its process.</p><p>This is the argument that upfront cost comparisons miss entirely. A five thousand rupee monthly software subscription looks cheap next to a one-time custom development cost, until you calculate the value of the hours lost every month to workarounds that a properly fitted system would have eliminated.</p><h2>When Off-the-Shelf Genuinely Wins</h2><p>None of this is an argument that custom software is always the right call, it frequently is not. A small team handling standard accounting, generic project management, or common HR functions is almost always better served by a mature, well-supported off-the-shelf tool. These categories are so standardized that building something custom would mean reinventing years of accumulated product refinement for no real benefit. The right question is never \"custom or off-the-shelf\" as a blanket policy, it is \"custom or off-the-shelf\" evaluated separately for each distinct function in the business.</p><h2>The Middle Path Most Businesses Miss</h2><p>It rarely has to be one extreme or the other across the entire business. Many businesses get the best outcome by keeping standard off-the-shelf tools for genuinely standard functions, generic accounting software, common email platforms, while building custom software only around the specific processes that actually differentiate how they operate or where a generic tool creates measurable friction. That hybrid approach controls cost while still solving the real bottleneck, instead of either over-investing in custom development for commodity tasks or under-investing in the one process that actually needs it.</p><h2>How to Start the Evaluation Properly</h2><p>Before committing to either path, map out your actual current workflow in detail, every manual step, every workaround, every place data gets copied between systems by hand. This exercise alone often reveals exactly where the real cost is hiding, and makes the custom-versus-off-the-shelf decision far more obvious than it seemed at the start. A good development partner should be willing to sit through this mapping exercise with you honestly, including telling you when an off-the-shelf tool is genuinely the better answer, rather than defaulting to recommending a custom build regardless of fit.</p><h2>Final Thought</h2><p>The right decision is rarely about which option is cheaper today. It is about which option costs less, in time, friction, and flexibility, three years from now, once your business has grown into whatever it is becoming.</p>', NULL, NULL, NULL, NULL, NULL, 'Custom Software vs Off-the-Shelf: How to Actually Decide | Deovate Blog', 'Almost every growing business hits this decision eventually. Here is a complete framework for deciding, based on what actually determines long-term cost and fit, not just the number on day one.', '\"[\\\"custom software development\\\",\\\"off the shelf software\\\",\\\"ERP\\\",\\\"business software\\\"]\"', NULL, 'published', '2026-06-25 05:02:29', 0, 1, 3132, 2, 5, 0, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(25, 'e35efe93-3ee0-41e0-a01c-d75e35d33e20', 33, 6, 'The Real Cost of Cart Abandonment (And How to Actually Reduce It)', 'the-real-cost-of-cart-abandonment-and-how-to-actually-reduce-it', 'Cart abandonment is one of the most measurable, most ignored revenue leaks in eCommerce. Here is where the friction actually comes from and what measurably reduces it.', '<p>Cart abandonment is one of the most measurable, most consistently ignored revenue leaks in eCommerce. Most stores treat a high abandonment rate as an inevitable cost of doing business online, an unavoidable tax on running a digital storefront, when in reality a large share of it comes from specific, identifiable, fixable friction points inside the checkout experience itself. The businesses that take this seriously and fix the friction methodically see measurable, often surprisingly large, recovery in completed sales, without spending an extra rupee on new traffic.</p><h2>Where the Abandonment Actually Happens</h2><p>Cart abandonment is rarely about price alone, even though that is the easiest explanation to reach for. It is far more often about an experience that introduced doubt, confusion, or friction at exactly the moment a customer was psychologically ready to commit to the purchase. An unexpected shipping cost revealed only at the last step. A forced account creation that feels like an unnecessary hurdle. A checkout process that stretches across too many pages. A payment method that simply is not available. Any one of these can be enough to tip a ready buyer back into hesitation, and hesitation at checkout very rarely resolves itself in the customer\'s favor.</p><h2>Seven Common Checkout Friction Points</h2><ul><li>Unexpected costs revealed only at the final step, shipping, taxes, or handling fees that were not visible earlier in the journey</li><li>Forced account creation before completing a purchase, adding a barrier for first-time or one-time buyers</li><li>A checkout process that takes more than three to four steps to complete</li><li>Limited payment options that do not match what the customer actually prefers to use</li><li>No visible security or trust signals during the payment step itself</li><li>Slow page load specifically during checkout, even if the rest of the store performs fine</li><li>No clear order summary visible before the final confirmation click, leaving customers uncertain about exactly what they are about to pay</li></ul><h2>Impact of Fixing Each Friction Point</h2><table><thead><tr><th>Friction Point Fixed</th><th>Typical Impact</th></tr></thead><tbody><tr><td>Guest checkout enabled</td><td>Meaningful reduction in abandonment at the account-creation step</td></tr><tr><td>Shipping cost shown early</td><td>Fewer surprise-cost exits at the final step</td></tr><tr><td>Checkout reduced to 2-3 steps</td><td>Higher overall completion rate</td></tr><tr><td>Multiple payment methods added</td><td>Captures customers who would otherwise have abandoned</td></tr><tr><td>Trust badges near the payment field</td><td>Increased confidence completing the payment step</td></tr></tbody></table><h2>The Psychology Behind Checkout Abandonment</h2><p>Every additional step in a checkout flow is a fresh opportunity for a customer to reconsider. Psychologically, momentum matters enormously in a purchase decision, once someone has decided to buy, the goal of your checkout should be to preserve that momentum and get out of the way, not to introduce new decisions or new information that reopens the question of whether to buy at all. A surprise cost at the final step does not just add a rupee amount, it reframes the entire transaction in the customer\'s mind as \"this store was not upfront with me,\" which is a trust problem, not just a pricing problem.</p><p>This is why simply lowering prices rarely fixes a high abandonment rate on its own. If the underlying experience still contains friction and surprise, a lower price just delays the moment of hesitation rather than removing it.</p><h2>Mobile Checkout Deserves Its Own Attention</h2><p>A significant and growing share of online shopping now happens on a phone, and mobile checkout experiences are disproportionately where abandonment happens, because small friction that is merely annoying on desktop becomes genuinely difficult on a smaller screen with a virtual keyboard. Long forms, tiny tap targets, payment fields that are not optimized for mobile autofill, all of these compound on mobile in ways that do not show up as clearly in aggregate desktop-weighted analytics. Testing your checkout specifically on a phone, ideally on a mid-range device and an average connection rather than the newest flagship on office wifi, often reveals friction that is invisible from a developer\'s desktop setup.</p><h2>Recovering Abandoned Carts That Already Happened</h2><p>Reducing new abandonment is the priority, but a well-built abandoned cart recovery sequence, typically a short series of reminder emails or messages sent over the following days, recovers a meaningful share of carts that were abandoned for reasons other than pure disinterest, a distraction, an interrupted session, uncertainty that resolves itself with a gentle reminder. The most effective recovery sequences are simple: a reminder shortly after abandonment, a follow-up with any relevant reassurance around shipping or returns, and occasionally a modest, time-limited incentive as a final nudge, rather than leading with a discount immediately, which can train customers to abandon carts intentionally expecting a coupon.</p><h2>The Bigger Picture</h2><p>None of these fixes require a full store rebuild, and that is precisely why they get overlooked, they are not dramatic enough to trigger a full redesign conversation, so they simply persist quietly for years. The businesses that treat checkout as its own dedicated, continuously optimized project, rather than an afterthought bolted onto the rest of the store, are the ones that consistently convert a higher share of the traffic they are already paying to acquire. Checkout is the single page in your entire funnel where revenue is decided in real time, and it deserves attention proportional to that fact.</p><h2>Final Thought</h2><p>Every abandoned cart represents a customer who was close enough to buying to add an item and start the process. That is a far warmer prospect than a new visitor arriving cold, which is exactly why the return on fixing checkout friction is consistently higher than the return on simply acquiring more traffic to send through the same broken funnel.</p>', NULL, NULL, NULL, NULL, NULL, 'The Real Cost of Cart Abandonment (And How to Actually Reduce It) | Deovate Blog', 'Cart abandonment is one of the most measurable, most ignored revenue leaks in eCommerce. Here is where the friction actually comes from and what measurably reduces it.', '\"[\\\"cart abandonment\\\",\\\"ecommerce checkout\\\",\\\"conversion rate optimization\\\",\\\"online store\\\"]\"', NULL, 'published', '2026-05-22 05:02:29', 0, 1, 2848, 3, 5, 0, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(26, '1cd3550a-17e6-4c55-8a59-d3bc6128cbf0', 34, 2, 'SEO in the Age of AI Search: What Still Actually Works', 'seo-in-the-age-of-ai-search-what-still-actually-works', 'AI-generated search summaries have changed how people find information. Here is what genuinely changed, what still works, and why the fundamentals matter more now, not less.', '<p>AI-generated search summaries have changed how people find information online, and a lot of businesses have quietly panicked, assuming SEO no longer matters the way it used to. The reality is more specific and, honestly, more reassuring than the panic suggests: some tactics have genuinely lost value, while the fundamentals that were always the actual foundation of good SEO matter more now than they did five years ago. Understanding the difference between what changed and what did not is the difference between adapting intelligently and abandoning a channel that still works.</p><h2>What Has Actually Changed</h2><p>AI-generated answers often satisfy a search query directly on the results page, without the user ever clicking through to a website, which has measurably reduced raw click volume for certain kinds of informational queries, particularly simple factual questions with a short, direct answer. This is a real shift, and pretending otherwise does not help anyone plan around it. But those AI answers are still pulling their information from somewhere. They are synthesizing content that already exists on the web, and being the specific source that gets cited, summarized, or referenced is now a form of visibility that carries real value, sometimes more strategic value than ranking first in a traditional list of ten blue links.</p><h2>What Still Works, and Now Matters More</h2><ol><li><strong>Clear, well-structured content that directly answers a specific question.</strong> This is exactly the format AI systems pull from most reliably, because it is unambiguous and easy to extract cleanly.</li><li><strong>Genuine expertise and original insight.</strong> AI-generated summaries increasingly favor sources that add something beyond generic, restated information already available everywhere else, which rewards depth over volume.</li><li><strong>Technical SEO fundamentals.</strong> Crawlability, site speed, and clean structured data have not become less important, if anything they have become a baseline requirement for being considered at all, by traditional search or AI systems.</li><li><strong>Strong internal linking and topical depth across a site.</strong> This signals authority both to traditional search engines and to AI summarization systems evaluating how comprehensively a site covers a subject.</li><li><strong>Local SEO for location-based businesses.</strong> AI answers for local queries still rely heavily on verified, structured business data, so the fundamentals of accurate listings and consistent citations remain just as relevant.</li></ol><h2>Old Tactic vs New Reality</h2><table><thead><tr><th>SEO Tactic</th><th>Then</th><th>Now</th></tr></thead><tbody><tr><td>Keyword stuffing</td><td>Marginally effective</td><td>Actively penalized and ignored</td></tr><tr><td>Generic 500-word articles</td><td>Ranked reasonably well</td><td>Rarely competitive or cited</td></tr><tr><td>Deep, well-structured expert content</td><td>Valuable</td><td>More valuable than ever</td></tr><tr><td>Backlinks from relevant sources</td><td>Core ranking factor</td><td>Still core, now also builds AI trust signals</td></tr><tr><td>Structured data markup</td><td>Nice to have</td><td>Increasingly necessary for AI visibility</td></tr></tbody></table><h2>Why Thin Content Is the First Casualty</h2><p>Content that exists purely to target a keyword, without offering a genuinely useful, specific answer, was already losing ground before AI search accelerated the trend, and it is now the clearest loser in this transition. AI summarization systems are, functionally, very good at identifying which sources actually contain substance and which sources are padded restatements of the same three points everyone else already published. Businesses that built their content strategy around volume, publishing frequently but shallowly, are the ones seeing the sharpest visibility decline, while businesses that published less often but with genuine depth are holding steady or even gaining ground.</p><h2>What Being \"AI-Citable\" Actually Requires</h2><p>Content that gets pulled into AI-generated answers tends to share a few concrete traits: a clear, direct answer to a specific question near the top of the content rather than buried under paragraphs of preamble, well-organized headings that map cleanly to distinct sub-questions, factual claims that are specific and checkable rather than vague, and enough surrounding context and structured data for a system to understand not just what the page says but what the page is actually about. This is not a fundamentally different discipline from writing genuinely helpful content for a human reader, it is largely the same discipline, executed with more structural discipline than casual blogging typically involves.</p><h2>Rethinking Success Metrics</h2><p>If raw click volume on certain informational queries is structurally declining industry-wide, measuring SEO success purely by total organic clicks becomes an increasingly incomplete picture. Businesses adapting well to this shift are starting to track additional signals, brand mention frequency in AI-generated answers, direct traffic growth that suggests brand recall from an AI citation, and conversion quality from the organic traffic that does still arrive, since that traffic increasingly represents higher-intent visitors who clicked through despite an AI summary already being available.</p><h2>Practical Steps for the Next Twelve Months</h2><p>Audit existing content honestly and identify which pieces are thin restatements versus genuinely deep resources, then prioritize consolidating or deepening the thin ones rather than adding more shallow content on top. Invest in structured data implementation across key pages if it has been neglected. Strengthen internal linking so topical authority is clearly demonstrated across a cluster of related content rather than isolated individual pages. And resist the temptation to chase every algorithm rumor, the fundamentals of genuinely useful, well-structured, expert content have outlasted every previous search algorithm shift, and there is no strong reason to believe this one is different.</p><h2>The Honest Takeaway</h2><p>SEO has not died, it has gotten less forgiving of shortcuts. Thin content and keyword tricks that used to squeeze out rankings are losing ground fast, while genuinely useful, well-structured, expert content is becoming the only reliable path to visibility, in both traditional search results and AI-generated summaries. The businesses treating this moment as a reason to abandon SEO are making a mistake; the businesses treating it as a reason to finally invest in real content depth are the ones who will be well positioned once the current uncertainty settles.</p>', NULL, NULL, NULL, NULL, NULL, 'SEO in the Age of AI Search: What Still Actually Works | Deovate Blog', 'AI-generated search summaries have changed how people find information. Here is what genuinely changed, what still works, and why the fundamentals matter more now, not less.', '\"[\\\"SEO 2026\\\",\\\"AI search\\\",\\\"technical SEO\\\",\\\"content strategy\\\"]\"', NULL, 'published', '2026-07-05 05:02:29', 1, 1, 1709, 4, 5, 0, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(27, '8cf14670-15ed-4ba3-beac-d90f8b946bd7', 34, 6, 'Google Ads vs Meta Ads: Where Should Your Budget Actually Go', 'google-ads-vs-meta-ads-where-should-your-budget-actually-go', 'One of the most common questions from businesses starting paid marketing, and the honest answer depends on your offer, not a fixed rule. Here is the actual framework for deciding.', '<p>This is one of the most common questions from businesses starting paid marketing, and the honest answer is that it depends heavily on your specific offer, audience, and stage of growth, not a fixed rule that applies universally. Most of the generic advice floating around defaults to a simple recommendation without explaining the reasoning, which leaves businesses applying a rule that may not actually fit their situation. This article breaks down exactly what determines the right split, so the decision can be made based on your specific business rather than a borrowed rule of thumb.</p><h2>The Core Difference That Actually Matters</h2><p>Google Ads captures demand that already exists. Someone is actively typing a search because they already have a need or a question, and your ad is competing to be the answer they click on, right at the moment of highest intent. Meta Ads, by contrast, creates demand by interrupting someone\'s scroll with something visually compelling before they were consciously looking for it at all. Neither approach is inherently better, they solve fundamentally different problems at different stages of a buyer\'s journey, and conflating them leads to poor budget decisions.</p><h2>When Google Ads Wins</h2><ul><li>High-intent purchases where people actively search before buying, services, B2B solutions, urgent or specific needs</li><li>Products or services with a well-defined, known search term customers are already using</li><li>Situations where you need measurable, bottom-of-funnel conversions relatively quickly</li></ul><h2>When Meta Ads Wins</h2><ul><li>Visually appealing products that genuinely benefit from strong creative, most physical products fit this category well</li><li>Building awareness for a new brand or offer that nobody is actively searching for yet</li><li>Lower-cost, more impulse-driven purchases where a scroll-stopping ad can trigger a spontaneous decision</li></ul><h2>Budget Allocation Guide</h2><table><thead><tr><th>Business Type</th><th>Suggested Starting Split</th></tr></thead><tbody><tr><td>B2B service or high-ticket consulting</td><td>70% Google, 30% Meta</td></tr><tr><td>Visual physical product (fashion, home goods)</td><td>40% Google, 60% Meta</td></tr><tr><td>New brand with low existing search volume</td><td>20% Google, 80% Meta</td></tr><tr><td>Established brand with strong search demand</td><td>60% Google, 40% Meta</td></tr></tbody></table><h2>Why Comparing Cost-Per-Click Alone Is Misleading</h2><p>Businesses new to paid marketing frequently compare platforms by looking only at cost-per-click, and conclude whichever platform is cheaper per click is the better investment. This comparison misses the point almost entirely, because the two platforms are delivering fundamentally different types of clicks. A cheap Meta click from someone mid-scroll who has never heard of your brand is not equivalent to a more expensive Google click from someone actively searching with clear buying intent. The metric that actually matters is cost per qualified conversion, not cost per click, and those two numbers can rank platforms in completely opposite order.</p><h2>The Funnel Stage Most Businesses Skip Thinking About</h2><p>A common mistake is running Meta ads that attempt to sell directly to a completely cold audience, expecting the same conversion rate as a Google search ad targeting someone already in buying mode. That comparison sets Meta up to look like it is underperforming, when the real issue is a mismatch between the audience\'s awareness stage and the ad\'s call to action. Cold Meta traffic generally responds better to lower-commitment offers, a free resource, a short video, a simple newsletter signup, that builds familiarity before a direct sales pitch, rather than asking for a purchase decision from someone who saw your brand for the first time four seconds ago.</p><h2>Testing Before Committing Serious Budget</h2><p>Before allocating a significant monthly budget to either platform, a smaller test budget run over two to three weeks on each platform reveals far more than theory alone. Track cost per qualified lead or sale, not just cost per click or impressions, and be honest about sample size, a handful of conversions on either platform is not yet a reliable signal. This testing phase is inexpensive relative to the cost of committing a large monthly budget to the wrong channel for months before noticing the mismatch.</p><h2>The Real Answer</h2><p>Most mature marketing strategies eventually use both platforms deliberately, Meta to build awareness and generate demand among people who were not yet looking, Google to capture that demand once it matures into an active search. Treating the two platforms as competitors fighting for the same fixed budget, rather than complementary tools serving different stages of the same customer journey, is usually where businesses leave the most performance on the table.</p><h2>Final Thought</h2><p>The right allocation is never a permanent decision, it should shift as your brand matures, as search demand for your category grows or shrinks, and as you learn more about where your specific customers actually spend their attention. Revisit the split quarterly with real data instead of setting it once and forgetting it.</p>', NULL, NULL, NULL, NULL, NULL, 'Google Ads vs Meta Ads: Where Should Your Budget Actually Go | Deovate Blog', 'One of the most common questions from businesses starting paid marketing, and the honest answer depends on your offer, not a fixed rule. Here is the actual framework for deciding.', '\"[\\\"google ads vs meta ads\\\",\\\"ppc strategy\\\",\\\"paid marketing budget\\\",\\\"digital advertising\\\"]\"', NULL, 'published', '2026-06-27 05:02:29', 0, 1, 3325, 5, 4, 0, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(28, '85599366-a2d2-47e7-9752-246a69674edd', 33, 15, 'Brand Identity Mistakes That Are Quietly Costing You Trust', 'brand-identity-mistakes-that-are-quietly-costing-you-trust', 'Most branding mistakes are not dramatic, they are small inconsistencies that quietly accumulate until a business looks less credible than it actually is.', '<p>Most branding mistakes are not dramatic, they are small inconsistencies that quietly accumulate until a business looks less credible than it actually is, without anyone inside the company noticing the slow drift. A slightly different logo file used on Instagram than on the website. A brand color that shifts a few shades between the printed brochure and the digital ad. A tone of voice that sounds formal in an email and casual on social media, as if two different companies were writing them. None of these individually feel like a crisis, which is exactly why they persist for years, unaddressed.</p><h2>Why Small Inconsistencies Matter More Than You Think</h2><p>A buyer evaluating your business rarely consciously thinks about your logo alignment, your specific shade of blue, or your font choice. But they register these details subconsciously, as a signal of how much attention the business pays to detail overall. Inconsistent branding does not just look mildly unpolished, it quietly reduces trust before a single word of your actual pitch, product, or service quality is even considered. In competitive markets, where a buyer is comparing you against several alternatives, that subconscious trust deficit can be the deciding factor even when your actual offering is genuinely stronger.</p><h2>Five Mistakes We See Constantly</h2><ol><li>Using multiple slightly different logo versions across different platforms instead of one consistent, locked master file that every team member pulls from.</li><li>Choosing colors that shift slightly between the website, social media, and printed materials, because nobody defined exact hex and print color codes in the first place.</li><li>No defined typography system, resulting in a different font appearing on every new document, presentation, or social post depending on whoever created it.</li><li>Marketing materials that look like they were made by different people at different times, because they usually were, without a shared brand reference to work from.</li><li>A visual identity that was designed once, early in the business\'s life, and never revisited or refined as the business matured and its positioning evolved.</li></ol><h2>Quick Brand Consistency Checklist</h2><table><thead><tr><th>Touchpoint</th><th>What to Check</th></tr></thead><tbody><tr><td>Website</td><td>Correct logo file, brand colors matching hex codes exactly</td></tr><tr><td>Social Media Profiles</td><td>Same logo crop and color treatment across all platforms</td></tr><tr><td>Business Cards & Stationery</td><td>Matches the primary brand guideline document exactly</td></tr><tr><td>Email Signature</td><td>Uses the approved logo and font, not a default system font</td></tr><tr><td>Marketing Materials</td><td>Follows the same visual system as the website</td></tr></tbody></table><h2>The Cost of Inconsistency Is Rarely Measured, But It Is Real</h2><p>Because inconsistent branding does not trigger an obvious complaint or a support ticket, businesses rarely attribute lost deals or hesitant customers to it directly. Instead, it gets absorbed into vague explanations like \"the market is tough right now\" or \"we need better salespeople,\" when part of the actual friction was a first impression that quietly undercut credibility before the conversation even started. This is difficult to measure precisely, but it is not difficult to observe once you start paying attention: businesses with tightly consistent branding are consistently perceived as more established and trustworthy than their actual size or age would suggest, and the reverse is equally true.</p><h2>Why Growing Businesses Are Especially Vulnerable to This</h2><p>Early-stage businesses often build their first brand assets quickly, sometimes as an afterthought while focused on the actual product or service. As the business grows, more people touch the brand, a new hire designs a slide deck, a freelancer builds a social campaign, an intern makes a flyer, each pulling from slightly different reference points because no single locked source of truth exists. The inconsistency compounds with every new person who touches brand materials without a clear guideline to follow, which is why the problem tends to get worse, not better, as a business scales, unless it is deliberately addressed.</p><h2>What a Proper Brand Guideline Actually Prevents</h2><p>A well-built brand guideline is not a vanity document, it is a practical tool that prevents exactly this kind of drift. It defines the locked logo files and their acceptable variations, the exact color codes for both digital and print use, the approved typography pairing, and enough tone-of-voice direction that anyone writing on behalf of the business sounds recognizably consistent with everyone else who has written for it. Once this exists, onboarding a new designer, freelancer, or marketing hire becomes dramatically faster and safer, because they have a clear reference instead of having to guess or reverse-engineer the brand from old files.</p><h2>The Fix Is Usually Simpler Than Expected</h2><p>Fixing inconsistent branding rarely means starting over from a blank page, and that misconception is often what stops businesses from addressing it at all. It usually means auditing what already exists across every platform and printed material, identifying which version of each asset is actually correct, defining one locked set of files and rules, and making sure every future piece of material pulls from that single source instead of being recreated from memory or guesswork each time. This is a contained, achievable project, not a full rebrand, and the return on doing it properly shows up in how the business is perceived long before it shows up in any measurable metric.</p><h2>Final Thought</h2><p>Brand consistency is one of the few areas of business where the fix is genuinely cheaper than the ongoing cost of ignoring the problem. A locked, well-documented identity pays for itself the first time it saves a new hire from guessing, and the first time a prospective client perceives your business as more established simply because everything they saw looked like it came from the same place.</p>', NULL, NULL, NULL, NULL, NULL, 'Brand Identity Mistakes That Are Quietly Costing You Trust | Deovate Blog', 'Most branding mistakes are not dramatic, they are small inconsistencies that quietly accumulate until a business looks less credible than it actually is.', '\"[\\\"brand identity\\\",\\\"branding mistakes\\\",\\\"logo design\\\",\\\"brand consistency\\\"]\"', NULL, 'published', '2026-07-16 05:02:29', 0, 1, 2288, 6, 5, 0, '2026-07-21 05:02:29', '2026-07-21 05:58:07', NULL);
INSERT INTO `blogs` (`id`, `uuid`, `category_id`, `author_id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `featured_image_alt`, `og_image`, `og_image_alt`, `gallery`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `status`, `published_at`, `is_featured`, `is_active`, `views`, `display_order`, `reading_time`, `comment_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(29, '945e8b1b-36b1-4e48-8b43-3be893509ce5', 35, 11, 'Cloud Migration Without the Downtime: A Practical Guide', 'cloud-migration-without-the-downtime-a-practical-guide', 'Cloud migration sounds simple in a pitch deck and becomes genuinely risky the moment it touches a live production system. Here is the practical sequence that actually prevents downtime.', '<p>Cloud migration is one of those projects that sounds simple in a planning meeting and becomes genuinely risky the moment it touches a live production system serving real users. The gap between the plan and the actual execution is where most of the painful stories come from, unplanned downtime, data that does not transfer cleanly, integrations that quietly break because nobody accounted for a hardcoded server address somewhere. This article covers the practical steps that actually prevent downtime, based on patterns that repeat across real migrations, not the simplified version that fits neatly on a slide.</p><h2>Why Migrations Go Wrong</h2><p>Most failed or painful migrations do not fail because of the cloud platform itself, modern cloud providers are generally reliable and well-documented. They fail because of missing planning, no tested rollback strategy, and an attempt to move everything at once instead of in controlled, verifiable stages. The technical act of moving a server or database is usually the easy part. The planning around it, dependency mapping, sequencing, rollback readiness, is where the actual risk lives, and it is also the part that gets rushed under deadline pressure.</p><h2>A Practical Migration Sequence</h2><ol><li>Audit the current environment fully, every dependency, integration, scheduled job, and data flow, before planning anything else. Skipping this step is the single most common cause of surprise breakage mid-migration.</li><li>Set up the new cloud environment in parallel, without touching the live system yet, so it can be tested and refined without any production risk.</li><li>Migrate non-critical components first to validate the process end-to-end on lower-risk parts of the system before touching anything customer-facing.</li><li>Run both environments in parallel briefly, comparing outputs and behavior to confirm the new setup genuinely behaves identically before cutting over.</li><li>Migrate the critical production workload during a planned, clearly communicated low-traffic window, with the team available and alert.</li><li>Keep the old environment on standby briefly as a rollback option before fully decommissioning it, rather than tearing it down the moment the new one appears to work.</li></ol><h2>Common Pitfalls and How to Avoid Them</h2><table><thead><tr><th>Pitfall</th><th>How to Avoid It</th></tr></thead><tbody><tr><td>No rollback plan</td><td>Keep the old environment live and ready until the new one is fully validated</td></tr><tr><td>Migrating everything at once</td><td>Move in stages, starting with lower-risk components</td></tr><tr><td>Underestimating data transfer time</td><td>Test transfer speed early with realistic data volumes, not a small sample</td></tr><tr><td>No communicated maintenance window</td><td>Notify users in advance even for planned, minimal downtime</td></tr><tr><td>Skipping post-migration monitoring</td><td>Watch performance and error rates closely for at least the first week</td></tr></tbody></table><h2>The Dependency Mapping Step Most Teams Underestimate</h2><p>Systems that have been running in the same environment for years accumulate quiet dependencies that nobody remembers documenting, a scheduled script that assumes a specific file path, a third-party integration whitelisted by a specific server IP address, an internal tool that connects directly to a database rather than through a proper API. These are precisely the things that break silently during a migration, because they were never part of the officially documented architecture in the first place. A thorough audit before migration should include actively searching for these hidden dependencies, checking server logs for unexpected connections, reviewing cron jobs, and interviewing team members who have worked closest to the system about anything that \"just works\" without anyone fully understanding why.</p><h2>Choosing the Right Migration Window</h2><p>Timing the actual cutover matters more than most teams initially assume. A migration attempted during a business\'s peak traffic period multiplies risk unnecessarily, both because more users are affected by any issue and because the team has less margin to investigate problems calmly under pressure. Identifying a genuine low-traffic window, based on real usage data rather than assumption, and communicating it clearly to stakeholders and, where relevant, customers, reduces both the actual risk and the organizational stress of the cutover itself.</p><h2>What Post-Migration Monitoring Should Actually Look Like</h2><p>The days immediately following a migration are not the time to consider the project finished and move attention elsewhere. Performance characteristics, response times, error rates, resource utilization, can behave differently under real production load in a new environment than they did during testing, even after careful validation. Close, active monitoring for at least the first week, with a clear escalation plan if anomalies appear, catches the kind of subtle issues that only surface under genuine production traffic patterns rather than staged test scenarios.</p><h2>The Real Goal</h2><p>A good migration is measured by how boring it is, no drama, no emergency rollback at 2am, no flood of angry support tickets, no scrambling to explain unexpected downtime to stakeholders. That uneventful outcome is not luck, it is the direct result of unglamorous, methodical planning done properly before a single server is actually touched, and it is worth resisting the pressure to skip or compress that planning phase in the name of moving faster.</p><h2>Final Thought</h2><p>The cost of doing a migration properly, in time and planning discipline, is almost always smaller than the cost of recovering from a migration that went wrong in production. Treat the planning phase as the actual project, and the cutover itself as the easy part it should be by the time you get there.</p>', NULL, NULL, NULL, NULL, NULL, 'Cloud Migration Without the Downtime: A Practical Guide | Deovate Blog', 'Cloud migration sounds simple in a pitch deck and becomes genuinely risky the moment it touches a live production system. Here is the practical sequence that actually prevents downtime.', '\"[\\\"cloud migration\\\",\\\"AWS migration\\\",\\\"devops\\\",\\\"zero downtime deployment\\\"]\"', NULL, 'published', '2026-05-26 05:02:29', 0, 1, 4103, 7, 5, 0, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(30, '1166173d-aa87-4bd7-8c2d-e3a54d354d14', 32, 9, 'API Integration Nightmares and How to Avoid Them', 'api-integration-nightmares-and-how-to-avoid-them', 'Almost every team that has scaled past a certain size has at least one API integration horror story. Here is why these problems happen and how properly built integrations avoid them.', '<p>Almost every team that has scaled past a certain size has at least one API integration horror story, a silent failure that went unnoticed for weeks, a data mismatch discovered only after a customer complained, an integration that broke overnight because a third-party provider changed something without meaningful warning. These stories are common enough that they should not be treated as bad luck, they are the predictable result of specific, avoidable mistakes made when the integration was originally built.</p><h2>Why Integrations Break in Ways Nobody Notices Immediately</h2><p>The dangerous failures are rarely the loud, obvious ones. A completely broken integration that stops working entirely gets noticed within hours and fixed quickly, because something visibly stops functioning. The genuinely dangerous failures are partial ones, an integration that keeps running and appears healthy on the surface, but starts silently dropping a small percentage of requests, or subtly corrupting a portion of the data passing through it. These can go unnoticed for weeks or months, quietly accumulating damage, before anyone realizes something is systematically wrong, often only after a downstream report or reconciliation surfaces a discrepancy that has been building the whole time.</p><h2>Common Integration Mistakes</h2><ul><li>No error handling for failed requests, so failures fail silently instead of alerting anyone who could act on them</li><li>No ongoing monitoring on integration health, meaning issues are typically discovered by customers, not by the team responsible</li><li>Hardcoded assumptions about a third-party API\'s response format, which quietly break the moment the provider updates that format</li><li>Overly broad access permissions granted to an integration that genuinely only needs a small, specific slice of data</li><li>No retry logic for temporary failures, treating every transient network blip as a permanent, unrecoverable failure</li></ul><h2>What a Properly Built Integration Includes</h2><table><thead><tr><th>Component</th><th>Why It Matters</th></tr></thead><tbody><tr><td>Error logging and alerting</td><td>Failures are caught immediately, not discovered weeks later by accident</td></tr><tr><td>Retry logic with backoff</td><td>Temporary network issues do not cause permanent data loss</td></tr><tr><td>Scoped authentication</td><td>Limits potential damage if credentials are ever compromised</td></tr><tr><td>Response validation</td><td>Catches unexpected format changes before they corrupt your data</td></tr><tr><td>Regular health monitoring</td><td>Provides ongoing visibility instead of a \"set it and forget it\" approach</td></tr></tbody></table><h2>The Third-Party Risk Nobody Plans For</h2><p>Every integration with an external API is also, implicitly, a dependency on that provider\'s decisions, their uptime, their versioning discipline, their communication when something changes. A provider that deprecates an old API version with only a short notice window can break an integration that has run reliably for years, seemingly without warning, if nobody was actively monitoring that provider\'s changelog or status page. Treating third-party dependencies as a source of ongoing risk, not a one-time integration task completed and forgotten, is the mindset shift that separates integrations that age gracefully from ones that eventually fail in production without warning.</p><h2>Designing for Graceful Degradation</h2><p>A well-designed integration should assume the external service it depends on will eventually fail, slow down, or return unexpected data, and should be built to handle that gracefully rather than assuming perfect, permanent reliability. This might mean caching recent responses so a temporary outage does not immediately break the user-facing feature depending on it, or designing a clear, honest fallback state rather than a cryptic error when a third-party service is unavailable. This kind of defensive design takes marginally more effort upfront and saves substantially more effort during the inevitable moment when a dependency does fail.</p><h2>Documentation That Actually Helps During an Incident</h2><p>When an integration does eventually break, at 11pm on a weekend, as these things tend to happen, the speed of the fix depends heavily on whether clear documentation exists: what the integration does, what it depends on, what a normal response looks like versus an abnormal one, and who to contact if the third-party provider itself is the source of the problem. Integrations built without this kind of documentation turn every incident into an investigation starting from zero, which extends downtime and increases the chance of a rushed, imperfect fix under pressure.</p><h2>The Bigger Lesson</h2><p>An integration is not done the day it starts working in a demo or a staging environment. It is genuinely done when it can fail safely, alert the right people immediately, and recover on its own or with minimal manual intervention, without someone discovering the underlying problem by accident three weeks later through a customer complaint or a reconciliation report.</p><h2>Final Thought</h2><p>The extra time spent building proper error handling, monitoring, and documentation into an integration rarely feels urgent while everything is working. It becomes the single most valuable decision made during that project the first time something on the other end of that connection inevitably changes without warning.</p>', NULL, NULL, NULL, NULL, NULL, 'API Integration Nightmares and How to Avoid Them | Deovate Blog', 'Almost every team that has scaled past a certain size has at least one API integration horror story. Here is why these problems happen and how properly built integrations avoid them.', '\"[\\\"API integration\\\",\\\"REST API\\\",\\\"third party API\\\",\\\"software architecture\\\"]\"', NULL, 'published', '2026-07-01 05:02:29', 0, 1, 3937, 8, 4, 0, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(31, '9edeab61-0478-4ba6-b500-e8778fdd5878', 31, 3, 'WordPress vs Headless CMS: Which One Actually Fits Your Business', 'wordpress-vs-headless-cms-which-one-actually-fits-your-business', 'This comparison comes up constantly, and most explanations get too technical too fast. Here is the direct answer to the business question underneath it.', '<p>This comparison comes up constantly among businesses planning a new website or reconsidering an existing one, and most explanations of it get too technical too quickly, diving into architecture diagrams before actually answering the business question underneath it: which one will make your team\'s life easier and your content genuinely more effective. This article answers that directly, in plain terms, before getting into the technical distinctions that actually matter for the decision.</p><h2>What Each One Actually Is, in Plain Terms</h2><p>WordPress bundles your content and your website\'s visual presentation together in one system, you edit a page and see it live in roughly the same place, all managed within one familiar interface. A headless CMS separates the content entirely from how it gets presented, your content lives in one central hub, and it gets pushed out programmatically to a website, a mobile app, or any other channel that needs it, each with its own independently built front-end presentation layer.</p><h2>When WordPress Is the Right Call</h2><ul><li>You have a single website and no immediate, concrete plans for a mobile app or other separate content channel</li><li>Your team wants a familiar, visual editing experience without needing developer support for every routine content change</li><li>You need access to a large, mature ecosystem of existing plugins for specific functionality without custom development</li></ul><h2>When a Headless CMS Is the Right Call</h2><ul><li>Your content genuinely needs to power more than one channel, a website and a mobile app, for example, from a single source</li><li>Your front-end needs to be built with a specific modern framework for performance, interactivity, or design flexibility reasons</li><li>You are planning meaningful growth into new digital channels over the next few years and want content architecture ready for that</li></ul><h2>Direct Comparison</h2><table><thead><tr><th>Factor</th><th>WordPress</th><th>Headless CMS</th></tr></thead><tbody><tr><td>Ease of Use for Non-Technical Teams</td><td>High</td><td>Moderate, depends on setup</td></tr><tr><td>Multi-Channel Content Delivery</td><td>Limited</td><td>Built for this</td></tr><tr><td>Front-End Design Flexibility</td><td>Good, within theme limits</td><td>Very high, fully custom</td></tr><tr><td>Setup Complexity</td><td>Low</td><td>Higher, requires more initial development</td></tr><tr><td>Best For</td><td>Single website, content-heavy sites</td><td>Multi-channel products, custom front-ends</td></tr></tbody></table><h2>The Misconception That Headless Is Simply \"Better\"</h2><p>A common misconception in technical circles is that headless architecture is a strict upgrade over traditional WordPress, more modern, more flexible, therefore inherently the smarter choice. This framing ignores the actual tradeoffs involved. Headless setups typically require more upfront development investment, a separate front-end build, custom integration between the content layer and the presentation layer, and often a steeper learning curve for content editors used to a more visual, WYSIWYG-style editing experience. For a business running a single, fairly standard website, that additional complexity buys real-world benefits it may never actually use.</p><h2>What Content Teams Actually Feel Day to Day</h2><p>The architectural decision matters less to most stakeholders than how it feels to actually use the system daily. WordPress content editors generally get a visual, page-builder-like experience close to what the published page will look like. Headless CMS editors typically work in a more structured, form-based interface, entering content into defined fields without seeing an exact visual preview unless the team has specifically built one. Neither is objectively better, but the mismatch between what a content team expects and what a chosen system actually delivers is a common, avoidable source of frustration after launch, so this is worth testing with actual content editors before committing to either path, not deciding purely on developer preference.</p><h2>A Middle Ground Worth Knowing About</h2><p>Some modern WordPress setups can function in a semi-headless way, using WordPress as the familiar content editing backend while a separate, faster front-end consumes that content through an API. This can offer a practical middle ground for teams who want the familiar editing experience their content team already knows, combined with more front-end flexibility than a traditional theme-based WordPress site typically allows. It is not the right fit for every situation, but it is worth knowing this option exists rather than assuming the choice is strictly binary.</p><h2>The Honest Recommendation</h2><p>If you are running a single, fairly standard website without concrete near-term plans for additional content channels, WordPress remains a genuinely strong, well-supported choice, not a compromise or a dated fallback. Reach for a headless CMS specifically when your content ambitions have genuinely outgrown a single channel, or when your design and performance requirements demand front-end flexibility a traditional theme cannot provide, not simply because headless sounds more modern in a conversation.</p><h2>Final Thought</h2><p>The right CMS choice should be driven by your actual content strategy over the next few years, not by which architecture happens to be trending in developer discussions. Start from your real distribution needs, and the right platform usually becomes obvious.</p>', NULL, NULL, NULL, NULL, NULL, 'WordPress vs Headless CMS: Which One Actually Fits Your Business | Deovate Blog', 'This comparison comes up constantly, and most explanations get too technical too fast. Here is the direct answer to the business question underneath it.', '\"[\\\"wordpress vs headless cms\\\",\\\"headless cms\\\",\\\"content management system\\\",\\\"CMS comparison\\\"]\"', NULL, 'published', '2026-06-22 05:02:29', 0, 1, 3157, 9, 4, 0, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(32, 'ba1f73f1-f464-4dfe-a570-be2ecb8598e3', 32, 12, 'Why Skipping QA Testing Costs More Than It Saves', 'why-skipping-qa-testing-costs-more-than-it-saves', 'Skipping or shortcutting QA is one of the most common cost-cutting decisions teams make under deadline pressure, and also one of the most expensive in hindsight.', '<p>Skipping or shortcutting QA is one of the most common cost-cutting decisions teams make under deadline pressure, and it is also, consistently, one of the most expensive decisions in hindsight. It rarely feels expensive in the moment, the release ships on time, the immediate pressure eases, and the actual cost only becomes visible later, scattered across support tickets, emergency patches, and a slowly eroding sense of customer trust that is much harder to measure than a missed deadline.</p><h2>The Hidden Math of Skipped Testing</h2><p>A bug caught during development, by a developer testing their own change or by a dedicated QA pass before release, might take an hour or two to fix. The same bug, if it slips through and is caught only after release, once it has actually affected real customers and generated support tickets, requires an emergency patch deployed under pressure, and can easily cost several times that in engineering time alone, before even counting the cost of the customer trust damaged along the way, or the developer time diverted away from planned work to deal with the fire.</p><h2>Where the Real Cost Shows Up</h2><ol><li>Emergency hotfixes deployed under pressure, which carry meaningfully higher risk of introducing a second, unrelated bug in the rush</li><li>Customer support volume spikes from multiple users independently hitting the same underlying issue</li><li>Lost trust from customers who experienced the bug directly, some of whom simply leave quietly without ever filing a complaint</li><li>Developer time pulled away from planned, valuable work to fight fires that better testing would have prevented</li><li>Reputational cost from public reviews or social media mentions of a visibly broken feature</li></ol><h2>Cost Comparison: Caught Early vs Caught Late</h2><table><thead><tr><th>Stage Bug Is Caught</th><th>Typical Cost to Fix</th><th>Additional Risk</th></tr></thead><tbody><tr><td>During development (manual/automated testing)</td><td>Low, usually under an hour</td><td>Minimal</td></tr><tr><td>During QA before release</td><td>Low to moderate</td><td>Minimal, contained to the release cycle</td></tr><tr><td>After release, caught by monitoring</td><td>Moderate to high</td><td>Support load, urgent patch risk</td></tr><tr><td>After release, caught by customer complaints</td><td>High</td><td>Trust damage, possible churn, PR risk</td></tr></tbody></table><h2>Why \"We\'ll Test It in Production\" Is a Trap</h2><p>Under enough deadline pressure, teams sometimes rationalize skipping thorough QA with the implicit plan of \"we\'ll catch issues once real users start using it.\" This approach quietly shifts the cost of testing onto customers, who did not sign up to be unpaid QA testers and who form their impression of product quality based on exactly this kind of experience. Even when the team does respond quickly to issues found this way, the customer\'s memory of the bug tends to outlast the memory of how quickly it was fixed, and repeated instances of this pattern compound into a broader perception that the product is unreliable, a perception that is disproportionately difficult to undo once established.</p><h2>Regression Testing: The Quiet Multiplier of QA Value</h2><p>A single round of testing before a first release catches obvious problems, but the compounding value of QA becomes most visible over time, through regression testing, verifying that new changes have not quietly broken something that was already working correctly. Products with frequent releases and no regression testing discipline tend to accumulate an invisible backlog of small breakages, features that technically stopped working weeks ago but that nobody has noticed yet because nobody was specifically checking. Regular regression testing is what prevents a fast release cadence from slowly eroding overall product reliability without anyone realizing it is happening.</p><h2>What \"Enough\" QA Actually Looks Like</h2><p>The goal is not exhaustive testing of every possible scenario before every release, that standard is rarely practical and often not worth the time investment relative to the risk involved. The goal is proportional testing, thorough coverage of critical paths, payment, authentication, core workflows, combined with lighter, faster checks on lower-risk areas, and automated regression coverage on anything that has broken before or that the business genuinely cannot afford to have fail. Calibrating this proportionally, rather than either skipping QA entirely or over-testing everything uniformly, is what makes a sustainable QA process, one a team can actually maintain release after release without it becoming a bottleneck.</p><h2>The Actual Argument for QA</h2><p>QA is not a cost center slowing down releases, despite how it often gets framed under deadline pressure, it is what makes fast releases survivable in the first place. A structured testing process lets a team move quickly with genuine confidence, because the safety net catching mistakes is built directly into the process, rather than the alternative, where your customers become the safety net, finding problems for you after the fact and quietly deciding how much of that experience they are willing to tolerate before looking elsewhere.</p><h2>Final Thought</h2><p>Every shortcut taken on QA is a bet that nothing important will break, placed by the team least equipped to absorb the consequences if it does not pay off. The businesses that treat QA as a genuine investment, not an optional final step, are consistently the ones able to move fast without that speed quietly costing them trust they worked hard to build.</p>', NULL, NULL, NULL, NULL, NULL, 'Why Skipping QA Testing Costs More Than It Saves | Deovate Blog', 'Skipping or shortcutting QA is one of the most common cost-cutting decisions teams make under deadline pressure, and also one of the most expensive in hindsight.', '\"[\\\"software QA testing\\\",\\\"quality assurance\\\",\\\"bug cost\\\",\\\"regression testing\\\"]\"', NULL, 'published', '2026-07-14 05:02:29', 1, 1, 1451, 10, 5, 0, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(33, '9369aae9-b1d3-433e-a4c1-2999ef51e14b', 36, 13, 'The Mobile App Testing Checklist Most Teams Skip Half Of', 'the-mobile-app-testing-checklist-most-teams-skip-half-of', 'Most mobile app testing happens on one phone, the developer\'s own device, on office wifi. Here is what a genuinely thorough testing checklist actually covers.', '<p>Most mobile app testing quietly happens on one phone, the developer\'s own device, on a fast, stable office wifi connection, which is precisely the environment least representative of how most real users will actually experience the app. This gap between how apps get tested and how they get used is where a large share of one-star reviews originate, not from fundamentally broken features, but from an app that was only ever validated under ideal, unrepresentative conditions.</p><h2>Why Device Diversity Actually Matters</h2><p>Android alone spans an enormous range of manufacturers, screen sizes, operating system versions, and hardware capabilities, and a feature that behaves perfectly on a recent flagship device can behave noticeably differently on a mid-range or older phone still actively used by a meaningful share of any real user base. iOS has less device fragmentation but still spans several actively used OS versions and screen sizes, each of which can surface layout or performance issues invisible on the newest device with the newest OS installed.</p><h2>The Checklist Categories Most Teams Under-Test</h2><ol><li><strong>Network conditions.</strong> Testing exclusively on fast wifi hides how the app behaves on slow mobile data, intermittent connectivity, or a connection that drops mid-request, which is a common real-world scenario for mobile users.</li><li><strong>Interruptions.</strong> Incoming calls, notifications, low battery warnings, and app-switching mid-task all need to be tested, since these interruptions happen constantly in real usage and can leave an app in an unexpected state.</li><li><strong>Permissions handling.</strong> What happens when a user denies camera, location, or notification permissions, does the app degrade gracefully or does it break in a confusing way.</li><li><strong>Background and resume behavior.</strong> Does the app correctly restore its state when a user switches away and back, or does it lose progress and force them to start over.</li><li><strong>Storage and memory constraints.</strong> Older or budget devices with limited storage and memory can behave very differently under load than a well-resourced test device.</li><li><strong>App store update behavior.</strong> Testing the actual upgrade path from an older installed version, not just fresh installs, since existing users experience updates, not clean installs.</li></ol><h2>Device and Scenario Coverage Table</h2><table><thead><tr><th>Test Category</th><th>Commonly Skipped Because</th><th>Real-World Risk</th></tr></thead><tbody><tr><td>Low-end device performance</td><td>Team only owns newer devices</td><td>Slow or crashing app for a real user segment</td></tr><tr><td>Poor network conditions</td><td>Office wifi is always fast</td><td>Failed requests with no graceful handling</td></tr><tr><td>Interrupted sessions</td><td>Rarely happens during a quick test</td><td>Lost user progress, frustrated re-entry</td></tr><tr><td>Permission denial flows</td><td>Testers usually accept all permissions</td><td>Confusing dead ends for privacy-conscious users</td></tr><tr><td>Update path from old version</td><td>Testing usually uses fresh installs</td><td>Broken experience for existing user base</td></tr></tbody></table><h2>Why Real Device Labs Matter More Than Simulators</h2><p>Simulators and emulators are genuinely useful for fast iteration during development, but they do not perfectly replicate real hardware behavior, particularly around performance under load, camera and sensor behavior, and how the operating system manages memory and background processes on an actual device. A thorough pre-release testing pass should include a spread of real physical devices, spanning different manufacturers, OS versions, and price tiers, not exclusively simulator-based testing, since the gap between simulated and real-device behavior is exactly where certain classes of bugs hide.</p><h2>App Store Review Signals Worth Reading Carefully</h2><p>Once an app is live, one-star reviews mentioning crashes, slowness, or specific broken features are a direct, if unpleasant, source of real-world QA data that no internal testing process fully replaces. Reading these reviews carefully, looking for patterns around specific device models, OS versions, or usage scenarios mentioned repeatedly, often reveals exactly the blind spots that internal testing missed, and should feed directly back into the testing checklist for future releases rather than being treated purely as reputation management.</p><h2>Building This Into an Ongoing Process</h2><p>None of this needs to happen manually and exhaustively for every single release. Automated testing frameworks can run core scenarios across a matrix of device and OS combinations without requiring a human tester to manually work through each one every time, reserving manual exploratory testing for new features and genuinely novel scenarios. The goal is building a testing process proportional to actual risk and real device usage data, not testing every possible combination exhaustively forever, which quickly becomes impractical and gets abandoned under time pressure.</p><h2>Final Thought</h2><p>An app that only gets tested on the newest flagship device with perfect connectivity is being validated against a version of reality most of its actual users do not live in. Closing that gap, deliberately testing under realistic, imperfect conditions, is one of the highest-leverage investments a mobile team can make in overall app store rating and long-term user retention.</p>', NULL, NULL, NULL, NULL, NULL, 'The Mobile App Testing Checklist Most Teams Skip Half Of | Deovate Blog', 'Most mobile app testing happens on one phone, the developer\'s own device, on office wifi. Here is what a genuinely thorough testing checklist actually covers.', '\"[\\\"mobile app testing\\\",\\\"android ios testing\\\",\\\"app QA checklist\\\",\\\"device compatibility\\\"]\"', NULL, 'published', '2026-06-08 05:02:29', 0, 1, 2812, 11, 4, 0, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(34, '4169dc07-7ca7-4574-98fe-522ea75094b4', 32, 1, 'ERP vs CRM: What Growing Businesses Actually Need First', 'erp-vs-crm-what-growing-businesses-actually-need-first', 'These two systems get confused constantly, and businesses often invest in the wrong one first. Here is a clear breakdown of what each actually solves.', '<p>These two systems get confused constantly, sometimes treated as interchangeable, sometimes treated as a package deal a business needs simultaneously, when in reality they solve genuinely different problems and most growing businesses have a clearer need for one before the other. Understanding that difference prevents a common, expensive mistake: investing significant budget and change-management effort into the wrong system first, based on a vague sense that \"we need better software\" rather than a specific understanding of which operational pain the business is actually feeling most acutely.</p><h2>What Each System Actually Solves</h2><p>A CRM, customer relationship management system, is built around managing the relationship and communication history with prospects and customers, tracking leads through a sales pipeline, logging interactions, and helping a sales or support team stay organized around people. An ERP, enterprise resource planning system, is built around managing the internal operations of the business itself, inventory, finance, procurement, sometimes manufacturing or logistics, connecting departments that would otherwise operate on disconnected spreadsheets and manual processes.</p><h2>Signs You Need a CRM First</h2><ul><li>Your sales team is tracking leads and deals in spreadsheets or scattered notes, with no shared visibility into pipeline status</li><li>Follow-ups are getting missed or delayed because there is no system prompting timely outreach</li><li>You cannot easily answer basic questions like how many active deals exist or what stage each one is in without manually checking with individual salespeople</li></ul><h2>Signs You Need an ERP First</h2><ul><li>Inventory counts are frequently wrong because they live in a spreadsheet disconnected from actual sales and purchasing activity</li><li>Financial reporting requires manually reconciling data from multiple disconnected systems every month</li><li>Different departments are working from different, sometimes contradictory, versions of the same operational data</li></ul><h2>Side-by-Side Comparison</h2><table><thead><tr><th>Aspect</th><th>CRM</th><th>ERP</th></tr></thead><tbody><tr><td>Primary Focus</td><td>Customer relationships and sales pipeline</td><td>Internal operations and resource management</td></tr><tr><td>Typical Primary Users</td><td>Sales and customer support teams</td><td>Finance, operations, and inventory teams</td></tr><tr><td>Core Problem Solved</td><td>Disorganized, inconsistent customer follow-up</td><td>Disconnected operational and financial data</td></tr><tr><td>Common First Sign of Need</td><td>Missed follow-ups, unclear pipeline visibility</td><td>Inventory discrepancies, manual reconciliation</td></tr></tbody></table><h2>Why Businesses Often Choose the Wrong One First</h2><p>The decision often gets driven by whichever department is loudest about their frustration at the moment, rather than a genuinely objective assessment of where the business is losing the most time or money. A vocal sales team frustrated with a messy pipeline can push a CRM purchase through even when the actual larger operational drag is happening quietly in inventory management, simply because sales frustration is more visible day to day than a finance team\'s monthly reconciliation headache. Taking a step back and mapping where manual, error-prone processes are actually costing the most time across the whole business, not just the loudest department, usually clarifies the real priority.</p><h2>Can You Actually Need Both at Once?</h2><p>Yes, and many established businesses eventually run both systems, often connected through an integration so customer and sales data can inform operational planning, and operational data like stock availability can inform what sales teams promise to customers. But implementing both simultaneously from scratch is a significant undertaking, both in cost and in the organizational change management required to get an entire team adopting new systems and workflows at once. Sequencing the implementation, solving the more urgent problem first, validating the new system genuinely works and is adopted well, then adding the second system, is generally a lower-risk path than attempting both simultaneously.</p><h2>The Integration Question Worth Asking Early</h2><p>If you already know both systems will eventually be needed, it is worth choosing the first system with an eye toward how well it can integrate with a future second system, rather than choosing purely based on the immediate need in isolation. A CRM and ERP that can share data cleanly, customer order history informing support conversations, inventory data informing sales promises, is significantly more valuable together than the same two systems operating as disconnected silos that happen to sit inside the same business.</p><h2>Final Thought</h2><p>The right first system is the one that solves your business\'s most expensive current problem, measured honestly in lost time, lost accuracy, or lost deals, not the one that happens to be trending in business software conversations or the one the loudest internal voice is currently advocating for.</p>', NULL, NULL, NULL, NULL, NULL, 'ERP vs CRM: What Growing Businesses Actually Need First | Deovate Blog', 'These two systems get confused constantly, and businesses often invest in the wrong one first. Here is a clear breakdown of what each actually solves.', '\"[\\\"ERP vs CRM\\\",\\\"business software\\\",\\\"enterprise resource planning\\\",\\\"customer relationship management\\\"]\"', NULL, 'published', '2026-07-16 05:02:29', 0, 1, 3683, 12, 4, 0, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(35, 'e77d6a1b-a352-4d11-9492-48cd7aab1da1', 37, 16, 'Enterprise Software Scaling Challenges Nobody Warns You About', 'enterprise-software-scaling-challenges-nobody-warns-you-about', 'Software that worked perfectly at ten users can behave completely differently at ten thousand. Here are the scaling challenges that tend to surprise growing teams the most.', '<p>Software that worked perfectly at ten users, then a hundred, can behave in genuinely surprising and difficult ways once it reaches a thousand or ten thousand, and the nature of that difficulty is rarely what teams expect going in. Most conversations about scaling focus on server capacity, more computing power to handle more load, but the challenges that actually cause the most disruption tend to be structural and organizational, not simply a matter of adding more hardware.</p><h2>Why Scaling Problems Surprise Teams</h2><p>Early-stage software decisions are made under time pressure, prioritizing shipping something that works now over architecture that will hold up at ten times the current scale, and this is usually the correct tradeoff at that stage. The problem is that these early decisions become deeply embedded in how the system works, and by the time scale genuinely demands revisiting them, unwinding them safely without disrupting a system already serving real, paying customers becomes a significantly harder problem than it would have been to design correctly from the start.</p><h2>Five Scaling Challenges That Catch Teams Off Guard</h2><ol><li><strong>Database queries that were fast at small scale become slow at large scale.</strong> A query that returns instantly against a thousand rows can take seconds against ten million, and this often only becomes visible once the damage to user experience is already happening in production.</li><li><strong>Background jobs designed for occasional use start competing for resources.</strong> A report generation job that ran fine once a day for a handful of users can start meaningfully impacting system performance when hundreds of users trigger it simultaneously.</li><li><strong>Onboarding new engineers gets slower as the codebase grows without clear structure.</strong> Early speed-focused development often skips the documentation and clean separation of concerns that make a growing team able to work efficiently without stepping on each other.</li><li><strong>Feature flags and configuration options accumulate into genuine complexity debt.</strong> Every \"just add a setting for this\" decision made early adds up, and the resulting configuration sprawl becomes its own source of bugs and confusion at scale.</li><li><strong>Support and operations processes that worked manually at small scale become genuine bottlenecks.</strong> A manual process for handling a specific edge case is fine at ten occurrences a month, and becomes untenable at ten occurrences an hour.</li></ol><h2>Symptom vs Underlying Cause</h2><table><thead><tr><th>Visible Symptom</th><th>Common Underlying Cause</th></tr></thead><tbody><tr><td>Pages loading noticeably slower over time</td><td>Unoptimized database queries not designed for current data volume</td></tr><tr><td>New features taking longer to build</td><td>Accumulated complexity debt in the existing codebase</td></tr><tr><td>Occasional unexplained outages under load</td><td>Background processes competing for shared resources</td></tr><tr><td>Support team increasingly overwhelmed</td><td>Manual processes that were never designed to scale</td></tr><tr><td>New engineers taking longer to onboard</td><td>Lack of documentation and structural clarity in a growing codebase</td></tr></tbody></table><h2>The Case for Addressing This Proactively, Not Reactively</h2><p>The natural tendency is to address scaling challenges reactively, waiting until a specific query is visibly causing slowness, or a specific manual process visibly breaks under increased volume, before investing time in fixing it. This reactive approach works, up to a point, but it means the business is essentially operating with a permanent low-grade risk of user-facing incidents, discovered by users experiencing the problem rather than by the team anticipating it. Building in regular architecture and process review cycles, explicitly asking \"what here will not hold up at ten times our current scale,\" before it becomes an active incident, is a meaningfully more stable way to grow.</p><h2>Technical Debt Is Not Always Bad Debt</h2><p>It is worth being precise here: not every early shortcut is a mistake that needs urgent correction. Some technical debt is genuinely fine, a decision made deliberately to move faster at a stage where the alternative, more scalable approach would have cost significant time the business did not have and may never have needed if the product had not found traction. The problem is not technical debt existing, every growing system has some. The problem is technical debt existing without anyone tracking it, so that when it does become relevant at scale, nobody remembers it is there until it causes a visible failure.</p><h2>Building a Culture That Catches This Early</h2><p>Teams that navigate scaling well tend to share a habit: they maintain some form of ongoing, lightweight tracking of known scaling risks, even ones not yet urgent, reviewed periodically rather than only discovered under crisis conditions. This does not require a heavy formal process, often a simple, honestly maintained list reviewed quarterly is enough to turn scaling challenges from unpleasant surprises into planned, manageable work scheduled before they become urgent.</p><h2>Final Thought</h2><p>Scaling challenges are not a sign that something was built wrong at the start, they are a natural and expected consequence of a system succeeding and growing beyond its original design assumptions. The businesses that handle this well are not the ones that avoided every early shortcut, they are the ones that stayed aware of which shortcuts existed and addressed them deliberately before growth forced the issue.</p>', NULL, NULL, NULL, NULL, NULL, 'Enterprise Software Scaling Challenges Nobody Warns You About | Deovate Blog', 'Software that worked perfectly at ten users can behave completely differently at ten thousand. Here are the scaling challenges that tend to surprise growing teams the most.', '\"[\\\"enterprise software scaling\\\",\\\"SaaS architecture\\\",\\\"system scalability\\\",\\\"technical debt\\\"]\"', NULL, 'published', '2026-07-04 05:02:30', 0, 1, 916, 13, 5, 0, '2026-07-21 05:02:30', '2026-07-21 05:02:30', NULL);
INSERT INTO `blogs` (`id`, `uuid`, `category_id`, `author_id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `featured_image_alt`, `og_image`, `og_image_alt`, `gallery`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `status`, `published_at`, `is_featured`, `is_active`, `views`, `display_order`, `reading_time`, `comment_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(36, '26f9accc-49f6-4416-b500-b0754846c9ca', 34, 17, 'Landing Page Copywriting That Actually Converts', 'landing-page-copywriting-that-actually-converts', 'Most landing page copy is written to sound impressive rather than to actually move a specific visitor toward a specific decision. Here is what genuinely converts, and why.', '<p>Most landing page copy is written to sound impressive, polished, and professional, rather than to actually move a specific visitor, arriving with a specific need, toward a specific decision. These are not the same goal, and optimizing for the wrong one is one of the most common, quietly expensive mistakes in digital marketing. A landing page can read beautifully and still convert poorly, because sounding good and being persuasive are related but genuinely different skills.</p><h2>The Core Principle Most Copy Ignores</h2><p>Effective landing page copy starts from the visitor\'s actual situation, not the company\'s internal perspective. A visitor arriving on a landing page usually has a specific problem, question, or need that brought them there, often from a specific ad or search term. Copy that immediately acknowledges that specific need, in language the visitor would actually use themselves, builds far more trust and momentum than copy that opens with a generic statement about the company\'s mission or history, which the visitor has no context for and, frankly, did not come looking for.</p><h2>Six Elements Every High-Converting Landing Page Gets Right</h2><ol><li><strong>A headline that speaks directly to the visitor\'s situation,</strong> not a clever tagline that requires context the visitor does not yet have.</li><li><strong>A subheadline that clarifies the specific outcome or benefit,</strong> answering the unspoken \"so what does this actually do for me\" question immediately.</li><li><strong>Specific, concrete claims rather than vague superlatives.</strong> \"Reduces checkout abandonment by identifying the exact friction point losing sales\" is more persuasive than \"the best solution for your business.\"</li><li><strong>Social proof placed near the moment of decision,</strong> not buried at the bottom of the page after the visitor has already decided to leave.</li><li><strong>One single, obvious call to action</strong> repeated consistently, rather than multiple competing options that force the visitor to choose between actions instead of just taking the one that matters.</li><li><strong>Copy that addresses the likely hesitation directly,</strong> rather than ignoring it and hoping the visitor does not think of it themselves.</li></ol><h2>Weak vs Strong Copy, Side by Side</h2><table><thead><tr><th>Weak Version</th><th>Stronger Version</th></tr></thead><tbody><tr><td>\"Welcome to our innovative platform\"</td><td>\"Stop losing sales to a checkout process that is quietly costing you customers\"</td></tr><tr><td>\"We are passionate about quality\"</td><td>\"Every project includes a documented QA process before it ships\"</td></tr><tr><td>\"Learn More\"</td><td>\"See How This Works For Your Business\"</td></tr><tr><td>\"Industry-leading solutions\"</td><td>\"Used by 200+ businesses to cut checkout abandonment by an average of 18%\"</td></tr></tbody></table><h2>Why Specificity Consistently Outperforms Polish</h2><p>Vague, polished language feels safe to write because it is difficult to be wrong about, \"industry-leading\" and \"innovative\" are claims nobody can really challenge, but they are also claims nobody genuinely believes, because every competitor makes the exact same claim in the exact same words. Specific claims, a real number, a real mechanism, a real named outcome, carry more persuasive weight precisely because they are falsifiable and therefore feel more credible, even though writing them requires more actual thought and, often, more honesty about what the product genuinely does well.</p><h2>Addressing Hesitation Instead of Hoping It Does Not Surface</h2><p>Every visitor arrives with some level of skepticism or hesitation, is this actually going to work for my specific situation, is this company legitimate, is the price justified. Copy that pretends this hesitation does not exist, focusing only on positive claims, leaves that doubt fully intact in the visitor\'s mind, unaddressed and free to grow as they consider leaving. Copy that names the likely hesitation directly, and then addresses it honestly, often converts better than copy that simply avoids the topic, because it demonstrates the business actually understands the visitor\'s situation rather than reciting a generic pitch.</p><h2>The Discipline of Testing Instead of Guessing</h2><p>Even genuinely skilled copywriters cannot reliably predict which specific headline or call-to-action phrasing will convert best for a particular audience without testing, because conversion behavior depends on factors, audience psychology, competitive context, specific traffic source, that are difficult to fully anticipate from a desk. Treating landing page copy as a hypothesis to be tested, rather than a finished, permanent artifact, is what separates pages that steadily improve over time from pages that were written once, based on best guesses, and never revisited regardless of how they actually perform.</p><h2>Final Thought</h2><p>The goal of landing page copy is never to sound impressive in isolation, it is to move a specific visitor, with a specific need, toward a specific decision, as clearly and honestly as possible. Every sentence on the page should be evaluated against that single standard, not against how polished or clever it sounds when read out of context.</p>', NULL, NULL, NULL, NULL, NULL, 'Landing Page Copywriting That Actually Converts | Deovate Blog', 'Most landing page copy is written to sound impressive rather than to actually move a specific visitor toward a specific decision. Here is what genuinely converts, and why.', '\"[\\\"landing page copywriting\\\",\\\"conversion copywriting\\\",\\\"headline writing\\\",\\\"CTA optimization\\\"]\"', NULL, 'published', '2026-05-25 05:02:30', 0, 1, 935, 14, 4, 0, '2026-07-21 05:02:30', '2026-07-21 05:02:30', NULL),
(37, 'df56eece-b6c3-47c8-ae24-b0fee886fbcf', 34, 2, 'Local SEO for Service Businesses: The Complete Practical Guide', 'local-seo-for-service-businesses-the-complete-practical-guide', 'For businesses that serve a specific area, showing up in local search results often matters more than ranking nationally. Here is a complete, practical breakdown of what actually moves the needle.', '<p>For businesses that serve a specific city, region, or service area, plumbers, clinics, consultants, local agencies, showing up prominently in local search results and map listings often matters far more than ranking nationally for broad, competitive keywords a local customer would never realistically use. Local SEO is a genuinely different discipline from general SEO, with its own specific factors, and businesses that treat it as an afterthought within a general SEO strategy usually leave significant, easily captured visibility on the table.</p><h2>Why Local Search Behaves Differently</h2><p>When someone searches for a service \"near me\" or includes a city name in their query, search engines prioritize a different set of signals than they would for a purely informational query, proximity, verified business information consistency, and genuine local relevance all carry disproportionate weight. A business can rank well nationally for general industry terms and still be nearly invisible for the local searches that actually drive real customers through the door, because these are functionally separate ranking systems responding to different signals.</p><h2>The Foundational Local SEO Checklist</h2><ol><li><strong>Claim and fully complete your Google Business Profile,</strong> with accurate categories, hours, photos, and a complete business description, not just the minimum required fields.</li><li><strong>Ensure your business name, address, and phone number are identical everywhere they appear online,</strong> directories, your website, social profiles, since inconsistency actively undermines trust signals to search engines.</li><li><strong>Collect genuine customer reviews consistently,</strong> both because review volume and recency are a ranking factor and because reviews directly influence a hesitant customer\'s decision.</li><li><strong>Build location-specific content on your website</strong> that genuinely addresses your service area, not just a generic \"areas we serve\" list with no real substance behind it.</li><li><strong>Get listed accurately in relevant local directories and industry-specific listing sites,</strong> which reinforce the legitimacy and consistency of your business information.</li></ol><h2>Local SEO Factors and Their Practical Impact</h2><table><thead><tr><th>Factor</th><th>Why It Matters</th><th>Common Mistake</th></tr></thead><tbody><tr><td>Google Business Profile completeness</td><td>Directly influences local map pack visibility</td><td>Leaving fields incomplete or outdated</td></tr><tr><td>NAP consistency (Name, Address, Phone)</td><td>Builds trust and confirms legitimacy to search engines</td><td>Different phone numbers or address formats across listings</td></tr><tr><td>Review quantity and recency</td><td>Signals ongoing legitimacy and customer satisfaction</td><td>A handful of old reviews with no recent activity</td></tr><tr><td>Location-specific website content</td><td>Demonstrates genuine relevance to local searches</td><td>A single generic paragraph mentioning multiple cities</td></tr><tr><td>Local backlinks and citations</td><td>Reinforces local authority and relevance</td><td>Relying only on national, generic backlinks</td></tr></tbody></table><h2>Why Generic \"Areas We Serve\" Pages Rarely Work</h2><p>A common local SEO mistake is creating a single page listing dozens of cities or neighborhoods a business claims to serve, with no genuine, distinct content about each one, purely to try to rank for many local search terms at once. Search engines have gotten increasingly good at recognizing this pattern as low-value, and it rarely performs as well as businesses hope. Genuinely useful local content, real detail about how the service applies specifically in that area, relevant local context, sometimes even location-specific case studies or testimonials, performs meaningfully better, both because it ranks better and because it is actually more persuasive to a real visitor from that area.</p><h2>Reviews as an Active Strategy, Not a Passive Hope</h2><p>Many businesses treat reviews passively, hoping satisfied customers will think to leave one unprompted, which results in a slow, inconsistent trickle at best. Businesses that treat review generation as an active, systematic part of their customer process, a simple, well-timed request sent after a positive interaction, consistently build a stronger, more recent review profile, which directly benefits both local search visibility and the conversion rate of visitors who do find the listing and check reviews before deciding to contact the business.</p><h2>The Compounding Nature of Local SEO</h2><p>Local SEO, like SEO generally, rewards consistency over sporadic effort. A business that steadily maintains its listing accuracy, consistently collects reviews, and periodically adds genuine local content builds a compounding advantage over competitors who set up their listing once and never revisit it. This makes local SEO one of the more durable, defensible marketing investments available to a service business, since the effort invested keeps paying off long after the specific task, claiming a listing, writing a page, was completed.</p><h2>Final Thought</h2><p>For a business that genuinely depends on local customers, local SEO is not a supplementary tactic to general SEO, it is frequently the single highest-leverage marketing channel available, because it captures customers at the exact moment they are actively looking for exactly what the business offers, in exactly the area it serves.</p>', NULL, NULL, NULL, NULL, NULL, 'Local SEO for Service Businesses: The Complete Practical Guide | Deovate Blog', 'For businesses that serve a specific area, showing up in local search results often matters more than ranking nationally. Here is a complete, practical breakdown of what actually moves the needle.', '\"[\\\"local SEO\\\",\\\"google business profile\\\",\\\"local search ranking\\\",\\\"service business marketing\\\"]\"', NULL, 'published', '2026-06-24 05:02:30', 0, 1, 2469, 15, 4, 0, '2026-07-21 05:02:30', '2026-07-21 05:02:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `uuid`, `name`, `slug`, `icon`, `image`, `image_alt`, `description`, `meta_title`, `meta_description`, `is_active`, `display_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(31, '37243892-cae7-4120-8447-e06edb066b8b', 'Web Development', 'web-development', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-07-21 05:02:28', '2026-07-21 05:02:28', NULL),
(32, '45f26569-d62d-4ffb-bdb1-10e6e8b80212', 'Software Development', 'software-development', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(33, 'b0e791e1-da3d-405f-9b78-0337ca9eaa97', 'Business & Startups', 'business-startups', NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(34, 'af9c44bd-a8b6-4670-b4f9-b27ec5b4852f', 'Digital Marketing', 'digital-marketing', NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(35, '3711cf2c-7d86-421a-90c6-183a796f89c3', 'Cloud Computing', 'cloud-computing', NULL, NULL, NULL, NULL, NULL, NULL, 1, 5, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(36, 'cf6a1d93-07b4-443d-86e5-4e0b80ef8211', 'Mobile App Development', 'mobile-app-development', NULL, NULL, NULL, NULL, NULL, NULL, 1, 6, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL),
(37, '708e75f3-c90a-4466-9627-a6af5586fd38', 'SaaS & Cloud', 'saas-cloud', NULL, NULL, NULL, NULL, NULL, NULL, 1, 7, '2026-07-21 05:02:29', '2026-07-21 05:02:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`, `deleted_at`) VALUES
('laravel-cache-active_blogs_for_comments', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:17:{i:0;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:19;s:5:\"title\";s:46:\"AI in Healthcare: Opportunities and Challenges\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:19;s:5:\"title\";s:46:\"AI in Healthcare: Opportunities and Challenges\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:4;s:5:\"title\";s:48:\"Artificial Intelligence in Everyday Applications\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:4;s:5:\"title\";s:48:\"Artificial Intelligence in Everyday Applications\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:2;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:17;s:5:\"title\";s:50:\"Best Cyber Security Practices for Small Businesses\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:17;s:5:\"title\";s:50:\"Best Cyber Security Practices for Small Businesses\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:3;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:2;s:5:\"title\";s:48:\"Best Practices for Scalable Software Development\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:2;s:5:\"title\";s:48:\"Best Practices for Scalable Software Development\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:4;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:14;s:5:\"title\";s:51:\"Cloud Migration Challenges and How to Overcome Them\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:14;s:5:\"title\";s:51:\"Cloud Migration Challenges and How to Overcome Them\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:5;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:9;s:5:\"title\";s:44:\"Cyber Security Threats Businesses Must Watch\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:9;s:5:\"title\";s:44:\"Cyber Security Threats Businesses Must Watch\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:6;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:10;s:5:\"title\";s:37:\"Digital Transformation Trends in 2025\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:10;s:5:\"title\";s:37:\"Digital Transformation Trends in 2025\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:7;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:18;s:5:\"title\";s:45:\"Healthcare Software Trends Shaping the Future\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:18;s:5:\"title\";s:45:\"Healthcare Software Trends Shaping the Future\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:8;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:8;s:5:\"title\";s:40:\"How Startups Can Scale Using SaaS Models\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:8;s:5:\"title\";s:40:\"How Startups Can Scale Using SaaS Models\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:9;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:13;s:5:\"title\";s:44:\"Machine Learning Use Cases Across Industries\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:13;s:5:\"title\";s:44:\"Machine Learning Use Cases Across Industries\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:10;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:3;s:5:\"title\";s:37:\"Mobile App Development Trends in 2025\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:3;s:5:\"title\";s:37:\"Mobile App Development Trends in 2025\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:11;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:16;s:5:\"title\";s:48:\"SaaS Pricing Models: Choosing the Right Strategy\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:16;s:5:\"title\";s:48:\"SaaS Pricing Models: Choosing the Right Strategy\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:12;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:7;s:5:\"title\";s:41:\"SEO Strategies That Actually Work in 2025\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:7;s:5:\"title\";s:41:\"SEO Strategies That Actually Work in 2025\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:13;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:6;s:5:\"title\";s:38:\"Telemedicine Transforming Patient Care\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:6;s:5:\"title\";s:38:\"Telemedicine Transforming Patient Care\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:14;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:1;s:5:\"title\";s:38:\"The Future of Technology in Healthcare\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:1;s:5:\"title\";s:38:\"The Future of Technology in Healthcare\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:15;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:15;s:5:\"title\";s:52:\"Understanding Healthcare Compliance and Data Privacy\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:15;s:5:\"title\";s:52:\"Understanding Healthcare Compliance and Data Privacy\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:16;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:5;s:5:\"title\";s:54:\"Why Cloud Computing Is Essential for Modern Businesses\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:5;s:5:\"title\";s:54:\"Why Cloud Computing Is Essential for Modern Businesses\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1781245445, NULL);
INSERT INTO `cache` (`key`, `value`, `expiration`, `deleted_at`) VALUES
('laravel-cache-active_users_for_comments', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:20:{i:0;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Admin User\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Admin User\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:20;s:4:\"name\";s:12:\"Assistant PM\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:20;s:4:\"name\";s:12:\"Assistant PM\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:2;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:7;s:4:\"name\";s:11:\"Author User\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:7;s:4:\"name\";s:11:\"Author User\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:3;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:5;s:4:\"name\";s:15:\"Content Manager\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:5;s:4:\"name\";s:15:\"Content Manager\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:4;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:13;s:4:\"name\";s:13:\"Designer User\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:13;s:4:\"name\";s:13:\"Designer User\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:5;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:12;s:4:\"name\";s:14:\"Developer User\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:12;s:4:\"name\";s:14:\"Developer User\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:6;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:6;s:4:\"name\";s:11:\"Editor User\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:6;s:4:\"name\";s:11:\"Editor User\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:7;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"HR Manager\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:4;s:4:\"name\";s:10:\"HR Manager\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:8;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:19;s:4:\"name\";s:19:\"Marketing Executive\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:19;s:4:\"name\";s:19:\"Marketing Executive\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:9;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:9;s:4:\"name\";s:17:\"Marketing Manager\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:9;s:4:\"name\";s:17:\"Marketing Manager\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:10;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:3;s:4:\"name\";s:15:\"Project Manager\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:3;s:4:\"name\";s:15:\"Project Manager\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:11;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:14;s:4:\"name\";s:9:\"QA Tester\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:14;s:4:\"name\";s:9:\"QA Tester\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:12;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:16;s:4:\"name\";s:13:\"R&D Developer\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:16;s:4:\"name\";s:13:\"R&D Developer\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:13;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:17;s:4:\"name\";s:15:\"Sales Executive\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:17;s:4:\"name\";s:15:\"Sales Executive\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:14;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:10;s:4:\"name\";s:13:\"Sales Manager\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:10;s:4:\"name\";s:13:\"Sales Manager\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:15;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:8;s:4:\"name\";s:11:\"SEO Manager\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:8;s:4:\"name\";s:11:\"SEO Manager\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:16;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:11;s:4:\"name\";s:17:\"Support Executive\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:11;s:4:\"name\";s:17:\"Support Executive\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:17;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:18;s:4:\"name\";s:12:\"Support Lead\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:18;s:4:\"name\";s:12:\"Support Lead\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:18;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"System Admin\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:1;s:4:\"name\";s:12:\"System Admin\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}i:19;O:15:\"App\\Models\\User\":36:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:15;s:4:\"name\";s:11:\"Viewer User\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:15;s:4:\"name\";s:11:\"Viewer User\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:17:\"email_verified_at\";s:8:\"datetime\";s:13:\"last_login_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:4:\"uuid\";i:1;s:7:\"role_id\";i:2;s:13:\"department_id\";i:3;s:4:\"name\";i:4;s:5:\"email\";i:5;s:8:\"username\";i:6;s:5:\"phone\";i:7;s:6:\"avatar\";i:8;s:11:\"designation\";i:9;s:3:\"bio\";i:10;s:17:\"email_verified_at\";i:11;s:8:\"password\";i:12;s:9:\"is_active\";i:13;s:13:\"last_login_at\";i:14;s:13:\"last_login_ip\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";s:16:\"\0*\0forceDeleting\";b:0;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1781245445, NULL),
('laravel-cache-blog_comment_edit_4169a218-648d-11f1-b925-484d7ed9887c', 'O:18:\"App\\Models\\Comment\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"comments\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:15:{s:2:\"id\";i:10;s:4:\"uuid\";s:36:\"4169a218-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:5;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:11:\"Simran Kaur\";s:5:\"email\";s:18:\"simran@example.com\";s:7:\"website\";N;s:7:\"comment\";s:38:\"Great insights. Thank you for sharing.\";s:6:\"status\";s:8:\"rejected\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:1;s:5:\"likes\";i:0;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:11:\"\0*\0original\";a:15:{s:2:\"id\";i:10;s:4:\"uuid\";s:36:\"4169a218-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:5;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:11:\"Simran Kaur\";s:5:\"email\";s:18:\"simran@example.com\";s:7:\"website\";N;s:7:\"comment\";s:38:\"Great insights. Thank you for sharing.\";s:6:\"status\";s:8:\"rejected\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:1;s:5:\"likes\";i:0;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:11:\"is_reported\";s:7:\"boolean\";s:5:\"likes\";s:7:\"integer\";s:8:\"dislikes\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:4:\"uuid\";i:1;s:7:\"blog_id\";i:2;s:9:\"parent_id\";i:3;s:7:\"user_id\";i:4;s:4:\"name\";i:5;s:5:\"email\";i:6;s:7:\"website\";i:7;s:7:\"comment\";i:8;s:6:\"status\";i:9;s:10:\"ip_address\";i:10;s:10:\"user_agent\";i:11;s:11:\"is_reported\";i:12;s:5:\"likes\";i:13;s:8:\"dislikes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}', 1781245445, NULL);
INSERT INTO `cache` (`key`, `value`, `expiration`, `deleted_at`) VALUES
('laravel-cache-blog_comments_list_page_1', 'O:42:\"Illuminate\\Pagination\\LengthAwarePaginator\":12:{s:8:\"\0*\0items\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:10:{i:0;O:18:\"App\\Models\\Comment\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"comments\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:10;s:4:\"uuid\";s:36:\"4169a218-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:5;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:11:\"Simran Kaur\";s:7:\"comment\";s:42:\"Great insights. Thank you for sharing.anky\";s:5:\"email\";s:18:\"simran@example.com\";s:6:\"status\";s:8:\"rejected\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:1;s:5:\"likes\";i:100;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:10;s:4:\"uuid\";s:36:\"4169a218-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:5;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:11:\"Simran Kaur\";s:7:\"comment\";s:42:\"Great insights. Thank you for sharing.anky\";s:5:\"email\";s:18:\"simran@example.com\";s:6:\"status\";s:8:\"rejected\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:1;s:5:\"likes\";i:100;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:11:\"is_reported\";s:7:\"boolean\";s:5:\"likes\";s:7:\"integer\";s:8:\"dislikes\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"blog\";O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:5;s:5:\"title\";s:54:\"Why Cloud Computing Is Essential for Modern Businesses\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:5;s:5:\"title\";s:54:\"Why Cloud Computing Is Essential for Modern Businesses\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:4:\"user\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:4:\"uuid\";i:1;s:7:\"blog_id\";i:2;s:9:\"parent_id\";i:3;s:7:\"user_id\";i:4;s:4:\"name\";i:5;s:5:\"email\";i:6;s:7:\"website\";i:7;s:7:\"comment\";i:8;s:6:\"status\";i:9;s:10:\"ip_address\";i:10;s:10:\"user_agent\";i:11;s:11:\"is_reported\";i:12;s:5:\"likes\";i:13;s:8:\"dislikes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:18:\"App\\Models\\Comment\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"comments\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:9;s:4:\"uuid\";s:36:\"4169a158-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:5;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:14:\"Rohit Malhotra\";s:7:\"comment\";s:39:\"The examples were practical and useful.\";s:5:\"email\";s:45:\"[rohit@example.com](mailto:rohit@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:11;s:8:\"dislikes\";i:1;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:9;s:4:\"uuid\";s:36:\"4169a158-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:5;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:14:\"Rohit Malhotra\";s:7:\"comment\";s:39:\"The examples were practical and useful.\";s:5:\"email\";s:45:\"[rohit@example.com](mailto:rohit@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:11;s:8:\"dislikes\";i:1;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:11:\"is_reported\";s:7:\"boolean\";s:5:\"likes\";s:7:\"integer\";s:8:\"dislikes\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"blog\";r:61;s:4:\"user\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:4:\"uuid\";i:1;s:7:\"blog_id\";i:2;s:9:\"parent_id\";i:3;s:7:\"user_id\";i:4;s:4:\"name\";i:5;s:5:\"email\";i:6;s:7:\"website\";i:7;s:7:\"comment\";i:8;s:6:\"status\";i:9;s:10:\"ip_address\";i:10;s:10:\"user_agent\";i:11;s:11:\"is_reported\";i:12;s:5:\"likes\";i:13;s:8:\"dislikes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:2;O:18:\"App\\Models\\Comment\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"comments\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:8;s:4:\"uuid\";s:36:\"4169a079-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:4;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:13:\"Anjali Kapoor\";s:7:\"comment\";s:43:\"Looking forward to more articles like this.\";s:5:\"email\";s:47:\"[anjali@example.com](mailto:anjali@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:6;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:8;s:4:\"uuid\";s:36:\"4169a079-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:4;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:13:\"Anjali Kapoor\";s:7:\"comment\";s:43:\"Looking forward to more articles like this.\";s:5:\"email\";s:47:\"[anjali@example.com](mailto:anjali@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:6;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:11:\"is_reported\";s:7:\"boolean\";s:5:\"likes\";s:7:\"integer\";s:8:\"dislikes\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"blog\";O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:4;s:5:\"title\";s:48:\"Artificial Intelligence in Everyday Applications\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:4;s:5:\"title\";s:48:\"Artificial Intelligence in Everyday Applications\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:4:\"user\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:4:\"uuid\";i:1;s:7:\"blog_id\";i:2;s:9:\"parent_id\";i:3;s:7:\"user_id\";i:4;s:4:\"name\";i:5;s:5:\"email\";i:6;s:7:\"website\";i:7;s:7:\"comment\";i:8;s:6:\"status\";i:9;s:10:\"ip_address\";i:10;s:10:\"user_agent\";i:11;s:11:\"is_reported\";i:12;s:5:\"likes\";i:13;s:8:\"dislikes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:3;O:18:\"App\\Models\\Comment\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"comments\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:7;s:4:\"uuid\";s:36:\"41699fa0-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:4;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:11:\"Vikas Mehta\";s:7:\"comment\";s:52:\"I disagree with some points but overall a good read.\";s:5:\"email\";s:45:\"[vikas@example.com](mailto:vikas@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:5;s:8:\"dislikes\";i:4;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:7;s:4:\"uuid\";s:36:\"41699fa0-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:4;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:11:\"Vikas Mehta\";s:7:\"comment\";s:52:\"I disagree with some points but overall a good read.\";s:5:\"email\";s:45:\"[vikas@example.com](mailto:vikas@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:5;s:8:\"dislikes\";i:4;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:11:\"is_reported\";s:7:\"boolean\";s:5:\"likes\";s:7:\"integer\";s:8:\"dislikes\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"blog\";r:296;s:4:\"user\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:4:\"uuid\";i:1;s:7:\"blog_id\";i:2;s:9:\"parent_id\";i:3;s:7:\"user_id\";i:4;s:4:\"name\";i:5;s:5:\"email\";i:6;s:7:\"website\";i:7;s:7:\"comment\";i:8;s:6:\"status\";i:9;s:10:\"ip_address\";i:10;s:10:\"user_agent\";i:11;s:11:\"is_reported\";i:12;s:5:\"likes\";i:13;s:8:\"dislikes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:4;O:18:\"App\\Models\\Comment\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"comments\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:6;s:4:\"uuid\";s:36:\"41699e53-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:3;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:11:\"Pooja Arora\";s:7:\"comment\";s:53:\"Very detailed explanation. Keep posting such content.\";s:5:\"email\";s:45:\"[pooja@example.com](mailto:pooja@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:10;s:8:\"dislikes\";i:1;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:6;s:4:\"uuid\";s:36:\"41699e53-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:3;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:11:\"Pooja Arora\";s:7:\"comment\";s:53:\"Very detailed explanation. Keep posting such content.\";s:5:\"email\";s:45:\"[pooja@example.com](mailto:pooja@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:10;s:8:\"dislikes\";i:1;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:11:\"is_reported\";s:7:\"boolean\";s:5:\"likes\";s:7:\"integer\";s:8:\"dislikes\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"blog\";O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:3;s:5:\"title\";s:37:\"Mobile App Development Trends in 2025\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:3;s:5:\"title\";s:37:\"Mobile App Development Trends in 2025\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:4:\"user\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:4:\"uuid\";i:1;s:7:\"blog_id\";i:2;s:9:\"parent_id\";i:3;s:7:\"user_id\";i:4;s:4:\"name\";i:5;s:5:\"email\";i:6;s:7:\"website\";i:7;s:7:\"comment\";i:8;s:6:\"status\";i:9;s:10:\"ip_address\";i:10;s:10:\"user_agent\";i:11;s:11:\"is_reported\";i:12;s:5:\"likes\";i:13;s:8:\"dislikes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:5;O:18:\"App\\Models\\Comment\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"comments\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:5;s:4:\"uuid\";s:36:\"414b5bb7-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:3;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:13:\"Sandeep Gupta\";s:7:\"comment\";s:44:\"This guide helped me solve my issue quickly.\";s:5:\"email\";s:49:\"[sandeep@example.com](mailto:sandeep@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:7;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:5;s:4:\"uuid\";s:36:\"414b5bb7-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:3;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:13:\"Sandeep Gupta\";s:7:\"comment\";s:44:\"This guide helped me solve my issue quickly.\";s:5:\"email\";s:49:\"[sandeep@example.com](mailto:sandeep@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:7;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:11:\"is_reported\";s:7:\"boolean\";s:5:\"likes\";s:7:\"integer\";s:8:\"dislikes\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"blog\";r:531;s:4:\"user\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:4:\"uuid\";i:1;s:7:\"blog_id\";i:2;s:9:\"parent_id\";i:3;s:7:\"user_id\";i:4;s:4:\"name\";i:5;s:5:\"email\";i:6;s:7:\"website\";i:7;s:7:\"comment\";i:8;s:6:\"status\";i:9;s:10:\"ip_address\";i:10;s:10:\"user_agent\";i:11;s:11:\"is_reported\";i:12;s:5:\"likes\";i:13;s:8:\"dislikes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:6;O:18:\"App\\Models\\Comment\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"comments\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:4;s:4:\"uuid\";s:36:\"414b5aac-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:2;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:10:\"Neha Verma\";s:7:\"comment\";s:54:\"Could you provide more examples related to this topic?\";s:5:\"email\";s:43:\"[neha@example.com](mailto:neha@example.com)\";s:6:\"status\";s:7:\"pending\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:3;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:4;s:4:\"uuid\";s:36:\"414b5aac-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:2;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:10:\"Neha Verma\";s:7:\"comment\";s:54:\"Could you provide more examples related to this topic?\";s:5:\"email\";s:43:\"[neha@example.com](mailto:neha@example.com)\";s:6:\"status\";s:7:\"pending\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:3;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:11:\"is_reported\";s:7:\"boolean\";s:5:\"likes\";s:7:\"integer\";s:8:\"dislikes\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"blog\";O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:2;s:5:\"title\";s:48:\"Best Practices for Scalable Software Development\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:2;s:5:\"title\";s:48:\"Best Practices for Scalable Software Development\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:4:\"user\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:4:\"uuid\";i:1;s:7:\"blog_id\";i:2;s:9:\"parent_id\";i:3;s:7:\"user_id\";i:4;s:4:\"name\";i:5;s:5:\"email\";i:6;s:7:\"website\";i:7;s:7:\"comment\";i:8;s:6:\"status\";i:9;s:10:\"ip_address\";i:10;s:10:\"user_agent\";i:11;s:11:\"is_reported\";i:12;s:5:\"likes\";i:13;s:8:\"dislikes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:7;O:18:\"App\\Models\\Comment\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"comments\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:3;s:4:\"uuid\";s:36:\"414b59f9-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:2;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:10:\"Amit Kumar\";s:7:\"comment\";s:51:\"I have implemented these tips and got good results.\";s:5:\"email\";s:43:\"[amit@example.com](mailto:amit@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:15;s:8:\"dislikes\";i:2;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:3;s:4:\"uuid\";s:36:\"414b59f9-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:2;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:10:\"Amit Kumar\";s:7:\"comment\";s:51:\"I have implemented these tips and got good results.\";s:5:\"email\";s:43:\"[amit@example.com](mailto:amit@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:15;s:8:\"dislikes\";i:2;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:11:\"is_reported\";s:7:\"boolean\";s:5:\"likes\";s:7:\"integer\";s:8:\"dislikes\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"blog\";r:766;s:4:\"user\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:4:\"uuid\";i:1;s:7:\"blog_id\";i:2;s:9:\"parent_id\";i:3;s:7:\"user_id\";i:4;s:4:\"name\";i:5;s:5:\"email\";i:6;s:7:\"website\";i:7;s:7:\"comment\";i:8;s:6:\"status\";i:9;s:10:\"ip_address\";i:10;s:10:\"user_agent\";i:11;s:11:\"is_reported\";i:12;s:5:\"likes\";i:13;s:8:\"dislikes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:8;O:18:\"App\\Models\\Comment\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"comments\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:2;s:4:\"uuid\";s:36:\"414b55f3-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:1;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:11:\"Priya Singh\";s:7:\"comment\";s:45:\"Thanks for sharing this valuable information.\";s:5:\"email\";s:45:\"[priya@example.com](mailto:priya@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:8;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:2;s:4:\"uuid\";s:36:\"414b55f3-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:1;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:11:\"Priya Singh\";s:7:\"comment\";s:45:\"Thanks for sharing this valuable information.\";s:5:\"email\";s:45:\"[priya@example.com](mailto:priya@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:8;s:8:\"dislikes\";i:0;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:11:\"is_reported\";s:7:\"boolean\";s:5:\"likes\";s:7:\"integer\";s:8:\"dislikes\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"blog\";O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:1;s:5:\"title\";s:38:\"The Future of Technology in Healthcare\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:1;s:5:\"title\";s:38:\"The Future of Technology in Healthcare\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:4:\"user\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:4:\"uuid\";i:1;s:7:\"blog_id\";i:2;s:9:\"parent_id\";i:3;s:7:\"user_id\";i:4;s:4:\"name\";i:5;s:5:\"email\";i:6;s:7:\"website\";i:7;s:7:\"comment\";i:8;s:6:\"status\";i:9;s:10:\"ip_address\";i:10;s:10:\"user_agent\";i:11;s:11:\"is_reported\";i:12;s:5:\"likes\";i:13;s:8:\"dislikes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:9;O:18:\"App\\Models\\Comment\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"comments\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:14:{s:2:\"id\";i:1;s:4:\"uuid\";s:36:\"4146e649-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:1;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:12:\"Rahul Sharma\";s:7:\"comment\";s:59:\"Excellent article. Very informative and easy to understand.\";s:5:\"email\";s:45:\"[rahul@example.com](mailto:rahul@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:12;s:8:\"dislikes\";i:1;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:11:\"\0*\0original\";a:14:{s:2:\"id\";i:1;s:4:\"uuid\";s:36:\"4146e649-648d-11f1-b925-484d7ed9887c\";s:7:\"blog_id\";i:1;s:9:\"parent_id\";N;s:7:\"user_id\";N;s:4:\"name\";s:12:\"Rahul Sharma\";s:7:\"comment\";s:59:\"Excellent article. Very informative and easy to understand.\";s:5:\"email\";s:45:\"[rahul@example.com](mailto:rahul@example.com)\";s:6:\"status\";s:8:\"approved\";s:9:\"is_active\";i:1;s:11:\"is_reported\";i:0;s:5:\"likes\";i:12;s:8:\"dislikes\";i:1;s:10:\"created_at\";s:19:\"2026-06-10 10:58:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:11:\"is_reported\";s:7:\"boolean\";s:5:\"likes\";s:7:\"integer\";s:8:\"dislikes\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"blog\";r:1001;s:4:\"user\";N;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:4:\"uuid\";i:1;s:7:\"blog_id\";i:2;s:9:\"parent_id\";i:3;s:7:\"user_id\";i:4;s:4:\"name\";i:5;s:5:\"email\";i:6;s:7:\"website\";i:7;s:7:\"comment\";i:8;s:6:\"status\";i:9;s:10:\"ip_address\";i:10;s:10:\"user_agent\";i:11;s:11:\"is_reported\";i:12;s:5:\"likes\";i:13;s:8:\"dislikes\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:10:\"\0*\0perPage\";i:15;s:14:\"\0*\0currentPage\";i:1;s:7:\"\0*\0path\";s:42:\"http://127.0.0.1:8000/admin/blogs/comments\";s:8:\"\0*\0query\";a:0:{}s:11:\"\0*\0fragment\";N;s:11:\"\0*\0pageName\";s:4:\"page\";s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:10:\"onEachSide\";i:3;s:10:\"\0*\0options\";a:2:{s:4:\"path\";s:42:\"http://127.0.0.1:8000/admin/blogs/comments\";s:8:\"pageName\";s:4:\"page\";}s:8:\"\0*\0total\";i:10;s:11:\"\0*\0lastPage\";i:1;}', 1781245631, NULL);
INSERT INTO `cache` (`key`, `value`, `expiration`, `deleted_at`) VALUES
('laravel-cache-blogs_page_1', 'O:42:\"Illuminate\\Pagination\\LengthAwarePaginator\":12:{s:8:\"\0*\0items\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:15:{i:0;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:19;s:4:\"uuid\";s:36:\"a459e163-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:16;s:9:\"author_id\";i:8;s:5:\"title\";s:46:\"AI in Healthcare: Opportunities and Challenges\";s:4:\"slug\";s:45:\"ai-in-healthcare-opportunities-and-challenges\";s:7:\"excerpt\";s:87:\"<p>Artificial intelligence offers major opportunities and challenges in healthcare.</p>\";s:14:\"featured_image\";s:71:\"blogs/a459e163-ee23-11f0-a0af-1860247b6ae0/1780901151_pull-stud-pic.jpg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:410;s:12:\"reading_time\";i:7;s:13:\"comment_count\";i:6;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:19;s:4:\"uuid\";s:36:\"a459e163-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:16;s:9:\"author_id\";i:8;s:5:\"title\";s:46:\"AI in Healthcare: Opportunities and Challenges\";s:4:\"slug\";s:45:\"ai-in-healthcare-opportunities-and-challenges\";s:7:\"excerpt\";s:87:\"<p>Artificial intelligence offers major opportunities and challenges in healthcare.</p>\";s:14:\"featured_image\";s:71:\"blogs/a459e163-ee23-11f0-a0af-1860247b6ae0/1780901151_pull-stud-pic.jpg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:410;s:12:\"reading_time\";i:7;s:13:\"comment_count\";i:6;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";O:17:\"App\\Models\\Author\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"authors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:8;s:4:\"name\";s:12:\"Ritika Joshi\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:8;s:4:\"name\";s:12:\"Ritika Joshi\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:12:\"social_links\";s:5:\"array\";s:11:\"total_blogs\";s:7:\"integer\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:18:{i:0;s:4:\"uuid\";i:1;s:7:\"user_id\";i:2;s:4:\"name\";i:3;s:4:\"slug\";i:4;s:5:\"email\";i:5;s:5:\"phone\";i:6;s:13:\"profile_image\";i:7;s:11:\"cover_image\";i:8;s:3:\"bio\";i:9;s:11:\"designation\";i:10;s:7:\"company\";i:11;s:7:\"website\";i:12;s:12:\"social_links\";i:13;s:10:\"meta_title\";i:14;s:16:\"meta_description\";i:15;s:11:\"total_blogs\";i:16;s:11:\"is_featured\";i:17;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:8:\"category\";O:23:\"App\\Models\\BlogCategory\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"blog_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:16;s:4:\"name\";s:16:\"AI in Healthcare\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:16;s:4:\"name\";s:16:\"AI in Healthcare\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"uuid\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:4:\"icon\";i:4;s:5:\"image\";i:5;s:11:\"description\";i:6;s:10:\"meta_title\";i:7;s:16:\"meta_description\";i:8;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:18;s:4:\"uuid\";s:36:\"a459df20-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:11;s:9:\"author_id\";i:2;s:5:\"title\";s:45:\"Healthcare Software Trends Shaping the Future\";s:4:\"slug\";s:45:\"healthcare-software-trends-shaping-the-future\";s:7:\"excerpt\";s:94:\"<p>Healthcare software is evolving to support efficient workflows and better patient care.</p>\";s:14:\"featured_image\";s:99:\"blogs/a459df20-ee23-11f0-a0af-1860247b6ae0/1770039313_whatsapp-image-2026-01-17-at-110310-pm-1.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:330;s:12:\"reading_time\";i:6;s:13:\"comment_count\";i:4;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:18;s:4:\"uuid\";s:36:\"a459df20-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:11;s:9:\"author_id\";i:2;s:5:\"title\";s:45:\"Healthcare Software Trends Shaping the Future\";s:4:\"slug\";s:45:\"healthcare-software-trends-shaping-the-future\";s:7:\"excerpt\";s:94:\"<p>Healthcare software is evolving to support efficient workflows and better patient care.</p>\";s:14:\"featured_image\";s:99:\"blogs/a459df20-ee23-11f0-a0af-1860247b6ae0/1770039313_whatsapp-image-2026-01-17-at-110310-pm-1.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:330;s:12:\"reading_time\";i:6;s:13:\"comment_count\";i:4;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";O:17:\"App\\Models\\Author\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"authors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Neha Verma\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Neha Verma\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:12:\"social_links\";s:5:\"array\";s:11:\"total_blogs\";s:7:\"integer\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:18:{i:0;s:4:\"uuid\";i:1;s:7:\"user_id\";i:2;s:4:\"name\";i:3;s:4:\"slug\";i:4;s:5:\"email\";i:5;s:5:\"phone\";i:6;s:13:\"profile_image\";i:7;s:11:\"cover_image\";i:8;s:3:\"bio\";i:9;s:11:\"designation\";i:10;s:7:\"company\";i:11;s:7:\"website\";i:12;s:12:\"social_links\";i:13;s:10:\"meta_title\";i:14;s:16:\"meta_description\";i:15;s:11:\"total_blogs\";i:16;s:11:\"is_featured\";i:17;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:8:\"category\";O:23:\"App\\Models\\BlogCategory\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"blog_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:11;s:4:\"name\";s:19:\"Healthcare Software\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:11;s:4:\"name\";s:19:\"Healthcare Software\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"uuid\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:4:\"icon\";i:4;s:5:\"image\";i:5;s:11:\"description\";i:6;s:10:\"meta_title\";i:7;s:16:\"meta_description\";i:8;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:2;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:17;s:4:\"uuid\";s:36:\"a4594a3d-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:10;s:9:\"author_id\";i:9;s:5:\"title\";s:50:\"Best Cyber Security Practices for Small Businesses\";s:4:\"slug\";s:50:\"best-cyber-security-practices-for-small-businesses\";s:7:\"excerpt\";s:85:\"<p>Small businesses must adopt strong cyber security practices to stay protected.</p>\";s:14:\"featured_image\";s:99:\"blogs/a4594a3d-ee23-11f0-a0af-1860247b6ae0/1770039198_whatsapp-image-2026-01-17-at-110309-pm-1.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:265;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:3;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:17;s:4:\"uuid\";s:36:\"a4594a3d-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:10;s:9:\"author_id\";i:9;s:5:\"title\";s:50:\"Best Cyber Security Practices for Small Businesses\";s:4:\"slug\";s:50:\"best-cyber-security-practices-for-small-businesses\";s:7:\"excerpt\";s:85:\"<p>Small businesses must adopt strong cyber security practices to stay protected.</p>\";s:14:\"featured_image\";s:99:\"blogs/a4594a3d-ee23-11f0-a0af-1860247b6ae0/1770039198_whatsapp-image-2026-01-17-at-110309-pm-1.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:265;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:3;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";O:17:\"App\\Models\\Author\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"authors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:9;s:4:\"name\";s:10:\"Arjun Nair\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:9;s:4:\"name\";s:10:\"Arjun Nair\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:12:\"social_links\";s:5:\"array\";s:11:\"total_blogs\";s:7:\"integer\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:18:{i:0;s:4:\"uuid\";i:1;s:7:\"user_id\";i:2;s:4:\"name\";i:3;s:4:\"slug\";i:4;s:5:\"email\";i:5;s:5:\"phone\";i:6;s:13:\"profile_image\";i:7;s:11:\"cover_image\";i:8;s:3:\"bio\";i:9;s:11:\"designation\";i:10;s:7:\"company\";i:11;s:7:\"website\";i:12;s:12:\"social_links\";i:13;s:10:\"meta_title\";i:14;s:16:\"meta_description\";i:15;s:11:\"total_blogs\";i:16;s:11:\"is_featured\";i:17;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:8:\"category\";O:23:\"App\\Models\\BlogCategory\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"blog_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:10;s:4:\"name\";s:14:\"Cyber Security\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:10;s:4:\"name\";s:14:\"Cyber Security\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"uuid\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:4:\"icon\";i:4;s:5:\"image\";i:5;s:11:\"description\";i:6;s:10:\"meta_title\";i:7;s:16:\"meta_description\";i:8;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:3;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:16;s:4:\"uuid\";s:36:\"a45947f3-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:8;s:9:\"author_id\";i:7;s:5:\"title\";s:48:\"SaaS Pricing Models: Choosing the Right Strategy\";s:4:\"slug\";s:47:\"saas-pricing-models-choosing-the-right-strategy\";s:7:\"excerpt\";s:79:\"<p>Choosing the right SaaS pricing model is crucial for sustainable growth.</p>\";s:14:\"featured_image\";s:97:\"blogs/a45947f3-ee23-11f0-a0af-1860247b6ae0/1770039157_whatsapp-image-2026-01-17-at-110308-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:210;s:12:\"reading_time\";i:4;s:13:\"comment_count\";i:1;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:16;s:4:\"uuid\";s:36:\"a45947f3-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:8;s:9:\"author_id\";i:7;s:5:\"title\";s:48:\"SaaS Pricing Models: Choosing the Right Strategy\";s:4:\"slug\";s:47:\"saas-pricing-models-choosing-the-right-strategy\";s:7:\"excerpt\";s:79:\"<p>Choosing the right SaaS pricing model is crucial for sustainable growth.</p>\";s:14:\"featured_image\";s:97:\"blogs/a45947f3-ee23-11f0-a0af-1860247b6ae0/1770039157_whatsapp-image-2026-01-17-at-110308-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:210;s:12:\"reading_time\";i:4;s:13:\"comment_count\";i:1;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";O:17:\"App\\Models\\Author\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"authors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:7;s:4:\"name\";s:14:\"Vikas Malhotra\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:7;s:4:\"name\";s:14:\"Vikas Malhotra\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:12:\"social_links\";s:5:\"array\";s:11:\"total_blogs\";s:7:\"integer\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:18:{i:0;s:4:\"uuid\";i:1;s:7:\"user_id\";i:2;s:4:\"name\";i:3;s:4:\"slug\";i:4;s:5:\"email\";i:5;s:5:\"phone\";i:6;s:13:\"profile_image\";i:7;s:11:\"cover_image\";i:8;s:3:\"bio\";i:9;s:11:\"designation\";i:10;s:7:\"company\";i:11;s:7:\"website\";i:12;s:12:\"social_links\";i:13;s:10:\"meta_title\";i:14;s:16:\"meta_description\";i:15;s:11:\"total_blogs\";i:16;s:11:\"is_featured\";i:17;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:8:\"category\";O:23:\"App\\Models\\BlogCategory\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"blog_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:8;s:4:\"name\";s:19:\"Business & Startups\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:8;s:4:\"name\";s:19:\"Business & Startups\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"uuid\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:4:\"icon\";i:4;s:5:\"image\";i:5;s:11:\"description\";i:6;s:10:\"meta_title\";i:7;s:16:\"meta_description\";i:8;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:4;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:15;s:4:\"uuid\";s:36:\"a459472a-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:20;s:9:\"author_id\";i:5;s:5:\"title\";s:52:\"Understanding Healthcare Compliance and Data Privacy\";s:4:\"slug\";s:52:\"understanding-healthcare-compliance-and-data-privacy\";s:7:\"excerpt\";s:86:\"<p>Healthcare compliance ensures data privacy, security, and regulatory adherence.</p>\";s:14:\"featured_image\";s:97:\"blogs/a459472a-ee23-11f0-a0af-1860247b6ae0/1770039115_whatsapp-image-2026-01-17-at-105704-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:280;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:3;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:15;s:4:\"uuid\";s:36:\"a459472a-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:20;s:9:\"author_id\";i:5;s:5:\"title\";s:52:\"Understanding Healthcare Compliance and Data Privacy\";s:4:\"slug\";s:52:\"understanding-healthcare-compliance-and-data-privacy\";s:7:\"excerpt\";s:86:\"<p>Healthcare compliance ensures data privacy, security, and regulatory adherence.</p>\";s:14:\"featured_image\";s:97:\"blogs/a459472a-ee23-11f0-a0af-1860247b6ae0/1770039115_whatsapp-image-2026-01-17-at-105704-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:280;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:3;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";O:17:\"App\\Models\\Author\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"authors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:5;s:4:\"name\";s:11:\"Ankit Patel\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:5;s:4:\"name\";s:11:\"Ankit Patel\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:12:\"social_links\";s:5:\"array\";s:11:\"total_blogs\";s:7:\"integer\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:18:{i:0;s:4:\"uuid\";i:1;s:7:\"user_id\";i:2;s:4:\"name\";i:3;s:4:\"slug\";i:4;s:5:\"email\";i:5;s:5:\"phone\";i:6;s:13:\"profile_image\";i:7;s:11:\"cover_image\";i:8;s:3:\"bio\";i:9;s:11:\"designation\";i:10;s:7:\"company\";i:11;s:7:\"website\";i:12;s:12:\"social_links\";i:13;s:10:\"meta_title\";i:14;s:16:\"meta_description\";i:15;s:11:\"total_blogs\";i:16;s:11:\"is_featured\";i:17;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:8:\"category\";O:23:\"App\\Models\\BlogCategory\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"blog_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:20;s:4:\"name\";s:19:\"DevOps & Automation\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:20;s:4:\"name\";s:19:\"DevOps & Automation\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"uuid\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:4:\"icon\";i:4;s:5:\"image\";i:5;s:11:\"description\";i:6;s:10:\"meta_title\";i:7;s:16:\"meta_description\";i:8;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:5;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:14;s:4:\"uuid\";s:36:\"a4594659-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:9;s:9:\"author_id\";i:4;s:5:\"title\";s:51:\"Cloud Migration Challenges and How to Overcome Them\";s:4:\"slug\";s:51:\"cloud-migration-challenges-and-how-to-overcome-them\";s:7:\"excerpt\";s:87:\"<p>Cloud migration presents technical and organizational challenges for businesses.</p>\";s:14:\"featured_image\";s:97:\"blogs/a4594659-ee23-11f0-a0af-1860247b6ae0/1770039071_whatsapp-image-2026-01-17-at-105703-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:225;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:2;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:14;s:4:\"uuid\";s:36:\"a4594659-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:9;s:9:\"author_id\";i:4;s:5:\"title\";s:51:\"Cloud Migration Challenges and How to Overcome Them\";s:4:\"slug\";s:51:\"cloud-migration-challenges-and-how-to-overcome-them\";s:7:\"excerpt\";s:87:\"<p>Cloud migration presents technical and organizational challenges for businesses.</p>\";s:14:\"featured_image\";s:97:\"blogs/a4594659-ee23-11f0-a0af-1860247b6ae0/1770039071_whatsapp-image-2026-01-17-at-105703-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:225;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:2;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";O:17:\"App\\Models\\Author\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"authors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:4;s:4:\"name\";s:11:\"Priya Singh\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:4;s:4:\"name\";s:11:\"Priya Singh\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:12:\"social_links\";s:5:\"array\";s:11:\"total_blogs\";s:7:\"integer\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:18:{i:0;s:4:\"uuid\";i:1;s:7:\"user_id\";i:2;s:4:\"name\";i:3;s:4:\"slug\";i:4;s:5:\"email\";i:5;s:5:\"phone\";i:6;s:13:\"profile_image\";i:7;s:11:\"cover_image\";i:8;s:3:\"bio\";i:9;s:11:\"designation\";i:10;s:7:\"company\";i:11;s:7:\"website\";i:12;s:12:\"social_links\";i:13;s:10:\"meta_title\";i:14;s:16:\"meta_description\";i:15;s:11:\"total_blogs\";i:16;s:11:\"is_featured\";i:17;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:8:\"category\";O:23:\"App\\Models\\BlogCategory\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"blog_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:9;s:4:\"name\";s:12:\"SaaS & Cloud\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:9;s:4:\"name\";s:12:\"SaaS & Cloud\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"uuid\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:4:\"icon\";i:4;s:5:\"image\";i:5;s:11:\"description\";i:6;s:10:\"meta_title\";i:7;s:16:\"meta_description\";i:8;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:6;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:13;s:4:\"uuid\";s:36:\"a4594547-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:7;s:9:\"author_id\";i:2;s:5:\"title\";s:44:\"Machine Learning Use Cases Across Industries\";s:4:\"slug\";s:44:\"machine-learning-use-cases-across-industries\";s:7:\"excerpt\";s:128:\"<p>Machine learning is transforming industries by enabling automation, predictive insights, and intelligent decision-making.</p>\";s:14:\"featured_image\";s:97:\"blogs/a4594547-ee23-11f0-a0af-1860247b6ae0/1770039034_whatsapp-image-2026-01-17-at-105702-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:340;s:12:\"reading_time\";i:6;s:13:\"comment_count\";i:4;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:13;s:4:\"uuid\";s:36:\"a4594547-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:7;s:9:\"author_id\";i:2;s:5:\"title\";s:44:\"Machine Learning Use Cases Across Industries\";s:4:\"slug\";s:44:\"machine-learning-use-cases-across-industries\";s:7:\"excerpt\";s:128:\"<p>Machine learning is transforming industries by enabling automation, predictive insights, and intelligent decision-making.</p>\";s:14:\"featured_image\";s:97:\"blogs/a4594547-ee23-11f0-a0af-1860247b6ae0/1770039034_whatsapp-image-2026-01-17-at-105702-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:340;s:12:\"reading_time\";i:6;s:13:\"comment_count\";i:4;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";r:279;s:8:\"category\";O:23:\"App\\Models\\BlogCategory\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"blog_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:7;s:4:\"name\";s:23:\"Artificial Intelligence\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:7;s:4:\"name\";s:23:\"Artificial Intelligence\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"uuid\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:4:\"icon\";i:4;s:5:\"image\";i:5;s:11:\"description\";i:6;s:10:\"meta_title\";i:7;s:16:\"meta_description\";i:8;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:7;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:12;s:4:\"uuid\";s:36:\"a459432c-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:5;s:9:\"author_id\";i:1;s:5:\"title\";s:56:\"Modern Web Development Tools Every Developer Should Know\";s:4:\"slug\";s:56:\"modern-web-development-tools-every-developer-should-know\";s:7:\"excerpt\";s:114:\"<p>Modern web development depends on powerful tools that improve productivity, performance, and collaboration.</p>\";s:14:\"featured_image\";s:59:\"blogs/a459432c-ee23-11f0-a0af-1860247b6ae0/1780638205_6.jpg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:0;s:5:\"views\";i:195;s:12:\"reading_time\";i:4;s:13:\"comment_count\";i:1;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:12;s:4:\"uuid\";s:36:\"a459432c-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:5;s:9:\"author_id\";i:1;s:5:\"title\";s:56:\"Modern Web Development Tools Every Developer Should Know\";s:4:\"slug\";s:56:\"modern-web-development-tools-every-developer-should-know\";s:7:\"excerpt\";s:114:\"<p>Modern web development depends on powerful tools that improve productivity, performance, and collaboration.</p>\";s:14:\"featured_image\";s:59:\"blogs/a459432c-ee23-11f0-a0af-1860247b6ae0/1780638205_6.jpg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:25:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:0;s:5:\"views\";i:195;s:12:\"reading_time\";i:4;s:13:\"comment_count\";i:1;s:10:\"created_at\";s:19:\"2026-01-10 18:25:29\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";O:17:\"App\\Models\\Author\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"authors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:1;s:4:\"name\";s:11:\"Amit Sharma\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:1;s:4:\"name\";s:11:\"Amit Sharma\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:12:\"social_links\";s:5:\"array\";s:11:\"total_blogs\";s:7:\"integer\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:18:{i:0;s:4:\"uuid\";i:1;s:7:\"user_id\";i:2;s:4:\"name\";i:3;s:4:\"slug\";i:4;s:5:\"email\";i:5;s:5:\"phone\";i:6;s:13:\"profile_image\";i:7;s:11:\"cover_image\";i:8;s:3:\"bio\";i:9;s:11:\"designation\";i:10;s:7:\"company\";i:11;s:7:\"website\";i:12;s:12:\"social_links\";i:13;s:10:\"meta_title\";i:14;s:16:\"meta_description\";i:15;s:11:\"total_blogs\";i:16;s:11:\"is_featured\";i:17;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:8:\"category\";O:23:\"App\\Models\\BlogCategory\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"blog_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:5;s:4:\"name\";s:15:\"Web Development\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:5;s:4:\"name\";s:15:\"Web Development\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"uuid\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:4:\"icon\";i:4;s:5:\"image\";i:5;s:11:\"description\";i:6;s:10:\"meta_title\";i:7;s:16:\"meta_description\";i:8;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:8;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:10;s:4:\"uuid\";s:36:\"8825578f-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:15;s:9:\"author_id\";N;s:5:\"title\";s:37:\"Digital Transformation Trends in 2025\";s:4:\"slug\";s:34:\"digital-transformation-trends-2025\";s:7:\"excerpt\";s:92:\"Digital transformation continues to reshape industries through technology-driven innovation.\";s:14:\"featured_image\";N;s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:42\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:390;s:12:\"reading_time\";i:6;s:13:\"comment_count\";i:5;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:10;s:4:\"uuid\";s:36:\"8825578f-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:15;s:9:\"author_id\";N;s:5:\"title\";s:37:\"Digital Transformation Trends in 2025\";s:4:\"slug\";s:34:\"digital-transformation-trends-2025\";s:7:\"excerpt\";s:92:\"Digital transformation continues to reshape industries through technology-driven innovation.\";s:14:\"featured_image\";N;s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:42\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:390;s:12:\"reading_time\";i:6;s:13:\"comment_count\";i:5;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";N;s:8:\"category\";O:23:\"App\\Models\\BlogCategory\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"blog_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:15;s:4:\"name\";s:17:\"Industry Insights\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:15;s:4:\"name\";s:17:\"Industry Insights\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"uuid\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:4:\"icon\";i:4;s:5:\"image\";i:5;s:11:\"description\";i:6;s:10:\"meta_title\";i:7;s:16:\"meta_description\";i:8;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:9;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:9;s:4:\"uuid\";s:36:\"882556b6-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:10;s:9:\"author_id\";N;s:5:\"title\";s:44:\"Cyber Security Threats Businesses Must Watch\";s:4:\"slug\";s:44:\"cyber-security-threats-businesses-must-watch\";s:7:\"excerpt\";s:67:\"Businesses face increasing cyber threats as digital adoption grows.\";s:14:\"featured_image\";N;s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:42\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:310;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:4;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:9;s:4:\"uuid\";s:36:\"882556b6-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:10;s:9:\"author_id\";N;s:5:\"title\";s:44:\"Cyber Security Threats Businesses Must Watch\";s:4:\"slug\";s:44:\"cyber-security-threats-businesses-must-watch\";s:7:\"excerpt\";s:67:\"Businesses face increasing cyber threats as digital adoption grows.\";s:14:\"featured_image\";N;s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:42\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:310;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:4;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";N;s:8:\"category\";r:552;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:10;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:8;s:4:\"uuid\";s:36:\"882555d8-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:8;s:9:\"author_id\";N;s:5:\"title\";s:40:\"How Startups Can Scale Using SaaS Models\";s:4:\"slug\";s:40:\"how-startups-can-scale-using-saas-models\";s:7:\"excerpt\";s:78:\"SaaS business models help startups scale efficiently with predictable revenue.\";s:14:\"featured_image\";N;s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:42\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:245;s:12:\"reading_time\";i:4;s:13:\"comment_count\";i:1;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:8;s:4:\"uuid\";s:36:\"882555d8-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:8;s:9:\"author_id\";N;s:5:\"title\";s:40:\"How Startups Can Scale Using SaaS Models\";s:4:\"slug\";s:40:\"how-startups-can-scale-using-saas-models\";s:7:\"excerpt\";s:78:\"SaaS business models help startups scale efficiently with predictable revenue.\";s:14:\"featured_image\";N;s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:42\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:245;s:12:\"reading_time\";i:4;s:13:\"comment_count\";i:1;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";N;s:8:\"category\";r:762;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:11;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:7;s:4:\"uuid\";s:36:\"88255504-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:13;s:9:\"author_id\";N;s:5:\"title\";s:41:\"SEO Strategies That Actually Work in 2025\";s:4:\"slug\";s:41:\"seo-strategies-that-actually-work-in-2025\";s:7:\"excerpt\";s:74:\"Modern SEO focuses on search intent, content quality, and user experience.\";s:14:\"featured_image\";N;s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:42\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:290;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:2;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:7;s:4:\"uuid\";s:36:\"88255504-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:13;s:9:\"author_id\";N;s:5:\"title\";s:41:\"SEO Strategies That Actually Work in 2025\";s:4:\"slug\";s:41:\"seo-strategies-that-actually-work-in-2025\";s:7:\"excerpt\";s:74:\"Modern SEO focuses on search intent, content quality, and user experience.\";s:14:\"featured_image\";N;s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:42\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:290;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:2;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";N;s:8:\"category\";O:23:\"App\\Models\\BlogCategory\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"blog_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:13;s:4:\"name\";s:17:\"Digital Marketing\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:13;s:4:\"name\";s:17:\"Digital Marketing\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"uuid\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:4:\"icon\";i:4;s:5:\"image\";i:5;s:11:\"description\";i:6;s:10:\"meta_title\";i:7;s:16:\"meta_description\";i:8;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:12;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:6;s:4:\"uuid\";s:36:\"88255426-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:12;s:9:\"author_id\";N;s:5:\"title\";s:38:\"Telemedicine Transforming Patient Care\";s:4:\"slug\";s:38:\"telemedicine-transforming-patient-care\";s:7:\"excerpt\";s:90:\"Telemedicine is improving healthcare access through virtual consultations and remote care.\";s:14:\"featured_image\";N;s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:42\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:360;s:12:\"reading_time\";i:6;s:13:\"comment_count\";i:5;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:6;s:4:\"uuid\";s:36:\"88255426-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:12;s:9:\"author_id\";N;s:5:\"title\";s:38:\"Telemedicine Transforming Patient Care\";s:4:\"slug\";s:38:\"telemedicine-transforming-patient-care\";s:7:\"excerpt\";s:90:\"Telemedicine is improving healthcare access through virtual consultations and remote care.\";s:14:\"featured_image\";N;s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:42\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:360;s:12:\"reading_time\";i:6;s:13:\"comment_count\";i:5;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";N;s:8:\"category\";O:23:\"App\\Models\\BlogCategory\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"blog_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:12;s:4:\"name\";s:12:\"Telemedicine\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:12;s:4:\"name\";s:12:\"Telemedicine\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"uuid\";i:1;s:4:\"name\";i:2;s:4:\"slug\";i:3;s:4:\"icon\";i:4;s:5:\"image\";i:5;s:11:\"description\";i:6;s:10:\"meta_title\";i:7;s:16:\"meta_description\";i:8;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:13;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:5;s:4:\"uuid\";s:36:\"8825533d-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:9;s:9:\"author_id\";i:6;s:5:\"title\";s:54:\"Why Cloud Computing Is Essential for Modern Businesses\";s:4:\"slug\";s:54:\"why-cloud-computing-is-essential-for-modern-businesses\";s:7:\"excerpt\";s:105:\"<p>Cloud computing enables scalability, flexibility, and cost efficiency for businesses of all sizes.</p>\";s:14:\"featured_image\";s:97:\"blogs/8825533d-ee23-11f0-a0af-1860247b6ae0/1770039737_whatsapp-image-2026-01-17-at-110311-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:275;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:3;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:5;s:4:\"uuid\";s:36:\"8825533d-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:9;s:9:\"author_id\";i:6;s:5:\"title\";s:54:\"Why Cloud Computing Is Essential for Modern Businesses\";s:4:\"slug\";s:54:\"why-cloud-computing-is-essential-for-modern-businesses\";s:7:\"excerpt\";s:105:\"<p>Cloud computing enables scalability, flexibility, and cost efficiency for businesses of all sizes.</p>\";s:14:\"featured_image\";s:97:\"blogs/8825533d-ee23-11f0-a0af-1860247b6ae0/1770039737_whatsapp-image-2026-01-17-at-110311-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:00\";s:11:\"is_featured\";i:0;s:9:\"is_active\";i:1;s:5:\"views\";i:275;s:12:\"reading_time\";i:5;s:13:\"comment_count\";i:3;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";O:17:\"App\\Models\\Author\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"authors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:6;s:4:\"name\";s:12:\"Sneha Kapoor\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:6;s:4:\"name\";s:12:\"Sneha Kapoor\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:12:\"social_links\";s:5:\"array\";s:11:\"total_blogs\";s:7:\"integer\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:18:{i:0;s:4:\"uuid\";i:1;s:7:\"user_id\";i:2;s:4:\"name\";i:3;s:4:\"slug\";i:4;s:5:\"email\";i:5;s:5:\"phone\";i:6;s:13:\"profile_image\";i:7;s:11:\"cover_image\";i:8;s:3:\"bio\";i:9;s:11:\"designation\";i:10;s:7:\"company\";i:11;s:7:\"website\";i:12;s:12:\"social_links\";i:13;s:10:\"meta_title\";i:14;s:16:\"meta_description\";i:15;s:11:\"total_blogs\";i:16;s:11:\"is_featured\";i:17;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:8:\"category\";r:1182;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:14;O:15:\"App\\Models\\Blog\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"blogs\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:4;s:4:\"uuid\";s:36:\"8825524a-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:7;s:9:\"author_id\";i:10;s:5:\"title\";s:48:\"Artificial Intelligence in Everyday Applications\";s:4:\"slug\";s:48:\"artificial-intelligence-in-everyday-applications\";s:7:\"excerpt\";s:93:\"<p>Artificial intelligence is now part of everyday digital experiences across industries.</p>\";s:14:\"featured_image\";s:97:\"blogs/8825524a-ee23-11f0-a0af-1860247b6ae0/1770039697_whatsapp-image-2026-01-17-at-112134-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:00\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:400;s:12:\"reading_time\";i:7;s:13:\"comment_count\";i:6;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:4;s:4:\"uuid\";s:36:\"8825524a-ee23-11f0-a0af-1860247b6ae0\";s:11:\"category_id\";i:7;s:9:\"author_id\";i:10;s:5:\"title\";s:48:\"Artificial Intelligence in Everyday Applications\";s:4:\"slug\";s:48:\"artificial-intelligence-in-everyday-applications\";s:7:\"excerpt\";s:93:\"<p>Artificial intelligence is now part of everyday digital experiences across industries.</p>\";s:14:\"featured_image\";s:97:\"blogs/8825524a-ee23-11f0-a0af-1860247b6ae0/1770039697_whatsapp-image-2026-01-17-at-112134-pm.jpeg\";s:6:\"status\";s:9:\"published\";s:12:\"published_at\";s:19:\"2026-01-10 18:24:00\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:5:\"views\";i:400;s:12:\"reading_time\";i:7;s:13:\"comment_count\";i:6;s:10:\"created_at\";s:19:\"2026-01-10 18:24:42\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:8:{s:13:\"meta_keywords\";s:5:\"array\";s:12:\"published_at\";s:8:\"datetime\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:5:\"views\";s:7:\"integer\";s:12:\"reading_time\";s:7:\"integer\";s:13:\"comment_count\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:6:\"author\";O:17:\"App\\Models\\Author\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"authors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:2:\"id\";i:10;s:4:\"name\";s:10:\"Kavita Rao\";}s:11:\"\0*\0original\";a:2:{s:2:\"id\";i:10;s:4:\"name\";s:10:\"Kavita Rao\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:5:{s:12:\"social_links\";s:5:\"array\";s:11:\"total_blogs\";s:7:\"integer\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:18:{i:0;s:4:\"uuid\";i:1;s:7:\"user_id\";i:2;s:4:\"name\";i:3;s:4:\"slug\";i:4;s:5:\"email\";i:5;s:5:\"phone\";i:6;s:13:\"profile_image\";i:7;s:11:\"cover_image\";i:8;s:3:\"bio\";i:9;s:11:\"designation\";i:10;s:7:\"company\";i:11;s:7:\"website\";i:12;s:12:\"social_links\";i:13;s:10:\"meta_title\";i:14;s:16:\"meta_description\";i:15;s:11:\"total_blogs\";i:16;s:11:\"is_featured\";i:17;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}s:8:\"category\";r:1330;}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:20:{i:0;s:4:\"uuid\";i:1;s:11:\"category_id\";i:2;s:9:\"author_id\";i:3;s:5:\"title\";i:4;s:4:\"slug\";i:5;s:7:\"excerpt\";i:6;s:7:\"content\";i:7;s:14:\"featured_image\";i:8;s:8:\"og_image\";i:9;s:10:\"meta_title\";i:10;s:16:\"meta_description\";i:11;s:13:\"meta_keywords\";i:12;s:13:\"canonical_url\";i:13;s:6:\"status\";i:14;s:12:\"published_at\";i:15;s:11:\"is_featured\";i:16;s:9:\"is_active\";i:17;s:5:\"views\";i:18;s:12:\"reading_time\";i:19;s:13:\"comment_count\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:10:\"\0*\0perPage\";i:15;s:14:\"\0*\0currentPage\";i:1;s:7:\"\0*\0path\";s:33:\"http://127.0.0.1:8000/admin/blogs\";s:8:\"\0*\0query\";a:0:{}s:11:\"\0*\0fragment\";N;s:11:\"\0*\0pageName\";s:4:\"page\";s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:10:\"onEachSide\";i:3;s:10:\"\0*\0options\";a:2:{s:4:\"path\";s:33:\"http://127.0.0.1:8000/admin/blogs\";s:8:\"pageName\";s:4:\"page\";}s:8:\"\0*\0total\";i:18;s:11:\"\0*\0lastPage\";i:2;}', 1781156286, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `employment_type` enum('full-time','part-time','contract','internship','freelance') NOT NULL DEFAULT 'full-time',
  `experience_level` enum('fresher','junior','mid','senior','lead') NOT NULL DEFAULT 'mid',
  `location` varchar(255) DEFAULT NULL,
  `is_remote` tinyint(1) NOT NULL DEFAULT 0,
  `openings` int(11) NOT NULL DEFAULT 1,
  `salary_min` int(11) DEFAULT NULL,
  `salary_max` int(11) DEFAULT NULL,
  `salary_currency` varchar(10) NOT NULL DEFAULT 'INR',
  `description` longtext NOT NULL,
  `responsibilities` longtext DEFAULT NULL,
  `requirements` longtext DEFAULT NULL,
  `benefits` longtext DEFAULT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills`)),
  `apply_url` varchar(255) DEFAULT NULL,
  `apply_email` varchar(255) DEFAULT NULL,
  `application_deadline` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `total_applications` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `uuid`, `department_id`, `title`, `slug`, `employment_type`, `experience_level`, `location`, `is_remote`, `openings`, `salary_min`, `salary_max`, `salary_currency`, `description`, `responsibilities`, `requirements`, `benefits`, `skills`, `apply_url`, `apply_email`, `application_deadline`, `meta_title`, `meta_description`, `is_active`, `display_order`, `is_featured`, `total_applications`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '33c5232d-5009-4fed-b29c-b3cc811ce24d', 2, 'Hr Manager1', 'hr-manager1', 'full-time', 'lead', 'ludhiana', 1, 1, 30000, 35000, 'INR', 'asdfadsf', 'asdfdfadasfad', 'asdfadf', 'asdfadsf', '[\"english\",\"graduation\",\"abc\"]', 'http://deovate.my-style.in', 'abhiii2404@gmail.com', '2026-02-20 18:30:00', 'asdfadfaadsf', 'asdfadfasd', 1, 0, 1, 0, '2026-06-09 00:18:23', '2026-02-17 11:32:40', '2026-07-17 06:28:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `career_applications`
--

CREATE TABLE `career_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `career_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `resume_id` bigint(20) UNSIGNED DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `cover_letter` text DEFAULT NULL,
  `portfolio_url` varchar(255) DEFAULT NULL,
  `current_company` varchar(255) DEFAULT NULL,
  `current_ctc` int(11) DEFAULT NULL,
  `expected_ctc` int(11) DEFAULT NULL,
  `notice_period` int(11) DEFAULT NULL,
  `status` enum('new','shortlisted','interview','offered','hired','rejected') NOT NULL DEFAULT 'new',
  `source` varchar(255) DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `career_applications`
--

INSERT INTO `career_applications` (`id`, `uuid`, `career_id`, `department_id`, `resume_id`, `full_name`, `email`, `phone`, `cover_letter`, `portfolio_url`, `current_company`, `current_ctc`, `expected_ctc`, `notice_period`, `status`, `source`, `admin_notes`, `ip_address`, `user_agent`, `applied_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '7b5f6a86-1525-11f1-8033-544810ce699a', 1, 1, NULL, 'Abhishek Kumar Singh', 'abhiii2404@gmail.com', '7301005510', 'I am applying for this position as I believe my skills and experience align well with your requirements.', NULL, 'Freelancer', 450000, 600000, 30, 'rejected', 'website', NULL, '192.168.1.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120.0.0.0 Safari/537.36', '2026-03-01 04:16:55', '2026-03-01 04:16:55', '2026-06-08 01:35:44', NULL),
(2, '652b0e5a-1525-11f1-8033-544810ce699a', 1, 1, NULL, 'Anky Singh Humraj', 'ankysinghhumraj1@gmail.com', '9431405900', 'I am interested in this opportunity and eager to contribute my skills to your organization.', NULL, 'ABC Services Pvt Ltd', 380000, 500000, 15, 'hired', 'referral', NULL, '192.168.1.11', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 Chrome/120.0.0.0 Safari/537.36', '2026-03-01 04:16:18', '2026-03-01 04:16:18', '2026-03-03 13:39:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `case_studies`
--

CREATE TABLE `case_studies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `case_study_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `project_duration` varchar(255) DEFAULT NULL,
  `project_budget` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `featured_image_alt` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `banner_image_alt` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `video_url` varchar(255) DEFAULT NULL,
  `overview` longtext DEFAULT NULL,
  `challenges` longtext DEFAULT NULL,
  `solutions` longtext DEFAULT NULL,
  `results` longtext DEFAULT NULL,
  `testimonial` longtext DEFAULT NULL,
  `key_metrics` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`key_metrics`)),
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_keywords`)),
  `canonical_url` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_studies`
--

INSERT INTO `case_studies` (`id`, `uuid`, `case_study_category_id`, `title`, `slug`, `client_name`, `industry`, `project_duration`, `project_budget`, `featured_image`, `featured_image_alt`, `banner_image`, `banner_image_alt`, `gallery`, `video_url`, `overview`, `challenges`, `solutions`, `results`, `testimonial`, `key_metrics`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `is_featured`, `is_active`, `display_order`, `views`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, '1021f20a-051d-46e6-b0d5-f9f6c24c884f', 21, 'Rebuilding a High-Bounce Corporate Website Into a Lead-Generating Asset', 'rebuilding-a-high-bounce-corporate-website-into-a-lead-generating-asset', 'Meridian Consulting Group', 'Legal & Professional Services', '8 Weeks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Meridian Consulting Group had a website that looked professional but was quietly failing at its one real job, turning visitors into consultation requests. Despite steady traffic from referrals and search, the contact form was converting at less than one percent, and the firm had no clear sense of why.', 'The homepage led with company history instead of the specific problems Meridian solved for clients. Navigation buried the contact page three clicks deep. Mobile load time exceeded six seconds, and the site had no clear next step for a visitor ready to reach out.', 'We rebuilt the site around visitor intent, rewriting the homepage to lead with specific client outcomes, restructuring navigation so booking a consultation took one click from any page, and rebuilding the front end for speed. A single, consistent call to action replaced five competing links across the site.', 'Within eight weeks of launch, consultation requests increased significantly, mobile load time dropped under two seconds, and the firm reported the clearest month-over-month lead visibility it had ever had from its website.', '\"We knew our website looked fine, we just did not realize how much it was actually costing us in missed inquiries. Within the first month after launch, we were fielding more qualified consultation requests than we had in the previous quarter.\" — Managing Partner, Meridian Consulting Group', '[\"3.2x increase in consultation form submissions\",\"Mobile load time cut from 6.1s to 1.8s\",\"Bounce rate reduced by 41%\",\"Zero downtime during migration\"]', 'Rebuilding a High-Bounce Corporate Website Into a Lead-Generating Asset | Deovate Case Study', 'How a focused website rebuild helped a professional services firm turn a high-bounce site into a genuine lead-generation asset.', '[\"website redesign case study\",\"law firm web design\",\"lead generation website\"]', NULL, 1, 1, 1, 503, '2026-05-16 05:56:18', '2026-07-21 05:56:18', '2026-07-21 05:56:18', NULL),
(22, '033d6cba-998a-45bb-b0f9-53df4588ad8e', 21, 'A Healthcare Website Redesign That Cut Appointment Booking Drop-Off in Half', 'a-healthcare-website-redesign-that-cut-appointment-booking-drop-off-in-half', 'CarePlus Medical Group', 'Healthcare & Medical Services', '10 Weeks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CarePlus Medical Group operates several clinics and relied heavily on its website for new patient bookings. The existing appointment flow required patients to fill a long form, then wait for a phone callback to confirm a time, and a large share of visitors dropped off before completing that first step.', 'The booking form asked for information most patients did not have ready, insurance details, referring physician, before showing any available time slots. There was no mobile-optimized version of the booking flow, and patients had no way to see real-time availability.', 'We redesigned the booking flow to show available appointment times first, moving detailed intake information to a shorter follow-up step after a slot was reserved. The entire flow was rebuilt mobile-first, since most bookings happened on phones, and we added clear trust signals, physician credentials and patient review snippets, near the booking widget.', 'Appointment booking completion improved dramatically within the first two months of launch, and clinic staff reported a noticeable drop in incomplete booking follow-up calls, freeing front-desk time for other patient needs.', '\"Patients were abandoning our old booking form constantly, and our staff spent hours every week chasing incomplete requests. The new flow just works the way patients actually expect it to.\" — Practice Administrator, CarePlus Medical Group', '[\"52% reduction in booking form drop-off\",\"Mobile bookings increased by 68%\",\"35% fewer incomplete-booking follow-up calls\",\"Average booking completion time cut to under 90 seconds\"]', 'A Healthcare Website Redesign That Cut Appointment Booking Drop-Off in Half | Deovate Case Study', 'How a mobile-first appointment booking redesign helped a healthcare group cut booking drop-off by more than half.', '[\"healthcare website redesign\",\"appointment booking UX\",\"medical website case study\"]', NULL, 0, 1, 2, 409, '2026-05-28 05:56:18', '2026-07-21 05:56:18', '2026-07-21 05:56:18', NULL),
(23, '22840609-c135-4f6c-9a61-9d1f3388459d', 22, 'Replacing Three Disconnected Spreadsheets With One Custom ERP', 'replacing-three-disconnected-spreadsheets-with-one-custom-erp', 'Horizon Manufacturing Co.', 'Manufacturing', '16 Weeks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Horizon Manufacturing was running inventory, production scheduling, and procurement across three separate spreadsheets maintained by three different teams, none of which reliably matched each other. Monthly reconciliation alone was consuming days of staff time every cycle.', 'Inventory counts were frequently wrong because updates in one spreadsheet never reached the other two in real time. Production planning was based on stock numbers that were often a full day out of date, leading to material shortages mid-run and costly rush orders.', 'We built a custom ERP system centralizing inventory, production scheduling, and procurement into one shared source of truth, with role-based access so each team saw exactly what they needed. Real-time stock updates replaced end-of-day manual entry, and automated low-stock alerts replaced guesswork-based reordering.', 'Within the first full quarter on the new system, Horizon eliminated the monthly reconciliation process entirely, cut material shortage incidents substantially, and gave leadership real-time visibility into production status for the first time.', '\"We used to spend the first three days of every month just figuring out whose numbers were right. That process does not exist anymore, everyone is looking at the same real-time data now.\" — Operations Director, Horizon Manufacturing Co.', '[\"100% elimination of monthly manual reconciliation\",\"61% reduction in material shortage incidents\",\"Real-time inventory visibility across 3 teams\",\"Procurement lead time cut by 9 days on average\"]', 'Replacing Three Disconnected Spreadsheets With One Custom ERP | Deovate Case Study', 'How a custom-built ERP system replaced disconnected spreadsheets and gave a manufacturing business real-time operational visibility.', '[\"custom ERP case study\",\"manufacturing software\",\"inventory management system\"]', NULL, 1, 1, 1, 577, '2026-01-03 05:56:18', '2026-07-21 05:56:18', '2026-07-21 05:56:18', NULL),
(24, 'd6eab0bb-1c38-452c-857a-c10a461440b8', 22, 'A Custom CRM That Finally Got the Sales Team to Stop Losing Leads', 'a-custom-crm-that-finally-got-the-sales-team-to-stop-losing-leads', 'Blueprint Realty Partners', 'Real Estate', '12 Weeks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Blueprint Realty Partners had a growing team of agents tracking leads individually, some in notebooks, some in personal spreadsheets, with no shared visibility into pipeline status. Leads were being followed up inconsistently, and some were simply falling through entirely.', 'Management could not answer basic questions, how many active leads existed, what stage each deal was in, without individually checking with every agent. Follow-ups depended entirely on individual agent memory and discipline, with no system-level reminders.', 'We built a custom CRM shaped specifically around Blueprint\'s actual sales process, from initial inquiry through closing, with automated follow-up reminders and a shared pipeline dashboard visible to management in real time. Lead assignment and handoff between agents became a tracked, auditable process instead of an informal one.', 'Within the first quarter, missed follow-ups dropped sharply, and management gained real-time pipeline visibility that directly informed staffing and marketing spend decisions for the first time.', '\"I used to have no real idea how many active leads we had at any given moment. Now I can see the entire pipeline in real time, and our agents are following up faster because the system actually reminds them.\" — Managing Broker, Blueprint Realty Partners', '[\"44% reduction in missed lead follow-ups\",\"Full real-time pipeline visibility for management\",\"Average lead response time cut from 18 hours to 3 hours\",\"22% increase in lead-to-close conversion\"]', 'A Custom CRM That Finally Got the Sales Team to Stop Losing Leads | Deovate Case Study', 'How a custom CRM built around a real estate team\'s actual sales process reduced missed follow-ups and improved conversion.', '[\"custom CRM case study\",\"real estate software\",\"sales pipeline management\"]', NULL, 0, 1, 2, 860, '2025-10-03 05:56:18', '2026-07-21 05:56:18', '2026-07-21 05:56:18', NULL),
(25, '29e03dbf-6943-4b4c-bd30-7934ddff6a27', 23, 'Cutting Cart Abandonment by Rebuilding Checkout From Scratch', 'cutting-cart-abandonment-by-rebuilding-checkout-from-scratch', 'Lumen & Co.', 'Fashion & Lifestyle Brands', '9 Weeks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lumen & Co. was running a visually strong fashion store with healthy traffic, but a cart abandonment rate well above industry benchmarks. Customers were adding items to their cart consistently but leaving before completing payment at a rate the brand could not explain internally.', 'Checkout required account creation before purchase, shipping costs were revealed only on the final step, and the process spanned five separate pages. Mobile checkout, which accounted for most of Lumen\'s traffic, was noticeably slower and harder to complete than desktop.', 'We rebuilt checkout as a streamlined two-step flow with guest checkout enabled by default, shipping costs shown clearly before the final step, and a mobile-first redesign tested specifically on real mid-range devices rather than only newer phones. Trust badges were placed directly next to the payment field rather than buried elsewhere on the site.', 'Cart abandonment dropped meaningfully within the first month post-launch, with the largest improvement coming specifically from mobile checkout completions, previously the store\'s weakest conversion segment.', '\"We knew people were adding to cart and leaving, we just did not know exactly why until the audit. The new checkout paid for itself within the first few weeks.\" — Founder, Lumen & Co.', '[\"37% reduction in cart abandonment\",\"Mobile checkout completion up 58%\",\"Checkout steps reduced from 5 to 2\",\"Average order value increased 12%\"]', 'Cutting Cart Abandonment by Rebuilding Checkout From Scratch | Deovate Case Study', 'How a full checkout rebuild helped a fashion eCommerce brand cut cart abandonment and lift mobile conversion.', '[\"ecommerce checkout redesign\",\"cart abandonment case study\",\"shopify conversion optimization\"]', NULL, 1, 1, 1, 441, '2025-12-15 05:56:18', '2026-07-21 05:56:18', '2026-07-21 05:56:18', NULL),
(26, 'fa7377de-b6e4-489d-9fa5-cbbd5ca0ba29', 23, 'Scaling a Regional Store Into a Multi-Vendor Marketplace', 'scaling-a-regional-store-into-a-multi-vendor-marketplace', 'Freshmart Grocers', 'Retail & eCommerce', '14 Weeks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Freshmart Grocers ran a single-vendor online grocery store and wanted to expand into a marketplace model, allowing local suppliers and specialty vendors to sell through the same platform without each needing their own separate store.', 'The existing store architecture had no concept of multiple vendors, separate inventories, individual payouts, or vendor-specific order management, all of which needed to be built without disrupting the existing single-vendor operations already generating daily revenue.', 'We built a multi-vendor marketplace layer on top of the existing store, giving each vendor an independent dashboard for inventory and orders while keeping a unified customer-facing storefront and checkout. Commission handling and automated payout calculations were built in from the start rather than managed manually.', 'Freshmart onboarded its first group of local vendors within a month of launch, with the platform handling multi-vendor orders and payouts automatically, something that would have required significant manual coordination on the previous system.', '\"Adding new vendors used to feel like a project every single time. Now it is a self-service process, and our catalog has grown faster in three months than it did in the previous year.\" — Operations Manager, Freshmart Grocers', '[\"3x product catalog growth within 90 days\",\"12 local vendors onboarded in first month\",\"Automated vendor payouts, zero manual processing\",\"Order volume increased 47% quarter over quarter\"]', 'Scaling a Regional Store Into a Multi-Vendor Marketplace | Deovate Case Study', 'How a single-vendor grocery store was rebuilt into a multi-vendor marketplace without disrupting existing operations.', '[\"multi vendor marketplace case study\",\"ecommerce scaling\",\"grocery ecommerce platform\"]', NULL, 0, 1, 2, 1323, '2026-06-19 05:56:19', '2026-07-21 05:56:19', '2026-07-21 05:56:19', NULL),
(27, '688073bd-8d4c-4b89-81b5-a8aae00960e0', 24, 'Tripling Organic Traffic for a B2B SaaS Company in Eight Months', 'tripling-organic-traffic-for-a-b2b-saas-company-in-eight-months', 'Northbridge Software Solutions', 'SaaS & Technology', '8 Months', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Northbridge Software Solutions had a technically solid product but almost no organic search visibility, relying entirely on paid ads and outbound sales for new leads. Their existing blog published inconsistently and rarely targeted terms their actual buyers searched for.', 'Existing content was written around generic industry topics rather than the specific questions Northbridge\'s buyers were actually asking. Technical SEO issues, slow page speed, missing structured data, were suppressing whatever organic visibility the site did have.', 'We rebuilt the technical SEO foundation first, fixing site speed and structured data, then developed a content strategy built around genuine buyer search intent, replacing generic posts with deep, specific resources addressing real evaluation questions. A consistent publishing and internal linking cadence replaced the previous sporadic approach.', 'Organic traffic grew steadily month over month, eventually tripling from the starting baseline, with a meaningful share of new trial signups now attributing organic search as their discovery channel for the first time in the company\'s history.', '\"We had basically written off organic search as a channel before this. Eight months later it is one of our most consistent sources of qualified trial signups.\" — Head of Marketing, Northbridge Software Solutions', '[\"3.1x increase in organic traffic\",\"68% growth in organic-attributed trial signups\",\"Average keyword ranking position improved by 14 spots\",\"22 pages ranking in top 10 search results\"]', 'Tripling Organic Traffic for a B2B SaaS Company in Eight Months | Deovate Case Study', 'How a structured technical and content SEO strategy tripled organic traffic for a B2B SaaS company in eight months.', '[\"SEO case study\",\"B2B SaaS SEO\",\"organic traffic growth\"]', NULL, 1, 1, 1, 188, '2025-12-26 05:56:19', '2026-07-21 05:56:19', '2026-07-21 05:56:19', NULL),
(28, '5b7c2b38-b9ac-4404-8a77-2d72147303b7', 24, 'A Local SEO Turnaround That Filled an Empty Appointment Calendar', 'a-local-seo-turnaround-that-filled-an-empty-appointment-calendar', 'Willow Dental Care', 'Healthcare & Medical Services', '6 Months', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Willow Dental Care had a strong reputation locally but almost no presence in local search results, losing potential patients to competing practices who simply showed up first on Google Maps and local search results.', 'Willow\'s Google Business Profile was incomplete and inconsistently updated, business information was listed differently across various directories, and the practice had fewer than ten reviews despite years of satisfied patients who had simply never been asked.', 'We fully optimized and completed Willow\'s Google Business Profile, corrected inconsistent business information across every directory listing, and implemented a simple, systematic review request process triggered after positive patient visits. Location-specific service pages replaced a single generic services page.', 'Local map pack visibility improved substantially within the first three months, and the practice\'s appointment calendar, previously with significant weekly openings, was consistently near capacity by the end of the engagement.', '\"We had no idea how much business we were losing simply from not showing up in local search. Our new patient bookings from Google alone have completely changed how full our schedule is.\" — Practice Owner, Willow Dental Care', '[\"4.2x increase in Google Business Profile views\",\"Review count grew from 9 to 87\",\"Local map pack ranking reached top 3 for core search terms\",\"New patient bookings from search up 76%\"]', 'A Local SEO Turnaround That Filled an Empty Appointment Calendar | Deovate Case Study', 'How a systematic local SEO strategy helped a dental practice dramatically improve local visibility and fill its appointment calendar.', '[\"local SEO case study\",\"dental practice marketing\",\"google business profile optimization\"]', NULL, 0, 1, 2, 236, '2026-05-13 05:56:19', '2026-07-21 05:56:19', '2026-07-21 05:56:19', NULL),
(29, '37279579-18c6-4c33-b00d-6f70d4ef6947', 25, 'Migrating a Legacy Booking Platform to AWS Without a Single Hour of Downtime', 'migrating-a-legacy-booking-platform-to-aws-without-a-single-hour-of-downtime', 'Skyline Travel Group', 'Travel & Tourism', '10 Weeks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Skyline Travel Group\'s booking platform was running on aging, on-premise infrastructure that had become a genuine operational risk, with no real disaster recovery plan and increasingly frequent performance issues during high-traffic booking periods.', 'The platform had accumulated years of undocumented dependencies, and any migration risked breaking integrations nobody fully remembered configuring. Skyline could not tolerate any meaningful downtime during the move, since bookings happened around the clock across time zones.', 'We conducted a full dependency audit before touching anything, then migrated to AWS in controlled stages, moving non-critical components first and validating each stage before proceeding. The critical booking system itself was cut over during a carefully planned low-traffic window with the old environment kept live as an immediate rollback option.', 'The migration completed with zero unplanned downtime, and Skyline saw an immediate, measurable improvement in platform stability and page load speed during subsequent high-traffic booking periods.', '\"We were genuinely nervous about this migration given how much depended on the old system quietly working. It went so smoothly that our support team did not receive a single downtime-related ticket.\" — Chief Technology Officer, Skyline Travel Group', '[\"Zero unplanned downtime during migration\",\"Page load speed improved by 63%\",\"99.98% uptime in the six months post-migration\",\"Infrastructure costs reduced by 28%\"]', 'Migrating a Legacy Booking Platform to AWS Without a Single Hour of Downtime | Deovate Case Study', 'How a legacy travel booking platform was migrated to AWS in stages with zero unplanned downtime.', '[\"AWS migration case study\",\"cloud migration\",\"zero downtime deployment\"]', NULL, 0, 1, 1, 317, '2025-10-13 05:56:19', '2026-07-21 05:56:19', '2026-07-21 05:56:19', NULL),
(30, '6f02b587-990f-4ce2-bc08-9aa9ba6c3120', 25, 'Cutting Server Costs by 40% While Improving Uptime for a Logistics Platform', 'cutting-server-costs-by-40-while-improving-uptime-for-a-logistics-platform', 'RouteWise Logistics', 'Logistics & Transportation', '7 Weeks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RouteWise Logistics was running its shipment tracking platform on significantly over-provisioned infrastructure, paying for far more server capacity than actual usage required, while still experiencing occasional slowdowns during peak shipment volume periods.', 'Infrastructure had been sized based on rough early estimates years earlier and never revisited as usage patterns became clearer. Peak load and average load were dramatically different, but the infrastructure was static rather than scaling with actual demand.', 'We right-sized the core infrastructure based on actual usage data, then implemented auto-scaling so capacity expanded automatically during genuine peak periods rather than running at peak-capacity cost around the clock. Monitoring and alerting were added to catch performance issues before they affected users.', 'RouteWise saw a substantial reduction in monthly infrastructure costs while simultaneously improving uptime during peak shipment periods, resolving the exact problem the original over-provisioned setup had failed to prevent.', '\"We were paying a lot every month for infrastructure that still slowed down exactly when we needed it most. The new setup costs less and has not had a single peak-period slowdown since launch.\" — VP of Engineering, RouteWise Logistics', '[\"40% reduction in monthly infrastructure cost\",\"99.95% uptime during peak shipment periods\",\"Auto-scaling handles 3x traffic spikes automatically\",\"Average response time improved by 34%\"]', 'Cutting Server Costs by 40% While Improving Uptime for a Logistics Platform | Deovate Case Study', 'How right-sizing infrastructure and adding auto-scaling cut costs by 40% while improving uptime for a logistics platform.', '[\"cloud cost optimization case study\",\"devops logistics\",\"infrastructure auto scaling\"]', NULL, 0, 1, 2, 1277, '2025-12-30 05:56:19', '2026-07-21 05:56:19', '2026-07-21 05:56:19', NULL),
(31, '21f743f1-44dc-4876-9e41-9a6ec746465f', 26, 'A Complete Brand Identity That Finally Matched the Quality of the Product', 'a-complete-brand-identity-that-finally-matched-the-quality-of-the-product', 'Verdant Learning Co.', 'Education & EdTech', '6 Weeks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Verdant Learning Co. had built a genuinely strong online learning product, but its visual identity had been assembled piecemeal over several years, inconsistent logo files, mismatched colors across platforms, and marketing materials that looked like they came from different companies.', 'The inconsistent branding was quietly undermining trust with prospective institutional clients evaluating Verdant against more established, visually polished competitors, despite Verdant\'s product being genuinely comparable or better.', 'We audited every existing brand touchpoint, then built a complete, locked identity system, refined logo, defined color and typography rules, and a clear usage guideline document, and rolled it out consistently across the website, marketing materials, and sales collateral.', 'Verdant reported a noticeably more confident reception in institutional sales conversations following the rebrand, with several prospective clients specifically commenting on the more professional, cohesive presentation compared to previous pitches.', '\"Our product was always strong, but our branding was quietly working against us in every enterprise pitch. The difference in how prospects react to our materials now is genuinely noticeable.\" — Co-Founder, Verdant Learning Co.', '[\"Complete brand system deployed across 100% of touchpoints\",\"Sales deck engagement time increased 45%\",\"Consistent identity across 12+ marketing assets\",\"Institutional client meeting requests up 30% post-rebrand\"]', 'A Complete Brand Identity That Finally Matched the Quality of the Product | Deovate Case Study', 'How a complete brand identity overhaul helped an EdTech company present itself with the credibility its product deserved.', '[\"brand identity case study\",\"edtech branding\",\"rebrand success story\"]', NULL, 0, 1, 1, 205, '2026-01-13 05:56:19', '2026-07-21 05:56:19', '2026-07-21 05:56:19', NULL),
(32, '477b61eb-2418-4d0b-a8e6-a1211f1f6a1c', 26, 'Redesigning a Confusing FinTech App Into One Users Actually Trust', 'redesigning-a-confusing-fintech-app-into-one-users-actually-trust', 'PayNest Financial', 'FinTech & Digital Payments', '10 Weeks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PayNest Financial\'s app handled real money for its users but had a confusing, cluttered interface that was generating a steady stream of support tickets from users unsure whether transactions had actually completed successfully.', 'Key actions, sending money, checking balances, viewing transaction history, were buried across inconsistent navigation patterns. Critical confirmation states were visually unclear, leaving users uncertain and anxious about whether a transaction had genuinely gone through.', 'We redesigned the core user flows around clarity and confidence, particularly transaction confirmation states, which now use unambiguous visual and text confirmation at every critical step. Navigation was simplified around the handful of actions users actually performed most often, removing rarely used options from primary view.', 'Support tickets related to transaction confusion dropped sharply within the first month post-launch, and user session recordings showed noticeably less hesitation and backtracking during core money-movement flows.', '\"Our support team used to spend a huge share of their time just reassuring users that a payment had actually gone through. That entire category of ticket has nearly disappeared since the redesign.\" — Head of Product, PayNest Financial', '[\"58% reduction in transaction-confusion support tickets\",\"Core flow completion time reduced by 39%\",\"App store rating improved from 3.4 to 4.6\",\"User-reported task success rate up to 94%\"]', 'Redesigning a Confusing FinTech App Into One Users Actually Trust | Deovate Case Study', 'How a UX redesign focused on clarity and trust reduced support tickets and improved ratings for a FinTech app.', '[\"fintech UX redesign case study\",\"app UI redesign\",\"financial app user experience\"]', NULL, 0, 1, 2, 1725, '2026-07-06 05:56:19', '2026-07-21 05:56:19', '2026-07-21 05:56:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `case_study_categories`
--

CREATE TABLE `case_study_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_study_categories`
--

INSERT INTO `case_study_categories` (`id`, `uuid`, `name`, `slug`, `description`, `icon`, `image`, `image_alt`, `meta_title`, `meta_description`, `is_active`, `is_featured`, `display_order`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 'abf8f4c8-98bf-4e81-ba69-43c383fa57f0', 'Web Design & Development', 'web-design-development', 'Real website rebuilds that turned confusing, underperforming sites into fast, trustworthy experiences that actually convert visitors.', 'bx bx-code-alt', NULL, NULL, 'Web Design & Development Case Studies | Deovate', 'Real website rebuilds that turned confusing, underperforming sites into fast, trustworthy experiences that actually convert visitors.', 1, 1, 1, 0, '2026-07-21 05:56:18', '2026-07-21 05:56:18', NULL),
(22, 'f1fe8df2-d821-4a57-9a2d-258ca4b168f4', 'Custom Software & Business Systems', 'custom-software-business-systems', 'Custom ERP, CRM, and internal tools built to replace the spreadsheets and workarounds slowing growing businesses down.', 'bx bx-desktop', NULL, NULL, 'Custom Software & Business Systems Case Studies | Deovate', 'Custom ERP, CRM, and internal tools built to replace the spreadsheets and workarounds slowing growing businesses down.', 1, 1, 2, 0, '2026-07-21 05:56:18', '2026-07-21 05:56:18', NULL),
(23, '2259f066-6ea0-4d7d-99e0-d335e46f9de9', 'eCommerce & Online Retail', 'ecommerce-online-retail', 'Store rebuilds and checkout redesigns focused on one outcome, turning more browsers into completed, paid orders.', 'bx bx-cart', NULL, NULL, 'eCommerce & Online Retail Case Studies | Deovate', 'Store rebuilds and checkout redesigns focused on one outcome, turning more browsers into completed, paid orders.', 1, 1, 3, 0, '2026-07-21 05:56:18', '2026-07-21 05:56:18', NULL),
(24, 'bec82eba-c77e-49bc-8e16-993885259907', 'Digital Marketing & SEO', 'digital-marketing-seo', 'Organic and paid growth strategies that delivered measurable traffic, leads, and revenue, not just vanity ranking improvements.', 'bx bx-trending-up', NULL, NULL, 'Digital Marketing & SEO Case Studies | Deovate', 'Organic and paid growth strategies that delivered measurable traffic, leads, and revenue, not just vanity ranking improvements.', 1, 1, 4, 0, '2026-07-21 05:56:19', '2026-07-21 05:56:19', NULL),
(25, '6cef3143-fd58-45c1-9f7b-5b1a441d95ed', 'Cloud & DevOps', 'cloud-devops', 'Infrastructure migrations and deployment overhauls built around one standard: reliability that customers never have to think about.', 'bx bx-cloud', NULL, NULL, 'Cloud & DevOps Case Studies | Deovate', 'Infrastructure migrations and deployment overhauls built around one standard: reliability that customers never have to think about.', 1, 0, 5, 0, '2026-07-21 05:56:19', '2026-07-21 05:56:19', NULL),
(26, '8c3f0ff0-8b31-42b6-96b0-c0fb72bdc986', 'Branding & UI/UX', 'branding-uiux', 'Identity and interface redesigns that helped growing businesses finally look and feel as trustworthy as the product they had already built.', 'bx bx-palette', NULL, NULL, 'Branding & UI/UX Case Studies | Deovate', 'Identity and interface redesigns that helped growing businesses finally look and feel as trustworthy as the product they had already built.', 1, 0, 6, 0, '2026-07-21 05:56:19', '2026-07-21 05:56:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `comment` longtext NOT NULL,
  `status` enum('pending','approved','rejected','spam') NOT NULL DEFAULT 'pending',
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `is_reported` tinyint(1) NOT NULL DEFAULT 0,
  `likes` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `dislikes` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_clients`
--

CREATE TABLE `crm_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `client_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `contact_person_name` varchar(255) DEFAULT NULL,
  `contact_person_email` varchar(255) DEFAULT NULL,
  `contact_person_phone` varchar(255) DEFAULT NULL,
  `contact_person_designation` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `company_size` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `registration_number` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `credit_limit` decimal(15,2) DEFAULT NULL,
  `outstanding_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `lifetime_value` decimal(15,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `payment_terms` int(11) DEFAULT NULL,
  `lead_id` bigint(20) UNSIGNED DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','blocked') NOT NULL DEFAULT 'active',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_priority` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `notes` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `account_manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `onboarded_at` timestamp NULL DEFAULT NULL,
  `last_contacted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_client_contacts`
--

CREATE TABLE `crm_client_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `allow_email` tinyint(1) NOT NULL DEFAULT 1,
  `allow_sms` tinyint(1) NOT NULL DEFAULT 1,
  `allow_whatsapp` tinyint(1) NOT NULL DEFAULT 0,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `notes` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_client_documents`
--

CREATE TABLE `crm_client_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `document_type` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_extension` varchar(20) DEFAULT NULL,
  `file_size` bigint(20) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `is_confidential` tinyint(1) NOT NULL DEFAULT 0,
  `is_signed` tinyint(1) NOT NULL DEFAULT 0,
  `signed_at` timestamp NULL DEFAULT NULL,
  `version` int(11) NOT NULL DEFAULT 1,
  `parent_document_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `uploaded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `uploaded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_client_notes`
--

CREATE TABLE `crm_client_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text NOT NULL,
  `note_type` varchar(255) DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT 1,
  `is_pinned` tinyint(1) NOT NULL DEFAULT 0,
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `requires_follow_up` tinyint(1) NOT NULL DEFAULT 0,
  `follow_up_at` timestamp NULL DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_deals`
--

CREATE TABLE `crm_deals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `deal_code` varchar(255) DEFAULT NULL,
  `deal_value` decimal(15,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `status` enum('open','negotiation','won','lost') NOT NULL DEFAULT 'open',
  `probability` int(11) DEFAULT NULL,
  `expected_close_date` date DEFAULT NULL,
  `closed_at` date DEFAULT NULL,
  `lost_reason` text DEFAULT NULL,
  `is_forecast` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `notes` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_expenses`
--

CREATE TABLE `crm_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `paid_by` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `tax_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(15,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `expense_date` date DEFAULT NULL,
  `status` enum('draft','submitted','approved','rejected','paid') NOT NULL DEFAULT 'draft',
  `receipt_path` varchar(255) DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_expense_categories`
--

CREATE TABLE `crm_expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_invoices`
--

CREATE TABLE `crm_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `sub_total` decimal(15,2) NOT NULL,
  `tax_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(15,2) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `status` enum('draft','sent','unpaid','partially_paid','paid','overdue','cancelled') NOT NULL DEFAULT 'draft',
  `paid_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `due_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `is_sent` tinyint(1) NOT NULL DEFAULT 0,
  `is_overdue` tinyint(1) NOT NULL DEFAULT 0,
  `pdf_path` varchar(255) DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_invoice_items`
--

CREATE TABLE `crm_invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `item_type` varchar(255) DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT 1.00,
  `unit_price` decimal(15,2) NOT NULL,
  `sub_total` decimal(15,2) NOT NULL,
  `tax_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `tax_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(15,2) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_leads`
--

CREATE TABLE `crm_leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `estimated_value` decimal(15,2) DEFAULT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `probability` int(11) DEFAULT NULL,
  `expected_close_date` date DEFAULT NULL,
  `last_contacted_at` timestamp NULL DEFAULT NULL,
  `next_follow_up_at` timestamp NULL DEFAULT NULL,
  `follow_up_count` int(11) NOT NULL DEFAULT 0,
  `is_converted` tinyint(1) NOT NULL DEFAULT 0,
  `converted_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `is_hot` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_lead_activities`
--

CREATE TABLE `crm_lead_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `activity_type` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `activity_at` timestamp NULL DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `outcome` varchar(255) DEFAULT NULL,
  `requires_follow_up` tinyint(1) NOT NULL DEFAULT 0,
  `next_follow_up_at` timestamp NULL DEFAULT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_lead_sources`
--

CREATE TABLE `crm_lead_sources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `medium` varchar(255) DEFAULT NULL,
  `campaign` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `cost` decimal(15,2) DEFAULT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `display_order` int(11) NOT NULL DEFAULT 0,
  `leads_count` int(11) NOT NULL DEFAULT 0,
  `conversions_count` int(11) NOT NULL DEFAULT 0,
  `color` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_lead_statuses`
--

CREATE TABLE `crm_lead_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_final` tinyint(1) NOT NULL DEFAULT 0,
  `is_won` tinyint(1) NOT NULL DEFAULT 0,
  `is_lost` tinyint(1) NOT NULL DEFAULT 0,
  `requires_follow_up` tinyint(1) NOT NULL DEFAULT 0,
  `auto_follow_up_days` int(11) DEFAULT NULL,
  `auto_archive` tinyint(1) NOT NULL DEFAULT 0,
  `counts_as_conversion` tinyint(1) NOT NULL DEFAULT 0,
  `counts_in_pipeline` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_payments`
--

CREATE TABLE `crm_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `received_by` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `payment_type` enum('advance','partial','full','refund') NOT NULL DEFAULT 'full',
  `transaction_id` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `gateway` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `status` enum('pending','success','failed','cancelled') NOT NULL DEFAULT 'success',
  `paid_at` date DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_payment_methods`
--

CREATE TABLE `crm_payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `upi_id` varchar(255) DEFAULT NULL,
  `config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`config`)),
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_projects`
--

CREATE TABLE `crm_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `project_code` varchar(255) DEFAULT NULL,
  `type` enum('fixed','hourly','retainer','milestone') NOT NULL DEFAULT 'fixed',
  `status` enum('pending','active','on-hold','completed','cancelled') NOT NULL DEFAULT 'pending',
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `estimated_hours` int(11) DEFAULT NULL,
  `actual_hours` int(11) DEFAULT NULL,
  `budget` decimal(15,2) DEFAULT NULL,
  `billing_rate` decimal(15,2) DEFAULT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `is_billable` tinyint(1) NOT NULL DEFAULT 1,
  `progress` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0,
  `summary` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_project_members`
--

CREATE TABLE `crm_project_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `can_view` tinyint(1) NOT NULL DEFAULT 1,
  `can_edit` tinyint(1) NOT NULL DEFAULT 0,
  `can_delete` tinyint(1) NOT NULL DEFAULT 0,
  `allocated_hours` int(11) DEFAULT NULL,
  `actual_hours` int(11) DEFAULT NULL,
  `is_billable` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_project_milestones`
--

CREATE TABLE `crm_project_milestones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `completed_date` date DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `is_billable` tinyint(1) NOT NULL DEFAULT 1,
  `is_invoiced` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('pending','in_progress','completed','on_hold','cancelled') NOT NULL DEFAULT 'pending',
  `progress` tinyint(4) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `notes` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_project_tasks`
--

CREATE TABLE `crm_project_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `milestone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('todo','in_progress','review','done','blocked') NOT NULL DEFAULT 'todo',
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'medium',
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `estimated_hours` int(11) DEFAULT NULL,
  `actual_hours` int(11) DEFAULT NULL,
  `is_billable` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_task_comments`
--

CREATE TABLE `crm_task_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text NOT NULL,
  `comment_type` varchar(255) DEFAULT NULL,
  `is_internal` tinyint(1) NOT NULL DEFAULT 1,
  `is_edited` tinyint(1) NOT NULL DEFAULT 0,
  `edited_at` timestamp NULL DEFAULT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `uuid`, `name`, `slug`, `description`, `is_active`, `display_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '639f8b92-ed6b-11f0-9e6e-1860247b6ae0', 'Administrator', 'administrator', 'The Administrator department is responsible for overall system control, platform governance, user access management, security enforcement, and high-level configuration of the website. This department ensures smooth operation, data integrity, and strategic system oversight.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(2, '639fa36b-ed6b-11f0-9e6e-1860247b6ae0', 'Human Resources', 'human-resources', 'The Human Resources department manages employee lifecycle processes including recruitment, onboarding, performance evaluation, payroll coordination, training, compliance, and organizational culture development to support business growth.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(3, '639fa4c8-ed6b-11f0-9e6e-1860247b6ae0', 'Finance', 'finance', 'The Finance department oversees financial planning, accounting, budgeting, invoicing, expense tracking, tax compliance, and revenue analysis to ensure accurate financial reporting and sustainable business operations.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(4, '639fa656-ed6b-11f0-9e6e-1860247b6ae0', 'IT Department', 'it-department', 'The IT Department is responsible for maintaining technical infrastructure, managing servers, ensuring cybersecurity, handling system integrations, monitoring performance, and providing internal technical support across the organization.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(5, '639fb2ba-ed6b-11f0-9e6e-1860247b6ae0', 'Development', 'development', 'The Development department focuses on building, maintaining, and optimizing web applications, software systems, APIs, and backend services while ensuring scalability, performance, and clean code architecture.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(6, '639fb36a-ed6b-11f0-9e6e-1860247b6ae0', 'Design', 'design', 'The Design department handles user interface design, user experience optimization, branding assets, visual identity, and creative elements to ensure an engaging, accessible, and visually appealing digital presence.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(7, '639fb3cb-ed6b-11f0-9e6e-1860247b6ae0', 'Quality Assurance', 'quality-assurance', 'The Quality Assurance department ensures product reliability by performing manual and automated testing, identifying bugs, validating features, and maintaining quality standards before releases reach end users.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(8, '639fb430-ed6b-11f0-9e6e-1860247b6ae0', 'Content', 'content', 'The Content department is responsible for content strategy, copywriting, blog publishing, documentation, editorial planning, and maintaining high-quality written materials that improve user engagement and search engine visibility.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(9, '639fb496-ed6b-11f0-9e6e-1860247b6ae0', 'Marketing', 'marketing', 'The Marketing department manages brand promotion, digital campaigns, audience targeting, social media strategy, email marketing, and analytics to drive traffic, engagement, and customer acquisition.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(10, '639fb4f9-ed6b-11f0-9e6e-1860247b6ae0', 'Sales', 'sales', 'The Sales department focuses on lead generation, client communication, deal negotiation, conversion optimization, and revenue growth by building strong relationships with customers and partners.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(11, '639fb55f-ed6b-11f0-9e6e-1860247b6ae0', 'Customer Support', 'customer-support', 'The Customer Support department provides timely assistance, issue resolution, and technical guidance to users while ensuring customer satisfaction, trust, and long-term retention.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(12, '639fb5bf-ed6b-11f0-9e6e-1860247b6ae0', 'SEO', 'seo', 'The SEO department optimizes website content, technical structure, and performance to improve search engine rankings, organic traffic, keyword visibility, and long-term digital growth.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(13, '639fb63c-ed6b-11f0-9e6e-1860247b6ae0', 'Operations', 'operations', 'The Operations department manages day-to-day business processes, workflow optimization, internal coordination, and operational efficiency to ensure smooth execution of organizational activities.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(14, '639fb696-ed6b-11f0-9e6e-1860247b6ae0', 'Legal', 'legal', 'The Legal department oversees contracts, compliance, policies, intellectual property, data protection, and regulatory requirements to minimize risk and ensure lawful business practices.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL),
(15, '639fb6f2-ed6b-11f0-9e6e-1860247b6ae0', 'Research & Development', 'research-development', 'The Research and Development department focuses on innovation, product improvement, technology research, and future-ready solutions to maintain competitive advantage and long-term sustainability.', 1, 0, '2026-01-09 09:26:33', '2026-01-09 09:26:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `to_email` varchar(255) NOT NULL,
  `to_name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `type` enum('manual','system','enquiry','career') NOT NULL DEFAULT 'manual',
  `direction` enum('incoming','outgoing') NOT NULL DEFAULT 'outgoing',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `enquiry_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('draft','queued','sent','failed') NOT NULL DEFAULT 'sent',
  `retry_count` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `sent_at` timestamp NULL DEFAULT NULL,
  `failure_reason` text DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `message_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `uuid`, `from_email`, `from_name`, `to_email`, `to_name`, `subject`, `body`, `type`, `direction`, `user_id`, `enquiry_id`, `status`, `retry_count`, `sent_at`, `failure_reason`, `source`, `ip_address`, `message_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'aaa5a3a5-5a1b-4b56-9d13-e0a22cbd56e4', 'developersatcreativeroom@gmail.com', 'Laravel', 'abhiii2404@gmail.com', 'System Admin', 'Reset Your Test Project Password', '<h2 style=\"margin:0 0 16px; color:#0B3C8A;\">Hello System Admin,</h2>\n\n<p>You are receiving this email because we received a password reset request for your account.</p>\n\n<p style=\"text-align:center; margin:28px 0;\">\n    <a href=\"http://127.0.0.1:8000/admin/password/reset/8d294a68e89967c325726a4b0700f2436d73817d51739b73ac718a4c7c34c713?email=abhiii2404%40gmail.com\"\n       style=\"background:#0B3C8A; color:#ffffff; padding:14px 32px; text-decoration:none; border-radius:6px; font-weight:600; display:inline-block;\">\n        Reset Password\n    </a>\n</p>\n\n<p>This password reset link will expire in 60 minutes.</p>\n\n<p>If you did not request a password reset, no further action is required.</p>\n', 'system', 'outgoing', NULL, NULL, 'sent', 0, '2026-07-17 02:02:23', NULL, 'password-reset', NULL, NULL, '2026-07-17 02:02:23', '2026-07-17 02:02:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE `email_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `to_email` varchar(255) NOT NULL,
  `to_name` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `body` longtext DEFAULT NULL,
  `template_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('queued','sent','failed') NOT NULL DEFAULT 'sent',
  `retry_count` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `sent_at` timestamp NULL DEFAULT NULL,
  `error_message` text DEFAULT NULL,
  `message_id` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_logs`
--

INSERT INTO `email_logs` (`id`, `uuid`, `to_email`, `to_name`, `from_email`, `from_name`, `subject`, `body`, `template_id`, `status`, `retry_count`, `sent_at`, `error_message`, `message_id`, `source`, `ip_address`, `user_agent`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, '47782e38-f625-4556-b8e5-c284469371e7', 'abhiii2404@gmail.com', 'System Admin', 'developersatcreativeroom@gmail.com', 'Laravel', 'Reset Your Test Project Password', '<h2 style=\"margin:0 0 16px; color:#0B3C8A;\">Hello System Admin,</h2>\n\n<p>You are receiving this email because we received a password reset request for your account.</p>\n\n<p style=\"text-align:center; margin:28px 0;\">\n    <a href=\"http://127.0.0.1:8000/admin/password/reset/58996b19d0e8211095179ea2e79954ec60bd70e76943aacee899494dc5575978?email=abhiii2404%40gmail.com\"\n       style=\"background:#0B3C8A; color:#ffffff; padding:14px 32px; text-decoration:none; border-radius:6px; font-weight:600; display:inline-block;\">\n        Reset Password\n    </a>\n</p>\n\n<p>This password reset link will expire in 60 minutes.</p>\n\n<p>If you did not request a password reset, no further action is required.</p>\n', 33, 'sent', 0, '2026-07-17 01:11:08', NULL, NULL, 'password-reset', NULL, NULL, '2026-07-17 01:11:08', '2026-07-17 01:11:08', NULL),
(8, '9555abd5-99b4-43aa-98f8-bb55836dbdd0', 'abhiii2404@gmail.com', 'System Admin', 'developersatcreativeroom@gmail.com', 'Laravel', 'Reset Your Test Project Password', '<h2 style=\"margin:0 0 16px; color:#0B3C8A;\">Hello System Admin,</h2>\n\n<p>You are receiving this email because we received a password reset request for your account.</p>\n\n<p style=\"text-align:center; margin:28px 0;\">\n    <a href=\"http://127.0.0.1:8000/admin/password/reset/cc77dc83f4e85834a4b212966d22e0e8c395745fb382812a4e770a4ede3b4c17?email=abhiii2404%40gmail.com\"\n       style=\"background:#0B3C8A; color:#ffffff; padding:14px 32px; text-decoration:none; border-radius:6px; font-weight:600; display:inline-block;\">\n        Reset Password\n    </a>\n</p>\n\n<p>This password reset link will expire in 60 minutes.</p>\n\n<p>If you did not request a password reset, no further action is required.</p>\n', 33, 'sent', 0, '2026-07-17 01:28:07', NULL, NULL, 'password-reset', NULL, NULL, '2026-07-17 01:28:08', '2026-07-17 01:28:08', NULL),
(9, 'e18a2e08-0fe7-4e2a-9415-b87c90aee33f', 'abhiii2404@gmail.com', 'System Admin', 'developersatcreativeroom@gmail.com', 'Laravel', 'Reset Your Test Project Password', '<h2 style=\"margin:0 0 16px; color:#0B3C8A;\">Hello System Admin,</h2>\n\n<p>You are receiving this email because we received a password reset request for your account.</p>\n\n<p style=\"text-align:center; margin:28px 0;\">\n    <a href=\"http://127.0.0.1:8000/admin/password/reset/82a7299c0d98e23abbb3923ea9d3476d4a492b9f4e373e9348516d435d564d6b?email=abhiii2404%40gmail.com\"\n       style=\"background:#0B3C8A; color:#ffffff; padding:14px 32px; text-decoration:none; border-radius:6px; font-weight:600; display:inline-block;\">\n        Reset Password\n    </a>\n</p>\n\n<p>This password reset link will expire in 60 minutes.</p>\n\n<p>If you did not request a password reset, no further action is required.</p>\n', 33, 'sent', 0, '2026-07-17 01:34:19', NULL, NULL, 'password-reset', NULL, NULL, '2026-07-17 01:34:19', '2026-07-17 01:34:19', NULL),
(12, 'd13a43ab-f3c7-4d25-85aa-16974cee676e', 'abhiii2404@gmail.com', 'System Admin', 'developersatcreativeroom@gmail.com', 'Laravel', 'Reset Your Test Project Password', '<h2 style=\"margin:0 0 16px; color:#0B3C8A;\">Hello System Admin,</h2>\n\n<p>You are receiving this email because we received a password reset request for your account.</p>\n\n<p style=\"text-align:center; margin:28px 0;\">\n    <a href=\"http://127.0.0.1:8000/admin/password/reset/8d294a68e89967c325726a4b0700f2436d73817d51739b73ac718a4c7c34c713?email=abhiii2404%40gmail.com\"\n       style=\"background:#0B3C8A; color:#ffffff; padding:14px 32px; text-decoration:none; border-radius:6px; font-weight:600; display:inline-block;\">\n        Reset Password\n    </a>\n</p>\n\n<p>This password reset link will expire in 60 minutes.</p>\n\n<p>If you did not request a password reset, no further action is required.</p>\n', 33, 'sent', 0, '2026-07-17 02:02:23', NULL, NULL, 'password-reset', NULL, NULL, '2026-07-17 02:02:23', '2026-07-17 02:02:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `variables` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`variables`)),
  `type` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `language` varchar(10) NOT NULL DEFAULT 'en',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `uuid`, `name`, `slug`, `subject`, `body`, `variables`, `type`, `module`, `language`, `is_active`, `display_order`, `is_default`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'c066bb10-17dc-11f1-ad9d-544810ce699a', 'Welcome Email', 'welcome-email', 'Welcome to {{site_name}}', '<p>Hello {{name}}, welcome to <strong>{{site_name}}</strong>. We are excited to have you join our platform and become part of our growing community. Your account has been successfully created and you can now explore all the features and services available to help you achieve your goals efficiently. Our team is committed to providing a secure and reliable experience for all users. If you need any assistance while getting started, our support team will always be happy to help you.</p>\r\n\r\n<p><strong>Best Regards,</strong><br />\r\n{{site_name}} Team<br />\r\nCustomer Success Departments</p>', '[\"name\",\"site_name\"]', 'system', 'auth', 'en', 1, 0, 1, '2026-03-04 15:13:35', '2026-03-06 10:59:21', NULL),
(2, 'c06a04ba-17dc-11f1-ad9d-544810ce699a', 'Email Verification', 'email-verification', 'Verify your email', '<p>Hello {{name}}, thank you for creating an account on <strong>{{site_name}}</strong>. To ensure the security of your account and confirm your email address, we kindly ask you to complete the verification process. Please use the OTP provided below or click the verification link to activate your account successfully. This process helps us maintain a trusted and secure platform for all users.</p>\r\n\r\n<p style=\"text-align:center\"><strong>{{otp}}</strong></p>\r\n\r\n<p style=\"text-align:center\"><a href=\"{{verification_link}}\" style=\"background:#0c4cc4;color:#fff;padding:12px 25px;border-radius:5px;text-decoration:none;\">Verify Email</a></p>\r\n\r\n<p><strong>Best Regards,</strong><br />\r\n{{site_name}} Security Team</p>', '[\"name\",\"verification_link\"]', 'system', 'auth', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-06 10:59:44', NULL),
(3, 'c06a091e-17dc-11f1-ad9d-544810ce699a', 'Registration Success', 'registration_success', 'Registration Successful', '\r\n<p>Hello {{name}}, we are pleased to inform you that your registration on <strong>{{site_name}}</strong> has been completed successfully. You now have full access to your account dashboard where you can explore our services and manage your profile easily. Our platform is designed to provide you with powerful tools that help you accomplish your tasks efficiently. If you experience any difficulties, our support team is always ready to assist you.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Team<br>Customer Experience Department</p>\r\n', '[\"name\",\"site_name\"]', 'system', 'auth', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(4, 'c06a0b02-17dc-11f1-ad9d-544810ce699a', 'Login Alert', 'login_alert', 'New Login Detected', '\r\n<p>Hello {{name}}, we detected a new login to your account on <strong>{{site_name}}</strong>. This notification is sent to help you stay informed about your account activity and ensure the security of your profile. If this login was performed by you, no action is required. However, if you do not recognize this activity, we strongly recommend resetting your password immediately to secure your account.</p>\r\n<p>IP Address: {{ip}}<br>Login Time: {{login_time}}</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Security Team</p>\r\n', '[\"name\",\"ip\"]', 'security', 'auth', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(5, 'c06a0c99-17dc-11f1-ad9d-544810ce699a', 'Password Reset', 'password_reset', 'Reset Your Password', '\r\n<p>Hello {{name}}, we received a request to reset the password associated with your account on <strong>{{site_name}}</strong>. If you made this request, please click the button below to create a new secure password. For security reasons, this reset link will expire shortly and can only be used once. If you did not request this password reset, please ignore this email.</p>\r\n<p style=\"text-align:center;\"><a href=\"{{reset_link}}\" style=\"background:#0c4cc4;color:#fff;padding:12px 25px;border-radius:5px;text-decoration:none;\">Reset Password</a></p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Security Team</p>\r\n', '[\"name\",\"reset_link\"]', 'system', 'auth', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(6, 'c06a0ef0-17dc-11f1-ad9d-544810ce699a', 'Password Changed', 'password_changed', 'Password Updated', '\r\n<p>Hello {{name}}, this email confirms that your account password has been successfully updated. This notification is sent to ensure that you are aware of changes made to your account credentials. If you made this change, no further action is required. However, if you did not update your password, please contact our support team immediately.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Security Team</p>\r\n', '[\"name\"]', 'security', 'auth', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(7, 'c06a1067-17dc-11f1-ad9d-544810ce699a', 'Profile Updated', 'profile_updated', 'Profile Updated', '\r\n<p>Hello {{name}}, your account profile information on <strong>{{site_name}}</strong> has been successfully updated. Keeping your profile information accurate helps us provide a better and more personalized experience. If you made these changes yourself, no action is required. If you notice any unauthorized updates, please contact our support team immediately.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Team</p>\r\n', '[\"name\"]', 'system', 'user', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(8, 'c06a1216-17dc-11f1-ad9d-544810ce699a', 'Account Approved', 'account_approved', 'Account Approved', '\r\n<p>Hello {{name}}, we are pleased to inform you that your account has been reviewed and approved by our team. You now have full access to the services and features available on <strong>{{site_name}}</strong>. We encourage you to log in to your dashboard and begin exploring everything our platform offers.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Administration Team</p>\r\n', '[\"name\"]', 'system', 'user', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(9, 'c06a1448-17dc-11f1-ad9d-544810ce699a', 'Account Rejected', 'account_rejected', 'Account Rejected', '\r\n<p>Hello {{name}}, thank you for your interest in joining <strong>{{site_name}}</strong>. After reviewing your application, we regret to inform you that your account request was not approved at this time. This decision may be due to incomplete or incorrect information. You may contact our support team if you need further clarification.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Administration Team</p>\r\n', '[\"name\"]', 'system', 'user', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(10, 'c06a15ca-17dc-11f1-ad9d-544810ce699a', 'Subscription Activated', 'subscription_activated', 'Subscription Activated', '\r\n<p>Hello {{name}}, your subscription plan <strong>{{plan}}</strong> has been successfully activated. You can now enjoy all premium features and services included in your plan. We are committed to providing you with the best possible experience through our platform.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Billing Team</p>\r\n', '[\"name\",\"plan\"]', 'system', 'subscription', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(11, 'c06a180c-17dc-11f1-ad9d-544810ce699a', 'Subscription Expired', 'subscription_expired', 'Subscription Expired', '\r\n<p>Hello {{name}}, your subscription plan on <strong>{{site_name}}</strong> has expired. As a result, certain premium features may no longer be available in your account. To continue enjoying full access to our services, please renew your subscription.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Billing Team</p>\r\n', '[\"name\"]', 'system', 'subscription', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(12, 'c06a19ab-17dc-11f1-ad9d-544810ce699a', 'Contact Enquiry Admin', 'contact_enquiry_admin', 'New Enquiry Received', '\r\n<p>A new enquiry has been submitted through the contact form on <strong>{{site_name}}</strong>. Please review the details below and respond to the customer as soon as possible. Providing timely responses helps maintain customer satisfaction and trust.</p>\r\n<p>Name: {{name}}<br>Email: {{email}}<br>Message: {{message}}</p>\r\n<p><strong>Regards,</strong><br>System Notification</p>\r\n', '[\"name\",\"email\",\"message\"]', 'admin', 'contact', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(13, 'c06a1b48-17dc-11f1-ad9d-544810ce699a', 'Contact Confirmation', 'contact_confirmation', 'We Received Your Enquiry', '\r\n<p>Hello {{name}}, thank you for contacting <strong>{{site_name}}</strong>. We have successfully received your enquiry and our team is currently reviewing your message. One of our support representatives will respond to you shortly.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Support Team</p>\r\n', '[\"name\"]', 'system', 'contact', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(14, 'c06a1cd4-17dc-11f1-ad9d-544810ce699a', 'Support Ticket Created', 'support_ticket_created', 'Support Ticket Created', '\r\n<p>Hello {{name}}, your support request has been successfully submitted. Our support team has received your ticket and will review your issue shortly. Please keep the ticket ID below for reference.</p>\r\n<p>Ticket ID: {{ticket_id}}</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Support Team</p>\r\n', '[\"name\",\"ticket_id\"]', 'system', 'support', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(15, 'c06a1e70-17dc-11f1-ad9d-544810ce699a', 'Support Reply', 'support_reply', 'Support Team Replied', '\r\n<p>Hello {{name}}, our support team has replied to your support ticket. Please log in to your account to view the latest response and continue the conversation if additional help is required.</p>\r\n<p>Ticket ID: {{ticket_id}}</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Support Team</p>\r\n', '[\"name\",\"ticket_id\"]', 'system', 'support', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(16, 'c06a2070-17dc-11f1-ad9d-544810ce699a', 'Order Confirmation', 'order_confirmation', 'Order Confirmation', '\r\n<p>Hello {{name}}, thank you for your order with <strong>{{site_name}}</strong>. Your order has been successfully placed and is currently being processed by our team. You will receive another notification once the order status changes.</p>\r\n<p>Order ID: {{order_id}}</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Sales Team</p>\r\n', '[\"name\",\"order_id\"]', 'system', 'order', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(17, 'c06a2201-17dc-11f1-ad9d-544810ce699a', 'Payment Success', 'payment_success', 'Payment Successful', '\r\n<p>Hello {{name}}, we are pleased to inform you that your payment of <strong>{{amount}}</strong> has been successfully processed. Your transaction has been securely completed and the corresponding services have been activated on your account.</p>\r\n<p>Transaction ID: {{transaction_id}}</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Billing Team</p>\r\n', '[\"name\",\"amount\"]', 'system', 'payment', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(18, 'c06a2398-17dc-11f1-ad9d-544810ce699a', 'Payment Failed', 'payment_failed', 'Payment Failed', '\r\n<p>Hello {{name}}, unfortunately your recent payment attempt on <strong>{{site_name}}</strong> could not be completed. This may happen due to insufficient funds or a temporary issue with your payment provider.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Billing Team</p>\r\n', '[\"name\"]', 'system', 'payment', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(19, 'c06a2af5-17dc-11f1-ad9d-544810ce699a', 'Invoice Email', 'invoice_email', 'Invoice for your purchase', '\r\n<p>Hello {{name}}, your invoice has been generated successfully. Please find the invoice details below for your records.</p>\r\n<p>Invoice ID: {{invoice_id}}</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Finance Department</p>\r\n', '[\"name\",\"invoice_id\"]', 'system', 'billing', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(20, 'c06a2dcc-17dc-11f1-ad9d-544810ce699a', 'Newsletter', 'newsletter', 'Latest Updates from {{site_name}}', '\r\n<p>Hello {{name}}, here are the latest updates and announcements from <strong>{{site_name}}</strong>. Our team continuously works to improve our platform and introduce new features that help you achieve better results.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Newsletter Team</p>\r\n', '[\"name\",\"site_name\"]', 'marketing', 'newsletter', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(21, 'c06a3016-17dc-11f1-ad9d-544810ce699a', 'Promotion Offer', 'promotion_offer', 'Special Offer', '\r\n<p>Hello {{name}}, we are excited to offer you a special promotion available for a limited time. Use the coupon code below to receive your exclusive discount on our services.</p>\r\n<p>Coupon Code: {{coupon}}</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Marketing Team</p>\r\n', '[\"name\",\"coupon\"]', 'marketing', 'promotion', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(22, 'c06a3257-17dc-11f1-ad9d-544810ce699a', 'New Device Login', 'new_device_login', 'New Device Login', '\r\n<p>Hello {{name}}, we detected a login attempt from a new device. This message is sent to ensure that your account remains secure.</p>\r\n<p>Device: {{device}}<br>IP: {{ip}}</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Security Team</p>\r\n', '[\"name\"]', 'security', 'auth', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(23, 'c06a3443-17dc-11f1-ad9d-544810ce699a', 'OTP Email', 'otp_email', 'Your OTP Code', '\r\n<p>Hello {{name}}, your one time password for completing the requested action on <strong>{{site_name}}</strong> is provided below. Please enter this code on the verification page to proceed.</p>\r\n<p style=\"text-align:center;\"><strong style=\"font-size:24px;color:#0c4cc4;\">{{otp}}</strong></p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Security Team</p>\r\n', '[\"name\",\"otp\"]', 'security', 'auth', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(24, 'c06a373c-17dc-11f1-ad9d-544810ce699a', 'Account Suspended', 'account_suspended', 'Account Suspended', '\r\n<p>Hello {{name}}, your account has been temporarily suspended due to a violation of our platform policies or unusual activity detected on your profile.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Administration Team</p>\r\n', '[\"name\"]', 'security', 'user', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(25, 'c06a394a-17dc-11f1-ad9d-544810ce699a', 'Account Deleted', 'account_deleted', 'Account Deleted', '\r\n<p>Hello {{name}}, this email confirms that your account has been permanently deleted from <strong>{{site_name}}</strong>. We are sorry to see you go.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Team</p>\r\n', '[\"name\"]', 'system', 'user', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(26, 'c06a7678-17dc-11f1-ad9d-544810ce699a', 'Admin Notification', 'admin_notification', 'Admin Notification', '\r\n<p>{{message}}</p>\r\n<p><strong>Regards,</strong><br>{{site_name}} System Notification</p>\r\n', '[\"message\"]', 'admin', 'system', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(27, 'c06a7cc3-17dc-11f1-ad9d-544810ce699a', 'Comment Notification', 'comment_notification', 'New Comment', '\r\n<p>Hello {{name}}, someone has recently commented on your post on <strong>{{site_name}}</strong>. You can log in to your account to view the comment and continue the discussion.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Community Team</p>\r\n', '[\"name\"]', 'system', 'blog', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(28, 'c06a81cd-17dc-11f1-ad9d-544810ce699a', 'Reply Notification', 'reply_notification', 'New Reply', '\r\n<p>Hello {{name}}, you have received a reply to your comment on <strong>{{site_name}}</strong>. Please log in to your account to view the response and continue the conversation.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Community Team</p>\r\n', '[\"name\"]', 'system', 'blog', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(29, 'c06a873e-17dc-11f1-ad9d-544810ce699a', 'Reminder Email', 'reminder_email', 'Reminder Notification', '\r\n<p>Hello {{name}}, this is a reminder notification regarding an important activity related to your account. Please review the information in your dashboard to ensure everything is up to date.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Notification Service</p>\r\n', '[\"name\"]', 'system', 'notification', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(30, 'c06a89a9-17dc-11f1-ad9d-544810ce699a', 'General Notification', 'general_notification', 'Notification', '\r\n<p>Hello {{name}}, you have received a new notification on your account. Please log in to your dashboard to view the details and take any necessary action.</p>\r\n<p><strong>Best Regards,</strong><br>{{site_name}} Notification System</p>\r\n', '[\"name\",\"message\"]', 'system', 'notification', 'en', 1, 0, 0, '2026-03-04 15:13:35', '2026-03-04 15:13:35', NULL),
(33, 'be7b3e55-30ea-4f7a-838f-60d6645f194d', 'Password Reset', 'password-reset', 'Reset Your {{app_name}} Password', '<h2 style=\"margin:0 0 16px; color:#0B3C8A;\">Hello {{name}},</h2>\n\n<p>You are receiving this email because we received a password reset request for your account.</p>\n\n<p style=\"text-align:center; margin:28px 0;\">\n    <a href=\"{{reset_url}}\"\n       style=\"background:#0B3C8A; color:#ffffff; padding:14px 32px; text-decoration:none; border-radius:6px; font-weight:600; display:inline-block;\">\n        Reset Password\n    </a>\n</p>\n\n<p>This password reset link will expire in 60 minutes.</p>\n\n<p>If you did not request a password reset, no further action is required.</p>\n', '[\"name\",\"reset_url\",\"app_name\"]', 'transactional', 'auth', 'en', 1, 0, 1, '2026-07-17 01:08:57', '2026-07-17 01:16:17', NULL),
(34, 'ccb654c8-9b53-45f7-b725-7dbb4df2775e', 'Contact — User Confirmation', 'contact-user-confirmation', 'Thanks for contacting {{app_name}}', '<h2 style=\"margin:0 0 16px; color:#0B3C8A;\">Hi {{name}},</h2>\n\n<p>Thanks for reaching out to {{app_name}}. We\'ve received your message and our team will get back to you shortly.</p>\n\n<p style=\"background:#f5f8fd; border-left:3px solid #0B3C8A; padding:12px 16px; margin:20px 0; color:#333;\">\n    {{message}}\n</p>\n\n<p>We usually respond within a few hours on working days.</p>\n\n<p>Best regards,<br>{{app_name}} Team</p>\n', '[\"name\",\"message\",\"app_name\"]', 'transactional', 'contact', 'en', 1, 0, 1, '2026-07-21 02:14:38', '2026-07-21 02:14:38', NULL),
(35, 'b74d03d4-687c-4873-a3f3-8c36ebc98215', 'Contact — Admin Notification', 'contact-admin-notification', 'New contact enquiry from {{name}}', '<h2 style=\"margin:0 0 16px; color:#0B3C8A;\">New Contact Enquiry</h2>\n\n<p>A new enquiry was submitted on {{app_name}}.</p>\n\n<table style=\"width:100%; border-collapse:collapse; margin:16px 0;\">\n    <tr>\n        <td style=\"padding:6px 0; color:#666; width:140px;\">Name</td>\n        <td style=\"padding:6px 0; color:#111;\">{{name}}</td>\n    </tr>\n    <tr>\n        <td style=\"padding:6px 0; color:#666;\">Email</td>\n        <td style=\"padding:6px 0; color:#111;\">{{email}}</td>\n    </tr>\n    <tr>\n        <td style=\"padding:6px 0; color:#666;\">Phone</td>\n        <td style=\"padding:6px 0; color:#111;\">{{phone}}</td>\n    </tr>\n</table>\n\n<p style=\"background:#f5f8fd; border-left:3px solid #0B3C8A; padding:12px 16px; margin:20px 0; color:#333;\">\n    {{message}}\n</p>\n\n<p>View and manage this enquiry from the admin panel.</p>\n', '[\"name\",\"email\",\"phone\",\"message\",\"app_name\"]', 'transactional', 'contact', 'en', 1, 0, 1, '2026-07-21 02:14:39', '2026-07-21 02:14:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `project_budget` varchar(255) DEFAULT NULL,
  `project_timeline` varchar(255) DEFAULT NULL,
  `service_interest` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `status` enum('new','in_progress','responded','converted','closed','spam') NOT NULL DEFAULT 'new',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `follow_up_at` timestamp NULL DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `uuid`, `type`, `name`, `email`, `phone`, `company_name`, `subject`, `message`, `project_budget`, `project_timeline`, `service_interest`, `source`, `status`, `is_read`, `read_at`, `assigned_to`, `follow_up_at`, `admin_notes`, `ip_address`, `user_agent`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '9b7e1b90-1a01-4d44-a001-111111111111', 'contact', 'Abhishek Kumar', 'abhiii2404@gmail.com', '9876543210', 'TechNova Pvt Ltd', 'Website Development', 'We need a corporate website for our IT company.', '5000-10000', '1-2 months', 'Web Development', 'website', 'new', 0, NULL, NULL, NULL, NULL, '192.168.1.10', 'Mozilla/5.0', '2026-03-04 04:30:00', '2026-03-04 04:30:00', NULL),
(2, '9b7e1b90-1a01-4d44-a001-222222222222', 'quote', 'Abhishek Kumar', 'abhiii2404@gmail.com', '9876543210', 'Startup Labs', 'Mobile App Development', 'Looking to build a cross-platform mobile app for our service.', '10000-20000', '2-3 months', 'Mobile App Development', 'google', 'new', 0, NULL, NULL, NULL, NULL, '192.168.1.11', 'Mozilla/5.0', '2026-03-04 04:35:00', '2026-03-04 04:35:00', NULL),
(3, '9b7e1b90-1a01-4d44-a001-333333333333', 'contact', 'Abhishek Kumar', 'abhiii2404@gmail.com', '9876543210', 'Growth Digital', 'SEO Services', 'We want to improve Google ranking for our ecommerce website.', '2000-5000', '3 months', 'SEO', 'organic', 'in_progress', 0, NULL, NULL, NULL, NULL, '192.168.1.12', 'Mozilla/5.0', '2026-03-04 04:40:00', '2026-03-04 04:40:00', NULL),
(4, '9b7e1b90-1a01-4d44-a001-444444444444', 'contact', 'Abhishek Kumar', 'abhiii2404@gmail.com', '9876543210', 'RetailMart', 'Ecommerce Development', 'Need a custom ecommerce platform with payment integration.', '10000-15000', '2 months', 'Ecommerce Development', 'website', 'new', 0, NULL, NULL, NULL, NULL, '192.168.1.13', 'Mozilla/5.0', '2026-03-04 04:45:00', '2026-03-04 04:45:00', NULL),
(5, '9b7e1b90-1a01-4d44-a001-555555555555', 'quote', 'Abhishek Kumar', 'abhiii2404@gmail.com', '9876543210', 'FinEdge', 'FinTech Platform', 'Looking for secure fintech web application development.', '20000-30000', '4 months', 'Web Application', 'referral', 'new', 0, NULL, NULL, NULL, NULL, '192.168.1.14', 'Mozilla/5.0', '2026-03-04 04:50:00', '2026-03-04 04:50:00', NULL),
(6, '9b7e1b90-1a01-4d44-a001-666666666666', 'contact', 'Abhishek Kumar', 'abhiii2404@gmail.com', '9876543210', 'EduSmart', 'LMS Development', 'We need a learning management system for online courses.', '8000-15000', '3 months', 'EdTech Development', 'website', 'new', 0, NULL, NULL, NULL, NULL, '192.168.1.15', 'Mozilla/5.0', '2026-03-04 04:55:00', '2026-03-04 04:55:00', NULL),
(7, '9b7e1b90-1a01-4d44-a001-777777777777', 'contact', 'Abhishek Kumar', 'abhiii2404@gmail.com', '9876543210', 'HealthPlus', 'Healthcare App', 'Want a healthcare mobile app for patient booking system.', '12000-20000', '3 months', 'Healthcare App', 'facebook', 'new', 0, NULL, NULL, NULL, NULL, '192.168.1.16', 'Mozilla/5.0', '2026-03-04 05:00:00', '2026-03-04 05:00:00', NULL),
(8, '9b7e1b90-1a01-4d44-a001-888888888888', 'quote', 'Abhishek Kumar', 'abhiii2404@gmail.com', '9876543210', 'CloudServe', 'Cloud Migration', 'Need help migrating our infrastructure to AWS cloud.', '15000-25000', '2 months', 'Cloud Computing', 'linkedin', 'new', 0, NULL, NULL, NULL, NULL, '192.168.1.17', 'Mozilla/5.0', '2026-03-04 05:05:00', '2026-03-04 05:05:00', NULL),
(9, '9b7e1b90-1a01-4d44-a001-999999999999', 'contact', 'Abhishek Kumar', 'abhiii2404@gmail.com', '9876543210', 'AI Labs', 'AI Automation', 'Interested in AI chatbot automation for our support team.', '7000-12000', '1-2 months', 'Artificial Intelligence', 'organic', 'new', 0, NULL, NULL, NULL, NULL, '192.168.1.18', 'Mozilla/5.0', '2026-03-04 05:10:00', '2026-03-04 05:10:00', NULL),
(10, '9b7e1b90-1a01-4d44-a001-101010101010', 'contact', 'Abhishek Kumar', 'abhiii2404@gmail.com', '9876543210', 'SecureNet', 'Cyber Security', 'Looking for a security audit for our web applications.', '5000-9000', '1 month', 'Cyber Security', 'website', 'spam', 1, '2026-07-21 02:18:21', 3, '2026-03-04 05:31:00', 'dsadsfads', '192.168.1.19', 'Mozilla/5.0', '2026-03-04 05:15:00', '2026-07-21 02:18:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enquiries_status_logs`
--

CREATE TABLE `enquiries_status_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `enquiry_id` bigint(20) UNSIGNED NOT NULL,
  `old_status` varchar(255) DEFAULT NULL,
  `new_status` varchar(255) NOT NULL,
  `changed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `follow_up_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries_status_logs`
--

INSERT INTO `enquiries_status_logs` (`id`, `uuid`, `enquiry_id`, `old_status`, `new_status`, `changed_by`, `notes`, `follow_up_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'e70f68e3-8633-4b4e-9e38-8bd64c1e7eb3', 10, 'in_progress', 'in_progress', NULL, 'dsadsfads', '2026-03-04 05:31:00', NULL, '2026-03-03 23:05:26', '2026-03-03 23:05:26'),
(2, 'ab685831-73ed-49ba-af76-4a25fe04cb59', 10, 'in_progress', 'in_progress', NULL, 'dsadsfads', '2026-03-04 05:31:00', NULL, '2026-03-03 23:05:35', '2026-03-03 23:05:35'),
(3, '3e475b3a-20b0-4a18-ad3d-d7bf84929279', 10, 'in_progress', 'converted', NULL, 'dsadsfads', '2026-03-04 05:31:00', NULL, '2026-03-03 23:05:43', '2026-03-03 23:05:43'),
(4, '1f40bdb0-f502-4324-908a-8fd1046198b4', 10, 'converted', 'closed', NULL, 'dsadsfads', '2026-03-04 05:31:00', NULL, '2026-03-03 23:05:51', '2026-03-03 23:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `page` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `uuid`, `title`, `slug`, `page`, `short_description`, `is_active`, `display_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'f87566ae-4199-412c-bab0-aab1823cb78b', 'Frequently Asked Questions', 'frequently-asked-questions', 'home', 'asdfadsf', 0, 0, '2026-03-17 11:45:36', '2026-03-17 12:12:44', '2026-03-17 12:12:44'),
(3, '24d4d3e8-a68f-4718-94b3-bd7d27ce6dcf', 'home page faq', 'home-page-faq', 'Home', 'asfdsad', 1, 0, '2026-07-15 04:06:15', '2026-07-15 04:06:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faq_items`
--

CREATE TABLE `faq_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_category_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_items`
--

INSERT INTO `faq_items` (`id`, `faq_category_id`, `question`, `answer`, `display_order`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'what is your name', 'dainya', 1, 1, '2026-03-17 11:49:15', '2026-03-17 11:57:46', '2026-03-17 11:57:46'),
(2, 1, 'What is your father name ?', 'Vijaiya', 2, 1, '2026-03-17 11:49:15', '2026-03-17 11:57:46', '2026-03-17 11:57:46'),
(3, 1, 'what is your name', 'dainya', 0, 1, '2026-03-17 11:57:46', '2026-03-17 11:58:01', '2026-03-17 11:58:01'),
(4, 1, 'What is your father name ?', 'Vijaiya', 0, 1, '2026-03-17 11:57:46', '2026-03-17 11:58:01', '2026-03-17 11:58:01'),
(5, 1, 'What is your father name ?', 'Vijaiya', 0, 1, '2026-03-17 11:58:01', '2026-03-17 12:01:11', '2026-03-17 12:01:11'),
(6, 1, 'what is your name', 'dainya', 0, 1, '2026-03-17 11:58:01', '2026-03-17 12:01:11', '2026-03-17 12:01:11'),
(7, 1, 'What is your father name ?', 'Vijaiya', 0, 1, '2026-03-17 12:01:11', '2026-03-17 12:01:23', '2026-03-17 12:01:23'),
(8, 1, 'what is your name', 'dainya', 0, 1, '2026-03-17 12:01:11', '2026-03-17 12:01:23', '2026-03-17 12:01:23'),
(9, 1, 'What is your father name ?', 'Vijaiya', 0, 1, '2026-03-17 12:01:23', '2026-03-17 12:02:53', '2026-03-17 12:02:53'),
(10, 1, 'what is your name', 'dainya', 0, 1, '2026-03-17 12:01:23', '2026-03-17 12:02:53', '2026-03-17 12:02:53'),
(11, 1, 'What is your father name ?', 'Vijaiya', 0, 1, '2026-03-17 12:02:53', '2026-03-17 12:04:26', '2026-03-17 12:04:26'),
(12, 1, 'what is your name', 'dainya', 0, 1, '2026-03-17 12:02:53', '2026-03-17 12:04:26', '2026-03-17 12:04:26'),
(13, 1, 'What is your father name ?', 'Vijaiya', 0, 1, '2026-03-17 12:04:26', '2026-03-17 12:04:38', '2026-03-17 12:04:38'),
(14, 1, 'what is your name', 'dainya', 0, 1, '2026-03-17 12:04:26', '2026-03-17 12:04:38', '2026-03-17 12:04:38'),
(15, 1, 'what is your name', 'dainya', 0, 1, '2026-03-17 12:04:38', '2026-07-15 04:06:29', '2026-07-15 04:06:29'),
(16, 1, 'What is your father name ?', 'Vijaiya', 0, 1, '2026-03-17 12:04:38', '2026-07-15 04:12:39', '2026-07-15 04:12:39'),
(17, 3, 'faq1', 'asdf', 1, 1, '2026-07-15 04:24:31', '2026-07-15 04:24:31', NULL),
(18, 3, 'faq2', 'asd', 2, 1, '2026-07-15 04:24:31', '2026-07-15 04:24:31', NULL),
(19, 3, 'faq3', 'asdfa', 3, 1, '2026-07-15 04:24:31', '2026-07-15 04:24:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `form_type` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `paragraph` text DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `heading_align` varchar(255) DEFAULT NULL,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`settings`)),
  `has_captcha` tinyint(1) NOT NULL DEFAULT 0,
  `send_email` tinyint(1) NOT NULL DEFAULT 0,
  `success_message` varchar(255) DEFAULT NULL,
  `redirect_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `submissions_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `uuid`, `name`, `slug`, `form_type`, `action`, `heading`, `paragraph`, `style`, `heading_align`, `settings`, `has_captcha`, `send_email`, `success_message`, `redirect_url`, `is_active`, `display_order`, `submissions_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'e3245a40-cf2a-4062-b7ae-ddd1539cc41c', 'Video Section', 'video-section', 'toggle', '#', 'Video Section Form', NULL, NULL, 'left', NULL, 0, 0, NULL, NULL, 1, 0, 0, '2026-03-19 00:11:58', '2026-03-21 04:00:19', NULL),
(2, '653ebfbd-94dd-4e0b-ba8d-4c231e1c345a', 'Vision Mission', 'vision-mission', 'toggle', '#', 'Vision Mission Form', NULL, NULL, 'left', NULL, 0, 0, NULL, NULL, 1, 0, 0, '2026-03-19 05:34:46', '2026-03-21 02:57:02', NULL),
(4, 'a33dfad0-693c-4a41-84d8-f43503a94b94', 'Trusted Clients', 'trusted-clients', 'toggle', '#', 'Trusted Clients Sections', NULL, NULL, 'center', NULL, 0, 0, NULL, NULL, 1, 0, 0, '2026-03-19 05:36:04', '2026-03-21 00:01:22', NULL),
(5, 'b23db55e-be83-4e78-afde-ec62233850e4', 'Wy Choose Us', 'wy-choose-us', 'toggle', '#', 'Why Choose Us Form', NULL, NULL, 'left', NULL, 0, 0, NULL, NULL, 1, 0, 0, '2026-03-21 04:16:50', '2026-03-21 04:16:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form_fields`
--

CREATE TABLE `form_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `form_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_multiple` tinyint(1) NOT NULL DEFAULT 0,
  `group_key` varchar(255) DEFAULT NULL,
  `enable_croppie` tinyint(1) NOT NULL DEFAULT 1,
  `field_id` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `use_ck_editor` tinyint(1) NOT NULL DEFAULT 0,
  `add_country_code` tinyint(1) NOT NULL DEFAULT 0,
  `placeholder` varchar(255) DEFAULT NULL,
  `field_width` varchar(255) DEFAULT NULL,
  `default_value` varchar(255) DEFAULT NULL,
  `validation_rules` varchar(255) DEFAULT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `conditions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`conditions`)),
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`id`, `uuid`, `form_id`, `name`, `label`, `type`, `is_multiple`, `group_key`, `enable_croppie`, `field_id`, `class`, `required`, `disabled`, `use_ck_editor`, `add_country_code`, `placeholder`, `field_width`, `default_value`, `validation_rules`, `options`, `conditions`, `sort_order`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'd51da8ed-e26a-45f0-9a25-f2f89c7f56e6', 1, 'name', 'Name', 'text', 0, NULL, 1, 'name', 'name', 1, 0, 0, 0, 'Enter Your Name', '3', NULL, NULL, NULL, NULL, 0, 1, '2026-03-19 00:11:58', '2026-03-21 04:00:20', '2026-03-21 04:00:20'),
(2, '7310f00a-ffa1-4cfd-90a5-075dafa59846', 1, 'email', 'Email', 'email', 0, NULL, 1, 'email', 'email', 1, 0, 0, 0, 'Enter Your Email', '3', NULL, NULL, NULL, NULL, 1, 1, '2026-03-19 00:11:58', '2026-03-21 04:00:20', '2026-03-21 04:00:20'),
(3, '917cfc61-44fc-4c75-9024-1bed22e0a110', 4, 'phone', 'Phone', 'number', 0, NULL, 1, 'phone', 'phone', 1, 1, 0, 1, 'Enter Your Phone Number', '6', NULL, NULL, NULL, NULL, 0, 1, '2026-03-20 05:04:58', '2026-03-21 00:01:22', '2026-03-21 00:01:22'),
(4, 'ba6ab364-688d-4fec-9c50-26de4844d826', 2, 'abhi', 'Abhi', 'textarea', 0, NULL, 1, NULL, NULL, 1, 0, 1, 0, 'enter YOur name', '12', NULL, NULL, NULL, NULL, 0, 1, '2026-03-20 05:06:47', '2026-03-21 02:57:07', '2026-03-21 02:57:07'),
(5, '38d7bcf6-05aa-4bab-b769-cafde5ec0710', 4, 'title', 'Title', 'text', 0, NULL, 1, 'title', 'title', 1, 1, 0, 0, 'Enter title here', '12', NULL, NULL, NULL, NULL, 1, 1, '2026-03-21 00:01:22', '2026-03-21 00:03:32', '2026-03-21 00:03:32'),
(6, '096fb575-33e6-412b-b132-ca17c85ade66', 4, 'subtitle', 'Subtitle', 'text', 0, NULL, 1, 'subtitle', 'subtitle', 1, 0, 0, 0, 'Enter Subtitle Here', '12', NULL, NULL, NULL, NULL, 2, 1, '2026-03-21 00:01:22', '2026-03-21 00:03:32', '2026-03-21 00:03:32'),
(7, 'f3e9c939-2f60-47c4-ac01-589b5ed2c567', 4, 'paragraphs[0][class]', 'Paragraph Class', 'text', 0, NULL, 1, NULL, 'paragraph-class', 1, 0, 0, 0, 'Enter Class of paragraph 1', '6', NULL, NULL, NULL, NULL, 3, 1, '2026-03-21 00:01:22', '2026-03-21 00:03:32', '2026-03-21 00:03:32'),
(8, 'e0060b6c-cd60-4a8b-a828-9e26bdd20051', 4, 'paragraphs[1][class]', 'Paragraph class 2', 'text', 0, NULL, 1, NULL, 'paragraph-class', 1, 0, 0, 0, 'Enter class of paragraph 2', '6', NULL, NULL, NULL, NULL, 4, 1, '2026-03-21 00:01:22', '2026-03-21 00:03:32', '2026-03-21 00:03:32'),
(9, '1c991451-6a33-413f-940b-4c894baf2ac2', 4, 'paragraphs[0][content]', 'Paragraph Content', 'textarea', 0, NULL, 1, 'description', 'paragraph-content', 1, 0, 1, 0, 'Enter content of paragraph', '6', NULL, NULL, NULL, NULL, 5, 1, '2026-03-21 00:01:22', '2026-03-21 00:03:32', '2026-03-21 00:03:32'),
(10, 'd8ff3b61-4379-4029-81c4-45d153779166', 4, 'paragraphs[1][content]', 'Paragraph Content 2', 'textarea', 0, NULL, 1, 'short_description', 'paragraph-content', 1, 0, 1, 0, 'Enter content of paragraph 2', '6', NULL, NULL, NULL, NULL, 6, 1, '2026-03-21 00:01:22', '2026-03-21 00:03:32', '2026-03-21 00:03:32'),
(11, 'b9fa1b8a-9be4-438a-9206-d0779309ac45', 4, 'title', 'Title', 'text', 0, NULL, 1, 'title', 'title', 1, 0, 0, 0, 'Enter title here', '6', NULL, NULL, NULL, NULL, 1, 1, '2026-03-21 00:03:32', '2026-03-21 00:03:32', NULL),
(12, '019796f2-94d5-4979-a75c-05c8441de1a1', 4, 'subtitle', 'Subtitle', 'text', 0, NULL, 1, 'subtitle', 'subtitle', 1, 0, 0, 0, 'Enter Subtitle Here', '6', NULL, NULL, NULL, NULL, 2, 1, '2026-03-21 00:03:32', '2026-03-21 00:03:32', NULL),
(13, 'af184164-6993-4f93-80cd-1b0f49ab376c', 4, 'paragraphs[0][class]', 'Paragraph Class', 'text', 0, NULL, 1, NULL, 'paragraph-class', 1, 0, 0, 0, 'Enter Class of paragraph 1', '6', NULL, NULL, NULL, NULL, 3, 1, '2026-03-21 00:03:32', '2026-03-21 00:03:32', NULL),
(14, 'ef673614-c960-4c16-8b6b-f692f4d660ca', 4, 'paragraphs[1][class]', 'Paragraph class 2', 'text', 0, NULL, 1, NULL, 'paragraph-class', 1, 0, 0, 0, 'Enter class of paragraph 2', '6', NULL, NULL, NULL, NULL, 4, 1, '2026-03-21 00:03:32', '2026-03-21 00:03:32', NULL),
(15, '5d77ef5b-5c58-4cb9-9240-6efcb2b9ec1c', 4, 'paragraphs[0][content]', 'Paragraph Content', 'textarea', 0, NULL, 1, 'description', 'paragraph-content', 1, 0, 1, 0, 'Enter content of paragraph', '6', NULL, NULL, NULL, NULL, 5, 1, '2026-03-21 00:03:32', '2026-03-21 00:03:32', NULL),
(16, 'd7c083c2-6519-4754-852a-8c0921d2147d', 4, 'paragraphs[1][content]', 'Paragraph Content 2', 'textarea', 0, NULL, 1, 'short_description', 'paragraph-content', 1, 0, 1, 0, 'Enter content of paragraph 2', '6', NULL, NULL, NULL, NULL, 6, 1, '2026-03-21 00:03:32', '2026-03-21 00:03:32', NULL),
(17, 'f01bcffb-7cf1-408d-b339-825571ddb5b9', 2, 'title', 'Title', 'text', 0, NULL, 1, 'title', 'title', 1, 0, 0, 0, 'Enter Section Title Here', '6', NULL, NULL, NULL, NULL, 1, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(18, '43881ab4-8972-43f8-8b03-e6b61ff57d18', 2, 'subtitle', 'Subtitle', 'text', 0, NULL, 1, 'subtitle', 'subtitle', 1, 0, 0, 0, 'Enter Section Subtitle Here', '6', NULL, NULL, NULL, NULL, 2, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(19, '119ea9e8-358e-4d8d-a685-9b8628e5e0eb', 2, 'paragraphs[0][class]', 'Paragraph Class', 'text', 0, NULL, 1, 'paragraph_class', 'paragraph_class', 1, 0, 0, 0, 'Enter Class Of Paragraph First', '6', NULL, NULL, NULL, NULL, 3, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(20, 'b3d40938-0215-46a0-badd-d3f7b1f5ff00', 2, 'paragraphs[1][class]', 'Paragraph Class 1', NULL, 0, NULL, 1, 'paragraph_class_1', 'paragraph_class_1', 1, 0, 0, 0, 'Enter Class Of Paragraph Second', '6', NULL, NULL, NULL, NULL, 4, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(21, '5dc1d126-cf54-410f-9d4b-b562b9982cf0', 2, 'paragraphs[0][content]', 'Paragraph Content', 'textarea', 0, NULL, 1, 'description', 'paragraph_content', 1, 0, 1, 0, 'Enter Content Of Paragraph First', '6', NULL, NULL, NULL, NULL, 5, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(22, '53cd04a1-0024-4cdc-bff3-fd7e108d7e52', 2, 'paragraphs[1][content]', 'Paragraph Content 1', 'textarea', 0, NULL, 1, 'short_description', NULL, 1, 0, 1, 0, 'Enter Content Of Paragraph Second', '6', NULL, NULL, NULL, NULL, 6, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(23, '4ad8d3ce-e574-4850-a8e0-4ddc8bb897bc', 2, 'vision[icon]', 'Vision Icon', 'text', 0, NULL, 1, 'vision_icon', NULL, 1, 0, 0, 0, 'Enter Vision Icon Name', '3', NULL, NULL, NULL, NULL, 8, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(24, 'bdae3d8d-06d2-4219-af4a-db02b775ccce', 2, 'vision[title]', 'Vision Title', 'text', 0, NULL, 1, 'vision_title', NULL, 0, 0, 0, 0, 'Enter Vision Title Here', '3', NULL, NULL, NULL, NULL, 7, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(25, 'dfab0743-b163-45d5-bde4-c91c25db7671', 2, 'vision[stat_number]', 'Vision Stat Number', 'text', 0, NULL, 1, 'v_stat_number', 'v_stat_number', 0, 0, 0, 0, 'Enter Vision Stat Number Here', '3', NULL, NULL, NULL, NULL, 9, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(26, '06849c27-92d6-446b-a2f7-72892dd09777', 2, 'vision[stat_label]', 'Vision Stat Label', 'text', 0, NULL, 1, 'v_stat_lable', 'v_stat_lable', 0, 0, 0, 0, 'Entet Vision Stat Label', '3', NULL, NULL, NULL, NULL, 10, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(27, 'cc4c9c2c-fd6f-4ab8-938f-d3606c1b6bf9', 2, 'vision[content]', 'Vision Content', 'textarea', 0, NULL, 1, 'v_content', 'v_content', 1, 0, 0, 0, 'Enter Vision Content Here', '12', NULL, NULL, NULL, NULL, 11, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(28, '62e68ac6-23a1-4117-9c37-0055a7873c61', 2, 'mission[icon]', 'Mission Icon', 'text', 0, NULL, 1, 'm_icon', 'm_icon', 1, 0, 0, 0, 'Enter Mission Icon Name', '3', NULL, NULL, NULL, NULL, 13, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(29, '48808c6a-b2e8-4b1f-9437-3fc74aa9152c', 2, 'mission[title]', 'Mission Title', 'text', 0, NULL, 1, 'm_title', 'm_title', 1, 0, 0, 0, 'Enter Mission Title Here', '3', NULL, NULL, NULL, NULL, 12, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(30, 'e73a58c2-f88a-4455-8a76-429db3781409', 2, 'mission[stat_number]', 'Mission Stat Number', 'text', 0, NULL, 1, 'm_stat_number', 'm_stat_number', 0, 0, 0, 0, 'Enter Mission Stat Number Here', '3', NULL, NULL, NULL, NULL, 14, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(31, '97c1786d-ef6e-4c41-bcfc-2a511499f52d', 2, 'mission[stat_label]', 'Mission Stat Label', 'text', 0, NULL, 1, 'm_stat_label', 'm_stat_label', 0, 0, 0, 0, 'Enter Mission Stat Lable Here', '3', NULL, NULL, NULL, NULL, 15, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(32, 'e4666ac9-ea3f-49ae-bfb0-871b621089dd', 2, 'cta_text', 'Cta Text', 'text', 0, NULL, 1, 'cta_text', 'cta_text', 0, 0, 0, 0, 'Enter Cta Text Here', '12', NULL, NULL, NULL, NULL, 16, 1, '2026-03-21 02:57:07', '2026-03-21 03:00:05', '2026-03-21 03:00:05'),
(33, '6c3669be-aa53-4812-acbf-d3b733b6e1e4', 2, 'title', 'Title', 'text', 0, NULL, 1, 'title', 'title', 1, 0, 0, 0, 'Enter Section Title Here', '6', NULL, NULL, NULL, NULL, 1, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(34, '010d9ae2-39e4-4fdd-a350-4b979986fd34', 2, 'subtitle', 'Subtitle', 'text', 0, NULL, 1, 'subtitle', 'subtitle', 1, 0, 0, 0, 'Enter Section Subtitle Here', '6', NULL, NULL, NULL, NULL, 2, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(35, 'fc35ddb8-e1db-41d4-b802-dba773959268', 2, 'paragraphs[0][class]', 'Paragraph Class', 'text', 0, NULL, 1, 'paragraph_class', 'paragraph_class', 1, 0, 0, 0, 'Enter Class Of Paragraph First', '6', NULL, NULL, NULL, NULL, 3, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(36, '27ddfd29-0be3-496c-8e63-551bcdc552bc', 2, 'paragraphs[1][class]', 'Paragraph Class 1', NULL, 0, NULL, 1, 'paragraph_class_1', 'paragraph_class_1', 1, 0, 0, 0, 'Enter Class Of Paragraph Second', '6', NULL, NULL, NULL, NULL, 4, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(37, 'bc7a5b9e-80d1-4364-beb3-ee6f48992a21', 2, 'paragraphs[0][content]', 'Paragraph Content', 'textarea', 0, NULL, 1, 'description', 'paragraph_content', 1, 0, 1, 0, 'Enter Content Of Paragraph First', '6', NULL, NULL, NULL, NULL, 5, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(38, 'b9e7439d-5cdf-4fff-96dd-e26798cb6447', 2, 'paragraphs[1][content]', 'Paragraph Content 1', 'textarea', 0, NULL, 1, 'short_description', NULL, 1, 0, 1, 0, 'Enter Content Of Paragraph Second', '6', NULL, NULL, NULL, NULL, 6, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(39, '0084c62f-cb4b-4f42-8108-4fcae0930853', 2, 'vision[title]', 'Vision Title', 'text', 0, NULL, 1, 'vision_title', NULL, 0, 0, 0, 0, 'Enter Vision Title Here', '3', NULL, NULL, NULL, NULL, 7, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(40, '7b71ddee-181c-45d8-af38-f05a4a2ac611', 2, 'vision[icon]', 'Vision Icon', 'text', 0, NULL, 1, 'vision_icon', NULL, 1, 0, 0, 0, 'Enter Vision Icon Name', '3', NULL, NULL, NULL, NULL, 8, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(41, '0e93363c-06eb-4717-9e16-e9a4a7622847', 2, 'vision[stat_number]', 'Vision Stat Number', 'text', 0, NULL, 1, 'v_stat_number', 'v_stat_number', 0, 0, 0, 0, 'Enter Vision Stat Number Here', '3', NULL, NULL, NULL, NULL, 9, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(42, 'd4cceb1e-bd90-4e56-b872-f852ac2b329e', 2, 'vision[stat_label]', 'Vision Stat Label', 'text', 0, NULL, 1, 'v_stat_lable', 'v_stat_lable', 0, 0, 0, 0, 'Entet Vision Stat Label', '3', NULL, NULL, NULL, NULL, 10, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(43, 'a73d1cfc-9727-4849-a13b-314ca0f7be08', 2, 'vision[content]', 'Vision Content', 'textarea', 0, NULL, 1, 'v_content', 'v_content', 1, 0, 0, 0, 'Enter Vision Content Here', '12', NULL, NULL, NULL, NULL, 11, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(44, '80129d92-0f5d-407d-83e8-4a54efd0a208', 2, 'mission[title]', 'Mission Title', 'text', 0, NULL, 1, 'm_title', 'm_title', 1, 0, 0, 0, 'Enter Mission Title Here', '3', NULL, NULL, NULL, NULL, 12, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(45, '9f078c9f-d9c2-4757-b11a-23c8a5f6b8d1', 2, 'mission[icon]', 'Mission Icon', 'text', 0, NULL, 1, 'm_icon', 'm_icon', 1, 0, 0, 0, 'Enter Mission Icon Name', '3', NULL, NULL, NULL, NULL, 13, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(46, 'ebd2d470-c6cf-47c6-b1e4-d2668ad352b6', 2, 'mission[stat_number]', 'Mission Stat Number', 'text', 0, NULL, 1, 'm_stat_number', 'm_stat_number', 0, 0, 0, 0, 'Enter Mission Stat Number Here', '3', NULL, NULL, NULL, NULL, 14, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(47, '13773bde-6ec3-47e9-bf5f-9c6528ea7cde', 2, 'mission[stat_label]', 'Mission Stat Label', 'text', 0, NULL, 1, 'm_stat_label', 'm_stat_label', 0, 0, 0, 0, 'Enter Mission Stat Lable Here', '3', NULL, NULL, NULL, NULL, 15, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(48, '7db9105c-eb8b-4768-8b2d-b7a6be4dda69', 2, 'cta_text', 'Cta Text', 'text', 0, NULL, 1, 'cta_text', 'cta_text', 0, 0, 0, 0, 'Enter Cta Text Here', '12', NULL, NULL, NULL, NULL, 17, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(49, '39ff73a3-a119-45b4-9d93-834089e8e284', 2, 'mission[content]', 'Mission Content', 'textarea', 0, NULL, 1, 'short_description', 'm_content', 1, 0, 1, 0, 'Enter Mission Content Here', '12', NULL, NULL, NULL, NULL, 16, 1, '2026-03-21 03:00:05', '2026-03-21 03:00:05', NULL),
(50, 'f633d7ae-9655-4cf9-89fb-b9dce2e1be6e', 1, 'background_url', 'Background Url', 'text', 0, NULL, 1, NULL, NULL, 1, 0, 0, 0, 'Enter Background Image url', '6', NULL, NULL, NULL, NULL, 1, 1, '2026-03-21 04:00:20', '2026-03-21 04:00:20', NULL),
(51, '73dc47e5-7c21-404d-aaf3-dc69762d9967', 1, 'video_url', 'Video Url', 'text', 0, NULL, 1, 'v_url', 'v_url', 1, 0, 0, 0, 'Enter Video Url Here', '6', NULL, NULL, NULL, NULL, 2, 1, '2026-03-21 04:00:20', '2026-03-21 04:00:20', NULL),
(52, '777557b2-f2b8-480f-a26d-23f9b5c3af96', 1, 'title', 'Title', 'text', 0, NULL, 1, 'title', 'title', 1, 0, 0, 0, 'Enter video Section Title Here', '6', NULL, NULL, NULL, NULL, 3, 1, '2026-03-21 04:00:20', '2026-03-21 04:00:20', NULL),
(53, '975825e0-6935-428e-bc37-bf68a598db35', 1, 'button_label', 'Button Label', 'text', 0, NULL, 1, 'b_label', NULL, 1, 0, 0, 0, 'Enter Button Lable Here', '6', NULL, NULL, NULL, NULL, 5, 1, '2026-03-21 04:00:20', '2026-03-21 04:00:20', NULL),
(54, 'd790a266-c5db-48d1-b41a-b44309dd71f2', 1, 'content', 'Content', 'textarea', 0, NULL, 1, 'content', 'content', 1, 0, 1, 0, 'Enter Vidoe Section Content Here', '12', NULL, NULL, NULL, NULL, 6, 1, '2026-03-21 04:00:20', '2026-03-21 04:00:20', NULL),
(55, '5759bf14-a33f-4e79-9565-f2304b684778', 5, 'title', 'Title', 'text', 0, NULL, 1, 'title', 'title', 1, 0, 0, 0, 'Enter Title Here', '6', NULL, NULL, NULL, NULL, 0, 1, '2026-03-21 04:16:50', '2026-03-21 04:16:50', NULL),
(56, 'a3fff20c-3d8c-42ba-bd5f-2d63de171ca1', 5, 'subtitle', 'Subtitle', 'text', 0, NULL, 1, 'subtitle', 'subtitle', 1, 0, 0, 0, 'Enter Subtitle here', '6', NULL, NULL, NULL, NULL, 1, 1, '2026-03-21 04:16:50', '2026-03-21 04:16:50', NULL),
(57, '3c273296-2042-433c-885e-a4e99d18bf7e', 6, 'label', 'Label', 'text', 0, NULL, 1, NULL, NULL, 1, 0, 0, 0, NULL, '12', NULL, NULL, '[]', NULL, 0, 1, '2026-07-16 06:24:10', '2026-07-16 06:24:11', '2026-07-16 06:24:11'),
(58, '789f8e9c-a0d1-434e-a30e-06f1f8667c6f', 6, 'title', 'Title', 'text', 0, NULL, 1, NULL, NULL, 1, 0, 0, 0, NULL, '12', NULL, NULL, '[]', NULL, 1, 1, '2026-07-16 06:24:10', '2026-07-16 06:24:11', '2026-07-16 06:24:11'),
(59, '0c21c805-fa8f-4846-a113-2e57aa653bda', 6, 'subtitle', 'Subtitle', 'text', 0, NULL, 1, NULL, NULL, 1, 0, 0, 0, NULL, '12', NULL, NULL, '[]', NULL, 2, 1, '2026-07-16 06:24:10', '2026-07-16 06:24:11', '2026-07-16 06:24:11'),
(60, 'ca431d9a-6b68-4e3a-9c7e-4f2aeb7f6048', 6, 'description', 'Description', 'textarea', 0, NULL, 1, NULL, NULL, 0, 0, 1, 0, NULL, '12', NULL, NULL, '[]', NULL, 2, 1, '2026-07-16 06:24:11', '2026-07-16 06:24:11', '2026-07-16 06:24:11'),
(61, '62ef9184-f86c-499c-9d9b-ada04b71bb00', 7, 'section_label', 'Section Label', 'text', 0, NULL, 1, NULL, NULL, 1, 0, 0, 0, NULL, '12', NULL, NULL, NULL, NULL, 0, 1, '2026-07-16 06:34:35', '2026-07-16 06:34:35', '2026-07-16 06:34:35'),
(62, '716bfbc9-069a-438a-9484-90155f297630', 7, 'section_title', 'Section Title', 'text', 0, NULL, 1, NULL, NULL, 1, 0, 0, 0, NULL, '12', NULL, NULL, NULL, NULL, 1, 1, '2026-07-16 06:34:35', '2026-07-16 06:34:35', '2026-07-16 06:34:35'),
(63, '05637e65-848a-486b-9e37-5d08e3d18e53', 7, 'section_subtitle', 'Section Subtitle', 'text', 0, NULL, 1, NULL, NULL, 1, 0, 0, 0, NULL, '12', NULL, NULL, NULL, NULL, 2, 1, '2026-07-16 06:34:35', '2026-07-16 06:34:35', '2026-07-16 06:34:35'),
(64, '0c5e0dc6-a129-46a3-9857-44f06881b460', 8, 'section_label', 'Section Label', 'text', 0, NULL, 1, NULL, NULL, 1, 0, 0, 0, NULL, '12', NULL, NULL, '[]', NULL, 0, 1, '2026-07-16 06:36:51', '2026-07-16 06:36:52', '2026-07-16 06:36:52'),
(65, 'ab0d19bc-0db3-401c-8484-595bf6dc5617', 8, 'section_title', 'Section Title', 'text', 0, NULL, 1, NULL, NULL, 1, 0, 0, 0, NULL, '12', NULL, NULL, '[]', NULL, 1, 1, '2026-07-16 06:36:51', '2026-07-16 06:36:52', '2026-07-16 06:36:52'),
(66, '445857fa-4e98-4125-98d8-8e32d641c1e4', 8, 'section_subtitle', 'Section Subtitle', 'text', 0, NULL, 1, NULL, NULL, 1, 0, 0, 0, NULL, '12', NULL, NULL, '[]', NULL, 2, 1, '2026-07-16 06:36:51', '2026-07-16 06:36:52', '2026-07-16 06:36:52'),
(67, 'dee3dcd5-12e3-4f0c-98cd-d9699154bd19', 8, 'description', 'Description', 'textarea', 0, NULL, 1, NULL, NULL, 0, 0, 1, 0, NULL, '12', NULL, NULL, '[]', NULL, 3, 1, '2026-07-16 06:36:51', '2026-07-16 06:36:52', '2026-07-16 06:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `google_reviews`
--

CREATE TABLE `google_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `google_review_id` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_photo_url` varchar(255) DEFAULT NULL,
  `author_url` varchar(255) DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `review_text` text DEFAULT NULL,
  `relative_time_description` varchar(255) DEFAULT NULL,
  `language` varchar(10) DEFAULT NULL,
  `review_time` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `fetched_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `industries`
--

CREATE TABLE `industries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `industries`
--

INSERT INTO `industries` (`id`, `uuid`, `category_id`, `name`, `slug`, `icon`, `image`, `image_alt`, `description`, `meta_title`, `meta_description`, `is_active`, `is_featured`, `display_order`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '20fbc152-e1b3-4aec-9c79-14d06bda93b3', 1, 'Healthcare & Medical Services', 'healthcare-medical-services', 'bx bxs-hospital', NULL, NULL, 'We build patient portals, clinic management systems, and appointment platforms that reduce administrative load without compromising data privacy or compliance.', 'Healthcare & Medical Services Software & Digital Solutions | Deovate', 'We build patient portals, clinic management systems, and appointment platforms that reduce administrative load without compromising data privacy or compliance.', 1, 1, 1, 0, '2026-07-21 05:35:41', '2026-07-21 05:35:41', NULL),
(2, '6b0cd645-cec2-493f-80ec-f54880e83f6f', 1, 'Telemedicine & Digital Health', 'telemedicine-digital-health', 'bx bx-video', NULL, NULL, 'From video consultation platforms to remote monitoring dashboards, we build the software that lets healthcare providers reach patients wherever they are.', 'Telemedicine & Digital Health Software & Digital Solutions | Deovate', 'From video consultation platforms to remote monitoring dashboards, we build the software that lets healthcare providers reach patients wherever they are.', 1, 0, 2, 0, '2026-07-21 05:35:41', '2026-07-21 05:35:41', NULL),
(3, 'c3708c12-8012-4027-809f-75f44dd9dab6', 2, 'Banking & Financial Services', 'banking-financial-services', 'bx bx-bank', NULL, NULL, 'We build secure banking portals, loan management systems, and financial dashboards engineered around strict compliance and data protection requirements.', 'Banking & Financial Services Software & Digital Solutions | Deovate', 'We build secure banking portals, loan management systems, and financial dashboards engineered around strict compliance and data protection requirements.', 1, 1, 1, 0, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(4, 'b5c27318-883c-4553-aa78-8ceca38c0cf2', 2, 'FinTech & Digital Payments', 'fintech-digital-payments', 'bx bx-credit-card', NULL, NULL, 'From payment gateways to digital wallets, we build FinTech products that move money reliably, securely, and at the speed modern users expect.', 'FinTech & Digital Payments Software & Digital Solutions | Deovate', 'From payment gateways to digital wallets, we build FinTech products that move money reliably, securely, and at the speed modern users expect.', 1, 0, 2, 0, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(5, '626b6f23-06ea-48b0-995c-986a704f41f7', 3, 'Retail & eCommerce', 'retail-ecommerce', 'bx bx-store', NULL, NULL, 'We build and optimize online stores engineered around real buying behavior, from product discovery through checkout, so browsers actually become buyers.', 'Retail & eCommerce Software & Digital Solutions | Deovate', 'We build and optimize online stores engineered around real buying behavior, from product discovery through checkout, so browsers actually become buyers.', 1, 1, 1, 0, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(6, 'db93def9-9bbe-496b-90c6-ea35bf1ff28d', 3, 'Fashion & Lifestyle Brands', 'fashion-lifestyle-brands', 'bx bx-shopping-bag', NULL, NULL, 'We build visually driven storefronts and catalog experiences suited to fashion and lifestyle brands, where presentation directly drives purchase decisions.', 'Fashion & Lifestyle Brands Software & Digital Solutions | Deovate', 'We build visually driven storefronts and catalog experiences suited to fashion and lifestyle brands, where presentation directly drives purchase decisions.', 1, 0, 2, 0, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(7, '5001660d-3c9a-4cd2-a3e5-d657eddf6d1d', 4, 'Real Estate', 'real-estate', 'bx bx-building-house', NULL, NULL, 'We build property listing platforms, agent CRMs, and lead management systems that help real estate businesses convert inquiries into closed deals.', 'Real Estate Software & Digital Solutions | Deovate', 'We build property listing platforms, agent CRMs, and lead management systems that help real estate businesses convert inquiries into closed deals.', 1, 0, 1, 0, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(8, 'cfc2504b-9213-4941-977c-520fd9480301', 4, 'Construction & Infrastructure', 'construction-infrastructure', 'bx bx-buildings', NULL, NULL, 'We build project tracking, procurement, and resource management software that brings order to complex, multi-site construction operations.', 'Construction & Infrastructure Software & Digital Solutions | Deovate', 'We build project tracking, procurement, and resource management software that brings order to complex, multi-site construction operations.', 1, 0, 2, 0, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(9, 'e64a13d6-5359-49f8-ab8d-d2832857d14c', 5, 'Education & EdTech', 'education-edtech', 'bx bx-book-open', NULL, NULL, 'We build learning management systems and institutional platforms that make enrollment, coursework, and communication simpler for schools and edtech businesses.', 'Education & EdTech Software & Digital Solutions | Deovate', 'We build learning management systems and institutional platforms that make enrollment, coursework, and communication simpler for schools and edtech businesses.', 1, 1, 1, 0, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(10, '4eff69ce-3c62-4906-9d54-ff280c429e47', 5, 'Online Learning Platforms', 'online-learning-platforms', 'bx bx-laptop', NULL, NULL, 'From course delivery to student progress tracking, we build online learning platforms designed to keep learners engaged and coming back.', 'Online Learning Platforms Software & Digital Solutions | Deovate', 'From course delivery to student progress tracking, we build online learning platforms designed to keep learners engaged and coming back.', 1, 0, 2, 0, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(11, 'e8c55100-282f-4faa-b00c-17cb83a7e766', 6, 'Travel & Tourism', 'travel-tourism', 'bx bx-plane', NULL, NULL, 'We build booking engines and itinerary platforms that make planning and reserving travel simple, fast, and trustworthy for real customers.', 'Travel & Tourism Software & Digital Solutions | Deovate', 'We build booking engines and itinerary platforms that make planning and reserving travel simple, fast, and trustworthy for real customers.', 1, 0, 1, 0, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL),
(12, '68bb9589-9a9c-48d6-9882-b0ea34eeb4c3', 6, 'Hotels & Hospitality', 'hotels-hospitality', 'bx bxs-hotel', NULL, NULL, 'We build reservation systems and guest management platforms that help hospitality businesses run smoother operations and deliver a better guest experience.', 'Hotels & Hospitality Software & Digital Solutions | Deovate', 'We build reservation systems and guest management platforms that help hospitality businesses run smoother operations and deliver a better guest experience.', 1, 0, 2, 0, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL),
(13, 'e8f8e00a-3b1f-42c1-9c3b-a0654430e27d', 7, 'Logistics & Transportation', 'logistics-transportation', 'bx bx-package', NULL, NULL, 'We build shipment tracking, fleet management, and route optimization software that gives logistics businesses real visibility into their operations.', 'Logistics & Transportation Software & Digital Solutions | Deovate', 'We build shipment tracking, fleet management, and route optimization software that gives logistics businesses real visibility into their operations.', 1, 0, 1, 0, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL),
(14, 'c13cacfe-6183-47de-a837-0fee239f498b', 7, 'Supply Chain & Warehousing', 'supply-chain-warehousing', 'bx bxs-truck', NULL, NULL, 'We build inventory and warehouse management systems that keep stock counts accurate and supply chains running without costly manual guesswork.', 'Supply Chain & Warehousing Software & Digital Solutions | Deovate', 'We build inventory and warehouse management systems that keep stock counts accurate and supply chains running without costly manual guesswork.', 1, 0, 2, 0, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL),
(15, '18805d94-5f6f-47cc-9b7b-efd07ffb059a', 8, 'Manufacturing', 'manufacturing', 'bx bx-cog', NULL, NULL, 'We build production tracking, quality control, and inventory systems that bring manufacturing operations out of spreadsheets and into real-time visibility.', 'Manufacturing Software & Digital Solutions | Deovate', 'We build production tracking, quality control, and inventory systems that bring manufacturing operations out of spreadsheets and into real-time visibility.', 1, 0, 1, 0, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL),
(16, 'fd3d684a-b510-4c3b-9b0f-3059d7f665f1', 8, 'Automotive', 'automotive', 'bx bx-car', NULL, NULL, 'From dealership management to service scheduling platforms, we build software that helps automotive businesses run more organized daily operations.', 'Automotive Software & Digital Solutions | Deovate', 'From dealership management to service scheduling platforms, we build software that helps automotive businesses run more organized daily operations.', 1, 0, 2, 0, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL),
(17, '347492c8-0553-40bb-917e-fb6f273ad80d', 9, 'Media & Entertainment', 'media-entertainment', 'bx bx-camera', NULL, NULL, 'We build content platforms and audience engagement tools for media businesses that need to publish, distribute, and monetize content reliably.', 'Media & Entertainment Software & Digital Solutions | Deovate', 'We build content platforms and audience engagement tools for media businesses that need to publish, distribute, and monetize content reliably.', 1, 0, 1, 0, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL),
(18, '961f2b83-94a3-4eb5-b65d-7b0d7ff8c92a', 9, 'Legal & Professional Services', 'legal-professional-services', 'bx bx-briefcase', NULL, NULL, 'We build client portals, case management, and document workflow systems that help legal and professional service firms stay organized and responsive.', 'Legal & Professional Services Software & Digital Solutions | Deovate', 'We build client portals, case management, and document workflow systems that help legal and professional service firms stay organized and responsive.', 1, 0, 2, 0, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL),
(19, '2a97bdc1-cd31-46ef-b4a0-cb17294d3f41', 9, 'Non-Profit & NGOs', 'non-profit-ngos', 'bx bx-heart', NULL, NULL, 'We build donor management, volunteer coordination, and outreach platforms that help non-profits run efficiently on limited budgets and teams.', 'Non-Profit & NGOs Software & Digital Solutions | Deovate', 'We build donor management, volunteer coordination, and outreach platforms that help non-profits run efficiently on limited budgets and teams.', 1, 0, 3, 0, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `industry_categories`
--

CREATE TABLE `industry_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `industry_categories`
--

INSERT INTO `industry_categories` (`id`, `uuid`, `name`, `slug`, `icon`, `description`, `is_active`, `display_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '3cb21867-2be5-427b-bbe4-4d030ec46503', 'Healthcare & Life Sciences', 'healthcare-life-sciences', 'bx bxs-hospital', 'Digital solutions for healthcare providers, clinics, and health-tech businesses that need software people can actually trust with sensitive information.', 1, 1, '2026-07-21 05:35:41', '2026-07-21 05:35:41', NULL),
(2, 'd51324d3-4a14-4bee-ae53-fb1b276c6e7c', 'Finance & FinTech', 'finance-fintech', 'bx bx-bank', 'Secure, compliant software for banks, lenders, and financial technology companies handling money and sensitive data at scale.', 1, 2, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(3, 'd54ed418-ee67-4d92-855b-de5448e20970', 'Retail & eCommerce', 'retail-ecommerce', 'bx bx-store', 'Online stores and retail platforms built around conversion, inventory accuracy, and a checkout experience customers actually complete.', 1, 3, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(4, '1452cae8-d2ce-4f97-af2d-b04e64406bb7', 'Real Estate & Construction', 'real-estate-construction', 'bx bx-building-house', 'Property listing platforms, CRM systems, and project management tools built for how real estate and construction businesses actually operate.', 1, 4, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(5, 'ab200d30-c8cd-4bb3-8478-79e5d02e70fe', 'Education & EdTech', 'education-edtech', 'bx bx-book-open', 'Learning platforms and institutional software built for how students, educators, and administrators actually use technology day to day.', 1, 5, '2026-07-21 05:35:42', '2026-07-21 05:35:42', NULL),
(6, '11aee0e9-3385-4366-b196-24232299ad7f', 'Travel & Hospitality', 'travel-hospitality', 'bx bx-plane', 'Booking platforms and guest management systems built for travel, tourism, and hospitality businesses that live and die by a smooth customer experience.', 1, 6, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL),
(7, 'e6dff9ff-4401-47fe-aafc-f77b67290cd6', 'Logistics & Supply Chain', 'logistics-supply-chain', 'bx bx-package', 'Tracking, routing, and warehouse management software built for businesses that move goods and need to know exactly where everything is.', 1, 7, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL),
(8, '9ab0ccaa-7ec3-4275-933e-28d540d71b8c', 'Manufacturing & Automotive', 'manufacturing-automotive', 'bx bx-cog', 'Production tracking and operational software built for manufacturers and automotive businesses managing complex, multi-stage processes.', 1, 8, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL),
(9, '6150935f-1fb5-4c47-bce5-4e3333dedb79', 'Media & Professional Services', 'media-professional-services', 'bx bx-briefcase', 'Platforms and internal tools built for agencies, media businesses, legal practices, and non-profits managing client work and public trust alike.', 1, 9, '2026-07-21 05:35:43', '2026-07-21 05:35:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `model_type` varchar(255) DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `collection` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL DEFAULT 'public',
  `path` varchar(255) NOT NULL,
  `size` bigint(20) UNSIGNED DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_properties`)),
  `conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`conversions`)),
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `uploaded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `uuid`, `model_type`, `model_id`, `collection`, `name`, `file_name`, `mime_type`, `disk`, `path`, `size`, `width`, `height`, `duration`, `alt_text`, `caption`, `is_featured`, `is_private`, `is_active`, `display_order`, `custom_properties`, `conversions`, `meta`, `uploaded_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '3d32cdd5-70db-4da1-96ec-4bb9baa375e6', 'App\\Models\\Blog', 1, 'test-gallery', 'gallery-1', 'cf2e64b8-3a09-4923-8db7-fdf9bf559d55.jpg', 'image/jpeg', 'public', 'test-uploads/gallery/cf2e64b8-3a09-4923-8db7-fdf9bf559d55.jpg', 11779, 1000, 700, NULL, NULL, NULL, 0, 0, 1, 1, NULL, '{\"thumb\":\"test-uploads\\/gallery\\/cf2e64b8-3a09-4923-8db7-fdf9bf559d55_thumb.jpg\"}', NULL, NULL, '2026-07-13 02:15:38', '2026-07-13 02:15:39', '2026-07-13 02:15:39'),
(2, 'f8fb6084-d8c5-4a88-9f00-ef388236f7ac', 'App\\Models\\Blog', 1, 'test-gallery', 'gallery-2', 'ab80fb16-b065-4afe-b90d-f47b565d42dc.jpg', 'image/jpeg', 'public', 'test-uploads/gallery/ab80fb16-b065-4afe-b90d-f47b565d42dc.jpg', 13687, 900, 900, NULL, NULL, NULL, 0, 0, 1, 2, NULL, '{\"thumb\":\"test-uploads\\/gallery\\/ab80fb16-b065-4afe-b90d-f47b565d42dc_thumb.jpg\"}', NULL, NULL, '2026-07-13 02:15:38', '2026-07-13 02:15:39', '2026-07-13 02:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `media_relations`
--

CREATE TABLE `media_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection` varchar(255) DEFAULT NULL,
  `usage` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `linked_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_relations`
--

INSERT INTO `media_relations` (`id`, `uuid`, `media_id`, `model_type`, `model_id`, `collection`, `usage`, `tag`, `is_primary`, `is_featured`, `is_active`, `display_order`, `meta`, `linked_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '06aeecbe-c5b4-40ae-9ebc-b00bfcf33782', 1, 'App\\Models\\Blog', 1, 'test-gallery', NULL, NULL, 1, 0, 1, 1, NULL, NULL, '2026-07-13 02:15:38', '2026-07-13 02:15:39', '2026-07-13 02:15:39'),
(2, '20ae5d7f-8612-4d0b-81b8-af6c834923b2', 2, 'App\\Models\\Blog', 1, 'test-gallery', NULL, NULL, 0, 0, 1, 2, NULL, NULL, '2026-07-13 02:15:38', '2026-07-13 02:15:39', '2026-07-13 02:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_03_080020_create_authors_table', 1),
(5, '2026_01_04_072647_create_blogs_categoories_table', 1),
(6, '2026_01_04_072838_create_blogs_table', 1),
(7, '2026_01_04_075945_create_tags_table', 1),
(8, '2026_01_04_075956_create_blog_tags_table', 1),
(9, '2026_01_04_080035_create_comments_table', 1),
(10, '2026_01_04_080612_create_careers_table', 1),
(11, '2026_01_04_080637_create_resumes_table', 1),
(12, '2026_01_04_080731_create_career_applications_table', 1),
(13, '2026_01_04_080806_create_application_status_logs_table', 1),
(14, '2026_01_04_080941_create_enquiries_table', 1),
(15, '2026_01_04_083620_create_email_templates_table', 1),
(16, '2026_01_04_083742_create_emails_table', 1),
(17, '2026_01_04_083923_create_email_logs_table', 1),
(18, '2026_01_04_085410_create_smtp_settings_table', 1),
(19, '2026_01_04_085803_create_testimonials_table', 1),
(20, '2026_01_04_090012_create_reviews_table', 1),
(21, '2026_01_04_090330_create_services_table', 1),
(22, '2026_01_04_090414_create_service_faqs_table', 1),
(23, '2026_01_04_090459_create_service_challenges_table', 1),
(24, '2026_01_04_090732_create_service_platforms_table', 1),
(25, '2026_01_04_094124_create_technologies_category_table', 1),
(26, '2026_01_04_094131_create_technologies_table', 1),
(27, '2026_01_04_094136_create_service_technology_table', 1),
(28, '2026_01_04_095002_create_case_study_categories_table', 1),
(29, '2026_01_04_095015_create_case_study_table', 1),
(30, '2026_01_04_095347_create_social_links_table', 1),
(31, '2026_01_04_095725_create_skills_table', 1),
(32, '2026_01_04_095742_create_industries_table', 1),
(33, '2026_01_04_100852_create_portfolio_categories_table', 1),
(34, '2026_01_04_100916_create_portfolios_table', 1),
(35, '2026_01_04_101006_create_portfolio_skills_table', 1),
(36, '2026_01_04_101257_create_portfolio_images_table', 1),
(37, '2026_01_04_101506_create_service_features_table', 1),
(38, '2026_01_04_101854_create_auth_log_table', 1),
(39, '2026_01_04_101946_create_newsletter_subscribers_table', 1),
(40, '2026_01_04_102050_create_partners_table', 1),
(41, '2026_01_04_102254_create_site_settings_table', 1),
(42, '2026_01_04_102338_create_notification_logs_table', 1),
(43, '2026_01_04_102436_create_system_logs_table', 1),
(44, '2026_01_06_162717_create_templates_table', 1),
(45, '2026_01_06_162848_create_sections_table', 1),
(46, '2026_01_06_163003_create_forms_table', 1),
(47, '2026_01_06_163038_create_form_fields_table', 1),
(48, '2026_01_06_163130_create_template_forms_table', 1),
(49, '2026_01_06_163232_create_pages_table', 1),
(50, '2026_01_06_163305_create_page_sections_table', 1),
(51, '2026_01_09_195554_create_crm_lead_statuses_table', 1),
(52, '2026_01_09_195555_create_crm_lead_sources_table', 1),
(53, '2026_01_09_195556_create_crm_leads_table', 1),
(54, '2026_01_09_195556_create_permissions_table', 1),
(55, '2026_01_09_195557_create_crm_payment_methods_table', 1),
(56, '2026_01_09_200513_create_crm_clients_table', 1),
(57, '2026_01_09_200514_create_crm_deals_table', 1),
(58, '2026_01_09_200515_create_crm_lead_activities_table', 1),
(59, '2026_01_09_200533_create_crm_client_contacts_table', 1),
(60, '2026_01_09_200534_create_crm_client_notes_table', 1),
(61, '2026_01_09_200535_create_crm_projects_table', 1),
(62, '2026_01_09_200536_create_crm_client_documents_table', 1),
(63, '2026_01_09_200545_create_crm_project_members_table', 1),
(64, '2026_01_09_200546_create_crm_project_milestones_table', 1),
(65, '2026_01_09_200547_create_crm_project_tasks_table', 1),
(66, '2026_01_09_200548_create_crm_task_comments_table', 1),
(67, '2026_01_09_200558_create_crm_invoices_table', 1),
(68, '2026_01_09_200559_create_crm_invoice_items_table', 1),
(69, '2026_01_09_200600_create_crm_payments_table', 1),
(70, '2026_01_09_200601_create_crm_expenses_categories_table', 1),
(71, '2026_01_09_200602_create_crm_expenses_table', 1),
(72, '2026_01_09_200612_create_role_permissions_table', 1),
(73, '2026_01_09_200613_create_user_permissions_table', 1),
(74, '2026_01_09_200622_create_activity_logs_table', 1),
(75, '2026_01_09_200623_create_media_table', 1),
(76, '2026_01_09_200624_create_media_relations_table', 1),
(77, '2026_01_10_113401_create_platforms_table', 2),
(78, '2026_01_04_090731_create_platforms_table', 3),
(79, '2026_01_10_114007_create_service_platforms_table', 3),
(80, '2026_01_04_090459_create_service_problems_table', 4),
(81, '2026_01_04_090627_create_service_solutions_table', 4),
(82, '2026_02_25_165422_add_browser_to_auth_logs_table', 4),
(83, '2026_03_01_081456_add_columns_to_application_status_logs_table', 5),
(84, '2026_01_31_062706_create_personal_access_tokens_table', 6),
(85, '2026_03_04_041547_create_enquiries_status_logs_table', 6),
(91, '2026_03_17_162744_create_faq_categories_table', 7),
(92, '2026_03_17_162753_create_faq_items_table', 7),
(93, '2026_03_19_100904_create_page_contents_table', 8),
(94, '2026_07_15_024040_add_alt_text_columns_to_image_fields', 9),
(95, '2026_07_15_090000_add_gallery_to_services_and_blogs_table', 10),
(96, '2026_07_15_100000_add_display_order_to_content_tables', 11),
(97, '2026_07_16_000000_create_section_contents_table', 12),
(98, '2026_07_16_010000_add_is_published_to_pages_table', 13),
(99, '2026_07_16_020000_create_page_section_links_table', 14),
(100, '2026_07_17_120814_add_read_tracking_to_enquiries_and_newsletter_subscribers_table', 15),
(101, '2026_07_16_150541_add_is_multiple_to_form_fields_table', 16),
(102, '2026_07_16_160000_add_group_and_croppie_to_form_fields_table', 16),
(103, '2026_07_17_090000_drop_content_settings_views_from_sections_table', 16),
(104, '2026_07_17_100000_create_page_section_contents_table', 16),
(105, '2026_07_17_110000_add_form_id_to_sections_table', 16),
(106, '2026_07_17_110500_make_template_id_nullable_on_sections_table', 16),
(107, '2026_07_21_104939_create_site_visits_table', 17),
(108, '2026_07_21_120000_fix_industries_tables_primary_keys', 18),
(109, '2026_07_21_110835_add_device_details_to_site_visits_table', 19),
(110, '2026_07_21_112731_create_google_reviews_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `emails_sent` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `last_email_sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `uuid`, `email`, `name`, `is_active`, `is_read`, `read_at`, `subscribed_at`, `unsubscribed_at`, `is_confirmed`, `confirmed_at`, `source`, `ip_address`, `user_agent`, `emails_sent`, `last_email_sent_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '8f4e0b44-7a7e-4f5d-8d0c-1d1b1f2e1111', 'john.doe@example.com', 'John Doe', 1, 0, NULL, '2026-03-01 04:45:00', NULL, 1, '2026-03-01 04:50:00', 'website', '192.168.1.1', 'Mozilla/5.0', 5, '2026-03-03 03:30:00', '2026-03-01 04:45:00', '2026-03-03 03:30:00', NULL),
(2, '5a2d6f52-3e22-4b8c-b9d1-1d1b1f2e2222', 'jane.smith@example.com', 'Jane Smith', 1, 0, NULL, '2026-03-01 05:30:00', NULL, 1, '2026-03-01 05:35:00', 'blog', '192.168.1.2', 'Mozilla/5.0', 3, '2026-03-02 03:00:00', '2026-03-01 05:30:00', '2026-03-02 03:00:00', NULL),
(3, '6c1e8a23-9a4b-4cbe-8c6a-1d1b1f2e3333', 'robert.brown@example.com', 'Robert Brown', 1, 0, NULL, '2026-03-01 06:30:00', NULL, 1, '2026-03-01 06:40:00', 'landing_page', '192.168.1.3', 'Mozilla/5.0', 4, '2026-03-03 02:15:00', '2026-03-01 06:30:00', '2026-03-03 02:15:00', NULL),
(4, 'b2c33d12-77f4-4a91-a4a7-1d1b1f2e4444', 'emily.jones@example.com', 'Emily Jones', 1, 0, NULL, '2026-03-01 08:00:00', NULL, 1, '2026-03-01 08:10:00', 'popup', '192.168.1.4', 'Mozilla/5.0', 2, '2026-03-02 04:45:00', '2026-03-01 08:00:00', '2026-03-02 04:45:00', NULL),
(5, 'e5d2a443-98c5-48f3-a8b1-1d1b1f2e5555', 'michael.taylor@example.com', 'Michael Taylor', 1, 0, NULL, '2026-03-01 08:50:00', NULL, 1, '2026-03-01 08:55:00', 'website', '192.168.1.5', 'Mozilla/5.0', 6, '2026-03-03 03:20:00', '2026-03-01 08:50:00', '2026-03-03 03:20:00', NULL),
(6, 'c0f6c02a-0d22-4c0a-a1de-1d1b1f2e6666', 'sarah.wilson@example.com', 'Sarah Wilson', 1, 0, NULL, '2026-03-01 09:30:00', NULL, 1, '2026-03-01 09:35:00', 'blog', '192.168.1.6', 'Mozilla/5.0', 1, '2026-03-02 03:50:00', '2026-03-01 09:30:00', '2026-03-02 03:50:00', NULL),
(7, '9a0b3c22-6a90-4c9a-bba7-1d1b1f2e7777', 'david.anderson@example.com', 'David Anderson', 1, 0, NULL, '2026-03-01 10:40:00', NULL, 1, '2026-03-01 10:45:00', 'landing_page', '192.168.1.7', 'Mozilla/5.0', 2, '2026-03-03 01:10:00', '2026-03-01 10:40:00', '2026-03-03 01:10:00', NULL),
(8, 'fa3e88e1-52aa-4c8c-bb4f-1d1b1f2e8888', 'olivia.martin@example.com', 'Olivia Martin', 1, 0, NULL, '2026-03-01 11:30:00', NULL, 1, '2026-03-01 11:40:00', 'popup', '192.168.1.8', 'Mozilla/5.0', 3, '2026-03-02 05:35:00', '2026-03-01 11:30:00', '2026-03-02 05:35:00', NULL),
(9, 'd9c3b7e5-2e6a-4c1a-b8c0-1d1b1f2e9999', 'william.thomas@example.com', 'William Thomas', 1, 0, NULL, '2026-03-01 12:55:00', NULL, 1, '2026-03-01 13:00:00', 'website', '192.168.1.9', 'Mozilla/5.0', 4, '2026-03-03 04:30:00', '2026-03-01 12:55:00', '2026-03-03 04:30:00', NULL),
(10, 'ab4c1d2f-4e66-4e1a-b1b7-1d1b1f2e1010', 'sophia.jackson@example.com', 'Sophia Jackson', 1, 0, NULL, '2026-03-01 13:40:00', NULL, 1, '2026-03-01 13:45:00', 'blog', '192.168.1.10', 'Mozilla/5.0', 2, '2026-03-02 06:30:00', '2026-03-01 13:40:00', '2026-03-04 08:57:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'info',
  `action_url` varchar(255) DEFAULT NULL,
  `action_text` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `channel` varchar(255) NOT NULL DEFAULT 'in_app',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `priority` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `template_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_keywords`)),
  `canonical_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `is_homepage` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `uuid`, `name`, `slug`, `title`, `description`, `template_id`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `is_active`, `is_published`, `is_homepage`, `display_order`, `published_at`, `created_by`, `updated_by`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '76a29d1a-9016-42b3-bf4f-535e0577594b', 'Home', 'home', 'Home', NULL, NULL, 'asdf', 'asfd', '[]', NULL, 1, 0, 0, 0, NULL, NULL, 1, 0, '2026-03-19 05:52:51', '2026-07-16 05:48:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_contents`
--

CREATE TABLE `page_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `form_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`settings`)),
  `display_order` int(11) NOT NULL DEFAULT 0,
  `position` varchar(255) DEFAULT NULL,
  `column` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `is_global` tinyint(1) NOT NULL DEFAULT 0,
  `device` varchar(255) DEFAULT NULL,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_sections`
--

CREATE TABLE `page_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `form_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_section_contents`
--

CREATE TABLE `page_section_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_section_links`
--

CREATE TABLE `page_section_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo_alt` varchar(255) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `uuid`, `name`, `slug`, `logo`, `logo_alt`, `website_url`, `type`, `industry`, `description`, `meta_title`, `meta_description`, `is_active`, `is_featured`, `display_order`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '898aaf40-f56f-4f52-9a47-15fa2440826b', 'sdgsfd sfgsf', 'sdgsfd-sfgsf', 'partners/898aaf40-f56f-4f52-9a47-15fa2440826b/1780557826_7.jpg', NULL, 'https://example.com', 'asdf', 'asd', NULL, NULL, NULL, 1, 1, 0, 0, '2026-06-04 01:53:46', '2026-06-04 01:55:46', '2026-06-04 01:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('abhiii2404@gmail.com', '$2y$12$bmkgfaWIDLgw56a0U7zLueeVehkvLzzC.AsgC3TojKMagYS.KKRjK', '2026-07-17 02:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `group` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_system` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `uuid`, `name`, `slug`, `group`, `module`, `action`, `description`, `display_order`, `is_system`, `is_active`, `meta`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '35a61328-bfed-44d0-8df9-a627d28352d2', 'Manage User', 'manage-user', 'test', 'test', 'create,edit,delete', 'asdfsd', 1, 0, 1, '[\"abc\",\"def\",\"ghi\"]', NULL, '2026-02-02 07:12:02', '2026-02-02 07:12:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `uuid`, `name`, `slug`, `icon`, `description`, `is_active`, `is_featured`, `display_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'e3b74a22-ee19-11f0-a0af-1860247b6ae0', 'Web', 'web', 'bx-globe', 'Web platform solutions for responsive, scalable, and SEO-friendly websites.', 1, 1, 1, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(2, 'e3b785f3-ee19-11f0-a0af-1860247b6ae0', 'Android', 'android', 'bx-android', 'Android platform development for high-performance mobile applications.', 1, 1, 2, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(3, 'e3b7885d-ee19-11f0-a0af-1860247b6ae0', 'iOS', 'ios', 'bx-apple', 'iOS platform development for secure and user-friendly Apple applications.', 1, 1, 3, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(4, 'e3b788f7-ee19-11f0-a0af-1860247b6ae0', 'Cross Platform', 'cross-platform', 'bx-devices', 'Cross-platform solutions using shared codebases for faster delivery.', 1, 1, 4, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(5, 'e3b7898d-ee19-11f0-a0af-1860247b6ae0', 'E-commerce', 'ecommerce', 'bx-cart', 'Ecommerce platforms for scalable online stores and digital commerce.', 1, 1, 5, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(6, 'e3b79481-ee19-11f0-a0af-1860247b6ae0', 'CMS', 'cms', 'bx-edit', 'Content Management Systems for easy content publishing and control.', 1, 0, 6, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(7, 'e3b7953d-ee19-11f0-a0af-1860247b6ae0', 'ERP', 'erp', 'bx-building', 'ERP platforms for enterprise resource planning and business automation.', 1, 1, 7, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(8, 'e3b795cb-ee19-11f0-a0af-1860247b6ae0', 'CRM', 'crm', 'bx-user-check', 'CRM platforms to manage customer relationships and sales pipelines.', 1, 1, 8, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(9, 'e3b7965b-ee19-11f0-a0af-1860247b6ae0', 'Cloud', 'cloud', 'bx-cloud', 'Cloud platforms for scalable infrastructure and application hosting.', 1, 1, 9, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(10, 'e3b796db-ee19-11f0-a0af-1860247b6ae0', 'API', 'api', 'bx-transfer', 'API platforms for system integration and data exchange.', 1, 0, 10, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(11, 'e3b79750-ee19-11f0-a0af-1860247b6ae0', 'DevOps', 'devops', 'bx-git-branch', 'DevOps platforms for CI/CD automation and deployment pipelines.', 1, 0, 11, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(12, 'e3b797c3-ee19-11f0-a0af-1860247b6ae0', 'AI & ML', 'ai-ml', 'bx-brain', 'AI and Machine Learning platforms for intelligent automation.', 1, 1, 12, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(13, 'e3b7983d-ee19-11f0-a0af-1860247b6ae0', 'IoT', 'iot', 'bx-chip', 'IoT platforms for connected devices and real-time data processing.', 1, 0, 13, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(14, 'e3b798be-ee19-11f0-a0af-1860247b6ae0', 'Blockchain', 'blockchain', 'bx-cube', 'Blockchain platforms for decentralized and secure applications.', 1, 0, 14, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(15, 'e3b7993b-ee19-11f0-a0af-1860247b6ae0', 'SaaS', 'saas', 'bx-layer', 'SaaS platforms for subscription-based software solutions.', 1, 1, 15, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(16, 'e3b799b3-ee19-11f0-a0af-1860247b6ae0', 'Big Data', 'big-data', 'bx-data', 'Big Data platforms for large-scale data analytics and insights.', 1, 0, 16, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(17, 'e3b79a2e-ee19-11f0-a0af-1860247b6ae0', 'FinTech', 'fintech', 'bx-credit-card', 'FinTech platforms for secure digital payments and finance solutions.', 1, 0, 17, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(18, 'e3b79ab4-ee19-11f0-a0af-1860247b6ae0', 'EdTech', 'edtech', 'bx-book', 'EdTech platforms for online learning and education management.', 1, 0, 18, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(19, 'e3b79b28-ee19-11f0-a0af-1860247b6ae0', 'HealthTech', 'healthtech', 'bx-heart', 'HealthTech platforms for healthcare management and digital health.', 1, 0, 19, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL),
(20, 'e3b79b9a-ee19-11f0-a0af-1860247b6ae0', 'MarTech', 'martech', 'bx-bullseye', 'MarTech platforms for digital marketing and analytics solutions.', 1, 0, 20, '2026-01-10 11:45:41', '2026-01-10 11:45:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `portfolio_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `project_url` varchar(255) DEFAULT NULL,
  `project_duration` varchar(255) DEFAULT NULL,
  `project_budget` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `featured_image_alt` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `banner_image_alt` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `video_url` varchar(255) DEFAULT NULL,
  `overview` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `challenges` longtext DEFAULT NULL,
  `solutions` longtext DEFAULT NULL,
  `results` longtext DEFAULT NULL,
  `project_type` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_keywords`)),
  `canonical_url` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `uuid`, `portfolio_category_id`, `title`, `slug`, `client_name`, `project_url`, `project_duration`, `project_budget`, `featured_image`, `featured_image_alt`, `banner_image`, `banner_image_alt`, `gallery`, `video_url`, `overview`, `description`, `challenges`, `solutions`, `results`, `project_type`, `industry`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `is_featured`, `is_active`, `display_order`, `views`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '25c19966-19f0-11f1-82cc-484d7ed9887c', 1, 'Website Redesign bx-home', 'website-redesign', 'Acme Corp', 'https://acme.com', '3 months', '5000', 'featured1.jpg', NULL, 'banner1.jpg', NULL, '[\"gallery1.jpg\",\"gallery2.jpg\"]', 'https://youtu.be/video1', 'Overview 1', 'Description 1', 'Challenges 1', 'Solutions 1', 'Results 1', 'Web', 'Technology', 'Meta Title 1', 'Meta Description 1', '[\"bx-home\",\"bxl-html\"]', 'https://acme.com/portfolio', 1, 1, 1, 100, '2025-12-31 18:30:00', '2026-03-07 06:36:21', '2026-03-07 06:36:21', NULL),
(2, '25c3e87d-19f0-11f1-82cc-484d7ed9887c', 2, 'Mobile App Development bx-mobile', 'mobile-app-development-bx-mobile', 'Beta Ltd', 'https://beta.com', '6 months', '12000', 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/1772871706_blog2-1.jpg', NULL, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/banner/1772882071_blog-2.jpg', NULL, '[\"portfolios\\/25c3e87d-19f0-11f1-82cc-484d7ed9887c\\/gallery\\/1780553074_fhukNDHe.jpg\",\"portfolios\\/25c3e87d-19f0-11f1-82cc-484d7ed9887c\\/gallery\\/1780553074_VfTa7aXg.jpg\"]', 'https://youtu.be/video2', 'Overview 2', '<p>Description 2</p>', 'Challenges 2', 'Solutions 2', 'Results 2', 'Mobile', 'Finance', 'Meta Title 2', 'Meta Description 2', NULL, 'https://beta.com/portfolio', 0, 1, 2, 250, '2026-01-04 18:30:00', '2026-03-07 06:37:20', '2026-06-04 01:59:07', NULL),
(3, '25c3e9a4-19f0-11f1-82cc-484d7ed9887c', 3, 'E-commerce Platform bx-cart', 'ecommerce-platform', 'Gamma Inc', 'https://gamma.com', '4 months', '8000', 'portfolios/25c3e9a4-19f0-11f1-82cc-484d7ed9887c/1772872037_blog-2.jpg', NULL, 'portfolios/25c3e9a4-19f0-11f1-82cc-484d7ed9887c/banner/1772881439_blog2-1.jpg', NULL, '[\"gallery5.jpg\",\"gallery6.jpg\"]', 'https://youtu.be/video3', 'Overview 3', '<p>Description 3</p>', 'Challenges 3', 'Solutions 3', 'Results 3', 'Web', 'Retail', 'Meta Title 3', 'Meta Description 3', '\"[\\\"[\\\\\\\"bx-cart\\\\\\\"\\\",\\\"\\\\\\\"bxl-shopify\\\\\\\"]\\\"]\"', 'https://gamma.com/portfolio', 1, 1, 3, 180, '2026-01-09 18:30:00', '2026-03-07 06:37:20', '2026-06-03 01:10:20', NULL),
(4, '25c3ea37-19f0-11f1-82cc-484d7ed9887c', 4, 'Brand Identity bx-paint', 'brand-identity', 'Delta Studio', 'https://delta.com', '2 months', '3000', 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/1780467029_4.jpg', NULL, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/banner/1780467029_5.jpg', NULL, '[\"portfolios\\/25c3ea37-19f0-11f1-82cc-484d7ed9887c\\/gallery\\/1780468249_t54dK75v.jpg\",\"portfolios\\/25c3ea37-19f0-11f1-82cc-484d7ed9887c\\/gallery\\/1780468249_2EYtMP8N.jpg\",\"portfolios\\/25c3ea37-19f0-11f1-82cc-484d7ed9887c\\/gallery\\/1780468249_tbV37Yyz.jpg\",\"portfolios\\/25c3ea37-19f0-11f1-82cc-484d7ed9887c\\/gallery\\/1780468249_nmTlHwid.jpg\",\"portfolios\\/25c3ea37-19f0-11f1-82cc-484d7ed9887c\\/gallery\\/1780468249_LfPtYEOv.jpg\",\"portfolios\\/25c3ea37-19f0-11f1-82cc-484d7ed9887c\\/gallery\\/1780468249_6kefSxCU.jpg\",\"portfolios\\/25c3ea37-19f0-11f1-82cc-484d7ed9887c\\/gallery\\/1780468249_23FLodvy.jpg\"]', 'https://youtu.be/video4', 'Overview 4', '<p>Description 4</p>', 'Challenges 4', 'Solutions 4', 'Results 4', 'Design', 'Creative', 'Meta Title 4', 'Meta Description 4', '[\"bx-paint\",\"bxl-illustrator\",\"abc\"]', 'https://delta.com/portfolio', 0, 1, 4, 90, '2026-01-11 18:30:00', '2026-03-07 06:37:20', '2026-06-04 00:27:08', NULL),
(5, '25c3ebb7-19f0-11f1-82cc-484d7ed9887c', 5, 'SEO Optimization bx-search', 'seo-optimization', 'Epsilon Co', 'https://epsilon.com', '1 month', '2000', 'featured5.jpg', NULL, 'banner5.jpg', NULL, '[\"gallery9.jpg\",\"gallery10.jpg\"]', 'https://youtu.be/video5', 'Overview 5', 'Description 5', 'Challenges 5', 'Solutions 5', 'Results 5', 'Marketing', 'Technology', 'Meta Title 5', 'Meta Description 5', '[\"bx-search\",\"bxl-google\"]', 'https://epsilon.com/portfolio', 1, 1, 5, 300, '2026-01-14 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(6, '25c3ec4d-19f0-11f1-82cc-484d7ed9887c', 6, 'Custom CRM bx-database', 'custom-crm', 'Zeta Systems', 'https://zeta.com', '5 months', '15000', 'featured6.jpg', NULL, 'banner6.jpg', NULL, '[\"gallery11.jpg\",\"gallery12.jpg\"]', 'https://youtu.be/video6', 'Overview 6', 'Description 6', 'Challenges 6', 'Solutions 6', 'Results 6', 'Web', 'Enterprise', 'Meta Title 6', 'Meta Description 6', '[\"bx-database\",\"bxl-microsoft\"]', 'https://zeta.com/portfolio', 0, 1, 6, 75, '2026-01-17 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(7, '25c3ecce-19f0-11f1-82cc-484d7ed9887c', 7, 'Social Media Campaign bx-share', 'social-media-campaign', 'Eta Media', 'https://eta.com', '3 weeks', '1000', 'featured7.jpg', NULL, 'banner7.jpg', NULL, '[\"gallery13.jpg\",\"gallery14.jpg\"]', 'https://youtu.be/video7', 'Overview 7', 'Description 7', 'Challenges 7', 'Solutions 7', 'Results 7', 'Marketing', 'Media', 'Meta Title 7', 'Meta Description 7', '[\"bx-share\",\"bxl-facebook\"]', 'https://eta.com/portfolio', 1, 1, 7, 220, '2026-01-19 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(8, '25c3ed83-19f0-11f1-82cc-484d7ed9887c', 8, 'Analytics Dashboard bx-chart', 'analytics-dashboard', 'Theta Tech', 'https://theta.com', '2 months', '7000', 'featured8.jpg', NULL, 'banner8.jpg', NULL, '[\"gallery15.jpg\",\"gallery16.jpg\"]', 'https://youtu.be/video8', 'Overview 8', 'Description 8', 'Challenges 8', 'Solutions 8', 'Results 8', 'Web', 'Analytics', 'Meta Title 8', 'Meta Description 8', '[\"bx-chart\",\"bxl-powerbi\"]', 'https://theta.com/portfolio', 0, 1, 8, 130, '2026-01-21 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(9, '25c3ee05-19f0-11f1-82cc-484d7ed9887c', 9, 'Payment Gateway Integration bx-credit-card', 'payment-gateway', 'Iota Payments', 'https://iota.com', '1 month', '4000', 'featured9.jpg', NULL, 'banner9.jpg', NULL, '[\"gallery17.jpg\",\"gallery18.jpg\"]', 'https://youtu.be/video9', 'Overview 9', 'Description 9', 'Challenges 9', 'Solutions 9', 'Results 9', 'Mobile', 'Finance', 'Meta Title 9', 'Meta Description 9', '[\"bx-credit-card\",\"bxl-paypal\"]', 'https://iota.com/portfolio', 1, 1, 9, 90, '2026-01-24 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(10, '25c3ee7c-19f0-11f1-82cc-484d7ed9887c', 10, 'Event Promotion bx-calendar', 'event-promotion', 'Kappa Events', 'https://kappa.com', '2 weeks', '1500', 'featured10.jpg', NULL, 'banner10.jpg', NULL, '[\"gallery19.jpg\",\"gallery20.jpg\"]', 'https://youtu.be/video10', 'Overview 10', 'Description 10', 'Challenges 10', 'Solutions 10', 'Results 10', 'Marketing', 'Events', 'Meta Title 10', 'Meta Description 10', '[\"bx-calendar\",\"bxl-instagram\"]', 'https://kappa.com/portfolio', 0, 1, 10, 60, '2026-01-27 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(11, '25c3eeec-19f0-11f1-82cc-484d7ed9887c', 11, 'Portfolio Website bx-briefcase', 'portfolio-website', 'Lambda Design', 'https://lambda.com', '1 month', '2500', 'featured11.jpg', NULL, 'banner11.jpg', NULL, '[\"gallery21.jpg\",\"gallery22.jpg\"]', 'https://youtu.be/video11', 'Overview 11', 'Description 11', 'Challenges 11', 'Solutions 11', 'Results 11', 'Web', 'Design', 'Meta Title 11', 'Meta Description 11', '[\"bx-briefcase\",\"bxl-dribbble\"]', 'https://lambda.com/portfolio', 1, 1, 11, 85, '2026-01-31 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(12, '25c3ef5e-19f0-11f1-82cc-484d7ed9887c', 12, 'Inventory System bx-box', 'inventory-system', 'Mu Logistics', 'https://mu.com', '3 months', '10000', 'featured12.jpg', NULL, 'banner12.jpg', NULL, '[\"gallery23.jpg\",\"gallery24.jpg\"]', 'https://youtu.be/video12', 'Overview 12', 'Description 12', 'Challenges 12', 'Solutions 12', 'Results 12', 'Web', 'Logistics', 'Meta Title 12', 'Meta Description 12', '[\"bx-box\",\"bxl-amazon\"]', 'https://mu.com/portfolio', 0, 1, 12, 120, '2026-02-04 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(13, '25c3efc8-19f0-11f1-82cc-484d7ed9887c', 13, 'Advertising Campaign bx-bullhorn', 'advertising-campaign', 'Nu Media', 'https://nu.com', '1 month', '1800', 'featured13.jpg', NULL, 'banner13.jpg', NULL, '[\"gallery25.jpg\",\"gallery26.jpg\"]', 'https://youtu.be/video13', 'Overview 13', 'Description 13', 'Challenges 13', 'Solutions 13', 'Results 13', 'Marketing', 'Advertising', 'Meta Title 13', 'Meta Description 13', '[\"bx-bullhorn\",\"bxl-twitter\"]', 'https://nu.com/portfolio', 1, 1, 13, 95, '2026-02-07 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(14, '25c3f035-19f0-11f1-82cc-484d7ed9887c', 14, 'Learning Management System bx-book', 'lms-system', 'Xi Education', 'https://xi.com', '6 months', '14000', 'featured14.jpg', NULL, 'banner14.jpg', NULL, '[\"gallery27.jpg\",\"gallery28.jpg\"]', 'https://youtu.be/video14', 'Overview 14', 'Description 14', 'Challenges 14', 'Solutions 14', 'Results 14', 'Web', 'Education', 'Meta Title 14', 'Meta Description 14', '[\"bx-book\",\"bxl-coursera\"]', 'https://xi.com/portfolio', 0, 1, 14, 170, '2026-02-09 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(15, '25c3f0a2-19f0-11f1-82cc-484d7ed9887c', 15, 'Fitness App bx-dumbbell', 'fitness-app', 'Omicron Fitness', 'https://omicron.com', '2 months', '6000', 'featured15.jpg', NULL, 'banner15.jpg', NULL, '[\"gallery29.jpg\",\"gallery30.jpg\"]', 'https://youtu.be/video15', 'Overview 15', 'Description 15', 'Challenges 15', 'Solutions 15', 'Results 15', 'Mobile', 'Health', 'Meta Title 15', 'Meta Description 15', '[\"bx-dumbbell\",\"bxl-strava\"]', 'https://omicron.com/portfolio', 1, 1, 15, 130, '2026-02-11 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(16, '25c3f110-19f0-11f1-82cc-484d7ed9887c', 16, 'Product Launch bx-rocket', 'product-launch', 'Pi Ventures', 'https://pi.com', '1 month', '3500', 'featured16.jpg', NULL, 'banner16.jpg', NULL, '[\"gallery31.jpg\",\"gallery32.jpg\"]', 'https://youtu.be/video16', 'Overview 16', 'Description 16', 'Challenges 16', 'Solutions 16', 'Results 16', 'Marketing', 'Tech', 'Meta Title 16', 'Meta Description 16', '[\"bx-rocket\",\"bxl-slack\"]', 'https://pi.com/portfolio', 0, 1, 16, 80, '2026-02-14 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(17, '25c3f179-19f0-11f1-82cc-484d7ed9887c', 17, 'SaaS Dashboard bx-server', 'saas-dashboard', 'Rho Solutions', 'https://rho.com', '4 months', '11000', 'featured17.jpg', NULL, 'banner17.jpg', NULL, '[\"gallery33.jpg\",\"gallery34.jpg\"]', 'https://youtu.be/video17', 'Overview 17', 'Description 17', 'Challenges 17', 'Solutions 17', 'Results 17', 'Web', 'SaaS', 'Meta Title 17', 'Meta Description 17', '[\"bx-server\",\"bxl-aws\"]', 'https://rho.com/portfolio', 1, 1, 17, 200, '2026-02-17 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(18, '25c3f1e4-19f0-11f1-82cc-484d7ed9887c', 18, 'Travel Booking App bx-plane', 'travel-booking-app', 'Sigma Travel', 'https://sigma.com', '3 months', '9000', 'featured18.jpg', NULL, 'banner18.jpg', NULL, '[\"gallery35.jpg\",\"gallery36.jpg\"]', 'https://youtu.be/video18', 'Overview 18', 'Description 18', 'Challenges 18', 'Solutions 18', 'Results 18', 'Mobile', 'Travel', 'Meta Title 18', 'Meta Description 18', '[\"bx-plane\",\"bxl-airbnb\"]', 'https://sigma.com/portfolio', 0, 1, 18, 150, '2026-02-19 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(19, '25c3f250-19f0-11f1-82cc-484d7ed9887c', 19, 'Influencer Marketing bx-user', 'influencer-marketing', 'Tau Media', 'https://tau.com', '2 weeks', '1200', 'featured19.jpg', NULL, 'banner19.jpg', NULL, '[\"gallery37.jpg\",\"gallery38.jpg\"]', 'https://youtu.be/video19', 'Overview 19', 'Description 19', 'Challenges 19', 'Solutions 19', 'Results 19', 'Marketing', 'Social Media', 'Meta Title 19', 'Meta Description 19', '[\"bx-user\",\"bxl-youtube\"]', 'https://tau.com/portfolio', 1, 1, 19, 75, '2026-02-21 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL),
(20, '25c3f2bd-19f0-11f1-82cc-484d7ed9887c', 20, 'Corporate Website bx-building', 'corporate-website', 'Upsilon Corp', 'https://upsilon.com', '5 months', '13000', 'featured20.jpg', NULL, 'banner20.jpg', NULL, '[\"gallery39.jpg\",\"gallery40.jpg\"]', 'https://youtu.be/video20', 'Overview 20', 'Description 20', 'Challenges 20', 'Solutions 20', 'Results 20', 'Web', 'Corporate', 'Meta Title 20', 'Meta Description 20', '[\"bx-building\",\"bxl-linkedin\"]', 'https://upsilon.com/portfolio', 0, 1, 20, 190, '2026-02-24 18:30:00', '2026-03-07 06:37:20', '2026-03-07 06:37:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_categories`
--

CREATE TABLE `portfolio_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `uuid`, `name`, `slug`, `description`, `icon`, `image`, `image_alt`, `meta_title`, `meta_description`, `is_active`, `is_featured`, `display_order`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2bae2871-19ef-11f1-82cc-484d7ed9887c', 'Web Development', 'web-development', '<p>Projects related to web development and websites</p>', 'bx bx-code fs-4 text-primary', 'portfolios/categories/2bae2871-19ef-11f1-82cc-484d7ed9887c/1772883206_blog-2.jpg', NULL, 'Web Development Projects', 'Collection of web development projects', 1, 1, 1, 500, '2026-03-07 06:28:58', '2026-06-03 00:25:47', '2026-06-03 00:25:47'),
(2, '2bafe688-19ef-11f1-82cc-484d7ed9887c', 'Mobile Apps', 'mobile-apps', '<p>Projects for Android, iOS, and cross-platform mobile apps</p>', 'bx bxl-android fs-4 text-success', 'portfolios/categories/2bafe688-19ef-11f1-82cc-484d7ed9887c/1780466641_6.jpg', NULL, 'Mobile App Projects', 'Showcase of mobile application projects', 0, 1, 2, 450, '2026-03-07 06:28:58', '2026-06-04 02:13:21', NULL),
(3, '2bafe762-19ef-11f1-82cc-484d7ed9887c', 'Design', 'design', '<p>Graphic design, UI/UX, and branding projects</p>', 'bx bxs-brush fs-4 text-danger', 'portfolios/categories/2bafe762-19ef-11f1-82cc-484d7ed9887c/1780466661_4.jpg', NULL, 'Design Projects', 'Portfolio of creative design projects', 1, 1, 3, 300, '2026-03-07 06:28:58', '2026-06-03 00:34:21', NULL),
(4, '2bafe7d7-19ef-11f1-82cc-484d7ed9887c', 'Marketing', 'marketing', 'Marketing campaigns, SEO, and promotions', 'bx bx-bullseye fs-4 text-warning', 'marketing.jpg', NULL, 'Marketing Projects', 'Portfolio of marketing campaigns', 1, 0, 4, 250, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(5, '2bafe868-19ef-11f1-82cc-484d7ed9887c', 'E-commerce', 'ecommerce', 'Online store and e-commerce platform projects', 'bx bx-cart fs-4 text-info', 'ecommerce.jpg', NULL, 'E-commerce Projects', 'Projects for online shopping platforms', 1, 1, 5, 400, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(6, '2bafe8d0-19ef-11f1-82cc-484d7ed9887c', 'Branding', 'branding', 'Brand identity, logo design, and corporate branding', 'bx bxs-palette fs-4 text-danger', 'branding.jpg', NULL, 'Branding Projects', 'Portfolio of branding and identity projects', 1, 0, 6, 220, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(7, '2bafe948-19ef-11f1-82cc-484d7ed9887c', 'Analytics', 'analytics', 'Data analytics dashboards and reporting projects', 'bx bx-bar-chart fs-4 text-primary', 'analytics.jpg', NULL, 'Analytics Projects', 'Portfolio of analytics solutions', 1, 0, 7, 180, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(8, '2bafe9b3-19ef-11f1-82cc-484d7ed9887c', 'Social Media', 'social-media', 'Social media campaigns and influencer marketing', 'bx bx-share-alt fs-4 text-primary', 'social-media.jpg', NULL, 'Social Media Projects', 'Projects related to social platforms', 1, 1, 8, 300, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(9, '2bafea0d-19ef-11f1-82cc-484d7ed9887c', 'Education', 'education', 'Learning management systems and educational platforms', 'bx bx-book fs-4 text-info', 'education.jpg', NULL, 'Education Projects', 'Portfolio of education technology projects', 1, 0, 9, 150, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(10, '2bafea6a-19ef-11f1-82cc-484d7ed9887c', 'Finance', 'finance', 'Financial apps, payment gateways, and fintech solutions', 'bx bx-credit-card fs-4 text-success', 'finance.jpg', NULL, 'Finance Projects', 'Projects related to finance technology', 1, 1, 10, 350, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(11, '2bafeb2c-19ef-11f1-82cc-484d7ed9887c', 'Healthcare', 'healthcare', 'Healthcare apps and solutions', 'bx bx-heart fs-4 text-danger', 'healthcare.jpg', NULL, 'Healthcare Projects', 'Portfolio of healthcare technology projects', 1, 0, 11, 200, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(12, '2bafeb8d-19ef-11f1-82cc-484d7ed9887c', 'Travel', 'travel', 'Travel booking apps and tourism-related projects', 'bx bx-world fs-4 text-info', 'travel.jpg', NULL, 'Travel Projects', 'Projects related to travel and tourism', 1, 1, 12, 170, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(13, '2bafebe6-19ef-11f1-82cc-484d7ed9887c', 'Events', 'events', 'Event management and promotion projects', 'bx bx-calendar fs-4 text-info', 'events.jpg', NULL, 'Event Projects', 'Portfolio of events and promotions', 1, 0, 13, 140, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(14, '2bafec44-19ef-11f1-82cc-484d7ed9887c', 'SaaS', 'saas', 'Software as a Service platforms and dashboards', 'bx bx-server fs-4 text-secondary', 'saas.jpg', NULL, 'SaaS Projects', 'Portfolio of SaaS platforms', 1, 1, 14, 250, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(15, '2bafeca3-19ef-11f1-82cc-484d7ed9887c', 'Logistics', 'logistics', 'Logistics management and tracking solutions', 'bx bx-truck fs-4 text-primary', 'logistics.jpg', NULL, 'Logistics Projects', 'Portfolio of logistics and supply chain projects', 1, 0, 15, 130, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(16, '2bafed03-19ef-11f1-82cc-484d7ed9887c', 'Fitness', 'fitness', 'Fitness apps and health tracking projects', 'bx bx-dumbbell fs-4 text-danger', 'fitness.jpg', NULL, 'Fitness Projects', 'Portfolio of fitness and health projects', 1, 1, 16, 160, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(17, '2bafed5c-19ef-11f1-82cc-484d7ed9887c', 'Tech Startup', 'tech-startup', 'Innovative technology startup projects', 'bx bx-rocket fs-4 text-success', 'tech-startup.jpg', NULL, 'Tech Startup Projects', 'Portfolio of innovative startup solutions', 1, 0, 17, 210, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(18, '2bafedb7-19ef-11f1-82cc-484d7ed9887c', 'Corporate', 'corporate', 'Corporate websites and enterprise projects', 'bx bx-building fs-4 text-info', 'corporate.jpg', NULL, 'Corporate Projects', 'Portfolio of corporate projects', 1, 1, 18, 300, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(19, '2bafee11-19ef-11f1-82cc-484d7ed9887c', 'Media', 'media', 'Media and entertainment industry projects', 'bx bx-tv fs-4 text-warning', 'media.jpg', NULL, 'Media Projects', 'Portfolio of media and entertainment projects', 1, 0, 19, 120, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL),
(20, '2bafee70-19ef-11f1-82cc-484d7ed9887c', 'Creative', 'creative', 'Creative and art-focused projects', 'bx bx-star fs-4 text-primary', 'creative.jpg', NULL, 'Creative Projects', 'Portfolio of creative art projects', 1, 1, 20, 200, '2026-03-07 06:28:58', '2026-03-07 06:28:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_images`
--

CREATE TABLE `portfolio_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `portfolio_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_images`
--

INSERT INTO `portfolio_images` (`id`, `uuid`, `portfolio_id`, `image`, `thumbnail`, `alt_text`, `caption`, `is_featured`, `is_active`, `display_order`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '63cb18fa-559f-4626-aa30-933cdd7962ff', 2, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/gallery/1772880438_xxlFwutG.png', NULL, NULL, NULL, 0, 1, 0, 0, '2026-03-07 05:17:20', '2026-03-07 05:17:20', NULL),
(2, 'fddf73fe-42ad-4f5e-a9a6-51d5892fd0d3', 2, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/gallery/1772880440_lAsA2wdv.png', NULL, NULL, NULL, 0, 1, 1, 0, '2026-03-07 05:17:20', '2026-03-07 05:17:20', NULL),
(3, 'daa8a91c-6a06-4a6b-bc26-13682d953f13', 2, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/gallery/1772880440_oZlnTetT.png', NULL, NULL, NULL, 0, 1, 2, 0, '2026-03-07 05:17:20', '2026-03-07 05:17:20', NULL),
(4, '9ecebd61-7795-4ac7-ba74-5548bc6f8640', 2, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/gallery/1772880440_W8QONjPd.png', NULL, NULL, NULL, 0, 1, 3, 0, '2026-03-07 05:17:20', '2026-03-07 05:17:20', NULL),
(5, '5c9c4204-4469-4e5e-becc-631b54aff4a8', 2, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/gallery/1772880440_eDOW17iB.png', NULL, NULL, NULL, 0, 1, 4, 0, '2026-03-07 05:17:20', '2026-03-07 05:17:20', NULL),
(6, '4c8d429d-1459-42e3-b27f-d436cd73c8f5', 2, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/gallery/1772880440_RiYk1mZD.png', NULL, NULL, NULL, 0, 1, 5, 0, '2026-03-07 05:17:20', '2026-03-07 05:17:20', NULL),
(7, '927ff32b-8a08-4dee-a414-86770b34948a', 2, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/gallery/1772880440_EXFzusLQ.png', NULL, NULL, NULL, 0, 1, 6, 0, '2026-03-07 05:17:20', '2026-03-07 05:17:20', NULL),
(8, '5c037e6e-e1c5-42cc-b650-528018fc23d6', 2, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/gallery/1772880440_c7mcKhX5.png', NULL, NULL, NULL, 0, 1, 7, 0, '2026-03-07 05:17:20', '2026-03-07 05:54:21', '2026-03-07 05:54:21'),
(9, 'e4c58688-9a7c-4755-9f3f-16a7b93af44f', 2, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/gallery/1772882321_j7JbRz2g.jpg', NULL, NULL, NULL, 0, 1, 0, 0, '2026-03-07 05:48:41', '2026-03-07 05:54:11', '2026-03-07 05:54:11'),
(10, '7f6e570e-a630-4ac3-a6b3-8c8b9549cda4', 2, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/gallery/1772882341_HYoCKgmD.jpg', NULL, NULL, NULL, 0, 1, 0, 0, '2026-03-07 05:49:01', '2026-03-07 05:54:11', '2026-03-07 05:54:11'),
(11, 'd41e2865-87a4-42d9-b47f-0e044b907b85', 2, 'portfolios/25c3e87d-19f0-11f1-82cc-484d7ed9887c/gallery/1772882816_bA6lvfCh.png', NULL, NULL, NULL, 0, 1, 7, 0, '2026-03-07 05:56:56', '2026-03-07 05:56:56', NULL),
(12, '8d01c74c-117a-4f29-92e7-061469c439a3', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467068_0W9rEtab.jpg', NULL, NULL, NULL, 0, 1, 0, 0, '2026-06-03 00:41:08', '2026-06-03 00:41:08', NULL),
(13, '2e423f07-0736-437c-8476-b645dda8de4a', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467068_rBAvh6D4.jpg', NULL, NULL, NULL, 0, 1, 1, 0, '2026-06-03 00:41:08', '2026-06-03 00:41:08', NULL),
(14, '94fa47e0-4007-47a9-9e53-6ba7e4ff1305', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467068_95vNF3Go.jpg', NULL, NULL, NULL, 0, 1, 2, 0, '2026-06-03 00:41:08', '2026-06-03 00:41:08', NULL),
(15, 'd901ee8f-dd58-4c29-9593-b4d75c4b2964', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467068_5J8uyTyh.jpg', NULL, NULL, NULL, 0, 1, 3, 0, '2026-06-03 00:41:08', '2026-06-03 00:41:08', NULL),
(16, '4c152336-f0c5-4a07-970a-e6f17bf3b8b6', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467068_ftj2Po0y.jpg', NULL, NULL, NULL, 0, 1, 4, 0, '2026-06-03 00:41:08', '2026-06-03 00:41:08', NULL),
(17, '5c1ecec3-76d7-495c-a5c6-5ad40737ede5', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467068_sJJ0FAB2.jpg', NULL, NULL, NULL, 0, 1, 5, 0, '2026-06-03 00:41:08', '2026-06-03 00:41:08', NULL),
(18, 'e1376e3d-79f8-4b16-b183-4be274dc9f90', 3, 'portfolios/25c3e9a4-19f0-11f1-82cc-484d7ed9887c/gallery/1780467725_In46jMaQ.jpg', NULL, NULL, NULL, 0, 1, 0, 0, '2026-06-03 00:52:05', '2026-06-03 00:52:05', NULL),
(19, 'cd34146b-9fe4-4ff8-a80c-361be44cc361', 3, 'portfolios/25c3e9a4-19f0-11f1-82cc-484d7ed9887c/gallery/1780467725_JmjXzpjG.jpg', NULL, NULL, NULL, 0, 1, 1, 0, '2026-06-03 00:52:05', '2026-06-03 00:52:05', NULL),
(20, '20553e66-8c8e-4d0a-a855-cacddfa1f522', 3, 'portfolios/25c3e9a4-19f0-11f1-82cc-484d7ed9887c/gallery/1780467725_RTot23ja.jpg', NULL, NULL, NULL, 0, 1, 2, 0, '2026-06-03 00:52:05', '2026-06-03 00:52:05', NULL),
(21, 'b6639418-a716-4696-afbe-837176576dca', 3, 'portfolios/25c3e9a4-19f0-11f1-82cc-484d7ed9887c/gallery/1780467725_CvHDgOLL.jpg', NULL, NULL, NULL, 0, 1, 3, 0, '2026-06-03 00:52:05', '2026-06-03 00:52:05', NULL),
(22, '0a39675f-1aa3-41b9-9251-0d9c32f1583a', 3, 'portfolios/25c3e9a4-19f0-11f1-82cc-484d7ed9887c/gallery/1780467725_wYQ4KcE0.jpg', NULL, NULL, NULL, 0, 1, 4, 0, '2026-06-03 00:52:05', '2026-06-03 00:52:05', NULL),
(23, 'db236ab0-90bd-4cbd-8e2f-043185c497e3', 3, 'portfolios/25c3e9a4-19f0-11f1-82cc-484d7ed9887c/gallery/1780467725_2VaW3JLF.jpg', NULL, NULL, NULL, 0, 1, 5, 0, '2026-06-03 00:52:05', '2026-06-03 00:52:05', NULL),
(24, 'f5475958-b1fc-4bd6-a3da-b5317c56b9ce', 3, 'portfolios/25c3e9a4-19f0-11f1-82cc-484d7ed9887c/gallery/1780467725_UZNMx7dZ.jpg', NULL, NULL, NULL, 0, 1, 6, 0, '2026-06-03 00:52:05', '2026-06-03 00:52:05', NULL),
(25, '6852548a-756c-4d97-ab5d-a57dacd4dfce', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467809_IXpvUwyR.jpg', NULL, NULL, NULL, 0, 1, 6, 0, '2026-06-03 00:53:29', '2026-06-03 00:53:29', NULL),
(26, '7738289d-614f-4b95-9caa-ef40823d7244', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467809_rMoo7Bkn.jpg', NULL, NULL, NULL, 0, 1, 7, 0, '2026-06-03 00:53:29', '2026-06-03 00:53:29', NULL),
(27, 'b799c330-87d0-405b-ad83-c7c612b72b5c', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467809_wWxgwWQw.jpg', NULL, NULL, NULL, 0, 1, 8, 0, '2026-06-03 00:53:29', '2026-06-03 00:53:29', NULL),
(28, 'c860e28a-bf65-4156-b922-effe8dc39eb8', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467809_s2rR3zpV.jpg', NULL, NULL, NULL, 0, 1, 9, 0, '2026-06-03 00:53:29', '2026-06-03 00:53:29', NULL),
(29, 'ce3bd5a3-81cb-4b28-9178-99b1b8db8578', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467809_wJMKkBdz.jpg', NULL, NULL, NULL, 0, 1, 10, 0, '2026-06-03 00:53:29', '2026-06-03 00:53:29', NULL),
(30, '848bf1ce-a211-4e4c-b9d7-8ca377774607', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467809_Z7LC25E7.jpg', NULL, NULL, NULL, 0, 1, 11, 0, '2026-06-03 00:53:29', '2026-06-03 00:53:29', NULL),
(31, '77a1de61-626c-4c26-91af-b80977b22dd1', 4, 'portfolios/25c3ea37-19f0-11f1-82cc-484d7ed9887c/gallery/1780467809_igU5XLBo.jpg', NULL, NULL, NULL, 0, 1, 12, 0, '2026-06-03 00:53:29', '2026-06-03 00:53:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_skills`
--

CREATE TABLE `portfolio_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `portfolio_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

CREATE TABLE `resumes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `resume_file` varchar(255) NOT NULL,
  `portfolio_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills`)),
  `experience_years` int(11) DEFAULT NULL,
  `current_role` varchar(255) DEFAULT NULL,
  `current_company` varchar(255) DEFAULT NULL,
  `expected_salary` varchar(255) DEFAULT NULL,
  `notice_period` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `status` enum('new','shortlisted','interview','offered','hired','rejected') NOT NULL DEFAULT 'new',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `review` longtext NOT NULL,
  `reviewable_type` varchar(255) NOT NULL,
  `reviewable_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `likes` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `dislikes` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `source` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `guard` varchar(255) NOT NULL DEFAULT 'web',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `uuid`, `name`, `slug`, `guard`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '69f66f62-e8dd-11f0-bdd3-1860247b6ae0', 'Super Admin', 'super-admin', 'web', 1, '2026-01-03 08:50:11', '2026-01-03 08:50:11', NULL),
(2, '69f67e2c-e8dd-11f0-bdd3-1860247b6ae0', 'Admin', 'admin', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(3, '69f69c45-e8dd-11f0-bdd3-1860247b6ae0', 'Project Manager', 'project-manager', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(4, '69f69ce3-e8dd-11f0-bdd3-1860247b6ae0', 'HR Manager', 'hr-manager', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(5, '69f69dcf-e8dd-11f0-bdd3-1860247b6ae0', 'Content Manager', 'content-manager', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(6, '69f6aa44-e8dd-11f0-bdd3-1860247b6ae0', 'Editor', 'editor', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(7, '69f6aae1-e8dd-11f0-bdd3-1860247b6ae0', 'Author', 'author', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(8, '69f6abd7-e8dd-11f0-bdd3-1860247b6ae0', 'SEO Manager', 'seo-manager', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(9, '69f6ac34-e8dd-11f0-bdd3-1860247b6ae0', 'Marketing Manager', 'marketing-manager', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(10, '69f6ac8b-e8dd-11f0-bdd3-1860247b6ae0', 'Sales Manager', 'sales-manager', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(11, '69f6acdc-e8dd-11f0-bdd3-1860247b6ae0', 'Support Executive', 'support-executive', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(12, '69f6ad30-e8dd-11f0-bdd3-1860247b6ae0', 'Developer', 'developer', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(13, '69f6ad8b-e8dd-11f0-bdd3-1860247b6ae0', 'Designer', 'designer', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(14, '69f6ade0-e8dd-11f0-bdd3-1860247b6ae0', 'QA Tester', 'qa-tester', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL),
(15, '69f6ae33-e8dd-11f0-bdd3-1860247b6ae0', 'Viewer', 'viewer', 'web', 1, '2026-01-03 14:20:11', '2026-01-03 14:20:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `is_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `conditions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`conditions`)),
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `uuid`, `role_id`, `permission_id`, `is_allowed`, `conditions`, `meta`, `created_at`, `updated_at`) VALUES
(1, 'c6a66094-7f24-4e9f-9c33-6220168fdbb8', 2, 1, 1, NULL, NULL, '2026-02-02 07:12:28', '2026-02-02 07:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `form_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section_contents`
--

CREATE TABLE `section_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `section_label` varchar(255) DEFAULT NULL,
  `section_title` varchar(255) DEFAULT NULL,
  `section_subtitle` varchar(255) DEFAULT NULL,
  `left_description` longtext DEFAULT NULL,
  `right_list` longtext DEFAULT NULL,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_contents`
--

INSERT INTO `section_contents` (`id`, `uuid`, `title`, `slug`, `page_name`, `section_name`, `section_label`, `section_title`, `section_subtitle`, `left_description`, `right_list`, `display_order`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '3bf3024b-890c-4d0d-9964-e6d6cbe5c7e1', 'Home About Section', 'home-about-section', 'home', 'about', 'Who We Are', 'WELCOME TO DEOVATE WORLD', 'Building modern websites', '<p>Test description</p>', '<ul><li>Item one</li></ul>', 0, 1, '2026-07-16 05:09:06', '2026-07-16 05:09:06', '2026-07-16 05:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `featured_image_alt` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `banner_image_alt` varchar(255) DEFAULT NULL,
  `gallery` longtext DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_keywords`)),
  `canonical_url` varchar(255) DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `review_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `uuid`, `title`, `slug`, `short_description`, `description`, `icon`, `featured_image`, `featured_image_alt`, `banner_image`, `banner_image_alt`, `gallery`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `rating`, `review_count`, `is_featured`, `is_active`, `display_order`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, '3e026be0-61dd-4243-8980-39fe38190d63', 'Web Design & Development', 'web-design-development', '<p>We design and build websites that load fast, look intentional, and guide visitors toward a decision instead of leaving them to figure it out themselves.</p>', '<p>Your website is doing a job whether you designed it to or not. It is either building confidence in the first ten seconds or quietly pushing visitors back to a search results page. We design and build websites that work the way a good salesperson would: clear, fast, and focused on moving the visitor toward a decision instead of overwhelming them with everything at once.</p>\r\n\r\n<h3>Why Businesses Need This</h3>\r\n\r\n<p>Most website problems are not visible to the business owner, because they never see their own site the way a new visitor does. A slow load time, a confusing menu, or a homepage that talks about the company instead of the customer, all of these quietly cost leads every single day without ever showing up as an obvious complaint. Good web design fixes what you cannot see from the inside.</p>\r\n\r\n<h3>Key Benefits</h3>\r\n\r\n<ul>\r\n	<li>First impression built for trust, not just aesthetics</li>\r\n	<li>Faster load times that keep visitors from bouncing before the page even finishes loading</li>\r\n	<li>A structure that guides visitors toward contacting you or buying, instead of leaving them to wander</li>\r\n	<li>A site your own team can update without needing a developer for every small change</li>\r\n	<li>A foundation that supports SEO instead of working against it</li>\r\n</ul>\r\n\r\n<h3>Tools &amp; Technologies We Use</h3>\r\n\r\n<p>HTML5, CSS3, JavaScript, React, Next.js, Tailwind CSS, WordPress, Figma for design, and performance tools like Lighthouse and GTmetrix to validate speed before launch.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'Web Design & Development | Deovate', 'We design and build websites that load fast, look intentional, and guide visitors toward a decision instead of leaving them to figure it out themselves.', '[\"web design\",\"web development\",\"website design company\",\"responsive website\"]', NULL, NULL, 0, 0, 1, 1, 0, '2026-07-21 04:29:12', '2026-07-21 04:39:02', NULL),
(22, 'f12abaa2-3b47-4b07-ae5a-4c6418662aba', 'Custom Software Development', 'custom-software-development', 'Software built around how your team actually operates, from ERP and CRM systems to full business automation and enterprise platforms.', '<p>Off-the-shelf software is built for the average business, which means it is never quite built for yours. Sooner or later you find yourself working around its limitations instead of the other way around. Custom software is built the opposite way, starting from how your team actually operates, so the tool fits the process instead of forcing the process to bend around the tool.</p><h3>Why Businesses Need This</h3><p>Businesses usually reach for custom software after they have already tried to force a generic tool to do something it was never designed for, spreadsheets patched together, workarounds that break every few months, manual steps nobody trusts completely. Custom software removes that friction permanently by solving the actual problem instead of adapting a generic one.</p><h3>Key Benefits</h3><ul><li>Built around your exact workflow instead of forcing you into someone else\'s process</li><li>No recurring per-user licensing fees eating into margins as you grow</li><li>Full ownership of the system and the data inside it</li><li>Scales with your business instead of hitting a plan limit at the worst possible time</li><li>Integrates with the other tools you already depend on</li></ul><h3>Tools & Technologies We Use</h3><p>PHP (Laravel), Node.js, Python, React, Vue, MySQL, PostgreSQL, and cloud infrastructure on AWS or Azure depending on the scale and requirements of the system.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'Custom Software Development | Deovate', 'Software built around how your team actually operates, from ERP and CRM systems to full business automation and enterprise platforms.', '\"[\\\"custom software development\\\",\\\"ERP software\\\",\\\"CRM development\\\",\\\"business automation\\\"]\"', NULL, NULL, 0, 0, 1, 2, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(23, 'e9498ccb-4a03-4e1b-9baf-5ad89f019c08', 'eCommerce Development', 'ecommerce-development', 'Online stores engineered around conversion first, not just visual polish, so browsers actually complete a purchase.', '<p>An online store is judged in seconds, not minutes. If checkout feels slow, confusing, or untrustworthy, the sale is gone before your product even gets a fair look, no matter how good it actually is. We build stores engineered around conversion first, not just visual polish, so the people who land on your site actually complete a purchase instead of abandoning a full cart.</p><h3>Why Businesses Need This</h3><p>Every year more buying decisions move online, and the businesses that treat their store as a real sales channel, not just a digital brochure, are the ones capturing that shift. A store that is slow, hard to navigate on mobile, or has a clunky checkout is quietly losing revenue that a competitor with a better-built store is picking up instead.</p><h3>Key Benefits</h3><ul><li>A checkout flow designed to reduce cart abandonment, not add friction to it</li><li>Mobile-first design, since most shopping traffic now comes from phones</li><li>Secure, reliable payment processing customers actually trust</li><li>A catalog structure that makes products easy to find, not just easy to list</li><li>Built to handle traffic spikes during sales and peak seasons without crashing</li></ul><h3>Tools & Technologies We Use</h3><p>Shopify, WooCommerce, Magento, custom builds on Laravel or Node.js, and payment integrations including Stripe, PayPal, Razorpay, and regional gateways as needed.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'eCommerce Development | Deovate', 'Online stores engineered around conversion first, not just visual polish, so browsers actually complete a purchase.', '\"[\\\"ecommerce development\\\",\\\"shopify development\\\",\\\"woocommerce\\\",\\\"online store\\\"]\"', NULL, NULL, 0, 0, 1, 3, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(24, '327d7957-799c-4e51-a3bb-409c75bda18a', 'Search Engine Optimization (SEO)', 'search-engine-optimization-seo', 'SEO strategies built around the actual searches your future customers are typing, not generic keyword stuffing.', '<p>Traffic without intent is just a number on a dashboard that does not translate into revenue. We build SEO strategies around the actual searches your future customers are typing, so the people arriving on your site are already looking for exactly what you offer, not landing there by accident.</p><h3>Why Businesses Need This</h3><p>Paid ads stop the moment you stop paying for them. SEO is the channel that keeps working in the background, bringing in visitors months and years after the work was done, which makes it one of the few marketing investments that actually compounds instead of resetting to zero every month.</p><h3>Key Benefits</h3><ul><li>Long-term, compounding traffic instead of traffic that disappears when ad spend stops</li><li>Higher trust, since organic results are perceived as more credible than paid ads</li><li>Better quality leads, because visitors are actively searching for what you offer</li><li>Improved site structure and speed as a side effect of proper technical SEO</li><li>A measurable, reportable return on the work being done every month</li></ul><h3>Tools & Technologies We Use</h3><p>Google Search Console, Ahrefs, SEMrush, Screaming Frog, Google Analytics, and structured data implementation for rich search results.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'Search Engine Optimization (SEO) | Deovate', 'SEO strategies built around the actual searches your future customers are typing, not generic keyword stuffing.', '\"[\\\"SEO services\\\",\\\"technical SEO\\\",\\\"local SEO\\\",\\\"SEO audit\\\"]\"', NULL, NULL, 0, 0, 1, 4, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(25, '65017a07-620d-478c-b699-649ceb418532', 'Digital Marketing', 'digital-marketing', 'Campaigns built around the full funnel, from the first click to the completed sale, so ad spend turns into measurable revenue.', '<p>Ad spend without a real strategy behind it just burns budget faster and calls it marketing. We build campaigns around the full funnel, from the first click a stranger makes to the completed sale, so every rupee of spend is tied to a measurable outcome, not just impressions.</p><h3>Why Businesses Need This</h3><p>Organic reach alone is rarely enough to hit aggressive growth targets on a specific timeline. Paid digital marketing lets you put your offer directly in front of the exact audience most likely to buy, right now, instead of waiting for them to find you eventually.</p><h3>Key Benefits</h3><ul><li>Immediate visibility instead of waiting months for organic traffic to build</li><li>Precise audience targeting based on behavior, interest, and intent</li><li>Full performance data on what is working and what is not, in real time</li><li>Budget flexibility, scale up what converts, cut what doesn\'t, without waiting</li><li>Multiple channels working together instead of relying on just one</li></ul><h3>Tools & Technologies We Use</h3><p>Google Ads Manager, Meta Ads Manager, Google Analytics, Google Tag Manager, and conversion tracking setups across every platform we run campaigns on.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'Digital Marketing | Deovate', 'Campaigns built around the full funnel, from the first click to the completed sale, so ad spend turns into measurable revenue.', '\"[\\\"digital marketing agency\\\",\\\"google ads\\\",\\\"meta ads\\\",\\\"lead generation\\\"]\"', NULL, NULL, 0, 0, 1, 5, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(26, '483a7bc4-7656-48cb-8f33-6cf6dcc9ae22', 'Branding & Graphic Design', 'branding-graphic-design', 'Visual identities that feel consistent and intentional across every place your business shows up.', '<p>A brand is not just a logo, it is the impression that stays after someone closes the tab or walks away from your booth. We build visual identities that feel consistent and intentional across every place your business shows up, so the impression left behind is the one you actually chose.</p><h3>Why Businesses Need This</h3><p>Inconsistent branding, a different logo variant here, mismatched colors there, quietly signals a lack of attention to detail, even when the actual product or service is excellent. A strong, consistent identity builds recognition and trust faster, especially with buyers evaluating you against more established competitors.</p><h3>Key Benefits</h3><ul><li>Instant recognition across every platform and touchpoint your business uses</li><li>A more premium, trustworthy first impression, especially for higher-ticket offers</li><li>Consistency that makes marketing and sales materials faster to produce going forward</li><li>A visual identity that can grow with the business instead of needing a redo every year</li><li>Design assets your team can reuse confidently without guessing what is \"on brand\"</li></ul><h3>Tools & Technologies We Use</h3><p>Adobe Illustrator, Photoshop, Figma, and Canva for lighter internal templates, with every deliverable provided in source and export-ready formats.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'Branding & Graphic Design | Deovate', 'Visual identities that feel consistent and intentional across every place your business shows up.', '\"[\\\"branding agency\\\",\\\"logo design\\\",\\\"brand identity design\\\",\\\"graphic design services\\\"]\"', NULL, NULL, 0, 0, 1, 6, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(27, 'c1447f05-0120-4f2a-ba81-d609c082bc6d', 'Cloud & DevOps Solutions', 'cloud-devops-solutions', 'Cloud infrastructure and deployment pipelines designed for reliability first, so scaling up does not mean things start breaking.', '<p>Downtime during a busy moment is one of the most expensive things that can happen to a growing product, both in lost revenue and lost trust. We build cloud infrastructure and deployment pipelines designed for reliability first, so scaling up does not mean things quietly start breaking under real load.</p><h3>Why Businesses Need This</h3><p>As a product grows, the informal setup that worked fine with a handful of users starts to show cracks, slow deploys, unclear rollback plans, servers sized by guesswork instead of data. Proper cloud and DevOps practices remove that uncertainty before it turns into an outage at the worst possible time.</p><h3>Key Benefits</h3><ul><li>Higher uptime and fewer surprise outages during peak traffic</li><li>Faster, safer deployments with automated testing built into the pipeline</li><li>Infrastructure costs matched to actual usage instead of guesswork</li><li>Faster recovery when something does go wrong, instead of hours of manual firefighting</li><li>A setup that scales smoothly as user numbers grow</li></ul><h3>Tools & Technologies We Use</h3><p>AWS, Azure, Docker, Kubernetes, Jenkins, GitHub Actions, Terraform, and monitoring tools like Grafana and CloudWatch.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'Cloud & DevOps Solutions | Deovate', 'Cloud infrastructure and deployment pipelines designed for reliability first, so scaling up does not mean things start breaking.', '\"[\\\"cloud solutions\\\",\\\"devops services\\\",\\\"AWS consulting\\\",\\\"CI\\\\\\/CD pipeline\\\"]\"', NULL, NULL, 0, 0, 1, 7, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(28, '630a367d-a4b1-4861-aea1-e02e251df659', 'API Development & Integration', 'api-development-integration', 'APIs and integrations that keep your connected systems reliable, secure, and easy to maintain.', '<p>Modern products rarely work in isolation, they connect to payment processors, CRMs, shipping providers, and countless other tools constantly. We build and integrate APIs that keep those connections reliable, secure, and easy to maintain, so one broken integration does not quietly take down half your workflow.</p><h3>Why Businesses Need This</h3><p>As a business adds more tools to its stack, the connections between them become just as important as the tools themselves. Poorly built integrations create silent data mismatches and manual double-entry, while well-built APIs let information move automatically and accurately between every system that needs it.</p><h3>Key Benefits</h3><ul><li>Systems that talk to each other automatically instead of relying on manual data entry</li><li>Fewer errors from copying data between disconnected tools</li><li>Faster feature development, since well-built APIs are easier to extend later</li><li>Better security around how sensitive data moves between systems</li><li>Easier onboarding of new tools without rebuilding your whole stack</li></ul><h3>Tools & Technologies We Use</h3><p>Node.js, PHP, Python, Postman for testing and documentation, REST and GraphQL architectures, and OAuth for secure authentication.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'API Development & Integration | Deovate', 'APIs and integrations that keep your connected systems reliable, secure, and easy to maintain.', '\"[\\\"API development\\\",\\\"API integration services\\\",\\\"REST API\\\",\\\"third party integration\\\"]\"', NULL, NULL, 0, 0, 1, 8, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(29, '53c1dab5-4bc8-495a-af5e-5f763b91e720', 'CMS Development', 'cms-development', 'Content management systems that give your team real independence, without sacrificing design or performance.', '<p>Your content should not require a developer every single time it needs to change. We build content management systems that give your team real independence over pages, blog posts, and product listings, without sacrificing design consistency or site performance in the process.</p><h3>Why Businesses Need This</h3><p>Businesses that rely on a developer for every content change end up publishing less often, because the friction of asking, waiting, and paying for small updates adds up. A properly built CMS removes that bottleneck entirely, putting control back in the hands of the people who actually create the content.</p><h3>Key Benefits</h3><ul><li>Publish and update content without waiting on a developer</li><li>A consistent design that does not break no matter who is editing it</li><li>Faster content publishing, which matters directly for SEO and marketing</li><li>Role-based access so the right people can edit the right sections</li><li>A platform that can grow from a simple site into a full content operation</li></ul><h3>Tools & Technologies We Use</h3><p>WordPress, Webflow, Strapi and other headless CMS platforms, and custom-built admin panels for fully bespoke content needs.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'CMS Development | Deovate', 'Content management systems that give your team real independence, without sacrificing design or performance.', '\"[\\\"CMS development\\\",\\\"wordpress development\\\",\\\"headless CMS\\\",\\\"content management system\\\"]\"', NULL, NULL, 0, 0, 1, 9, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(30, 'ef1233b0-85aa-4bdb-81a4-bc55d7610902', 'Maintenance & Support', 'maintenance-support', 'Ongoing maintenance and support so small issues get caught early, before they turn into downtime or lost customer trust.', '<p>A launched product still needs ongoing attention, software is never really \"done.\" We provide ongoing maintenance and support so small issues get caught early, before they turn into downtime, security incidents, or a customer-facing problem that damages trust.</p><h3>Why Businesses Need This</h3><p>Software that is never updated becomes a security and stability risk over time, even if nothing appears wrong on the surface. Regular maintenance is what keeps a working product working, catching small issues while they are still cheap and easy to fix.</p><h3>Key Benefits</h3><ul><li>Fewer unexpected outages and emergency fire-drills</li><li>Faster response when something does go wrong</li><li>Lower long-term cost, since small fixes are cheaper than emergency ones</li><li>Improved security posture through regular updates and monitoring</li><li>Peace of mind that someone is actually watching the system</li></ul><h3>Tools & Technologies We Use</h3><p>Uptime monitoring tools, automated backup systems, security scanning tools, and ticketing systems like Jira or Freshdesk for tracking support requests.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'Maintenance & Support | Deovate', 'Ongoing maintenance and support so small issues get caught early, before they turn into downtime or lost customer trust.', '\"[\\\"website maintenance\\\",\\\"software support\\\",\\\"bug fixing services\\\",\\\"security monitoring\\\"]\"', NULL, NULL, 0, 0, 1, 10, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(31, '9a57dbb6-9f94-49ac-bf15-0d3ca5798c36', 'Web Hosting & Server Management', 'web-hosting-server-management', 'Hosting infrastructure built for uptime, speed, and recovery, so your site stays available when it matters most.', '<p>Hosting is invisible when it works and extremely costly when it does not. We set up and manage hosting infrastructure built for uptime, speed, and recovery, so your site stays available when it matters most, not just on an average Tuesday afternoon.</p><h3>Why Businesses Need This</h3><p>Cheap, generic shared hosting is often where performance and reliability problems actually start, long before anyone thinks to blame the code. Properly configured hosting and server management remove one of the most common and preventable causes of downtime and slow performance.</p><h3>Key Benefits</h3><ul><li>Higher uptime with infrastructure sized correctly for real traffic</li><li>Faster page loads, which directly affects both conversions and SEO</li><li>Stronger security through properly configured servers and SSL</li><li>Reliable email delivery instead of messages landing in spam</li><li>A tested recovery plan in place before disaster strikes, not after</li></ul><h3>Tools & Technologies We Use</h3><p>cPanel, Plesk, Nginx, Apache, Cloudflare for CDN and security, and automated backup tools with off-site storage.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'Web Hosting & Server Management | Deovate', 'Hosting infrastructure built for uptime, speed, and recovery, so your site stays available when it matters most.', '\"[\\\"web hosting\\\",\\\"server management\\\",\\\"VPS hosting\\\",\\\"dedicated server\\\"]\"', NULL, NULL, 0, 0, 1, 11, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(32, '2b589805-edff-4c51-9ebb-21ae199e5c1b', 'Testing & Quality Assurance (QA)', 'testing-quality-assurance-qa', 'Comprehensive testing that finds issues before your users do, helping you launch reliable software with confidence.', '<p>Every bug that reaches a live user costs more than the one caught in development. A checkout button that fails on Safari, an API that times out under real traffic, a form that silently drops data on mobile, these are the moments customers remember, and they decide whether they trust your product again. Comprehensive testing finds these issues before your users do, helping you launch reliable software with confidence.</p><h3>Why Businesses Need This</h3><p>Most teams do not lack good developers, they lack a structured way to catch what developers cannot see from inside their own code. Software that \"works on my machine\" and software that works for every real user under real conditions are two different things, and QA is the process that closes that gap before it becomes a public problem.</p><h3>Key Benefits</h3><ul><li>Fewer production bugs reaching real customers, protecting both revenue and trust</li><li>Faster, safer releases, since regression testing catches what a new change quietly broke</li><li>Confidence to launch during high-stakes moments, sales events, major updates, funding demos</li><li>Clear, evidence-based reports so the decision to ship is based on data, not hope</li><li>Lower long-term cost, since a bug caught pre-launch is far cheaper than one fixed in production</li></ul><h3>Tools & Technologies We Use</h3><p>Selenium, Playwright, Cypress, and Appium for automation; Postman and REST Assured for API testing; JMeter and k6 for performance; Burp Suite and OWASP ZAP for security; Jira and TestRail for tracking; integrated directly into CI/CD via Jenkins or GitHub Actions.</p>', NULL, NULL, NULL, NULL, NULL, NULL, 'Testing & Quality Assurance (QA) | Deovate', 'Comprehensive testing that finds issues before your users do, helping you launch reliable software with confidence.', '\"[\\\"software testing services\\\",\\\"QA testing company\\\",\\\"automated testing\\\",\\\"security testing\\\"]\"', NULL, NULL, 0, 0, 1, 12, 4, '2026-07-21 04:29:17', '2026-07-21 06:12:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_challenges`
--

CREATE TABLE `service_challenges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `challenge` varchar(255) NOT NULL,
  `solution` longtext NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_faqs`
--

CREATE TABLE `service_faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` longtext NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_faqs`
--

INSERT INTO `service_faqs` (`id`, `uuid`, `service_id`, `question`, `answer`, `is_active`, `is_featured`, `display_order`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '57e3bb31-c94d-46bf-95af-84b1a608341a', 21, 'How long does a website project usually take?', 'A standard business website typically takes four to six weeks from kickoff to launch, depending on the number of pages and how much content needs to be created or gathered.', 1, 0, 1, 0, '2026-07-21 04:29:12', '2026-07-21 04:29:12', NULL),
(2, '38a63b7d-7031-460b-8bbb-0d77ae6372ca', 21, 'Will I be able to update the website myself after launch?', 'Yes. We build on a content management system and walk your team through exactly how to update pages, so you are not dependent on us for routine changes.', 1, 0, 2, 0, '2026-07-21 04:29:12', '2026-07-21 04:29:12', NULL),
(3, 'f4c44e90-c98d-4375-bb40-1b9470c94c93', 21, 'Do you also handle the website copywriting?', 'We can write the copy, refine what you already have, or work from content your team provides, whichever fits your project best.', 1, 0, 3, 0, '2026-07-21 04:29:12', '2026-07-21 04:29:12', NULL),
(4, 'f66afeef-395b-4fed-bc2e-6f55c92548b2', 22, 'How is custom software different from just buying a SaaS tool?', 'A SaaS tool solves a generic version of your problem and charges you monthly for the privilege. Custom software solves your specific problem once, and you own it outright.', 1, 0, 1, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(5, '443a7896-8fb3-4880-ba8e-167146f32ce3', 22, 'How long does a custom software project take?', 'It depends heavily on scope, a focused internal tool might take six to eight weeks, while a full ERP or enterprise platform can take several months, broken into phased releases.', 1, 0, 2, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(6, '2072ce7f-b1a0-485f-915c-9cee46b09ad9', 22, 'What happens after the software is built, do you support it?', 'Yes, we offer ongoing maintenance and support plans so the system keeps running smoothly and can evolve as your business needs change.', 1, 0, 3, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(7, 'becfa448-596d-431d-aa36-cb620b4ebddf', 23, 'Which platform is right for my store, Shopify or a custom build?', 'Shopify or WooCommerce fits most standard product catalogs well. A custom build makes sense once your pricing logic, catalog size, or workflow gets complex enough that a standard platform starts limiting you.', 1, 0, 1, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(8, '5e4d670b-1fe0-4599-854d-f0862f7ceda0', 23, 'Can you migrate my existing store without losing my products and orders?', 'Yes, we handle full data migration, products, customers, and order history, with careful validation so nothing is lost in the move.', 1, 0, 2, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(9, '4ddce231-2d31-45fb-b52c-98799d7676b3', 23, 'Do you handle ongoing store maintenance after launch?', 'Yes, including plugin and platform updates, performance monitoring, and support during high-traffic periods like sales events.', 1, 0, 3, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(10, '2882115c-6c82-4ba4-a3c5-445966fa97fe', 24, 'How long does SEO take to show results?', 'Meaningful movement typically starts around three to four months, with stronger compounding results building over six to twelve months, since SEO is a long-term investment, not an instant switch.', 1, 0, 1, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(11, '6baa835b-c546-4508-b15f-dc56eb2673d7', 24, 'Do you guarantee a number one ranking?', 'No credible agency can guarantee a specific ranking, search algorithms change constantly. We focus on sustainable growth in visibility, traffic, and qualified leads instead of chasing an unreliable promise.', 1, 0, 2, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(12, '80cebf07-0095-4124-83ad-2954a95eef86', 24, 'Is SEO still worth it with AI search results becoming more common?', 'Yes, being cited and understood clearly by search engines matters even more now, since AI-generated answers still pull from well-structured, authoritative content.', 1, 0, 3, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(13, 'e6c20da5-0b95-4dcb-8cb4-bef6c65f50ce', 25, 'How much budget do I need to start seeing results?', 'It depends on your industry and competition, but we help define a realistic starting budget during onboarding based on your goals, rather than a generic one-size number.', 1, 0, 1, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(14, '3273bde1-304d-4f55-93a3-b95211d54ca8', 25, 'Which platform should I start with, Google or Meta?', 'Google Ads tends to work well for high-intent searches, while Meta works well for demand generation and visual products. We usually recommend based on your specific offer.', 1, 0, 2, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(15, '3ceb5905-299d-4d6a-b612-7f094d320e80', 25, 'How do you report on campaign performance?', 'You get regular performance reports covering spend, conversions, cost per lead, and return on ad spend, in plain language, not just raw platform exports.', 1, 0, 3, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(16, 'f2deeb68-4272-4160-8556-9f014ac23d36', 26, 'I already have a logo, can you just build the rest of the brand around it?', 'Yes, if the existing logo is solid we build the full identity system around it. If it is genuinely holding the brand back, we will tell you honestly and suggest options.', 1, 0, 1, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(17, 'd03f933e-467e-411a-9624-d64073c5b969', 26, 'What files do I actually receive at the end?', 'A complete brand kit including source files, export formats for web and print, and a usage guide covering colors, fonts, and logo spacing rules.', 1, 0, 2, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(18, 'f0f27be8-1d69-4364-8485-b5f43475d760', 26, 'How many logo concepts do you typically present?', 'Usually three distinct directions to start, refined based on your feedback into one final, polished identity rather than dozens of similar variations.', 1, 0, 3, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(19, '2c701796-b1fa-4918-af00-60c29b80549b', 27, 'Will migrating to the cloud mean downtime for our users?', 'We plan every migration to minimize downtime, often to a small maintenance window communicated in advance, with a tested rollback plan in case anything goes wrong.', 1, 0, 1, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(20, '61285523-a609-4fe1-8b22-cb0f5981ee1f', 27, 'How do you decide between AWS and Azure for a project?', 'It depends on your existing tools, team familiarity, and workload requirements, we recommend based on what actually fits your situation.', 1, 0, 2, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(21, '23e2f06e-8887-431d-ac9d-57527facfb66', 27, 'Do you provide ongoing infrastructure monitoring after setup?', 'Yes, we offer ongoing monitoring and support plans so issues are caught and resolved before they turn into downtime.', 1, 0, 3, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(22, '319c70be-b146-49ec-849f-e051d68e1b19', 28, 'Can you integrate with a tool that does not have public documentation?', 'In most cases yes, we can work with what is available, including reverse-engineering safe integration paths where a provider offers limited but usable access.', 1, 0, 1, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(23, 'a1ed4ab8-c01d-4034-a5a6-4a011c12ed12', 28, 'How do you keep integrated data secure?', 'We follow standard security practices including encrypted connections, secure authentication like OAuth, and limiting each integration to only the data access it actually needs.', 1, 0, 2, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(24, '7319ca26-4236-4094-a4f3-bf9607736791', 28, 'What happens if a third-party API changes or goes down?', 'We build integrations with error handling and monitoring in place, so failures are caught quickly and we can respond before it becomes a bigger issue.', 1, 0, 3, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(25, '9be0e93a-ecc6-44af-b513-9abcb636e6b9', 29, 'Which CMS is best for my business?', 'It depends on your content complexity and team, WordPress fits most standard business sites well, while a headless CMS makes more sense if you are publishing across multiple platforms.', 1, 0, 1, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(26, '1bed2074-a450-4c3e-9f91-d1befd4677e7', 29, 'Can you train our team to use the CMS?', 'Yes, every CMS project includes a walkthrough session so your team feels confident managing content independently from day one.', 1, 0, 2, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(27, 'd9e7bc71-a3e3-4839-900a-6334027e1166', 29, 'Is WordPress secure enough for a business website?', 'Yes, when configured and maintained correctly. Most WordPress security issues come from outdated plugins and weak hosting, both of which we address directly.', 1, 0, 3, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(28, 'b816912f-25d2-46f6-bb9d-1299cbe0fead', 30, 'What is included in a standard maintenance plan?', 'Typically regular backups, software and security updates, uptime monitoring, and a set number of support hours each month for fixes and small changes.', 1, 0, 1, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(29, 'eed1141d-f6aa-4db2-a522-eabae72507df', 30, 'What happens if something breaks outside of your monitoring hours?', 'Critical issues are flagged by automated monitoring around the clock, and response time depends on the support plan tier you choose.', 1, 0, 2, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(30, '5557950c-bb40-4969-b68a-376c0ed634ed', 30, 'Do I need a maintenance plan if my site rarely changes?', 'Yes, even a site that never changes still depends on software and plugins that need security updates, skipping maintenance is one of the most common causes of preventable breaches.', 1, 0, 3, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(31, '557d045e-62b7-48c1-ab57-9e4b713032e7', 31, 'Do I need a dedicated server, or is VPS enough?', 'Most growing businesses are well served by a properly sized VPS. A dedicated server usually only becomes necessary at high, consistent traffic volumes or specific compliance requirements.', 1, 0, 1, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(32, 'd70146fa-50c5-416b-8758-a7bcc1752f02', 31, 'How often are backups taken?', 'Backup frequency is set based on how often your data changes, typically daily, with backups stored off-site so a server issue cannot affect the backup itself.', 1, 0, 2, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(33, '81eac5b7-ffaf-47fd-8c6a-40769cd9ed13', 31, 'Can you migrate my site to new hosting without downtime?', 'In most cases yes, we plan migrations to minimize or fully avoid downtime, with a rollback option ready in case anything unexpected comes up.', 1, 0, 3, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(34, 'df2248bf-6828-44d6-a74f-89e21d21dc8d', 32, 'Do you offer one-time testing or ongoing QA support?', 'Both, some clients need a focused audit before a major release, others bring us in as an ongoing extension of their team across every sprint.', 1, 0, 1, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(35, '06174c1f-a385-4508-b736-9265456e2f09', 32, 'Can you test an existing product with no documentation?', 'Yes, we regularly take over QA for live products with no prior documentation, starting by mapping the current state before building a test plan around it.', 1, 0, 2, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(36, 'f1706a11-ce68-4c63-a74e-86a925200dc1', 32, 'Can QA be integrated into our CI/CD pipeline?', 'Yes, we set up automated test suites to run on every build, so quality checks happen continuously rather than only right before release.', 1, 0, 3, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(37, '205d40fe-d54b-4c1f-a2a7-81e20b00543a', 32, 'How do you report bugs to our development team?', 'Every defect is logged in the tracking tool you already use, with clear steps to reproduce, screenshots or recordings, and severity so nothing gets lost in translation.', 1, 0, 4, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_features`
--

CREATE TABLE `service_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `is_highlighted` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_features`
--

INSERT INTO `service_features` (`id`, `uuid`, `service_id`, `title`, `short_description`, `icon`, `image`, `image_alt`, `is_highlighted`, `is_active`, `display_order`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '644f7e71-fc1b-497f-9317-252e928f86bd', 21, 'UI/UX Design', 'Before a single screen is designed, we map out how a real user is expected to move through the site, what they are looking for first, what would make them hesitate, and what would make them leave. Design decisions come from that map, not from what simply looks good in isolation. The result is an interface people navigate without having to think about where to click next, which directly reduces drop-off and builds the kind of comfort that turns a visit into a conversation.', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:12', '2026-07-21 04:29:12', NULL),
(2, '43fd424f-559f-4efb-a1b5-74082b91dcd6', 21, 'Responsive Design', 'More than half of most websites\' traffic now arrives on a phone, and a layout that only works on desktop is quietly turning away that majority. We build every page to adapt cleanly across phone, tablet, and desktop screens, so buttons stay tappable, text stays readable, and nothing breaks or overlaps depending on what device someone happens to be using.', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:12', '2026-07-21 04:29:12', NULL),
(3, 'e9b4238f-cbb3-4a11-b4d4-bf91d914b763', 21, 'Landing Pages', 'A landing page exists to do one thing well: move a specific visitor toward one specific action, whether that is booking a call, downloading something, or completing a purchase. We strip away the navigation menu, the extra links, and the distractions that a normal website page needs, and build a focused page where every element earns its place.', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:12', '2026-07-21 04:29:12', NULL),
(4, 'ff4d0d6b-773a-443f-a4cc-484f92b081c2', 21, 'Website Redesign', 'An outdated website does not just look old, it actively signals to visitors that the business behind it might be outdated too. We start a redesign by auditing what is actually underperforming, load speed, mobile experience, unclear messaging, and rebuild around modern standards while preserving what already works, including your existing SEO rankings.', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:12', '2026-07-21 04:29:12', NULL),
(5, 'bcbbe813-6c21-4480-9ea5-af8650b0776b', 21, 'CMS Development', 'If updating your own website means emailing a developer and waiting three days, the website is working against you, not for you. We build on content management systems configured so your own team can add pages, update pricing, or publish a blog post confidently, without accidentally breaking the design.', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:12', '2026-07-21 04:29:12', NULL),
(6, 'bcaf08a7-41b1-4bc6-a22f-b0ed3b7a9407', 22, 'ERP', 'When inventory counts live in one spreadsheet, financial records live in another system, and operations updates happen over messages, small mistakes compound into expensive ones fast. We build ERP systems that bring these core functions into a single, reliable source of truth.', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(7, '5cf7bdb2-3721-433a-a3d8-49356ed9a633', 22, 'CRM', 'A CRM is only as useful as your sales team\'s willingness to actually use it. We build CRMs shaped around how your sales process genuinely works, so logging a call or moving a deal forward takes seconds, not a dedicated data-entry session at the end of the day.', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(8, 'bb21a35d-29a1-410b-9d37-e66ca52097ef', 22, 'Business Automation', 'Every hour spent on a repetitive manual task, copying data between systems, generating the same report by hand every week, is an hour not spent on work that actually grows the business. We identify which tasks can be automated safely and build the workflows to handle them.', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(9, '23e27973-dd2d-46ae-a11b-d2c630aa8471', 22, 'Enterprise Software', 'At enterprise scale, small inefficiencies do not stay small, they multiply across every team and department. We build enterprise software designed for scale and security from the first line of code, engineered to hold up under real organizational complexity.', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(10, '26d0734e-0e47-4aab-93fd-9f5f2db3b10e', 22, 'Desktop Applications', 'Not every workflow belongs in a browser tab, especially ones that require offline reliability, heavy local processing, or deep integration with a user\'s machine. We build native and cross-platform desktop applications engineered for speed and dependability.', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(11, 'b20cf6ec-4ef0-4e27-bf0b-280b55eb1d1a', 23, 'Shopify', 'We build and customize Shopify stores well beyond a default theme, tuning them for speed, mobile checkout, and the specific way your product catalog actually needs to be presented.', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(12, 'ddcc609a-c184-45ee-a138-caf6418d5912', 23, 'WooCommerce', 'For businesses already on WordPress, WooCommerce extends the existing site into a full store without starting from scratch. We configure it properly for performance and security.', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(13, 'f4c56210-2d5b-418b-ac85-755dbf8d3a3b', 23, 'Custom Stores', 'When your product catalog, pricing logic, or customer journey does not fit neatly into a standard platform, we build a fully custom store engineered around exactly how you sell.', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(14, 'ab905a9a-a8ec-4086-8cf5-dc83a8675d49', 23, 'Multi-vendor Marketplace', 'Running a marketplace means managing multiple sellers, individual inventories, and commission splits at the same time. We build multi-vendor platforms that keep that complexity organized on the backend while staying simple for every seller.', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(15, 'ba76db1d-03a6-4848-a7a9-44c10af2d6ae', 23, 'Payment Integration', 'A failed or clunky payment step is one of the fastest ways to lose a sale that was already won. We integrate secure, reliable payment gateways so transactions complete smoothly across cards, digital wallets, and regional payment methods.', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:13', '2026-07-21 04:29:13', NULL),
(16, 'ed1ff47e-594a-4dfb-8301-c8ecdba02a62', 24, 'Technical SEO', 'Search engines cannot rank content they cannot properly crawl and understand, no matter how good that content is. We fix the technical foundation, site speed, crawlability, indexing, structured data.', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(17, 'd829ab3b-9f58-4167-9bf9-7648f1eeb35e', 24, 'On-Page SEO', 'Every page should be built to clearly answer a specific search intent, both for the reader and for the algorithm trying to understand what the page is about. We optimize content structure, headings, and metadata.', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(18, '87ba28e6-3968-4379-9fa2-9581131a4453', 24, 'Off-Page SEO', 'Rankings are not built on your website alone, they are also earned through trust signals from elsewhere on the internet. We build authority through legitimate outreach and link-building strategies.', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(19, 'd392317d-83b2-4fa0-9daf-1fb69e09bf2d', 24, 'Local SEO', 'For businesses that serve a specific city or region, showing up in local map results often matters more than ranking nationally. We optimize your Google Business presence and local citations.', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(20, 'a0a78468-a59e-458a-9f57-d511b22c3a50', 24, 'SEO Audits', 'Before fixing anything, we find out exactly what is holding your site back. Our audits go beyond a generic automated checklist, prioritizing the specific issues that will actually move rankings.', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(21, '97a568d3-206f-4e13-9429-1ab1f6ccd054', 25, 'Google Ads', 'We build and manage Google Ads campaigns around buyer intent, not just visibility, targeting the specific searches that are closest to an actual purchase or lead decision.', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(22, 'a8d5b513-8b5c-4cfe-ad2e-f16829286e31', 25, 'Meta Ads', 'Facebook and Instagram audiences respond to different creative than a search ad ever will. We build Meta campaigns with scroll-stopping creative and precise audience targeting.', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(23, '994e36b7-539c-450d-ab0c-7abbaa7dd153', 25, 'PPC Campaigns', 'Every paid click should be working toward a return, not just adding to a traffic count. We manage PPC campaigns across platforms with constant testing and optimization.', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(24, 'daf15a21-a8bd-4427-8621-09cbf225852d', 25, 'Lead Generation', 'We build campaigns and landing experiences specifically designed to capture qualified leads, not just raw traffic, so your sales team spends its time on prospects who are genuinely worth pursuing.', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(25, 'f41c8472-33f9-487c-bae3-affa24624fdb', 25, 'Conversion Optimization', 'More traffic does not fix a leaky funnel, it just sends more people through the same broken path. We test and refine the actual conversion journey, page by page and step by step.', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(26, '860f0795-6041-4a9b-ae1b-63e3b450bada', 26, 'Logo Design', 'A logo needs to work small on a business card and large on a storefront sign, in full color and in a single flat color, without losing clarity in either direction. We design marks that hold up across every size and context your business actually needs.', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(27, 'ca5783ac-5095-428c-83b1-c5624a52ebf4', 26, 'Brand Identity', 'Colors, typography, tone of voice, and imagery style should all say the same thing about your business, not compete with each other. We build a complete identity system with clear usage guidelines.', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(28, '29237cc1-be47-4f61-9786-b4182423d864', 26, 'Business Stationery', 'Business cards, letterheads, and invoices are small details, but they are also some of the most physically handled brand touchpoints you have. We design stationery that carries your identity consistently.', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(29, '683bffe2-6f8a-4629-b68a-cf431817e052', 26, 'Social Media Creatives', 'Feeds move fast, and inconsistent visuals get scrolled past without a second look. We design social creative templates that keep your brand instantly recognizable post after post.', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:14', '2026-07-21 04:29:14', NULL),
(30, '3b2da5ad-36e9-4017-bec9-9b690b68078f', 26, 'Marketing Materials', 'From brochures to trade show banners to pitch decks, we design marketing collateral that stays strictly on-brand and actually communicates your value clearly.', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(31, '7c212343-1e4e-44c4-8021-72aa6a69703c', 27, 'AWS', 'We architect and manage AWS environments sized for your actual workload, balancing performance against cost instead of over-provisioning by default.', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(32, 'd5ca0353-1aae-48cd-82ef-8d87c96b42ee', 27, 'Azure', 'For teams already inside the Microsoft ecosystem, we build and manage Azure infrastructure that integrates cleanly with your existing tools and identity systems.', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(33, 'b54969d0-f3a1-49c1-9612-989f0f0b89cd', 27, 'Docker', 'Containerizing an application means it runs identically everywhere, on a developer\'s laptop, in staging, and in production, eliminating the \"it worked on my machine\" problem.', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(34, '9f6ba4e8-5bde-498d-9e62-16d8fbe3f804', 27, 'CI/CD', 'Manual deployments are slow, stressful, and prone to human error. We set up continuous integration and delivery pipelines so code moves from commit to production safely and automatically.', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(35, '9f3fa4af-c140-48a8-8f03-ce678fd9d41e', 27, 'Server Deployment', 'We handle server setup and deployment configuration so your application launches on infrastructure that is secure, properly monitored, and genuinely built to handle real traffic from day one.', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(36, 'd071a9d6-1e92-4af7-aeb7-739abb96646a', 27, 'Cloud Migration', 'Moving off legacy infrastructure is genuinely risky if it is not planned carefully. We migrate systems to the cloud with a clear rollback plan at every stage, keeping downtime to an absolute minimum.', NULL, NULL, NULL, 0, 1, 6, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(37, '6f5ec813-5b6a-40d5-b657-169fffbea690', 28, 'REST APIs', 'We design REST APIs that are clean, consistent, and well-documented, so any team consuming them, internal or external, can integrate quickly without needing to guess how an endpoint is supposed to behave.', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(38, 'c29b1eaa-eac2-4e2f-99fb-3d0d67fc297c', 28, 'Third-Party APIs', 'We integrate the external tools your business already depends on, shipping providers, payment processors, marketing platforms, directly into your product without disrupting existing workflows.', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(39, '01cf88bf-3329-4080-8df0-8eea14c8200a', 28, 'Payment APIs', 'Payment integrations need to be both seamless for the customer and airtight on security. We connect payment gateways correctly the first time, handling edge cases that many integrations overlook.', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(40, '16bff009-b6f2-4c0a-a950-743b43f4f3f8', 28, 'CRM Integration', 'Customer data trapped in one system is data your team cannot act on anywhere else. We connect your CRM to the rest of your stack so information flows both ways automatically.', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(41, 'f5292f29-d8ac-47f2-ba42-9fa3af353584', 28, 'ERP Integration', 'We connect ERP systems to your other business tools so inventory, finance, and operations data stays consistent everywhere it is used.', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(42, '2f5d355e-b18e-4a05-b2e6-bdae82335080', 29, 'WordPress', 'We build custom WordPress sites engineered for speed and security well beyond a default theme and plugin stack, since an unoptimized setup is one of the most common causes of slow load times and security vulnerabilities.', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(43, '08e2557f-1378-4151-9fcf-568b3959f7dd', 29, 'Headless CMS', 'When your content needs to power a website, a mobile app, and other channels at the same time, a headless CMS keeps content centralized in one place while each front-end stays fully flexible.', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(44, 'e4f03702-650e-42c3-ae3d-62fc537c4a72', 29, 'Custom CMS', 'Sometimes an off-the-shelf CMS simply cannot match a genuinely unusual content workflow. We build custom content systems tailored exactly to how your team creates, approves, and publishes content.', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:15', '2026-07-21 04:29:15', NULL),
(45, '9bba4c07-fecd-475e-b499-eac69e624d1b', 29, 'Content Migration', 'Moving years of accumulated content between platforms is genuinely high-risk if handled carelessly. We migrate content carefully, preserving formatting, structure, and search rankings.', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(46, 'bf7d86d7-4061-400c-9fb0-c32fce429d1e', 29, 'CMS Maintenance', 'A CMS needs ongoing care, security patches, plugin updates, performance checks, to stay reliable over time. We keep it running smoothly in the background.', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(47, 'f4c3586b-8b19-41ff-b5fb-d165ad5c1bbb', 30, 'Website Maintenance', 'We handle the routine upkeep, backups, plugin and platform updates, broken link checks, that keep a website healthy over time, so it stays reliable without you having to think about it.', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(48, '5cd52679-231c-4449-aed8-d70379927d31', 30, 'Software Updates', 'We keep your software current with the latest dependencies, libraries, and platform updates, reducing both security risk and compatibility issues that quietly build up over time.', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(49, '12a3ff9d-02d2-4d52-81e9-a98977cd872e', 30, 'Bug Fixes', 'When something breaks, response time matters more than almost anything else. We diagnose and resolve bugs quickly, focused on root-cause fixes rather than quick patches.', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(50, '42df4544-f198-4e55-8fa0-06e5477aec35', 30, 'Security Monitoring', 'We monitor for vulnerabilities and suspicious activity continuously, not just during an annual review, so threats are caught while they are still small.', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(51, '9697d0f5-5213-4568-ac0f-1780326f0bf8', 30, 'Performance Optimization', 'A slow site loses visitors before they even see your content. We continuously tune performance, load times, database queries, image and asset sizes, to keep the experience fast.', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(52, 'f981b2c7-434d-49a2-8f7f-07c52f5af129', 31, 'VPS Setup', 'We configure virtual private servers sized correctly for your actual traffic, giving you dedicated resources and much greater control than shared hosting.', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(53, '7b8b12a0-89c4-4c4f-9c25-c597c3b26836', 31, 'Dedicated Servers', 'For high-traffic or resource-intensive applications, we set up and manage dedicated servers built for maximum performance, giving you full control over the environment.', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(54, '320ba53d-1fc5-414f-aedd-4297ed6a685b', 31, 'SSL', 'We implement and manage SSL certificates so every connection to your site is encrypted, keeping visitor data safe and ensuring browsers show your site as secure.', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(55, '2118f915-2c06-4bb0-b13f-435abe8bff3c', 31, 'Email Hosting', 'We set up reliable, professional email hosting on your own domain, configured correctly with proper authentication records so messages actually land in inboxes.', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:16', '2026-07-21 04:29:16', NULL),
(56, '7d9837ff-7265-4309-bc87-082e19149b91', 31, 'Backup & Disaster Recovery', 'We set up automated, regularly tested backups and a clear recovery plan, so a server failure or bad deployment never means permanently losing your data.', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(57, '2e1cf75b-a26f-49f1-86ed-139cc33b8a0d', 32, 'Manual Testing', '<p><strong>Description:</strong> A hands-on testing approach where our team explores your product the way a real user would, without a script dictating every click, deliberately probing for anything that feels wrong even if it is not technically a bug.</p><p><strong>Why You Need It:</strong> Automated scripts repeat known checks well, but they cannot notice a page that feels confusing or an error message that makes no sense. Human judgment catches what a script is blind to.</p><p><strong>Key Benefit:</strong> You get issues surfaced that would otherwise only be discovered after real customers hit them and complain.</p><p><strong>Core Value:</strong> Human perspective and real-world judgment applied to your product before it reaches real users.</p>', NULL, NULL, NULL, 0, 1, 1, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(58, '1e74af95-123b-4ecd-8f01-73f26bad9495', 32, 'Automated Testing', '<p><strong>Description:</strong> Building repeatable test scripts around your critical flows, login, checkout, core navigation, so they can be run automatically on every release instead of manually every time.</p><p><strong>Why You Need It:</strong> Manually re-checking the same core flows on every release does not scale and eats up hours your team does not have.</p><p><strong>Key Benefit:</strong> Faster release cycles, since regression checks that used to take days now run in minutes.</p><p><strong>Core Value:</strong> Consistent, repeatable quality checks that scale with your release frequency instead of slowing it down.</p>', NULL, NULL, NULL, 0, 1, 2, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(59, '777ed6a8-cb1e-423e-89c2-1b530245452e', 32, 'Functional Testing', '<p><strong>Description:</strong> Validating that every feature does exactly what it was built to do, checking business logic, workflows, and edge cases beyond the obvious \"happy path.\"</p><p><strong>Why You Need It:</strong> A feature that works in the one scenario a developer tested is not the same as a feature that works in every scenario a real customer will actually hit.</p><p><strong>Key Benefit:</strong> Confidence that shipped features actually deliver the business outcome they were built for, not just a passing demo.</p><p><strong>Core Value:</strong> Direct validation between what was promised and what was actually built.</p>', NULL, NULL, NULL, 0, 1, 3, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(60, '6c4ebb03-2e24-4c4f-895e-977c199db2d2', 32, 'Regression Testing', '<p><strong>Description:</strong> Re-testing existing features after every code change to confirm that a fix or new feature did not quietly break something that was already working.</p><p><strong>Why You Need It:</strong> New code fixes one thing and breaks three others more often than most teams admit, especially in fast-moving products with frequent releases.</p><p><strong>Key Benefit:</strong> Protection for the features your customers already rely on, so today\'s update does not become tomorrow\'s support ticket.</p><p><strong>Core Value:</strong> A safety net that keeps forward progress from creating backward damage.</p>', NULL, NULL, NULL, 0, 1, 4, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(61, '112c9d22-75a0-4522-b073-4574b93bd43d', 32, 'Performance & Load Testing', '<p><strong>Description:</strong> Simulating real-world traffic and stress conditions to see exactly how your system behaves under pressure, before a sale, launch, or viral moment does it for real.</p><p><strong>Why You Need It:</strong> A product that works perfectly for ten users and collapses under ten thousand is not actually ready for growth.</p><p><strong>Key Benefit:</strong> Confidence that your infrastructure will hold up during the exact moments when it matters most, high traffic, high stakes.</p><p><strong>Core Value:</strong> Proof, not assumption, that your system can handle real demand.</p>', NULL, NULL, NULL, 0, 1, 5, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(62, '1cfd2490-ec0d-4fac-8966-43ce6a0baf06', 32, 'Security Testing', '<p><strong>Description:</strong> Probing authentication, authorization, and common vulnerabilities the way an attacker would, before those weaknesses become a real incident.</p><p><strong>Why You Need It:</strong> Every application collects, stores, or moves data that someone could try to exploit, and most breaches start from a gap nobody thought to check.</p><p><strong>Key Benefit:</strong> Vulnerabilities identified and closed before they turn into a data breach, downtime, or reputational damage.</p><p><strong>Core Value:</strong> A proactive security posture instead of a reactive one built only after something goes wrong.</p>', NULL, NULL, NULL, 0, 1, 6, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(63, '21fb2e0a-4025-4e3c-a512-833ba9799337', 32, 'API Testing', '<p><strong>Description:</strong> Testing the contracts between systems directly, independent of whatever interface sits on top of them, covering both REST and GraphQL endpoints.</p><p><strong>Why You Need It:</strong> Most modern products are held together by APIs users never see, and a broken connection there can silently break features that look fine on the surface.</p><p><strong>Key Benefit:</strong> Reliable data flow between every system your product depends on, caught at the source instead of downstream.</p><p><strong>Core Value:</strong> Confidence in the invisible infrastructure that your entire user experience quietly depends on.</p>', NULL, NULL, NULL, 0, 1, 7, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(64, '77055b89-ef82-4d0a-88d5-8f3e278bad78', 32, 'Cross-Browser Testing', '<p><strong>Description:</strong> Verifying your product looks and functions correctly across Chrome, Firefox, Edge, and Safari, not just the one browser your team happens to use.</p><p><strong>Why You Need It:</strong> A feature that works perfectly in Chrome can behave completely differently, or break outright, in Safari or Firefox.</p><p><strong>Key Benefit:</strong> A consistent experience for every visitor, regardless of which browser they walk in with.</p><p><strong>Core Value:</strong> No customer left out because of a browser your team never tested against.</p>', NULL, NULL, NULL, 0, 1, 8, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(65, 'cf6d4a2c-9659-4ade-8d0e-a5215cff5137', 32, 'Mobile App Testing', '<p><strong>Description:</strong> Testing across real Android and iOS device and OS combinations, not just the single phone your development team happens to carry.</p><p><strong>Why You Need It:</strong> Android and iOS are different ecosystems with different rules, screen sizes, and user expectations, and issues on one rarely show up on the other.</p><p><strong>Key Benefit:</strong> An app that performs reliably across the actual range of devices your users own, not just a flagship test phone.</p><p><strong>Core Value:</strong> Real device coverage that protects your app store ratings and user retention.</p>', NULL, NULL, NULL, 0, 1, 9, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(66, '710f84bb-702e-4037-ae26-7b2ba9795371', 32, 'Usability Testing', '<p><strong>Description:</strong> Evaluating whether real users can actually accomplish what they came to do, without confusion or unnecessary extra effort, beyond just checking that features technically function.</p><p><strong>Why You Need It:</strong> A product can be fully functional and still frustrate the people using it, and frustrated users quietly churn instead of complaining.</p><p><strong>Key Benefit:</strong> A product that feels intuitive, which directly reduces support tickets and increases user retention.</p><p><strong>Core Value:</strong> The difference between software that works and software people actually enjoy using.</p>', NULL, NULL, NULL, 0, 1, 10, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(67, '31c8dc50-b21f-4a79-ae04-5cb32dce2c6d', 32, 'Accessibility Testing', '<p><strong>Description:</strong> Testing against WCAG standards so people using screen readers, keyboard navigation, or other assistive technology can use your product without hitting walls your team never noticed.</p><p><strong>Why You Need It:</strong> Accessible software is not a compliance checkbox, it is a wider door for more of your customers to walk through, and inaccessible products quietly exclude real users.</p><p><strong>Key Benefit:</strong> A larger addressable audience and reduced legal risk around accessibility compliance requirements.</p><p><strong>Core Value:</strong> Software that works for everyone, not just the majority use case your team designed around.</p>', NULL, NULL, NULL, 0, 1, 11, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(68, '926a282e-0abe-4b6d-83b3-58fdd6af587b', 32, 'Database Testing', '<p><strong>Description:</strong> Verifying that information moves through your system accurately, from the moment a user submits it to however long it needs to be stored, including migrations and query behavior.</p><p><strong>Why You Need It:</strong> An interface can look perfect while the data underneath it is quietly corrupted, duplicated, or lost, and that kind of failure often goes unnoticed until it is expensive to fix.</p><p><strong>Key Benefit:</strong> Confidence that the data driving your business decisions and customer records is actually accurate.</p><p><strong>Core Value:</strong> Integrity at the foundation layer that every other feature depends on.</p>', NULL, NULL, NULL, 0, 1, 12, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(69, '47c73018-9ac1-4ec6-8e4d-0d4c9271265b', 32, 'Smoke & Sanity Testing', '<p><strong>Description:</strong> Running fast checks to confirm a build is stable enough to test at all, before a full test cycle begins, catching obvious breakages early.</p><p><strong>Why You Need It:</strong> Discovering a build is fundamentally broken halfway through a deep testing pass wastes time on both sides that a five-minute check could have saved.</p><p><strong>Key Benefit:</strong> Faster feedback loops and less wasted testing effort on builds that were never release-ready to begin with.</p><p><strong>Core Value:</strong> A quick, reliable gate that protects the rest of the QA process from wasted effort.</p>', NULL, NULL, NULL, 0, 1, 13, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(70, 'fa17b240-1854-460f-9758-5faecce94220', 32, 'User Acceptance Testing (UAT)', '<p><strong>Description:</strong> Bringing real business stakeholders into the process to confirm the product actually solves the problem it was built for, before it goes live to your customers.</p><p><strong>Why You Need It:</strong> Technical correctness and business fit are not always the same thing, a feature can pass every test and still miss what the business actually needed.</p><p><strong>Key Benefit:</strong> Sign-off from the people who matter most, ensuring the final product genuinely fits real business needs.</p><p><strong>Core Value:</strong> The final confidence check that closes the gap between \"it works\" and \"it\'s right.\"</p>', NULL, NULL, NULL, 0, 1, 14, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(71, '5ace48a1-d809-4255-a4b4-057b85e9ebfb', 32, 'Test Case Design & Documentation', '<p><strong>Description:</strong> Writing and documenting clear test plans, cases, and scenarios, so your team has a lasting reference and every defect is reported with enough detail to act on immediately.</p><p><strong>Why You Need It:</strong> Good testing needs to be repeatable, not something that lives only in one tester\'s memory and disappears when that person moves on.</p><p><strong>Key Benefit:</strong> A durable, reusable testing asset your team can rely on across every future release, not just this one.</p><p><strong>Core Value:</strong> Institutional knowledge captured in a form your whole team can use, not just the person who did the testing.</p>', NULL, NULL, NULL, 0, 1, 15, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL),
(72, '7636db22-9bff-4115-99f1-6d6da434b004', 32, 'QA Consulting & Process Improvement', '<p><strong>Description:</strong> Assessing how your team currently handles quality, then helping build testing into your existing workflow and CI/CD pipeline so it strengthens delivery speed instead of slowing it down.</p><p><strong>Why You Need It:</strong> Sometimes the gap is not a missing test, it is a missing process, and no amount of individual testing effort fixes a broken workflow.</p><p><strong>Key Benefit:</strong> A QA process that scales with your team, catching issues systematically instead of depending on individual heroics.</p><p><strong>Core Value:</strong> A lasting improvement to how your team ships software, not just a one-time testing pass.</p>', NULL, NULL, NULL, 0, 1, 16, 0, '2026-07-21 04:29:17', '2026-07-21 04:29:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_platforms`
--

CREATE TABLE `service_platforms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `platform_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_problems`
--

CREATE TABLE `service_problems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_solutions`
--

CREATE TABLE `service_solutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_technology`
--

CREATE TABLE `service_technology` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `technology_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0kqVo57Bf4YhSH99rKikcSDLMI5ppRYZFKXmSU8Z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2E1M3l2RmdKUTBqTEY2Y0ZpdWZIWFBkWjBCUWVESHZyZkFIVTk5cyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158442),
('0NB9EnACyJEVSMwIvIPQkkinxNY8Hseegx4uwhcC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTJ2eVYxamZyQVJLakVlb0p4cTVBblhPa0c5MVo5b0FUaUZGcUR1NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781157623),
('3HRCk0aTVjvmFOuoFt15D65NwD9HhAKRG95Dd1uR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibWlRZ3p1VFhUajVsZjAwTFRZQXA3YVNkWXNvWlhPVlB0N3puMUNFRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781157499),
('3T3DhGRJfKe4Cz4pMaixZKqIHkZ6yhLJH0NYwirq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaENxVnI5dU0zSnpiZE1oOWllZ3M2V1JEV25qS2xjdER5elFKbjN5RSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158615),
('4GncQ4fRhpnDL32L9Zzu9O9HbOabTMGJi8CAuoGo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnVpd0NBSHVZaG9tR1BKYzlnbTV6bUs1c0FwQ3hDaVZIVUhuWkNXUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158422),
('4vedmzoJF4rE1hzGKeS9PysmJgGnki6JskZnCVWF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibzh0U05ROGJFdnh5OUZqeGtqbnY3cU1Zb1NjWDlVSUZUSXBFTEZEbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158721),
('7gJWaEpWVlQlThYXSkvgdBimFugr4C9QyoklslOK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0pyUk85elVFd3hJU3hZYW9yUWNWa0M1SkRnem9FS3Q0VG9VaUJBayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781159046),
('85md6WsSlIaKPkC2Ri36j7uRpH3hB3Nd18X2pdWu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienlFU3hPcDA1d2JFWHE1QUtESVBjSG9LalNDNzlDbXE4OFBwc29RWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781157909),
('9gLpIBafiplGzfNKdR7RHZpxRjFCHiOrf0nAq4TF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiODFkR1prTFhSTUFmV0tsZTh4cXZzYnRiZFFVMmliOXVpcEVMSUo5SyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158620),
('9sWibXDFk9xzfpL4jIgrzjZoMbfd0r6yPULehpbM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGdMQzEwWnM1cTlUQ1FVbmpDc2RJNTYwOWlJUjV6NlFJR2JNZGY1ZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158678),
('9vPXYpLqhNUtluDIRqgG29aaNYgvaUbpM6zpwwUj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieG5ubGdQVHpObE9QSW1JcE1kU1FDWWxRSmFOWk1SYklWcXI0a0VIZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158608),
('aFTYoTm73EjBWEMuOUqZirHW4j8a0nSJmvFJrrfz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHRlUk5FcE1JcFY5Unc2V01UbzlFT3Jvc0FaU25VRDVkRlZjTlVhMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158711),
('BcnKT03qAuzAnlqCjeVAxb8S3Jh2TwajV4ebhkJR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibXQ5bjZ4a25xckdNQU9PWVpZVWRKZFNXRkUzcDVlaFdUblVWUWFVdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158714),
('DCEnXKLimpsrqCc2l8BW1TggNcgW8DggHcff3ZhD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3pERkZFTUFTNFVxM2J0b1phektENm9HOWl6THBvbUNiZk1TbGJQMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781156706),
('DInTZlEvqgYcsDgWqzyxfMsFaFZkQhJ4VESIIAgB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidllsaUhxVmczcHdqTUl0UjdmQjRHYlNWcjhjWXVKTEp1Qm1HdkFjayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158658),
('f3nVHefPlQjS8MBchznsI16XNKctGuBOlOtKGXtm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmRoNU1Wa0J5YkZNTHU2bmZUa24xaXkySUJkaUNFZHFMQ0tGdFI1ViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781157424),
('FMofHOdgaJLITktEIvrc4DRihWx2t1RFrJ89Qdae', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTjFKRmcxZHRaTVlDcFJjQmpoaXJGYktBb0tVZHQ0SGt6Y1NpbWowYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158268),
('Fry587xUH7tAMfwzgzt2oYp1kBefThr9X0H83YD9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGgyeUJ4VzBHWUF4Z2hRWFNxRTNEQTNzOVZqZml1ampFMXZMcnNudCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoxNjoiZnJvbnQuaG9tZS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781155164),
('hn7oLfE8Fse2WxfrVspcTURpGCdft1BBnvqgXlrP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'YToxMzp7czo2OiJfdG9rZW4iO3M6NDA6Im85T1p0bVBZNXRKdWlibG1CdDhCd2NST0x6Yk9xV25zT3VoVmYyTTYiO3M6NjoiX2ZsYXNoIjthOjI6e3M6MzoibmV3IjthOjA6e31zOjM6Im9sZCI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjkyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vYmxvZ3MvY29tbWVudHMvY3JlYXRlb3JlZGl0LzQxNjlhMjE4LTY0OGQtMTFmMS1iOTI1LTQ4NGQ3ZWQ5ODg3YyI7czo1OiJyb3V0ZSI7czozMzoiYWRtaW4uYmxvZ3MuY29tbWVudHMuY3JlYXRlb3JlZGl0Ijt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTI6ImF1dGhfdXNlcl9pZCI7aToxO3M6MTQ6ImF1dGhfdXNlcl9uYW1lIjtzOjEyOiJTeXN0ZW0gQWRtaW4iO3M6MTU6ImF1dGhfdXNlcl9lbWFpbCI7czoyMDoiYWJoaWlpMjQwNEBnbWFpbC5jb20iO3M6MTA6ImxvZ2luX3RpbWUiO086MjU6IklsbHVtaW5hdGVcU3VwcG9ydFxDYXJib24iOjM6e3M6NDoiZGF0ZSI7czoyNjoiMjAyNi0wNi0xMSAwNjoxOTo0Ny4wOTA4OTkiO3M6MTM6InRpbWV6b25lX3R5cGUiO2k6MztzOjg6InRpbWV6b25lIjtzOjM6IlVUQyI7fXM6ODoibG9naW5faXAiO3M6OToiMTI3LjAuMC4xIjtzOjExOiJsb2dpbl9hZ2VudCI7czo4MDoiTW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NDsgcnY6MTUxLjApIEdlY2tvLzIwMTAwMTAxIEZpcmVmb3gvMTUxLjAiO3M6MTM6ImxvZ2luX2Jyb3dzZXIiO3M6NzoiRmlyZWZveCI7czoxMjoibG9naW5fZGV2aWNlIjtzOjc6IkRlc2t0b3AiO3M6MTQ6ImxvZ2luX3BsYXRmb3JtIjtzOjc6IldpbmRvd3MiO30=', 1781158916),
('jjEFZojKDlFvooZUolSPFUypdbHzN6I4jCOmsv6I', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTQ5N1lnemFBMkZaWldXcVE4YWV5UEZGclJVcTF0bWpRaGRDVDlubyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781157253),
('kK4REtiUri4SHkZvgFPjv4NWEabFUSYPwe33aoSC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTdlZTZsbVppRTY1cXdQRVhQRlhuaFJ4Mm9ZOUNWU25Yc3ZKTUlkayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781157662),
('KlZ084MM2RpHP3pJsxzrYZQazNRuAjncr4E6BQzi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0g3UmZOM1dnOGh2bTFqU09RazJoNEs2MGRSbVZ5ZldHc1hsVUFveSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781159042),
('ksFQtmObSSPtDXcjEDeXrOibK2FPJekvmGHwOH6r', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YToxMzp7czo2OiJfdG9rZW4iO3M6NDA6InpaNzRMMEFtZGhwSmJ1QWdaS3FwVEtuVWhxQ3lQRnhaVHl1TE1aaXciO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc3RvcmFnZS9hYmhpLnBuZyI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxMjoiYXV0aF91c2VyX2lkIjtpOjE7czoxNDoiYXV0aF91c2VyX25hbWUiO3M6MTI6IlN5c3RlbSBBZG1pbiI7czoxNToiYXV0aF91c2VyX2VtYWlsIjtzOjIwOiJhYmhpaWkyNDA0QGdtYWlsLmNvbSI7czoxMDoibG9naW5fdGltZSI7TzoyNToiSWxsdW1pbmF0ZVxTdXBwb3J0XENhcmJvbiI6Mzp7czo0OiJkYXRlIjtzOjI2OiIyMDI2LTA2LTExIDA1OjMyOjI1LjU2MDU0OCI7czoxMzoidGltZXpvbmVfdHlwZSI7aTozO3M6ODoidGltZXpvbmUiO3M6MzoiVVRDIjt9czo4OiJsb2dpbl9pcCI7czo5OiIxMjcuMC4wLjEiO3M6MTE6ImxvZ2luX2FnZW50IjtzOjE0NDoiTW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ29kZS8xLjEyMy4yIENocm9tZS8xNDguMC43Nzc4Ljk3IEVsZWN0cm9uLzQyLjIuMCBTYWZhcmkvNTM3LjM2IjtzOjEzOiJsb2dpbl9icm93c2VyIjtzOjY6IkNocm9tZSI7czoxMjoibG9naW5fZGV2aWNlIjtzOjc6IkRlc2t0b3AiO3M6MTQ6ImxvZ2luX3BsYXRmb3JtIjtzOjc6IldpbmRvd3MiO30=', 1781159231),
('m414VB7NGNwZRVoNTPDJjFNXdPTRLvDcROarZ00y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXQzS1UxRmV6M1B4blJYOUFaeG9teGJrOXlpanZqYndMVXR5N2NaTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781159232),
('MLu84pJCzeDFocd0wFXdQiVltAsKTjSpD21rDEn3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTHFtTzFQcnFneTlvS0lkRUJtczN1TWhYaEVVZmFMS2lDWUIwYmZJdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781156052),
('MTLyHrB6NCTdYKS1WlzCbWubd4RrhU9AdDRNjTlk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWRKdnFzMHByMXNYMUhVZWRsZzR3YVMyS1l5SE5wanVBNm53OXlGbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158437),
('p3wLVKAbRjzbTnIuzTWmgiPHo7mkgDXVbK05JNuv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0F3aXpnNmZ2a2ZPZ3pPZ3dYdmVtd3U3amJKN25wbEV3V0NkM0k4OSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158468),
('pNTkhjkdyxAUayNgtcVPUyBMFTLBRMzSVUOkLgFB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2pGWlNYNWRMR2hxV051TkZQYXpyNTlUU0ozNk02cWFDNUJmblcwOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781155949),
('pSU1eoxslcYBSUn9yHWBtRL1S0EJGnNgx8pe2Zgp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXFkeTdKMzBzNHd0N0pSY2JXbWd4M2lGc2h6amR4UUw2eXdVMmZCbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781159138),
('QZNpsTx7PW5tkH9JHksd6duderVkcJqMHtXRkNLK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGtISTFZQk1Eamt5NHlYMU5UTzNJS0lKUmRQZWpQR0lTZHhPT2tVayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158249),
('SHjOuq42fBHD1j8V1hiHt9xC4LVqYBnbsugvgepK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTlFEV1loYm1zNXpPOG9Sc0p4a1pyZUV5R3BOUFJYSXJmU2FjdVB5RCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781155889),
('uDxpwAMBpkYNDtF7U6qaEghKy1tdYLoowFaMERjg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibjh4S3B3QXBWRnNKZkhzM1ZNdjlaZll3Y05kdzBBblliTnZNeGIzeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781155184),
('uwrLKsoCgis1RWNMRpgfoCXLMpbyP4b8yn6LGJY0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2RiaHNTMmFkWlhGeVhkeU05RHdwVkhoYWRmWEk4cGN3UzRDRW5SeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781156078),
('VefspiH7lvLfYIKOa8S5peLTl3np5alwqlW8tqua', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialdabm1oMnFBWFhPNFFKSlA0dk5JMTNOQWxsUUd6MUhQcmtpSmdOcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158675),
('VJMxsH0XWWlnPhfrfb07kjF6IAaRcryXdToKrRTp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXQxSUc3eThjdmJLNkJld0Y3Y3k2V3JJS0psUjZJY2hQU1BXOFZZVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158338),
('VnANy7Sev0sCGpxWQFvYkq5YGkPnjEXeYO66BLZU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDFSaldOdm5EaVA4TlhRMFdqVkVIZ0VPZ3RQUDZJbnQzUk95STh4diI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158684),
('Y3LeMmZyHfnwO9hGXMGUepWxQBLSN9ZFOFoaYx4q', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTDczSlBOcnppSmtTbFFhNGhVSk5zT0tGeXJDNzVybUNxQkpiV0FIZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158473),
('ytOiPUjcbisz2qoCpbrDGkz40Yj1EDAZXv7a7eOW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnJuM0thbUppcTRwT284YmsyRUZpaVhQZTdwcGFaTENRVG1Ybm56eiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781158603),
('Zf6TZEjXP18XtvGX5oXTDWAmaAz6s2O5LVzHzHNG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid2lQak1yVXM2VE5rSkRPUGY1MTBiZjRpSnNJMGRkSEZIQUVkaW5mSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781157503),
('zyGuAxcBSUASU5cRrHwYt6gbj3KDcOpWh0ZxownG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.2 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGJlZnBpTjI2dmczR0lNM21JbDNqRWxEMXhTYlhzcDFKOUxINzAzWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NldHMvc2l0ZS53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiZnJvbnQuZmFsbGJhY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781157262);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `group` varchar(255) DEFAULT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `label` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `is_autoload` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_visits`
--

CREATE TABLE `site_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `browser` varchar(50) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `device_type` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_visits`
--

INSERT INTO `site_visits` (`id`, `uuid`, `session_id`, `ip_address`, `path`, `referrer`, `user_agent`, `browser`, `platform`, `device_type`, `created_at`, `updated_at`) VALUES
(1, '6c02d82b-083b-49e1-8040-eacfea764966', 'ODIuhtQs7hqJcy5tZyHVUCWTJDqes2rmo9L4t5dq', '127.0.0.1', '/', NULL, 'Symfony', 'Other', 'Other', 'Desktop', '2026-07-21 06:02:23', '2026-07-21 06:02:23'),
(2, '94989c9b-170e-4c42-a35a-c6e8d0a00a5b', '4osuTZnX8H496RIgknYcDVtHpheWx2nbjimuZniN', '127.0.0.1', 'testimonials', NULL, 'Symfony', 'Other', 'Other', 'Desktop', '2026-07-21 06:04:27', '2026-07-21 06:04:27'),
(3, '8b260101-4a40-494e-8246-c9944b230d2b', '8ej5ccCGGVi50xcz7qvOPINvKfXpmGEw7kGsRZxL', '127.0.0.1', '/', NULL, 'Symfony', 'Other', 'Other', 'Desktop', '2026-07-21 06:04:57', '2026-07-21 06:04:57'),
(4, 'ee0107bd-0652-4ccd-9e52-7ed44e0b0ca0', 'qZypBFIXsXf6P8waa8Amgvpn5LhB1Xg8z1iCZiU1', '127.0.0.1', '/', NULL, 'Symfony', 'Other', 'Other', 'Desktop', '2026-07-21 06:06:45', '2026-07-21 06:06:45'),
(5, 'e5c7faab-6146-4ff2-ba0c-30fef8e22c7b', '5AwLqagaRWazi8hR3bJrjGDSNiI9jolzZz9nTw91', '127.0.0.1', '/', NULL, 'Symfony', 'Other', 'Other', 'Desktop', '2026-07-21 06:06:54', '2026-07-21 06:06:54'),
(6, 'b3de85f7-164a-4869-bda0-9370993d4af7', 'Bcfl4AbAVCw38TVUFfJUB5L6sJ8EiG8i6pmdtX9S', '127.0.0.1', 'services/smoke-test-service-1784633941', NULL, 'Symfony', 'Other', 'Other', 'Desktop', '2026-07-21 06:09:01', '2026-07-21 06:09:01'),
(7, 'e935b276-d0bf-4d89-8818-785db30bb047', 'Jy1ahl3iSnrVeo3BCfpySprONqkJ4wPiu9YYT3F1', '127.0.0.1', 'services/no-features-service-1784633980', NULL, 'Symfony', 'Other', 'Other', 'Desktop', '2026-07-21 06:09:40', '2026-07-21 06:09:40'),
(8, 'e51fbcfd-1f7b-4bc4-8416-1bce481136b4', '9MJgRk19ZDlhy0aiuCfBdSjOqSHb6WAzTg7taZc9', '127.0.0.1', 'services', NULL, 'Symfony', 'Other', 'Other', 'Desktop', '2026-07-21 06:09:41', '2026-07-21 06:09:41'),
(9, '8dad2ce8-7909-4b1e-bec6-d1c0a0ff8b66', 'CjvOXHOgmou9FDeTDj6c3DJAhCAkBzqHyIWcZVsz', '127.0.0.1', 'services/no-features-service-2-1784633991', NULL, 'Symfony', 'Other', 'Other', 'Desktop', '2026-07-21 06:09:51', '2026-07-21 06:09:51'),
(10, '67c38415-1785-428f-8e0f-47258bbf9cf3', 'HLNQb2rkcE2VJ7YiYMGofzF2NqKARwHfetYxMShS', '127.0.0.1', 'services/no-features-service-3-1784634000', NULL, 'Symfony', 'Other', 'Other', 'Desktop', '2026-07-21 06:10:01', '2026-07-21 06:10:01'),
(11, '850a6468-183f-4c13-85a0-8910b25b02f9', '1o6HGbFD1qWQrh88OxAy3fKOmktHSG2Y23WtYz9a', '127.0.0.1', 'services', NULL, 'Symfony', 'Other', 'Other', 'Desktop', '2026-07-21 06:10:07', '2026-07-21 06:10:07'),
(12, '8a06ec48-8448-4ddb-8c96-51840515f8bd', 'oJTX4xTyJBpVwlT16ukN4QJTzfyDDlxiZOeNEDjm', '127.0.0.1', 'services/testing-quality-assurance-qa', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'Firefox', 'Windows', 'Desktop', '2026-07-21 06:11:47', '2026-07-21 06:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `technology_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `usage_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `uuid`, `name`, `slug`, `icon`, `description`, `type`, `technology_id`, `is_active`, `is_featured`, `display_order`, `usage_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '0e2c6b41-4820-4d90-9421-c6ec48fe24ae', 'React Native', 'react-native', 'bx bxl-react', 'asdffdas', 'sdfgsfdg', 4, 1, 1, 0, 0, '2026-02-28 21:44:18', '2026-06-04 02:24:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `smtp_settings`
--

CREATE TABLE `smtp_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Default SMTP',
  `driver` enum('smtp','sendmail','ses','mailgun') NOT NULL DEFAULT 'smtp',
  `host` varchar(255) NOT NULL,
  `port` int(11) NOT NULL DEFAULT 587,
  `encryption` enum('tls','ssl') DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `from_email` varchar(255) NOT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `linkable_type` varchar(255) DEFAULT NULL,
  `linkable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `clicks` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `record_id` bigint(20) UNSIGNED DEFAULT NULL,
  `record_type` varchar(255) DEFAULT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_values`)),
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_values`)),
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'info',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `uuid`, `name`, `slug`, `meta_title`, `meta_description`, `is_active`, `display_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '14dc3c5b-ee21-11f0-a0af-1860247b6ae0', 'Technology', 'technology', 'Latest Technology Trends', 'Read the latest blogs and updates on modern technology trends.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(2, '14dc6592-ee21-11f0-a0af-1860247b6ae0', 'Web Development', 'web-development', 'Web Development Blogs', 'Insights and tutorials on web development technologies.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(3, '14dc677d-ee21-11f0-a0af-1860247b6ae0', 'Mobile App Development', 'mobile-app-development', 'Mobile App Development Articles', 'Articles on Android and iOS mobile app development.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(4, '14dc67f0-ee21-11f0-a0af-1860247b6ae0', 'Software Development', 'software-development', 'Software Development Insights', 'Best practices and trends in software development.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(5, '14dc688e-ee21-11f0-a0af-1860247b6ae0', 'Frontend Development', 'frontend-development', 'Frontend Development Guides', 'Learn about frontend frameworks and UI development.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(6, '14dc6901-ee21-11f0-a0af-1860247b6ae0', 'Backend Development', 'backend-development', 'Backend Development Tutorials', 'Server-side development tips and technologies.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(7, '14dc6968-ee21-11f0-a0af-1860247b6ae0', 'Full Stack Development', 'full-stack-development', 'Full Stack Development Blogs', 'Articles covering frontend and backend development.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(8, '14dc8706-ee21-11f0-a0af-1860247b6ae0', 'Laravel', 'laravel', 'Laravel Framework Blogs', 'Laravel tips, tutorials, and best practices.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(9, '14dc8808-ee21-11f0-a0af-1860247b6ae0', 'ReactJS', 'reactjs', 'ReactJS Development Blogs', 'Guides and updates on ReactJS development.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(10, '14dc8878-ee21-11f0-a0af-1860247b6ae0', 'Node.js', 'nodejs', 'Node.js Backend Development', 'Learn about Node.js and scalable backend systems.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(11, '14dc88da-ee21-11f0-a0af-1860247b6ae0', 'PHP', 'php', 'PHP Development Articles', 'PHP programming tutorials and backend development guides.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(12, '14dc8946-ee21-11f0-a0af-1860247b6ae0', 'JavaScript', 'javascript', 'JavaScript Programming Blogs', 'Modern JavaScript concepts and frameworks.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(13, '14dc89b3-ee21-11f0-a0af-1860247b6ae0', 'Python', 'python', 'Python Programming Blogs', 'Python tutorials for web, AI, and automation.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(14, '14dc8a1e-ee21-11f0-a0af-1860247b6ae0', 'Artificial Intelligence', 'artificial-intelligence', 'Artificial Intelligence Blogs', 'AI trends, machine learning, and automation insights.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(15, '14dc8add-ee21-11f0-a0af-1860247b6ae0', 'Machine Learning', 'machine-learning', 'Machine Learning Articles', 'ML concepts, models, and real-world applications.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(16, '14dc8b46-ee21-11f0-a0af-1860247b6ae0', 'Data Science', 'data-science', 'Data Science Blogs', 'Data analysis, visualization, and analytics guides.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(17, '14dc8bb2-ee21-11f0-a0af-1860247b6ae0', 'Cloud Computing', 'cloud-computing', 'Cloud Computing Services', 'Cloud platforms, deployment, and scalability insights.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(18, '14dc8c23-ee21-11f0-a0af-1860247b6ae0', 'AWS', 'aws', 'AWS Cloud Blogs', 'Amazon Web Services cloud solutions and tutorials.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(19, '14dc8c9d-ee21-11f0-a0af-1860247b6ae0', 'DevOps', 'devops', 'DevOps Best Practices', 'CI/CD, automation, and DevOps culture blogs.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(20, '14dc8d0e-ee21-11f0-a0af-1860247b6ae0', 'Docker', 'docker', 'Docker Containerization', 'Docker tutorials and container deployment guides.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(21, '14dc8db7-ee21-11f0-a0af-1860247b6ae0', 'Kubernetes', 'kubernetes', 'Kubernetes Orchestration', 'Kubernetes container orchestration blogs.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(22, '14dc8e29-ee21-11f0-a0af-1860247b6ae0', 'Cyber Security', 'cyber-security', 'Cyber Security Awareness', 'Cyber security trends and data protection tips.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(23, '14dc8e94-ee21-11f0-a0af-1860247b6ae0', 'Blockchain', 'blockchain', 'Blockchain Technology Blogs', 'Blockchain, crypto, and Web3 insights.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(24, '14dc8ef6-ee21-11f0-a0af-1860247b6ae0', 'Healthcare Technology', 'healthcare-technology', 'Healthcare Technology Blogs', 'Health tech innovations and digital healthcare.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(25, '14dc8f66-ee21-11f0-a0af-1860247b6ae0', 'Digital Transformation', 'digital-transformation', 'Digital Transformation Strategies', 'How businesses adopt digital technologies.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(26, '14dc8fe4-ee21-11f0-a0af-1860247b6ae0', 'Startup', 'startup', 'Startup Growth Blogs', 'Startup ideas, growth strategies, and funding.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(27, '14dc9051-ee21-11f0-a0af-1860247b6ae0', 'SaaS', 'saas', 'SaaS Business Blogs', 'Software as a Service trends and insights.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(28, '14dc90bf-ee21-11f0-a0af-1860247b6ae0', 'UI UX Design', 'ui-ux-design', 'UI UX Design Tips', 'User interface and user experience design blogs.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(29, '14dc9130-ee21-11f0-a0af-1860247b6ae0', 'SEO', 'seo', 'SEO Optimization Blogs', 'Search engine optimization strategies and tips.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(30, '14dc91cc-ee21-11f0-a0af-1860247b6ae0', 'Digital Marketing', 'digital-marketing', 'Digital Marketing Blogs', 'Online marketing, growth, and branding strategies.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(31, '14dc9240-ee21-11f0-a0af-1860247b6ae0', 'Content Marketing', 'content-marketing', 'Content Marketing Strategies', 'Content creation and marketing insights.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(32, '14dc92a6-ee21-11f0-a0af-1860247b6ae0', 'Ecommerce', 'ecommerce', 'Ecommerce Business Blogs', 'Online store development and ecommerce growth.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(33, '14dc9318-ee21-11f0-a0af-1860247b6ae0', 'Payment Gateway', 'payment-gateway', 'Online Payment Gateways', 'Payment integration and fintech solutions.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(34, '14dc93ba-ee21-11f0-a0af-1860247b6ae0', 'API Development', 'api-development', 'API Development Blogs', 'REST and GraphQL API development tutorials.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(35, '14dc9469-ee21-11f0-a0af-1860247b6ae0', 'Microservices', 'microservices', 'Microservices Architecture', 'Scalable microservices design and development.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(36, '14dc94e1-ee21-11f0-a0af-1860247b6ae0', 'Performance Optimization', 'performance-optimization', 'Performance Optimization Tips', 'Improve application speed and performance.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(37, '14dc954c-ee21-11f0-a0af-1860247b6ae0', 'Testing', 'testing', 'Software Testing Blogs', 'Manual and automated software testing guides.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(38, '14dc95b2-ee21-11f0-a0af-1860247b6ae0', 'Automation', 'automation', 'Automation Tools & Techniques', 'Process automation and productivity blogs.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(39, '14dc9615-ee21-11f0-a0af-1860247b6ae0', 'Open Source', 'open-source', 'Open Source Software', 'Open source tools and community-driven projects.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(40, '14dc9680-ee21-11f0-a0af-1860247b6ae0', 'Tech News', 'tech-news', 'Latest Tech News', 'Trending news from the technology world.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(41, '14dc96ee-ee21-11f0-a0af-1860247b6ae0', 'Business Technology', 'business-technology', 'Business Technology Solutions', 'Technology solutions for modern businesses.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(42, '14dc9757-ee21-11f0-a0af-1860247b6ae0', 'IT Services', 'it-services', 'IT Services Blogs', 'Managed IT services and support solutions.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(43, '14dc980a-ee21-11f0-a0af-1860247b6ae0', 'Cloud Security', 'cloud-security', 'Cloud Security Blogs', 'Secure cloud infrastructure and compliance.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(44, '14dc987e-ee21-11f0-a0af-1860247b6ae0', 'Big Data', 'big-data', 'Big Data Analytics', 'Big data processing and analytics insights.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(45, '14dc98ef-ee21-11f0-a0af-1860247b6ae0', 'Remote Work', 'remote-work', 'Remote Work Technology', 'Tools and tips for remote working teams.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(46, '14dc9955-ee21-11f0-a0af-1860247b6ae0', 'Healthcare Software', 'healthcare-software', 'Healthcare Software Solutions', 'Software solutions for healthcare industry.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(47, '14dc99bd-ee21-11f0-a0af-1860247b6ae0', 'Telemedicine', 'telemedicine', 'Telemedicine Technology', 'Virtual healthcare and telemedicine solutions.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(48, '14dc9a28-ee21-11f0-a0af-1860247b6ae0', 'AI in Healthcare', 'ai-in-healthcare', 'AI in Healthcare Blogs', 'Artificial intelligence applications in healthcare.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(49, '14dc9a89-ee21-11f0-a0af-1860247b6ae0', 'Startup Technology', 'startup-technology', 'Startup Technology Stack', 'Technology stack recommendations for startups.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL),
(50, '14dc9af6-ee21-11f0-a0af-1860247b6ae0', 'Future Technology', 'future-technology', 'Future Technology Trends', 'Emerging technologies shaping the future.', 1, 0, '2026-01-10 12:37:09', '2026-01-10 12:37:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `technologies`
--

CREATE TABLE `technologies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `technology_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technologies`
--

INSERT INTO `technologies` (`id`, `uuid`, `name`, `slug`, `icon`, `image`, `image_alt`, `technology_category_id`, `description`, `website_url`, `version`, `meta_title`, `meta_description`, `is_active`, `is_featured`, `display_order`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'd84fa94a-8842-4b54-a281-ad1fc77b927b', 'HTML5', 'html5', 'fab fa-html5', NULL, NULL, 1, 'The structural foundation of every website we build, semantic and accessible by default.', 'https://developer.mozilla.org/en-US/docs/Web/HTML', NULL, NULL, NULL, 1, 0, 1, 0, '2026-07-21 05:15:08', '2026-07-21 05:15:08', NULL),
(2, '58866a4c-e02b-47eb-a937-07823ed2b4ea', 'CSS3', 'css3', 'fab fa-css3-alt', NULL, NULL, 1, 'Used for clean, responsive styling across every screen size we design for.', 'https://developer.mozilla.org/en-US/docs/Web/CSS', NULL, NULL, NULL, 1, 0, 2, 0, '2026-07-21 05:15:08', '2026-07-21 05:15:08', NULL),
(3, '06bb2ccd-10e5-41b8-a5ff-6d80d10f6489', 'JavaScript', 'javascript', 'fab fa-js', NULL, NULL, 1, 'Powers the interactive, dynamic behavior behind modern web experiences.', 'https://developer.mozilla.org/en-US/docs/Web/JavaScript', NULL, NULL, NULL, 1, 0, 3, 0, '2026-07-21 05:15:08', '2026-07-21 05:15:08', NULL),
(4, 'e3a3e6d0-1ca4-400b-8500-cb756503598c', 'React', 'react', 'fab fa-react', NULL, NULL, 1, 'Our go-to library for building fast, component-based user interfaces.', 'https://react.dev', NULL, NULL, NULL, 1, 1, 4, 0, '2026-07-21 05:15:08', '2026-07-21 05:15:08', NULL),
(5, 'ba362b39-3bec-4584-adb8-9d047801a273', 'Vue.js', 'vuejs', 'fab fa-vuejs', NULL, NULL, 1, 'A flexible, approachable framework we use for interactive front-end builds.', 'https://vuejs.org', NULL, NULL, NULL, 1, 0, 5, 0, '2026-07-21 05:15:08', '2026-07-21 05:15:08', NULL),
(6, 'c50d6ac1-0c76-44b9-87d6-15af94c4d7ba', 'Next.js', 'nextjs', 'fas fa-code', NULL, NULL, 1, 'Used when a project needs server-side rendering and strong SEO performance out of the box.', 'https://nextjs.org', NULL, NULL, NULL, 1, 0, 6, 0, '2026-07-21 05:15:08', '2026-07-21 05:15:08', NULL),
(7, '73ad6061-21ae-4e9c-925f-86b3c14e5f93', 'Tailwind CSS', 'tailwind-css', 'fas fa-wind', NULL, NULL, 1, 'Our utility-first styling framework for building consistent, maintainable design systems fast.', 'https://tailwindcss.com', NULL, NULL, NULL, 1, 0, 7, 0, '2026-07-21 05:15:08', '2026-07-21 05:15:08', NULL),
(8, 'b6394194-1784-4895-b613-9885f400447e', 'PHP', 'php', 'fab fa-php', NULL, NULL, 2, 'A reliable, mature language we use for building robust server-side applications.', 'https://www.php.net', NULL, NULL, NULL, 1, 0, 1, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(9, '50828df5-eed8-47a3-a75b-073c43cfaf9f', 'Laravel', 'laravel', 'fab fa-laravel', NULL, NULL, 2, 'Our primary framework for building secure, scalable custom software and web applications.', 'https://laravel.com', NULL, NULL, NULL, 1, 1, 2, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(10, '5fb794a6-dbab-4bd5-a511-e8e10c3a972b', 'Node.js', 'nodejs', 'fab fa-node-js', NULL, NULL, 2, 'Used for real-time features and JavaScript-based backend services that need to scale efficiently.', 'https://nodejs.org', NULL, NULL, NULL, 1, 0, 3, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(11, '8ec4cb88-e846-404c-9220-96e5738d5d39', 'Python', 'python', 'fab fa-python', NULL, NULL, 2, 'Applied for backend systems, automation, and data-driven application logic.', 'https://www.python.org', NULL, NULL, NULL, 1, 0, 4, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(12, '06cfe5fe-4696-4bb5-924b-f5fcfb97fee3', 'MySQL', 'mysql', 'fas fa-database', NULL, NULL, 3, 'A dependable relational database used across the majority of our web and software projects.', 'https://www.mysql.com', NULL, NULL, NULL, 1, 0, 1, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(13, '916b37e2-703f-4730-9c10-af5f88fdf7fd', 'PostgreSQL', 'postgresql', 'fas fa-database', NULL, NULL, 3, 'Chosen for projects that need advanced querying and strong data integrity at scale.', 'https://www.postgresql.org', NULL, NULL, NULL, 1, 0, 2, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(14, 'a1a7d7c9-b043-4bfe-aa38-45b1806a718c', 'AWS', 'aws', 'fab fa-aws', NULL, NULL, 4, 'Our primary cloud platform for scalable, production-grade infrastructure.', 'https://aws.amazon.com', NULL, NULL, NULL, 1, 1, 1, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(15, '0a70e7fa-46df-401f-8334-dc19a6887539', 'Azure', 'azure', 'fab fa-microsoft', NULL, NULL, 4, 'Used for cloud infrastructure on projects already inside the Microsoft ecosystem.', 'https://azure.microsoft.com', NULL, NULL, NULL, 1, 0, 2, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(16, '15f4a922-c640-4de8-a4c2-49ee297dfee1', 'Docker', 'docker', 'fab fa-docker', NULL, NULL, 4, 'Containerizes applications so they run identically across every environment.', 'https://www.docker.com', NULL, NULL, NULL, 1, 0, 3, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(17, 'a5495402-b06a-4b1f-b8a3-f9f4e34c00fc', 'Kubernetes', 'kubernetes', 'fas fa-dharmachakra', NULL, NULL, 4, 'Orchestrates containerized applications for projects that need reliable scaling.', 'https://kubernetes.io', NULL, NULL, NULL, 1, 0, 4, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(18, '5a3876d2-0b01-4732-ba3a-7071db4f0bae', 'Jenkins', 'jenkins', 'fab fa-jenkins', NULL, NULL, 4, 'Automates our build, test, and deployment pipelines.', 'https://www.jenkins.io', NULL, NULL, NULL, 1, 0, 5, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(19, 'c597cf45-78e9-4637-aa51-a8e7cd84eb50', 'GitHub Actions', 'github-actions', 'fab fa-github', NULL, NULL, 4, 'Our CI/CD tool of choice for automating testing and deployment directly from the codebase.', 'https://github.com/features/actions', NULL, NULL, NULL, 1, 0, 6, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(20, '62b0540a-db2c-446d-9aea-3b4a9ff68779', 'Terraform', 'terraform', 'fas fa-layer-group', NULL, NULL, 4, 'Used to manage cloud infrastructure as version-controlled code.', 'https://www.terraform.io', NULL, NULL, NULL, 1, 0, 7, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(21, 'f4cbf7e5-dbbf-4a37-8748-92abb4802faf', 'Nginx', 'nginx', 'fas fa-server', NULL, NULL, 4, 'A high-performance web server used to handle production traffic reliably.', 'https://nginx.org', NULL, NULL, NULL, 1, 0, 8, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(22, '65ce19d8-7a78-4502-8c0f-6e42298e0ecb', 'Cloudflare', 'cloudflare', 'fas fa-shield-alt', NULL, NULL, 4, 'Provides CDN, security, and performance layers in front of hosted applications.', 'https://www.cloudflare.com', NULL, NULL, NULL, 1, 0, 9, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(23, 'b8bea2b0-a0dc-435b-ab89-f6323a52004e', 'WordPress', 'wordpress', 'fab fa-wordpress', NULL, NULL, 5, 'Our most-used CMS for content-driven business websites, customized well beyond default themes.', 'https://wordpress.org', NULL, NULL, NULL, 1, 1, 1, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(24, 'e674fef8-a60d-4797-8dd3-65074176b09c', 'Shopify', 'shopify', 'fab fa-shopify', NULL, NULL, 5, 'A platform we build and customize for fast-launching, scalable online stores.', 'https://www.shopify.com', NULL, NULL, NULL, 1, 0, 2, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(25, '5fb2e58e-9a0f-48b7-b1bd-1755c46b0b30', 'WooCommerce', 'woocommerce', 'fas fa-shopping-bag', NULL, NULL, 5, 'Extends WordPress into a full eCommerce store for businesses already on that platform.', 'https://woocommerce.com', NULL, NULL, NULL, 1, 0, 3, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(26, 'f4418aa8-6477-472f-9bc6-46c6c31030dd', 'Magento', 'magento', 'fas fa-store', NULL, NULL, 5, 'Used for complex, high-catalog eCommerce builds that need deep customization.', 'https://business.adobe.com/products/magento/magento-commerce.html', NULL, NULL, NULL, 1, 0, 4, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(27, 'd8941395-4746-4dda-82b0-64f925cf6630', 'REST API', 'rest-api', 'fas fa-plug', NULL, NULL, 6, 'Our standard architecture for building clean, predictable, well-documented APIs.', NULL, NULL, NULL, NULL, 1, 0, 1, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(28, 'ea7b7c32-0309-464a-a30e-ba8ecdeda51d', 'GraphQL', 'graphql', 'fas fa-project-diagram', NULL, NULL, 6, 'Used when applications need flexible, efficient data queries across complex systems.', 'https://graphql.org', NULL, NULL, NULL, 1, 0, 2, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(29, '2738097e-1dc3-4ddf-b861-0ea3d3b49193', 'Postman', 'postman', 'fas fa-paper-plane', NULL, NULL, 6, 'Our tool for testing and documenting APIs during development.', 'https://www.postman.com', NULL, NULL, NULL, 1, 0, 3, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(30, '84ba5d26-9892-404c-86d1-0f619633e6d7', 'Stripe', 'stripe', 'fab fa-stripe', NULL, NULL, 6, 'A secure payment gateway we integrate for reliable online transactions.', 'https://stripe.com', NULL, NULL, NULL, 1, 0, 4, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(31, 'b8cf7e51-717f-406e-9b51-70b22fe462fb', 'PayPal', 'paypal', 'fab fa-paypal', NULL, NULL, 6, 'A widely trusted payment method we integrate into eCommerce and SaaS checkouts.', 'https://www.paypal.com', NULL, NULL, NULL, 1, 0, 5, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(32, '69995194-ba58-45ed-a291-9a3e7c1eb426', 'Razorpay', 'razorpay', 'fas fa-credit-card', NULL, NULL, 6, 'Our preferred regional payment gateway integration for Indian businesses.', 'https://razorpay.com', NULL, NULL, NULL, 1, 0, 6, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(33, '9e88c368-0e14-4421-bcd5-ba7d7cb22fed', 'Selenium', 'selenium', 'fas fa-vial', NULL, NULL, 7, 'Automates browser testing across our clients\' web applications.', 'https://www.selenium.dev', NULL, NULL, NULL, 1, 0, 1, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(34, '78950bad-41c8-4fc1-802f-a248274a6ff7', 'Playwright', 'playwright', 'fas fa-play', NULL, NULL, 7, 'A modern automation tool we use for reliable cross-browser testing.', 'https://playwright.dev', NULL, NULL, NULL, 1, 0, 2, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(35, 'ed081725-6b70-4884-b311-e68cabb9c212', 'Cypress', 'cypress', 'fas fa-check-double', NULL, NULL, 7, 'Used for fast, developer-friendly end-to-end testing.', 'https://www.cypress.io', NULL, NULL, NULL, 1, 0, 3, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(36, 'f7c563f1-4435-492f-80a0-079b2a3f7dba', 'Appium', 'appium', 'fas fa-mobile-alt', NULL, NULL, 7, 'Automates testing across Android and iOS mobile applications.', 'https://appium.io', NULL, NULL, NULL, 1, 0, 4, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(37, '433e186f-bc5d-4635-967e-fa28144fa3d8', 'JMeter', 'jmeter', 'fas fa-tachometer-alt', NULL, NULL, 7, 'Simulates real-world load and performance testing before major releases.', 'https://jmeter.apache.org', NULL, NULL, NULL, 1, 0, 5, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(38, 'da5e8d06-9aed-4889-a286-640e1d45f2c0', 'Jira', 'jira', 'fab fa-jira', NULL, NULL, 7, 'Tracks defects, test cases, and QA workflow across every project.', 'https://www.atlassian.com/software/jira', NULL, NULL, NULL, 1, 0, 6, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(39, 'c5a99d9c-66cb-468f-8426-1b126f6db11b', 'Figma', 'figma', 'fab fa-figma', NULL, NULL, 8, 'Our primary tool for UI/UX design, prototyping, and design collaboration.', 'https://www.figma.com', NULL, NULL, NULL, 1, 1, 1, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(40, '3c1f21b1-00d4-47b6-b277-71843e93d01d', 'Adobe Illustrator', 'adobe-illustrator', 'fab fa-adobe', NULL, NULL, 8, 'Used for logo design, brand assets, and scalable vector graphics.', 'https://www.adobe.com/products/illustrator.html', NULL, NULL, NULL, 1, 0, 2, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(41, 'a722bfc1-c8dc-454c-b851-4bc6f6148fb5', 'Adobe Photoshop', 'adobe-photoshop', 'fab fa-adobe', NULL, NULL, 8, 'Applied for photo editing, marketing creatives, and detailed visual design work.', 'https://www.adobe.com/products/photoshop.html', NULL, NULL, NULL, 1, 0, 3, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(42, 'e5ba7cdd-5412-49cc-93a4-a48c762a01d2', 'Canva', 'canva', 'fas fa-paint-brush', NULL, NULL, 8, 'Used for fast turnaround on social media creatives and lightweight marketing materials.', 'https://www.canva.com', NULL, NULL, NULL, 1, 0, 4, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(43, '2a7fe09b-931f-4539-8d3e-a49f381d67ca', 'Google Analytics', 'google-analytics', 'fab fa-google', NULL, NULL, 9, 'Tracks visitor behavior and campaign performance across every client website.', 'https://analytics.google.com', NULL, NULL, NULL, 1, 0, 1, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(44, '5394ef0d-2c9f-4fe9-a742-48d839b2c8db', 'Google Search Console', 'google-search-console', 'fab fa-google', NULL, NULL, 9, 'Monitors search performance, indexing, and technical SEO health.', 'https://search.google.com/search-console', NULL, NULL, NULL, 1, 0, 2, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(45, 'f87c8764-2bea-4a6a-a77f-4ae1cd7b4a13', 'Google Ads', 'google-ads', 'fab fa-google', NULL, NULL, 9, 'Manages paid search campaigns built around real buyer intent.', 'https://ads.google.com', NULL, NULL, NULL, 1, 0, 3, 0, '2026-07-21 05:15:11', '2026-07-21 05:15:11', NULL),
(46, '6af248ca-c7d5-4b1f-a749-836da5ff75e1', 'Meta Ads Manager', 'meta-ads-manager', 'fab fa-meta', NULL, NULL, 9, 'Runs and optimizes Facebook and Instagram advertising campaigns.', 'https://www.facebook.com/business/tools/ads-manager', NULL, NULL, NULL, 1, 0, 4, 0, '2026-07-21 05:15:11', '2026-07-21 05:15:11', NULL),
(47, '6231db9d-cb06-4bb1-8ff7-bd41cf576715', 'Ahrefs', 'ahrefs', 'fas fa-chart-bar', NULL, NULL, 9, 'Used for keyword research, backlink analysis, and competitor SEO audits.', 'https://ahrefs.com', NULL, NULL, NULL, 1, 0, 5, 0, '2026-07-21 05:15:11', '2026-07-21 05:15:11', NULL),
(48, 'ae7f11b6-9a77-43e3-aa93-bb4db9c144bc', 'SEMrush', 'semrush', 'fas fa-chart-line', NULL, NULL, 9, 'Supports technical SEO audits and ongoing organic performance tracking.', 'https://www.semrush.com', NULL, NULL, NULL, 1, 0, 6, 0, '2026-07-21 05:15:11', '2026-07-21 05:15:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `technology_categories`
--

CREATE TABLE `technology_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technology_categories`
--

INSERT INTO `technology_categories` (`id`, `uuid`, `name`, `slug`, `icon`, `image`, `image_alt`, `description`, `meta_title`, `meta_description`, `is_active`, `is_featured`, `display_order`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '5649eb0f-542a-4663-8c2f-c1a9d7a8e0d6', 'Frontend Development', 'frontend-development', 'fas fa-desktop', NULL, NULL, 'The technologies we use to build fast, responsive interfaces that users actually interact with.', NULL, NULL, 1, 1, 1, 0, '2026-07-21 05:15:08', '2026-07-21 05:15:08', NULL),
(2, 'c79294c5-29ec-43fe-92e2-5346ccffecdc', 'Backend Development', 'backend-development', 'fas fa-server', NULL, NULL, 'The server-side languages and frameworks powering the business logic behind every application we build.', NULL, NULL, 1, 1, 2, 0, '2026-07-21 05:15:08', '2026-07-21 05:15:08', NULL),
(3, '18596cd9-5ec9-4c04-a338-f4b36f672f22', 'Database', 'database', 'fas fa-database', NULL, NULL, 'The systems we rely on to store, structure, and protect business-critical data.', NULL, NULL, 1, 0, 3, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(4, '59e596f3-24dd-4b79-90d6-01b4c7b1b667', 'Cloud & DevOps', 'cloud-devops', 'fas fa-cloud', NULL, NULL, 'The infrastructure and deployment tooling behind reliable, scalable hosting environments.', NULL, NULL, 1, 1, 4, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(5, '505c14ea-3ba4-4193-838d-fee9dc5f63a3', 'CMS & eCommerce', 'cms-ecommerce', 'fas fa-shopping-cart', NULL, NULL, 'The platforms we build and customize for content management and online stores.', NULL, NULL, 1, 1, 5, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(6, '35726a1f-041a-4aa2-a04c-baf1fae5c2a2', 'API & Integration', 'api-integration', 'fas fa-plug', NULL, NULL, 'The tools and standards we use to connect systems and move data between them reliably.', NULL, NULL, 1, 0, 6, 0, '2026-07-21 05:15:09', '2026-07-21 05:15:09', NULL),
(7, '11fd1d04-0344-48f8-a8a5-28345bcff967', 'Testing & QA Tools', 'testing-qa-tools', 'fas fa-vial', NULL, NULL, 'The tools our QA team uses to catch issues before your users ever do.', NULL, NULL, 1, 0, 7, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(8, '508cb2f4-07b7-404f-b6f2-e1d8e15bf780', 'Design Tools', 'design-tools', 'fas fa-pen-nib', NULL, NULL, 'The design software behind every interface, brand identity, and marketing asset we create.', NULL, NULL, 1, 0, 8, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL),
(9, 'd3574568-acea-4834-89fe-1da794ece496', 'SEO & Marketing Tools', 'seo-marketing-tools', 'fas fa-chart-line', NULL, NULL, 'The platforms we use to research, track, and improve organic and paid performance.', NULL, NULL, 1, 0, 9, 0, '2026-07-21 05:15:10', '2026-07-21 05:15:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `layouts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`layouts`)),
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`settings`)),
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `usage_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_forms`
--

CREATE TABLE `template_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `template_id` bigint(20) UNSIGNED NOT NULL,
  `form_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `position` varchar(255) DEFAULT NULL,
  `section_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_alt` varchar(255) DEFAULT NULL,
  `message` longtext NOT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `source_url` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `location` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `uuid`, `name`, `designation`, `company`, `photo`, `photo_alt`, `message`, `rating`, `video_url`, `source`, `source_url`, `is_featured`, `is_active`, `display_order`, `location`, `meta_title`, `meta_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '86683a95-c16e-4536-8337-bfea7062ff2c', 'Abhishek Kr', 'developer', 'Abhi Info', 'testimonials/{ 86683a95-c16e-4536-8337-bfea7062ff2c}/1780560356_7.jpg', NULL, 'afgassgd', 5, NULL, NULL, NULL, 0, 1, 0, 'home', NULL, NULL, '2026-06-04 02:27:37', '2026-06-04 02:35:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `avatar_alt` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `role_id`, `department_id`, `name`, `email`, `username`, `phone`, `avatar`, `avatar_alt`, `designation`, `bio`, `email_verified_at`, `password`, `is_active`, `last_login_at`, `last_login_ip`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'a1b2c3d4-e8dd-11f0-bdd3-1860247b6ae0', 1, 1, 'System Admin', 'abhiii2404@gmail.com', 'admin', '7301005510', 'abhi.png', NULL, 'Administrator', 'Default system administrator account', '2026-01-03 08:50:11', '$2y$12$MUPR3KFCBZQEJ9oChjBDQusxSATVgIUz6z44vl04WnY35M96kOv2q', 1, '2026-07-21 02:17:28', '127.0.0.1', 'gJXJgnqS9hOmf90JStLMra1KidoEaDCWrB0SC1wvstC9uNYJpFpH9c5un8Yx', '2026-01-03 08:50:11', '2026-07-21 02:17:28', NULL),
(2, '47d1d174-ee11-11f0-a0af-1860247b6ae0', 2, 1, 'Admin User', 'admin@example.com', ' admin', '9000000002', NULL, NULL, 'Administrator', 'Manages platform operations.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(3, '47d1e45a-ee11-11f0-a0af-1860247b6ae0', 3, 13, 'Project Manager', 'pm@example.com', 'projectmanager', '9000000003', NULL, NULL, 'Project Manager', 'Handles project execution.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(4, '47d1e603-ee11-11f0-a0af-1860247b6ae0', 4, 2, 'HR Manager', 'hr@example.com', 'hrmanager', '9000000004', NULL, NULL, 'HR Manager', 'Manages HR activities.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(5, '47d1e720-ee11-11f0-a0af-1860247b6ae0', 5, 8, 'Content Manager', 'content@example.com', 'contentmanager', '9000000005', NULL, NULL, 'Content Manager', 'Oversees content creation.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(6, '47d1e80a-ee11-11f0-a0af-1860247b6ae0', 6, 8, 'Editor User', 'editor@example.com', 'editor', '9000000006', NULL, NULL, 'Editor', 'Edits and reviews content.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(7, '47d1e8ef-ee11-11f0-a0af-1860247b6ae0', 7, 8, 'Author User', 'author@example.com', 'author', '9000000007', NULL, NULL, 'Author', 'Writes blog articles.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(8, '47d1e9cb-ee11-11f0-a0af-1860247b6ae0', 8, 12, 'SEO Manager', 'seo@example.com', 'seomanager', '9000000008', NULL, NULL, 'SEO Manager', 'Optimizes search visibility.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(9, '47d1eab2-ee11-11f0-a0af-1860247b6ae0', 9, 9, 'Marketing Manager', 'marketing@example.com', 'marketingmanager', '9000000009', NULL, NULL, 'Marketing Manager', 'Handles campaigns.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(10, '47d1eb88-ee11-11f0-a0af-1860247b6ae0', 10, 10, 'Sales Manager', 'sales@example.com', 'salesmanager', '9000000010', NULL, NULL, 'Sales Manager', 'Manages sales deals.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(11, '47d1ec63-ee11-11f0-a0af-1860247b6ae0', 11, 11, 'Support Executive', 'support@example.com', 'support', '9000000011', NULL, NULL, 'Support Executive', 'Customer support.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(12, '47d1ed46-ee11-11f0-a0af-1860247b6ae0', 12, 5, 'Developer User', 'dev@example.com', 'developer', '9000000012', NULL, NULL, 'Developer', 'Builds applications.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(13, '47d1ee19-ee11-11f0-a0af-1860247b6ae0', 13, 6, 'Designer User', 'designer@example.com', 'designer', '9000000013', NULL, NULL, 'Designer', 'Designs UI/UX.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(14, '47d1eeec-ee11-11f0-a0af-1860247b6ae0', 14, 7, 'QA Tester', 'qa@example.com', 'qatester', '9000000014', NULL, NULL, 'QA Tester', 'Tests system.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(15, '47d1efc8-ee11-11f0-a0af-1860247b6ae0', 15, 13, 'Viewer User', 'viewer@example.com', 'viewer', '9000000015', NULL, NULL, 'Viewer', 'Read-only access.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(16, '47d1f0ae-ee11-11f0-a0af-1860247b6ae0', 12, 15, 'R&D Developer', 'rnd@example.com', 'rnddev', '9000000016', NULL, NULL, 'R&D Engineer', 'Research & innovation.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(17, '47d1f198-ee11-11f0-a0af-1860247b6ae0', 10, 10, 'Sales Executive', 'salesexec@example.com', 'salesexec', '9000000017', NULL, NULL, 'Sales Executive', 'Closes deals.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(18, '47d1f27a-ee11-11f0-a0af-1860247b6ae0', 11, 11, 'Support Lead', 'supportlead@example.com', 'supportlead', '9000000018', NULL, NULL, 'Support Lead', 'Leads support team.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(19, '47d1f35a-ee11-11f0-a0af-1860247b6ae0', 9, 9, 'Marketing Executive', 'marketingexec@example.com', 'marketingexec', '9000000019', NULL, NULL, 'Marketing Executive', 'Runs campaigns.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL),
(20, '47d1f43e-ee11-11f0-a0af-1860247b6ae0', 3, 13, 'Assistant PM', 'assistantpm@example.com', 'assistantpm', '9000000020', NULL, NULL, 'Assistant Project Manager', 'Supports project planning.', '2026-01-10 10:44:03', '$2y$12$KIXQ8v0z0tK5jT6SxQZk4eKp9XkU6q5YpZ9O9m8PZKQp8Jw4Cq1uC', 1, NULL, NULL, NULL, '2026-01-10 10:44:03', '2026-01-10 10:44:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `is_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `expires_at` date DEFAULT NULL,
  `conditions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`conditions`)),
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `granted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `uuid`, `user_id`, `permission_id`, `is_allowed`, `expires_at`, `conditions`, `meta`, `granted_by`, `created_at`, `updated_at`) VALUES
(1, 'ae53a774-0589-4aa8-b740-af37b1daf714', 2, 1, 1, '2026-02-02', NULL, NULL, 2, '2026-02-02 07:13:25', '2026-02-02 07:13:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_module_index` (`user_id`,`module`),
  ADD KEY `activity_logs_subject_type_subject_id_index` (`subject_type`,`subject_id`),
  ADD KEY `activity_logs_action_index` (`action`),
  ADD KEY `activity_logs_level_index` (`level`);

--
-- Indexes for table `application_status_logs`
--
ALTER TABLE `application_status_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `application_status_logs_uuid_unique` (`uuid`),
  ADD KEY `application_status_logs_career_application_id_foreign` (`career_application_id`),
  ADD KEY `application_status_logs_changed_by_foreign` (`changed_by`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `authors_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `authors_slug_unique` (`slug`),
  ADD KEY `authors_user_id_foreign` (`user_id`),
  ADD KEY `authors_display_order_index` (`display_order`);

--
-- Indexes for table `auth_logs`
--
ALTER TABLE `auth_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `auth_logs_uuid_unique` (`uuid`),
  ADD KEY `auth_logs_user_id_event_index` (`user_id`,`event`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`),
  ADD KEY `blogs_category_id_foreign` (`category_id`),
  ADD KEY `blogs_author_id_foreign` (`author_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_categories_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `blog_categories_slug_unique` (`slug`),
  ADD KEY `blog_categories_display_order_index` (`display_order`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_tags_blog_id_tag_id_unique` (`blog_id`,`tag_id`),
  ADD UNIQUE KEY `blog_tags_uuid_unique` (`uuid`),
  ADD KEY `blog_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `careers_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `careers_slug_unique` (`slug`),
  ADD KEY `careers_department_id_foreign` (`department_id`),
  ADD KEY `careers_display_order_index` (`display_order`);

--
-- Indexes for table `career_applications`
--
ALTER TABLE `career_applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `career_applications_uuid_unique` (`uuid`),
  ADD KEY `career_applications_career_id_foreign` (`career_id`),
  ADD KEY `career_applications_department_id_foreign` (`department_id`),
  ADD KEY `career_applications_resume_id_foreign` (`resume_id`);

--
-- Indexes for table `case_studies`
--
ALTER TABLE `case_studies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `case_studies_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `case_studies_slug_unique` (`slug`),
  ADD KEY `case_studies_case_study_category_id_is_active_index` (`case_study_category_id`,`is_active`);

--
-- Indexes for table `case_study_categories`
--
ALTER TABLE `case_study_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `case_study_categories_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `case_study_categories_slug_unique` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `comments_uuid_unique` (`uuid`),
  ADD KEY `comments_blog_id_foreign` (`blog_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `crm_clients`
--
ALTER TABLE `crm_clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm_clients_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `crm_clients_client_code_unique` (`client_code`),
  ADD KEY `crm_clients_lead_id_foreign` (`lead_id`),
  ADD KEY `crm_clients_created_by_foreign` (`created_by`),
  ADD KEY `crm_clients_account_manager_id_foreign` (`account_manager_id`),
  ADD KEY `crm_clients_email_index` (`email`);

--
-- Indexes for table `crm_client_contacts`
--
ALTER TABLE `crm_client_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_client_contacts_client_id_foreign` (`client_id`),
  ADD KEY `crm_client_contacts_created_by_foreign` (`created_by`),
  ADD KEY `crm_client_contacts_email_index` (`email`),
  ADD KEY `crm_client_contacts_phone_index` (`phone`);

--
-- Indexes for table `crm_client_documents`
--
ALTER TABLE `crm_client_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_client_documents_client_id_foreign` (`client_id`),
  ADD KEY `crm_client_documents_project_id_foreign` (`project_id`),
  ADD KEY `crm_client_documents_parent_document_id_foreign` (`parent_document_id`),
  ADD KEY `crm_client_documents_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `crm_client_notes`
--
ALTER TABLE `crm_client_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_client_notes_client_id_foreign` (`client_id`),
  ADD KEY `crm_client_notes_user_id_foreign` (`user_id`);

--
-- Indexes for table `crm_deals`
--
ALTER TABLE `crm_deals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm_deals_deal_code_unique` (`deal_code`),
  ADD KEY `crm_deals_lead_id_foreign` (`lead_id`),
  ADD KEY `crm_deals_client_id_foreign` (`client_id`),
  ADD KEY `crm_deals_assigned_to_foreign` (`assigned_to`),
  ADD KEY `crm_deals_created_by_foreign` (`created_by`);

--
-- Indexes for table `crm_expenses`
--
ALTER TABLE `crm_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_expenses_category_id_foreign` (`category_id`),
  ADD KEY `crm_expenses_project_id_foreign` (`project_id`),
  ADD KEY `crm_expenses_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `crm_expenses_paid_by_foreign` (`paid_by`),
  ADD KEY `crm_expenses_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `crm_expense_categories`
--
ALTER TABLE `crm_expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm_expense_categories_slug_unique` (`slug`),
  ADD KEY `crm_expense_categories_parent_id_foreign` (`parent_id`),
  ADD KEY `crm_expense_categories_created_by_foreign` (`created_by`);

--
-- Indexes for table `crm_invoices`
--
ALTER TABLE `crm_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm_invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `crm_invoices_client_id_foreign` (`client_id`),
  ADD KEY `crm_invoices_project_id_foreign` (`project_id`),
  ADD KEY `crm_invoices_created_by_foreign` (`created_by`),
  ADD KEY `crm_invoices_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `crm_invoice_items`
--
ALTER TABLE `crm_invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_invoice_items_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `crm_leads`
--
ALTER TABLE `crm_leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_leads_status_id_foreign` (`status_id`),
  ADD KEY `crm_leads_source_id_foreign` (`source_id`),
  ADD KEY `crm_leads_assigned_to_foreign` (`assigned_to`),
  ADD KEY `crm_leads_created_by_foreign` (`created_by`),
  ADD KEY `crm_leads_email_index` (`email`),
  ADD KEY `crm_leads_phone_index` (`phone`);

--
-- Indexes for table `crm_lead_activities`
--
ALTER TABLE `crm_lead_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_lead_activities_lead_id_foreign` (`lead_id`),
  ADD KEY `crm_lead_activities_user_id_foreign` (`user_id`);

--
-- Indexes for table `crm_lead_sources`
--
ALTER TABLE `crm_lead_sources`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm_lead_sources_slug_unique` (`slug`),
  ADD KEY `crm_lead_sources_created_by_foreign` (`created_by`);

--
-- Indexes for table `crm_lead_statuses`
--
ALTER TABLE `crm_lead_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm_lead_statuses_slug_unique` (`slug`),
  ADD KEY `crm_lead_statuses_created_by_foreign` (`created_by`);

--
-- Indexes for table `crm_payments`
--
ALTER TABLE `crm_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `crm_payments_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `crm_payments_received_by_foreign` (`received_by`);

--
-- Indexes for table `crm_payment_methods`
--
ALTER TABLE `crm_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm_payment_methods_slug_unique` (`slug`),
  ADD KEY `crm_payment_methods_created_by_foreign` (`created_by`);

--
-- Indexes for table `crm_projects`
--
ALTER TABLE `crm_projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm_projects_project_code_unique` (`project_code`),
  ADD KEY `crm_projects_client_id_foreign` (`client_id`),
  ADD KEY `crm_projects_manager_id_foreign` (`manager_id`),
  ADD KEY `crm_projects_created_by_foreign` (`created_by`),
  ADD KEY `crm_projects_updated_by_foreign` (`updated_by`),
  ADD KEY `crm_projects_slug_index` (`slug`);

--
-- Indexes for table `crm_project_members`
--
ALTER TABLE `crm_project_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm_project_members_project_id_user_id_unique` (`project_id`,`user_id`),
  ADD KEY `crm_project_members_user_id_foreign` (`user_id`),
  ADD KEY `crm_project_members_added_by_foreign` (`added_by`);

--
-- Indexes for table `crm_project_milestones`
--
ALTER TABLE `crm_project_milestones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_project_milestones_project_id_foreign` (`project_id`),
  ADD KEY `crm_project_milestones_created_by_foreign` (`created_by`);

--
-- Indexes for table `crm_project_tasks`
--
ALTER TABLE `crm_project_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_project_tasks_project_id_foreign` (`project_id`),
  ADD KEY `crm_project_tasks_milestone_id_foreign` (`milestone_id`),
  ADD KEY `crm_project_tasks_assigned_to_foreign` (`assigned_to`),
  ADD KEY `crm_project_tasks_created_by_foreign` (`created_by`);

--
-- Indexes for table `crm_task_comments`
--
ALTER TABLE `crm_task_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_task_comments_task_id_foreign` (`task_id`),
  ADD KEY `crm_task_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `departments_slug_unique` (`slug`),
  ADD KEY `departments_display_order_index` (`display_order`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emails_uuid_unique` (`uuid`),
  ADD KEY `emails_user_id_foreign` (`user_id`),
  ADD KEY `emails_enquiry_id_foreign` (`enquiry_id`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_logs_uuid_unique` (`uuid`),
  ADD KEY `email_logs_template_id_foreign` (`template_id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_templates_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `email_templates_slug_unique` (`slug`),
  ADD KEY `email_templates_display_order_index` (`display_order`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enquiries_uuid_unique` (`uuid`),
  ADD KEY `enquiries_assigned_to_foreign` (`assigned_to`);

--
-- Indexes for table `enquiries_status_logs`
--
ALTER TABLE `enquiries_status_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enquiries_status_logs_uuid_unique` (`uuid`),
  ADD KEY `enquiries_status_logs_changed_by_foreign` (`changed_by`),
  ADD KEY `enquiries_status_logs_enquiry_id_index` (`enquiry_id`),
  ADD KEY `enquiries_status_logs_new_status_index` (`new_status`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faq_categories_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `faq_categories_slug_unique` (`slug`),
  ADD KEY `faq_categories_display_order_index` (`display_order`);

--
-- Indexes for table `faq_items`
--
ALTER TABLE `faq_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faq_items_faq_category_id_is_active_index` (`faq_category_id`,`is_active`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `forms_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `forms_slug_unique` (`slug`),
  ADD KEY `forms_slug_is_active_index` (`slug`,`is_active`);

--
-- Indexes for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_fields_uuid_unique` (`uuid`),
  ADD KEY `form_fields_form_id_is_active_index` (`form_id`,`is_active`),
  ADD KEY `form_fields_sort_order_index` (`sort_order`);

--
-- Indexes for table `google_reviews`
--
ALTER TABLE `google_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `google_reviews_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `google_reviews_google_review_id_unique` (`google_review_id`);

--
-- Indexes for table `industries`
--
ALTER TABLE `industries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `industries_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `industries_slug_unique` (`slug`),
  ADD KEY `industries_category_id_index` (`category_id`);

--
-- Indexes for table `industry_categories`
--
ALTER TABLE `industry_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `industry_categories_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `industry_categories_slug_unique` (`slug`),
  ADD KEY `industry_categories_display_order_index` (`display_order`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_uploaded_by_foreign` (`uploaded_by`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_collection_index` (`collection`),
  ADD KEY `media_mime_type_index` (`mime_type`);

--
-- Indexes for table `media_relations`
--
ALTER TABLE `media_relations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_relation_unique` (`media_id`,`model_type`,`model_id`),
  ADD KEY `media_relations_linked_by_foreign` (`linked_by`),
  ADD KEY `media_relations_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_relations_collection_index` (`collection`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletter_subscribers_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `newsletter_subscribers_email_unique` (`email`),
  ADD KEY `newsletter_subscribers_is_active_is_confirmed_index` (`is_active`,`is_confirmed`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notification_logs_uuid_unique` (`uuid`),
  ADD KEY `notification_logs_user_id_is_read_index` (`user_id`,`is_read`),
  ADD KEY `notification_logs_type_channel_index` (`type`,`channel`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_created_by_foreign` (`created_by`),
  ADD KEY `pages_updated_by_foreign` (`updated_by`),
  ADD KEY `pages_slug_is_active_index` (`slug`,`is_active`),
  ADD KEY `pages_template_id_index` (`template_id`);

--
-- Indexes for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_contents_uuid_unique` (`uuid`),
  ADD KEY `page_contents_form_id_foreign` (`form_id`),
  ADD KEY `page_contents_created_by_foreign` (`created_by`),
  ADD KEY `page_contents_updated_by_foreign` (`updated_by`),
  ADD KEY `page_contents_page_id_form_id_index` (`page_id`,`form_id`),
  ADD KEY `page_contents_is_active_is_visible_index` (`is_active`,`is_visible`),
  ADD KEY `page_contents_display_order_index` (`display_order`);

--
-- Indexes for table `page_sections`
--
ALTER TABLE `page_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `page_sections_page_id_foreign` (`page_id`),
  ADD KEY `page_sections_form_id_foreign` (`form_id`),
  ADD KEY `page_sections_display_order_index` (`display_order`);

--
-- Indexes for table `page_section_contents`
--
ALTER TABLE `page_section_contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_section_contents_page_id_section_id_unique` (`page_id`,`section_id`),
  ADD UNIQUE KEY `page_section_contents_uuid_unique` (`uuid`),
  ADD KEY `page_section_contents_section_id_foreign` (`section_id`);

--
-- Indexes for table `page_section_links`
--
ALTER TABLE `page_section_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_section_links_page_id_section_id_unique` (`page_id`,`section_id`),
  ADD KEY `page_section_links_section_id_foreign` (`section_id`),
  ADD KEY `page_section_links_display_order_index` (`display_order`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `partners_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `partners_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`),
  ADD KEY `permissions_created_by_foreign` (`created_by`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `platforms_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `platforms_name_unique` (`name`),
  ADD UNIQUE KEY `platforms_slug_unique` (`slug`),
  ADD KEY `platforms_is_active_display_order_index` (`is_active`,`display_order`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `portfolios_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `portfolios_slug_unique` (`slug`),
  ADD KEY `portfolios_portfolio_category_id_is_active_index` (`portfolio_category_id`,`is_active`);

--
-- Indexes for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `portfolio_categories_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `portfolio_categories_slug_unique` (`slug`);

--
-- Indexes for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `portfolio_images_uuid_unique` (`uuid`),
  ADD KEY `portfolio_images_portfolio_id_is_active_index` (`portfolio_id`,`is_active`);

--
-- Indexes for table `portfolio_skills`
--
ALTER TABLE `portfolio_skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `portfolio_skills_portfolio_id_skill_id_unique` (`portfolio_id`,`skill_id`),
  ADD UNIQUE KEY `portfolio_skills_uuid_unique` (`uuid`),
  ADD KEY `portfolio_skills_skill_id_foreign` (`skill_id`),
  ADD KEY `portfolio_skills_portfolio_id_is_active_index` (`portfolio_id`,`is_active`);

--
-- Indexes for table `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resumes_uuid_unique` (`uuid`),
  ADD KEY `resumes_email_index` (`email`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_uuid_unique` (`uuid`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_reviewable_type_reviewable_id_index` (`reviewable_type`,`reviewable_id`),
  ADD KEY `reviews_status_index` (`status`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_permissions_role_id_permission_id_unique` (`role_id`,`permission_id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sections_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `sections_slug_unique` (`slug`),
  ADD KEY `sections_template_id_is_active_index` (`is_active`),
  ADD KEY `sections_form_id_foreign` (`form_id`);

--
-- Indexes for table `section_contents`
--
ALTER TABLE `section_contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_contents_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `section_contents_slug_unique` (`slug`),
  ADD KEY `section_contents_page_name_section_name_index` (`page_name`,`section_name`),
  ADD KEY `section_contents_display_order_index` (`display_order`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Indexes for table `service_challenges`
--
ALTER TABLE `service_challenges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_challenges_uuid_unique` (`uuid`),
  ADD KEY `service_challenges_service_id_is_active_index` (`service_id`,`is_active`);

--
-- Indexes for table `service_faqs`
--
ALTER TABLE `service_faqs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_faqs_uuid_unique` (`uuid`),
  ADD KEY `service_faqs_service_id_is_active_index` (`service_id`,`is_active`);

--
-- Indexes for table `service_features`
--
ALTER TABLE `service_features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_features_uuid_unique` (`uuid`),
  ADD KEY `service_features_service_id_is_active_index` (`service_id`,`is_active`);

--
-- Indexes for table `service_platforms`
--
ALTER TABLE `service_platforms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_platforms_service_id_platform_id_unique` (`service_id`,`platform_id`),
  ADD UNIQUE KEY `service_platforms_uuid_unique` (`uuid`),
  ADD KEY `service_platforms_service_id_is_active_index` (`service_id`,`is_active`),
  ADD KEY `service_platforms_platform_id_is_active_index` (`platform_id`,`is_active`);

--
-- Indexes for table `service_problems`
--
ALTER TABLE `service_problems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_problems_uuid_unique` (`uuid`),
  ADD KEY `service_problems_service_id_foreign` (`service_id`);

--
-- Indexes for table `service_solutions`
--
ALTER TABLE `service_solutions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_solutions_uuid_unique` (`uuid`),
  ADD KEY `service_solutions_service_id_foreign` (`service_id`);

--
-- Indexes for table `service_technology`
--
ALTER TABLE `service_technology`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_technology_service_id_technology_id_unique` (`service_id`,`technology_id`),
  ADD UNIQUE KEY `service_technology_uuid_unique` (`uuid`),
  ADD KEY `service_technology_technology_id_foreign` (`technology_id`),
  ADD KEY `service_technology_service_id_is_active_index` (`service_id`,`is_active`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_settings_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `site_settings_key_unique` (`key`),
  ADD KEY `site_settings_group_is_active_index` (`group`,`is_active`);

--
-- Indexes for table `site_visits`
--
ALTER TABLE `site_visits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_visits_uuid_unique` (`uuid`),
  ADD KEY `site_visits_session_id_index` (`session_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skills_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `skills_slug_unique` (`slug`),
  ADD KEY `skills_technology_id_foreign` (`technology_id`);

--
-- Indexes for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `smtp_settings_uuid_unique` (`uuid`),
  ADD KEY `smtp_settings_created_by_foreign` (`created_by`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `social_links_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `social_links_slug_unique` (`slug`),
  ADD KEY `social_links_linkable_type_linkable_id_index` (`linkable_type`,`linkable_id`),
  ADD KEY `social_links_linkable_type_linkable_id_is_active_index` (`linkable_type`,`linkable_id`,`is_active`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `system_logs_uuid_unique` (`uuid`),
  ADD KEY `system_logs_module_action_index` (`module`,`action`),
  ADD KEY `system_logs_user_id_index` (`user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`),
  ADD KEY `tags_display_order_index` (`display_order`);

--
-- Indexes for table `technologies`
--
ALTER TABLE `technologies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `technologies_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `technologies_slug_unique` (`slug`),
  ADD KEY `technologies_technology_category_id_is_active_index` (`technology_category_id`,`is_active`);

--
-- Indexes for table `technology_categories`
--
ALTER TABLE `technology_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `technology_categories_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `technology_categories_slug_unique` (`slug`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `templates_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `templates_slug_unique` (`slug`),
  ADD KEY `templates_type_is_active_index` (`type`,`is_active`),
  ADD KEY `templates_display_order_index` (`display_order`);

--
-- Indexes for table `template_forms`
--
ALTER TABLE `template_forms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `template_forms_template_id_form_id_unique` (`template_id`,`form_id`),
  ADD UNIQUE KEY `template_forms_uuid_unique` (`uuid`),
  ADD KEY `template_forms_form_id_foreign` (`form_id`),
  ADD KEY `template_forms_template_id_is_active_index` (`template_id`,`is_active`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `testimonials_uuid_unique` (`uuid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_permissions_user_id_permission_id_unique` (`user_id`,`permission_id`),
  ADD KEY `user_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_permissions_granted_by_foreign` (`granted_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `application_status_logs`
--
ALTER TABLE `application_status_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `auth_logs`
--
ALTER TABLE `auth_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `career_applications`
--
ALTER TABLE `career_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `case_studies`
--
ALTER TABLE `case_studies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `case_study_categories`
--
ALTER TABLE `case_study_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `crm_clients`
--
ALTER TABLE `crm_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_client_contacts`
--
ALTER TABLE `crm_client_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_client_documents`
--
ALTER TABLE `crm_client_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_client_notes`
--
ALTER TABLE `crm_client_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_deals`
--
ALTER TABLE `crm_deals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_expenses`
--
ALTER TABLE `crm_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_expense_categories`
--
ALTER TABLE `crm_expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_invoices`
--
ALTER TABLE `crm_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_invoice_items`
--
ALTER TABLE `crm_invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_leads`
--
ALTER TABLE `crm_leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_lead_activities`
--
ALTER TABLE `crm_lead_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_lead_sources`
--
ALTER TABLE `crm_lead_sources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_lead_statuses`
--
ALTER TABLE `crm_lead_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_payments`
--
ALTER TABLE `crm_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_payment_methods`
--
ALTER TABLE `crm_payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_projects`
--
ALTER TABLE `crm_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_project_members`
--
ALTER TABLE `crm_project_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_project_milestones`
--
ALTER TABLE `crm_project_milestones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_project_tasks`
--
ALTER TABLE `crm_project_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_task_comments`
--
ALTER TABLE `crm_task_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enquiries_status_logs`
--
ALTER TABLE `enquiries_status_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faq_items`
--
ALTER TABLE `faq_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `form_fields`
--
ALTER TABLE `form_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `google_reviews`
--
ALTER TABLE `google_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `industries`
--
ALTER TABLE `industries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `industry_categories`
--
ALTER TABLE `industry_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media_relations`
--
ALTER TABLE `media_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_sections`
--
ALTER TABLE `page_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_section_contents`
--
ALTER TABLE `page_section_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_section_links`
--
ALTER TABLE `page_section_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `portfolio_skills`
--
ALTER TABLE `portfolio_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resumes`
--
ALTER TABLE `resumes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `section_contents`
--
ALTER TABLE `section_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `service_challenges`
--
ALTER TABLE `service_challenges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_faqs`
--
ALTER TABLE `service_faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `service_features`
--
ALTER TABLE `service_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `service_platforms`
--
ALTER TABLE `service_platforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `service_problems`
--
ALTER TABLE `service_problems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_solutions`
--
ALTER TABLE `service_solutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_technology`
--
ALTER TABLE `service_technology`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `site_visits`
--
ALTER TABLE `site_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `technologies`
--
ALTER TABLE `technologies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `technology_categories`
--
ALTER TABLE `technology_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_forms`
--
ALTER TABLE `template_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `application_status_logs`
--
ALTER TABLE `application_status_logs`
  ADD CONSTRAINT `application_status_logs_career_application_id_foreign` FOREIGN KEY (`career_application_id`) REFERENCES `career_applications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `application_status_logs_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `authors`
--
ALTER TABLE `authors`
  ADD CONSTRAINT `authors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `auth_logs`
--
ALTER TABLE `auth_logs`
  ADD CONSTRAINT `auth_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `blogs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD CONSTRAINT `blog_tags_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `careers`
--
ALTER TABLE `careers`
  ADD CONSTRAINT `careers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `career_applications`
--
ALTER TABLE `career_applications`
  ADD CONSTRAINT `career_applications_career_id_foreign` FOREIGN KEY (`career_id`) REFERENCES `careers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `career_applications_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `career_applications_resume_id_foreign` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `case_studies`
--
ALTER TABLE `case_studies`
  ADD CONSTRAINT `case_studies_case_study_category_id_foreign` FOREIGN KEY (`case_study_category_id`) REFERENCES `case_study_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `enquiries_status_logs`
--
ALTER TABLE `enquiries_status_logs`
  ADD CONSTRAINT `enquiries_status_logs_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `enquiries_status_logs_enquiry_id_foreign` FOREIGN KEY (`enquiry_id`) REFERENCES `enquiries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faq_items`
--
ALTER TABLE `faq_items`
  ADD CONSTRAINT `faq_items_faq_category_id_foreign` FOREIGN KEY (`faq_category_id`) REFERENCES `faq_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `industries`
--
ALTER TABLE `industries`
  ADD CONSTRAINT `industries_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `industry_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD CONSTRAINT `page_contents_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `page_contents_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `page_contents_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `page_contents_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `page_sections`
--
ALTER TABLE `page_sections`
  ADD CONSTRAINT `page_sections_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `page_sections_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_section_contents`
--
ALTER TABLE `page_section_contents`
  ADD CONSTRAINT `page_section_contents_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `page_section_contents_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_section_links`
--
ALTER TABLE `page_section_links`
  ADD CONSTRAINT `page_section_links_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `page_section_links_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_problems`
--
ALTER TABLE `service_problems`
  ADD CONSTRAINT `service_problems_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_solutions`
--
ALTER TABLE `service_solutions`
  ADD CONSTRAINT `service_solutions_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
