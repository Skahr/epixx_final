-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 30 2015 г., 14:23
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `epixx_final`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id_cat` int(11) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ru` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id_cat`, `name_en`, `name_ru`) VALUES
(1, 'Rifles', 'Винтовки'),
(2, 'Shotguns', 'Дробовики'),
(3, 'Sniper', 'Снайперские'),
(4, 'Bows', 'Луки'),
(5, 'Launchers', 'Установки'),
(6, 'Pistols', 'Пистолеты'),
(7, 'Throwing', 'Метательное'),
(8, 'Melee', 'Мили');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `c_order` text NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_phone` varchar(255) NOT NULL,
  `c_adress` varchar(255) NOT NULL,
  `o_status` varchar(255) NOT NULL,
  `o_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `c_order`, `c_name`, `c_phone`, `c_adress`, `o_status`, `o_date`) VALUES
(1, '{"1":"1","6":1,"8":2,"9":1}', 'c_name', 'c_phone', '', 'fin', '2015-03-14 11:31:56'),
(2, '{"1":"2","4":"5","6":"10"}', 'Василий Пупкин', '1234567', '', 'fin', '2015-03-14 11:31:56'),
(3, '{"1":"7","3":"5","6":"1"}', 'zxcc fg vbbb', '123', '', 'fin', '2015-03-14 11:31:56'),
(4, '{"1":"1","2":"2","9":"1"}', 'zxchhhh', '3444', '', 'fin', '2015-03-14 11:31:56'),
(5, '{"1":"1","2":"2","8":1}', 'Пупкин', '1234', '', 'conf', '2015-03-23 09:07:20'),
(6, '{"1":"2","2":"1","8":"1","9":"1"}', 'asdffgg', '12334cfdf', '', 'new', '2015-03-24 12:00:47'),
(7, '{"2":"26"}', 'assdffgg', '23334', '', 'fin', '2015-03-28 14:06:29'),
(8, '{"6":"1"}', 'qssxx', '23444', '', 'new', '2015-03-28 15:14:12'),
(9, '{"6":"1","4":"1","5":"1","7":"8"}', 'gdfgdsss', '65656', '', 'new', '2015-03-28 16:11:07');

-- --------------------------------------------------------

--
-- Структура таблицы `pricelist`
--

CREATE TABLE IF NOT EXISTS `pricelist` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_cat` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `sale` int(11) NOT NULL DEFAULT '0',
  `units` varchar(255) NOT NULL,
  `q` int(11) NOT NULL,
  `soldq` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pricelist`
--

INSERT INTO `pricelist` (`id`, `name`, `id_cat`, `description`, `img`, `price`, `sale`, `units`, `q`, `soldq`) VALUES
(1, 'Болтор Прайм', 1, 'Стреляет разработанными Орокин болтами, которые быстрее и острее обычных, но обладают меньшей эффективной дальностью.', 'Boltor_Prime', 500, 15, 'шт', 100, 9),
(2, 'Латрон Призрак', 1, 'Латрон Призрак это более мощная версия стандартной, полуавтоматической винтовки, которая имеет уникальный дизайн.', 'WraithLatron', 999, 0, 'шт', -1, 31),
(3, 'Горгона Призма', 1, 'Улучшенная закаленным призматическим кристаллом из Бездны, эта Горгона ценится за свою красоту и улучшенную механику.', 'PrismGorgon', 699, 0, 'шт', 25, 8),
(4, 'Карак', 1, 'Массивный, надежный и смертоносный. Карак стоит на вооружении во многих взводах Гринир.', 'Karack', 99, 25, 'шт', 500, 6),
(5, 'Комм', 2, 'С каждым выстрелом в непрерывной очереди Комм выстреливает дополнительный снаряд и становится все более смертоносным.', 'Kohm', 125, 0, 'шт', 500, 0),
(6, 'Оптикор', 5, 'При полной зарядке, эта лазерная пушка Корпуса способна выполнить уничтожающий взрыв световой энергией.', 'Opticor', 355, 0, 'шт', 300, 10),
(7, 'Фаг', 2, 'Испускает семь потоков биохимической энергии, которые мгновенно проедают любую поверхность.', 'Phage', 635, 5, 'шт', 300, 0),
(8, 'Пантера', 1, 'Выстреливающая разогнанные лезвия, это оружие может быть использовано как боевая пила, расчленяющая все, что оказалось в зоне поражения.', 'Panthera', 300, 10, 'шт', 500, 0),
(9, 'Аклекс', 6, 'Парные Лексы удваивают количество высококалиберного свинца, которым вы можете поражать врагов, однако страдает точность и увеличивается время перезарядки.', 'Aklex', 150, 50, 'шт', 100, 1),
(10, 'Кронен', 8, 'Кронен воскрешает смертоносный стиль боя, который когда-то был утерян в веках.', 'Kronen', 400, 0, 'шт', 100, 0),
(11, 'Лекс Прайм', 6, 'Лекс Прайм - это мощный и точный пистолет с низкой скорострельностью и малым размером обоймы. Очень эффективен на дальних дистанциях.', 'PrimeLex', 450, 10, 'шт', 25, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'admin@master.ru', '$2y$10$OOv1km3I7rTU9/doaAXxLewkcI.OFb6EcfJYktedT0gjlSIYI/tJq');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id_cat`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pricelist`
--
ALTER TABLE `pricelist`
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
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `pricelist`
--
ALTER TABLE `pricelist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
