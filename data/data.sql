CREATE DATABASE IF NOT EXISTS `adrowcreatives_db`;

USE `adrowcreatives_db`;

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Fullname` varchar(255) NOT NULL,
  `Username` varchar(100) NOT NULL UNIQUE,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL UNIQUE,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL UNIQUE,
  `Description` text DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Quantity` int(11) NOT NULL DEFAULT 0,
  `Barcode` varchar(255) DEFAULT NULL,
  `QR_Code` varchar(255) DEFAULT NULL,
  `Upload` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

