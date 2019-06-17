/*
 Navicat Premium Data Transfer

 Source Server         : PHP工具箱
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : video

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 04/01/2019 19:52:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `truename` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '真实姓名',
  `gid` int(10) NOT NULL COMMENT '角色id',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态：0正常，1禁用',
  `add_time` int(10) NOT NULL COMMENT '添加用户时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '系统管理员', 1, 0, 1539696007);
INSERT INTO `admin` VALUES (2, 'tom', '21232f297a57a5a743894a0e4a801fc3', '网站管理员', 1, 0, 1539696007);
INSERT INTO `admin` VALUES (7, 'test', '098f6bcd4621d373cade4e832627b4f6', '张琪', 8, 0, 1541501177);
INSERT INTO `admin` VALUES (4, 'test2', '6537e99af2c2223642df9f70a0b5afca', '孟宪晖', 2, 0, 1540025777);
INSERT INTO `admin` VALUES (8, 'hbw', '0192023a7bbd73250516f069df18b500', '黄博文', 8, 0, 1541842756);
INSERT INTO `admin` VALUES (9, 'test4', 'c289ffe12a30c94530b7fc4e532e2f42', '庄燕龙', 1, 0, 1542116279);

-- ----------------------------
-- Table structure for admin_groups
-- ----------------------------
DROP TABLE IF EXISTS `admin_groups`;
CREATE TABLE `admin_groups`  (
  `gid` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色标题',
  `rights` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色权限，json格式保存',
  PRIMARY KEY (`gid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_groups
-- ----------------------------
INSERT INTO `admin_groups` VALUES (1, '系统管理员', '[1,4,9,5,6,2,11,10,3,13,14,7,8,15,16,17,18,19,20,21,22,23,24,25,26,27]');
INSERT INTO `admin_groups` VALUES (2, '开发人员', '[1,4,9,5,6,2,11,10,3,13,14,7,8,15,16,17,18,19]');
INSERT INTO `admin_groups` VALUES (8, '测试人员', '[7,8,15,16,17,18,19]');

-- ----------------------------
-- Table structure for admin_menus
-- ----------------------------
DROP TABLE IF EXISTS `admin_menus`;
CREATE TABLE `admin_menus`  (
  `mid` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `pid` int(10) NOT NULL DEFAULT 0 COMMENT '父级id',
  `ord` int(10) NOT NULL DEFAULT 0 COMMENT '菜单排序',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '菜单名称',
  `controller` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '控制器',
  `method` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '方法',
  `ishidden` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否隐藏：0正常显示，1隐藏',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态：0正常，1禁用',
  PRIMARY KEY (`mid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_menus
-- ----------------------------
INSERT INTO `admin_menus` VALUES (1, 0, 0, '管理员管理', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (2, 0, 0, '权限管理', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (3, 0, 0, '系统管理', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (4, 1, 0, '管理员列表', 'Admin', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (5, 1, 0, '管理员添加', 'Admin', 'add', 1, 0);
INSERT INTO `admin_menus` VALUES (6, 1, 0, '管理员保存', 'Admin', 'sava', 1, 0);
INSERT INTO `admin_menus` VALUES (7, 0, 0, '标签管理', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (8, 7, 0, '频道标签', 'Labels', 'channel', 0, 0);
INSERT INTO `admin_menus` VALUES (9, 4, 0, '角色测试', 'Admin', 'Tests', 0, 0);
INSERT INTO `admin_menus` VALUES (13, 3, 0, '网站设置', 'Site', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (11, 2, 0, '角色管理列表', 'Roles', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (10, 2, 0, '菜单管理列表', 'Menu', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (14, 3, 0, '保存设置', 'Site', 'save', 1, 0);
INSERT INTO `admin_menus` VALUES (15, 7, 0, '资费标签', 'Labels', 'charge', 0, 0);
INSERT INTO `admin_menus` VALUES (16, 7, 0, '地区标签', 'Labels', 'area', 0, 0);
INSERT INTO `admin_menus` VALUES (17, 7, 0, '类型标签', 'Labels', 'vtype', 0, 0);
INSERT INTO `admin_menus` VALUES (18, 7, 0, '规格标签', 'Labels', 'vnorm', 0, 0);
INSERT INTO `admin_menus` VALUES (19, 7, 0, '年代标签', 'Labels', 'vdecade', 0, 0);
INSERT INTO `admin_menus` VALUES (20, 0, 0, '影片管理', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (21, 20, 0, '影片列表', 'Video', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (22, 20, 0, '添加影片', 'Video', 'add', 1, 0);
INSERT INTO `admin_menus` VALUES (23, 20, 0, '保存影片', 'Video', 'save', 1, 0);
INSERT INTO `admin_menus` VALUES (24, 20, 0, '图片上传', 'Video', 'upload_img', 1, 0);
INSERT INTO `admin_menus` VALUES (25, 0, 0, '幻灯片管理', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (26, 25, 0, '首页首屏', 'Slide', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (27, 25, 0, '幻灯片保存', 'Slide', 'save', 1, 0);

-- ----------------------------
-- Table structure for admin_sites
-- ----------------------------
DROP TABLE IF EXISTS `admin_sites`;
CREATE TABLE `admin_sites`  (
  `names` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `values` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_sites
-- ----------------------------
INSERT INTO `admin_sites` VALUES ('site', '\"\\u53ef\\u80fd\\u662f\\u6700\\u597d\\u7528\\u7684\"');

-- ----------------------------
-- Table structure for video
-- ----------------------------
DROP TABLE IF EXISTS `video`;
CREATE TABLE `video`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `channel_id` int(10) NOT NULL COMMENT '频道id',
  `charge_id` int(10) NOT NULL COMMENT '资费id',
  `area_id` int(10) NOT NULL COMMENT '地区id',
  `vtype_id` int(10) NOT NULL COMMENT '类型id',
  `vnorm_id` int(10) NOT NULL COMMENT '规格id',
  `vdecade_id` int(10) NOT NULL COMMENT '年代id',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '影片名称',
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '影片关键字',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '影片描述',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '影片封面url',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '影片播放地址',
  `pv` int(10) NOT NULL COMMENT '影片播放次数',
  `score` int(3) NOT NULL COMMENT '影片评分',
  `is_vip` int(1) NOT NULL DEFAULT 0 COMMENT 'VIP权限 0：否 1：是',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0：正常  1：下线',
  `add_time` int(10) NOT NULL COMMENT '影片添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of video
-- ----------------------------
INSERT INTO `video` VALUES (1, 1, 11, 14, 23, 35, 47, '测试影片1', '1', '1', '/uploads/20181119\\0aebe64d5b7d37e60cf903dd86c94a4f.jpg', 'http://www.debuginn.cn', 0, 0, 0, 1, 1542628131);
INSERT INTO `video` VALUES (2, 1, 12, 13, 24, 36, 47, '测试影片2', '1', '1', '', 'http://www.debuginn.cn', 0, 0, 0, 1, 1542628131);
INSERT INTO `video` VALUES (3, 1, 12, 13, 23, 36, 47, '测试影片3', '37082619', '11', '', 'http://www.debuginn.cn', 0, 0, 0, 1, 1542628511);
INSERT INTO `video` VALUES (4, 1, 11, 13, 23, 36, 48, '测试影片4', '370', '1', '', 'http://www.debuginn.cn', 0, 0, 0, 1, 1542628531);
INSERT INTO `video` VALUES (5, 1, 12, 14, 23, 36, 47, '测试影片5', '370826199809166817', '111', '/uploads/20181119\\18ccfbda8dd5c076e81b54bfbd8eedba.jpg', 'http://www.debuginn.cn', 0, 0, 0, 1, 1542633673);
INSERT INTO `video` VALUES (7, 1, 11, 13, 22, 36, 46, '爱奇艺测试', '126393', '1111', '/uploads/20181123\\da3f4237c0d0ae2a90176fabd72dc095.jpg', 'http://www.debuginn.cn', 0, 0, 0, 0, 1542964166);
INSERT INTO `video` VALUES (6, 1, 12, 14, 23, 36, 46, '测试影片6', '11', '11', '/uploads/20181119\\592be345ca774164986bc65e1fd06d5f.png', 'http://www.debuginn.cn', 0, 0, 0, 1, 1542633997);

-- ----------------------------
-- Table structure for video_labels
-- ----------------------------
DROP TABLE IF EXISTS `video_labels`;
CREATE TABLE `video_labels`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ord` int(3) NOT NULL DEFAULT 0 COMMENT '排序',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标签标题',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '标签状态',
  `flag` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标签分类标识',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 54 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of video_labels
-- ----------------------------
INSERT INTO `video_labels` VALUES (1, 0, '电视剧', 0, 'channel');
INSERT INTO `video_labels` VALUES (2, 0, '电影', 0, 'channel');
INSERT INTO `video_labels` VALUES (3, 0, '综艺', 0, 'channel');
INSERT INTO `video_labels` VALUES (4, 0, '动漫', 0, 'channel');
INSERT INTO `video_labels` VALUES (5, 0, '纪录片', 0, 'channel');
INSERT INTO `video_labels` VALUES (6, 0, '游戏', 0, 'channel');
INSERT INTO `video_labels` VALUES (7, 0, '资讯', 0, 'channel');
INSERT INTO `video_labels` VALUES (8, 0, '娱乐', 0, 'channel');
INSERT INTO `video_labels` VALUES (9, 0, '财经', 0, 'channel');
INSERT INTO `video_labels` VALUES (10, 0, '网络电影', 0, 'channel');
INSERT INTO `video_labels` VALUES (11, 0, '免费', 0, 'charge');
INSERT INTO `video_labels` VALUES (12, 0, '付费', 0, 'charge');
INSERT INTO `video_labels` VALUES (13, 0, '华语', 0, 'area');
INSERT INTO `video_labels` VALUES (14, 0, '香港', 0, 'area');
INSERT INTO `video_labels` VALUES (15, 0, '美国', 0, 'area');
INSERT INTO `video_labels` VALUES (16, 0, '欧洲', 0, 'area');
INSERT INTO `video_labels` VALUES (17, 0, '韩国', 0, 'area');
INSERT INTO `video_labels` VALUES (18, 0, '日本', 0, 'area');
INSERT INTO `video_labels` VALUES (19, 0, '泰国', 0, 'area');
INSERT INTO `video_labels` VALUES (20, 0, '印度', 0, 'area');
INSERT INTO `video_labels` VALUES (21, 0, '其他', 0, 'area');
INSERT INTO `video_labels` VALUES (22, 0, '喜剧', 0, 'vtype');
INSERT INTO `video_labels` VALUES (23, 0, '悲剧', 0, 'vtype');
INSERT INTO `video_labels` VALUES (24, 0, '爱情', 0, 'vtype');
INSERT INTO `video_labels` VALUES (25, 0, '动作', 0, 'vtype');
INSERT INTO `video_labels` VALUES (26, 0, '枪战', 0, 'vtype');
INSERT INTO `video_labels` VALUES (27, 0, '犯罪', 0, 'vtype');
INSERT INTO `video_labels` VALUES (28, 0, '惊悚', 0, 'vtype');
INSERT INTO `video_labels` VALUES (29, 0, '恐怖', 0, 'vtype');
INSERT INTO `video_labels` VALUES (30, 0, '悬疑', 0, 'vtype');
INSERT INTO `video_labels` VALUES (31, 0, '动画', 0, 'vtype');
INSERT INTO `video_labels` VALUES (32, 0, '家庭', 0, 'vtype');
INSERT INTO `video_labels` VALUES (33, 0, '青春', 0, 'vtype');
INSERT INTO `video_labels` VALUES (34, 0, '战争', 0, 'vtype');
INSERT INTO `video_labels` VALUES (35, 0, '巨制', 0, 'vnorm');
INSERT INTO `video_labels` VALUES (36, 0, '院线', 0, 'vnorm');
INSERT INTO `video_labels` VALUES (37, 0, '独播', 0, 'vnorm');
INSERT INTO `video_labels` VALUES (38, 0, '网络大电影', 0, 'vnorm');
INSERT INTO `video_labels` VALUES (39, 0, '经典', 0, 'vnorm');
INSERT INTO `video_labels` VALUES (40, 0, '口碑佳片', 0, 'vnorm');
INSERT INTO `video_labels` VALUES (41, 0, '杜比', 0, 'vnorm');
INSERT INTO `video_labels` VALUES (42, 0, '电影节目', 0, 'vnorm');
INSERT INTO `video_labels` VALUES (43, 0, '4K', 0, 'vnorm');
INSERT INTO `video_labels` VALUES (44, 0, '原声', 0, 'vnorm');
INSERT INTO `video_labels` VALUES (45, 0, '粤语', 0, 'vnorm');
INSERT INTO `video_labels` VALUES (46, 0, '2018', 0, 'vdecade');
INSERT INTO `video_labels` VALUES (47, 0, '2017', 0, 'vdecade');
INSERT INTO `video_labels` VALUES (48, 0, '2016', 0, 'vdecade');
INSERT INTO `video_labels` VALUES (49, 0, '2015-2011', 0, 'vdecade');
INSERT INTO `video_labels` VALUES (50, 0, '2010-2000', 0, 'vdecade');
INSERT INTO `video_labels` VALUES (51, 0, '90年代', 0, 'vdecade');
INSERT INTO `video_labels` VALUES (52, 0, '80年代', 0, 'vdecade');
INSERT INTO `video_labels` VALUES (53, 0, '更早', 0, 'vdecade');

-- ----------------------------
-- Table structure for video_slide
-- ----------------------------
DROP TABLE IF EXISTS `video_slide`;
CREATE TABLE `video_slide`  (
  `id` int(10) NOT NULL,
  `ord` int(2) NOT NULL DEFAULT 0 COMMENT '排序',
  `type` int(2) NOT NULL COMMENT '类型 0：首页首屏',
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '视频链接地址',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片链接',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of video_slide
-- ----------------------------
INSERT INTO `video_slide` VALUES (0, 0, 0, '爱奇艺测试', 'http://www.debuginn.cn', '/uploads/20181205\\4e05377d71e0f1a73c7423725ae33611.jpg');

SET FOREIGN_KEY_CHECKS = 1;
