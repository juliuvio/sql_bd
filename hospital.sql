-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 27 2024 г., 23:28
-- Версия сервера: 5.5.25
-- Версия PHP: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `hospital`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `idD` int(11) NOT NULL AUTO_INCREMENT,
  `doctorfio` varchar(70) NOT NULL,
  `bdate` date NOT NULL,
  `phone` varchar(12) NOT NULL,
  `salary` int(10) NOT NULL,
  `idS` int(11) NOT NULL,
  PRIMARY KEY (`idD`),
  KEY `idS` (`idS`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `doctor`
--

INSERT INTO `doctor` (`idD`, `doctorfio`, `bdate`, `phone`, `salary`, `idS`) VALUES
(1, 'Романов Тимофей Петрович', '1978-01-03', '+79274891273', 70000, 1),
(2, 'Борисов Арсений Дмитриевич', '1956-04-29', '+79604361294', 75000, 2),
(3, 'Михайлов Вадим Артёмович', '1989-02-06', '+79033271045', 80000, 3),
(4, 'Волков Максим Давидович', '1985-07-27', '+79451295612', 70000, 4),
(5, 'Мартынова Алина Данииловна', '1992-11-06', '+79033451037', 85000, 5),
(6, 'Егоров Александр Александрович', '1963-04-11', '+79271045972', 85000, 6),
(7, 'Колесникова Мария Артёмовна', '1973-08-20', '+79453456710', 90000, 7),
(8, 'Бочаров Михаил Михайлович', '1984-09-30', '+7962531044', 95000, 8),
(9, 'Селиванова Регина Петровна', '1982-02-15', '+79567892354', 70000, 9),
(10, 'Широкова Елизавета Матвеевна', '1986-06-30', '+79638926710', 80000, 10),
(11, 'Баранов Матвей Кириллович', '1974-09-27', '+79033106789', 95000, 11),
(12, 'Петрова Ольга Михайловна', '1992-12-07', '+79036278046', 95000, 1),
(13, 'Зайнуллин Финар Динарович', '1974-08-21', '+79567862355', 90000, 1),
(14, 'Юсупова Гульназ Гарафутдиновна', '1989-02-08', '+79033451037', 85000, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `medreport`
--

CREATE TABLE IF NOT EXISTS `medreport` (
  `idM` int(11) NOT NULL AUTO_INCREMENT,
  `diagnostic` varchar(5) NOT NULL,
  `medcertificate` enum('да','нет') NOT NULL,
  `medication` varchar(50) NOT NULL,
  `idV` int(11) NOT NULL,
  PRIMARY KEY (`idM`),
  UNIQUE KEY `idV` (`idV`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `medreport`
--

INSERT INTO `medreport` (`idM`, `diagnostic`, `medcertificate`, `medication`, `idV`) VALUES
(1, 'A15.0', 'да', 'направление на КТ,МРТ', 1),
(2, 'T67.7', 'да', 'направление на КТ,МРТ', 2),
(3, 'Р89.1', 'нет', 'направление на обследование', 3),
(4, 'К20.3', 'да', 'на повторный прием', 4),
(5, 'С56', 'нет', 'улучшение состояния', 5),
(6, 'П45.1', 'нет', 'направление на обследование', 6),
(7, 'С78.2', 'да', 'направление на обследование', 7),
(8, 'К28.3', 'да', 'на повторный прием', 8),
(9, 'К10', 'нет', 'направление на КТ,МРТ', 9),
(10, 'Т83', 'нет', 'улучшение состояния, лечение не требуется', 10),
(11, 'Н78', 'да', 'направление на КТ,МРТ', 11);

-- --------------------------------------------------------

--
-- Структура таблицы `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `idP` int(11) NOT NULL AUTO_INCREMENT,
  `patientfio` varchar(70) NOT NULL,
  `bdate` date NOT NULL,
  `phone` varchar(12) NOT NULL,
  `medpolis` varchar(16) NOT NULL,
  `medcard` int(5) NOT NULL,
  PRIMARY KEY (`idP`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `patient`
--

INSERT INTO `patient` (`idP`, `patientfio`, `bdate`, `phone`, `medpolis`, `medcard`) VALUES
(1, 'Трифонова Виктория Борисовна', '1968-12-05', '+79634824305', '7803569780124563', 78002),
(2, 'Шмелев Павел Константинович', '1977-08-23', '+79033182546', '0362158952301574', 38702),
(3, 'Тимофеева Полина Павловна', '1964-03-16', '+79311820634', '0934578366910245', 78219),
(4, 'Куприянова София Тимофеевна', '1959-07-07', '+79675265354', '7203869410785326', 12968),
(5, 'Козловский Макар Романович', '1978-03-29', '+79857168823', '8802359631245786', 89001),
(6, 'Золотов Дмитрий Романович', '1988-10-26', '+79635261705', '3021546879821654', 97012),
(7, 'Романова Юлия Марковна', '1960-02-05', '+79201842576', '0321657864518659', 13288),
(8, 'Воронина Елизавета Константиновна', '1985-06-14', '+79967864486', '8642132186440480', 12650),
(9, 'Лаптева Таисия Кирилловна', '1994-09-12', '+79994568210', '4894605123845163', 76596),
(10, 'Емельянов Мирон Егорович', '1956-03-18', '+79455870236', '7802485874651320', 53056),
(11, 'Никитин Андрей Матвеевич', '1948-07-29', '+79633102287', '7012896325415896', 10265);

-- --------------------------------------------------------

--
-- Структура таблицы `specialization`
--

CREATE TABLE IF NOT EXISTS `specialization` (
  `idS` int(11) NOT NULL AUTO_INCREMENT,
  `namespec` varchar(30) NOT NULL,
  PRIMARY KEY (`idS`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `specialization`
--

INSERT INTO `specialization` (`idS`, `namespec`) VALUES
(1, 'хирург'),
(2, 'офтальмолог'),
(3, 'невролог'),
(4, 'эндокринолог'),
(5, 'кардиолог'),
(6, 'инфекционист'),
(7, 'аллерголог'),
(8, 'терапевт уч'),
(9, 'гастроэнтеролог'),
(10, 'травматолог'),
(11, 'дерматолог');

-- --------------------------------------------------------

--
-- Структура таблицы `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
  `idV` int(11) NOT NULL AUTO_INCREMENT,
  `visitdate` date NOT NULL,
  `visittime` time NOT NULL,
  `idD` int(11) NOT NULL,
  `idP` int(11) NOT NULL,
  PRIMARY KEY (`idV`),
  UNIQUE KEY `idV` (`idV`),
  KEY `idD` (`idD`),
  KEY `idP` (`idP`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `visit`
--

INSERT INTO `visit` (`idV`, `visitdate`, `visittime`, `idD`, `idP`) VALUES
(1, '2023-01-26', '09:30:00', 1, 1),
(2, '2023-01-26', '09:30:00', 2, 2),
(3, '2023-01-26', '10:00:00', 3, 3),
(4, '2023-01-27', '10:00:00', 4, 4),
(5, '2023-01-27', '10:30:00', 5, 5),
(6, '2023-01-27', '10:30:00', 6, 6),
(7, '2023-01-28', '10:30:00', 7, 7),
(8, '2023-01-28', '10:30:00', 8, 8),
(9, '2023-01-28', '15:00:00', 9, 9),
(10, '2023-01-29', '12:00:00', 10, 10),
(11, '2023-01-29', '12:00:00', 11, 11),
(13, '2023-01-30', '11:00:00', 1, 3),
(14, '2023-01-30', '11:30:00', 2, 4),
(15, '2023-01-30', '12:00:00', 4, 7),
(16, '2023-01-30', '12:30:00', 5, 9),
(17, '2023-01-31', '13:00:00', 8, 10),
(18, '2023-01-31', '13:30:00', 1, 5),
(19, '2023-01-23', '13:00:00', 1, 4),
(28, '2023-01-23', '13:00:00', 1, 11),
(29, '2023-01-23', '13:00:00', 2, 2);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`idS`) REFERENCES `specialization` (`idS`);

--
-- Ограничения внешнего ключа таблицы `medreport`
--
ALTER TABLE `medreport`
  ADD CONSTRAINT `medreport_ibfk_1` FOREIGN KEY (`idV`) REFERENCES `visit` (`idV`);

--
-- Ограничения внешнего ключа таблицы `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_ibfk_1` FOREIGN KEY (`idD`) REFERENCES `doctor` (`idD`),
  ADD CONSTRAINT `visit_ibfk_2` FOREIGN KEY (`idP`) REFERENCES `patient` (`idP`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
