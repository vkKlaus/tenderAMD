-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 31 2020 г., 14:05
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `j96873ov_tender`
--

-- --------------------------------------------------------

--
-- Структура таблицы `log`
--
-- Создание: Май 29 2020 г., 12:56
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(14) NOT NULL,
  `user` int(14) NOT NULL,
  `tender` int(5) DEFAULT NULL,
  `download` tinyint(4) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `operation` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--
-- Создание: Май 29 2020 г., 12:56
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(3) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`id`, `uid`, `name`) VALUES
(1, 0, 'Две столицы'),
(2, 0, 'Бартон');

-- --------------------------------------------------------

--
-- Структура таблицы `tenders`
--
-- Создание: Май 29 2020 г., 12:56
--

DROP TABLE IF EXISTS `tenders`;
CREATE TABLE `tenders` (
  `id` int(5) NOT NULL,
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `close` tinyint(1) NOT NULL DEFAULT '0',
  `type` int(2) DEFAULT NULL,
  `project` int(3) DEFAULT NULL,
  `description` text,
  `date_open` date NOT NULL,
  `date_close` date NOT NULL,
  `documents` varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--
-- Создание: Май 29 2020 г., 12:56
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(3) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`id`, `uid`, `name`) VALUES
(2, NULL, 'СМР'),
(3, NULL, 'поставка оборудования'),
(4, NULL, 'поставка материалов'),
(5, NULL, 'геодезия и изыскательские работы'),
(6, NULL, 'проектные работы');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--
-- Создание: Май 29 2020 г., 12:56
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(14) NOT NULL,
  `inn` int(14) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `password` varchar(1024) DEFAULT NULL,
  `action` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(1024) DEFAULT NULL,
  `address_legal` varchar(1024) DEFAULT NULL,
  `address_actual` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `log`
--
ALTER TABLE `log`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tenders`
--
ALTER TABLE `tenders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `type`
--
ALTER TABLE `type`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
