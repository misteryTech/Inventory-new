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

 Date: 25/02/2025 11:27:44
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
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of approved_products
-- ----------------------------
INSERT INTO `approved_products` VALUES (1, 'AMBER Notebook yarn', 4, '2025-02-07', 3, NULL, 6, NULL);
INSERT INTO `approved_products` VALUES (2, 'smoothy plump', 22, '2025-02-07', 3, NULL, 7, NULL);
INSERT INTO `approved_products` VALUES (3, 'smoothy plump', 22, '2025-02-07', 3, NULL, 9, NULL);
INSERT INTO `approved_products` VALUES (4, 'scentshop', 100, '2025-02-07', 3, NULL, 8, NULL);
INSERT INTO `approved_products` VALUES (5, 'VDR-1733810865842-739', 20, '2025-02-07', 3, NULL, 10, NULL);
INSERT INTO `approved_products` VALUES (6, 'VDR-1733810865842-739', 20, '2025-02-07', 3, NULL, 10, NULL);
INSERT INTO `approved_products` VALUES (7, '6975640630099', 22, '2025-02-07', 3, NULL, 9, NULL);
INSERT INTO `approved_products` VALUES (8, 'smoothy plump', 22, '2025-02-07', 2, NULL, 7, '6975640630099');
INSERT INTO `approved_products` VALUES (9, 'sample4', 2, '2025-02-07', 2, NULL, 5, 'RMB-1733802065897-977');
INSERT INTO `approved_products` VALUES (10, 'AMBER Notebook yarn', 1, '2025-02-07', 2, NULL, 5, '4806535956012');
INSERT INTO `approved_products` VALUES (11, 'AMBER Notebook yarn', 4, '2025-02-07', 1, NULL, 6, '4806535956012');
INSERT INTO `approved_products` VALUES (12, 'AMBER Notebook yarn', 5, '2025-02-09', 1, NULL, 11, '4806535956012');
INSERT INTO `approved_products` VALUES (13, 'scentshop', 2, '2025-02-09', 1, NULL, 12, '4800047865503');
INSERT INTO `approved_products` VALUES (14, 'AMBER Notebook yarn', 10, '2025-02-09', 1, NULL, 13, '4806535956012');

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
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_requests
-- ----------------------------
INSERT INTO `product_requests` VALUES (1, '6', 'needed in the lab', '2025-01-17 11:41:34', 'Released', 'RF679B2CBFD23961.37404826', '2025-01-30');
INSERT INTO `product_requests` VALUES (2, '6', 'asd', '2025-01-17 11:42:53', 'Released', 'RF679B2CF1DA3D45.34716481', '2025-01-30');
INSERT INTO `product_requests` VALUES (3, '6', 'asd', '2025-01-17 11:48:18', 'Release', 'RF679B1BBBD7D168.03853610', '2025-01-30');
INSERT INTO `product_requests` VALUES (4, '6', 'FOR TEACHING', '2025-01-24 20:53:31', 'Release', 'RF679B22B113F000.94712299', '2025-01-30');
INSERT INTO `product_requests` VALUES (5, '8', '', '2025-01-24 21:20:22', 'Onprocess', 'RF679B1C4F0766B8.13734135', '2025-01-30');
INSERT INTO `product_requests` VALUES (6, '6', 'asd', '2025-02-07 11:42:47', 'Onprocess', NULL, NULL);
INSERT INTO `product_requests` VALUES (7, '6', 'asd', '2025-02-07 13:55:09', 'Onprocess', NULL, NULL);
INSERT INTO `product_requests` VALUES (8, '6', 'asd', '2025-02-07 13:56:43', 'Onprocess', NULL, NULL);
INSERT INTO `product_requests` VALUES (9, '6', 'asd', '2025-02-07 13:57:54', 'Onprocess', NULL, NULL);
INSERT INTO `product_requests` VALUES (10, '6', '', '2025-02-07 14:16:45', 'Onprocess', NULL, NULL);
INSERT INTO `product_requests` VALUES (11, '6', 'for staff', '2025-02-09 17:28:37', 'Onprocess', NULL, NULL);
INSERT INTO `product_requests` VALUES (12, '6', 'pahumot maam', '2025-02-09 17:29:21', 'Onprocess', NULL, NULL);
INSERT INTO `product_requests` VALUES (13, '6', 'sad', '2025-02-09 17:40:00', 'Onprocess', NULL, NULL);

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
INSERT INTO `product_transfer` VALUES (1, 6, '0', '2', NULL, '2025-01-30', 1);
INSERT INTO `product_transfer` VALUES (2, 6, 'QOJ-1733801', '2', NULL, '2025-01-30', 1);
INSERT INTO `product_transfer` VALUES (3, 6, 'QOJ-1733801982874-382', '1', NULL, '2025-01-30', 2);

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
INSERT INTO `products` VALUES (4, 'QOJ-1733801982874-382', 'sample3', 'sample3', 2.00, 2219, 'Fashion', 'Box', 'New', '1', 'uploads/59690TUB (2).JPG', '2025-01-30 13:24:43', 'No', 'qrcodes/QOJ-1733801982874-382.png', 10);
INSERT INTO `products` VALUES (5, 'RMB-1733802065897-977', 'sample4', 'sample4', 2.00, 100, 'Beauty', 'Piece', 'New', '1', '', '2025-01-30 13:27:34', 'No', 'qrcodes/RMB-1733802065897-977.png', 5);
INSERT INTO `products` VALUES (6, 'VDR-1733810865842-739', 'sample5', 'sample5', 100.00, 100, 'GFI', 'Piece', 'Damage', '3', '', NULL, 'No', 'qrcodes/VDR-1733810865842-739.png', 50);
INSERT INTO `products` VALUES (7, '4806535956012', 'AMBER Notebook yarn', '20 x 15 80 Leaves Notebook', 29.00, 24, 'Starbright', 'Piece', 'New', '3', 'uploads/WIN_20250124_20_44_53_Pro.jpg', '2025-01-30 20:46:24', 'No', 'qrcodes/4806535956012.png', 5);
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
  `approved2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`request_product_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of request_products
-- ----------------------------
INSERT INTO `request_products` VALUES (1, 1, 'QOJ-1733801982874-382', 2, 'admin', NULL, 'Declined');
INSERT INTO `request_products` VALUES (2, 2, 'ECL-1733801771657-360', 1, 'admin', NULL, 'Approved');
INSERT INTO `request_products` VALUES (3, 2, 'QOJ-1733801982874-382', 1, 'admin', NULL, 'Declined');
INSERT INTO `request_products` VALUES (4, 3, 'QOJ-1733801982874-382', 1, 'admin', NULL, 'Declined');
INSERT INTO `request_products` VALUES (5, 4, '4806535956012', 100, 'admin', NULL, 'Declined');
INSERT INTO `request_products` VALUES (6, 5, 'RMB-1733802065897-977', 2, 'admin', NULL, 'Onprocess');
INSERT INTO `request_products` VALUES (7, 5, '4806535956012', 1, 'admin', NULL, 'Onprocess');
INSERT INTO `request_products` VALUES (8, 8, '6975640630099', 2, 'admin', NULL, 'Approved');
INSERT INTO `request_products` VALUES (9, 6, '4806535956012', 4, 'admin', NULL, 'Onprocess');
INSERT INTO `request_products` VALUES (10, 7, '6975640630099', 22, 'admin', NULL, 'Onprocess');
INSERT INTO `request_products` VALUES (11, 8, '4800047865503', 100, 'admin', NULL, 'Onprocess');
INSERT INTO `request_products` VALUES (12, 9, '6975640630099', 22, 'admin', NULL, 'Onprocess');
INSERT INTO `request_products` VALUES (13, 10, 'VDR-1733810865842-739', 20, 'admin', NULL, 'Onprocess');
INSERT INTO `request_products` VALUES (14, 11, '4806535956012', 5, 'admin', NULL, 'Onprocess');
INSERT INTO `request_products` VALUES (15, 12, '4800047865503', 2, 'admin', NULL, 'Onprocess');
INSERT INTO `request_products` VALUES (16, 13, '4806535956012', 10, 'admin', NULL, 'Onprocess');

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
INSERT INTO `users` VALUES (7, 'china', 'china@gmail.com', '', 'china', '2024-12-22 16:12:36', 'User', 'No', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (8, 'john', 'johnalbert@gmail.com', '', 'john', '2025-01-24 21:15:26', 'User', 'No', '', 'Teacher', 'Clinic', 'john albert', 'collamar', 'Male', '2003-03-03', '09518325608', 'labangal G.S.C');

SET FOREIGN_KEY_CHECKS = 1;
