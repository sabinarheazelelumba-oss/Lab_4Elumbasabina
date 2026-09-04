-- LavaLust Laboratory Exercise 4 database export
-- Import this file in phpMyAdmin, MySQL Workbench, or the mysql CLI.

CREATE DATABASE IF NOT EXISTS `mydb`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `mydb`;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(100) NOT NULL,
  `lastname` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`firstname`, `lastname`, `email`, `username`) VALUES
  ('Juan', 'Dela Cruz', 'juan@example.com', 'juandelacruz'),
  ('Maria', 'Santos', 'maria@example.com', 'mariasantos'),
  ('Pedro', 'Garcia', 'pedro@example.com', 'pedrogarcia'),
  ('Ana', 'Reyes', 'ana@example.com', 'anareyes'),
  ('Jose', 'Mendoza', 'jose@example.com', 'josemendoza');

SELECT * FROM `users` ORDER BY `id`;
