DROP DATABASE ticket;

SET character_set_client = utf8;
SET character_set_connection = utf8;
SET character_set_results = utf8;
SET character_set_server = utf8;
 
CREATE DATABASE ticket;
USE ticket;
CREATE TABLE price (
	id				INT(4),
	name		    CHAR(32),
    price_child     INT(4),
    price_adult     INT(4),
	etc		        CHAR(32)
);

INSERT INTO price (id, name, price_child, price_adult, etc)
VALUES
(1, '입장권', 	 7000,  10000, '입장'),
(2, 'BIG3', 		12000, 16000, '입장+놀이3종'),
(3, '자유이용권',  21000, 26000, '입장+놀이자유'),
(4, '연간이용권',  70000, 90000, '입장+놀이자유');

SELECT * FROM price;