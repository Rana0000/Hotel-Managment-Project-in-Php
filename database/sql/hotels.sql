-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 05:58 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotels`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(1000) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `facilities` varchar(1000) NOT NULL,
  `rate` int(11) NOT NULL,
  `more_details` text DEFAULT NULL,
  `image_url` varchar(1000) DEFAULT 'https://via.placeholder.com/150'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `hotel_name`, `address`, `facilities`, `rate`, `more_details`, `image_url`) VALUES
(1, 'Four Seasons Resort Bali', 'Jimbaran Bay, Indonesia', 'SPA, Fitness Centre, Pool Facilities & Services', 4, 'Experience both the river and beach landscapes of Bali with our multi-destination package. For a unique check-in experience in Sayan, arrive by river raft from Four Seasons Resort Bali at Jimbaran Bay.', 'src/images/hotel_images/646a2d758970e_hotel-1.jpg'),
(2, 'Atlantis Paradise Island', 'Bahamas', 'Kids adventure, Theatre, Golf Course, SPA', 5, 'The most popular resort destination in The Bahamas - features the world\'s largest open-air marine habitat; Aquaventure water park, including the iconic Mayan Temple\'s Leap of Faith slider; 11 unique pools; renowned beaches; 18-hole golf course; the largest casino in the Caribbean.', 'src/images/hotel_images/646a2db7ce382_hotel-2.jpg'),
(3, 'Hotel Stadt Wien ', 'Salzburg, Zell am See', 'Fitness room, Garden terrace', 3, 'Lots of room for lots of vacation At Hotel Stadt Wien in Zell am See, you will experience nature up close. Both inside and outside the hotel. Enjoy the Salzburg-style hospitality. Uncomplicated, sincere and relaxed.Step inside and feel completely at home from the moment you arrive. ', 'src/images/hotel_images/646a2e68106aa_hotel-3.jpeg'),
(4, 'The Peninsula Paris', 'Paris, France', 'SPA, Fitness Center, Pool, Tennis Court', 4, 'The hotel also has a business center, a conference center, a golf course, and a restaurant.', 'src/images/hotel_images/646a2f2cea5b4_hotel-4.jpg'),
(5, 'Hilton Hotel', '1B Azadlig Avenue, Baku 1000', 'Fitness and Recreation, Business and Work, Conveniences, Dining', 4, 'The original company was founded by Conrad Hilton. As of December 30, 2019, 584 Hilton Hotels & Resorts properties with 216,379 rooms in 94 countries and territories are located across six continents.This includes 61 properties that are owned or leased with 219,264 rooms, 272 that are managed with 119,612 rooms, and 251 that are franchised with 77,451 rooms. In 2020, Fortune magazine ranked Hilton Hotels & Resorts at number one on their Fortune List of the Top 100 Companies to Work For in 2020 based on an employee survey of satisfaction.', 'src/images/hotel_images/646a33f5d7b66_hotel-5.jpg'),
(6, 'The Principal Madrid', 'Madrid, Spain', 'Yoga room, Fitness Center', 5, 'A gem in the shape of a hotel. This extraordinary property combines city leisure and the privacy and comfort of a home away from home. Within the walls of this fortress, you’ll find all the finesse and attention to detail that celebrates elegance and exclusivity. Being the first 5-star hotel in Gran Via.', 'src/images/hotel_images/646a3546d5f40_hotel-6.jpg'),
(7, 'Hotel Napoleon', 'Pesaro PU, Italy', 'Pool, Fitness Center, SPA, and Restaurant', 4, 'Napoleon Pesaro is a five-star hotel located in the heart of the city of Pesaro, Italy. The hotel offers a wide range of services and amenities to its guests, including a spa, a fitness center, a casino, and a restaurant. The hotel is also close to many popular attractions in Pesaro, including the Palazzo Ducale and the Basilica of San Francesco.', 'src/images/hotel_images/646a360952734_hotel-7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(5, 'admin', 'c4ca4238a0b923820dcc509a6f75849b'),
(6, 'Gunay', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
