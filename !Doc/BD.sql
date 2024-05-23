-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 22 2024 г., 23:08
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
-- База данных: `my_yii2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `order_id` int NOT NULL,
  `worker_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `message`, `order_id`, `worker_id`) VALUES
(1, 'Всё сделаем!', 1, 2),
(2, 'Всё сделаем!', 2, 3),
(3, 'Починим в момент.', 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `component`
--

CREATE TABLE `component` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `climate_tech_type` varchar(255) NOT NULL,
  `climate_tech_model` varchar(255) NOT NULL,
  `problem_description` text NOT NULL,
  `start_date` date NOT NULL,
  `completion_date` date DEFAULT NULL,
  `status_id` int NOT NULL,
  `client_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `climate_tech_type`, `climate_tech_model`, `problem_description`, `start_date`, `completion_date`, `status_id`, `client_id`) VALUES
(1, 'Кондиционер', 'TCL TAC-12CHSA/TPG-W белый ', 'Не охлаждает воздух', '2023-06-06', NULL, 2, 7),
(2, 'Кондиционер', 'Electrolux EACS/I-09HAT/N3_21Y белый', 'Выключается сам по себе', '2023-05-05', NULL, 2, 8),
(3, 'Увлажнитель воздуха', 'Xiaomi Smart Humidifier 2', 'Пар имеет неприятный запах', '2022-07-07', '2023-01-01', 4, 9),
(4, 'Увлажнитель воздуха', 'Polaris PUH 2300 WIFI IQ Home', 'Увлажнитель воздуха продолжает работать при предельном снижении уровня воды', '2023-08-02', NULL, 1, 8),
(5, 'Сушилка для рук', 'Ballu BAHD-1250', 'Не работает', '2023-08-02', NULL, 1, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `order_component`
--

CREATE TABLE `order_component` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `component_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Новая заявка'),
(2, 'В процессе ремонта'),
(3, 'Ожидание комплектующих'),
(4, 'Готова к выдаче');

-- --------------------------------------------------------

--
-- Структура таблицы `order_worker`
--

CREATE TABLE `order_worker` (
  `id` int NOT NULL,
  `is_executor` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - false\r\n1 - true',
  `order_id` int NOT NULL,
  `worker_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_worker`
--

INSERT INTO `order_worker` (`id`, `is_executor`, `order_id`, `worker_id`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 3),
(3, 1, 3, 3),
(4, 0, 4, NULL),
(5, 0, 5, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`, `code`) VALUES
(1, 'Заказчик', 'client'),
(2, 'Специалист', 'specialist'),
(3, 'Менеджер', 'manager'),
(4, 'Оператор', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `phone` varchar(16) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `surname`, `name`, `patronymic`, `phone`, `login`, `password`, `role_id`) VALUES
(1, 'Широков', 'Василий', 'Матвеевич', '89210563128', 'login1', 'pass1', 3),
(2, 'Кудрявцева', 'Ева', 'Ивановна', '89535078985', 'login2', 'pass2', 2),
(3, 'Гончарова', 'Ульяна', 'Ярославовна', '89210673849', 'login3', 'pass3', 2),
(4, 'Гусева', 'Виктория', 'Данииловна', '89990563748', 'login4', 'pass4', 4),
(5, 'Баранов', 'Артём', 'Юрьевич', '89994563847', 'login5', 'pass5', 4),
(6, 'Овчинников', 'Фёдор', 'Никитич', '89219567849', 'login6', 'pass6', 1),
(7, 'Петров', 'Никита', 'Артёмович', '89219567841', 'login7', 'pass7', 1),
(8, 'Ковалева', 'Софья', 'Владимировна', '89219567842', 'login8', 'pass8', 1),
(9, 'Кузнецов', 'Сергей', 'Матвеевич', '89219567843', 'login9', 'pass9', 1),
(10, 'Беспалова', 'Екатерина', 'Даниэльевна', '89219567844', 'login10', 'pass10', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Индексы таблицы `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Индексы таблицы `order_component`
--
ALTER TABLE `order_component`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `component_id` (`component_id`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_worker`
--
ALTER TABLE `order_worker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `component`
--
ALTER TABLE `component`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `order_component`
--
ALTER TABLE `order_component`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `order_worker`
--
ALTER TABLE `order_worker`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_component`
--
ALTER TABLE `order_component`
  ADD CONSTRAINT `order_component_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `component` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_component_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `order_worker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_worker`
--
ALTER TABLE `order_worker`
  ADD CONSTRAINT `order_worker_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_worker_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
