-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Loomise aeg: Jaan 09, 2024 kell 11:21 EL
-- Serveri versioon: 10.4.27-MariaDB
-- PHP versioon: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Andmebaas: `tantsu`
--

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `kasutaja`
--

CREATE TABLE `kasutaja` (
  `id` int(11) NOT NULL,
  `kasutaja` varchar(100) DEFAULT NULL,
  `parool` varchar(100) DEFAULT NULL,
  `onAdmin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Andmete tõmmistamine tabelile `kasutaja`
--

INSERT INTO `kasutaja` (`id`, `kasutaja`, `parool`, `onAdmin`) VALUES
(1, 'admin', 'sucMlqxrx7qA2', 1),
(2, 'MakitoDrel', 'su/Skj9HirkGw', 0);

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `tantsud`
--

CREATE TABLE `tantsud` (
  `id` int(11) NOT NULL,
  `tantsupaar` varchar(38) DEFAULT NULL,
  `punktid` int(11) DEFAULT 0,
  `kommentaarid` text DEFAULT ' ',
  `ava_paev` datetime DEFAULT NULL,
  `avalik` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Andmete tõmmistamine tabelile `tantsud`
--

INSERT INTO `tantsud` (`id`, `tantsupaar`, `punktid`, `kommentaarid`, `ava_paev`, `avalik`) VALUES
(1, 'Mike+Anastassia', 100, 'Niiiicedddd\ndddd\ndddd\ndddd\nddddddddddddddddddddddddddddddddddddddddddddd\n', NULL, 1),
(2, 'Tanel padar + Nataly', 32, ' ', NULL, 1),
(3, 'Jüri Ratas + Järve', 26, ' ', NULL, 1),
(4, 'Killa + Deboshir Vasya', 4, ' lollöl\n', NULL, 1),
(13, 'bbb', 0, ' ', '2024-01-08 11:30:38', 0),
(17, 'fff', 0, ' ', '2024-01-09 11:08:33', 1);

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `kasutaja`
--
ALTER TABLE `kasutaja`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nimi` (`kasutaja`);

--
-- Indeksid tabelile `tantsud`
--
ALTER TABLE `tantsud`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tantsupaar` (`tantsupaar`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `kasutaja`
--
ALTER TABLE `kasutaja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT tabelile `tantsud`
--
ALTER TABLE `tantsud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
