-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 13 2024 г., 13:01
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gazeta`
--

-- --------------------------------------------------------

--
-- Структура таблицы `newspapers`
--

CREATE TABLE `newspapers` (
  `newspaper_id` bigint NOT NULL,
  `newspaper_date` date DEFAULT NULL,
  `newspaper_title` text,
  `newspapers_registered` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `newspapers_author_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `newspapers_content`
--

CREATE TABLE `newspapers_content` (
  `newspaper_content_id` bigint NOT NULL,
  `newspaper_content_img` varchar(180) DEFAULT NULL,
  `newspaper_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `newspapers_content_data`
--

CREATE TABLE `newspapers_content_data` (
  `newspaper_content_data_id` bigint NOT NULL,
  `newspaper_content_data_text` text,
  `newspaper_content_data_type` varchar(15) DEFAULT NULL,
  `newspaper_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` bigint NOT NULL,
  `user_name` varchar(40) DEFAULT NULL,
  `user_surname` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`) VALUES
(2, 'Рустем', 'Жумабек');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `newspapers`
--
ALTER TABLE `newspapers`
  ADD PRIMARY KEY (`newspaper_id`);

--
-- Индексы таблицы `newspapers_content`
--
ALTER TABLE `newspapers_content`
  ADD PRIMARY KEY (`newspaper_content_id`);

--
-- Индексы таблицы `newspapers_content_data`
--
ALTER TABLE `newspapers_content_data`
  ADD PRIMARY KEY (`newspaper_content_data_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `newspapers`
--
ALTER TABLE `newspapers`
  MODIFY `newspaper_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `newspapers_content`
--
ALTER TABLE `newspapers_content`
  MODIFY `newspaper_content_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `newspapers_content_data`
--
ALTER TABLE `newspapers_content_data`
  MODIFY `newspaper_content_data_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
