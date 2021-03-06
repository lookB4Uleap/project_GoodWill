te_time"	TEXT
);
CREATE TABLE IF NOT EXISTS "menu" (
	"id"	INTEGER NOT NULL DEFAULT 100 PRIMARY KEY AUTOINCREMENT,
	"item_nm"	TEXT NOT NULL,
	"item_price"	NUMERIC NOT NULL,
	"discount"	NUMERIC DEFAULT 0,
	"image_url"	TEXT,
	"category"	TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS "map_order" (
	"order_id"	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	"uid"	INTEGER NOT NULL
);
CREATE TABLE IF NOT EXISTS "reservations" (
	"id"	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	"datetime"	TEXT NOT NULL,
	"table"	INTEGER,
	"uid"	INTEGER
);
INSERT INTO "users" ("uid","user_nm","user_email","user_phno","login_id","pass","addr") VALUES (9000,'Admin','admin@admin.co',1236548792,'admin','password','Address of admin1'),
 (9001,'Admin2','admin2@admin.co',1234568790,'admin2','admin2','Address of admin2');
INSERT INTO "orders" ("order_id","uid","item_id","item_nm","item_price","item_quant","order_date_time") VALUES (910000,9000,10000,'Mutton Biriyani',90,1,NULL),
 (910002,9000,10001,'Chicken Korma',50,1,'2021-12-15 19:15:08');
INSERT INTO "menu" ("id","item_nm","item_price","discount","image_url","category") VALUES (10000,'Mutton Biriyani',90,0,NULL,'Biriyani'),
 (10001,'Chicken Korma',50,0,NULL,'Curry');
INSERT INTO "map_order" ("order_id","uid") VALUES (910000,9000);
INSERT INTO "reservations" ("id","datetime","table","uid") VALUES (8000,'2016-01-03 08:50:18',NULL,9000);
COMMIT;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                