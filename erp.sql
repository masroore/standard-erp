-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2021 at 05:51 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `title_ar`, `title_en`, `phone`, `email`, `location`, `created_at`, `updated_at`) VALUES
(1, 'الفرع الرئيسي', 'Main Branch', '01157809060', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buy_ordered_supplies`
--

CREATE TABLE `buy_ordered_supplies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `start_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `total_qty` double(15,3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buy_ordered_supply_details`
--

CREATE TABLE `buy_ordered_supply_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordered_supply_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `purchase_unit_id` bigint(20) DEFAULT NULL,
  `net_unit_cost` double(15,3) DEFAULT NULL,
  `qunatity` int(11) NOT NULL,
  `unit_price` double(15,3) NOT NULL,
  `tax_rate` double(15,3) NOT NULL,
  `tax` double(15,3) NOT NULL,
  `discount` double(15,3) NOT NULL,
  `total` double(15,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buy_purchase_invoices`
--

CREATE TABLE `buy_purchase_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `money_id` bigint(20) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `total_qty` double(15,3) NOT NULL,
  `order_tax_rate` double(15,3) NOT NULL,
  `order_tax` double(15,3) NOT NULL,
  `shipping_cost` double(15,3) NOT NULL,
  `total_cost` double(15,3) NOT NULL,
  `total_discount` double(15,3) NOT NULL DEFAULT 0.000,
  `total_tax` double(15,3) NOT NULL DEFAULT 0.000,
  `paid_amount` double(15,3) NOT NULL DEFAULT 0.000,
  `grand_total` double(15,3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_paid` tinyint(4) NOT NULL,
  `is_received` tinyint(4) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buy_purchase_invoice_details`
--

CREATE TABLE `buy_purchase_invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buy_invoice_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `purchase_unit_id` bigint(20) DEFAULT NULL,
  `net_unit_cost` double(15,3) DEFAULT NULL,
  `qunatity` int(11) NOT NULL,
  `unit_price` double(15,3) NOT NULL,
  `tax_rate` double(15,3) NOT NULL,
  `tax` double(15,3) NOT NULL,
  `discount` double(15,3) NOT NULL,
  `total` double(15,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buy_purchase_orders`
--

CREATE TABLE `buy_purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `total_qty` double(15,3) NOT NULL,
  `total_cost` double(15,3) NOT NULL,
  `grand_total` double(15,3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buy_purchase_order_details`
--

CREATE TABLE `buy_purchase_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `purchase_unit_id` bigint(20) DEFAULT NULL,
  `net_unit_cost` double(15,3) DEFAULT NULL,
  `qunatity` int(11) NOT NULL,
  `unit_price` double(15,3) NOT NULL,
  `total` double(15,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buy_receives`
--

CREATE TABLE `buy_receives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_invoice_id` bigint(20) NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `total_qty` double(15,3) NOT NULL,
  `order_tax_rate` double(15,3) NOT NULL,
  `order_tax` double(15,3) NOT NULL,
  `shipping_cost` double(15,3) NOT NULL,
  `total_cost` double(15,3) NOT NULL,
  `total_discount` double(15,3) NOT NULL DEFAULT 0.000,
  `total_tax` double(15,3) NOT NULL DEFAULT 0.000,
  `paid_amount` double(15,3) NOT NULL DEFAULT 0.000,
  `grand_total` double(15,3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buy_receive_details`
--

CREATE TABLE `buy_receive_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receive_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `purchase_unit_id` bigint(20) DEFAULT NULL,
  `net_unit_cost` double(15,3) DEFAULT NULL,
  `qunatity` int(11) NOT NULL,
  `unit_price` double(15,3) NOT NULL,
  `tax_rate` double(15,3) NOT NULL,
  `tax` double(15,3) NOT NULL,
  `discount` double(15,3) NOT NULL,
  `total` double(15,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buy_supplier_quotations`
--

CREATE TABLE `buy_supplier_quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `start_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `total_qty` double(15,3) NOT NULL,
  `order_tax_rate` double(15,3) NOT NULL,
  `order_tax` double(15,3) NOT NULL,
  `shipping_cost` double(15,3) NOT NULL,
  `total_cost` double(15,3) NOT NULL,
  `total_discount` double(15,3) NOT NULL DEFAULT 0.000,
  `total_tax` double(15,3) NOT NULL DEFAULT 0.000,
  `grand_total` double(15,3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buy_supplier_quotation_details`
--

CREATE TABLE `buy_supplier_quotation_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buy_quotation_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `purchase_unit_id` bigint(20) DEFAULT NULL,
  `net_unit_cost` double(15,3) DEFAULT NULL,
  `qunatity` int(11) NOT NULL,
  `unit_price` double(15,3) NOT NULL,
  `tax_rate` double(15,3) NOT NULL,
  `tax` double(15,3) NOT NULL,
  `discount` double(15,3) NOT NULL,
  `total` double(15,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `supplier_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `tax_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_file_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` double(8,2) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fin_accounts`
--

CREATE TABLE `fin_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_amount` double(15,3) NOT NULL DEFAULT 0.000,
  `parent_id` bigint(20) DEFAULT 0,
  `level` tinyint(4) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fin_accounts`
--

INSERT INTO `fin_accounts` (`id`, `cat_id`, `title_ar`, `title_en`, `start_amount`, `parent_id`, `level`, `description`, `created_at`, `updated_at`) VALUES
(7, 1, 'الاصول', 'Assets', 0.000, 0, 1, 'Assets', '2021-10-23 10:55:00', '2021-10-23 10:55:00'),
(8, 2, 'الخصوم', 'Liabilities', 0.000, 0, 1, 'Liabilities', '2021-10-23 10:55:43', '2021-10-23 10:55:43'),
(9, 3, 'الايرادات', 'Income', 0.000, 0, 1, 'Income', '2021-10-23 10:56:14', '2021-10-23 10:56:14'),
(10, 4, 'المصروفات', 'Expenses', 0.000, 0, 1, 'Expenses', '2021-10-23 10:56:43', '2021-10-23 10:56:43'),
(11, 1, 'اصول طويلة الاجل', 'long term assets', 0.000, 7, 2, 'long term assets', '2021-10-23 10:57:55', '2021-10-23 10:57:55'),
(12, 1, 'اصول ثابته', 'Fixed Assets', 0.000, 11, 3, 'Fixed Assets', '2021-10-23 10:58:44', '2021-10-23 10:58:44'),
(13, 1, 'الاراضي', 'Land', 0.000, 12, 4, 'Land', '2021-10-23 10:59:17', '2021-10-23 10:59:17'),
(14, 1, 'اصول قصيرة الاجل', 'short term assets', 0.000, 7, 2, 'short term assets', '2021-10-24 06:07:31', '2021-10-24 06:07:31'),
(15, 1, 'بضاعة', 'goods', 0.000, 14, 3, '00000', '2021-10-24 06:14:11', '2021-10-24 06:14:11'),
(16, 1, 'test', 'Facebook adds', 0.000, 12, 4, '00000', '2021-10-24 06:17:42', '2021-10-24 06:17:42'),
(17, 2, 'رأس المال', 'capital', 0.000, 8, 2, '0000', '2021-10-24 06:30:51', '2021-10-24 06:30:51'),
(18, 1, 'test 0', 'test 0', 0.000, 16, 5, '00', '2021-10-24 06:31:19', '2021-10-24 06:31:19'),
(19, 1, 'تجربة', 'Fjhkkkkk', 0.000, 7, 2, 'dfghjk', '2021-10-31 05:22:39', '2021-10-31 05:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `fin_categories`
--

CREATE TABLE `fin_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fin_categories`
--

INSERT INTO `fin_categories` (`id`, `title_ar`, `title_en`, `created_at`, `updated_at`) VALUES
(1, 'الاصول', 'assets', NULL, NULL),
(2, 'الخصوم', 'liabilities', NULL, NULL),
(3, 'الايرادات', 'income', NULL, NULL),
(4, 'المصروفات', 'expenses', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fin_journals`
--

CREATE TABLE `fin_journals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fin_journal_details`
--

CREATE TABLE `fin_journal_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `journal_id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `debit` double(15,3) DEFAULT NULL,
  `credit` double(15,3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fin_settings`
--

CREATE TABLE `fin_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_06_193551_laratrust_setup_tables', 2),
(6, '2021_05_29_211854_create_parent_companies_table', 3),
(7, '2021_05_29_212228_create_customers_table', 3),
(8, '2021_05_30_215133_add_role_to_users_table', 3),
(9, '2021_05_31_041604_add_createted_to_users_table', 3),
(10, '2021_05_31_051844_add_uptatedby_to_users_table', 4),
(11, '2021_05_31_081321_create_customer_groups_table', 4),
(12, '2021_05_31_090226_add_attr_to_customers_table', 4),
(13, '2021_05_31_093820_create_suppliers_table', 4),
(14, '2021_06_01_213609_create_contacts_table', 5),
(15, '2021_06_09_011316_create_departments_table', 6),
(16, '2021_06_09_011416_create_tickets_table', 6),
(17, '2021_06_10_003043_create_ticket_replies_table', 6),
(18, '2021_06_10_003346_create_ticket_attachments_table', 6),
(19, '2021_06_10_005416_create_tickets_users_table', 6),
(20, '2021_06_10_005605_create_moved_tickets_table', 6),
(21, '2021_06_11_081616_add_type_to_ticket_attachments_table', 6),
(22, '2021_06_11_084507_add_link_to_ticket_attachments_table', 6),
(23, '2021_06_15_221342_add_moved_date_to_tickets_table', 6),
(24, '2021_06_15_233338_add_reply_id_to_ticket_attachments_table', 6),
(25, '2021_06_15_233646_add_relation_to_ticket_attachments_table', 6),
(26, '2021_09_19_093059_create_fin_categories_table', 7),
(27, '2021_09_19_093146_create_fin_accounts_table', 7),
(28, '2021_09_19_094636_create_fin_journals_table', 7),
(29, '2021_09_19_094723_create_fin_journal_details_table', 7),
(30, '2021_09_19_094844_create_fin_settings_table', 7),
(31, '2021_09_19_095127_create_sto_categories_table', 7),
(32, '2021_09_19_095156_create_sto_stores_table', 7),
(33, '2021_09_19_095211_create_sto_items_table', 7),
(34, '2021_09_19_095229_create_sto_quantities_table', 7),
(35, '2021_09_19_095306_create_sto_transfares_table', 7),
(36, '2021_09_19_095325_create_sto_units_table', 7),
(37, '2021_09_19_095335_create_sto_brands_table', 7),
(38, '2021_09_25_153040_create_buy_purchase_orders_table', 7),
(39, '2021_09_25_153131_create_buy_purchase_order_details_table', 7),
(40, '2021_09_25_153216_create_buy_supplier_quotations_table', 7),
(41, '2021_09_25_153217_create_buy_supplier_quotation_details_table', 7),
(42, '2021_09_25_153444_create_buy_receives_table', 7),
(43, '2021_09_25_153454_create_buy_receive_details_table', 7),
(44, '2021_09_25_153622_create_buy_ordered_supplies_table', 7),
(45, '2021_09_25_153641_create_buy_ordered_supply_details_table', 7),
(46, '2021_09_25_153905_create_buy_purchase_invoices_table', 7),
(47, '2021_09_25_153906_create_buy_purchase_invoice_details_table', 7),
(48, '2021_09_25_155313_create_sal_quotations_table', 7),
(49, '2021_09_25_155329_create_sal_quotation_details_table', 7),
(50, '2021_09_25_155346_create_sal_invoices_table', 7),
(51, '2021_09_25_155403_create_sal_invoice_details_table', 7),
(52, '2021_09_25_155606_create_ser_services_table', 7),
(53, '2021_09_25_155636_create_ser_service_invoices_table', 7),
(54, '2021_09_25_155704_create_ser_service_invoice_details_table', 7),
(55, '2021_09_27_102750_create_branches_table', 8),
(56, '2021_09_27_103719_add_branch_id_to_sto_brand_table', 9),
(57, '2021_09_27_104304_add_branch_id_to_sto_categories_table', 10),
(58, '2021_09_27_104455_add_branch_id_to_users_table', 11),
(59, '2021_09_29_170419_add_attr_to_sto_stores_table', 12),
(60, '2021_09_30_082953_add_branch_id_to_sto_stores_table', 13),
(61, '2021_10_03_122251_add_attr_to_sto_items_table', 14),
(62, '2021_10_03_131316_add_attrs_to_sto_items_table', 15),
(63, '2021_10_20_141450_add_description_to_fin_accounts_table', 16),
(64, '2021_10_24_083940_add_relation_to_fin_accounts_table', 17),
(65, '2021_10_24_084615_add_relation_to_fin_journals_table', 18),
(66, '2021_10_24_084730_add_relation_to_fin_journal_details_table', 18),
(67, '2021_10_24_085014_add_relation_to_fin_settings_table', 18),
(68, '2021_10_24_092244_add_attr_to_fin_journals_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `moved_tickets`
--

CREATE TABLE `moved_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_companies`
--

CREATE TABLE `parent_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('mohamedahussien7@gmail.com', '$2y$10$xxX2tJ/qgpLKmi5L5oM/k.h0hjBLCB0xOJN.JmRj8NVGOXjPBhNtq', '2021-09-06 16:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sal_invoices`
--

CREATE TABLE `sal_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `money_id` bigint(20) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `total_qty` double(15,3) NOT NULL,
  `order_tax_rate` double(15,3) NOT NULL,
  `order_tax` double(15,3) NOT NULL,
  `shipping_cost` double(15,3) NOT NULL,
  `total_cost` double(15,3) NOT NULL,
  `total_discount` double(15,3) NOT NULL DEFAULT 0.000,
  `total_tax` double(15,3) NOT NULL DEFAULT 0.000,
  `paid_amount` double(15,3) NOT NULL DEFAULT 0.000,
  `grand_total` double(15,3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_paid` tinyint(4) NOT NULL,
  `is_received` tinyint(4) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sal_invoice_details`
--

CREATE TABLE `sal_invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sal_invoice_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `sale_unit_id` bigint(20) DEFAULT NULL,
  `qunatity` int(11) NOT NULL,
  `unit_price` double(15,3) NOT NULL,
  `tax_rate` double(15,3) NOT NULL,
  `tax` double(15,3) NOT NULL,
  `discount` double(15,3) NOT NULL,
  `total` double(15,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sal_quotations`
--

CREATE TABLE `sal_quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `start_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `total_qty` double(15,3) NOT NULL,
  `order_tax_rate` double(15,3) NOT NULL,
  `order_tax` double(15,3) NOT NULL,
  `shipping_cost` double(15,3) NOT NULL,
  `total_cost` double(15,3) NOT NULL,
  `total_discount` double(15,3) NOT NULL DEFAULT 0.000,
  `total_tax` double(15,3) NOT NULL DEFAULT 0.000,
  `grand_total` double(15,3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sal_quotation_details`
--

CREATE TABLE `sal_quotation_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sal_quotation_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `sale_unit_id` bigint(20) DEFAULT NULL,
  `qunatity` int(11) NOT NULL,
  `unit_price` double(15,3) NOT NULL,
  `tax_rate` double(15,3) NOT NULL,
  `tax` double(15,3) NOT NULL,
  `discount` double(15,3) NOT NULL,
  `total` double(15,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ser_services`
--

CREATE TABLE `ser_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price` double(15,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ser_service_invoices`
--

CREATE TABLE `ser_service_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `money_id` bigint(20) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `paid_amount` double(15,3) NOT NULL DEFAULT 0.000,
  `grand_total` double(15,3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_paid` tinyint(4) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ser_service_invoice_details`
--

CREATE TABLE `ser_service_invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ser_invoice_id` bigint(20) NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `qunatity` int(11) NOT NULL,
  `unit_price` double(15,3) NOT NULL,
  `tax_rate` double(15,3) NOT NULL,
  `tax` double(15,3) NOT NULL,
  `discount` double(15,3) NOT NULL,
  `total` double(15,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sto_brands`
--

CREATE TABLE `sto_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sto_brands`
--

INSERT INTO `sto_brands` (`id`, `title_ar`, `title_en`, `branch_id`, `created_at`, `updated_at`) VALUES
(5, 'Voluptatem Ea duis 2020', 'Voluptas cum vel imp 2020', 1, '2021-09-27 07:06:56', '2021-09-30 06:41:27'),
(7, 'pest 20120', 'Facebook adds', 1, '2021-09-27 07:24:26', '2021-09-27 07:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `sto_categories`
--

CREATE TABLE `sto_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT 0,
  `level` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sto_categories`
--

INSERT INTO `sto_categories` (`id`, `title_ar`, `title_en`, `parent_id`, `level`, `created_at`, `updated_at`, `branch_id`) VALUES
(3, 'تصنيف رئيسي', 'main category', 0, 1, '2021-09-27 09:42:39', '2021-09-29 10:29:07', 1),
(4, 'الاقسام الرئسية', 'Main Categories', 0, 1, '2021-09-29 04:49:02', '2021-09-29 04:49:02', 1),
(5, 'قسم فرعي مستوي1', 'sub category level 1', 4, 2, '2021-09-29 04:50:20', '2021-09-29 04:50:20', 1),
(6, 'قسم فرعي مستوي2', 'sub category level 2', 5, 3, '2021-09-29 04:50:44', '2021-09-29 04:50:44', 1),
(7, 'قسم فرعي مستوي 3', 'sub category level 3', 6, 4, '2021-09-29 04:51:15', '2021-09-29 04:51:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sto_items`
--

CREATE TABLE `sto_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` double(15,3) DEFAULT NULL,
  `sale_price` double(15,3) NOT NULL,
  `alert_quantity` int(11) NOT NULL DEFAULT 10,
  `cat_id` bigint(20) DEFAULT NULL,
  `brand_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) NOT NULL DEFAULT 1,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_method` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode_symbology` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_batch` tinyint(4) NOT NULL DEFAULT 0,
  `is_variant` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sto_items`
--

INSERT INTO `sto_items` (`id`, `title_ar`, `title_en`, `barcode`, `cost`, `sale_price`, `alert_quantity`, `cat_id`, `brand_id`, `branch_id`, `code`, `created_by`, `updated_by`, `tax_id`, `tax_method`, `image`, `description`, `barcode_symbology`, `is_batch`, `is_variant`, `created_at`, `updated_at`) VALUES
(2, 'Basil Mcpherson', 'Althea Kennedy', 'Velma Burns', 5470.000, 672.000, 943, 7, 5, 1, 'Althea Porter', 2, 2, 10, 2, '1633335275DsZuPRZcLR.jpg', 'Lorem aliquid commod                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod\r\n                       Lorem aliquid commod', 'EAN8', 0, 0, '2021-10-03 15:03:11', '2021-10-04 06:14:35'),
(6, 'Hanae Mendez', 'Upton Davidson', 'Fulton Golden', 754.000, 323.000, 121, 4, 5, 1, 'Holmes Jefferson', 2, NULL, 14, 2, NULL, 'Quae modi recusandae', 'C39', 0, 0, '2021-10-03 15:33:31', '2021-10-03 15:33:31'),
(7, 'Marvin Simpson', 'Driscoll Valenzuela', 'Lydia Tanner', 81.000, 539.000, 183, 5, 5, 1, 'Bree Calhoun', 2, NULL, 14, 1, NULL, 'Dolore distinctio C', 'C39', 0, 0, '2021-10-03 15:46:20', '2021-10-03 15:46:20'),
(8, 'Iris Stuart', 'Serina Faulkner', 'Quamar Harding', 764.000, 430.000, 974, 4, 5, 1, '58888', 2, NULL, 0, 2, NULL, 'Nobis saepe cupidita', 'UPCE', 0, 0, '2021-10-04 05:22:21', '2021-10-04 05:22:21'),
(9, '20test 52', '52333333333', '3333333333333', 33333.000, 333333333.000, 333333, 3, NULL, 1, '333333333333333', 2, NULL, 0, 1, NULL, NULL, 'C128', 0, 0, '2021-10-04 05:23:17', '2021-10-04 05:23:17'),
(10, 'Martin Montgomery', 'Tashya Deleon', 'Graham Justice', 853.000, 24.000, 131, 3, 5, 1, 'Phoebe Mendez', 2, 2, 14, 2, '1633333754ln7CB7Tkbo.png', 'Et deserunt quia asp', 'EAN13', 0, 0, '2021-10-04 05:40:20', '2021-10-04 05:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `sto_quantities`
--

CREATE TABLE `sto_quantities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sto_stores`
--

CREATE TABLE `sto_stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) NOT NULL DEFAULT 1,
  `user_id` bigint(20) DEFAULT NULL COMMENT 'Storekeeper',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sto_stores`
--

INSERT INTO `sto_stores` (`id`, `title_ar`, `title_en`, `address`, `branch_id`, `user_id`, `phone`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'test', '52', 'الحي الاول مدينة العبور', 1, 2, '01157809060', 1, '2021-09-29 16:26:29', '2021-09-29 16:26:29'),
(2, '20test 52', 'Facebook adds', 'الحي الاول مدينة العبور', 1, 23, '01157809060', 1, '2021-09-29 16:35:28', '2021-09-29 16:35:28'),
(3, 'Quia sit corporis re', 'Amet laboriosam il', 'Et ut adipisicing ea', 1, 26, '+1 (706) 594-2154', 1, '2021-09-29 16:41:47', '2021-09-29 16:41:47'),
(5, 'Voluptatem Ea duis 2020', 'Voluptas cum vel imp 2020', 'Qui quaerat exercita 2020', 1, 30, '+1 (977) 453-5157 2020', 1, '2021-09-30 06:27:26', '2021-09-30 06:44:42'),
(6, 'Eaque numquam qui ac', 'Quis omnis labore oc', 'Ut quas quasi eos v', 1, 23, '+1 (783) 475-7972', 1, '2021-09-30 06:36:12', '2021-09-30 06:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `sto_transfares`
--

CREATE TABLE `sto_transfares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `from_store` bigint(20) NOT NULL,
  `to_store` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sto_units`
--

CREATE TABLE `sto_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_unit` int(11) NOT NULL DEFAULT 0,
  `operator` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_value` double(15,3) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sto_units`
--

INSERT INTO `sto_units` (`id`, `unit_code`, `unit_name`, `base_unit`, `operator`, `operation_value`, `is_active`, `created_at`, `updated_at`) VALUES
(3, '2580000000000000', 'sss20000000000000', 0, NULL, NULL, 1, '2021-09-29 13:02:14', '2021-09-29 13:32:30'),
(4, '25800', 'sss200', 0, NULL, NULL, 1, '2021-09-29 13:17:01', '2021-09-29 13:32:50'),
(5, '1205', 'كرتونة', 0, NULL, NULL, 1, '2021-09-29 14:42:31', '2021-09-29 14:42:31'),
(6, '12056', 'قطعة', 5, '/', 12.000, 1, '2021-09-29 14:43:31', '2021-09-29 14:43:51');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `tax_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_file_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_moved` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => not moved , 1 => moved',
  `move_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => not moved , 1 => internal , 2 => external',
  `move_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `closed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `closed_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `move_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_users`
--

CREATE TABLE `tickets_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachments`
--

CREATE TABLE `ticket_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_replies`
--

CREATE TABLE `ticket_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reply_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `remember_token`, `photo`, `status`, `role_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'super admin', 'super_admin@app.com', NULL, '$2y$10$N7gYpcKM2oKnqM8M7M1mQukSv//8a1DkJNQE7lnNSybQSr1vTGs1S', '01020075711', 'XTwWf2KegHz0OMtylUzZ8kfAkNDLXtDo0xsmbuu3PBtEoNxlEjnBYPuGrQYi', '1631626192nDxFPvNHF8.jpeg', 1, NULL, 0, 0, 17, '2021-09-06 17:21:06', '2021-09-14 14:01:11'),
(23, 'September Castillo', 'kenusab@mailinator.com', NULL, '$2y$10$fWCWa15uK/.GzEj9hyLd0OrOt.JiPUlCjfUCz0eUO/jPOkkKJgdiW', 'Seth Witt', NULL, NULL, 1, NULL, 1, 2, 2, '2021-09-15 09:02:37', '2021-09-22 14:41:06'),
(26, 'Nyssa Tate', 'gifeg@mailinator.com', NULL, '$2y$10$gDzVu9AdJZKyxS./PrUTnuuxM/Kg1doEUobQ3jVQPw4rWsELOYVkS', 'Wynter Kramer', NULL, '1631794577r5XXutkhnF.jpeg', 1, NULL, 1, 2, 2, '2021-09-15 10:01:03', '2021-09-16 10:16:17'),
(27, 'Barclay Torres', 'tajuni@mailinator.com', NULL, '$2y$10$3CRJDA/Poshw3FCHohRMDOUdfPvJ8Wh/XlzBarlzU7uh3kMRQ2Y0e', 'Noble Singleton', NULL, NULL, 1, NULL, 1, 2, NULL, '2021-09-15 10:01:30', '2021-09-15 10:01:30'),
(28, 'Melvin Franco', 'winybob@mailinator.com', NULL, '$2y$10$7jd3cDgMLbntJvENiQzScueaXPbilnvEEh3cg7IwPMJn5xHLI3QNu', 'Oprah Small', NULL, NULL, 1, NULL, 1, 2, NULL, '2021-09-15 10:01:53', '2021-09-15 10:01:53'),
(30, 'Cruz Pena', 'xywoqaf@mailinator.com', NULL, '$2y$10$dS/QfHsKpO6VF4Q2sYs8sOmzaR.W66hSiJ.vAwTxhDOzKnsil9hY.', 'Zahir Snider', NULL, '16317083713FkpAHhNFH.jpg', 1, NULL, 1, 2, 2, '2021-09-15 10:07:51', '2021-09-15 10:19:31'),
(33, 'Shana Ball', 'mepy@mailinator.com', NULL, '$2y$10$Ks7gS.WoCmTn5RqoI2RFKu0Z6UVzuSoMqCPBZnJvQnH/D8whRbxu2', 'Emi Crawford', NULL, '1632328854eSJOirEBiN.jpeg', 1, NULL, 1, 2, NULL, '2021-09-22 14:40:54', '2021-09-22 14:40:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_ordered_supplies`
--
ALTER TABLE `buy_ordered_supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_ordered_supply_details`
--
ALTER TABLE `buy_ordered_supply_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_purchase_invoices`
--
ALTER TABLE `buy_purchase_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_purchase_invoice_details`
--
ALTER TABLE `buy_purchase_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_purchase_orders`
--
ALTER TABLE `buy_purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_purchase_order_details`
--
ALTER TABLE `buy_purchase_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_receives`
--
ALTER TABLE `buy_receives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_receive_details`
--
ALTER TABLE `buy_receive_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_supplier_quotations`
--
ALTER TABLE `buy_supplier_quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_supplier_quotation_details`
--
ALTER TABLE `buy_supplier_quotation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_parent_id_foreign` (`parent_id`),
  ADD KEY `customers_group_id_foreign` (`group_id`);

--
-- Indexes for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fin_accounts`
--
ALTER TABLE `fin_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fin_accounts_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `fin_categories`
--
ALTER TABLE `fin_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fin_journals`
--
ALTER TABLE `fin_journals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fin_journals_user_id_foreign` (`user_id`);

--
-- Indexes for table `fin_journal_details`
--
ALTER TABLE `fin_journal_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fin_journal_details_journal_id_foreign` (`journal_id`),
  ADD KEY `fin_journal_details_account_id_foreign` (`account_id`);

--
-- Indexes for table `fin_settings`
--
ALTER TABLE `fin_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fin_settings_user_id_foreign` (`user_id`),
  ADD KEY `fin_settings_account_id_foreign` (`account_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moved_tickets`
--
ALTER TABLE `moved_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moved_tickets_ticket_id_foreign` (`ticket_id`),
  ADD KEY `moved_tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `parent_companies`
--
ALTER TABLE `parent_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sal_invoices`
--
ALTER TABLE `sal_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sal_invoice_details`
--
ALTER TABLE `sal_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sal_quotations`
--
ALTER TABLE `sal_quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sal_quotation_details`
--
ALTER TABLE `sal_quotation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ser_services`
--
ALTER TABLE `ser_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ser_service_invoices`
--
ALTER TABLE `ser_service_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ser_service_invoice_details`
--
ALTER TABLE `ser_service_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sto_brands`
--
ALTER TABLE `sto_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sto_categories`
--
ALTER TABLE `sto_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sto_items`
--
ALTER TABLE `sto_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sto_quantities`
--
ALTER TABLE `sto_quantities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sto_stores`
--
ALTER TABLE `sto_stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sto_transfares`
--
ALTER TABLE `sto_transfares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sto_units`
--
ALTER TABLE `sto_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_department_id_foreign` (`department_id`),
  ADD KEY `tickets_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `tickets_users`
--
ALTER TABLE `tickets_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_users_ticket_id_foreign` (`ticket_id`),
  ADD KEY `tickets_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_attachments_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_attachments_reply_id_foreign` (`reply_id`);

--
-- Indexes for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_replies_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_replies_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buy_ordered_supplies`
--
ALTER TABLE `buy_ordered_supplies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_ordered_supply_details`
--
ALTER TABLE `buy_ordered_supply_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_purchase_invoices`
--
ALTER TABLE `buy_purchase_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_purchase_invoice_details`
--
ALTER TABLE `buy_purchase_invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_purchase_orders`
--
ALTER TABLE `buy_purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_purchase_order_details`
--
ALTER TABLE `buy_purchase_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_receives`
--
ALTER TABLE `buy_receives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_receive_details`
--
ALTER TABLE `buy_receive_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_supplier_quotations`
--
ALTER TABLE `buy_supplier_quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_supplier_quotation_details`
--
ALTER TABLE `buy_supplier_quotation_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fin_accounts`
--
ALTER TABLE `fin_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `fin_categories`
--
ALTER TABLE `fin_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fin_journals`
--
ALTER TABLE `fin_journals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fin_journal_details`
--
ALTER TABLE `fin_journal_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fin_settings`
--
ALTER TABLE `fin_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `moved_tickets`
--
ALTER TABLE `moved_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent_companies`
--
ALTER TABLE `parent_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sal_invoices`
--
ALTER TABLE `sal_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sal_invoice_details`
--
ALTER TABLE `sal_invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sal_quotations`
--
ALTER TABLE `sal_quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sal_quotation_details`
--
ALTER TABLE `sal_quotation_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ser_services`
--
ALTER TABLE `ser_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ser_service_invoices`
--
ALTER TABLE `ser_service_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ser_service_invoice_details`
--
ALTER TABLE `ser_service_invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sto_brands`
--
ALTER TABLE `sto_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sto_categories`
--
ALTER TABLE `sto_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sto_items`
--
ALTER TABLE `sto_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sto_quantities`
--
ALTER TABLE `sto_quantities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sto_stores`
--
ALTER TABLE `sto_stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sto_transfares`
--
ALTER TABLE `sto_transfares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sto_units`
--
ALTER TABLE `sto_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_users`
--
ALTER TABLE `tickets_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `customer_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `parent_companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fin_accounts`
--
ALTER TABLE `fin_accounts`
  ADD CONSTRAINT `fin_accounts_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `fin_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fin_journals`
--
ALTER TABLE `fin_journals`
  ADD CONSTRAINT `fin_journals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fin_journal_details`
--
ALTER TABLE `fin_journal_details`
  ADD CONSTRAINT `fin_journal_details_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `fin_accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fin_journal_details_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `fin_journals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fin_settings`
--
ALTER TABLE `fin_settings`
  ADD CONSTRAINT `fin_settings_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `fin_accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fin_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `moved_tickets`
--
ALTER TABLE `moved_tickets`
  ADD CONSTRAINT `moved_tickets_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `moved_tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets_users`
--
ALTER TABLE `tickets_users`
  ADD CONSTRAINT `tickets_users_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD CONSTRAINT `ticket_attachments_reply_id_foreign` FOREIGN KEY (`reply_id`) REFERENCES `ticket_replies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_attachments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD CONSTRAINT `ticket_replies_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
