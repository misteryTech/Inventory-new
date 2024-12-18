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

 Date: 18/12/2024 09:43:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for product_registration_logs
-- ----------------------------
DROP TABLE IF EXISTS `product_registration_logs`;
CREATE TABLE `product_registration_logs`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `action` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_registration_logs
-- ----------------------------
INSERT INTO `product_registration_logs` VALUES (1, 6, 'Added', 100, '2024-12-10 14:08:07');

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
  PRIMARY KEY (`request_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_requests
-- ----------------------------
INSERT INTO `product_requests` VALUES (1, 'f0s2e38fmpae6u2h3ecnvov0ri', 'For Our labe', '2024-12-12 16:20:08', 'pending', NULL);
INSERT INTO `product_requests` VALUES (2, 'f0s2e38fmpae6u2h3ecnvov0ri', '22', '2024-12-12 16:24:48', 'pending', NULL);
INSERT INTO `product_requests` VALUES (3, 'f0s2e38fmpae6u2h3ecnvov0ri', '', '2024-12-12 16:28:11', 'pending', NULL);
INSERT INTO `product_requests` VALUES (4, '6', '', '2024-12-12 16:32:56', 'pending', NULL);
INSERT INTO `product_requests` VALUES (5, '6', '33', '2024-12-16 14:21:26', 'Pending', NULL);
INSERT INTO `product_requests` VALUES (6, '6', 'sd', '2024-12-16 14:22:32', 'Pending', NULL);

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
  `created_at` time NULL DEFAULT current_timestamp,
  `archive` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qr_code_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `reorder_point` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'sample', 'samplesssssss', 'sample', 1111.00, 3, 'Electronics', 'Piece', 'New', 'Electronics', 'uploads/59690TUB (1).JPG', '13:24:38', 'No', 'qrcodes/sample.png', 2);
INSERT INTO `products` VALUES (2, 'ECL-1733801771657-360', 'sample1', 'sample1', 2.00, 2, 'Fashion', 'Box', 'New', 'Home & Kitchen', '', '13:24:45', 'No', 'qrcodes/ECL-1733801771657-360.png', 20);
INSERT INTO `products` VALUES (3, 'MRS-1733801823048-86', 'sample2', '3', 2.00, 2, 'Home & Kitchen', 'Kg', 'Used', 'Home & Kitchen', '', '13:24:34', 'Yes', 'qrcodes/MRS-1733801823048-86.png', 2);
INSERT INTO `products` VALUES (4, 'QOJ-1733801982874-382', 'sample3', 'sample3', 2.00, 2, 'Fashion', 'Box', 'New', 'Home & Kitchen', 'uploads/59690TUB (2).JPG', '13:24:43', 'No', 'qrcodes/QOJ-1733801982874-382.png', 10);
INSERT INTO `products` VALUES (5, 'RMB-1733802065897-977', 'sample4', 'sample4', 2.00, 100, 'Beauty', 'Piece', 'New', 'Fashion', '', '13:27:34', 'No', 'qrcodes/RMB-1733802065897-977.png', 5);
INSERT INTO `products` VALUES (6, 'VDR-1733810865842-739', 'sample5', 'sample5', 100.00, 100, 'GFI', 'Piece', 'Damage', 'Fashion', '', NULL, 'No', 'qrcodes/VDR-1733810865842-739.png', 50);

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
  `approved2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`request_product_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of request_products
-- ----------------------------
INSERT INTO `request_products` VALUES (10, 5, 'ECL-1733801771657-360', 2, NULL, NULL, NULL);
INSERT INTO `request_products` VALUES (11, 5, 'QOJ-1733801982874-382', 2, NULL, NULL, NULL);
INSERT INTO `request_products` VALUES (12, 6, 'ECL-1733801771657-360', 2, 'admin', NULL, 'Approved');
INSERT INTO `request_products` VALUES (13, 6, 'QOJ-1733801982874-382', 2, 'admin', NULL, 'Approved');

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
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@gmail.com', '', 'admins', '2024-12-09 13:45:55', 'Admin', 'No', NULL);
INSERT INTO `users` VALUES (5, 'adminssssss', 'admin12@gmail.com', '', 'admin123', '2024-12-09 13:50:25', 'User', 'Yes', NULL);
INSERT INTO `users` VALUES (6, 'sample', 'sample@gmail.com', '', 'sample', '2024-12-09 13:51:38', 'User', 'Yes', NULL);

SET FOREIGN_KEY_CHECKS = 1;
