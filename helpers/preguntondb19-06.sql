-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3310
-- Tiempo de generación: 20-06-2023 a las 10:08:54
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
  `descripcion` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `descripcion`, `color`) VALUES
(1, 'GENERAL', 'VERDE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `idPais` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `idPais`, `nombre`) VALUES
(23, 1, 'CABA'),
(24, 1, 'Buenos aires'),
(25, 1, 'Mar del Plata'),
(26, 1, 'Rosario'),
(27, 1, 'Salta'),
(28, 1, 'Mendoza'),
(29, 2, 'La Paz'),
(30, 3, 'Bahia'),
(31, 3, 'Santa Catarina'),
(32, 3, 'Sao Paulo'),
(33, 4, 'Bogota'),
(34, 4, 'Medellin'),
(35, 5, 'Monterrey'),
(36, 5, 'Guadalajara'),
(37, 6, 'Ciudad del este'),
(38, 6, 'Asuncion'),
(39, 7, 'Lima'),
(40, 7, 'Arequipa'),
(41, 8, 'Montevideo'),
(42, 8, 'Colonia de Sacramento'),
(43, 9, 'Caracas'),
(44, 9, 'Maracaibo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadistica`
--

CREATE TABLE `estadistica` (
  `Id` int(11) NOT NULL,
  `cantidad_mostrada` int(11) NOT NULL,
  `cant_correctas` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(164, 80, 0, '2023-06-20 05:36:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_estado` int(11) NOT NULL DEFAULT 0,
  `id_categoria` int(11) DEFAULT NULL,
  `veces_mostrada` int(11) NOT NULL DEFAULT 0,
  `veces_correcta` int(11) NOT NULL DEFAULT 0,
  `porc_correc` int(11) NOT NULL DEFAULT 0,
  `opcionA` varchar(255) DEFAULT NULL,
  `opcionB` varchar(255) DEFAULT NULL,
  `opcionC` varchar(255) DEFAULT NULL,
  `opcionD` varchar(255) DEFAULT NULL,
  `resp_correcta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `id_estado`, `id_categoria`, `veces_mostrada`, `veces_correcta`, `porc_correc`, `opcionA`, `opcionB`, `opcionC`, `opcionD`, `resp_correcta`) VALUES
(1, '¿Cuál es el elemento químico más abundante en el universo?', 3, 0, 95, 45, 48, 'Hidrógeno', 'Oxígeno', 'Carbono', 'Hierro', 'A'),
(2, '¿Cuál es el río más largo del mundo?', 2, 0, 97, 58, 60, 'Amazonas', 'Nilo', 'Yangtsé', 'Misisipi', 'B'),
(3, '¿Cuál es la capital de Australia?', 2, 0, 95, 47, 49, 'Sídney', 'Melbourne', 'Brisbane', 'Canberra', 'D'),
(4, '¿Cuál es el planeta más grande del sistema solar?', 2, 0, 95, 46, 48, 'Mercurio', 'Venus', 'Júpiter', 'Marte', 'C'),
(5, '¿Cuál es la montaña más alta del mundo?', 2, 0, 96, 56, 59, 'Mont Blanc', 'K2', 'Everest', 'Aconcagua', 'C'),
(6, '¿Cuál es el país más poblado del mundo?', 2, 0, 93, 47, 51, 'Estados Unidos', 'China', 'India', 'Brasil', 'B'),
(7, '¿Cuál es el símbolo químico del oro?', 2, 0, 95, 59, 62, 'Au', 'Ag', 'Fe', 'Hg', 'A'),
(8, '¿Cuál es el océano más grande del mundo?', 2, 0, 95, 56, 59, 'Océano Atlántico\n', 'Océano Pacífico', 'Océano Índico\n', 'Océano Ártico\n', 'B'),
(9, '¿Cuál es el animal terrestre más grande del mundo?', 2, 0, 95, 58, 62, 'Elefante africano', 'Rinoceronte blanco\n', 'Jirafa', 'Oso polar\n', 'A'),
(10, '¿Cuál es el compuesto químico principal que constituye la atmósfera terrestre?', 2, 0, 100, 47, 47, 'Nitrógeno', 'Oxígeno\n', 'Dióxido de carbono\n', 'Argón', 'A'),
(37, 'asfasf', 4, 1, 3, 0, 0, 'asd', 'asd', 'asd', 'asd', 'A'),
(38, '', 4, 1, 0, 0, 0, '', '', '', '', 'A'),
(39, 'a', 2, 1, 0, 0, 0, 'a', 'a', 'a', 'a', 'B');

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
  `lat` decimal(30,20) NOT NULL,
  `lng` decimal(30,20) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Nombre_usuario` varchar(30) NOT NULL,
  `Foto_perfil` varchar(30) DEFAULT NULL,
  `Id_rol` int(11) NOT NULL,
  `Hash` varchar(255) NOT NULL,
  `contrasenia_hash` varchar(255) NOT NULL,
  `Puntaje_max` varchar(255) NOT NULL,
  `nivel` int(11) NOT NULL,
  `cant_respondidas` int(11) NOT NULL,
  `cant_acertadas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `Nombre_completo`, `Fecha_nacimiento`, `Genero`, `idPais`, `lat`, `lng`, `Mail`, `Nombre_usuario`, `Foto_perfil`, `Id_rol`, `Hash`, `contrasenia_hash`, `Puntaje_max`, `nivel`, `cant_respondidas`, `cant_acertadas`) VALUES
(12, 'Marianita Aquino', '2001-03-23', 'Femenino', 1, 0.00000000000000000000, 0.00000000000000000000, 'maraquino@gmail.com', 'Mar', '', 3, '7ce6b2286a5396e614b8484105d277e0', '81dc9bdb52d04dc20036dbd8313ed055', '7', 75, 14, 9),
(80, 'Hernan', '1996-09-17', 'Masculino', 1, -34.69891451120487000000, -58.50764973161350500000, 'fittipaldi.h@gmail.com', 'Fitti', '', 3, 'c2dfb0b48d36edab65407c6a074a5170', '81dc9bdb52d04dc20036dbd8313ed055', '3', 57, 581, 330),
(82, 'Admin', '2000-01-01', 'No especificar', 1, -37.11248696198316600000, -56.85141338520986000000, 'admin-esperoquenoexista@pregunton.ar', 'admin', NULL, 1, '56de15ff97c9bce1b769fc2c783bc834', '81dc9bdb52d04dc20036dbd8313ed055', '', 0, 0, 0),
(83, 'Editor', '2000-01-01', 'No especificar', 1, -32.95088252473996000000, -60.70188254502038000000, 'editor-esperoquenoexista@pregunton.ar', 'Editor', NULL, 2, 'a1d59b3bbdcc7dd1e221ad60e7b65395', '81dc9bdb52d04dc20036dbd8313ed055', '', 0, 0, 0);

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
(721, 12, 10),
(722, 12, 7),
(723, 12, 5),
(724, 12, 1),
(775, 0, 4),
(1260, 80, 7),
(1261, 80, 5),
(1262, 80, 8),
(1263, 80, 10),
(1264, 80, 9),
(1265, 80, 2),
(1266, 80, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadistica`
--
ALTER TABLE `estadistica`
  ADD PRIMARY KEY (`Id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `usuario_pregunta`
--
ALTER TABLE `usuario_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1267;

--
-- Restricciones para tablas volcadas
--

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
