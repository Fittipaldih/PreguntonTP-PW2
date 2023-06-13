-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2023 a las 21:18:39
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadistica`
--

CREATE TABLE `estadistica` (
  `Id` int(11) NOT NULL,
  `cantidad_mostrada` int(11) NOT NULL,
  `cant_correctas` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `puntaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `id_usuario`, `puntaje`) VALUES
(15, 37, 2),
(16, 37, 3),
(17, 12, 7),
(18, 37, 0),
(19, 37, 0),
(20, 37, 0),
(21, 37, 0),
(22, 37, 0),
(23, 37, 0),
(24, 37, 0),
(25, 37, 0),
(26, 37, 0),
(27, 37, 0),
(28, 37, 0),
(29, 37, 0),
(30, 37, 0),
(31, 37, 0),
(32, 37, 0),
(33, 37, 0),
(34, 37, 0),
(35, 37, 0),
(36, 37, 0),
(37, 37, 0),
(38, 37, 0),
(39, 37, 0),
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
(51, 58, 4);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `estado`, `id_partida`, `id_categoria`, `id_respuesta`, `veces_mostrada`, `veces_correcta`, `porc_correc`, `opcionA`, `opcionB`, `opcionC`, `opcionD`, `resp_correcta`) VALUES
(1, '¿Cuál es el elemento químico más abundante en el universo?', 0, 0, 0, 2, 23, 6, 26, 'Hidrógeno', 'Oxígeno', 'Carbono', 'Hierro', 'A'),
(2, '¿Cuál es el río más largo del mundo?', 0, 0, 0, 3, 25, 15, 60, 'Amazonas', 'Nilo', 'Yangtsé', 'Misisipi', 'B'),
(3, '¿Cuál es la capital de Australia?', 0, 0, 0, 4, 24, 11, 46, 'Sídney', 'Melbourne', 'Brisbane', 'Canberra', 'D'),
(4, '¿Cuál es el planeta más grande del sistema solar?', 0, 0, 0, 5, 24, 13, 57, 'Mercurio', 'Venus', 'Júpiter', 'Marte', 'C'),
(5, '¿Cuál es la montaña más alta del mundo?', 0, 0, 0, 6, 23, 13, 57, 'Mont Blanc', 'K2', 'Everest', 'Aconcagua', 'C'),
(6, '¿Cuál es el país más poblado del mundo?', 0, 0, 0, 7, 22, 9, 41, 'Estados Unidos', 'China', 'India', 'Brasil', 'B'),
(7, '¿Cuál es el símbolo químico del oro?', 0, 0, 0, 8, 22, 12, 55, 'Au', 'Ag', 'Fe', 'Hg', 'A'),
(8, '¿Cuál es el océano más grande del mundo?', 0, 0, 0, 9, 23, 12, 52, 'Océano Atlántico\n', 'Océano Pacífico', 'Océano Índico\n', 'Océano Ártico\n', 'B'),
(9, '¿Cuál es el animal terrestre más grande del mundo?', 0, 0, 0, 10, 23, 12, 52, 'Elefante africano', 'Rinoceronte blanco\n', 'Jirafa', 'Oso polar\n', 'A'),
(10, '¿Cuál es el compuesto químico principal que constituye la atmósfera terrestre?', 0, 0, 0, 11, 28, 4, 15, 'Nitrógeno', 'Oxígeno\n', 'Dióxido de carbono\n', 'Argón', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(11) UNSIGNED NOT NULL,
  `opcionA` text NOT NULL,
  `opcionB` text NOT NULL,
  `opcionC` text NOT NULL,
  `opcionD` text NOT NULL,
  `resp_correcta` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id`, `opcionA`, `opcionB`, `opcionC`, `opcionD`, `resp_correcta`) VALUES
(2, 'Hidrógeno', 'Oxígeno', 'Carbono', 'Hierro', 'A'),
(3, 'Amazonas', 'Nilo', 'Yangtsé', 'Misisipi', 'B'),
(4, 'Sídney', 'Melbourne', 'Brisbane', 'Canberra', 'D'),
(5, 'Mercurio', 'Venus', 'Júpiter', 'Marte', 'C'),
(6, 'Mont Blanc', 'K2', 'Everest', 'Aconcagua', 'C'),
(7, 'Estados Unidos', 'China', 'India', 'Brasil', 'B'),
(8, 'Au', 'Ag', 'Fe', 'Hg', 'A'),
(9, 'Océano Atlántico', 'Océano Pacífico', 'Océano Índico', 'Océano Ártico', 'B'),
(10, 'Elefante africano', 'Rinoceronte blanco', 'Jirafa', 'Oso polar', 'A'),
(11, 'Nitrógeno', 'Oxígeno', 'Dióxido de carbono', 'Argón', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Pais` varchar(30) NOT NULL,
  `Ciudad` varchar(30) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `Nombre_completo`, `Fecha_nacimiento`, `Genero`, `Pais`, `Ciudad`, `Mail`, `Nombre_usuario`, `Foto_perfil`, `Id_rol`, `Hash`, `contrasenia_hash`, `Puntaje_max`, `nivel`, `cant_respondidas`, `cant_acertadas`) VALUES
(12, 'Marianita Aquino', '2001-03-23', 'Femenino', 'Argentina', 'CABA', 'maraquino@gmail.com', 'Mar', '', 3, '7ce6b2286a5396e614b8484105d277e0', '81dc9bdb52d04dc20036dbd8313ed055', '7', 88, 8, 7),
(22, 'Hernan', '1997-09-17', 'Masculino', 'Argentina', 'La Matanza', 'fittipaldi.h@gmail.com', 'Fitti', '', 3, '2369fed0fc27c3b658ca7cf02274ba89', '81dc9bdb52d04dc20036dbd8313ed055', '0', 0, 0, 0),
(37, 'Lisandro Menu', '2003-01-28', 'Masculino', 'Argentina', 'Santa Rosa', 'lisandro@hotmail.com', 'lisandro', 'charizard_f.gif', 3, '85133e07ba49e25e70d977345ccdaef7', 'e120ea280aa50693d5568d0071456460', '8', 42, 212, 88);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_pregunta`
--

CREATE TABLE `usuario_pregunta` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario_pregunta`
--

INSERT INTO `usuario_pregunta` (`id`, `id_usuario`, `id_pregunta`) VALUES
(431, 12, 4),
(432, 12, 6),
(433, 12, 1),
(434, 12, 3),
(435, 12, 10),
(436, 12, 7),
(437, 12, 2),
(438, 12, 9),
(525, 37, 8),
(526, 37, 2),
(537, 58, 9),
(538, 58, 3),
(539, 58, 4),
(540, 58, 7),
(541, 58, 5),
(542, 58, 2),
(543, 58, 6),
(544, 58, 1);

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
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
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
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuario_pregunta`
--
ALTER TABLE `usuario_pregunta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `usuario_pregunta`
--
ALTER TABLE `usuario_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=545;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
