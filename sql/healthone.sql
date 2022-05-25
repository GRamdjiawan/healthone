-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 25 mei 2022 om 00:44
-- Serverversie: 10.4.22-MariaDB
-- PHP-versie: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthone`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

CREATE TABLE `categorie` (
  `id` int(5) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `omschrijving` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `categorie`
--

INSERT INTO `categorie` (`id`, `naam`, `foto`, `omschrijving`) VALUES
(1, 'Roeitrainer', 'roeitrainer.jpg', 'Kort samengevat gebruik je dus bij élke roeibeweging je bilspieren, bovenbeenspieren, kuiten, hamstrings, schenen, rugspieren, schouderspieren, biceps, triceps en buikspieren. Dat zijn er nogal wat! Fitnessen op een roeitrainer is dus meer dan geschikt om'),
(2, 'Crosstrainer', 'crosstrainer.jpg', 'Op een crosstrainer werk je aan je hart- en longconditie en de bloedsomloop. Wanneer je doel van de training het verbeteren van je conditie is, kies je voor een lange training op een rustig tempo of kort op hoge intensiteit. Ook is het mogelijk om te trai'),
(3, 'Hometrainer', 'hometrainer.jpg', 'Het fietsen op een hometrainer verkleint namelijk de kans op hart-en-vaatziekten. Dit komt omdat je hart efficiënter te werk gaat. Dit houdt in dat je hart per slag meer bloed transporteert, maar wel minder slagen maakt.'),
(4, 'Loopband', 'loopband.jpg', 'Een training op een loopband betekent minder belasting voor het scheenbeen en dus minder opbouw van botmassa. Aan de andere kant is aangetoond dat lopers die veel op een loopband lopen, minder risico hebben op het ontwikkelen van stressfracturen aan het s');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `id` int(5) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `omschrijving` varchar(255) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `naam`, `foto`, `omschrijving`, `categorie_id`) VALUES
(1, 'Roei die trainer', 'roeitrainer.jpg', 'Dit is de roeitrainer der roeitrainers als hier niet op heb getraind.                                                                                                                                                                                          ', 1),
(2, 'crosstrainer TI MAX PRO 5e GEN ULTRA SUPER', 'crosstrainer.jpg', 'Een van de eerste crosstrainers in the game.', 2),
(3, 'HOMEnotaloneTrainer', 'hometrainer.jpg', 'Dit is de home trainer die je niet thuis gebruikt.', 3),
(4, 'ロプーバンド', 'loopband.jpg', 'De Japanse ロプーバンド (loopband) is een mooi model met de gekste functies. ', 4);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ibfk_1` (`categorie_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
