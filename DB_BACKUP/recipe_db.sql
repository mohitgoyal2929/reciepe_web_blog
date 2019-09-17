-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 29, 2019 at 06:43 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image`) VALUES
(1, 'Vegetarian', 'This category is for pure vegetarian food', ''),
(2, 'Non Vegetarian', 'This type of food contains eggs, flesh etc. Not for vegetarians. If the food looks vegetarian, but still contain eggs if any recipe marked this.', ''),
(3, 'Indian', 'The traditional Indian food recipes, which were made with local spices and vegetables only.', ''),
(4, 'Chinese', 'Chinese traditional dishes cooking recipe.', ''),
(5, 'Labenese', 'Lebanese cuisine is a Levantine style of cooking that includes an abundance of whole grains, fruits, vegetables, starches, fresh fish and seafood; animal fats are consumed sparingly.', ''),
(15, 'Pizza', 'a dish of Italian origin, consisting of a flat round base of dough baked with a topping of tomatoes and cheese, typically with added meat, fish, or vegetables.', ''),
(16, 'Rice', '', ''),
(17, 'Drinks & Cocktails', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`user_id`, `recipe_id`) VALUES
(1, 1),
(1, 4),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `description`) VALUES
(3, 'Onion Choped', 'this is onion category, that is briefly choped'),
(4, 'Garlic', 'An indian spice - Garlic. Usually smells.'),
(6, 'Peanut', 'Indian peanuts are kind of dry fruits.'),
(7, 'Ginger', 'Indian spice usually used to make spicy curry'),
(8, 'Broccoli Florets', 'Broccoli is an edible green plant in the cabbage family (Brassicas) whose large flowering head ... Close-ups of broccoli florets '),
(9, 'ricotta cheese', ''),
(10, 'Parmesan cheese', ''),
(11, 'cream', ''),
(12, 'garlic cloves', ''),
(13, 'green onion', ''),
(14, 'asparagus', ''),
(15, 'mozzarella cheese', ''),
(16, 'capicollo', ''),
(17, 'burratas', ''),
(18, 'baby kale', ''),
(19, 'arugula', ''),
(20, 'olive oil', ''),
(21, 'tomato paste', ''),
(22, 'dried oregano', ''),
(23, 'balsamic vinegar', ''),
(24, 'Salt', ''),
(25, 'pepper', ''),
(26, 'basmati rice', ''),
(27, 'cardamom', ''),
(28, 'clove', ''),
(29, 'bay leaf', ''),
(30, 'stick cinnamon', ''),
(31, 'sushi rice', ''),
(32, 'unseasoned rice vinegar', ''),
(33, 'sugar', ''),
(35, 'Cranberry Juice', ''),
(36, 'Brandy', ''),
(37, 'Triple Sec', ''),
(38, 'Mixed Berries', ''),
(39, 'Lychees in Syrup', ''),
(40, 'Oranges', ''),
(41, 'Angostura bitters', '');

-- --------------------------------------------------------

--
-- Table structure for table `meal_type`
--

CREATE TABLE `meal_type` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meal_type`
--

INSERT INTO `meal_type` (`id`, `name`, `description`) VALUES
(1, 'Breakfast', 'Generally morning food recipes'),
(2, 'Lunch', 'Food that will suits the afternoon food'),
(3, 'Dinner', 'Food that suits the night meal.'),
(4, 'Snacks', 'Food that will suits the breakfast or evening snacks.'),
(5, 'Cheat Meal', 'The meal that is supposed to be taken by a dieting person. It should be healthy and contains good level of minerals and vitamins, that helps one to enjoy taste of food without taking any risk to health.'),
(13, 'Main Dish', 'The main course is the featured or primary dish in a meal consisting of several courses. It usually follows the entrÃ©e course.'),
(14, 'Appetizers', 'a small dish of food or a drink taken before a meal or the main course of a meal to stimulate one\'s appetite.');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`user_id`, `recipe_id`, `rating`, `comment`) VALUES
(1, 1, 4, ''),
(1, 4, 5, ''),
(1, 6, 5, ''),
(2, 1, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `serving` tinyint(4) NOT NULL,
  `cooking_time` int(11) NOT NULL,
  `prep_time` int(11) NOT NULL,
  `meal_type_id` int(11) NOT NULL,
  `main_picture` text NOT NULL,
  `description` text NOT NULL,
  `nutrition_fact` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `name`, `serving`, `cooking_time`, `prep_time`, `meal_type_id`, `main_picture`, `description`, `nutrition_fact`, `date`, `user_id`) VALUES
(1, 'Cheese tikka', 1, 90, 120, 4, 'imgs/featured/3.png', '<h6>This is the recipe of Cheese Tikka AKA Paneer Tikka</h6>\r\n<p>Marinate the cheese for half an hour in the mustard oil with turmeric powder, chilly powder and salt. Don\'t forget to add garm Masala.</p>\r\n<p>After half hour, when cheese looks tender, heat your oven for 100<sup>o</sup>C, put your cheese in the over for 10 mins. After 10 mind remove cheese fomr oven</p>\r\n<p>Serve Hot with green chilly sauce.</p>', NULL, '2019-07-24 21:12:25', 1),
(2, 'Chicken Tikka', 5, 120, 150, 5, 'imgs/featured/chickentikka01.jpg', '<p>As we mentioned the ingredients, please be prepared with them. Chicken should be tendered and fresh.</p>\r\n<p>Marinate chicken with yogurt, garam masala, chilly powder and turmeric powder<p>\r\n<p>After half hour of marination, heat up your oven for minimum 100<sup>o</sup>C. Put your chicken pieced on cooking tray and let them cook for half hour.<p>\r\n<p>Take your food out from oven after prescribed time, Serve Hot with green sauce.</p>', NULL, '2019-07-26 11:23:05', 1),
(3, 'Creamy Broccoli Pizza', 4, 45, 50, 13, 'imgs/featured/6a00d8358081ff69e201b7c8ca0a48970b-pi.jpg', 'Ingredients: \r\n\r\nBroccoli Cream\r\n4 cups (280 g) broccoli florets\r\n1 container (300 g) ricotta cheese\r\n1/2 cup (35 g) Parmesan cheese, freshly grated\r\n1/2 cup (125 ml) 35 % cream\r\n2 garlic cloves, roughly chopped\r\n1 green onion, cut into pieces\r\n\r\nToppings:\r\n4 cups (280 g) broccoli florets\r\n3/4 lb (340 g) asparagus\r\n1 recipe pizza dough for 8 (see recipe)\r\n1 cup (100 g) mozzarella cheese, grated\r\n12 slices mild capicollo, torn in half\r\n2 burratas, about 1/2 lb (225 g) each, drained and cut in half right before serving\r\n2 cups (50 g) baby kale or arugula\r\n\r\nBroccoli Cream\r\n1. In a pot of salted boiling water, cook the broccoli until tender, about 3 minutes. With a slotted spoon, remove the broccoli (keep the pot of water). In a food processor, purÃ©e with the remaining ingredients until smooth. Use a spatula to scrape down the sides of the food processor as needed. Season with salt and pepper. Set aside.\r\n\r\nToppings\r\n2. Place a pizza stone or inverted baking sheet on the middle rack of the oven. Preheat the oven to 450Â°F (230Â°C).\r\n3. In the same pot of salted boiling water, cook the broccoli until tender, about 3 minutes. With a slotted spoon, remove the broccoli and run under cold water. Cook the asparagus in the same water until tender, about 2 minutes. Drain and run under cold water.\r\n4. Cut the dough into 4 equal pieces. On a lightly floured work surface, roll out one piece of dough into an 11-inch (28 cm) disc. Place on a square of parchment paper. Repeat with the remaining dough.\r\nCover each pizza with about 3/4 cup (180 ml) of the broccoli cream. Sprinkle with mozzarella. Divide the cooked vegetables and capicollo among the pizzas.\r\n5. Place 1 pizza at a time (with the parchment paper) on the pizza stone. Cook for 10 minutes or until the dough is cooked through and nicely golden. Immediately garnish with the burratas and kale.\r\n', NULL, '2019-07-27 13:47:56', 1),
(4, 'Quick and Easy Pizza', 4, 15, 12, 13, 'imgs/featured/Pepperoni-Pizza-Garlic-Crust.jpg', '<pre>\r\nINGREDIENTS\r\n\r\nSauce\r\n\r\n60 ml (1/4 cup) olive oil\r\n30 ml (2 tbsp) tomato paste\r\n2.5 ml (1/2 tsp) dried oregano\r\n2.5 ml (1/2 tsp) balsamic vinegar\r\n1 small clove garlic, finely chopped\r\nSalt and pepper\r\n\r\nPizza\r\n\r\n4 naan bread/ 4 tortillas\r\n500 ml (2 cups) toppings of your choice (bell peppers, mushrooms, sausage, smoked meat, cold cuts, leftover cooked chicken)\r\n375 ml (11/2 cups) grated mozzarella cheese\r\n\r\n\r\nPREPARATION\r\nSauce\r\n1. In a bowl, combine all the ingredients. Season with salt and pepper.\r\nPizza\r\n2. With the rack in the middle position, preheat the oven to 210 Â°C (425 Â°F). Line a baking sheet with parchment paper.\r\n3. Spread the sauce on the bread. Scatter the toppings and cheese on the bread. Place on the baking sheet and bake for 10 to 12 minutes or until the cheese has melted.\r\n</pre>', NULL, '2019-07-27 13:52:25', 1),
(5, 'Indian style pulao', 3, 20, 20, 13, 'imgs/featured/pulao-5123.jpg', '<pre>\r\nINGREDIENTS\r\n\r\n1 1/2 cups (345 g) basmati rice\r\n1 onion, finely chopped\r\n2 tbsp (30 ml) olive oil\r\n1 clove garlic, finely chopped\r\n3 pods cardamom\r\n1 clove\r\n1 bay leaf\r\n1 stick cinnamon, about 2 inches (5 cm) long\r\n3 cups (750 ml) water\r\nSalt and pepper\r\n\r\n\r\n\r\nPREPARATION\r\n1. In a bowl, place the rice and cover with cold water. Rinse the rice and repeat until the water runs clear. Drain well.\r\n2. In a medium saucepan over high heat, brown the onion in the oil. Add the garlic, spices and rice. Season with salt and pepper. Continue cooking over medium heat, stirring until the rice just begins to stick to the bottom of the pan. Add the water. Stir and bring to a boil.\r\n3. Cover and cook over low heat for about 12 minutes or until the rice is tender. Remove from the heat and let rest for 5 minutes.\r\n\r\n</pre>', NULL, '2019-07-27 13:59:13', 1),
(6, 'Basic sushi rice', 4, 20, 15, 13, 'imgs/featured/maxresdefault.jpg', '<pre>\r\nINGREDIENTS\r\n\r\n2 cups (500 ml) sushi rice (Calrose)\r\n2 cups (500 ml) cold water\r\n1/3 cup (75 ml) unseasoned rice vinegar\r\n2 teaspoons (10 ml) salt\r\n2 teaspoons (10 ml) sugar\r\n\r\n\r\nPREPARATION\r\n1. Place rice in a bowl and cover with cold water. Gently rinse rice until water becomes cloudy. Drain and repeat four to five times or until water runs completely clear. Leave rice in a sieve until it is well drained.\r\n2. Place rice and water into a rice cooker. Close the lid and start the cooking process.\r\n3. In a small bowl, combine vinegar, salt and sugar until it dissolves. Set aside.\r\n4. Place cooked rice in a bowl, ideally a stainless steel bowl. Add rice vinegar mixture and stir with a spatula. Stir until all rice has absorbed liquid (beware of hot steam). Make a hole in the centre of the rice and let rest for 5 minutes. Repeat two or three times. Let cool to room temperature. The rice is ready to be used to make sushi.\r\n</pre>', NULL, '2019-07-27 14:03:51', 1),
(7, ' Tutti Frutti Punch', 1, 5, 12, 14, 'imgs/featured/ALN0571_RECIPES_XMAS_TUTTI_FRUTTI_PUNCH_PD_455x315.jpg', '<pre>\r\nINGREDIENTS\r\n\r\n8 cups (2 litres) cold cranberry juice\r\n1 cup (250 ml) brandy\r\n1 cup (250 ml) triple sec\r\n1 bag (500 g) frozen mixed berries\r\n1 can (19 oz/540 ml) lychees in syrup\r\n2 oranges, sliced\r\nAngostura bitters (optional)\r\n\r\nPREPARATION\r\n1. In an 18-cup (4.5 litre) punch bowl, combine the cold cranberry juice, brandy, triple sec, frozen mixed berries, lychees in syrup and the sliced oranges. Add a few drops of Angostura bitters, if desired. Serve with ice.\r\n\r\n\r\n</pre>', 'Calories: 40,\r\nFat: 1g,\r\nCarbs: 6g,\r\nProtein: 1g\r\n<p> There are 40 calories in a 1 serving of Red Band Tutti Frutti Fruit Pastilles. </p>\r\n<p> Calorie breakdown: 24% fat, 65% carbs, 11% protein.</p>', '2019-07-28 09:42:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_category`
--

CREATE TABLE `recipe_category` (
  `recipe_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_category`
--

INSERT INTO `recipe_category` (`recipe_id`, `category_id`) VALUES
(2, 2),
(2, 3),
(3, 15),
(4, 15),
(5, 1),
(5, 16),
(6, 1),
(6, 16),
(7, 1),
(7, 17);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_gallery`
--

CREATE TABLE `recipe_gallery` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL DEFAULT 'image_recipe',
  `url` varchar(200) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_gallery`
--

INSERT INTO `recipe_gallery` (`id`, `recipe_id`, `name`, `url`, `size`) VALUES
(2, 2, 'chickentikka01.jpg, chickentikka02.jpg', 'imgs/chickentikka01.jpg, imgs/chickentikka02.jpg', 316852);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredient`
--

CREATE TABLE `recipe_ingredient` (
  `recipe_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_ingredient`
--

INSERT INTO `recipe_ingredient` (`recipe_id`, `ingredient_id`) VALUES
(2, 3),
(2, 4),
(2, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(4, 20),
(4, 21),
(4, 22),
(4, 23),
(4, 24),
(4, 25),
(5, 3),
(5, 4),
(5, 20),
(5, 24),
(5, 25),
(5, 26),
(5, 27),
(6, 3),
(6, 4),
(6, 24),
(6, 25),
(6, 31),
(6, 32),
(6, 33),
(7, 35),
(7, 36),
(7, 37),
(7, 38),
(7, 39),
(7, 40);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `value` varchar(400) NOT NULL,
  `last_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `last_changed`) VALUES
(11, 'website_name', 'Recipe Web Blog', '2019-07-24 09:52:16'),
(12, 'disable_registration', 'off', '2019-07-24 09:52:16'),
(45, 'facebook_link', 'https://facebook.com/recipewebblog', '2019-07-26 08:08:28'),
(46, 'twitter_link', 'https://twitter.com/recipewebblogs', '2019-07-26 08:08:28'),
(47, 'instagram_link', 'https://instagram.com/recipewebblog', '2019-07-26 08:08:28'),
(48, 'pinterest_link', 'https://pinterest.com/recipewebblog', '2019-07-26 08:08:28'),
(50, 'website_about', 'This is about text of the website. It can be changed now from the admin panel by the administrator. This text is coming from settings table. edited           ', '2019-07-26 08:12:14'),
(87, 'excerpt_length', '150', '2019-07-26 08:18:14'),
(112, 'excerpt_length_search', '100', '2019-07-26 13:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `description`, `image_url`, `created_at`) VALUES
(15, 'Crabcake Sandwiches with Chipotle RÃ©moulade', 'These are not your average sandwiches. The velvety ravigote sauce adds a bright, spicy and smoky flavor to the tender crabmeat. Plus, it\\\'s topped with crispy bacon and ripe tomato. It doesn\\\'t get better than that!', '/imgs/slides/recipe_1.jpeg', '2019-07-24 13:57:30'),
(16, 'Blue Crab, Bacon and Tomato Sandwiches', 'These are not your average sandwiches. The velvety ravigote sauce adds a bright, spicy and smoky flavor to the tender crabmeat. Plus, it\\\'s topped with crispy bacon and ripe tomato. It doesn\\\'t get better than that!', '/imgs/slides/recipe_2.jpeg', '2019-07-24 13:58:05'),
(17, 'Redfish and Creole Tomato Courtbouillon', 'I love this recipe because it shows off the best of Louisiana\\\'s wonderful seafood. This hearty soup is packed with fresh shrimp, redfish, oysters and crabmeat.', '/imgs/slides/recipe_3.jpeg', '2019-07-24 13:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `verfication_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `role`, `verfication_code`) VALUES
(1, 'david', 'ken', 'davidken', 'david@123', 'admin', ''),
(2, 'ben', 'stokes', 'benstokes', 'ben@123', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`recipe_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `meal_type`
--
ALTER TABLE `meal_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`user_id`,`recipe_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe_category`
--
ALTER TABLE `recipe_category`
  ADD PRIMARY KEY (`recipe_id`,`category_id`);

--
-- Indexes for table `recipe_gallery`
--
ALTER TABLE `recipe_gallery`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recipe` (`recipe_id`);

--
-- Indexes for table `recipe_ingredient`
--
ALTER TABLE `recipe_ingredient`
  ADD PRIMARY KEY (`recipe_id`,`ingredient_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `meal_type`
--
ALTER TABLE `meal_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recipe_gallery`
--
ALTER TABLE `recipe_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
