-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2023 a las 09:54:50
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
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Id` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Editor'),
(3, 'Jugador'),
(4, 'No_validado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `Nombre_completo` varchar(30) NOT NULL,
  `Anio_nacimiento` date NOT NULL,
  `Genero` varchar(30) NOT NULL,
  `Pais` varchar(30) NOT NULL,
  `Ciudad` varchar(30) NOT NULL,
  `Mail` varchar(30) NOT NULL,
  `Nombre_usuario` varchar(30) NOT NULL,
  `Foto_perfil` varchar(30) NOT NULL,
  `Id_rol` int(11) NOT NULL,
  `Hash` varchar(255) NOT NULL,
  `contrasenia_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `Nombre_completo`, `Anio_nacimiento`, `Genero`, `Pais`, `Ciudad`, `Mail`, `Nombre_usuario`, `Foto_perfil`, `Id_rol`, `Hash`, `contrasenia_hash`) VALUES
(1, '', '0000-00-00', '', '', '', '', '', '', 0, '0', ''),
(2, 'Lisandro Menu', '2003-01-28', 'm', 'Argentina', 'Santa Rosa', 'lisandro@pregunton.com', 'lisandroo', '', 1, '0', ''),
(4, 'Lisandro', '2003-01-28', 'Masculino', 'Argentina', 'Santa Rosa', 'lisandro@hotmail.com', 'lisandrooo', 'charizard_f.gif', 0, '$2y$10$2/tnSK.F1bhtToekOFeaZe2QcyMjqM/ES5bKZeKUVnpHmYXtEYMNe', '$2y$10$AslBi7ABmHcaq6R5wEgauOFn/a7SOlEoyTf.uMcZQL5dDArFWQPuK');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
