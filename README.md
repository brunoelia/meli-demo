meli-demo
=========

CREATE TABLE `my_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(64) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `customer` varchar(256) DEFAULT NULL,
  `meli_order_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `meli_order_id_UNIQUE` (`meli_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;


test-code-review
