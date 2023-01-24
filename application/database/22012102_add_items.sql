CREATE TABLE items ( 
    `id` SERIAL NOT NULL , 
    `item_code` VARCHAR(8) NOT NULL ,
    `category_id` int(20) NOT NULL,
    `name` VARCHAR(64) NOT NULL , 
    `buy_price` numeric(10, 0) NOT NULL ,
    `sell_price` numeric(10, 0) NOT NULL ,
    `stock` int(11) NOT NULL ,
    `unit` VARCHAR(32) NOT NULL ,
    `description` TEXT NULL,
    PRIMARY KEY (`id`));
