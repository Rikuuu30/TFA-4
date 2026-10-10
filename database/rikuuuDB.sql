-- Zen Supply POS database export for MariaDB/MySQL.
-- For an existing rikuuuDB installation, run `php spark migrate` instead of re-importing this file.
-- The administrator demo login is admin.rikuuu / ZSD123 (stored as a password hash).
-- Other sample staff accounts use the temporary local password: ZenSupplyDemo!2026.
-- Replace these sample credentials before publishing or using real staff accounts.
CREATE DATABASE IF NOT EXISTS `rikuuuDB`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `rikuuuDB`;

CREATE TABLE `customers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20),
  `created_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `full_name` VARCHAR(100) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `avatar` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `customers` (`full_name`, `email`, `phone`, `created_at`) VALUES
  ('Jian Pineda', 'jian.pineda@example.com', '+63 917 204 1186', '2025-01-12 10:15:00'),
  ('Tristan Jamito', 'tristan.jamito@example.com', '+63 995 481 3022', '2025-03-08 11:20:00'),
  ('Angelo Josh', 'angelo.josh@example.com', '+63 927 653 9401', '2025-06-21 14:05:00'),
  ('Amiel Acob', 'amiel.acob@example.com', '+63 916 875 2204', '2025-11-02 09:40:00'),
  ('Sean Kacey', 'sean.kacey@example.com', '+63 908 311 7654', '2025-02-14 16:30:00');

INSERT INTO `users` (`username`, `full_name`, `password_hash`, `created_at`) VALUES
  ('admin.rikuuu', 'Mara Villanueva', '$2y$10$5L/sGpd9CTJbsuwXbv48Fe/utSEmOmyQ1FFvMQjHUUnuvfzWEOraG', '2025-01-05 08:00:00'),
  ('cashier.ken', 'Kenneth Ramos', '$2y$10$qzItjA29rB7af5i/VdRaVuUuYUSMANFs2IIIKp50MVc0PYpeb99c2', '2025-03-11 09:00:00'),
  ('sales.ana', 'Ana Mendoza', '$2y$10$QgisEkeKbapf8OOou/jHsOsTwg1apVSFn0wC7zrlRQjBbkaiYdBem', '2025-06-03 09:00:00'),
  ('stock.jules', 'Julian Flores', '$2y$10$vidlDFrtAJJnvwfc8TiHJ.1jLkH60NYkx/ni.9u54CLoJGyfH8BqG', '2025-08-18 08:00:00'),
  ('manager.bea', 'Beatrice Sy', '$2y$10$p1oAuGlPCOAc7/dIMCjt7OxCecVIR24SwXRAUJZ5xX/dfMOc9JJv6', '2025-01-05 08:00:00'),
  ('sales.paolo', 'Paolo Navarro', '$2y$10$1dH2BMEt.ziKaDubyGCAdOigFtGX9iZWINVpkAiJnjVCVchs9Z1AW', '2026-02-09 10:00:00');
