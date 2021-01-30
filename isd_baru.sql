/*
 Navicat Premium Data Transfer

 Source Server         : MySQL Local
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : isd

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 30/01/2021 19:25:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for asset
-- ----------------------------
DROP TABLE IF EXISTS `asset`;
CREATE TABLE `asset`  (
  `asset_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asset
-- ----------------------------
INSERT INTO `asset` VALUES ('PC-0001', 'Komputer Admin', 1);
INSERT INTO `asset` VALUES ('PC-0002', 'Komputer Sales 1', 2);
INSERT INTO `asset` VALUES ('PC-0003', 'Komputer Sales 2', 3);

-- ----------------------------
-- Table structure for departement
-- ----------------------------
DROP TABLE IF EXISTS `departement`;
CREATE TABLE `departement`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of departement
-- ----------------------------
INSERT INTO `departement` VALUES (1, 'Bersahaja');
INSERT INTO `departement` VALUES (2, 'Bahagia');
INSERT INTO `departement` VALUES (3, 'Keindahan');

-- ----------------------------
-- Table structure for tiket
-- ----------------------------
DROP TABLE IF EXISTS `tiket`;
CREATE TABLE `tiket`  (
  `id_tiket` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal` date NOT NULL,
  `pc_no` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` int(50) NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `departemen` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `problem` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `penanganan` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `penanggung_jawab` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_penanganan` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_tiket`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tiket
-- ----------------------------
INSERT INTO `tiket` VALUES ('30012021034438', '2021-01-30', '1', 5, 'mail@gmail.com', 'Acak Acakan', 'Budi ngerusak komputer admin', 'Udah di klarifikasi', 'close', '1', '2021-01-13');
INSERT INTO `tiket` VALUES ('30012021042112', '2021-01-30', '1', 3, 'budi@mail.com', 'Acak Acakan', 'Kusnaedi fitnah saya ngerusakin komputer admin', 'Tiket duplikat', 'cancel', '1', '2021-01-04');
INSERT INTO `tiket` VALUES ('30012021104517', '2021-01-30', '3', 5, 'BUDI@HHA.com', 'Acak Acakan', 'TES', '', 'open', NULL, NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `departement_id` int(255) NULL DEFAULT NULL,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fullname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_hp` int(14) NOT NULL,
  `level` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, NULL, 'Tsuch1y4', 'tsuch1y4', 'Administrator', 2147483647, 'Admin', 'gambar_admin/Tulips.jpg');
INSERT INTO `user` VALUES (2, 1, 'hakko', 'hakko', 'Hakko Bio Richard', 2147483647, 'User', 'gambar_admin/Chrysanthemum.jpg');
INSERT INTO `user` VALUES (3, 2, 'budi', 'budi', 'Budi Susanoo', 1231312313, 'User', 'gambar_admin/Chrysanthemum.jpg');
INSERT INTO `user` VALUES (4, NULL, 'asep', 'asep', 'Asep Sutanto', 1231232132, 'Admin', 'gambar_admin/Tulips.jpg');
INSERT INTO `user` VALUES (5, 2, 'kus', 'kus', 'Kusnaedi Doang', 123, 'User', '');
INSERT INTO `user` VALUES (6, NULL, 'admin', 'admin', 'Admin Kasep', 1231232322, 'Admin', 'gambar_admin/Tulips.jpg');

SET FOREIGN_KEY_CHECKS = 1;
