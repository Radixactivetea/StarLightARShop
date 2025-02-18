-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2025 at 03:53 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `starlightarshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int NOT NULL,
  `user_id` char(36) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `street_address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `post_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ar`
--

CREATE TABLE `ar` (
  `ar_id` int NOT NULL,
  `model_path` varchar(255) NOT NULL,
  `qr_link` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ar`
--

INSERT INTO `ar` (`ar_id`, `model_path`, `qr_link`, `img_url`) VALUES
(1, 'cup.glb', 'http://starlightarshop.test/AR/1', 'ar1.png');

-- --------------------------------------------------------

--
-- Table structure for table `ban_requests`
--

CREATE TABLE `ban_requests` (
  `id` int NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `seller_id` char(36) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `evidence` text,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `admin_id` char(36) DEFAULT NULL,
  `admin_notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_id` int NOT NULL,
  `user_id` char(36) NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`, `image_url`) VALUES
(1, 'Bowl', NULL, 'bowl.png'),
(2, 'Mug', NULL, 'mug.png'),
(3, 'Plate', NULL, 'plate.png'),
(4, 'Vase', NULL, 'vase.png'),
(5, 'Collection', NULL, 'collection.png'),
(6, 'Cup', NULL, 'cup.png'),
(7, 'Jug', NULL, 'jug.png');

-- --------------------------------------------------------

--
-- Table structure for table `dimensions`
--

CREATE TABLE `dimensions` (
  `dimension_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `diameter` decimal(10,1) DEFAULT NULL,
  `height` decimal(10,1) DEFAULT NULL,
  `weight` decimal(10,1) DEFAULT NULL,
  `capacity` decimal(10,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dimensions`
--

INSERT INTO `dimensions` (`dimension_id`, `product_id`, `diameter`, `height`, `weight`, `capacity`) VALUES
(14, 65, 2.0, 2.0, 2.0, 2.0),
(16, 67, 12.0, 12.0, 12.0, 12.0),
(17, 68, 24.0, 15.0, 2.4, 3.5),
(18, 69, 15.0, 24.0, 1.1, 1.9),
(20, 85, 9.0, 9.0, 0.4, 0.3),
(54, 129, 30.0, 10.0, 2.3, 2.5);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `experience_details` text,
  `feature_suggestions` text,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_replied` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `noti_id` int NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint NOT NULL,
  `user_id` char(36) NOT NULL DEFAULT (uuid()),
  `promotion_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `street_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `post_code` int DEFAULT NULL,
  `order_status` varchar(10) DEFAULT NULL,
  `tracking_number` varchar(20) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_id` bigint NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint NOT NULL,
  `order_id` bigint NOT NULL,
  `internal_reference` varchar(50) NOT NULL,
  `gateway_reference` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_level` int NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `has_AR` tinyint(1) NOT NULL DEFAULT '0',
  `ar_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `price`, `stock_level`, `image_url`, `has_AR`, `ar_id`) VALUES
(2, 'Le Kuisto Dinnerware Set X Gift', 'Buy Le Kuisto Dinnerware Set and get an olive wood accessory for free.\r\n\r\nThis beautiful dinner set by Le Kuisto is the perfect selection for simple and elegant family gatherings. The set is made of stoneware and comes in the perfect size for meals with your family. \r\n\r\n*One set is composed of four of each of the items listed below. Total of 12 pieces', 135.00, 2, 'Le Kuisto Dinnerware Set X Gift.png', 0, NULL),
(43, 'Dinner Plate With Handles', 'Our famous stoneware dinner plate with handles is perfect for sharing and family gatherings. Handmade with a Mediterranean style, it adds a unique touch to any meal. Carry and serve with ease thanks to the convenient handles.', 62.00, 7, 'Stoneware Diner Plate With Handles.png', 0, NULL),
(65, 'Tapas Bowl', 'This Tapas Bowl from Ewa collection are the perfect addition to your dining collection. With a diameter of 5.9 inches, they are the ideal size for serving individual portions of your favorite tapas dishes. Made of durable stoneware, these bowls are both functional and stylish, adding a touch of elegance to any meal.', 20.00, 10, 'Stoneware Tapas Bowl.png', 0, NULL),
(67, 'Coffee Cup', 'This  Coffee Cup EDAN 6 oz is hand-crafted with stoneware and features a contemporary design with a matte finish. This timeless style adds a practical element of art to any table, making it perfect for hospitality or home use.', 25.40, 11, 'Stoneware Coffee Cup.png', 1, 1),
(68, 'Serving Bowl', '&#039;&#039;Love this beautiful serving bowl, it&#039;s really as nice in person as they are in the photos. I will be ordering again &#039;&#039; Deanne (Retailer, USA)★★★★★Gorgeous serving bowl silhouette, shallow, minimal and so chic! Perfect for effortless and elegant dining. Just wonder what would you put in this bowl !', 35.50, 17, '678f7223b2725.png', 0, NULL),
(69, 'Pitcher ', 'With gorgeous, bold stoneware as a functional centrepiece, every meal becomes a multi-sensory experience.  Whether used for water or wine or to display flowers in the home, our ethnic-contemporary designs combine the purity of form with individual artistry to create a visual feast for the eyes.', 33.00, 5, 'Stoneware Pitcher.png', 0, NULL),
(85, 'Coffee Mug ', 'Take a break from your busy schedule and savor a hot beverage in our elegant Osun stoneware mugs. These beautifully shaped mugs are perfect for indulging in hot cocoa, chocolate, or tea, keeping your drink warm for longer. Take some time for yourself and enjoy a comforting moment with our mugs.', 23.00, 17, 'Stoneware Coffee Mug.png', 0, NULL),
(129, 'Stoneware Serving Bowl', 'Stoneware bowls are naturally able to maintain even temperatures, both during and after the cooking process. Scorch that may alter flavour is prevented, dessert and cold soups are kept cold, and warmth is maintained in soups and stews.       Rounded or organically shaped dinnerware, handmade by local artisans and designer-made, our collection is special and unique by its matte finish.', 43.40, 18, '6754a539b56a3.png', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(65, 1),
(68, 1),
(129, 1),
(85, 2),
(43, 3),
(67, 6),
(69, 7);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `promotion_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `discount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`promotion_id`, `name`, `description`, `discount`) VALUES
(1, 'Winter Sale', 'Get 30% off on all pottery items. Limited time offer!', 30),
(2, 'Black Friday Deals', 'Massive discounts across all categories, up to 50% off!', 50),
(3, 'New Year Special', 'Celebrate the new year with a 20% discount on collections.', 20),
(4, 'Flash Sale', 'Limited-time flash sale on select items. Discounts up to 70% off!', 70),
(5, 'Holiday Extravaganza', 'Enjoy 40% off on all pottery decor items during the holidays.', 40),
(6, 'Clearance Sale', 'Up to 80% off on select clearance items. Hurry before they’re gone!', 80),
(7, 'Summer Collection', 'Get 25% off on summer collection. Perfect for the sunny days!', 25),
(8, 'Back to School', 'Exclusive 15% discount.', 15);

-- --------------------------------------------------------

--
-- Table structure for table `review&rating`
--

CREATE TABLE `review&rating` (
  `review_id` int NOT NULL,
  `user_id` varchar(255) NOT NULL DEFAULT '0',
  `order_id` bigint NOT NULL,
  `product_id` int NOT NULL,
  `rating` int DEFAULT '0',
  `review` text,
  `date` date DEFAULT NULL,
  `response` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_requests`
--

CREATE TABLE `seller_requests` (
  `id` int NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `status` enum('pending','approved') DEFAULT NULL,
  `requested_by` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` char(36) NOT NULL DEFAULT (uuid()),
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_num` varchar(13) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'customer',
  `date_of_birth` date DEFAULT NULL,
  `profile_pic_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'default.png',
  `banned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `password`, `email`, `phone_num`, `gender`, `role`, `date_of_birth`, `profile_pic_url`, `banned`) VALUES
('0b46df08-ee0f-11ef-8a35-d45d64613b08', 'first', 'user', '$2y$10$KilScaSfl9A4oUl0NpzcIOZjhg3pcOfZQRSUBI1D53WZaDuYgFl7C', 'user@example.com', NULL, NULL, 'customer', '2009-10-18', 'default.png', 0),
('54896145-ee10-11ef-8a35-d45d64613b08', 'first', 'admin', '$2y$10$TFsw/.W1CNVJSGwhmuzYluFY5ahS9a6sc1OIUythuOVL16e6ALZwe', 'admin@example.com', NULL, NULL, 'admin', '2002-11-18', 'default.png', 0),
('ebd850a5-ee0f-11ef-8a35-d45d64613b08', 'first', 'seller', '$2y$10$eSqdW//S4rWTg0MXjmhGoejmnlSFI5aSzxD4gJpn/n7pcnD4.9f0.', 'seller@example.com', NULL, NULL, 'staff', '1988-12-19', 'default.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ar`
--
ALTER TABLE `ar`
  ADD PRIMARY KEY (`ar_id`);

--
-- Indexes for table `ban_requests`
--
ALTER TABLE `ban_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id` (`category_id`);

--
-- Indexes for table `dimensions`
--
ALTER TABLE `dimensions`
  ADD PRIMARY KEY (`dimension_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`noti_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `promotion_id` (`promotion_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `ar_id` (`ar_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`promotion_id`),
  ADD UNIQUE KEY `promotion_id` (`promotion_id`);

--
-- Indexes for table `review&rating`
--
ALTER TABLE `review&rating`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `seller_requests`
--
ALTER TABLE `seller_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requested_by` (`requested_by`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ar`
--
ALTER TABLE `ar`
  MODIFY `ar_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ban_requests`
--
ALTER TABLE `ban_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dimensions`
--
ALTER TABLE `dimensions`
  MODIFY `dimension_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `noti_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22324;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `promotion_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `review&rating`
--
ALTER TABLE `review&rating`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `seller_requests`
--
ALTER TABLE `seller_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `ban_requests`
--
ALTER TABLE `ban_requests`
  ADD CONSTRAINT `ban_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ban_requests_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ban_requests_ibfk_3` FOREIGN KEY (`admin_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `dimensions`
--
ALTER TABLE `dimensions`
  ADD CONSTRAINT `dimensions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`promotion_id`) REFERENCES `promotion` (`promotion_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`ar_id`) REFERENCES `ar` (`ar_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `review&rating`
--
ALTER TABLE `review&rating`
  ADD CONSTRAINT `review&rating_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review&rating_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `review&rating_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seller_requests`
--
ALTER TABLE `seller_requests`
  ADD CONSTRAINT `seller_requests_ibfk_1` FOREIGN KEY (`requested_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seller_requests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
