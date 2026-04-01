-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 01. Apr 2026 um 14:00
-- Server-Version: 10.11.14-MariaDB-0ubuntu0.24.04.1
-- PHP-Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `php_mt241022_21756`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `forum_messages`
--

CREATE TABLE `forum_messages` (
  `messageID` int(11) NOT NULL,
  `threadID` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(200) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `forum_threads`
--

CREATE TABLE `forum_threads` (
  `threadID` int(10) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `forum_users`
--

CREATE TABLE `forum_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `forum_messages`
--
ALTER TABLE `forum_messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indizes für die Tabelle `forum_threads`
--
ALTER TABLE `forum_threads`
  ADD PRIMARY KEY (`threadID`);

--
-- Indizes für die Tabelle `forum_users`
--
ALTER TABLE `forum_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `forum_messages`
--
ALTER TABLE `forum_messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `forum_threads`
--
ALTER TABLE `forum_threads`
  MODIFY `threadID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `forum_users`
--
ALTER TABLE `forum_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
