/*
 Navicat Premium Dump SQL

 Source Server         : miste_ry
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : online_inventory

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 15/03/2025 22:18:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for approved_products
-- ----------------------------
DROP TABLE IF EXISTS `approved_products`;
CREATE TABLE `approved_products`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `quantity` int NULL DEFAULT NULL,
  `date_approved` date NULL DEFAULT NULL,
  `print` int NULL DEFAULT NULL,
  `admin_approved` int NULL DEFAULT NULL,
  `session_id` int NULL DEFAULT NULL,
  `batch_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of approved_products
-- ----------------------------
INSERT INTO `approved_products` VALUES (1, 'AMBER Notebook yarn', 22, '2025-03-14', 0, NULL, 2, '4806535956012');
INSERT INTO `approved_products` VALUES (2, 'sample3', 2, '2025-03-14', 0, NULL, 3, 'QOJ-1733801982874-382');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'Appliances');
INSERT INTO `category` VALUES (2, 'Electronics');
INSERT INTO `category` VALUES (3, 'School Supplies');

-- ----------------------------
-- Table structure for product_registration_logs
-- ----------------------------
DROP TABLE IF EXISTS `product_registration_logs`;
CREATE TABLE `product_registration_logs`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `action` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_registration_logs
-- ----------------------------
INSERT INTO `product_registration_logs` VALUES (1, '6', 'Added', 100, '2024-12-10 14:08:07');
INSERT INTO `product_registration_logs` VALUES (2, '7', 'Added', 200, '2025-01-24 20:46:24');
INSERT INTO `product_registration_logs` VALUES (3, '8', 'Added', 20, '2025-01-24 21:09:22');
INSERT INTO `product_registration_logs` VALUES (4, '9', 'Added', 40, '2025-01-24 21:30:15');
INSERT INTO `product_registration_logs` VALUES (5, '0', 'add stocks', 222, '2025-01-30 02:21:28');
INSERT INTO `product_registration_logs` VALUES (6, '0', 'add stocks', 2222, '2025-01-30 02:22:25');
INSERT INTO `product_registration_logs` VALUES (7, '4806535956012', 'add stocks', 222, '2025-01-30 02:24:07');
INSERT INTO `product_registration_logs` VALUES (8, '6975640630099', 'add stocks', 200, '2025-01-30 03:42:17');
INSERT INTO `product_registration_logs` VALUES (9, '4800047865503', 'add stocks', 200, '2025-01-30 13:18:05');

-- ----------------------------
-- Table structure for product_requests
-- ----------------------------
DROP TABLE IF EXISTS `product_requests`;
CREATE TABLE `product_requests`  (
  `request_id` int NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `release_form` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `release_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`request_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_requests
-- ----------------------------
INSERT INTO `product_requests` VALUES (1, '7', 'For Sample Teaching', '2025-03-14 10:43:29', 'Pending', NULL, NULL);
INSERT INTO `product_requests` VALUES (2, '8', 'asd', '2025-03-14 10:48:10', 'Released', 'RF67D3C826BA5513.16268298', '2025-03-14');
INSERT INTO `product_requests` VALUES (3, '7', 'asd', '2025-03-14 13:19:08', 'Released', 'RF67D3E88182B755.01434660', '2025-03-14');
INSERT INTO `product_requests` VALUES (4, '7', 'sd', '2025-03-14 13:46:25', 'Pending', NULL, NULL);

-- ----------------------------
-- Table structure for product_transfer
-- ----------------------------
DROP TABLE IF EXISTS `product_transfer`;
CREATE TABLE `product_transfer`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `batch_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stock` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `release_date` date NULL DEFAULT NULL,
  `request_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_transfer
-- ----------------------------
INSERT INTO `product_transfer` VALUES (1, 8, '4806535956012', '22', NULL, '2025-03-14', 2);
INSERT INTO `product_transfer` VALUES (2, 7, 'QOJ-1733801982874-382', '2', NULL, '2025-03-14', 3);
INSERT INTO `product_transfer` VALUES (3, 7, 'QOJ-1733801982874-382', '2', NULL, '2025-03-14', 3);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `batch_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_price` decimal(10, 2) NULL DEFAULT NULL,
  `stock` int NULL DEFAULT NULL,
  `supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `archive` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qr_code_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `reorder_point` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'sample', 'samplesssssss', 'sample', 1111.00, 3, 'Electronics', 'Piece', 'New', '2', 'uploads/59690TUB (1).JPG', '2025-01-30 13:24:38', 'No', 'qrcodes/sample.png', 2);
INSERT INTO `products` VALUES (2, 'ECL-1733801771657-360', 'sample1', 'sample1', 2.00, 224, 'Fashion', 'Box', 'New', '2', '', '2025-01-30 13:24:45', 'No', 'qrcodes/ECL-1733801771657-360.png', 20);
INSERT INTO `products` VALUES (3, 'MRS-1733801823048-86', 'sample2', '3', 2.00, 2, 'Home & Kitchen', 'Kg', 'Used', '2', '', '2025-01-30 13:24:34', 'Yes', 'qrcodes/MRS-1733801823048-86.png', 2);
INSERT INTO `products` VALUES (4, 'QOJ-1733801982874-382', 'sample3', 'sample3', 2.00, 2213, 'Fashion', 'Box', 'New', '1', 'uploads/59690TUB (2).JPG', '2025-01-30 13:24:43', 'No', 'qrcodes/QOJ-1733801982874-382.png', 10);
INSERT INTO `products` VALUES (5, 'RMB-1733802065897-977', 'sample4', 'sample4', 2.00, 100, 'Beauty', 'Piece', 'New', '1', '', '2025-01-30 13:27:34', 'No', 'qrcodes/RMB-1733802065897-977.png', 5);
INSERT INTO `products` VALUES (6, 'VDR-1733810865842-739', 'sample5', 'sample5', 100.00, 100, 'GFI', 'Piece', 'Damage', '3', '', NULL, 'No', 'qrcodes/VDR-1733810865842-739.png', 50);
INSERT INTO `products` VALUES (7, '4806535956012', 'AMBER Notebook yarn', '20 x 15 80 Leaves Notebook', 29.00, 2, 'Starbright', 'Piece', 'New', '3', 'uploads/WIN_20250124_20_44_53_Pro.jpg', '2025-01-30 20:46:24', 'No', 'qrcodes/4806535956012.png', 5);
INSERT INTO `products` VALUES (8, '6975640630099', 'smoothy plump', 'beauty glaze/brown gel', 200.00, 202, 'janjan', 'Piece', 'New', '4', '', '2025-01-30 21:09:22', 'No', 'qrcodes/6975640630099.png', 5);
INSERT INTO `products` VALUES (9, '4800047865503', 'scentshop', 'candy kiss/ cologne', 25.00, 202, 'mamon', 'Piece', 'New', '5', '', '2025-01-30 21:30:15', 'No', 'qrcodes/4800047865503.png', 5);

-- ----------------------------
-- Table structure for request_products
-- ----------------------------
DROP TABLE IF EXISTS `request_products`;
CREATE TABLE `request_products`  (
  `request_product_id` int NOT NULL AUTO_INCREMENT,
  `request_id` int NOT NULL,
  `product_id` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `approved1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_claim` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`request_product_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of request_products
-- ----------------------------
INSERT INTO `request_products` VALUES (0, 1, 'QOJ-1733801982874-382', 2, 'admin', NULL, 'Declined', NULL);
INSERT INTO `request_products` VALUES (2, 2, '4806535956012', 22, 'admin', 'Transferred', 'Onprocess', '2025-03-14 16:19:55');
INSERT INTO `request_products` VALUES (3, 3, 'QOJ-1733801982874-382', 2, 'admin', 'Transferred', 'Released', '2025-03-15 00:32:35');
INSERT INTO `request_products` VALUES (4, 4, '4806535956012', 12, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for unit
-- ----------------------------
DROP TABLE IF EXISTS `unit`;
CREATE TABLE `unit`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of unit
-- ----------------------------
INSERT INTO `unit` VALUES (1, '');
INSERT INTO `unit` VALUES (2, '');
INSERT INTO `unit` VALUES (3, 'Piece');
INSERT INTO `unit` VALUES (4, 'Kilo');
INSERT INTO `unit` VALUES (5, 'asd');
INSERT INTO `unit` VALUES (6, 'Grams');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `archive` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dob` date NULL DEFAULT NULL,
  `mobileno` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@gmail.com', '', 'admins', '2024-12-09 13:45:55', 'Admin', 'No', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (5, 'adminssssss', 'admin12@gmail.com', '', 'admin123', '2024-12-09 13:50:25', 'User', 'Yes', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (6, 'samples', 'samples@gmail.com', '', 'sample', '2024-12-09 13:51:38', 'User', 'No', '', 'Principal', 'Cashier', 'reymark', 'sample1', 'Female', '2025-01-17', '11111111111', 'sample');
INSERT INTO `users` VALUES (7, 'china', 'china@gmail.com', '', 'china', '2024-12-22 16:12:36', 'User', 'No', '', 'Staff', 'Cashier', 'asd', 'asd', 'Male', '2025-03-06', 'as1231', 'asdasd123');
INSERT INTO `users` VALUES (8, 'john', 'johnalbert@gmail.com', '', 'john', '2025-01-24 21:15:26', 'User', 'No', '', 'Teacher', 'Clinic', 'john albert', 'collamar', 'Male', '2003-03-03', '09518325608', 'labangal G.S.C');

SET FOREIGN_KEY_CHECKS = 1;
