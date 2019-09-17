
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id_brand` int(11) NOT NULL AUTO_INCREMENT,
  `vendor` varchar(128) NOT NULL,
  `brand_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_brand`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` char(128) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `checkoutaction`;
CREATE TABLE `checkoutaction` (
  `checkout_id` int(11) NOT NULL,
  `UPC` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`checkout_id`,`UPC`),
  KEY `items_id` (`UPC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `DateCreated` date DEFAULT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `UPC` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  KEY `store_id_idx` (`store_id`),
  KEY `items_id` (`UPC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `description` varchar(128) DEFAULT NULL,
  `brand_id` varchar(128) DEFAULT NULL,
  `vendor_cost` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `taxable` tinyint(4) DEFAULT NULL,
  `size` varchar(32) DEFAULT NULL,
  `UPC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `restock`;
CREATE TABLE `restock` (
  `restock_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `UPC` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `fulfilled` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`restock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `store`;
CREATE TABLE `store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(128) NOT NULL,
  `city` varchar(128) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `hours` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL DEFAULT '0',
  `vendor_name` varchar(128) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE `checkout` (
  `checkout_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cust_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`checkout_id`),
  KEY `cust_id` (`cust_id`),
  CONSTRAINT `cust_id` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;


