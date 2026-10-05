-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2026 at 08:10 PM
-- Server version: 11.4.13-MariaDB
-- PHP Version: 8.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `httsysco_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_settings`
--

CREATE TABLE `about_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` text NOT NULL,
  `slug` varchar(191) NOT NULL,
  `breadcrumbs_anchor` varchar(191) NOT NULL,
  `about_subtitle` varchar(191) NOT NULL,
  `about_title` varchar(191) NOT NULL,
  `about_description` text NOT NULL,
  `about_buttontext` varchar(191) NOT NULL,
  `about_buttonlink` varchar(191) NOT NULL,
  `about_image` varchar(191) NOT NULL,
  `about_ytlink` varchar(191) NOT NULL,
  `member_title_section` varchar(255) NOT NULL,
  `banner_img` varchar(255) DEFAULT NULL,
  `banner_title` varchar(255) DEFAULT NULL,
  `banner_desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_settings`
--

INSERT INTO `about_settings` (`id`, `language_id`, `meta_title`, `meta_description`, `slug`, `breadcrumbs_anchor`, `about_subtitle`, `about_title`, `about_description`, `about_buttontext`, `about_buttonlink`, `about_image`, `about_ytlink`, `member_title_section`, `banner_img`, `banner_title`, `banner_desc`, `created_at`, `updated_at`) VALUES
(1, 1, 'About HT Tech system', 'HT Tech system is a trusted global software development and multiple business agency formed as a joint venture between USA and Bangladeshis entities.', 'about-us', 'Home', 'We Make Brands Stand Out.', 'A Digital Marketing and Custom Web Design agency', '<p>Web design encompasses many different skills and disciplines in the production and maintenance of websites. The different areas of web design include web graphic design, interface design, including standardized code.</p>\r\n<ul>\r\n<li>Beautiful and easy to understand UI, professional animations</li>\r\n<li>These advantages are pixel perfect design &amp; clear code delivered</li>\r\n<li>Present your services with flexible, convenient and multipurpose</li>\r\n</ul>', 'Contact us', 'https://httsys.com/contact', 'https://httsys.com/public/images/media/1633278274PSDFebFrameNot163 (1).webp', 'https://www.youtube.com/', 'Professional <span>team.</span>', 'https://icode.lucian.host/public/images/media/1633027720quinheader.webp', 'About the company', 'Quin is a creative agency built with one purpose: to help you define your brand. We offer impeccable service combining a nice and user-friendly design with quality programming.', NULL, '2023-03-06 19:52:07'),
(2, 2, 'এইচটি প্রযুক্তি সিস্টেম সম্পর্কে', 'এইচটি টেক সিস্টেম একটি বিশ্বস্ত বৈশ্বিক সফ্টওয়্যার ডেভেলপমেন্ট এবং একাধিক ব্যবসায়িক সংস্থা যা মার্কিন যুক্তরাষ্ট্র এবং বাংলাদেশী সংস্থাগুলির মধ্যে একটি যৌথ উদ্যোগ হিসাবে গঠিত।', 'about-us', 'হোম', 'আমরা ব্র্যান্ডগুলিকে আলাদা করি।', 'একটি ডিজিটাল মার্কেটিং এবং কাস্টম ওয়েব ডিজাইন এজেন্সি', '<p>ওয়েব ডিজাইন ওয়েবসাইটের উৎপাদন এবং রক্ষণাবেক্ষণে বিভিন্ন দক্ষতা এবং শৃঙ্খলাকে অন্তর্ভুক্ত করে। ওয়েব ডিজাইনের বিভিন্ন ক্ষেত্রের মধ্যে রয়েছে ওয়েব গ্রাফিক ডিজাইন, ইন্টারফেস ডিজাইন, প্রমিত কোড সহ।</p>\r\n<p>সুন্দর এবং সহজে বোঝা যায় UI, পেশাদার অ্যানিমেশন<br />এই সুবিধাগুলি হল পিক্সেল নিখুঁত ডিজাইন এবং পরিষ্কার কোড সরবরাহ করা<br />আপনার পরিষেবাগুলি নমনীয়, সুবিধাজনক এবং বহুমুখী সহ উপস্থাপন করুন</p>', 'যোগাযোগ করুন', 'https://httsys.com/contact', 'https://httsys.com/public/images/media/1633278274PSDFebFrameNot163 (1).webp', 'https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d', 'প্রফেশনাল', 'https://icode.lucian.host/public/images/media/1633027720quinheader.webp', 'Sobre <span> a empresa </span>', 'Quin é uma agência de criação construída com um propósito: ajudar você a definir sua marca. Oferecemos um serviço impecável combinando um design agradável e amigável com uma programação de qualidade.', NULL, '2023-10-15 08:32:57'),
(3, 3, 'حول نيفا', 'يشمل تصميم الويب العديد من المهارات والتخصصات المختلفة في إنتاج وصيانة المواقع الإلكترونية.', 'about-us', 'منزل، بيت', 'نجعل العلامات التجارية متميزة.', 'وكالة تسويق رقمي وتصميم مواقع ويب مخصصة', '<p>يشمل</p>\r\n<p><strong> تصميم الويب strong&gt; العديد من المهارات والتخصصات المختلفة في إنتاج مواقع الويب وصيانتها. تشمل المجالات المختلفة لتصميم الويب تصميم رسومات الويب ، وتصميم الواجهة ، بما في ذلك التعليمات البرمجية الموحدة. p&gt; </strong></p>\r\n<p><strong> واجهة مستخدم جميلة وسهلة الفهم ورسوم متحركة احترافية li&gt; هذه المزايا هي تصميم مثالي للبكسل وأمبير. تسليم كود واضح قدم خدماتك بمرونة وملاءمة ومتعددة الأغراض li&gt; </strong></p>', 'اتصل بنا', 'https://icode.lucian.host/contact', 'https://icode.lucian.host/public/images/media/1633278274PSDFebFrameNot163 (1).webp', 'https://www.youtube.com/watch?v=fMkYqHI68io', 'فريق فني.', 'https://icode.lucian.host/public/images/media/1633027720quinheader.webp', 'حول <span> الشركة </ span>', 'Quin هي وكالة إبداعية تم إنشاؤها لغرض واحد: مساعدتك في تحديد علامتك التجارية. نحن نقدم خدمة لا تشوبها شائبة تجمع بين التصميم الجميل وسهل الاستخدام والبرمجة عالية الجودة.', NULL, '2022-01-24 15:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `country` varchar(191) NOT NULL DEFAULT 'Bangladesh',
  `state` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `address_line` varchar(191) NOT NULL,
  `postal_code` varchar(191) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `name`, `phone`, `email`, `country`, `state`, `city`, `address_line`, `postal_code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 16, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 1, '2026-09-08 01:36:43', '2026-09-08 01:36:43'),
(2, 17, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Kather Pool, Comilla Adarsha Sadar, Cumilla-3500.', '3500', 1, '2026-09-08 01:42:30', '2026-09-08 01:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `ad_zones`
--

CREATE TABLE `ad_zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` longtext DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_zones`
--

INSERT INTO `ad_zones` (`id`, `key`, `name`, `code`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'site_top', 'Site-wide - Top of Page (every page)', '<script async=\"async\" data-cfasync=\"false\" src=\"https://pl30880299.effectivecpmnetwork.com/5f009b5dc933eca9d52e7232ff4f376a/invoke.js\"></script>\r\n<div id=\"container-5f009b5dc933eca9d52e7232ff4f376a\"></div>', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(2, 'site_below_header', 'Site-wide - Below Header (every page)', 'https://www.effectivecpmnetwork.com/vnnbdy10?key=e5342d6962a59e0717685bf8d6c28011', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(3, 'site_above_footer', 'Site-wide - Above Footer (every page)', '<script>\r\natOptions = {\r\n\'key\' : \'f606162a4ac4a866898fc97af53d4acb\',\r\n\'format\' : \'iframe\',\r\n\'height\' : 90,\r\n\'width\' : 728,\r\n\'params\' : {}\r\n};\r\n</script>\r\n<script src=\"https://www.highperformanceformat.com/f606162a4ac4a866898fc97af53d4acb/invoke.js\"></script>', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(4, 'site_bottom', 'Site-wide - Bottom of Page / popup scripts (every page)', NULL, 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(5, 'home_top', 'Home Page - Top', 'https://www.effectivecpmnetwork.com/dy2rfii3?key=7bd8b8d3874a0e4eaa72555171741454', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(6, 'home_bottom', 'Home Page - Bottom', '<script async=\"async\" data-cfasync=\"false\" src=\"https://pl30880299.effectivecpmnetwork.com/5f009b5dc933eca9d52e7232ff4f376a/invoke.js\"></script>\r\n<div id=\"container-5f009b5dc933eca9d52e7232ff4f376a\"></div>', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(7, 'blog_sidebar_top', 'Blog Listing - Sidebar Top', '<script async=\"async\" data-cfasync=\"false\" src=\"https://pl30880299.effectivecpmnetwork.com/5f009b5dc933eca9d52e7232ff4f376a/invoke.js\"></script>\r\n<div id=\"container-5f009b5dc933eca9d52e7232ff4f376a\"></div>', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(8, 'blog_infeed', 'Blog Listing - In Feed (after every 3rd post)', '<script>\r\natOptions = {\r\n\'key\' : \'f606162a4ac4a866898fc97af53d4acb\',\r\n\'format\' : \'iframe\',\r\n\'height\' : 90,\r\n\'width\' : 728,\r\n\'params\' : {}\r\n};\r\n</script>\r\n<script src=\"https://www.highperformanceformat.com/f606162a4ac4a866898fc97af53d4acb/invoke.js\"></script>', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(9, 'blog_below_posts', 'Blog Listing - Below Post List', 'https://www.effectivecpmnetwork.com/vnnbdy10?key=e5342d6962a59e0717685bf8d6c28011', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(10, 'post_sidebar_top', 'Single Post - Sidebar Top', NULL, 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(11, 'post_sidebar_bottom', 'Single Post - Sidebar Bottom', NULL, 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(12, 'post_in_content_top', 'Single Post - In Content Top', '<script>\r\natOptions = {\r\n\'key\' : \'f606162a4ac4a866898fc97af53d4acb\',\r\n\'format\' : \'iframe\',\r\n\'height\' : 90,\r\n\'width\' : 728,\r\n\'params\' : {}\r\n};\r\n</script>\r\n<script src=\"https://www.highperformanceformat.com/f606162a4ac4a866898fc97af53d4acb/invoke.js\"></script>', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(13, 'post_in_content_bottom', 'Single Post - In Content Bottom', '<script async=\"async\" data-cfasync=\"false\" src=\"https://pl30880299.effectivecpmnetwork.com/5f009b5dc933eca9d52e7232ff4f376a/invoke.js\"></script>\r\n<div id=\"container-5f009b5dc933eca9d52e7232ff4f376a\"></div>', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(14, 'page_top', 'Generic Page - Top', '<script>\r\natOptions = {\r\n\'key\' : \'f606162a4ac4a866898fc97af53d4acb\',\r\n\'format\' : \'iframe\',\r\n\'height\' : 90,\r\n\'width\' : 728,\r\n\'params\' : {}\r\n};\r\n</script>\r\n<script src=\"https://www.highperformanceformat.com/f606162a4ac4a866898fc97af53d4acb/invoke.js\"></script>', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23'),
(15, 'page_bottom', 'Generic Page - Bottom', '<script>\r\natOptions = {\r\n\'key\' : \'f606162a4ac4a866898fc97af53d4acb\',\r\n\'format\' : \'iframe\',\r\n\'height\' : 90,\r\n\'width\' : 728,\r\n\'params\' : {}\r\n};\r\n</script>\r\n<script src=\"https://www.highperformanceformat.com/f606162a4ac4a866898fc97af53d4acb/invoke.js\"></script>', 0, '2026-08-15 20:30:52', '2026-08-16 20:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `blog_settings`
--

CREATE TABLE `blog_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(4) DEFAULT 0,
  `banner_img` text DEFAULT NULL,
  `banner_title` text DEFAULT NULL,
  `banner_desc` text DEFAULT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` text NOT NULL,
  `slug` varchar(191) NOT NULL,
  `breadcrumbs_anchor` varchar(191) NOT NULL,
  `html_sidebar1` text NOT NULL,
  `html_sidebar2` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_settings`
--

INSERT INTO `blog_settings` (`id`, `language_id`, `banner_img`, `banner_title`, `banner_desc`, `meta_title`, `meta_description`, `slug`, `breadcrumbs_anchor`, `html_sidebar1`, `html_sidebar2`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://icode.lucian.host/public/images/media/1633963749news-bg.webp', 'Our recent <span>news</span>', 'Making people smile gets us out of bed every morning. Through thoughtful design, we create delightful digital experiences that make life simpler and more enjoyable.', 'Our recent news', 'Do you believe that your brand needs help from a creative team? Contact us to start working for your project!', 'blog', 'Home', '<h3 class=\"widget-title\">About us</h3>\r\n<div class=\"textwidget\"><a href=\"/about-us\"><img class=\"html-widget-image img-fluid\" src=\"/public/images/media/1615714364sidebar-img1.jpg\" alt=\"\" /></a>\r\n<p class=\"html-widget-paragraph\">Do you believe that your brand needs help from a creative team? Contact us to start working for your project!</p>\r\n<a class=\"btn btn-style1\" href=\"https://www.effectivecpmnetwork.com/vnnbdy10?key=e5342d6962a59e0717685bf8d6c28011\">Read More </a></div>', '<h3 class=\"widget-title\">Banner ad</h3>\r\n<div class=\"textwidget\"><a title=\"adsense\" href=\"https://www.effectivecpmnetwork.com/vnnbdy10?key=e5342d6962a59e0717685bf8d6c28011\" target=\"_blank\" rel=\"noreferrer noopener\"><img class=\"html-widget-image img-ad img-fluid\" src=\"/storage/photos/1/ChatGPT_Image_Sep_24__2026__02_14_36_AM__1_.png\" alt=\"\" /></a> <img src=\"/storage/photos/1/ChatGPT_Image_Sep_24__2026__02_14_36_AM__1_.png\" alt=\"ChatGPT_Image_Sep_24__2026__02_14_36_AM__1_.png\" /></div>', NULL, '2026-10-02 00:28:29'),
(2, 2, 'https://icode.lucian.host/public/images/media/1633963749news-bg.webp', 'Nossas <span> notícias </span> recentes', 'Fazer as pessoas sorrirem nos tira da cama todas as manhãs. Por meio de um design bem pensado, criamos experiências digitais maravilhosas que tornam a vida mais simples e agradável.', 'আমাদের সাম্প্রতিক সংবাদ', 'আপনি কি মনে করেন আপনার ব্র্যান্ডের একটি সৃজনশীল দলের সাহায্য প্রয়োজন? আপনার প্রকল্পের কাজ শুরু করতে আমাদের সাথে যোগাযোগ করুন!', 'blog', 'Home', '<h3 class=\"widget-title\">আমাদের সম্পর্কে</h3>\r\n<div class=\"textwidget\"><a href=\"/about-us\"><img class=\"html-widget-image img-fluid\" src=\"/public/images/media/1615714364sidebar-img1.jpg\" alt=\"\" /></a>\r\n<p class=\"html-widget-paragraph\">আপনি কি মনে করেন আপনার ব্র্যান্ডের একটি সৃজনশীল দলের সাহায্য প্রয়োজন? আপনার প্রকল্পের কাজ শুরু করতে আমাদের সাথে যোগাযোগ করুন!</p>\r\n<a href=\"https://www.effectivecpmnetwork.com/vnnbdy10?key=e5342d6962a59e0717685bf8d6c28011\"><strong>আরও পড়ুন</strong></a></div>', '<h3 class=\"widget-title\">বিজ্ঞাপন</h3>\r\n<div class=\"textwidget\"><a title=\"ChatGPT_Image_Sep_24__2026__02_14_36_AM__1_.png\" href=\"/storage/files/1/ChatGPT_Image_Sep_24__2026__02_14_36_AM__1_.png\">https://test.httsys.com/storage/files/1/ChatGPT_Image_Sep_24__2026__02_14_36_AM__1_.png</a>\r\n<p class=\"html-widget-paragraph\">&nbsp;</p>\r\n<a href=\"https://www.effectivecpmnetwork.com/vnnbdy10?key=e5342d6962a59e0717685bf8d6c28011\"><strong>আরও পড়ুন</strong></a></div>', NULL, '2026-09-24 02:27:34'),
(3, 3, 'https://icode.lucian.host/public/images/media/1633963749news-bg.webp', 'آخر <span> أخبار </ span>', 'جعل الناس يبتسمون يجعلنا ننهض من الفراش كل صباح. من خلال التصميم المدروس ، نخلق تجارب رقمية مبهجة تجعل الحياة أبسط وأكثر متعة.', 'آخر أخبارنا', 'هل تعتقد أن علامتك التجارية تحتاج إلى مساعدة من فريق مبدع؟ اتصل بنا لبدء العمل في مشروعك!', 'blog', 'منزل، بيت', '<h3 class=\"widget-title\">معلومات عنا</h3>\r\n<div class=\"textwidget\"><a href=\"/about-us\"><img class=\"html-widget-image img-fluid\" src=\"/public/images/media/1615714364sidebar-img1.jpg\" alt=\"\" /></a>\r\n<p class=\"html-widget-paragraph\">هل تعتقد أن علامتك التجارية تحتاج إلى مساعدة من فريق مبدع؟ اتصل بنا لبدء العمل في مشروعك!</p>\r\n<a class=\"btn btn-style1\" href=\"/about-us\">اقرأ أكثر </a></div>', '<h3 class=\"widget-title\">لافتة إعلانية</h3>\r\n<div class=\"textwidget\"><a title=\"adsense\" href=\"https://www.google.com/adsense/start/\" target=\"_blank\" rel=\"noopener\"><img class=\"html-widget-image img-ad img-fluid\" src=\"/public/images/media/1615715240adsense500x500.png\" alt=\"\" /></a>&nbsp;</div>', NULL, '2021-03-20 18:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `photo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `photo_id`, `created_at`, `updated_at`) VALUES
(1, 'HT Tech system', 263, '2026-08-28 17:40:53', '2026-08-28 17:40:53'),
(2, 'Apple', 270, '2026-08-30 14:30:58', '2026-08-30 14:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `language_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Agency, Consulting', '2021-03-13 19:32:07', '2021-03-13 19:32:07'),
(2, 1, 'Design, UI/UX', '2021-03-13 19:32:20', '2021-03-13 19:32:20'),
(3, 1, 'Programming', '2021-03-13 19:32:32', '2021-03-13 19:32:32'),
(5, 0, 'en', '2021-04-05 22:44:55', '2021-04-05 22:44:55'),
(9, 2, 'ডিজাইন, UI/UX', '2021-04-10 22:05:08', '2023-03-07 14:32:18'),
(8, 2, 'এজেন্সী, কনসাল্টিং', '2021-04-10 22:04:47', '2023-03-07 14:33:23'),
(10, 2, 'প্রোগ্রামিং', '2021-04-10 22:05:18', '2023-03-07 14:31:55'),
(11, 3, 'برمجة', '2021-04-11 17:47:26', '2021-04-11 17:47:26'),
(12, 3, 'تصميم', '2021-04-11 17:47:37', '2021-04-11 17:47:37'),
(13, 3, 'وكالة ، استشارات', '2021-04-11 17:47:46', '2021-04-11 17:47:46'),
(14, 1, 'Bangla', '2026-08-22 20:01:29', '2026-08-22 20:01:29'),
(15, 2, 'বাংলা', '2026-08-22 20:02:15', '2026-08-22 20:02:15');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_id` varchar(191) NOT NULL,
  `company_name` text NOT NULL,
  `company_link` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `photo_id`, `company_name`, `company_link`, `created_at`, `updated_at`) VALUES
(1, '32', 'Crofts', '#', '2021-03-13 21:15:05', '2023-03-06 19:35:41'),
(2, '33', 'Autospeed', '#', '2021-03-13 21:15:24', '2023-03-06 19:35:54'),
(3, '34', 'Chesire', '#', '2021-03-13 21:15:40', '2023-03-06 19:36:06'),
(4, '35', 'Fast Banana', '#', '2021-03-13 21:15:55', '2023-03-06 19:36:18'),
(5, '36', 'Dance studio', '#', '2021-03-13 21:16:07', '2023-03-06 19:36:30'),
(6, '37', 'Beautybox', '#', '2021-03-13 21:16:19', '2023-03-06 19:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 0,
  `author` varchar(191) NOT NULL,
  `photo` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `body` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `is_active`, `author`, `photo`, `email`, `body`, `created_at`, `updated_at`) VALUES
(1, 20, 16, 1, 'earn stationme1', '', 'earnstationme1@gmail.com', 'আমি ট্রেন ভ্রমণ অনেক পছন্দ করি। বনলতা এক্সপ্রেস উপন্যাসটি আমার অনেক আগের থেকেই খুব ভালো লাগতো। বনলতা এক্সপ্রেস...', '2026-08-24 21:09:32', '2026-08-24 21:22:44'),
(2, 21, 16, 1, 'earn stationme1', '', 'earnstationme1@gmail.com', 'আমি জানি না কেন, কথাটা শুনে আমার নিজের বাবার কথা মনে পড়লো।', '2026-08-24 21:23:54', '2026-08-26 14:25:54'),
(3, 20, 14, 1, 'abc', '', 'abc@httsys.com', 'ট্রেনটির রুট চাঁপাইনবাবগঞ্জ পর্যন্ত বর্ধিত করা হয়।', '2026-08-26 14:30:42', '2026-08-26 14:30:42');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment_id` int(10) UNSIGNED NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 0,
  `author` varchar(191) NOT NULL,
  `photo` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `body` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_settings`
--

CREATE TABLE `contact_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `banner_title` text DEFAULT NULL,
  `banner_img` text DEFAULT NULL,
  `banner_desc` text DEFAULT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` text NOT NULL,
  `slug` varchar(191) NOT NULL,
  `breadcrumbs_anchor` varchar(191) NOT NULL,
  `box_icon1` varchar(191) NOT NULL,
  `box_icon2` varchar(191) NOT NULL,
  `box_icon3` varchar(191) NOT NULL,
  `box_title1` varchar(191) NOT NULL,
  `box_title2` varchar(191) NOT NULL,
  `box_title3` varchar(191) NOT NULL,
  `box_html1` text NOT NULL,
  `box_html2` text NOT NULL,
  `box_html3` text NOT NULL,
  `form_title` varchar(191) NOT NULL,
  `form_input_name` varchar(191) NOT NULL,
  `form_input_email` varchar(191) NOT NULL,
  `form_input_budget` varchar(191) NOT NULL,
  `form_input_phone` varchar(191) NOT NULL,
  `form_message` text NOT NULL,
  `button_text` varchar(191) NOT NULL,
  `button_link` varchar(191) NOT NULL,
  `mailto` varchar(191) NOT NULL,
  `title` varchar(191) NOT NULL,
  `iframe_txt` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_settings`
--

INSERT INTO `contact_settings` (`id`, `language_id`, `banner_title`, `banner_img`, `banner_desc`, `meta_title`, `meta_description`, `slug`, `breadcrumbs_anchor`, `box_icon1`, `box_icon2`, `box_icon3`, `box_title1`, `box_title2`, `box_title3`, `box_html1`, `box_html2`, `box_html3`, `form_title`, `form_input_name`, `form_input_email`, `form_input_budget`, `form_input_phone`, `form_message`, `button_text`, `button_link`, `mailto`, `title`, `iframe_txt`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, 'Contact us', 'Our Contact page', 'contact', 'Home', '<i class=\"fas fa-phone-volume\"></i>', '<i class=\"fas fa-envelope\"></i>', '<i class=\"fas fa-map-marker-alt\"></i>', 'Call us today', 'Our emails', 'Our address', '<p><a href=\"tel:+8801770166682\">tel:+001-1512-6660182 </a><a href=\"tel:+8801770166682\">tel:+8801770166682</a></p>', '<p><a href=\"mailto:httechsystem@gmail.com\">support@httsys.com</a> <a href=\"mailto:httechsystem@gmail.com\">httechsystem@gmail.com</a></p>', '<p><a href=\"https://goo.gl/maps/JwQdjL8S1MaJnQAv5\">4781 Valley Lane, Austin, Texas, United States America.</a></p>', 'Send us a message', 'Name', 'Email', 'Phone Number', 'Phone', 'Message', 'Submit', '', 'support@httsys.com', 'Where we are', '<p><iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9929.880220551257!2d-0.1308206!3d51.5229378!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x35223832b9a7517a!2sUniversity%20of%20London!5e0!3m2!1sen!2sro!4v1615724797695!5m2!1sen!2sro\" width=\"100%\" height=\"450\" allowfullscreen=\"\"></iframe></p>', NULL, '2026-09-24 02:04:51'),
(2, 2, NULL, NULL, NULL, 'যোগাযোগ করুন', 'আমাদের যোগাযোগ পৃষ্ঠা', 'contact', 'হোম', '<i class=\"fas fa-phone-volume\"></i>', '<i class=\"fas fa-envelope\"></i>', '<i class=\"fas fa-map-marker-alt\"></i>', 'আজ আমাদের সঙ্গে যোগাযোগ করুন', 'আমাদের ইমেইল', 'আমাদের ঠিকানা', '<p><a href=\"tel:+8801770166682\">+001-1512-6660182</a> <a href=\"tel:+8801770166682\">+8801770166682</a></p>', '<p><a href=\"mailto:httechsystem@gmail.com\">support@httsys.com</a> <a href=\"mailto:httechsystem@gmail.com\">httechsystem@gmail.com</a></p>', '<p><a href=\"https://goo.gl/maps/VFKEtSh7efxc8BBt5\">4781 Valley Lane, Austin, Texas, United States America.</a></p>', 'আমাদের একটি মেসেজ পাঠান', 'নাম', 'ইমেইল', 'ফোন নম্বর', 'ফোন নম্বর', 'মেসেজ', 'সাবমিট', '', 'support@httsys.com', 'যেখানে আমরা আছি', '<p><iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9929.880220551257!2d-0.1308206!3d51.5229378!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x35223832b9a7517a!2sUniversity%20of%20London!5e0!3m2!1sen!2sro!4v1615724797695!5m2!1sen!2sro\" width=\"100%\" height=\"450\" allowfullscreen=\"\"></iframe></p>', NULL, '2026-09-24 02:04:17'),
(3, 3, NULL, NULL, NULL, 'اتصل بنا', 'صفحة الاتصال الخاصة بنا', 'contact', 'منزل، بيت', '<i class=\"fas fa-phone-volume\"></i>', '<i class=\"fas fa-envelope\"></i>', '<i class=\"fas fa-map-marker-alt\"></i>', 'اتصل بنا اليوم', 'رسائل البريد الإلكتروني لدينا', 'عنواننا', '<p><a href=\"tel:+472543657456\">PS: +47 254 3657 456</a> <a href=\"tel:+877390740223\">HO: +87 739 0740 223</a></p>', '<p><a href=\"mailto:contact@niva.host\">contact@niva.host</a> <a href=\"mailto:office@niva.host\">office@niva.host</a></p>', '<p><a href=\"https://goo.gl/maps/JwQdjL8S1MaJnQAv5\">Malet St, Bloomsbury, London WC1E 7HU, United Kingdom</a></p>', 'أرسل لنا رسالة', 'اسم', 'بريد إلكتروني', 'هاتف', 'الدخل', 'رسالة', 'إرسال', '', 'contact@lucian.host', 'اين نحن', '<p><iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9929.880220551257!2d-0.1308206!3d51.5229378!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x35223832b9a7517a!2sUniversity%20of%20London!5e0!3m2!1sen!2sro!4v1615724797695!5m2!1sen!2sro\" width=\"100%\" height=\"450\" allowfullscreen=\"\"></iframe></p>', NULL, '2021-04-10 23:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `type` enum('fixed','percent') NOT NULL DEFAULT 'fixed',
  `value` decimal(12,2) NOT NULL,
  `max_discount` decimal(12,2) DEFAULT NULL,
  `min_subtotal` decimal(12,2) DEFAULT NULL,
  `usage_limit` int(10) UNSIGNED DEFAULT NULL,
  `used_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `max_discount`, `min_subtotal`, `usage_limit`, `used_count`, `expires_at`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'WELCOME500', 'fixed', 500.00, NULL, 20000.00, 10, 10, '2026-12-31 00:00:00', 1, '2026-09-12 02:49:39', '2026-09-30 02:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'USD', 'US Dollar', 1, 0, '2026-09-28 01:05:53', '2026-09-28 01:05:53'),
(2, 'EU', 'Euro', 1, 0, '2026-09-28 02:31:57', '2026-09-28 02:31:57'),
(3, 'GBP', 'UK Pound', 1, 0, '2026-09-28 02:32:57', '2026-09-28 02:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `currency_listings`
--

CREATE TABLE `currency_listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'USD',
  `rate` decimal(15,4) NOT NULL,
  `amount_available` decimal(15,2) NOT NULL,
  `amount_reserved` decimal(15,2) NOT NULL DEFAULT 0.00,
  `amount_sold` decimal(15,2) NOT NULL DEFAULT 0.00,
  `min_order` decimal(15,2) DEFAULT NULL,
  `max_order` decimal(15,2) DEFAULT NULL,
  `delivery_note` text DEFAULT NULL,
  `status` enum('active','paused','closed') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency_listings`
--

INSERT INTO `currency_listings` (`id`, `user_id`, `currency`, `rate`, `amount_available`, `amount_reserved`, `amount_sold`, `min_order`, `max_order`, `delivery_note`, `status`, `created_at`, `updated_at`) VALUES
(1, 16, 'USD', 125.0000, 100.00, 17.00, 2.00, 2.00, 100.00, 'rocket send money. 018123454678', 'active', '2026-09-22 03:33:15', '2026-10-04 01:27:23'),
(2, 14, 'USD', 125.5000, 500.00, 50.00, 0.00, 2.00, 100.00, NULL, 'active', '2026-10-04 01:26:47', '2026-10-04 01:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `currency_orders`
--

CREATE TABLE `currency_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(10) NOT NULL,
  `currency_amount` decimal(15,2) NOT NULL,
  `rate` decimal(15,4) NOT NULL,
  `total_bdt` decimal(15,2) NOT NULL,
  `receiving_details` text DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_reference` varchar(191) DEFAULT NULL,
  `escrow_hold_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('awaiting_payment','pending','completed','rejected') NOT NULL DEFAULT 'awaiting_payment',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seller_status` enum('pending','released','rejected') NOT NULL DEFAULT 'pending',
  `seller_note` text DEFAULT NULL,
  `seller_acted_at` timestamp NULL DEFAULT NULL,
  `buyer_confirmed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency_orders`
--

INSERT INTO `currency_orders` (`id`, `listing_id`, `buyer_id`, `seller_id`, `currency`, `currency_amount`, `rate`, `total_bdt`, `receiving_details`, `payment_method_id`, `payment_reference`, `escrow_hold_id`, `status`, `created_at`, `updated_at`, `seller_status`, `seller_note`, `seller_acted_at`, `buyer_confirmed_at`) VALUES
(1, 1, 17, 16, 'USD', 2.00, 125.0000, 250.00, NULL, NULL, NULL, NULL, 'awaiting_payment', '2026-09-22 15:43:56', '2026-09-22 15:43:56', 'pending', NULL, NULL, NULL),
(2, 1, 16, 16, 'USD', 2.00, 125.0000, 250.00, NULL, NULL, NULL, NULL, 'awaiting_payment', '2026-09-26 02:39:41', '2026-09-26 02:39:41', 'pending', NULL, NULL, NULL),
(3, 1, 17, 16, 'USD', 2.00, 125.0000, 250.00, 'sojeebbackup@gmail.com\r\nPersonal PayPal account', 1, 'GI47SF64L09', 1, 'completed', '2026-09-28 01:09:53', '2026-09-28 01:15:04', 'pending', NULL, NULL, NULL),
(4, 1, 17, 16, 'USD', 3.50, 125.0000, 437.50, 'sojeebbackup@gmail.com \r\nPayPal personal', 1, 'AT47SF64L46', 2, 'pending', '2026-09-28 01:18:47', '2026-10-04 01:14:32', 'released', NULL, '2026-10-04 01:14:32', NULL),
(5, 1, 14, 16, 'USD', 5.00, 125.0000, 625.00, 'send my paypal account: abc@gmail.com', 1, 'KI09U3I76', 3, 'pending', '2026-10-04 01:03:51', '2026-10-04 01:15:25', 'released', NULL, '2026-10-04 01:13:45', '2026-10-04 01:15:25'),
(6, 1, 14, 16, 'USD', 4.50, 125.0000, 562.50, 'my personal nsave account email : abc@gmail.com', 1, 'LY02U3I47', 5, 'pending', '2026-10-04 01:27:23', '2026-10-04 01:41:02', 'released', NULL, '2026-10-04 01:41:02', NULL),
(7, 2, 16, 14, 'USD', 50.00, 125.5000, 6275.00, 'my personal wise account email is : earnstationme1@gmail.com', 1, 'HE26U3I10', 6, 'pending', '2026-10-04 01:29:18', '2026-10-04 01:30:35', 'pending', NULL, NULL, NULL),
(8, 2, 17, 14, 'USD', 39.00, 125.5000, 4894.50, 'This my personal PayPal account email: emailsojeeb@gmail.com', 1, 'JE00F2L05', 7, 'rejected', '2026-10-04 01:33:50', '2026-10-04 01:39:53', 'rejected', 'dont send money in your account pleace check in your account then try request again', '2026-10-04 01:37:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fund_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `donor_name` varchar(191) DEFAULT NULL,
  `donor_mobile` varchar(191) DEFAULT NULL,
  `donor_email` varchar(191) DEFAULT NULL,
  `amount` decimal(14,2) NOT NULL,
  `reference` varchar(191) NOT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `manual_reference` varchar(191) DEFAULT NULL,
  `status` enum('pending','completed','failed','cancelled') NOT NULL DEFAULT 'pending',
  `gateway_response` text DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `fund_id`, `payment_method_id`, `user_id`, `donor_name`, `donor_mobile`, `donor_email`, `amount`, `reference`, `transaction_id`, `manual_reference`, `status`, `gateway_response`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'sojeeb', '01770166682', 'sojeebbackup@gmail.com', 1000.00, 'DON-POJCJM31OG', NULL, 'Gdtf53ftfT64', 'failed', NULL, NULL, '2026-09-05 00:42:09', '2026-09-05 02:38:44'),
(2, 1, 1, NULL, 'backup', '01712345678', 'earnstationme1@gmail.com', 2000.00, 'DON-VVFG22KDDU', 'R45TH4KL5', 'R45TH4KL5', 'completed', NULL, '2026-09-05 00:49:15', '2026-09-05 00:47:56', '2026-09-05 00:49:15'),
(3, 1, 1, NULL, 'সজীব', '01876101515', 'emailsojeeb@gmail.com', 5000.00, 'DON-SOOUFBHFV4', 'TR23G5L7', 'TR23G5L7', 'completed', NULL, '2026-09-05 00:56:18', '2026-09-05 00:54:04', '2026-09-05 00:56:18'),
(4, 2, 1, 17, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 2000.00, 'DON-LUHTX1VZXA', 'TR24G5L8', 'TR24G5L8', 'completed', NULL, '2026-09-05 02:37:39', '2026-09-05 02:35:56', '2026-09-05 02:37:39'),
(5, 2, 1, NULL, 'backup', '01770166682', 'sojeebbackup@gmail.com', 1200.00, 'DON-ODCHKDGMF5', 'JI25TH4KM0', 'JI25TH4KM0', 'completed', NULL, '2026-09-05 16:47:47', '2026-09-05 16:41:21', '2026-09-05 16:47:47'),
(6, 1, 1, NULL, 'Sojeeb', '01876101515', 'emailsojeeb@gmail.com', 100.00, 'DON-LHRX8GLYHC', NULL, 'KJ57KD6Y68', 'pending', NULL, NULL, '2026-09-05 19:48:54', '2026-09-05 20:02:32'),
(7, 2, 1, NULL, 'earnstationme1', '01812345678', 'earnstationme1@gmail.com', 500.00, 'DON-PQAEMKOQZN', NULL, NULL, 'pending', NULL, NULL, '2026-09-06 02:44:06', '2026-09-06 02:44:06'),
(8, 1, 1, NULL, 'Sojeeb', '01876101515', 'emailsojeeb@gmail.com', 1500.00, 'DON-BN0AQCZHFA', NULL, NULL, 'pending', NULL, NULL, '2026-09-06 03:33:57', '2026-09-06 03:33:57'),
(9, 1, 1, 1, 'super_admin_httsys', '+8801876101515', 'httechsystem@gmail.com', 5000.00, 'DON-XXDI9GPAAQ', NULL, NULL, 'pending', NULL, NULL, '2026-09-06 21:07:52', '2026-09-06 21:07:52'),
(10, 1, 1, 17, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 500.00, 'DON-BAPIA2MBHT', NULL, NULL, 'pending', NULL, NULL, '2026-09-08 03:15:38', '2026-09-08 03:15:38'),
(11, 2, 1, NULL, 'backup', '01770166682', 'sojeebbackup@gmail.com', 1000.00, 'DON-XLC66WO8I6', NULL, NULL, 'pending', NULL, NULL, '2026-09-08 23:51:34', '2026-09-08 23:51:34'),
(12, 1, 1, 16, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 500.00, 'DON-ADA2QGPZID', NULL, 'KI28TH4KM7', 'pending', NULL, NULL, '2026-09-11 02:17:44', '2026-09-11 02:18:18'),
(13, 2, 1, 17, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 2000.00, 'DON-K4THLXSVYT', NULL, NULL, 'pending', NULL, NULL, '2026-09-26 04:20:08', '2026-09-26 04:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `escrow_holds`
--

CREATE TABLE `escrow_holds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payer_id` bigint(20) UNSIGNED NOT NULL,
  `payee_id` bigint(20) UNSIGNED NOT NULL,
  `listing_type` varchar(40) DEFAULT NULL,
  `listing_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `fee_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `payout_amount` decimal(15,2) NOT NULL,
  `payment_method` varchar(60) DEFAULT NULL,
  `payment_reference` varchar(191) DEFAULT NULL,
  `status` enum('held','released','rejected') NOT NULL DEFAULT 'held',
  `admin_note` text DEFAULT NULL,
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `escrow_holds`
--

INSERT INTO `escrow_holds` (`id`, `payer_id`, `payee_id`, `listing_type`, `listing_id`, `amount`, `fee_amount`, `payout_amount`, `payment_method`, `payment_reference`, `status`, `admin_note`, `reviewed_by`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(1, 17, 16, 'currency_exchange', 3, 250.00, 5.00, 245.00, 'bkash', 'GI47SF64L09', 'released', NULL, 1, '2026-09-28 01:15:04', '2026-09-28 01:11:39', '2026-09-28 01:15:04'),
(2, 17, 16, 'currency_exchange', 4, 437.50, 8.75, 428.75, 'bkash', 'AT47SF64L46', 'held', NULL, NULL, NULL, '2026-09-28 01:19:32', '2026-09-28 01:19:32'),
(3, 14, 16, 'currency_exchange', 5, 625.00, 12.50, 612.50, 'bkash', 'KI09U3I76', 'held', NULL, NULL, NULL, '2026-10-04 01:05:20', '2026-10-04 01:05:20'),
(4, 14, 16, 'marketplace', 4, 500.00, 10.00, 490.00, 'bkash', 'PL09U3I02', 'held', NULL, NULL, NULL, '2026-10-04 01:18:33', '2026-10-04 01:18:33'),
(5, 14, 16, 'currency_exchange', 6, 562.50, 11.25, 551.25, 'bkash', 'LY02U3I47', 'held', NULL, NULL, NULL, '2026-10-04 01:28:23', '2026-10-04 01:28:23'),
(6, 16, 14, 'currency_exchange', 7, 6275.00, 125.50, 6149.50, 'bkash', 'HE26U3I10', 'held', NULL, NULL, NULL, '2026-10-04 01:30:35', '2026-10-04 01:30:35'),
(7, 17, 14, 'currency_exchange', 8, 4894.50, 97.89, 4796.61, 'bkash', 'JE00F2L05', 'rejected', NULL, 1, '2026-10-04 01:39:53', '2026-10-04 01:34:52', '2026-10-04 01:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_settings`
--

CREATE TABLE `fee_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_type` varchar(60) NOT NULL,
  `fixed_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `percent_fee` decimal(5,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_settings`
--

INSERT INTO `fee_settings` (`id`, `service_type`, `fixed_fee`, `percent_fee`, `created_at`, `updated_at`) VALUES
(1, 'currency_exchange', 0.00, 2.00, '2026-09-22 03:29:34', '2026-09-22 03:40:23'),
(2, 'marketplace', 0.00, 2.00, '2026-09-22 03:29:34', '2026-09-22 03:40:23'),
(3, 'auction', 0.00, 3.50, '2026-09-22 03:29:34', '2026-09-22 03:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE `funds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `short_description` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `target_amount` decimal(14,2) DEFAULT NULL,
  `collected_amount` decimal(14,2) NOT NULL DEFAULT 0.00,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `language_id`, `title`, `slug`, `short_description`, `description`, `photo_id`, `target_amount`, `collected_amount`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sadaqah Jariyah Fund', 'Sadaqah-Jariyah-Fund', 'Sadaqah Jariyah Fund', 'Sadaqah Jariyah Fund', 277, 150000.00, 7000.00, 1, 0, '2026-09-05 00:24:42', '2026-09-05 16:49:45'),
(2, 2, 'সাদকাহ জারিয়াহ তহবিল', 'সদকহ-জরযহ-তহবল', 'সাদকাহ জারিয়াহ তহবিল', 'সাদকাহ জারিয়াহ তহবিল', 276, 550000.00, 3200.00, 1, 0, '2026-09-05 02:26:06', '2026-09-05 16:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `game_ads`
--

CREATE TABLE `game_ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `ad_type` varchar(20) NOT NULL DEFAULT 'link',
  `link` text DEFAULT NULL,
  `image_url` text DEFAULT NULL,
  `code` longtext DEFAULT NULL,
  `duration` smallint(5) UNSIGNED NOT NULL DEFAULT 30,
  `max_show` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `shown_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_ads`
--

INSERT INTO `game_ads` (`id`, `title`, `ad_type`, `link`, `image_url`, `code`, `duration`, `max_show`, `shown_count`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'HT Tech system', 'link', 'https://httsys.com/', NULL, NULL, 5, 60, 30, 1, '2026-09-20 02:41:35', '2026-09-22 23:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `game_plays`
--

CREATE TABLE `game_plays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `game_key` varchar(50) NOT NULL,
  `ad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `choice` varchar(10) DEFAULT NULL,
  `is_win` tinyint(1) NOT NULL DEFAULT 0,
  `outcome` varchar(10) DEFAULT NULL,
  `ad_duration` smallint(5) UNSIGNED NOT NULL DEFAULT 30,
  `math_a` tinyint(3) UNSIGNED DEFAULT NULL,
  `math_b` tinyint(3) UNSIGNED DEFAULT NULL,
  `math_attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `ad_loaded_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `points_awarded` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ad_progress` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `stake` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `direction` varchar(10) DEFAULT NULL,
  `trade_seconds` smallint(5) UNSIGNED DEFAULT NULL,
  `points_change` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_plays`
--

INSERT INTO `game_plays` (`id`, `user_id`, `game_key`, `ad_id`, `choice`, `is_win`, `outcome`, `ad_duration`, `math_a`, `math_b`, `math_attempts`, `ad_loaded_at`, `completed_at`, `status`, `points_awarded`, `ip_address`, `created_at`, `updated_at`, `ad_progress`, `stake`, `direction`, `trade_seconds`, `points_change`) VALUES
(1, 16, 'spin_wheel', 1, NULL, 1, NULL, 30, 7, 4, 1, '2026-09-20 02:43:40', '2026-09-20 02:44:29', 'completed', 1, '103.117.193.227', '2026-09-20 02:43:39', '2026-09-20 02:44:29', 0, 0, NULL, NULL, 1),
(2, 16, 'flip_coin', 1, 'heads', 1, 'heads', 30, 7, 7, 0, '2026-09-20 02:45:15', '2026-09-20 02:45:53', 'completed', 1, '103.117.193.227', '2026-09-20 02:45:14', '2026-09-20 02:45:53', 0, 0, NULL, NULL, 1),
(3, 16, 'flip_coin', 1, 'tails', 0, 'heads', 30, 7, 12, 0, '2026-09-20 02:46:58', NULL, 'pending', 0, '103.117.193.227', '2026-09-20 02:46:57', '2026-09-20 02:47:28', 0, 0, NULL, NULL, 0),
(4, 16, 'spin_wheel', 1, NULL, 0, NULL, 30, 15, 12, 0, '2026-09-20 03:06:00', '2026-09-20 03:06:57', 'completed', 0, '103.117.193.227', '2026-09-20 03:05:59', '2026-09-20 03:06:57', 30, 0, NULL, NULL, 0),
(5, 16, 'flip_coin', 1, 'tails', 1, 'tails', 30, 7, 15, 1, '2026-09-20 03:07:19', '2026-09-20 03:08:13', 'completed', 1, '103.117.193.227', '2026-09-20 03:07:18', '2026-09-20 03:08:13', 30, 0, NULL, NULL, 1),
(6, 17, 'spin_wheel', 1, NULL, 1, NULL, 30, 4, 3, 0, '2026-09-20 03:38:57', '2026-09-20 03:39:52', 'completed', 1, '103.117.193.227', '2026-09-20 03:38:56', '2026-09-20 03:39:52', 30, 0, NULL, NULL, 1),
(7, 17, 'flip_coin', 1, 'heads', 1, 'heads', 30, 10, 14, 0, '2026-09-20 03:40:28', '2026-09-20 03:41:03', 'completed', 1, '103.117.193.227', '2026-09-20 03:40:27', '2026-09-20 03:41:03', 30, 0, NULL, NULL, 1),
(8, 16, 'spin_wheel', 1, NULL, 1, NULL, 10, 12, 3, 0, '2026-09-22 02:03:53', '2026-09-22 02:04:11', 'completed', 1, '103.117.193.227', '2026-09-22 02:03:52', '2026-09-22 02:04:11', 10, 0, NULL, NULL, 1),
(9, 16, 'three_numbers', 1, NULL, 0, '000', 10, 6, 12, 0, '2026-09-22 02:19:16', '2026-09-22 02:19:32', 'completed', 0, '103.117.193.227', '2026-09-22 02:19:15', '2026-09-22 02:19:32', 10, 0, NULL, NULL, 0),
(10, 16, 'three_numbers', 1, NULL, 0, '000', 10, 14, 10, 0, '2026-09-22 02:19:44', '2026-09-22 02:19:59', 'completed', 0, '103.117.193.227', '2026-09-22 02:19:43', '2026-09-22 02:19:59', 10, 0, NULL, NULL, 0),
(11, 16, 'three_numbers', 1, NULL, 1, '005', 10, 4, 15, 0, '2026-09-22 02:20:12', '2026-09-22 02:21:04', 'completed', 5, '103.117.193.227', '2026-09-22 02:20:11', '2026-09-22 02:21:04', 10, 0, NULL, NULL, 5),
(12, 16, 'up_down', 1, NULL, 0, 'down', 5, 9, 10, 0, '2026-09-22 02:22:05', '2026-09-22 02:22:17', 'completed', 0, '103.117.193.227', '2026-09-22 02:22:05', '2026-09-22 02:22:17', 5, 1, 'up', 30, -1),
(13, 16, 'up_down', 1, NULL, 0, 'up', 5, 2, 15, 1, '2026-09-22 02:23:32', '2026-09-22 02:23:47', 'completed', 0, '103.117.193.227', '2026-09-22 02:23:31', '2026-09-22 02:23:47', 5, 1, 'down', 30, -1),
(14, 16, 'up_down', 1, NULL, 1, 'up', 5, 6, 6, 0, '2026-09-22 02:24:26', '2026-09-22 02:24:34', 'completed', 1, '103.117.193.227', '2026-09-22 02:24:25', '2026-09-22 02:24:34', 5, 1, 'up', 30, 1),
(15, 16, 'three_numbers', 1, NULL, 1, '005', 5, 2, 2, 0, '2026-09-22 02:27:09', '2026-09-22 02:27:47', 'completed', 5, '103.117.193.227', '2026-09-22 02:27:08', '2026-09-22 02:27:47', 5, 0, NULL, NULL, 5),
(16, 16, 'spin_wheel', 1, NULL, 1, NULL, 5, 13, 14, 1, '2026-09-22 02:58:18', '2026-09-22 02:58:35', 'completed', 1, '103.117.193.227', '2026-09-22 02:58:17', '2026-09-22 02:58:35', 5, 0, NULL, NULL, 1),
(17, 16, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 02:59:07', 'completed', 1, '103.117.193.227', '2026-09-22 02:59:07', '2026-09-22 02:59:07', 0, 1, 'up', 10, 1),
(18, 16, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 02:59:30', 'completed', 5, '103.117.193.227', '2026-09-22 02:59:30', '2026-09-22 02:59:30', 0, 5, 'up', 30, 5),
(19, 17, 'spin_wheel', 1, NULL, 1, NULL, 5, 14, 10, 0, '2026-09-22 03:49:22', '2026-09-22 03:49:34', 'completed', 1, '103.117.193.227', '2026-09-22 03:49:21', '2026-09-22 03:49:34', 5, 0, NULL, NULL, 1),
(20, 17, 'flip_coin', 1, 'tails', 0, 'heads', 5, 4, 14, 0, '2026-09-22 03:50:05', '2026-09-22 03:50:18', 'completed', 0, '103.117.193.227', '2026-09-22 03:50:05', '2026-09-22 03:50:18', 5, 0, NULL, NULL, 0),
(21, 17, 'three_numbers', 1, NULL, 1, '010', 5, 15, 5, 0, '2026-09-22 03:50:44', '2026-09-22 03:50:55', 'completed', 10, '103.117.193.227', '2026-09-22 03:50:43', '2026-09-22 03:50:55', 5, 0, NULL, NULL, 10),
(22, 17, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 03:51:36', 'completed', 1, '103.117.193.227', '2026-09-22 03:51:36', '2026-09-22 03:51:36', 0, 1, 'up', 30, 1),
(23, 17, 'up_down', NULL, NULL, 0, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 03:53:07', 'completed', 0, '103.117.193.227', '2026-09-22 03:53:07', '2026-09-22 03:53:07', 0, 1, 'down', 30, -1),
(24, 17, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 03:53:55', 'completed', 10, '103.117.193.227', '2026-09-22 03:53:55', '2026-09-22 03:53:55', 0, 10, 'up', 10, 10),
(25, 17, 'up_down', NULL, NULL, 1, 'down', 0, NULL, NULL, 0, NULL, '2026-09-22 03:56:13', 'completed', 1, '103.117.193.227', '2026-09-22 03:56:13', '2026-09-22 03:56:13', 0, 1, 'down', 10, 1),
(26, 17, 'up_down', NULL, NULL, 1, 'down', 0, NULL, NULL, 0, NULL, '2026-09-22 03:56:34', 'completed', 1, '103.117.193.227', '2026-09-22 03:56:34', '2026-09-22 03:56:34', 0, 1, 'down', 30, 1),
(27, 17, 'up_down', NULL, NULL, 1, 'down', 0, NULL, NULL, 0, NULL, '2026-09-22 15:27:41', 'completed', 5, '37.111.233.182', '2026-09-22 15:27:41', '2026-09-22 15:27:41', 0, 5, 'down', 10, 5),
(28, 17, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 15:28:03', 'completed', 5, '37.111.233.182', '2026-09-22 15:28:03', '2026-09-22 15:28:03', 0, 5, 'up', 30, 5),
(29, 17, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 15:32:34', 'completed', 1, '37.111.233.182', '2026-09-22 15:32:34', '2026-09-22 15:32:34', 0, 1, 'up', 30, 1),
(30, 17, 'spin_wheel', 1, NULL, 1, NULL, 5, 15, 12, 0, '2026-09-22 16:12:58', '2026-09-22 16:13:09', 'completed', 1, '37.111.233.182', '2026-09-22 16:12:56', '2026-09-22 16:13:09', 5, 0, NULL, NULL, 1),
(31, 19, 'three_numbers', 1, NULL, 0, '000', 5, 2, 6, 0, '2026-09-22 20:36:26', '2026-09-22 20:36:41', 'completed', 0, '103.117.193.227', '2026-09-22 20:36:25', '2026-09-22 20:36:41', 5, 0, NULL, NULL, 0),
(32, 19, 'three_numbers', 1, NULL, 0, '000', 5, 3, 13, 0, '2026-09-22 20:36:53', '2026-09-22 20:37:03', 'completed', 0, '103.117.193.227', '2026-09-22 20:36:51', '2026-09-22 20:37:03', 5, 0, NULL, NULL, 0),
(33, 19, 'three_numbers', 1, NULL, 0, '000', 5, 4, 13, 0, '2026-09-22 20:37:31', '2026-09-22 20:37:44', 'completed', 0, '103.117.193.227', '2026-09-22 20:37:30', '2026-09-22 20:37:44', 5, 0, NULL, NULL, 0),
(34, 19, 'spin_wheel', 1, NULL, 1, NULL, 5, 15, 10, 0, '2026-09-22 20:38:11', '2026-09-22 20:38:22', 'completed', 1, '103.117.193.227', '2026-09-22 20:38:10', '2026-09-22 20:38:22', 5, 0, NULL, NULL, 1),
(35, 19, 'spin_wheel', 1, NULL, 0, NULL, 5, 9, 5, 0, '2026-09-22 20:38:36', '2026-09-22 20:38:53', 'completed', 0, '103.117.193.227', '2026-09-22 20:38:35', '2026-09-22 20:38:53', 5, 0, NULL, NULL, 0),
(36, 19, 'spin_wheel', 1, NULL, 0, NULL, 5, 14, 5, 0, '2026-09-22 20:39:09', '2026-09-22 20:39:19', 'completed', 0, '103.117.193.227', '2026-09-22 20:39:08', '2026-09-22 20:39:19', 5, 0, NULL, NULL, 0),
(37, 19, 'spin_wheel', 1, NULL, 0, NULL, 5, 10, 5, 0, '2026-09-22 20:39:28', '2026-09-22 20:39:37', 'completed', 0, '103.117.193.227', '2026-09-22 20:39:27', '2026-09-22 20:39:37', 5, 0, NULL, NULL, 0),
(38, 19, 'spin_wheel', 1, NULL, 1, NULL, 5, 9, 9, 0, '2026-09-22 20:39:47', '2026-09-22 20:39:56', 'completed', 1, '103.117.193.227', '2026-09-22 20:39:46', '2026-09-22 20:39:56', 5, 0, NULL, NULL, 1),
(39, 19, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 20:40:37', 'completed', 1, '103.117.193.227', '2026-09-22 20:40:37', '2026-09-22 20:40:37', 0, 1, 'up', 30, 1),
(40, 19, 'up_down', NULL, NULL, 1, 'down', 0, NULL, NULL, 0, NULL, '2026-09-22 20:41:29', 'completed', 1, '103.117.193.227', '2026-09-22 20:41:29', '2026-09-22 20:41:29', 0, 1, 'down', 10, 1),
(41, 19, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 20:41:46', 'completed', 1, '103.117.193.227', '2026-09-22 20:41:46', '2026-09-22 20:41:46', 0, 1, 'up', 30, 1),
(42, 19, 'up_down', NULL, NULL, 1, 'down', 0, NULL, NULL, 0, NULL, '2026-09-22 20:42:41', 'completed', 1, '103.117.193.227', '2026-09-22 20:42:41', '2026-09-22 20:42:41', 0, 1, 'down', 10, 1),
(43, 16, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 23:05:44', 'completed', 10, '103.117.193.227', '2026-09-22 23:05:44', '2026-09-22 23:05:44', 0, 10, 'up', 10, 10),
(44, 16, 'up_down', NULL, NULL, 1, 'down', 0, NULL, NULL, 0, NULL, '2026-09-22 23:06:07', 'completed', 30, '103.117.193.227', '2026-09-22 23:06:07', '2026-09-22 23:06:07', 0, 30, 'down', 30, 30),
(45, 16, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 23:08:59', 'completed', 54, '103.117.193.227', '2026-09-22 23:08:59', '2026-09-22 23:08:59', 0, 60, 'up', 10, 54),
(46, 16, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-22 23:09:40', 'completed', 9, '103.117.193.227', '2026-09-22 23:09:40', '2026-09-22 23:09:40', 0, 10, 'up', 30, 9),
(47, 16, 'spin_wheel', 1, NULL, 0, NULL, 5, 8, 5, 0, '2026-09-22 23:10:57', '2026-09-22 23:11:14', 'completed', 0, '103.117.193.227', '2026-09-22 23:10:56', '2026-09-22 23:11:14', 5, 0, NULL, NULL, 0),
(48, 16, 'spin_wheel', 1, NULL, 1, NULL, 5, 7, 11, 0, '2026-09-22 23:11:22', '2026-09-22 23:11:32', 'completed', 1, '103.117.193.227', '2026-09-22 23:11:21', '2026-09-22 23:11:32', 5, 0, NULL, NULL, 1),
(49, 16, 'spin_wheel', NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '2026-09-22 23:12:14', 'completed', 0, '103.117.193.227', '2026-09-22 23:12:14', '2026-09-22 23:12:14', 0, 0, NULL, NULL, 0),
(50, 16, 'spin_wheel', NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '2026-09-22 23:12:22', 'completed', 0, '103.117.193.227', '2026-09-22 23:12:22', '2026-09-22 23:12:22', 0, 0, NULL, NULL, 0),
(51, 16, 'spin_wheel', NULL, NULL, 1, NULL, 0, NULL, NULL, 0, NULL, '2026-09-22 23:12:29', 'completed', 1, '103.117.193.227', '2026-09-22 23:12:29', '2026-09-22 23:12:29', 0, 0, NULL, NULL, 1),
(52, 16, 'spin_wheel', NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '2026-09-22 23:12:37', 'completed', 0, '103.117.193.227', '2026-09-22 23:12:37', '2026-09-22 23:12:37', 0, 0, NULL, NULL, 0),
(53, 16, 'spin_wheel', NULL, NULL, 1, NULL, 0, NULL, NULL, 0, NULL, '2026-09-22 23:12:46', 'completed', 1, '103.117.193.227', '2026-09-22 23:12:46', '2026-09-22 23:12:46', 0, 0, NULL, NULL, 1),
(54, 16, 'flip_coin', NULL, 'tails', 0, 'heads', 0, NULL, NULL, 0, NULL, '2026-09-22 23:13:00', 'completed', 0, '103.117.193.227', '2026-09-22 23:13:00', '2026-09-22 23:13:00', 0, 0, NULL, NULL, 0),
(55, 16, 'flip_coin', NULL, 'heads', 0, 'tails', 0, NULL, NULL, 0, NULL, '2026-09-22 23:13:05', 'completed', 0, '103.117.193.227', '2026-09-22 23:13:05', '2026-09-22 23:13:05', 0, 0, NULL, NULL, 0),
(56, 16, 'flip_coin', NULL, 'tails', 0, 'heads', 0, NULL, NULL, 0, NULL, '2026-09-22 23:13:12', 'completed', 0, '103.117.193.227', '2026-09-22 23:13:12', '2026-09-22 23:13:12', 0, 0, NULL, NULL, 0),
(57, 16, 'flip_coin', NULL, 'heads', 1, 'heads', 0, NULL, NULL, 0, NULL, '2026-09-22 23:13:18', 'completed', 1, '103.117.193.227', '2026-09-22 23:13:18', '2026-09-22 23:13:18', 0, 0, NULL, NULL, 1),
(58, 16, 'flip_coin', NULL, 'tails', 1, 'tails', 0, NULL, NULL, 0, NULL, '2026-09-22 23:13:24', 'completed', 1, '103.117.193.227', '2026-09-22 23:13:24', '2026-09-22 23:13:24', 0, 0, NULL, NULL, 1),
(59, 16, 'flip_coin', NULL, 'heads', 0, 'tails', 0, NULL, NULL, 0, NULL, '2026-09-22 23:13:30', 'completed', 0, '103.117.193.227', '2026-09-22 23:13:30', '2026-09-22 23:13:30', 0, 0, NULL, NULL, 0),
(60, 16, 'three_numbers', NULL, NULL, 1, '002', 0, NULL, NULL, 0, NULL, '2026-09-22 23:13:54', 'completed', 2, '103.117.193.227', '2026-09-22 23:13:54', '2026-09-22 23:13:54', 0, 0, NULL, NULL, 2),
(61, 16, 'three_numbers', NULL, NULL, 0, '000', 0, NULL, NULL, 0, NULL, '2026-09-22 23:14:02', 'completed', 0, '103.117.193.227', '2026-09-22 23:14:02', '2026-09-22 23:14:02', 0, 0, NULL, NULL, 0),
(62, 16, 'three_numbers', NULL, NULL, 1, '020', 0, NULL, NULL, 0, NULL, '2026-09-22 23:14:09', 'completed', 20, '103.117.193.227', '2026-09-22 23:14:09', '2026-09-22 23:14:09', 0, 0, NULL, NULL, 20),
(63, 16, 'three_numbers', NULL, NULL, 1, '005', 0, NULL, NULL, 0, NULL, '2026-09-22 23:14:16', 'completed', 5, '103.117.193.227', '2026-09-22 23:14:16', '2026-09-22 23:14:16', 0, 0, NULL, NULL, 5),
(64, 16, 'three_numbers', NULL, NULL, 1, '010', 0, NULL, NULL, 0, NULL, '2026-09-22 23:14:23', 'completed', 10, '103.117.193.227', '2026-09-22 23:14:23', '2026-09-22 23:14:23', 0, 0, NULL, NULL, 10),
(65, 16, 'three_numbers', NULL, NULL, 1, '005', 0, NULL, NULL, 0, NULL, '2026-09-22 23:14:31', 'completed', 5, '103.117.193.227', '2026-09-22 23:14:31', '2026-09-22 23:14:31', 0, 0, NULL, NULL, 5),
(66, 16, 'three_numbers', NULL, NULL, 0, '000', 0, NULL, NULL, 0, NULL, '2026-09-22 23:14:38', 'completed', 0, '103.117.193.227', '2026-09-22 23:14:38', '2026-09-22 23:14:38', 0, 0, NULL, NULL, 0),
(67, 16, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-26 02:25:11', 'completed', 1, '103.117.193.227', '2026-09-26 02:25:11', '2026-09-26 02:25:11', 0, 1, 'up', 30, 1),
(68, 16, 'three_numbers', NULL, NULL, 1, '050', 0, NULL, NULL, 0, NULL, '2026-09-26 02:27:00', 'completed', 50, '103.117.193.227', '2026-09-26 02:27:00', '2026-09-26 02:27:00', 0, 0, NULL, NULL, 50),
(69, 16, 'three_numbers', NULL, NULL, 0, '000', 0, NULL, NULL, 0, NULL, '2026-09-26 02:27:23', 'completed', 0, '103.117.193.227', '2026-09-26 02:27:23', '2026-09-26 02:27:23', 0, 0, NULL, NULL, 0),
(70, 16, 'three_numbers', NULL, NULL, 1, '001', 0, NULL, NULL, 0, NULL, '2026-09-26 02:27:30', 'completed', 1, '103.117.193.227', '2026-09-26 02:27:30', '2026-09-26 02:27:30', 0, 0, NULL, NULL, 1),
(71, 16, 'three_numbers', NULL, NULL, 1, '001', 0, NULL, NULL, 0, NULL, '2026-09-26 02:27:40', 'completed', 1, '103.117.193.227', '2026-09-26 02:27:40', '2026-09-26 02:27:40', 0, 0, NULL, NULL, 1),
(72, 16, 'flip_coin', NULL, 'tails', 1, 'tails', 0, NULL, NULL, 0, NULL, '2026-09-26 02:27:54', 'completed', 1, '103.117.193.227', '2026-09-26 02:27:54', '2026-09-26 02:27:54', 0, 0, NULL, NULL, 1),
(73, 16, 'flip_coin', NULL, 'heads', 1, 'heads', 0, NULL, NULL, 0, NULL, '2026-09-26 02:28:00', 'completed', 1, '103.117.193.227', '2026-09-26 02:28:00', '2026-09-26 02:28:00', 0, 0, NULL, NULL, 1),
(74, 16, 'flip_coin', NULL, 'tails', 0, 'heads', 0, NULL, NULL, 0, NULL, '2026-09-26 02:28:06', 'completed', 0, '103.117.193.227', '2026-09-26 02:28:06', '2026-09-26 02:28:06', 0, 0, NULL, NULL, 0),
(75, 16, 'spin_wheel', NULL, NULL, 1, NULL, 0, NULL, NULL, 0, NULL, '2026-09-26 02:28:17', 'completed', 1, '103.117.193.227', '2026-09-26 02:28:17', '2026-09-26 02:28:17', 0, 0, NULL, NULL, 1),
(76, 16, 'spin_wheel', NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '2026-09-26 02:28:25', 'completed', 0, '103.117.193.227', '2026-09-26 02:28:25', '2026-09-26 02:28:25', 0, 0, NULL, NULL, 0),
(77, 16, 'flip_coin', NULL, 'tails', 1, 'tails', 0, NULL, NULL, 0, NULL, '2026-09-26 02:30:54', 'completed', 1, '103.117.193.227', '2026-09-26 02:30:54', '2026-09-26 02:30:54', 0, 0, NULL, NULL, 1),
(78, 16, 'three_numbers', NULL, NULL, 0, '000', 0, NULL, NULL, 0, NULL, '2026-09-26 02:31:11', 'completed', 0, '103.117.193.227', '2026-09-26 02:31:11', '2026-09-26 02:31:11', 0, 0, NULL, NULL, 0),
(79, 17, 'three_numbers', NULL, NULL, 0, '000', 0, NULL, NULL, 0, NULL, '2026-09-26 04:18:47', 'completed', 0, '103.117.193.227', '2026-09-26 04:18:47', '2026-09-26 04:18:47', 0, 0, NULL, NULL, 0),
(80, 17, 'three_numbers', NULL, NULL, 1, '002', 0, NULL, NULL, 0, NULL, '2026-09-26 04:18:55', 'completed', 2, '103.117.193.227', '2026-09-26 04:18:55', '2026-09-26 04:18:55', 0, 0, NULL, NULL, 2),
(81, 17, 'three_numbers', NULL, NULL, 1, '001', 0, NULL, NULL, 0, NULL, '2026-09-26 04:19:01', 'completed', 1, '103.117.193.227', '2026-09-26 04:19:01', '2026-09-26 04:19:01', 0, 0, NULL, NULL, 1),
(82, 17, 'three_numbers', NULL, NULL, 0, '000', 0, NULL, NULL, 0, NULL, '2026-09-26 04:19:07', 'completed', 0, '103.117.193.227', '2026-09-26 04:19:07', '2026-09-26 04:19:07', 0, 0, NULL, NULL, 0),
(83, 17, 'three_numbers', NULL, NULL, 0, '000', 0, NULL, NULL, 0, NULL, '2026-09-26 04:19:14', 'completed', 0, '103.117.193.227', '2026-09-26 04:19:14', '2026-09-26 04:19:14', 0, 0, NULL, NULL, 0),
(84, 17, 'three_numbers', NULL, NULL, 1, '020', 0, NULL, NULL, 0, NULL, '2026-09-26 04:19:20', 'completed', 20, '103.117.193.227', '2026-09-26 04:19:20', '2026-09-26 04:19:20', 0, 0, NULL, NULL, 20),
(85, 17, 'three_numbers', NULL, NULL, 0, '000', 0, NULL, NULL, 0, NULL, '2026-09-26 04:19:31', 'completed', 0, '103.117.193.227', '2026-09-26 04:19:31', '2026-09-26 04:19:31', 0, 0, NULL, NULL, 0),
(86, 17, 'three_numbers', NULL, NULL, 1, '010', 0, NULL, NULL, 0, NULL, '2026-09-26 04:19:37', 'completed', 10, '103.117.193.227', '2026-09-26 04:19:37', '2026-09-26 04:19:37', 0, 0, NULL, NULL, 10),
(87, 17, 'up_down', NULL, NULL, 1, 'down', 0, NULL, NULL, 0, NULL, '2026-09-26 04:20:54', 'completed', 1, '103.117.193.227', '2026-09-26 04:20:54', '2026-09-26 04:20:54', 0, 1, 'down', 30, 1),
(88, 17, 'up_down', NULL, NULL, 1, 'down', 0, NULL, NULL, 0, NULL, '2026-09-26 04:21:35', 'completed', 1, '103.117.193.227', '2026-09-26 04:21:35', '2026-09-26 04:21:35', 0, 1, 'down', 30, 1),
(89, 16, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-09-30 03:07:32', 'completed', 1, '103.117.193.227', '2026-09-30 03:07:32', '2026-09-30 03:07:32', 0, 1, 'up', 30, 1),
(90, 16, 'spin_wheel', NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '2026-09-30 03:08:21', 'completed', 0, '103.117.193.227', '2026-09-30 03:08:21', '2026-09-30 03:08:21', 0, 0, NULL, NULL, 0),
(91, 16, 'flip_coin', NULL, 'tails', 1, 'tails', 0, NULL, NULL, 0, NULL, '2026-09-30 03:08:31', 'completed', 1, '103.117.193.227', '2026-09-30 03:08:31', '2026-09-30 03:08:31', 0, 0, NULL, NULL, 1),
(92, 16, 'three_numbers', NULL, NULL, 1, '001', 0, NULL, NULL, 0, NULL, '2026-09-30 03:08:41', 'completed', 1, '103.117.193.227', '2026-09-30 03:08:41', '2026-09-30 03:08:41', 0, 0, NULL, NULL, 1),
(93, 14, 'spin_wheel', NULL, NULL, 1, NULL, 0, NULL, NULL, 0, NULL, '2026-10-04 01:06:40', 'completed', 1, '103.117.193.227', '2026-10-04 01:06:40', '2026-10-04 01:06:40', 0, 0, NULL, NULL, 1),
(94, 14, 'spin_wheel', NULL, NULL, 1, NULL, 0, NULL, NULL, 0, NULL, '2026-10-04 01:06:48', 'completed', 1, '103.117.193.227', '2026-10-04 01:06:48', '2026-10-04 01:06:48', 0, 0, NULL, NULL, 1),
(95, 14, 'spin_wheel', NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, '2026-10-04 01:06:57', 'completed', 0, '103.117.193.227', '2026-10-04 01:06:57', '2026-10-04 01:06:57', 0, 0, NULL, NULL, 0),
(96, 14, 'flip_coin', NULL, 'tails', 1, 'tails', 0, NULL, NULL, 0, NULL, '2026-10-04 01:07:09', 'completed', 1, '103.117.193.227', '2026-10-04 01:07:09', '2026-10-04 01:07:09', 0, 0, NULL, NULL, 1),
(97, 14, 'flip_coin', NULL, 'heads', 1, 'heads', 0, NULL, NULL, 0, NULL, '2026-10-04 01:07:15', 'completed', 1, '103.117.193.227', '2026-10-04 01:07:15', '2026-10-04 01:07:15', 0, 0, NULL, NULL, 1),
(98, 14, 'flip_coin', NULL, 'tails', 0, 'heads', 0, NULL, NULL, 0, NULL, '2026-10-04 01:07:25', 'completed', 0, '103.117.193.227', '2026-10-04 01:07:25', '2026-10-04 01:07:25', 0, 0, NULL, NULL, 0),
(99, 14, 'three_numbers', NULL, NULL, 0, '000', 0, NULL, NULL, 0, NULL, '2026-10-04 01:07:34', 'completed', 0, '103.117.193.227', '2026-10-04 01:07:34', '2026-10-04 01:07:34', 0, 0, NULL, NULL, 0),
(100, 14, 'three_numbers', NULL, NULL, 1, '010', 0, NULL, NULL, 0, NULL, '2026-10-04 01:07:41', 'completed', 10, '103.117.193.227', '2026-10-04 01:07:41', '2026-10-04 01:07:41', 0, 0, NULL, NULL, 10),
(101, 14, 'three_numbers', NULL, NULL, 0, '000', 0, NULL, NULL, 0, NULL, '2026-10-04 01:07:49', 'completed', 0, '103.117.193.227', '2026-10-04 01:07:49', '2026-10-04 01:07:49', 0, 0, NULL, NULL, 0),
(102, 14, 'three_numbers', NULL, NULL, 1, '050', 0, NULL, NULL, 0, NULL, '2026-10-04 01:07:56', 'completed', 50, '103.117.193.227', '2026-10-04 01:07:56', '2026-10-04 01:07:56', 0, 0, NULL, NULL, 50),
(103, 14, 'three_numbers', NULL, NULL, 1, '005', 0, NULL, NULL, 0, NULL, '2026-10-04 01:08:03', 'completed', 5, '103.117.193.227', '2026-10-04 01:08:03', '2026-10-04 01:08:03', 0, 0, NULL, NULL, 5),
(104, 14, 'three_numbers', NULL, NULL, 1, '010', 0, NULL, NULL, 0, NULL, '2026-10-04 01:08:10', 'completed', 10, '103.117.193.227', '2026-10-04 01:08:10', '2026-10-04 01:08:10', 0, 0, NULL, NULL, 10),
(105, 14, 'three_numbers', NULL, NULL, 1, '050', 0, NULL, NULL, 0, NULL, '2026-10-04 01:08:19', 'completed', 50, '103.117.193.227', '2026-10-04 01:08:19', '2026-10-04 01:08:19', 0, 0, NULL, NULL, 50),
(106, 14, 'three_numbers', NULL, NULL, 1, '002', 0, NULL, NULL, 0, NULL, '2026-10-04 01:08:26', 'completed', 2, '103.117.193.227', '2026-10-04 01:08:26', '2026-10-04 01:08:26', 0, 0, NULL, NULL, 2),
(107, 14, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-10-04 01:08:38', 'completed', 1, '103.117.193.227', '2026-10-04 01:08:38', '2026-10-04 01:08:38', 0, 1, 'up', 30, 1),
(108, 14, 'up_down', NULL, NULL, 1, 'up', 0, NULL, NULL, 0, NULL, '2026-10-04 01:09:16', 'completed', 90, '103.117.193.227', '2026-10-04 01:09:16', '2026-10-04 01:09:16', 0, 100, 'up', 30, 90);

-- --------------------------------------------------------

--
-- Table structure for table `game_settings`
--

CREATE TABLE `game_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_key` varchar(50) NOT NULL,
  `name` varchar(191) NOT NULL,
  `win_percent` tinyint(3) UNSIGNED NOT NULL DEFAULT 30,
  `hourly_limit` int(10) UNSIGNED NOT NULL DEFAULT 10,
  `points_per_win` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `win_block` smallint(5) UNSIGNED NOT NULL DEFAULT 100,
  `options` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_settings`
--

INSERT INTO `game_settings` (`id`, `game_key`, `name`, `win_percent`, `hourly_limit`, `points_per_win`, `is_active`, `created_at`, `updated_at`, `win_block`, `options`) VALUES
(1, 'spin_wheel', 'Spin The Wheel', 50, 30, 1, 1, '2026-09-20 02:39:49', '2026-09-22 23:12:00', 100, '{\"show_ad\":false}'),
(2, 'flip_coin', 'Flip The Coin', 50, 30, 1, 1, '2026-09-20 02:39:49', '2026-09-22 23:12:00', 100, '{\"show_ad\":false}'),
(3, 'three_numbers', '3 Numbers', 50, 50, 1, 1, '2026-09-22 02:18:06', '2026-09-22 23:12:00', 100, '{\"prizes\":[1,2,5,10,20,50,100],\"show_ad\":false}'),
(4, 'up_down', 'Up or Down', 100, 50, 1, 1, '2026-09-22 02:18:06', '2026-09-22 23:07:21', 100, '{\"min_stake\":1,\"max_stake\":100,\"payout_percent\":90,\"show_ad\":false}');

-- --------------------------------------------------------

--
-- Table structure for table `header_footer_settings`
--

CREATE TABLE `header_footer_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(4) NOT NULL,
  `sidebar_title` varchar(191) DEFAULT NULL,
  `sidebar_title2` char(255) DEFAULT NULL,
  `sidebar_description` text DEFAULT NULL,
  `sidebar_description2` varchar(255) DEFAULT NULL,
  `sidebar_menu_description` text DEFAULT NULL,
  `typed_title` varchar(191) NOT NULL,
  `typed_text` text NOT NULL,
  `typed_buttontext` varchar(191) NOT NULL,
  `typed_buttonlink` varchar(191) NOT NULL,
  `footer_col1_subtitle` varchar(191) NOT NULL,
  `footer_col1_title` varchar(191) NOT NULL,
  `footer_col1_buttontext` varchar(191) NOT NULL,
  `footer_col1_buttonlink` varchar(191) NOT NULL,
  `footer_col2_title1` varchar(191) NOT NULL,
  `footer_col2_title2` text NOT NULL,
  `footer_col2_html1` text NOT NULL,
  `footer_col2_html2` text NOT NULL,
  `footer_copyright` text NOT NULL,
  `social_links` text DEFAULT NULL,
  `submenu-extra` text NOT NULL,
  `button_start_text` varchar(255) NOT NULL,
  `button_start_link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `typed_font_size` smallint(5) UNSIGNED DEFAULT NULL,
  `footer_col1_subtitle_size` smallint(5) UNSIGNED DEFAULT NULL,
  `footer_col1_title_size` smallint(5) UNSIGNED DEFAULT NULL,
  `footer_col2_title_size` smallint(5) UNSIGNED DEFAULT NULL,
  `footer_col2_text_size` smallint(5) UNSIGNED DEFAULT NULL,
  `footer_copyright_size` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `header_footer_settings`
--

INSERT INTO `header_footer_settings` (`id`, `language_id`, `sidebar_title`, `sidebar_title2`, `sidebar_description`, `sidebar_description2`, `sidebar_menu_description`, `typed_title`, `typed_text`, `typed_buttontext`, `typed_buttonlink`, `footer_col1_subtitle`, `footer_col1_title`, `footer_col1_buttontext`, `footer_col1_buttonlink`, `footer_col2_title1`, `footer_col2_title2`, `footer_col2_html1`, `footer_col2_html2`, `footer_copyright`, `social_links`, `submenu-extra`, `button_start_text`, `button_start_link`, `created_at`, `updated_at`, `typed_font_size`, `footer_col1_subtitle_size`, `footer_col1_title_size`, `footer_col2_title_size`, `footer_col2_text_size`, `footer_copyright_size`) VALUES
(1, 1, 'Shop', 'Login', 'https://test.httsys.com/shop', 'https://test.httsys.com/login', '<p>If you have any suggestion or any question?</p>\r\n<p><a class=\"btn btn-slider\" href=\"/contact\" target=\"_self\">Let\'s Talk</a></p>', 'Your valuable donation could be the last ray of hope for someone\'s survival.', 'Your valuable donation could be the last ray of hope for someone\'s survival.', 'Donate', 'https://test.httsys.com/donate', 'Give a great quote about playing mini-games.', 'Let\'s get to Games & earn point', 'Enter the game', 'https://test.httsys.com/mini-games', 'Quick Links', 'Say Hello', '<ul class=\"menu\">\r\n<li class=\"menu-item-footer\">\r\n<h2><span style=\"color: #ffffff;\"><strong><a style=\"color: #ffffff;\" href=\"/gdpr\">GDPR</a></strong></span></h2>\r\n</li>\r\n<li class=\"menu-item-footer\">\r\n<h2><span style=\"color: #ffffff;\"><strong><a style=\"color: #ffffff;\" href=\"/terms-conditions\">Terms and conditions</a></strong></span></h2>\r\n</li>\r\n<li class=\"menu-item-footer\">\r\n<h2><span style=\"color: #ffffff;\"><strong><a style=\"color: #ffffff;\" href=\"/privacy-policy\">Privacy Policy</a></strong></span></h2>\r\n</li>\r\n<li class=\"menu-item-footer\"><span style=\"color: #ecf0f1;\">HT Tech system is a trusted global software development and multiple business agency formed as a joint venture between USA and Bangladeshis entities.</span></li>\r\n</ul>', '<ul class=\"ft-link\">\r\n<li>\r\n<h2><span style=\"color: #ffffff;\"><strong><a style=\"color: #ffffff;\" href=\"mailto:httechsystem@gmail.com\">support@httsys.com</a></strong></span></h2>\r\n</li>\r\n<li>\r\n<h2><span style=\"color: #ffffff;\"><strong><a style=\"color: #ffffff;\" href=\"mailto:httechsystem@gmail.com\">httechsystem@gmail.com</a></strong></span></h2>\r\n</li>\r\n<li><span style=\"color: #ced4d9;\">4781 Valley Lane, Austin, Texas, United States America.</span></li>\r\n</ul>\r\n<div class=\"social-share-inner\">\r\n<ul class=\"social-share\">\r\n<li><a href=\"https://www.facebook.com/httechsystem\" target=\"_blank\" rel=\"noopener\"><em class=\"fab fa-facebook-f\"><strong>facebook</strong></em></a></li>\r\n<li><a href=\"https://twitter.com/httechsystem\" target=\"_blank\" rel=\"noopener\"><em class=\"fab fa-twitter\"><strong>twitter</strong></em></a></li>\r\n<li><a href=\"https://www.youtube.com/channel/UCOUudh7u6f8wVsfcyw4dHEw\" target=\"_blank\" rel=\"noopener\"><em class=\"fab fa-youtube\"><strong>youtube</strong></em></a></li>\r\n<li><em class=\"fab fa-pinterest\"><strong><a href=\"https://www.pinterest.com/httechsystem\" target=\"_blank\" rel=\"noopener\">pinterest</a></strong></em></li>\r\n</ul>\r\n</div>', '<p><span style=\"color: #ffffff;\"><strong>&copy; 2026. All rights reserved by HT Tech system</strong></span></p>', '<ul>\r\n<li><a href=\"https://www.facebook.com/\" target=\"_blank\" rel=\"noopener\"><em class=\"facebook-icon\"><strong>facebook</strong></em></a></li>\r\n<li><a href=\"https://twitter.com/SweetThemes1\" target=\"_blank\" rel=\"noopener\"><em class=\"twitter-icon\"><strong>twitter</strong></em></a></li>\r\n<li><a href=\"https://www.instagram.com\" target=\"_blank\" rel=\"noopener\"><em class=\"instagram-icon\"><strong>instagram</strong></em></a></li>\r\n<li><a href=\"https://www.behance.net\" target=\"_blank\" rel=\"noopener\"><em class=\"behance-icon\"><strong>behance</strong></em></a></li>\r\n<li><a href=\"https://www.linkedin.com/\" target=\"_blank\" rel=\"noopener\"><em class=\"linkedin-icon\"><strong>linkedin</strong></em></a></li>\r\n</ul>', 'lorem', 'Start a Project', '#', NULL, '2026-09-30 02:56:32', NULL, 32, 36, 16, 16, 16),
(2, 2, 'দোকান', 'লগইন', 'https://test.httsys.com/shop', 'https://test.httsys.com/login', '<p>আপনার কি কোনো পরামর্শ বা প্রশ্ন আছে?</p>\r\n<p><a class=\"btn btn-slider\" href=\"/contact\" target=\"_self\">চল কথা বলি</a></p>', 'আপনার মূল্যবান অনুদান কারো বেঁচে থাকার শেষ আশার আলো হতে পারে।', 'আপনার মূল্যবান অনুদান কারো বেঁচে থাকার শেষ আশার আলো হতে পারে।', 'দান করুন', 'https://test.httsys.com/donate', 'খেলা হোক আনন্দের, জয় হোক দক্ষতার—চ্যালেঞ্জ নিন, মজা করুন আর নিজের সেরাটাকে ছাড়িয়ে যান!', 'চলুন গেমসে যাই এবং পয়েন্ট অর্জন করি।', 'গেমস ভিতরে প্রবেশ', 'https://test.httsys.com/mini-games', 'দ্রুত লিঙ্ক', 'হ্যালো বলুন', '<ul class=\"menu\">\r\n<li class=\"menu-item-footer\">\r\n<h2><span style=\"color: #ffffff;\"><strong><a style=\"color: #ffffff;\" href=\"/gdpr\">জিডিপিআর</a></strong></span></h2>\r\n</li>\r\n<li class=\"menu-item-footer\">\r\n<h2><span style=\"color: #ffffff;\"><strong><a style=\"color: #ffffff;\" href=\"/terms-conditions\">শর্তাবলী</a></strong></span></h2>\r\n</li>\r\n<li class=\"menu-item-footer\">\r\n<h2><span style=\"color: #ffffff;\"><strong><a style=\"color: #ffffff;\" href=\"/privacy-policy\">প্রাইভেসি পলিসি</a></strong></span></h2>\r\n</li>\r\n<li class=\"menu-item-footer\"><span style=\"color: #ced4d9;\">এইচটি টেক সিস্টেম একটি বিশ্বস্ত বৈশ্বিক সফ্টওয়্যার ডেভেলপমেন্ট এবং একাধিক ব্যবসায়িক সংস্থা যা মার্কিন যুক্তরাষ্ট্র এবং বাংলাদেশী সংস্থাগুলির মধ্যে একটি যৌথ উদ্যোগ হিসাবে গঠিত।</span></li>\r\n</ul>', '<ul class=\"ft-link\">\r\n<li>\r\n<h2><span style=\"color: #ffffff;\"><strong><a style=\"color: #ffffff;\" href=\"mailto:httechsystem@gmail.com\">support@httsys.com</a></strong></span></h2>\r\n</li>\r\n<li>\r\n<h2><span style=\"color: #ffffff;\"><strong><a style=\"color: #ffffff;\" href=\"mailto:httechsystem@gmail.com\">httechsystem@gmail.com</a></strong></span></h2>\r\n</li>\r\n<li><span style=\"color: #ced4d9;\">৪৭৮১ ভ্যালি লেন, অস্টিন, টেক্সাস, মার্কিন যুক্তরাষ্ট্র।</span></li>\r\n</ul>\r\n<div class=\"social-share-inner\">\r\n<ul class=\"social-share\">\r\n<li><a href=\"https://www.facebook.com/httechsystem\" target=\"_blank\" rel=\"noopener\"><em class=\"fab fa-facebook-f\"><strong>facebook</strong></em></a></li>\r\n<li><a href=\"https://twitter.com/httechsystem\" target=\"_blank\" rel=\"noopener\"><em class=\"fab fa-twitter\"><strong>twitter</strong></em></a></li>\r\n<li><a href=\"https://www.youtube.com/channel/UCOUudh7u6f8wVsfcyw4dHEw\" target=\"_blank\" rel=\"noopener\"><em class=\"fab fa-youtube\"><strong>youtube</strong></em></a></li>\r\n<li><em class=\"fab fa-pinterest\"><strong><a href=\"https://www.pinterest.com/httechsystem\" target=\"_blank\" rel=\"noopener\">pinterest</a></strong></em></li>\r\n</ul>\r\n</div>', '<p><span style=\"color: #ffffff;\"><strong>&copy; ২০২৬. এইচটি টেক সিস্টেম দ্বারা সমস্ত অধিকার সংরক্ষিত ৷</strong></span></p>', '<ul>\r\n<li><a href=\"https://www.facebook.com/\" target=\"_blank\" rel=\"noopener\"><em class=\"facebook-icon\"><strong>facebook</strong></em></a></li>\r\n<li><a href=\"https://twitter.com/SweetThemes1\" target=\"_blank\" rel=\"noopener\"><em class=\"twitter-icon\"><strong>twitter</strong></em></a></li>\r\n<li><a href=\"https://www.instagram.com\" target=\"_blank\" rel=\"noopener\"><em class=\"instagram-icon\"><strong>instagram</strong></em></a></li>\r\n<li><a href=\"https://www.behance.net\" target=\"_blank\" rel=\"noopener\"><em class=\"behance-icon\"><strong>behance</strong></em></a></li>\r\n<li><a href=\"https://www.linkedin.com/\" target=\"_blank\" rel=\"noopener\"><em class=\"linkedin-icon\"><strong>linkedin</strong></em></a></li>\r\n</ul>', 'lorem', 'Start a Project', '#', NULL, '2026-09-30 02:48:22', NULL, 28, 30, 16, 16, 16),
(3, 3, 'لدينا محفظة', 'لدينا محفظة', 'https://icode.lucian.host/portfolio', 'https://icode.lucian.host/portfolio', '<p>هل لديك مشروع لنا؟</p>\r\n<p><a class=\"btn btn-slider\" href=\"/contact\" target=\"_self\">لنتحدث</a></p>', 'هل تبحث عن', '[\'تصميم المواقع؟\', \'وسائل التواصل الاجتماعي؟\', \'تصميم وطباعة؟\', \'تصميم رقمي؟\', \'تصميم وطباعة؟\']', 'اتصال', 'https://icode.lucian.host/contact', 'على استعداد للقيام بذلك', 'هيا بنا إلى العمل', 'اتصل بنا', 'https://icode.lucian.host/contact', 'روابط سريعة', 'قل مرحبا', '<ul class=\"menu\">\r\n<li class=\"menu-item-footer\"><a href=\"/gdpr\">جاربار</a></li>\r\n<li class=\"menu-item-footer\"><a href=\"/terms-conditions\">الأحكام والشروط</a></li>\r\n<li class=\"menu-item-footer\"><a href=\"/privacy-policy\">سياسة الخصوصية</a></li>\r\n</ul>', '<ul class=\"ft-link\">\r\n<li><a href=\"mailto:admin@example.com\">admin@example.com</a></li>\r\n<li><a href=\"mailto:hr@example.com\">hr@example.com</a></li>\r\n</ul>\r\n<div class=\"social-share-inner\">\r\n<ul class=\"social-share\">\r\n<li><a href=\"https://twitter.com/SweetThemes1\" target=\"_blank\" rel=\"noopener\"><em class=\"fab fa-facebook-f\"><strong>facebook</strong></em></a></li>\r\n<li><a href=\"https://www.instagram.com\" target=\"_blank\" rel=\"noopener\"><em class=\"fab fa-twitter\"><strong>instagram</strong></em></a></li>\r\n<li><a href=\"https://www.behance.net\" target=\"_blank\" rel=\"noopener\"><em class=\"fab fa-behance\"><strong>behance</strong></em></a></li>\r\n</ul>\r\n</div>', '<p>&copy; 2022. جميع الحقوق محفوظة Sweet-Themes. نحن نتتبع أي نية للقرصنة.</p>', '<ul>\r\n<li><a href=\"https://www.facebook.com/\" target=\"_blank\" rel=\"noopener\"><em class=\"facebook-icon\"><strong>facebook</strong></em></a></li>\r\n<li><a href=\"https://twitter.com/SweetThemes1\" target=\"_blank\" rel=\"noopener\"><em class=\"twitter-icon\"><strong>twitter</strong></em></a></li>\r\n<li><a href=\"https://www.instagram.com\" target=\"_blank\" rel=\"noopener\"><em class=\"instagram-icon\"><strong>instagram</strong></em></a></li>\r\n<li><a href=\"https://www.behance.net\" target=\"_blank\" rel=\"noopener\"><em class=\"behance-icon\"><strong>behance</strong></em></a></li>\r\n<li><a href=\"https://www.linkedin.com/\" target=\"_blank\" rel=\"noopener\"><em class=\"linkedin-icon\"><strong>linkedin</strong></em></a></li>\r\n</ul>', 'lorem', 'Start a Project', '#', NULL, '2022-01-24 14:25:40', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_sections`
--

CREATE TABLE `home_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_sections`
--

INSERT INTO `home_sections` (`id`, `key`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'slider', 'Hero Slider (top banner)', 1, '2026-08-17 21:19:12', '2026-08-18 21:02:37'),
(2, 'about', 'About Us', 1, '2026-08-17 21:19:12', '2026-08-18 21:02:37'),
(3, 'services', 'Services', 1, '2026-08-17 21:19:12', '2026-08-18 21:02:37'),
(4, 'fun_facts', 'Fun Facts / Counters', 1, '2026-08-17 21:19:12', '2026-08-18 21:02:37'),
(5, 'portfolio', 'Portfolio / Projects', 1, '2026-08-17 21:19:12', '2026-08-18 21:02:37'),
(6, 'testimonial', 'Testimonials', 1, '2026-08-17 21:19:12', '2026-08-18 21:02:37'),
(7, 'blog', 'Latest Blog Posts', 1, '2026-08-17 21:19:12', '2026-08-18 21:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `home_settings`
--

CREATE TABLE `home_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` text NOT NULL,
  `fun_title` varchar(191) NOT NULL,
  `fun_description` text NOT NULL,
  `count_icon1` varchar(255) DEFAULT NULL,
  `count_icon2` varchar(255) DEFAULT NULL,
  `count_icon3` varchar(255) DEFAULT NULL,
  `count_icon4` varchar(255) DEFAULT NULL,
  `count_number1` varchar(191) NOT NULL,
  `count_description1` text NOT NULL,
  `count_number2` varchar(191) NOT NULL,
  `count_description2` text NOT NULL,
  `count_number3` varchar(191) NOT NULL,
  `count_description3` text NOT NULL,
  `count_number4` varchar(191) NOT NULL,
  `count_description4` text NOT NULL,
  `about_subtitle` varchar(191) NOT NULL,
  `about_title` varchar(191) NOT NULL,
  `about_description` text NOT NULL,
  `about_buttontext` varchar(191) NOT NULL,
  `about_buttonlink` varchar(191) NOT NULL,
  `about_image1` varchar(191) NOT NULL,
  `about_image2` varchar(191) NOT NULL,
  `about_image3` varchar(255) DEFAULT NULL,
  `about_image1_titlu1` varchar(255) DEFAULT NULL,
  `about_image1_titlu2` varchar(255) DEFAULT NULL,
  `about_image2_titlu1` varchar(255) DEFAULT NULL,
  `about_image2_titlu2` varchar(255) DEFAULT NULL,
  `about_image3_titlu1` varchar(255) DEFAULT NULL,
  `about_image3_titlu2` varchar(255) DEFAULT NULL,
  `about_yearstitle` varchar(191) NOT NULL,
  `about_yearstext` varchar(191) NOT NULL,
  `services_title` varchar(191) NOT NULL,
  `sevices_text` text DEFAULT NULL,
  `projects_title` varchar(191) NOT NULL,
  `projects_subtitle` varchar(191) NOT NULL,
  `testimonial_title` varchar(255) DEFAULT NULL,
  `testimonial_subtitle` varchar(255) DEFAULT NULL,
  `blog_title` varchar(191) NOT NULL,
  `blog_subtitle` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_settings`
--

INSERT INTO `home_settings` (`id`, `language_id`, `meta_title`, `meta_description`, `fun_title`, `fun_description`, `count_icon1`, `count_icon2`, `count_icon3`, `count_icon4`, `count_number1`, `count_description1`, `count_number2`, `count_description2`, `count_number3`, `count_description3`, `count_number4`, `count_description4`, `about_subtitle`, `about_title`, `about_description`, `about_buttontext`, `about_buttonlink`, `about_image1`, `about_image2`, `about_image3`, `about_image1_titlu1`, `about_image1_titlu2`, `about_image2_titlu1`, `about_image2_titlu2`, `about_image3_titlu1`, `about_image3_titlu2`, `about_yearstitle`, `about_yearstext`, `services_title`, `sevices_text`, `projects_title`, `projects_subtitle`, `testimonial_title`, `testimonial_subtitle`, `blog_title`, `blog_subtitle`, `created_at`, `updated_at`) VALUES
(1, 1, 'HT Tech system', 'HT Tech system is a trusted global software development and multiple business agency formed as a joint venture between USA and Bangladeshis entities.', 'Fun Facts', 'This motivates us to continue looking for new challenges in order to improve our services.', '<i class=\"far fa-smile\"></i>', '<i class=\"fas fa-mug-hot\"></i>', '<i class=\"far fa-lightbulb\"></i>', '<i class=\"fas fa-briefcase\"></i>', '425', 'Happy Customers', '12', 'Cups of Coffee', '1320', 'Innovations', '860', 'Great Projects', 'About the studio', 'Unlimited Skills for Super Projects.', '<p><strong>Web design</strong> encompasses many different skills and disciplines in the production and maintenance of websites. The different areas of web design include web graphic design, interface design, including standardized code.</p>\r\n<ul>\r\n<li>Beautiful and easy to understand UI, professional animations</li>\r\n<li>These advantages are pixel perfect design &amp; clear code delivered</li>\r\n<li>Present your services with flexible, convenient and multipurpose</li>\r\n</ul>', 'Get the offer', 'https://httsys.com/pricing', 'https://httsys.com/public/images/media/1632839112about-us-pic3.webp', 'https://httsys.com/public/images/media/1632839112about-us-pic2.webp', 'https://httsys.com/public/images/media/1632839113about-us-pic1.webp', 'Web Development', 'Quality Code', 'Creative Agency', 'Marketing Strategy', 'Web Design Services', 'User Experience', '12', 'YEARS OF EXPERIENCE', 'How can we help?', '<p>We help premium brands&nbsp;achieve their future&nbsp;through innovation and creative perspectives.&nbsp;</p>', 'Our premium projects.', 'Mirror of creative solutions developed for clients. As passionate designers, we love building awesome products that are easy to use, accessible, engaging, and delightful.', 'Our clients', 'They are just some of those who have trusted our services. Project delivered, happy customer with quin cms.', 'Our latest news.', 'Blog posts', NULL, '2023-03-06 19:47:09'),
(2, 2, 'এইচটি টেক সিস্টেম', 'এইচটি টেক সিস্টেম হল একটি বিশ্বস্ত বৈশ্বিক সফটওয়্যার ডেভেলপমেন্ট এবং একাধিক ব্যবসায়িক সংস্থা যা মার্কিন যুক্তরাষ্ট্র এবং বাংলাদেশী সংস্থাগুলির মধ্যে যৌথ উদ্যোগে গঠিত।', 'মজার ঘটনা', 'এটি আমাদের পরিষেবাগুলিকে উন্নত করার জন্য নতুন চ্যালেঞ্জগুলির সন্ধান চালিয়ে যেতে অনুপ্রাণিত করে৷', '<i class=\"far fa-smile\"></i>', '<i class=\"fas fa-mug-hot\"></i>', '<i class=\"far fa-lightbulb\"></i>', '<i class=\"fas fa-briefcase\"></i>', '425', 'খুশি গ্রাহকদের', '12', 'কফি কাপ', '1320', 'উদ্ভাবন', '860', 'মহান প্রকল্প', 'স্টুডিও সম্পর্কে', 'সুপার প্রজেক্টের জন্য সীমাহীন দক্ষতা।</span>', '<p>ওয়েব ডিজাইন ওয়েবসাইটের উৎপাদন এবং রক্ষণাবেক্ষণে বিভিন্ন দক্ষতা এবং শৃঙ্খলাকে অন্তর্ভুক্ত করে। ওয়েব ডিজাইনের বিভিন্ন ক্ষেত্রের মধ্যে রয়েছে ওয়েব গ্রাফিক ডিজাইন, ইন্টারফেস ডিজাইন, প্রমিত কোড সহ।</p>\r\n<ul>\r\n<li>সুন্দর এবং সহজে বোঝা যায় UI, পেশাদার অ্যানিমেশন<br />এই সুবিধাগুলি হল পিক্সেল নিখুঁত ডিজাইন এবং পরিষ্কার কোড সরবরাহ করা<br />আপনার পরিষেবাগুলি নমনীয়, সুবিধাজনক এবং বহুমুখী সহ উপস্থাপন করুন</li>\r\n</ul>', 'অফারটি পান', 'https://httsys.com/pricing', 'https://httsys.com/public/images/media/1632839112about-us-pic3.webp', 'https://httsys.com/public/images/media/1632839112about-us-pic2.webp', 'https://httsys.com/public/images/media/1632839113about-us-pic1.webp', 'ওয়েব ডেভেলপমেন্ট', 'গুণমান কোড', 'ক্রিয়েটিভ এজেন্সি', 'বিপণন কৌশল', 'ওয়েব ডিজাইন সেবা', 'ব্যবহারকারীর অভিজ্ঞতা', '১২', 'বছরের অভিজ্ঞতা', '<span>আমরা কিভাবে সাহায্য করতে পারি?</span>', '<p>আমরা প্রিমিয়াম ব্র্যান্ডকে উদ্ভাবন এবং সৃজনশীল দৃষ্টিভঙ্গির মাধ্যমে তাদের ভবিষ্যৎ অর্জনে সহায়তা করি।</p>', 'আমাদের প্রিমিয়াম প্রকল্প.', 'ক্লায়েন্টদের জন্য তৈরি সৃজনশীল সমাধানের আয়না। উত্সাহী ডিজাইনার হিসাবে, আমরা এমন দুর্দান্ত পণ্য তৈরি করতে পছন্দ করি যা ব্যবহার করা সহজ, অ্যাক্সেসযোগ্য, আকর্ষক এবং আনন্দদায়ক।', 'আপনি উত্তর দিবেন না', 'তারা শুধুমাত্র কিছু যারা আমাদের পরিষেবা বিশ্বাস করেছে. প্রকল্প বিতরণ করা হয়েছে, কুইন সেমি সহ খুশি গ্রাহক।', 'আমাদের সর্বশেষ খবর.', 'ব্লগ এর লেখাগুলো', NULL, '2023-03-06 20:40:01'),
(3, 3, 'نيفا CMS | وكالة إبداعية', 'سواء كنت بحاجة إلى شعار جديد أو موقع ويب أو مقطع فيديو أو حملة تسويقية أو كتاب إلكتروني تم إنشاؤه لعملك ، فإن مفتاح إنجاح المشروع يبدأ بامتلاك موجز إبداعي مدروس جيدًا.', 'حقائق ممتعة', 'على مر السنين قمنا بالعديد من الأشياء التي نفخر بها. هذا يحفزنا على مواصلة البحث عن تحديات جديدة من أجل تحسين خدماتنا.', '<i class=\"far fa-smile\"></i>', '<i class=\"fas fa-mug-hot\"></i>', '<i class=\"far fa-lightbulb\"></i>', '<i class=\"fas fa-briefcase\"></i>', '425', 'مشاريع عظيمة', '12', 'ابتكارات', '1320', 'كؤوس من القهوة', '860', 'الزبائن سعداء', 'عن الوكالة', 'مهارات غير محدودة للمشاريع الخارقة.', 'يشمل <p> <strong> تصميم الويب </ strong> العديد من المهارات والتخصصات المختلفة في إنتاج مواقع الويب وصيانتها. تشمل المجالات المختلفة لتصميم الويب تصميم رسومات الويب ، وتصميم الواجهة ، بما في ذلك التعليمات البرمجية الموحدة. </ p>\r\n<ul>\r\n<li> واجهة مستخدم جميلة وسهلة الفهم ورسوم متحركة احترافية </ li>\r\n<li> هذه المزايا هي تصميم مثالي للبكسل وأمبير. تسليم كود واضح </li>\r\n<li> قدم خدماتك بمرونة وملاءمة ومتعددة الأغراض </ li>\r\n</ul>', 'احصل على العرض', 'https://icode.lucian.host/pricing', 'https://icode.lucian.host/public/images/media/1632839112about-us-pic3.webp', 'https://icode.lucian.host/public/images/media/1632839112about-us-pic2.webp', 'https://icode.lucian.host/public/images/media/1632839113about-us-pic1.webp', 'تطوير الشبكة', 'كود الجودة', 'وكالة إبداعية', 'استراتيجية التسويق', 'خدمات تصميم المواقع', 'تجربة المستخدم', '12', 'سنوات من الخبرة', 'كيف يمكننا المساعدة؟', '<p>نحن نساعد العلامات التجارية المتميزة على تحقيق مستقبلها من خلال الابتكار ووجهات النظر الإبداعية. نحن ننمي شركتك من خلال الأفكار الداخلية الخاصة ، <strong>والتي </strong>تم اختبارها وإتقانها على مر السنين.</p>', 'مشاريعنا المتميزة.', 'اعمال محددة', 'عملائنا', 'إنهم مجرد بعض أولئك الذين وثقوا بخدماتنا. تم تسليم المشروع ، عميل سعيد مع quin cms.', 'آخر أخبارنا', 'مشاركات المدونة', NULL, '2021-06-05 15:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_id` varchar(191) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 1,
  `rtl` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - LTR, 1- RTL',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `photo_id`, `name`, `code`, `is_default`, `rtl`, `created_at`, `updated_at`) VALUES
(1, '116', 'English', 'en', 0, 0, NULL, '2023-03-07 15:39:49'),
(2, '248', 'Bangla', 'bn', 1, 0, NULL, '2026-06-01 21:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(191) DEFAULT NULL,
  `logged_in_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `ip_address`, `user_agent`, `logged_in_at`, `created_at`, `updated_at`) VALUES
(1, 11, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-14 10:39:57', '2026-08-14 10:39:57', '2026-08-14 10:39:57'),
(2, 11, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-14 10:44:12', '2026-08-14 10:44:12', '2026-08-14 10:44:12'),
(3, 11, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-14 10:51:54', '2026-08-14 10:51:54', '2026-08-14 10:51:54'),
(4, 1, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-14 14:28:23', '2026-08-14 14:28:23', '2026-08-14 14:28:23'),
(5, 12, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', '2026-08-14 16:44:30', '2026-08-14 16:44:30', '2026-08-14 16:44:30'),
(6, 11, '37.111.210.90', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-14 17:11:29', '2026-08-14 17:11:29', '2026-08-14 17:11:29'),
(7, 11, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-14 20:34:34', '2026-08-14 20:34:34', '2026-08-14 20:34:34'),
(8, 1, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-14 20:35:47', '2026-08-14 20:35:47', '2026-08-14 20:35:47'),
(9, 13, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-14 20:47:27', '2026-08-14 20:47:27', '2026-08-14 20:47:27'),
(10, 13, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-14 20:48:26', '2026-08-14 20:48:26', '2026-08-14 20:48:26'),
(11, 11, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-14 20:50:57', '2026-08-14 20:50:57', '2026-08-14 20:50:57'),
(12, 11, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-14 21:23:38', '2026-08-14 21:23:38', '2026-08-14 21:23:38'),
(13, 11, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-14 21:57:26', '2026-08-14 21:57:26', '2026-08-14 21:57:26'),
(14, 12, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', '2026-08-14 22:16:34', '2026-08-14 22:16:34', '2026-08-14 22:16:34'),
(15, 11, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-14 22:23:21', '2026-08-14 22:23:21', '2026-08-14 22:23:21'),
(16, 13, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-14 22:42:02', '2026-08-14 22:42:02', '2026-08-14 22:42:02'),
(17, 11, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-15 07:15:19', '2026-08-15 07:15:19', '2026-08-15 07:15:19'),
(18, 13, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-15 18:58:44', '2026-08-15 18:58:44', '2026-08-15 18:58:44'),
(19, 1, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-15 19:00:28', '2026-08-15 19:00:28', '2026-08-15 19:00:28'),
(20, 12, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', '2026-08-15 21:45:27', '2026-08-15 21:45:27', '2026-08-15 21:45:27'),
(21, 11, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-15 21:47:20', '2026-08-15 21:47:20', '2026-08-15 21:47:20'),
(22, 11, '37.111.234.229', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-16 09:08:18', '2026-08-16 09:08:18', '2026-08-16 09:08:18'),
(23, 1, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 17:19:43', '2026-08-16 17:19:43', '2026-08-16 17:19:43'),
(24, 11, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-16 21:58:24', '2026-08-16 21:58:24', '2026-08-16 21:58:24'),
(25, 11, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-17 22:17:20', '2026-08-17 22:17:20', '2026-08-17 22:17:20'),
(26, 14, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-20 20:53:17', '2026-08-20 20:53:17', '2026-08-20 20:53:17'),
(27, 15, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 09:42:35', '2026-08-21 09:42:35', '2026-08-21 09:42:35'),
(28, 16, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 10:22:12', '2026-08-21 10:22:12', '2026-08-21 10:22:12'),
(29, 16, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 10:37:34', '2026-08-21 10:37:34', '2026-08-21 10:37:34'),
(30, 17, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-21 11:18:33', '2026-08-21 11:18:33', '2026-08-21 11:18:33'),
(31, 17, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-21 14:39:39', '2026-08-21 14:39:39', '2026-08-21 14:39:39'),
(32, 16, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 15:10:36', '2026-08-21 15:10:36', '2026-08-21 15:10:36'),
(33, 16, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 20:20:26', '2026-08-21 20:20:26', '2026-08-21 20:20:26'),
(34, 1, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-21 20:29:13', '2026-08-21 20:29:13', '2026-08-21 20:29:13'),
(35, 16, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-21 20:41:42', '2026-08-21 20:41:42', '2026-08-21 20:41:42'),
(36, 1, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-21 20:43:34', '2026-08-21 20:43:34', '2026-08-21 20:43:34'),
(37, 1, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 09:04:56', '2026-08-22 09:04:56', '2026-08-22 09:04:56'),
(38, 16, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-22 10:27:08', '2026-08-22 10:27:08', '2026-08-22 10:27:08'),
(39, 16, '37.111.234.190', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-22 14:56:04', '2026-08-22 14:56:04', '2026-08-22 14:56:04'),
(40, 16, '103.117.193.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-22 19:59:31', '2026-08-22 19:59:31', '2026-08-22 19:59:31'),
(41, 16, '37.111.236.146', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-23 09:39:59', '2026-08-23 09:39:59', '2026-08-23 09:39:59'),
(42, 16, '37.111.198.32', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-08-24 10:00:29', '2026-08-24 10:00:29', '2026-08-24 10:00:29'),
(43, 16, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-24 21:07:43', '2026-08-24 21:07:43', '2026-08-24 21:07:43'),
(44, 14, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-26 14:28:02', '2026-08-26 14:28:02', '2026-08-26 14:28:02'),
(45, 14, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-26 14:59:32', '2026-08-26 14:59:32', '2026-08-26 14:59:32'),
(46, 14, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-26 15:00:06', '2026-08-26 15:00:06', '2026-08-26 15:00:06'),
(47, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', '2026-09-05 00:49:55', '2026-09-05 00:49:55', '2026-09-05 00:49:55'),
(48, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-05 00:55:09', '2026-09-05 00:55:09', '2026-09-05 00:55:09'),
(49, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-06 22:10:26', '2026-09-06 22:10:26', '2026-09-06 22:10:26'),
(50, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', '2026-09-08 00:56:41', '2026-09-08 00:56:41', '2026-09-08 00:56:41'),
(51, 16, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-08 01:32:52', '2026-09-08 01:32:52', '2026-09-08 01:32:52'),
(52, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-08 01:35:13', '2026-09-08 01:35:13', '2026-09-08 01:35:13'),
(53, 17, '37.111.233.19', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-08 15:12:08', '2026-09-08 15:12:08', '2026-09-08 15:12:08'),
(54, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', '2026-09-08 23:57:19', '2026-09-08 23:57:19', '2026-09-08 23:57:19'),
(55, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-09 02:06:03', '2026-09-09 02:06:03', '2026-09-09 02:06:03'),
(56, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', '2026-09-11 02:11:51', '2026-09-11 02:11:51', '2026-09-11 02:11:51'),
(57, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', '2026-09-12 01:09:54', '2026-09-12 01:09:54', '2026-09-12 01:09:54'),
(58, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-12 01:37:06', '2026-09-12 01:37:06', '2026-09-12 01:37:06'),
(59, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-13 01:52:04', '2026-09-13 01:52:04', '2026-09-13 01:52:04'),
(60, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-13 02:02:52', '2026-09-13 02:02:52', '2026-09-13 02:02:52'),
(61, 17, '37.111.233.228', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-13 17:08:52', '2026-09-13 17:08:52', '2026-09-13 17:08:52'),
(62, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-14 01:27:12', '2026-09-14 01:27:12', '2026-09-14 01:27:12'),
(63, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-14 01:52:40', '2026-09-14 01:52:40', '2026-09-14 01:52:40'),
(64, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-15 01:37:23', '2026-09-15 01:37:23', '2026-09-15 01:37:23'),
(65, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-15 01:54:09', '2026-09-15 01:54:09', '2026-09-15 01:54:09'),
(66, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-15 23:33:18', '2026-09-15 23:33:18', '2026-09-15 23:33:18'),
(67, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-16 00:20:33', '2026-09-16 00:20:33', '2026-09-16 00:20:33'),
(68, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-16 01:39:56', '2026-09-16 01:39:56', '2026-09-16 01:39:56'),
(69, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-16 04:03:06', '2026-09-16 04:03:06', '2026-09-16 04:03:06'),
(70, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-18 23:54:53', '2026-09-18 23:54:53', '2026-09-18 23:54:53'),
(71, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-19 03:07:56', '2026-09-19 03:07:56', '2026-09-19 03:07:56'),
(72, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-20 01:47:25', '2026-09-20 01:47:25', '2026-09-20 01:47:25'),
(73, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-20 03:38:21', '2026-09-20 03:38:21', '2026-09-20 03:38:21'),
(74, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-21 02:36:26', '2026-09-21 02:36:26', '2026-09-21 02:36:26'),
(75, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-22 01:47:11', '2026-09-22 01:47:11', '2026-09-22 01:47:11'),
(76, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-22 03:49:03', '2026-09-22 03:49:03', '2026-09-22 03:49:03'),
(77, 17, '37.111.233.182', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-22 15:26:53', '2026-09-22 15:26:53', '2026-09-22 15:26:53'),
(78, 19, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', '2026-09-22 20:35:19', '2026-09-22 20:35:19', '2026-09-22 20:35:19'),
(79, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-22 22:00:53', '2026-09-22 22:00:53', '2026-09-22 22:00:53'),
(80, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-24 01:06:00', '2026-09-24 01:06:00', '2026-09-24 01:06:00'),
(81, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', '2026-09-26 02:25:03', '2026-09-26 02:25:03', '2026-09-26 02:25:03'),
(82, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-26 04:18:44', '2026-09-26 04:18:44', '2026-09-26 04:18:44'),
(83, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-09-27 00:39:25', '2026-09-27 00:39:25', '2026-09-27 00:39:25'),
(84, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-09-28 01:08:15', '2026-09-28 01:08:15', '2026-09-28 01:08:15'),
(85, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-28 01:09:34', '2026-09-28 01:09:34', '2026-09-28 01:09:34'),
(86, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-09-29 00:13:00', '2026-09-29 00:13:00', '2026-09-29 00:13:00'),
(87, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-09-29 00:13:52', '2026-09-29 00:13:52', '2026-09-29 00:13:52'),
(88, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-09-30 02:53:30', '2026-09-30 02:53:30', '2026-09-30 02:53:30'),
(89, 16, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-10-01 01:38:34', '2026-10-01 01:38:34', '2026-10-01 01:38:34'),
(90, 16, '103.117.193.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-10-02 01:32:17', '2026-10-02 01:32:17', '2026-10-02 01:32:17'),
(91, 14, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-10-04 01:03:20', '2026-10-04 01:03:20', '2026-10-04 01:03:20'),
(92, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-10-04 01:12:54', '2026-10-04 01:12:54', '2026-10-04 01:12:54'),
(93, 14, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-10-04 01:14:54', '2026-10-04 01:14:54', '2026-10-04 01:14:54'),
(94, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-10-04 01:28:52', '2026-10-04 01:28:52', '2026-10-04 01:28:52'),
(95, 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2026-10-04 01:33:23', '2026-10-04 01:33:23', '2026-10-04 01:33:23'),
(96, 14, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-10-04 01:35:35', '2026-10-04 01:35:35', '2026-10-04 01:35:35'),
(97, 16, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-10-04 01:40:49', '2026-10-04 01:40:49', '2026-10-04 01:40:49'),
(98, 14, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', '2026-10-04 01:41:16', '2026-10-04 01:41:16', '2026-10-04 01:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_bids`
--

CREATE TABLE `marketplace_bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marketplace_bids`
--

INSERT INTO `marketplace_bids` (`id`, `listing_id`, `user_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 3, 16, 11500.00, '2026-09-28 01:40:00', '2026-09-28 01:40:00'),
(2, 3, 16, 11550.00, '2026-09-28 01:44:34', '2026-09-28 01:44:34'),
(3, 4, 16, 14000.00, '2026-10-04 01:31:11', '2026-10-04 01:31:11'),
(4, 4, 17, 14700.00, '2026-10-04 01:48:52', '2026-10-04 01:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_listings`
--

CREATE TABLE `marketplace_listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `photo_id` int(10) UNSIGNED DEFAULT NULL,
  `listing_type` enum('fixed','auction') NOT NULL DEFAULT 'fixed',
  `price` decimal(15,2) DEFAULT NULL,
  `quantity_available` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `quantity_reserved` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `quantity_sold` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `starting_price` decimal(15,2) DEFAULT NULL,
  `current_bid` decimal(15,2) DEFAULT NULL,
  `bid_increment` decimal(15,2) DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `winning_bid_id` bigint(20) UNSIGNED DEFAULT NULL,
  `digital_file_id` int(10) UNSIGNED DEFAULT NULL,
  `digital_link` varchar(191) DEFAULT NULL,
  `status` enum('active','sold','closed','expired') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marketplace_listings`
--

INSERT INTO `marketplace_listings` (`id`, `user_id`, `title`, `description`, `photo_id`, `listing_type`, `price`, `quantity_available`, `quantity_reserved`, `quantity_sold`, `starting_price`, `current_bid`, `bid_increment`, `ends_at`, `winning_bid_id`, `digital_file_id`, `digital_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 16, 'ক্লাউড সিস্টেম আজীবন ডাটার সেভ নোট', 'নিচের বাটন থেকে ক্লিক করে আপনি রেজিস্ট্রেশন করুন। রেজিস্ট্রেশন করার পর ইমেইল ভেরিফিকেশন করে নিন। লগ ইন করে আপনার ফ্রি ক্লাউড সিস্টেম আজীবন ডাটার সেভ নোট ব্যবহার করুন। আমরা আশা করব পরবর্তী সময় আমাদের সাথে থাকবেন।', NULL, 'fixed', 500.00, 10, 3, 0, NULL, NULL, 10.00, NULL, NULL, 281, 'https://test.httsys.com/profile#notepad', 'active', '2026-09-22 03:38:42', '2026-10-04 01:17:30'),
(2, 17, 'Sako 3000VA Automatic Voltage Stabilizer – Special Features', 'SAKO 3000VA Automatic Voltage Stabilizer\r\n🔹 Full Specifications\r\nItem	Voltage Stabilizer\r\nPhase	Single Phase\r\nPower Type	AC\r\nCapacity	3000VA\r\nTotal Power	2400W\r\nInput Voltage	90V – 270V\r\nOutput Voltage	220V ± 3%\r\nFrequency	50Hz\r\nNoise Level	≤ 50dB\r\nProtection System	High Voltage Cut-off, Low Voltage Cut-off, Short Circuit Protection, Overload Protection\r\nRestart System	Auto Restart with Smart Delay Timer\r\nOperating Temperature	-5°C to 60°C\r\nHumidity Range	20% – 90%', 282, 'auction', NULL, 1, 0, 0, 11000.00, NULL, 100.00, '2026-09-22 22:46:00', NULL, NULL, NULL, 'expired', '2026-09-22 15:47:11', '2026-09-27 01:02:50'),
(3, 17, 'Sako 3000VA Automatic Voltage Stabilizer – Special Features', 'SAKO 3000VA Automatic Voltage Stabilizer\r\n🔹 Full Specifications\r\nItem Voltage Stabilizer\r\nPhase Single Phase\r\nPower Type AC\r\nCapacity 3000VA\r\nTotal Power 2400W\r\nInput Voltage 90V – 270V\r\nOutput Voltage 220V ± 3%\r\nFrequency 50Hz\r\nNoise Level ≤ 50dB\r\nProtection System High Voltage Cut-off, Low Voltage Cut-off, Short Circuit Protection, Overload Protection\r\nRestart System Auto Restart with Smart Delay Timer\r\nOperating Temperature -5°C to 60°C\r\nHumidity Range 20% – 90%', 283, 'auction', NULL, 1, 0, 0, 11000.00, 11550.00, 10.00, '2026-09-30 12:01:00', 2, NULL, NULL, 'sold', '2026-09-28 01:39:13', '2026-10-01 23:51:36'),
(4, 14, 'Men\'s Leather Biker Jacket', 'III-Fashions Mens Leather Jacket - Real Lambskin Classic Vintage Style Leather Jackets For Men Brown Leather Jacket for Mens, Black - Wick, Small : Amazon.sg: Fashion\r\nIII-Fashions Mens Leather Jacket - Real Lambskin Classic Vintage Style Leather Jackets For Men Brown Leather Jacket for Mens, Black - Wick, Small : Amazon.sg: Fashion\r\n\r\nAmazon.sg\r\nHUGO - Regular-fit biker jacket in buffalo leather - Black', 284, 'auction', NULL, 1, 0, 0, 14000.00, 14700.00, 500.00, '2026-10-31 00:00:00', NULL, NULL, NULL, 'active', '2026-10-04 01:25:50', '2026-10-04 01:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_orders`
--

CREATE TABLE `marketplace_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `amount` decimal(15,2) NOT NULL,
  `receiving_details` text DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_reference` varchar(191) DEFAULT NULL,
  `escrow_hold_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('awaiting_payment','pending','completed','rejected') NOT NULL DEFAULT 'awaiting_payment',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seller_status` enum('pending','released','rejected') NOT NULL DEFAULT 'pending',
  `seller_note` text DEFAULT NULL,
  `seller_acted_at` timestamp NULL DEFAULT NULL,
  `buyer_confirmed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marketplace_orders`
--

INSERT INTO `marketplace_orders` (`id`, `listing_id`, `buyer_id`, `seller_id`, `quantity`, `amount`, `receiving_details`, `payment_method_id`, `payment_reference`, `escrow_hold_id`, `status`, `created_at`, `updated_at`, `seller_status`, `seller_note`, `seller_acted_at`, `buyer_confirmed_at`) VALUES
(1, 1, 17, 16, 1, 500.00, NULL, NULL, NULL, NULL, 'awaiting_payment', '2026-09-22 15:43:23', '2026-09-22 15:43:23', 'pending', NULL, NULL, NULL),
(2, 1, 17, 16, 1, 500.00, NULL, NULL, NULL, NULL, 'awaiting_payment', '2026-09-28 01:32:07', '2026-09-28 01:32:07', 'pending', NULL, NULL, NULL),
(3, 3, 16, 17, 1, 11550.00, NULL, NULL, NULL, NULL, 'awaiting_payment', '2026-10-01 23:51:36', '2026-10-01 23:51:36', 'pending', NULL, NULL, NULL),
(4, 1, 14, 16, 1, 500.00, 'abc@gmail.com', 1, 'PL09U3I02', 4, 'pending', '2026-10-04 01:17:30', '2026-10-04 01:18:33', 'pending', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_id` varchar(191) NOT NULL,
  `name` text NOT NULL,
  `position` text NOT NULL,
  `facebook` text DEFAULT NULL,
  `twitter` text DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `photo_id`, `name`, `position`, `facebook`, `twitter`, `linkedin`, `created_at`, `updated_at`) VALUES
(5, '252', 'Diana A.', 'UI/UX', 'https://www.facebook.com/', 'https://twitter.com/home', 'https://www.linkedin.com/feed/', '2021-03-14 01:53:22', '2023-03-06 19:33:41'),
(4, '253', 'Michael O.', 'Designer', 'https://www.facebook.com/', 'https://twitter.com/home', 'https://www.linkedin.com/feed/', '2021-03-14 01:52:00', '2023-03-06 19:33:56'),
(3, '254', 'Bianca D.', 'Advertising manager', 'https://www.facebook.com/', 'https://twitter.com/home', 'https://www.linkedin.com/feed/', '2021-03-14 01:51:28', '2023-03-06 19:34:12'),
(2, '255', 'John M.', 'WEB manager', 'https://www.facebook.com/', 'https://twitter.com/home', 'https://www.linkedin.com/feed/', '2021-03-14 01:50:35', '2023-03-06 19:34:26'),
(1, '256', 'Elisabeth Doe', 'SEO Manager', 'https://www.facebook.com/', 'https://twitter.com/home', 'https://www.linkedin.com/feed/', '2021-03-14 01:49:48', '2023-03-06 19:34:41'),
(6, '257', 'Olivia M.', 'Programmer', 'https://www.facebook.com/', 'https://twitter.com/home', 'https://www.linkedin.com/feed/', '2021-03-14 01:54:26', '2023-03-06 19:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `name` varchar(191) NOT NULL,
  `link` varchar(191) NOT NULL,
  `on_off_submenu` tinyint(1) NOT NULL DEFAULT 0,
  `submenu` text DEFAULT NULL,
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `language_id`, `name`, `link`, `on_off_submenu`, `submenu`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Home', 'https://httsys.com/', 1, '<ul class=\"dropdown-menu header__nav-menu\">\r\n<li><a href=\"https://httsys.com/pricing\">About us</a></li>\r\n<li><a href=\"https://httsys.com/pricing\">Portfolio</a></li>\r\n<li><a href=\"https://httsys.com/pricing\">Pricing</a></li>\r\n</ul>', 1, '2021-03-13 15:37:55', '2026-09-15 02:39:56'),
(3, 1, 'Mini Games', 'https://test.httsys.com/mini-games', 0, '<ul class=\"dropdown-menu header__nav-menu\">\r\n<li><a href=\"/portfolio\">Our Projects</a></li>\r\n<li><a href=\"/project/niva\">Niva WordPress Theme</a></li>\r\n<li><a href=\"/project/venor\">Venor WordPress Theme</a></li>\r\n</ul>', 3, '2021-03-13 15:39:05', '2026-09-21 02:35:04'),
(29, 1, 'Shop', 'https://test.httsys.com/shop', 1, '<div class=\"dropdown-menu\"><a class=\"dropdown-item\" href=\"/shop\">Shop</a> <a class=\"dropdown-item\" href=\"/profile\">Profile</a> <a class=\"dropdown-item\" href=\"/pos\">POS</a></div>', 21, '2026-09-15 23:35:04', '2026-09-18 02:31:01'),
(9, 1, 'Blog', 'https://httsys.com/blog', 1, '<ul class=\"dropdown-menu header__nav-menu\">\r\n<li><a href=\"/blog\">Our recent news</a></li>\r\n<li><a href=\"/post/top-6-articles-you-must-read-today-niva\">Top 6 Articles You Must Read</a></li>\r\n<li><a href=\"/post/7-creative-ways-to-boost-your-social-media\">Top 7 Creative Ways to Boost Your Media</a></li>\r\n</ul>', 5, '2021-04-10 20:03:48', '2023-03-05 21:21:49'),
(17, 3, 'منزل، بيت', 'https://icode.lucian.host/', 0, NULL, 111, '2021-03-13 15:37:55', '2021-03-13 15:37:55'),
(11, 2, 'হোম', 'https://httsys.com/', 1, '<div class=\"dropdown-menu\"><a class=\"dropdown-item\" href=\"/about-us\">আমাদের সম্পর্কে</a> <a class=\"dropdown-item\" href=\"/portfolio\">পোর্টফোলিও</a> <a class=\"dropdown-item\" href=\"/pricing\">মূল্য নির্ধারণ</a></div>', 11, '2021-04-10 20:34:43', '2026-09-18 02:27:13'),
(14, 2, 'মিনি গেমস', 'https://test.httsys.com/mini-games', 0, '<ul class=\"dropdown-menu header__nav-menu\">\r\n<li><a href=\"/portfolio\">আমাদের প্রকল্প<br />নিভা ওয়ার্ডপ্রেস থিম<br />ভেনর ওয়ার্ডপ্রেস থিম</a></li>\r\n</ul>', 33, '2021-04-10 20:39:50', '2026-09-21 02:36:15'),
(16, 2, 'ব্লগ', 'https://httsys.com/blog', 1, '<ul class=\"dropdown-menu header__nav-menu\">\r\n<li><a href=\"/blog\">আমাদের সাম্প্রতিক খবর<br />শীর্ষ 6 নিবন্ধ আপনি অবশ্যই পড়তে হবে<br />শীর্ষ 7 সৃজনশীল উপায় আপনার মিডিয়া বুস্ট</a></li>\r\n</ul>', 44, '2021-04-10 20:44:07', '2026-09-18 02:34:53'),
(18, 3, 'معلومات عنا', 'https://icode.lucian.host/about-us', 0, NULL, 222, '2021-03-13 15:38:33', '2021-03-13 15:46:23'),
(19, 3, 'ملف', 'https://icode.lucian.host/portfolio', 1, '<ul class=\"dropdown-menu header__nav-menu\">\r\n<li><a href=\"https://icode.lucian.host/portfolio\">مشاريعنا</a></li>\r\n<li><a href=\"https://icode.lucian.host/project/niva\">نيفا وورد الموضوع</a></li>\r\n<li><a href=\"https://icode.lucian.host/project/venor\">موضوع Venor WordPress</a></li>\r\n</ul>', 333, '2021-03-13 15:39:05', '2021-04-11 17:07:57'),
(20, 3, 'التسعير', 'https://icode.lucian.host/pricing', 0, NULL, 444, '2021-03-13 15:44:34', '2021-03-13 15:44:34'),
(21, 3, 'مدونة او مذكرة', 'https://icode.lucian.host/blog', 1, '<ul class=\"dropdown-menu header__nav-menu\">\r\n<li><a href=\"https://icode.lucian.host/blog\">آخر أخبارنا</a></li>\r\n<li><a href=\"https://icode.lucian.host/post/top-6-articles-you-must-read-today-niva\">أهم 6 مقالات يجب أن تقرأها</a></li>\r\n<li><a href=\"https://icode.lucian.host/post/7-creative-ways-to-boost-your-social-media\">أفضل 7 طرق إبداعية لتعزيز Medi الخاص بك</a></li>\r\n</ul>', 555, '2021-04-10 20:03:48', '2021-04-11 17:08:29'),
(23, 4, 'হোম', 'https://httsys.com/', 0, NULL, 6, '2023-03-06 19:41:49', '2023-03-06 19:41:49'),
(24, 4, 'আমাদের সম্পর্কে', 'https://httsys.com/about-us', 0, NULL, 7, '2023-03-06 19:42:58', '2023-03-06 19:42:58'),
(25, 1, 'Login', 'https://test.httsys.com/login', 0, NULL, 0, '2026-08-14 20:16:35', '2026-08-24 20:52:38'),
(26, 2, 'লগইন', 'https://test.httsys.com/login', 0, NULL, 8, '2026-08-14 20:24:52', '2026-09-05 16:52:05'),
(27, 1, 'Donate', 'https://test.httsys.com/donate', 0, NULL, 23, '2026-09-05 02:06:17', '2026-09-05 02:08:20'),
(28, 2, 'দান করুন', 'https://test.httsys.com/donate', 0, NULL, 56, '2026-09-05 02:08:01', '2026-09-05 02:09:16'),
(31, 2, 'দোকান', 'https://test.httsys.com/shop', 1, '<div class=\"dropdown-menu\"><a class=\"dropdown-item\" href=\"/shop\">দোকান</a> <a class=\"dropdown-item\" href=\"/profile\">প্রোফাইল</a> <a class=\"dropdown-item\" href=\"/pos\">POS</a></div>', 55, '2026-09-18 02:34:18', '2026-09-18 02:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(58, '2014_10_12_000000_create_users_table', 1),
(59, '2014_10_12_100000_create_password_resets_table', 1),
(60, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(61, '2016_04_22_211638_create_roles_table', 1),
(62, '2018_07_15_120309_add_photo_id_to_users', 1),
(63, '2018_07_15_140042_create_photos_table', 1),
(64, '2018_07_21_084950_create_posts_table', 1),
(65, '2018_07_21_142400_create_categories_table', 1),
(66, '2018_07_25_180532_create_comments_table', 1),
(67, '2018_07_25_180651_create_comment_replies_table', 1),
(68, '2019_08_19_000000_create_failed_jobs_table', 1),
(69, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(70, '2021_02_18_105157_create_sessions_table', 1),
(71, '2021_02_18_110236_add_fb_id_column_in_users_table', 1),
(72, '2021_02_21_092726_create_settings_table', 1),
(73, '2021_03_02_124524_create_menus_table', 1),
(74, '2021_03_02_150833_create_sliders_table', 1),
(75, '2021_03_04_111731_create_services_table', 1),
(76, '2021_03_04_114538_create_testimonials_table', 1),
(77, '2021_03_04_130014_create_clients_table', 1),
(78, '2021_03_04_132321_create_projects_table', 1),
(79, '2021_03_04_133655_create_members_table', 1),
(80, '2021_03_05_154933_create_pricings_table', 1),
(81, '2021_03_06_143051_create_project_categories_table', 1),
(82, '2021_03_06_143105_create_pages_table', 1),
(83, '2021_03_07_094913_create_header_footer_settings_table', 1),
(84, '2021_03_07_094936_create_home_settings_table', 1),
(85, '2021_03_07_095003_create_about_settings_table', 1),
(86, '2021_03_07_095030_create_portfolio_settings_table', 1),
(87, '2021_03_07_095049_create_pricing_settings_table', 1),
(88, '2021_03_07_095108_create_blog_settings_table', 1),
(89, '2021_03_07_095119_create_contact_settings_table', 1),
(90, '2020_03_14_141017_create_languages_table', 2),
(91, '2021_06_09_135740_create_orders_table', 3),
(92, '2026_08_14_000001_add_note_and_login_tracking_to_users_table', 4),
(93, '2026_08_15_000001_create_notes_table', 4),
(94, '2026_08_14_000002_create_login_logs_table', 4),
(95, '2026_08_16_000001_create_ad_zones_table', 5),
(96, '2026_08_17_000001_add_ticker_text_to_settings_table', 6),
(97, '2026_08_17_000001_create_home_sections_table', 7),
(98, '2026_08_19_000002_add_photo_dark_id_to_settings_table', 8),
(99, '2026_08_21_000001_add_email_verification_fields_to_users_table', 9),
(100, '2026_08_21_000002_add_email_verification_enabled_to_settings_table', 9),
(101, '2026_08_22_000001_add_share_token_to_photos_table', 10),
(102, '2026_08_23_000001_add_slider_autoplay_seconds_to_settings_table', 11),
(103, '2026_08_24_000001_add_ip_language_detection_enabled_to_settings_table', 12),
(104, '2026_08_24_000002_add_user_id_to_comments_table', 13),
(105, '2026_08_25_000001_create_notification_settings_table', 14),
(106, '2026_08_26_000001_add_timezone_to_settings_table', 15),
(107, '2026_08_27_000001_create_product_categories_table', 16),
(108, '2026_08_27_000002_create_brands_table', 16),
(109, '2026_08_27_000003_create_products_table', 16),
(110, '2026_09_04_000001_create_funds_table', 17),
(111, '2026_09_04_000002_create_payment_methods_table', 17),
(112, '2026_09_04_000003_create_donations_table', 17),
(113, '2026_08_31_000001_add_video_and_shipping_info_to_products_table', 18),
(114, '2026_08_31_000002_create_product_attributes_table', 18),
(115, '2026_09_06_100001_add_video_and_shipping_fields_to_products_table', 19),
(116, '2026_09_06_100002_create_product_variant_groups_table', 19),
(117, '2026_09_06_100003_create_product_variant_options_table', 19),
(118, '2026_09_06_100004_create_product_reviews_table', 20),
(119, '2026_09_07_000001_create_addresses_table', 21),
(120, '2026_09_07_000002_create_shop_orders_table', 22),
(121, '2026_09_07_000003_create_shop_order_items_table', 22),
(122, '2026_09_09_000001_add_payment_method_id_to_shop_orders_table', 23),
(123, '2026_09_09_000002_add_show_in_shop_to_payment_methods_table', 24),
(124, '2026_09_11_000001_create_shop_payment_methods_table', 25),
(125, '2026_09_11_000002_repoint_shop_orders_payment_method_fk', 25),
(126, '2026_09_11_000003_drop_show_in_shop_from_payment_methods_table', 25),
(127, '2026_09_08_000001_create_pickup_locations_table', 26),
(128, '2026_09_08_000002_create_coupons_table', 26),
(129, '2026_09_10_000001_add_pickup_and_coupon_to_shop_orders_table', 26),
(130, '2026_09_14_000001_create_profile_update_requests_table', 27),
(131, '2026_09_15_000001_create_role_permissions_and_user_active', 28),
(132, '2026_09_16_000000_add_pos_support', 29),
(133, '2026_09_18_000000_add_pos_refunds_and_offline', 30),
(134, '2026_09_19_000001_create_game_settings_table', 31),
(135, '2026_09_19_000002_create_game_ads_table', 31),
(136, '2026_09_19_000003_create_game_plays_table', 31),
(137, '2026_09_19_000004_add_points_to_users_table', 31),
(138, '2026_09_20_000001_add_ad_progress_to_game_plays_table', 32),
(139, '2026_09_19_000000_add_returns_and_whatsapp_order', 33),
(140, '2026_09_21_000001_add_game_options_and_trade_fields', 34),
(141, '2026_09_16_000001_create_wallet_foundation_tables', 35),
(142, '2026_09_17_000001_create_currency_exchange_tables', 35),
(143, '2026_09_18_000001_create_marketplace_tables', 35),
(144, '2026_09_22_000001_create_currencies_table', 36),
(145, '2026_09_22_000002_create_wallet_topup_requests_table', 36),
(146, '2026_09_28_000001_add_font_sizes_to_header_footer_settings_table', 37),
(147, '2026_09_29_000001_add_fulfillment_steps_to_p2p_orders', 38);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(2, 11, 'welcome', 'hi এখন বাংলা ফন্টে লেখা যাচ্ছে কিন্তু দ্বিতীয়বার আবার কোন ডাটা কিছু এডিট করতে বা সংযুক্ত করতে গেলে সেভ হচ্ছে না', '2026-08-14 22:14:02', '2026-08-14 22:40:32'),
(3, 11, 'my Todo', 'This my first note\nGood morning \nToday Visit  Matiara, Cumilla', '2026-08-14 22:14:45', '2026-08-16 09:08:37'),
(4, 12, NULL, '01812345678\r\nAjker bazar\r\n20/08/2026', '2026-08-14 22:16:20', '2026-08-14 22:16:20'),
(5, 12, 'Todo', 'My note 15/08/2026 হ্যালো', '2026-08-14 22:17:17', '2026-08-15 21:45:45'),
(6, 11, 'bangla', 'ইংরেজি ফন্টে লিখলে সেভ হচ্ছে। কিন্তু বাংলা ফন্টে লিখতে গেলে সেভ হচ্ছে না', '2026-08-14 22:23:45', '2026-08-14 22:23:45'),
(8, 13, 'Todo', 'This is my notepad', '2026-08-14 22:42:33', '2026-08-14 22:42:33'),
(9, 13, 'বনলতা এক্সপ্রেস', 'বনলতা এক্সপ্রেস (ট্রেন নং-৭৯১/৭৯২) বাংলাদেশ রেলওয়ে পরিচালিত দেশের দুই গুরুত্বপূর্ণ মহানগরী (রাজশাহী - ঢাকা) ও (ঢাকা - রাজশাহী) রুটে চলাচলকারী বিরতিহীন (NONSTOP) আন্তঃনগর ট্রেন। পরে ট্রেনটির রুট চাঁপাইনবাবগঞ্জ পর্যন্ত বর্ধিত করা হয়। রাজশাহী বেজের প্রধান VIP ট্রেন। এটি ব্রডগেজের প্রথম বিরতিহীন (NONSTOP) এবং সর্বোচ্চ (LUXURIOUS) ট্রেন। ট্রেনটিতে STARLINK এর হাইস্পীড Wi-Fi কানেকশনের ব্যবস্থা আছে।\n\nইতিহাস\n২০১৯ সালের ২৫ এপ্রিল বৃহস্পতিবার বেলা ১১টার দিকে সবুজ পতাকা নেড়ে ও বাঁশি বাজিয়ে ভিডিও কনফারেন্সের মাধ্যমে রাজশাহী-ঢাকা রুটে বিরতিহীন আন্তঃনগর এক্সপ্রেস বনলতার উদ্বোধন করেন তৎকালীন প্রধানমন্ত্রী শেখ হাসিনা। তখন রাজশাহী থেকে ভিডিও কনফারেন্সে উদ্বোধনী অনুষ্ঠানে যোগ দেন তৎকালীন রেলমন্ত্রী নুরুল ইসলাম সুজন ও রাজশাহী সিটি কর্পোরেশনের তৎকালীন মেয়র এ এইচ এম খায়রুজ্জামান লিটন। তবে কিছুদিন চলার পর ১৭ই জুলাই ২০১৯ তারিখে ট্রেনটির রুট চাঁপাইনবাবগঞ্জ পর্যন্ত বর্ধিত করা হয়। এর কিছু দিন পর ২০২০ সালের জানুয়ারির প্রথম দিকে এর ট্রেনটির অত্যাধুনিক প্রযুক্তির পিটি ইনকার রেকটি চিলাহাটী ঢাকা রুটের আন্তনগর নীলসাগর এক্সপ্রেস ট্রেনটিকে দিয়ে ভারত থেকে আমদানিকৃত অত্যাধুনিক বিলাসবহুল এলএইচবি রেক বনলতা এক্সপ্রেস ট্রেনে যুক্ত করা হয়।[২]\n\nনামকরণ\nততকালীন প্রধানমন্ত্রী শেখ হাসিনা কবি জীবনানন্দ দাশ এর বিখ্যাত কবিতা এর চরিত্র বনলতা সেন থেকে এর নামকরণ করছেন। যেহেতু বনলতা সেন নাটোরের তাই অঞ্চল বিবেচনায় এর নাম বনলতা এক্সপ্রেস হয়।', '2026-08-14 22:43:12', '2026-08-14 22:43:12'),
(10, 11, '১৫/০৮/২০২৬', 'বাডুর বাসায় যাব badu bashai jabo। Geyechilam', '2026-08-15 07:17:06', '2026-08-17 22:17:38'),
(11, 12, 'Gchjvv', 'এইচজি থেকে শুরু হয়ে যাবে না বলে', '2026-08-15 21:45:59', '2026-08-15 21:45:59'),
(12, 11, 'জেলার নাম', 'ঢাকা, গাজীপুর, নারায়ণগঞ্জ, নরসিংদী, মুন্সিগঞ্জ, মানিকগঞ্জ, টাঙ্গাইল, কিশোরগঞ্জ, ফরিদপুর, গোপালগঞ্জ, মাদারীপুর, শরীয়তপুর, রাজবাড়ী, চট্টগ্রাম, কক্সবাজার, কুমিল্লা, ব্রাহ্মণবাড়িয়া, চাঁদপুর, ফেনী, নোয়াখালী, লক্ষ্মীপুর, খাগড়াছড়ি, রাঙ্গামাটি, বান্দরবান, সিলেট, মৌলভীবাজার, হবিগঞ্জ, সুনামগঞ্জ, রাজশাহী, নাটোর, নওগাঁ, চাঁপাইনবাবগঞ্জ, পাবনা, সিরাজগঞ্জ, বগুড়া, জয়পুরহাট, রংপুর, দিনাজপুর, ঠাকুরগাঁও, পঞ্চগড়, নীলফামারী, লালমনিরহাট, কুড়িগ্রাম, খুলনা, বাগেরহাট, সাতক্ষীরা, যশোর, ঝিনাইদহ, মাগুরা, নড়াইল, কুষ্টিয়া, চুয়াডাঙ্গা, মেহেরপুর, বরিশাল, পটুয়াখালী, ভোলা, পিরোজপুর, ঝালকাঠি, বরগুনা, ময়মনসিংহ, জামালপুর, শেরপুর, নেত্রকোনা।', '2026-08-16 21:58:52', '2026-08-16 21:59:07'),
(13, 14, 'Todo', 'save inoculation', '2026-08-20 20:53:49', '2026-08-20 20:53:49'),
(14, 16, 'Welcome', 'hello hi i am new user. 24/08/2026', '2026-08-21 10:22:36', '2026-08-24 10:00:59'),
(15, 17, 'আমার', 'আমি চাচ্ছি ল্যাংগুয়েজ বাটনের অবস্থান পরিবর্তন', '2026-08-21 14:40:39', '2026-08-21 14:40:53'),
(16, 1, 'ToDo', 'Continue from where you stopped\ncd /home/httsysco/public_html/test.httsys.com\nphp artisan optimize:clear\nphp artisan migrate\nphp artisan cache:clear', '2026-08-21 15:04:59', '2026-08-23 21:20:37'),
(17, 17, 'Client requirement', 'Mostak Net	Mostak	01744-234960	Bakshimul 200 user 50 commission\n\nUniversity Online	Titu	01953109792 	Kotbari 150 user 50 commission \n\nIsrafil internet	Israfil	01892677683	Pir Jatrapur, Sadakpur 160 user 50 commission \n\nFariya network	Mohin	01887954061	Chauddagram 500 user 60 commission\n\nNoyon wifi	Noyon	01855-177722	Bizra 300 user 60 commission', '2026-09-13 17:14:04', '2026-09-13 17:14:04'),
(18, 16, 'My Orders', '\"আগের কাজ শেষের অংশ থেকে শুরু করুন\"', '2026-09-14 01:33:36', '2026-09-14 01:33:36'),
(19, 16, '14-09-26', 'ক্লিক করলে এমন দেখায়', '2026-09-14 01:34:14', '2026-09-14 01:34:14'),
(20, 1, 'Claude', 'এখানে আমার লাইভ ওয়েবসাইটের জিপ ফাইল ডাটাবেস ফাইল দেয়া হয়েছে। আমি চাচ্ছি এখানে যতগুলো স্ক্রিনশট দেয়া হয়েছে সেগুলো ভালো করে পর্যবেক্ষণ করুন।একটা জিনিস মনে রাখবেন যতটুক কাজ করেছেন ততটুক মনে রাখবেন। পরবর্তীতে কোন কারণে টোকেন শেষ হয়ে গেলে বা অন্য সময় আগে যেখানে কাজ শেষ করেছেন সেখান থেকে শুরু করুন কমান্ড দিলে সেই আগের কাজ শেষের অংশ থেকে তাতে শুরু করতে পারেন। আরেকটা জিনিস মনে রাখবেন আমার ওয়েবসাইটের php version 7.3 এবং নতুন ডাটাবেজ টেবল ক্রিয়েট করার সময় আমার ডাটাবেজ ভালো করে চেক করে তারপর নতুন টা তৈরি করবেন।', '2026-09-19 01:55:05', '2026-09-19 01:55:05'),
(21, 1, '\"আগের কাজ শেষের অংশ থেকে শুরু করুন\"', 'cd /home/httsysco/public_html/test.httsys.com', '2026-09-19 01:55:33', '2026-09-19 01:55:51'),
(22, 1, 'weeding video', 'https://httsys.com/media/view/MvT115y6a2Fau8W63OWsEAeLp6E8z7tKyIxZDyRv', '2026-09-19 01:56:57', '2026-09-19 01:56:57'),
(23, 1, NULL, 'php artisan config:clear\nphp artisan route:clear\nphp artisan cache:clear', '2026-09-19 01:57:23', '2026-09-19 01:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

CREATE TABLE `notification_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `photo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `badge_text` varchar(191) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `button_text` varchar(191) DEFAULT NULL,
  `button_link` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_settings`
--

INSERT INTO `notification_settings` (`id`, `language_id`, `is_enabled`, `photo_id`, `badge_text`, `title`, `description`, `button_text`, `button_link`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'Contact', 'Welcome', 'ওয়েব ডিজাইন ওয়েবসাইটের উৎপাদন এবং রক্ষণাবেক্ষণে বিভিন্ন দক্ষতা এবং শৃঙ্খলাকে অন্তর্ভুক্ত করে। ওয়েব ডিজাইনের বিভিন্ন ক্ষেত্রের মধ্যে রয়েছে ওয়েব গ্রাফিক ডিজাইন, ইন্টারফেস ডিজাইন, প্রমিত কোড সহ।', 'সাবমিট', 'https://test.httsys.com/login', '2026-08-25 12:36:21', '2026-08-25 12:41:52'),
(2, 2, 1, 262, 'HT Tech system', 'Welcome', 'ওয়েব ডিজাইন ওয়েবসাইটের উৎপাদন এবং রক্ষণাবেক্ষণে বিভিন্ন দক্ষতা এবং শৃঙ্খলাকে অন্তর্ভুক্ত করে। ওয়েব ডিজাইনের বিভিন্ন ক্ষেত্রের মধ্যে রয়েছে ওয়েব গ্রাফিক ডিজাইন, ইন্টারফেস ডিজাইন, প্রমিত কোড সহ।', 'Submit', 'https://test.httsys.com/login', '2026-08-25 12:36:21', '2026-08-25 14:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `pricing_id` int(11) NOT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `amount` double(8,2) UNSIGNED DEFAULT NULL,
  `payment_status` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `pricing_id`, `transaction_id`, `amount`, `payment_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '63224971', 5.00, 0, '2021-06-09 18:58:13', '2021-06-09 18:58:13', NULL),
(2, 1, 1, '40859269', 5.00, 0, '2021-06-09 19:07:57', '2021-06-09 19:07:57', NULL),
(3, 1, 1, '87126729', 5.00, 0, '2021-06-09 19:08:34', '2021-06-09 19:08:34', NULL),
(4, 1, 1, '95156667', 5.00, 0, '2021-06-09 19:08:54', '2021-06-09 19:08:54', NULL),
(5, 1, 1, '72560519', 5.00, 0, '2021-06-09 19:10:39', '2021-06-09 19:10:39', NULL),
(6, 1, 1, '36843852', 5.00, 0, '2021-06-09 19:11:19', '2021-06-09 19:11:19', NULL),
(7, 1, 1, '54336862', 5.00, 0, '2021-06-09 19:15:51', '2021-06-09 19:15:51', NULL),
(8, 1, 1, '21932173', 5.00, 0, '2021-06-09 19:16:12', '2021-06-09 19:16:12', NULL),
(9, 1, 1, '10907697', 5.00, 0, '2021-06-09 19:16:50', '2021-06-09 19:16:50', NULL),
(10, 1, 1, '98960638', 5.00, 0, '2021-06-09 19:17:44', '2021-06-09 19:17:44', NULL),
(11, 1, 1, '60297663', 5.00, 0, '2021-06-09 19:18:01', '2021-06-09 19:18:01', NULL),
(12, 1, 1, '45298363', 5.00, 0, '2021-06-09 19:22:36', '2021-06-09 19:22:36', NULL),
(13, 1, 1, '65640608', 5.00, 0, '2021-06-09 19:23:39', '2021-06-09 19:23:39', NULL),
(14, 1, 1, '48939601', 5.00, 0, '2021-06-09 19:28:15', '2021-06-09 19:28:15', NULL),
(15, 1, 1, '55553551', 5.00, 0, '2021-06-09 19:28:49', '2021-06-09 19:28:49', NULL),
(16, 1, 1, '85930629', 5.00, 0, '2021-06-09 21:22:20', '2021-06-09 21:22:20', NULL),
(17, 1, 1, '77016119', 5.00, 0, '2021-06-10 05:12:54', '2021-06-10 05:12:54', NULL),
(18, 1, 1, '72444810', 5.00, 0, '2021-06-10 08:40:22', '2021-06-10 08:40:22', NULL),
(19, 1, 1, '61309735', 5.00, 0, '2021-06-10 08:41:23', '2021-06-10 08:41:23', NULL),
(20, 1, 1, '93593647', 5.00, 0, '2021-06-10 17:55:06', '2021-06-10 17:55:06', NULL),
(21, 1, 1, '80539520', 5.00, 0, '2021-06-10 18:02:08', '2021-06-10 18:02:08', NULL),
(22, 1, 1, '86256916', 5.00, 0, '2021-06-10 18:02:21', '2021-06-10 18:02:21', NULL),
(23, 1, 1, '54983637', 5.00, 0, '2021-06-10 18:03:16', '2021-06-10 18:03:16', NULL),
(24, 1, 1, '59425412', 5.00, 0, '2021-06-10 18:03:23', '2021-06-10 18:03:23', NULL),
(25, 1, 1, '34198675', 5.00, 0, '2021-06-10 18:03:41', '2021-06-10 18:03:41', NULL),
(26, 1, 1, '24471871', 5.00, 0, '2021-06-10 18:04:30', '2021-06-10 18:04:30', NULL),
(27, 1, 1, '42274701', 5.00, 0, '2021-06-10 18:05:10', '2021-06-10 18:05:10', NULL),
(28, 1, 1, '66822383', 5.00, 0, '2021-06-10 18:05:37', '2021-06-10 18:05:37', NULL),
(29, 1, 1, '78337109', 5.00, 0, '2021-06-10 18:05:50', '2021-06-10 18:05:50', NULL),
(30, 1, 1, '71413027', 5.00, 0, '2021-06-10 18:06:14', '2021-06-10 18:06:14', NULL),
(31, 1, 1, '38620334', 5.00, 0, '2021-06-10 18:10:41', '2021-06-10 18:10:41', NULL),
(32, 1, 1, '62686281', 5.00, 0, '2021-06-10 18:10:58', '2021-06-10 18:10:58', NULL),
(33, 1, 1, '93409193', 5.00, 0, '2021-06-10 18:11:21', '2021-06-10 18:11:21', NULL),
(34, 1, 1, '74753508', 5.00, 0, '2021-06-10 18:18:39', '2021-06-10 18:18:39', NULL),
(35, 1, 1, '23874215', 5.00, 0, '2021-06-10 18:47:28', '2021-06-10 18:47:28', NULL),
(36, 1, 1, '26502310', 5.00, 0, '2021-06-10 18:49:06', '2021-06-10 18:49:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_returns`
--

CREATE TABLE `order_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(191) NOT NULL,
  `status` enum('pending','accepted','rejected') NOT NULL DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_returns`
--

INSERT INTO `order_returns` (`id`, `order_id`, `user_id`, `reason`, `status`, `admin_note`, `reviewed_by`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(1, 9, 16, 'color not match', 'pending', NULL, NULL, NULL, '2026-09-22 01:56:18', '2026-09-22 01:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_return_items`
--

CREATE TABLE `order_return_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_return_items`
--

INSERT INTO `order_return_items` (`id`, `return_id`, `order_item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 1, '2026-09-22 01:56:18', '2026-09-22 01:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL,
  `photo_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `body` text NOT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `language_id`, `user_id`, `photo_id`, `title`, `slug`, `body`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'GDPR', 'gdpr', '<p>We, at <strong>HT Tech system</strong> <a href=\"/\">httsys.com</a>, ensure to maintain the highest standards of transactional security and quality so that your information and details are secure. To know more about our policies please read the following to learn about our information gathering and dissemination practices.</p>\r\n<p>Note: Kindly note that our privacy policy is subject to change at any time without prior notice. To ensure that you are aware of any changes, please review this policy at regular intervals.</p>\r\n<p>By visiting this website you agree to be bound by the terms and conditions of this Privacy Policy. Any disagreement will be subject to the jurisdiction of Dhaka, Bangladesh.</p>\r\n<p>By mere use of the Website, you express consent to our use and disclosure of your personal information in accordance with this Privacy Policy. This Privacy Policy is incorporated into and subject to the Terms of Use</p>\r\n<p><strong>1. Collection of Personally Identifiable Information and other Information</strong><br />When you use our Website, we store your browsing information so that we canprovide services and features that meet your needs,.</p>\r\n<p>In general, you can browse the Website without telling us who you are or revealing any personal information about yourself. Once you give us your personal information, you are not anonymous to us. You always have the option to not provide information by choosing not to use a particular service or feature on the Website. We compile your usage behaviour and personal information and the information on an aggregate basus to internal research to better enhance our product offerings to serve you better.. This information may include the URL that you just came from (whether this URL is on our Website or not), which URL you next go to (whether this URL is on our Website or not), your computer browser information, and your IP address.</p>\r\n<p>We use data collection devices such as \"cookies (small file stored on your computer)\" on certain pages of the Website to help analyse our web page flow, measure promotional effectiveness, and promote trust and safety. We offer certain features that are only available through the use of a \"cookie\".</p>\r\n<p>Additionally, third parties may also place cookies or similar devices on our website, which we cannot control. If you choose to buy on the Website, we collect information about your buying behaviour.</p>\r\n<p>If you transact with us, we collect some additional information, such as a billing address, a credit / debit card number and a credit / debit card expiration date and/ or other payment instrument details.If you post messages or leave a feedback for us, we will collect that information you provide to us. We retain this information as necessary to resolve disputes, provide customer support and troubleshoot problems as permitted by law.</p>\r\n<p>If you send us personal correspondence, such as emails or letters, or if other users or third parties send us correspondence about your activities or postings on the Website, we may collect such information into a file specific to you.</p>\r\n<p>We collect personally identifiable information (email address, name, phone number.) from you when you set up a free account with us. We do use your contact information to send you offers based on your previous orders and your interests. However, data protection is a matter of trust and your privacy is important to us. We shall therefore use your name and other information which relates to you in the manner set out in this Privacy Policy. We will only collect information where it is necessary for us to do so and we will only collect information</p>\r\n<p><strong>2. Sharing of personal information</strong><br />We will only share personal information with companies, organizations or individuals outside the periphery of HT Tech system httsys.com if we have a good-faith and believe that access, use, preservation or disclosure of the information is reasonably necessary to:</p>\r\n<p>meet any applicable law, regulation, legal process or enforceable governmental request.<br />enforce applicable Terms of Service, including investigation of potential violations.<br />detect, prevent, or otherwise address fraud, security or technical issues.<br />protect against harm to the rights, property or safety of <strong>HT Tech sytem</strong> <a href=\"/\">httsyscom</a>, our users or the public as required or permitted by law.<br />We may share aggregated, non-personally identifiable information publicly and with our partners &ndash; like bus operators, agents or connected sites. For example, we may share information publicly to show trends about the general use of our services. We may also share consolidated information provided by like-minded users with bus operators without ever taking individual names, email ids or other contact details.</p>\r\n<p>If <strong>HT Tech system</strong> <a href=\"/\">httsys.com</a> is involved in a merger, acquisition or asset sale, we will continue to ensure the confidentiality of your personal information and give notice before personal information is transferred or becomes subject to a different privacy policy.</p>\r\n<p><strong>3. Collecting and Using Your Personal Data</strong><br />Information Collected while Using the Application<br />While using Our Application, in order to provide features of Our Application, We may collect, with your prior permission:</p>\r\n<p>Information regarding your location<br />Information from your Device\'s phone book (contacts list)<br />Pictures and other information from your Device\'s camera and photo library</p>\r\n<p>We use this information to provide features of Our Service, to improve and customize Our Service. The information may be uploaded to the Company\'s servers and/or it may be simply stored on your device.</p>\r\n<p>Contact List Sync for Mobile Recharge Product:<br />For recharge service, we are collecting your device&rsquo;s phone book (contact list) and send it to our api through a secure and encrypted channel solely owned and controlled by httsys.com. Detailed terms &amp; conditions for recharge product can be found in app under the recharge section.</p>\r\n<p>You can enable or disable access to this information at any time, through Your Device settings. We don&rsquo;t store or share any of your personal data to any other third party channel. Your data security is important to us and we only process this data through <strong>HT Tech system</strong> own channel to ensure features of our services.</p>\r\n<p>If you have any questions about this Privacy Policy, You can contact us by email: <a href=\"mailto:support@httsys.com\">support@httsys.com</a> or <a href=\"mailto:httechsystem@gmail.com\">httechsystem@gmail.com</a></p>\r\n<p>4. Security Precautions<br />Our Website has stringent security measures in place to protect the loss, misuse, and alteration of the information under our control. Whenever you change or access your account information, we offer the use of a secure server. As informed earlier in this policy, once we receive your information we ensure strict security guidelines to protect it against unauthorized access. For example, we use SSL security to protect users against identity theft &amp; spyware.</p>\r\n<p>5. Your Consent<br />By using the Website and/ or by providing your information, you consent to the collection and use of the information you disclose on the Website in accordance with this Privacy Policy, including but not limited to your consent for sharing your information as per this privacy policy.</p>\r\n<p>We may decide to make amends to this privacy policy without prior information, therefore, it is suggested you review this page at regular intervals. This ensures you are up-to-date with the details of the information we collect, how we use it, and under what circumstances we disclose it.</p>\r\n<p>&nbsp;</p>', 'GDPR', 'The General Data Protection Regulation We, at HT Tech system httsys.com, ensure to maintain the highest standards of transactional security and quality so that your information and details are secure.', '2021-03-14 20:56:16', '2023-07-06 08:31:09'),
(2, 1, 1, NULL, 'Terms and conditions', 'terms-conditions', '<p>We, at <strong>HT Tech system</strong> <a href=\"/\">httsys.com</a>, ensure to maintain the highest standards of transactional security and quality so that your information and details are secure. To know more about our policies please read the following to learn about our information gathering and dissemination practices.</p>\r\n<p>Note: Kindly note that our privacy policy is subject to change at any time without prior notice. To ensure that you are aware of any changes, please review this policy at regular intervals.</p>\r\n<p>By visiting this website you agree to be bound by the terms and conditions of this Privacy Policy. Any disagreement will be subject to the jurisdiction of Dhaka, Bangladesh.</p>\r\n<p>By mere use of the Website, you express consent to our use and disclosure of your personal information in accordance with this Privacy Policy. This Privacy Policy is incorporated into and subject to the Terms of Use</p>\r\n<p><strong>1. Collection of Personally Identifiable Information and other Information</strong><br />When you use our Website, we store your browsing information so that we canprovide services and features that meet your needs,.</p>\r\n<p>In general, you can browse the Website without telling us who you are or revealing any personal information about yourself. Once you give us your personal information, you are not anonymous to us. You always have the option to not provide information by choosing not to use a particular service or feature on the Website. We compile your usage behaviour and personal information and the information on an aggregate basus to internal research to better enhance our product offerings to serve you better.. This information may include the URL that you just came from (whether this URL is on our Website or not), which URL you next go to (whether this URL is on our Website or not), your computer browser information, and your IP address.</p>\r\n<p>We use data collection devices such as \"cookies (small file stored on your computer)\" on certain pages of the Website to help analyse our web page flow, measure promotional effectiveness, and promote trust and safety. We offer certain features that are only available through the use of a \"cookie\".</p>\r\n<p>Additionally, third parties may also place cookies or similar devices on our website, which we cannot control. If you choose to buy on the Website, we collect information about your buying behaviour.</p>\r\n<p>If you transact with us, we collect some additional information, such as a billing address, a credit / debit card number and a credit / debit card expiration date and/ or other payment instrument details.If you post messages or leave a feedback for us, we will collect that information you provide to us. We retain this information as necessary to resolve disputes, provide customer support and troubleshoot problems as permitted by law.</p>\r\n<p>If you send us personal correspondence, such as emails or letters, or if other users or third parties send us correspondence about your activities or postings on the Website, we may collect such information into a file specific to you.</p>\r\n<p>We collect personally identifiable information (email address, name, phone number.) from you when you set up a free account with us. We do use your contact information to send you offers based on your previous orders and your interests. However, data protection is a matter of trust and your privacy is important to us. We shall therefore use your name and other information which relates to you in the manner set out in this Privacy Policy. We will only collect information where it is necessary for us to do so and we will only collect information</p>\r\n<p><strong>2. Sharing of personal information</strong><br />We will only share personal information with companies, organizations or individuals outside the periphery of HT Tech system httsys.com if we have a good-faith and believe that access, use, preservation or disclosure of the information is reasonably necessary to:</p>\r\n<p>meet any applicable law, regulation, legal process or enforceable governmental request.<br />enforce applicable Terms of Service, including investigation of potential violations.<br />detect, prevent, or otherwise address fraud, security or technical issues.<br />protect against harm to the rights, property or safety of <strong>HT Tech sytem</strong> <a href=\"/\">httsyscom</a>, our users or the public as required or permitted by law.<br />We may share aggregated, non-personally identifiable information publicly and with our partners &ndash; like bus operators, agents or connected sites. For example, we may share information publicly to show trends about the general use of our services. We may also share consolidated information provided by like-minded users with bus operators without ever taking individual names, email ids or other contact details.</p>\r\n<p>If <strong>HT Tech system</strong> <a href=\"/\">httsys.com</a> is involved in a merger, acquisition or asset sale, we will continue to ensure the confidentiality of your personal information and give notice before personal information is transferred or becomes subject to a different privacy policy.</p>\r\n<p><strong>3. Collecting and Using Your Personal Data</strong><br />Information Collected while Using the Application<br />While using Our Application, in order to provide features of Our Application, We may collect, with your prior permission:</p>\r\n<p>Information regarding your location<br />Information from your Device\'s phone book (contacts list)<br />Pictures and other information from your Device\'s camera and photo library</p>\r\n<p>We use this information to provide features of Our Service, to improve and customize Our Service. The information may be uploaded to the Company\'s servers and/or it may be simply stored on your device.</p>\r\n<p>Contact List Sync for Mobile Recharge Product:<br />For recharge service, we are collecting your device&rsquo;s phone book (contact list) and send it to our api through a secure and encrypted channel solely owned and controlled by httsys.com. Detailed terms &amp; conditions for recharge product can be found in app under the recharge section.</p>\r\n<p>You can enable or disable access to this information at any time, through Your Device settings. We don&rsquo;t store or share any of your personal data to any other third party channel. Your data security is important to us and we only process this data through <strong>HT Tech system</strong> own channel to ensure features of our services.</p>\r\n<p>If you have any questions about this Privacy Policy, You can contact us by email: <a href=\"mailto:support@httsys.com\">support@httsys.com</a> or <a href=\"mailto:httechsystem@gmail.com\">httechsystem@gmail.com</a></p>\r\n<p>4. Security Precautions<br />Our Website has stringent security measures in place to protect the loss, misuse, and alteration of the information under our control. Whenever you change or access your account information, we offer the use of a secure server. As informed earlier in this policy, once we receive your information we ensure strict security guidelines to protect it against unauthorized access. For example, we use SSL security to protect users against identity theft &amp; spyware.</p>\r\n<p>5. Your Consent<br />By using the Website and/ or by providing your information, you consent to the collection and use of the information you disclose on the Website in accordance with this Privacy Policy, including but not limited to your consent for sharing your information as per this privacy policy.</p>\r\n<p>We may decide to make amends to this privacy policy without prior information, therefore, it is suggested you review this page at regular intervals. This ensures you are up-to-date with the details of the information we collect, how we use it, and under what circumstances we disclose it.</p>\r\n<p>&nbsp;</p>', 'Terms and conditions', 'Terms and conditions We, at HT Tech system httsys.com, ensure to maintain the highest standards of transactional security and quality so that your information and details are secure.', '2021-03-14 21:07:27', '2023-07-06 08:29:54'),
(3, 1, 1, 260, 'Privacy Policy', 'privacy-policy', '<p>We, at <strong>HT Tech system</strong> <a href=\"/\">httsys.com</a>, ensure to maintain the highest standards of transactional security and quality so that your information and details are secure. To know more about our policies please read the following to learn about our information gathering and dissemination practices.</p>\r\n<p>Note: Kindly note that our privacy policy is subject to change at any time without prior notice. To ensure that you are aware of any changes, please review this policy at regular intervals.</p>\r\n<p>By visiting this website you agree to be bound by the terms and conditions of this Privacy Policy. Any disagreement will be subject to the jurisdiction of Dhaka, Bangladesh.</p>\r\n<p>By mere use of the Website, you express consent to our use and disclosure of your personal information in accordance with this Privacy Policy. This Privacy Policy is incorporated into and subject to the Terms of Use</p>\r\n<p><strong>1. Collection of Personally Identifiable Information and other Information</strong><br />When you use our Website, we store your browsing information so that we canprovide services and features that meet your needs,.</p>\r\n<p>In general, you can browse the Website without telling us who you are or revealing any personal information about yourself. Once you give us your personal information, you are not anonymous to us. You always have the option to not provide information by choosing not to use a particular service or feature on the Website. We compile your usage behaviour and personal information and the information on an aggregate basus to internal research to better enhance our product offerings to serve you better.. This information may include the URL that you just came from (whether this URL is on our Website or not), which URL you next go to (whether this URL is on our Website or not), your computer browser information, and your IP address.</p>\r\n<p>We use data collection devices such as \"cookies (small file stored on your computer)\" on certain pages of the Website to help analyse our web page flow, measure promotional effectiveness, and promote trust and safety. We offer certain features that are only available through the use of a \"cookie\".</p>\r\n<p>Additionally, third parties may also place cookies or similar devices on our website, which we cannot control. If you choose to buy on the Website, we collect information about your buying behaviour.</p>\r\n<p>If you transact with us, we collect some additional information, such as a billing address, a credit / debit card number and a credit / debit card expiration date and/ or other payment instrument details.If you post messages or leave a feedback for us, we will collect that information you provide to us. We retain this information as necessary to resolve disputes, provide customer support and troubleshoot problems as permitted by law.</p>\r\n<p>If you send us personal correspondence, such as emails or letters, or if other users or third parties send us correspondence about your activities or postings on the Website, we may collect such information into a file specific to you.</p>\r\n<p>We collect personally identifiable information (email address, name, phone number.) from you when you set up a free account with us. We do use your contact information to send you offers based on your previous orders and your interests. However, data protection is a matter of trust and your privacy is important to us. We shall therefore use your name and other information which relates to you in the manner set out in this Privacy Policy. We will only collect information where it is necessary for us to do so and we will only collect information</p>\r\n<p><strong>2. Sharing of personal information</strong><br />We will only share personal information with companies, organizations or individuals outside the periphery of HT Tech system httsys.com if we have a good-faith and believe that access, use, preservation or disclosure of the information is reasonably necessary to:</p>\r\n<p>meet any applicable law, regulation, legal process or enforceable governmental request.<br />enforce applicable Terms of Service, including investigation of potential violations.<br />detect, prevent, or otherwise address fraud, security or technical issues.<br />protect against harm to the rights, property or safety of <strong>HT Tech sytem</strong> <a href=\"/\">httsyscom</a>, our users or the public as required or permitted by law.<br />We may share aggregated, non-personally identifiable information publicly and with our partners &ndash; like bus operators, agents or connected sites. For example, we may share information publicly to show trends about the general use of our services. We may also share consolidated information provided by like-minded users with bus operators without ever taking individual names, email ids or other contact details.</p>\r\n<p>If <strong>HT Tech system</strong> <a href=\"/\">httsys.com</a> is involved in a merger, acquisition or asset sale, we will continue to ensure the confidentiality of your personal information and give notice before personal information is transferred or becomes subject to a different privacy policy.</p>\r\n<p><strong>3. Collecting and Using Your Personal Data</strong><br />Information Collected while Using the Application<br />While using Our Application, in order to provide features of Our Application, We may collect, with your prior permission:</p>\r\n<p>Information regarding your location<br />Information from your Device\'s phone book (contacts list)<br />Pictures and other information from your Device\'s camera and photo library</p>\r\n<p>We use this information to provide features of Our Service, to improve and customize Our Service. The information may be uploaded to the Company\'s servers and/or it may be simply stored on your device.</p>\r\n<p>Contact List Sync for Mobile Recharge Product:<br />For recharge service, we are collecting your device&rsquo;s phone book (contact list) and send it to our api through a secure and encrypted channel solely owned and controlled by httsys.com. Detailed terms &amp; conditions for recharge product can be found in app under the recharge section.</p>\r\n<p>You can enable or disable access to this information at any time, through Your Device settings. We don&rsquo;t store or share any of your personal data to any other third party channel. Your data security is important to us and we only process this data through <strong>HT Tech system</strong> own channel to ensure features of our services.</p>\r\n<p>If you have any questions about this Privacy Policy, You can contact us by email: <a href=\"mailto:support@httsys.com\">support@httsys.com</a> or <a href=\"mailto:httechsystem@gmail.com\">httechsystem@gmail.com</a></p>\r\n<p>4. Security Precautions<br />Our Website has stringent security measures in place to protect the loss, misuse, and alteration of the information under our control. Whenever you change or access your account information, we offer the use of a secure server. As informed earlier in this policy, once we receive your information we ensure strict security guidelines to protect it against unauthorized access. For example, we use SSL security to protect users against identity theft &amp; spyware.</p>\r\n<p>5. Your Consent<br />By using the Website and/ or by providing your information, you consent to the collection and use of the information you disclose on the Website in accordance with this Privacy Policy, including but not limited to your consent for sharing your information as per this privacy policy.</p>\r\n<p>We may decide to make amends to this privacy policy without prior information, therefore, it is suggested you review this page at regular intervals. This ensures you are up-to-date with the details of the information we collect, how we use it, and under what circumstances we disclose it.</p>\r\n<p>&nbsp;</p>', 'Privacy Policy', 'We, at HT Tech system httsys.com, ensure to maintain the highest standards of transactional security and quality so that your information and details are secure. To know more about our policies please read the following to learn about our information gathering and dissemination practices.', '2021-03-14 21:08:41', '2023-03-08 11:11:54'),
(6, 2, 1, NULL, 'জিডিপিআর', 'gdpr', '<p>আমরা, এইচটি টেক সিস্টেম&nbsp;<a href=\"/\"> httsys.com</a>-এ, লেনদেন সংক্রান্ত নিরাপত্তা এবং গুণমানের সর্বোচ্চ মান বজায় রাখা নিশ্চিত করি যাতে আপনার তথ্য এবং বিবরণ সুরক্ষিত থাকে। আমাদের নীতিগুলি সম্পর্কে আরও জানতে আমাদের তথ্য সংগ্রহ এবং প্রচারের অনুশীলনগুলি সম্পর্কে জানতে অনুগ্রহ করে নিম্নলিখিতটি পড়ুন।</p>\r\n<p>দ্রষ্টব্য: অনুগ্রহ করে নোট করুন যে আমাদের গোপনীয়তা নীতি পূর্ব বিজ্ঞপ্তি ছাড়াই যেকোনো সময় পরিবর্তন সাপেক্ষে। আপনি যে কোনো পরিবর্তন সম্পর্কে সচেতন তা নিশ্চিত করতে, অনুগ্রহ করে নিয়মিত বিরতিতে এই নীতি পর্যালোচনা করুন।</p>\r\n<p>এই ওয়েবসাইট পরিদর্শন করে আপনি এই গোপনীয়তা নীতির শর্তাবলী দ্বারা আবদ্ধ হতে সম্মত হন। যেকোনো মতবিরোধ ঢাকা, বাংলাদেশের এখতিয়ারের অধীন হবে।</p>\r\n<p>শুধুমাত্র ওয়েবসাইট ব্যবহার করে, আপনি এই গোপনীয়তা নীতি অনুসারে আমাদের ব্যবহার এবং আপনার ব্যক্তিগত তথ্য প্রকাশের জন্য সম্মতি প্রকাশ করেন। এই গোপনীয়তা নীতি অন্তর্ভুক্ত করা হয়েছে এবং ব্যবহারের শর্তাবলী সাপেক্ষে</p>\r\n<p>1. ব্যক্তিগতভাবে সনাক্তকরণযোগ্য তথ্য এবং অন্যান্য তথ্য সংগ্রহ<br />আপনি যখন আমাদের ওয়েবসাইট ব্যবহার করেন, তখন আমরা আপনার ব্রাউজিং তথ্য সংরক্ষণ করি যাতে আমরা আপনার চাহিদা মেটাতে পারে এমন পরিষেবা এবং বৈশিষ্ট্যগুলি সরবরাহ করতে পারি।</p>\r\n<p>সাধারণভাবে, আপনি কে আমাদের না বলে বা নিজের সম্পর্কে কোনো ব্যক্তিগত তথ্য প্রকাশ না করে আপনি ওয়েবসাইটটি ব্রাউজ করতে পারেন। একবার আপনি আমাদের আপনার ব্যক্তিগত তথ্য দিলে, আপনি আমাদের কাছে বেনামী থাকবেন না। ওয়েবসাইটটিতে একটি নির্দিষ্ট পরিষেবা বা বৈশিষ্ট্য ব্যবহার না করার জন্য আপনার কাছে সর্বদা তথ্য প্রদান না করার বিকল্প রয়েছে। আমরা আপনার ব্যবহার আচরণ এবং ব্যক্তিগত তথ্য এবং একটি সামগ্রিক ভিত্তির তথ্য অভ্যন্তরীণ গবেষণায় সংকলন করি যাতে আপনাকে আরও ভালভাবে পরিবেশন করার জন্য আমাদের পণ্যের অফারগুলিকে আরও ভালভাবে উন্নত করা যায়। না), আপনি পরবর্তী কোন URL-এ যাবেন (এই URLটি আমাদের ওয়েবসাইটে আছে কি না), আপনার কম্পিউটার ব্রাউজারের তথ্য এবং আপনার IP ঠিকানা৷</p>\r\n<p>আমরা আমাদের ওয়েব পৃষ্ঠার প্রবাহ বিশ্লেষণ করতে, প্রচারমূলক কার্যকারিতা পরিমাপ করতে এবং বিশ্বাস ও নিরাপত্তার প্রচারে সহায়তা করতে ওয়েবসাইটের নির্দিষ্ট পৃষ্ঠাগুলিতে \"কুকিজ (আপনার কম্পিউটারে সংরক্ষিত ছোট ফাইল)\" এর মতো ডেটা সংগ্রহের ডিভাইস ব্যবহার করি। আমরা কিছু বৈশিষ্ট্য অফার করি যা শুধুমাত্র একটি \"কুকি\" ব্যবহারের মাধ্যমে উপলব্ধ।</p>\r\n<p>উপরন্তু, তৃতীয় পক্ষগুলি আমাদের ওয়েবসাইটে কুকি বা অনুরূপ ডিভাইস রাখতে পারে, যা আমরা নিয়ন্ত্রণ করতে পারি না। আপনি যদি ওয়েবসাইটে কেনাকাটা করতে চান, আমরা আপনার কেনার আচরণ সম্পর্কে তথ্য সংগ্রহ করি।</p>\r\n<p>আপনি যদি আমাদের সাথে লেনদেন করেন, আমরা কিছু অতিরিক্ত তথ্য সংগ্রহ করি, যেমন একটি বিলিং ঠিকানা, একটি ক্রেডিট/ডেবিট কার্ড নম্বর এবং একটি ক্রেডিট/ডেবিট কার্ডের মেয়াদ শেষ হওয়ার তারিখ এবং/অথবা অন্যান্য অর্থপ্রদানের উপকরণের বিবরণ৷ আপনি যদি বার্তা পোস্ট করেন বা আমাদের জন্য একটি প্রতিক্রিয়া জানান , আপনি আমাদের প্রদান করা তথ্য আমরা সংগ্রহ করব। বিরোধ নিষ্পত্তি, গ্রাহক সহায়তা প্রদান এবং আইন দ্বারা অনুমোদিত সমস্যা সমাধানের জন্য আমরা এই তথ্যটি প্রয়োজনীয় হিসাবে ধরে রাখি।</p>\r\n<p>আপনি যদি আমাদের ব্যক্তিগত চিঠিপত্র পাঠান, যেমন ইমেল বা চিঠি, অথবা যদি অন্য ব্যবহারকারী বা তৃতীয় পক্ষরা আমাদের ওয়েবসাইটে আপনার কার্যকলাপ বা পোস্টিং সম্পর্কে চিঠিপত্র পাঠায়, আমরা আপনার জন্য নির্দিষ্ট একটি ফাইলে এই ধরনের তথ্য সংগ্রহ করতে পারি।</p>\r\n<p>আপনি যখন আমাদের সাথে একটি বিনামূল্যে অ্যাকাউন্ট সেট আপ করেন তখন আমরা আপনার কাছ থেকে ব্যক্তিগতভাবে সনাক্তযোগ্য তথ্য (ইমেল ঠিকানা, নাম, ফোন নম্বর) সংগ্রহ করি। আমরা আপনার পূর্ববর্তী অর্ডার এবং আপনার আগ্রহের উপর ভিত্তি করে আপনাকে অফার পাঠাতে আপনার যোগাযোগের তথ্য ব্যবহার করি। যাইহোক, ডেটা সুরক্ষা একটি আস্থার বিষয় এবং আপনার গোপনীয়তা আমাদের কাছে গুরুত্বপূর্ণ। তাই আমরা এই গোপনীয়তা নীতিতে নির্ধারিত পদ্ধতিতে আপনার নাম এবং আপনার সাথে সম্পর্কিত অন্যান্য তথ্য ব্যবহার করব। আমরা শুধুমাত্র তথ্য সংগ্রহ করব যেখানে এটি করা আমাদের জন্য প্রয়োজনীয় এবং আমরা শুধুমাত্র তথ্য সংগ্রহ করব</p>\r\n<p>2. ব্যক্তিগত তথ্য শেয়ার করা<br />আমরা শুধুমাত্র এইচটি টেক সিস্টেম&nbsp; <a href=\"/\">httsys.com</a> এর পরিধির বাইরের কোম্পানি, সংস্থা বা ব্যক্তিদের সাথে ব্যক্তিগত তথ্য শেয়ার করব যদি আমাদের সৎ বিশ্বাস থাকে এবং বিশ্বাস করি যে তথ্যের অ্যাক্সেস, ব্যবহার, সংরক্ষণ বা প্রকাশ করা যুক্তিসঙ্গতভাবে প্রয়োজনীয়:</p>\r\n<p>কোনো প্রযোজ্য আইন, প্রবিধান, আইনি প্রক্রিয়া বা প্রয়োগযোগ্য সরকারি অনুরোধ পূরণ করুন।<br />সম্ভাব্য লঙ্ঘনের তদন্ত সহ প্রযোজ্য পরিষেবার শর্তাবলী প্রয়োগ করুন।<br />জালিয়াতি, নিরাপত্তা বা প্রযুক্তিগত সমস্যা সনাক্ত করা, প্রতিরোধ করা বা অন্যথায় সমাধান করা।<br />এইচটি টেক সিস্টেম&nbsp;<a href=\"/\">httsyscom</a>, আমাদের ব্যবহারকারী বা জনসাধারণের অধিকার, সম্পত্তি বা নিরাপত্তার ক্ষতির বিরুদ্ধে সুরক্ষা প্রয়োজন বা আইন দ্বারা অনুমোদিত।<br />আমরা একত্রিত, অ-ব্যক্তিগতভাবে শনাক্তযোগ্য তথ্য সর্বজনীনভাবে এবং আমাদের অংশীদারদের সাথে ভাগ করতে পারি - যেমন বাস অপারেটর, এজেন্ট বা সংযুক্ত সাইট। উদাহরণস্বরূপ, আমরা আমাদের পরিষেবার সাধারণ ব্যবহার সম্পর্কে প্রবণতা দেখাতে সর্বজনীনভাবে তথ্য শেয়ার করতে পারি। আমরা কখনও পৃথক নাম, ইমেল আইডি বা অন্যান্য যোগাযোগের বিশদ বিবরণ না নিয়েই সমমনা ব্যবহারকারীদের দ্বারা প্রদত্ত একত্রিত তথ্য বাস অপারেটরদের সাথে ভাগ করতে পারি।</p>\r\n<p>যদি এইচটি টেক সিস্টেম <a href=\"/\">httsys.com</a> কোনো একীভূতকরণ, অধিগ্রহণ বা সম্পদ বিক্রির সাথে জড়িত থাকে, তাহলে আমরা আপনার ব্যক্তিগত তথ্যের গোপনীয়তা নিশ্চিত করা অব্যাহত রাখব এবং ব্যক্তিগত তথ্য স্থানান্তর বা ভিন্ন গোপনীয়তা নীতির অধীন হওয়ার আগে নোটিশ দেব।</p>\r\n<p>3. আপনার ব্যক্তিগত ডেটা সংগ্রহ এবং ব্যবহার করা<br />অ্যাপ্লিকেশন ব্যবহার করার সময় সংগৃহীত তথ্য<br />আমাদের অ্যাপ্লিকেশন ব্যবহার করার সময়, আমাদের অ্যাপ্লিকেশনের বৈশিষ্ট্যগুলি প্রদান করার জন্য, আমরা আপনার পূর্বানুমতি নিয়ে সংগ্রহ করতে পারি:</p>\r\n<p>আপনার অবস্থান সংক্রান্ত তথ্য<br />আপনার ডিভাইসের ফোন বুক থেকে তথ্য (পরিচিতি তালিকা)<br />আপনার ডিভাইসের ক্যামেরা এবং ফটো লাইব্রেরি থেকে ছবি এবং অন্যান্য তথ্য</p>\r\n<p>আমরা আমাদের পরিষেবার বৈশিষ্ট্যগুলি প্রদান করতে, আমাদের পরিষেবা উন্নত করতে এবং কাস্টমাইজ করতে এই তথ্য ব্যবহার করি। তথ্য কোম্পানির সার্ভারে আপলোড করা হতে পারে এবং/অথবা এটি সহজভাবে আপনার ডিভাইসে সংরক্ষণ করা হতে পারে।</p>\r\n<p>মোবাইল রিচার্জ পণ্যের জন্য যোগাযোগ তালিকা সিঙ্ক:<br />রিচার্জ পরিষেবার জন্য, আমরা আপনার ডিভাইসের ফোন বুক (যোগাযোগের তালিকা) সংগ্রহ করছি এবং শুধুমাত্র এইচটি টেক সিস্টেম&nbsp; <a href=\"/\">httsys.com</a>-এর মালিকানাধীন এবং নিয়ন্ত্রিত একটি সুরক্ষিত এবং এনক্রিপ্ট করা চ্যানেলের মাধ্যমে আমাদের এপিআইতে পাঠাচ্ছি। রিচার্জ পণ্যের বিস্তারিত শর্তাবলী রিচার্জ বিভাগের অধীনে অ্যাপে পাওয়া যাবে।</p>\r\n<p>আপনি আপনার ডিভাইস সেটিংসের মাধ্যমে যেকোনো সময় এই তথ্যে অ্যাক্সেস সক্ষম বা অক্ষম করতে পারেন৷ আমরা অন্য কোনো তৃতীয় পক্ষের চ্যানেলে আপনার কোনো ব্যক্তিগত ডেটা সঞ্চয় বা শেয়ার করি না। আপনার ডেটা নিরাপত্তা আমাদের কাছে গুরুত্বপূর্ণ এবং আমরা আমাদের পরিষেবার বৈশিষ্ট্যগুলি নিশ্চিত করতে শুধুমাত্র HT Tech সিস্টেমের নিজস্ব চ্যানেলের মাধ্যমে এই ডেটা প্রক্রিয়া করি।</p>\r\n<p>এই গোপনীয়তা নীতি সম্পর্কে আপনার কোন প্রশ্ন থাকলে, আপনি আমাদের সাথে ইমেল যোগাযোগ করতে পারেন: <a href=\"mailto:support@httsys.com\">support@httsys.com</a> বা &nbsp;<a href=\"mailto:httechsystem@gmail.com\">httechsystem@gmail.com</a></p>\r\n<p>4. নিরাপত্তা সতর্কতা<br />আমাদের নিয়ন্ত্রণাধীন তথ্যের ক্ষতি, অপব্যবহার এবং পরিবর্তন থেকে রক্ষা করার জন্য আমাদের ওয়েবসাইটে কঠোর নিরাপত্তা ব্যবস্থা রয়েছে। যখনই আপনি আপনার অ্যাকাউন্টের তথ্য পরিবর্তন করেন বা অ্যাক্সেস করেন, আমরা একটি সুরক্ষিত সার্ভার ব্যবহারের প্রস্তাব দিই। এই নীতিতে আগেই জানানো হয়েছে, একবার আমরা আপনার তথ্য পেয়ে গেলে আমরা অননুমোদিত অ্যাক্সেস থেকে রক্ষা করার জন্য কঠোর নিরাপত্তা নির্দেশিকা নিশ্চিত করি। উদাহরণস্বরূপ, পরিচয় চুরি এবং স্পাইওয়্যার থেকে ব্যবহারকারীদের রক্ষা করতে আমরা SSL নিরাপত্তা ব্যবহার করি।</p>\r\n<p>5. আপনার সম্মতি<br />ওয়েবসাইট ব্যবহার করে এবং/অথবা আপনার তথ্য প্রদানের মাধ্যমে, আপনি এই গোপনীয়তা নীতি অনুসারে ওয়েবসাইটে প্রকাশ করা তথ্য সংগ্রহ ও ব্যবহারে সম্মত হন, এই গোপনীয়তা নীতি অনুসারে আপনার তথ্য ভাগ করার জন্য আপনার সম্মতি সহ কিন্তু সীমাবদ্ধ নয় .</p>\r\n<p>আমরা পূর্বের তথ্য ছাড়াই এই গোপনীয়তা নীতিতে সংশোধন করার সিদ্ধান্ত নিতে পারি, তাই, আপনাকে নিয়মিত বিরতিতে এই পৃষ্ঠাটি পর্যালোচনা করার পরামর্শ দেওয়া হচ্ছে। এটি নিশ্চিত করে যে আপনি আমাদের সংগ্রহ করা তথ্যের বিশদ বিবরণের সাথে আপ-টু-ডেট আছেন, আমরা কীভাবে এটি ব্যবহার করি এবং কোন পরিস্থিতিতে আমরা এটি প্রকাশ করি।</p>', 'জিডিপিআর', 'সাধারণ ডেটা সুরক্ষা প্রবিধান আমরা, এইচটি টেক সিস্টেম  httsys.com-এ, লেনদেন সংক্রান্ত নিরাপত্তা এবং গুণমানের সর্বোচ্চ মান বজায় রাখা নিশ্চিত করি যাতে আপনার তথ্য এবং বিবরণ সুরক্ষিত থাকে। আমাদের নীতিগুলি সম্পর্কে আরও জানতে আমাদের তথ্য সংগ্রহ এবং প্রচারের অনুশীলনগুলি সম্পর্কে জানতে অনুগ্রহ করে নিম্নলিখিতটি পড়ুন।', '2021-03-14 20:56:16', '2023-07-06 08:36:35'),
(7, 2, 1, NULL, 'শর্তাবলী', 'terms-conditions', '<p>আমরা, এইচটি টেক সিস্টেম&nbsp;<a href=\"/\"> httsys.com</a>-এ, লেনদেন সংক্রান্ত নিরাপত্তা এবং গুণমানের সর্বোচ্চ মান বজায় রাখা নিশ্চিত করি যাতে আপনার তথ্য এবং বিবরণ সুরক্ষিত থাকে। আমাদের নীতিগুলি সম্পর্কে আরও জানতে আমাদের তথ্য সংগ্রহ এবং প্রচারের অনুশীলনগুলি সম্পর্কে জানতে অনুগ্রহ করে নিম্নলিখিতটি পড়ুন।</p>\r\n<p>দ্রষ্টব্য: অনুগ্রহ করে নোট করুন যে আমাদের গোপনীয়তা নীতি পূর্ব বিজ্ঞপ্তি ছাড়াই যেকোনো সময় পরিবর্তন সাপেক্ষে। আপনি যে কোনো পরিবর্তন সম্পর্কে সচেতন তা নিশ্চিত করতে, অনুগ্রহ করে নিয়মিত বিরতিতে এই নীতি পর্যালোচনা করুন।</p>\r\n<p>এই ওয়েবসাইট পরিদর্শন করে আপনি এই গোপনীয়তা নীতির শর্তাবলী দ্বারা আবদ্ধ হতে সম্মত হন। যেকোনো মতবিরোধ ঢাকা, বাংলাদেশের এখতিয়ারের অধীন হবে।</p>\r\n<p>শুধুমাত্র ওয়েবসাইট ব্যবহার করে, আপনি এই গোপনীয়তা নীতি অনুসারে আমাদের ব্যবহার এবং আপনার ব্যক্তিগত তথ্য প্রকাশের জন্য সম্মতি প্রকাশ করেন। এই গোপনীয়তা নীতি অন্তর্ভুক্ত করা হয়েছে এবং ব্যবহারের শর্তাবলী সাপেক্ষে</p>\r\n<p>1. ব্যক্তিগতভাবে সনাক্তকরণযোগ্য তথ্য এবং অন্যান্য তথ্য সংগ্রহ<br />আপনি যখন আমাদের ওয়েবসাইট ব্যবহার করেন, তখন আমরা আপনার ব্রাউজিং তথ্য সংরক্ষণ করি যাতে আমরা আপনার চাহিদা মেটাতে পারে এমন পরিষেবা এবং বৈশিষ্ট্যগুলি সরবরাহ করতে পারি।</p>\r\n<p>সাধারণভাবে, আপনি কে আমাদের না বলে বা নিজের সম্পর্কে কোনো ব্যক্তিগত তথ্য প্রকাশ না করে আপনি ওয়েবসাইটটি ব্রাউজ করতে পারেন। একবার আপনি আমাদের আপনার ব্যক্তিগত তথ্য দিলে, আপনি আমাদের কাছে বেনামী থাকবেন না। ওয়েবসাইটটিতে একটি নির্দিষ্ট পরিষেবা বা বৈশিষ্ট্য ব্যবহার না করার জন্য আপনার কাছে সর্বদা তথ্য প্রদান না করার বিকল্প রয়েছে। আমরা আপনার ব্যবহার আচরণ এবং ব্যক্তিগত তথ্য এবং একটি সামগ্রিক ভিত্তির তথ্য অভ্যন্তরীণ গবেষণায় সংকলন করি যাতে আপনাকে আরও ভালভাবে পরিবেশন করার জন্য আমাদের পণ্যের অফারগুলিকে আরও ভালভাবে উন্নত করা যায়। না), আপনি পরবর্তী কোন URL-এ যাবেন (এই URLটি আমাদের ওয়েবসাইটে আছে কি না), আপনার কম্পিউটার ব্রাউজারের তথ্য এবং আপনার IP ঠিকানা৷</p>\r\n<p>আমরা আমাদের ওয়েব পৃষ্ঠার প্রবাহ বিশ্লেষণ করতে, প্রচারমূলক কার্যকারিতা পরিমাপ করতে এবং বিশ্বাস ও নিরাপত্তার প্রচারে সহায়তা করতে ওয়েবসাইটের নির্দিষ্ট পৃষ্ঠাগুলিতে \"কুকিজ (আপনার কম্পিউটারে সংরক্ষিত ছোট ফাইল)\" এর মতো ডেটা সংগ্রহের ডিভাইস ব্যবহার করি। আমরা কিছু বৈশিষ্ট্য অফার করি যা শুধুমাত্র একটি \"কুকি\" ব্যবহারের মাধ্যমে উপলব্ধ।</p>\r\n<p>উপরন্তু, তৃতীয় পক্ষগুলি আমাদের ওয়েবসাইটে কুকি বা অনুরূপ ডিভাইস রাখতে পারে, যা আমরা নিয়ন্ত্রণ করতে পারি না। আপনি যদি ওয়েবসাইটে কেনাকাটা করতে চান, আমরা আপনার কেনার আচরণ সম্পর্কে তথ্য সংগ্রহ করি।</p>\r\n<p>আপনি যদি আমাদের সাথে লেনদেন করেন, আমরা কিছু অতিরিক্ত তথ্য সংগ্রহ করি, যেমন একটি বিলিং ঠিকানা, একটি ক্রেডিট/ডেবিট কার্ড নম্বর এবং একটি ক্রেডিট/ডেবিট কার্ডের মেয়াদ শেষ হওয়ার তারিখ এবং/অথবা অন্যান্য অর্থপ্রদানের উপকরণের বিবরণ৷ আপনি যদি বার্তা পোস্ট করেন বা আমাদের জন্য একটি প্রতিক্রিয়া জানান , আপনি আমাদের প্রদান করা তথ্য আমরা সংগ্রহ করব। বিরোধ নিষ্পত্তি, গ্রাহক সহায়তা প্রদান এবং আইন দ্বারা অনুমোদিত সমস্যা সমাধানের জন্য আমরা এই তথ্যটি প্রয়োজনীয় হিসাবে ধরে রাখি।</p>\r\n<p>আপনি যদি আমাদের ব্যক্তিগত চিঠিপত্র পাঠান, যেমন ইমেল বা চিঠি, অথবা যদি অন্য ব্যবহারকারী বা তৃতীয় পক্ষরা আমাদের ওয়েবসাইটে আপনার কার্যকলাপ বা পোস্টিং সম্পর্কে চিঠিপত্র পাঠায়, আমরা আপনার জন্য নির্দিষ্ট একটি ফাইলে এই ধরনের তথ্য সংগ্রহ করতে পারি।</p>\r\n<p>আপনি যখন আমাদের সাথে একটি বিনামূল্যে অ্যাকাউন্ট সেট আপ করেন তখন আমরা আপনার কাছ থেকে ব্যক্তিগতভাবে সনাক্তযোগ্য তথ্য (ইমেল ঠিকানা, নাম, ফোন নম্বর) সংগ্রহ করি। আমরা আপনার পূর্ববর্তী অর্ডার এবং আপনার আগ্রহের উপর ভিত্তি করে আপনাকে অফার পাঠাতে আপনার যোগাযোগের তথ্য ব্যবহার করি। যাইহোক, ডেটা সুরক্ষা একটি আস্থার বিষয় এবং আপনার গোপনীয়তা আমাদের কাছে গুরুত্বপূর্ণ। তাই আমরা এই গোপনীয়তা নীতিতে নির্ধারিত পদ্ধতিতে আপনার নাম এবং আপনার সাথে সম্পর্কিত অন্যান্য তথ্য ব্যবহার করব। আমরা শুধুমাত্র তথ্য সংগ্রহ করব যেখানে এটি করা আমাদের জন্য প্রয়োজনীয় এবং আমরা শুধুমাত্র তথ্য সংগ্রহ করব</p>\r\n<p>2. ব্যক্তিগত তথ্য শেয়ার করা<br />আমরা শুধুমাত্র এইচটি টেক সিস্টেম&nbsp; <a href=\"/\">httsys.com</a> এর পরিধির বাইরের কোম্পানি, সংস্থা বা ব্যক্তিদের সাথে ব্যক্তিগত তথ্য শেয়ার করব যদি আমাদের সৎ বিশ্বাস থাকে এবং বিশ্বাস করি যে তথ্যের অ্যাক্সেস, ব্যবহার, সংরক্ষণ বা প্রকাশ করা যুক্তিসঙ্গতভাবে প্রয়োজনীয়:</p>\r\n<p>কোনো প্রযোজ্য আইন, প্রবিধান, আইনি প্রক্রিয়া বা প্রয়োগযোগ্য সরকারি অনুরোধ পূরণ করুন।<br />সম্ভাব্য লঙ্ঘনের তদন্ত সহ প্রযোজ্য পরিষেবার শর্তাবলী প্রয়োগ করুন।<br />জালিয়াতি, নিরাপত্তা বা প্রযুক্তিগত সমস্যা সনাক্ত করা, প্রতিরোধ করা বা অন্যথায় সমাধান করা।<br />এইচটি টেক সিস্টেম&nbsp;<a href=\"/\">httsyscom</a>, আমাদের ব্যবহারকারী বা জনসাধারণের অধিকার, সম্পত্তি বা নিরাপত্তার ক্ষতির বিরুদ্ধে সুরক্ষা প্রয়োজন বা আইন দ্বারা অনুমোদিত।<br />আমরা একত্রিত, অ-ব্যক্তিগতভাবে শনাক্তযোগ্য তথ্য সর্বজনীনভাবে এবং আমাদের অংশীদারদের সাথে ভাগ করতে পারি - যেমন বাস অপারেটর, এজেন্ট বা সংযুক্ত সাইট। উদাহরণস্বরূপ, আমরা আমাদের পরিষেবার সাধারণ ব্যবহার সম্পর্কে প্রবণতা দেখাতে সর্বজনীনভাবে তথ্য শেয়ার করতে পারি। আমরা কখনও পৃথক নাম, ইমেল আইডি বা অন্যান্য যোগাযোগের বিশদ বিবরণ না নিয়েই সমমনা ব্যবহারকারীদের দ্বারা প্রদত্ত একত্রিত তথ্য বাস অপারেটরদের সাথে ভাগ করতে পারি।</p>\r\n<p>যদি এইচটি টেক সিস্টেম <a href=\"/\">httsys.com</a> কোনো একীভূতকরণ, অধিগ্রহণ বা সম্পদ বিক্রির সাথে জড়িত থাকে, তাহলে আমরা আপনার ব্যক্তিগত তথ্যের গোপনীয়তা নিশ্চিত করা অব্যাহত রাখব এবং ব্যক্তিগত তথ্য স্থানান্তর বা ভিন্ন গোপনীয়তা নীতির অধীন হওয়ার আগে নোটিশ দেব।</p>\r\n<p>3. আপনার ব্যক্তিগত ডেটা সংগ্রহ এবং ব্যবহার করা<br />অ্যাপ্লিকেশন ব্যবহার করার সময় সংগৃহীত তথ্য<br />আমাদের অ্যাপ্লিকেশন ব্যবহার করার সময়, আমাদের অ্যাপ্লিকেশনের বৈশিষ্ট্যগুলি প্রদান করার জন্য, আমরা আপনার পূর্বানুমতি নিয়ে সংগ্রহ করতে পারি:</p>\r\n<p>আপনার অবস্থান সংক্রান্ত তথ্য<br />আপনার ডিভাইসের ফোন বুক থেকে তথ্য (পরিচিতি তালিকা)<br />আপনার ডিভাইসের ক্যামেরা এবং ফটো লাইব্রেরি থেকে ছবি এবং অন্যান্য তথ্য</p>\r\n<p>আমরা আমাদের পরিষেবার বৈশিষ্ট্যগুলি প্রদান করতে, আমাদের পরিষেবা উন্নত করতে এবং কাস্টমাইজ করতে এই তথ্য ব্যবহার করি। তথ্য কোম্পানির সার্ভারে আপলোড করা হতে পারে এবং/অথবা এটি সহজভাবে আপনার ডিভাইসে সংরক্ষণ করা হতে পারে।</p>\r\n<p>মোবাইল রিচার্জ পণ্যের জন্য যোগাযোগ তালিকা সিঙ্ক:<br />রিচার্জ পরিষেবার জন্য, আমরা আপনার ডিভাইসের ফোন বুক (যোগাযোগের তালিকা) সংগ্রহ করছি এবং শুধুমাত্র এইচটি টেক সিস্টেম&nbsp; <a href=\"/\">httsys.com</a>-এর মালিকানাধীন এবং নিয়ন্ত্রিত একটি সুরক্ষিত এবং এনক্রিপ্ট করা চ্যানেলের মাধ্যমে আমাদের এপিআইতে পাঠাচ্ছি। রিচার্জ পণ্যের বিস্তারিত শর্তাবলী রিচার্জ বিভাগের অধীনে অ্যাপে পাওয়া যাবে।</p>\r\n<p>আপনি আপনার ডিভাইস সেটিংসের মাধ্যমে যেকোনো সময় এই তথ্যে অ্যাক্সেস সক্ষম বা অক্ষম করতে পারেন৷ আমরা অন্য কোনো তৃতীয় পক্ষের চ্যানেলে আপনার কোনো ব্যক্তিগত ডেটা সঞ্চয় বা শেয়ার করি না। আপনার ডেটা নিরাপত্তা আমাদের কাছে গুরুত্বপূর্ণ এবং আমরা আমাদের পরিষেবার বৈশিষ্ট্যগুলি নিশ্চিত করতে শুধুমাত্র HT Tech সিস্টেমের নিজস্ব চ্যানেলের মাধ্যমে এই ডেটা প্রক্রিয়া করি।</p>\r\n<p>এই গোপনীয়তা নীতি সম্পর্কে আপনার কোন প্রশ্ন থাকলে, আপনি আমাদের সাথে ইমেল যোগাযোগ করতে পারেন: <a href=\"mailto:support@httsys.com\">support@httsys.com</a> বা &nbsp;<a href=\"mailto:httechsystem@gmail.com\">httechsystem@gmail.com</a></p>\r\n<p>4. নিরাপত্তা সতর্কতা<br />আমাদের নিয়ন্ত্রণাধীন তথ্যের ক্ষতি, অপব্যবহার এবং পরিবর্তন থেকে রক্ষা করার জন্য আমাদের ওয়েবসাইটে কঠোর নিরাপত্তা ব্যবস্থা রয়েছে। যখনই আপনি আপনার অ্যাকাউন্টের তথ্য পরিবর্তন করেন বা অ্যাক্সেস করেন, আমরা একটি সুরক্ষিত সার্ভার ব্যবহারের প্রস্তাব দিই। এই নীতিতে আগেই জানানো হয়েছে, একবার আমরা আপনার তথ্য পেয়ে গেলে আমরা অননুমোদিত অ্যাক্সেস থেকে রক্ষা করার জন্য কঠোর নিরাপত্তা নির্দেশিকা নিশ্চিত করি। উদাহরণস্বরূপ, পরিচয় চুরি এবং স্পাইওয়্যার থেকে ব্যবহারকারীদের রক্ষা করতে আমরা SSL নিরাপত্তা ব্যবহার করি।</p>\r\n<p>5. আপনার সম্মতি<br />ওয়েবসাইট ব্যবহার করে এবং/অথবা আপনার তথ্য প্রদানের মাধ্যমে, আপনি এই গোপনীয়তা নীতি অনুসারে ওয়েবসাইটে প্রকাশ করা তথ্য সংগ্রহ ও ব্যবহারে সম্মত হন, এই গোপনীয়তা নীতি অনুসারে আপনার তথ্য ভাগ করার জন্য আপনার সম্মতি সহ কিন্তু সীমাবদ্ধ নয় .</p>\r\n<p>আমরা পূর্বের তথ্য ছাড়াই এই গোপনীয়তা নীতিতে সংশোধন করার সিদ্ধান্ত নিতে পারি, তাই, আপনাকে নিয়মিত বিরতিতে এই পৃষ্ঠাটি পর্যালোচনা করার পরামর্শ দেওয়া হচ্ছে। এটি নিশ্চিত করে যে আপনি আমাদের সংগ্রহ করা তথ্যের বিশদ বিবরণের সাথে আপ-টু-ডেট আছেন, আমরা কীভাবে এটি ব্যবহার করি এবং কোন পরিস্থিতিতে আমরা এটি প্রকাশ করি।</p>', 'শর্তাবলী', 'শর্তাবলী আমরা, এইচটি টেক সিস্টেম  httsys.com-এ, লেনদেন সংক্রান্ত নিরাপত্তা এবং গুণমানের সর্বোচ্চ মান বজায় রাখা নিশ্চিত করি যাতে আপনার তথ্য এবং বিবরণ সুরক্ষিত থাকে।', '2021-03-14 21:07:27', '2023-07-06 08:33:56'),
(8, 2, 1, 261, 'গোপনীয়তা নীতি', 'privacy-policy', '<p>আমরা, এইচটি টেক সিস্টেম&nbsp;<a href=\"/\"> httsys.com</a>-এ, লেনদেন সংক্রান্ত নিরাপত্তা এবং গুণমানের সর্বোচ্চ মান বজায় রাখা নিশ্চিত করি যাতে আপনার তথ্য এবং বিবরণ সুরক্ষিত থাকে। আমাদের নীতিগুলি সম্পর্কে আরও জানতে আমাদের তথ্য সংগ্রহ এবং প্রচারের অনুশীলনগুলি সম্পর্কে জানতে অনুগ্রহ করে নিম্নলিখিতটি পড়ুন।</p>\r\n<p>দ্রষ্টব্য: অনুগ্রহ করে নোট করুন যে আমাদের গোপনীয়তা নীতি পূর্ব বিজ্ঞপ্তি ছাড়াই যেকোনো সময় পরিবর্তন সাপেক্ষে। আপনি যে কোনো পরিবর্তন সম্পর্কে সচেতন তা নিশ্চিত করতে, অনুগ্রহ করে নিয়মিত বিরতিতে এই নীতি পর্যালোচনা করুন।</p>\r\n<p>এই ওয়েবসাইট পরিদর্শন করে আপনি এই গোপনীয়তা নীতির শর্তাবলী দ্বারা আবদ্ধ হতে সম্মত হন। যেকোনো মতবিরোধ ঢাকা, বাংলাদেশের এখতিয়ারের অধীন হবে।</p>\r\n<p>শুধুমাত্র ওয়েবসাইট ব্যবহার করে, আপনি এই গোপনীয়তা নীতি অনুসারে আমাদের ব্যবহার এবং আপনার ব্যক্তিগত তথ্য প্রকাশের জন্য সম্মতি প্রকাশ করেন। এই গোপনীয়তা নীতি অন্তর্ভুক্ত করা হয়েছে এবং ব্যবহারের শর্তাবলী সাপেক্ষে</p>\r\n<p>1. ব্যক্তিগতভাবে সনাক্তকরণযোগ্য তথ্য এবং অন্যান্য তথ্য সংগ্রহ<br />আপনি যখন আমাদের ওয়েবসাইট ব্যবহার করেন, তখন আমরা আপনার ব্রাউজিং তথ্য সংরক্ষণ করি যাতে আমরা আপনার চাহিদা মেটাতে পারে এমন পরিষেবা এবং বৈশিষ্ট্যগুলি সরবরাহ করতে পারি।</p>\r\n<p>সাধারণভাবে, আপনি কে আমাদের না বলে বা নিজের সম্পর্কে কোনো ব্যক্তিগত তথ্য প্রকাশ না করে আপনি ওয়েবসাইটটি ব্রাউজ করতে পারেন। একবার আপনি আমাদের আপনার ব্যক্তিগত তথ্য দিলে, আপনি আমাদের কাছে বেনামী থাকবেন না। ওয়েবসাইটটিতে একটি নির্দিষ্ট পরিষেবা বা বৈশিষ্ট্য ব্যবহার না করার জন্য আপনার কাছে সর্বদা তথ্য প্রদান না করার বিকল্প রয়েছে। আমরা আপনার ব্যবহার আচরণ এবং ব্যক্তিগত তথ্য এবং একটি সামগ্রিক ভিত্তির তথ্য অভ্যন্তরীণ গবেষণায় সংকলন করি যাতে আপনাকে আরও ভালভাবে পরিবেশন করার জন্য আমাদের পণ্যের অফারগুলিকে আরও ভালভাবে উন্নত করা যায়। না), আপনি পরবর্তী কোন URL-এ যাবেন (এই URLটি আমাদের ওয়েবসাইটে আছে কি না), আপনার কম্পিউটার ব্রাউজারের তথ্য এবং আপনার IP ঠিকানা৷</p>\r\n<p>আমরা আমাদের ওয়েব পৃষ্ঠার প্রবাহ বিশ্লেষণ করতে, প্রচারমূলক কার্যকারিতা পরিমাপ করতে এবং বিশ্বাস ও নিরাপত্তার প্রচারে সহায়তা করতে ওয়েবসাইটের নির্দিষ্ট পৃষ্ঠাগুলিতে \"কুকিজ (আপনার কম্পিউটারে সংরক্ষিত ছোট ফাইল)\" এর মতো ডেটা সংগ্রহের ডিভাইস ব্যবহার করি। আমরা কিছু বৈশিষ্ট্য অফার করি যা শুধুমাত্র একটি \"কুকি\" ব্যবহারের মাধ্যমে উপলব্ধ।</p>\r\n<p>উপরন্তু, তৃতীয় পক্ষগুলি আমাদের ওয়েবসাইটে কুকি বা অনুরূপ ডিভাইস রাখতে পারে, যা আমরা নিয়ন্ত্রণ করতে পারি না। আপনি যদি ওয়েবসাইটে কেনাকাটা করতে চান, আমরা আপনার কেনার আচরণ সম্পর্কে তথ্য সংগ্রহ করি।</p>\r\n<p>আপনি যদি আমাদের সাথে লেনদেন করেন, আমরা কিছু অতিরিক্ত তথ্য সংগ্রহ করি, যেমন একটি বিলিং ঠিকানা, একটি ক্রেডিট/ডেবিট কার্ড নম্বর এবং একটি ক্রেডিট/ডেবিট কার্ডের মেয়াদ শেষ হওয়ার তারিখ এবং/অথবা অন্যান্য অর্থপ্রদানের উপকরণের বিবরণ৷ আপনি যদি বার্তা পোস্ট করেন বা আমাদের জন্য একটি প্রতিক্রিয়া জানান , আপনি আমাদের প্রদান করা তথ্য আমরা সংগ্রহ করব। বিরোধ নিষ্পত্তি, গ্রাহক সহায়তা প্রদান এবং আইন দ্বারা অনুমোদিত সমস্যা সমাধানের জন্য আমরা এই তথ্যটি প্রয়োজনীয় হিসাবে ধরে রাখি।</p>\r\n<p>আপনি যদি আমাদের ব্যক্তিগত চিঠিপত্র পাঠান, যেমন ইমেল বা চিঠি, অথবা যদি অন্য ব্যবহারকারী বা তৃতীয় পক্ষরা আমাদের ওয়েবসাইটে আপনার কার্যকলাপ বা পোস্টিং সম্পর্কে চিঠিপত্র পাঠায়, আমরা আপনার জন্য নির্দিষ্ট একটি ফাইলে এই ধরনের তথ্য সংগ্রহ করতে পারি।</p>\r\n<p>আপনি যখন আমাদের সাথে একটি বিনামূল্যে অ্যাকাউন্ট সেট আপ করেন তখন আমরা আপনার কাছ থেকে ব্যক্তিগতভাবে সনাক্তযোগ্য তথ্য (ইমেল ঠিকানা, নাম, ফোন নম্বর) সংগ্রহ করি। আমরা আপনার পূর্ববর্তী অর্ডার এবং আপনার আগ্রহের উপর ভিত্তি করে আপনাকে অফার পাঠাতে আপনার যোগাযোগের তথ্য ব্যবহার করি। যাইহোক, ডেটা সুরক্ষা একটি আস্থার বিষয় এবং আপনার গোপনীয়তা আমাদের কাছে গুরুত্বপূর্ণ। তাই আমরা এই গোপনীয়তা নীতিতে নির্ধারিত পদ্ধতিতে আপনার নাম এবং আপনার সাথে সম্পর্কিত অন্যান্য তথ্য ব্যবহার করব। আমরা শুধুমাত্র তথ্য সংগ্রহ করব যেখানে এটি করা আমাদের জন্য প্রয়োজনীয় এবং আমরা শুধুমাত্র তথ্য সংগ্রহ করব</p>\r\n<p>2. ব্যক্তিগত তথ্য শেয়ার করা<br />আমরা শুধুমাত্র এইচটি টেক সিস্টেম&nbsp; <a href=\"/\">httsys.com</a> এর পরিধির বাইরের কোম্পানি, সংস্থা বা ব্যক্তিদের সাথে ব্যক্তিগত তথ্য শেয়ার করব যদি আমাদের সৎ বিশ্বাস থাকে এবং বিশ্বাস করি যে তথ্যের অ্যাক্সেস, ব্যবহার, সংরক্ষণ বা প্রকাশ করা যুক্তিসঙ্গতভাবে প্রয়োজনীয়:</p>\r\n<p>কোনো প্রযোজ্য আইন, প্রবিধান, আইনি প্রক্রিয়া বা প্রয়োগযোগ্য সরকারি অনুরোধ পূরণ করুন।<br />সম্ভাব্য লঙ্ঘনের তদন্ত সহ প্রযোজ্য পরিষেবার শর্তাবলী প্রয়োগ করুন।<br />জালিয়াতি, নিরাপত্তা বা প্রযুক্তিগত সমস্যা সনাক্ত করা, প্রতিরোধ করা বা অন্যথায় সমাধান করা।<br />এইচটি টেক সিস্টেম&nbsp;<a href=\"/\">httsyscom</a>, আমাদের ব্যবহারকারী বা জনসাধারণের অধিকার, সম্পত্তি বা নিরাপত্তার ক্ষতির বিরুদ্ধে সুরক্ষা প্রয়োজন বা আইন দ্বারা অনুমোদিত।<br />আমরা একত্রিত, অ-ব্যক্তিগতভাবে শনাক্তযোগ্য তথ্য সর্বজনীনভাবে এবং আমাদের অংশীদারদের সাথে ভাগ করতে পারি - যেমন বাস অপারেটর, এজেন্ট বা সংযুক্ত সাইট। উদাহরণস্বরূপ, আমরা আমাদের পরিষেবার সাধারণ ব্যবহার সম্পর্কে প্রবণতা দেখাতে সর্বজনীনভাবে তথ্য শেয়ার করতে পারি। আমরা কখনও পৃথক নাম, ইমেল আইডি বা অন্যান্য যোগাযোগের বিশদ বিবরণ না নিয়েই সমমনা ব্যবহারকারীদের দ্বারা প্রদত্ত একত্রিত তথ্য বাস অপারেটরদের সাথে ভাগ করতে পারি।</p>\r\n<p>যদি এইচটি টেক সিস্টেম <a href=\"/\">httsys.com</a> কোনো একীভূতকরণ, অধিগ্রহণ বা সম্পদ বিক্রির সাথে জড়িত থাকে, তাহলে আমরা আপনার ব্যক্তিগত তথ্যের গোপনীয়তা নিশ্চিত করা অব্যাহত রাখব এবং ব্যক্তিগত তথ্য স্থানান্তর বা ভিন্ন গোপনীয়তা নীতির অধীন হওয়ার আগে নোটিশ দেব।</p>\r\n<p>3. আপনার ব্যক্তিগত ডেটা সংগ্রহ এবং ব্যবহার করা<br />অ্যাপ্লিকেশন ব্যবহার করার সময় সংগৃহীত তথ্য<br />আমাদের অ্যাপ্লিকেশন ব্যবহার করার সময়, আমাদের অ্যাপ্লিকেশনের বৈশিষ্ট্যগুলি প্রদান করার জন্য, আমরা আপনার পূর্বানুমতি নিয়ে সংগ্রহ করতে পারি:</p>\r\n<p>আপনার অবস্থান সংক্রান্ত তথ্য<br />আপনার ডিভাইসের ফোন বুক থেকে তথ্য (পরিচিতি তালিকা)<br />আপনার ডিভাইসের ক্যামেরা এবং ফটো লাইব্রেরি থেকে ছবি এবং অন্যান্য তথ্য</p>\r\n<p>আমরা আমাদের পরিষেবার বৈশিষ্ট্যগুলি প্রদান করতে, আমাদের পরিষেবা উন্নত করতে এবং কাস্টমাইজ করতে এই তথ্য ব্যবহার করি। তথ্য কোম্পানির সার্ভারে আপলোড করা হতে পারে এবং/অথবা এটি সহজভাবে আপনার ডিভাইসে সংরক্ষণ করা হতে পারে।</p>\r\n<p>মোবাইল রিচার্জ পণ্যের জন্য যোগাযোগ তালিকা সিঙ্ক:<br />রিচার্জ পরিষেবার জন্য, আমরা আপনার ডিভাইসের ফোন বুক (যোগাযোগের তালিকা) সংগ্রহ করছি এবং শুধুমাত্র এইচটি টেক সিস্টেম&nbsp; <a href=\"/\">httsys.com</a>-এর মালিকানাধীন এবং নিয়ন্ত্রিত একটি সুরক্ষিত এবং এনক্রিপ্ট করা চ্যানেলের মাধ্যমে আমাদের এপিআইতে পাঠাচ্ছি। রিচার্জ পণ্যের বিস্তারিত শর্তাবলী রিচার্জ বিভাগের অধীনে অ্যাপে পাওয়া যাবে।</p>\r\n<p>আপনি আপনার ডিভাইস সেটিংসের মাধ্যমে যেকোনো সময় এই তথ্যে অ্যাক্সেস সক্ষম বা অক্ষম করতে পারেন৷ আমরা অন্য কোনো তৃতীয় পক্ষের চ্যানেলে আপনার কোনো ব্যক্তিগত ডেটা সঞ্চয় বা শেয়ার করি না। আপনার ডেটা নিরাপত্তা আমাদের কাছে গুরুত্বপূর্ণ এবং আমরা আমাদের পরিষেবার বৈশিষ্ট্যগুলি নিশ্চিত করতে শুধুমাত্র HT Tech সিস্টেমের নিজস্ব চ্যানেলের মাধ্যমে এই ডেটা প্রক্রিয়া করি।</p>\r\n<p>এই গোপনীয়তা নীতি সম্পর্কে আপনার কোন প্রশ্ন থাকলে, আপনি আমাদের সাথে ইমেল যোগাযোগ করতে পারেন: <a href=\"mailto:support@httsys.com\">support@httsys.com</a> বা &nbsp;<a href=\"mailto:httechsystem@gmail.com\">httechsystem@gmail.com</a></p>\r\n<p>4. নিরাপত্তা সতর্কতা<br />আমাদের নিয়ন্ত্রণাধীন তথ্যের ক্ষতি, অপব্যবহার এবং পরিবর্তন থেকে রক্ষা করার জন্য আমাদের ওয়েবসাইটে কঠোর নিরাপত্তা ব্যবস্থা রয়েছে। যখনই আপনি আপনার অ্যাকাউন্টের তথ্য পরিবর্তন করেন বা অ্যাক্সেস করেন, আমরা একটি সুরক্ষিত সার্ভার ব্যবহারের প্রস্তাব দিই। এই নীতিতে আগেই জানানো হয়েছে, একবার আমরা আপনার তথ্য পেয়ে গেলে আমরা অননুমোদিত অ্যাক্সেস থেকে রক্ষা করার জন্য কঠোর নিরাপত্তা নির্দেশিকা নিশ্চিত করি। উদাহরণস্বরূপ, পরিচয় চুরি এবং স্পাইওয়্যার থেকে ব্যবহারকারীদের রক্ষা করতে আমরা SSL নিরাপত্তা ব্যবহার করি।</p>\r\n<p>5. আপনার সম্মতি<br />ওয়েবসাইট ব্যবহার করে এবং/অথবা আপনার তথ্য প্রদানের মাধ্যমে, আপনি এই গোপনীয়তা নীতি অনুসারে ওয়েবসাইটে প্রকাশ করা তথ্য সংগ্রহ ও ব্যবহারে সম্মত হন, এই গোপনীয়তা নীতি অনুসারে আপনার তথ্য ভাগ করার জন্য আপনার সম্মতি সহ কিন্তু সীমাবদ্ধ নয় .</p>\r\n<p>আমরা পূর্বের তথ্য ছাড়াই এই গোপনীয়তা নীতিতে সংশোধন করার সিদ্ধান্ত নিতে পারি, তাই, আপনাকে নিয়মিত বিরতিতে এই পৃষ্ঠাটি পর্যালোচনা করার পরামর্শ দেওয়া হচ্ছে। এটি নিশ্চিত করে যে আপনি আমাদের সংগ্রহ করা তথ্যের বিশদ বিবরণের সাথে আপ-টু-ডেট আছেন, আমরা কীভাবে এটি ব্যবহার করি এবং কোন পরিস্থিতিতে আমরা এটি প্রকাশ করি।</p>', 'গোপনীয়তা নীতি', 'আমরা, এইচটি টেক সিস্টেম  httsys.com-এ, লেনদেন সংক্রান্ত নিরাপত্তা এবং গুণমানের সর্বোচ্চ মান বজায় রাখা নিশ্চিত করি যাতে আপনার তথ্য এবং বিবরণ সুরক্ষিত থাকে। আমাদের নীতিগুলি সম্পর্কে আরও জানতে আমাদের তথ্য সংগ্রহ এবং প্রচারের অনুশীলনগুলি সম্পর্কে জানতে অনুগ্রহ করে নিম্নলিখিতটি পড়ুন।', '2021-03-14 21:08:41', '2023-03-08 11:18:15');
INSERT INTO `pages` (`id`, `language_id`, `user_id`, `photo_id`, `title`, `slug`, `body`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(9, 3, 1, NULL, 'جاربار', 'gdpr', '<p>اللائحة العامة لحماية البيانات (الاتحاد الأوروبي) 2016/679 (GDPR) هي لائحة في قانون الاتحاد الأوروبي بشأن حماية البيانات والخصوصية في الاتحاد الأوروبي (EU) والمنطقة الاقتصادية الأوروبية (EEA). كما تتناول نقل البيانات الشخصية خارج مناطق الاتحاد الأوروبي والمنطقة الاقتصادية الأوروبية. يتمثل الهدف الأساسي للائحة العامة لحماية البيانات في منح الأفراد إمكانية التحكم في بياناتهم الشخصية وتبسيط البيئة التنظيمية للأعمال التجارية الدولية من خلال توحيد اللوائح داخل الاتحاد الأوروبي. [1] تحل اللائحة محل توجيه حماية البيانات 95/46 / EC ، وتحتوي على أحكام ومتطلبات تتعلق بمعالجة البيانات الشخصية للأفراد (يطلق عليهم رسميًا موضوعات البيانات في اللائحة العامة لحماية البيانات) الموجودين في المنطقة الاقتصادية الأوروبية ، وينطبقون على أي مؤسسة بغض النظر عن موقعه وجنسية الأشخاص موضوع البيانات أو إقامتهم - أي معالجة المعلومات الشخصية للأفراد داخل المنطقة الاقتصادية الأوروبية</p>\r\n<p>يجب على مراقبي ومعالجات البيانات الشخصية وضع التدابير الفنية والتنظيمية المناسبة لتنفيذ مبادئ حماية البيانات. يجب تصميم وبناء العمليات التجارية التي تتعامل مع البيانات الشخصية مع مراعاة المبادئ وتوفير ضمانات لحماية البيانات (على سبيل المثال ، استخدام إخفاء الهوية أو إخفاء الهوية الكامل عند الاقتضاء). يجب على مراقبي البيانات تصميم أنظمة المعلومات مع مراعاة الخصوصية. على سبيل المثال ، استخدام أعلى إعدادات الخصوصية الممكنة بشكل افتراضي ، بحيث لا تكون مجموعات البيانات متاحة بشكل افتراضي للجمهور ولا يمكن استخدامها لتحديد موضوع ما. لا يجوز معالجة أي بيانات شخصية ما لم تتم هذه المعالجة بموجب أحد القواعد القانونية الستة المحددة في اللائحة (الموافقة ، العقد ، المهمة العامة ، المصلحة الحيوية ، المصلحة المشروعة أو المتطلبات القانونية). عندما تعتمد المعالجة على الموافقة ، يحق لصاحب البيانات إبطالها في أي وقت.</p>\r\n<p>يجب على مراقبي البيانات الكشف بوضوح عن أي جمع للبيانات ، والإعلان عن الأساس القانوني والغرض من معالجة البيانات ، وتحديد مدة الاحتفاظ بالبيانات وما إذا كانت تتم مشاركتها مع أي جهات خارجية أو خارج المنطقة الاقتصادية الأوروبية. تلتزم الشركات بحماية بيانات الموظفين والمستهلكين إلى الدرجة التي يتم فيها استخراج البيانات الضرورية فقط مع الحد الأدنى من التدخل في خصوصية البيانات من الموظفين أو المستهلكين أو الأطراف الثالثة. يجب أن يكون لدى الشركات ضوابط ولوائح داخلية لمختلف الإدارات مثل التدقيق والضوابط الداخلية والعمليات. يحق لأصحاب البيانات طلب نسخة محمولة من البيانات التي تم جمعها بواسطة وحدة تحكم بتنسيق مشترك ، والحق في محو بياناتهم في ظل ظروف معينة. يُطلب من السلطات العامة والشركات التي تتكون أنشطتها الأساسية من المعالجة المنتظمة أو المنهجية للبيانات الشخصية تعيين مسؤول حماية البيانات (DPO) ، وهو مسؤول عن إدارة الامتثال للقانون العام لحماية البيانات (GDPR). يجب على الشركات الإبلاغ عن انتهاكات البيانات إلى السلطات الإشرافية الوطنية في غضون 72 ساعة إذا كان لها تأثير سلبي على خصوصية المستخدم. في بعض الحالات ، قد يتم تغريم منتهكي اللائحة العامة لحماية البيانات (GDPR) حتى 20 مليون يورو أو ما يصل إلى 4٪ من حجم المبيعات السنوي العالمي للسنة المالية السابقة في حالة وجود مؤسسة ، أيهما أكبر.</p>\r\n<p>تم اعتماد اللائحة العامة لحماية البيانات (GDPR) في 14 أبريل 2016 ، وأصبحت قابلة للتنفيذ اعتبارًا من 25 مايو 2018. نظرًا لأن اللائحة العامة لحماية البيانات هي لائحة وليست توجيهًا ، فهي ملزمة وقابلة للتطبيق بشكل مباشر ، ولكنها توفر المرونة لجوانب معينة من اللوائح ليتم تعديلها من قبل الأفراد. الدول الأعضاء.</p>\r\n<p>أصبحت اللائحة نموذجًا للعديد من القوانين الوطنية خارج الاتحاد الأوروبي ، بما في ذلك تشيلي واليابان والبرازيل وكوريا الجنوبية والأرجنتين وكينيا. قانون خصوصية المستهلك في كاليفورنيا (CCPA) ، المعتمد في 28 يونيو 2018 ، له العديد من أوجه التشابه مع اللائحة العامة لحماية البيانات. [2]</p>', 'جاربار', 'اللائحة العامة لحماية البيانات', '2021-03-14 20:56:16', '2021-04-11 18:44:43'),
(10, 3, 1, NULL, 'الأحكام والشروط', 'terms-conditions', '<p>شروط الخدمة (المعروفة أيضًا باسم شروط الاستخدام والشروط والأحكام ، والتي يشار إليها عادةً باختصار TOS أو ToS أو ToU أو T&amp;C) هي الاتفاقيات القانونية بين مقدم الخدمة والشخص الذي يريد استخدام تلك الخدمة. يجب أن يوافق الشخص على الالتزام بشروط الخدمة من أجل استخدام الخدمة المقدمة. [1] يمكن أن تكون شروط الخدمة أيضًا مجرد إخلاء مسؤولية ، خاصة فيما يتعلق باستخدام مواقع الويب. أثارت اللغة الغامضة والجمل المطولة المستخدمة في شروط الاستخدام مخاوف بشأن خصوصية العميل وزادت من الوعي العام بعدة طرق.</p>\r\n<p>تحتوي اتفاقية شروط الخدمة عادةً على أقسام تتعلق بموضوع واحد أو أكثر من الموضوعات التالية</p>\r\n<p>توضيح / تعريف الكلمات والعبارات الرئيسية<br />حقوق ومسؤوليات المستخدم<br />الاستخدام الصحيح أو المتوقع ؛ تعريف سوء الاستخدام<br />المساءلة عن الإجراءات والسلوك والسلوك عبر الإنترنت<br />سياسة الخصوصية التي تحدد استخدام البيانات الشخصية<br />تفاصيل الدفع مثل رسوم العضوية أو الاشتراك ، إلخ.<br />سياسة إلغاء الاشتراك التي تصف إجراءات إنهاء الحساب ، إن وجدت<br />يحتوي أحيانًا على بند تحكيم يوضح بالتفصيل عملية تسوية النزاع وحقوقًا محدودة لرفع دعوى إلى المحكمة<br />إخلاء المسؤولية / تحديد المسؤولية يوضح المسؤولية القانونية للموقع عن الأضرار التي يتكبدها المستخدمون<br />إشعار المستخدم عند تعديل الشروط ، إذا تم عرضه<br />من بين 102 شركة قامت بتسويق الاختبارات الجينية للمستهلكين في عام 2014 للأغراض الصحية ، كان لدى 71 شركة أحكام وشروط متاحة للجمهور: [4]</p>\r\n<p>57 من 71 لديها بنود إخلاء المسؤولية (بما في ذلك 10 إخلاء المسؤولية عن الضرر الناجم عن إهمالهم) ،<br />51 دع الشركة تغير الشروط (بما في ذلك 17 دون إشعار) ،<br />34 السماح بالكشف عن البيانات في ظروف معينة ،<br />31 يطلب من المستهلكين تعويض الشركة ،<br />20 وعد بعدم بيع البيانات.<br />من بين 260 اتفاقية ترخيص برمجيات المستهلك في السوق الشامل في عام 2010 ، [5]</p>\r\n<p>91٪ تنازلوا عن ضمانات القابلية للتسويق أو الملاءمة للغرض أو قالوا \"كما هي\"<br />92٪ تنازلوا عن الأضرار التبعية أو العرضية أو الخاصة أو المتوقعة<br />لم يضمن 69٪ أن البرنامج خالٍ من العيوب أو سيعمل كما هو موصوف في الدليل<br />55٪ تعويضات قصوى بسعر الشراء أو أقل<br />قال 36٪ إنهم لا يضمنون ما إذا كان ينتهك حقوق الملكية الفكرية للآخرين<br />32٪ مطلوب تحكيم أو محكمة معينة<br />17٪ طلب من العميل دفع الفواتير القانونية للمصنع (تعويض) ، ولكن ليس العكس<br />من بين شروط وأحكام 31 خدمة حوسبة سحابية في يناير ويوليو 2010 ، تعمل في إنجلترا ، [6]</p>\r\n<p>27 حدد القانون الذي سيتم استخدامه (ولاية أمريكية أو دولة أخرى) ،<br />يحدد معظمهم أنه يمكن للمستهلكين رفع دعوى ضد الشركة فقط في مدينة معينة في تلك الولاية القضائية ، على الرغم من أنه غالبًا ما يمكن للشركة رفع دعوى ضد المستهلك في أي مكان ،<br />يتطلب البعض تقديم المطالبات في غضون نصف عام إلى عامين ،<br />7 ـ فرض التحكيم ، وكل ذلك يمنع المستهلك من التصرف غير المشروع والمعارض.<br />13 يمكن تعديل الشروط بمجرد نشر التغييرات على موقع الويب الخاص بهم ،<br />الغالبية تتنصل من المسؤولية عن السرية أو النسخ الاحتياطية ،<br />الوعد الأكبر بالحفاظ على البيانات لفترة وجيزة فقط بعد إنهاء الخدمة ،<br />قليلون يتعهدون بحذف البيانات تمامًا عندما يغادر العميل ،<br />يقوم البعض بمراقبة بيانات العملاء لفرض سياساتهم على الاستخدام ،<br />جميع ضمانات إخلاء المسئولية وتقريبًا جميع إخلاء المسئولية ،<br />24 يطلب من العميل تعويضهم ، والقليل من تعويض العميل ،<br />القليل منهم يعطي ائتمانات للخدمة السيئة ، 15 يعد \"بأفضل الجهود\" ويمكن أن يعلق أو يتوقف في أي وقت.<br />لاحظ الباحثون أن القواعد الخاصة بالموقع والحدود الزمنية قد تكون غير قابلة للتنفيذ بالنسبة للمستهلكين في العديد من الولايات القضائية التي تخضع لحماية المستهلك ، وأن سياسات الاستخدام المقبولة نادرًا ما يتم فرضها ، وأن الحذف السريع يعد أمرًا خطيرًا إذا حكمت المحكمة لاحقًا أن الإنهاء غير قانوني ، وأن القوانين المحلية تتطلب في كثير من الأحيان ضمانات (وأجبرت المملكة المتحدة شركة Apple على قول ذلك).</p>', 'الأحكام والشروط', 'لاحظ الباحثون أن القواعد الخاصة بالمكان والحدود الزمنية قد تكون غير قابلة للتنفيذ', '2021-03-14 21:07:27', '2021-04-11 18:44:06'),
(11, 3, 1, NULL, 'سياسة الخصوصية', 'privacy-policy', '<p>اللائحة العامة لحماية البيانات (الاتحاد الأوروبي) 2016/679 (GDPR) هي لائحة في قانون الاتحاد الأوروبي بشأن حماية البيانات والخصوصية في الاتحاد الأوروبي (EU) والمنطقة الاقتصادية الأوروبية (EEA). كما تتناول نقل البيانات الشخصية خارج مناطق الاتحاد الأوروبي والمنطقة الاقتصادية الأوروبية. يتمثل الهدف الأساسي للائحة العامة لحماية البيانات في منح الأفراد إمكانية التحكم في بياناتهم الشخصية وتبسيط البيئة التنظيمية للأعمال التجارية الدولية من خلال توحيد اللوائح داخل الاتحاد الأوروبي. [1] تحل اللائحة محل توجيه حماية البيانات 95/46 / EC ، وتحتوي على أحكام ومتطلبات تتعلق بمعالجة البيانات الشخصية للأفراد (يطلق عليهم رسميًا موضوعات البيانات في اللائحة العامة لحماية البيانات) الموجودين في المنطقة الاقتصادية الأوروبية ، وينطبقون على أي مؤسسة بغض النظر عن موقعه وجنسية الأشخاص موضوع البيانات أو إقامتهم - أي معالجة المعلومات الشخصية للأفراد داخل المنطقة الاقتصادية الأوروبية</p>\r\n<p>يجب على مراقبي ومعالجات البيانات الشخصية وضع التدابير الفنية والتنظيمية المناسبة لتنفيذ مبادئ حماية البيانات. يجب تصميم وبناء العمليات التجارية التي تتعامل مع البيانات الشخصية مع مراعاة المبادئ وتوفير ضمانات لحماية البيانات (على سبيل المثال ، استخدام إخفاء الهوية أو إخفاء الهوية الكامل عند الاقتضاء). يجب على مراقبي البيانات تصميم أنظمة المعلومات مع مراعاة الخصوصية. على سبيل المثال ، استخدام أعلى إعدادات الخصوصية الممكنة بشكل افتراضي ، بحيث لا تكون مجموعات البيانات متاحة بشكل افتراضي للجمهور ولا يمكن استخدامها لتحديد موضوع ما. لا يجوز معالجة أي بيانات شخصية ما لم تتم هذه المعالجة بموجب أحد القواعد القانونية الستة المحددة في اللائحة (الموافقة ، العقد ، المهمة العامة ، المصلحة الحيوية ، المصلحة المشروعة أو المتطلبات القانونية). عندما تعتمد المعالجة على الموافقة ، يحق لصاحب البيانات إبطالها في أي وقت.</p>\r\n<p>يجب على مراقبي البيانات الكشف بوضوح عن أي جمع للبيانات ، والإعلان عن الأساس القانوني والغرض من معالجة البيانات ، وتحديد مدة الاحتفاظ بالبيانات وما إذا كانت تتم مشاركتها مع أي جهات خارجية أو خارج المنطقة الاقتصادية الأوروبية. تلتزم الشركات بحماية بيانات الموظفين والمستهلكين إلى الدرجة التي يتم فيها استخراج البيانات الضرورية فقط مع الحد الأدنى من التدخل في خصوصية البيانات من الموظفين أو المستهلكين أو الأطراف الثالثة. يجب أن يكون لدى الشركات ضوابط ولوائح داخلية لمختلف الإدارات مثل التدقيق والضوابط الداخلية والعمليات. يحق لأصحاب البيانات طلب نسخة محمولة من البيانات التي تم جمعها بواسطة وحدة تحكم بتنسيق مشترك ، والحق في محو بياناتهم في ظل ظروف معينة. يُطلب من السلطات العامة والشركات التي تتكون أنشطتها الأساسية من المعالجة المنتظمة أو المنهجية للبيانات الشخصية تعيين مسؤول حماية البيانات (DPO) ، وهو مسؤول عن إدارة الامتثال للقانون العام لحماية البيانات (GDPR). يجب على الشركات الإبلاغ عن انتهاكات البيانات إلى السلطات الإشرافية الوطنية في غضون 72 ساعة إذا كان لها تأثير سلبي على خصوصية المستخدم. في بعض الحالات ، قد يتم تغريم منتهكي اللائحة العامة لحماية البيانات (GDPR) حتى 20 مليون يورو أو ما يصل إلى 4٪ من حجم المبيعات السنوي العالمي للسنة المالية السابقة في حالة وجود مؤسسة ، أيهما أكبر.</p>\r\n<p>تم اعتماد اللائحة العامة لحماية البيانات <strong>(GDPR)</strong> في 14 أبريل 2016 ، وأصبحت قابلة للتنفيذ اعتبارًا من 25 مايو 2018. نظرًا لأن اللائحة العامة لحماية البيانات هي لائحة وليست توجيهًا ، فهي ملزمة وقابلة للتطبيق بشكل مباشر ، ولكنها توفر المرونة لجوانب معينة من اللوائح ليتم تعديلها من قبل الأفراد. الدول الأعضاء.</p>\r\n<p>أصبحت اللائحة نموذجًا للعديد من القوانين الوطنية خارج الاتحاد الأوروبي ، بما في ذلك تشيلي واليابان والبرازيل وكوريا الجنوبية والأرجنتين وكينيا. قانون خصوصية المستهلك في كاليفورنيا (CCPA) ، المعتمد في 28 يونيو 2018 ، له العديد من أوجه التشابه مع اللائحة العامة لحماية البيانات. [2]</p>', 'سياسة الخصوصية', 'في كندا ، تم إنشاء مفوض الخصوصية الكندي بموجب قانون حقوق الإنسان الكندي في عام 1977.', '2021-03-14 21:08:41', '2021-04-11 18:43:31'),
(14, 1, 1, NULL, 'Service example', 'service-example', '<h3>Heading title</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, <strong>sed do eiusmod </strong>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<p><a href=\"https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d\"><img class=\"img-fluid thumparallax-down\" src=\"/public/images/media/163388533314de21b7e74d5379a173b84119868006%20(1).webp\" alt=\"test\" /></a></p>\r\n</div>\r\n<div class=\"col-md-6\">\r\n<p>Lorem ipsum dolor sit amet, <strong>consectetur adipisicing</strong> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n</div>\r\n</div>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <strong>Duis aute irure dolor</strong> in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <strong>non proident</strong>, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n<p><a href=\"https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d\"><img class=\"img-fluid thumparallax-down\" src=\"/public/images/media/1633885135ezgif.com-gif-maker%20(6)%20(1).webp\" alt=\"test\" /></a></p>', 'Service example', 'HT Tech system is a creative agency built with one purpose: to help you define your brand.', '2021-10-12 11:56:22', '2023-10-15 08:23:55'),
(15, 2, 1, NULL, 'Exemplo de serviço', 'service-example', '<h3>T&iacute;tulo do t&iacute;tulo</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, <strong>sed do eiusmod </strong>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<p><a href=\"https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d\"><img class=\"img-fluid thumparallax-down\" src=\"/public/images/media/163388533314de21b7e74d5379a173b84119868006%20(1).webp\" alt=\"test\" /></a></p>\r\n</div>\r\n<div class=\"col-md-6\">\r\n<p>Lorem ipsum dolor sit amet, <strong>consectetur adipisicing</strong> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n</div>\r\n</div>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <strong>Duis aute irure dolor</strong> in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <strong>non proident</strong>, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n<p><a href=\"https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d\"><img class=\"img-fluid thumparallax-down\" src=\"/public/images/media/1633885135ezgif.com-gif-maker%20(6)%20(1).webp\" alt=\"test\" /></a></p>', 'Exemplo de serviço', 'Exemplo de serviço', '2021-10-14 12:29:38', '2023-10-15 08:28:26'),
(16, 3, 1, NULL, 'مثال الخدمة', 'service-example', '<h3>عنوان العنوان</h3>\r\n<p>Lorem ipsum dolor sit amet، consectetur adipisicing elit، <strong> sed do eiusmod </strong> tempor incidunt ut labore et dolore magna aliqua. كل ما في الأمر هو الحد الأدنى من التمرين ، ممارسة العمل على nostrud. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. باستثناء حالات معينة ، يجب أن يكون الشخص مسؤولاً عن ممارسة الجنس. &nbsp; &nbsp;</p>\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<p><img class=\"img-fluid thumparallax-down\" src=\"/public/images/media/163388533314de21b7e74d5379a173b84119868006%20(1).webp\" alt=\"test\" /></p>\r\n</div>\r\n<div class=\"col-md-6\">\r\n<p>Lorem ipsum dolor sit amet, <strong>consectetur adipisicing</strong> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n</div>\r\n</div>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <strong>Duis aute irure dolor</strong> in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <strong>non proident</strong>, sunt in culpa qui officia deserunt mollit anim id est laborum. &nbsp; &nbsp;</p>\r\n<p><img class=\"img-fluid thumparallax-down\" src=\"/public/images/media/1633885135ezgif.com-gif-maker%20(6)%20(1).webp\" alt=\"test\" /></p>', 'مثال الخدمة', 'مثال الخدمة', '2021-10-14 12:31:12', '2021-10-14 12:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('contact@lucian.host', '$2y$10$V03XjapY6Ln0dM71jO.82e64kFK8NTAlU/oKrVl5fPEFbQFwdi2JK', '2021-06-07 22:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `type` enum('sslcommerz','bkash','nagad','manual') NOT NULL DEFAULT 'manual',
  `instructions` text DEFAULT NULL,
  `config` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `slug`, `type`, `instructions`, `config`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'bkash', 'bkash', 'manual', 'বিকাশ অ্যাপ ব্যবহার করে: বিকাশ অ্যাপটি খুলুন এবং আপনার অ্যাকাউন্টে লগ ইন করুন।\r\nহোম স্ক্রিনে থাকা \'টাকা পাঠান\' (Send Money) আইকনে ট্যাপ করুন।\r\nপ্রাপকের মোবাইল নম্বরটি লিখুন অথবা আপনার ফোনের কন্টাক্ট থেকে বেছে নিন।\r\nআপনি যে পরিমাণ টাকা পাঠাতে চান তা টাইপ করুন এবং এগিয়ে যেতে অ্যারো আইকনে ট্যাপ করুন।\r\nট্রান্সফারটি নিশ্চিত করতে আপনার বিকাশ পিন দিন।\r\n--------------------------------------------------------------------------------------------------------------------------------------------------------------------\r\nইউএসএসডি কোড (*247#) ব্যবহার করে: আপনার মোবাইল ফোনে *247# ডায়াল করুন।\r\n\'টাকা পাঠান\' (Send Money) এর জন্য ১ নির্বাচন করুন। প্রাপকের বিকাশ মোবাইল নম্বরটি লিখুন।\r\nআপনি যে পরিমাণ টাকা পাঠাতে চান তা লিখুন।\r\nলেনদেনের জন্য একটি রেফারেন্স লিখুন (অথবা এটি খালি রাখুন/একটি সংক্ষিপ্ত নোট টাইপ করুন)।\r\nলেনদেনটি শেষ করতে আপনার বিকাশ পিন দিন।', '{\"account_number\":\"01876101515\",\"account_name\":\"Personal\"}', 1, 0, '2026-09-05 00:21:14', '2026-09-06 03:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `share_token` varchar(40) DEFAULT NULL,
  `file` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `share_token`, `file`, `created_at`, `updated_at`) VALUES
(1, 'IIRiEflRW5fPKPkTvbzPN3sncyP9YDbP1', '1615631836niva2logo.png', '2021-03-13 15:37:16', '2021-03-13 15:37:16'),
(2, 'y52xov2EJSngwXZQ94qqaaTrl5UyDO1l2', '1615631850niva2logo.png', '2021-03-13 15:37:30', '2021-03-13 15:37:30'),
(3, 'gRTnFCebb9mXQA8UKJ2BtW0g7hBpyXXH3', '1615635078home-slider-layer1-test2-2.jpg', '2021-03-13 16:31:18', '2021-03-13 16:31:18'),
(4, 'cZOfiNwoptamliat3dCpmkWTpWi6rtPn4', '1615635502start-project-bg-img-1.jpg', '2021-03-13 16:38:22', '2021-03-13 16:38:22'),
(5, 'sji34tF7JtdFUodX3zK8XjSJIxzU63Qr5', '1615636710about-s1.jpg', '2021-03-13 16:58:30', '2021-03-13 16:58:30'),
(6, 'SiRhcS28CPjjAhJ6y8b9Zzmvk33Nsl356', '1615636710about-s2.jpg', '2021-03-13 16:58:30', '2021-03-13 16:58:30'),
(8, 'dRrOkI3k9RriPH6C1p5tz6C2Y2SEfFZX8', '1615637853web-design.jpg', '2021-03-13 17:17:33', '2021-03-13 17:17:33'),
(9, 'gdMWMcsP23eJqmYIu5fGWP8BccImEAVz9', '1615638059seo-solutions.jpg', '2021-03-13 17:20:59', '2021-03-13 17:20:59'),
(10, 'f9DFn2d66Ys6goh0xteMX9cpV70rTGdH10', '1615638134advertise-soluti.jpg', '2021-03-13 17:22:14', '2021-03-13 17:22:14'),
(11, 'wMYAw3MCcYohR3etrCzNFpxyZPadZFSE11', '1615638165app-sol-service.jpg', '2021-03-13 17:22:45', '2021-03-13 17:22:45'),
(19, '02a9YPhQl8lt6yKYxK2dl7OQyNVFaY7D19', '1615644757niva-project.jpg', '2021-03-13 19:12:37', '2021-03-13 19:12:37'),
(20, 'aJ8L9Tf25u1iuwiVa41EatHoWC81eBh720', '1615644758venor-project.jpg', '2021-03-13 19:12:38', '2021-03-13 19:12:38'),
(38, 'uqa1ZBrUxsMroEOhRhIhXWdbYKqGOf2z38', '1615660211blog-psot1.jpg', '2021-03-13 23:30:11', '2021-03-13 23:30:11'),
(39, 'BINUqw2Sd8yRUVZ2eXjDmusxGkzB3RMv39', '1615660375post-rece2.jpg', '2021-03-13 23:32:55', '2021-03-13 23:32:55'),
(40, 'iIOax0Yynu1VyKAWuzrFkPGAejt53BEL40', '1615660380post-rece3.jpg', '2021-03-13 23:33:00', '2021-03-13 23:33:00'),
(24, 'TxNiYSRunggKZOjTMVZuh13u1NEfnJCp24', '1615648164favicon.png', '2021-03-13 20:09:24', '2021-03-13 20:09:24'),
(25, 'C8UGcdhW4yphcmrle3FCbTGwto3CwEHZ25', '1615649260about-3-page.jpg', '2021-03-13 20:27:40', '2021-03-13 20:27:40'),
(26, 'e8UP60J5zQtXxR3Dgfvy6k03o4W7jJYe26', '1615650588member-pic (4).jpg', '2021-03-13 20:49:48', '2021-03-13 20:49:48'),
(27, 'T15hwhlf7eNlIahVePusYchWc6BRnP9F27', '1615650635member-pic (2).jpg', '2021-03-13 20:50:35', '2021-03-13 20:50:35'),
(28, 'Rd2N55O8yjbMMV94rlicSFBUfjKQPtjA28', '1615650688member-pic (1).jpg', '2021-03-13 20:51:28', '2021-03-13 20:51:28'),
(29, 'gIFRejgdBKsGd6jrGUwqQbBm8z6WczpP29', '1615650720member-pic (6).jpg', '2021-03-13 20:52:00', '2021-03-13 20:52:00'),
(30, 'tZLXt3pfJKeHvG25UTENNGzCi0IIJjrr30', '1615650802member-pic (5).jpg', '2021-03-13 20:53:22', '2021-03-13 20:53:22'),
(31, 'VQCMGRfGudjnymm0ufpruykTWutZXXVE31', '1615650866member-pic (3).jpg', '2021-03-13 20:54:26', '2021-03-13 20:54:26'),
(32, 'WaWYZ2dJjIQ3Y5ouGHk1Pw591F7bSuvF32', '1615652105client-p2.png', '2021-03-13 21:15:05', '2021-03-13 21:15:05'),
(33, 'kPMF8wHQATP46n1wBho0TaeOxzfKGUi333', '1615652124client-p3.png', '2021-03-13 21:15:24', '2021-03-13 21:15:24'),
(34, 'GKr8jrWoChWonQt560bCUT4op7RnLy1m34', '1615652140client-p4.png', '2021-03-13 21:15:40', '2021-03-13 21:15:40'),
(35, 'TM4nAiWHgNGcyOQu3dHcEpdqQFzial7Z35', '1615652155client-p5.png', '2021-03-13 21:15:55', '2021-03-13 21:15:55'),
(36, 'cUhiRKVruVlcibULxwca3sIZuEF45kuv36', '1615652167client-p6.png', '2021-03-13 21:16:07', '2021-03-13 21:16:07'),
(37, 'Tx0duKwkYYTcueUYrDpMPTArg8OBku8237', '1615652179client-p8.png', '2021-03-13 21:16:19', '2021-03-13 21:16:19'),
(41, 'amPfX2o1giTnH4VtBSr0orZucUFaetVT41', '1615661120project5.jpg', '2021-03-13 23:45:20', '2021-03-13 23:45:20'),
(42, '0IwiDP6HavBxQiqIg3UlbeA2UbLgFasQ42', '1615661127project1.jpg', '2021-03-13 23:45:27', '2021-03-13 23:45:27'),
(43, '14JcleepOFS7JBmZIwaQCrS0EmW9AwgZ43', '1615661133project2.jpg', '2021-03-13 23:45:33', '2021-03-13 23:45:33'),
(44, 'z99DpRBpuTFKsIB0eY6AEnbLwRcE7Gaj44', '1615661137project6.jpg', '2021-03-13 23:45:37', '2021-03-13 23:45:37'),
(45, 'c8VuZcPQFSuRQ5jshY6kYkgW3p1YXpJr45', '1615661143project3.jpg', '2021-03-13 23:45:43', '2021-03-13 23:45:43'),
(46, 'ihjoyPLlYrNFWyM9ROTzQmEGrptz8jKJ46', '1615661148project5.jpg', '2021-03-13 23:45:48', '2021-03-13 23:45:48'),
(47, '9RfQNqR04zySvzUwc8jPuSwNN4efwoxK47', '1615661162project4.jpg', '2021-03-13 23:46:02', '2021-03-13 23:46:02'),
(48, 'ZBsH71I89lED1y5Y5T47j9RTpiApY9lO48', '1615661279st-portfolio1 (1).jpg', '2021-03-13 23:47:59', '2021-03-13 23:47:59'),
(49, 'eyEVSPeKlZkHg3W7WTeOBW3wDpAz4I3K49', '1615661279st-portfolio4 (1).jpg', '2021-03-13 23:47:59', '2021-03-13 23:47:59'),
(50, 'a1VQMRJCjEA7M5vTGoabbTWMOSeLXYxr50', '1615661280st-portfolio2.jpg', '2021-03-13 23:48:00', '2021-03-13 23:48:00'),
(51, 'bLwGcfC3RD57tstcUlZs6t4YZyWrIuBF51', '1615661280st-portfolio3.jpg', '2021-03-13 23:48:00', '2021-03-13 23:48:00'),
(53, 'kkwx73cwpnfOHsqY7QHpmBaDmgLBv0VZ53', '1615713675member-pic (4).jpg', '2021-03-14 13:21:15', '2021-03-14 13:21:15'),
(54, 'Y40fclosyCNdOqMvbTrcg54kJT40Y7jV54', '1615714364sidebar-img1.jpg', '2021-03-14 13:32:44', '2021-03-14 13:32:44'),
(55, 'yemzz3JZgp8UHLTAcDZ5wyfIry7rKX4h55', '1615715240adsense500x500.png', '2021-03-14 13:47:20', '2021-03-14 13:47:20'),
(58, 'rBUKukttkWsMUsjDlUJTijMd72xULoSz58', '1615722163adplace-blog.jpg', '2021-03-14 15:42:43', '2021-03-14 15:42:43'),
(95, 'wrs9r4eMniUfn1it8NUEykanjORf4qRj95', '16163164191616251805sandwich-packaging.jpg', '2021-03-21 12:46:59', '2021-03-21 12:46:59'),
(85, 'O1pD6bmY0i7gcZYNSbU0HUlzon2yn45X85', '1616237145member22-agency-600x600.jpg', '2021-03-20 14:45:45', '2021-03-20 14:45:45'),
(87, 'KVan2LKnan0O1wbwgUd0IbqucdDioLfd87', '1616251743identity-branding3.jpg', '2021-03-20 18:49:03', '2021-03-20 18:49:03'),
(88, 'K3CAmCk1bp0GFFcB26FKDhxg7wn4uzk988', '1616251805sandwich-packaging.jpg', '2021-03-20 18:50:05', '2021-03-20 18:50:05'),
(89, 'KqWdjmcfwuOS9YhLNb7yXHHkvDrhlEWE89', '1616312321project1.jpg', '2021-03-21 11:38:41', '2021-03-21 11:38:41'),
(90, 'bvTJ6V6Apsjul4X72X7w9c9O3E1dt00o90', '1616312331project2.jpg', '2021-03-21 11:38:51', '2021-03-21 11:38:51'),
(91, '8SvfAIU3wZxeF4DHVy5EHjWe99oGefaX91', '1616312337project3.jpg', '2021-03-21 11:38:57', '2021-03-21 11:38:57'),
(92, 'NbXNVxUg1XsnYNhIuDMKuDpOBcZYAzms92', '1616312346project4.jpg', '2021-03-21 11:39:06', '2021-03-21 11:39:06'),
(93, 'lN3wsrvr7EJJv8MTPPjygn3Jyxdu3LHe93', '1616312361project5.jpg', '2021-03-21 11:39:21', '2021-03-21 11:39:21'),
(94, 'jawXKSHdLeR4FpesG03WIUmHztimIwuL94', '1616312371project6.jpg', '2021-03-21 11:39:31', '2021-03-21 11:39:31'),
(114, 'BxFcaSoO3ulCPWXB9UvkbLqjTqrfrYsZ114', '1618065739arabic.svg', '2021-04-10 18:42:19', '2021-04-10 18:42:19'),
(115, 'T9svXuJezP2b1YnJ9MMyqX1z2A5Mgfau115', '1618066273portugal.svg', '2021-04-10 18:51:13', '2021-04-10 18:51:13'),
(116, 'zOl3Y1qQR4m6HgPdqsF3Xvg5YVDZVdlI116', '1618066305united-kingdom.svg', '2021-04-10 18:51:45', '2021-04-10 18:51:45'),
(119, 'g1xpKzOkN2F46QwKc6pmqWvS1QNzMNf4119', '16187422851615635502start-project-bg-img-1.jpg', '2021-04-18 14:38:05', '2021-04-18 14:38:05'),
(120, 'wJXCgLp0Widdn2lxquHymOYEBB3CBg3r120', '16187424371615635502start-project-bg-img-1.jpg', '2021-04-18 14:40:37', '2021-04-18 14:40:37'),
(121, 'yL3BAPIDnA7sXHOgVfDgnOCEVhiGNsFl121', '1621861012logo8.svg', '2021-05-24 16:56:52', '2021-05-24 16:56:52'),
(122, 'M9xZtaMfoS9SDknGlPcqDhMKxxB0bxs9122', '1622048188venor-layer1.png', '2021-05-26 20:56:28', '2021-05-26 20:56:28'),
(123, 'z3N9OLXTJCUSdnkRs9FuDA1gq60cOkol123', '1622050488home-version-five-banner-side-img1.png', '2021-05-26 21:34:48', '2021-05-26 21:34:48'),
(124, 'jd6YiLx3DFOOAYDfhB38ZTq6F96y2jWw124', '1622051367right-image-2.png', '2021-05-26 21:49:27', '2021-05-26 21:49:27'),
(125, 'iZ2iPXJrMpGb1KyUOkzxXe6yjLR2wEmK125', '1622051695banner-image.png', '2021-05-26 21:54:55', '2021-05-26 21:54:55'),
(126, '4USRTf2XrGb5jkz9lD8wR9GXDXUoKbJ5126', '1622051838banner-1.png', '2021-05-26 21:57:18', '2021-05-26 21:57:18'),
(127, 'GSJHJqp5gksulcyh6jyw6WYcyqE1cIWU127', '16220521941615636710about-s1.jpg', '2021-05-26 22:03:14', '2021-05-26 22:03:14'),
(128, 't0fXVCKTCA1wmVVpyma5LNWxPSv238GG128', '16220522691615636710about-s1.jpg', '2021-05-26 22:04:29', '2021-05-26 22:04:29'),
(168, 'IIFbf1l5dGcS67rt0YvMsAWrDIKoI6Ep168', '1622363873galerie1.jpg', '2021-05-30 12:37:53', '2021-05-30 12:37:53'),
(130, 'Q0XBtqNgpeOhROt9G976GhPhs3LBmR7U130', '16220532141615636710about-s2.jpg', '2021-05-26 22:20:14', '2021-05-26 22:20:14'),
(131, 'A0zhDaDCp6YONrhuf5E8TZqKBAG79TLG131', '16220581871615636710about-s2.jpg', '2021-05-26 23:43:07', '2021-05-26 23:43:07'),
(132, 'MUkVZBD1sOGnWBvDJVi9JeBpVbeAgoNb132', '16221355461615638134advertise-soluti.jpg', '2021-05-27 21:12:26', '2021-05-27 21:12:26'),
(133, 'IcBCoHbzphwsnI444mTxTW7V9B7Uc72D133', '16221359571615638134advertise-soluti.jpg', '2021-05-27 21:19:17', '2021-05-27 21:19:17'),
(134, 'EvCb1GqlJkW3CXnj4wzL5ae4C6qbNre4134', '16221360901615638134advertise-soluti.jpg', '2021-05-27 21:21:30', '2021-05-27 21:21:30'),
(135, 'SStyPncgRIbbhR1T54AzToE06RCIQ8sE135', '16221363221615638134advertise-soluti.jpg', '2021-05-27 21:25:22', '2021-05-27 21:25:22'),
(136, 'YaseGNLRhgSMy1pW18jQYtijAeRtHe5C136', '1622283727project1.jpg', '2021-05-29 14:22:07', '2021-05-29 14:22:07'),
(137, 'vy1gRQJNrXuebIxRcpukA58k6j6Ktbhw137', '1622292570project2.jpg', '2021-05-29 16:49:30', '2021-05-29 16:49:30'),
(138, 'LPKfOsBCXNhs605KWEMhmx5LvInH3ISO138', '1622292686project3.jpg', '2021-05-29 16:51:26', '2021-05-29 16:51:26'),
(139, 'Rjr2rWJxPqvgftEM9URF7cPJmmDPJf5D139', '1622292846project3.jpg', '2021-05-29 16:54:06', '2021-05-29 16:54:06'),
(140, '1QDwE9f84F6gjM6wqaWQOdFf8T9I2SVm140', '1622292944project4.jpg', '2021-05-29 16:55:44', '2021-05-29 16:55:44'),
(144, 'aaBRGIKQwNHMmW0PjteW5mlAbxiHCznb144', '1622298365post1.jpg', '2021-05-29 18:26:05', '2021-05-29 18:26:05'),
(145, 'Fz1tdgO5Fl8jCFt2t88ZQzUONtwYu4a9145', '1622298385post2.jpg', '2021-05-29 18:26:25', '2021-05-29 18:26:25'),
(146, '1VnL9p92l44bHSuxYlBbfWy26RaipswS146', '1622298433post3.jpg', '2021-05-29 18:27:13', '2021-05-29 18:27:13'),
(147, 'd7pDp3b4NKqckqzT7x38DKDga7tQNO5B147', '1622301395slider2.png', '2021-05-29 19:16:35', '2021-05-29 19:16:35'),
(148, 'fyPSgnNd3KH8cRQYWt8wydbnwsvkFLTO148', '16223146321615649260about-3-page.jpg', '2021-05-29 22:57:12', '2021-05-29 22:57:12'),
(155, 'nkWbBOmZESEMXSynU3NhH593taGoxPeh155', '1622317714portret3.jpg', '2021-05-29 23:48:34', '2021-05-29 23:48:34'),
(171, '0cHUslLSpXOOCfLPMBzeEfYIv145wP3N171', '1622363875galerie4.jpg', '2021-05-30 12:37:55', '2021-05-30 12:37:55'),
(158, 'fkDTjfCLpWK6ypwRztqxiQLNpxOE9pX9158', '1622318113portret5.jpg', '2021-05-29 23:55:13', '2021-05-29 23:55:13'),
(159, 'U3sT5pRix156Xi5GC4bugqNC9ZMrbCVN159', '1622318247portret6.jpg', '2021-05-29 23:57:27', '2021-05-29 23:57:27'),
(160, '0UhIT53gt8YsTV4m0vA77Cmk9P7cwvbd160', '1622318449portret1.jpg', '2021-05-30 00:00:49', '2021-05-30 00:00:49'),
(161, 'VodnL04GYBRwJFtCjyGIqG5VAEgXTP60161', '1622318512portret6.jpg', '2021-05-30 00:01:52', '2021-05-30 00:01:52'),
(170, 'qtfO9m9cUbqWmm2lGt07lVupwGHKsYCB170', '1622363874galerie3.jpg', '2021-05-30 12:37:54', '2021-05-30 12:37:54'),
(169, '4RzfU9R6vDQcDTQE50LvyLKFj9QrIx3n169', '1622363873galerie2.jpg', '2021-05-30 12:37:53', '2021-05-30 12:37:53'),
(164, 'kmdmLC68iSvO5SiOG3P4dYVCZEBj02cS164', '1622318868portret4.jpg', '2021-05-30 00:07:48', '2021-05-30 00:07:48'),
(165, 'S8JGtpXct9lQDidy0QXxISDANS2lWQy5165', '1622322430project5.jpg', '2021-05-30 01:07:10', '2021-05-30 01:07:10'),
(166, 'lMH9dLw94i9mhKBC51Jq8vE7g7RoTUTa166', '1622322484project6.jpg', '2021-05-30 01:08:04', '2021-05-30 01:08:04'),
(167, '77UCgFsIUMsw5ytcBUHrLyl5FpSIXLkk167', '1622322572project1.jpg', '2021-05-30 01:09:32', '2021-05-30 01:09:32'),
(210, 'leCDozioBrpcX4Qd1aHfyriGMIvrt9LT210', '1633178646testimonial3_1.webp', '2021-10-02 16:44:06', '2021-10-02 16:44:06'),
(208, 'P5j2ILF4P4gVPAlHMwjaSNE8NxIU02KZ208', '1633028114projectquin1jpg.webp', '2021-09-30 22:55:14', '2021-09-30 22:55:14'),
(209, 'WXSIpvC3mdoQY9gpinOWg2s8uW5YlQ87209', '1633028145project3quin.webp', '2021-09-30 22:55:45', '2021-09-30 22:55:45'),
(207, 'FZ19mMBU889wM2hlQ0tQazwVQeGes1vy207', '1633028074project2quin.webp', '2021-09-30 22:54:34', '2021-09-30 22:54:34'),
(206, 'pvIQ1ZUvbKGXKDWrNPzxm6UEg1d7Bor7206', '1633027856favicon.webp', '2021-09-30 22:50:56', '2021-09-30 22:50:56'),
(205, 'vYX7YcELe79xkOVEAZ5CF3gqM4ztAOYo205', '1633027761logo.svg', '2021-09-30 22:49:21', '2021-09-30 22:49:21'),
(204, 'Cib8k3tMaves2T99oRu1gqYWmI0PvtwR204', '1633027720quinheader.webp', '2021-09-30 22:48:40', '2021-09-30 22:48:40'),
(203, 'RJya6iVBxXcSqBANGbUdXh2ErEiqXL7k203', '163302763816327698011632602616Consult_header-10.webp', '2021-09-30 22:47:18', '2021-09-30 22:47:18'),
(190, 'bhQvxt92mmRllwY5g1caj6U4FGojkSTX190', '1632820172logo-white.svg', '2021-09-28 13:09:32', '2021-09-28 13:09:32'),
(191, 'EArLh3X6xcnHAwE6JsiZAsKAO3mIC3Fc191', '1632839112about-us-pic3.webp', '2021-09-28 18:25:12', '2021-09-28 18:25:12'),
(192, 'htLIaBBEM76HIw9wu1S1NDss55VV7Try192', '1632839112about-us-pic2.webp', '2021-09-28 18:25:12', '2021-09-28 18:25:12'),
(193, 'WgrbOtLUAVjGmxLybaans9PcEfoD3BdX193', '1632839113about-us-pic1.webp', '2021-09-28 18:25:13', '2021-09-28 18:25:13'),
(194, 'ZtKBqTOEAHFO8LKtDFIdHczntIZQxtFM194', '1632921799quin-service-webdesign.webp', '2021-09-29 17:23:19', '2021-09-29 17:23:19'),
(195, 'qre4UMcTruBcozYm2EkR59T15WDLRUJ3195', '1632921978quin-service-webdesign1.webp', '2021-09-29 17:26:18', '2021-09-29 17:26:18'),
(196, 'NPBh29gZIohvmd3HdK6XfBtGjtP9Qhhm196', '1632922118quin-service2.webp', '2021-09-29 17:28:38', '2021-09-29 17:28:38'),
(197, 'Xk2Fk1rUNLtUtOaz0boTvpKRK6yGljdu197', '1632922319quin-service1.webp', '2021-09-29 17:31:59', '2021-09-29 17:31:59'),
(198, 'ILMRuB81tzmEq60TMwhN7ToPp2Minf0q198', '1632922413quin-service4.webp', '2021-09-29 17:33:33', '2021-09-29 17:33:33'),
(211, 'gPxXDpU9c95yBKDauRfAYkrSOmOM3AmY211', '1633178646testimonial2_1.webp', '2021-10-02 16:44:06', '2021-10-02 16:44:06'),
(212, 'bWSOQEqYByqzPZ51lWSTOIx2TXcfRnLn212', '1633178648testimonial1_1.webp', '2021-10-02 16:44:08', '2021-10-02 16:44:08'),
(213, 'Q4F7e5zlTMIceLkzeokqptmdz8CKYJRp213', '1633250087blog-post1.webp', '2021-10-03 12:34:47', '2021-10-03 12:34:47'),
(214, 'hyKjCnprAtaXSr54XHmrmtrEjnFtEY7V214', '1633250107blog-post2.webp', '2021-10-03 12:35:07', '2021-10-03 12:35:07'),
(215, 'zByshUPxb1jjRt8eq7SjyvSaLfcmK56A215', '1633250113blog-post3.webp', '2021-10-03 12:35:13', '2021-10-03 12:35:13'),
(216, 'nWFAXPibvk3hWa9DSiJbsfHGwosf2V8k216', '1633278274PSDFebFrameNot163 (1).webp', '2021-10-03 20:24:34', '2021-10-03 20:24:34'),
(217, 'KdtC8cnLmc5sOhs4ny9sWjXjVXV13XVk217', '1633880725portf_header-16.webp', '2021-10-10 19:45:25', '2021-10-10 19:45:25'),
(218, '0Ef4cdF3sBq6hvnYSONbmdYkxhGery6K218', '1633882008project1-test.webp', '2021-10-10 20:06:48', '2021-10-10 20:06:48'),
(219, 'wRiM2XXfSUr3aaWOfxTobPCUtGOTNqoA219', '163388441262dd36111481101.6002db2f51eef.webp', '2021-10-10 20:46:52', '2021-10-10 20:46:52'),
(220, 'lxdSvWZ8mDEYm3Cwq1CadqLifsvGI41p220', '1633884505project1quin.webp', '2021-10-10 20:48:25', '2021-10-10 20:48:25'),
(221, 's8uckBu0OUG94z8HbO6TbgRNwfFVDDl9221', '1633884610fe1ac9110475937.5fee059e53bdf.webp', '2021-10-10 20:50:10', '2021-10-10 20:50:10'),
(222, '2kCES5YYOjDbtcksOF8JwPsmiXehAjgn222', '1633884677Project2quib.webp', '2021-10-10 20:51:17', '2021-10-10 20:51:17'),
(223, '5VfSgiHrvTnyfpcSLVaImLy5rLek9fxx223', '1633885135ezgif.com-gif-maker (6) (1).webp', '2021-10-10 20:58:55', '2021-10-10 20:58:55'),
(224, 'vQvLOhOgT3w4Qe7PpRDOmn1V5px8xt2P224', '1633885230ezgif.com-gif-maker (7).webp', '2021-10-10 21:00:30', '2021-10-10 21:00:30'),
(225, 'HuI2KGASKIMOwI6308YRxpVrci1nlUIt225', '163388533314de21b7e74d5379a173b84119868006 (1).webp', '2021-10-10 21:02:13', '2021-10-10 21:02:13'),
(226, 'Y6E0BmVY4x58i8Zs57nL2z5UbOqlhbKM226', '1633885407ezgif.com-gif-maker (8).webp', '2021-10-10 21:03:27', '2021-10-10 21:03:27'),
(231, 'ULeFFNJPf9kyCZHM5TwONknsjTBPVfmm231', '1641902421logo3.png', '2022-01-11 17:00:21', '2022-01-11 17:00:21'),
(232, 'N8sRjMRH6zOrz2LzcP2QS1Uekv3bNcgd232', '1641910281logo3 (1).svg', '2022-01-11 19:11:21', '2022-01-11 19:11:21'),
(233, 'AD4J48cuPeYJrNu2ZMZIo2mkwGE8PXJ1233', '1641916582image-2-icode.svg', '2022-01-11 20:56:22', '2022-01-11 20:56:22'),
(234, 'zl4K18UJiNbVxQSaOUZktNop97eVbmrA234', '1642597997web-design.png', '2022-01-19 18:13:17', '2022-01-19 18:13:17'),
(235, 'C4KKiZ3u1LPooMkbTGgDmr7OfTDuaeeA235', '1642598023infographic.png', '2022-01-19 18:13:43', '2022-01-19 18:13:43'),
(236, 'uQGR4g8UmtGotXtIRAcBR6C84LsAHCnf236', '1642598034coding.png', '2022-01-19 18:13:54', '2022-01-19 18:13:54'),
(237, 'dzjK6POnFzdg8FKFRkDy9bPiwBOXwb1d237', '1642598042wireframe.png', '2022-01-19 18:14:02', '2022-01-19 18:14:02'),
(238, 'tJR6MSKwqCbKKs6qEjDWnceowVqpDK47238', '1642859398image1-slider.svg', '2022-01-22 18:49:58', '2022-01-22 18:49:58'),
(239, '3wIbDSfzwrLkygPpvkDrgvLWXeIMGuP9239', '164286014020943546 [Converted].svg', '2022-01-22 19:02:20', '2022-01-22 19:02:20'),
(240, 'dfKQCuMS1BDu7irDK1a88DfYQWSiC8bN240', '1642887630logo-loader.svg', '2022-01-23 02:40:30', '2022-01-23 02:40:30'),
(241, 'DNAdRb2ZjL5zRZnfrFpqQvvxKfOshRW0241', '1643016131favicon.png', '2022-01-24 14:22:11', '2022-01-24 14:22:11'),
(247, 'Z4mYjgSe5f1EYngjXd7HJ4fAjOK2fofA247', '1780350001HT Tech systemAsset 19mainlogob.png', '2026-06-01 21:40:01', '2026-06-01 21:40:01'),
(248, 'rZpinsj2JIUv7rvEHiark1XwO0TOVdx3248', '1780350111Bangla bng.png', '2026-06-01 21:41:51', '2026-06-01 21:41:51'),
(249, 'inDTOICOY9FSAe1D23KxQsoLlfjNZGR1249', '1780425944HT Tech systemAsset 19mainlogob.png', '2026-06-02 18:45:44', '2026-06-02 18:45:44'),
(250, 'PWJCMAvBU3Oyf4wCvg8oXOqy2oLHNABn250', '1785261278PXL_20221013_014724015.jpg', '2026-07-28 17:54:38', '2026-07-28 17:54:38'),
(251, 'udWFDf2PO8G4ZPrIGR1AplmSb2Z6yRUb251', '1787163751HT Tech systemAsset 19mainlogow.png', '2026-08-19 18:22:31', '2026-08-19 18:22:31'),
(252, '49oADEwnpzKCVGhKvAFNjfmMhSSQkJ3N252', '1787163769HT Tech systemAsset 19mainlogow.png', '2026-08-19 18:22:49', '2026-08-19 18:22:49'),
(253, 'TyLn9UNbGzEsSCnldjE5QtyZvFRb7UyI253', '17873457522026-08-14 15-58-42.mp4', '2026-08-21 20:55:52', '2026-08-21 20:55:52'),
(254, '2JGM6msFNg5xs8csdobtwUD34jSUt3hYbfTanZLC', '1787392758my first cartoon make.mp4', '2026-08-22 09:59:22', '2026-08-22 09:59:22'),
(255, 'MRPFbKxWwuc1r1zWrXy6WnMUmpKafFjM03kOEuxH', '1787393443Untitled design (1).mp4', '2026-08-22 10:10:43', '2026-08-22 10:10:43'),
(256, 'MvT115y6a2Fau8W63OWsEAeLp6E8z7tKyIxZDyRv', '1787394136Live S2S Arena.mp4', '2026-08-22 10:22:17', '2026-08-22 10:22:17'),
(257, 'n71RK5lpIN00PRxEfyKiIVebARpdU96BukshGETf', '1787394171nid_form2_correction_edit.pdf', '2026-08-22 10:22:51', '2026-08-22 10:22:51'),
(258, 'x9R61zqBTn2Z9hhZRujlHMQbXu7CZmHgqmzSz3TS', '1787394215Chiro Odhora  চর অধর  Miftah Zaman  Amit Malick  New Bangla Song  Official Lyrical Video.mp3', '2026-08-22 10:23:35', '2026-08-22 10:23:35'),
(259, 'sakmLqTKirXdEP7rylA8bYOOzg2jfCyjKUuWNf4W', '1787394469PXL_20260810_102841385.mp4', '2026-08-22 10:27:49', '2026-08-22 10:27:49'),
(260, 'SL7tShKPVE6pt4eZYzoX7Ylm0v3xnTCxzFxSdkS0', '1787429077FB_IMG_1787401994971.jpg', '2026-08-22 20:04:37', '2026-08-22 20:04:37'),
(261, 'hsfa8getDZnTwjWdWv4poLbKFYru8olcEMvQdrwh', '1787667287HT Tech systemAsset 19mainlogob.png', '2026-08-25 14:14:47', '2026-08-25 14:14:47'),
(262, '2AOvmPeM2eoWsf3wC1tiobfeJftS1SJIbrRzJvK5', '1787667366Bangla bng.png', '2026-08-25 14:16:06', '2026-08-25 14:16:06'),
(263, 'RQGLiVJQ8mBgYkUwi5MwK4g7e556XZtkYOk1OnP5', '1787917253Untitled design (6)512.png', '2026-08-28 17:40:53', '2026-08-28 17:40:53'),
(264, 'MpXiilTBWYvnLnP9hJHUJunUfdxPeH4pp8ba81pu', '1787917459Screenshot 2026-08-18 000222.png', '2026-08-28 17:44:19', '2026-08-28 17:44:19'),
(265, 'WelL9FPDMMdEcFTYqESTs19T90KEwjlM8CBW5lZf', '1787917459Screenshot 2026-08-19 024640.png', '2026-08-28 17:44:19', '2026-08-28 17:44:19'),
(266, 'SsRz1win0nXamsyzfDTQcOx5AqRMfTHkaCnh8rv7', '1787917460Screenshot 2026-08-26 152102.png', '2026-08-28 17:44:20', '2026-08-28 17:44:20'),
(267, 'UfnFzFR1tybeJ7I29Cjd0OghhBjcOTRbAJAHyhrw', '1787917460Screenshot 2026-08-23 021938.png', '2026-08-28 17:44:20', '2026-08-28 17:44:20'),
(268, 'SJP0IitVAHZuEHVcFl4beJwv0lt5d97gPHDFVQ8P', '1787917762Screenshot 2026-08-22 032218.png', '2026-08-28 17:49:22', '2026-08-28 17:49:22'),
(269, 'QzFfdQJVG1icLMqdywodIgLxfhGT4HCZl0XEzBTf', '1787917762fix-timezone.zip', '2026-08-28 17:49:22', '2026-08-28 17:49:22'),
(270, 'si3zzCGJRGSuFh4wDC5L1OZcmjA3nBZqRiT3c3Zg', '1788078658httsys_400x400.png', '2026-08-30 14:30:58', '2026-08-30 14:30:58'),
(271, 'EqLc52QNiI6HkcjQb9TXRky6uVVC7Y37CGwNZEeh', '1788078775iPhone-17-Pro-Max-Pro-Price-in-Bangladesh-(2).webp', '2026-08-30 14:32:55', '2026-08-30 14:32:55'),
(272, 'e43UCN4Z4Sk4ayOd0elkwse9VaVDKJtvUEnHVJRr', '1788078775iPhone-17-Pro-Max-Pro-Price-in-Bangladesh-(1).webp', '2026-08-30 14:32:55', '2026-08-30 14:32:55'),
(273, 'ZfM9iGxzqn4pbs2rOJC1ljRHsMDYgQagr0T5Ygex', '1788078775iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', '2026-08-30 14:32:55', '2026-08-30 14:32:55'),
(274, 'hM4jdZTLt8PpNcFbRpAbb21HZLYHhjIzEwxJFG0h', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', '2026-08-30 14:34:45', '2026-08-30 14:34:45'),
(275, 'tSH2BtiEq81rj4jlNIlvIAaoIe2Fj6ohNMem4Agu', '1788546282Untitled design512.png', '2026-09-05 00:24:42', '2026-09-05 00:24:42'),
(276, 'j4tTF4eQkLTzKkvZOaLequ6nGlZQOcH2URVoZwbR', '1788553566vecteezy_people-are-putting-money-in-the-donation-box_6916149.jpg', '2026-09-05 02:26:06', '2026-09-05 02:26:06'),
(277, 'RexfJaDuJVM7C97ZSgoLzYb1Tdo5OsOoj4msaleZ', '1788553621vecteezy_people-are-putting-money-in-the-donation-box_6916149.jpg', '2026-09-05 02:27:01', '2026-09-05 02:27:01'),
(284, 'YKN1gspkxskm8EoRzTOHfTXlP7xEHvgL42BYiUnJ', '1791055550jacket.jpg', '2026-10-04 01:25:50', '2026-10-04 01:25:50'),
(279, 'dFsHvp4GO4ZOKqcNySDMfFHnIrOK5Gl2RNtZj8Uh', '1789415436_vecteezy_man-korean-stylish-minimalist-boy-wallpaper-man-fashion_11668762.jpg', '2026-09-15 01:50:36', '2026-09-15 01:50:36'),
(280, 'tKse1qStln55IBuSCUq6nmLPCF7bZEG7OSJ8Ea7x', '1789416275_1000008881.jpg', '2026-09-15 02:04:35', '2026-09-15 02:04:35'),
(281, '0SEJ5VqffoKFrxjoAjrT3gqKoIp0zLdWunwjWIlf', '1790026722vecteezy_yellow-notepad-with-a-matching-pen-on-a-bright-yellow_52079121.jpg', '2026-09-22 03:38:42', '2026-09-22 03:38:42'),
(282, 'hDwDj2vx7ZRA4HkY01T2Zslp2bd83Vt4y7KaeRFj', '17900704311000104703.png', '2026-09-22 15:47:11', '2026-09-22 15:47:11'),
(283, 'Rf6doxL3l4Uhs2p0bJKk4BUQJoEtrFz6pgQgobpH', '17905379531000104703.png', '2026-09-28 01:39:13', '2026-09-28 01:39:13');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_locations`
--

CREATE TABLE `pickup_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `address_line` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `state` varchar(191) DEFAULT NULL,
  `country` varchar(191) NOT NULL DEFAULT 'Bangladesh',
  `postal_code` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pickup_locations`
--

INSERT INTO `pickup_locations` (`id`, `name`, `address_line`, `city`, `state`, `country`, `postal_code`, `phone`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Chittagong', 'GPO', 'Chittagong', 'Chittagong', 'Bangladesh', '4000', '+8801876101515', 1, 0, '2026-09-12 02:50:42', '2026-09-12 02:50:42'),
(2, 'Comilla', 'GPO', 'Comilla', 'Chittagong', 'Bangladesh', '3500', '+8801876101515', 1, 1, '2026-09-12 02:51:13', '2026-09-12 02:51:13'),
(3, 'Dhaka', 'GPO', 'Dhaka', 'Dhaka', 'Bangladesh', '1000', '+8801876101515', 1, 2, '2026-09-12 02:51:55', '2026-09-12 02:51:55');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_settings`
--

CREATE TABLE `portfolio_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` int(4) NOT NULL DEFAULT 0,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` text NOT NULL,
  `slug` varchar(191) NOT NULL,
  `breadcrumbs_anchor` varchar(191) NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `banner_img` varchar(255) DEFAULT NULL,
  `banner_title` varchar(255) DEFAULT NULL,
  `banner_desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_settings`
--

INSERT INTO `portfolio_settings` (`id`, `language_id`, `meta_title`, `meta_description`, `slug`, `breadcrumbs_anchor`, `title`, `description`, `banner_img`, `banner_title`, `banner_desc`, `created_at`, `updated_at`) VALUES
(1, 1, 'Our Portfolio', 'HT Tech system put customers first and facilitate them with the freedom to choose from many of system, compare prices, offer the best deals and safeguards- all within a few minutes and with just a few step on our Website.', 'portfolio', 'Home', '', '', 'https://icode.lucian.host/public/images/media/1633880725portf_header-16.webp', 'Our latest<span>projects</span>', 'Mirror of creative solutions developed for clients. As passionate designers, we love building awesome products that are easy to use, accessible, engaging, and delightful.', NULL, '2023-03-06 19:53:24'),
(2, 2, 'আমাদের পোর্টফোলিও', 'এইচটি টেক সিস্টেম প্রকল্প', 'portfolio', 'হোম', '', '', 'https://icode.lucian.host/public/images/media/1633880725portf_header-16.webp', 'Nossos últimos <span> projetos </span>', 'Espelho de soluções criativas desenvolvidas para clientes. Como designers apaixonados, adoramos criar produtos incríveis que são fáceis de usar, acessíveis, envolventes e deliciosos.', NULL, '2023-03-07 14:13:52'),
(3, 3, 'لدينا محفظة', 'مشاريع نيفا', 'portfolio', 'منزل، بيت', '', '', 'https://icode.lucian.host/public/images/media/1633880725portf_header-16.webp', 'أحدث <span> مشاريعنا </ span>', 'مرآة الحلول الإبداعية المطورة للعملاء. بصفتنا مصممين شغوفين ، نحب بناء منتجات رائعة سهلة الاستخدام ويمكن الوصول إليها وجذابة وممتعة.', NULL, '2021-04-10 22:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `photo_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `body` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `language_id`, `user_id`, `category_id`, `photo_id`, `title`, `slug`, `body`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(18, 3, 1, 11, 215, 'أفضل 7 طرق إبداعية لتعزيز وسائل الإعلام الخاصة بك', '7-creative-ways-to-boost-your-social-media', '<p>يشمل تصميم الويب العديد من المهارات والتخصصات المختلفة في إنتاج وصيانة المواقع الإلكترونية. تشمل المجالات المختلفة لتصميم الويب تصميم رسومات الويب ؛ تصميم واجهة؛ التأليف ، بما في ذلك التعليمات البرمجية الموحدة.</p>\r\n<p>كانت العلامة التجارية موجودة منذ 350 م وهي مشتقة من كلمة \"براندر\" ، والتي تعني \"حرق\" في اللغة الإسكندنافية القديمة. بحلول القرن السادس عشر ، أصبحت تعني العلامة التي أحرقها أصحاب المزارع على الماشية للدلالة على الملكية. ومع ذلك ، فإن العلامة التجارية اليوم هي أكثر من مجرد مظهر أو شعار. لقد حان للدلالة على الشعور العاطفي \"الغريزي\". رد الفعل الذي يمكن أن تثيره الشركة من عملائها</p>\r\n<p><img class=\"img-fluid\" src=\"/public/images/media/1615661162project4.jpg\" alt=\"1615661162project4.jpg\" /></p>\r\n<p>يشمل تصميم الويب العديد من المهارات والتخصصات المختلفة في إنتاج وصيانة المواقع الإلكترونية. تشمل المجالات المختلفة لتصميم الويب تصميم رسومات الويب ؛ تصميم واجهة؛ التأليف ، بما في ذلك التعليمات البرمجية الموحدة.</p>\r\n<blockquote>\r\n<p>يستخدم مصطلح تصميم الويب عادةً لوصف عملية التصميم المتعلقة بتصميم الواجهة الأمامية (جانب العميل) لموقع الويب بما في ذلك كتابة العلامات. يتداخل تصميم الويب جزئيًا مع هندسة الويب.</p>\r\n<footer class=\"blockquote-footer\">Michael Smith</footer></blockquote>\r\n<p>كانت العلامة التجارية موجودة منذ 350 م وهي مشتقة من كلمة \"براندر\" ، والتي تعني \"حرق\" في اللغة الإسكندنافية القديمة. بحلول القرن السادس عشر ، أصبحت تعني العلامة التي أحرقها أصحاب المزارع على الماشية للدلالة على الملكية. ومع ذلك ، فإن العلامة التجارية اليوم هي أكثر من مجرد مظهر أو شعار. لقد حان للدلالة على الشعور العاطفي \"الغريزي\". رد الفعل الذي يمكن أن تثيره الشركة من عملائها</p>\r\n<p><a title=\"adsense\" href=\"https://www.google.com/adsense/start/\" target=\"_blank\" rel=\"noreferrer noopener\"><img class=\"img-fluid img-ad\" src=\"/public/images/media/1615722163adplace-blog.jpg\" alt=\"1615722163adplace-blog.jpg\" /></a></p>', 'أفضل 7 طرق إبداعية لتعزيز وسائل الإعلام الخاصة بك', 'كانت العلامة التجارية موجودة منذ 350 م وهي مشتقة من كلمة \"براندر\" ، والتي تعني \"تحترق\" في اللغة الإسكندنافية القديمة. بحلول القرن السادس عشر ، أصبحت تعني العلامة التي أحرقها أصحاب المزارع على الماشية للدلالة على الملكية. ومع ذلك ، فإن العلامة التجارية اليوم هي أكثر من مجرد مظهر أو شعار. لقد حان للدلالة على رد فعل \"الشعور الغريزي\" العاطفي الذي يمكن أن تثيره الشركة من عملائها', '2021-03-14 00:38:58', '2021-04-11 21:48:14'),
(17, 3, 1, 12, 213, 'أحدث تصميمات المصمم الفني جون دو', 'tech-designer-john-does-latest-creation', '<p>يشمل تصميم الويب العديد من المهارات والتخصصات المختلفة في إنتاج وصيانة المواقع الإلكترونية. تشمل المجالات المختلفة لتصميم الويب تصميم رسومات الويب ؛ تصميم واجهة؛ التأليف ، بما في ذلك التعليمات البرمجية الموحدة.</p>\r\n<p>كانت العلامة التجارية موجودة منذ 350 م وهي مشتقة من كلمة \"براندر\" ، والتي تعني \"حرق\" في اللغة الإسكندنافية القديمة. بحلول القرن السادس عشر ، أصبحت تعني العلامة التي أحرقها أصحاب المزارع على الماشية للدلالة على الملكية. ومع ذلك ، فإن العلامة التجارية اليوم هي أكثر من مجرد مظهر أو شعار. لقد حان للدلالة على الشعور العاطفي \"الغريزي\". رد الفعل الذي يمكن أن تثيره الشركة من عملائها</p>\r\n<p><img class=\"img-fluid\" src=\"/public/images/media/1615661162project4.jpg\" alt=\"1615661162project4.jpg\" /></p>\r\n<p>يشمل تصميم الويب العديد من المهارات والتخصصات المختلفة في إنتاج وصيانة المواقع الإلكترونية. تشمل المجالات المختلفة لتصميم الويب تصميم رسومات الويب ؛ تصميم واجهة؛ التأليف ، بما في ذلك التعليمات البرمجية الموحدة.</p>\r\n<blockquote>\r\n<p>يستخدم مصطلح تصميم الويب عادةً لوصف عملية التصميم المتعلقة بتصميم الواجهة الأمامية (جانب العميل) لموقع الويب بما في ذلك كتابة العلامات. يتداخل تصميم الويب جزئيًا مع هندسة الويب.</p>\r\n<footer class=\"blockquote-footer\">Michael Smith</footer></blockquote>\r\n<p>كانت العلامة التجارية موجودة منذ 350 م وهي مشتقة من كلمة \"براندر\" ، والتي تعني \"حرق\" في اللغة الإسكندنافية القديمة. بحلول القرن السادس عشر ، أصبحت تعني العلامة التي أحرقها أصحاب المزارع على الماشية للدلالة على الملكية. ومع ذلك ، فإن العلامة التجارية اليوم هي أكثر من مجرد مظهر أو شعار. لقد حان للدلالة على الشعور العاطفي \"الغريزي\". رد الفعل الذي يمكن أن تثيره الشركة من عملائها</p>\r\n<p><a title=\"adsense\" href=\"https://www.google.com/adsense/start/\" target=\"_blank\" rel=\"noreferrer noopener\"><img class=\"img-fluid img-ad\" src=\"/public/images/media/1615722163adplace-blog.jpg\" alt=\"1615722163adplace-blog.jpg\" /></a></p>', 'أحدث تصميمات المصمم الفني جون دو', 'كانت العلامة التجارية موجودة منذ 350 م وهي مشتقة من كلمة \"براندر\" ، والتي تعني \"تحترق\" في اللغة الإسكندنافية القديمة. بحلول القرن السادس عشر ، أصبحت تعني العلامة التي أحرقها أصحاب المزارع على الماشية للدلالة على الملكية. ومع ذلك ، فإن العلامة التجارية اليوم هي أكثر من مجرد مظهر أو شعار. لقد حان للدلالة على رد فعل \"الشعور الغريزي\" العاطفي الذي يمكن أن تثيره الشركة من عملائها', '2021-03-14 00:37:06', '2021-04-11 21:48:17'),
(16, 3, 1, 13, 214, 'قم ببناء موقع الويب الخاص بك باستخدام Venor CMS', 'top-6-articles-you-must-read-today-niva', '<p>يشمل تصميم الويب العديد من المهارات والتخصصات المختلفة في إنتاج وصيانة المواقع الإلكترونية. تشمل المجالات المختلفة لتصميم الويب تصميم رسومات الويب ؛ تصميم واجهة؛ التأليف ، بما في ذلك التعليمات البرمجية الموحدة.</p>\r\n<p>كانت العلامة التجارية موجودة منذ 350 م وهي مشتقة من كلمة \"براندر\" ، والتي تعني \"حرق\" في اللغة الإسكندنافية القديمة. بحلول القرن السادس عشر ، أصبحت تعني العلامة التي أحرقها أصحاب المزارع على الماشية للدلالة على الملكية. ومع ذلك ، فإن العلامة التجارية اليوم هي أكثر من مجرد مظهر أو شعار. لقد حان للدلالة على الشعور العاطفي \"الغريزي\". رد الفعل الذي يمكن أن تثيره الشركة من عملائها</p>\r\n<p><img class=\"img-fluid\" src=\"/public/images/media/1615661162project4.jpg\" alt=\"1615661162project4.jpg\" /></p>\r\n<p>يشمل تصميم الويب العديد من المهارات والتخصصات المختلفة في إنتاج وصيانة المواقع الإلكترونية. تشمل المجالات المختلفة لتصميم الويب تصميم رسومات الويب ؛ تصميم واجهة؛ التأليف ، بما في ذلك التعليمات البرمجية الموحدة.</p>\r\n<blockquote>\r\n<p>يستخدم مصطلح تصميم الويب عادةً لوصف عملية التصميم المتعلقة بتصميم الواجهة الأمامية (جانب العميل) لموقع الويب بما في ذلك كتابة العلامات. يتداخل تصميم الويب جزئيًا مع هندسة الويب.</p>\r\n<footer class=\"blockquote-footer\">Michael Smith</footer></blockquote>\r\n<p>كانت العلامة التجارية موجودة منذ 350 م وهي مشتقة من كلمة \"براندر\" ، والتي تعني \"حرق\" في اللغة الإسكندنافية القديمة. بحلول القرن السادس عشر ، أصبحت تعني العلامة التي أحرقها أصحاب المزارع على الماشية للدلالة على الملكية. ومع ذلك ، فإن العلامة التجارية اليوم هي أكثر من مجرد مظهر أو شعار. لقد حان للدلالة على الشعور العاطفي \"الغريزي\". رد الفعل الذي يمكن أن تثيره الشركة من عملائها</p>\r\n<p><a title=\"adsense\" href=\"https://www.google.com/adsense/start/\" target=\"_blank\" rel=\"noreferrer noopener\"><img class=\"img-fluid img-ad\" src=\"/public/images/media/1615722163adplace-blog.jpg\" alt=\"1615722163adplace-blog.jpg\" /></a></p>', 'قم ببناء موقع الويب الخاص بك باستخدام Venor CMS', 'كانت العلامة التجارية موجودة منذ 350 م وهي مشتقة من كلمة \"براندر\" ، والتي تعني \"تحترق\" في اللغة الإسكندنافية القديمة. بحلول القرن السادس عشر ، أصبحت تعني العلامة التي أحرقها أصحاب المزارع على الماشية للدلالة على الملكية. ومع ذلك ، فإن العلامة التجارية اليوم هي أكثر من مجرد مظهر أو شعار. لقد حان للدلالة على رد فعل \"الشعور الغريزي\" العاطفي الذي يمكن أن تثيره الشركة من عملائها', '2021-03-14 00:35:52', '2021-04-11 21:48:21'),
(15, 2, 1, 10, 215, 'শীর্ষ 7 সৃজনশীল উপায় আপনার মিডিয়া বুস্ট', '7-সৃজনশীল-উপায়-বুস্ট-আপনার-সোশ্যাল-মিডিয়া', '<p>ওয়েব ডিজাইন ওয়েবসাইটের উৎপাদন এবং রক্ষণাবেক্ষণে বিভিন্ন দক্ষতা এবং শৃঙ্খলাকে অন্তর্ভুক্ত করে। ওয়েব ডিজাইনের বিভিন্ন ক্ষেত্রের মধ্যে রয়েছে ওয়েব গ্রাফিক ডিজাইন; ইন্টারফেস নকশা; প্রমিত কোড সহ অনুমোদন।</p>\r\n<p>ব্র্যান্ডিং প্রায় 350 খ্রিস্টাব্দ থেকে হয়ে আসছে এবং এটি \"Brandr\" শব্দ থেকে উদ্ভূত হয়েছে, যার অর্থ প্রাচীন নর্স ভাষায় \"বার্ন করা\"। 1500-এর দশকের মধ্যে, এর অর্থ হল সেই চিহ্ন যা পশুপালকরা মালিকানা বোঝাতে গবাদি পশু পোড়ায়। তবুও ব্র্যান্ডিং আজ শুধু একটি চেহারা বা একটি লোগোর চেয়ে বেশি। এটি একটি সংবেদনশীল \"অন্ত্রের অনুভূতি\" প্রতিক্রিয়া বোঝাতে এসেছে যা একটি কোম্পানি তার গ্রাহকদের কাছ থেকে প্রকাশ করতে পারে</p>\r\n<p><img class=\"img-fluid\" src=\"/public/images/media/1615661162project4.jpg\" alt=\"1615661162project4.jpg\" /></p>\r\n<p>ওয়েব ডিজাইন ওয়েবসাইটের উৎপাদন এবং রক্ষণাবেক্ষণে বিভিন্ন দক্ষতা এবং শৃঙ্খলাকে অন্তর্ভুক্ত করে। ওয়েব ডিজাইনের বিভিন্ন ক্ষেত্রের মধ্যে রয়েছে ওয়েব গ্রাফিক ডিজাইন; ইন্টারফেস নকশা; প্রমিত কোড সহ অনুমোদন।</p>\r\n<p>ওয়েব ডিজাইন শব্দটি সাধারণত লেখার মার্ক আপ সহ একটি ওয়েবসাইটের ফ্রন্ট-এন্ড (ক্লায়েন্ট সাইড) ডিজাইনের সাথে সম্পর্কিত ডিজাইন প্রক্রিয়া বর্ণনা করতে ব্যবহৃত হয়। ওয়েব ডিজাইন আংশিকভাবে ওয়েব ইঞ্জিনিয়ারিংকে ওভারল্যাপ করে।</p>\r\n<p>মাইকেল স্মিথ</p>\r\n<p>ব্র্যান্ডিং প্রায় 350 খ্রিস্টাব্দ থেকে হয়ে আসছে এবং এটি \"Brandr\" শব্দ থেকে উদ্ভূত হয়েছে, যার অর্থ প্রাচীন নর্স ভাষায় \"বার্ন করা\"। 1500-এর দশকের মধ্যে, এর অর্থ হল সেই চিহ্ন যা পশুপালকরা মালিকানা বোঝাতে গবাদি পশু পোড়ায়। তবুও ব্র্যান্ডিং আজ শুধু একটি চেহারা বা একটি লোগোর চেয়ে বেশি। এটি একটি সংবেদনশীল \"অন্ত্রের অনুভূতি\" প্রতিক্রিয়া বোঝাতে এসেছে যা একটি কোম্পানি তার গ্রাহকদের কাছ থেকে প্রকাশ করতে পারে</p>\r\n<p><a title=\"adsense\" href=\"https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d\" target=\"_blank\" rel=\"noopener\"><img class=\"img-fluid img-ad\" src=\"/public/images/media/1615722163adplace-blog.jpg\" alt=\"1615722163adplace-blog.jpg\" /></a></p>', 'শীর্ষ 7 সৃজনশীল উপায় আপনার মিডিয়া বুস্ট', 'ব্র্যান্ডিং প্রায় 350 খ্রিস্টাব্দ থেকে হয়ে আসছে এবং এটি \"Brandr\" শব্দ থেকে উদ্ভূত হয়েছে, যার অর্থ প্রাচীন নর্স ভাষায় \"বার্ন করা\"। 1500-এর দশকের মধ্যে, এর অর্থ হল সেই চিহ্ন যা পশুপালকরা মালিকানা বোঝাতে গবাদি পশু পোড়ায়। তবুও ব্র্যান্ডিং আজ শুধু একটি চেহারা বা একটি লোগোর চেয়ে বেশি। এটি একটি সংবেদনশীল \"অন্ত্রের অনুভূতি\" প্রতিক্রিয়া বোঝাতে এসেছে যা একটি কোম্পানি তার গ্রাহকদের কাছ থেকে প্রকাশ করতে পারে', '2021-03-14 00:38:58', '2023-10-15 08:19:52'),
(14, 2, 1, 8, 213, 'টেক ডিজাইনার জন ডো এর সর্বশেষ ডিজাইন', 'tech-designer-john-does-latest-creation', '<p>O design da Web abrange muitas habilidades e disciplinas diferentes na produ&ccedil;&atilde;o e manuten&ccedil;&atilde;o de websites. As diferentes &aacute;reas de web design incluem web design gr&aacute;fico; design de interface; autoria, incluindo c&oacute;digo padronizado.</p>\r\n<p>Branding existe desde 350 d.C. e &eacute; derivado da palavra Brandr, que significa queimar na l&iacute;ngua n&oacute;rdica antiga. Por volta de 1500, passou a significar a marca que os fazendeiros queimavam no gado para significar propriedade. Ainda assim, a marca hoje &eacute; mais do que apenas um visual ou um logotipo. Passou a significar a rea&ccedil;&atilde;o de sentimento emocional que uma empresa pode obter de seus clientes</p>\r\n<p><img class=\"img-fluid\" src=\"/public/images/media/1615661162project4.jpg\" alt=\"1615661162project4.jpg\" /></p>\r\n<p>O design da Web abrange muitas habilidades e disciplinas diferentes na produ&ccedil;&atilde;o e manuten&ccedil;&atilde;o de websites. As diferentes &aacute;reas de web design incluem web design gr&aacute;fico; design de interface; autoria, incluindo c&oacute;digo padronizado.</p>\r\n<blockquote>\r\n<p>O termo web design &eacute; normalmente usado para descrever o processo de design relacionado ao design do front-end (lado do cliente) de um site, incluindo a marca&ccedil;&atilde;o de escrita. O design da web se sobrep&otilde;e parcialmente &agrave; engenharia da web.</p>\r\n<footer class=\"blockquote-footer\">Michael Smith</footer></blockquote>\r\n<p>Branding existe desde 350 d.C. e &eacute; derivado da palavra Brandr, que significa queimar na l&iacute;ngua n&oacute;rdica antiga. Por volta de 1500, passou a significar a marca que os fazendeiros queimavam no gado para significar propriedade. Ainda assim, a marca hoje &eacute; mais do que apenas um visual ou um logotipo. Passou a significar a rea&ccedil;&atilde;o de sentimento emocional que uma empresa pode obter de seus clientes</p>\r\n<p><a title=\"adsense\" href=\"https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d\" target=\"_blank\" rel=\"noopener\"><img class=\"img-fluid img-ad\" src=\"/public/images/media/1615722163adplace-blog.jpg\" alt=\"1615722163adplace-blog.jpg\" /></a></p>', 'Tech designer John Doe\'s latest design', 'Branding existe desde 350 d.C. e é derivado da palavra “Brandr”, que significa “queimar” na língua nórdica antiga. Por volta de 1500, passou a significar a marca que os fazendeiros queimavam no gado para significar propriedade. Ainda assim, a marca hoje é mais do que apenas um visual ou um logotipo. Passou a significar a reação emocional de \"intuição\" que uma empresa pode provocar em seus clientes', '2021-03-14 00:37:06', '2023-10-15 08:20:59'),
(3, 1, 1, 3, 215, 'Top 7 Creative Ways to Boost Your Media', '7-creative-ways-to-boost-your-social-media', '<p>Web design encompasses many different skills and disciplines in the production and maintenance of websites. The different areas of web design include web graphic design; interface design; authoring, including standardised code.</p>\r\n<p>Branding has been around since 350 A.D and is derived from the word &ldquo;Brandr&rdquo;, meaning &ldquo;to burn&rdquo; in Ancient Norse language. By the 1500s, it had come to mean the mark that ranchers burned on cattle to signify ownership. Yet branding today is more than just a look or a logo. It has come to signify the emotional &ldquo;gut feeling&rdquo; reaction a company can elicit from its customers</p>\r\n<p><a href=\"https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d\"><img class=\"img-fluid\" src=\"/public/images/media/1615661162project4.jpg\" alt=\"1615661162project4.jpg\" /></a></p>\r\n<p>Web design encompasses many different skills and disciplines in the production and maintenance of websites. The different areas of web design include web graphic design; interface design; authoring, including standardised code.</p>\r\n<blockquote>\r\n<p>The term web design is normally used to describe the design process relating to the front-end (client side) design of a website including writing mark up. Web design partially overlaps web engineering.</p>\r\n<footer class=\"blockquote-footer\">Michael Smith</footer></blockquote>\r\n<p>Branding has been around since 350 A.D and is derived from the word &ldquo;Brandr&rdquo;, meaning &ldquo;to burn&rdquo; in Ancient Norse language. By the 1500s, it had come to mean the mark that ranchers burned on cattle to signify ownership. Yet branding today is more than just a look or a logo. It has come to signify the emotional &ldquo;gut feeling&rdquo; reaction a company can elicit from its customers</p>\r\n<p><a title=\"adsense\" href=\"https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d\" target=\"_blank\" rel=\"noopener\"><img class=\"img-fluid img-ad\" src=\"/public/images/media/1615722163adplace-blog.jpg\" alt=\"1615722163adplace-blog.jpg\" /></a></p>', 'Top 7 Creative Ways to Boost Your Media', 'Branding has been around since 350 A.D and is derived from the word “Brandr”, meaning “to burn” in Ancient Norse language. By the 1500s, it had come to mean the mark that ranchers burned on cattle to signify ownership. Yet branding today is more than just a look or a logo. It has come to signify the emotional “gut feeling” reaction a company can elicit from its customers', '2021-03-14 00:38:58', '2023-10-15 08:42:36'),
(13, 2, 1, 10, 214, 'CMS দিয়ে আপনার ওয়েবসাইট তৈরি করুন', 'top-6-articles-you-must-read-today-niva', '<p>O design da Web abrange muitas habilidades e disciplinas diferentes na produ&ccedil;&atilde;o e manuten&ccedil;&atilde;o de websites. As diferentes &aacute;reas de web design incluem web design gr&aacute;fico; design de interface; autoria, incluindo c&oacute;digo padronizado.</p>\r\n<p>Branding existe desde 350 d.C. e &eacute; derivado da palavra Brandr, que significa queimar na l&iacute;ngua n&oacute;rdica antiga. Por volta de 1500, passou a significar a marca que os fazendeiros queimavam no gado para significar propriedade. Ainda assim, a marca hoje &eacute; mais do que apenas um visual ou um logotipo. Passou a significar a rea&ccedil;&atilde;o de sentimento emocional que uma empresa pode obter de seus clientes</p>\r\n<p><img class=\"img-fluid\" src=\"/public/images/media/1615661162project4.jpg\" alt=\"1615661162project4.jpg\" /></p>\r\n<p>O design da Web abrange muitas habilidades e disciplinas diferentes na produ&ccedil;&atilde;o e manuten&ccedil;&atilde;o de websites. As diferentes &aacute;reas de web design incluem web design gr&aacute;fico; design de interface; autoria, incluindo c&oacute;digo padronizado.</p>\r\n<blockquote>\r\n<p>O termo web design &eacute; normalmente usado para descrever o processo de design relacionado ao design do front-end (lado do cliente) de um site, incluindo a marca&ccedil;&atilde;o de escrita. O design da web se sobrep&otilde;e parcialmente &agrave; engenharia da web.</p>\r\n<footer class=\"blockquote-footer\">Michael Smith</footer></blockquote>\r\n<p>Branding existe desde 350 d.C. e &eacute; derivado da palavra Brandr, que significa queimar na l&iacute;ngua n&oacute;rdica antiga. Por volta de 1500, passou a significar a marca que os fazendeiros queimavam no gado para significar propriedade. Ainda assim, a marca hoje &eacute; mais do que apenas um visual ou um logotipo. Passou a significar a rea&ccedil;&atilde;o de sentimento emocional que uma empresa pode obter de seus clientes</p>\r\n<p><a title=\"adsense\" href=\"https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d\" target=\"_blank\" rel=\"noopener\"><img class=\"img-fluid img-ad\" src=\"/public/images/media/1615722163adplace-blog.jpg\" alt=\"1615722163adplace-blog.jpg\" /></a></p>', 'Build your website with CMS', 'Branding existe desde 350 d.C. e é derivado da palavra “Brandr”, que significa “queimar” na língua nórdica antiga. Por volta de 1500, passou a significar a marca que os fazendeiros queimavam no gado para significar propriedade. Ainda assim, a marca hoje é mais do que apenas um visual ou um logotipo. Passou a significar a reação emocional de \"intuição\" que uma empresa pode provocar em seus clientes', '2021-03-14 00:35:52', '2023-10-15 08:22:00'),
(1, 1, 1, 1, 214, 'Buld your website with Venor CMS', 'top-6-articles-you-must-read-today-niva', '<p>Web design encompasses many different skills and disciplines in the production and maintenance of websites. The different areas of web design include web graphic design; interface design; authoring, including standardised code.</p>\r\n<p>Branding has been around since 350 A.D and is derived from the word &ldquo;Brandr&rdquo;, meaning &ldquo;to burn&rdquo; in Ancient Norse language. By the 1500s, it had come to mean the mark that ranchers burned on cattle to signify ownership. Yet branding today is more than just a look or a logo. It has come to signify the emotional &ldquo;gut feeling&rdquo; reaction a company can elicit from its customers</p>\r\n<p><img class=\"img-fluid\" src=\"/public/images/media/1615661162project4.jpg\" alt=\"1615661162project4.jpg\" /></p>\r\n<p>Web design encompasses many different skills and disciplines in the production and maintenance of websites. The different areas of web design include web graphic design; interface design; authoring, including standardised code.</p>\r\n<blockquote>\r\n<p>The term web design is normally used to describe the design process relating to the front-end (client side) design of a website including writing mark up. Web design partially overlaps web engineering.</p>\r\n<footer class=\"blockquote-footer\">Michael Smith</footer></blockquote>\r\n<p>Branding has been around since 350 A.D and is derived from the word &ldquo;Brandr&rdquo;, meaning &ldquo;to burn&rdquo; in Ancient Norse language. By the 1500s, it had come to mean the mark that ranchers burned on cattle to signify ownership. Yet branding today is more than just a look or a logo. It has come to signify the emotional &ldquo;gut feeling&rdquo; reaction a company can elicit from its customers</p>\r\n<p><a title=\"adsense\" href=\"https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d\" target=\"_blank\" rel=\"noopener\"><img class=\"img-fluid img-ad\" src=\"/public/images/media/1615722163adplace-blog.jpg\" alt=\"1615722163adplace-blog.jpg\" /></a></p>', 'Buld your website with Venor CMS', 'Branding has been around since 350 A.D and is derived from the word “Brandr”, meaning “to burn” in Ancient Norse language. By the 1500s, it had come to mean the mark that ranchers burned on cattle to signify ownership. Yet branding today is more than just a look or a logo. It has come to signify the emotional “gut feeling” reaction a company can elicit from its customers', '2021-03-14 00:35:52', '2023-10-15 08:18:32'),
(2, 1, 1, 2, 213, 'Tech designer John Doe\'s latest design', 'tech-designer-john-does-latest-creation', '<p>Web design encompasses many different skills and disciplines in the production and maintenance of websites. The different areas of web design include web graphic design; interface design; authoring, including standardised code.</p>\r\n<p>Branding has been around since 350 A.D and is derived from the word &ldquo;Brandr&rdquo;, meaning &ldquo;to burn&rdquo; in Ancient Norse language. By the 1500s, it had come to mean the mark that ranchers burned on cattle to signify ownership. Yet branding today is more than just a look or a logo. It has come to signify the emotional &ldquo;gut feeling&rdquo; reaction a company can elicit from its customers</p>\r\n<p><img class=\"img-fluid\" src=\"/public/images/media/1615661162project4.jpg\" alt=\"1615661162project4.jpg\" /></p>\r\n<p>Web design encompasses many different skills and disciplines in the production and maintenance of websites. The different areas of web design include web graphic design; interface design; authoring, including standardised code.</p>\r\n<blockquote>\r\n<p>The term web design is normally used to describe the design process relating to the front-end (client side) design of a website including writing mark up. Web design partially overlaps web engineering.</p>\r\n<footer class=\"blockquote-footer\">Michael Smith</footer></blockquote>\r\n<p>Branding has been around since 350 A.D and is derived from the word &ldquo;Brandr&rdquo;, meaning &ldquo;to burn&rdquo; in Ancient Norse language. By the 1500s, it had come to mean the mark that ranchers burned on cattle to signify ownership. Yet branding today is more than just a look or a logo. It has come to signify the emotional &ldquo;gut feeling&rdquo; reaction a company can elicit from its customers</p>\r\n<p><a title=\"adsense\" href=\"https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d\" target=\"_blank\" rel=\"noopener\"><img class=\"img-fluid img-ad\" src=\"/public/images/media/1615722163adplace-blog.jpg\" alt=\"1615722163adplace-blog.jpg\" /></a></p>', 'Tech designer John Doe\'s latest design', 'Branding has been around since 350 A.D and is derived from the word “Brandr”, meaning “to burn” in Ancient Norse language. By the 1500s, it had come to mean the mark that ranchers burned on cattle to signify ownership. Yet branding today is more than just a look or a logo. It has come to signify the emotional “gut feeling” reaction a company can elicit from its customers', '2021-03-14 00:37:06', '2023-10-15 08:17:28'),
(20, 2, 1, 9, 250, 'বনলতা এক্সপ্রেস', 'বনলত-একসপরস', '<p>বনলতা এক্সপ্রেস&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><video controls=\"controls\" width=\"340\" height=\"250\">\r\n<source src=\"https://www.httsys.com/storage/files/1/my_first_cartoon_make.mp4\" type=\"video/mp4\" /></video></p>\r\n<p>বনলতা এক্সপ্রেস (ট্রেন নং-৭৯১/৭৯২) বাংলাদেশ রেলওয়ে পরিচালিত দেশের দুই গুরুত্বপূর্ণ মহানগরী (রাজশাহী - ঢাকা) ও (ঢাকা - রাজশাহী) রুটে চলাচলকারী বিরতিহীন (NONSTOP) আন্তঃনগর ট্রেন। পরে ট্রেনটির রুট চাঁপাইনবাবগঞ্জ পর্যন্ত বর্ধিত করা হয়। রাজশাহী বেজের প্রধান VIP ট্রেন। এটি ব্রডগেজের প্রথম বিরতিহীন (NONSTOP) এবং সর্বোচ্চ (LUXURIOUS) ট্রেন। ট্রেনটিতে STARLINK এর হাইস্পীড Wi-Fi কানেকশনের ব্যবস্থা আছে।</p>\r\n<p>ইতিহাস<br />২০১৯ সালের ২৫ এপ্রিল বৃহস্পতিবার বেলা ১১টার দিকে সবুজ পতাকা নেড়ে ও বাঁশি বাজিয়ে ভিডিও কনফারেন্সের মাধ্যমে রাজশাহী-ঢাকা রুটে বিরতিহীন আন্তঃনগর এক্সপ্রেস বনলতার উদ্বোধন করেন তৎকালীন প্রধানমন্ত্রী শেখ হাসিনা। তখন রাজশাহী থেকে ভিডিও কনফারেন্সে উদ্বোধনী অনুষ্ঠানে যোগ দেন তৎকালীন রেলমন্ত্রী নুরুল ইসলাম সুজন ও রাজশাহী সিটি কর্পোরেশনের তৎকালীন মেয়র এ এইচ এম খায়রুজ্জামান লিটন। তবে কিছুদিন চলার পর ১৭ই জুলাই ২০১৯ তারিখে ট্রেনটির রুট চাঁপাইনবাবগঞ্জ পর্যন্ত বর্ধিত করা হয়। এর কিছু দিন পর ২০২০ সালের জানুয়ারির প্রথম দিকে এর ট্রেনটির অত্যাধুনিক প্রযুক্তির পিটি ইনকার রেকটি চিলাহাটী ঢাকা রুটের আন্তনগর নীলসাগর এক্সপ্রেস ট্রেনটিকে দিয়ে ভারত থেকে আমদানিকৃত অত্যাধুনিক বিলাসবহুল এলএইচবি রেক বনলতা এক্সপ্রেস ট্রেনে যুক্ত করা হয়।[২]</p>\r\n<p>নামকরণ<br />ততকালীন প্রধানমন্ত্রী শেখ হাসিনা কবি জীবনানন্দ দাশ এর বিখ্যাত কবিতা এর চরিত্র বনলতা সেন থেকে এর নামকরণ করছেন। যেহেতু বনলতা সেন নাটোরের তাই অঞ্চল বিবেচনায় এর নাম বনলতা এক্সপ্রেস হয়।</p>\r\n<p>রোলিং স্টক</p>', 'বনলতা এক্সপ্রেস', 'বনলতা এক্সপ্রেস', '2026-07-28 17:54:38', '2026-08-24 21:21:00'),
(21, 2, 16, 15, 260, '\"প্রাপককে পাওয়া যায়নি।\"', 'পরপকক-পওয-যযন', '<p>আমি পঁচিশ বছর ধরে কুরিয়ার সার্ভিসে কাজ করি। চিঠি, পার্সেল, কাগজপত্র, নোটিশ, সব পৌঁছে দিই। আগে চিঠি বেশি আসতো। এখন আসে ব্যাংকের কাগজ, চাকরির কাগজ, আদালতের নোটিশ, অনলাইন অর্ডারের বাক্স।</p>\r\n<p>&nbsp;</p>\r\n<p>আমার নাম কামাল। ধানমন্ডি, মোহাম্মদপুর, কলাবাগান, হাজারীবাগ, এই এলাকাগুলোতে আমার রুট। প্রতিদিন একটা ব্যাগ কাঁধে নিয়ে ঘুরি। বৃষ্টি হলে ভিজি। রোদ হলে পুড়ি। শীত হলে কাঁপি। কাজটা ভালো লাগে না। তবু ছাড়িনি।</p>\r\n<p>&nbsp;</p>\r\n<p>আমাদের অফিসে একটা নিয়ম আছে। ঠিকানা ভুল হলে তিনবার চেষ্টা করতে হয়। তারপর লেখা হয়-</p>\r\n<p>&nbsp;</p>\r\n<p>\"প্রাপককে পাওয়া যায়নি।\"</p>\r\n<p>&nbsp;</p>\r\n<p>এই তিনটা শব্দ আমি জীবনে অসংখ্যবার লিখেছি। কিন্তু একদিন একটা খামের উপর এই তিনটা শব্দ লিখতে গিয়ে আমার হাত থেমে গিয়েছিল। খামের উপর লেখা ছিল-</p>\r\n<p>&nbsp;</p>\r\n<p>প্রেরক: আবদুল হালিম</p>\r\n<p>প্রাপক: রাশেদ হালিম</p>\r\n<p>বাড়ি: ১৭/বি, লালমাটিয়া, ঢাকা।</p>\r\n<p>নিচে ছোট করে লেখা-</p>\r\n<p>জরুরি। ব্যক্তিগত।</p>\r\n<p>&nbsp;</p>\r\n<p>অর্থাৎ, আবদুল হালিম নামে এক বয়স্ক বাবা তাঁর ছেলে রাশেদ হালিমের কাছে চিঠি পাঠিয়েছেন। কিন্তু মজার বিষয় হলো, প্রেরক ও প্রাপক দুজনেরই ঠিকানা একই দেয়া-</p>\r\n<p>১৭/বি, লালমাটিয়া, ঢাকা। মানে বাবা তাঁর নিজের বাড়ির ঠিকানাতেই ছেলের নামে চিঠি পোস্ট করেছেন!</p>\r\n<p>&nbsp;</p>\r\n<p>আমি ঠিকানায় গিয়ে দেখি, ১৭/বি বলে কোনো বাড়িই নেই।&nbsp;</p>\r\n<p>১৭ আছে।&nbsp;</p>\r\n<p>১৭/এ আছে।&nbsp;</p>\r\n<p>১৭/সি আছে।&nbsp;</p>\r\n<p>কিন্তু ১৭/বি নেই।&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>পাশের দোকানের লোককে জিজ্ঞেস করলাম। লোকটা বললো, \"আগে ছিল।\"</p>\r\n<p>\"এখন?\"</p>\r\n<p>\"ভেঙে ফ্ল্যাট হইছে।\"</p>\r\n<p>\"হালিম সাহেব?\"</p>\r\n<p>লোকটা কাঁধ ঝাঁকালো, \"চিনি না।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি পাশের চায়ের দোকানে গেলাম। চা-ওয়ালা বললো, \"আবদুল হালিম নামে একজন ছিল।\"</p>\r\n<p>\"কোথায় গেছে?\"</p>\r\n<p>\"মারা গেছে।\"</p>\r\n<p>\"কবে?\"</p>\r\n<p>\"অনেক বছর।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি অফিসে ফিরে খামটা \"প্রাপককে পাওয়া যায়নি\" লিখে জমা দিতে পারতাম। দিইনি। পরদিন আবার গেলাম। ১৭ নম্বর বাড়ির পুরোনো দারোয়ানকে পেলাম। বয়স অনেক। নাম গফুর। আমি খামের নামটা বলতেই লোকটা আমার দিকে তাকিয়ে বললো,</p>\r\n<p>&nbsp;</p>\r\n<p>\"আপনি আবদুল হালিম সাহেবের ছেলের লোক?\"</p>\r\n<p>\"না। কুরিয়ার।\'\'</p>\r\n<p>লোকটা বললো, \"আবদুল হালিম সাহেব তো নাই।\"</p>\r\n<p>আমি জিজ্ঞেস করলাম, \"তার ছেলে কোথায়?\"</p>\r\n<p>\"বিদেশে।\"</p>\r\n<p>\"কোন দেশে?\"</p>\r\n<p>\"কানাডা।\"</p>\r\n<p>\"যোগাযোগ নেই?\"</p>\r\n<p>\"না।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি জিজ্ঞেস করলাম, \"কেন?\"</p>\r\n<p>লোকটা বললো, \"বাপ ছেলের ঝামেলা।\"</p>\r\n<p>&nbsp;</p>\r\n<p>এই কথাটা বাংলাদেশের মানুষের খুব প্রিয়। সবকিছুর ব্যাখ্যা এক কথায় হয়ে যায়, \"ঝামেলা ছিল।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি বললাম, \"কী ঝামেলা?\"</p>\r\n<p>লোকটা বললো, \"সেইটা আমি জানি না।\"</p>\r\n<p>তারপর একটু থেমে বললো, \"তবে শেষের দিকে আবদুল হালিম সাহেব প্রতিদিন বিকেলে গেটের সামনে বসে থাকতেন।\"</p>\r\n<p>\"কেন?\"</p>\r\n<p>\"ছেলের জন্য।\"</p>\r\n<p>\"ছেলে আসতো?\"</p>\r\n<p>\"না।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি চুপ করে গেলাম।</p>\r\n<p>&nbsp;</p>\r\n<p>কানাডায় ছেলেটার নাম ছিল রাশেদ হালিম। ফেসবুকে খুঁজলাম। পেলাম না। লিংকডইনে পেলাম একজনকে। নাম মিলে যায়। ঢাকায় জন্ম। কানাডায় সফটওয়্যার ইঞ্জিনিয়ার। বয়সও মিলে। আমি তার প্রোফাইলের ছবি দেখলাম। একজন হাসিখুশি মানুষ। বউ। দুইটা বাচ্চা। বরফের মধ্যে দাঁড়িয়ে ছবি। ক্যাপশনে লেখা-</p>\r\n<p>&nbsp;</p>\r\n<p>\"Home is where your people are.\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি অনেকক্ষণ ঐ কথাটার দিকে তাকিয়ে ছিলাম। হোম ইজ হোয়্যার ইয়োর পিপল আর। মানুষ কত সহজে ইংরেজিতে এমন কথা লিখে ফেলে। নিজের ভাষায় বলতে গেলে বুক কাঁপে।</p>\r\n<p>&nbsp;</p>\r\n<p>আমি তাকে মেসেজ পাঠালাম, \"আপনার নামে একটা চিঠি এসেছে।\"</p>\r\n<p>&nbsp;</p>\r\n<p>কোনো উত্তর নেই।</p>\r\n<p>&nbsp;</p>\r\n<p>দুই দিন পর উত্তর এলো, \"Who are you?\"</p>\r\n<p>আমি বললাম, \"আমি কুরিয়ার সার্ভিসে কাজ করি। আপনার বাবা একটা চিঠি পোস্ট করেছে।\"</p>\r\n<p>সে লিখলো, \"My father died years ago.\"</p>\r\n<p>আমি বললাম, \"চিঠিটা আপনার জন্যই।\"</p>\r\n<p>&nbsp;</p>\r\n<p>অনেকক্ষণ কোনো উত্তর নেই।</p>\r\n<p>তারপর লিখলো, \"Don\'t contact me again.\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি চুপ করে গেলাম। চিঠিটা আমার ড্রয়ারে রয়ে গেল।</p>\r\n<p>তারপর এক সপ্তাহ। দুই সপ্তাহ। এক মাস। আমি চিঠিটা অফিসে জমা দিইনি।&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>একদিন সন্ধ্যায় রাশেদের কাছ থেকে মেসেজ এলো, \"What does the letter say?\"</p>\r\n<p>আমি বললাম, \"আমি খুলি নাই।\"</p>\r\n<p>সে আবার লিখলো, \"Can you send me a picture?\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি খামের ছবি পাঠালাম।</p>\r\n<p>সে অনেকক্ষণ কোনো উত্তর দিলো না।</p>\r\n<p>&nbsp;</p>\r\n<p>তারপর লিখলো, \"That\'s my father\'s handwriting.\"</p>\r\n<p>আমি বললাম, \"আপনি চিঠিটা চান?\"</p>\r\n<p>অনেকক্ষণ পর উত্তর এলো, \"Yes.\"</p>\r\n<p>আমি বললাম, \"ঠিকানা দেন।\"</p>\r\n<p>&nbsp;</p>\r\n<p>সে ঠিকানা দিল। সেদিনই আমি চিঠিটা পাঠিয়ে দিলাম। কাজ শেষ। ভাবলাম, এবার আমার দায়িত্ব শেষ। তিন দিন পর একটা ফোন এলো। বিদেশি নম্বর। আমি ধরলাম। ওপাশ থেকে একটা পুরুষের গলা।</p>\r\n<p>&nbsp;</p>\r\n<p>\"আপনি কামাল?\"</p>\r\n<p>\"জি।\"</p>\r\n<p>\"আমি রাশেদ।\"</p>\r\n<p>\"জি।\"</p>\r\n<p>\"চিঠিটা পেয়েছি।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি চুপ করে থাকলাম।</p>\r\n<p>&nbsp;</p>\r\n<p>সে বললো, \"আপনি কি জানেন, আমার বাবা মারা যাওয়ার আগে শেষবার আমাকে কী বলেছিলেন?\"</p>\r\n<p>\"না।\"</p>\r\n<p>\"বলেছিলেন, তুই যদি কোনোদিন ফিরে আসিস, আমার কাছে আসিস না।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি কিছু বললাম না।</p>\r\n<p>&nbsp;</p>\r\n<p>সে বললো, \"আমি আর ফিরিনি।\"</p>\r\n<p>&nbsp;</p>\r\n<p>তারপর দীর্ঘ নীরবতা।</p>\r\n<p>&nbsp;</p>\r\n<p>\"চিঠিতে কী ছিল জানেন?\"</p>\r\n<p>\"না।\"</p>\r\n<p>&nbsp;</p>\r\n<p>সে হাসলো।</p>\r\n<p>&nbsp;</p>\r\n<p>তারপর বললো, \"আমার বাবা কখনো কাউকে চিঠি লিখতেন না।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি অবাক হলাম।</p>\r\n<p>&nbsp;</p>\r\n<p>বললাম, \"কিন্তু এটা তো আপনার বাবার হাতের লেখা।\"</p>\r\n<p>\"হ্যাঁ।\"</p>\r\n<p>\"তাহলে?\"</p>\r\n<p>\"তিনি লিখেছিলেন। কিন্তু পাঠাননি।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি বুঝলাম না।</p>\r\n<p>&nbsp;</p>\r\n<p>রাশেদ বললো, \"চিঠিটা তিনি নিজের আলমারিতে রেখে গিয়েছিলেন।\"</p>\r\n<p>\"কীভাবে পোস্ট হলো?\"</p>\r\n<p>\"তার বাড়ি বিক্রি করার পর নতুন মালিক পুরোনো আলমারির কাগজপত্রের মধ্যে খামটা পেয়েছিলেন। হয়তো ভেবেছেন পোস্ট করা হয়নি, তাই দয়ায় পড়ে ডাকবাক্সে ফেলে দিয়েছেন।\"</p>\r\n<p>আমি বললাম, \"চিঠিতে কী ছিল?\"</p>\r\n<p>রাশেদ কিছুক্ষণ চুপ করে থেকে বললো, \"একটা মাত্র বাক্য।\"</p>\r\n<p>\"কী?\"</p>\r\n<p>&nbsp;</p>\r\n<p>\"আমি ভুল করেছিলাম।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি বললাম, \"এইটুকু?\"</p>\r\n<p>\"হ্যাঁ।\"</p>\r\n<p>\"আর কিছু?\"</p>\r\n<p>\"না।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি বললাম, \"তাহলে আপনি কাঁদছেন কেন?\"</p>\r\n<p>রাশেদ কান্না থামিয়ে বললো, \"আমি ভেবেছিলাম, বাবারা কখনো ভুল করে না।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি জানি না কেন, কথাটা শুনে আমার নিজের বাবার কথা মনে পড়লো। আমার বাবা ছিলেন রাগী মানুষ। আমি ছোটবেলায় একবার স্কুল থেকে পালিয়ে সিনেমা দেখতে গিয়েছিলাম। বাবা জানতে পেরে আমাকে এমন মেরেছিলেন যে তিনদিন স্কুলে যেতে পারিনি। তারপর আমি ঠিক করেছিলাম, কোনোদিন বাবার সঙ্গে কথা বলবো না।</p>\r\n<p>&nbsp;</p>\r\n<p>দুদিন পরই বাবা মারা গেলেন। আমার রাগটা রয়ে গেল। বাবা রইলেন না। মানুষের রাগেরও একটা সমস্যা আছে। যার ওপর রাগ করা হয়, সে না থাকলেও রাগটা থেকে যায়। তারপর একদিন সেই রাগের কোনো ঠিকানা থাকে না।</p>\r\n<p>&nbsp;</p>\r\n<p>রাশেদ বলল, \"কামাল ভাই?\"</p>\r\n<p>\"জি?\'\'</p>\r\n<p>\"আপনি কি একটা কাজ করবেন?\"</p>\r\n<p>\"কী?\"</p>\r\n<p>\"আমার বাবার কবরটা খুঁজে দিতে পারবেন?\"</p>\r\n<p>আমি বললাম, \"পারবো।\"</p>\r\n<p>\"কেন জানি না, আমি যেতে চাই।\"</p>\r\n<p>\"আসবেন?\"</p>\r\n<p>\"হ্যাঁ।\"</p>\r\n<p>&nbsp;</p>\r\n<p>তিন মাস পর রাশেদ ঢাকায় এলো। আমি তাকে বিমানবন্দর থেকে নিতে যাইনি। কিন্তু সে নিজেই আমাকে ফোন করলে।</p>\r\n<p>&nbsp;</p>\r\n<p>\"কামাল ভাই, আমি ঢাকায়।\"</p>\r\n<p>\"কোথায়?\"</p>\r\n<p>\"পুরোনো বাসার সামনে।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি গেলাম। সে গাড়ি থেকে নামলো। আমি প্রথমে চিনতেই পারিনি। ছবির চেয়ে মানুষ বাস্তবে অন্যরকম।</p>\r\n<p>&nbsp;</p>\r\n<p>সে আমাকে দেখে বললো, \"আপনিই কামাল?\"</p>\r\n<p>\"জি।\"</p>\r\n<p>&nbsp;</p>\r\n<p>সে হাত বাড়ালো। আমি হাত ধরলাম। তার হাত কাঁপছিল। আমরা একসঙ্গে কবরস্থানে গেলাম। তার বাবার কবর খুঁজে পেলাম। রাশেদ কিছুক্ষণ দাঁড়িয়ে রইল। তারপর বসে পড়লো।</p>\r\n<p>&nbsp;</p>\r\n<p>কোনো দোয়া পড়লো না। কিছু বললো না। শুধু মাটির উপর হাত রাখলো।</p>\r\n<p>&nbsp;</p>\r\n<p>অনেকক্ষণ পর বললো, \"বাবা, আমি এসেছি।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি একটু দূরে দাঁড়িয়ে ছিলাম।</p>\r\n<p>&nbsp;</p>\r\n<p>সে আবার বললো, \"তুমি বলেছিলে, আসিস না।\'\'</p>\r\n<p>&nbsp;</p>\r\n<p>চুপ</p>\r\n<p>&nbsp;</p>\r\n<p>\'\'আমি আসিনি।\'\'</p>\r\n<p>&nbsp;</p>\r\n<p>চুপ</p>\r\n<p>&nbsp;</p>\r\n<p>\'\'তুমি ভুল করেছিলে।\"</p>\r\n<p>&nbsp;</p>\r\n<p>চুপ</p>\r\n<p>&nbsp;</p>\r\n<p>\"আমিও ভুল করেছিলাম বাবা।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি আর দাঁড়িয়ে থাকতে পারলাম না। দূরে সরে গেলাম।</p>\r\n<p>মানুষের কিছু কথার সাক্ষী হওয়া উচিত না। কিছু কথা মৃত মানুষের আর জীবিত মানুষের মাঝেই থাকা ভালো।</p>\r\n<p>&nbsp;</p>\r\n<p>ফেরার সময় রাশেদ আমাকে বললো, \"কামাল ভাই, আপনি না থাকলে আমি আসতাম না।\"</p>\r\n<p>আমি বললাম, \"আমি তো শুধু চিঠি পৌঁছাইছি।\"</p>\r\n<p>সে বললো, \"না।\"</p>\r\n<p>\"তাহলে?\"</p>\r\n<p>\"আপনি আমার কাছে একটা ঠিকানা পৌঁছে দিয়েছেন।\"</p>\r\n<p>আমি হেসে বললাম, \"কবরের ঠিকানা?\"</p>\r\n<p>সে মাথা নাড়লো, \"না।\"</p>\r\n<p>\"তাহলে?\"</p>\r\n<p>সে বললো, \"বাবার কাছে যাওয়ার ঠিকানা।\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি কিছু বললাম না। অফিসে গিয়ে আমার ছেলেকে ফোন করলাম। সে ধরলো না। আবার করলাম। ধরলো।</p>\r\n<p>&nbsp;</p>\r\n<p>বললো, \"কী হয়েছে?\"</p>\r\n<p>আমি বললাম, \"কিছু না।\"</p>\r\n<p>\"তাহলে ফোন করছো কেন?\"</p>\r\n<p>আমি বললাম, \"তুই কেমন আছিস?\"</p>\r\n<p>সে বললো, \"ভালো।\"</p>\r\n<p>আমি বললাম, \"তোর সঙ্গে আমার কোনোদিন খুব বেশি রাগারাগি হয়েছে?\"</p>\r\n<p>ওপাশে সে হাসলো, \"আপনার তো প্রতিদিনই রাগারাগি হয়।\"</p>\r\n<p>আমি বললাম, \"আমি যদি কোনোদিন ভুল করে থাকি?\"</p>\r\n<p>&nbsp;</p>\r\n<p>সে চুপ করে গেল।</p>\r\n<p>&nbsp;</p>\r\n<p>আমি বললাম, \"তাহলে আমাকে বলিস।\"</p>\r\n<p>\"কেন?\"</p>\r\n<p>\"যাতে আমি ঠিক করতে পারি।\"</p>\r\n<p>সে কিছুক্ষণ চুপ করে থেকে বললো, \"আব্বা, আপনি ঠিক আছেন তো?\'\'</p>\r\n<p>\"হ্যাঁ।\"</p>\r\n<p>\"কিছু খাইছেন?\"</p>\r\n<p>\"না।\"</p>\r\n<p>\"খেয়ে ঘুমান।\"</p>\r\n<p>&nbsp;</p>\r\n<p>ফোন কেটে গেল।</p>\r\n<p>&nbsp;</p>\r\n<p>আমি অনেকক্ষণ ফোনটার দিকে তাকিয়ে রইলাম। তারপর ড্রয়ার খুললাম। রাশেদের বাবার চিঠির একটা ফটোকপি সেখানে রেখেছিলাম। মাত্র এক লাইন।</p>\r\n<p>&nbsp;</p>\r\n<p>\'\'আমি ভুল করেছিলাম।\'\'</p>\r\n<p>&nbsp;</p>\r\n<p>আমি কাগজটা হাতে নিয়ে ভাবলাম, মানুষ পৃথিবীতে কত কিছু লিখে। উপন্যাস। কবিতা। ইতিহাস। আইন। প্রেমপত্র। ক্ষমাপত্র। কিন্তু জীবনের সবচেয়ে কঠিন চিঠিটা সম্ভবত এই তিনটা শব্দের, আমি ভুল করেছিলাম। এই তিনটা শব্দ বলতে একজন বাবার পঁচাত্তর বছর লাগে। একজন ছেলের ত্রিশ বছর। কখনো কখনো পুরো একটা জীবন।</p>\r\n<p>&nbsp;</p>\r\n<p>পরদিন অফিসে গিয়ে টেবিলে এক পুরোনো পার্সেল পড়ে থাকতে দেখলাম। প্রাপক মৃত, প্রেরকের খোঁজ নেই। ফেরত যাওয়ার অপেক্ষায় ধুলো জমছে খামের উপর। আমি কিছুক্ষণ সেটার দিকে তাকিয়ে রইলাম। মনে হলো, পৃথিবীতে কত অভিমান, কত অসম্পূর্ণ কথা এভাবেই কোনো না কোনো টেবিলে ঠিকানাহীন হয়ে জমা পড়ে থাকে।&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>অফিসে ভালো লাগলো না। আমি বাড়ি ফিরে এলাম।</p>\r\n<p>&nbsp;</p>\r\n<p>আমার ছেলে তখন ঘরে বসে ফোন দেখছিল। আমি তার পাশে গিয়ে বসলাম। সে তাকালো।</p>\r\n<p>&nbsp;</p>\r\n<p>আমি বললাম, \"তোর সাথে আমার একটা কথা ছিল।\"</p>\r\n<p>সে অবাক হয়ে বললো, \"কী কথা?\"</p>\r\n<p>&nbsp;</p>\r\n<p>আমি ড্রয়ার থেকে রাশেদের বাবার চিঠির ফটোকপিটা বের করে তার সামনে রাখলাম।</p>\r\n<p>&nbsp;</p>\r\n<p>সে খামটার দিকে, তারপর আমার দিকে অনেকক্ষণ তাকিয়ে রইল।</p>\r\n<p>তারপর হঠাৎ উঠে এসে আমাকে জড়িয়ে ধরলো।</p>\r\n<p>&nbsp;</p>\r\n<p>অনেক বছর পর। খুব অল্প সময়ের জন্য। কিন্তু যথেষ্ট। আমি তার পিঠে হাত রাখলাম। কিছু বললাম না। আমার মনে হলো, সেদিন যদি রাশেদের বাবার চিঠিটা পৌঁছে না দিতাম, তাহলে হয়তো আমার ছেলেকে আমি এই কথাগুলো কোনোদিন বলতাম না।</p>\r\n<p>&nbsp;</p>\r\n<p>আমি এখনও কুরিয়ারে কাজ করি। এখনও ভুল ঠিকানার পার্সেল আসে। এখনো অফিসে তিনটা শব্দ লেখা হয়,&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>\"প্রাপককে পাওয়া যায়নি।\"</p>\r\n<p>&nbsp;</p>\r\n<p>কিন্তু আমি আর আগের মতো সহজে লিখতে পারি না। কারণ আমি জানি, কখনো কখনো মানুষ ঠিকানায় থাকে না। অভিমানে থাকে। দূরত্বে থাকে। ভুল বোঝাবুঝিতে থাকে। কখনো বিদেশে থাকে। কখনো কবরের নিচে। আর</p>\r\n<p>কখনো, একই বাড়িতে থেকেও একটা দরজার ওপাশে থাকে। তাই কোনো চিঠি হাতে নিয়ে যদি মনে হয়, \"লোকটা তো নেই।\" আমি একটু অপেক্ষা করি। কারণ ঠিকানাটা ভুল হতে পারে। কিন্তু চিঠিটা নয়। চিঠি সাধারণত ঠিক মানুষটার কাছেই যেতে চায়। শুধু পৌঁছাতে কখনো কখনো একজন কামালের দরকার হয়!</p>', 'প্রাপককে পাওয়া যায়নি।', 'প্রাপককে পাওয়া যায়নি। আমি পঁচিশ বছর ধরে কুরিয়ার সার্ভিসে কাজ করি। চিঠি, পার্সেল, কাগজপত্র, নোটিশ, সব পৌঁছে দিই। আগে চিঠি বেশি আসতো।', '2026-08-22 20:04:37', '2026-08-24 21:21:11'),
(22, 2, 17, 15, 278, 'আপনার ফোন ISP ডিফল্ট DNS ব্যবহার করে। এইটা বাদ দেওয়ার বহু কারণ রয়েছে তবে বেস্ট কারণ হচ্ছে প্রাইভেসি।', 'আপনর-ফন-ISP-ডফলট-DNS-বযবহর-কর-এইট-বদ-দওযর-বহ-করণ-রযছ-তব-বসট-করণ-হচছ-পরইভস', '<p>আল্লাহর ওয়াস্তে ISP এর DNS ব্যবহার করা বন্ধ করুন। কয়েকদিন ধরে Default DNS এর উপরে রিসার্চ করতেছিলাম, খুব ভয়াবহ সব জিনিস খুঁজে পেয়েছি....</p>\r\n<p>&nbsp;</p>\r\n<p>আপনার ফোন ISP ডিফল্ট DNS ব্যবহার করে। এইটা বাদ দেওয়ার বহু কারণ রয়েছে তবে বেস্ট কারণ হচ্ছে প্রাইভেসি।</p>\r\n<p>&nbsp;</p>\r\n<p>সবার আগে dnsspeedtest*online (* সরিয়ে dot বসান) &mdash; এই লিংকে যান। এখানে টেস্ট করুন কোন Private DNS আপনার ISP থেকে বেশি ফাস্ট।</p>\r\n<p>&nbsp;</p>\r\n<p>এরপরে, ফোনের Private DNS সেটিংস থেকে DNS সেটাপ করে নিন।</p>\r\n<p>&nbsp;</p>\r\n<p>ক্লাউডফ্লেয়ার সবচেয়ে ফাস্ট হলে, one*one*one*one (* সরিয়ে dot বসান) সেটাপ করে নিন।</p>\r\n<p>&nbsp;</p>\r\n<p>সিউকর DNS এর জন্য Quad9 বেশ জনপ্রিয়। dns*quad9*net (* সরিয়ে ডট বসান) সেটাপ করে নিন।</p>\r\n<p>&nbsp;</p>\r\n<p>এডস ব্লক করতে চাইলে, মোস্ট এটাক ব্লক করতে চাইলে dns*adguard-dns*com ব্যবহার করতে পারেন। এডাল্ট কন্টেন্ট ব্লক করার জন্য family* adguard-dns*com ব্যবহার করতে পারেন। তবে ব্লকিং না করে শুধু সিকিউর DNS চাইলে unfiltered*adguard-dns*com ব্যবহার করুন। (* সরিয়ে ডট বসান)</p>\r\n<p>&nbsp;</p>\r\n<p>সবচেয়ে বেস্ট কিছু চাইলে NextDNS সাজেস্ট করবো। সবকিছুই কন্ট্রোল করতে পারবেন নিজে থেকে।</p>\r\n<p>&nbsp;</p>\r\n<p>আপনি চাইলে ফোন থেকে অথবা সরাসরি রাউটার থেকেও DNS চেঞ্জ করতে পারবেন। আবার নিজের হোস্টেড পার্সোনাল DNS সার্ভার বানাতে পারেন।&nbsp;</p>', 'DNS', 'আপনার ফোন ISP ডিফল্ট DNS ব্যবহার করে। এইটা বাদ দেওয়ার বহু কারণ রয়েছে তবে বেস্ট কারণ হচ্ছে প্রাইভেসি।', '2026-09-06 22:13:55', '2026-09-06 22:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `pos_refunds`
--

CREATE TABLE `pos_refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `refund_number` varchar(32) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(191) NOT NULL,
  `refund_method` varchar(20) NOT NULL,
  `restock` tinyint(1) NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `tax` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total` decimal(12,2) NOT NULL,
  `processed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_refunds`
--

INSERT INTO `pos_refunds` (`id`, `refund_number`, `order_id`, `reason`, `refund_method`, `restock`, `notes`, `subtotal`, `tax`, `total`, `processed_by`, `created_at`, `updated_at`) VALUES
(1, 'REFUND-202609-5589', 25, 'Customer changed mind', 'mfs', 1, NULL, 184990.00, 27748.50, 212738.50, 1, '2026-09-20 01:30:55', '2026-09-20 01:30:55'),
(2, 'REFUND-202609-5904', 29, 'Customer changed mind', 'cash', 1, NULL, 154990.00, 23248.50, 178238.50, 1, '2026-09-22 01:45:46', '2026-09-22 01:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `pos_refund_items`
--

CREATE TABLE `pos_refund_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `refund_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `tax_rate` decimal(5,2) DEFAULT NULL,
  `line_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_refund_items`
--

INSERT INTO `pos_refund_items` (`id`, `refund_id`, `order_item_id`, `quantity`, `unit_price`, `tax_rate`, `line_total`, `created_at`, `updated_at`) VALUES
(1, 1, 27, 1, 184990.00, 15.00, 184990.00, '2026-09-20 01:30:55', '2026-09-20 01:30:55'),
(2, 2, 32, 1, 154990.00, 15.00, 154990.00, '2026-09-22 01:45:46', '2026-09-22 01:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `pricings`
--

CREATE TABLE `pricings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `title` text NOT NULL,
  `amount` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `button_text` text NOT NULL,
  `button_link` text NOT NULL,
  `pricing_switch` tinyint(1) NOT NULL DEFAULT 1,
  `popular_text` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricings`
--

INSERT INTO `pricings` (`id`, `language_id`, `title`, `amount`, `description`, `button_text`, `button_link`, `pricing_switch`, `popular_text`, `created_at`, `updated_at`) VALUES
(1, 1, '<h3><strong>Basic Plan</strong> <span>No coding skills required to create unique sites. Customize your site in real-time and see the results instantly.</span></h3>', '5', '<ul>\r\n<li><strong>10GB</strong> Disk Space</li>\r\n<li><strong>100GB</strong> Monthly Bandwith</li>\r\n<li><strong>20</strong> Email Accounts</li>\r\n<li>Unlimited Subdomains</li>\r\n</ul>', 'Get the offer', 'https://adscookie.com/6a107b23', 0, NULL, '2021-03-14 12:51:33', '2023-10-10 16:33:39'),
(2, 1, '<h3><strong>Professional Plan</strong> <span>No coding skills required to create unique sites. Customize your site in real-time and see the results instantly.</span></h3>', '10', '<ul>\r\n<li><strong>10GB</strong> Disk Space</li>\r\n<li><strong>100GB</strong> Monthly Bandwith</li>\r\n<li><strong>20</strong> Email Accounts</li>\r\n<li>Unlimited Subdomains</li>\r\n</ul>', 'Get the offer', 'https://adscookie.com/6a107b23', 1, 'Popular', '2021-03-14 12:53:17', '2023-10-10 16:33:25'),
(3, 1, '<h3><strong>Advanced Plan</strong> <span>No coding skills required to create unique sites. Customize your site in real-time and see the results instantly.</span></h3>', '15', '<ul>\r\n<li><strong>10GB</strong> Disk Space</li>\r\n<li><strong>100GB</strong> Monthly Bandwith</li>\r\n<li><strong>20</strong> Email Accounts</li>\r\n<li>Unlimited Subdomains</li>\r\n</ul>', 'Get the offer', 'https://adscookie.com/6a107b23', 0, NULL, '2021-03-14 12:53:41', '2023-10-10 16:33:07'),
(7, 2, '<h3><strong>বেসিক প্ল্যান</strong> <span>অনন্য সাইট তৈরি করতে কোন কোডিং দক্ষতার প্রয়োজন নেই। আপনার সাইটকে রিয়েল-টাইমে কাস্টমাইজ করুন এবং সাথে সাথে ফলাফল দেখুন।</span></h3>', '5', '<ul>\r\n<li><strong>10GB</strong> ডিস্ক স্পেস<br /><strong>100GB</strong> মাসিক ব্যান্ডউইথ<br /><strong>20</strong>টি ইমেল অ্যাকাউন্ট<br />সীমাহীন সাবডোমেন</li>\r\n</ul>', 'অফারটি পান', 'https://httsys.com/contact', 0, NULL, '2021-03-14 12:51:33', '2023-03-07 15:01:07'),
(8, 2, '<h3><strong>পেশাদার পরিকল্পনা</strong> <span>অনন্য সাইট তৈরি করতে কোন কোডিং দক্ষতার প্রয়োজন নেই। আপনার সাইটকে রিয়েল-টাইমে কাস্টমাইজ করুন এবং সাথে সাথে ফলাফল দেখুন।</span></h3>', '10', '<ul>\r\n<li><strong>10GB</strong> ডিস্ক স্পেস<br /><strong>100GB</strong> মাসিক ব্যান্ডউইথ<br /><strong>20</strong>টি ইমেল অ্যাকাউন্ট<br />সীমাহীন সাবডোমেন</li>\r\n</ul>', 'অফারটি পান', 'https://httsys.com/contact', 1, 'জনপ্রিয়', '2021-03-14 12:53:17', '2023-03-07 14:59:38'),
(9, 2, '<h3><strong>উন্নত পরিকল্পনা</strong> <span>অনন্য সাইট তৈরি করতে কোন কোডিং দক্ষতার প্রয়োজন নেই। আপনার সাইটকে রিয়েল-টাইমে কাস্টমাইজ করুন এবং সাথে সাথে ফলাফল দেখুন।</span></h3>', '15', '<ul>\r\n<li><strong>10GB</strong> ডিস্ক স্পেস<br /><strong>100GB</strong> মাসিক ব্যান্ডউইথ<br /><strong>20</strong>টি ইমেল অ্যাকাউন্ট<br />সীমাহীন সাবডোমেন</li>\r\n</ul>', 'অফারটি পান', 'https://httsys.com/contact', 0, NULL, '2021-03-14 12:53:41', '2023-03-07 14:57:52'),
(10, 3, '<h3><strong>الخطة الأساسية</strong> <span>لا تتطلب مهارات البرمجة لإنشاء مواقع فريدة. قم بتخصيص موقعك في الوقت الفعلي وشاهد النتائج على الفور.</span></h3>', '5', '<ul>\r\n<li><strong>10GB</strong> مساحة القرص</li>\r\n<li><strong>100GB</strong> النطاق الترددي الشهري</li>\r\n<li><strong>20</strong>حسابات البريد الإلكتروني</li>\r\n<li>نطاقات فرعية غير محدودة</li>\r\n</ul>', 'احصل على العرض', 'https://icode.lucian.host/contact', 0, NULL, '2021-03-14 12:51:33', '2021-03-14 13:05:14'),
(11, 3, '<h3><strong>الخطة المهنية</strong> <span>لا تتطلب مهارات البرمجة لإنشاء مواقع فريدة. قم بتخصيص موقعك في الوقت الفعلي وشاهد النتائج على الفور.</span></h3>', '10', '<ul>\r\n<li><strong>10GB</strong> مساحة القرص</li>\r\n<li><strong>100GB</strong> النطاق الترددي الشهري</li>\r\n<li><strong>20</strong>حسابات البريد الإلكتروني</li>\r\n<li>نطاقات فرعية غير محدودة</li>\r\n</ul>', 'احصل على العرض', 'https://icode.lucian.host/contact', 1, 'شائع', '2021-03-14 12:53:17', '2021-03-14 13:05:25'),
(12, 3, '<h3><strong>Advanced Plan</strong> <span>لا تتطلب مهارات البرمجة لإنشاء مواقع فريدة. قم بتخصيص موقعك في الوقت الفعلي وشاهد النتائج على الفور.</span></h3>', '15', '<ul>\r\n<li><strong>10GB</strong> مساحة القرص</li>\r\n<li><strong>100GB</strong> النطاق الترددي الشهري</li>\r\n<li><strong>20</strong>حسابات البريد الإلكتروني</li>\r\n<li>نطاقات فرعية غير محدودة</li>\r\n</ul>', 'احصل على العرض', 'https://icode.lucian.host/contact', 0, NULL, '2021-03-14 12:53:41', '2021-03-14 13:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_settings`
--

CREATE TABLE `pricing_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` text NOT NULL,
  `slug` varchar(191) NOT NULL,
  `breadcrumbs_anchor` varchar(191) NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `banner_img` text DEFAULT NULL,
  `banner_title` text DEFAULT NULL,
  `banner_desc` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricing_settings`
--

INSERT INTO `pricing_settings` (`id`, `language_id`, `meta_title`, `meta_description`, `slug`, `breadcrumbs_anchor`, `title`, `description`, `banner_img`, `banner_title`, `banner_desc`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pricing', 'HT Tech system put customers first and facilitate them with the freedom to choose from many of system, compare prices, offer the best deals and safeguards- all within a few minutes and with just a few step on our Website.', 'pricing', 'Home', 'The best <span>pricing plans</span>', 'HT Tech system put customers first and facilitate them with the freedom to choose from many of system, compare prices, offer the best deals and safeguards- all within a few minutes and with just a few step on our Website.', 'https://icode.lucian.host/public/images/media/1633956967pricing-tab-bg.webp', 'The best <span>pricing plans</span>', 'Whether you need a new logo, website, video, marketing campaign, or ebook created for your business, the key to making the project a success starts with having a well-thought-out creative brief.', NULL, '2023-03-06 19:54:49'),
(2, 2, 'মূল্য নির্ধারণ', 'আমাদের সাম্প্রতিক মূল্য', 'pricing', 'হোম', 'সেরা <span>মূল্যের পরিকল্পনা</span>', 'আমরা গ্রাহকদের প্রথমে রাখি এবং তাদের অনেকগুলি সিস্টেম থেকে বেছে নেওয়ার স্বাধীনতা দিয়ে, দামের তুলনা করি, সেরা ডিল এবং সুরক্ষা অফার করি- সব কিছু মাত্র কয়েক মিনিটের মধ্যে এবং আমাদের ওয়েবসাইটে মাত্র কয়েকটি ধাপে।', 'https://icode.lucian.host/public/images/media/1633956967pricing-tab-bg.webp', NULL, NULL, NULL, '2023-03-07 14:14:11'),
(3, 3, 'التسعير', 'أسعارنا الأخيرة', 'pricing', 'بيت', 'خطط التسعير', 'سواء كنت بحاجة إلى شعار جديد أو موقع ويب أو مقطع فيديو أو حملة تسويقية أو كتاب إلكتروني تم إنشاؤه لعملك ، فإن مفتاح إنجاح المشروع يبدأ بامتلاك موجز إبداعي مدروس جيدًا.', 'https://icode.lucian.host/public/images/media/1633956967pricing-tab-bg.webp', NULL, NULL, NULL, '2021-03-20 18:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `photo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `img_gal1` text DEFAULT NULL,
  `img_gal2` text DEFAULT NULL,
  `img_gal3` text DEFAULT NULL,
  `img_gal4` text DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `sku` varchar(64) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `type` enum('digital','physical') NOT NULL DEFAULT 'physical',
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `sale_price` decimal(12,2) DEFAULT NULL,
  `tax_rate` decimal(5,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `digital_file_id` bigint(20) UNSIGNED DEFAULT NULL,
  `digital_link` varchar(191) DEFAULT NULL,
  `video_url` varchar(191) DEFAULT NULL,
  `shipping_return_info` text DEFAULT NULL,
  `warranty_duration` int(11) DEFAULT NULL,
  `warranty_unit` enum('days','months','years') DEFAULT NULL,
  `is_flash_sale` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `language_id`, `user_id`, `product_category_id`, `brand_id`, `photo_id`, `img_gal1`, `img_gal2`, `img_gal3`, `img_gal4`, `title`, `slug`, `sku`, `short_description`, `body`, `type`, `price`, `sale_price`, `tax_rate`, `stock`, `digital_file_id`, `digital_link`, `video_url`, `shipping_return_info`, `warranty_duration`, `warranty_unit`, `is_flash_sale`, `is_active`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, 268, 'https://test.httsys.com/public/images/media/1787917459Screenshot 2026-08-18 000222.png', NULL, NULL, NULL, 'website', 'website', NULL, NULL, '<p>সুন্দর এবং সহজে বোঝা যায় UI, পেশাদার অ্যানিমেশন<br />এই সুবিধাগুলি হল পিক্সেল নিখুঁত ডিজাইন এবং পরিষ্কার কোড সরবরাহ করা<br />আপনার পরিষেবাগুলি নমনীয়, সুবিধাজনক এবং বহুমুখী সহ উপস্থাপন করুন</p>', 'digital', 500.00, 490.00, NULL, NULL, 269, 'https://httsys.com/', NULL, NULL, 6, 'months', 1, 1, 'HT Tech system', 'HT Tech system Theme Photos', '2026-08-28 17:49:22', '2026-08-30 14:21:59'),
(2, 1, 1, 5, 2, 274, 'https://test.httsys.com/public/images/media/1788078775iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'https://test.httsys.com/public/images/media/1788078775iPhone-17-Pro-Max-Pro-Price-in-Bangladesh-(1).webp', 'https://test.httsys.com/public/images/media/1788078775iPhone-17-Pro-Max-Pro-Price-in-Bangladesh-(2).webp', NULL, 'iPhone 17 Pro Max', 'iPhone-17-Pro-Max', 'PHONE-IPHONE-17-PRO-MAX-001', 'Display: 6.9\" LTPO Super Retina XDR OLED, 120Hz with 3000 nits peak brightness Camera: 48MP triple camera with periscope zoom, LiDAR scanner, and 4K Dolby Vision video Processor: Apple A19 Pro (3nm) with 6-core GPU for flagship performance Battery: Up to 5088mAh with 50% charge in 20 minutes (wired) + MagSafe/Qi2 wireless charging Our purpose is to provide accurate information from trusted sources. If you find any errors or inaccuracies, please let us know.', '<div class=\"border-b data-[state=closed]:mb-2 border-none\" data-state=\"open\" data-orientation=\"vertical\">\r\n<h3 class=\"flex\" data-orientation=\"vertical\" data-state=\"open\"><button id=\"radix-:r34:\" class=\"flex flex-1 items-center justify-between transition-all px-6 py-4.5 lg:px-11 lg:py-5 bg-primary/40 rounded text-xs uppercase sm:text-sm font-medium\" type=\"button\" aria-controls=\"radix-:r35:\" aria-expanded=\"true\" data-state=\"open\" data-orientation=\"vertical\" data-radix-collection-item=\"\">Body</button></h3>\r\n<div id=\"radix-:r35:\" class=\"overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down\" role=\"region\" data-state=\"open\" aria-labelledby=\"radix-:r34:\" data-orientation=\"vertical\">\r\n<div class=\"pb-4 pt-0 mt-2\">\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Dimensions</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">163.4 x 78 x 8.8 mm (6.43 x 3.07 x 0.35 in)</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Weight</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">233 g (8.22 oz)</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Build</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Glass front (Ceramic Shield 2), aluminum alloy frame, aluminum alloy back/ glass back (Ceramic Shield)</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">SIM</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Nano-SIM + eSIM + eSIM (max 2 at a time; International); eSIM + eSIM (8 or more, max 2 at a time; USA); Nano-SIM + Nano-SIM (China)</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Features</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">IP68 dust tight and water resistant (immersible up to 6m for 30 min); Apple Pay (Visa, MasterCard, AMEX certified)</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"border-b data-[state=closed]:mb-2 border-none\" data-state=\"open\" data-orientation=\"vertical\">\r\n<h3 class=\"flex\" data-orientation=\"vertical\" data-state=\"open\"><button id=\"radix-:r36:\" class=\"flex flex-1 items-center justify-between transition-all px-6 py-4.5 lg:px-11 lg:py-5 bg-primary/40 rounded text-xs uppercase sm:text-sm font-medium\" type=\"button\" aria-controls=\"radix-:r37:\" aria-expanded=\"true\" data-state=\"open\" data-orientation=\"vertical\" data-radix-collection-item=\"\">Comms</button></h3>\r\n<div id=\"radix-:r37:\" class=\"overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down\" role=\"region\" data-state=\"open\" aria-labelledby=\"radix-:r36:\" data-orientation=\"vertical\">\r\n<div class=\"pb-4 pt-0 mt-2\">\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">WLAN</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Wi-Fi 802.11 a/b/g/n/ac/6e/7, tri-band, hotspot</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Bluetooth</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">6.0, A2DP, LE</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Positioning</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">GPS (L1+L5), GLONASS, GALILEO, BDS, QZSS, NavIC</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">NFC</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Yes</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Radio</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">No</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">USB</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">USB Type-C 3.2 Gen 2, DisplayPort</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"border-b data-[state=closed]:mb-2 border-none\" data-state=\"open\" data-orientation=\"vertical\">\r\n<h3 class=\"flex\" data-orientation=\"vertical\" data-state=\"open\"><button id=\"radix-:r38:\" class=\"flex flex-1 items-center justify-between transition-all px-6 py-4.5 lg:px-11 lg:py-5 bg-primary/40 rounded text-xs uppercase sm:text-sm font-medium\" type=\"button\" aria-controls=\"radix-:r39:\" aria-expanded=\"true\" data-state=\"open\" data-orientation=\"vertical\" data-radix-collection-item=\"\">Sound</button></h3>\r\n<div id=\"radix-:r39:\" class=\"overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down\" role=\"region\" data-state=\"open\" aria-labelledby=\"radix-:r38:\" data-orientation=\"vertical\">\r\n<div class=\"pb-4 pt-0 mt-2\">\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Loudspeaker</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Yes, with stereo speakers</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">3.5mm jack</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">No</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"border-b data-[state=closed]:mb-2 border-none\" data-state=\"open\" data-orientation=\"vertical\">\r\n<h3 class=\"flex\" data-orientation=\"vertical\" data-state=\"open\"><button id=\"radix-:r3a:\" class=\"flex flex-1 items-center justify-between transition-all px-6 py-4.5 lg:px-11 lg:py-5 bg-primary/40 rounded text-xs uppercase sm:text-sm font-medium\" type=\"button\" aria-controls=\"radix-:r3b:\" aria-expanded=\"true\" data-state=\"open\" data-orientation=\"vertical\" data-radix-collection-item=\"\">Memory</button></h3>\r\n<div id=\"radix-:r3b:\" class=\"overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down\" role=\"region\" data-state=\"open\" aria-labelledby=\"radix-:r3a:\" data-orientation=\"vertical\">\r\n<div class=\"pb-4 pt-0 mt-2\">\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Card slot</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">No</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Internal</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">256GB 12GB RAM, 512GB 12GB RAM, 1TB 12GB RAM, 2TB 12GB RAM; NVMe</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"border-b data-[state=closed]:mb-2 border-none\" data-state=\"open\" data-orientation=\"vertical\">\r\n<h3 class=\"flex\" data-orientation=\"vertical\" data-state=\"open\"><button id=\"radix-:r3c:\" class=\"flex flex-1 items-center justify-between transition-all px-6 py-4.5 lg:px-11 lg:py-5 bg-primary/40 rounded text-xs uppercase sm:text-sm font-medium\" type=\"button\" aria-controls=\"radix-:r3d:\" aria-expanded=\"true\" data-state=\"open\" data-orientation=\"vertical\" data-radix-collection-item=\"\">Battery</button></h3>\r\n<div id=\"radix-:r3d:\" class=\"overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down\" role=\"region\" data-state=\"open\" aria-labelledby=\"radix-:r3c:\" data-orientation=\"vertical\">\r\n<div class=\"pb-4 pt-0 mt-2\">\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Type</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Li-Ion 4832 mAh - Nano SIM model; Li-Ion 5088 mAh - eSIM only model</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Charging</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Wired, PD2.0, 50% in 20 min; 25W wireless (MagSafe), 50% in 30 min; 15W wireless (MagSafe) - China only; 25W wireless (Qi2); 4.5W reverse wired</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"border-b data-[state=closed]:mb-2 border-none\" data-state=\"open\" data-orientation=\"vertical\">\r\n<h3 class=\"flex\" data-orientation=\"vertical\" data-state=\"open\"><button id=\"radix-:r3e:\" class=\"flex flex-1 items-center justify-between transition-all px-6 py-4.5 lg:px-11 lg:py-5 bg-primary/40 rounded text-xs uppercase sm:text-sm font-medium\" type=\"button\" aria-controls=\"radix-:r3f:\" aria-expanded=\"true\" data-state=\"open\" data-orientation=\"vertical\" data-radix-collection-item=\"\">Display</button></h3>\r\n<div id=\"radix-:r3f:\" class=\"overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down\" role=\"region\" data-state=\"open\" aria-labelledby=\"radix-:r3e:\" data-orientation=\"vertical\">\r\n<div class=\"pb-4 pt-0 mt-2\">\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Type</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">LTPO Super Retina XDR OLED, 120Hz, HDR10, Dolby Vision, 1000 nits (typ), 1600 nits (HBM), 3000 nits (peak)</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Size</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">6.9 inches, 115.6 cm2 (~90.7% screen-to-body ratio)</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Resolution</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">1320 x 2868 pixels, 19.5:9 ratio (~460 ppi density)</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Protection</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Ceramic Shield 2; Anti-reflective coating</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"border-b data-[state=closed]:mb-2 border-none\" data-state=\"open\" data-orientation=\"vertical\">\r\n<h3 class=\"flex\" data-orientation=\"vertical\" data-state=\"open\"><button id=\"radix-:r3g:\" class=\"flex flex-1 items-center justify-between transition-all px-6 py-4.5 lg:px-11 lg:py-5 bg-primary/40 rounded text-xs uppercase sm:text-sm font-medium\" type=\"button\" aria-controls=\"radix-:r3h:\" aria-expanded=\"true\" data-state=\"open\" data-orientation=\"vertical\" data-radix-collection-item=\"\">Features</button></h3>\r\n<div id=\"radix-:r3h:\" class=\"overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down\" role=\"region\" data-state=\"open\" aria-labelledby=\"radix-:r3g:\" data-orientation=\"vertical\">\r\n<div class=\"pb-4 pt-0 mt-2\">\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Sensors</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Face ID, accelerometer, gyro, proximity, compass, barometer; Ultra Wideband (UWB) support (gen2 chip); Emergency SOS, Messages and Find My via satellite</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"border-b data-[state=closed]:mb-2 border-none\" data-state=\"open\" data-orientation=\"vertical\">\r\n<h3 class=\"flex\" data-orientation=\"vertical\" data-state=\"open\"><button id=\"radix-:r3i:\" class=\"flex flex-1 items-center justify-between transition-all px-6 py-4.5 lg:px-11 lg:py-5 bg-primary/40 rounded text-xs uppercase sm:text-sm font-medium\" type=\"button\" aria-controls=\"radix-:r3j:\" aria-expanded=\"true\" data-state=\"open\" data-orientation=\"vertical\" data-radix-collection-item=\"\">Platform</button></h3>\r\n<div id=\"radix-:r3j:\" class=\"overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down\" role=\"region\" data-state=\"open\" aria-labelledby=\"radix-:r3i:\" data-orientation=\"vertical\">\r\n<div class=\"pb-4 pt-0 mt-2\">\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">OS</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">iOS 26</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Chipset</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Apple A19 Pro (3 nm)</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">CPU</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Hexa-core</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">GPU</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Apple GPU (6-core graphics)</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"border-b data-[state=closed]:mb-2 border-none\" data-state=\"open\" data-orientation=\"vertical\">\r\n<h3 class=\"flex\" data-orientation=\"vertical\" data-state=\"open\"><button id=\"radix-:r3k:\" class=\"flex flex-1 items-center justify-between transition-all px-6 py-4.5 lg:px-11 lg:py-5 bg-primary/40 rounded text-xs uppercase sm:text-sm font-medium\" type=\"button\" aria-controls=\"radix-:r3l:\" aria-expanded=\"true\" data-state=\"open\" data-orientation=\"vertical\" data-radix-collection-item=\"\">Main Camera</button></h3>\r\n<div id=\"radix-:r3l:\" class=\"overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down\" role=\"region\" data-state=\"open\" aria-labelledby=\"radix-:r3k:\" data-orientation=\"vertical\">\r\n<div class=\"pb-4 pt-0 mt-2\">\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Triple</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">48 MP, f/1.6, 24mm (wide), 1/1.28\", 1.22&micro;m, dual pixel PDAF, sensor-shift OIS; 48 MP, f/2.8, 100mm (periscope telephoto), 1/2.55\", 0.7&micro;m, PDAF, 3D sensor‑shift OIS, 4x optical zoom; 48 MP, f/2.2, 13mm, 120˚ (ultrawide), 1/2.55\", 0.7&micro;m, PDAF; TOF 3D LiDAR scanner (depth)</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Features</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">Dual-LED dual-tone flash, HDR (photo/panorama)</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Video</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">4K@24/25/30/60/100/120fps, 1080p@25/30/60/120/240fps, 10-bit HDR, Dolby Vision HDR (up to 60fps), ProRes, ProRes RAW, Apple Log 2, 3D (spatial) video/audio, stereo sound rec.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"border-b data-[state=closed]:mb-2 border-none\" data-state=\"open\" data-orientation=\"vertical\">\r\n<h3 class=\"flex\" data-orientation=\"vertical\" data-state=\"open\"><button id=\"radix-:r3m:\" class=\"flex flex-1 items-center justify-between transition-all px-6 py-4.5 lg:px-11 lg:py-5 bg-primary/40 rounded text-xs uppercase sm:text-sm font-medium\" type=\"button\" aria-controls=\"radix-:r3n:\" aria-expanded=\"true\" data-state=\"open\" data-orientation=\"vertical\" data-radix-collection-item=\"\">Selfie camera</button></h3>\r\n<div id=\"radix-:r3n:\" class=\"overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down\" role=\"region\" data-state=\"open\" aria-labelledby=\"radix-:r3m:\" data-orientation=\"vertical\">\r\n<div class=\"pb-4 pt-0 mt-2\">\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Single</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">18 MP multi-aspect, f/1.9, (wide), PDAF, OIS; SL 3D, (depth/biometrics sensor)</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Features</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">HDR, Dolby Vision HDR, 3D (spatial) audio, stereo sound rec., ProRes RAW, Apple Log 2</p>\r\n</div>\r\n<div class=\"mb-2 last:mb-0 flex justify-start items-center h-full px-3 sm:px-6 py-4.5 lg:px-11 lg:py-5 bg-gray rounded text-xxs uppercase sm:text-sm font-medium\">\r\n<p class=\"w-[166px] lg:w-[463px] pr-2\">Video</p>\r\n<p class=\"pl-4 w-full leading-20 sm:leading-20 border-l border-dashed\">4K@24/25/30/60fps, 1080p@25/30/60/120fps, gyro-EIS</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 'physical', 173170.00, 154990.00, 15.00, 6, NULL, NULL, 'https://youtu.be/_-AS5DtDeqs?si=fM9qJ2HFGcYfoGAH', NULL, 1, 'years', 0, 1, 'iPhone 17 Pro Max', 'iPhone 17 Pro Max', '2026-08-30 14:34:45', '2026-09-22 01:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `value` varchar(191) NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `name`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 2, 'Color', 'Cosmic Orange, Deep Blue, Silver', 0, '2026-09-06 02:31:56', '2026-09-06 02:31:56'),
(2, 2, 'Ram', '6GB, 8GB, 12GB', 1, '2026-09-06 02:31:56', '2026-09-06 02:31:56'),
(3, 2, 'Storage', '256GB, 512GB, 1TB, 2TB', 2, '2026-09-06 02:31:56', '2026-09-06 02:31:56'),
(4, 2, 'Region/Variant', 'JP/MEA (Dual e-Sim), SG/MLY/TH (Global - Sim + eSim), HK / CH (Dual Sim),  USA (Dual e-Sim)', 3, '2026-09-06 02:31:56', '2026-09-06 02:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `language_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Website', 'Website', '2026-08-28 17:37:49', '2026-08-28 17:37:49'),
(2, 1, 'photos', 'photos', '2026-08-28 17:39:13', '2026-08-28 17:39:13'),
(3, 2, 'ওয়েবসাইট', 'ওযবসইট', '2026-08-28 17:39:38', '2026-08-28 17:39:38'),
(4, 2, 'ছবি', 'ছব', '2026-08-28 17:40:01', '2026-08-28 17:40:01'),
(5, 1, 'Phone', 'Phone', '2026-08-30 14:28:30', '2026-08-30 14:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 4, 'good product', '2026-09-06 21:04:34', '2026-09-06 21:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_groups`
--

CREATE TABLE `product_variant_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variant_groups`
--

INSERT INTO `product_variant_groups` (`id`, `product_id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES
(41, 2, 'Color', 0, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(42, 2, 'Region/Variant', 1, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(43, 2, 'Storage', 2, '2026-09-16 23:47:46', '2026-09-16 23:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_options`
--

CREATE TABLE `product_variant_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_group_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(191) NOT NULL,
  `color_code` varchar(191) DEFAULT NULL,
  `price_modifier` decimal(12,2) NOT NULL DEFAULT 0.00,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variant_options`
--

INSERT INTO `product_variant_options` (`id`, `product_variant_group_id`, `value`, `color_code`, `price_modifier`, `sort_order`, `created_at`, `updated_at`) VALUES
(106, 41, 'Cosmic Orange', '#c2703d', 0.00, 0, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(107, 41, 'Deep Blue', NULL, 0.00, 1, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(108, 41, 'Silver', NULL, 0.00, 2, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(109, 42, 'JP/MEA (Dual e-Sim)', NULL, 0.00, 0, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(110, 42, 'SG/MLY/TH (Global - Sim + eSim)', NULL, 0.00, 1, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(111, 42, 'HK / CH (Dual Sim)', NULL, 0.00, 2, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(112, 42, 'USA (Dual e-Sim)', NULL, 0.00, 3, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(113, 42, 'Australia (Sim + e-Sim)', NULL, 0.00, 4, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(114, 43, '256GB', NULL, 0.00, 0, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(115, 43, '512GB', NULL, 0.00, 1, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(116, 43, '1TB', NULL, 0.00, 2, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(117, 43, '2TB', NULL, 0.00, 3, '2026-09-16 23:47:46', '2026-09-16 23:47:46'),
(118, 43, '1TB', '#c2703d', 30000.00, 4, '2026-09-16 23:47:46', '2026-09-16 23:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `profile_update_requests`
--

CREATE TABLE `profile_update_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `photo_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_update_requests`
--

INSERT INTO `profile_update_requests` (`id`, `user_id`, `name`, `phone`, `city`, `address`, `photo_id`, `status`, `reviewed_by`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(1, 16, NULL, NULL, 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', NULL, 'approved', 1, '2026-09-15 01:40:29', '2026-09-15 01:39:38', '2026-09-15 01:40:29'),
(2, 16, NULL, NULL, NULL, NULL, 279, 'approved', 1, '2026-09-15 01:51:15', '2026-09-15 01:50:36', '2026-09-15 01:51:15'),
(3, 17, NULL, NULL, 'Comilla', 'Enaya Mansion, 2nd floor, Holding-1610/5, Kather Pool Road, Race Cource, kotwali thana, Cumilla\r\nGM-23.471980,91.168761', 280, 'approved', 1, '2026-09-15 02:05:27', '2026-09-15 02:04:35', '2026-09-15 02:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL,
  `project_category_id` int(10) UNSIGNED NOT NULL,
  `photo_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `body` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `image_featured2` text DEFAULT NULL,
  `img_gal1` text DEFAULT NULL,
  `img_gal2` text DEFAULT NULL,
  `img_gal3` text DEFAULT NULL,
  `img_gal4` text DEFAULT NULL,
  `date` text DEFAULT NULL,
  `client` text DEFAULT NULL,
  `button_text` text DEFAULT NULL,
  `button_link` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `language_id`, `user_id`, `project_category_id`, `photo_id`, `title`, `slug`, `body`, `excerpt`, `image_featured2`, `img_gal1`, `img_gal2`, `img_gal3`, `img_gal4`, `date`, `client`, `button_text`, `button_link`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 220, 'Niva Brochure Theme', 'niva', '<p>Lorem ipsum dolor sit amet, cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Sed do eiusmod tempor incididunt. Lorem ipsum dolor sit amet, cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Sed do eiusmod tempor incididunt.&nbsp;</p>', '<p><strong>Lorem ipsum dolor sit amet,&nbsp;</strong>cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>\r\n<p>Ut enim ad minim veniam, quis nostrud<strong>&nbsp;exercitation ullamco</strong>&nbsp;laboris. Sed do eiusmod tempor incididunt.&nbsp;</p>', 'https://httsys.com/public/images/media/163388441262dd36111481101.6002db2f51eef.webp', 'https://httsys.com/public/images/media/1622363873galerie2.jpg', 'https://httsys.com/public/images/media/1622363873galerie1.jpg', 'https://httsys.com/public/images/media/1622363874galerie3.jpg', 'https://httsys.com/public/images/media/1622363875galerie4.jpg', 'Duration project: 12 days', 'Client: Sweet Themes', 'View website', 'https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d', 'HT Tech system WordPress Theme', 'HT Tech system WordPress Theme', '2021-03-13 17:34:32', '2023-10-15 08:41:03'),
(2, 1, 1, 2, 226, 'Niva Logo Design', 'niva-cms', '<p>Lorem ipsum dolor sit amet, cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Sed do eiusmod tempor incididunt. Lorem ipsum dolor sit amet, cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Sed do eiusmod tempor incididunt.&nbsp;</p>', '<p><strong>Lorem ipsum dolor sit amet,&nbsp;</strong>cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>\r\n<p>Ut enim ad minim veniam, quis nostrud<strong>&nbsp;exercitation ullamco</strong>&nbsp;laboris. Sed do eiusmod tempor incididunt.&nbsp;</p>', 'https://httsys.com/public/images/media/163388533314de21b7e74d5379a173b84119868006 (1).webp', 'https://httsys.com/public/images/media/1622363873galerie2.jpg', 'https://httsys.com/public/images/media/1622363873galerie1.jpg', 'https://httsys.com/public/images/media/1622363874galerie3.jpg', 'https://httsys.com/public/images/media/1622363875galerie4.jpg', 'Duration project: 14 days', 'Client: Sweet Themes', 'View website', 'https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d', 'HT Tech system CMS', 'HT Tech system CMS', '2021-03-13 17:35:52', '2023-10-15 08:40:14'),
(3, 1, 1, 2, 222, 'bootstrap Laravel', 'rentzone', '<p>Lorem ipsum dolor sit amet, cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Sed do eiusmod tempor incididunt. Lorem ipsum dolor sit amet, cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Sed do eiusmod tempor incididunt.&nbsp;</p>', '<p><strong>Lorem ipsum dolor sit amet,&nbsp;</strong>cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>\r\n<p>Ut enim ad minim veniam, quis nostrud<strong>&nbsp;exercitation ullamco</strong>&nbsp;laboris. Sed do eiusmod tempor incididunt.&nbsp;</p>', 'https://httsys.com/public/images/media/1633884610fe1ac9110475937.5fee059e53bdf.webp', 'https://httsys.com/public/images/media/1622363873galerie2.jpg', 'https://httsys.com/public/images/media/1622363873galerie1.jpg', 'https://httsys.com/public/images/media/1622363874galerie3.jpg', 'https://httsys.com/public/images/media/1622363875galerie4.jpg', 'Duration project: 14 days', 'Client: Sweet Themes', 'View website', 'https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d', 'bootstrap Laravel', 'bootstrap Laravel', '2021-03-13 17:36:34', '2023-10-15 08:39:37'),
(4, 1, 1, 1, 209, 'Venor WordPress Theme', 'venor', '<p>Lorem ipsum dolor sit amet, cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Sed do eiusmod tempor incididunt. Lorem ipsum dolor sit amet, cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Sed do eiusmod tempor incididunt.&nbsp;</p>', '<p><strong>Lorem ipsum dolor sit amet,&nbsp;</strong>cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>\r\n<p>Ut enim ad minim veniam, quis nostrud<strong>&nbsp;exercitation ullamco</strong>&nbsp;laboris. Sed do eiusmod tempor incididunt.&nbsp;</p>', 'https://httsys.com/public/images/media/1633885135ezgif.com-gif-maker%20(6)%20(1).webp', 'https://httsys.com/public/images/media/1622363873galerie2.jpg', 'https://httsys.com/public/images/media/1622363873galerie1.jpg', 'https://httsys.com/public/images/media/1622363874galerie3.jpg', 'https://httsys.com/public/images/media/1622363875galerie4.jpg', 'Duration project: 14 days', 'Client: Sweet Themes', 'View website', 'https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d', 'Wordpress', 'Wordpress', '2021-03-13 17:36:58', '2023-10-15 08:38:57'),
(9, 2, 1, 11, 220, 'বিজ্ঞাপন', 'niva', '<p>বিজ্ঞাপন হল একটি পণ্য বা পরিষেবার প্রতি মনোযোগ আনার জন্য নিযুক্ত অনুশীলন এবং কৌশল। বিজ্ঞাপনের লক্ষ্য একটি পণ্য বা পরিষেবাকে ভোক্তাদের দৃষ্টি আকর্ষণ করার আশায় স্পটলাইটে রাখা। এটি সাধারণত একটি নির্দিষ্ট পণ্য বা পরিষেবার প্রচার করার জন্য ব্যবহৃত হয়, তবে এর বিস্তৃত পরিসরের ব্যবহার রয়েছে, সবচেয়ে সাধারণ হচ্ছে বাণিজ্যিক বিজ্ঞাপন।</p>\r\n<p>বাণিজ্যিক বিজ্ঞাপনগুলি প্রায়শই \"ব্র্যান্ডিং\" এর মাধ্যমে তাদের পণ্য বা পরিষেবাগুলির বর্ধিত ব্যবহার তৈরি করতে চায়, যা ভোক্তাদের মনে নির্দিষ্ট গুণাবলীর সাথে একটি পণ্যের নাম বা চিত্র যুক্ত করে। অন্যদিকে, যে বিজ্ঞাপনগুলি একটি অবিলম্বে বিক্রয় করতে ইচ্ছুক সেগুলি সরাসরি-প্রতিক্রিয়া বিজ্ঞাপন হিসাবে পরিচিত। ভোক্তা পণ্য বা পরিষেবার চেয়ে বেশি বিজ্ঞাপন দেয় এমন অ-বাণিজ্যিক সংস্থাগুলির মধ্যে রাজনৈতিক দল, স্বার্থ গোষ্ঠী, ধর্মীয় সংস্থা এবং সরকারী সংস্থাগুলি অন্তর্ভুক্ত রয়েছে। অলাভজনক সংস্থাগুলি বিনামূল্যে বোঝানোর পদ্ধতি ব্যবহার করতে পারে, যেমন একটি পাবলিক সার্ভিস ঘোষণা৷ বিজ্ঞাপন কর্মীদের বা শেয়ারহোল্ডারদের আশ্বস্ত করতে সাহায্য করতে পারে যে একটি কোম্পানি কার্যকর বা সফল।</p>', '<p>বিজ্ঞাপন হল একটি পণ্য বা পরিষেবার প্রতি মনোযোগ আনার জন্য নিযুক্ত অনুশীলন এবং কৌশল। বিজ্ঞাপনের লক্ষ্য একটি পণ্য বা পরিষেবাকে ভোক্তাদের দৃষ্টি আকর্ষণ করার আশায় স্পটলাইটে রাখা। এটি সাধারণত একটি নির্দিষ্ট পণ্য বা পরিষেবার প্রচার করার জন্য ব্যবহৃত হয়, তবে এর বিস্তৃত পরিসরের ব্যবহার রয়েছে, সবচেয়ে সাধারণ হচ্ছে বাণিজ্যিক বিজ্ঞাপন।</p>\r\n<p>বাণিজ্যিক বিজ্ঞাপনগুলি প্রায়শই \"ব্র্যান্ডিং\" এর মাধ্যমে তাদের পণ্য বা পরিষেবাগুলির বর্ধিত ব্যবহার তৈরি করতে চায়, যা ভোক্তাদের মনে নির্দিষ্ট গুণাবলীর সাথে একটি পণ্যের নাম বা চিত্র যুক্ত করে। অন্যদিকে, যে বিজ্ঞাপনগুলি একটি অবিলম্বে বিক্রয় করতে ইচ্ছুক সেগুলি সরাসরি-প্রতিক্রিয়া বিজ্ঞাপন হিসাবে পরিচিত। ভোক্তা পণ্য বা পরিষেবার চেয়ে বেশি বিজ্ঞাপন দেয় এমন অ-বাণিজ্যিক সংস্থাগুলির মধ্যে রাজনৈতিক দল, স্বার্থ গোষ্ঠী, ধর্মীয় সংস্থা এবং সরকারী সংস্থাগুলি অন্তর্ভুক্ত রয়েছে। অলাভজনক সংস্থাগুলি বিনামূল্যে বোঝানোর পদ্ধতি ব্যবহার করতে পারে, যেমন একটি পাবলিক সার্ভিস ঘোষণা৷ বিজ্ঞাপন কর্মীদের বা শেয়ারহোল্ডারদের আশ্বস্ত করতে সাহায্য করতে পারে যে একটি কোম্পানি কার্যকর বা সফল।</p>', 'https://httsys.com/public/images/media/163388441262dd36111481101.6002db2f51eef.webp', 'https://httsys.com/public/images/media/1622363873galerie2.jpg', 'https://httsys.com/public/images/media/1622363873galerie1.jpg', 'https://httsys.com/public/images/media/1622363874galerie3.jpg', 'https://httsys.com/public/images/media/1622363875galerie4.jpg', 'প্রকল্পের মেয়াদ: 2 দিন', 'ক্লায়েন্ট: এইচটি টেক সিস্টেম থিম', 'ওয়েবসাইট দেখুন', 'https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d', 'Advertising', 'বিজ্ঞাপন হল একটি পণ্য বা পরিষেবার প্রতি মনোযোগ আনার জন্য নিযুক্ত অনুশীলন এবং কৌশল। বিজ্ঞাপনের লক্ষ্য একটি পণ্য বা পরিষেবাকে ভোক্তাদের দৃষ্টি আকর্ষণ করার আশায় স্পটলাইটে রাখা। এটি সাধারণত একটি নির্দিষ্ট পণ্য বা পরিষেবার প্রচার করার জন্য ব্যবহৃত হয়, তবে এর বিস্তৃত পরিসরের ব্যবহার রয়েছে, সবচেয়ে সাধারণ হচ্ছে বাণিজ্যিক বিজ্ঞাপন।', '2021-03-13 17:34:32', '2023-10-15 08:38:14'),
(10, 2, 1, 4, 226, 'এইচটি টেক সিস্টেম সিএমএস', 'niva-cms', '<p>একটি বিষয়বস্তু ব্যবস্থাপনা সিস্টেম (সিএমএস) হল কম্পিউটার সফ্টওয়্যার যা ডিজিটাল সামগ্রী (কন্টেন্ট ম্যানেজমেন্ট) তৈরি এবং পরিবর্তন পরিচালনা করতে ব্যবহৃত হয়। একটি CMS সাধারণত এন্টারপ্রাইজ কন্টেন্ট ম্যানেজমেন্ট (ECM) এবং ওয়েব কন্টেন্ট ম্যানেজমেন্ট (WCM) এর জন্য ব্যবহৃত হয়।</p>\r\n<p>ECM সাধারণত ডকুমেন্ট ম্যানেজমেন্ট, ডিজিটাল অ্যাসেট ম্যানেজমেন্ট এবং রেকর্ড ধারণকে একীভূত করে একটি সহযোগী পরিবেশে একাধিক ব্যবহারকারীকে সমর্থন করে।</p>\r\n<p>বিকল্পভাবে, WCM হল ওয়েবসাইটগুলির জন্য সহযোগিতামূলক রচনা এবং এতে পাঠ্য এবং এম্বেড গ্রাফিক্স, ফটো, ভিডিও, অডিও, মানচিত্র এবং প্রোগ্রাম কোড অন্তর্ভুক্ত থাকতে পারে যা সামগ্রী প্রদর্শন করে এবং ব্যবহারকারীর সাথে যোগাযোগ করে। ECM সাধারণত একটি WCM ফাংশন অন্তর্ভুক্ত করে।</p>', '<div class=\"QFw9Te BLojaf\">\r\n<div class=\"A3dMNc\">\r\n<p>একটি বিষয়বস্তু ব্যবস্থাপনা সিস্টেম (সিএমএস) হল কম্পিউটার সফ্টওয়্যার যা ডিজিটাল সামগ্রী (কন্টেন্ট ম্যানেজমেন্ট) তৈরি এবং পরিবর্তন পরিচালনা করতে ব্যবহৃত হয়। একটি CMS সাধারণত এন্টারপ্রাইজ কন্টেন্ট ম্যানেজমেন্ট (ECM) এবং ওয়েব কন্টেন্ট ম্যানেজমেন্ট (WCM) এর জন্য ব্যবহৃত হয়।</p>\r\n<p>ECM সাধারণত ডকুমেন্ট ম্যানেজমেন্ট, ডিজিটাল অ্যাসেট ম্যানেজমেন্ট এবং রেকর্ড ধারণকে একীভূত করে একটি সহযোগী পরিবেশে একাধিক ব্যবহারকারীকে সমর্থন করে।</p>\r\n<p>বিকল্পভাবে, WCM হল ওয়েবসাইটগুলির জন্য সহযোগিতামূলক রচনা এবং এতে পাঠ্য এবং এম্বেড গ্রাফিক্স, ফটো, ভিডিও, অডিও, মানচিত্র এবং প্রোগ্রাম কোড অন্তর্ভুক্ত থাকতে পারে যা সামগ্রী প্রদর্শন করে এবং ব্যবহারকারীর সাথে যোগাযোগ করে। ECM সাধারণত একটি WCM ফাংশন অন্তর্ভুক্ত করে।</p>\r\n</div>\r\n</div>', 'https://httsys.com/public/images/media/163388533314de21b7e74d5379a173b84119868006 (1).webp', 'https://httsys.com/public/images/media/1622363873galerie2.jpg', 'https://httsys.com/public/images/media/1622363873galerie1.jpg', 'https://httsys.com/public/images/media/1622363874galerie3.jpg', 'https://httsys.com/public/images/media/1622363875galerie4.jpg', 'প্রকল্পের সময়কাল: 14 দিন', 'ক্লায়েন্ট: এইচটি টেক সিস্টেম থিম', 'ওয়েবসাইট দেখুন', 'https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d', 'HT Tech system CMS', 'একটি বিষয়বস্তু ব্যবস্থাপনা সিস্টেম (সিএমএস) হল কম্পিউটার সফ্টওয়্যার যা ডিজিটাল সামগ্রী (কন্টেন্ট ম্যানেজমেন্ট) তৈরি এবং পরিবর্তন পরিচালনা করতে ব্যবহৃত হয়। একটি CMS সাধারণত এন্টারপ্রাইজ কন্টেন্ট ম্যানেজমেন্ট (ECM) এবং ওয়েব কন্টেন্ট ম্যানেজমেন্ট (WCM) এর জন্য ব্যবহৃত হয়।', '2021-03-13 17:35:52', '2023-10-15 08:37:31'),
(11, 2, 1, 9, 222, 'লারাভেল', 'rentzone', '<p>Laravel হল একটি বিনামূল্যের এবং ওপেন-সোর্স PHP ওয়েব ফ্রেমওয়ার্ক, যা টেলর অটওয়েল দ্বারা তৈরি এবং মডেল-ভিউ-কন্ট্রোলার (MVC) আর্কিটেকচারাল প্যাটার্ন অনুসরণ করে এবং সিমফনির উপর ভিত্তি করে ওয়েব অ্যাপ্লিকেশনের বিকাশের উদ্দেশ্যে। লারাভেলের কিছু বৈশিষ্ট্য হল একটি ডেডিকেটেড ডিপেন্ডেন্সি ম্যানেজার সহ একটি মডুলার প্যাকেজিং সিস্টেম, রিলেশনাল ডাটাবেস অ্যাক্সেস করার বিভিন্ন উপায়, অ্যাপ্লিকেশন স্থাপন ও রক্ষণাবেক্ষণে সহায়তা করে এমন ইউটিলিটি, এবং সিনট্যাকটিক চিনির দিকে তার অভিযোজন।</p>', '<p>Laravel হল একটি বিনামূল্যের এবং ওপেন-সোর্স PHP ওয়েব ফ্রেমওয়ার্ক, যা টেলর অটওয়েল দ্বারা তৈরি এবং মডেল-ভিউ-কন্ট্রোলার (MVC) আর্কিটেকচারাল প্যাটার্ন অনুসরণ করে এবং সিমফনির উপর ভিত্তি করে ওয়েব অ্যাপ্লিকেশনের বিকাশের উদ্দেশ্যে। লারাভেলের কিছু বৈশিষ্ট্য হল একটি ডেডিকেটেড ডিপেন্ডেন্সি ম্যানেজার সহ একটি মডুলার প্যাকেজিং সিস্টেম, রিলেশনাল ডাটাবেস অ্যাক্সেস করার বিভিন্ন উপায়, অ্যাপ্লিকেশন স্থাপন ও রক্ষণাবেক্ষণে সহায়তা করে এমন ইউটিলিটি, এবং সিনট্যাকটিক চিনির দিকে তার অভিযোজন।</p>', 'https://httsys.com/public/images/media/1633884610fe1ac9110475937.5fee059e53bdf.webp', 'https://httsys.com/public/images/media/1622363873galerie2.jpg', 'https://httsys.com/public/images/media/1622363873galerie1.jpg', 'https://httsys.com/public/images/media/1622363874galerie3.jpg', 'https://httsys.com/public/images/media/1622363875galerie4.jpg', 'প্রকল্পের সময়কাল: 14 দিন', 'ক্লায়েন্ট: এইচটি টেক সিস্টেম থিম', 'সাইট ভিজিট করুন', 'https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d', 'Laravel', 'Laravel হল একটি বিনামূল্যের এবং ওপেন-সোর্স PHP ওয়েব ফ্রেমওয়ার্ক, যা টেলর অটওয়েল দ্বারা তৈরি এবং মডেল-ভিউ-কন্ট্রোলার (MVC)', '2021-03-13 17:36:34', '2023-10-15 08:36:12'),
(12, 2, 1, 4, 209, 'ওয়ার্ডপ্রেস থিম', 'ওয়ার্ডপ্রেস থিম', '<p>ওয়ার্ডপ্রেস থিম কি ? ওয়ার্ডপ্রেস থিম হলো এক ধরনের ওয়েব টেমপ্লেট যার মাধ্যমে ওয়েবসাইট নিজের মতো করে ডিজাইন করা যায়। আরো সহজ ভাবে বলতে গেলে ওয়ার্ডপ্রেস থিম হলো ওয়েবসাইটের রেডিমেড ডিজাইন। এক্ষেত্রে কোনো ডেভেলোপার আগে থেকে একটি থিম ডেভেলোপ করে ইন্টারনেটে দিয়ে রাখে, এবং যে কেউ চাইলেই সেই থিম ডাউনলোড করে নিজের ওয়ার্ডপ্রেস ওয়েবসাইটের জন্য ব্যবহার করতে পারে।</p>\r\n<p>ওয়ার্ডপ্রেস হচ্ছে বর্তমান সময়ে সবচেয়ে জনপ্রিয় CMS যার মাধ্যমে কোডিং ছাড়া ওয়েবসাইট তৈরি করা যায়।</p>\r\n<p>আর ওয়ার্ডপ্রেসের মাধ্যমে ওয়েবসাইট তৈরির প্রধান হাতিয়ার হচ্ছে ওয়ার্ডপ্রেস থিম।</p>\r\n<p>আপনি যদি আপনার ওয়ার্ডপ্রেস ওয়েবসাইটে একটি থিম ইন্সটল করেন তাহলে আপনার ওয়েবসাইট দেখতে হুবহু সেই থিমের মতো হয়ে যাবে।</p>\r\n<p>তো আজকের আর্টিকালে আমরা ওয়ার্ডপ্রেস থিম</p>', '<p>ওয়ার্ডপ্রেস থিম কি ? ওয়ার্ডপ্রেস থিম হলো এক ধরনের ওয়েব টেমপ্লেট যার মাধ্যমে ওয়েবসাইট নিজের মতো করে ডিজাইন করা যায়। আরো সহজ ভাবে বলতে গেলে ওয়ার্ডপ্রেস থিম হলো ওয়েবসাইটের রেডিমেড ডিজাইন। এক্ষেত্রে কোনো ডেভেলোপার আগে থেকে একটি থিম ডেভেলোপ করে ইন্টারনেটে দিয়ে রাখে, এবং যে কেউ চাইলেই সেই থিম ডাউনলোড করে নিজের ওয়ার্ডপ্রেস ওয়েবসাইটের জন্য ব্যবহার করতে পারে।</p>\r\n<p>ওয়ার্ডপ্রেস হচ্ছে বর্তমান সময়ে সবচেয়ে জনপ্রিয় CMS যার মাধ্যমে কোডিং ছাড়া ওয়েবসাইট তৈরি করা যায়।</p>\r\n<p>আর ওয়ার্ডপ্রেসের মাধ্যমে ওয়েবসাইট তৈরির প্রধান হাতিয়ার হচ্ছে ওয়ার্ডপ্রেস থিম।</p>\r\n<p>আপনি যদি আপনার ওয়ার্ডপ্রেস ওয়েবসাইটে একটি থিম ইন্সটল করেন তাহলে আপনার ওয়েবসাইট দেখতে হুবহু সেই থিমের মতো হয়ে যাবে।</p>\r\n<p>তো আজকের আর্টিকালে আমরা ওয়ার্ডপ্রেস থিম</p>', 'https://httsys.com/public/images/media/1633885135ezgif.com-gif-maker%20(6)%20(1).webp', 'https://httsys.com/public/images/media/1622363873galerie2.jpg', 'https://httsys.com/public/images/media/1622363873galerie1.jpg', 'https://httsys.com/public/images/media/1622363874galerie3.jpg', 'https://httsys.com/public/images/media/1622363875galerie4.jpg', 'প্রকল্পের সময়কাল: 14 দিন', 'ক্লায়েন্ট: মিষ্টি থিম', 'ওয়েবসাইট দেখুন', 'https://www.highcpmrevenuegate.com/urn2exne?key=02bbf6992ad226859dec010a0be8723d', 'ওয়ার্ডপ্রেস থিম', 'ওয়ার্ডপ্রেস থিম', '2021-03-13 17:36:58', '2023-10-15 08:35:57'),
(15, 3, 1, 14, 220, 'موضوع كتيب نيفا', 'niva', '<p>Lorem ipsum dolor sit amet ، الغطس cosetura cing elit ، sed do eiusmod ، والطويل والحيوية ، بحيث يكون العمل من آلام السمنة. على مر السنين ، الذين تمرين nostrud ، تعمل منطقة المدرسة. لكني أقوم بتخصيص الوقت والحيوية. Lorem ipsum dolor sit amet ، الغطس cosetura cing elit ، sed do eiusmod ، والطويل والحيوية ، بحيث يكون العمل من آلام السمنة. على مر السنين ، الذين تمرين nostrud ، تعمل منطقة المدرسة. لكني أقوم بتخصيص الوقت والحيوية.</p>', '<p><strong>Lorem ipsum dolor sit amet,&nbsp;</strong>cosetetura dips cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>\r\n<p>Ut enim ad minim veniam, quis nostrud<strong>&nbsp;exercitation ullamco</strong>&nbsp;laboris. Sed do eiusmod tempor incididunt.&nbsp;</p>', 'https://icode.lucian.host/public/images/media/163388441262dd36111481101.6002db2f51eef.webp', 'https://icode.lucian.host/public/images/media/1622363873galerie2.jpg', 'https://icode.lucian.host/public/images/media/1622363873galerie1.jpg', 'https://icode.lucian.host/public/images/media/1622363874galerie3.jpg', 'https://icode.lucian.host/public/images/media/1622363875galerie4.jpg', 'مدة المشروع: 14 يوم', 'العميل: ثيمات حلوة', 'عرض الموقع', 'https://niva.lucian.host', 'موضوع كتيب نيفا', 'موضوع الوكالة الإبداعية', '2021-03-13 17:34:32', '2021-10-13 12:15:20'),
(16, 3, 1, 14, 226, 'Niva تصميم شعار', 'niva-cms', '<p>Lorem ipsum dolor sit amet ، الغطس cosetura cing elit ، sed do eiusmod ، والطويل والحيوية ، بحيث يكون العمل من آلام السمنة. على مر السنين ، الذين تمرين nostrud ، تعمل منطقة المدرسة. لكني أقوم بتخصيص الوقت والحيوية. Lorem ipsum dolor sit amet ، الغطس cosetura cing elit ، sed do eiusmod ، والطويل والحيوية ، بحيث يكون العمل من آلام السمنة. على مر السنين ، الذين تمرين nostrud ، تعمل منطقة المدرسة. لكني أقوم بتخصيص الوقت والحيوية.</p>', '<p>Lorem ipsum dolor sit amet ، <strong>تراجع </strong>cosetura cing elit ، sed do eiusmod tempor incidunt ut labore et dolore magna aliqua. المساعدة في الحد الأدنى من ممارسة الرياضة ، ممارسة العمل.</p>\r\n<p><strong>المساعدة </strong>في الحد الأدنى من ممارسة الرياضة ، ممارسة العمل. Sed do eiusmod tempor incidunt.</p>', 'https://icode.lucian.host/public/images/media/163388533314de21b7e74d5379a173b84119868006 (1).webp', 'https://icode.lucian.host/public/images/media/1622363873galerie2.jpg', 'https://icode.lucian.host/public/images/media/1622363873galerie1.jpg', 'https://icode.lucian.host/public/images/media/1622363874galerie3.jpg', 'https://icode.lucian.host/public/images/media/1622363875galerie4.jpg', 'مدة المشروع: 14 يوم', 'العميل: ثيمات حلوة', 'عرض الموقع', 'https://icode.lucian.host', 'NIVA تصميم شعار', 'موضوع الوكالة الإبداعية', '2021-03-13 17:35:52', '2021-10-13 12:13:28'),
(17, 3, 1, 13, 222, 'Rentzone كراسة', 'rentzone', '<p>Lorem ipsum dolor sit amet ، الغطس cosetura cing elit ، sed do eiusmod ، والطويل والحيوية ، بحيث يكون العمل من آلام السمنة. على مر السنين ، الذين تمرين nostrud ، تعمل منطقة المدرسة. لكني أقوم بتخصيص الوقت والحيوية. Lorem ipsum dolor sit amet ، الغطس cosetura cing elit ، sed do eiusmod ، والطويل والحيوية ، بحيث يكون العمل من آلام السمنة. على مر السنين ، الذين تمرين nostrud ، تعمل منطقة المدرسة. لكني أقوم بتخصيص الوقت والحيوية.</p>', '<p>Lorem ipsum dolor sit amet ، <strong>تراجع </strong>cosetura cing elit ، sed do eiusmod tempor incidunt ut labore et dolore magna aliqua. المساعدة في الحد الأدنى من ممارسة الرياضة ، ممارسة العمل.</p>\r\n<p><strong>المساعدة </strong>في الحد الأدنى من ممارسة الرياضة ، ممارسة العمل. Sed do eiusmod tempor incidunt.</p>', 'https://icode.lucian.host/public/images/media/1633884610fe1ac9110475937.5fee059e53bdf.webp', 'https://icode.lucian.host/public/images/media/1622363873galerie2.jpg', 'https://icode.lucian.host/public/images/media/1622363873galerie1.jpg', 'https://icode.lucian.host/public/images/media/1622363874galerie3.jpg', 'https://icode.lucian.host/public/images/media/1622363875galerie4.jpg', 'مدة المشروع: 14 يوم', 'العميل: ثيمات حلوة', 'عرض الموقع', 'http://rentzone.lucian.host/', 'Rentzone كراسة', 'موضوع الوكالة الإبداعية', '2021-03-13 17:36:34', '2021-10-13 12:11:54'),
(18, 3, 1, 13, 209, 'موضوع Venor WordPress', 'venor', '<p>Lorem ipsum dolor sit amet ، الغطس cosetura cing elit ، sed do eiusmod ، والطويل والحيوية ، بحيث يكون العمل من آلام السمنة. على مر السنين ، الذين تمرين nostrud ، تعمل منطقة المدرسة. لكني أقوم بتخصيص الوقت والحيوية. Lorem ipsum dolor sit amet ، الغطس cosetura cing elit ، sed do eiusmod ، والطويل والحيوية ، بحيث يكون العمل من آلام السمنة. على مر السنين ، الذين تمرين nostrud ، تعمل منطقة المدرسة. لكني أقوم بتخصيص الوقت والحيوية.</p>', '<p><strong>Lorem ipsum dolor sit amet </strong>، تراجع cosetura cing elit ، sed do eiusmod tempor incidunt ut labore et dolore magna aliqua. المساعدة في الحد الأدنى من ممارسة الرياضة ، ممارسة العمل.</p>\r\n<p>المساعدة في الحد الأدنى من ممارسة الرياضة ، ممارسة العمل. Sed do eiusmod tempor <strong>incidunt</strong>.</p>', 'https://icode.lucian.host/public/images/media/1633885135ezgif.com-gif-maker%20(6)%20(1).webp', 'https://icode.lucian.host/public/images/media/1622363873galerie2.jpg', 'https://icode.lucian.host/public/images/media/1622363873galerie1.jpg', 'https://icode.lucian.host/public/images/media/1622363874galerie3.jpg', 'https://icode.lucian.host/public/images/media/1622363875galerie4.jpg', 'مدة المشروع: 14 يوم', 'العميل: ثيمات حلوة', 'عرض الموقع', 'http://laravel1.lucian.host', 'Venor Wordpress', 'موضوع الوكالة الإبداعية', '2021-03-13 17:36:58', '2021-10-13 12:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE `project_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`id`, `language_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'WordPress', '2021-03-13 17:34:03', '2021-03-13 17:34:03'),
(2, 1, 'Laravel', '2021-03-13 17:35:15', '2021-03-13 17:35:15'),
(3, 1, 'SEO', '2021-03-13 17:39:32', '2021-03-13 17:39:32'),
(4, 2, 'ওয়ার্ডপ্রেস', '2021-03-13 17:39:37', '2023-03-07 14:30:22'),
(9, 2, 'লারাভেল', '2021-04-10 22:19:10', '2023-03-07 14:30:02'),
(8, 1, 'Advertise', '2021-04-10 22:18:07', '2021-04-10 22:18:07'),
(10, 2, 'এসইও', '2021-04-10 22:19:14', '2023-03-07 14:29:32'),
(11, 2, 'বিজ্ঞাপন দিন', '2021-04-10 22:19:24', '2023-03-07 14:29:06'),
(12, 3, 'يعلن', '2021-04-11 17:29:16', '2021-04-11 17:29:16'),
(13, 3, 'برمجة', '2021-04-11 17:29:42', '2021-04-11 17:29:42'),
(14, 3, 'تسويق', '2021-04-11 17:30:03', '2021-04-11 17:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `is_locked`, `created_at`, `updated_at`) VALUES
(1, 'administrator', NULL, 1, NULL, NULL),
(2, 'author', NULL, 0, NULL, NULL),
(3, 'subscriber', NULL, 0, NULL, NULL),
(4, 'POS operator', NULL, 0, '2026-09-16 01:37:53', '2026-09-16 01:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission`, `created_at`, `updated_at`) VALUES
(1, 2, 'dashboard.view', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(2, 2, 'shop.products.view', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(3, 2, 'shop.products.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(4, 2, 'shop.categories.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(5, 2, 'shop.brands.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(6, 2, 'shop.coupons.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(7, 2, 'shop.pickup_locations.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(8, 2, 'shop.payment_methods.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(9, 2, 'orders.view', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(10, 2, 'orders.verify_payment', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(11, 2, 'orders.update_status', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(12, 2, 'donations.view', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(13, 2, 'donations.verify', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(14, 2, 'donations.funds.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(15, 2, 'donations.payment_methods.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(16, 2, 'users.view', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(17, 2, 'users.create', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(18, 2, 'users.update', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(19, 2, 'users.profile_requests', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(20, 2, 'content.posts.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(21, 2, 'content.categories.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(22, 2, 'content.comments.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(23, 2, 'content.media.manage', '2026-09-16 00:15:02', '2026-09-16 00:15:02'),
(24, 2, 'pos.access', '2026-09-16 01:16:37', '2026-09-16 01:16:37'),
(25, 2, 'pos.orders.delete', '2026-09-16 01:16:37', '2026-09-16 01:16:37'),
(36, 2, 'pos.refunds.process', '2026-09-20 01:27:54', '2026-09-20 01:27:54'),
(37, 2, 'orders.returns.manage', '2026-09-22 01:41:50', '2026-09-22 01:41:50'),
(38, 4, 'dashboard.view', '2026-09-22 23:27:14', '2026-09-22 23:27:14'),
(39, 4, 'shop.products.view', '2026-09-22 23:27:14', '2026-09-22 23:27:14'),
(40, 4, 'shop.products.manage', '2026-09-22 23:27:14', '2026-09-22 23:27:14'),
(41, 4, 'shop.categories.manage', '2026-09-22 23:27:14', '2026-09-22 23:27:14'),
(42, 4, 'shop.brands.manage', '2026-09-22 23:27:14', '2026-09-22 23:27:14'),
(43, 4, 'shop.coupons.manage', '2026-09-22 23:27:14', '2026-09-22 23:27:14'),
(44, 4, 'shop.pickup_locations.manage', '2026-09-22 23:27:14', '2026-09-22 23:27:14'),
(45, 4, 'shop.payment_methods.manage', '2026-09-22 23:27:14', '2026-09-22 23:27:14'),
(46, 4, 'pos.access', '2026-09-22 23:27:14', '2026-09-22 23:27:14'),
(47, 4, 'pos.orders.delete', '2026-09-22 23:27:14', '2026-09-22 23:27:14'),
(48, 4, 'pos.refunds.process', '2026-09-22 23:27:14', '2026-09-22 23:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `photo_id` varchar(191) NOT NULL,
  `icon` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `language_id`, `photo_id`, `icon`, `title`, `description`, `button_text`, `button_link`, `created_at`, `updated_at`) VALUES
(1, 1, '234', '<i class=\"fas fa-crown\"></i>', 'Web Design', 'Your design has to be as intuitive as it is helpful and insightful. We gathered an intimate understanding of the latest UI & UX behaviors.', 'Read more', 'https://httsys.com/service-example', '2021-03-13 17:09:08', '2023-03-06 19:32:09'),
(2, 1, '235', '<i class=\"fab fa-google\"></i>', 'SEO Solutions', 'There’s some SEO in everything you do online. Search engine optimization, or SEO, is a strategy for improving your site’s rankings in engine results.', 'Read more', 'https://httsys.com/service-example', '2021-03-13 17:20:59', '2023-03-06 19:31:54'),
(3, 1, '236', '<i class=\"fas fa-mobile\"></i>', 'App development', 'Mobile app development is the act or process by which a mobile app is developed for mobile devices, such as personal digital assistants.', 'Read more', 'https://httsys.com/service-example', '2021-03-13 17:22:14', '2023-03-06 19:31:39'),
(4, 1, '237', '<i class=\"fas fa-bullhorn\"></i>', 'Online advertising', 'Online Advertising is the art of using the internet as a medium to deliver marketing messages to an identified and intended audience.', 'Read more', 'https://httsys.com/service-example', '2021-03-13 17:22:45', '2023-03-06 19:31:25'),
(8, 2, '235', '<i class=\"fab fa-google\"></i>', 'এসইও সমাধান', 'আপনি অনলাইনে যা কিছু করেন তার মধ্যে কিছু SEO আছে। সার্চ ইঞ্জিন অপ্টিমাইজেশান, বা এসইও, ইঞ্জিন ফলাফলে আপনার সাইটের র‌্যাঙ্কিং উন্নত করার একটি কৌশল।', 'আরও পড়ুন', 'https://httsys.com/service-example', '2021-03-13 17:20:59', '2023-03-07 14:46:00'),
(7, 2, '234', '<i class=\"fas fa-crown\"></i>', 'ওয়েব ডিজাইন', 'আপনার নকশা যতটা স্বজ্ঞাত হতে হবে ততটাই সহায়ক এবং অন্তর্দৃষ্টিপূর্ণ। আমরা সর্বশেষ UI এবং UX আচরণ সম্পর্কে একটি অন্তরঙ্গ বোঝাপড়া সংগ্রহ করেছি।', 'আরও পড়ুন', 'https://httsys.com/service-example', '2021-03-13 17:09:08', '2023-03-07 14:47:21'),
(9, 2, '236', '<i class=\"fas fa-mobile\"></i>', 'অ্যাপ ডেভেলপমেন্ট', 'মোবাইল অ্যাপ ডেভেলপমেন্ট হল সেই কাজ বা প্রক্রিয়া যার মাধ্যমে মোবাইল ডিভাইসের জন্য একটি মোবাইল অ্যাপ তৈরি করা হয়, যেমন ব্যক্তিগত ডিজিটাল সহকারী।', 'আরও পড়ুন', 'https://httsys.com/service-example', '2021-03-13 17:22:14', '2023-03-07 14:44:48'),
(10, 2, '237', '<i class=\"fas fa-bullhorn\"></i>', 'অনলাইন বিজ্ঞাপন', 'অনলাইন বিজ্ঞাপন হল একটি চিহ্নিত এবং অভিপ্রেত দর্শকদের কাছে বিপণন বার্তা প্রদানের মাধ্যম হিসাবে ইন্টারনেট ব্যবহার করার শিল্প।', 'আরও পড়ুন', 'https://httsys.com/service-example', '2021-03-13 17:22:45', '2023-03-07 14:43:11'),
(11, 3, '234', '<i class=\"fas fa-crown\"></i>', 'تصميم المواقع', 'يشمل تصميم الويب العديد من المهارات والتخصصات المختلفة في إنتاج وصيانة المواقع الإلكترونية.', 'مزيد من المعلومات', 'https://icode.lucian.host/service-example', '2021-03-13 17:09:08', '2021-03-13 17:17:33'),
(12, 3, '235', '<i class=\"fab fa-google\"></i>', 'حلول تحسين محركات البحث', 'كلمات البحث حسنا. أول ما تبدأ به عندما يتعلق الأمر بحلول تحسين محركات البحث هي كلماتك الرئيسية نفسها.', 'مزيد من المعلومات', 'https://icode.lucian.host/service-example', '2021-03-13 17:20:59', '2021-03-13 17:23:53'),
(13, 3, '236', '<i class=\"fas fa-mobile\"></i>', 'تطوير التطبيق', 'يشمل تصميم الويب العديد من المهارات والتخصصات المختلفة في إنتاج وصيانة المواقع الإلكترونية.', 'مزيد من المعلومات', 'https://icode.lucian.host/service-example', '2021-03-13 17:22:14', '2021-03-13 17:22:14'),
(14, 3, '237', '<i class=\"fas fa-bullhorn\"></i>', 'يعلن', 'يشمل تصميم الويب العديد من المهارات والتخصصات المختلفة في إنتاج وصيانة المواقع الإلكترونية.', 'مزيد من المعلومات', 'https://icode.lucian.host/service-example', '2021-03-13 17:22:45', '2021-03-13 17:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Cq4dXhFye3qHrI7N6qfnaIS51Mec6CKcUlMxduZN', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWgzUU1vcU1RZHVUU0dqOVE5WTk5R2lVRkxmZHp2UHJDUkxFU2JrUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056910),
('A42ZWon6uRS9aSxzcy2rCoObv45wvoJVpxfqi5Jg', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicTZVMzVMS2ZGbjYzVDJrMUdjYVBLTG54R3ljUGdKSFhjU0dXUHVzZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056908),
('JdFeHWGT1aRvAKIyRpk1nIReWMwBQAaLECh7c4X4', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzR1elVudnJ4MFFFSlJPWVJva21ra2R2YVg3ZTBvQVZvbUlZdXM2NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056933),
('nNNfRFKRlPVWmblLxhKzYN41mSFgCMQ3kZzMEKK7', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmJNbnNKM0p0WUhzNjN6RUQ0b092N3FmQXBDeUlhNVpjTnRFVEd6ViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791057165),
('MaQLKtH0rLPsyTJPWEtRZlfGeNeTyNLUhbefN2hs', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibThFMnZ5MnpLeVhqNUdjc1h5MXJSWVdvcU1DV0JtOXFzR3lPdW1tNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791057619),
('9Hmyh5s2mg8tAkmOS2a77DgJqbdaVmGlrs1H2Ug3', NULL, '64.233.173.96', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib0Y5VmFIVmtpQW00MW9JaUVvRGRrSEdBcXJpZFNJc0xwMEdUZUdPeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hcmtldHBsYWNlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1791056911),
('stGHIRTCjvqhKjLndH1vBs7mtBmhvenlCrirlHQx', NULL, '64.233.173.96', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTVHWHFDZ3ZyUDZ2SEV0b0JycjlDNmdLUlZkOTljcllvNUM1UGh4YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hcmtldHBsYWNlP3R5cGU9YXVjdGlvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1791056910),
('ucSTX1g3WbX7EXjFjC9AQ0RezEv5UIiSaU7JPeM7', NULL, '64.233.173.101', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkZtN25jS3gyWjZjRHo1dUpTT0JkQlB3aUVuY21nVEZ6cVlWcWJaUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hcmtldHBsYWNlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1791056911),
('5y34Fa71aEEaRZQzWiikmqmBd3pyB6Px9AE0OnnR', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia3liNkZvaGlwUjVUY29VNWNpbm5kcDc3OWV6bDNMckxhQkdHQ2NNSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056462),
('7zbZZ17bFlmUY9w97ZFTFztIQcNMSE6RXsQU0HzK', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVlVaUE3MnB1WDZhQVpnSXJ1c1BUb0l1UElPbkE4MTh3QkV4VVlIQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056476),
('7B9aTX4QdQJk2aFxcHzXcjWGw3RrF0eeibL43qco', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3VEbEhUUVR5amVUdzJ6WU43cm4yUGgydW1FWUZXamVvQ3kwT0Q5cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056895),
('BHooXrNLZcgL4n5n4Szb0NT2TFPSMU78GOyrEf6X', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazJDRmxUTDRyUHZpWTM4SXFPR1JWSjBDT3FDNVFnc1dEM2o1OEtvRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056121),
('rWS8LsMRAWm42P5ux7shOlZac1qQomrnoIa3sydc', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGxkV0J4N3l5eEpXZ3JlUVVZcDRCc1Q5VHQ4aE1xWWluWk13NVlRYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056136),
('SegYWBE4Wy9fvj9pB7gs49lhr5yp89Rj2o1kiOhx', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjZDbjBudnYybzBxZE1lYlZ6MmpRa01Ta3dvZ3dUa1g3SjJseHltRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056247),
('P2utXNYtylu3R59m1uDwkbC7BNlgXkHc8awtF4td', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYXM3QmlrM1E0Rk5weHlsc0FRZEx5UXpIZjF1UUk0b1NvMGRyd3EzSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056254),
('E5CW8rqdCJIIHFNp7Xcxh1SqPhmnHJmaaOebCt7W', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFlZaUhKUTR6cU1wUWdsV3MyV0dINnpDZTNQYXBWbmNDMTZnVkxveSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056404),
('JIXfeItYKBBg5O1iKsAQ9MY6E8xpKUoDsEaYMWeK', 14, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiemk2Q05WQWdGTENUUWJoVGdDQUZlNElrNDZBSEwwY2Y2dldUZ2tBRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL3Nob3AiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNDt9', 1791057619),
('irw7dEXUMrzkC6MxFCrEtSVxVp5za91nQGr7m5mi', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWRnSU1Sa0pWT3BXOGpZVDZmUzk1a01sUTZLRlZCOTJlQVozV2NaSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056469),
('JN5B47F0icsdud9fNKqSKetvjoWqqxlzUUBYGvtQ', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmpFUENRTVlVcktZdFVxY2hWZDE2MzJ2aGpTbGdmSVBvdFBZS2FRQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056449),
('KEmx52b07x6FxX7IcTPDIS1gbOB6v4q2g6hBZLkZ', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicjc4NTFsUjAzSkcwb1hGMmVvbGlOWkE0dXNtRjBTZmRpd05EQVI4SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056092),
('gzETP0RasIqVoW1pPs6Ov72OJcZBabalo79XHNm2', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0hDRVFRUHhETm91aFRGQnhMeWJrYzExV3NYMzNvaHVqQlU5RVBTSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056016),
('AXDkaK49GQD2LyFXGA0YMjgBdp1zTk0l2IeQNjU3', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNlFzajdrMkNnRUREcEdmVU5BSXR2eW0wS3psYWc1Mlo3OHR2WVRETCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056018),
('feLmT5vUbMB7xPn62Njf6zmcqc4jA4R5hgN1QBqf', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTZCOFFsR2N6WmJNWWo2YTB2SFZFMzRyZGxtZVFBTXZvSnR6SEQ5MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056906),
('CkacPVnbOg2egFqCgn4RvkQTfvrSn7Xo5I816lau', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHd3N1hnY2xuTmZOOU4zY3F1c3oyRFgxRFQzMTVaY1FVM2ZiTWZHaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056031),
('tbOUjbKw7XtTLR0HDxVAefzcwHjyL6rCmVSw6z9a', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGFLczBvY3NZbmk3TVZOaE5obEVqbEgxWFBiOERXZjFpMkxMTU9SOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056014),
('971QC5ufrC1jIEeEpTkwzylsYaUrJanF1avFIvkr', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2ZCRjJBT3hpYkFuQzNYRkROclRIOXRyWEJVUnA5WlYwNTNjVzdwMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055959),
('EwnErI12ghL2roBt3B7bCmVCdDxUoy16RVjk8ymi', 17, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid3pkd0ZGd0xPbVFidDRQT29YcnFNTnRIVGdYQjBTTVJ6SGQxTUY2QSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL2RvbmF0ZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE3O30=', 1791057165),
('8hbHxTaAepQqpNjtBOBLzgou9eQVhKUiQk9rgpJP', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTFhVXVsWU9XbnJmNU05d0lpM2g4eUtPeUFJMzNwbG1JdTZscVRWMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055967),
('ccU4GgBdnMreYLKQFm0bCJrFramEUvI2oG78I0AZ', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXB5R3NnUmlRVVNHQWpYN3Zpb1pyVlZpcU44V0tCZnlHQk9OUnpYTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055975),
('XtB4JqR3sP1voOGmtCeQGoRVU31CbkF8kYmClqry', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiemNVRmNPb0p6NGdKVjhueVFTajRVMEROWWo5cGthWTBlT081YjJvVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055990),
('gO1obVusoX4QxWnhAMReVwuR3iITgcYK35vrD9n3', NULL, '103.117.193.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHRIWXFyQ2hVbk9kT1h6eXlvVFY1bkJXNERDRVlSV2ZGRzRYbWt6ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056006),
('uyrF7t6HiIHbYCy1SuFRNc2WrvN933qVHZDrB2j2', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOU9iWktLVmZsS2swVEd2Sm1uSjhadlJraFA0MXRtdVVZYXZnWkt4NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055871),
('TrRlmEzEL7ukUSnUsdVYJCYgzYlx0wPWWqMkzSgs', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVjVGZ2xsSm1hU0FYeW5taGNUQXQ0SzViS1dxckNnSUJvMTRENVBDMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055859),
('tIbyiFcr375uTJbsXDm9vD3mrMkaY0atxBd4ZqPd', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHJxeTNqUTVNUU1nQ2xFYUpyMUtIaE9lYU9FMUJQTERRcGcxVXhRQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055856),
('xpooh3F7irp78kIk6vXHlkmzQmoptSoaUgflCb6L', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnBROXFoRDFNZE5mQjlRWElsQmZWcjRxd2FTWnNrbTdBUms4YlpreiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055733),
('O9VvLkM6XEqoUITaaKP7dpsVE7gNUtXcNnUeTSYz', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibjhGSDB2MUtLNmNTR2g2bmw4ZkdGU2dHQTdGVXZPbGZLTXhITmhpSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055750),
('IvET39SQP5LOsSPC7gLPmFu8lSI2IORiIjrJWzQY', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXdrblNYZ0J2eHBLb3dBODZ5U1RlYUNEeGdVSWZTdTJPY1FZVVdGUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055752),
('UhSub4lEuaDSGyJ20mdUGnUhRy9BG95SyrwJidew', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOG51bWxaU2MydmZCYVF2bDBKM2FQV1dhdUxiZ2JGOGRpTGh4WDAwbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055753),
('ReXVsVWuXoaTxmZhP46xxgwJr6hffY0YWVTFX23m', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0xMY2pMUDc3Wm9WWjBzWUdhcWRhNXVsaVpoeU8xanBiRmJKeDRheSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055851),
('Mm5UstexGu1Lo16H4Uo3jfdUc5hjHakH8jXlWRpb', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGZBdG5tUW90YVIzMjFCbm5QcU9kQmE0TWdVTjJMWXN4QUJleHpDTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055758),
('BpFEXfnUbr9d6HdvII2MZaEziFHsTZxaGePURsc1', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGR0SmRNd3RVOW1Pd1Y5RXRBTEt4NzdNcnhnTVFOczIxRW0zYWt5eCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055835),
('vzl3sKeBJiZUxkc3gl0Blv6PUEwehLwQ8tpKZOGx', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUZ6cWlqVDI4ZTdlOFU3T29RTEZ2YzFlYXFyNGpxZ3hORjE0dE01WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055855),
('8tujPboKyj7SJeMxRjvhktCGYjJg28QDDgnGOBq7', 1, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibFJ2RnVieHVFRklwRFNxTldlekw1V2pmbmJhN2ZOaVNMRTFsZHo4YyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MDoiaHR0cHM6Ly90ZXN0Lmh0dHN5cy5jb20vcHVibGljL2FkbWluL3dhbGxldC9lc2Nyb3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056393),
('AOMS49tiq5z7RWWOE7R3BL6SD5juMVNii8x4bHPs', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiclZSRG9XTEJGamZhdW1vWEN0MkY0WHd0a0VXZDN3TE5sSmJjOHp4NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056128),
('4FxMn6hF9T5h139OTM3xVtyWd9PDi0quCFGBHxiy', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGs3TW0zQ3hvamVzWXVTbzBpNTAzVkxUOGhCOFUxMlNENTFMZXFRWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055724),
('TY6Vxy6oEUI1IaTO1fXXO2U9aDk1PGd263M11BF0', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHVQZG9CYzdzemYzNkROWnBycE1JY0I5alBBYldwcW41S1pvcUxUOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054885),
('m7Kk6eTeVyEjBwMFO9IktoXugccTdYQdCRVZHHAw', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRExrbTZHZGhmMzJodkhNa3pGbTVDamkzVFJsekIwR0VGR2JDNlFYMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054767),
('Hz4UNizLEaTvlccvAFTxAOVQnMOjtg6khVg6iOXU', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWNmd2VsQ0t1TGtNUXJtZ1M5WjlmNzFMckFKTTBYNkVVd2pENGwwcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054097),
('5H7o9AEUrEtgvE1J0V1QyblhBU0sIsuDF2cTOvCs', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEdHRUJsbmpNTExtU1Z0U2tLVHFCZmlQcVJGTXYwZ1JzMlozMjdXbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054101),
('NfZ0dItg7FKPqU7n8jPHQsX6sV06pbNtTG3QAd0X', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkpWbDd0dlVLVEZoWFdYYThTWmkwUUJxWFBwa1lrOWVHSmpISk12MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054105),
('aljFxmhE7xLqmy1EacRwuq6wf2kPs7Ik0ClrdBMI', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzV2QUxybEU1SUdJT2pBUHlCaVNsMnpwTGxGR25JNDAwRGlBb1hFWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054156),
('t0bp9BN4dx52DdA0nclPAdKHPcvQARENeU59kEM7', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlI4TmFOSU9MSzB3bG9qVFJmUkU0WUxQRFZvblhkN1B5ZTJ1WWhWZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054109),
('2AqLduoGsJMhGR6CyBPuj6EXSesV8V79ocGmrgl3', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibU9xT3BHOEF2TEU1bGZZckFOQlRLWnJ4N0Vhckx2RmtYdkVBY2I2OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054161),
('ukflkPgvfq2ZZSxseWCfwv5NUgH5X3FZCuQEqN4A', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMnU5U3R5OTg0V3VPWHZaclZMOE1ydDVTR2lOeG9HTVVMeE10U1hWYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054166),
('y2Q7zXMdXeOKN7AjJkvxXfftjzLzgINOyisCdLUf', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXVEZ0RNOG5adTNvR3NBOEwxWEVQR3F0WXI2cWhnMmdkMTd1QkhmdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054178),
('pjWCPXxaoETeXy35nl9V7fwCAWarRzBEB5KoN6K2', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWERZR3p6amc4ZDNEZm1nRW03ekU3N3NQRGoyVVpydzRNTG9VVUNSVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791056443),
('0qTCMYuncCI6jW3Z3czj6tf0EgKP5ylixxrG7UvB', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia09oNktMZDhDRVo1N2k1WXZ4bVZsbjdUZHc3bG5JWUpqaXg3UG15NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054200),
('u32bYZS42rjdnu3Sqsd6l1peRYCgYAuRsZrSOSH9', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic0xKM0xHYm00dzRmcHNHM1JQYWZTVVR6MDZPejFPWXFTUXpONTBGTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054220),
('E5xdlQfRHSGtE8uvQ8tvOQhLCu200DbKfcXWHWr9', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHlZMHRJeWQ4Ym8yUTF0TUJzS1lOT2hORnkxRzI3UFg1c3pwdjBIcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054222),
('lWorgJlZqSA3YDENIYmLQd3vaxPjaOb8BThUiZmQ', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUk4alhDM29ac29WT3RiNzBkN2xrMTBJV2xNMlpBYkZDS25JcnRBWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054223),
('YU3VVmkIvvZQWeT965dhPJw2misjUncX01ES41eP', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmJjdndiTWJITXZwTmh2cjZzZkNtUjJWdXoxVzBGanFFZ21SNWEwTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054397),
('WPww5q84fkKtGveJs1buGKOoBiWyf0RuMZiMYosJ', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEhWQ0V2U3UwamV5VTZxQThaUFVpSDZad1Y2RHZiMEtZZDEwWkJuYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054231),
('JoPiIh4q9qK9CC4YjM4pYvZuWi5WLnKxc9oxVYCE', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidFRpZVU4clVIaDRqazc3NU15TFVxWWdhTTE2ZHhGZDA2cTlZS2R6TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054321),
('th3K6oMYgx3UtniijgNxUM2d7uXBlKzWIzgnHBPj', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlhXVUIwVlhyVHhSZzJrTjRxMmNxZWJmckJYQTc5bkVBM09FWVdHNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054426),
('sLd1US9seRR6jHYgkllk3o7wfpCw1AgSUic9TagS', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibk9DMjl0MVA0ZHh1UXhqSWRnbEtGN2EzQVNrTFV5ME54WFFFZENVViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054451),
('MNaxbsZZAipjJDO7SaA8O0ajeoW7LxkANmpNiye0', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzcwM2dlaHZSUTl2WVI3cWtRdnV3eWlTWUVmNVhWSWFBNVhDU0V1VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054427),
('vQLPpqan2eJ7OjcbU5Lfw6CGpIhQbxugebX5MepR', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGIwSEl0RG9aSG1GcnNGQW90SzNvdE9GczkzMktnd3l4TlhmUUFRcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054429),
('4DEa3XzhFhXyDFKOgaiyMJvV3m3SbWw6dGtnDCfm', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXZiTVFsZE9BV1N1UllaeDVxemYzcFhJbzZsUWVJYUxXODVRWWExRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054436),
('s8fDpB8I0NprNj07IhWmx74pi4YmAyvi2eGY2IzC', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiczRrMXA5aVZOcUVnUHdQQkQ5eUhaS0RkeGVLbHZIY09hZXNiajVVNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054445),
('jOgSj5vkdkLxIySzG5dTxVHt9XEO3V3xkSwWBFZi', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0ZaT0FaQkZ0a2piWUNBTklKOEVOM0NpdFBwZ2NKdlBnRHNNQUxFUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054514),
('Ps44szPzUuJQx6BIrnQYxbiNMApgrCYe1QivH1rG', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHNOU0FtVHhqc2JkbEEzbWcyd2hKQkZOUVBDc3A5bUI4T3lMZWRtVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054453),
('mCN5QCZQGHZo33t1kCZe1mObx3P8z5kzfKFXhDbh', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3o2RVlEa0Q1SlhtTFhvalFrVHRIejZnQmNiZmk1V3B1VVRaVElqOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054454),
('Q37YSDVV3eqsmDBcAsSHADYpVlXfJZKLuMDHnsvv', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRU4ySmRsZzVlaFdnM2E5SkxndHFiRzRvVnk5TkpnamVGTjE3V3BzYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054461),
('jzcgeVx51FKDjAUjwEj3lQe5o6EOLrFIVmEZx8C3', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmg4TmF2QlZrejlRV0FUQ0FtU2RQOEUwYWNkSjh2Rmd3YTA2UDYzbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054469),
('T4iMSj8a0EqIKrMIr96ptChQ0b16MZX3Z2N0wyY0', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoianQ4QzJQbnBlVHFRd3JoNDQ2ODl4bEwwdnVtVU1PU1ZRN3NKdkNJdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054476),
('GI1xcRrAC0n2tEJEb7vBZp6mcRvCjSJJAatEXDxe', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1RmV2RFZlNSRlpOZFJuTUZIbHlEZmpkMktqZEhDb3BUUU9IbUdFZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054484),
('EplP9IgxZyZauoitq0KjYIJk5wgk3ofE2FN9RQ69', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEU0MkprUUVVUWNzcGJuY2wweHdRY3B4ODJHNVJJamYzQWJERTlCaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054491),
('k8zpEJ9AMhPtd0PRcr1jKqerTLfVbVutoY6Idn2O', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUh0R2ZpNll4VXlGaG9JbHduSmhuR3o3N25Tdkp1eGdVVVg4V0xSdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054499),
('Z6ZwOp7paXkpsw4NF468PpQj8VJGfcuhurZn82d9', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUF5SVFrMVRKUmVOQVd0WklRS2VSbGc4WFlPbE5qQ0R2UWd0QXRTdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054507),
('CWUcJdfAbjuZcOkZtWaVuJsuCTMVMT7OmbmT2fB9', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ29DZHlFd2lsVWRONVJ1aVh2c3lSVDFDeDhrTGFXVGR5MEJXUkZWaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054596),
('8ltwTyge98JGtOK7orsZ8vB7Q4sd3PsWuyeGV0tF', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWlrV3NNbnlualg2YWlDSk03ajd2eDZQMnZxcjBKZ1B0dFpNWFFlMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054516),
('gxLImcC5NdGCpKPsY0hc1NM77u39WY8JhpyDexWs', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUU0Vkl2dThVRGZZbVFJRjN2Qll4OVRtVEM2WHJCTFM0M0hPc0F0UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054518),
('w6GolrcB8wWKaIVEUzkyLMAzIQ37cBjjFjXHTMkG', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWG0yblBRU1F5NXRrcVV1MGFFZEFBUjh4R1JFdHdpUXVTTnVsaFJPNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054557),
('ZGXqzBOWdz3Zya5KwzUXRxo2wJ1g2ykAMxgWSwSl', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmdpcGxXQmxkOUw4MlNOTkJ4TkFZSm04Y2NLOWlUT2Q4NGRTMlZTRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054648),
('icRvbXWfQGBqvQIfjp4T1LKvqgCLOlnFzi5jHjNg', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVZrMW56ak8zY0ZmS2dPYlR4NjVtWWpUVDJuVzU3aVpieHplUkVpNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054670),
('9fLdjupEU2bbchzUswlG1m7zJwr2ePnJR2dKJEmA', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGRLQWZvbDBRZkRzaUJJQTdsMmx4eFNaNDR6QXFLMXBBaTdUb1RCdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054710),
('HohkllFCTsRRwAt8XDYFNDcFC3Olg065DdiNpjjX', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjVCYkM5T3dIYVBOSVJHSzViTTA3WHN1Wmg3c3VQdnJmM3ViNDlKRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054742),
('iMzt8xFi1rLH1n08KTvgRqBjXBWzNWDe81s60j26', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmt0am53UHhWYTc2RVpZbmt6dmNLUmxCN2pZbEcxSGQyTk5KTmtKeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054774),
('ASS3BEvSSkcBUIUF0hsgk8DiEaJtIzG1oJQV4mpA', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiallteVl1bTFCSUhmWDBTZ0h1TUc4MlRuWFl2UkQ1V3U2bFJhcEZLeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054825),
('1ree9EGDRClDsDstoPBkPcDtR9co6BldMwcaWULP', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieE00N1pUa2VOQXBzc0ROdVduWVNRdE1Ca2VEZjNTd3piR0k5U0JaVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054872),
('Bv0mxMvdHA7NeNzYtePo6mbQ4M4x6Gx5y9CljMPj', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNnFTTGRKRVJDWFZVYnd3R3RTbDBvYmxZMm0zQW9BV1Zsc0c2MVM2VyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054876),
('rwFLMWT8jk2Q9Mp0ILwz8l1UvnxzzGQHDkRhstI0', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMTBOOHVkdlNXTmdsM0o4cllnamlYOGp3eWIxYmVVdjM2RGRZOVhLaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054895),
('zKeWbEKVDAdy5kJIBKYRpBp4IGq1WrlrBuf8qpTY', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3BYWkRRbENSQlk5V2NlbVB2OHJ1M2w2WDJEbURTYjUxVXluSk1GeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054926),
('HaJ0JOoZiGxd7feMbqaal97xrfrLHfcio7yEwnBC', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaVVFc29pYllMZFh6c216MW84RGlobU5ESXNTaUdISG9wUWxYUnNpbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055039),
('Lp989Z2vXEsATKva48EkLHIGdj3l9bpa9dpRcRJn', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFpsUjN1ZDZWQkh6aEtoNmNQUzlvZ0dIY21Mb3ZSMEZpbmxHYWxSTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055041),
('agPYDg1CcOfXOxwVKC8Zs9j9Lm3UulKHNZQvc5x3', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib25LeGtXVHhBRFJ2N1FUZXdWNkVadlpqTEpEMUl5YWxVbEI3TlBvUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055044),
('ckAdscMeg8McHSA6AlneRbijCJodkpVzEC18X2sI', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUpneGFLZmVzMHFlbjRDMjlMalc2NW1UWkI5dDR3MzlsaFUwT0IxWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054399),
('C5iExehkri33UDh7O4btNLJsURRJvNi48R4JYO1f', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMG1TZHlNOUNsUmw4dlhiZEt3TkdjV0hhdEVEeXVSRTJMaGhPc0pqMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054401),
('KqYrB4jUcgJsAECR1O2UzRaLTrdMM7sSwIcG3TAU', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickN1OHprWnNPM3ZqWXIxSGxaNWJCRGMyQTlpbm1qc2FSSkN4VlZaVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054409),
('4w5EoJb1ist5KUIT0wP7qZscq0VwTVrpZBe5BpcN', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMk9OeDM2Q3Y3SkNuZXplSXBVYXFXYVdieXhkZDc2eFFGY213d0pJRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791054417),
('s2XJpTQNXmdVYVDU0vrcXfqTTaGJMw0ep6eRFVny', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic1U3RzVvcFFSblU4MG9OQ2ZDSlpvZFlkNTNCVE1DRXIzeFhXTzhpMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055121),
('r0tZoiH5t7YmTlW4uNGjrDxZasjR6iB525aoLWl5', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1ltdXNzZHd2Q3c4b29XQ3dIdk1OTmFnRkJuVXVqOEVoUnljdXdkRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055050),
('t02pU0MKADaEhHXdVPSG0BiZRi8FCWZwMV1ZKFnP', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUJEd3R1R2xmdllCNDdkMlVIS3NHanRRYXlWc2RmcUdhbzhzTlJ2aCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055114),
('WCWgGSBJ6HK9130dy8jlZERtzUiy7EaqAqqytgUw', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWw2cEh4Q3VnaGdSZWt1ejlHZE05ZlFFQmVLWFZQckZORDJRVE5RSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055128);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PBcyzz4cRuSHPiYYFJxRw5CuDsGv3nDTYinRNa1a', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmVTeWxYMVl0bWcxSmdrOU1MOEFuajZFVGc0elpENzlYb2JER1dIeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055123),
('w7fZB8PweQGVTNzy9O4lFJz9yCI9a4xQnjnK2TZt', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWhyemtrV0RucW5RYnV2d25hNkFSaDkxWnQwRjVQMm5GRUo1YWZnZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055132),
('djJKvVT2cVTyUGTQdk3H0uYrtSl2rimiUGtijr9c', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicnMxNVpmWVZweVRsQ1FjVmZLNmNXTkJDeUU4bXd5NmFJMEFya0RxdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055148),
('ewcHItCq9sPh8vKt3s3sSkqWf1hYUsta41Tax2M3', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazQwN2dJM0k3M2M5U2xUZTVFZGVlQnhlM1ZnMklrRmhEOXdnTTZoayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055551),
('WiZEiPk3GQQYyAziP4Z7LFWforB2JEanCna8F0El', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3RnNDlpckNzalMwNEVjRTd4N2ZLZlI0VnBlSk5KeUZpTGdEMGMxayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055565),
('PJiJ4Tw5paWGzpiuKIpXXkDxqQPZVE74kX3u4w2h', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYU1CNFEzaVVhMTBLS01XajFTUFA2RHJEbEpKeVA3RWxuMGtHeXJjRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055572),
('wKV5J7hAD89QvVCECjwTETfSe155e0cPll5XqBbU', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicVpBck95N0ZGMVd3Z050ajlOOU1XZzZHV1JVTHJGVVRpNlRUbVBCdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055608),
('LhRe2QDZQEvPH14ZJIRQUItDWLbGcGGmSBdjboGO', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkNsaEt0ZENKcXBWeWhBQ0hFV1l5RGNDVWFuaWdOSmZuenZ4RXhNdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055626),
('LhlhKhb7IIRNDDb7aaaNFgQk3uO0KafwlkUEKvZr', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUlhMEYxelRGbGsyeURMUTJXWVN2c1VQU3FoTUdONU5SQUxuSzhlMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055629),
('bHZiBrIh5D6wqTjNgi5ev7p0WEAbDIZrooDCeiSR', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXVFYWRlT0Q0Tk1OZVMwNUoxWTVHdzM1TWQzQUpLb1VoSW55T3FOdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055631),
('T0J2DU2SJGPgSlTIHNEorSnpLxlq8AhrkbD2rfEp', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNlRDY2dYbVk0Y2R0eEp3UmRmOXh4RXlZNzF3a1BKZDhOd3NTWWJtTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055635),
('ZbDjjw7O52LzNZaVRHOjsZ2fTRF1PXrQTN4x1q6A', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM21YeHhIeEFKSlB0V3hPdWo5MVdUSWJCMTJwM0VMWGJuOEFUVnJPZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055644),
('d1PGhvPWyfI9zDVbb1Sx72iiOgdlt6P8SK3sJKFW', NULL, '103.117.193.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVhmMkthOWtCbXV4RlVseEpDSGR6YlVob0hwTHZiRWRJeHJjNUFCdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vdGVzdC5odHRzeXMuY29tL21hbmlmZXN0Lmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791055704);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `maintenance_status` tinyint(1) NOT NULL,
  `maintenance_text` text DEFAULT NULL,
  `ticker_text` text DEFAULT NULL,
  `ticker_status` tinyint(1) NOT NULL DEFAULT 0,
  `email_verification_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `slider_autoplay_seconds` smallint(5) UNSIGNED NOT NULL DEFAULT 8,
  `ip_language_detection_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `timezone` varchar(60) NOT NULL DEFAULT 'Asia/Dhaka',
  `title` varchar(191) NOT NULL,
  `favicon` text NOT NULL,
  `loader_status` tinyint(1) NOT NULL,
  `loader_img` varchar(255) DEFAULT NULL,
  `loader_color` varchar(255) DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `price_range` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `whatsapp` tinyint(1) NOT NULL,
  `whatsapp_order_number` varchar(30) DEFAULT NULL,
  `font` text NOT NULL,
  `facebook_pixel` text DEFAULT NULL,
  `facebook_pixel_switch` tinyint(1) NOT NULL DEFAULT 1,
  `analytics` text DEFAULT NULL,
  `analytics_switch` tinyint(1) NOT NULL DEFAULT 1,
  `SchmeaORG` text DEFAULT NULL,
  `SchmeaORG_switch` tinyint(1) NOT NULL DEFAULT 1,
  `OGgraph` text DEFAULT NULL,
  `OGgraph_switch` tinyint(1) NOT NULL DEFAULT 1,
  `photo_id` varchar(191) DEFAULT NULL,
  `photo_dark_id` varchar(191) DEFAULT NULL,
  `custom_css` text DEFAULT NULL,
  `custom_js` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `language_id`, `maintenance_status`, `maintenance_text`, `ticker_text`, `ticker_status`, `email_verification_enabled`, `slider_autoplay_seconds`, `ip_language_detection_enabled`, `timezone`, `title`, `favicon`, `loader_status`, `loader_img`, `loader_color`, `keywords`, `author`, `contact`, `phone`, `price_range`, `country`, `address`, `whatsapp`, `whatsapp_order_number`, `font`, `facebook_pixel`, `facebook_pixel_switch`, `analytics`, `analytics_switch`, `SchmeaORG`, `SchmeaORG_switch`, `OGgraph`, `OGgraph_switch`, `photo_id`, `photo_dark_id`, `custom_css`, `custom_js`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '<h3 style=\"text-align: center;\">Our website is under construction&nbsp;</h3>\r\n<p style=\"text-align: center;\">We will be back soon.&nbsp;</p>', '<p>Quality service in low budget<br />24/7 support is available<br />New offers are running this month<br />We hope you can contact us on WhatsApp if you have any problem or any question<br />How can we help?</p>', 1, 1, 5, 0, 'Asia/Dhaka', 'HT Tech system', 'https://httsys.com/public/images/media/1678051962HT Tech systemAsset 19mainiconw.png', 0, 'https://httsys.com/public/images/media/1678051912HT Tech systemAsset 19mainlogob.png', 'white', 'httsys, ht, HT Tech, HT Tech system, ht tech system, httechsystem, tech bd, bd, usa,', 'HT Tech system', 'httechsystem@gmail.com', '+8801876101515', '10$ to 50000$', 'United States America', '4781 Valley Lane, Austin, Texas', 1, '8801876101515', 'https://fonts.googleapis.com/css2?family=DM+Sans&family=Quicksand:wght@300;400;600;700&display=swap', 'CODE-FACEBOOK', 0, 'UA-CODE-12', 0, '<div class=\"hidden\" itemscope=\"\" itemtype=\"http://schema.org/LocalBusiness\">\r\n   <span itemprop=\"description\">Laravel CMS Script with Frontend Website</span>\r\n   <span itemprop=\"priceRange\">The best prices.</span><br>\r\n   <a itemprop=\"url\" href=\"https://icode.lucian.host/\">\r\n   </a><a itemprop=\"sameAs\" href=\"https://icode.lucian.host\">Facebook</a> |\r\n   <span itemprop=\"name\">contact@niva.host</span>\r\n   <div itemprop=\"address\" itemscope=\"\" itemtype=\"http://schema.org/PostalAddress\">\r\n      <span itemprop=\"streetAddress\">Street Name, Number 123</span> |\r\n      <span itemprop=\"addressLocality\">Bucharest</span> |\r\n      <span itemprop=\"addressCountry\">Romania</span> |\r\n      <span itemprop=\"telephone\">0722.123.456</span> |\r\n      <span itemprop=\"email\">contact@niva.host</span>\r\n   </div>\r\n   <img itemprop=\"logo\" src=\"https://icode.lucian.host/public/images/media/1615648164favicon.png\" height=\"50px\">\r\n   <img itemprop=\"image\" src=\"https://icode.lucian.host/public/images/media/1615648164favicon.png\" />\r\n</div>', 0, '<meta property=\"og:title\" content=\"Niva Agency CMS\" />\r\n<meta property=\"og:type\" content=\"website\" />\r\n<meta property=\"og:url\" content=\"https://icode.lucian.host/\" />\r\n<meta property=\"og:image\" content=\"https://icode.lucian.host/public/images/media/1615648164favicon.png\" />\r\n<meta property=\"og:site_name\" content=\"niva\" />\r\n<meta property=\"og:description\" content=\"Laravel CMS Script with Frontend Website\" />', 0, '247', '251', NULL, 'console.log(\'working\');', NULL, '2026-09-28 02:57:28'),
(2, 2, 0, NULL, '<p>স্বল্প বাজেটে মানসম্পন্ন সেবা<br />২৪/৭ সাপোর্ট চালু আছে<br />নতুন অফার চলছে এই মাসে<br />আমরা আশা করব আপনার যে কোন সমস্যা বা কোন প্রশ্ন থাকলে আমাদের হোয়াটসঅ্যাপে যোগাযোগ করবেন<br />আমরা কিভাবে সাহায্য করতে পারি?</p>', 1, 1, 5, 0, 'Asia/Dhaka', 'এইচটি টেক সিস্টেম', 'https://httsys.com/public/images/media/1678051962HT Tech systemAsset 19mainiconw.png', 0, 'https://httsys.com/public/images/media/1678051912HT Tech systemAsset 19mainlogob.png', 'white', 'এইচটি টেক সিস্টেম', 'এইচটি টেক সিস্টেম', 'httechsystem@gmail.com', '+8801876101515', '১০৳ থেকে ৫০০০০৳', 'Bangladesh', '4781 Valley Lane, Austin, Texas', 1, '8801876101515', 'https://fonts.googleapis.com/css2?family=DM+Sans&family=Quicksand:wght@300;400;600;700&display=swap', 'CODE-FACEBOOK123-p', 0, 'UA-CODE-12-p2434', 0, '<div class=\"hidden\" itemscope=\"\" itemtype=\"http://schema.org/LocalBusiness\">\r\n   <span itemprop=\"description\">Laravel CMS Script with Frontend Website</span>\r\n   <span itemprop=\"priceRange\">The best prices.</span><br>\r\n   <a itemprop=\"url\" href=\"https://icode.lucian.host/\">\r\n   </a><a itemprop=\"sameAs\" href=\"https://icode.lucian.host\">Facebook</a> |\r\n   <span itemprop=\"name\">contact@niva.host</span>\r\n   <div itemprop=\"address\" itemscope=\"\" itemtype=\"http://schema.org/PostalAddress\">\r\n      <span itemprop=\"streetAddress\">Street Name, Number 123</span> |\r\n      <span itemprop=\"addressLocality\">Bucharest</span> |\r\n      <span itemprop=\"addressCountry\">Romania</span> |\r\n      <span itemprop=\"telephone\">0722.123.456</span> |\r\n      <span itemprop=\"email\">contact@niva.host</span>\r\n   </div>\r\n   <img itemprop=\"logo\" src=\"https://icode.lucian.host/public/images/media/1615648164favicon.png\" height=\"50px\">\r\n   <img itemprop=\"image\" src=\"https://icode.lucian.host/public/images/media/1615648164favicon.png\" />\r\n</div>', 1, '<meta property=\"og:title\" content=\"Niva Agency CMS\" />\r\n<meta property=\"og:type\" content=\"website\" />\r\n<meta property=\"og:url\" content=\"https://icode.lucian.host/\" />\r\n<meta property=\"og:image\" content=\"https://icode.lucian.host/public/images/media/1615648164favicon.png\" />\r\n<meta property=\"og:site_name\" content=\"niva\" />\r\n<meta property=\"og:description\" content=\"Laravel CMS Script with Frontend Website\" />', 1, '249', '252', NULL, 'console.log(\'working\');', NULL, '2026-09-28 02:57:28'),
(3, 3, 0, NULL, NULL, 0, 1, 5, 0, 'Asia/Dhaka', 'موضوع نيفا CMS', 'https://icode.lucian.host/public/images/media/1643016131favicon.png', 1, 'https://icode.lucian.host/public/images/media/1642887630logo-loader.svg', 'white', 'سم ، لارافيل ، نيفا ، إنجليزي', 'Sweet Themes', 'contact@niva.host', '+40741395171', '300$ to 5000$', 'رومانيا', 'Unirii Street، 191، بوخارست', 1, NULL, 'https://fonts.googleapis.com/css2?family=DM+Sans&family=Quicksand:wght@300;400;600;700&display=swap', 'CODE-FACEBOOK123', 0, 'UA-CODE-12', 0, '<div class=\"hidden\" itemscope=\"\" itemtype=\"http://schema.org/LocalBusiness\">\r\n   <span itemprop=\"description\">Laravel CMS Script with Frontend Website</span>\r\n   <span itemprop=\"priceRange\">The best prices.</span><br>\r\n   <a itemprop=\"url\" href=\"https://icode.lucian.host/\">\r\n   </a><a itemprop=\"sameAs\" href=\"https://icode.lucian.host\">Facebook</a> |\r\n   <span itemprop=\"name\">contact@niva.host</span>\r\n   <div itemprop=\"address\" itemscope=\"\" itemtype=\"http://schema.org/PostalAddress\">\r\n      <span itemprop=\"streetAddress\">Street Name, Number 123</span> |\r\n      <span itemprop=\"addressLocality\">Bucharest</span> |\r\n      <span itemprop=\"addressCountry\">Romania</span> |\r\n      <span itemprop=\"telephone\">0722.123.456</span> |\r\n      <span itemprop=\"email\">contact@niva.host</span>\r\n   </div>\r\n   <img itemprop=\"logo\" src=\"https://icode.lucian.host/public/images/media/1615648164favicon.png\" height=\"50px\">\r\n   <img itemprop=\"image\" src=\"https://icode.lucian.host/public/images/media/1615648164favicon.png\" />\r\n</div>', 1, '<meta property=\"og:title\" content=\"Niva Agency CMS\" />\r\n<meta property=\"og:type\" content=\"website\" />\r\n<meta property=\"og:url\" content=\"https://icode.lucian.host/\" />\r\n<meta property=\"og:image\" content=\"https://icode.lucian.host/public/images/media/1615648164favicon.png\" />\r\n<meta property=\"og:site_name\" content=\"niva\" />\r\n<meta property=\"og:description\" content=\"Laravel CMS Script with Frontend Website\" />', 1, '232', NULL, 'body {\r\nbackground: #fff;\r\n}', 'console.log(\'working\');', NULL, '2026-09-28 02:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders`
--

CREATE TABLE `shop_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(191) NOT NULL,
  `offline_id` varchar(64) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `served_by` bigint(20) UNSIGNED DEFAULT NULL,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pickup_location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ship_name` varchar(191) NOT NULL,
  `ship_phone` varchar(191) NOT NULL,
  `ship_email` varchar(191) DEFAULT NULL,
  `ship_country` varchar(191) NOT NULL,
  `ship_state` varchar(191) NOT NULL,
  `ship_city` varchar(191) NOT NULL,
  `ship_address_line` varchar(191) NOT NULL,
  `ship_postal_code` varchar(191) DEFAULT NULL,
  `order_type` enum('delivery','pickup','pos') NOT NULL DEFAULT 'delivery',
  `status` enum('pending','confirmed','on_the_way','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(191) NOT NULL DEFAULT 'cod',
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `manual_reference` varchar(191) DEFAULT NULL,
  `payment_status` enum('unpaid','paid') NOT NULL DEFAULT 'unpaid',
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(12,2) NOT NULL DEFAULT 0.00,
  `shipping_charge` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `coupon_code` varchar(191) DEFAULT NULL,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(10) NOT NULL DEFAULT 'USD',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount_tendered` decimal(12,2) DEFAULT NULL,
  `change_due` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_orders`
--

INSERT INTO `shop_orders` (`id`, `order_number`, `offline_id`, `user_id`, `served_by`, `address_id`, `pickup_location_id`, `ship_name`, `ship_phone`, `ship_email`, `ship_country`, `ship_state`, `ship_city`, `ship_address_line`, `ship_postal_code`, `order_type`, `status`, `payment_method`, `payment_method_id`, `manual_reference`, `payment_status`, `subtotal`, `tax`, `shipping_charge`, `discount`, `coupon_code`, `total`, `currency`, `note`, `created_at`, `updated_at`, `amount_tendered`, `change_due`) VALUES
(1, '8246233', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'pending', 'cod', NULL, NULL, 'unpaid', 154990.00, 38747.50, 10.00, 0.00, NULL, 193747.50, '$', NULL, '2026-09-08 01:37:51', '2026-09-08 01:37:51', NULL, NULL),
(2, '4557583', NULL, 17, NULL, 2, NULL, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Kather Pool, Comilla Adarsha Sadar, Cumilla-3500.', '3500', 'delivery', 'pending', 'cod', NULL, NULL, 'unpaid', 154990.00, 38747.50, 10.00, 0.00, NULL, 193747.50, '$', NULL, '2026-09-08 01:43:08', '2026-09-08 01:43:08', NULL, NULL),
(3, '4812994', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'pending', 'bkash', NULL, NULL, 'unpaid', 154990.00, 38747.50, 10.00, 0.00, NULL, 193747.50, '$', NULL, '2026-09-09 00:37:00', '2026-09-09 00:37:00', NULL, NULL),
(4, '5015998', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'pending', 'bkash', NULL, NULL, 'unpaid', 154990.00, 38747.50, 10.00, 0.00, NULL, 193747.50, '$', NULL, '2026-09-09 00:37:46', '2026-09-09 00:37:46', NULL, NULL),
(5, '3392219', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'cancelled', 'bkash', NULL, NULL, 'unpaid', 184990.00, 46247.50, 10.00, 0.00, NULL, 231247.50, '$', NULL, '2026-09-09 01:00:43', '2026-09-09 01:01:07', NULL, NULL),
(6, '2964078', NULL, 17, NULL, 2, NULL, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Kather Pool, Comilla Adarsha Sadar, Cumilla-3500.', '3500', 'delivery', 'pending', 'bkash', NULL, NULL, 'unpaid', 184990.00, 46247.50, 10.00, 0.00, NULL, 231247.50, '$', NULL, '2026-09-09 02:06:48', '2026-09-09 02:06:48', NULL, NULL),
(7, '6650241', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'pending', 'bkash', 1, NULL, 'unpaid', 184990.00, 46247.50, 10.00, 0.00, NULL, 231247.50, '$', NULL, '2026-09-11 02:14:08', '2026-09-11 02:14:08', NULL, NULL),
(8, '6592115', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'pending', 'bkash', 1, NULL, 'unpaid', 154990.00, 38747.50, 10.00, 0.00, NULL, 193747.50, '$', NULL, '2026-09-11 02:15:52', '2026-09-11 02:15:52', NULL, NULL),
(9, '4579175', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'delivered', 'bkash', 1, 'R45TH4KL5', 'paid', 184990.00, 46247.50, 10.00, 0.00, NULL, 231247.50, '$', NULL, '2026-09-12 01:10:25', '2026-09-22 01:53:10', NULL, NULL),
(10, '8683712', NULL, 17, NULL, 2, NULL, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Kather Pool, Comilla Adarsha Sadar, Cumilla-3500.', '3500', 'delivery', 'delivered', 'bkash', 1, 'YS24K5L56', 'paid', 154990.00, 38747.50, 10.00, 0.00, NULL, 193747.50, '$', NULL, '2026-09-12 01:37:50', '2026-09-13 01:56:49', NULL, NULL),
(11, '5754765', NULL, 17, NULL, 2, NULL, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Kather Pool, Comilla Adarsha Sadar, Cumilla-3500.', '3500', 'delivery', 'delivered', 'bkash', 1, 'TR24G5L8', 'paid', 490.00, 122.50, 10.00, 0.00, NULL, 622.50, '$', NULL, '2026-09-12 02:11:08', '2026-09-15 02:30:20', NULL, NULL),
(12, '7322051', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'delivered', 'bkash', 1, 'JF28TH4KM3', 'paid', 490.00, 122.50, 10.00, 0.00, NULL, 622.50, '$', NULL, '2026-09-12 02:24:51', '2026-09-14 02:40:15', NULL, NULL),
(13, '9280718', NULL, 16, NULL, NULL, 2, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Comilla — GPO', '3500', 'pickup', 'pending', 'bkash', 1, NULL, 'unpaid', 184990.00, 46247.50, 10.00, 500.00, 'WELCOME500', 230747.50, '$', NULL, '2026-09-12 02:53:22', '2026-09-12 02:53:22', NULL, NULL),
(14, '2864482', NULL, 17, NULL, 2, NULL, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Kather Pool, Comilla Adarsha Sadar, Cumilla-3500.', '3500', 'delivery', 'pending', 'bkash', 1, NULL, 'unpaid', 490.00, 122.50, 10.00, 0.00, NULL, 622.50, '$', NULL, '2026-09-12 02:57:47', '2026-09-12 02:57:47', NULL, NULL),
(15, '5005289', NULL, 16, NULL, NULL, 2, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Comilla — GPO', '3500', 'pickup', 'pending', 'bkash', 1, 'KI28TH4KM7', 'paid', 154990.00, 38747.50, 10.00, 0.00, NULL, 193747.50, '$', NULL, '2026-09-13 01:53:21', '2026-09-13 01:55:21', NULL, NULL),
(16, '4156598', NULL, 17, NULL, 2, NULL, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Kather Pool, Comilla Adarsha Sadar, Cumilla-3500.', '3500', 'delivery', 'pending', 'bkash', 1, NULL, 'unpaid', 154990.00, 38747.50, 10.00, 500.00, 'WELCOME500', 193247.50, '$', NULL, '2026-09-13 02:04:47', '2026-09-13 02:04:47', NULL, NULL),
(17, '7933761', NULL, 17, NULL, 2, NULL, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Kather Pool, Comilla Adarsha Sadar, Cumilla-3500.', '3500', 'delivery', 'pending', 'bkash', 1, NULL, 'unpaid', 154990.00, 38747.50, 10.00, 500.00, 'WELCOME500', 193247.50, '$', NULL, '2026-09-13 03:21:10', '2026-09-13 03:21:10', NULL, NULL),
(18, '6690270', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'pending', 'cod', NULL, NULL, 'unpaid', 154990.00, 38747.50, 10.00, 0.00, NULL, 193747.50, '$', NULL, '2026-09-13 03:59:27', '2026-09-13 03:59:27', NULL, NULL),
(19, '2133257', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'pending', 'bkash', 1, 'KI28TH4KM7', 'unpaid', 490.00, 122.50, 10.00, 0.00, NULL, 622.50, '$', NULL, '2026-09-13 04:00:44', '2026-09-13 04:00:53', NULL, NULL),
(20, '9076268', NULL, 17, NULL, 2, NULL, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Kather Pool, Comilla Adarsha Sadar, Cumilla-3500.', '3500', 'delivery', 'pending', 'bkash', 1, 'YS24K5L56', 'unpaid', 154990.00, 38747.50, 10.00, 500.00, 'WELCOME500', 193247.50, '$', NULL, '2026-09-13 17:10:24', '2026-09-13 17:10:52', NULL, NULL),
(21, '4128683', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'pending', 'bkash', 1, 'JI25TH4KM0', 'unpaid', 154990.00, 38747.50, 10.00, 500.00, 'WELCOME500', 193247.50, '$', NULL, '2026-09-14 03:30:45', '2026-09-14 03:31:05', NULL, NULL),
(22, '5564099', NULL, 18, 1, NULL, NULL, 'Walking Customer', '-', 'walking-customer@pos.local', 'United States America', 'United States America', '4781 Valley Lane, Austin, Texas', '4781 Valley Lane, Austin, Texas', NULL, 'pos', 'delivered', 'cash', NULL, NULL, 'paid', 184990.00, 46247.50, 0.00, 3699.80, NULL, 227537.70, '$', NULL, '2026-09-16 01:19:41', '2026-09-16 01:19:41', 228000.00, 462.30),
(23, '7378364', NULL, 14, 1, NULL, NULL, 'abc', '+8801712345678', 'abc@httsys.com', 'United States America', 'United States America', '4781 Valley Lane, Austin, Texas', '4781 Valley Lane, Austin, Texas', NULL, 'pos', 'delivered', 'card', NULL, NULL, 'paid', 155480.00, 38870.00, 0.00, 500.00, NULL, 193850.00, '$', NULL, '2026-09-16 01:33:59', '2026-09-16 01:33:59', 193850.00, 0.00),
(24, '6727543', NULL, 18, 17, NULL, NULL, 'Walking Customer', '-', 'walking-customer@pos.local', 'United States America', 'United States America', '4781 Valley Lane, Austin, Texas', '4781 Valley Lane, Austin, Texas', NULL, 'pos', 'delivered', 'mfs', NULL, NULL, 'paid', 155970.00, 38992.50, 0.00, 200.00, NULL, 194762.50, '$', NULL, '2026-09-16 04:05:06', '2026-09-16 04:05:06', 194762.50, 0.00),
(25, '7025136', NULL, 14, 1, NULL, NULL, 'abc', '+8801712345678', 'abc@httsys.com', 'United States America', 'United States America', '4781 Valley Lane, Austin, Texas', '4781 Valley Lane, Austin, Texas', NULL, 'pos', 'delivered', 'cash', NULL, NULL, 'paid', 184990.00, 27748.50, 0.00, 184990.00, NULL, 27748.50, '$', NULL, '2026-09-16 23:50:34', '2026-09-16 23:50:34', 27750.00, 1.50),
(26, '9704758', NULL, 18, 1, NULL, NULL, 'Walking Customer', '-', 'walking-customer@pos.local', 'United States America', 'United States America', '4781 Valley Lane, Austin, Texas', '4781 Valley Lane, Austin, Texas', NULL, 'pos', 'delivered', 'card', NULL, NULL, 'paid', 155480.00, 23371.00, 0.00, 0.00, NULL, 178851.00, '$', NULL, '2026-09-20 01:35:50', '2026-09-20 01:35:50', 178851.00, 0.00),
(27, '6547008', NULL, 14, 1, NULL, NULL, 'abc', '+8801712345678', 'abc@httsys.com', 'United States America', 'United States America', '4781 Valley Lane, Austin, Texas', '4781 Valley Lane, Austin, Texas', NULL, 'pos', 'delivered', 'cash', NULL, NULL, 'paid', 490.00, 122.50, 0.00, 9.80, NULL, 602.70, '$', NULL, '2026-09-20 01:40:48', '2026-09-20 01:40:48', 610.00, 7.30),
(28, '5515004', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'pending', 'bkash', 1, NULL, 'unpaid', 490.00, 122.50, 10.00, 0.00, NULL, 622.50, '$', NULL, '2026-09-20 01:55:09', '2026-09-20 01:55:09', NULL, NULL),
(29, '9319231', NULL, 18, 1, NULL, NULL, 'Walking Customer', '-', 'walking-customer@pos.local', 'United States America', 'United States America', '4781 Valley Lane, Austin, Texas', '4781 Valley Lane, Austin, Texas', NULL, 'pos', 'delivered', 'cash', NULL, NULL, 'paid', 154990.00, 23248.50, 0.00, 500.00, NULL, 177738.50, '$', NULL, '2026-09-22 01:44:16', '2026-09-22 01:44:16', 177750.00, 11.50),
(30, '6556327', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'cancelled', 'bkash', 1, 'KI28TH4KM9', 'paid', 184990.00, 46247.50, 10.00, 500.00, 'WELCOME500', 230747.50, '$', NULL, '2026-09-22 01:47:59', '2026-09-22 01:50:43', NULL, NULL),
(31, '9143096', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'confirmed', 'cod', NULL, NULL, 'unpaid', 154990.00, 38747.50, 10.00, 500.00, 'WELCOME500', 193247.50, '$', NULL, '2026-09-24 01:07:09', '2026-09-24 01:08:06', NULL, NULL),
(32, '2815213', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'cancelled', 'bkash', 1, 'BA28TH4K63', 'unpaid', 154990.00, 38747.50, 10.00, 500.00, 'WELCOME500', 193247.50, '$', NULL, '2026-09-28 02:51:30', '2026-09-28 03:00:37', NULL, NULL),
(33, '8446771', NULL, 17, NULL, 2, NULL, 'Sojeeb', '+8801876101515', 'emailsojeeb@gmail.com', 'Bangladesh', 'Chittagong', 'Comilla', 'Kather Pool, Comilla Adarsha Sadar, Cumilla-3500.', '3500', 'delivery', 'pending', 'bkash', 1, 'YS24K5L58', 'unpaid', 154990.00, 38747.50, 10.00, 500.00, 'WELCOME500', 193247.50, '$', NULL, '2026-09-28 02:58:49', '2026-09-28 02:59:01', NULL, NULL),
(34, '8826343', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'pending', 'bkash', 1, 'VR253ftfT17', 'unpaid', 154990.00, 38747.50, 10.00, 500.00, 'WELCOME500', 193247.50, '$', NULL, '2026-09-30 02:58:47', '2026-09-30 02:59:28', NULL, NULL),
(35, '3715283', NULL, 16, NULL, 1, NULL, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Wasa, S Khulshi Rd, Chattogram 4000', '4000', 'delivery', 'pending', 'cod', NULL, NULL, 'unpaid', 154990.00, 38747.50, 10.00, 0.00, NULL, 193747.50, '$', NULL, '2026-09-30 03:27:16', '2026-09-30 03:27:16', NULL, NULL),
(36, '3046969', NULL, 16, NULL, NULL, 1, 'earn stationme1', '+8801712345678', 'earnstationme1@gmail.com', 'Bangladesh', 'Chittagong', 'Chittagong', 'Chittagong — GPO', '4000', 'pickup', 'pending', 'cod', NULL, NULL, 'unpaid', 490.00, 122.50, 10.00, 0.00, NULL, 622.50, '$', NULL, '2026-10-01 01:42:27', '2026-10-01 01:42:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_items`
--

CREATE TABLE `shop_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_title` varchar(191) NOT NULL,
  `product_image` varchar(191) DEFAULT NULL,
  `variant_summary` varchar(191) DEFAULT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `tax_rate` decimal(5,2) DEFAULT NULL,
  `line_tax` decimal(12,2) DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `refunded_quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `line_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_order_items`
--

INSERT INTO `shop_order_items` (`id`, `order_id`, `product_id`, `product_title`, `product_image`, `variant_summary`, `unit_price`, `tax_rate`, `line_tax`, `quantity`, `refunded_quantity`, `line_total`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Deep Blue | USA (Dual e-Sim) | 512GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-08 01:37:51', '2026-09-08 01:37:51'),
(2, 2, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-08 01:43:08', '2026-09-08 01:43:08'),
(3, 3, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-09 00:37:00', '2026-09-09 00:37:00'),
(4, 4, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-09 00:37:46', '2026-09-09 00:37:46'),
(5, 5, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 1TB', 184990.00, NULL, NULL, 1, 0, 184990.00, '2026-09-09 01:00:43', '2026-09-09 01:00:43'),
(6, 6, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 1TB', 184990.00, NULL, NULL, 1, 0, 184990.00, '2026-09-09 02:06:48', '2026-09-09 02:06:48'),
(7, 7, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 1TB', 184990.00, NULL, NULL, 1, 0, 184990.00, '2026-09-11 02:14:08', '2026-09-11 02:14:08'),
(8, 8, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-11 02:15:52', '2026-09-11 02:15:52'),
(9, 9, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | USA (Dual e-Sim) | 1TB', 184990.00, NULL, NULL, 1, 0, 184990.00, '2026-09-12 01:10:25', '2026-09-12 01:10:25'),
(10, 10, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Deep Blue | SG/MLY/TH (Global - Sim + eSim) | 512GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-12 01:37:50', '2026-09-12 01:37:50'),
(11, 11, 1, 'website', '1787917762Screenshot 2026-08-22 032218.png', '', 490.00, NULL, NULL, 1, 0, 490.00, '2026-09-12 02:11:08', '2026-09-12 02:11:08'),
(12, 12, 1, 'website', '1787917762Screenshot 2026-08-22 032218.png', '', 490.00, NULL, NULL, 1, 0, 490.00, '2026-09-12 02:24:51', '2026-09-12 02:24:51'),
(13, 13, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | USA (Dual e-Sim) | 1TB', 184990.00, NULL, NULL, 1, 0, 184990.00, '2026-09-12 02:53:22', '2026-09-12 02:53:22'),
(14, 14, 1, 'website', '1787917762Screenshot 2026-08-22 032218.png', '', 490.00, NULL, NULL, 1, 0, 490.00, '2026-09-12 02:57:47', '2026-09-12 02:57:47'),
(15, 15, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-13 01:53:21', '2026-09-13 01:53:21'),
(16, 16, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Silver | SG/MLY/TH (Global - Sim + eSim) | 512GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-13 02:04:47', '2026-09-13 02:04:47'),
(17, 17, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-13 03:21:10', '2026-09-13 03:21:10'),
(18, 18, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-13 03:59:27', '2026-09-13 03:59:27'),
(19, 19, 1, 'website', '1787917762Screenshot 2026-08-22 032218.png', '', 490.00, NULL, NULL, 1, 0, 490.00, '2026-09-13 04:00:44', '2026-09-13 04:00:44'),
(20, 20, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Deep Blue | USA (Dual e-Sim) | 512GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-13 17:10:24', '2026-09-13 17:10:24'),
(21, 21, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-14 03:30:45', '2026-09-14 03:30:45'),
(22, 22, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | USA (Dual e-Sim) | 1TB', 184990.00, 25.00, 46247.50, 1, 0, 184990.00, '2026-09-16 01:19:41', '2026-09-16 01:19:41'),
(23, 23, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, 25.00, 38747.50, 1, 0, 154990.00, '2026-09-16 01:33:59', '2026-09-16 01:33:59'),
(24, 23, 1, 'website', '1787917762Screenshot 2026-08-22 032218.png', '', 490.00, 25.00, 122.50, 1, 0, 490.00, '2026-09-16 01:33:59', '2026-09-16 01:33:59'),
(25, 24, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, 25.00, 38747.50, 1, 0, 154990.00, '2026-09-16 04:05:06', '2026-09-16 04:05:06'),
(26, 24, 1, 'website', '1787917762Screenshot 2026-08-22 032218.png', '', 490.00, 25.00, 245.00, 2, 0, 980.00, '2026-09-16 04:05:06', '2026-09-16 04:05:06'),
(27, 25, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | USA (Dual e-Sim) | 1TB', 184990.00, 15.00, 27748.50, 1, 1, 184990.00, '2026-09-16 23:50:34', '2026-09-20 01:30:55'),
(28, 26, 1, 'website', '1787917762Screenshot 2026-08-22 032218.png', '', 490.00, 25.00, 122.50, 1, 0, 490.00, '2026-09-20 01:35:50', '2026-09-20 01:35:50'),
(29, 26, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Silver | SG/MLY/TH (Global - Sim + eSim) | 256GB', 154990.00, 15.00, 23248.50, 1, 0, 154990.00, '2026-09-20 01:35:50', '2026-09-20 01:35:50'),
(30, 27, 1, 'website', '1787917762Screenshot 2026-08-22 032218.png', '', 490.00, 25.00, 122.50, 1, 0, 490.00, '2026-09-20 01:40:48', '2026-09-20 01:40:48'),
(31, 28, 1, 'website', '1787917762Screenshot 2026-08-22 032218.png', '', 490.00, NULL, NULL, 1, 0, 490.00, '2026-09-20 01:55:09', '2026-09-20 01:55:09'),
(32, 29, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, 15.00, 23248.50, 1, 1, 154990.00, '2026-09-22 01:44:16', '2026-09-22 01:45:46'),
(33, 30, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | USA (Dual e-Sim) | 1TB', 184990.00, NULL, NULL, 1, 0, 184990.00, '2026-09-22 01:47:59', '2026-09-22 01:47:59'),
(34, 31, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-24 01:07:09', '2026-09-24 01:07:09'),
(35, 32, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-28 02:51:30', '2026-09-28 02:51:30'),
(36, 33, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-28 02:58:49', '2026-09-28 02:58:49'),
(37, 34, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-30 02:58:47', '2026-09-30 02:58:47'),
(38, 35, 2, 'iPhone 17 Pro Max', '1788078885iPhone-17-Pro-Max-price-in-bangladesh-(3).webp', 'Cosmic Orange | JP/MEA (Dual e-Sim) | 256GB', 154990.00, NULL, NULL, 1, 0, 154990.00, '2026-09-30 03:27:16', '2026-09-30 03:27:16'),
(39, 36, 1, 'website', '1787917762Screenshot 2026-08-22 032218.png', '', 490.00, NULL, NULL, 1, 0, 490.00, '2026-10-01 01:42:27', '2026-10-01 01:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `shop_payment_methods`
--

CREATE TABLE `shop_payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `type` enum('manual','sslcommerz','bkash','nagad') NOT NULL DEFAULT 'manual',
  `instructions` text DEFAULT NULL,
  `config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`config`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_payment_methods`
--

INSERT INTO `shop_payment_methods` (`id`, `name`, `slug`, `type`, `instructions`, `config`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'bkash', 'bkash', 'manual', 'বিকাশ অ্যাপ ব্যবহার করে: বিকাশ অ্যাপটি খুলুন এবং আপনার অ্যাকাউন্টে লগ ইন করুন।\r\nহোম স্ক্রিনে থাকা \'টাকা পাঠান\' (Send Money) আইকনে ট্যাপ করুন।\r\nপ্রাপকের মোবাইল নম্বরটি লিখুন অথবা আপনার ফোনের কন্টাক্ট থেকে বেছে নিন।\r\nআপনি যে পরিমাণ টাকা পাঠাতে চান তা টাইপ করুন এবং এগিয়ে যেতে অ্যারো আইকনে ট্যাপ করুন।\r\nট্রান্সফারটি নিশ্চিত করতে আপনার বিকাশ পিন দিন।\r\n--------------------------------------------------------------------------------------------------------------------------------------------------------------------\r\nইউএসএসডি কোড (*247#) ব্যবহার করে: আপনার মোবাইল ফোনে *247# ডায়াল করুন।\r\n\'টাকা পাঠান\' (Send Money) এর জন্য ১ নির্বাচন করুন। প্রাপকের বিকাশ মোবাইল নম্বরটি লিখুন।\r\nআপনি যে পরিমাণ টাকা পাঠাতে চান তা লিখুন।\r\nলেনদেনের জন্য একটি রেফারেন্স লিখুন (অথবা এটি খালি রাখুন/একটি সংক্ষিপ্ত নোট টাইপ করুন)।\r\nলেনদেনটি শেষ করতে আপনার বিকাশ পিন দিন।', '{\"account_number\":\"01876101515\",\"account_name\":\"Personal\"}', 1, 0, '2026-09-11 02:13:44', '2026-09-11 02:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `photo_id` varchar(191) NOT NULL,
  `heading1` text NOT NULL,
  `heading2` text DEFAULT NULL,
  `typed_text` text DEFAULT NULL,
  `bodyslider` text NOT NULL,
  `button_text` varchar(191) DEFAULT NULL,
  `button_link` varchar(191) DEFAULT NULL,
  `button_text2` varchar(255) DEFAULT NULL,
  `button_link2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `language_id`, `photo_id`, `heading1`, `heading2`, `typed_text`, `bodyslider`, `button_text`, `button_link`, `button_text2`, `button_link2`, `created_at`, `updated_at`) VALUES
(2, 2, '238', 'আমরা স্বল্প বাজেট সাথে মানসম্পন্ন পরিষেবা প্রদান করি', NULL, '[\'Web Design\', \'Social Media\', \'Print Design\', \'Digital Design\', \'Print Design\']', '<p>আমরা বিজ্ঞাপন, ওয়েব ডেভেলপমেন্ট, ওয়ার্ডপ্রেস থিম এবং প্লাগইন, এসইও এবং ডিজিটাল মার্কেটিং, মোবাইল অ্যাপ এবং গ্রাফিক ডিজাইন এবং আরও অনেক কিছুতে পরিষেবা প্রদান করি। আমাদের আইটি পরিষেবা লাইনের মধ্যে রয়েছে এসএপি এবং সমর্থন, এন্টারপ্রাইজ এবং ক্লাউড, সার্ভার ম্যানেজমেন্ট হোস্টিং, ডোমেইন, ইনভেন্টরি ম্যানেজমেন্ট, ব্যবসায়িক উন্নয়ন এবং আরও অনেক কিছু।</p>', 'যোগাযোগ করুন', 'https://httsys.com/contact', 'আমাদের সম্পর্কে', 'https://httsys.com/about-us', '2021-03-13 16:38:22', '2023-03-08 10:38:44'),
(12, 3, '238', 'وكالة تسويق رقمي وتصميم مواقع ويب مخصصة', NULL, '[\'تصميم المواقع؟\', \'وسائل التواصل الاجتماعي؟\', \'تصميم وطباعة؟\', \'تصميم رقمي؟\', \'تصميم وطباعة؟\']', '<p>هل تبحث عن تصميم رقمي؟ iCODE هي وكالة إبداعية تم إنشاؤها لغرض واحد: مساعدتك في تحديد علامتك التجارية. نحن نقدم خدمة لا تشوبها شائبة تجمع بين التصميم الجميل وسهل الاستخدام والبرمجة عالية الجودة.</p>', 'ابقى على تواصل', 'https://icode.lucian.host/contact', NULL, NULL, '2021-04-03 14:44:45', '2022-01-24 15:10:35'),
(13, 3, '239', 'البحث عن التميز الرقمي؟ قل لا زيادة.', NULL, NULL, '<p>نحن نساعد العلامات التجارية المتميزة على تحقيق مستقبلهم من خلال الابتكار ووجهات النظر الإبداعية. نحن ننمي شركتك من خلال الأفكار الداخلية الخاصة ، والتي تم اختبارها وإتقانها على مر السنين.</p>', 'اتصل بنا', 'https://icode.lucian.host/contact', 'عرض محفظتنا', 'https://icode.lucian.host/about-us', '2021-04-10 20:48:03', '2022-01-24 15:09:43'),
(11, 2, '239', 'httsys.com কীভাবে প্রযুক্তি জীবনকে সহজ করে তোলে', NULL, NULL, '<p>এইচটি টেক সিস্টেম হল একটি বিশ্বস্ত বিশ্বব্যাপী সফটওয়্যার ডেভেলপমেন্ট এবং একাধিক ব্যবসায়িক সংস্থা যা মার্কিন যুক্তরাষ্ট্র এবং বাংলাদেশী সংস্থাগুলির মধ্যে যৌথ উদ্যোগে গঠিত। আমরা বাংলাদেশ, যুক্তরাষ্ট্র, সহ বিশ্বের বিভিন্ন স্থান থেকে আমাদের ক্লায়েন্টদের পরিষেবা দিয়ে থাকি।</p>', 'যোগাযোগ করুন', 'https://httsys.com/contact', 'আমাদের সম্পর্কে', 'https://httsys.com/about-us', '2021-04-10 20:50:35', '2023-03-12 18:07:11'),
(9, 1, '238', 'We Provide Quality services with cost efficiencies', NULL, '[\'Web Design\', \'Social Media\', \'Print Design\', \'Digital Design\', \'Print Design\']', '<p>We expertise in AI &amp; Deep Learning, Web development, WordPress Themes &amp; Plugins, Seo &amp; digital marketing, Mobile App and Graphic design and many more. Our IT service line includes SAP and support, Enterprise &amp; Cloud, server management, and Testing &amp; Automation. inventory management, busniess development and more.</p>', 'Get in touch', 'https://httsys.com/contact', 'about us', 'https://httsys.com/about-us', '2021-04-03 14:44:45', '2023-03-08 10:08:42'),
(10, 1, '239', 'httsys.com how technology makes life easier', NULL, NULL, '<p>HT Tech system is a trusted global software development and multiple business agency formed as a joint venture between USA and Bangladeshis entities. We serve our clients from locations around the world including Bangladesh, USA.</p>', 'Get in touch', 'https://httsys.com/contact', 'About us', 'https://httsys.com/about-us', '2021-04-10 20:48:03', '2023-03-12 18:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` tinyint(4) NOT NULL DEFAULT 0,
  `subtitle` text NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `name` text NOT NULL,
  `position` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `language_id`, `subtitle`, `profile_pic`, `title`, `description`, `name`, `position`, `created_at`, `updated_at`) VALUES
(2, 1, 'Clients Opinion', 'https://httsys.com/public/images/media/1633178646testimonial3_1.webp', 'Top quality agency', '<p>It&rsquo;s the perfect solution for our business. <strong>Quin </strong>is the most valuable business resource we have EVER purchased. We&rsquo;ve seen amazing results already.</p>', 'Michael Doe', 'Envato volunteer', '2021-03-13 19:24:51', '2023-03-06 19:33:02'),
(3, 1, 'Clients Opinion', 'https://httsys.com/public/images/media/1633178646testimonial2_1.webp', 'Professional team', '<p>It&rsquo;s the perfect solution for our business. Niva is the most valuable business resource we have EVER purchased. We&rsquo;ve seen amazing results already.</p>', 'Felix Doe', 'Scoro programmer', '2021-03-13 19:25:31', '2023-03-06 19:32:49'),
(4, 1, 'Clients Opinion', 'https://httsys.com/public/images/media/1633178648testimonial1_1.webp', 'Absolutely awesome', '<p>It&rsquo;s the perfect solution for our business. <strong>Quin </strong>is the most valuable business resource we have EVER purchased. We&rsquo;ve seen amazing results already.</p>', 'Lucian Doe', 'Sweet Themes programmer', '2021-03-13 19:26:20', '2023-03-06 19:32:35'),
(8, 2, 'Opinião dos clientes\r\n', 'https://httsys.com/public/images/media/1633178646testimonial3_1.webp', 'Agência de alta qualidade', '<p>আমাদের ব্যবসার জন্য নিখুঁত সমাধান। আমরা কখনও ক্রয় করেছি সবচেয়ে মূল্যবান ব্যবসা সম্পদ. আমরা ইতিমধ্যে আশ্চর্যজনক ফলাফল দেখেছি।</p>', 'মাইকেল ডো', 'ডিজাইনার', '2021-03-13 19:24:51', '2023-03-12 19:27:56'),
(9, 2, 'Opinião dos clientes\r\n', 'https://httsys.com/public/images/media/1633178646testimonial2_1.webp', 'Equipe profissional', '<p>আপনার ব্যবসার জন্য নিখুঁত সমাধান। নিভা হল সবচেয়ে মূল্যবান ব্যবসায়িক সম্পদ যা আমরা কখনও কিনেছি। ইতিমধ্যেই আশ্চর্যজনক ফলাফল দেখা যাবে</p>', 'ফেলিক্স ডো', 'স্কোরো প্রোগ্রামার', '2021-03-13 19:25:31', '2023-03-12 19:24:52'),
(10, 2, 'Opinião dos clientes\r\n', 'https://httsys.com/public/images/media/1633178648testimonial1_1.webp', 'Absolutamente incrível', '<p>এটি আমাদের ব্যবসার জন্য নিখুঁত সমাধান। HT Tech সিস্টেম হল সবচেয়ে মূল্যবান ব্যবসায়িক সম্পদ যা আমরা কখনও কিনেছি। আমরা ইতিমধ্যে আশ্চর্যজনক ফলাফল দেখেছি।</p>', 'লুসিয়ান ডো', 'থিম প্রোগ্রামার', '2021-03-13 19:26:20', '2023-03-07 14:49:17'),
(12, 3, 'رأي العملاء', 'https://icode.lucian.host/public/images/media/1633178646testimonial3_1.webp', 'وكالة عالية الجودة', '<p> إنه الحل الأمثل لأعمالنا. <strong> Quin </strong> هو المورد التجاري الأكثر قيمة الذي اشتريناه على الإطلاق. لقد رأينا نتائج مذهلة بالفعل. </ p>', 'Michael Doe', 'متطوع Envato', '2021-03-13 19:24:51', '2021-03-13 19:24:51'),
(13, 3, 'رأي العملاء', 'https://icode.lucian.host/public/images/media/1633178646testimonial2_1.webp', 'فريق فني', '<p> إنه الحل الأمثل لأعمالنا. <strong> Quin </strong> هو المورد التجاري الأكثر قيمة الذي اشتريناه على الإطلاق. لقد رأينا نتائج مذهلة بالفعل. </ p>', 'Felix Doe', 'برامج النتيجة', '2021-03-13 19:25:31', '2021-03-13 19:25:31'),
(14, 3, 'رأي العملاء', 'https://icode.lucian.host/public/images/media/1633178648testimonial1_1.webp', 'رائع بكل تأكيد', '<p> إنه الحل الأمثل لأعمالنا. <strong> Quin </strong> هو المورد التجاري الأكثر قيمة الذي اشتريناه على الإطلاق. لقد رأينا نتائج مذهلة بالفعل. </ p>', 'Lucian Ionut', 'مبرمج ثيمات حلوة', '2021-03-13 19:26:20', '2021-03-13 19:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 3,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_code` varchar(10) DEFAULT NULL,
  `verification_code_expires_at` timestamp NULL DEFAULT NULL,
  `verification_sent_at` timestamp NULL DEFAULT NULL,
  `verification_resend_count` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `email_verification_override` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo_id` varchar(191) DEFAULT NULL,
  `fb_id` varchar(191) DEFAULT NULL,
  `points` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role_id`, `is_active`, `email`, `email_verified_at`, `verification_code`, `verification_code_expires_at`, `verification_sent_at`, `verification_resend_count`, `email_verification_override`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `address`, `city`, `phone`, `note`, `last_login_at`, `last_login_ip`, `created_at`, `updated_at`, `photo_id`, `fb_id`, `points`) VALUES
(1, 'super_admin_httsys', 1, 1, 'httechsystem@gmail.com', '2026-08-21 20:29:13', NULL, NULL, NULL, 0, 0, '$2y$10$EtZylBHKifbvw6zlDDlpiuBT12/TuK5Qy2FSioTNt7x7B3ZzEd0OK', NULL, NULL, 'FRiuboshjrqEwvdCrMuwaLy20xaXfiiW27rKfxgGq47xOQ94R20haK5ksJJ7', NULL, NULL, '4781 Valley Lane, Austin, Texas, United States America.', 'Austin', '+8801876101515', NULL, '2026-08-22 09:04:56', '103.117.193.226', '2021-03-13 15:29:44', '2026-08-22 09:04:56', '247', '3371932529579633', 0),
(14, 'abc', 4, 1, 'abc@httsys.com', NULL, '323366', '2026-08-26 14:37:01', '2026-08-26 14:27:01', 0, 1, '$2y$10$wk4ykGG81lTBUfrZ1kZzs.01xzLIjZv3SOxX/NCV3WKlSfHxDqK5C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+8801712345678', NULL, '2026-10-04 01:41:16', '103.117.193.227', '2026-08-20 20:53:17', '2026-10-04 01:41:16', NULL, NULL, 102),
(16, 'earn stationme1', 3, 1, 'earnstationme1@gmail.com', NULL, '791295', '2026-08-21 10:31:39', '2026-08-21 10:21:39', 3, 1, '$2y$10$z.G1sx0mzYXU9RrcKBZdW.STy4wArhIsDY8LeWBiSvEMgIVJxvV.K', NULL, NULL, '9qiHY7JkraZblPf7DtEXln4dzKJu40WgijMvl7K5MKj2wywtzLF4zLCMX23v', NULL, NULL, 'Wasa, S Khulshi Rd, Chattogram 4000', 'Chittagong', '+8801712345678', NULL, '2026-10-04 01:40:49', '103.117.193.227', '2026-08-21 09:54:20', '2026-10-04 01:40:49', '279', NULL, 120),
(17, 'Sojeeb', 1, 1, 'emailsojeeb@gmail.com', '2026-08-21 11:18:23', NULL, NULL, NULL, 0, 0, '$2y$10$l4n6H48uBaBU1Na8mptBdeIiOpnzI7aIP7yIA9wG35JBLEgZBemN6', NULL, NULL, NULL, NULL, NULL, 'Enaya Mansion, 2nd floor, Holding-1610/5, Kather Pool Road, Race Cource, kotwali thana, Cumilla\r\nGM-23.471980,91.168761', 'Comilla', '+8801876101515', NULL, '2026-10-04 01:33:23', '103.117.193.227', '2026-08-21 11:17:24', '2026-10-04 01:33:23', '280', NULL, 22),
(18, 'Walking Customer', 3, 1, 'walking-customer@pos.local', '2026-09-16 01:16:37', NULL, NULL, NULL, 0, 1, '$2y$10$2Mdpk8I6Jt568PsRTJMaTuxQYIYc.aWY7ecgg8Nhh/3dKqwWJjhfC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-16 01:16:37', '2026-09-16 01:16:37', NULL, NULL, 0),
(19, 'Sonia', 3, 1, 'mrssoniaakther@gmail.com', '2026-09-22 20:35:14', NULL, NULL, NULL, 0, 0, '$2y$10$flQ.drR4CQepavJeG1dCUejdQ0aTUrCLS6A6Ysq2xYrtgKwrl156K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+8801876101510', NULL, '2026-09-22 20:35:19', '103.117.193.227', '2026-09-22 20:34:46', '2026-09-22 20:42:41', NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `created_at`, `updated_at`) VALUES
(1, 16, 205.00, '2026-09-22 03:31:14', '2026-10-01 02:26:15'),
(2, 17, 1050.00, '2026-09-22 03:54:29', '2026-09-28 01:46:41'),
(3, 19, 0.00, '2026-09-22 20:35:20', '2026-09-22 20:35:20'),
(4, 14, 120.00, '2026-10-04 01:03:20', '2026-10-04 01:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_topup_requests`
--

CREATE TABLE `wallet_topup_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_reference` varchar(191) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_topup_requests`
--

INSERT INTO `wallet_topup_requests` (`id`, `user_id`, `amount`, `payment_method_id`, `payment_reference`, `status`, `admin_note`, `reviewed_by`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(1, 17, 1000.00, 1, 'KI47SF64L54', 'approved', NULL, 1, '2026-09-28 01:46:41', '2026-09-28 01:12:43', '2026-09-28 01:46:41'),
(2, 14, 50.00, 1, 'K0FTU3I02', 'pending', NULL, NULL, NULL, '2026-10-04 01:10:47', '2026-10-04 01:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('credit','debit') NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `balance_after` decimal(15,2) NOT NULL,
  `source` varchar(60) NOT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `wallet_id`, `type`, `amount`, `balance_after`, `source`, `source_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'credit', 50.00, 50.00, 'points_conversion', NULL, '50 points converted to wallet balance', '2026-09-28 01:14:13', '2026-09-28 01:14:13'),
(2, 1, 'credit', 245.00, 245.00, 'escrow_release', 1, 'Escrow release for currency_exchange #3', '2026-09-28 01:15:04', '2026-09-28 01:15:04'),
(3, 1, 'credit', 110.00, 355.00, 'points_conversion', NULL, '110 points converted to wallet balance', '2026-09-28 01:45:09', '2026-09-28 01:45:09'),
(4, 2, 'credit', 1000.00, 1050.00, 'topup', 1, 'Wallet top-up via bkash', '2026-09-28 01:46:41', '2026-09-28 01:46:41'),
(5, 1, 'debit', 150.00, 205.00, 'withdrawal', 1, 'Withdrawal via bkash', '2026-10-01 02:26:15', '2026-10-01 02:26:15'),
(6, 4, 'credit', 120.00, 120.00, 'points_conversion', NULL, '120 points converted to wallet balance', '2026-10-04 01:11:09', '2026-10-04 01:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_requests`
--

CREATE TABLE `withdrawal_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `method` varchar(60) NOT NULL,
  `account_details` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawal_requests`
--

INSERT INTO `withdrawal_requests` (`id`, `user_id`, `amount`, `method`, `account_details`, `status`, `admin_note`, `reviewed_by`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(1, 16, 150.00, 'bkash', '01777770762', 'approved', NULL, 1, '2026-10-01 02:26:15', '2026-09-28 01:45:56', '2026-10-01 02:26:15'),
(2, 14, 100.00, 'bkash', '015123456678', 'pending', NULL, NULL, NULL, '2026-10-04 01:11:49', '2026-10-04 01:11:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_settings`
--
ALTER TABLE `about_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `ad_zones`
--
ALTER TABLE `ad_zones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ad_zones_key_unique` (`key`);

--
-- Indexes for table `blog_settings`
--
ALTER TABLE `blog_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_index` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_replies_comment_id_index` (`comment_id`);

--
-- Indexes for table `contact_settings`
--
ALTER TABLE `contact_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_code_unique` (`code`);

--
-- Indexes for table `currency_listings`
--
ALTER TABLE `currency_listings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currency_listings_user_id_foreign` (`user_id`),
  ADD KEY `currency_listings_currency_status_index` (`currency`,`status`);

--
-- Indexes for table `currency_orders`
--
ALTER TABLE `currency_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currency_orders_listing_id_foreign` (`listing_id`),
  ADD KEY `currency_orders_buyer_id_foreign` (`buyer_id`),
  ADD KEY `currency_orders_seller_id_foreign` (`seller_id`),
  ADD KEY `currency_orders_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `currency_orders_escrow_hold_id_foreign` (`escrow_hold_id`),
  ADD KEY `currency_orders_status_index` (`status`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donations_reference_unique` (`reference`),
  ADD KEY `donations_fund_id_status_index` (`fund_id`,`status`),
  ADD KEY `donations_donor_mobile_index` (`donor_mobile`),
  ADD KEY `donations_donor_email_index` (`donor_email`);

--
-- Indexes for table `escrow_holds`
--
ALTER TABLE `escrow_holds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `escrow_holds_payer_id_foreign` (`payer_id`),
  ADD KEY `escrow_holds_payee_id_foreign` (`payee_id`),
  ADD KEY `escrow_holds_reviewed_by_foreign` (`reviewed_by`),
  ADD KEY `escrow_holds_listing_type_listing_id_index` (`listing_type`,`listing_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fee_settings`
--
ALTER TABLE `fee_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fee_settings_service_type_unique` (`service_type`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `funds_slug_unique` (`slug`);

--
-- Indexes for table `game_ads`
--
ALTER TABLE `game_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_plays`
--
ALTER TABLE `game_plays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_plays_user_game_created_idx` (`user_id`,`game_key`,`created_at`);

--
-- Indexes for table `game_settings`
--
ALTER TABLE `game_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `game_settings_game_key_unique` (`game_key`);

--
-- Indexes for table `header_footer_settings`
--
ALTER TABLE `header_footer_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_sections`
--
ALTER TABLE `home_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `home_sections_key_unique` (`key`);

--
-- Indexes for table `home_settings`
--
ALTER TABLE `home_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketplace_bids`
--
ALTER TABLE `marketplace_bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marketplace_bids_user_id_foreign` (`user_id`),
  ADD KEY `marketplace_bids_listing_id_amount_index` (`listing_id`,`amount`);

--
-- Indexes for table `marketplace_listings`
--
ALTER TABLE `marketplace_listings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marketplace_listings_user_id_foreign` (`user_id`),
  ADD KEY `marketplace_listings_listing_type_status_index` (`listing_type`,`status`);

--
-- Indexes for table `marketplace_orders`
--
ALTER TABLE `marketplace_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marketplace_orders_listing_id_foreign` (`listing_id`),
  ADD KEY `marketplace_orders_buyer_id_foreign` (`buyer_id`),
  ADD KEY `marketplace_orders_seller_id_foreign` (`seller_id`),
  ADD KEY `marketplace_orders_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `marketplace_orders_escrow_hold_id_foreign` (`escrow_hold_id`),
  ADD KEY `marketplace_orders_status_index` (`status`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_order_unique` (`order`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_user_id_index` (`user_id`);

--
-- Indexes for table `notification_settings`
--
ALTER TABLE `notification_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_returns`
--
ALTER TABLE `order_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_returns_order_id_foreign` (`order_id`),
  ADD KEY `order_returns_user_id_foreign` (`user_id`),
  ADD KEY `order_returns_reviewed_by_foreign` (`reviewed_by`);

--
-- Indexes for table `order_return_items`
--
ALTER TABLE `order_return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_return_items_return_id_foreign` (`return_id`),
  ADD KEY `order_return_items_order_item_id_foreign` (`order_item_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_user_id_index` (`user_id`),
  ADD KEY `pages_photo_id_index` (`photo_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_methods_slug_unique` (`slug`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photos_share_token_unique` (`share_token`);

--
-- Indexes for table `pickup_locations`
--
ALTER TABLE `pickup_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio_settings`
--
ALTER TABLE `portfolio_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_index` (`user_id`),
  ADD KEY `posts_category_id_index` (`category_id`),
  ADD KEY `posts_photo_id_index` (`photo_id`);

--
-- Indexes for table `pos_refunds`
--
ALTER TABLE `pos_refunds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pos_refunds_refund_number_unique` (`refund_number`),
  ADD KEY `pos_refunds_order_id_foreign` (`order_id`),
  ADD KEY `pos_refunds_processed_by_foreign` (`processed_by`);

--
-- Indexes for table `pos_refund_items`
--
ALTER TABLE `pos_refund_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pos_refund_items_refund_id_foreign` (`refund_id`),
  ADD KEY `pos_refund_items_order_item_id_foreign` (`order_item_id`);

--
-- Indexes for table `pricings`
--
ALTER TABLE `pricings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing_settings`
--
ALTER TABLE `pricing_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_slug_unique` (`slug`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variant_groups`
--
ALTER TABLE `product_variant_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_groups_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variant_options`
--
ALTER TABLE `product_variant_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_options_product_variant_group_id_foreign` (`product_variant_group_id`);

--
-- Indexes for table `profile_update_requests`
--
ALTER TABLE `profile_update_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_update_requests_user_id_foreign` (`user_id`),
  ADD KEY `profile_update_requests_reviewed_by_foreign` (`reviewed_by`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_user_id_index` (`user_id`),
  ADD KEY `projects_project_category_id_index` (`project_category_id`),
  ADD KEY `projects_photo_id_index` (`photo_id`);

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_permissions_role_id_permission_unique` (`role_id`,`permission`),
  ADD KEY `role_permissions_role_id_index` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_orders`
--
ALTER TABLE `shop_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shop_orders_order_number_unique` (`order_number`),
  ADD UNIQUE KEY `shop_orders_offline_id_unique` (`offline_id`),
  ADD KEY `shop_orders_user_id_foreign` (`user_id`),
  ADD KEY `shop_orders_address_id_foreign` (`address_id`),
  ADD KEY `shop_orders_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `shop_orders_pickup_location_id_foreign` (`pickup_location_id`),
  ADD KEY `shop_orders_served_by_foreign` (`served_by`);

--
-- Indexes for table `shop_order_items`
--
ALTER TABLE `shop_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_order_items_order_id_foreign` (`order_id`),
  ADD KEY `shop_order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `shop_payment_methods`
--
ALTER TABLE `shop_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shop_payment_methods_slug_unique` (`slug`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_index` (`role_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallets_user_id_unique` (`user_id`);

--
-- Indexes for table `wallet_topup_requests`
--
ALTER TABLE `wallet_topup_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_topup_requests_user_id_foreign` (`user_id`),
  ADD KEY `wallet_topup_requests_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `wallet_topup_requests_reviewed_by_foreign` (`reviewed_by`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_transactions_wallet_id_created_at_index` (`wallet_id`,`created_at`);

--
-- Indexes for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrawal_requests_user_id_foreign` (`user_id`),
  ADD KEY `withdrawal_requests_reviewed_by_foreign` (`reviewed_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_settings`
--
ALTER TABLE `about_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ad_zones`
--
ALTER TABLE `ad_zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `blog_settings`
--
ALTER TABLE `blog_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_settings`
--
ALTER TABLE `contact_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `currency_listings`
--
ALTER TABLE `currency_listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currency_orders`
--
ALTER TABLE `currency_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `escrow_holds`
--
ALTER TABLE `escrow_holds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_settings`
--
ALTER TABLE `fee_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `game_ads`
--
ALTER TABLE `game_ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `game_plays`
--
ALTER TABLE `game_plays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `game_settings`
--
ALTER TABLE `game_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `header_footer_settings`
--
ALTER TABLE `header_footer_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `home_sections`
--
ALTER TABLE `home_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `home_settings`
--
ALTER TABLE `home_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `marketplace_bids`
--
ALTER TABLE `marketplace_bids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `marketplace_listings`
--
ALTER TABLE `marketplace_listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `marketplace_orders`
--
ALTER TABLE `marketplace_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `notification_settings`
--
ALTER TABLE `notification_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_returns`
--
ALTER TABLE `order_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_return_items`
--
ALTER TABLE `order_return_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `pickup_locations`
--
ALTER TABLE `pickup_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `portfolio_settings`
--
ALTER TABLE `portfolio_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pos_refunds`
--
ALTER TABLE `pos_refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pos_refund_items`
--
ALTER TABLE `pos_refund_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pricings`
--
ALTER TABLE `pricings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pricing_settings`
--
ALTER TABLE `pricing_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_variant_groups`
--
ALTER TABLE `product_variant_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `product_variant_options`
--
ALTER TABLE `product_variant_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `profile_update_requests`
--
ALTER TABLE `profile_update_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shop_orders`
--
ALTER TABLE `shop_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `shop_order_items`
--
ALTER TABLE `shop_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `shop_payment_methods`
--
ALTER TABLE `shop_payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wallet_topup_requests`
--
ALTER TABLE `wallet_topup_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `currency_listings`
--
ALTER TABLE `currency_listings`
  ADD CONSTRAINT `currency_listings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `currency_orders`
--
ALTER TABLE `currency_orders`
  ADD CONSTRAINT `currency_orders_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `currency_orders_escrow_hold_id_foreign` FOREIGN KEY (`escrow_hold_id`) REFERENCES `escrow_holds` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `currency_orders_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `currency_listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `currency_orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `shop_payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `currency_orders_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `escrow_holds`
--
ALTER TABLE `escrow_holds`
  ADD CONSTRAINT `escrow_holds_payee_id_foreign` FOREIGN KEY (`payee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `escrow_holds_payer_id_foreign` FOREIGN KEY (`payer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `escrow_holds_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `marketplace_bids`
--
ALTER TABLE `marketplace_bids`
  ADD CONSTRAINT `marketplace_bids_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `marketplace_listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marketplace_bids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marketplace_listings`
--
ALTER TABLE `marketplace_listings`
  ADD CONSTRAINT `marketplace_listings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marketplace_orders`
--
ALTER TABLE `marketplace_orders`
  ADD CONSTRAINT `marketplace_orders_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marketplace_orders_escrow_hold_id_foreign` FOREIGN KEY (`escrow_hold_id`) REFERENCES `escrow_holds` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `marketplace_orders_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `marketplace_listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marketplace_orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `shop_payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `marketplace_orders_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_returns`
--
ALTER TABLE `order_returns`
  ADD CONSTRAINT `order_returns_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `shop_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_returns_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_returns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_return_items`
--
ALTER TABLE `order_return_items`
  ADD CONSTRAINT `order_return_items_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `shop_order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_return_items_return_id_foreign` FOREIGN KEY (`return_id`) REFERENCES `order_returns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pos_refunds`
--
ALTER TABLE `pos_refunds`
  ADD CONSTRAINT `pos_refunds_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `shop_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pos_refunds_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pos_refund_items`
--
ALTER TABLE `pos_refund_items`
  ADD CONSTRAINT `pos_refund_items_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `shop_order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pos_refund_items_refund_id_foreign` FOREIGN KEY (`refund_id`) REFERENCES `pos_refunds` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variant_groups`
--
ALTER TABLE `product_variant_groups`
  ADD CONSTRAINT `product_variant_groups_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variant_options`
--
ALTER TABLE `product_variant_options`
  ADD CONSTRAINT `product_variant_options_product_variant_group_id_foreign` FOREIGN KEY (`product_variant_group_id`) REFERENCES `product_variant_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profile_update_requests`
--
ALTER TABLE `profile_update_requests`
  ADD CONSTRAINT `profile_update_requests_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `profile_update_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_orders`
--
ALTER TABLE `shop_orders`
  ADD CONSTRAINT `shop_orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shop_orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `shop_payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shop_orders_pickup_location_id_foreign` FOREIGN KEY (`pickup_location_id`) REFERENCES `pickup_locations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shop_orders_served_by_foreign` FOREIGN KEY (`served_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shop_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_order_items`
--
ALTER TABLE `shop_order_items`
  ADD CONSTRAINT `shop_order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `shop_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shop_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_topup_requests`
--
ALTER TABLE `wallet_topup_requests`
  ADD CONSTRAINT `wallet_topup_requests_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `shop_payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `wallet_topup_requests_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `wallet_topup_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  ADD CONSTRAINT `withdrawal_requests_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `withdrawal_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
