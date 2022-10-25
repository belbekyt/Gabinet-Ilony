-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Gru 2021, 13:39
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `gabinet`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accounttype`
--

CREATE TABLE `accounttype` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `accounttype`
--

INSERT INTO `accounttype` (`id`, `name`) VALUES
(1, 'ADMINISTRATOR'),
(2, 'RECEPCJA'),
(3, 'LEKARZ'),
(4, 'PACJENT');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `content` varchar(1500) NOT NULL,
  `author` int(11) DEFAULT NULL,
  `dateAdded` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `author`, `dateAdded`) VALUES
(1, 'test', 'test11', 1, '2021-09-26');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `specialisation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `doctors`
--

INSERT INTO `doctors` (`id`, `user`, `specialisation`) VALUES
(3, 5, 1),
(4, 5, 2),
(5, 5, 3);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `mainpagearticles`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `mainpagearticles` (
`title` varchar(300)
,`content` varchar(1500)
,`author` int(11)
,`dateAdded` varchar(10)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `specialisation`
--

CREATE TABLE `specialisation` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `specialisation`
--

INSERT INTO `specialisation` (`id`, `name`) VALUES
(1, 'CHIRURGIA STOMATOLOGICZNA'),
(2, 'CHIRURGIA SZCZĘKOWO-TWARZOWA'),
(3, 'OTODOCJA'),
(4, 'PERIODONTOLOGIA'),
(5, 'PROSTETYKA STOMATOLOGICZNA'),
(6, 'STOMATOLOGIA DZIECIĘCA'),
(7, 'STOMATOLOGIA ZACHOWAWCZA Z ENDODONCJĄ'),
(8, 'ZDROWIE PUBLICZNE'),
(9, 'EPIDEMIOLOGIA');

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `specials`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `specials` (
`id` int(11)
,`name` varchar(150)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `login` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `tel` varchar(9) NOT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `login`, `email`, `pass`, `tel`, `type`) VALUES
(2, 'Mateusz ', 'Targoński', 'test1', 'mateoi@gmail.com', '$2y$10$IsyuIboybPhOsiO9Ok9JQOXfFqxvfuaF.ngKq4BEe7kLI.pFDsSiu', '222222222', 4),
(3, 'aaa', 'bbb', 'test22', '123@q.l', '$2y$10$dLEAUY/b9q3tfSjThJLHLu2rRkIKVFF3TYkz2sIuGGdqTkdAz2AYi', '123123222', 4),
(4, 'aaa', 'bbb', 'test222', '123@q.la', '$2y$10$MXkQGJ2xNCYuDS1IyOLqseNl0BtCV7ulS4cXpnZLti5M/ntccJRo2', '123133222', 4),
(5, 'TestoweImie', 'TestoweNazwisko', 'TestowyLogin', 'TestowyEmail@mail.com', '$2y$10$xRpzchiezRqBA5MUjgho3OoPjoqrIkagLxAuHylFUp1SV2SNrqkLe', '123123123', 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `visit`
--

CREATE TABLE `visit` (
  `id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `visitDate` date NOT NULL DEFAULT current_timestamp(),
  `visitTime` time NOT NULL DEFAULT current_timestamp(),
  `nfz` tinyint(1) NOT NULL DEFAULT 0,
  `accepted` tinyint(1) NOT NULL DEFAULT 0,
  `cost` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `visit`
--

INSERT INTO `visit` (`id`, `doctor`, `patient`, `visitDate`, `visitTime`, `nfz`, `accepted`, `cost`) VALUES
(1, 5, 5, '2021-12-15', '09:00:00', 0, 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `visitrequests`
--

CREATE TABLE `visitrequests` (
  `id` int(11) NOT NULL,
  `dateProposalFrom` date NOT NULL DEFAULT current_timestamp(),
  `dateProposalTo` date NOT NULL DEFAULT (current_timestamp() + 14 * 24 * 60 * 60),
  `timeProposalFrom` time NOT NULL DEFAULT '10:00:00',
  `timeProposalTo` time NOT NULL DEFAULT '19:00:00',
  `special` int(11) NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  `nfz` tinyint(1) DEFAULT 0,
  `fullname` varchar(300) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `visitrequests`
--

INSERT INTO `visitrequests` (`id`, `dateProposalFrom`, `dateProposalTo`, `timeProposalFrom`, `timeProposalTo`, `special`, `note`, `nfz`, `fullname`, `user`) VALUES
(26, '2021-12-15', '2021-12-25', '09:00:00', '14:00:00', 1, '', 0, 'TestoweImie TestoweNazwisko', 5);

-- --------------------------------------------------------

--
-- Struktura widoku `mainpagearticles`
--
DROP TABLE IF EXISTS `mainpagearticles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mainpagearticles`  AS SELECT `articles`.`title` AS `title`, `articles`.`content` AS `content`, `articles`.`author` AS `author`, date_format(`articles`.`dateAdded`,'%d.%m.%Y') AS `dateAdded` FROM `articles` ORDER BY `articles`.`id` DESC LIMIT 0, 2 ;

-- --------------------------------------------------------

--
-- Struktura widoku `specials`
--
DROP TABLE IF EXISTS `specials`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `specials`  AS SELECT `specialisation`.`id` AS `id`, `specialisation`.`name` AS `name` FROM `specialisation` ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accounttype`
--
ALTER TABLE `accounttype`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indeksy dla tabeli `specialisation`
--
ALTER TABLE `specialisation`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_type` (`type`);

--
-- Indeksy dla tabeli `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doc` (`doctor`),
  ADD KEY `fk_pat` (`patient`);

--
-- Indeksy dla tabeli `visitrequests`
--
ALTER TABLE `visitrequests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `special` (`special`),
  ADD KEY `user` (`user`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `accounttype`
--
ALTER TABLE `accounttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `specialisation`
--
ALTER TABLE `specialisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `visit`
--
ALTER TABLE `visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `visitrequests`
--
ALTER TABLE `visitrequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`type`) REFERENCES `accounttype` (`id`);

--
-- Ograniczenia dla tabeli `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `fk_doc` FOREIGN KEY (`doctor`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_pat` FOREIGN KEY (`patient`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `visitrequests`
--
ALTER TABLE `visitrequests`
  ADD CONSTRAINT `visitrequests_ibfk_1` FOREIGN KEY (`special`) REFERENCES `specialisation` (`id`),
  ADD CONSTRAINT `visitrequests_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
