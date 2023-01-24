-- make users.username nullable but still unique
ALTER TABLE `users` MODIFY `username` VARCHAR(32) NULL;
-- add users.deleted_at
ALTER TABLE `users` ADD `deleted_at` TIMESTAMP NULL AFTER `role`;