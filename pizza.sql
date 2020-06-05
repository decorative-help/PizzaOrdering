-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2020 at 04:42 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_factor` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `price_factor`, `created_at`, `updated_at`) VALUES
(1, 'Euro', 0.89, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'John Doe',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_methods`
--

CREATE TABLE `delivery_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_factor` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_methods`
--

INSERT INTO `delivery_methods` (`id`, `name`, `price_factor`, `created_at`, `updated_at`) VALUES
(1, 'Delivery', 7.20, NULL, NULL),
(2, 'Take Away', 0.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2020_06_02_095300_create_pizzas_table', 1),
(3, '2020_06_02_122608_create_customers_table', 1),
(4, '2020_06_02_152234_create_sizes_table', 1),
(5, '2020_06_02_152653_create_toppings_table', 1),
(6, '2020_06_02_152737_create_payments_table', 1),
(7, '2020_06_02_152810_create_delivery_methods_table', 1),
(8, '2020_06_03_143808_create_orders_table', 1),
(9, '2020_06_03_144604_create_ordered_pizzas_table', 1),
(10, '2020_06_05_112042_create_currencies_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_pizzas`
--

CREATE TABLE `ordered_pizzas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `pizza_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `topping_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `delivery_method_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `total_price` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_factor` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `price_factor`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 1.00, NULL, NULL),
(2, 'Bank Card', 0.90, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pizzas`
--

CREATE TABLE `pizzas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pizzas`
--

INSERT INTO `pizzas` (`id`, `name`, `image_link`, `description`, `basic_price`, `created_at`, `updated_at`) VALUES
(1, 'Buffalo Chicken', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/buffalo-chicken-pizza.png', 'All the Zing, without the wing - This tangy, spicy pie is made for Game Day. Kick off with Buffalo blue cheese sauce, grilled chicken, red onions, fire-roasted red peppers and mozzarella cheese.', 13.29, NULL, NULL),
(2, 'Chipotle Chicken', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/Chipotle-Chicken.png', 'Smoky, zesty and bold - This Southwest-style flavor-bomb is set off with smoky chipotle sauce, then topped with chipotle chicken, zesty red onions, and melty mozzarella. Me gusta?', 11.69, NULL, NULL),
(3, 'Chicken Bruschetta', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/chickenbruschetta.png', 'A Twist on Italian Taste - What can make bruschetta better? How about grilled chicken? Add roasted garlic, Italiano Blend Seasoning, parmesan and mozzarella, and it\'s molto deliziosa.', 14.79, NULL, NULL),
(4, 'Chipotle Steak', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/Chipotle-Steak.png', 'Smoky chipotle meets sizzling steak - his hearty Southwest-inspired pie combines smoky chipotle sauce, tender steak, zesty red onions, and melty mozzarella.VIVA CHIPOTLE!', 11.69, NULL, NULL),
(5, 'Bacon Double Cheeseburger ', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/bacondblchburg.png', 'Cheeseburger. Pizza. Enough Said - Yeah, we did it. Crush two comfort-food classics in one, with ground beef, bacon crumble and four-cheese blend. Try it with Honey Mustard dipping sauce for extra burger bite!', 10.69, NULL, NULL),
(6, 'Canadian Eh!', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/canadian.png', 'True north delicious - As Canadian as a toque on a moose. Pepperoni, fresh mushrooms, bacon crumble and 100% Canadian Dairy mozzarella cheese.', 12.19, NULL, NULL),
(7, 'Classic Super', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/12400.png', 'The Pizza Pizza original - A staple since 1967, this one never goes out of style! A classic combo of pepperoni, fresh mushrooms, green peppers, and mozzarella cheese.', 12.19, NULL, NULL),
(8, 'Sausage Mushroom Melt', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/SausageMelt.png', 'Creamy, dreamy and melty - Meet your dream pizza: rich, tasteful and?savoury. Made with creamy garlic sauce, spicy Italian sausage, fresh mushrooms, Italiano blend seasoning, and ooey-gooey mozzarella cheese. ', 10.69, NULL, NULL),
(9, 'Spicy BBQ Chicken', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/bbqchicken.png', 'Saddle up for a slice - It\'s a showdown at Flavour Corral, with grilled chicken, hot banana peppers, red onions, Texas BBQ sauce and mozzarella cheese. Wanna amp it up even more? Add Frank\'s Red Hot!', 13.29, NULL, NULL),
(10, 'Tropical Hawaiian ', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/12700.png', 'Grab your floral shirt and dip in - Don\'t let anyone tell you it isn\'t amazing. This taste of the tropics brings together sweet pineapple, bacon crumble, bacon strips, and mozzarella cheese for a beach vacation on Flavour Island! ', 13.29, NULL, NULL),
(11, 'Sweet Heat', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/13830.png', 'A fiery bite with a sweet twist - Sometimes opposites attract and make sweet, spicy magic! Trust us, the combo of grilled chicken, pineapple, hot banana peppers and mozzarella cheese is totally amazing.', 13.29, NULL, NULL),
(12, 'Pepperoni', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/Pepperoni.png', 'The all-time favourite - It doesn\'t get any more iconic than this. Savoury pepperoni, homestyle sauce, and ooey-gooey, stretchy mozzarella. Perfection!', 9.19, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_factor` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `price_factor`, `created_at`, `updated_at`) VALUES
(1, 'Small', 0.80, NULL, NULL),
(2, 'Medium', 1.00, NULL, NULL),
(3, 'Large', 1.20, NULL, NULL),
(4, 'X-Large', 1.50, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `toppings`
--

CREATE TABLE `toppings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_factor` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toppings`
--

INSERT INTO `toppings` (`id`, `name`, `price_factor`, `created_at`, `updated_at`) VALUES
(1, 'Bruschetta', 0.50, NULL, NULL),
(2, 'Goat Cheese', 0.90, NULL, NULL),
(3, 'Caramelized Onions', 0.70, NULL, NULL),
(4, 'Fire Roasted Red Peppers', 1.00, NULL, NULL),
(5, 'Fresh Mushrooms', 1.50, NULL, NULL),
(6, 'Green Olives', 0.10, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_methods`
--
ALTER TABLE `delivery_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_pizzas`
--
ALTER TABLE `ordered_pizzas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordered_pizzas_order_id_foreign` (`order_id`),
  ADD KEY `ordered_pizzas_pizza_id_foreign` (`pizza_id`),
  ADD KEY `ordered_pizzas_size_id_foreign` (`size_id`),
  ADD KEY `ordered_pizzas_topping_id_foreign` (`topping_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_payment_id_foreign` (`payment_id`),
  ADD KEY `orders_delivery_method_id_foreign` (`delivery_method_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toppings`
--
ALTER TABLE `toppings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_methods`
--
ALTER TABLE `delivery_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ordered_pizzas`
--
ALTER TABLE `ordered_pizzas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `toppings`
--
ALTER TABLE `toppings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordered_pizzas`
--
ALTER TABLE `ordered_pizzas`
  ADD CONSTRAINT `ordered_pizzas_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordered_pizzas_pizza_id_foreign` FOREIGN KEY (`pizza_id`) REFERENCES `pizzas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordered_pizzas_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordered_pizzas_topping_id_foreign` FOREIGN KEY (`topping_id`) REFERENCES `toppings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_delivery_method_id_foreign` FOREIGN KEY (`delivery_method_id`) REFERENCES `delivery_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
