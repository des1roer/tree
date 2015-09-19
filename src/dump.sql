BEGIN TRANSACTION;
CREATE TABLE "page" (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`title`	TEXT NOT NULL UNIQUE,
	`link`	TEXT,
	`parent_id`	INTEGER NOT NULL,
	`f_order`	INTEGER NOT NULL,
	FOREIGN KEY(`parent_id`) REFERENCES id
);
INSERT INTO `page` VALUES (1,'root',NULL,0,1);
INSERT INTO `page` VALUES (2,'1 node','http://des1roer.blogspot.ru/',1,1);
INSERT INTO `page` VALUES (3,'2 child','http://des1roer.blogspot.com/2015/09/js.html',2,1);
COMMIT;
