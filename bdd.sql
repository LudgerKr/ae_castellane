-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 26, 2019 at 01:35 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `castellane`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `idarticle` int(11) NOT NULL,
  `title` char(255) NOT NULL,
  `comment` text NOT NULL,
  `categoryid` int(11) NOT NULL,
  `usersid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`idarticle`, `title`, `comment`, `categoryid`, `usersid`) VALUES
(1, 'Bonjour', 'Ceci est un test.', 1, 1),
(2, 'Bonjour', 'Ceci est un test.', 2, 1),
(3, 'Bonjour', 'Ceci est un test.', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `idcategory` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`idcategory`, `name`, `content`) VALUES
(1, 'test', 'ceci est un test ...'),
(2, 'test 1', 'ceci est un test 1 ...');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `idmeeting` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `hourbegin` time NOT NULL,
  `hourend` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `idquestion` int(11) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`idquestion`, `content`) VALUES
(1, 'Quel est votre meilleur ami(e)s ?'),
(2, 'Quel est votre marque de voiture favorite ?');

-- --------------------------------------------------------

--
-- Table structure for table `quizz`
--

CREATE TABLE `quizz` (
  `idquizz` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizz`
--

INSERT INTO `quizz` (`idquizz`, `question`, `answer`) VALUES
(1, 'Test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `register_seance`
--

CREATE TABLE `register_seance` (
  `userid` int(11) NOT NULL,
  `seanceid` int(11) NOT NULL,
  `nombreUsers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `register_seance`
--

INSERT INTO `register_seance` (`userid`, `seanceid`, `nombreUsers`) VALUES
(0, 117, 0),
(1, 116, 0),
(1, 116, 0),
(1, 117, 0),
(1, 119, 0),
(1, 121, 0),
(1, 116, 0),
(1, 115, 0),
(0, 116, 0),
(0, 116, 0),
(0, 115, 0),
(0, 124, 0),
(0, 117, 0),
(0, 3, 0),
(1, 3, 0),
(1, 12, 0),
(1, 1, 0),
(1, 1, 0),
(1, 12, 0),
(1, 3, 0),
(17, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `idresult` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `result_quizz`
--

CREATE TABLE `result_quizz` (
  `idrquizz` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `quizzid` int(11) NOT NULL,
  `reply` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seance`
--

CREATE TABLE `seance` (
  `idseance` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seance`
--

INSERT INTO `seance` (`idseance`, `date`, `time`) VALUES
(1, '2019-02-25', '10:30:00'),
(3, '2019-02-27', '10:30:00'),
(12, '2019-02-28', '10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `idshop` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `content` varchar(50) NOT NULL,
  `content2` varchar(50) NOT NULL,
  `content3` varchar(50) NOT NULL,
  `content4` varchar(50) NOT NULL,
  `content5` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`idshop`, `title`, `price`, `content`, `content2`, `content3`, `content4`, `content5`) VALUES
(1, 'Pack Permis Zen (code et conduite)', 711, 'Frais d\'inscription et gestion de dossier ', 'Evaluation initiale ', 'Formation au code de la route', '20 séances de conduite ', '5H de formation en ligne à la conduite '),
(2, 'Pack Conduite Supervisée', 882, 'Frais d\'inscription et gestion de dossier ', 'Evaluation initiale ', 'Formation au code de la route', '20 séances de conduite', '5H de formation en ligne à la conduite'),
(3, 'Pack Conduite Accompagnée', 981, 'Frais d\'inscription et gestion de dossier', 'Evaluation initiale', 'Accompagnement par un moniteur', 'Livre de code', 'Votre formation à la conduite en moins de 30 jours'),
(4, 'Pack Accéléré (code et conduite)', 981, 'Frais d\'inscription et gestion de dossier ', 'Evaluation initiale', 'Accompagnement par un moniteur', 'Formation au code de la route', 'Votre formation à la conduite en moins de 30 jours'),
(5, 'Pack Prémium (code + conduite)', 981, 'Frais d\'inscription et gestion de dossier', 'Suivi de votre formation par un coach', 'Livre de code ', '22 séances de conduite ', 'Une formule complète avec le suivi de votre format');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `right` enum('Utilisateur','Moniteur','Administrateur') NOT NULL,
  `ban` int(11) NOT NULL,
  `reply` varchar(250) NOT NULL,
  `idquestion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`iduser`, `lastname`, `firstname`, `age`, `phone`, `email`, `password`, `right`, `ban`, `reply`, `idquestion`) VALUES
(7, 'DRAPALA', 'MATHIEU', 20, 617490416, 'drapalamathieu95@gmail.com', '$2y$10$hbJgzPssDF2aMXPpANBYTeC6tfSkwfZn7iYSo915VuzTFosERTeIW', 'Administrateur', 0, 'Damien', 1),
(16, 'LA', 'Richard', 23, 620600543, 'richard.rdla@gmail.com', '$2y$10$IwmbN6N6hbGakRithyR1y.BTjT/2MnPugR.KsNRxT5Z27K0BPpgFi', 'Utilisateur', 0, 'Cindy', 1),
(17, 'TEST', 'test', 20, 617490417, 'test@test.fr', '$2y$10$.5jDpmUb9iqZQ69zpdU/VuqOX3RhETJWtR8AkmuqTctH4tMJ67ZVW', 'Utilisateur', 0, 'Damien', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `idvehicles` int(11) NOT NULL,
  `licenseplate` varchar(255) NOT NULL,
  `mileage` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `status` enum('Occupée','Réparation','Disponible') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`idarticle`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idcategory`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`idmeeting`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idquestion`);

--
-- Indexes for table `quizz`
--
ALTER TABLE `quizz`
  ADD PRIMARY KEY (`idquizz`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`idresult`);

--
-- Indexes for table `result_quizz`
--
ALTER TABLE `result_quizz`
  ADD PRIMARY KEY (`idrquizz`);

--
-- Indexes for table `seance`
--
ALTER TABLE `seance`
  ADD PRIMARY KEY (`idseance`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`idshop`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`idvehicles`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `idarticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `idcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `idmeeting` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `idquestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quizz`
--
ALTER TABLE `quizz`
  MODIFY `idquizz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `idresult` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `result_quizz`
--
ALTER TABLE `result_quizz`
  MODIFY `idrquizz` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seance`
--
ALTER TABLE `seance`
  MODIFY `idseance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `idshop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `idvehicles` int(11) NOT NULL AUTO_INCREMENT;
