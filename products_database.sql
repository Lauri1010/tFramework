-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11.11.2017 klo 15:12
-- Palvelimen versio: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products_database`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `product`
--

CREATE TABLE `product` (
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_category_id_ref` int(11) UNSIGNED NOT NULL,
  `product_store_id_ref` int(11) UNSIGNED NOT NULL,
  `product_vendor_id_ref` int(11) UNSIGNED DEFAULT NULL,
  `product_name` char(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL,
  `discount_price` decimal(7,2) DEFAULT NULL,
  `image_url` char(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_be_removed` tinyint(1) DEFAULT NULL,
  `brand` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` char(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inventory` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `product`
--

INSERT INTO `product` (`product_id`, `product_category_id_ref`, `product_store_id_ref`, `product_vendor_id_ref`, `product_name`, `price`, `discount_price`, `image_url`, `to_be_removed`, `brand`, `message`, `inventory`) VALUES
(9, 1, 2, 1, 'Nokia Lumia 1230', '900.00', '800.00', 'product-2.jpg', 0, 'Nokia', 'New nokia lumia phone', 20),
(10, 1, 2, 1, 'Lg leon 2015', '800.00', '700.00', 'product-3.jpg', 0, 'Lg', 'New Lg phone', 20),
(12, 1, 2, 1, 'Sony microsoft', '200.00', '150.00', 'product-4.jpg', 0, 'Sony', 'New sony phone', 20),
(18, 1, 2, 1, 'I phone 6', '1100.00', '900.00', 'product-5.jpg', 0, 'Apple', 'Apple Iphone 6', 20),
(19, 1, 2, 1, 'Samsung galaxy s5 -2015', '700.00', '500.00', 'product-1.jpg', 0, 'Samsung', 'New samsung phone', 20),
(21, 1, 2, 1, 'samsung galaxy note', '500.00', '400.00', 'product-6.jpg', 0, 'Samsung', 'The new samsung', 20);

-- --------------------------------------------------------

--
-- Rakenne taululle `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(10) UNSIGNED NOT NULL,
  `product_category_name` char(150) COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `product_category_name`) VALUES
(1, 'Phones'),
(2, 'Tvs');

-- --------------------------------------------------------

--
-- Rakenne taululle `product_vendor`
--

CREATE TABLE `product_vendor` (
  `vendor_id` int(11) UNSIGNED NOT NULL,
  `vendor_name` char(50) COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `product_vendor`
--

INSERT INTO `product_vendor` (`vendor_id`, `vendor_name`) VALUES
(1, 'Test name');

-- --------------------------------------------------------

--
-- Rakenne taululle `product_vendor_accounts`
--

CREATE TABLE `product_vendor_accounts` (
  `account_id` int(11) NOT NULL,
  `account_name` char(50) COLLATE utf8_unicode_ci DEFAULT '0',
  `product_vendor_id_ref` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `product_vendor_accounts`
--

INSERT INTO `product_vendor_accounts` (`account_id`, `account_name`, `product_vendor_id_ref`) VALUES
(1, 'Account', 1);

-- --------------------------------------------------------

--
-- Rakenne taululle `product_vendor_financials`
--

CREATE TABLE `product_vendor_financials` (
  `product_vendor_financials_id` int(10) UNSIGNED NOT NULL,
  `balance` decimal(10,2) UNSIGNED DEFAULT NULL,
  `product_vendor_id_ref` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `product_vendor_financials`
--

INSERT INTO `product_vendor_financials` (`product_vendor_financials_id`, `balance`, `product_vendor_id_ref`) VALUES
(1, '100.00', 1);

-- --------------------------------------------------------

--
-- Rakenne taululle `store`
--

CREATE TABLE `store` (
  `store_id` int(10) UNSIGNED NOT NULL,
  `store_name` char(150) COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `store`
--

INSERT INTO `store` (`store_id`, `store_name`) VALUES
(1, 'Phone store'),
(2, 'Apple store');

-- --------------------------------------------------------

--
-- Rakenne taululle `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` char(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` char(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` char(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `salt`) VALUES
(2, 'laupatrik', 'salainen', 'laupatrik@gmail.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `FK_products_product_category` (`product_category_id_ref`),
  ADD KEY `FK_product_store` (`product_store_id_ref`),
  ADD KEY `FK_product_product_vendor` (`product_vendor_id_ref`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `product_vendor`
--
ALTER TABLE `product_vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `product_vendor_accounts`
--
ALTER TABLE `product_vendor_accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `FK_product_vendor_accounts_product_vendor` (`product_vendor_id_ref`);

--
-- Indexes for table `product_vendor_financials`
--
ALTER TABLE `product_vendor_financials`
  ADD PRIMARY KEY (`product_vendor_financials_id`),
  ADD KEY `FK_product_vendor_financials_product_vendor` (`product_vendor_id_ref`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product_vendor`
--
ALTER TABLE `product_vendor`
  MODIFY `vendor_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product_vendor_accounts`
--
ALTER TABLE `product_vendor_accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product_vendor_financials`
--
ALTER TABLE `product_vendor_financials`
  MODIFY `product_vendor_financials_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_product_vendor` FOREIGN KEY (`product_vendor_id_ref`) REFERENCES `product_vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_product_store` FOREIGN KEY (`product_store_id_ref`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_products_product_category` FOREIGN KEY (`product_category_id_ref`) REFERENCES `product_category` (`product_category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Rajoitteet taululle `product_vendor_accounts`
--
ALTER TABLE `product_vendor_accounts`
  ADD CONSTRAINT `FK_product_vendor_accounts_product_vendor` FOREIGN KEY (`product_vendor_id_ref`) REFERENCES `product_vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Rajoitteet taululle `product_vendor_financials`
--
ALTER TABLE `product_vendor_financials`
  ADD CONSTRAINT `FK_product_vendor_financials_product_vendor` FOREIGN KEY (`product_vendor_id_ref`) REFERENCES `product_vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
