-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2023 a las 07:17:32
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
  `puntaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `id_usuario`, `puntaje`) VALUES
(15, 37, 2),
(16, 37, 3),
(17, 12, 7),
(18, 37, 0),
(19, 37, 0),
(40, 37, 0),
(41, 37, 2),
(42, 37, 0),
(43, 37, 8),
(44, 37, 0),
(45, 37, 6),
(46, 37, 0),
(47, 37, 1),
(48, 58, 1),
(49, 58, 4),
(50, 58, 0),
(51, 58, 4),
(52, 40, 9),
(53, 22, 4),
(54, 22, 0),
(55, 22, 2),
(56, 22, 2),
(57, 22, 3),
(58, 22, 1),
(59, 22, 1),
(60, 22, 0),
(61, 22, 3),
(62, 22, 3),
(63, 22, 2),
(64, 22, 2),
(65, 22, 0),
(66, 22, 0),
(67, 22, 1),
(68, 22, 5),
(69, 22, 1),
(70, 22, 1),
(71, 22, 3),
(72, 22, 3),
(73, 22, 0),
(74, 22, 1),
(75, 22, 4),
(76, 22, 0),
(77, 22, 1),
(78, 22, 2),
(79, 22, 0),
(80, 22, 2),
(81, 22, 1),
(82, 22, 1),
(83, 22, 0),
(84, 22, 5),
(85, 22, 2),
(86, 22, 3),
(87, 22, 1),
(88, 22, 2),
(89, 22, 2),
(90, 22, 3),
(91, 22, 2),
(92, 22, 2),
(93, 22, 0),
(94, 22, 2),
(95, 22, 2),
(96, 22, 0),
(97, 12, 1),
(98, 12, 0),
(99, 12, 2),
(100, 12, 1),
(101, 12, 1),
(102, 12, 6),
(103, 12, 5),
(104, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_respuesta` int(11) NOT NULL,
  `veces_mostrada` int(11) NOT NULL,
  `veces_correcta` int(11) NOT NULL,
  `porc_correc` int(11) NOT NULL,
  `opcionA` varchar(255) DEFAULT NULL,
  `opcionB` varchar(255) DEFAULT NULL,
  `opcionC` varchar(255) DEFAULT NULL,
  `opcionD` varchar(255) DEFAULT NULL,
  `resp_correcta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `estado`, `id_partida`, `id_categoria`, `id_respuesta`, `veces_mostrada`, `veces_correcta`, `porc_correc`, `opcionA`, `opcionB`, `opcionC`, `opcionD`, `resp_correcta`) VALUES
(1, '¿Cuál es el elemento químico más abundante en el universo?', 0, 0, 0, 2, 41, 17, 41, 'Hidrógeno', 'Oxígeno', 'Carbono', 'Hierro', 'A'),
(2, '¿Cuál es el río más largo del mundo?', 0, 0, 0, 3, 43, 27, 63, 'Amazonas', 'Nilo', 'Yangtsé', 'Misisipi', 'B'),
(3, '¿Cuál es la capital de Australia?', 0, 0, 0, 4, 43, 19, 44, 'Sídney', 'Melbourne', 'Brisbane', 'Canberra', 'D'),
(4, '¿Cuál es el planeta más grande del sistema solar?', 0, 0, 0, 5, 42, 22, 52, 'Mercurio', 'Venus', 'Júpiter', 'Marte', 'C'),
(5, '¿Cuál es la montaña más alta del mundo?', 0, 0, 0, 6, 42, 23, 55, 'Mont Blanc', 'K2', 'Everest', 'Aconcagua', 'C'),
(6, '¿Cuál es el país más poblado del mundo?', 0, 0, 0, 7, 41, 18, 44, 'Estados Unidos', 'China', 'India', 'Brasil', 'B'),
(7, '¿Cuál es el símbolo químico del oro?', 0, 0, 0, 8, 40, 24, 60, 'Au', 'Ag', 'Fe', 'Hg', 'A'),
(8, '¿Cuál es el océano más grande del mundo?', 0, 0, 0, 9, 43, 24, 56, 'Océano Atlántico\n', 'Océano Pacífico', 'Océano Índico\n', 'Océano Ártico\n', 'B'),
(9, '¿Cuál es el animal terrestre más grande del mundo?', 0, 0, 0, 10, 40, 23, 58, 'Elefante africano', 'Rinoceronte blanco\n', 'Jirafa', 'Oso polar\n', 'A'),
(10, '¿Cuál es el compuesto químico principal que constituye la atmósfera terrestre?', 0, 0, 0, 11, 46, 16, 36, 'Nitrógeno', 'Oxígeno\n', 'Dióxido de carbono\n', 'Argón', 'A');

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
  `Mail` varchar(30) NOT NULL,
  `Nombre_usuario` varchar(30) NOT NULL,
  `Foto_perfil` varchar(30) NOT NULL,
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
(12, 'Marianita Aquino', '2001-03-23', 'Femenino', 1, 0.00000000000000000000, 0.00000000000000000000, 'maraquino@gmail.com', 'Mar', '', 3, '7ce6b2286a5396e614b8484105d277e0', '81dc9bdb52d04dc20036dbd8313ed055', '7', 60, 59, 35),
(73, 'Hernan', '1996-09-17', 'Masculino', 1, 0.00000000000000000000, 0.00000000000000000000, 'fittipaldi.h@gmail.com', 'Fitti', 'herni.jpg', 3, '9808b7f2d20818aaa41cca235dcfb8f8', '81dc9bdb52d04dc20036dbd8313ed055', '', 0, 2, 0);

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
(713, 73, 8),
(714, 73, 3),
(720, 12, 1),
(721, 12, 5),
(722, 12, 2),
(723, 12, 8),
(724, 12, 7),
(725, 12, 3),
(726, 12, 4),
(727, 12, 6),
(728, 12, 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadistica`
--
ALTER TABLE `estadistica`
  ADD PRIMARY KEY (`Id`);

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
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `usuario_pregunta`
--
ALTER TABLE `usuario_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=729;

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
