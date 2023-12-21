-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Dec 03, 2023 at 01:43 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_management`
--
CREATE DATABASE IF NOT EXISTS `recipe_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `recipe_management`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner'),
(4, 'Snacks'),
(5, 'Desserts');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `ingredient_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `quantity_unit` varchar(50) NOT NULL,
  PRIMARY KEY (`ingredient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `name`, `quantity_unit`) VALUES
(1, 'Salt', '1 teaspoon'),
(2, 'Black Pepper', '1/2 teaspoon'),
(3, 'Olive Oil', '2 tablespoons'),
(4, 'Garlic', '2 cloves, minced'),
(5, 'Onion', '1 medium, chopped'),
(6, 'Chicken Breast', '2 cups, cooked and shredded'),
(7, 'Pasta', '8 ounces, cooked'),
(8, 'Tomato', '2 medium, diced'),
(9, 'Cheese', '1 cup, shredded'),
(10, 'Lettuce', '1 head, shredded'),
(11, 'Cucumber', '1, sliced'),
(12, 'Bell Pepper', '1, diced'),
(13, 'Rice', '1 cup, cooked'),
(14, 'Soy Sauce', '2 tablespoons'),
(15, 'Ginger', '1 tablespoon, minced'),
(16, 'Eggs', '4, beaten'),
(17, 'Flour', '1 cup'),
(18, 'Sugar', '1/2 cup'),
(19, 'Baking Powder', '1 teaspoon'),
(20, 'Thyme', '1/2 cup'),
(21, 'Garlic', '1 teaspoon'),
(22, 'Bok Choy', '3 bag'),
(23, 'Noodle', '1 bag'),
(24, 'Shallot', '2 teaspoon'),
(25, 'Fish Sauce', '1 teaspoon'),
(26, 'Beef slices', '90 grams'),
(27, 'Cinnamon sticks', '5 pieces'),
(28, 'Star anise', '6 pieces'),
(29, 'Bean sprouts', 'cups'),
(30, 'Kimchi', '2 cups'),
(31, 'Kimchi juice', '2 tablespoons'),
(32, 'Kimchi paste', '3 tablespoons'),
(33, 'Carrots', '3 grams'),
(34, 'Shrimp', '4 grams'),
(35, 'Lemongrass', '4 stalks'),
(36, 'Galangal', '3 grams'),
(37, 'Kaffir lime leaves', '10 leaves'),
(38, 'Thai chilies', '5 pieces'),
(39, 'Mushrooms', '5 grams'),
(40, 'Rice vermicelli', '3 grams'),
(41, 'Pork hock', '8 grams'),
(42, 'Pigs blood cubes', '4 pieces'),
(43, 'Shrimp paste', '2 tablespoons'),
(44, 'Anchovy fish sauce', '3 tablespoons'),
(45, 'Vietnamese mint', '5 grams');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `recipe_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `recipe_name` varchar(255) NOT NULL,
  `description` text,
  `instructions` text,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modification_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image_path` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `prep_cook_time` int DEFAULT NULL,
  `servings` int DEFAULT NULL,
  `difficulty_level` enum('easy','medium','hard') DEFAULT NULL,
  `rating` int DEFAULT NULL,
  PRIMARY KEY (`recipe_id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `user_id`, `recipe_name`, `description`, `instructions`, `creation_date`, `modification_date`, `image_path`, `category_id`, `prep_cook_time`, `servings`, `difficulty_level`, `rating`) VALUES
(20, 20, 'Avocado Toast', 'Simple and nutritious avocado toast with a variety of toppings', '1. Mash ripe avocado onto toasted bread, 2. Add toppings like tomatoes, radishes, and a sprinkle of salt', '2023-11-29 06:14:20', '2023-12-02 20:38:10', 'https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fstatic.onecms.io%2Fwp-content%2Fuploads%2Fsites%2F19%2F2016%2F07%2F29%2F1609-avo-tahini-toast-ckl-2000.jpg&q=60', 1, 10, 2, 'easy', 5),
(19, 19, 'Tom Yum Soup', 'Hot and sour Thai soup with shrimp and herbs', '1. Simmer shrimp and herbs for broth, 2. Add vegetables and spices, 3. Serve hot', '2023-11-29 06:14:20', '2023-12-02 20:38:39', 'https://hot-thai-kitchen.com/wp-content/uploads/2013/03/tom-yum-goong-blog.jpg', 2, 30, 2, 'medium', 5),
(18, 18, 'Bun Bo Hue', 'Spicy Vietnamese noodle soup with beef and lemongrass', '1. Simmer beef and lemongrass for broth, 2. Cook rice noodles and assemble with herbs', '2023-11-29 06:14:20', '2023-12-02 20:39:05', 'https://www.foodandwine.com/thmb/oQxMr-wP2YjxLZ63kRmGnlDy4ZI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Bun-bo-Hue-Vietnamese-Vermicelli-Noodle-Soup-with-Sliced-Beef-XL-RECIPE0423-47194f9a6efb4695ac72c76798f6aa64.jpg', 3, 45, 5, 'medium', 5),
(17, 17, 'Fried Chicken', 'Crispy Korean-style fried chicken', '1. Coat chicken in seasoned flour, 2. Fry until golden and crispy', '2023-11-29 06:14:20', '2023-12-02 20:39:21', 'https://food.fnr.sndimg.com/content/dam/images/food/fullset/2012/11/2/0/DV1510H_fried-chicken-recipe-10_s4x3.jpg.rend.hgtvcom.1280.1280.suffix/1568222255998.jpeg', 4, 40, 3, 'easy', 5),
(16, 16, 'Swedish Meatballs', 'Homemade Swedish meatballs with creamy sauce', '1. Mix and shape meatballs, 2. Cook and serve with creamy sauce', '2023-11-29 06:14:20', '2023-12-02 20:39:45', 'https://images.services.kitchenstories.io/hP04DDCA2zQ-oTBkgfZDNJ52CHw=/3840x0/filters:quality(85)/images.kitchenstories.io/wagtailOriginalImages/R2854-photo-final-1.jpg', 2, 30, 4, 'medium', 5),
(15, 15, 'Hummus and Pita', 'Classic hummus with soft and warm pita bread', '1. Blend chickpeas, garlic, and tahini, 2. Serve with warm pita bread', '2023-11-29 06:14:20', '2023-12-02 20:40:41', 'https://showmars.com/wp-content/uploads/2021/03/Hummus-Pita-675x456-1.png', 3, 10, 8, 'hard', 4),
(14, 14, 'Honey Glazed Pineapple', 'Grilled honey glazed pineapple for a sweet treat', '1. Grill pineapple slices with honey glaze, 2. Serve as a refreshing dessert', '2023-11-29 06:14:20', '2023-12-02 20:42:26', 'https://princesspinkygirl.com/wp-content/uploads/2021/05/Grilled-Pineapple-Rings-15-hero.jpg', 4, 15, 6, 'medium', 5),
(13, 13, 'Pho', 'Vietnamese Ox Tail Pho with fragrant broth', '1. Simmer ox tail for broth, 2. Cook rice noodles and assemble with herbs', '2023-11-29 06:14:20', '2023-12-02 20:42:50', 'https://www.recipetineats.com/wp-content/uploads/2019/04/Beef-Pho_6.jpg', 5, 60, 2, 'medium', 5),
(12, 12, 'Taco', 'Delicious pork taco with fresh toppings', '1. Season and cook pork, 2. Assemble tacos with salsa and cilantro', '2023-11-29 06:14:20', '2023-12-02 20:43:08', 'https://feelgoodfoodie.net/wp-content/uploads/2017/04/Ground-Beef-Tacos-9.jpg', 1, 25, 8, 'hard', 4),
(10, 10, 'BBQ Pulled Pork Sandwich', 'Savory BBQ pulled pork sandwich with coleslaw', '1. Slow-cook pulled pork, 2. Assemble sandwich with coleslaw and BBQ sauce', '2023-11-29 06:14:20', '2023-12-02 20:43:51', 'https://saltpepperskillet.com/wp-content/uploads/pulled-pork-sandwiches-on-butcher-paper-horizontal.jpg', 2, 240, 5, 'hard', 4),
(11, 11, 'Kimchi Fried Rice', 'Spicy Kimchi fried rice with vegetables and tofu', '1. Sauté vegetables and tofu, 2. Stir-fry with Kimchi and rice, 3. Season to taste', '2023-11-29 06:14:20', '2023-12-02 20:43:29', 'https://www.recipetineats.com/wp-content/uploads/2021/03/Kimchi-Fried-Rice-Skillet.jpg', 3, 35, 4, 'medium', 4),
(9, 9, 'Pad Thai', 'Authentic Pad Thai with stir-fried noodles and shrimp', '1. Stir-fry shrimp and noodles, 2. Toss with Pad Thai sauce and peanuts', '2023-11-29 06:14:20', '2023-12-02 20:44:22', 'https://www.onceuponachef.com/images/2016/03/pad-thai-1200x1483.jpg', 4, 30, 3, 'medium', 5),
(8, 8, 'Greek Gyro', 'Traditional Greek gyro with seasoned pork and tzatziki', '1. Season and grill pork, 2. Assemble gyro with pita and tzatziki', '2023-11-29 06:14:20', '2023-12-02 20:44:51', 'https://www.greekboston.com/wp-content/uploads/2018/07/Traditional-Gyro.jpg', 5, 20, 2, 'easy', 5),
(7, 7, 'Sweet and Sour Chicken', 'Homemade sweet and sour chicken with colorful vegetables', '1. Coat chicken in batter, 2. Fry until crispy, 3. Toss in sweet and sour sauce', '2023-11-29 06:14:20', '2023-12-02 20:45:18', 'https://www.swankyrecipes.com/wp-content/uploads/2022/05/Best-Sweet-and-Sour-Chicken.jpg', 2, 30, 4, 'medium', 5),
(6, 6, 'Creamy Mushroom Risotto', 'Creamy mushroom risotto with Arborio rice', '1. Sauté mushrooms, 2. Cook Arborio rice with broth, 3. Stir in cream and Parmesan', '2023-11-29 06:14:20', '2023-12-02 20:45:44', 'https://www.threeolivesbranch.com/wp-content/uploads/2020/12/creamy-mushroom-risotto-threeolivesbranch-6-500x375.jpg', 3, 40, 6, 'medium', 4),
(5, 5, 'Chocolate Chip Cookies', 'Soft and chewy chocolate chip cookies', '1. Mix dough with chocolate chips, 2. Drop onto baking sheet, 3. Bake until golden brown', '2023-11-29 06:14:20', '2023-12-02 20:46:08', 'https://sallysbakingaddiction.com/wp-content/uploads/2013/05/classic-chocolate-chip-cookies.jpg', 5, 15, 24, 'easy', 4),
(4, 4, 'Homemade Pizza', 'Classic Margherita pizza with fresh ingredients', '1. Prepare pizza dough, 2. Top with tomatoes, mozzarella, and basil, 3. Bake until golden', '2023-11-29 06:14:20', '2023-12-02 20:46:31', 'https://theschmidtywife.com/wp-content/uploads/2021/02/Featured_Homemade_Pizza-735x1103.jpg', 4, 35, 4, 'medium', 5),
(3, 3, 'Grilled Chicken Salad', 'Grilled chicken salad with fresh greens and vinaigrette', '1. Grill chicken, 2. Toss with salad greens, 3. Drizzle with vinaigrette', '2023-11-29 06:14:20', '2023-12-02 20:46:56', 'https://www.spendwithpennies.com/wp-content/uploads/2023/06/Grilled-Chicken-Caesar-Salad-SpendWithPennies-4.jpg', 3, 25, 3, 'easy', 5),
(2, 2, 'Vegetarian Stir-Fry', 'Healthy and delicious vegetable stir-fry', '1. Chop vegetables, 2. Stir-fry with tofu, 3. Season and serve', '2023-11-29 06:14:20', '2023-12-02 20:47:17', 'https://therecipecritic.com/wp-content/uploads/2019/08/vegetable_stir_fry.jpg', 2, 20, 2, 'easy', 5),
(1, 1, 'Classic Spaghetti Bolognese', 'Spaghetti Bolognese with a rich meat sauce', '1. Cook spaghetti, 2. Prepare meat sauce, 3. Combine and serve', '2023-11-29 06:14:20', '2023-12-02 20:47:47', 'https://thecozycook.com/wp-content/uploads/2019/08/Bolognese-Sauce.jpg', 1, 30, 4, 'medium', 5);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

DROP TABLE IF EXISTS `recipe_ingredients`;
CREATE TABLE IF NOT EXISTS `recipe_ingredients` (
  `recipe_ingredient_id` int NOT NULL AUTO_INCREMENT,
  `recipe_id` int DEFAULT NULL,
  `ingredient_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`recipe_ingredient_id`),
  KEY `recipe_id` (`recipe_id`),
  KEY `ingredient_id` (`ingredient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`recipe_ingredient_id`, `recipe_id`, `ingredient_id`, `quantity`, `unit`) VALUES
(1, 1, 1, 200, 'g'),
(2, 1, 6, 200, 'g'),
(3, 1, 7, 150, 'g'),
(4, 1, 13, 3, ''),
(5, 1, 16, 100, 'g'),
(6, 1, 18, 3, ''),
(7, 1, 21, 50, 'g'),
(8, 2, 26, 500, 'g'),
(9, 2, 27, 4, ''),
(10, 2, 30, 4, ''),
(11, 2, 32, 1, 'head'),
(12, 2, 33, 2, ''),
(13, 2, 36, 1, 'onion'),
(14, 3, 34, 3, ''),
(15, 3, 39, 200, 'g'),
(16, 3, 40, 100, 'g'),
(17, 3, 42, 2, ''),
(18, 3, 46, 1, 'head'),
(19, 3, 47, 3, ''),
(20, 4, 50, 500, 'g'),
(21, 4, 51, 1, 'cup'),
(22, 4, 54, 12, 'count'),
(23, 4, 55, 1, 'bunch'),
(24, 4, 58, 2, 'count'),
(25, 4, 59, 1, 'head'),
(26, 5, 67, 1, 'whole'),
(27, 5, 68, 200, 'g'),
(28, 5, 69, 2, 'count'),
(29, 5, 70, 1, 'bottle'),
(30, 5, 73, 1, 'bunch'),
(31, 5, 74, 3, 'count'),
(32, 6, 79, 3, 'cups'),
(33, 6, 81, 200, 'g'),
(34, 6, 86, 2, 'count'),
(35, 6, 87, 1, 'bunch'),
(36, 6, 89, 2, 'tbsp'),
(37, 6, 91, 2, 'tbsp'),
(38, 7, 94, 2, 'racks'),
(39, 7, 97, 2, 'tbsp'),
(40, 7, 98, 1, 'tbsp'),
(41, 7, 101, 1, 'tbsp'),
(42, 7, 104, 1, 'tbsp'),
(43, 7, 105, 1, 'tbsp'),
(44, 8, 109, 2, 'count'),
(45, 8, 114, 500, 'g'),
(46, 8, 115, 1, 'cup'),
(47, 8, 118, 1, 'can'),
(48, 8, 121, 2, 'tsp'),
(49, 8, 124, 1, 'tsp'),
(50, 9, 131, 6, 'count'),
(51, 9, 134, 1, 'cup'),
(52, 9, 137, 1, 'cup'),
(53, 9, 140, 1, 'cup'),
(54, 9, 143, 1, 'tsp'),
(55, 9, 146, 1, 'cup'),
(56, 10, 1, 200, 'g'),
(57, 10, 6, 200, 'g'),
(58, 10, 7, 150, 'g'),
(59, 10, 13, 3, ''),
(60, 10, 16, 100, 'g'),
(61, 11, 18, 3, ''),
(62, 11, 21, 50, 'g'),
(63, 11, 26, 500, 'g'),
(64, 11, 27, 4, ''),
(65, 12, 30, 4, ''),
(66, 12, 32, 1, 'head'),
(67, 12, 33, 2, ''),
(68, 12, 36, 1, 'onion'),
(69, 13, 34, 3, ''),
(70, 13, 39, 200, 'g'),
(71, 13, 40, 100, 'g'),
(72, 13, 42, 2, ''),
(73, 13, 46, 1, 'head'),
(74, 13, 47, 3, ''),
(75, 14, 50, 500, 'g'),
(76, 14, 51, 1, 'cup'),
(77, 14, 54, 12, 'count'),
(78, 14, 55, 1, 'bunch'),
(79, 14, 58, 2, 'count'),
(80, 14, 59, 1, 'head'),
(81, 15, 67, 1, 'whole'),
(82, 15, 68, 200, 'g'),
(83, 15, 69, 2, 'count'),
(84, 15, 70, 1, 'bottle'),
(85, 15, 73, 1, 'bunch'),
(86, 15, 74, 3, 'count'),
(87, 16, 79, 3, 'cups'),
(88, 16, 81, 200, 'g'),
(89, 16, 86, 2, 'count'),
(90, 16, 87, 1, 'bunch'),
(91, 16, 89, 2, 'tbsp'),
(92, 16, 91, 2, 'tbsp'),
(93, 17, 94, 2, 'racks'),
(94, 17, 97, 2, 'tbsp'),
(95, 17, 98, 1, 'tbsp'),
(96, 17, 101, 1, 'tbsp'),
(97, 17, 104, 1, 'tbsp'),
(98, 17, 105, 1, 'tbsp'),
(99, 18, 109, 2, 'count'),
(100, 18, 114, 500, 'g'),
(101, 18, 115, 1, 'cup'),
(102, 18, 118, 1, 'can'),
(103, 18, 121, 2, 'tsp'),
(104, 18, 124, 1, 'tsp'),
(105, 19, 131, 6, 'count'),
(106, 19, 134, 1, 'cup'),
(107, 19, 137, 1, 'cup'),
(108, 19, 140, 1, 'cup'),
(109, 19, 143, 1, 'tsp'),
(110, 19, 146, 1, 'cup'),
(111, 20, 6, 200, 'g'),
(112, 20, 7, 150, 'g'),
(113, 20, 13, 3, ''),
(114, 20, 16, 100, 'g');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `recipe_id` int DEFAULT NULL,
  `review_text` text,
  `review_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`),
  KEY `user_id` (`user_id`),
  KEY `recipe_id` (`recipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `recipe_id`, `review_text`, `review_date`) VALUES
(1, 1, 1, 'Delicious spaghetti recipe! My family loved it!', '2023-01-20 07:00:00'),
(2, 2, 2, 'Great twist to veggie stir-fry!', '2023-02-05 07:00:00'),
(3, 3, 3, 'Loved the grilled chicken salad!', '2023-03-15 06:00:00'),
(4, 4, 4, 'Homemade pizza was so much better than store bought! Never going back.', '2023-04-10 06:00:00'),
(5, 5, 5, 'Best chocolate chip cookies ever!', '2023-05-25 06:00:00'),
(6, 6, 6, 'Creamy mushroom risotto was so creamy!', '2023-06-25 06:00:00'),
(7, 7, 7, 'Sweet and sour chicken was delicious!', '2023-07-10 06:00:00'),
(8, 8, 8, 'Greek gyro was refreshing!', '2023-08-20 06:00:00'),
(9, 9, 9, 'Perfect pad thai! Reminded me of my home country', '2023-09-28 06:00:00'),
(10, 10, 10, 'BBQ pulled pork sandwich was a hit!', '2023-10-15 06:00:00'),
(11, 11, 11, 'Kimchi fried rice was spicy and tasty!', '2023-11-10 07:00:00'),
(12, 12, 12, 'The tacos were so juicy!', '2023-12-31 07:00:00'),
(13, 13, 13, 'Pho was authentic and delicious!', '2024-01-15 07:00:00'),
(14, 14, 14, 'Better than pineapples on pizza!', '2024-02-22 07:00:00'),
(15, 15, 15, 'Hummus and pita were a perfect snack!', '2024-03-10 07:00:00'),
(16, 16, 16, 'Swedish meatballs were savory!', '2024-04-25 06:00:00'),
(17, 17, 17, 'The best Korean fried chicken I have ever made in my life!', '2024-05-15 06:00:00'),
(18, 18, 18, 'Bun Bo Hue tasted spicy and savory! I will make this for my in-laws next week!', '2024-06-30 06:00:00'),
(19, 19, 19, 'I couldn\'t get enough of this Tomyum!', '2024-07-20 06:00:00'),
(20, 20, 20, 'Avocado toast made a tasty breakfast!', '2024-08-08 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `role_id` enum('admin','user') NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `role_id`, `email`, `password`) VALUES
(9, 'GiselleA', 'user', 'aerichandesu@smtown.com', '$2y$10$FtFQd3vcZkTRw7oXpyudUeUR3m9BFXfrMKca2klK.sgZTzBXEUiRK'),
(7, 'NingNing', 'admin', 'bemyae@smtown.com', '$2y$10$RViPFQpkKu0DwXObL5NaGODO5akEBl7MFGliyThM2H1jopYdAQpYG'),
(6, 'IreneBae', 'user', 'redvelvet@smtown.com', '$2y$10$Srg8hUm9Y1Uj5gXYWPb2XOs9liFHKZ4uQ3rxZ97HzxDobQvuXVpUm'),
(5, 'Pewdiepie', 'user', 'pewpew@pie.com', '$2y$10$2xqJ/pda39eS8/SNIntCo.r1LXoNwS6olgOGJvg.XsqECQHPGqyIy'),
(4, 'GordonRamsay', 'admin', 'cheframsay@gmail.com', '$2y$10$p3wXhT7GgGEctO2rRLHvX.Sq/8idqTgaHtRBI6DJRe841UUidf49i'),
(3, 'MileyCyrus', 'user', 'whatsgoodmiley@gmail.com', '$2y$10$ehovAW9QRyHWDlvBCMZonu2rvCVydj.naqVU/dMuEvx2Fo4EywEya'),
(2, 'JustinBieber', 'user', 'jb@gmail.com', '$2y$10$EX2Rk2JZFLfE3ANjulmXtuLGRpIuCHVOdXV.b7444YAvIfvBLlPf.'),
(1, 'SteveJobs', 'admin', 'steve@apple.com', '$2y$10$DxGWHHjl3vZoguOSZgHH6uYcD2FXcpN7Kf.sXMDfGNTIfY/yGN1G6'),
(10, 'MaxPrice', 'admin', 'maxprice@gmail.com', '$2y$10$uBxMpwkdqOdlqYQrgjNxfOHnbk.NyaisgaC/lzICtB/JraYm/VAN6'),
(11, 'RioDePinco', 'user', 'riothekingkitty@gmail.com', '$2y$10$njPc/WGt5lrRdJd7UynLp.4xbLZv8.2X6OswcYT/kObNbl1MuVzfm'),
(12, 'LuvySivongsa', 'user', 'luvylovesyou@gmail.com', '$2y$10$Y/laRLJ/Cd9MMkVb1kLYS..WMseDP90QPmtXkC8BSFd1i7vRlBxKK'),
(13, 'SwethaUppula', 'admin', 'swethauppula@gmail.com', '$2y$10$pr0WNMIax6.aPFJnOFsk5.d1vPnelAZEioSUdr9GGaO.wQxrRnHX2'),
(14, 'YangYiPing', 'user', 'yangxi@gmail.com', '$2y$10$jgo9EscgkQKayWKlYjwsHu19E8M3uKeP0q2MJh0S8cwI4pySqf6Tu'),
(15, 'KangSeulgi', 'user', 'kredvelvet@gmail.com', '$2y$10$5qVbbNnH3U7dC2aLqK.PnuWiOzVLheh6.tgKOJZa0AEMgh7BG12IC'),
(16, 'TiniMai', 'admin', 'tinimai@gmail.com', '$2y$10$5k4Unk.8iPxStcUbys4di.hXrXz.3KpQNyZN/6/lsJe1WyHskgzse'),
(17, 'ArchDrury', 'user', 'archdrury@gmail.com', '$2y$10$Yld/v1yL.C8J61tfelf6juxTYJ.FZS8sl5VnCqKJGuKel.6kAPSRy'),
(18, 'CocoChanel', 'user', 'cc@gmail.com', '$2y$10$cQ2Kfr1/jPaSUowq4FXA8OjK20XNTd7IaTnQ5gYaA.SFvbk6R0uOm'),
(19, 'ProfessorChong', 'admin', 'chongoh@gmail.com', '$2y$10$FPGWbkai/Oer0he8Qenu6OjYUCYIBPbPjZqYOGTfqj1w.NHfPglN.'),
(20, 'ElonMusk', 'user', 'elon@tesla.com', '$2y$10$ieOCVW1CHa0E0/QTZ79Ase0jK8u6cTjq.x3l87jICN.pwjfvRy/9e'),
(21, 'pjones', 'admin', 'pjones@gmail.com', '$2y$10$w9F4Mxl3.Ic4UpK7FBZtWeZAltXPIYBJAX190pHAqCpxrTE4nsiK6'),
(22, 'bsmith', 'admin', 'bsmith@gmail.com', '$2y$10$KbxdMXI91Xsw2fdZu4Hzved8zi.ZzuPAbePsZu3fv0H20Ii83Yp1S');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;