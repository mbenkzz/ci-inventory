ALTER TABLE transaction 
ADD COLUMN `paid` numeric(10,0) not null after `total`,
ADD COLUMN `change` numeric(10,0) not null after `paid`;

UPDATE `transaction` SET `paid`= total, `change`= 0;

ALTER TABLE `transaction` CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
