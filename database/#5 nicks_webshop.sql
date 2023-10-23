-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 okt 2023 om 21:55
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nicks_webshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_picture_location` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `product_picture_location`) VALUES
(1, 'Schoenen', 'Sportschoenen van een bekend merk.', 69.99, '\\educom-webshop-database-1697464368\\Images\\Sportschoenen.png'),
(2, 'Strandstoel', 'Een stoel voor op het strand.', 30.00, '\\educom-webshop-database-1697464368\\Images\\strandstoel.png'),
(3, 'Kat', 'Een nieuwsgierige kitten.', 129.50, '\\educom-webshop-database-1697464368\\Images\\kat.png'),
(4, 'Boot', 'Deze boot gaat zo hard als u kan roeien.', 300.00, '\\educom-webshop-database-1697464368\\Images\\boot.png'),
(5, 'Auto', 'Deze auto werd heel lang geleden gebruikt waardoor de motor stuk is.', 2500.00, '\\educom-webshop-database-1697464368\\Images\\auto.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email_address` varchar(80) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `email_address`, `password`) VALUES
(1, 'Nick Koole', 'nickkoole@hotmail.com', 'nick'),
(2, 'N', 'n@n.n', 'n'),
(3, 'q', 'q@q.q', 'q'),
(4, 'e', 'e@e.e', 'e'),
(5, 'r', 'r@r.r', 'r'),
(6, 't', 't@t.t', 't'),
(7, 'p', 'p@p.p', 'p'),
(8, 'k', 'k@k.k', 'k'),
(9, 'm', 'm@m.m', 'm'),
(10, 'ww', 'ww@w.w', 'w'),
(11, 'gg', 'gg@gg.gg', 'g'),
(12, 'ww', 'ww@ww.ww', 'w');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
