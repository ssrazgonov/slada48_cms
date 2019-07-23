-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 23 2019 г., 05:43
-- Версия сервера: 5.7.24
-- Версия PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `slada48`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1561199819),
('m130524_201442_init', 1561199823),
('m190124_110200_add_verification_token_column_to_user_table', 1561199823),
('m190618_153725_create_product_table', 1561199823),
('m190618_154642_create_product_category_table', 1561199823),
('m190618_174116_create_product_cat_fake_data', 1561199824),
('m190618_210424_create_product_fake_data', 1561206211),
('m190621_073427_create_product_option_table', 1561206212),
('m190625_083222_create_product_option_fake_data', 1562744691),
('m190625_123611_create_order_table', 1562744692);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` float DEFAULT NULL,
  `payment_mehtod` int(11) DEFAULT '1',
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `user_id`, `status`, `created_at`, `updated_at`, `amount`, `payment_mehtod`, `note`) VALUES
(12, 15, 0, '2019-07-15 12:36:52', '2019-07-15 12:36:52', 2812, 1, '12у12'),
(11, 13, 0, '2019-07-14 18:42:17', '2019-07-14 18:42:17', 11680, 2, 'adaw'),
(10, 13, 0, '2019-07-14 18:37:38', '2019-07-14 18:37:38', 2608.2, 1, 'gdgsg'),
(13, 16, 0, '2019-07-22 17:17:45', '2019-07-22 17:17:45', 25, 1, 'Comment');

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE IF NOT EXISTS `order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `product_option` int(11) DEFAULT NULL,
  `sum` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`, `price`, `product_option`, `sum`) VALUES
(23, 13, 93, 1, 25, NULL, 25),
(22, 12, 31, 2000, 1406, 1, 2812),
(21, 11, 33, 10, 1168, NULL, 11680),
(20, 10, 38, 2100, 1242, 2, 2608.2);

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `title`, `keywords`, `description`, `content`, `parent_id`, `sort`) VALUES
(1, 'Тест', 'бла бла бла', 'бла бла бла x 3', 'бла бла бла x 300', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `page_category`
--

DROP TABLE IF EXISTS `page_category`;
CREATE TABLE IF NOT EXISTS `page_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `page_category`
--

INSERT INTO `page_category` (`id`, `title`) VALUES
(1, 'Тестовый раздел');

-- --------------------------------------------------------

--
-- Структура таблицы `payment_mehtod`
--

DROP TABLE IF EXISTS `payment_mehtod`;
CREATE TABLE IF NOT EXISTS `payment_mehtod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment_mehtod`
--

INSERT INTO `payment_mehtod` (`id`, `title`) VALUES
(1, 'Наличными в магазине'),
(2, 'Наличными курьеру');

-- --------------------------------------------------------

--
-- Структура таблицы `price_type`
--

DROP TABLE IF EXISTS `price_type`;
CREATE TABLE IF NOT EXISTS `price_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `price_type`
--

INSERT INTO `price_type` (`id`, `title`) VALUES
(1, 'вес'),
(2, 'штучно');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `vendor_code` varchar(255) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `price_type_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `prod_img` varchar(255) DEFAULT NULL,
  `min` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `title`, `vendor_code`, `cat_id`, `price`, `price_type_id`, `description`, `prod_img`, `min`) VALUES
(93, 'Песочное с джемом', 'Песочное с джемом 123', 2, 25, 2, '', 'песочное.png', 0),
(101, 'печенька', '12312', NULL, 1200, 1, 'уфиф фп ффупк уфкп фук пфукп уфк фук фукпфук фукпфу', '!.png', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `cat_img` varchar(255) DEFAULT NULL,
  `description` text,
  `cat_slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cat_slug` (`cat_slug`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_category`
--

INSERT INTO `product_category` (`id`, `title`, `parent_id`, `cat_img`, `description`, `cat_slug`) VALUES
(1, 'Детские торты', 0, 'детские_торты.png', 'Детские торты любых видов', 'det-tort'),
(2, 'Праздничные торты торты', 0, 'праздничные_торты.png', 'Праздничные торты любых видов', 'prazd-tort'),
(3, 'Свадебные торты', 0, 'свадебные_торты.png', 'Свадебные торты любых видов', 'svad-tort');

-- --------------------------------------------------------

--
-- Структура таблицы `product_option`
--

DROP TABLE IF EXISTS `product_option`;
CREATE TABLE IF NOT EXISTS `product_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_option`
--

INSERT INTO `product_option` (`id`, `title`, `description`, `img`) VALUES
(1, NULL, 'test', '/img/nachinka2.jpg'),
(2, NULL, 'test2', '/img/nachinka3.jpg'),
(3, '0', 'Слои медового полуфабриката соединены между собой кремом сливочным с вареным сгущенным молоком.', '/img/nachinka1.png'),
(4, '1', 'Слои бисквитного полуфабриката поочередно соединены между собой суфле, черносмородиновым конфитюром и дробленым арахисом.', '/img/nachinka2.jpg'),
(5, '2', 'Слои медового полуфабриката соединены между собой сметанным кремом с добавлением чернослива и грецкого ореха.', '/img/nachinka3.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `product_option_rel`
--

DROP TABLE IF EXISTS `product_option_rel`;
CREATE TABLE IF NOT EXISTS `product_option_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `product_option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `qty_preset`
--

DROP TABLE IF EXISTS `qty_preset`;
CREATE TABLE IF NOT EXISTS `qty_preset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `qty_preset`
--

INSERT INTO `qty_preset` (`id`, `name`) VALUES
(1, 'По умолчанию');

-- --------------------------------------------------------

--
-- Структура таблицы `qty_rel`
--

DROP TABLE IF EXISTS `qty_rel`;
CREATE TABLE IF NOT EXISTS `qty_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty_preset_id` int(11) NOT NULL,
  `qty_value_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `qty_rel`
--

INSERT INTO `qty_rel` (`id`, `qty_preset_id`, `qty_value_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `qty_value`
--

DROP TABLE IF EXISTS `qty_value`;
CREATE TABLE IF NOT EXISTS `qty_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `qty_value`
--

INSERT INTO `qty_value` (`id`, `value`) VALUES
(1, 450),
(2, 2000);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `phone`) VALUES
(9, 'test123', '05nfWPOAX2YcuH36n4kzbSkPpH6dOPZb', '$2y$13$d0IzV9X/qAn6Z1lSQvhaMe/Qf6NqJmej67VSUh98rHCdjBZ/ThoWy', NULL, 'test2@test.loc1', 10, 1562968716, 1563179626, '6kCsTaX2nN8rKYH46WVwmX8Bx6FEyqnA_1562968716', '12313123'),
(10, 'guest123', 'uY4kJC1rc350deBs3GiKzxvgEh7i6iBj', '$2y$13$MAxlfelyQ4asCtYnjUFmuORXxSY9Bnp3f.kTKuXiPxNEDcrpjoMZC', NULL, 'guest123@test.loc', 10, 1563042886, 1563042886, 'VxXqEAH2iO9ndQkSb1FmK4pIk5iqppuv_1563042886', '0'),
(11, 'polz2', 'e0Jldrz0fLSKOYYtrp6GQVpBKtMR44-y', '$2y$13$K556UjILIzzJCT9xXL9gHu5zAa4eRA755Q1VbV6LX6VRVZNRjp.6W', NULL, 'polz@test.loc', 10, 1563044830, 1563044830, 'oTJh6fOzKxMUpYuqBrM_jPSMC_83hsD-_1563044830', '0'),
(12, 'blabla', 'ieFXlb3hQTVxnr6qsHvAK9sp9NCnqc5U', '$2y$13$bWF9CnAJ.2hzAU6CXGvBYuStI0dmklniAFA26Gr.k4dOqMFxxTqt2', NULL, 'blabla@blabla.loc', 10, 1563053422, 1563053422, '1Bu35HgEBCQzH2JtcgP7wDE7RXL4vXxl_1563053422', '0'),
(13, '123', 'Si2LG4G7NnSTAgA4NrqAH9BTIyCQHMkp', '$2y$13$e2APkwuDk74h8A0OXkH2I.5cL8kyzRpRpbSlgxuUi9HOIEukRTb0O', NULL, '123@ru.ru', 10, 1563129416, 1563129416, 'w0aPK6Xm_VgMapFZfTd94KEdnWwDb2_J_1563129416', '0'),
(14, 'test', 'bF-yG3_qFUVT2XA4_mvrzI2jdYXeKGhg', '$2y$13$2vH.OPo96qLPsuZPJr5Bne5vnj/TDiG4R3TmweIHl16EdwJp2LTHm', NULL, 'test2@test.loc', 10, 1563182427, 1563182427, 'PgWpS3UUQTpjXzvba_t0hpXEKirUEZNM_1563182427', '0'),
(15, 'TesterMike', 'fdDthOFOyhn7HdZNnQPc7Efen-quI7dD', '$2y$13$xE9Q5Md7hehGe3Um.PYI9efiRWj/geCHKa9W5ugpAmjPWxh6Wfhfe', NULL, 'Mike@mike.ru', 10, 1563192854, 1563192854, 'x0kufu2oQZMyP9YcOa1KiPzQjNtBSQ6X_1563192854', '0'),
(16, 'test1234', '-NkmKUddW9_nfRkKOikOiU9bl1mN7_tv', '$2y$13$akMUZ9df7wTT2Z38/4MK6u/EUm0iV6HkHxlOCGGOt13A2Yf4UkhI2', NULL, 'test123@test.loc', 10, 1563815819, 1563815819, 'kiBA5xFR4K4Wnr7EHVLmw_8RByfu0yd3_1563815818', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
