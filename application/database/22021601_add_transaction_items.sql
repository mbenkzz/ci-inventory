CREATE TABLE detail_transaction (
    `id` SERIAL NOT NULL,
    `trans_id` BIGINT(20) NOT NULL,
    `item_code` VARCHAR(16) NOT NULL,
    `item_name` VARCHAR(64) NOT NULL,
    `amount` INT(11) NOT NULL,
    `buy_price` numeric(10,0) NOT NULL,
    `sell_price` numeric(10,0) NOT NULL,
    PRIMARY KEY (id)
);
