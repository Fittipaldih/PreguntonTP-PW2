-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3310
-- Tiempo de generación: 26-06-2023 a las 01:20:18
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `preguntondb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `descripcion`) VALUES
(1, 'Conocimiento general'),
(2, 'Programacion PHP'),
(3, 'Base de datos'),
(4, 'Programación Orientada a Objetos'),
(5, 'Estilos en CSS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pregunta`
--

CREATE TABLE `estado_pregunta` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_pregunta`
--

INSERT INTO `estado_pregunta` (`id`, `descripcion`) VALUES
(1, 'SUGERIDA'),
(2, 'APROBADA'),
(3, 'REPORTADA'),
(4, 'NO_DISPONIBLE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`) VALUES
(1, 'Argentina'),
(2, 'Bolivia'),
(3, 'Brasil'),
(4, 'Colombia'),
(5, 'Mexico'),
(6, 'Paraguay'),
(7, 'Peru'),
(8, 'Uruguay'),
(9, 'Venezuela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `id_usuario`, `puntaje`, `fecha`) VALUES
(15, 37, 2, '2023-06-17 00:34:43'),
(16, 37, 3, '2023-06-17 00:34:43'),
(17, 12, 7, '2023-06-17 00:34:43'),
(18, 37, 0, '2023-06-17 00:34:43'),
(19, 37, 0, '2023-06-17 00:34:43'),
(40, 37, 0, '2023-06-17 00:34:43'),
(41, 37, 2, '2023-06-17 00:34:43'),
(42, 37, 0, '2023-06-17 00:34:43'),
(43, 37, 8, '2023-06-17 00:34:43'),
(44, 37, 0, '2023-06-17 00:34:43'),
(45, 37, 6, '2023-06-17 00:34:43'),
(46, 37, 0, '2023-06-17 00:34:43'),
(47, 37, 1, '2023-06-17 00:34:43'),
(48, 58, 1, '2023-06-17 00:34:43'),
(49, 58, 4, '2023-06-17 00:34:43'),
(50, 58, 0, '2023-06-17 00:34:43'),
(51, 58, 4, '2023-06-17 00:34:43'),
(52, 40, 9, '2023-06-17 00:34:43'),
(53, 22, 4, '2023-06-17 00:34:43'),
(54, 22, 0, '2023-06-17 00:34:43'),
(55, 22, 2, '2023-06-17 00:34:43'),
(56, 22, 2, '2023-06-17 00:34:43'),
(57, 22, 3, '2023-06-17 00:34:43'),
(58, 22, 1, '2023-06-17 00:34:43'),
(59, 22, 1, '2023-06-17 00:34:43'),
(60, 22, 0, '2023-06-17 00:34:43'),
(61, 22, 3, '2023-06-17 00:34:43'),
(62, 22, 3, '2023-06-17 00:34:43'),
(63, 22, 2, '2023-06-17 00:34:43'),
(64, 22, 2, '2023-06-17 00:34:43'),
(65, 22, 0, '2023-06-17 00:34:43'),
(66, 22, 0, '2023-06-17 00:34:43'),
(67, 22, 1, '2023-06-17 00:34:43'),
(68, 22, 5, '2023-06-17 00:34:43'),
(69, 22, 1, '2023-06-17 00:34:43'),
(70, 22, 1, '2023-06-17 00:34:43'),
(71, 22, 3, '2023-06-17 00:34:43'),
(72, 22, 3, '2023-06-17 00:34:43'),
(73, 22, 0, '2023-06-17 00:34:43'),
(74, 22, 1, '2023-06-17 00:34:43'),
(75, 22, 4, '2023-06-17 00:34:43'),
(76, 22, 0, '2023-06-17 00:34:43'),
(77, 22, 1, '2023-06-17 00:34:43'),
(78, 22, 2, '2023-06-17 00:34:43'),
(79, 22, 0, '2023-06-17 00:34:43'),
(80, 22, 2, '2023-06-17 00:34:43'),
(81, 22, 1, '2023-06-17 00:34:43'),
(82, 22, 1, '2023-06-17 00:34:43'),
(83, 22, 0, '2023-06-17 00:34:43'),
(84, 22, 5, '2023-06-17 00:34:43'),
(85, 22, 2, '2023-06-17 00:34:43'),
(86, 22, 3, '2023-06-17 00:34:43'),
(87, 22, 1, '2023-06-17 00:34:43'),
(88, 22, 2, '2023-06-17 00:34:43'),
(89, 22, 2, '2023-06-17 00:34:43'),
(90, 22, 3, '2023-06-17 00:34:43'),
(91, 22, 2, '2023-06-17 00:34:43'),
(92, 22, 2, '2023-06-17 00:34:43'),
(93, 22, 0, '2023-06-17 00:34:43'),
(94, 22, 2, '2023-06-17 00:34:43'),
(95, 22, 2, '2023-06-17 00:34:43'),
(96, 22, 0, '2023-06-17 00:34:43'),
(97, 78, 0, '2023-06-17 00:34:43'),
(98, 80, 0, '2023-06-17 00:34:43'),
(99, 80, 0, '2023-06-17 00:34:43'),
(100, 80, 0, '2023-06-17 00:34:43'),
(101, 80, 0, '2023-06-17 00:34:43'),
(102, 80, 0, '2023-06-17 00:34:43'),
(103, 80, 0, '2023-06-17 00:34:43'),
(104, 80, 0, '2023-06-17 00:34:43'),
(105, 80, 0, '2023-06-17 00:34:43'),
(106, 12, 0, '2023-06-17 00:34:43'),
(107, 80, 2, '2023-06-17 00:34:43'),
(108, 80, 1, '2023-06-17 00:34:43'),
(109, 80, 0, '2023-06-17 00:34:43'),
(110, 80, 0, '2023-06-17 00:34:43'),
(111, 80, 0, '2023-06-17 00:34:43'),
(112, 80, 0, '2023-06-17 00:34:43'),
(113, 80, 3, '2023-06-17 00:34:43'),
(114, 80, 0, '2023-06-17 00:34:43'),
(115, 80, 0, '2023-06-17 00:34:43'),
(116, 80, 0, '2023-06-17 00:34:43'),
(117, 80, 0, '2023-06-17 00:34:43'),
(118, 80, 0, '2023-06-17 00:34:43'),
(119, 80, 0, '2023-06-17 00:34:43'),
(120, 80, 0, '2023-06-17 00:34:43'),
(121, 80, 0, '2023-06-17 00:34:43'),
(122, 80, 0, '2023-06-17 00:34:43'),
(123, 80, 0, '2023-06-17 00:34:43'),
(124, 80, 0, '2023-06-17 00:34:43'),
(125, 80, 0, '2023-06-17 00:34:43'),
(126, 80, 0, '2023-06-17 00:34:43'),
(127, 80, 0, '2023-06-17 00:34:43'),
(128, 80, 0, '2023-06-17 00:34:43'),
(129, 80, 0, '2023-06-17 00:34:43'),
(130, 80, 0, '2023-06-17 00:34:43'),
(131, 80, 0, '2023-06-17 00:34:43'),
(132, 80, 0, '2023-06-17 00:34:43'),
(133, 80, 0, '2023-06-17 00:34:43'),
(134, 80, 0, '2023-06-17 00:34:43'),
(135, 80, 0, '2023-06-17 00:34:43'),
(136, 80, 0, '2023-06-17 00:34:43'),
(137, 80, 0, '2023-06-17 00:34:43'),
(138, 80, 0, '2023-06-17 00:34:43'),
(139, 80, 0, '2023-06-17 00:34:43'),
(140, 80, 0, '2023-06-17 00:34:43'),
(141, 80, 0, '2023-06-17 00:34:43'),
(142, 80, 0, '2023-06-17 00:34:43'),
(143, 80, 0, '2023-06-17 00:34:43'),
(144, 80, 0, '2023-06-17 00:34:43'),
(145, 80, 0, '2023-06-17 00:34:43'),
(146, 80, 0, '2023-06-17 00:34:43'),
(147, 80, 0, '2023-06-17 00:34:43'),
(148, 80, 0, '2023-06-17 00:34:43'),
(149, 80, 0, '2023-06-17 00:34:43'),
(150, 80, 0, '2023-06-17 00:34:43'),
(151, 80, 0, '2023-06-17 00:34:43'),
(152, 80, 0, '2023-06-17 00:34:43'),
(153, 80, 0, '2023-06-17 00:34:43'),
(154, 80, 0, '2023-06-17 00:34:43'),
(155, 80, 0, '2023-06-17 00:34:43'),
(156, 80, 0, '2023-06-17 00:34:43'),
(157, 80, 0, '2023-06-17 00:34:43'),
(158, 80, 0, '2023-06-17 00:34:43'),
(159, 80, 0, '2023-06-17 00:34:43'),
(160, 80, 0, '2023-06-17 00:34:43'),
(161, 80, 0, '2023-06-17 00:36:01'),
(162, 80, 0, '2023-06-19 18:44:40'),
(163, 80, 0, '2023-06-20 05:23:48'),
(164, 80, 0, '2023-06-20 05:36:29'),
(165, 80, 0, '2023-06-20 09:23:43'),
(166, 12, 0, '2023-06-20 19:23:33'),
(167, 12, 0, '2023-06-20 19:25:15'),
(168, 84, 0, '2023-06-20 19:55:56'),
(169, 80, 0, '2023-06-20 20:03:15'),
(170, 80, 0, '2023-06-20 20:13:15'),
(171, 80, 0, '2023-06-20 20:41:46'),
(172, 84, 0, '2023-06-20 20:41:59'),
(173, 84, 0, '2023-06-20 20:42:35'),
(174, 84, 0, '2023-06-20 20:42:46'),
(175, 80, 0, '2023-06-20 20:57:07'),
(176, 80, 0, '2023-06-20 21:07:53'),
(177, 80, 0, '2023-06-20 21:07:59'),
(178, 80, 0, '2023-06-20 21:09:57'),
(179, 80, 0, '2023-06-20 21:10:35'),
(180, 80, 0, '2023-06-20 21:11:05'),
(181, 80, 0, '2023-06-20 21:11:48'),
(182, 80, 0, '2023-06-20 21:12:07'),
(183, 80, 0, '2023-06-20 21:12:25'),
(184, 80, 0, '2023-06-20 21:12:44'),
(185, 80, 0, '2023-06-20 21:55:33'),
(186, 80, 0, '2023-06-20 21:58:33'),
(187, 80, 0, '2023-06-20 22:21:03'),
(188, 80, 0, '2023-06-20 22:30:42'),
(189, 80, 0, '2023-06-20 22:39:23'),
(190, 80, 0, '2023-06-20 22:43:21'),
(191, 80, 0, '2023-06-20 23:33:43'),
(192, 80, 0, '2023-06-20 23:42:41'),
(193, 80, 0, '2023-06-20 23:46:33'),
(194, 80, 0, '2023-06-20 23:46:55'),
(195, 80, 5, '2023-06-20 23:48:39'),
(196, 80, 0, '2023-06-20 23:49:38'),
(197, 80, 2, '2023-06-20 23:51:09'),
(198, 80, 3, '2023-06-21 09:21:41'),
(199, 80, 1, '2023-06-21 09:23:34'),
(200, 80, 4, '2023-06-21 09:23:49'),
(201, 80, 1, '2023-06-21 09:24:09'),
(202, 80, 2, '2023-06-21 09:27:28'),
(203, 80, 2, '2023-06-21 09:31:30'),
(204, 80, 2, '2023-06-21 09:32:53'),
(205, 80, 0, '2023-06-21 09:33:12'),
(206, 80, 2, '2023-06-21 09:36:15'),
(207, 80, 1, '2023-06-21 09:54:35'),
(208, 80, 0, '2023-06-21 09:55:42'),
(209, 80, 0, '2023-06-21 09:55:54'),
(210, 80, 0, '2023-06-21 09:57:23'),
(211, 80, 0, '2023-06-21 09:57:28'),
(212, 80, 0, '2023-06-21 09:58:41'),
(213, 80, 0, '2023-06-21 09:59:03'),
(214, 80, 7, '2023-06-21 09:59:41'),
(215, 80, 2, '2023-06-21 10:01:01'),
(216, 80, 2, '2023-06-21 10:08:24'),
(217, 80, 1, '2023-06-21 10:11:37'),
(218, 80, 3, '2023-06-21 10:11:48'),
(219, 80, 2, '2023-06-21 10:20:49'),
(220, 80, 2, '2023-06-21 10:23:07'),
(221, 80, 2, '2023-06-21 10:24:17'),
(222, 80, 2, '2023-06-21 10:28:09'),
(223, 80, 2, '2023-06-21 10:29:50'),
(224, 80, 1, '2023-06-21 10:31:17'),
(225, 80, 2, '2023-06-21 10:36:02'),
(226, 80, 0, '2023-06-21 10:38:39'),
(227, 80, 0, '2023-06-21 10:38:48'),
(228, 80, 0, '2023-06-21 10:47:31'),
(229, 80, 0, '2023-06-21 10:47:48'),
(230, 80, 0, '2023-06-21 10:49:26'),
(231, 80, 0, '2023-06-21 10:58:54'),
(232, 80, 0, '2023-06-21 10:59:03'),
(233, 80, 0, '2023-06-21 10:59:58'),
(234, 80, 0, '2023-06-21 11:01:21'),
(235, 80, 0, '2023-06-21 11:02:20'),
(236, 80, 0, '2023-06-21 11:03:01'),
(237, 80, 0, '2023-06-21 11:16:54'),
(238, 80, 0, '2023-06-21 11:17:05'),
(239, 80, 0, '2023-06-21 11:20:36'),
(240, 80, 0, '2023-06-21 11:27:06'),
(241, 80, 0, '2023-06-21 11:27:58'),
(242, 80, 0, '2023-06-21 11:28:20'),
(243, 80, 0, '2023-06-21 11:28:22'),
(244, 80, 0, '2023-06-21 11:31:03'),
(245, 80, 0, '2023-06-21 11:39:12'),
(246, 80, 0, '2023-06-21 11:40:27'),
(247, 80, 0, '2023-06-21 11:40:43'),
(248, 80, 0, '2023-06-21 11:41:32'),
(249, 80, 0, '2023-06-21 11:43:40'),
(250, 80, 0, '2023-06-21 11:45:42'),
(251, 80, 0, '2023-06-21 11:45:44'),
(252, 80, 0, '2023-06-21 11:45:59'),
(253, 80, 0, '2023-06-21 11:46:42'),
(254, 80, 0, '2023-06-21 11:47:12'),
(255, 80, 0, '2023-06-21 11:49:32'),
(256, 80, 0, '2023-06-21 11:49:41'),
(257, 80, 0, '2023-06-21 11:49:46'),
(258, 80, 0, '2023-06-21 11:49:50'),
(259, 80, 0, '2023-06-21 11:51:33'),
(260, 80, 0, '2023-06-21 11:52:30'),
(261, 80, 0, '2023-06-21 11:53:45'),
(262, 80, 0, '2023-06-21 11:54:21'),
(263, 80, 0, '2023-06-21 11:55:00'),
(264, 80, 0, '2023-06-21 11:55:30'),
(265, 80, 0, '2023-06-21 11:55:57'),
(266, 80, 0, '2023-06-21 11:56:30'),
(267, 80, 0, '2023-06-21 12:02:10'),
(268, 80, 0, '2023-06-21 12:07:51'),
(269, 80, 0, '2023-06-21 12:10:23'),
(270, 80, 0, '2023-06-21 12:12:40'),
(271, 80, 0, '2023-06-21 12:14:04'),
(272, 80, 0, '2023-06-21 12:14:08'),
(273, 80, 0, '2023-06-21 12:15:30'),
(274, 80, 0, '2023-06-21 12:19:00'),
(275, 80, 0, '2023-06-21 12:19:30'),
(276, 80, 0, '2023-06-21 12:48:12'),
(277, 80, 0, '2023-06-21 12:48:33'),
(278, 80, 0, '2023-06-21 12:53:18'),
(279, 80, 0, '2023-06-21 12:58:10'),
(280, 80, 0, '2023-06-21 12:59:27'),
(281, 80, 0, '2023-06-21 13:03:46'),
(282, 80, 0, '2023-06-21 13:05:19'),
(283, 80, 0, '2023-06-21 13:08:09'),
(284, 80, 0, '2023-06-21 13:10:49'),
(285, 80, 0, '2023-06-21 13:12:00'),
(286, 80, 0, '2023-06-21 13:13:14'),
(287, 80, 0, '2023-06-21 13:13:54'),
(288, 80, 0, '2023-06-21 13:14:25'),
(289, 80, 0, '2023-06-21 13:15:06'),
(290, 80, 0, '2023-06-21 13:15:46'),
(291, 80, 0, '2023-06-21 13:17:34'),
(292, 80, 0, '2023-06-21 13:18:34'),
(293, 80, 0, '2023-06-21 13:19:36'),
(294, 80, 0, '2023-06-21 13:20:29'),
(295, 80, 0, '2023-06-21 13:20:42'),
(296, 80, 0, '2023-06-21 13:21:32'),
(297, 80, 0, '2023-06-21 13:21:42'),
(298, 80, 0, '2023-06-21 13:21:52'),
(299, 80, 0, '2023-06-21 13:22:44'),
(300, 80, 0, '2023-06-21 13:24:27'),
(301, 80, 0, '2023-06-21 13:29:51'),
(302, 80, 0, '2023-06-21 13:33:29'),
(303, 80, 0, '2023-06-21 13:35:26'),
(304, 80, 0, '2023-06-21 13:37:14'),
(305, 80, 0, '2023-06-21 13:37:21'),
(306, 80, 0, '2023-06-21 13:40:11'),
(307, 80, 0, '2023-06-21 13:42:45'),
(308, 80, 0, '2023-06-21 13:46:09'),
(309, 80, 0, '2023-06-21 13:47:15'),
(310, 80, 0, '2023-06-21 14:13:39'),
(311, 80, 0, '2023-06-21 23:10:47'),
(312, 80, 0, '2023-06-21 23:14:13'),
(313, 80, 0, '2023-06-21 23:18:13'),
(314, 80, 0, '2023-06-21 23:18:33'),
(315, 80, 0, '2023-06-21 23:22:57'),
(316, 80, 0, '2023-06-22 00:25:25'),
(317, 80, 0, '2023-06-22 00:28:21'),
(318, 80, 0, '2023-06-22 02:19:43'),
(319, 80, 0, '2023-06-22 02:27:40'),
(320, 80, 0, '2023-06-22 04:23:39'),
(321, 80, 0, '2023-06-22 04:24:11'),
(322, 80, 0, '2023-06-22 04:45:36'),
(323, 80, 0, '2023-06-22 05:16:46'),
(324, 80, 0, '2023-06-22 05:25:41'),
(325, 80, 0, '2023-06-22 05:26:25'),
(326, 80, 0, '2023-06-22 05:32:30'),
(327, 80, 0, '2023-06-22 05:45:12'),
(328, 80, 0, '2023-06-22 05:54:46'),
(329, 80, 0, '2023-06-22 05:58:16'),
(330, 80, 0, '2023-06-22 06:00:49'),
(331, 80, 0, '2023-06-22 06:04:14'),
(332, 80, 0, '2023-06-22 06:10:29'),
(333, 80, 0, '2023-06-22 06:10:33'),
(334, 80, 0, '2023-06-22 06:10:45'),
(335, 80, 0, '2023-06-22 06:20:27'),
(336, 80, 0, '2023-06-22 06:24:00'),
(337, 80, 0, '2023-06-22 06:25:26'),
(338, 80, 0, '2023-06-22 06:27:09'),
(339, 80, 0, '2023-06-22 06:27:30'),
(340, 80, 0, '2023-06-22 06:43:03'),
(341, 80, 0, '2023-06-22 06:43:05'),
(342, 80, 0, '2023-06-22 06:43:06'),
(343, 80, 0, '2023-06-22 06:43:06'),
(344, 80, 0, '2023-06-22 06:43:35'),
(345, 80, 0, '2023-06-22 06:43:59'),
(346, 80, 0, '2023-06-22 06:44:01'),
(347, 80, 0, '2023-06-22 06:45:28'),
(348, 80, 0, '2023-06-22 06:45:29'),
(349, 80, 0, '2023-06-22 06:45:30'),
(350, 80, 0, '2023-06-22 06:45:30'),
(351, 80, 0, '2023-06-22 06:45:30'),
(352, 80, 0, '2023-06-22 06:45:30'),
(353, 80, 0, '2023-06-22 06:45:31'),
(354, 80, 0, '2023-06-22 06:45:31'),
(355, 80, 0, '2023-06-22 06:45:31'),
(356, 80, 0, '2023-06-22 06:45:31'),
(357, 80, 0, '2023-06-22 06:45:31'),
(358, 80, 0, '2023-06-22 06:45:31'),
(359, 80, 0, '2023-06-22 06:45:32'),
(360, 80, 0, '2023-06-22 06:45:32'),
(361, 80, 0, '2023-06-22 06:45:47'),
(362, 80, 10, '2023-06-22 07:06:22'),
(363, 80, 0, '2023-06-22 07:11:00'),
(364, 80, 0, '2023-06-22 07:14:24'),
(365, 80, 0, '2023-06-22 07:14:47'),
(366, 80, 0, '2023-06-22 07:16:27'),
(367, 80, 0, '2023-06-23 18:27:00'),
(368, 93, 0, '2023-06-25 23:10:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_estado` int(11) NOT NULL DEFAULT 1,
  `id_categoria` int(11) NOT NULL,
  `veces_mostrada` int(11) NOT NULL DEFAULT 0,
  `veces_correcta` int(11) NOT NULL DEFAULT 0,
  `porc_correc` int(11) NOT NULL DEFAULT 0,
  `opcionA` varchar(255) NOT NULL,
  `opcionB` varchar(255) NOT NULL,
  `opcionC` varchar(255) NOT NULL,
  `opcionD` varchar(255) NOT NULL,
  `resp_correcta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `id_estado`, `id_categoria`, `veces_mostrada`, `veces_correcta`, `porc_correc`, `opcionA`, `opcionB`, `opcionC`, `opcionD`, `resp_correcta`) VALUES
(1, '¿Cuál es el elemento químico más abundante en el universo?', 2, 1, 125, 56, 45, 'Hidrógeno', 'Oxígeno', 'Carbono', 'Hierro', 'A'),
(2, '¿Cuál es el río más largo del mundo?', 2, 1, 128, 80, 63, 'Amazonas', 'Nilo', 'Yangtsé', 'Misisipi', 'B'),
(3, '¿Cuál es la capital de Australia?', 2, 1, 120, 64, 53, 'Sídney', 'Melbourne', 'Brisbane', 'Canberra', 'D'),
(4, '¿Cuál es el planeta más grande del sistema solar?', 2, 1, 122, 63, 52, 'Mercurio', 'Venus', 'Júpiter', 'Marte', 'C'),
(5, '¿Cuál es la montaña más alta del mundo?', 2, 1, 121, 78, 64, 'Mont Blanc', 'K2', 'Everest', 'Aconcagua', 'C'),
(6, '¿Cuál es el país más poblado del mundo?', 2, 1, 125, 68, 54, 'Estados Unidos', 'China', 'India', 'Brasil', 'B'),
(7, '¿Cuál es el símbolo químico del oro?', 2, 1, 124, 78, 63, 'Au', 'Ag', 'Fe', 'Hg', 'A'),
(8, '¿Cuál es el océano más grande del mundo?', 2, 1, 126, 72, 57, 'Atlántico', 'Pacífico', 'Índico', 'Ártico', 'B'),
(9, '¿Cuál es el animal terrestre más grande del mundo?', 2, 1, 126, 77, 61, 'Jirafa', 'Rinoceronte blanco', 'Elefante africano', 'Oso polar', 'C'),
(10, '¿Cuál es el compuesto químico principal que constituye la atmósfera terrestre?', 2, 1, 130, 61, 47, 'Nitrógeno', 'Oxígeno\n', 'Dióxido de carbono\n', 'Argón', 'A'),
(44, '¿Qué significa PHP?', 2, 2, 15, 9, 60, 'Hypertext Preprocessor', 'Personal Home Page', 'Pretext Hypertext Processor', 'Hypertext Processor', 'A'),
(45, '¿Cuál es el operador utilizado para concatenar cadenas en PHP?', 2, 2, 15, 6, 43, '+', '&&', '.', ',', 'C'),
(46, '¿Cuál es la forma correcta de comentar una línea en PHP?', 2, 2, 14, 11, 79, '/* This is a comment */', '# This is a comment', '// This is a comment', '-- This is a comment', 'C'),
(47, '¿Cuál es el resultado de la expresión \"3\" + 2 en PHP?', 2, 2, 15, 9, 60, '5', '32', 'Error', 'NaN', 'A'),
(48, '¿Cuál es la función utilizada para obtener la longitud de una cadena en PHP?', 2, 2, 15, 7, 47, 'length()', 'size()', 'strlen()', 'count()', 'C'),
(49, '¿Cuál es el símbolo utilizado para acceder a propiedades de un objeto en PHP?', 2, 2, 15, 5, 33, '.', '->', '::', '/', 'B'),
(51, '¿Cuál es la función utilizada para obtener la fecha y hora actual en PHP?', 2, 2, 15, 7, 47, 'now()', 'currentDateTime()', 'getDate()', 'date()', 'D'),
(52, '¿Cuál es la forma correcta de declarar una variable en PHP?', 2, 2, 15, 10, 67, '$var = 5;', 'var = 5;', 'variable = 5;', '5 = $var;', 'A'),
(53, '¿Cuál es la función utilizada para redirigir a otra página en PHP?', 2, 2, 15, 11, 73, 'navigateTo()', 'header()', 'redirect()', 'goTo()', 'B'),
(54, '¿Qué significa SQL?', 2, 3, 14, 12, 86, 'Structured Query Language', 'Simple Query Language', 'Sequential Query Language', 'Structured Question Language', 'A'),
(55, '¿Cuál es el comando utilizado para crear una nueva tabla en MySQL?', 2, 3, 15, 10, 67, 'CREATE TABLE', 'ADD TABLE', 'NEW TABLE', 'INSERT TABLE', 'A'),
(56, '¿Cuál es el comando utilizado para insertar datos en una tabla en MySQL?', 2, 3, 14, 4, 29, 'ADD', 'INSERT', 'CREATE', 'UPDATE', 'B'),
(57, '¿Cuál es el operador utilizado para combinar múltiples condiciones en una consulta WHERE en MySQL?', 2, 3, 15, 10, 67, 'AND', 'OR', 'NOT', 'XOR', 'A'),
(58, '¿Cuál es la función utilizada para obtener el número de registros en una tabla en MySQL?', 2, 3, 15, 8, 53, 'COUNT()', 'SUM()', 'MAX()', 'MIN()', 'A'),
(59, '¿Cuál es el comando utilizado para eliminar una tabla en MySQL?', 2, 3, 15, 12, 80, 'DROP TABLE', 'DELETE TABLE', 'REMOVE TABLE', 'ERASE TABLE', 'A'),
(60, '¿Cuál es el comando utilizado para actualizar datos en una tabla en MySQL?', 2, 3, 15, 9, 60, 'UPDATE', 'ALTER', 'MODIFY', 'CHANGE', 'A'),
(61, '¿Cuál es el tipo de dato utilizado para almacenar valores monetarios en MySQL?', 2, 3, 15, 10, 67, 'INT', 'FLOAT', 'CHAR', 'DECIMAL', 'D'),
(62, '¿Cuál es el comando utilizado para seleccionar datos de una tabla en MySQL?', 2, 3, 14, 10, 71, 'SELECT', 'FETCH', 'GET', 'RETRIEVE', 'A'),
(63, '¿Cuál es la cláusula utilizada para filtrar registros en una consulta SELECT en MySQL?', 2, 3, 14, 10, 71, 'WHERE', 'FROM', 'JOIN', 'GROUP BY', 'A'),
(64, '¿Qué es la herencia en POO?', 2, 4, 15, 5, 36, 'Crear una nueva clase a partir de una clase existente.', 'Eliminar una clase.', 'Cambiar el nombre de una clase.', 'Dividir una clase en múltiples subclases.', 'A'),
(65, '¿Cuál palabra clave se utiliza para crear una instancia de una clase en Java?', 2, 4, 15, 10, 67, 'new', 'instance', 'create', 'instantiate', 'A'),
(66, '¿Cuál conceptos está asociado con la encapsulación en POO?', 2, 4, 15, 6, 40, 'Limitar el acceso de las variables y acceder mediante métodos.', 'Crear múltiples instancias de una clase.', 'Modificar una clase durante la ejecución.', 'Establecer una relación de parentesco entre clases.', 'A'),
(67, '¿Qué es el polimorfismo en POO?', 2, 4, 15, 9, 60, 'Que una clase herede comportamientos de otra.', 'Que una clase tenga múltiples métodos con el mismo nombre pero con diferentes implementaciones.', 'Que una clase herede una interfaz e implemente sus métodos.', 'Todas las anteriores son correctas.', 'B'),
(68, '¿Cuál de los siguientes conceptos está asociado con la abstracción en POO?', 2, 4, 15, 9, 60, 'Representar una idea o concepto mediante una clase.', 'Crear múltiples instancias de una clase.', 'Modificar el comportamiento de una clase en tiempo de ejecución.', 'Establecer una relación de parentesco entre clases.', 'A'),
(69, '¿Cuál de las siguientes afirmaciones sobre las interfaces en programación orientada a objetos es correcta?', 1, 4, 1, 0, 0, 'Una interfaz define un contrato que una clase puede implementar.', 'Una interfaz es una clase abstracta.', 'Una interfaz solo puede contener métodos abstractos.', 'Una clase puede implementar múltiples interfaces.', 'D'),
(70, '¿Qué es la sobrecarga de métodos en una clase de POO?', 2, 4, 14, 10, 71, 'Heredar propiedades y comportamientos de una clase padre.', 'Múltiples métodos con el mismo nombre pero con diferentes parámetros.', 'Ocultar las variables y proporcionar una interfaz para acceder a ellos.', 'Crear múltiples instancias de sí misma.', 'B'),
(71, '¿Cuál de las siguientes palabras clave se utiliza para heredar de una clase en C++?', 1, 4, 2, 0, 0, 'class', 'extend', 'inherit', 'derive', 'D'),
(72, '¿Cuál afirmación sobre las clases abstractas en POO es correcta?', 2, 4, 15, 8, 53, 'Puede tener métodos abstractos y métodos con implementación.', 'No puede tener constructores.', 'No puede ser heredada.', 'Solo puede tener métodos abstractos.', 'A'),
(73, '¿Cuál de las siguientes palabras clave se utiliza para heredar de una clase en Python?', 2, 4, 14, 12, 86, 'class', 'extend', 'inherit', 'derive', 'B'),
(74, '¿Qué significa CSS?', 2, 5, 15, 9, 60, 'Cascading Style Sheets', 'Creative Style Solutions', 'Code Styling Syntax', 'Coded Style System', 'A'),
(75, '¿Cuál es la forma de aplicar estilos CSS?', 2, 5, 15, 7, 47, 'Utilizando el atributo \"style\" en la etiqueta HTML.', 'Creando una etiqueta <style> en el documento HTML.', 'Enlazando un archivo externo CSS.', 'Todas las anteriores.', 'D'),
(76, '¿Cuál de los siguientes selectores CSS selecciona un elemento con el id \"myElement\"?', 2, 5, 14, 11, 79, '#myElement', '.myElement', 'myElement', '*myElement', 'A'),
(77, '¿Cuál de los siguientes selectores CSS selecciona todos los elementos <p> dentro de un <div>?', 2, 5, 15, 10, 67, 'div p', 'p div', '.p div', '#div p', 'A'),
(78, '¿Cuál de los siguientes valores representa el color blanco en RGB?', 2, 5, 15, 9, 60, '#ffffff', '#000000', '#ff0000', '#00ff00', 'A'),
(79, '¿Cuál propiedad CSS se utiliza para definir el tamaño de fuente?', 2, 5, 15, 10, 67, 'font-size', 'font-family', 'font-weight', 'font-color', 'A'),
(80, '¿Cuál propiedad CSS se utiliza para aplicar un color de fondo a un elemento?', 2, 5, 15, 11, 79, 'background-color', 'color', 'border-color', 'text-color', 'A'),
(81, '¿Cuál propiedad CSS se utiliza para establecer el margen derecho de un elemento?', 2, 5, 15, 8, 53, 'margin-right', 'margin-left', 'margin-top', 'margin-bottom', 'A'),
(82, '¿Cuál propiedad CSS se utiliza para alinear un elemento al centro horizontalmente?', 2, 5, 15, 7, 47, 'text-align: center', 'text-align: left', 'text-align: right', 'text-align: justify', 'A'),
(83, '¿Cuál propiedad CSS se utiliza para crear una sombra alrededor de un elemento?', 2, 5, 14, 10, 71, 'box-shadow', 'text-shadow', 'border-shadow', 'element-shadow', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `descripcion`) VALUES
(0, 'No_validado'),
(1, 'Administrador'),
(2, 'Editor'),
(3, 'Jugador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `Nombre_completo` varchar(30) NOT NULL,
  `Fecha_nacimiento` date NOT NULL,
  `Genero` varchar(30) NOT NULL,
  `idPais` int(30) NOT NULL,
  `lat` decimal(30,20) NOT NULL DEFAULT -34.67001600000000000000,
  `lng` decimal(30,20) NOT NULL DEFAULT -58.56227200000000000000,
  `Mail` varchar(255) NOT NULL,
  `Nombre_usuario` varchar(30) NOT NULL,
  `Foto_perfil` varchar(30) DEFAULT NULL,
  `Id_rol` int(11) NOT NULL,
  `Hash` varchar(255) NOT NULL,
  `contrasenia_hash` varchar(255) NOT NULL,
  `Puntaje_max` varchar(255) NOT NULL,
  `nivel` int(11) NOT NULL,
  `cant_respondidas` int(11) NOT NULL,
  `cant_acertadas` int(11) NOT NULL,
  `Fecha_registro` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `Nombre_completo`, `Fecha_nacimiento`, `Genero`, `idPais`, `lat`, `lng`, `Mail`, `Nombre_usuario`, `Foto_perfil`, `Id_rol`, `Hash`, `contrasenia_hash`, `Puntaje_max`, `nivel`, `cant_respondidas`, `cant_acertadas`, `Fecha_registro`) VALUES
(12, 'Marianita Aquino', '2001-03-23', 'Femenino', 1, 0.00000000000000000000, 0.00000000000000000000, 'maraquino@gmail.com', 'Mar', NULL, 3, '7ce6b2286a5396e614b8484105d277e0', '81dc9bdb52d04dc20036dbd8313ed055', '7', 62, 35, 21, '2023-05-18'),
(80, 'Hernan Fittipaldi', '1996-09-17', 'Masculino', 1, -34.69891451120487000000, -58.50764973161350500000, 'fittipaldi.h@gmail.com', 'Fitti', 'Ciro.jpg', 3, 'c2dfb0b48d36edab65407c6a074a5170', '81dc9bdb52d04dc20036dbd8313ed055', '2', 59, 1357, 806, '2023-04-20'),
(82, 'Admin', '2000-01-01', 'No especificar', 1, -37.11248696198316600000, -56.85141338520986000000, 'admin-esperoquenoexista@pregunton.ar', 'admin', NULL, 1, '56de15ff97c9bce1b769fc2c783bc834', '81dc9bdb52d04dc20036dbd8313ed055', '', 0, 0, 0, '2023-06-25'),
(83, 'Editor', '2000-01-01', 'No especificar', 1, -32.95088252473996000000, -60.70188254502038000000, 'editor-esperoquenoexista@pregunton.ar', 'Editor', NULL, 2, 'a1d59b3bbdcc7dd1e221ad60e7b65395', '81dc9bdb52d04dc20036dbd8313ed055', '', 0, 0, 0, '2023-06-25'),
(93, 'Camila', '2010-04-05', 'No especificar', 5, 19.68459217253188600000, -98.93644009210087000000, 'camidemexico@gmail.com', 'Cami', NULL, 3, '8196f2093b03662e000dcf164cdfbc92', '81dc9bdb52d04dc20036dbd8313ed055', '', 50, 2, 1, '2023-06-25'),
(94, 'Natanael', '1945-08-09', 'Masculino', 4, 6.24880152730377700000, -75.56819753287763000000, 'natadecolombia@gmail.com', 'Nata', NULL, 3, '410c3a33ba6a196593f2871afd34d9b5', '81dc9bdb52d04dc20036dbd8313ed055', '', 0, 0, 0, '2023-06-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_pregunta`
--

CREATE TABLE `usuario_pregunta` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_pregunta`
--

INSERT INTO `usuario_pregunta` (`id`, `id_usuario`, `id_pregunta`) VALUES
(525, 37, 8),
(526, 37, 2),
(537, 58, 9),
(538, 58, 3),
(539, 58, 4),
(540, 58, 7),
(541, 58, 5),
(542, 58, 2),
(543, 58, 6),
(544, 58, 1),
(675, 22, 6),
(677, 78, 2),
(678, 78, 9),
(679, 78, 7),
(680, 78, 3),
(775, 0, 4),
(1288, 12, 3),
(1289, 12, 4),
(1290, 12, 5),
(1291, 12, 6),
(1292, 12, 9),
(1293, 12, 1),
(1294, 12, 2),
(1295, 12, 8),
(1397, 84, 7),
(1398, 84, 10),
(1414, 84, 5),
(1415, 84, 6),
(1416, 84, 2),
(1417, 84, 3),
(1418, 84, 8),
(1472, 12, 10),
(1473, 84, 9),
(1474, 84, 4),
(1475, 84, 1),
(2078, 80, 9),
(2079, 80, 61),
(2080, 80, 7),
(2081, 80, 77),
(2082, 80, 55),
(2083, 80, 48),
(2084, 80, 66),
(2085, 80, 6),
(2086, 80, 10),
(2087, 80, 49),
(2088, 80, 64),
(2089, 80, 1),
(2090, 80, 82),
(2091, 80, 81),
(2092, 80, 75),
(2093, 80, 3),
(2094, 80, 5),
(2095, 80, 79),
(2096, 80, 74),
(2097, 80, 60),
(2098, 80, 44),
(2099, 80, 58),
(2100, 80, 8),
(2101, 80, 2),
(2102, 80, 51),
(2103, 80, 57),
(2104, 80, 68),
(2105, 80, 72),
(2106, 80, 52),
(2107, 80, 67),
(2108, 80, 4),
(2109, 80, 78),
(2110, 80, 65),
(2111, 80, 47),
(2112, 80, 45),
(2113, 80, 59),
(2114, 80, 80),
(2115, 93, 53),
(2116, 93, 71);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_pregunta`
--
ALTER TABLE `estado_pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Mail` (`Mail`),
  ADD KEY `idPais` (`idPais`),
  ADD KEY `Id_rol` (`Id_rol`);

--
-- Indices de la tabla `usuario_pregunta`
--
ALTER TABLE `usuario_pregunta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estado_pregunta`
--
ALTER TABLE `estado_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `usuario_pregunta`
--
ALTER TABLE `usuario_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2117;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `pregunta_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado_pregunta` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idPais`) REFERENCES `pais` (`id`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`Id_rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
