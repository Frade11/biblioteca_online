-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 18 2025 г., 20:48
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `biblioteca`
--

-- --------------------------------------------------------

--
-- Структура таблицы `carti_biblioteca`
--

CREATE TABLE `carti_biblioteca` (
  `id` int(11) NOT NULL,
  `titlu_carte` varchar(255) NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `gen_literar` varchar(100) DEFAULT NULL,
  `an_publicare` int(11) DEFAULT NULL,
  `nr_pagini` int(11) DEFAULT NULL,
  `descriere` text DEFAULT NULL,
  `stare_disponibilitate` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `carti_biblioteca`
--

INSERT INTO `carti_biblioteca` (`id`, `titlu_carte`, `autor`, `gen_literar`, `an_publicare`, `nr_pagini`, `descriere`, `stare_disponibilitate`) VALUES
(1, 'Harry Potter', 'J.K. Rowling', 'Fictiune', 1997, 320, 'Istoria unui baiat in academia magica', 1),
(2, 'Cel mai iubit dintre pământeni', 'Marin Preda', 'Roman', 1980, 672, 'Roman despre destinul intelectualului în regimul comunist', 0),
(3, 'Ultima noapte de dragoste, întâia noapte de război', 'Camil Petrescu', 'Roman', 1930, 296, 'Roman de analiză psihologică în perioada Primului Război Mondial', 1),
(4, 'Pădurea spânzuraților', 'Liviu Rebreanu', 'Roman', 1922, 420, 'Dramă psihologică a unui soldat în timpul războiului', 1),
(5, 'Maitreyi', 'Mircea Eliade', 'Roman', 1933, 320, 'Poveste de dragoste între un inginer european și o tânără indiană', 1),
(6, 'Romanul adolescentului miop', 'Mircea Eliade', 'Roman', 1989, 280, 'Jurnalul intim al autorului în perioada adolescenței', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `utilizatori_biblioteca`
--

CREATE TABLE `utilizatori_biblioteca` (
  `id` int(11) NOT NULL,
  `nume` varchar(100) NOT NULL,
  `prenume` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nr_telefon` varchar(20) DEFAULT NULL,
  `data_inregistrare` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `utilizatori_biblioteca`
--

INSERT INTO `utilizatori_biblioteca` (`id`, `nume`, `prenume`, `email`, `nr_telefon`, `data_inregistrare`) VALUES
(1, 'Gurdis', 'Artemii', 'gurdisartemii@gmail.com', '078445698', '2025-11-18'),
(2, 'Colcotin', 'Adrian', 'pana@edu.com', '078844636', '2025-11-18');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `carti_biblioteca`
--
ALTER TABLE `carti_biblioteca`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `utilizatori_biblioteca`
--
ALTER TABLE `utilizatori_biblioteca`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `carti_biblioteca`
--
ALTER TABLE `carti_biblioteca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `utilizatori_biblioteca`
--
ALTER TABLE `utilizatori_biblioteca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
