-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3307
-- Generation Time: 06.09.2017 klo 18:53
-- Palvelimen versio: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) unsigned NOT NULL,
  `product_category_id_ref` int(11) unsigned NOT NULL,
  `product_store_id_ref` int(11) unsigned NOT NULL,
  `product_vendor_id_ref` int(11) unsigned DEFAULT NULL,
  `product_name` char(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL,
  `discount_price` decimal(7,2) DEFAULT NULL,
  `image_url` char(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_be_removed` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `product`
--

INSERT INTO `product` (`product_id`, `product_category_id_ref`, `product_store_id_ref`, `product_vendor_id_ref`, `product_name`, `price`, `discount_price`, `image_url`, `to_be_removed`) VALUES
(2, 1, 1, 1, 'Jakkus', '15.01', '7.11', 'urli.img', 1),
(3, 1, 1, 1, 'Levis', '11.01', '9.11', '', NULL),
(4, 1, 1, 1, 'Saapikkaat', '2.50', '2.00', 'img.jpg', NULL),
(6, 1, 1, 1, 'Jakku', '11.00', '7.00', ' img.jpg', NULL);

-- --------------------------------------------------------

--
-- Rakenne taululle `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `product_category_id` int(10) unsigned NOT NULL,
  `product_category_name` char(150) COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `product_category_name`) VALUES
(1, 'Pants'),
(2, 'Tank top');

-- --------------------------------------------------------

--
-- Rakenne taululle `product_vendor`
--

CREATE TABLE IF NOT EXISTS `product_vendor` (
  `vendor_id` int(11) unsigned NOT NULL,
  `vendor_name` char(50) COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `product_vendor`
--

INSERT INTO `product_vendor` (`vendor_id`, `vendor_name`) VALUES
(1, 'Test name');

-- --------------------------------------------------------

--
-- Rakenne taululle `product_vendor_accounts`
--

CREATE TABLE IF NOT EXISTS `product_vendor_accounts` (
  `account_id` int(11) NOT NULL,
  `account_name` char(50) COLLATE utf8_unicode_ci DEFAULT '0',
  `product_vendor_id_ref` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `product_vendor_accounts`
--

INSERT INTO `product_vendor_accounts` (`account_id`, `account_name`, `product_vendor_id_ref`) VALUES
(1, 'Account', 1);

-- --------------------------------------------------------

--
-- Rakenne taululle `product_vendor_financials`
--

CREATE TABLE IF NOT EXISTS `product_vendor_financials` (
  `product_vendor_financials_id` int(10) unsigned NOT NULL,
  `balance` decimal(10,2) unsigned DEFAULT NULL,
  `product_vendor_id_ref` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `product_vendor_financials`
--

INSERT INTO `product_vendor_financials` (`product_vendor_financials_id`, `balance`, `product_vendor_id_ref`) VALUES
(1, '100.00', 1);

-- --------------------------------------------------------

--
-- Rakenne taululle `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `store_id` int(10) unsigned NOT NULL,
  `store_name` char(150) COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vedos taulusta `store`
--

INSERT INTO `store` (`store_id`, `store_name`) VALUES
(1, 'Halens'),
(2, 'Romukama');

-- --------------------------------------------------------

--
-- Rakenne taululle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) unsigned NOT NULL,
  `username` char(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` char(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` char(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  MODIFY `product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product_vendor`
--
ALTER TABLE `product_vendor`
  MODIFY `vendor_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product_vendor_accounts`
--
ALTER TABLE `product_vendor_accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product_vendor_financials`
--
ALTER TABLE `product_vendor_financials`
  MODIFY `product_vendor_financials_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
