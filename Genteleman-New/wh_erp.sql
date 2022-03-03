#
# TABLE STRUCTURE FOR: admin_login
#

DROP TABLE IF EXISTS `admin_login`;

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(25) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_address` text NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `tin_no` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `admin_login` (`id`, `user_name`, `admin_email`, `admin_password`, `shop_name`, `shop_address`, `user_type`, `tin_no`, `phone_no`, `created_date`, `updated_date`) VALUES ('1', 'anantham', 'ananthamsolutions@gmail.com', 'anantham@321', 'ANANTHAM', 'Door No 61/4057,Electronic Street,Pallimukku Junction,Kochi-682016', 'A', 'ANFG2341234', '9656905555', '2017-12-11 16:23:47', '2017-12-11 11:11:44');


#
# TABLE STRUCTURE FOR: category
#

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_description` text NOT NULL,
  `category_status` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('1', 'HikVision', '', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('2', 'ERD', 'Adaptor', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('3', 'Securus ', 'BNC Connector', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('4', 'JAI', 'DC Pin', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('5', 'C P Plus', 'CCTV', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('6', 'Dahua', 'CCTV', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('7', 'Outdoor Housing', 'Camera outdoor housing aluminium', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('8', 'Camera Stand VW', 'VW Camera Stand Metal White', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('9', 'HDMI Cable', 'VW HDMI Cable 3M', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('10', 'VGA Cable', 'VW VGA Cable 1.5M White', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('11', 'Audio Mic', 'VW Audio Mic Dom', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('12', 'Coaxial Cable RG 59', 'RG 59 Coaxial Cable Trublu Eco 2+100 YD Gold', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('13', 'ZK Techo', 'CCTV', '1');
INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_status`) VALUES ('14', 'camera', 'CCTV Camera', '1');


#
# TABLE STRUCTURE FOR: color_details
#

DROP TABLE IF EXISTS `color_details`;

CREATE TABLE `color_details` (
  `color_id` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(255) NOT NULL,
  `color_remarks` text NOT NULL,
  `color_status` int(11) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `color_details` (`color_id`, `color_name`, `color_remarks`, `color_status`) VALUES ('1', 'NIL', '', '1');


#
# TABLE STRUCTURE FOR: dealer_details
#

DROP TABLE IF EXISTS `dealer_details`;

CREATE TABLE `dealer_details` (
  `dealer_id` int(11) NOT NULL AUTO_INCREMENT,
  `dealer_name` varchar(50) NOT NULL,
  `dealer_address` text NOT NULL,
  `dealer_phone` bigint(20) NOT NULL,
  `dealer_email` varchar(50) NOT NULL,
  `dealer_place` text NOT NULL,
  `dealer_status` int(11) NOT NULL,
  PRIMARY KEY (`dealer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `dealer_details` (`dealer_id`, `dealer_name`, `dealer_address`, `dealer_phone`, `dealer_email`, `dealer_place`, `dealer_status`) VALUES ('1', 'rr', 'gggg', '7878906756565', 'rfsdd@gmail.com', 'kked', '1');


#
# TABLE STRUCTURE FOR: product_details
#

DROP TABLE IF EXISTS `product_details`;

CREATE TABLE `product_details` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id_fk` int(11) NOT NULL,
  `subcategory_id_fk` int(11) NOT NULL,
  `subcategory1_id_fk` int(11) NOT NULL,
  `subcategory2_id_fk` int(11) NOT NULL,
  `subcategory3_id_fk` int(11) NOT NULL,
  `subcategory4_id_fk` int(11) NOT NULL,
  `color_id_fk` int(11) NOT NULL,
  `size_id_fk` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_reorderqty` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_status` int(11) NOT NULL,
  `product_created_date` datetime NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('1', '1', '12', '0', '0', '0', '0', '1', '1', 'Hikvision DVR 4CH 7A04HGHI F1', 'HIKVISION', '1', 'Hikvision DVR 4CH 7A04HGHI F1', '1', '2017-12-12 03:20:21');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('2', '1', '13', '0', '0', '0', '0', '1', '1', 'Hikvision DVR 8CH 7A08HGHI F1', 'HIKVISION', '1', 'Hikvision DVR 8CH 7A08HGHI F1', '1', '2017-12-12 03:21:23');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('3', '1', '14', '0', '0', '0', '0', '1', '1', 'Hikvision Bullet IR HD 720 DS2CE16COT-IRP', 'Hikvision', '4', 'Hikvision  Bullet IR HD 720 DS2CE16COT-IRP', '1', '2017-12-12 03:22:06');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('4', '1', '15', '0', '0', '0', '0', '1', '1', 'Hikvision DOM IR HD 720 DS2CE5A COT IRPF', 'HIKVISION', '4', 'Hikvision DOM IR HD 720 DS 2CE5A COT IRPF', '1', '2017-12-12 03:22:58');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('5', '1', '16', '0', '0', '0', '0', '1', '1', 'Hikvision DOM  Camera 2MP DS-2CE5ADOT-IRPF 3.6mm', 'HIKVISION', '4', 'HIKVISION  DOM Camera 2MP DS-2CE5ADOT-IRPF 3.6mm', '1', '2017-12-12 03:25:31');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('6', '1', '17', '0', '0', '0', '0', '1', '1', 'Hikvision DVR ECO 7A04HGHI-F1/N', 'HIKVISION', '1', 'Hikvision DVR 4CH ECO DS-7A04HGHI-F1/N', '1', '2017-12-12 03:29:01');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('7', '1', '18', '0', '0', '0', '0', '1', '1', 'Hikvision DVR ECO DS-7A08HGHI-F1/N', 'HIKVISION', '1', 'Hikvision DVR 8CH ECO DS-7A08HGHI-f!/N', '1', '2017-12-12 03:30:05');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('8', '1', '19', '0', '0', '0', '0', '1', '1', 'Hikvision Bullet Camera DS-2CE1ACOT-IRP/ECO 3.6mm ECO 3.6MM', 'HIKVISION', '4', 'Hikvision Bullet Camerea Eco 3.6mm ', '1', '2017-12-12 03:31:21');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('9', '1', '20', '0', '0', '0', '0', '1', '1', 'Hikvision Dom Camera DS-2CE5ACOT-IRP/ECO 3.6MM', 'HIKVISION', '4', 'Hikvision Dom Camera DS-2CE5ACOT-IRP/ECO 3.6mm', '1', '2017-12-12 03:33:06');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('10', '2', '21', '0', '0', '0', '0', '1', '1', 'LPP Adapter SMPS AD-1210AT IT Product', 'ERD', '1', 'ERD LPP Adapter SMPS AD-1210AT IT Product', '1', '2017-12-12 03:35:04');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('11', '2', '22', '0', '0', '0', '0', '1', '1', ' LPP Adapter SMPS AD-125A0D IT Product', 'ERD', '1', 'ERD LPP Adapter SMPS AD-125A0D IT Product', '1', '2017-12-12 03:36:54');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('12', '2', '23', '0', '0', '0', '0', '1', '1', 'LPP Adapter SMPS AD-123A0D IT Product', 'ERD', '1', 'ERD LPP Adapter SMPS AD-123A0D IT Product', '1', '2017-12-12 03:37:36');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('13', '2', '24', '0', '0', '0', '0', '1', '1', 'LPP Adapter SMPS 12V 5A Ad-11 IT Product', 'ERD', '1', 'ERD LPP Adapter SMPS 12V 5A Ad-11 IT Product', '1', '2017-12-12 03:38:03');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('14', '2', '25', '0', '0', '0', '0', '1', '1', 'LPP Adapter SMPS 12V 10A AD-22 IT Product', 'ERD', '1', 'ERD LPP Adapter SMPS 12V 10A AD-22 IT Product', '1', '2017-12-12 03:38:32');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('15', '3', '26', '0', '0', '0', '0', '1', '1', 'Securus BNC Connector', 'Securus', '1', 'Securus BNC Connector', '1', '2017-12-12 03:39:04');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('16', '4', '27', '0', '0', '0', '0', '1', '1', 'Jai DC Pin Connector Screw Type', 'Jai', '1', 'Jai DC Pin Connector Screw Type', '1', '2017-12-12 03:39:32');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('17', '4', '28', '0', '0', '0', '0', '1', '1', 'Jai DC Pin Connector Wire Type', 'Jai', '1', 'Jai DC Pin Connector Wire Type', '1', '2017-12-12 03:39:47');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('18', '5', '29', '0', '0', '0', '0', '1', '1', 'C P Plus DVR 4CH HDCVI Panta Brid DVR W/O HD CP - UVR - 040', 'C P Plus', '1', 'C P Plus DVR 4CH HDCVI Panta Brid DVR W/O HD CP - UVR - 040', '1', '2017-12-12 03:40:30');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('19', '5', '30', '0', '0', '0', '0', '1', '1', 'CP PLus HDCVI Bullet IR CP-USC-TA 10L2-0360', 'C P Plus', '4', 'CP PLus HDCVI Bullet IR CP-USC-TA 10L2-0360', '1', '2017-12-12 03:40:56');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('20', '5', '31', '0', '0', '0', '0', '1', '1', 'CP Plus Dom IR CP-VAC-D10L2 1MP 3.6mm 20 Mtr', 'C P Plus', '4', 'CP Plus Dom IR CP-VAC-D10L2 1MP 3.6mm 20 Mtr', '1', '2017-12-12 03:41:13');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('21', '5', '32', '0', '0', '0', '0', '1', '1', 'C P Plus Bullet CP-VCG-ST13L2 1.3MP 3.6mm 20 Mtr', 'C P Plus', '4', 'C P Plus Bullet CP-VCG-ST13L2 1.3MP 3.6mm 20 Mtr', '1', '2017-12-12 03:41:45');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('22', '5', '33', '0', '0', '0', '0', '1', '1', 'C P Plus DOM IR CP-VAC-D13L2 1.3MP 3.6mm 20 Mtr', 'C P Plus', '4', 'C P Plus DOM IR CP-VAC-D13L2 1.3MP 3.6mm 20 Mtr', '1', '2017-12-12 03:42:09');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('23', '6', '34', '0', '0', '0', '0', '1', '1', 'Dahua 4CH XVR W/O HDD DH-XVR4104HS', 'Dahua', '1', 'Dahua 4CH XVR W/O HDD DH-XVR4104HS', '1', '2017-12-12 03:42:40');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('24', '6', '35', '0', '0', '0', '0', '1', '1', 'Dahua Bullet IR HDCVI HFW1000RM 0360B', 'Dahua', '4', 'Dahua Bullet IR HDCVI HFW1000RM 0360B', '1', '2017-12-12 03:42:59');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('25', '6', '36', '0', '0', '0', '0', '1', '1', 'Dahua Dom IR HDCVI HDW1100RP 0360B', 'Dahua', '4', 'Dahua Dom IR HDCVI HDW1100RP 0360B', '1', '2017-12-12 03:43:28');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('26', '7', '37', '0', '0', '0', '0', '1', '1', 'Camera Outdoor Housing Aluminium', 'CCD Housing', '1', 'Camera Outdoor Housing Aluminium', '1', '2017-12-12 03:43:58');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('27', '8', '40', '0', '0', '0', '0', '1', '1', 'VW Camera Stand Metal White', 'VW', '1', 'VW Camera Stand Metal White', '1', '2017-12-12 03:44:30');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('28', '9', '39', '0', '0', '0', '0', '1', '1', 'VW HDMI Cable 3M', 'VW', '1', 'VW HDMI Cable 3M', '1', '2017-12-12 03:45:00');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('29', '9', '38', '0', '0', '0', '0', '1', '1', 'VW HDMI Cable 1.5M', 'VW', '1', 'VW HDMI Cable 1.5M', '1', '2017-12-12 03:45:23');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('30', '10', '41', '0', '0', '0', '0', '1', '1', 'VW VGA Cable 1.5M White', 'VW', '1', 'VW VGA Cable 1.5M White', '1', '2017-12-12 03:45:39');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('31', '11', '42', '0', '0', '0', '0', '1', '1', 'VW Audio Mic Dom', 'VW', '1', 'VW Audio Mic Dom', '1', '2017-12-12 02:08:16');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('32', '12', '44', '0', '0', '0', '0', '1', '1', 'RG 59 Coaxial Cable Trublu Eco 2+100 YD Gold', 'Trublu', '1', 'RG 59 Coaxial Cable Trublu Eco 2+100 YD Gold', '1', '2017-12-12 03:47:09');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('33', '12', '43', '0', '0', '0', '0', '1', '1', 'RG 59 Coaxial Cable Trublu Eco 3+100 YD Gold', 'Trublu', '1', 'RG 59 Coaxial Cable Trublu Eco 3+100 YD Gold', '1', '2017-12-12 03:46:49');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('34', '13', '45', '0', '0', '0', '0', '1', '1', 'Camera ZK GT-AD1220A-3.6mm Plastic Dome 2MP 4in1 -8525', 'ZK Techo', '4', 'Camera ZK GT-AD1220A-3.6mm Plastic Dome 2MP 4in1 -8525', '1', '2017-12-12 03:47:34');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('35', '13', '46', '0', '0', '0', '0', '1', '1', 'Camera ZK Dome GT-AD1213-1/2.8 Sony 2.8-12mm - 8525', 'ZK Techo', '2', 'Camera ZK Dome GT-AD1213-1/2.8 Sony 2.8-12mm - 8525', '1', '2017-12-12 03:47:51');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('36', '13', '47', '0', '0', '0', '0', '1', '1', 'Camera ZK GT-AB1213B Metal Bullet 1.3 MP 4 in 1 3.6mm-8525', 'ZK Techo', '2', 'Camera ZK GT-AB1213B Metal Bullet 1.3 MP 4 in 1 3.6mm-8525', '1', '2017-12-12 03:48:33');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('37', '13', '48', '0', '0', '0', '0', '1', '1', 'Camera ZK GT-AD1213 Bullet 1.3MP 1/2.8 Sony 8mm -8525', 'ZK Techo', '2', 'Camera ZK GT-AD1213 Bullet 1.3MP 1/2.8 Sony 8mm -8525', '1', '2017-12-12 03:48:49');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('38', '13', '49', '0', '0', '0', '0', '1', '1', 'Camera ZK GT-ADM220 AHD Metal Bullet 6mm 2MP-8525', 'ZK Teck', '1', 'Camera ZK GT-ADM220 AHD Metal Bullet 6mm 2MP-8525', '1', '2017-12-12 03:49:08');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('39', '13', '50', '0', '0', '0', '0', '1', '1', 'Camera ZK GT-ADP220 4mm Metal Bullet 2MP-8525', 'ZK Techo', '1', 'Camera ZK GT-ADP220 4mm Metal Bullet 2MP-8525', '1', '2017-12-12 03:49:41');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('40', '13', '51', '0', '0', '0', '0', '1', '1', 'Camera ZK GT BB513 IP Bullet 1.3MP 3.6mm -8525', 'ZK Techo', '1', 'Camera ZK GT BB513 IP Bullet 1.3MP 3.6mm -8525', '1', '2017-12-12 03:49:59');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('41', '13', '52', '0', '0', '0', '0', '1', '1', 'Camera ZK PT-DA294K2 IP Plastic Dome 4MP 4mm-8525', 'ZK Techo', '1', 'Camera ZK PT-DA294K2 IP Plastic Dome 4MP 4mm-8525', '1', '2017-12-12 03:50:19');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('42', '13', '53', '0', '0', '0', '0', '1', '1', 'XVR ZK-4 Channel 1080P-DVR 1 Sata-Z304XE-C-8521', 'ZK Techo', '1', 'XVR ZK-4 Channel 1080P-DVR 1 Sata-Z304XE-C-8521', '1', '2017-12-12 03:50:33');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('43', '13', '54', '0', '0', '0', '0', '1', '1', 'Fingerprint Time Attendance Device (K13) PRO-8543', 'ZK Techo', '1', 'Fingerprint Time Attendance Device (K13) PRO-8543', '1', '2017-12-12 03:50:56');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('44', '13', '55', '0', '0', '0', '0', '1', '1', 'Fingerprint Time Attendance Device (K13) PRO-8543', 'ZK Techo', '1', 'Fingerprint Time Attendance Device (K13) PRO-8543', '1', '2017-12-12 03:51:21');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('45', '13', '56', '0', '0', '0', '0', '1', '1', 'Magnetic Lock E/Bolt ZK (AL-100) -8301', 'ZK Techo', '1', 'Magnetic Lock E/Bolt ZK (AL-100) -8301', '1', '2017-12-12 03:51:36');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('46', '13', '57', '0', '0', '0', '0', '1', '1', 'Fingerprint (PL10) Door Lock W/O Card-8543', 'ZK Techo', '1', 'Fingerprint (PL10) Door Lock W/O Card-8543', '1', '2017-12-12 03:51:54');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('47', '13', '58', '0', '0', '0', '0', '1', '1', 'Exit Button/Em Break Glass (EB900)-8536', 'ZK Techo', '1', 'Exit Button/Em Break Glass (EB900)-8536', '1', '2017-12-12 03:52:12');
INSERT INTO `product_details` (`product_id`, `category_id_fk`, `subcategory_id_fk`, `subcategory1_id_fk`, `subcategory2_id_fk`, `subcategory3_id_fk`, `subcategory4_id_fk`, `color_id_fk`, `size_id_fk`, `product_name`, `product_brand`, `product_reorderqty`, `product_description`, `product_status`, `product_created_date`) VALUES ('48', '13', '59', '0', '0', '0', '0', '1', '1', 'Bracket for Camera GT-ADP - 8525', 'ZK Techo', '1', 'Bracket for Camera GT-ADP - 8525', '1', '2017-12-12 03:52:30');


#
# TABLE STRUCTURE FOR: purchase_details
#

DROP TABLE IF EXISTS `purchase_details`;

CREATE TABLE `purchase_details` (
  `purchase_id` double NOT NULL AUTO_INCREMENT,
  `product_id_fk` int(11) NOT NULL,
  `vendor_id_fk` int(11) NOT NULL,
  `include_bill` int(11) NOT NULL,
  `tax_id_fk` int(11) NOT NULL,
  `product_purchase_quantity` float NOT NULL,
  `product_hsn` varchar(50) NOT NULL,
  `purchase_return_qty` int(11) NOT NULL,
  `purchase_price` double NOT NULL,
  `sale_price` double NOT NULL,
  `purchase_total_price` double NOT NULL,
  `purchase_grandd_total` double NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_created_date` datetime NOT NULL,
  `purchase_invoice_no` int(11) NOT NULL,
  `purchase_invoice_number` varchar(255) NOT NULL,
  `purchase_remarks` text NOT NULL,
  `purchase_status` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: purchase_return
#

DROP TABLE IF EXISTS `purchase_return`;

CREATE TABLE `purchase_return` (
  `preturn_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(11) NOT NULL,
  `purchase_id_fk` int(11) NOT NULL,
  `product_id_fk` int(11) NOT NULL,
  `customer_id_fk` int(11) NOT NULL,
  `return_qty` int(11) NOT NULL,
  `preturnpurchase_quantity` int(11) NOT NULL,
  `return_date` date NOT NULL,
  `return_reason` int(11) NOT NULL,
  `return_description` text NOT NULL,
  `return_status` int(11) NOT NULL,
  PRIMARY KEY (`preturn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: roomorblock
#

DROP TABLE IF EXISTS `roomorblock`;

CREATE TABLE `roomorblock` (
  `rb_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_id_fk` varchar(50) NOT NULL,
  `warehouse_rk` varchar(50) NOT NULL,
  `warehouse_rb` varchar(50) NOT NULL,
  `rb_status` int(11) NOT NULL,
  PRIMARY KEY (`rb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `roomorblock` (`rb_id`, `warehouse_id_fk`, `warehouse_rk`, `warehouse_rb`, `rb_status`) VALUES ('1', '1', '1', '1', '1');


#
# TABLE STRUCTURE FOR: sale_details
#

DROP TABLE IF EXISTS `sale_details`;

CREATE TABLE `sale_details` (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id_fk` int(11) NOT NULL,
  `product_id_fk` int(11) NOT NULL,
  `dealer_id_fk` int(11) NOT NULL,
  `sale_quantity` float NOT NULL,
  `sale_price` double NOT NULL,
  `sale_discount` double NOT NULL,
  `without_taxamt` double NOT NULL,
  `sale_total_price` double NOT NULL,
  `sale_payment_mode` int(11) NOT NULL,
  `grand_total` double NOT NULL,
  `sale_remarks` text NOT NULL,
  `sale_date` date DEFAULT NULL,
  `sale_created_date` datetime NOT NULL,
  `sale_invoice_number` int(11) NOT NULL,
  `taxid_fk` int(11) NOT NULL,
  `sale_status` int(11) NOT NULL,
  `cust_details` int(11) NOT NULL,
  PRIMARY KEY (`sale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: sale_return
#

DROP TABLE IF EXISTS `sale_return`;

CREATE TABLE `sale_return` (
  `sreturn_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(11) NOT NULL,
  `sale_id_fk` int(11) NOT NULL,
  `product_id_fk` int(11) NOT NULL,
  `return_qty` int(11) NOT NULL,
  `sreturn_qty` int(11) NOT NULL,
  `return_date` date NOT NULL,
  `return_reason` int(11) NOT NULL,
  `return_description` text NOT NULL,
  `return_status` int(11) NOT NULL,
  PRIMARY KEY (`sreturn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: size
#

DROP TABLE IF EXISTS `size`;

CREATE TABLE `size` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `size_name` varchar(255) NOT NULL,
  `size_description` text NOT NULL,
  `size_status` int(11) NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `size` (`size_id`, `size_name`, `size_description`, `size_status`) VALUES ('1', 'NIL', '', '1');
INSERT INTO `size` (`size_id`, `size_name`, `size_description`, `size_status`) VALUES ('2', '1.3 mp', '', '1');


#
# TABLE STRUCTURE FOR: stock_details
#

DROP TABLE IF EXISTS `stock_details`;

CREATE TABLE `stock_details` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id_fk` int(11) NOT NULL,
  `warehouse_id_fk` int(11) NOT NULL,
  `rb_id_fk` int(11) NOT NULL,
  `purchase_quantity` double NOT NULL,
  `purchase_total_amount` double NOT NULL,
  `sale_quantity` double NOT NULL,
  `sale_total_amount` double NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `manuf_date` date NOT NULL,
  `expr_date` date NOT NULL,
  `stock_status` int(11) NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('1', '1', '1', '1', '0', '0', '0', '0', '2017-12-12 10:03:10', '2017-12-14 08:09:09', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('2', '2', '1', '1', '0', '0', '0', '0', '2017-12-12 12:06:34', '2017-12-14 08:04:26', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('3', '3', '1', '1', '0', '0', '0', '0', '2017-12-12 12:11:22', '2017-12-14 06:53:34', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('4', '4', '1', '1', '0', '0', '0', '0', '2017-12-12 12:50:56', '2017-12-14 06:53:34', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('5', '5', '1', '1', '0', '0', '0', '0', '2017-12-12 12:53:43', '2017-12-14 06:53:34', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('6', '6', '1', '1', '0', '0', '0', '0', '2017-12-12 12:55:15', '2017-12-14 06:53:34', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('7', '7', '1', '1', '0', '0', '0', '0', '2017-12-12 12:57:49', '2017-12-14 06:53:35', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('8', '8', '1', '1', '0', '0', '0', '0', '2017-12-12 12:58:56', '2017-12-14 06:53:35', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('9', '9', '1', '1', '0', '0', '0', '0', '2017-12-12 01:00:17', '2017-12-14 06:53:35', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('10', '10', '0', '0', '0', '0', '0', '0', '2017-12-12 01:01:36', '2017-12-14 07:00:05', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('11', '11', '0', '0', '0', '0', '0', '0', '2017-12-12 01:02:46', '2017-12-12 01:02:46', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('12', '12', '0', '0', '0', '0', '0', '0', '2017-12-12 01:07:09', '2017-12-12 01:07:09', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('13', '13', '0', '0', '0', '0', '0', '0', '2017-12-12 01:11:10', '2017-12-12 01:11:10', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('14', '14', '0', '0', '0', '0', '0', '0', '2017-12-12 01:13:26', '2017-12-12 01:13:26', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('15', '15', '0', '0', '0', '0', '0', '0', '2017-12-12 01:14:54', '2017-12-12 01:14:54', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('16', '16', '0', '0', '0', '0', '0', '0', '2017-12-12 01:16:01', '2017-12-12 01:16:01', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('17', '17', '0', '0', '0', '0', '0', '0', '2017-12-12 01:17:50', '2017-12-12 01:17:50', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('18', '18', '0', '0', '0', '0', '0', '0', '2017-12-12 01:27:42', '2017-12-12 01:27:42', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('19', '19', '0', '0', '0', '0', '0', '0', '2017-12-12 01:37:52', '2017-12-12 01:37:52', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('20', '20', '0', '0', '0', '0', '0', '0', '2017-12-12 01:41:28', '2017-12-12 01:41:28', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('21', '21', '0', '0', '0', '0', '0', '0', '2017-12-12 01:46:43', '2017-12-12 01:46:43', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('22', '22', '0', '0', '0', '0', '0', '0', '2017-12-12 01:48:42', '2017-12-12 01:48:42', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('23', '23', '0', '0', '0', '0', '0', '0', '2017-12-12 01:51:56', '2017-12-12 01:51:56', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('24', '24', '0', '0', '0', '0', '0', '0', '2017-12-12 01:54:20', '2017-12-12 01:54:20', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('25', '25', '0', '0', '0', '0', '0', '0', '2017-12-12 01:57:48', '2017-12-12 01:57:48', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('26', '26', '0', '0', '0', '0', '0', '0', '2017-12-12 01:59:58', '2017-12-12 01:59:58', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('27', '27', '1', '1', '0', '0', '0', '0', '2017-12-12 02:03:05', '2017-12-13 09:56:17', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('28', '28', '0', '0', '0', '0', '0', '0', '2017-12-12 02:04:21', '2017-12-12 02:04:21', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('29', '29', '0', '0', '0', '0', '0', '0', '2017-12-12 02:06:19', '2017-12-12 02:06:19', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('30', '30', '0', '0', '0', '0', '0', '0', '2017-12-12 02:07:22', '2017-12-12 02:07:22', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('31', '31', '0', '0', '0', '0', '0', '0', '2017-12-12 02:08:16', '2017-12-12 02:08:16', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('32', '32', '0', '0', '0', '0', '0', '0', '2017-12-12 02:10:11', '2017-12-12 02:10:11', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('33', '33', '0', '0', '0', '0', '0', '0', '2017-12-12 02:11:09', '2017-12-12 02:11:09', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('34', '34', '0', '0', '0', '0', '0', '0', '2017-12-12 02:14:29', '2017-12-12 02:14:29', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('35', '35', '0', '0', '0', '0', '0', '0', '2017-12-12 02:19:37', '2017-12-12 02:19:37', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('36', '36', '0', '0', '0', '0', '0', '0', '2017-12-12 02:29:19', '2017-12-12 02:29:19', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('37', '37', '0', '0', '0', '0', '0', '0', '2017-12-12 02:31:31', '2017-12-12 02:31:31', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('38', '38', '0', '0', '0', '0', '0', '0', '2017-12-12 02:33:24', '2017-12-12 02:33:24', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('39', '39', '0', '0', '0', '0', '0', '0', '2017-12-12 02:35:32', '2017-12-12 02:35:32', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('40', '40', '0', '0', '0', '0', '0', '0', '2017-12-12 02:37:09', '2017-12-12 02:37:09', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('41', '41', '0', '0', '0', '0', '0', '0', '2017-12-12 02:40:33', '2017-12-12 02:40:33', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('42', '42', '0', '0', '0', '0', '0', '0', '2017-12-12 02:43:53', '2017-12-12 02:43:53', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('43', '43', '0', '0', '0', '0', '0', '0', '2017-12-12 02:46:36', '2017-12-12 02:46:36', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('44', '44', '0', '0', '0', '0', '0', '0', '2017-12-12 02:48:58', '2017-12-12 02:48:58', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('45', '45', '0', '0', '0', '0', '0', '0', '2017-12-12 02:51:20', '2017-12-12 02:51:20', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('46', '46', '0', '0', '0', '0', '0', '0', '2017-12-12 02:52:48', '2017-12-12 02:52:48', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('47', '47', '0', '0', '0', '0', '0', '0', '2017-12-12 02:55:29', '2017-12-12 02:55:29', '1970-01-01', '1970-01-01', '1');
INSERT INTO `stock_details` (`stock_id`, `product_id_fk`, `warehouse_id_fk`, `rb_id_fk`, `purchase_quantity`, `purchase_total_amount`, `sale_quantity`, `sale_total_amount`, `created_date`, `updated_date`, `manuf_date`, `expr_date`, `stock_status`) VALUES ('48', '48', '0', '0', '0', '0', '0', '0', '2017-12-12 02:56:47', '2017-12-12 02:56:47', '1970-01-01', '1970-01-01', '1');


#
# TABLE STRUCTURE FOR: subcategory
#

DROP TABLE IF EXISTS `subcategory`;

CREATE TABLE `subcategory` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id_fk` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_remarks` text NOT NULL,
  `subcategory_status` int(11) NOT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('1', '1', 'Camera Zk GT-AD1220A-3.6MM 2.MP', 'plastic dome', '0');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('2', '2', 'DVR 4CH 7A04HGHI F1', '', '0');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('3', '2', 'DVR 8CH 7A08HGHI F1', '', '0');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('4', '2', 'BULLET  IR HD 720 DS2CE16COT-IRP', '', '0');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('5', '2', 'DOM IR HD 720 DS2CE5A COT IRPF', '', '0');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('6', '2', 'DOM CAMERA 2MP DS_2CE5ADOT-IRPF 3.6MM', '', '0');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('7', '2', 'DVR  ECO DS-7A04HGHI-F1/N', '', '0');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('8', '2', 'DVR ECO DS-7A08HGHI-F1/N', '', '0');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('9', '2', 'BULLET CAMERA DS-2CE1ACOT-IRP/ECO 3.6MM', '', '0');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('10', '2', 'DOM CAMERA  DS-2CE5ACOT-IRP/ECO 3.6MM', '', '0');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('11', '1', 'DVR ', '', '0');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('12', '1', 'DVR 4CH 7A04HGHI F1', '', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('13', '1', 'DVR 8CH 7A08HGHI F1', '', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('14', '1', 'BULLET  IR HD 720 DS2CE16COT-IRP', '', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('15', '1', 'DOM IR HD 720 DS2CE5A COT IRPF', '', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('16', '1', 'DOM CAMERA 2MP DS_2CE5ADOT-IRPF 3.6MM', '', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('17', '1', 'DVR  ECO DS-7A04HGHI-F1/N', '', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('18', '1', 'DVR ECO DS-7A08HGHI-F1/N', '', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('19', '1', 'BULLET CAMERA DS-2CE1ACOT-IRP/ECO 3.6MM', '', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('20', '1', 'DOM CAMERA  DS-2CE5ACOT-IRP/ECO 3.6MM', '', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('21', '2', 'AD-1210AT', 'Adaptor', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('22', '2', 'AD-125A0D', 'Adaptor', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('23', '2', 'AD-123A0D', 'Adaptor', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('24', '2', 'AD11', 'Adapter SMPS', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('25', '2', 'AD-22', 'Adapter SMPS', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('26', '3', 'BNC Connector', 'BNC ', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('27', '4', 'DC Pin Screw Type', 'Screw Type', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('28', '4', 'DC Pin Wire Type', 'With Soldering wire', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('29', '5', 'DVR  4CH HDCVI PANTA BRID DVR W/O HD CP - UVR - 040', 'DVR  4CH HDCVI PANTA BRID DVR W/O HD CP - UVR - 040', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('30', '5', 'Bullet Camera CP-USC-TA 10L2-0360', 'Bullet Cmera', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('31', '5', 'Dom Camera IR CP-VAC-D 10L2 ', '1MP 3.6mm 20 Mtr', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('32', '5', 'Bullet Camera CP-VCG-ST13L2', '1.3 MP 3.6mm 20 Mtr', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('33', '5', 'Dom Camera IR CP-VAC-D13L2', '1.3 MP 3.6mm 20 Mtr', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('34', '6', 'DVR  4CH XVR W/O HDD DH-XVR4104HS', 'DVR', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('35', '6', 'Bullet Camera IR HDCVI HFW1000RM 0360B', 'Bullet Camera', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('36', '6', 'Dom Camera IR HDCVI HDW1100RP 0360B', 'Dom Camera', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('37', '7', 'Camera outdoor housing Aluminium', 'Camera outdoor housing aluminium', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('38', '9', 'VW HDMI Cable 1.5 M', 'VW HDMI Cable 1.5M', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('39', '9', 'VW HDMI Cable 3M', 'VW HDMI Cable 3M', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('40', '8', 'VW Camrea Stand Metal  White', 'VW Camera Stand Metal White', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('41', '10', 'VW VGA Cable 1.5M White', 'VW VGA Cable 1.5M White', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('42', '11', 'VW Audio Mic Dom', 'VW Audio Mic Dom', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('43', '12', 'RG 59 Coaxial Cable Trublu Eco 3+100 YD Gold', 'RG 59 Coaxial Cable Trublu Eco 3+100 YD Gold', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('44', '12', 'RG 59 Coaxial Cable Trublu Eco 2+100 YD Gold', 'RG 59 Coaxial Cable Trublu Eco 2+100 YD Gold', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('45', '13', 'Camera ZK GT-AD1220A 3.6mm ', 'Plastic Dome 2 MP 4IN1 -8525', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('46', '13', 'Camera ZK Dome GT-AD1213-1/2.8 Sony', '2.8-12mm, 1.3MP-8525', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('47', '13', 'Camera ZK GT -AB1213B Metal Bullet', '1.3MP, 4 in 1, 3.6MM -8525', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('48', '13', 'Camera ZK GT-AD1213 Bullet', '1.3MP 1/2.8 Sony, 8MM -8525', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('49', '13', 'Camera ZK GT-ADM220 AHD Metal Bullet', '6mm, 2MP-8525', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('50', '13', 'Camera ZK GT-ADP220,4MM Metal Bullet', '4 mm, 2MP-8525', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('51', '13', 'Camera ZK GT-BB513 IP Bullet', '1.3 MP, 3.6mm -8525', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('52', '13', 'Camera ZK PT-DA294K2 IP Plastic Dome', '4MP, 4mm - 8525', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('53', '13', 'XVR ZK -4 Channel 1080P - DVR ', 'SATA-Z304XE-C -8521', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('54', '13', 'Fingerprint Time Attendance Device (K13) PRO-8543', 'Fingerprint Time Attendance Device (K13)PRO-8543', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('55', '13', 'Fingerprint Time Attendance Device (X305 PRO-ID) -8543', 'Fingerprint Time Attendance Device (X305 PRO-ID) - 8543', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('56', '13', 'Magnetic Lock E/Bolt ZK (AL-100) -8301', 'Magnetic Lock E/Bolt ZK (AL-100) - 8301', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('57', '13', 'Fingerprint Door Lock (PL10) W/O Card - 8543', 'Fingerprint Door Lock (PL10) W/O Card - 8543', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('58', '13', 'Exit Button, Em Break Glass (EB900) -8536', 'Exit Button, Em Break Glass (EB900) -8536', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('59', '13', 'Bracket for Camera GT-ADP-8525', 'Bracket for Camera GT-ADP-8525', '1');
INSERT INTO `subcategory` (`subcategory_id`, `category_id_fk`, `subcategory_name`, `subcategory_remarks`, `subcategory_status`) VALUES ('60', '14', 'CCTV Camera', '', '1');


#
# TABLE STRUCTURE FOR: subcategory1
#

DROP TABLE IF EXISTS `subcategory1`;

CREATE TABLE `subcategory1` (
  `subcategory1_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id_fk` int(11) NOT NULL,
  `subcategory1_name` varchar(50) NOT NULL,
  `subcategory1_remarks` text NOT NULL,
  `subcategory1_status` int(11) NOT NULL,
  PRIMARY KEY (`subcategory1_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `subcategory1` (`subcategory1_id`, `category_id_fk`, `subcategory1_name`, `subcategory1_remarks`, `subcategory1_status`) VALUES ('1', '2', 'DVR 8CH 7A08HGHI F1', '', '1');


#
# TABLE STRUCTURE FOR: subcategory2
#

DROP TABLE IF EXISTS `subcategory2`;

CREATE TABLE `subcategory2` (
  `subcategory2_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id_fk` int(11) NOT NULL,
  `subcategory2_name` varchar(50) NOT NULL,
  `subcategory2_remarks` text NOT NULL,
  `subcategory2_status` int(11) NOT NULL,
  PRIMARY KEY (`subcategory2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: subcategory3
#

DROP TABLE IF EXISTS `subcategory3`;

CREATE TABLE `subcategory3` (
  `subcategory3_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id_fk` int(11) NOT NULL,
  `subcategory3_name` varchar(50) NOT NULL,
  `subcategory3_remarks` text NOT NULL,
  `subcategory3_status` int(11) NOT NULL,
  PRIMARY KEY (`subcategory3_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: subcategory4
#

DROP TABLE IF EXISTS `subcategory4`;

CREATE TABLE `subcategory4` (
  `subcategory4_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id_fk` int(11) NOT NULL,
  `subcategory4_name` varchar(50) NOT NULL,
  `subcategory4_remarks` text NOT NULL,
  `subcategory4_status` int(11) NOT NULL,
  PRIMARY KEY (`subcategory4_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tax_class
#

DROP TABLE IF EXISTS `tax_class`;

CREATE TABLE `tax_class` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(255) NOT NULL,
  `tax_type` int(11) NOT NULL,
  `tax_amount` double NOT NULL,
  `tax_description` text NOT NULL,
  `tax_status` int(11) NOT NULL,
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('1', 'GST @ 12% (split tax)', '1', '12', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('2', 'GST @ 18% (split tax)', '1', '18', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('3', 'GST @ 28% (split tax)', '1', '28', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('4', 'GST @ 5% (split tax)', '1', '5', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('5', 'GST @ Nill', '1', '0', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('6', 'GST @ Zero', '1', '0', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('7', 'VAT @ 5%', '1', '5', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('8', 'IGST @ 12%', '2', '12', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('9', 'IGST @ 18%', '2', '18', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('10', 'IGST @ 28%', '2', '28', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('11', 'IGST @ 5%', '2', '5', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('12', 'IGST @ Nill', '2', '0', 'Nill', '1');
INSERT INTO `tax_class` (`tax_id`, `tax_name`, `tax_type`, `tax_amount`, `tax_description`, `tax_status`) VALUES ('13', 'IGST @ Zero', '2', '0', 'Nill', '1');


#
# TABLE STRUCTURE FOR: tax_paymentdeatails
#

DROP TABLE IF EXISTS `tax_paymentdeatails`;

CREATE TABLE `tax_paymentdeatails` (
  `tax_payid` int(11) NOT NULL AUTO_INCREMENT,
  `saletax` double NOT NULL,
  `purchasetax` double NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `cgst_amount` double NOT NULL,
  `sgst_amount` double NOT NULL,
  `igst_amount` double NOT NULL,
  `tax_paydescription` text NOT NULL,
  `tax_paydate` date NOT NULL,
  `paystatus` int(11) NOT NULL,
  `tax_paystatus` int(11) NOT NULL,
  PRIMARY KEY (`tax_payid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: taxation_record
#

DROP TABLE IF EXISTS `taxation_record`;

CREATE TABLE `taxation_record` (
  `taxation_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id_fk` int(11) NOT NULL,
  `item_id_fk` int(11) NOT NULL,
  `purchase_id_fk` int(11) NOT NULL,
  `saleid_fk` int(11) NOT NULL,
  `taxation_name` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `five_percentage` double NOT NULL,
  `twelve_percentage` double NOT NULL,
  `eighteen_percentage` double NOT NULL,
  `twetyeight_percentage` double NOT NULL,
  `taxtype` varchar(50) NOT NULL,
  `tax_percentage` int(11) NOT NULL,
  `cgst_tax` varchar(50) NOT NULL,
  `sgst_tax` varchar(50) NOT NULL,
  `igst_tax` varchar(50) NOT NULL,
  `purchase_cgst_amount` double NOT NULL,
  `purchase_sgst_amount` double NOT NULL,
  `purchase_igst_amount` double NOT NULL,
  `sale_cgst_amount` double NOT NULL,
  `sale_sgst_amount` double NOT NULL,
  `sale_igst_amount` double NOT NULL,
  `date` date NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `gradtotal` double NOT NULL,
  `taxation_status` int(11) NOT NULL,
  PRIMARY KEY (`taxation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('1', '1', '1', '1', '0', 'PURCHASE', '2184', '0', '0', '393.12', '18', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '196.56', '196.56', '0', '0', '0', '0', '2017-12-12', '12', '2017', '0', '393.12', '2577.12', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('2', '1', '0', '2', '0', 'PURCHASE', '3420', '0', '0', '615.6', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '307.8', '307.8', '0', '0', '0', '0', '2017-12-12', '12', '2017', '0', '615.6', '17150.12', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('3', '1', '3', '3', '0', 'PURCHASE', '9170', '0', '0', '1650.6', '18', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '825.3', '825.3', '0', '0', '0', '0', '2017-12-12', '12', '2017', '0', '1650.6', '17433.32', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('4', '1', '0', '4', '0', 'PURCHASE', '2980', '0', '0', '536.4', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '268.2', '268.2', '0', '0', '0', '0', '2017-12-12', '12', '2017', '0', '536.4', '17150.12', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('5', '1', '0', '5', '0', 'PURCHASE', '3850', '0', '0', '693', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '346.5', '346.5', '0', '0', '0', '0', '2017-12-12', '12', '2017', '0', '693', '17150.12', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('6', '1', '1', '6', '0', 'PURCHASE', '1000', '0', '120', '0', '0', 'GST @ 12% (split tax)', '12', 'CGST @6.0 on purchases', 'SGST @6.0 on purchases', '', '60', '60', '0', '0', '0', '0', '2017-12-12', '12', '2017', '0', '120', '1120', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('7', '1', '1', '1', '0', 'PURCHASE', '2184', '0', '0', '393.12', '18', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '196.56', '196.56', '0', '0', '0', '0', '2017-12-12', '12', '2017', '0', '393.12', '2577.12', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('8', '1', '2', '2', '0', 'PURCHASE', '3420', '0', '0', '615.6', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '307.8', '307.8', '0', '0', '0', '0', '2017-12-12', '12', '2017', '0', '615.6', '14856.2', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('9', '1', '3', '3', '0', 'PURCHASE', '9170', '0', '0', '1650.6', '18', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '825.3', '825.3', '0', '0', '0', '0', '2017-12-12', '12', '2017', '0', '1650.6', '17433.32', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('10', '1', '2', '1', '0', 'PURCHASE', '1600', '0', '192', '0', '0', 'GST @ 12% (split tax)', '12', 'CGST @6.0 on purchases', 'SGST @6.0 on purchases', '', '96', '96', '0', '0', '0', '0', '2017-12-13', '12', '2017', '0', '192', '1792', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('11', '1', '27', '2', '0', 'PURCHASE', '500', '0', '0', '0', '140', 'GST @ 28% (split tax)', '28', 'CGST @14.0 on purchases', 'SGST @14.0 on purchases', '', '70', '70', '0', '0', '0', '0', '2017-12-13', '12', '2017', '0', '140', '640', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('12', '1', '1', '1', '0', 'PURCHASE', '2184', '0', '0', '393.12', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '196.56', '196.56', '0', '0', '0', '0', '2017-12-13', '12', '2017', '0', '393.12', '6612.72', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('13', '1', '2', '2', '0', 'PURCHASE', '3420', '0', '0', '615.6', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '307.8', '307.8', '0', '0', '0', '0', '2017-12-13', '12', '2017', '0', '615.6', '6612.72', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('14', '1', '4', '4', '0', 'PURCHASE', '4170', '0', '0', '750.6', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '375.3', '375.3', '0', '0', '0', '0', '2017-12-13', '12', '2017', '0', '750.6', '4920.6', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('15', '1', '5', '5', '0', 'PURCHASE', '6540', '0', '0', '1177.2', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '588.6', '588.6', '0', '0', '0', '0', '2017-12-13', '12', '2017', '0', '1177.2', '7717.2', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('16', '1', '1', '6', '0', 'PURCHASE', '2184', '0', '0', '393.12', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '196.56', '196.56', '0', '0', '0', '0', '2017-12-13', '12', '2017', '0', '393.12', '2577.12', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('17', '1', '2', '7', '0', 'PURCHASE', '3420', '0', '0', '615.6', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '307.8', '307.8', '0', '0', '0', '0', '2017-12-13', '12', '2017', '0', '615.6', '6612.72', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('18', '1', '1', '1', '0', 'PURCHASE', '3000', '0', '360', '0', '0', 'GST @ 12% (split tax)', '12', 'CGST @6.0 on purchases', 'SGST @6.0 on purchases', '', '180', '180', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '360', '3360', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('19', '1', '1', '1', '0', 'PURCHASE', '2184', '0', '262.08', '0', '0', 'GST @ 12% (split tax)', '12', 'CGST @6.0 on purchases', 'SGST @6.0 on purchases', '', '131.04', '131.04', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '262.08', '2446.08', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('20', '1', '1', '1', '0', 'PURCHASE', '2184', '0', '0', '393.12', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '196.56', '196.56', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '393.12', '2577.12', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('21', '1', '1', '1', '0', 'PURCHASE', '2184', '0', '0', '393.12', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '196.56', '196.56', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '393.12', '44502.52', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('22', '1', '2', '2', '0', 'PURCHASE', '3420', '0', '0', '615.6', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '307.8', '307.8', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '615.6', '44502.52', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('23', '1', '3', '3', '0', 'PURCHASE', '9170', '0', '0', '1650.6', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '825.3', '825.3', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '1650.6', '44502.52', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('24', '1', '4', '4', '0', 'PURCHASE', '4170', '0', '0', '750.6', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '375.3', '375.3', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '750.6', '44502.52', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('25', '1', '5', '5', '0', 'PURCHASE', '6540', '0', '0', '1177.2', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '588.6', '588.6', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '1177.2', '44502.52', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('26', '1', '6', '6', '0', 'PURCHASE', '2100', '0', '0', '378', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '189', '189', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '378', '44502.52', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('27', '1', '7', '7', '0', 'PURCHASE', '2980', '0', '0', '536.4', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '268.2', '268.2', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '536.4', '44502.52', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('28', '1', '8', '8', '0', 'PURCHASE', '3850', '0', '0', '693', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '346.5', '346.5', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '693', '44502.52', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('29', '1', '9', '9', '0', 'PURCHASE', '3300', '0', '0', '594', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '297', '297', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '594', '44502.52', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('30', '1', '10', '10', '0', 'PURCHASE', '660', '0', '0', '118.8', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '59.4', '59.4', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '118.8', '45281.32', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('31', '1', '1', '0', '1', 'SALE', '2174', '0', '0', '391.32', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on sales', 'SGST @9.0 on sales', '', '0', '0', '0', '195.66', '195.66', '0', '2017-12-14', '12', '2017', '391.32', '0', '2565.32', '0');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('32', '1', '1', '1', '0', 'PURCHASE', '300', '0', '36', '0', '0', 'GST @ 12% (split tax)', '12', 'CGST @6.0 on purchases', 'SGST @6.0 on purchases', '', '18', '18', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '36', '336', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('33', '1', '1', '0', '1', 'SALE', '28', '0', '0', '5.04', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on sales', 'SGST @9.0 on sales', '', '0', '0', '0', '2.52', '2.52', '0', '2017-12-14', '12', '2017', '5.04', '0', '33.04', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('34', '1', '1', '1', '0', 'PURCHASE', '2184', '0', '0', '393.12', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '196.56', '196.56', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '393.12', '2577.12', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('35', '1', '2', '2', '0', 'PURCHASE', '3420', '0', '0', '615.6', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on purchases', 'SGST @9.0 on purchases', '', '307.8', '307.8', '0', '0', '0', '0', '2017-12-14', '12', '2017', '0', '615.6', '6612.72', '1');
INSERT INTO `taxation_record` (`taxation_id`, `vendor_id_fk`, `item_id_fk`, `purchase_id_fk`, `saleid_fk`, `taxation_name`, `amount`, `five_percentage`, `twelve_percentage`, `eighteen_percentage`, `twetyeight_percentage`, `taxtype`, `tax_percentage`, `cgst_tax`, `sgst_tax`, `igst_tax`, `purchase_cgst_amount`, `purchase_sgst_amount`, `purchase_igst_amount`, `sale_cgst_amount`, `sale_sgst_amount`, `sale_igst_amount`, `date`, `month`, `year`, `debit`, `credit`, `gradtotal`, `taxation_status`) VALUES ('36', '1', '1', '0', '1', 'SALE', '2174', '0', '0', '391.32', '0', 'GST @ 18% (split tax)', '18', 'CGST @9.0 on sales', 'SGST @9.0 on sales', '', '0', '0', '0', '195.66', '195.66', '0', '2017-12-14', '12', '2017', '391.32', '0', '2565.32', '1');


#
# TABLE STRUCTURE FOR: vendor
#

DROP TABLE IF EXISTS `vendor`;

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(50) NOT NULL,
  `vendor_address` varchar(255) NOT NULL,
  `vender_mail` varchar(255) NOT NULL,
  `vendor_phone` varchar(20) NOT NULL,
  `vendor_tin` varchar(255) NOT NULL,
  `hsn_number` varchar(255) NOT NULL,
  `vendor_pin` varchar(255) NOT NULL,
  `vendor_status` int(11) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `vendor` (`vendor_id`, `vendor_name`, `vendor_address`, `vender_mail`, `vendor_phone`, `vendor_tin`, `hsn_number`, `vendor_pin`, `vendor_status`) VALUES ('1', 'R R Electronics - CCTV', '39/4012A, Divans Building, Karimpatta Road, Pallimukku, Kochi 682016', 'rrelectronicsam@gmail.com', '9387242061', '32AFBPR5400H1ZW', '', 'AFDPR 5400H', '1');


#
# TABLE STRUCTURE FOR: warehouse_details
#

DROP TABLE IF EXISTS `warehouse_details`;

CREATE TABLE `warehouse_details` (
  `warehouse_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_name` varchar(50) NOT NULL,
  `warehouse_place` varchar(50) NOT NULL,
  `warehouse_Desc` varchar(50) NOT NULL,
  `warehouse_status` int(11) NOT NULL,
  PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `warehouse_details` (`warehouse_id`, `warehouse_name`, `warehouse_place`, `warehouse_Desc`, `warehouse_status`) VALUES ('1', 'ANANTHAM ', 'PALLIMUKK', '', '1');


