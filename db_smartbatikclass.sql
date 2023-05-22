/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : db_smartbatikclass

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 18/02/2022 10:14:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for answers
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `topic_id` int(11) NULL DEFAULT NULL,
  `quiz` int(11) NULL DEFAULT NULL,
  `correct` int(11) NULL DEFAULT NULL,
  `incorrect` int(11) NULL DEFAULT NULL,
  `date` datetime(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of answers
-- ----------------------------
INSERT INTO `answers` VALUES (8, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', 1, 4, 4, 0, '0000-00-00 00:00:00', '2022-02-06 12:19:59', NULL);
INSERT INTO `answers` VALUES (9, 'k7QDLHOfQHUHLWcu5T22NwJyL2r1', 1, 4, 4, 0, '0000-00-00 00:00:00', '2022-02-08 16:24:19', NULL);
INSERT INTO `answers` VALUES (10, 'ApZXnJZ9i9SRV7rEICze9piMmA22', 1, 4, 2, 2, '0000-00-00 00:00:00', '2022-02-08 16:53:38', NULL);
INSERT INTO `answers` VALUES (11, 'ApZXnJZ9i9SRV7rEICze9piMmA22', 6, 4, 4, 0, '0000-00-00 00:00:00', '2022-02-11 09:02:25', NULL);
INSERT INTO `answers` VALUES (13, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', 6, 4, 4, 0, '0000-00-00 00:00:00', '2022-02-11 09:38:00', NULL);
INSERT INTO `answers` VALUES (17, '11xs0VWcXudhBAbnrt8xmTGeCxv1', 6, 4, 2, 2, '0000-00-00 00:00:00', '2022-02-11 10:05:37', NULL);
INSERT INTO `answers` VALUES (18, '11xs0VWcXudhBAbnrt8xmTGeCxv1', 6, 4, 2, 2, '0000-00-00 00:00:00', '2022-02-11 10:05:40', NULL);
INSERT INTO `answers` VALUES (19, '11xs0VWcXudhBAbnrt8xmTGeCxv1', 6, 4, 2, 2, '0000-00-00 00:00:00', '2022-02-11 10:05:54', NULL);

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES (1, '8a01f3e9c0.jpg', 'https://www.baktos.com/internasional/cheslie-kryst-miss-usa-2019-meninggal-dunia-di-usia-30-tahun', '2022-01-31 22:29:10', '2022-01-31 22:29:52', NULL);
INSERT INTO `banners` VALUES (2, '04974ee0a9d34056f63fcd3c9be9a55a.png', 'https://www.baktos.com/infotainment/drakor-all-of-us-are-dead-siswa-yang-melawan-wabah-virus-zombie', '2022-01-31 22:58:52', '2022-01-31 22:59:03', NULL);
INSERT INTO `banners` VALUES (3, 'nb_esc_cover.jpg', 'https://www.baktos.com/infotainment/selebritis/kenali-aktor-ganteng-asal-lombok-pemain-film-horor-sajen/', '2022-02-10 12:28:24', '2022-02-10 12:31:02', NULL);
INSERT INTO `banners` VALUES (4, 'istagram-fitur-baru.jpg', 'https://www.baktos.com/technology/instagram-memiliki-fitur-baru-untuk-live-video-dan-remixing-video/', '2022-02-11 08:11:51', NULL, NULL);

-- ----------------------------
-- Table structure for gallery
-- ----------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date` datetime(0) NULL DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gallery
-- ----------------------------
INSERT INTO `gallery` VALUES (2, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', 'png-clipart-brown-haired-girl-3d-character-cartoon-girl-illustration-japanese-cute-girl-cartoon-characters-cartoon-character-child.png', '2022-02-04 00:00:00', 'Ini Hasil Pembatik', '2022-02-04 18:24:15', NULL);
INSERT INTO `gallery` VALUES (3, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', 'tulis-rindu-dengan-citra-kirana-rezky-aditya-bikin-geger-190819t.jpg', '2022-02-04 00:00:00', 'Ini Hasil Pembatik', '2022-02-04 18:24:51', NULL);
INSERT INTO `gallery` VALUES (4, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', 'tulis-rindu-dengan-citra-kirana-rezky-aditya-bikin-geger-190819t.jpg', '2022-02-04 00:00:00', 'Ini Hasil Pembatik', '2022-02-04 18:25:15', '2022-02-07 13:53:15');
INSERT INTO `gallery` VALUES (8, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', 'nb_esc_cover.jpg', NULL, 'Gambar laptop', '2022-02-08 08:48:06', NULL);
INSERT INTO `gallery` VALUES (9, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', 'sponsor.png', NULL, 'TEST', '2022-02-08 08:49:52', NULL);
INSERT INTO `gallery` VALUES (10, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', 'nb_esc_cover.jpg', NULL, '', '2022-02-08 08:51:42', NULL);
INSERT INTO `gallery` VALUES (11, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', 'sponsor.png', NULL, '', '2022-02-08 08:56:02', NULL);
INSERT INTO `gallery` VALUES (12, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', '20220102_125709.jpg', NULL, 'Jalan Jalan', '2022-02-08 10:33:09', NULL);
INSERT INTO `gallery` VALUES (13, 'k7QDLHOfQHUHLWcu5T22NwJyL2r1', '20220201_215924.jpg', NULL, 'Gotong Royong', '2022-02-08 16:51:28', NULL);
INSERT INTO `gallery` VALUES (14, 'ApZXnJZ9i9SRV7rEICze9piMmA22', '1644235217355_164423518616442352173551475848669.JPG', NULL, 'ini gambar mouse', '2022-02-11 09:40:21', NULL);
INSERT INTO `gallery` VALUES (15, 'ApZXnJZ9i9SRV7rEICze9piMmA22', '1643618166564_16436181311643618166564794956208.png', NULL, 'ini gambar iPhone', '2022-02-11 09:40:44', NULL);
INSERT INTO `gallery` VALUES (16, 'ApZXnJZ9i9SRV7rEICze9piMmA22', '1643012911311_16430129081643012911311115005855.jpeg', NULL, 'ini Gambar Laptop', '2022-02-11 09:44:18', NULL);
INSERT INTO `gallery` VALUES (17, 'ApZXnJZ9i9SRV7rEICze9piMmA22', 'b2cb1791-00f3-43f0-a15e-2c826088daae7269830031925233192.jpg', NULL, 'Computer Buat Coding', '2022-02-11 10:11:25', NULL);
INSERT INTO `gallery` VALUES (18, 'ApZXnJZ9i9SRV7rEICze9piMmA22', 'c2be6542-3b06-443a-80fe-63c55535e0c4800834377455579817.jpg', NULL, 'Kegiatan Hasil Membatik', '2022-02-11 10:14:05', NULL);
INSERT INTO `gallery` VALUES (19, 'ApZXnJZ9i9SRV7rEICze9piMmA22', 'IMG-20220211-WA0000.jpg', NULL, 'Hasil Batik ', '2022-02-11 18:45:47', NULL);

-- ----------------------------
-- Table structure for level
-- ----------------------------
DROP TABLE IF EXISTS `level`;
CREATE TABLE `level`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of level
-- ----------------------------
INSERT INTO `level` VALUES (1, 'Peserta');
INSERT INTO `level` VALUES (2, 'Admin');
INSERT INTO `level` VALUES (6, 'Mentor');

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `uri` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `icon` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_main` int(11) NOT NULL,
  `is_aktif` int(1) NOT NULL DEFAULT 1,
  `order` int(2) NULL DEFAULT 0,
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'Master Data', '#', 'fas fa-th', 0, 1, 2);
INSERT INTO `menus` VALUES (2, 'Data Sekolah', 'admin/sekolah', '', 1, 1, 1);
INSERT INTO `menus` VALUES (4, 'Setting', '#', 'fas fa-cogs', 0, 1, 1);
INSERT INTO `menus` VALUES (5, 'Data Users', 'admin/users', '', 4, 1, 0);
INSERT INTO `menus` VALUES (7, 'Quiz', '#', 'fab fa-buffer', 0, 1, 3);
INSERT INTO `menus` VALUES (9, 'Quiz', 'admin/quiz', '', 7, 1, 2);
INSERT INTO `menus` VALUES (13, 'Topik Quiz', 'admin/topik', '', 7, 1, 1);
INSERT INTO `menus` VALUES (14, 'Laporan', '#', 'fas fa-file-pdf-o', 0, 1, 4);
INSERT INTO `menus` VALUES (15, 'Portfolio', 'admin/lapkegiatan', '', 14, 1, 0);
INSERT INTO `menus` VALUES (19, 'Data Peserta Smart BC', 'admin/peserta', '1', 1, 1, 2);
INSERT INTO `menus` VALUES (20, 'Data Module', 'admin/module', '', 1, 1, 3);
INSERT INTO `menus` VALUES (21, 'Data Videos', 'admin/videos', '', 1, 1, 4);
INSERT INTO `menus` VALUES (22, 'Data Banner', 'admin/banners', '', 1, 1, 5);
INSERT INTO `menus` VALUES (23, 'Gallery Membatik', 'admin/gallery', '', 14, 1, 1);
INSERT INTO `menus` VALUES (24, 'Sertifikat Peserta', 'admin/sertifikat', '', 14, 1, 2);

-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `batch` int(11) NULL DEFAULT NULL,
  `jenjang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date` datetime(0) NULL DEFAULT current_timestamp(0),
  `read` int(11) NULL DEFAULT 0,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES (1, 'Aplikasi Membatik', 1, 'SD', '2022-02-01 13:54:12', 7, 'aplikasi-membatik.pdf', '2022-02-01 13:54:17', '2022-02-09 22:42:35', '2022-02-09 09:42:35');
INSERT INTO `modules` VALUES (2, 'Aplikasi Membatik', 1, 'SD', '2022-02-01 13:54:12', 0, 'aplikasi-membatik.pdf', '2022-02-01 14:10:59', '2022-02-09 22:42:37', '2022-02-09 09:42:37');
INSERT INTO `modules` VALUES (3, 'Aplikasi Membatik', 1, 'SD', '2022-02-01 13:54:12', 1, 'aplikasi-membatik.pdf', '2022-02-01 14:10:59', '2022-02-11 10:12:25', NULL);
INSERT INTO `modules` VALUES (4, 'Aplikasi Membatik', 0, 'SD', '2022-02-01 13:54:12', 3, 'aplikasi-membatik.pdf', '2022-02-01 14:11:00', '2022-02-09 09:01:28', NULL);
INSERT INTO `modules` VALUES (5, 'Aplikasi Membatik', 0, 'SD', '2022-02-01 13:54:12', 1, 'aplikasi-membatik.pdf', '2022-02-01 14:11:01', '2022-02-10 12:01:56', '2022-02-09 23:01:56');
INSERT INTO `modules` VALUES (6, 'Aplikasi Membatik', 0, 'SD', '2022-02-01 13:54:12', 10, 'aplikasi-membatik.pdf', '2022-02-01 14:11:01', '2022-02-11 10:06:29', NULL);
INSERT INTO `modules` VALUES (7, 'Aplikasi Membatik', 2, 'SD', '2022-02-01 13:54:12', 0, 'aplikasi-membatik.pdf', '2022-02-01 14:11:02', '2022-02-10 12:01:51', '2022-02-09 23:01:51');
INSERT INTO `modules` VALUES (8, 'Aplikasi Membatik', 2, 'SD', '2022-02-01 13:54:12', 0, 'aplikasi-membatik.pdf', '2022-02-01 14:11:02', '2022-02-10 12:01:54', '2022-02-09 23:01:54');
INSERT INTO `modules` VALUES (9, 'Aplikasi Membatik', 2, 'SD', '2022-02-01 13:54:12', 2, 'aplikasi-membatik.pdf', '2022-02-01 14:11:03', '2022-02-10 12:01:49', '2022-02-09 23:01:49');
INSERT INTO `modules` VALUES (10, 'Tutorial Aplikasi Membatik Dengan Benar danTepat Untuk Pemula', 1, 'SD', '2022-02-01 13:54:12', 23, 'warta-banten-online.pdf', '2022-02-01 14:11:03', '2022-02-11 10:13:05', NULL);
INSERT INTO `modules` VALUES (11, 'Module Pertama', 0, 'SD', '2022-02-09 09:40:48', 3, 'AMBANG BATAS DAN PEROLEHAN KURSI.pdf', '2022-02-09 22:33:17', '2022-02-11 10:12:19', NULL);
INSERT INTO `modules` VALUES (12, 'Module Kedua', 0, 'SMP', NULL, 0, '358 RTLH Dibangun DPKPP Pandeglang Melalui Program BSPS _ WARTA BANTEN.pdf', '2022-02-10 11:25:54', NULL, NULL);
INSERT INTO `modules` VALUES (13, 'Module Kedua', 0, 'SMP', '0000-00-00 00:00:00', 0, '358 RTLH Dibangun DPKPP Pandeglang Melalui Program BSPS _ WARTA BANTEN.pdf', '2022-02-10 11:27:34', NULL, NULL);
INSERT INTO `modules` VALUES (14, 'Module berikutnya B', 0, 'SMA', '2022-02-10 11:30:32', 0, 'Modul PPM Video Tutorial Klaten 2014.pdf', '2022-02-10 11:30:32', '2022-02-10 11:53:32', NULL);
INSERT INTO `modules` VALUES (15, 'Module Berikutnya C', 0, 'SMP', '2022-02-11 08:09:12', 0, 'pdmc-1.pdf', '2022-02-11 08:09:12', '2022-02-11 08:09:19', '2022-02-10 19:09:19');

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NULL DEFAULT NULL,
  `options` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES (1, 1, 'Jun 2017');
INSERT INTO `options` VALUES (2, 1, 'Jun 2018');
INSERT INTO `options` VALUES (3, 1, 'May 2017');
INSERT INTO `options` VALUES (4, 1, 'May 2018');
INSERT INTO `options` VALUES (5, 2, 'Java');
INSERT INTO `options` VALUES (6, 2, 'Dart');
INSERT INTO `options` VALUES (7, 2, 'Kotlin');
INSERT INTO `options` VALUES (8, 2, 'Ruby');
INSERT INTO `options` VALUES (9, 3, 'May 4, 1776');
INSERT INTO `options` VALUES (10, 3, 'June 4, 1776');
INSERT INTO `options` VALUES (11, 3, 'July 4, 1776');
INSERT INTO `options` VALUES (12, 3, 'July 2, 1777');
INSERT INTO `options` VALUES (13, 4, 'Fiestas');
INSERT INTO `options` VALUES (14, 4, 'Bullfighting');
INSERT INTO `options` VALUES (15, 4, 'Flamenco');
INSERT INTO `options` VALUES (16, 4, 'Mariachi');
INSERT INTO `options` VALUES (21, 13, 'Jakarta');
INSERT INTO `options` VALUES (22, 13, 'Bali');
INSERT INTO `options` VALUES (23, 13, 'Kalimanan');
INSERT INTO `options` VALUES (24, 13, 'Nusantara');
INSERT INTO `options` VALUES (25, 14, 'Pandeglang');
INSERT INTO `options` VALUES (26, 14, 'Serang');
INSERT INTO `options` VALUES (27, 14, 'Cilegon');
INSERT INTO `options` VALUES (28, 14, 'Tangerang');
INSERT INTO `options` VALUES (29, 15, 'Gudeg');
INSERT INTO `options` VALUES (30, 15, 'Rendang');
INSERT INTO `options` VALUES (31, 15, 'Sayur Asem');
INSERT INTO `options` VALUES (32, 15, 'Sayur Sop');
INSERT INTO `options` VALUES (33, 16, 'Hitam');
INSERT INTO `options` VALUES (34, 16, 'Putih');
INSERT INTO `options` VALUES (35, 16, 'Ungu');
INSERT INTO `options` VALUES (36, 16, 'Coklat');
INSERT INTO `options` VALUES (45, 18, 'Barat');
INSERT INTO `options` VALUES (46, 18, 'Timur');
INSERT INTO `options` VALUES (47, 18, 'Utara');
INSERT INTO `options` VALUES (48, 18, 'Selatan');
INSERT INTO `options` VALUES (49, 18, 'Barat Daya');

-- ----------------------------
-- Table structure for quiz
-- ----------------------------
DROP TABLE IF EXISTS `quiz`;
CREATE TABLE `quiz`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NULL DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of quiz
-- ----------------------------
INSERT INTO `quiz` VALUES (1, 1, 'RadioListTile onchange value is object? type', 'Jun 2018', NULL, '2022-02-01 18:18:16', '2022-02-04 10:11:28', NULL);
INSERT INTO `quiz` VALUES (2, 1, 'Which programing language is used by Flutter ?', 'Dart', NULL, '2022-02-01 18:19:54', '2022-02-02 09:16:05', NULL);
INSERT INTO `quiz` VALUES (3, 1, 'When was the Declaration of Independence approved by the Second Continental Congress?', 'July 4, 1776', NULL, '2022-02-04 16:13:17', '2022-02-04 16:13:27', NULL);
INSERT INTO `quiz` VALUES (4, 1, 'What did the Spanish autonomous community of Catalonia ban in 2010, that took effect in 2012?', 'Bullfighting', NULL, '2022-02-04 16:14:09', '2022-02-04 16:14:16', NULL);
INSERT INTO `quiz` VALUES (13, 6, 'Ibu Kota Negara Baru', 'Nusantara', NULL, '2022-02-10 16:32:30', NULL, NULL);
INSERT INTO `quiz` VALUES (14, 6, 'Ibu Kota Provinsi Banten', 'Serang', NULL, '2022-02-10 16:39:31', NULL, NULL);
INSERT INTO `quiz` VALUES (15, 6, 'Makanan Khas Sunda', 'Sayur Asem', NULL, '2022-02-10 16:40:53', NULL, NULL);
INSERT INTO `quiz` VALUES (16, 6, 'Perpaduan Warna Hitam dan Putih Menghasilkan Warna?', 'Coklat', NULL, '2022-02-11 08:15:02', NULL, NULL);
INSERT INTO `quiz` VALUES (18, 8, 'Darimanakah Matahari Terbit ?', 'Timur', NULL, '2022-02-13 08:53:19', '2022-02-13 09:33:06', NULL);

-- ----------------------------
-- Table structure for sekolah
-- ----------------------------
DROP TABLE IF EXISTS `sekolah`;
CREATE TABLE `sekolah`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenjang` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sekolah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sekolah
-- ----------------------------
INSERT INTO `sekolah` VALUES (4, 'SD', 'SD IT ICMA', 'Jln. Raya Labuan - Pandeglang KM. 09 Kadusuluh Pandeglang - Banten', '2022-02-09 18:05:32', '2022-02-09 18:09:16');
INSERT INTO `sekolah` VALUES (5, 'SD', 'SD Negeri 1 Sukasari', 'Jln. Raya Pandeglang KM. 03 Suksari Kecamatan Kaduhejo Kab. Pandeglang - Banten', '2022-02-09 18:06:00', '2022-02-09 18:14:02');

-- ----------------------------
-- Table structure for sertifikat
-- ----------------------------
DROP TABLE IF EXISTS `sertifikat`;
CREATE TABLE `sertifikat`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sertifikat
-- ----------------------------
INSERT INTO `sertifikat` VALUES (14, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', 'AAQj0VUCx8cMihql7SLsYSgdfjC3.pdf', '2022-02-09 09:00:55', NULL);
INSERT INTO `sertifikat` VALUES (15, 'ApZXnJZ9i9SRV7rEICze9piMmA22', 'ApZXnJZ9i9SRV7rEICze9piMmA22.pdf', '2022-02-11 09:06:12', NULL);
INSERT INTO `sertifikat` VALUES (16, '11xs0VWcXudhBAbnrt8xmTGeCxv1', '11xs0VWcXudhBAbnrt8xmTGeCxv1.pdf', '2022-02-11 10:06:04', NULL);

-- ----------------------------
-- Table structure for topic
-- ----------------------------
DROP TABLE IF EXISTS `topic`;
CREATE TABLE `topic`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `thema` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `batch` int(11) NOT NULL COMMENT '0: All Kelompok',
  `date` datetime(0) NULL DEFAULT NULL,
  `jenjang` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_active` int(1) NULL DEFAULT 0 COMMENT '0: Pending, 1: Open, 2: Close',
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of topic
-- ----------------------------
INSERT INTO `topic` VALUES (1, 'Mengenal Tentang Canting dan Membatik Tradisinonal 5', 1, '2022-02-01 20:10:47', 'SD', 1, NULL, '2022-02-01 20:10:45', '2022-02-11 09:15:31', NULL);
INSERT INTO `topic` VALUES (2, 'Canting dan Membatik 4', 1, '2022-02-02 11:01:46', 'SD', 2, NULL, '2022-02-02 11:01:39', '2022-02-11 09:15:25', NULL);
INSERT INTO `topic` VALUES (3, 'Mengenal Tentang Canting dan Membatik Tradisinonal 3', 0, '2022-02-01 20:10:47', 'SD', 2, NULL, '2022-02-02 11:11:55', '2022-02-11 09:15:22', NULL);
INSERT INTO `topic` VALUES (6, 'Canting dan Membatik Tahap 2', 0, '2022-02-02 11:01:46', 'SD', 1, NULL, '2022-02-02 11:13:10', '2022-02-11 09:15:19', NULL);
INSERT INTO `topic` VALUES (8, 'Quiz Untuk Mendapatkan Sertifikat Smart Batik Class 1', 0, '2022-02-10 00:00:01', 'SD', 0, NULL, '2022-02-10 13:00:01', '2022-02-11 09:15:17', NULL);

-- ----------------------------
-- Table structure for userlevel
-- ----------------------------
DROP TABLE IF EXISTS `userlevel`;
CREATE TABLE `userlevel`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_level` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of userlevel
-- ----------------------------
INSERT INTO `userlevel` VALUES (1, 2, 1);
INSERT INTO `userlevel` VALUES (2, 2, 2);
INSERT INTO `userlevel` VALUES (4, 2, 4);
INSERT INTO `userlevel` VALUES (5, 2, 5);
INSERT INTO `userlevel` VALUES (7, 2, 7);
INSERT INTO `userlevel` VALUES (9, 2, 9);
INSERT INTO `userlevel` VALUES (13, 2, 13);
INSERT INTO `userlevel` VALUES (14, 2, 14);
INSERT INTO `userlevel` VALUES (15, 2, 15);
INSERT INTO `userlevel` VALUES (18, 2, 18);
INSERT INTO `userlevel` VALUES (19, 2, 19);
INSERT INTO `userlevel` VALUES (42, 2, 20);
INSERT INTO `userlevel` VALUES (43, 2, 21);
INSERT INTO `userlevel` VALUES (44, 2, 22);
INSERT INTO `userlevel` VALUES (45, 2, 23);
INSERT INTO `userlevel` VALUES (46, 2, 24);
INSERT INTO `userlevel` VALUES (47, 6, 1);
INSERT INTO `userlevel` VALUES (48, 6, 2);
INSERT INTO `userlevel` VALUES (51, 6, 7);
INSERT INTO `userlevel` VALUES (52, 6, 9);
INSERT INTO `userlevel` VALUES (53, 6, 13);
INSERT INTO `userlevel` VALUES (54, 6, 14);
INSERT INTO `userlevel` VALUES (55, 6, 15);
INSERT INTO `userlevel` VALUES (56, 6, 18);
INSERT INTO `userlevel` VALUES (57, 6, 19);
INSERT INTO `userlevel` VALUES (58, 6, 20);
INSERT INTO `userlevel` VALUES (59, 6, 21);
INSERT INTO `userlevel` VALUES (60, 6, 22);
INSERT INTO `userlevel` VALUES (61, 6, 23);
INSERT INTO `userlevel` VALUES (62, 6, 24);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `displayname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenjang` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sekolahid` int(11) NOT NULL,
  `jurusan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int(11) NULL DEFAULT 0,
  `is_active` int(1) NOT NULL DEFAULT 0 COMMENT '0: inactive, 1: active',
  `is_level` int(1) NOT NULL DEFAULT 1 COMMENT '1: peserta, 2: Mentor',
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `update_by` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `update_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (2, 'AAQj0VUCx8cMihql7SLsYSgdfjC3', 'programmerjunior1@gmail.com', '', 'Irfan Junior', '83813131169', 'SD', 5, 'Kp. Rambutan', 'http://192.168.1.5:8082/uploads/avatars/aaqj0vucx8cmihql7slsysgdfjc3/20220207_183552.jpg', 1, 1, 1, '2022-02-06 10:10:41', '', '2022-02-13 09:55:52', NULL);
INSERT INTO `users` VALUES (3, 'ApZXnJZ9i9SRV7rEICze9piMmA22', 'irfan@harnods.com', '', 'Prof. Irfan Rosiadi, S.Kom, MM, LC', '1234234234', 'SD', 4, 'Ilmu Komputer', 'http://192.168.1.5:8082/uploads/avatars/apzxnjz9i9srv7reicze9pimma22/nb_esc_cover.jpg', 1, 1, 1, '2022-02-06 10:43:18', '', '2022-02-11 09:03:04', NULL);
INSERT INTO `users` VALUES (4, 'k7QDLHOfQHUHLWcu5T22NwJyL2r1', 'mediabaktos@gmail.com', '$2y$04$Q9pAUoKbca3687AbJkwOC.w587UEuhNVT/zfpT240eYyZbet76lNS', 'Test Update Profile', '', 'Admin', 0, '', 'https://lh3.googleusercontent.com/a/AATXAJxJUpAsHeZVMsz3dohpGIVFqS6i2NGrIQBOPMCE=s96-c', 0, 1, 2, '2022-02-08 16:20:50', '', '2022-02-11 13:23:26', NULL);
INSERT INTO `users` VALUES (5, '11xs0VWcXudhBAbnrt8xmTGeCxv1', 'dipantaratv@gmail.com', '', 'Dipantara TV', '123009102989', 'SD', 4, 'Ekonomi Bisnis', 'https://lh3.googleusercontent.com/a-/AOh14GjSo2MNgPiixMm315-l8NeDN-ix5uL6we92PqQL=s96-c', 0, 1, 1, '2022-02-11 09:48:12', '', '2022-02-13 10:20:39', NULL);
INSERT INTO `users` VALUES (7, '', 'admin1@sample.com', '$2y$04$Q9pAUoKbca3687AbJkwOC.w587UEuhNVT/zfpT240eYyZbet76lNS', 'Irfan Rosyadi', '', '', 0, '', '', 0, 1, 6, '2022-02-11 13:07:37', '', '2022-02-11 13:26:50', NULL);

-- ----------------------------
-- Table structure for videos
-- ----------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int(11) NULL DEFAULT 0,
  `date` datetime(0) NULL DEFAULT NULL,
  `read` int(11) NULL DEFAULT 0,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of videos
-- ----------------------------
INSERT INTO `videos` VALUES (1, 'Proses dan Cara Membuat Batik dengan baik dan benar untuk pemula', 1, '2022-02-01 14:03:49', 8, '7-WQ3DKKn0w', NULL, '2022-02-01 14:03:57', '2022-02-03 13:29:01', NULL);
INSERT INTO `videos` VALUES (2, 'Proses dan Cara Membuat Batik Tutorial', 1, '2022-02-01 14:03:49', 3, '7-WQ3DKKn0w', NULL, '2022-02-01 15:44:42', '2022-02-09 23:00:06', '2022-02-09 10:00:06');
INSERT INTO `videos` VALUES (3, 'Proses dan Cara Membuat Batik Tutorial', 1, '2022-02-01 14:03:49', 1, '7-WQ3DKKn0w', NULL, '2022-02-01 15:44:43', '2022-02-03 13:43:44', NULL);
INSERT INTO `videos` VALUES (4, 'Proses dan Cara Membuat Batik Tutorial', 1, '2022-02-01 14:03:49', 0, '7-WQ3DKKn0w', NULL, '2022-02-01 15:44:43', '2022-02-03 12:53:10', NULL);
INSERT INTO `videos` VALUES (5, 'Proses dan Cara Membuat Batik Tutorial', 1, '2022-02-01 14:03:49', 1, '7-WQ3DKKn0w', NULL, '2022-02-01 15:44:43', '2022-02-03 13:31:25', NULL);
INSERT INTO `videos` VALUES (6, 'Proses dan Cara Membuat Batik Tutorial', 1, '2022-02-01 14:03:49', 9, '7-WQ3DKKn0w', NULL, '2022-02-01 15:44:44', '2022-02-04 16:18:16', NULL);
INSERT INTO `videos` VALUES (7, 'Mengupas Sejarah Kewadanan Kota Menes', 1, '2022-02-09 22:55:59', 34, 'BLxrfNp4Oak', NULL, '2022-02-01 15:44:45', '2022-02-10 11:55:59', NULL);
INSERT INTO `videos` VALUES (8, 'Cinta Luar Biasa - Andmesh', 0, '2022-02-09 09:59:30', 0, 'ZUm1iTjI8VQ', NULL, '2022-02-09 22:59:09', '2022-02-09 22:59:30', NULL);

SET FOREIGN_KEY_CHECKS = 1;
