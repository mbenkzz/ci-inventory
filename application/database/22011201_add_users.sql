CREATE TABLE users ( 
    `id` SERIAL NOT NULL , 
    `username` VARCHAR(32) NOT NULL , 
    `password` VARCHAR(32) NOT NULL , 
    PRIMARY KEY (`id`), 
    UNIQUE (`username`));

ALTER TABLE `users` ADD `fullname` TEXT NULL AFTER `password`;

INSERT INTO `users` (`id`, `username`, `password`, `fullname`) VALUES (NULL, 'admin', MD5('admin'), 'Administrator');