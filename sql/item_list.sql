-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-09-07 19:00:20
-- サーバのバージョン： 10.4.10-MariaDB
-- PHP のバージョン: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `item_list`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `start` date NOT NULL COMMENT '開始日時',
  `end` date NOT NULL COMMENT '終了日時',
  `start_time` time NOT NULL DEFAULT '00:00:00',
  `end_time` time NOT NULL DEFAULT '00:00:00',
  `tag` tinyint(4) DEFAULT 0,
  `memo` text DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `items`
--

INSERT INTO `items` (`id`, `title`, `start`, `end`, `start_time`, `end_time`, `tag`, `memo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(0, 'zz', '2020-01-01', '2020-01-04', '00:02:00', '01:00:00', 2, 'jj', NULL, '2020-09-07', '2020-09-07'),
(1, 'aaa', '2020-01-02', '2020-01-03', '01:00:00', '03:03:00', 0, 'aaaaa', NULL, '2020-09-03', '2020-09-07'),
(2, 'bb', '2020-01-01', '2020-01-01', '00:00:00', '00:00:00', 0, '', NULL, '2020-09-03', '2020-09-03'),
(3, 'cc', '2020-01-01', '2020-01-01', '00:00:00', '00:00:00', 1, 'cc', NULL, '2020-09-03', '2020-09-03'),
(4, 'dd', '2020-01-02', '2020-02-01', '00:00:00', '00:00:00', 2, 'dd', NULL, '2020-09-03', '2020-09-03'),
(5, 'ee', '2020-01-01', '2020-01-01', '00:00:00', '00:00:00', 1, '', NULL, '2020-09-03', '2020-09-03'),
(6, 'ff', '2020-09-03', '2020-09-04', '00:00:00', '00:00:00', 1, '', NULL, '2020-09-03', '2020-09-03'),
(7, 'gg', '2020-01-01', '2020-01-02', '01:00:00', '01:00:00', 1, 'gg', NULL, '2020-09-07', '2020-09-07'),
(8, 'hh', '2020-01-02', '2020-01-03', '00:00:00', '02:00:00', 0, 'hh', NULL, '2020-09-07', '2020-09-07'),
(9, 'ii', '2020-01-01', '2020-01-02', '01:00:00', '02:00:00', 0, '', NULL, '2020-09-07', '2020-09-07');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
