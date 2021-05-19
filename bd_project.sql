-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 19 2021 г., 17:26
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bd_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `claims`
--

CREATE TABLE `claims` (
  `id` int NOT NULL,
  `author` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `newValue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `claims`
--

INSERT INTO `claims` (`id`, `author`, `title`, `value`, `newValue`, `status`) VALUES
(94, 'admin', 'Заменить дорожное покрытие ул. Черняховского', 'uploads/1621429619f1a352a111c5cd4c1d1709497af912d0_XL.jpg', 'uploads/16214318907bfe84ef01aefc1aa146aca93b67e94c_XL.jpg', 1),
(96, 'user', 'Отремонтировано на улице Пролетарская', 'uploads/16214319787bfe84ef01aefc1aa146aca93b67e94c_XL.jpg', 'uploads/1621432015049.jpg', 1),
(97, 'admin', 'Отремонтировать заезд во двор ул. Проспект-Мира', 'uploads/16214342217bfe84ef01aefc1aa146aca93b67e94c_XL.jpg', NULL, 0),
(98, 'user', 'Отремонтировать двор улица Московский-проспект', 'uploads/16214342787bfe84ef01aefc1aa146aca93b67e94c_XL.jpg', 'uploads/1621434306976e90c81f5f45ad3d3518a54ae2bfeb.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(355) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `user_group` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`, `user_group`) VALUES
(13, 'Акчурин Константин Евгеньевич', 'admin', 'sorokin190701@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'uploads/1621431485DgJkuiQ270U.jpg', 1),
(14, 'Константин Сорокин', 'user', 'x007xx05@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'uploads/1621432120BJn6T4K-VeQ.jpg', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `claims`
--
ALTER TABLE `claims`
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
-- AUTO_INCREMENT для таблицы `claims`
--
ALTER TABLE `claims`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
