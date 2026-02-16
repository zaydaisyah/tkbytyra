-- TKBYTYRA Consolidated SQL Dump
-- Generated on: 2026-01-21 12:48:06

SET FOREIGN_KEY_CHECKS = 0;

--
-- Table structure for table `audit_logs`
--
DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE `audit_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `details` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `audit_logs`
--
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('2', '1', 'Login', 'User logged in: admin', '2026-01-16 17:49:36');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('3', '1', 'Logout', 'User logged out: admin', '2026-01-16 17:49:58');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('4', '1', 'Login', 'User logged in: tkadmin', '2026-01-16 17:57:02');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('5', '1', 'Logout', 'User logged out: tkadmin', '2026-01-16 17:57:08');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('6', '1', 'Login', 'User logged in: tkadmin', '2026-01-16 18:15:44');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('7', '1', 'Logout', 'User logged out: tkadmin', '2026-01-16 18:44:38');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('8', '1', 'Login', 'User logged in: tkadmin', '2026-01-17 17:04:02');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('9', '1', 'Logout', 'User logged out: tkadmin', '2026-01-17 17:04:54');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('10', '1', 'Login', 'User logged in: tkadmin', '2026-01-17 17:05:10');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('11', '1', 'Login', 'User logged in: tkadmin', '2026-01-21 17:33:29');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('12', '1', 'Logout', 'User logged out: tkadmin', '2026-01-21 17:39:49');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('13', '6', 'Login', 'User logged in: admin1', '2026-01-21 17:40:20');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('14', '6', 'Logout', 'User logged out: admin1', '2026-01-21 18:08:24');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('15', '6', 'Login', 'User logged in: admin1', '2026-01-21 18:09:07');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('16', '6', 'Logout', 'User logged out: admin1', '2026-01-21 18:19:27');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('17', '6', 'Login', 'User logged in: admin1', '2026-01-21 18:19:39');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('18', '6', 'Login', 'User logged in: admin1', '2026-01-21 20:25:26');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('19', '6', 'Logout', 'User logged out: admin1', '2026-01-21 20:28:08');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('20', '6', 'Login', 'User logged in: admin1', '2026-01-21 20:34:07');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('21', '6', 'Update Profile', 'Updated profile information for user: admin1', '2026-01-22 00:40:00');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('22', '1', 'Add Product', 'Added new product: LP-TYAR-01', '2026-01-22 00:41:00');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('23', '1', 'Stock Update', 'Updated stock for product ID: 1', '2026-01-22 00:42:00');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('24', '6', 'Add Delivery', 'Created new delivery for Farah Amina', '2026-01-22 00:43:00');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('25', '6', 'Add Delivery', 'Created new delivery for Zulkifli Hassan', '2026-01-22 00:44:00');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('26', '1', 'Generate Report', 'Generated Low Stock report', '2026-01-22 00:45:00');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('27', '1', 'Export PDF', 'Exported Audit Log to PDF', '2026-01-22 00:46:00');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('28', '1', 'Export Excel', 'Exported Stock Summary to Excel', '2026-01-22 00:47:00');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('29', '6', 'Update Delivery', 'Updated delivery status for Farah Amina to Shipped', '2026-01-22 00:48:00');
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES ('30', '1', 'User Login', 'User logged in: tkadmin', '2026-01-22 00:49:00');

--
-- Table structure for table `categories`
--
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--
INSERT INTO `categories` (`id`, `name`, `description`) VALUES ('1', 'Contour', NULL);
INSERT INTO `categories` (`id`, `name`, `description`) VALUES ('2', 'Lips', NULL);
INSERT INTO `categories` (`id`, `name`, `description`) VALUES ('3', 'Mascara', NULL);
INSERT INTO `categories` (`id`, `name`, `description`) VALUES ('4', 'Blusher', NULL);
INSERT INTO `categories` (`id`, `name`, `description`) VALUES ('5', 'Mist', NULL);

--
-- Table structure for table `products`
--
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_code` varchar(50) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `category_id` int DEFAULT NULL,
  `supplier_id` int DEFAULT NULL,
  `description` text,
  `cost_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `selling_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` int NOT NULL DEFAULT '0',
  `min_stock_level` int NOT NULL DEFAULT '5',
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code` (`product_code`),
  KEY `category_id` (`category_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('1', 'LP-FLUT-01', 'TKBYTYRA Lip Paint Fluttershy', '2', '1', NULL, '25.00', '45.00', '50', '5', 'img/products/fluttershy.png', '2026-01-21 18:44:30', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('2', 'LS-MARI-01', 'TKBYTYRA Lip Shimmer Mariposa', '2', '1', NULL, '28.00', '49.00', '40', '5', 'img/products/mariposa.png', '2026-01-21 18:44:30', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('3', 'KT-FELI-01', 'TKBYTYRA Kiss & Tell Lipstick - Feline', '2', '1', NULL, '22.00', '39.00', '60', '5', 'img/products/fluttershy.png', '2026-01-21 18:44:30', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('4', 'BL-WEDD-01', 'Wedding Collection Blusher EMfiniTY', '4', '2', NULL, '35.00', '59.00', '30', '5', 'img/products/mariposa.png', '2026-01-21 18:44:30', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('5', 'BL-PILL-01', 'Pillow Cheeks Blusher - Cottontail', '4', '2', NULL, '30.00', '55.00', '3', '5', 'img/products/mariposa.png', '2026-01-21 18:44:30', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('6', 'MS-FLUF-01', 'TK By TYRA Fluff & Flutter Mascara', '3', '3', NULL, '20.00', '42.00', '0', '5', 'img/products/fluttershy.png', '2026-01-21 18:44:30', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('7', 'FD-ONEW-01', 'One Stick Wonder - Golden Amber', '1', '4', NULL, '32.00', '65.00', '25', '5', 'img/products/mariposa.png', '2026-01-21 18:44:30', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('8', 'MT-HEADO-01', 'Head Over Heels Mist - Peach Bliss', '5', '5', NULL, '18.00', '35.00', '80', '5', 'img/products/fluttershy.png', '2026-01-21 18:44:30', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('9', 'LP-TYAR-01', 'TK By TYRA Lip Paint - Tyara', '2', '1', NULL, '25.00', '45.00', '50', '5', 'img/products/fluttershy.png', '2026-01-21 18:57:05', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('10', 'KT-PINK-01', 'TK By TYRA Kiss & Tell - Pinky Swear', '2', '1', NULL, '22.00', '39.00', '45', '5', 'img/products/mariposa.png', '2026-01-21 18:57:05', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('11', 'KT-FLIR-01', 'TK By TYRA Kiss & Tell - Flirty Fling', '2', '1', NULL, '22.00', '39.00', '45', '5', 'img/products/mariposa.png', '2026-01-21 18:57:05', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('12', 'KT-BARE-01', 'TK By TYRA Kiss & Tell - Barely There', '2', '1', NULL, '22.00', '39.00', '45', '5', 'img/products/mariposa.png', '2026-01-21 18:57:05', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('13', 'KT-SWEE-01', 'TK By TYRA Kiss & Tell - Sweet Talk', '2', '1', NULL, '22.00', '39.00', '45', '5', 'img/products/mariposa.png', '2026-01-21 18:57:05', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('14', 'KT-TEMP-01', 'TK By TYRA Kiss & Tell - Tempting Toast', '2', '1', NULL, '22.00', '39.00', '45', '5', 'img/products/mariposa.png', '2026-01-21 18:57:05', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('15', 'BL-PILL-COT', 'TK By TYRA Pillow Cheeks - Cottontail', '4', '2', NULL, '30.00', '55.00', '5', '5', 'img/products/mariposa.png', '2026-01-21 19:00:49', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('16', 'BL-PILL-FEL', 'TK By TYRA Pillow Cheeks - Feline', '4', '2', NULL, '30.00', '55.00', '35', '5', 'img/products/mariposa.png', '2026-01-21 19:00:49', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('17', 'BL-PILL-MAR', 'TK By TYRA Pillow Cheeks - Mariposa', '4', '2', NULL, '30.00', '55.00', '35', '5', 'img/products/mariposa.png', '2026-01-21 19:00:49', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('18', 'BL-WEDD-EMF', 'TKbyTyra Wedding Collection Blusher EMfiniTY TE', '4', '2', NULL, '35.00', '59.00', '25', '5', 'img/products/mariposa.png', '2026-01-21 19:00:49', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('19', 'BL-CANV-REB', 'TK By TYRA The Cheek Canvas: Rebirth', '4', '2', NULL, '38.00', '69.00', '20', '5', 'img/products/mariposa.png', '2026-01-21 19:00:49', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('20', 'BL-CANV-LUC', 'TK By TYRA The Cheek Canvas: Lucky', '4', '2', NULL, '38.00', '69.00', '20', '5', 'img/products/mariposa.png', '2026-01-21 19:00:49', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('21', 'FD-OSW-GAM', 'TK By TYRA One Stick Wonder - Golden Amber', '1', '4', NULL, '32.00', '65.00', '30', '5', 'img/products/mariposa.png', '2026-01-21 19:03:46', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('22', 'FD-OSW-SGL', 'TK By TYRA One Stick Wonder - Stardust Glow', '1', '4', NULL, '32.00', '65.00', '25', '5', 'img/products/mariposa.png', '2026-01-21 19:03:46', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('23', 'FD-OSW-HDU', 'TK By TYRA One Stick Wonder - Halo Dusk', '1', '4', NULL, '32.00', '65.00', '20', '5', 'img/products/mariposa.png', '2026-01-21 19:03:46', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('24', 'FD-OSW-MMU', 'TK By TYRA One Stick Wonder - Moonlit Muse', '1', '4', NULL, '32.00', '65.00', '15', '5', 'img/products/mariposa.png', '2026-01-21 19:03:46', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('25', 'MS-FF-WATER', 'TK By TYRA Fluff & Flutter – Super Waterproof Mascara', '3', '3', NULL, '20.00', '45.00', '0', '5', 'img/products/fluttershy.png', '2026-01-21 19:05:46', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('26', 'MS-FF-EASY', 'TK By TYRA Fluff & Flutter – Easy to Remove Mascara', '3', '3', NULL, '18.00', '42.00', '0', '5', 'img/products/fluttershy.png', '2026-01-21 19:05:46', '2026-01-21 20:42:22');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('27', 'SC-GLOW-01', 'Glow Serum - Vitamin C', '5', '7', 'Brightening facial serum', '45.00', '89.00', '30', '10', 'img/products/serum.png', '2026-01-22 00:50:00', '2026-01-22 00:50:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('28', 'SC-HYDR-02', 'Hydra Boost Moisturizer', '5', '7', 'Daily hydrating cream', '35.00', '65.00', '40', '10', 'img/products/moisturizer.png', '2026-01-22 00:50:00', '2026-01-22 00:50:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('29', 'LP-MATT-05', 'Matte Liquid Lip - Rose Berry', '2', '11', 'Long lasting matte finish', '20.00', '45.00', '50', '5', 'img/products/fluttershy.png', '2026-01-22 00:50:00', '2026-01-22 00:50:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('30', 'LP-GLOS-08', 'Ultra Gloss - Crystal Clear', '2', '20', 'High shine lip gloss', '18.00', '39.00', '60', '5', 'img/products/mariposa.png', '2026-01-22 00:50:00', '2026-01-22 00:50:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('31', 'EY-LINR-01', 'Precision Eyeliner - Jet Black', '3', '3', 'Waterproof felt tip liner', '15.00', '35.00', '80', '15', 'img/products/eyeliner.png', '2026-01-22 00:51:00', '2026-01-22 00:51:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('32', 'EY-SHAD-04', 'Midnight Palette - 12 Shades', '3', '6', 'Pigmented eyeshadow palette', '55.00', '129.00', '20', '5', 'img/products/palette.png', '2026-01-22 00:51:00', '2026-01-22 00:51:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('33', 'CH-BRON-02', 'Sun Kissed Bronzer', '1', '4', 'Golden shimmer bronzer', '28.00', '59.00', '35', '5', 'img/products/mariposa.png', '2026-01-22 00:51:00', '2026-01-22 00:51:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('34', 'CH-HIGH-01', 'Halo Glow Highlighter', '1', '18', 'Liquid highlight drops', '32.00', '69.00', '25', '5', 'img/products/highlighter.png', '2026-01-22 00:51:00', '2026-01-22 00:51:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('35', 'MT-FIXR-03', 'Stay All Day Setting Spray', '5', '5', 'Mattifying fix mist', '22.00', '45.00', '45', '10', 'img/products/fluttershy.png', '2026-01-22 00:51:00', '2026-01-22 00:51:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('36', 'SC-CLEA-01', 'Gentle Foaming Cleanser', '5', '7', 'Daily face wash', '25.00', '49.00', '50', '10', 'img/products/cleanser.png', '2026-01-22 00:52:00', '2026-01-22 00:52:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('37', 'SC-SUNS-05', 'Invisible Sun Shield SPF50', '5', '13', 'Broad spectrum sunscreen', '38.00', '75.00', '100', '20', 'img/products/sunscreen.png', '2026-01-22 00:52:00', '2026-01-22 00:52:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('38', 'LP-OIL-02', 'Lush Lip Oil - Honey', '2', '1', 'Nourishing lip treatment', '24.00', '48.00', '30', '5', 'img/products/lipoil.png', '2026-01-22 00:52:00', '2026-01-22 00:52:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('39', 'EY-BROW-01', 'Arch Define Brow Pencil', '3', '3', 'Fine tip brow pencil', '12.00', '29.00', '70', '10', 'img/products/brow.png', '2026-01-22 00:52:00', '2026-01-22 00:52:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('40', 'CH-CREA-03', 'Cheek Tint - Peachy Pink', '4', '2', 'Cream blusher stick', '22.00', '45.00', '40', '5', 'img/products/mariposa.png', '2026-01-22 00:52:00', '2026-01-22 00:52:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('41', 'EY-PRIM-01', 'Eye Canvas Primer', '3', '6', 'Eyeshadow base', '16.00', '35.00', '25', '5', 'img/products/primer.png', '2026-01-22 00:53:00', '2026-01-22 00:53:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('42', 'SC-DETX-04', 'Clay Detox Mask', '5', '19', 'Deep pore cleansing mask', '28.00', '55.00', '15', '5', 'img/products/mask.png', '2026-01-22 00:53:00', '2026-01-22 00:53:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('43', 'LP-LNR-07', 'Sculpt Lip Liner - Nude', '2', '11', 'Creamy lip pencil', '10.00', '25.00', '90', '15', 'img/products/lipliner.png', '2026-01-22 00:53:00', '2026-01-22 00:53:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('44', 'FD-BLUR-01', 'Soft Focus Setting Powder', '1', '12', 'Translucent loose powder', '30.00', '65.00', '20', '5', 'img/products/powder.png', '2026-01-22 00:53:00', '2026-01-22 00:53:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('45', 'EY-GLIT-02', 'Stardust Liquid Glitter', '3', '14', 'Sparkling eye topper', '20.00', '42.00', '35', '5', 'img/products/glitter.png', '2026-01-22 00:53:00', '2026-01-22 00:53:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('46', 'CH-PAL-01', 'Cheek Wardrobe Palette', '4', '2', '3-in-1 blush & contour', '48.00', '95.00', '12', '3', 'img/products/mariposa.png', '2026-01-22 00:54:00', '2026-01-22 00:54:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('47', 'SC-EYE-01', 'Bright Eye Cream', '5', '16', 'Dark circle treatment', '32.00', '69.00', '18', '5', 'img/products/eyecream.png', '2026-01-22 00:54:00', '2026-01-22 00:54:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('48', 'SC-NIGH-03', 'Overnight Repair Balm', '5', '16', 'Intensive night treatment', '42.00', '85.00', '10', '3', 'img/products/nightbalm.png', '2026-01-22 00:54:00', '2026-01-22 00:54:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('49', 'LP-PLMP-01', 'Plump It Up Lip Balm', '2', '1', 'Volumizing lip care', '18.00', '38.00', '45', '5', 'img/products/plumper.png', '2026-01-22 00:54:00', '2026-01-22 00:54:00');
INSERT INTO `products` (`id`, `product_code`, `name`, `category_id`, `supplier_id`, `description`, `cost_price`, `selling_price`, `quantity`, `min_stock_level`, `image_path`, `created_at`, `updated_at`) VALUES ('50', 'TL-BRSH-SET', 'Luxury Brush Set - 8pcs', '1', '15', 'Professional synthetic brushes', '65.00', '149.00', '15', '5', 'img/products/brushes.png', '2026-01-22 00:54:00', '2026-01-22 00:54:00');

--
-- Table structure for table `stock_movements`
--
DROP TABLE IF EXISTS `stock_movements`;
CREATE TABLE `stock_movements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `type` enum('in','out') NOT NULL,
  `quantity` int NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `stock_movements_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stock_movements_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock_movements`
--
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('1', '7', '6', 'in', '100', 'Initial Stock', '2026-01-11 11:27:56');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('2', '21', '6', 'in', '50', 'New Shipment', '2026-01-13 11:27:56');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('3', '7', '15', 'out', '5', 'Customer Sale', '2026-01-14 11:27:56');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('4', '22', '6', 'in', '30', 'Restocking', '2026-01-16 11:27:56');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('5', '24', '16', 'out', '2', 'Damaged Item', '2026-01-17 11:27:56');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('6', '21', '15', 'out', '10', 'Customer Sale', '2026-01-18 11:27:56');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('7', '1', '6', 'in', '20', 'Vendor Delivery', '2026-01-19 11:27:56');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('8', '23', '17', 'out', '1', 'Internal Use', '2026-01-20 11:27:56');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('9', '7', '6', 'in', '100', 'Initial Stock', '2026-01-11 12:42:24');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('10', '21', '6', 'in', '50', 'New Shipment', '2026-01-13 12:42:24');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('11', '7', '15', 'out', '5', 'Customer Sale', '2026-01-14 12:42:24');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('12', '22', '6', 'in', '30', 'Restocking', '2026-01-16 12:42:24');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('13', '24', '16', 'out', '2', 'Damaged Item', '2026-01-17 12:42:24');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('14', '21', '15', 'out', '10', 'Customer Sale', '2026-01-18 12:42:24');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('15', '1', '6', 'in', '20', 'Vendor Delivery', '2026-01-19 12:42:24');
INSERT INTO `stock_movements` (`id`, `product_id`, `user_id`, `type`, `quantity`, `reason`, `created_at`) VALUES ('16', '23', '17', 'out', '1', 'Internal Use', '2026-01-20 12:42:24');

--
-- Table structure for table `suppliers`
--
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suppliers`
--
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('1', 'Velvet Gloss Co.', 'Sarah Johnson', '012-3456789', 'sales@velvetgloss.com', 'Kuala Lumpur', '2026-01-21 20:42:21');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('2', 'Bloom Blush Manufacturing', 'Michael Chen', '011-2233445', 'contact@bloomblush.my', 'Selangor', '2026-01-21 20:42:22');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('3', 'Lash Lab Experts', 'Jessica Wong', '019-8877665', 'info@lashlab.com', 'Penang', '2026-01-21 20:42:22');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('4', 'Chisel & Glow Supplies', 'David Miller', '015-4433221', 'orders@chiselglow.id', 'Johor', '2026-01-21 20:42:22');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('5', 'Essence Mist Distro', 'Ahmad Faisal', '013-9988776', 'hello@essencemist.com', 'Melaka', '2026-01-21 20:42:22');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('6', 'Glow Palette HQ', 'Lim Wei Meng', '017-1122334', 'admin@glowpalette.com', 'Ipoh, Perak', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('7', 'Pure Skin Lab', 'Siti Aminah', '016-5544332', 'support@pureskin.my', 'Shah Alam', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('8', 'Chroma Cosmetics', 'Robert Tan', '014-7766554', 'info@chromacos.com', 'Kuching', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('9', 'Luxe Lash Supply', 'Grace Lee', '012-9988112', 'sales@luxelash.com', 'Kota Kinabalu', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('10', 'Silk Mist Solutions', 'Hassan Ali', '011-3344112', 'hassan@silkmist.my', 'Seremban', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('11', 'Petal Pink Pigments', 'Lily Tan', '013-5566778', 'lily@petalpink.com', 'Klang', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('12', 'Matte Magic Ind.', 'Kevin Low', '018-2233889', 'kevin@mattemagic.my', 'Petaling Jaya', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('13', 'Radiance Resource', 'Nurul Huda', '019-1122998', 'nurul@radiance.my', 'Alor Setar', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('14', 'Sparkle Source', 'Tan Ah Song', '012-7788443', 'orders@sparkle.com', 'George Town', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('15', 'Velvet Vine Labs', 'Chloe Sim', '011-8899221', 'chloe@velvetvine.id', 'Batu Pahat', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('16', 'Bloom & Beauty', 'Fariz Rahman', '013-4455112', 'fariz@bloombeauty.com', 'Kuantan', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('17', 'Elegance Essence', 'Wong Mei Ling', '016-8877112', 'meiling@elegance.sg', 'Johor Bahru', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('18', 'Diamond Dust Co.', 'Zackary Koh', '014-2233112', 'zack@diamonddust.com', 'Cheras', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('19', 'Oasis Mist Prod.', 'Fatimah Yusof', '012-5566112', 'fatimah@oasismist.my', 'Bangi', '2026-01-22 00:35:00');
INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_at`) VALUES ('20', 'Glamour Gloss Lab', 'Jason Ng', '011-7788112', 'jason@glamourgloss.com', 'Rawang', '2026-01-22 00:35:00');

--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','manager') NOT NULL DEFAULT 'staff',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('1', 'tkadmin', 'TkAdmin', '$2y$10$NG/WFyJ87quGY4XE5DzVOenZfXlPw/Slylr1ITCDp6mbW8aAOHzu.', 'admin', '2026-01-16 17:23:00');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('2', 'staff', 'Staff Member', '$2y$10$lhO72QUabzXWFeDM6XfZ3u3QBqcZNT6mBFAAPLyzOoEpWtG7QyTw.', 'staff', '2026-01-16 17:23:00');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('3', 'manager', 'Manager', '$2y$10$lhO72QUabzXWFeDM6XfZ3u3QBqcZNT6mBFAAPLyzOoEpWtG7QyTw.', 'manager', '2026-01-16 17:23:00');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('5', 'assistant_manager', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'manager', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('6', 'admin1', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('7', 'admin2', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('8', 'admin3', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('9', 'admin4', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('10', 'admin5', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('11', 'admin6', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('12', 'admin7', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('13', 'admin8', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('14', 'admin9', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('15', 'admin10', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('16', 'admin11', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('17', 'admin12', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('18', 'admin13', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('19', 'admin14', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('20', 'admin15', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('21', 'admin16', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('22', 'admin17', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');
INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `created_at`) VALUES ('23', 'admin18', NULL, '$2y$10$81LSQSuQEWmMziJ7kBXOK.2v/H5W9ixg3CS3NdHazdGe5AUHi4T86', 'admin', '2026-01-21 17:37:09');

--
-- Table structure for table `deliveries`
--
DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE `deliveries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `customer_name` varchar(150) NOT NULL,
  `customer_email` varchar(150) DEFAULT NULL,
  `customer_address` text NOT NULL,
  `tracking_number` varchar(100) DEFAULT NULL,
  `courier_name` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `deliveries`
--
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('1', '1', '2', 'Farah Amina', 'farah@example.com', 'No 12, Jalan Ampang, Kuala Lumpur', 'TK-MY-88291', 'J&T Express', 'Shipped', '2026-01-21 13:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('2', '4', '1', 'Zulkifli Hassan', 'zul@webmail.my', 'Lot 45, Section 7, Shah Alam, Selangor', 'PL-771239', 'PosLaju', 'Pending', '2026-01-21 15:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('3', '2', '3', 'Nurul Izzah', 'nurul@example.com', 'Taman Tun Dr Ismail, KL', 'JT-991100', 'J&T Express', 'Processing', '2026-01-22 09:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('4', '5', '1', 'Siti Sara', 'sara@mail.com', 'Melaka Tengah', 'NV-442211', 'NinjaVan', 'Shipped', '2026-01-22 09:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('5', '8', '2', 'John Doe', 'john@global.com', 'Cyberjaya, Selangor', 'PL-556677', 'PosLaju', 'Pending', '2026-01-22 09:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('6', '10', '1', 'Ah Leng', 'leng@biz.my', 'Petaling Jaya', 'DHL-112233', 'DHL', 'Delivered', '2026-01-22 09:45:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('7', '12', '4', 'Priya Mani', 'priya@edu.my', 'Skudai, Johor', 'JT-334455', 'J&T Express', 'Shipped', '2026-01-22 10:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('8', '15', '2', 'Ramasamy', 'rama@vendor.id', 'Ipoh Garden, Perak', 'NV-778899', 'NinjaVan', 'Cancelled', '2026-01-22 10:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('9', '18', '1', 'Mei Kuan', 'mei@shop.com', 'Miri, Sarawak', 'PL-112244', 'PosLaju', 'Processing', '2026-01-22 10:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('10', '20', '3', 'Faizal Aziz', 'faizal@gov.my', 'Putrajaya', 'PL-667788', 'PosLaju', 'Delivered', '2026-01-22 10:45:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('11', '1', '1', 'Linda Tan', 'linda@home.my', 'Gurney Drive, Penang', 'JT-112277', 'J&T Express', 'Shipped', '2026-01-22 11:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('12', '3', '2', 'Wei Han', 'han@tech.com', 'Bukit Bintang, KL', 'NV-990011', 'NinjaVan', 'Pending', '2026-01-22 11:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('13', '6', '1', 'Siti Jamilah', 'siti@mail.my', 'Kota Bharu, Kelantan', 'PL-443311', 'PosLaju', 'Shipped', '2026-01-22 11:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('14', '9', '2', 'Kevin Wong', 'kevin@wong.my', 'Subang Jaya', 'DHL-776622', 'DHL', 'Delivered', '2026-01-22 11:45:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('15', '11', '3', 'Noraini', 'aini@edu.com', 'Seberang Perai', 'JT-887711', 'J&T Express', 'Processing', '2026-01-22 12:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('16', '14', '5', 'Daniel Haikal', 'daniel@fast.my', 'Seremban 2', 'NV-332277', 'NinjaVan', 'Shipped', '2026-01-22 12:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('17', '17', '1', 'Esther Lim', 'esther@art.com', 'Mont Kiara, KL', 'PL-998811', 'PosLaju', 'Pending', '2026-01-22 12:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('18', '21', '2', 'Badrul Hisyam', 'bad@mail.my', 'Kangar, Perlis', 'JT-554411', 'J&T Express', 'Delivered', '2026-01-22 12:45:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('19', '24', '1', 'Grace Ng', 'grace@ng.com', 'Cheras, Selangor', 'NV-114477', 'NinjaVan', 'Shipped', '2026-01-22 13:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('20', '2', '3', 'Yusof Haslam', 'yusof@film.my', 'Ampang, Selangor', 'PL-223344', 'PosLaju', 'Processing', '2026-01-22 13:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('21', '5', '1', 'Zaiton', 'zai@mail.com', 'Sungai Petani', 'JT-667799', 'J&T Express', 'Shipped', '2026-01-22 13:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('22', '7', '2', 'Arif Roslan', 'arif@corp.my', 'Shah Alam', 'DHL-554499', 'DHL', 'Pending', '2026-01-22 13:45:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('23', '10', '1', 'Choo Ah Beng', 'choo@biz.my', 'Damansara', 'NV-882200', 'NinjaVan', 'Delivered', '2026-01-22 14:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('24', '13', '4', 'Saraswathi', 'sara@edu.my', 'Klang, Selangor', 'PL-119933', 'PosLaju', 'Shipped', '2026-01-22 14:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('25', '16', '1', 'Lim Kit Siang', 'lim@mail.my', 'Gelugor, Penang', 'JT-445588', 'J&T Express', 'Processing', '2026-01-22 14:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('26', '19', '2', 'Mustapha', 'mus@mail.com', 'Labuan', 'NV-773311', 'NinjaVan', 'Pending', '2026-01-22 14:45:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('27', '22', '1', 'Nurul Fatihah', 'nurul.f@mail.my', 'Kemaman, Terengganu', 'PL-881133', 'PosLaju', 'Shipped', '2026-01-22 15:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('28', '25', '3', 'Jason Statham', 'jason@action.com', 'Bangsar South, KL', 'DHL-339911', 'DHL', 'Delivered', '2026-01-22 15:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('29', '1', '1', 'Rosmah', 'ros@mail.my', 'Taman Duta, KL', 'JT-110044', 'J&T Express', 'Processing', '2026-01-22 15:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('30', '3', '2', 'Khairy M', 'khairy@gov.my', 'Rembau, NS', 'NV-551188', 'NinjaVan', 'Shipped', '2026-01-22 15:45:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('31', '4', '1', 'Siti Nurhaliza', 'siti@diva.my', 'Kajang, Selangor', 'PL-773344', 'PosLaju', 'Pending', '2026-01-22 16:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('32', '6', '1', 'Lee Chong Wei', 'lee@sport.my', 'Bukit Jalil, KL', 'JT-993311', 'J&T Express', 'Delivered', '2026-01-22 16:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('33', '8', '2', 'Nicol David', 'nicol@sport.my', 'Penang Island', 'NV-334411', 'NinjaVan', 'Shipped', '2026-01-22 16:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('34', '11', '1', 'Michelle Yeoh', 'michelle@oscar.com', 'Ipoh, Perak', 'DHL-661144', 'DHL', 'Processing', '2026-01-22 16:45:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('35', '14', '3', 'Henry Golding', 'henry@star.my', 'Betong, Sarawak', 'PL-884411', 'PosLaju', 'Pending', '2026-01-22 17:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('36', '15', '1', 'Tan Sri Vincent', 'vincent@berjaya.com', 'Bukit Tunku, KL', 'JT-663388', 'J&T Express', 'Shipped', '2026-01-22 17:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('37', '18', '2', 'Datuk K', 'k@global.my', 'Kuala Lumpur', 'NV-228833', 'NinjaVan', 'Delivered', '2026-01-22 17:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('38', '20', '1', 'Neelofa', 'lufa@nilofa.my', 'Pasir Mas, Kelantan', 'PL-115599', 'PosLaju', 'Processing', '2026-01-22 17:45:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('39', '21', '4', 'Fattah Amin', 'fattah@star.my', 'Setia Alam, Selangor', 'JT-441100', 'J&T Express', 'Shipped', '2026-01-22 18:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('40', '23', '1', 'Fazura', 'faz@star.my', 'Pekan, Pahang', 'NV-992244', 'NinjaVan', 'Pending', '2026-01-22 18:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('41', '2', '2', 'Maya Karin', 'maya@eco.my', 'Janda Baik, Pahang', 'DHL-552288', 'DHL', 'Delivered', '2026-01-22 18:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('42', '5', '1', 'Bront Palarae', 'bront@film.my', 'Tanjung Bungah, Penang', 'PL-331177', 'PosLaju', 'Shipped', '2026-01-22 18:45:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('43', '7', '3', 'Yuna', 'yuna@music.com', 'Los Angeles / KL', 'JT-882211', 'J&T Express', 'Processing', '2026-01-22 19:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('44', '9', '1', 'Shaheizy Sam', 'sam@film.my', 'Petaling Jaya', 'NV-441188', 'NinjaVan', 'Pending', '2026-01-22 19:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('45', '11', '2', 'Syamsul Yusof', 'syamsul@film.my', 'Gombak, Selangor', 'PL-992211', 'PosLaju', 'Shipped', '2026-01-22 19:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('46', '13', '1', 'Nora Danish', 'nora@mail.my', 'Damansara Heights', 'JT-224466', 'J&T Express', 'Delivered', '2026-01-22 19:45:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('47', '16', '2', 'Aaron Aziz', 'aaron@star.my', 'Singapore / KL', 'NV-663300', 'NinjaVan', 'Shipped', '2026-01-22 20:00:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('48', '19', '1', 'Zizan Razak', 'zizan@comedy.my', 'Dungun, Terengganu', 'DHL-114400', 'DHL', 'Processing', '2026-01-22 20:15:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('49', '22', '3', 'Johan', 'johan@radio.my', 'Ampang Jaya', 'PL-884422', 'PosLaju', 'Pending', '2026-01-22 20:30:00');
INSERT INTO `deliveries` (`id`, `product_id`, `quantity`, `customer_name`, `customer_email`, `customer_address`, `tracking_number`, `courier_name`, `status`, `created_at`) VALUES ('50', '25', '1', 'Nabil Ahmad', 'nabil@star.my', 'Seremban, NS', 'JT-772211', 'J&T Express', 'Shipped', '2026-01-22 20:45:00');

--
-- Table structure for table `customers`
--
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`) VALUES (1, 'Farah Amina', 'farah@example.com', '012-3456789', 'Kuala Lumpur');
INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`) VALUES (2, 'Zulkifli Hassan', 'zul@webmail.my', '011-2233445', 'Shah Alam');

--
-- Table structure for table `orders`
--
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT '0.00',
  `status` enum('Pending','Paid','Shipped','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `orders` (`id`, `customer_id`, `user_id`, `total_amount`, `status`) VALUES (1, 1, 1, 90.00, 'Paid');
INSERT INTO `orders` (`id`, `customer_id`, `user_id`, `total_amount`, `status`) VALUES (2, 2, 6, 59.00, 'Pending');

--
-- Table structure for table `order_items`
--
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES (1, 1, 1, 2, 45.00);
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES (2, 2, 4, 1, 59.00);

SET FOREIGN_KEY_CHECKS = 1;
