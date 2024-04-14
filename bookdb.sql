-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 07. dub 2024, 13:54
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `bookdb`
--
CREATE DATABASE IF NOT EXISTS `bookdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci;
USE `bookdb`;

-- --------------------------------------------------------

--
-- Struktura tabulky `bookinfo`
--

DROP TABLE IF EXISTS `bookinfo`;
CREATE TABLE `bookinfo` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- VZTAHY TABULKY `bookinfo`:
--   `book_id`
--       `knihy` -> `id`
--

--
-- Vyprázdnit tabulku před vkládáním `bookinfo`
--

TRUNCATE TABLE `bookinfo`;
--
-- Vypisuji data pro tabulku `bookinfo`
--

INSERT DELAYED IGNORE INTO `bookinfo` (`id`, `book_id`, `info`) VALUES
(1, 1, 'Test'),
(2, 1, 'Test'),
(3, 5, ''),
(4, 4, ''),
(5, 4, ''),
(6, 6, '');

-- --------------------------------------------------------

--
-- Struktura tabulky `knihy`
--

DROP TABLE IF EXISTS `knihy`;
CREATE TABLE `knihy` (
  `id` int(11) NOT NULL,
  `cena` decimal(10,2) DEFAULT NULL,
  `jmeno` varchar(255) DEFAULT NULL,
  `zanr_id` int(11) DEFAULT NULL,
  `pocet_stran` int(11) DEFAULT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `dostupnost` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- VZTAHY TABULKY `knihy`:
--   `zanr_id`
--       `zanry` -> `id`
--

--
-- Vyprázdnit tabulku před vkládáním `knihy`
--

TRUNCATE TABLE `knihy`;
--
-- Vypisuji data pro tabulku `knihy`
--

INSERT DELAYED IGNORE INTO `knihy` (`id`, `cena`, `jmeno`, `zanr_id`, `pocet_stran`, `autor`, `dostupnost`) VALUES
(1, 350.00, 'Pán Gondolinu', 4, 320, 'J.R.R. Tolkien', 'Dostupná'),
(2, 300.00, 'Harry Potter a Kámen mudrců', 4, 320, 'J.K. Rowlingová', 'Vyprodáno'),
(3, 250.00, 'Vražda v Orient expresu', 2, 256, 'Agatha Christie', 'Dostupná'),
(4, 280.00, '1984', 3, 328, 'George Orwell', 'Dostupná'),
(5, 320.00, 'Pán krajin', 5, 512, 'Stephen King', 'Dostupná'),
(6, 270.00, 'Nevyřízené účty', 6, 400, 'Lee Child', 'Na objednání'),
(7, 230.00, 'Stín trpaslíka', 19, 368, 'Terry Pratchett', 'Vyprodáno');

-- --------------------------------------------------------

--
-- Struktura tabulky `oblibene_zanry`
--

DROP TABLE IF EXISTS `oblibene_zanry`;
CREATE TABLE `oblibene_zanry` (
  `id` int(11) NOT NULL,
  `id_uzivatele` int(11) DEFAULT NULL,
  `id_zanru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- VZTAHY TABULKY `oblibene_zanry`:
--   `id_uzivatele`
--       `uzivatele` -> `id`
--   `id_zanru`
--       `zanry` -> `id`
--

--
-- Vyprázdnit tabulku před vkládáním `oblibene_zanry`
--

TRUNCATE TABLE `oblibene_zanry`;
-- --------------------------------------------------------

--
-- Struktura tabulky `rezervace`
--

DROP TABLE IF EXISTS `rezervace`;
CREATE TABLE `rezervace` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `nazev_knihy` varchar(255) NOT NULL,
  `datum_cas` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- VZTAHY TABULKY `rezervace`:
--   `book_id`
--       `knihy` -> `id`
--

--
-- Vyprázdnit tabulku před vkládáním `rezervace`
--

TRUNCATE TABLE `rezervace`;
--
-- Vypisuji data pro tabulku `rezervace`
--

INSERT DELAYED IGNORE INTO `rezervace` (`id`, `book_id`, `nazev_knihy`, `datum_cas`) VALUES
(1, 1, 'Pán Gondolinu', '2024-04-08 13:30:00');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

DROP TABLE IF EXISTS `uzivatele`;
CREATE TABLE `uzivatele` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(255) DEFAULT NULL,
  `prijmeni` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `heslo` varchar(255) DEFAULT NULL,
  `datum_nar` date DEFAULT NULL,
  `role` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- VZTAHY TABULKY `uzivatele`:
--

--
-- Vyprázdnit tabulku před vkládáním `uzivatele`
--

TRUNCATE TABLE `uzivatele`;
--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT DELAYED IGNORE INTO `uzivatele` (`id`, `jmeno`, `prijmeni`, `mail`, `heslo`, `datum_nar`, `role`) VALUES
(2, 'Kokes', 'Vyskocil', 'vyskocil@kombajn.cz', '$2y$10$t/RUoeRC0AMe.vOX4VnNtenQ66CIw4ONNo1dKBjF8TSj3iWdrjXXe', '2002-09-09', '0'),
(3, 'Jakub', 'Mrázek', 'mrazek04@seznam.cz', '$2y$10$lrfHe7A7hpgT35ZT328GXe.yoW04cpCKEhAWwtvgQ4jGXRRX9HClK', '2004-09-10', '1'),
(4, 'Petr', 'Novák', 'petr@example.com', 'asdf', '1985-05-15', '0'),
(5, 'Jan', 'Svoboda', 'jan@example.com', 'asdf', '1982-08-22', '0'),
(6, 'Marie', 'Novotná', 'marie@example.com', 'asdf', '1987-11-03', '0'),
(7, 'Kateřina', 'Dvořáková', 'katerina@example.com', 'asdf', '1984-04-10', '0'),
(8, 'Jiří', 'Černý', 'jiri@example.com', 'asdf', '1988-09-28', '0'),
(9, 'Lucie', 'Procházková', 'lucie@example.com', 'asdf', '1981-12-19', '0'),
(10, 'Martin', 'Kučera', 'martin@example.com', 'asdf', '1990-07-07', '0'),
(11, 'Veronika', 'Veselá', 'veronika@example.com', 'asdf', '1983-02-14', '0'),
(12, 'Michal', 'Horák', 'michal@example.com', 'asdf', '1986-06-25', '0'),
(13, 'Tereza', 'Němcová', 'tereza@example.com', 'asdf', '1989-03-31', '0'),
(14, 'Jakub', 'Novák', 'jakub@example.com', 'asdf', '1992-10-12', '0'),
(15, 'Eva', 'Svobodová', 'eva@example.com', 'asdf', '1995-01-07', '0'),
(16, 'Tomáš', 'Novotný', 'tomas@example.com', 'asdf', '1993-04-18', '0'),
(17, 'Anna', 'Dvořáková', 'anna@example.com', 'asdf', '1980-08-29', '0'),
(18, 'Jana', 'Černá', 'jana@example.com', 'asdf', '1987-11-23', '0'),
(19, 'Pavel', 'Procházka', 'pavel@example.com', 'asdf', '1984-06-09', '0'),
(20, 'Karolína', 'Kučerová', 'karolina@example.com', 'asdf', '1982-09-17', '0'),
(21, 'Adam', 'Veselý', 'adam@example.com', 'asdf', '1989-02-28', '0'),
(24, 'Pepa', 'Kebab', 'kebabjeham@seznam.cz', '$2y$10$3Tukry1280q/NJAFWOctQ.uCZWPjGTCF0A1n/uaU3WZVvGDaoU6bG', '2004-09-10', '0');

-- --------------------------------------------------------

--
-- Struktura tabulky `zanry`
--

DROP TABLE IF EXISTS `zanry`;
CREATE TABLE `zanry` (
  `id` int(11) NOT NULL,
  `nazev` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- VZTAHY TABULKY `zanry`:
--

--
-- Vyprázdnit tabulku před vkládáním `zanry`
--

TRUNCATE TABLE `zanry`;
--
-- Vypisuji data pro tabulku `zanry`
--

INSERT DELAYED IGNORE INTO `zanry` (`id`, `nazev`) VALUES
(1, 'Romantika'),
(2, 'Detektivka'),
(3, 'Sci-Fi'),
(4, 'Fantasy'),
(5, 'Horor'),
(6, 'Thriller'),
(7, 'Drama'),
(8, 'Komiksy'),
(9, 'Poezie'),
(10, 'Historický'),
(11, 'Biografie'),
(12, 'Krimi'),
(13, 'Akční'),
(14, 'Mystery'),
(15, 'Podivuhodný'),
(16, 'Psychologický'),
(17, 'Dobrodružný'),
(18, 'Román'),
(19, 'Humor'),
(20, 'Přírodovědný'),
(21, 'Válečný'),
(22, 'Náboženský'),
(23, 'Sportovní');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `bookinfo`
--
ALTER TABLE `bookinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexy pro tabulku `knihy`
--
ALTER TABLE `knihy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zanr_id` (`zanr_id`);

--
-- Indexy pro tabulku `oblibene_zanry`
--
ALTER TABLE `oblibene_zanry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzivatele` (`id_uzivatele`),
  ADD KEY `id_zanru` (`id_zanru`);

--
-- Indexy pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `zanry`
--
ALTER TABLE `zanry`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `bookinfo`
--
ALTER TABLE `bookinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `knihy`
--
ALTER TABLE `knihy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `oblibene_zanry`
--
ALTER TABLE `oblibene_zanry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pro tabulku `zanry`
--
ALTER TABLE `zanry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `bookinfo`
--
ALTER TABLE `bookinfo`
  ADD CONSTRAINT `bookinfo_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `knihy` (`id`);

--
-- Omezení pro tabulku `knihy`
--
ALTER TABLE `knihy`
  ADD CONSTRAINT `knihy_ibfk_1` FOREIGN KEY (`zanr_id`) REFERENCES `zanry` (`id`);

--
-- Omezení pro tabulku `oblibene_zanry`
--
ALTER TABLE `oblibene_zanry`
  ADD CONSTRAINT `oblibene_zanry_ibfk_1` FOREIGN KEY (`id_uzivatele`) REFERENCES `uzivatele` (`id`),
  ADD CONSTRAINT `oblibene_zanry_ibfk_2` FOREIGN KEY (`id_zanru`) REFERENCES `zanry` (`id`);

--
-- Omezení pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  ADD CONSTRAINT `rezervace_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `knihy` (`id`);


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata tabulky bookinfo
--

--
-- Vyprázdnit tabulku před vkládáním `pma__column_info`
--

TRUNCATE TABLE `pma__column_info`;
--
-- Vyprázdnit tabulku před vkládáním `pma__table_uiprefs`
--

TRUNCATE TABLE `pma__table_uiprefs`;
--
-- Vyprázdnit tabulku před vkládáním `pma__tracking`
--

TRUNCATE TABLE `pma__tracking`;
--
-- Metadata tabulky knihy
--

--
-- Vyprázdnit tabulku před vkládáním `pma__column_info`
--

TRUNCATE TABLE `pma__column_info`;
--
-- Vyprázdnit tabulku před vkládáním `pma__table_uiprefs`
--

TRUNCATE TABLE `pma__table_uiprefs`;
--
-- Vyprázdnit tabulku před vkládáním `pma__tracking`
--

TRUNCATE TABLE `pma__tracking`;
--
-- Metadata tabulky oblibene_zanry
--

--
-- Vyprázdnit tabulku před vkládáním `pma__column_info`
--

TRUNCATE TABLE `pma__column_info`;
--
-- Vyprázdnit tabulku před vkládáním `pma__table_uiprefs`
--

TRUNCATE TABLE `pma__table_uiprefs`;
--
-- Vyprázdnit tabulku před vkládáním `pma__tracking`
--

TRUNCATE TABLE `pma__tracking`;
--
-- Metadata tabulky rezervace
--

--
-- Vyprázdnit tabulku před vkládáním `pma__column_info`
--

TRUNCATE TABLE `pma__column_info`;
--
-- Vyprázdnit tabulku před vkládáním `pma__table_uiprefs`
--

TRUNCATE TABLE `pma__table_uiprefs`;
--
-- Vyprázdnit tabulku před vkládáním `pma__tracking`
--

TRUNCATE TABLE `pma__tracking`;
--
-- Metadata tabulky uzivatele
--

--
-- Vyprázdnit tabulku před vkládáním `pma__column_info`
--

TRUNCATE TABLE `pma__column_info`;
--
-- Vyprázdnit tabulku před vkládáním `pma__table_uiprefs`
--

TRUNCATE TABLE `pma__table_uiprefs`;
--
-- Vypisuji data pro tabulku `pma__table_uiprefs`
--

INSERT DELAYED IGNORE INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'bookdb', 'uzivatele', '[]', '2024-04-02 17:08:27');

--
-- Vyprázdnit tabulku před vkládáním `pma__tracking`
--

TRUNCATE TABLE `pma__tracking`;
--
-- Metadata tabulky zanry
--

--
-- Vyprázdnit tabulku před vkládáním `pma__column_info`
--

TRUNCATE TABLE `pma__column_info`;
--
-- Vyprázdnit tabulku před vkládáním `pma__table_uiprefs`
--

TRUNCATE TABLE `pma__table_uiprefs`;
--
-- Vypisuji data pro tabulku `pma__table_uiprefs`
--

INSERT DELAYED IGNORE INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'bookdb', 'zanry', '{\"CREATE_TIME\":\"2024-03-24 18:09:06\",\"col_order\":[1,0],\"col_visib\":[1,1]}', '2024-04-03 18:54:45');

--
-- Vyprázdnit tabulku před vkládáním `pma__tracking`
--

TRUNCATE TABLE `pma__tracking`;
--
-- Metadata databáze bookdb
--

--
-- Vyprázdnit tabulku před vkládáním `pma__bookmark`
--

TRUNCATE TABLE `pma__bookmark`;
--
-- Vyprázdnit tabulku před vkládáním `pma__relation`
--

TRUNCATE TABLE `pma__relation`;
--
-- Vyprázdnit tabulku před vkládáním `pma__savedsearches`
--

TRUNCATE TABLE `pma__savedsearches`;
--
-- Vyprázdnit tabulku před vkládáním `pma__central_columns`
--

TRUNCATE TABLE `pma__central_columns`;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
