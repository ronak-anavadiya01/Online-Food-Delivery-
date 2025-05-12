-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 09:44 AM
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
-- Database: `food_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(5) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `update_date` date DEFAULT NULL,
  `delete_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `status`, `image`, `create_date`, `update_date`, `delete_date`) VALUES
(1, 'fastfood', 'Fruit', 1, '', '2025-03-25', NULL, NULL),
(207, 'breakfast', 'Breakfast', 1, '', '2024-04-10', NULL, NULL),
(209, '', 'Cold drink', 1, '', '2024-04-10', NULL, NULL),
(210, 'fastfood', 'Vegetables', 1, '', '2024-04-10', NULL, NULL),
(211, '', 'Dairy', 1, '', '2024-04-10', NULL, NULL),
(227, NULL, 'Dried Fruit', 1, '', '2024-04-23', NULL, NULL),
(228, NULL, 'Sweet', 1, '', '2024-04-23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mobile` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`, `mobile`) VALUES
(1, 'ronak', 'ronak@gmail.com', 'i meet me', '2025-04-09 11:12:17', NULL),
(2, 'dhaval', 'dhaval@gmail.com', 'good', '2025-04-12 12:08:41', NULL),
(3, 'dhaval', 'dhaval@gmail.com', 'good', '2025-04-12 12:13:25', ''),
(4, 'dhaval', 'dhaval@gmail.com', 'good', '2025-04-12 12:14:56', ''),
(5, 'dhaval', 'dhaval@gmail.com', 'good', '2025-04-12 12:16:00', ''),
(6, 'azad', 'azad@gmail.com', 'ert', '2025-04-12 12:16:34', '8511202454'),
(7, 'azad', 'azad@gmail.com', 'ert', '2025-04-12 12:18:07', '8511202454'),
(8, 'azad', 'azad@gmail.com', 'ert', '2025-04-12 12:20:02', '8511202454'),
(9, 'admin', 'admin@gmail.com', 'ronak', '2025-04-13 13:25:36', '8511202454'),
(10, 'admin', 'admin@gmail.com', 'ronak', '2025-04-13 14:43:33', '8511202454');

-- --------------------------------------------------------

--
-- Table structure for table `contect`
--

CREATE TABLE `contect` (
  `id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contect`
--

INSERT INTO `contect` (`id`, `name`, `email`, `message`) VALUES
(1, 'Azad', 'azadprajapati158@gmail.com', 'hello'),
(5, 'tony', 'tonyy63158@gmail.com', 'hiiii');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customerjbhbhjbhbv_orders`
--

CREATE TABLE `customerjbhbhjbhbv_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `landmark` varchar(100) DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerjbhbhjbhbv_orders`
--

INSERT INTO `customerjbhbhjbhbv_orders` (`id`, `user_id`, `address_1`, `address_2`, `landmark`, `pincode`, `country`, `state`, `city`, `create_date`, `update_date`, `delete_date`, `address`) VALUES
(1, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'deesa');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status` int(11) DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `weight_type` varchar(20) DEFAULT NULL,
  `status` tinyint(5) DEFAULT NULL,
  `category_name` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `update_date` date DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `user_id`, `category_id`, `name`, `description`, `weight`, `weight_type`, `status`, `category_name`, `user_name`, `create_date`, `update_date`, `delete_date`, `subcategory_id`, `price`, `image`) VALUES
(106, 1, 210, 'Potatoes', 'white potatoes', 5.00, 'kg', 1, '', 'Azad Prajapati', '2024-04-10', NULL, NULL, 14, 90.00, NULL),
(107, 1, 211, 'Mango Juice', 'ice mango', 1.00, 'kg', 1, '', 'Azad Prajapati', '2024-04-10', NULL, NULL, 15, 100.00, NULL),
(116, 1, 207, 'Pasta', 'spicy pasta', 100.00, 'gm', 1, '', 'Azad Prajapati', '2024-04-17', NULL, NULL, NULL, 50.00, NULL),
(125, 1, 209, 'Pepsi', 'strong', 60.00, 'ml', 1, '', 'Azad Prajapati', '2024-04-23', NULL, NULL, NULL, 60.00, NULL),
(127, 1, 227, 'Dates', 'Semi-dry dates', 40.00, 'gm', 1, '', 'Azad Prajapati', '2024-04-23', NULL, NULL, NULL, 0.00, NULL),
(129, 1, 207, 'Vada Pav', 'butter spicy', 35.00, 'gm', 1, '', 'Azad Prajapati', '2024-04-23', NULL, NULL, NULL, 0.00, NULL),
(132, 1, 228, 'Kaju Katli', 'kaju barfi', 1.00, 'kg', 1, '', 'Azad Prajapati', '2024-04-23', NULL, NULL, NULL, 400.00, NULL),
(140, 1, 1, 'Apples', 'fresh apple', 1.00, 'kg', 1, '', 'Azad Prajapati', '2024-04-23', NULL, NULL, NULL, 0.00, NULL),
(144, 1, 1, 'banana', 'gsahdgye', 50.00, 'gm', 1, '', 'Azad Prajapati', '2024-05-11', NULL, NULL, NULL, 0.00, NULL),
(145, 27, 207, 'hjbhvghvjbjb', 'klmnkjnj', 565.00, 'gm', 1, '', 'kiranben', '2025-03-15', NULL, NULL, 15, 0.00, NULL),
(148, 1, 1, 'Mango', 'Fresh and juicy fruits delivered to your doorstep – quality you can trust!', 1.00, 'kg', 1, '', 'Azad Prajapati11', '2025-03-27', NULL, NULL, NULL, 150.00, NULL),
(149, 1, 1, 'Mosambi', 'Fresh and juicy Mosambi (sweet lime) – nature\'s refreshing delight!', 1.00, 'kg', 1, '', 'Azad Prajapati11', '2025-03-27', NULL, NULL, NULL, 110.00, NULL),
(150, 1, 1, 'Pomegranate.', 'Pomegranate: A nutrient-rich superfruit with juicy, ruby-red seeds and a sweet-tart flavor, boosting health and immunity.', 1.00, 'kg', 1, '', 'Azad Prajapati11', '2025-03-27', NULL, NULL, NULL, 70.00, NULL),
(151, 1, 1, 'Pineapple', 'Pineapple: A tropical fruit with a tangy-sweet flavor, rich in vitamin C and perfect for refreshing snacks or drinks.', 1.00, 'kg', 1, '', 'Azad Prajapati11', '2025-03-27', NULL, NULL, NULL, 125.00, NULL),
(152, 1, 1, 'Kiwi', 'Kiwi: A nutrient-packed fruit with a tangy-sweet taste, vibrant green flesh, and loaded with vitamin C and antioxidants.', 1.00, 'kg', 1, '', 'Azad Prajapati11', '2025-03-27', NULL, NULL, NULL, 500.00, NULL),
(153, 1, 207, 'Dabeli', 'Dabeli: A spicy-sweet Indian street food served in a soft bun with delicious toppings.', 1.00, 'kg', 1, '', 'Azad Prajapati11', '2025-03-27', NULL, NULL, NULL, 300.00, NULL),
(154, 1, 207, 'Patra', 'Patra: A savory snack of spiced gram flour rolled in colocasia leaves.', 1.00, 'kg', 1, '', 'Azad Prajapati11', '2025-03-27', NULL, NULL, NULL, 250.00, NULL),
(155, 1, 207, 'Bhagiya', 'Bhagiya: A crispy, deep-fried snack made with spiced gram flour and vegetables.', 1.00, 'kg', 1, '', 'Azad Prajapati11', '2025-03-27', NULL, NULL, NULL, 350.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `food_images`
--

CREATE TABLE `food_images` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_primary` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_images`
--

INSERT INTO `food_images` (`id`, `food_id`, `name`, `is_primary`) VALUES
(34, 106, 'food-16.jpg', NULL),
(36, 107, 'food-23.jpg', NULL),
(48, 116, 'food-63.jpg', NULL),
(57, 125, 'food-69.jpg', NULL),
(59, 127, 'food-73.jpg', NULL),
(61, 129, 'food-75.jpg', NULL),
(64, 132, 'food-78.jpg', NULL),
(70, 140, 'food-86.jpg', NULL),
(75, 145, '', NULL),
(76, 148, 'pexels-julieaagaard-2294471.jpg', NULL),
(77, 149, 'pexels-pixabay-207085.jpg', NULL),
(78, 150, 'pexels-enginakyurt-1435735.jpg', NULL),
(79, 151, 'pexels-thebstudio-947879.jpg', NULL),
(80, 152, 'pexels-pixabay-51312.jpg', NULL),
(81, 153, 'download.jfif', NULL),
(82, 154, 'download (2).jfif', NULL),
(83, 155, 'download (3).jfif', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `food_subcategories`
--

CREATE TABLE `food_subcategories` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_subcategories`
--

INSERT INTO `food_subcategories` (`id`, `food_id`, `name`, `price`, `status`) VALUES
(16, 106, 'Colombo', 120.00, 1),
(17, 106, 'pokharaj', 100.00, 1),
(21, 107, 'Almond Mango Juice', 120.00, 1),
(22, 107, 'Saffron Mango Juice', 140.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `delivery_charge` decimal(10,2) DEFAULT 0.00,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) NOT NULL DEFAULT 'Cash on Delivery',
  `create_date` datetime DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_date` datetime DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `food_name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `phone`, `address_id`, `subtotal`, `delivery_charge`, `total_price`, `order_date`, `payment_method`, `create_date`, `update_date`, `delete_date`, `total`, `status`, `food_name`, `category`, `subcategory`, `quantity`) VALUES
(67, 1, 'deesa', '8855223366', NULL, 0.00, 0.00, 160.00, '2025-03-27 13:59:49', 'Cash on Delivery', '2025-03-27 13:59:49', '2025-03-27 13:59:49', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(68, 1, 'hbjkmnjhvyujknhj', '1122336655', NULL, 0.00, 0.00, 80.00, '2025-03-27 14:12:15', 'Cash on Delivery', '2025-03-27 14:12:15', '2025-03-27 14:12:15', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(69, 1, 'hbjkmnjhvyujknhj', '1122336655', NULL, 0.00, 0.00, 80.00, '2025-03-27 14:13:56', 'Cash on Delivery', '2025-03-27 14:13:56', '2025-03-27 14:13:56', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(70, 1, 'hbjkmnjhvyujknhj', '1122336655', NULL, 0.00, 0.00, 80.00, '2025-03-27 14:15:36', 'Cash on Delivery', '2025-03-27 14:15:36', '2025-03-27 14:15:36', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(71, 1, 'jewfnuewtg0y5i6ojh', '1122336655', NULL, 0.00, 0.00, 2000.00, '2025-03-27 14:17:15', 'Cash on Delivery', '2025-03-27 14:17:15', '2025-04-12 13:16:51', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(72, 1, 'nfkrmflekmfl', '7894561230', NULL, 0.00, 0.00, 40.00, '2025-03-27 14:19:43', 'Cash on Delivery', '2025-03-27 14:19:43', '2025-03-27 14:19:43', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(73, 1, 'knbhjnbm', '8855223366', NULL, 0.00, 0.00, 1600.00, '2025-03-27 16:47:09', 'Cash on Delivery', '2025-03-27 16:47:09', '2025-03-27 16:47:09', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(75, 28, 'deesa', '1234567890', NULL, 0.00, 0.00, 40.00, '2025-03-28 09:30:59', 'Cash on Delivery', '2025-03-28 09:30:59', '2025-03-28 09:30:59', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(76, 28, 'tegv4e ', '1234567890', NULL, 0.00, 0.00, 200.00, '2025-03-28 09:31:51', 'Cash on Delivery', '2025-03-28 09:31:51', '2025-03-28 09:31:51', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(77, 1, 'bbjgbjgjv', '1234567890', NULL, 0.00, 0.00, 80.00, '2025-03-28 10:01:39', 'Cash on Delivery', '2025-03-28 10:01:39', '2025-03-28 10:01:39', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(78, 1, 'gbujgttr', '1231231231', NULL, 0.00, 0.00, 80.00, '2025-03-28 13:34:26', 'Cash on Delivery', '2025-03-28 13:34:26', '2025-03-28 13:34:26', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(79, 1, 'deesa', '1234567890', NULL, 0.00, 0.00, 40.00, '2025-03-28 14:26:00', 'Cash on Delivery', '2025-03-28 14:26:00', '2025-03-28 14:26:00', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(80, 1, 'guygyt', '1234567890', NULL, 0.00, 0.00, 80.00, '2025-03-28 15:50:34', 'Cash on Delivery', '2025-03-28 15:50:34', '2025-03-28 15:50:34', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(81, 1, 'gjtuv', '1231231231', NULL, 0.00, 0.00, 80.00, '2025-03-29 10:36:56', 'Cash on Delivery', '2025-03-29 10:36:56', '2025-03-29 10:36:56', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(82, 1, 'hbgvy', '1231231231', NULL, 0.00, 0.00, 0.00, '2025-04-03 11:29:59', 'Cash on Delivery', '2025-04-03 11:29:59', '2025-04-03 11:29:59', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(83, 1, 'bhjgyh', '1234567890', NULL, 0.00, 0.00, 40.00, '2025-04-03 13:41:02', 'Cash on Delivery', '2025-04-03 13:41:02', '2025-04-03 13:41:02', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(84, 1, 'f evww 4', '1231231231', NULL, 0.00, 0.00, 400.00, '2025-04-03 16:23:38', 'Cash on Delivery', '2025-04-03 16:23:38', '2025-04-03 16:23:38', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(85, 1, 'patan', '8511202454', NULL, 0.00, 0.00, 400.00, '2025-04-03 16:28:17', 'Cash on Delivery', '2025-04-03 16:28:17', '2025-04-03 16:28:17', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(86, 1, 'SWCEV', 'FRFFQ', NULL, 0.00, 0.00, 100.00, '2025-04-03 16:34:36', 'Cash on Delivery', '2025-04-03 16:34:36', '2025-04-12 13:06:26', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(87, 1, 'gvdbe5bw', '1231231231', NULL, 0.00, 0.00, 160.00, '2025-04-03 16:56:46', 'Cash on Delivery', '2025-04-03 16:56:46', '2025-04-12 13:16:12', NULL, 0.00, 'cancelled', NULL, NULL, NULL, NULL),
(89, 1, 'wejj57', '8511202454', NULL, 0.00, 0.00, 320.00, '2025-04-03 17:04:25', 'Cash on Delivery', '2025-04-03 17:04:25', '2025-04-03 17:04:25', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(90, 1, 'rtwrtwtw', '8511202454', NULL, 0.00, 0.00, 80.00, '2025-04-03 17:23:52', 'Cash on Delivery', '2025-04-03 17:23:52', '2025-04-03 17:23:52', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(91, 1, 'eyyhne', '1231231231', NULL, 0.00, 0.00, 160.00, '2025-04-03 17:26:22', 'Cash on Delivery', '2025-04-03 17:26:22', '2025-04-03 17:26:22', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(92, 1, '6eg6e4', '1231231231', NULL, 0.00, 0.00, 160.00, '2025-04-03 17:36:41', 'Cash on Delivery', '2025-04-03 17:36:41', '2025-04-03 17:36:41', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(93, 1, 'dffv', '21`1415151515', NULL, 0.00, 0.00, 160.00, '2025-04-03 17:46:58', 'Cash on Delivery', '2025-04-03 17:46:58', '2025-04-03 17:46:58', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(94, 1, 'gvb5 5y ', '1231231231', NULL, 0.00, 0.00, 160.00, '2025-04-03 17:49:23', 'Cash on Delivery', '2025-04-03 17:49:23', '2025-04-03 17:49:23', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(95, 1, 'sg at4', '1234567890', NULL, 0.00, 0.00, 80.00, '2025-04-03 17:50:04', 'Cash on Delivery', '2025-04-03 17:50:04', '2025-04-12 13:14:12', NULL, 0.00, 'cancelled', NULL, NULL, NULL, NULL),
(96, 1, 'gtte4une', '8511202454', NULL, 0.00, 0.00, 40.00, '2025-04-03 17:56:40', 'Cash on Delivery', '2025-04-03 17:56:40', '2025-04-12 13:13:46', NULL, 0.00, 'cancelled', NULL, NULL, NULL, NULL),
(97, 1, 'beyb3n73u', '8511202454', NULL, 0.00, 0.00, 80.00, '2025-04-03 17:58:38', 'Cash on Delivery', '2025-04-03 17:58:38', '2025-04-12 13:03:37', NULL, 0.00, 'cancelled', NULL, NULL, NULL, NULL),
(112, 28, 'qwe', '8511202454', NULL, 0.00, 0.00, 160.00, '2025-04-05 10:20:41', 'Cash on Delivery', '2025-04-05 10:20:41', '2025-04-05 10:20:41', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(113, 28, 'qwqw', '5555555555', NULL, 0.00, 0.00, 160.00, '2025-04-05 10:23:26', 'Cash on Delivery', '2025-04-05 10:23:26', '2025-04-05 10:23:26', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(114, 28, 'qwqw', '5555555555', NULL, 0.00, 0.00, 160.00, '2025-04-05 10:24:03', 'Cash on Delivery', '2025-04-05 10:24:03', '2025-04-12 13:01:29', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(115, 28, 'qwqw', '5555555555', NULL, 0.00, 0.00, 160.00, '2025-04-05 10:25:13', 'Cash on Delivery', '2025-04-05 10:25:13', '2025-04-05 10:25:13', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(117, 28, 'qwqw', '5555555555', NULL, 0.00, 0.00, 160.00, '2025-04-05 10:26:10', 'Cash on Delivery', '2025-04-05 10:26:10', '2025-04-05 10:26:10', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(118, 28, 'qdwd', '1231231231', NULL, 0.00, 0.00, 0.00, '2025-04-06 15:30:26', 'Cash on Delivery', '2025-04-06 15:30:26', '2025-04-06 15:30:26', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(119, 28, 'fef', '1231231231', NULL, 0.00, 0.00, 80.00, '2025-04-06 19:57:19', 'Cash on Delivery', '2025-04-06 19:57:19', '2025-04-06 19:57:19', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(120, 28, 'dwdwd', '8511202454', NULL, 0.00, 0.00, 200.00, '2025-04-07 11:18:20', 'Cash on Delivery', '2025-04-07 11:18:20', '2025-04-07 11:18:20', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(121, 28, 'njkb', '5555555555', NULL, 0.00, 0.00, 200.00, '2025-04-07 12:07:44', 'Cash on Delivery', '2025-04-07 12:07:44', '2025-04-13 19:14:25', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(122, 28, 'bhgy', 'bhjvh', NULL, 0.00, 0.00, 200.00, '2025-04-08 12:26:04', 'Cash on Delivery', '2025-04-08 12:26:04', '2025-04-08 12:26:04', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(123, 28, 'ewwg', '5555555555', NULL, 0.00, 0.00, 80.00, '2025-04-09 15:53:52', 'Cash on Delivery', '2025-04-09 15:53:52', '2025-04-13 19:14:20', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(124, 28, 'afqf', '5555555555', NULL, 0.00, 0.00, 160.00, '2025-04-09 15:54:25', 'Cash on Delivery', '2025-04-09 15:54:25', '2025-04-12 13:03:25', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(125, 28, 'fqfq', 'fqfq', NULL, 0.00, 0.00, 40.00, '2025-04-09 16:06:29', 'Cash on Delivery', '2025-04-09 16:06:29', '2025-04-09 16:06:29', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(126, 28, 'dqdq', '1231231231', NULL, 0.00, 0.00, 80.00, '2025-04-09 16:16:07', 'Cash on Delivery', '2025-04-09 16:16:07', '2025-04-12 13:16:37', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(128, 28, 'qdd', 'dqd', NULL, 0.00, 0.00, 200.00, '2025-04-09 16:19:09', 'Cash on Delivery', '2025-04-09 16:19:09', '2025-04-12 12:59:03', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(132, 1, 'wfqfecq', '5555555555', NULL, 0.00, 0.00, 0.00, '2025-04-12 13:21:44', 'Cash on Delivery', '2025-04-12 13:21:44', '2025-04-13 20:18:24', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(133, 1, 'ddqf', '1231231231', NULL, 0.00, 0.00, 0.00, '2025-04-12 13:23:00', 'Cash on Delivery', '2025-04-12 13:23:00', '2025-04-12 17:52:33', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(134, 1, 'qqq', '1234567890', NULL, 0.00, 0.00, 140.00, '2025-04-12 20:15:45', 'Cash on Delivery', '2025-04-12 20:15:45', '2025-04-12 20:15:45', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(135, 1, 'ddD', '8511202454', NULL, 0.00, 0.00, 140.00, '2025-04-12 20:17:20', 'Cash on Delivery', '2025-04-12 20:17:20', '2025-04-13 20:57:40', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(136, 1, 'ddD', '8511202454', NULL, 0.00, 0.00, 140.00, '2025-04-13 07:49:09', 'Cash on Delivery', '2025-04-13 07:49:09', '2025-04-14 07:33:10', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(137, 1, 'ddD', '8511202454', NULL, 0.00, 0.00, 140.00, '2025-04-13 07:51:51', 'Cash on Delivery', '2025-04-13 07:51:51', '2025-04-14 09:47:07', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(138, 1, 'vhfhf', '5555555555', NULL, 0.00, 0.00, 300.00, '2025-04-13 07:52:18', 'Cash on Delivery', '2025-04-13 07:52:18', '2025-04-14 09:47:12', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(139, 1, 'rwrq', '1234567890', NULL, 0.00, 0.00, 100.00, '2025-04-13 09:20:16', 'Cash on Delivery', '2025-04-13 09:20:16', '2025-04-13 11:10:29', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(140, 1, 'y', '8511202454', NULL, 0.00, 0.00, 1600.00, '2025-04-13 09:48:14', 'Cash on Delivery', '2025-04-13 09:48:14', '2025-04-13 09:48:30', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(141, 28, 'fhdd', '5555555555', NULL, 0.00, 0.00, 90.00, '2025-04-14 23:15:20', 'Cash on Delivery', '2025-04-14 23:15:20', '2025-04-14 23:15:49', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(142, 28, 'bhjvjvj', '8511202454', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:25:19', 'Cash on Delivery', '2025-04-14 23:25:19', '2025-04-14 23:25:19', NULL, 0.00, 'pending', 'Mango Juice', NULL, NULL, 1),
(143, 28, 'bhjvjvj', '8511202454', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:26:19', 'Cash on Delivery', '2025-04-14 23:26:19', '2025-04-14 23:26:19', NULL, 0.00, 'pending', 'Mango Juice', NULL, NULL, 1),
(144, 28, 'bhjvjvj', '8511202454', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:28:40', 'Cash on Delivery', '2025-04-14 23:28:40', '2025-04-14 23:28:40', NULL, 0.00, 'pending', 'Mango Juice', NULL, NULL, 1),
(145, 28, 'bhjvjvj', '8511202454', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:30:03', 'Cash on Delivery', '2025-04-14 23:30:03', '2025-04-14 23:30:03', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'new one', 1),
(146, 28, 'bhjvjvj', '8511202454', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:31:29', 'Cash on Delivery', '2025-04-14 23:31:29', '2025-04-14 23:31:29', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'new one', 1),
(147, 28, 'bhjvjvj', '8511202454', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:37:32', 'Cash on Delivery', '2025-04-14 23:37:32', '2025-04-14 23:37:32', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'new one', 1),
(148, 28, 'bjv', '1234567890', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:37:45', 'Cash on Delivery', '2025-04-14 23:37:45', '2025-04-14 23:37:45', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'new one', 1),
(149, 28, 'bjv', '1234567890', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:38:46', 'Cash on Delivery', '2025-04-14 23:38:46', '2025-04-14 23:38:46', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'new one', 1),
(150, 28, 'bjv', '1234567890', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:40:18', 'Cash on Delivery', '2025-04-14 23:40:18', '2025-04-14 23:40:18', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'new one', 1),
(151, 28, 'bjv', '1234567890', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:40:33', 'Cash on Delivery', '2025-04-14 23:40:33', '2025-04-14 23:40:33', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'new one', 1),
(152, 28, 'bjv', '1234567890', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:40:46', 'Cash on Delivery', '2025-04-14 23:40:46', '2025-04-14 23:40:46', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'new one', 1),
(153, 28, 'bjv', '1234567890', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:41:05', 'Cash on Delivery', '2025-04-14 23:41:05', '2025-04-14 23:41:05', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'new one', 1),
(154, 28, 'bjv', '1234567890', NULL, 0.00, 0.00, 100.00, '2025-04-14 23:41:37', 'Cash on Delivery', '2025-04-14 23:41:37', '2025-04-14 23:41:37', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'new one', 1),
(155, 28, 'vhuv', '5555555555', NULL, 0.00, 0.00, 90.00, '2025-04-14 23:45:56', 'Cash on Delivery', '2025-04-14 23:45:56', '2025-04-14 23:45:56', NULL, 0.00, 'pending', 'Potatoes', 'Vegetables', 'pokharaj', 1),
(156, 28, 'vhuv', '5555555555', NULL, 0.00, 0.00, 90.00, '2025-04-15 00:01:14', 'Cash on Delivery', '2025-04-15 00:01:14', '2025-04-15 00:01:14', NULL, 0.00, 'pending', 'Potatoes', 'Vegetables', 'pokharaj', 1),
(157, 28, 'vhuv', '5555555555', NULL, 0.00, 0.00, 90.00, '2025-04-15 00:05:19', 'Cash on Delivery', '2025-04-15 00:05:19', '2025-04-15 00:05:19', NULL, 0.00, 'pending', 'Potatoes', 'Vegetables', 'pokharaj', 1),
(158, 28, 'sqdw', '1234567890', NULL, 0.00, 0.00, 170.00, '2025-04-15 00:13:20', 'Cash on Delivery', '2025-04-15 00:13:20', '2025-04-15 00:13:20', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(159, 28, 'nnbj', '1234567890', NULL, 0.00, 0.00, 400.00, '2025-04-15 00:13:42', 'Cash on Delivery', '2025-04-15 00:13:42', '2025-04-15 00:13:42', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(160, 28, ' jknk', '1231231231', NULL, 0.00, 0.00, 120.00, '2025-04-15 00:14:28', 'Cash on Delivery', '2025-04-15 00:14:28', '2025-04-15 00:14:28', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(161, 28, 'gfh', '5555555555', NULL, 0.00, 0.00, 620.00, '2025-04-15 00:15:31', 'Cash on Delivery', '2025-04-15 00:15:31', '2025-04-15 07:32:52', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(162, 28, 'dd', '1234567890', NULL, 0.00, 0.00, 100.00, '2025-04-15 07:34:36', 'Cash on Delivery', '2025-04-15 07:34:36', '2025-04-15 07:34:45', NULL, 0.00, 'delivered', NULL, NULL, NULL, NULL),
(163, 28, 'ftyy', '8511202454', NULL, 0.00, 0.00, 120.00, '2025-04-15 07:45:54', 'Cash on Delivery', '2025-04-15 07:45:54', '2025-04-15 07:45:54', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(164, 28, 'wtt', '8511202454', NULL, 0.00, 0.00, 50.00, '2025-04-15 07:47:18', 'Cash on Delivery', '2025-04-15 07:47:18', '2025-04-15 07:47:18', NULL, 0.00, 'pending', 'Pasta', NULL, NULL, 1),
(165, 28, 'wtt', '8511202454', NULL, 0.00, 0.00, 50.00, '2025-04-15 07:48:51', 'Cash on Delivery', '2025-04-15 07:48:51', '2025-04-15 07:48:51', NULL, 0.00, 'pending', 'Pasta', NULL, NULL, 1),
(166, 28, 'fwfwr3', '1231231231', NULL, 0.00, 0.00, 100.00, '2025-04-15 08:20:27', 'Cash on Delivery', '2025-04-15 08:20:27', '2025-04-15 08:20:27', NULL, 0.00, 'pending', NULL, NULL, NULL, NULL),
(167, 28, 'fafaf', '8511202456', NULL, 0.00, 0.00, 150.00, '2025-04-15 08:32:13', 'Cash on Delivery', '2025-04-15 08:32:13', '2025-04-15 08:32:13', NULL, 0.00, 'pending', 'Mango', 'Fruit', '', NULL),
(168, 28, 'fafaf', '8511202456', NULL, 0.00, 0.00, 150.00, '2025-04-15 08:33:29', 'Cash on Delivery', '2025-04-15 08:33:29', '2025-04-15 08:33:29', NULL, 0.00, 'pending', 'Mango', 'Fruit', '', NULL),
(169, 28, 'fafaf', '8511202456', NULL, 0.00, 0.00, 150.00, '2025-04-15 08:36:00', 'Cash on Delivery', '2025-04-15 08:36:00', '2025-04-15 08:36:00', NULL, 0.00, 'pending', 'Mango', 'Fruit', '', NULL),
(170, 28, 'fafaf', '8511202456', NULL, 0.00, 0.00, 150.00, '2025-04-15 08:37:41', 'Cash on Delivery', '2025-04-15 08:37:41', '2025-04-15 08:37:41', NULL, 0.00, 'pending', 'Mango', 'Fruit', '', NULL),
(171, 28, 'afas', '8511202454', NULL, 0.00, 0.00, 120.00, '2025-04-15 08:41:41', 'Cash on Delivery', '2025-04-15 08:41:41', '2025-04-15 08:41:41', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'wew', NULL),
(172, 28, 'sfsa', '8511202454', NULL, 0.00, 0.00, 120.00, '2025-04-15 08:45:44', 'Cash on Delivery', '2025-04-15 08:45:44', '2025-04-15 08:45:44', NULL, 0.00, 'pending', 'Potatoes', 'Vegetables', 'Colombo', NULL),
(173, 28, 'vhuyfy', '1234567890', NULL, 0.00, 0.00, 140.00, '2025-04-15 08:51:06', 'Cash on Delivery', '2025-04-15 08:51:06', '2025-04-15 08:51:06', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'Saffron Mango Juice', 1),
(174, 28, 'vhuyfy', '1234567890', NULL, 0.00, 0.00, 140.00, '2025-04-15 08:51:43', 'Cash on Delivery', '2025-04-15 08:51:43', '2025-04-15 08:51:43', NULL, 0.00, 'pending', 'Mango Juice', 'Dairy', 'Saffron Mango Juice', 1),
(175, 28, 'vfyfhfiygihohohoh', '9586512470', NULL, 0.00, 0.00, 200.00, '2025-04-15 08:55:04', 'Cash on Delivery', '2025-04-15 08:55:04', '2025-04-15 08:56:53', NULL, 0.00, 'delivered', 'Potatoes', 'Vegetables', 'pokharaj', 2),
(176, 28, 'deesa', '8200401956', NULL, 0.00, 0.00, 260.00, '2025-04-15 09:03:49', 'Cash on Delivery', '2025-04-15 09:03:49', '2025-04-15 09:03:49', NULL, 0.00, 'pending', 'Potatoes, Mango Juice, Pasta', 'Vegetables, Dairy, Breakfast', ', Almond Mango Juice, ', 3),
(177, 28, 'deesa', '8200401956', NULL, 0.00, 0.00, 260.00, '2025-04-15 09:05:48', 'Cash on Delivery', '2025-04-15 09:05:48', '2025-04-15 09:05:48', NULL, 0.00, 'pending', 'Potatoes, Mango Juice, Pasta', 'Vegetables, Dairy, Breakfast', ', Almond Mango Juice, ', 3),
(178, 28, 'deesa', '8200401956', NULL, 0.00, 0.00, 260.00, '2025-04-15 09:07:33', 'Cash on Delivery', '2025-04-15 09:07:33', '2025-04-15 09:07:33', NULL, 0.00, 'pending', 'Potatoes, Mango Juice, Pasta', 'Vegetables, Dairy, Breakfast', ', Almond Mango Juice, ', 3),
(179, 28, 'deesa', '8200401956', NULL, 0.00, 0.00, 260.00, '2025-04-15 09:08:46', 'Cash on Delivery', '2025-04-15 09:08:46', '2025-04-15 09:08:46', NULL, 0.00, 'pending', 'Potatoes, Mango Juice, Pasta', 'Vegetables, Dairy, Breakfast', ', Almond Mango Juice, ', 3),
(180, 28, 'deesa', '8200401956', NULL, 0.00, 0.00, 260.00, '2025-04-15 09:11:57', 'Cash on Delivery', '2025-04-15 09:11:57', '2025-04-15 09:11:57', NULL, 0.00, 'pending', 'Potatoes, Mango Juice, Pasta', 'Vegetables, Dairy, Breakfast', ', Almond Mango Juice, ', 3),
(181, 28, 'deesa', '8200401956', NULL, 0.00, 0.00, 260.00, '2025-04-15 09:12:13', 'Cash on Delivery', '2025-04-15 09:12:13', '2025-04-15 09:12:13', NULL, 0.00, 'pending', 'Potatoes, Mango Juice, Pasta', 'Vegetables, Dairy, Breakfast', ', Almond Mango Juice, ', 3),
(182, 28, 'deesa', '8200401956', NULL, 0.00, 0.00, 260.00, '2025-04-15 09:13:22', 'Cash on Delivery', '2025-04-15 09:13:22', '2025-04-15 09:13:22', NULL, 0.00, 'pending', 'Potatoes, Mango Juice, Pasta', 'Vegetables, Dairy, Breakfast', ', Almond Mango Juice, ', 3),
(183, 28, 'deesa', '8200401956', NULL, 0.00, 0.00, 260.00, '2025-04-15 09:17:13', 'Cash on Delivery', '2025-04-15 09:17:13', '2025-04-15 09:17:34', NULL, 0.00, 'delivered', 'Potatoes, Mango Juice, Pasta', 'Vegetables, Dairy, Breakfast', ', Almond Mango Juice, ', 3),
(184, 28, 'patan', '9586512470', NULL, 0.00, 0.00, 280.00, '2025-04-15 09:19:06', 'Cash on Delivery', '2025-04-15 09:19:06', '2025-04-15 09:19:16', NULL, 0.00, 'delivered', 'Mango Juice, Potatoes, Pepsi', 'Dairy, Vegetables, Cold drink', 'Almond Mango Juice, pokharaj, ', 3),
(185, 28, 'surat', '9624552210', NULL, 0.00, 0.00, 230.00, '2025-04-15 09:26:37', 'Cash on Delivery', '2025-04-15 09:26:37', '2025-04-15 09:26:48', NULL, 0.00, 'delivered', 'Potatoes, Mango Juice', 'Vegetables, Dairy', ', Saffron Mango Juice', 2),
(186, 28, 'surat', '9586512470', NULL, 0.00, 0.00, 170.00, '2025-04-15 09:30:52', 'Cash on Delivery', '2025-04-15 09:30:52', '2025-04-15 09:31:07', NULL, 0.00, 'delivered', 'Mango Juice, Pasta', 'Dairy, Breakfast', 'Almond Mango Juice, ', 2),
(187, 28, 'vvhffhfyfy', '5555555555', NULL, 0.00, 0.00, 230.00, '2025-04-15 09:45:27', 'Cash on Delivery', '2025-04-15 09:45:27', '2025-04-15 09:45:37', NULL, 0.00, 'delivered', 'Potatoes, Mango Juice', 'Vegetables, Dairy', ', Saffron Mango Juice', 2),
(188, 28, 'jhvvvhvhv', '1234567890', NULL, 0.00, 0.00, 400.00, '2025-04-15 09:57:35', 'Cash on Delivery', '2025-04-15 09:57:35', '2025-04-15 23:56:04', NULL, 0.00, 'pending', 'Potatoes, Mango Juice', 'Vegetables, Dairy', 'Colombo, Saffron Mango Juice', 3),
(189, 1, 'deeesa', '8511222455', NULL, 0.00, 0.00, 360.00, '2025-04-15 14:05:40', 'Cash on Delivery', '2025-04-15 14:05:40', '2025-04-16 00:39:08', NULL, 0.00, 'cancelled', 'Potatoes, Mango Juice', 'Vegetables, Dairy', 'Colombo, Almond Mango Juice', 3),
(190, 1, ' mlwe', '8511202454', NULL, 0.00, 0.00, 210.00, '2025-04-15 14:11:32', 'Cash on Delivery', '2025-04-15 14:11:32', '2025-04-15 14:11:41', NULL, 0.00, 'delivered', 'Mango Juice, Potatoes', 'Dairy, Vegetables', 'Almond Mango Juice, ', 2),
(191, 1, 'deesa', '8511202454', NULL, 0.00, 0.00, 360.00, '2025-04-16 00:32:48', 'Cash on Delivery', '2025-04-16 00:32:48', '2025-04-16 00:43:32', NULL, 0.00, 'delivered', 'Mango Juice, Potatoes', 'Dairy, Vegetables', 'Almond Mango Juice, Colombo', 3),
(192, 1, 'gjhghg', '9586512470', NULL, 0.00, 0.00, 370.00, '2025-04-16 12:39:22', 'Cash on Delivery', '2025-04-16 12:39:22', '2025-04-16 12:40:26', NULL, 0.00, 'cancelled', 'Mango Juice, Potatoes', 'Dairy, Vegetables', 'Saffron Mango Juice, ', 3),
(193, 1, 'deesa', '8511202454', NULL, 0.00, 0.00, 360.00, '2025-04-16 17:49:10', 'Cash on Delivery', '2025-04-16 17:49:10', '2025-04-16 17:58:11', NULL, 0.00, 'delivered', 'Potatoes, Mango Juice', 'Vegetables, Dairy', 'Colombo, Almond Mango Juice', 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_feedback`
--

CREATE TABLE `order_feedback` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `feedback` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_feedback`
--

INSERT INTO `order_feedback` (`id`, `order_id`, `user_id`, `rating`, `feedback`, `created_at`) VALUES
(1, 126, 28, 5, 'good', '2025-04-09 16:16:21'),
(5, 132, 1, 4, '', '2025-04-12 13:22:08'),
(6, 133, 1, 5, '', '2025-04-12 13:23:03'),
(7, 138, 1, 5, '', '2025-04-13 07:52:29'),
(8, 141, 28, 5, '', '2025-04-14 23:15:36'),
(9, 154, 28, 5, '', '2025-04-14 23:41:45'),
(10, 188, 28, 5, '', '2025-04-15 09:57:41'),
(11, 189, 1, 5, 'best', '2025-04-15 14:05:52'),
(12, 191, 1, 5, 'good product', '2025-04-16 00:34:06'),
(13, 192, 1, 5, '', '2025-04-16 12:41:02'),
(14, 193, 1, 5, 'testy', '2025-04-16 17:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_amount` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` tinyint(5) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `food_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `food_id`, `subcategory_id`, `quantity`, `unit_amount`, `amount`, `status`, `create_date`, `update_date`, `delete_date`, `food_name`, `category`, `subcategory`, `price`) VALUES
(4, 157, 106, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Potatoes', 'Vegetables', 'pokharaj', 0.00),
(5, 158, 116, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Pasta', '', '', 0.00),
(6, 158, 107, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Mango Juice', '', '', 0.00),
(7, 159, 132, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Kaju Katli', '', '', 0.00),
(8, 160, 107, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Mango Juice', '', '', 0.00),
(9, 161, 106, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Potatoes', '', '', 0.00),
(10, 161, 107, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Mango Juice', '', '', 0.00),
(11, 161, 132, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Kaju Katli', '', '', 0.00),
(12, 162, 107, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Mango Juice', '', '', 0.00),
(13, 171, 107, 21, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 123.00),
(14, 172, 106, 16, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00),
(15, 174, 107, 22, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 140.00),
(16, 175, 106, 17, 2, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 100.00),
(17, 183, 107, 21, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00),
(18, 184, 107, 21, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00),
(19, 184, 106, 17, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 100.00),
(20, 185, 107, 22, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 140.00),
(21, 186, 107, 21, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00),
(22, 187, 107, 22, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 140.00),
(23, 188, 106, 16, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00),
(24, 188, 107, 22, 2, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 140.00),
(25, 189, 106, 16, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00),
(26, 189, 107, 21, 2, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00),
(27, 190, 107, 21, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00),
(28, 191, 107, 21, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00),
(29, 191, 106, 16, 2, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00),
(30, 192, 107, 22, 2, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 140.00),
(31, 193, 106, 16, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00),
(32, 193, 107, 21, 2, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 120.00);

-- --------------------------------------------------------

--
-- Table structure for table `organic`
--

CREATE TABLE `organic` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `weight_type` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organic`
--

INSERT INTO `organic` (`id`, `name`, `description`, `weight`, `weight_type`, `price`, `image`, `created_at`) VALUES
(1, 'Tomato', 'Fresh organic tomatoes, rich in flavor and antioxidants.', '1', 'kg', 30.00, 'tomato.jpg', '2025-04-14 06:28:50'),
(2, 'Chili', 'Spicy green chilies, grown without chemicals.', '250', 'g', 20.00, 'chili.jpg', '2025-04-14 06:28:50'),
(3, 'Coriander', 'Aromatic organic coriander leaves.', '100', 'g', 10.00, 'coriander.jpg', '2025-04-14 06:28:50'),
(4, 'Potato', 'Healthy and chemical-free potatoes.', '1', 'kg', 25.00, 'potato.jpg', '2025-04-14 06:28:50'),
(11, 'Potatoes', 'good', '1', 'kg', 120.00, 'veg_67ff564e1bd920.28731908.png', '2025-04-16 07:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `views` int(11) DEFAULT 0,
  `is_organic` tinyint(1) DEFAULT 0,
  `rating` decimal(3,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `food_id`, `user_id`, `rating`) VALUES
(1, 106, 1, 1),
(2, 107, 1, 5),
(3, 151, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `delete_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `category_id`, `status`, `created_at`, `price`) VALUES
(9, 'Fruits', 1, 1, '2025-03-25 06:17:05', 0.00),
(10, 'Dried Fruits', 227, 1, '2025-03-25 06:17:05', 0.00),
(13, 'colambo', 210, 1, '2025-03-25 07:08:38', 80.00),
(14, 'pokharaj', 210, 1, '2025-03-25 07:08:38', 40.00),
(15, 'new one', 211, 1, '2025-03-25 07:08:38', 200.00),
(16, 'new two', 211, 1, '2025-03-25 07:08:38', 100.00),
(17, 'kiss', 209, 1, '2025-04-10 07:19:59', 0.00),
(18, 'ooooo', 210, 1, '2025-04-10 07:25:05', 0.00),
(19, 'ff', 209, 1, '2025-04-10 07:34:51', 0.00),
(20, 'pop', 211, 1, '2025-04-10 10:10:18', 0.00),
(21, 'wew', 1, 1, '2025-04-11 02:20:23', 123.00),
(22, 'erer', 211, 1, '2025-04-11 04:12:12', 1233.00),
(23, 'balaki con', 211, 1, '2025-04-11 04:35:42', 10.00),
(24, 'conn', 228, 1, '2025-04-11 15:32:05', 0.00),
(26, 'boss', 210, 1, '2025-04-11 15:51:30', 120.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `status` tinyint(5) NOT NULL,
  `create_date` date DEFAULT current_timestamp(),
  `update_date` date DEFAULT NULL,
  `delete_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `full_name`, `email`, `password`, `mobile`, `status`, `create_date`, `update_date`, `delete_date`) VALUES
(1, 1, 'ronak', 'admin@gmail.com', '123123', 4561237890, 1, '0000-00-00', NULL, NULL),
(24, 2, 'Vishnu Prajapati', 'user@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 7016568403, 1, '2025-03-01', NULL, NULL),
(25, 2, 'Vishnu Prajapati', 'vishnu@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 7016568403, 1, '2025-03-01', NULL, NULL),
(26, 2, 'ronak', 'user@gmail.com', '888299ac283b65372d4376fb66e6bce5', 5588996644, 1, '2025-03-10', NULL, NULL),
(27, 2, 'kiran', 'kiran@gmail.com', '123123123', 5588996655, 1, '2025-03-11', NULL, NULL),
(28, 2, 'ronakbhai', 'admin@gmail.com', '123123', 1122334455, 1, '2025-03-28', NULL, NULL),
(29, 2, 'ronak', 'admin@gmail.com', '112233', 8511202454, 0, '2025-03-28', NULL, NULL),
(31, 2, 'dhaval', 'dhava@gmail.com', '789789', 9586512470, 0, '2025-04-12', NULL, NULL),
(32, 2, 'ram', 'one@gmail.com', '$2y$10$eji2V.zsl4q5c23A.keotOK6SZBvlcPpQBSymzVaKHycFz9h9WjuK', 9586512470, 0, '2025-04-16', NULL, NULL),
(33, 2, 'yes', 'yes@gmail.com', '123456', 8511202454, 0, '2025-04-16', NULL, NULL),
(34, 2, 'ronakbhai', 'parth@gmail.com', '123456', 4561237890, 0, '2025-04-16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `pincode` varchar(15) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` text NOT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `address_1`, `address_2`, `landmark`, `pincode`, `country`, `state`, `city`, `address`, `create_date`, `update_date`, `delete_date`) VALUES
(1, 27, '', NULL, NULL, NULL, NULL, NULL, NULL, 'deesA', '2025-03-14 13:35:48', '2025-03-14 13:35:48', NULL),
(2, 27, '', NULL, NULL, NULL, NULL, NULL, NULL, 'deesa new city', '2025-03-14 13:47:56', '2025-03-14 13:47:56', NULL),
(3, 27, '', NULL, NULL, NULL, NULL, NULL, NULL, 'ihjuijih', '2025-03-14 13:54:54', '2025-03-14 13:54:54', NULL),
(9, 27, '', NULL, NULL, NULL, NULL, NULL, NULL, '64,prajapati vas deesa,385535', '2025-03-14 14:35:03', '2025-03-14 14:35:03', NULL),
(10, 27, '', NULL, NULL, '385535', 'India', 'Gujarat', 'deesa', '64,prajapati vas deesa,385535', '2025-03-14 14:36:44', '2025-03-14 14:36:44', NULL),
(11, 27, '', NULL, NULL, '385535', 'India', 'Gujarat', 'patan', 'd,demfknfeesa,385535', '2025-03-14 14:40:38', '2025-03-14 14:40:38', NULL),
(12, 27, '', NULL, NULL, '385535', 'India', 'Gujarat', 'patan', 'sa,385535', '2025-03-14 17:38:43', '2025-03-14 17:38:43', NULL),
(13, 27, '', NULL, NULL, '385535', 'India', 'Gujarat', 'patan', 'vas deesa,385535', '2025-03-15 09:28:50', '2025-03-15 09:28:50', NULL),
(14, 27, '', NULL, NULL, '385535', 'India', 'Gujarat', 'new deesa', 'hjhknjbjkbjn 64,prajapati vas deesa,385535', '2025-03-24 10:29:47', '2025-03-24 10:29:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_carts`
--

CREATE TABLE `user_carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `create_date` datetime DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_date` datetime DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_carts`
--

INSERT INTO `user_carts` (`id`, `user_id`, `food_id`, `subcategory_id`, `quantity`, `create_date`, `update_date`, `delete_date`, `price`) VALUES
(470, 1, 153, NULL, 1, '2025-04-16 18:00:01', '2025-04-16 18:00:01', NULL, 300.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contect`
--
ALTER TABLE `contect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerjbhbhjbhbv_orders`
--
ALTER TABLE `customerjbhbhjbhbv_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foods_ibfk_1` (`user_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `food_images`
--
ALTER TABLE `food_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `food_subcategories`
--
ALTER TABLE `food_subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `order_details_ibfk_1` (`order_id`);

--
-- Indexes for table `order_feedback`
--
ALTER TABLE `order_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `organic`
--
ALTER TABLE `organic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_carts`
--
ALTER TABLE `user_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contect`
--
ALTER TABLE `contect`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerjbhbhjbhbv_orders`
--
ALTER TABLE `customerjbhbhjbhbv_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `food_images`
--
ALTER TABLE `food_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `food_subcategories`
--
ALTER TABLE `food_subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_feedback`
--
ALTER TABLE `order_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `organic`
--
ALTER TABLE `organic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_carts`
--
ALTER TABLE `user_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=471;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`),
  ADD CONSTRAINT `bill_ibfk_3` FOREIGN KEY (`subcategory_id`) REFERENCES `food_subcategories` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Constraints for table `customerjbhbhjbhbv_orders`
--
ALTER TABLE `customerjbhbhjbhbv_orders`
  ADD CONSTRAINT `customerjbhbhjbhbv_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD CONSTRAINT `customer_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `customer_orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `customerjbhbhjbhbv_orders` (`id`);

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `foods_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `food_images`
--
ALTER TABLE `food_images`
  ADD CONSTRAINT `food_images_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`);

--
-- Constraints for table `food_subcategories`
--
ALTER TABLE `food_subcategories`
  ADD CONSTRAINT `food_subcategories_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_feedback`
--
ALTER TABLE `order_feedback`
  ADD CONSTRAINT `order_feedback_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_feedback_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`);

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`),
  ADD CONSTRAINT `product_ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`),
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`);

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_carts`
--
ALTER TABLE `user_carts`
  ADD CONSTRAINT `user_carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_carts_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
