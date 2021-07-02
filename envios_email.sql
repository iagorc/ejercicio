/*
 Navicat Premium Data Transfer

 Source Server         : 205
 Source Server Type    : MySQL
 Source Server Version : 100148
 Source Host           : 192.168.0.205:3306
 Source Schema         : itete_plataforma

 Target Server Type    : MySQL
 Target Server Version : 100148
 File Encoding         : 65001

 Date: 02/07/2021 09:58:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for envios_email
-- ----------------------------
DROP TABLE IF EXISTS `envios_email`;
CREATE TABLE `envios_email`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime(0) NULL DEFAULT NULL,
  `asunto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `texto` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
