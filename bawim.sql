-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Sty 2022, 23:25
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bawim`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `advertisements`
--

CREATE TABLE `advertisements` (
  `aid` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `category` text NOT NULL,
  `path` text NOT NULL,
  `description` text NOT NULL,
  `status` text NOT NULL,
  `price` text NOT NULL,
  `postcode` text NOT NULL,
  `location` text NOT NULL,
  `phone_number` text NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `advertisements`
--

INSERT INTO `advertisements` (`aid`, `title`, `category`, `path`, `description`, `status`, `price`, `postcode`, `location`, `phone_number`, `uid`, `created`) VALUES
(10, 'koszulka Diego Maradona', 'Sport i Hobby', '/uploads/qk9Yr8t3Cqs8YW2rViEE.jpg', 'Sprzedam koszulkę z oryginalnym i odręcznym autografem DIEGO MARADONY i certyfikatem, z prywatnej kolekcji.', 'Używany', '650', '60-005', 'Poznań', '881536482', 12, '2021-10-07 10:52:31'),
(15, 'płyta Piosenki ludowe', 'Rozrywka', '/uploads/2h4Sl3c1Chx41a0qUr4h.jpg', '  Płyta Piosenki ludowe dozwolone od 0 do 100 lat.\r\nStan idealny.\r\nMożliwa wysyłka.', 'Nowy', '10', '30-569', 'Kraków', '123456789', 5, '2021-10-12 23:55:26'),
(17, 'sukienka letnia', 'Moda', '/uploads/S6DQdf1SkCl7ZQ7ayo1c.jpg', 'Mam na sprzedaż sukienkę widoczna na zdjęciach w rozmiarze M, kupiona w sklepie New Yorker, kilka razy założona, stan bardzo dobry. Możliwa wysyłka.', 'Używany', '25', '30-569', 'Kraków', '123456789', 5, '2021-10-27 10:57:48'),
(27, 'Mercedes-Benz W124', 'Motoryzacja', '/uploads/JVhdd80aMIBijk3AXs9O.jpg', ' Sprzedam w pięknym stanie Mercedes Benz 2.0.\r\nAuto użytkowane głównie do jazdy miejskiej.\r\nPiękny egzemplarz dla prawdziwych miłośników starej klasy Mercedesów.\r\nDodatkowo w wyposażeniu felgi 15 cali z oponami zimowymi, aktualnie założone felgi 16 cali z letnimi oponami.', 'Używany', '18500', '00-275', 'Warszawa', '741852963', 15, '2021-11-12 07:35:31'),
(35, 'Oppo A53 4/64 GB - czarny', 'Elektronika', '/uploads/CG85QxXF13VW1pdmaVAy.jpg', 'Oppo A53 4/64 GB w kolorze czarnym.\nTelefon nie był nigdy używany, zapakowany w oryginalne opakowanie, zafoliowany.', 'Nowy', '635', '00-275', 'Warszawa', '741852963', 15, '2021-11-20 13:38:40'),
(39, 'wózek Easywalker Harvey', 'Dla dzieci', '/uploads/HSAIXA7eYEPnoDEeKTvp.jpg', 'Sprzedam wózek 2w1 głęboko-spacerowy Easywalker Harvey 2 zakupiony w kwietniu 2020r.\r\nGondola i spacerówka w stanie bardzo dobrym z normalnymi śladami użytkowania.', 'Używany', '1830', '51-128', 'Wrocław', '502975384', 21, '2021-12-12 10:46:07'),
(40, 'grzechotki krówki', 'Dla dzieci', '/uploads/4Lcei0nPgFrxWFrWEqfZ.jpg', 'Grzechotki z lusterkiem do przymocowania zarówno do łóżeczka jak i wózka. Różne dźwięki wywołują zainteresowanie u wszystkich małych dzieci. ', 'Używany', '15', '51-128', 'Wrocław', '502975384', 21, '2021-12-29 14:06:39'),
(44, 'ciągnik Lamborghini', 'Rolnictwo', '/uploads/dgpLiXHT79kBeTPoIgeg.jpg', 'CIĄGNIK ROLNICZY LAMBORGHINI 1050 PREMUIM. Właściwości: rok produkcji 2003, silnik 4 cylindrowy o mocy 105 KM, ilość mth 7972, przedni TUZ, ogumienie przód 380/70 R28, ogumienie tył 480/70 R38.', 'Używany', '83500', '60-005', 'Poznań', '881536482', 12, '2022-01-06 14:44:46'),
(45, 'film PITBULL', 'Rozrywka', '/uploads/mbvQ2TBZhOBbG2Sio8Mn.jpg', 'Sprzedam film PITBULL Ostatni pies - reżyseria Władysław Pasikowski.', 'Używany', '12', '30-569', 'Kraków', '123456789', 5, '2022-01-08 17:18:07'),
(46, 'smartwatch Samsung Watch', 'Elektronika', '/uploads/vxDRsPI6avMDZMoRnJFm.jpg', 'Mam do sprzedania smartwatch Galaxy Watch 46 mm. Zegarek został kupiony 29.09.2021r. w RTV Euro AGD. Zegarek jest praktycznie nieużywany. Testowany tylko jeden cykl do rozładowania baterii. Do zegarka od razu dokupiłem i założyłem szkiełko ochronne. Poza tym jest cały oryginalny zestaw.', 'Nowy', '899', '00-275', 'Warszawa', '741852963', 15, '2022-01-11 14:35:38');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `uid` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`uid`, `name`, `surname`, `postcode`, `city`, `email`, `phone_number`, `password`) VALUES
(5, 'Dorota', 'Lis', '30-569', 'Kraków', 'dorota123@gmail.com', '123456789', '$1$salt$c/maBNDFfE7PDTmv3OAvs/'),
(12, 'Janusz', 'Biznesmen', '60-005', 'Poznań', 'sprzedawca@agh.pl', '881536482', '$1$salt$gA.5zcHulzQxm6aNC5oWS/'),
(15, 'Marian', 'Kowalski', '00-275', 'Warszawa', 'chytry.marian@wp.pl', '741852963', '$1$salt$gSfkFP/kRSbgk6GN2ZFAf1'),
(21, 'Barbara', 'Achmistrowicz-Wachmistrowicz', '51-128', 'Wrocław', 'basiawroclaw1982@poczta.pl', '502975384', '$1$salt$d2fgxADX8aSMbkxUj9p84/');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `uid` (`uid`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `aid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `uid` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
