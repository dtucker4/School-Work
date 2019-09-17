
INSERT INTO `brand` VALUES (15,'Larrys food','Kick-ass Coffee'),(16,'Larrys food','Foldgers Coffee'),(17,'Larrys food','Dempsters'),(18,'The other guys','Breadsters');
INSERT INTO `category` VALUES (1,'Bread'),(2,'Coffee');
INSERT INTO `checkoutaction` VALUES (0,203004,2),(0,322124,1),(0,502001,4),(0,3002001,1);
INSERT INTO `inventory` VALUES (3002001,1,20),(3002001,2,0),(322124,1,20),(322124,2,10),(203004,1,0),(203004,2,0),(502001,1,10),(502001,2,15);
INSERT INTO `items` VALUES ('Three Sisters','Kick-ass Coffee',9.13,13.99,'Coffee',1,'500g',3002001),('Classic Roast','Foldgers Coffee',8.7,11.99,'Coffee',1,'750g',322124),('whole grain bread','Dempsters',2.3,2.99,'Bread',1,'300g',203004),('white bread','Breadsters',1.99,2.59,'Bread',1,'600g',502001);
INSERT INTO `restock` VALUES (1,NULL,4,322124,1,NULL,1),(2,NULL,20,3002001,1,NULL,1),(3,NULL,15,502001,2,NULL,1),(4,NULL,5,322124,2,NULL,1),(5,NULL,10,502001,1,NULL,1);
INSERT INTO `store` VALUES (1,'Awesome Groceries','Thunder Bay','120 Awesome St.','8am-11pm'),(2,'The Best Groceries','England','219 W. Best St.','7am-11am');
INSERT INTO `vendor` VALUES (1,'Larrys food'),(2,'The other guys');
