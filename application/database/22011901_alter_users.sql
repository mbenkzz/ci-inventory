ALTER TABLE users ADD COLUMN `role` VARCHAR(32) NOT NULL DEFAULT 'user' AFTER `fullname`;

UPDATE users SET role = 'admin' WHERE username = 'admin';
