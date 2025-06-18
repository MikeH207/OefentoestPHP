-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 jun 2025 om 11:58
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filmclub`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `beoordeling`
--

CREATE TABLE `beoordeling` (
  `id` int(5) NOT NULL,
  `cijfer` int(2) NOT NULL,
  `opmerking` text NOT NULL,
  `film_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `beoordeling`
--

INSERT INTO `beoordeling` (`id`, `cijfer`, `opmerking`, `film_id`) VALUES
(1, 9, 'Geweldig visueel', 13),
(2, 8, 'Intrigerend verhaal ', 13),
(3, 7, 'Mooi voor jong en oud ', 14),
(4, 10, 'Filmklassieker ', 14);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `film`
--

CREATE TABLE `film` (
  `id` int(5) NOT NULL,
  `titel` varchar(100) NOT NULL,
  `genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `film`
--

INSERT INTO `film` (`id`, `titel`, `genre`) VALUES
(13, 'Inception', 'Sci-Fi'),
(14, 'The Lion King', 'Animatie'),
(15, 'The Godfather', 'Misdaad'),
(24, 'e', 'e');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `beoordeling`
--
ALTER TABLE `beoordeling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `film_id` (`film_id`);

--
-- Indexen voor tabel `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `beoordeling`
--
ALTER TABLE `beoordeling`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `film`
--
ALTER TABLE `film`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `beoordeling`
--
ALTER TABLE `beoordeling`
  ADD CONSTRAINT `beoordeling_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
