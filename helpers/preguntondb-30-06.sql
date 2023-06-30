-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2023 a las 07:09:37
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
(3, 'REPORTADA');

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
(450, 80, 4, '2023-06-30 04:37:26'),
(451, 80, 2, '2023-06-30 04:43:39'),
(452, 80, 0, '2023-06-30 04:43:56'),
(453, 80, 8, '2023-06-30 04:44:27'),
(454, 80, 1, '2023-06-30 04:44:56'),
(455, 94, 1, '2023-06-30 04:50:58'),
(456, 94, 2, '2023-06-30 04:51:12'),
(457, 94, 2, '2023-06-30 04:51:28'),
(458, 93, 2, '2023-06-30 04:51:53'),
(459, 93, 4, '2023-06-30 04:52:14'),
(460, 12, 2, '2023-06-30 04:53:45'),
(461, 12, 2, '2023-06-30 04:53:54'),
(462, 12, 9, '2023-06-30 04:54:28');

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
  `resp_correcta` varchar(255) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `descripcion`, `id_estado`, `id_categoria`, `veces_mostrada`, `veces_correcta`, `porc_correc`, `opcionA`, `opcionB`, `opcionC`, `opcionD`, `resp_correcta`, `fecha_creacion`) VALUES
(1, '¿Cuál es el elemento químico más abundante en el universo?', 2, 1, 5, 2, 40, 'Hidrógeno', 'Oxígeno', 'Carbono', 'Hierro', 'A', '2023-06-26'),
(2, '¿Cuál es el río más largo del mundo?', 2, 1, 5, 3, 60, 'Amazonas', 'Nilo', 'Yangtsé', 'Misisipi', 'B', '2023-06-26'),
(3, '¿Cuál es la capital de Australia?', 2, 1, 6, 2, 33, 'Sídney', 'Melbourne', 'Brisbane', 'Canberra', 'D', '2023-06-26'),
(4, '¿Cuál es el planeta más grande del sistema solar?', 2, 1, 5, 2, 40, 'Mercurio', 'Venus', 'Júpiter', 'Marte', 'C', '2023-06-26'),
(5, '¿Cuál es la montaña más alta del mundo?', 2, 1, 5, 2, 40, 'Mont Blanc', 'K2', 'Everest', 'Aconcagua', 'C', '2023-06-26'),
(6, '¿Cuál es el país más poblado del mundo?', 2, 1, 5, 2, 40, 'Estados Unidos', 'China', 'India', 'Brasil', 'B', '2023-06-26'),
(7, '¿Cuál es el símbolo químico del oro?', 2, 1, 5, 2, 40, 'Au', 'Ag', 'Fe', 'Hg', 'A', '2023-06-26'),
(8, '¿Cuál es el océano más grande del mundo?', 2, 1, 6, 2, 33, 'Atlántico', 'Pacífico', 'Índico', 'Ártico', 'B', '2023-06-26'),
(9, '¿Cuál es el animal terrestre más grande del mundo?', 2, 1, 7, 3, 43, 'Jirafa', 'Rinoceronte blanco', 'Elefante africano', 'Oso polar', 'C', '2023-06-26'),
(10, '¿Cuál es el compuesto químico principal que constituye la atmósfera terrestre?', 2, 1, 7, 3, 43, 'Nitrógeno', 'Oxígeno\n', 'Dióxido de carbono\n', 'Argón', 'A', '2023-06-26'),
(44, '¿Qué significa PHP?', 2, 2, 7, 4, 57, 'Hypertext Preprocessor', 'Personal Home Page', 'Pretext Hypertext Processor', 'Hypertext Processor', 'A', '2023-06-26'),
(45, '¿Cuál es el operador utilizado para concatenar cadenas en PHP?', 2, 2, 6, 2, 33, '+', '&&', '.', ',', 'C', '2023-06-26'),
(46, '¿Cuál es la forma correcta de comentar una línea en PHP?', 2, 2, 5, 3, 60, '/* This is a comment */', '# This is a comment', '// This is a comment', '-- This is a comment', 'C', '2023-06-26'),
(47, '¿Cuál es el resultado de la expresión \"3\" + 2 en PHP?', 2, 2, 5, 2, 40, '5', '32', 'Error', 'NaN', 'A', '2023-06-26'),
(48, '¿Cuál es la función utilizada para obtener la longitud de una cadena en PHP?', 2, 2, 5, 2, 40, 'length()', 'size()', 'strlen()', 'count()', 'C', '2023-06-26'),
(49, '¿Cuál es el símbolo utilizado para acceder a propiedades de un objeto en PHP?', 2, 2, 5, 2, 40, '.', '->', '::', '/', 'B', '2023-06-26'),
(51, '¿Cuál es la función utilizada para obtener la fecha y hora actual en PHP?', 2, 2, 8, 2, 25, 'now()', 'currentDateTime()', 'getDate()', 'date()', 'D', '2023-06-26'),
(52, '¿Cuál es la forma correcta de declarar una variable en PHP?', 2, 2, 4, 2, 50, '$var = 5;', 'var = 5;', 'variable = 5;', '5 = $var;', 'A', '2023-06-26'),
(53, '¿Cuál es la función utilizada para redirigir a otra página en PHP?', 2, 2, 6, 3, 50, 'navigateTo()', 'header()', 'redirect()', 'goTo()', 'B', '2023-06-26'),
(54, '¿Qué significa SQL?', 2, 3, 5, 4, 80, 'Structured Query Language', 'Simple Query Language', 'Sequential Query Language', 'Structured Question Language', 'A', '2023-06-26'),
(55, '¿Cuál es el comando utilizado para crear una nueva tabla en MySQL?', 2, 3, 6, 4, 67, 'CREATE TABLE', 'ADD TABLE', 'NEW TABLE', 'INSERT TABLE', 'A', '2023-06-26'),
(56, '¿Cuál es el comando utilizado para insertar datos en una tabla en MySQL?', 2, 3, 8, 2, 25, 'ADD', 'INSERT', 'CREATE', 'UPDATE', 'B', '2023-06-26'),
(57, '¿Cuál es el operador utilizado para combinar múltiples condiciones en una consulta WHERE en MySQL?', 2, 3, 5, 3, 60, 'AND', 'OR', 'NOT', 'XOR', 'A', '2023-06-26'),
(58, '¿Cuál es la función utilizada para obtener el número de registros en una tabla en MySQL?', 2, 3, 7, 6, 86, 'COUNT()', 'SUM()', 'MAX()', 'MIN()', 'A', '2023-06-26'),
(59, '¿Cuál es el comando utilizado para eliminar una tabla en MySQL?', 2, 3, 5, 2, 40, 'DROP TABLE', 'DELETE TABLE', 'REMOVE TABLE', 'ERASE TABLE', 'A', '2023-06-26'),
(60, '¿Cuál es el comando utilizado para actualizar datos en una tabla en MySQL?', 2, 3, 6, 3, 50, 'UPDATE', 'ALTER', 'MODIFY', 'CHANGE', 'A', '2023-06-26'),
(61, '¿Cuál es el tipo de dato utilizado para almacenar valores monetarios en MySQL?', 2, 3, 7, 4, 67, 'INT', 'FLOAT', 'CHAR', 'DECIMAL', 'D', '2023-06-26'),
(62, '¿Cuál es el comando utilizado para seleccionar datos de una tabla en MySQL?', 2, 3, 6, 3, 50, 'SELECT', 'FETCH', 'GET', 'RETRIEVE', 'A', '2023-06-26'),
(63, '¿Cuál es la cláusula utilizada para filtrar registros en una consulta SELECT en MySQL?', 2, 3, 5, 3, 60, 'WHERE', 'FROM', 'JOIN', 'GROUP BY', 'A', '2023-06-26'),
(64, '¿Qué es la herencia en POO?', 2, 4, 6, 2, 33, 'Crear una nueva clase a partir de una clase existente.', 'Eliminar una clase.', 'Cambiar el nombre de una clase.', 'Dividir una clase en múltiples subclases.', 'A', '2023-06-26'),
(65, '¿Cuál palabra clave se utiliza para crear una instancia de una clase en Java?', 2, 4, 6, 5, 83, 'new', 'instance', 'create', 'instantiate', 'A', '2023-06-26'),
(66, '¿Cuál conceptos está asociado con la encapsulación en POO?', 2, 4, 6, 3, 50, 'Limitar el acceso de las variables y acceder mediante métodos.', 'Crear múltiples instancias de una clase.', 'Modificar una clase durante la ejecución.', 'Establecer una relación de parentesco entre clases.', 'A', '2023-06-26'),
(67, '¿Qué es el polimorfismo en POO?', 2, 4, 4, 2, 50, 'Que una clase herede comportamientos de otra.', 'Que una clase tenga múltiples métodos con el mismo nombre pero con diferentes implementaciones.', 'Que una clase herede una interfaz e implemente sus métodos.', 'Todas las anteriores son correctas.', 'B', '2023-06-26'),
(68, '¿Cuál de los siguientes conceptos está asociado con la abstracción en POO?', 2, 4, 8, 1, 13, 'Representar una idea o concepto mediante una clase.', 'Crear múltiples instancias de una clase.', 'Modificar el comportamiento de una clase en tiempo de ejecución.', 'Establecer una relación de parentesco entre clases.', 'A', '2023-06-26'),
(69, '¿Cuál de las siguientes afirmaciones sobre las interfaces en programación orientada a objetos es correcta?', 2, 4, 4, 1, 25, 'Una interfaz define un contrato que una clase puede implementar.', 'Una interfaz es una clase abstracta.', 'Una interfaz solo puede contener métodos abstractos.', 'Una clase puede implementar múltiples interfaces.', 'D', '2023-06-26'),
(70, '¿Qué es la sobrecarga de métodos en una clase de POO?', 2, 4, 8, 3, 38, 'Heredar propiedades y comportamientos de una clase padre.', 'Múltiples métodos con el mismo nombre pero con diferentes parámetros.', 'Ocultar las variables y proporcionar una interfaz para acceder a ellos.', 'Crear múltiples instancias de sí misma.', 'B', '2023-06-26'),
(72, '¿Cuál afirmación sobre las clases abstractas en POO es correcta?', 2, 4, 5, 3, 60, 'Puede tener métodos abstractos y métodos con implementación.', 'No puede tener constructores.', 'No puede ser heredada.', 'Solo puede tener métodos abstractos.', 'A', '2023-06-26'),
(74, '¿Qué significa CSS?', 2, 5, 6, 3, 50, 'Cascading Style Sheets', 'Creative Style Solutions', 'Code Styling Syntax', 'Coded Style System', 'A', '2023-06-26'),
(75, '¿Cuál es la forma de aplicar estilos CSS?', 2, 5, 6, 2, 33, 'Utilizando el atributo \"style\" en la etiqueta HTML.', 'Creando una etiqueta <style> en el documento HTML.', 'Enlazando un archivo externo CSS.', 'Todas las anteriores.', 'D', '2023-06-26'),
(76, '¿Cuál de los siguientes selectores CSS selecciona un elemento con el id \"myElement\"?', 2, 5, 7, 5, 71, '#myElement', '.myElement', 'myElement', '*myElement', 'A', '2023-06-26'),
(77, '¿Cuál de los siguientes selectores CSS selecciona todos los elementos <p> dentro de un <div>?', 2, 5, 6, 3, 50, 'div p', 'p div', '.p div', '#div p', 'A', '2023-06-26'),
(78, '¿Cuál de los siguientes valores representa el color blanco en RGB?', 2, 5, 8, 3, 38, '#ffffff', '#000000', '#ff0000', '#00ff00', 'A', '2023-06-26'),
(79, '¿Cuál propiedad CSS se utiliza para definir el tamaño de fuente?', 2, 5, 5, 2, 40, 'font-size', 'font-family', 'font-weight', 'font-color', 'A', '2023-06-26'),
(80, '¿Cuál propiedad CSS se utiliza para aplicar un color de fondo a un elemento?', 2, 5, 7, 3, 43, 'background-color', 'color', 'border-color', 'text-color', 'A', '2023-06-26'),
(81, '¿Cuál propiedad CSS se utiliza para establecer el margen derecho de un elemento?', 2, 5, 5, 2, 40, 'margin-right', 'margin-left', 'margin-top', 'margin-bottom', 'A', '2023-06-26'),
(82, '¿Cuál propiedad CSS se utiliza para alinear un elemento al centro horizontalmente?', 2, 5, 5, 2, 40, 'text-align: center', 'text-align: left', 'text-align: right', 'text-align: justify', 'A', '2023-06-26'),
(83, '¿Cuál propiedad CSS se utiliza para crear una sombra alrededor de un elemento?', 2, 5, 5, 2, 40, 'box-shadow', 'text-shadow', 'border-shadow', 'element-shadow', 'A', '2023-06-26');

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
(12, 'Marianita Aquino', '2001-03-23', 'Femenino', 1, 0.00000000000000000000, 0.00000000000000000000, 'maraquino@gmail.com', 'Mar', NULL, 3, '7ce6b2286a5396e614b8484105d277e0', '81dc9bdb52d04dc20036dbd8313ed055', '9', 81, 16, 13, '2023-05-18'),
(80, 'Hernan Fittipaldi', '1996-09-17', 'Masculino', 1, -34.69891451120487000000, -58.50764973161350500000, 'fittipaldi.h@gmail.com', 'Fitti', 'Ciro.jpg', 3, 'c2dfb0b48d36edab65407c6a074a5170', '81dc9bdb52d04dc20036dbd8313ed055', '8', 78, 24, 18, '2023-04-20'),
(82, 'Admin', '2000-01-01', 'No especificar', 1, -37.11248696198316600000, -56.85141338520986000000, 'admin@pregunton.com.ar', 'admin', NULL, 1, '56de15ff97c9bce1b769fc2c783bc834', '81dc9bdb52d04dc20036dbd8313ed055', '0', 0, 0, 0, '2023-06-25'),
(83, 'Editor', '2000-01-01', 'No especificar', 1, -32.95088252473996000000, -60.70188254502038000000, 'editor@pregunton.com.ar', 'Editor', NULL, 2, 'a1d59b3bbdcc7dd1e221ad60e7b65395', '81dc9bdb52d04dc20036dbd8313ed055', '0', 0, 0, 0, '2023-06-25'),
(93, 'Camila', '2010-04-05', 'No especificar', 5, 19.68459217253188600000, -98.93644009210087000000, 'camidemexico@gmail.com', 'Cami', NULL, 3, '8196f2093b03662e000dcf164cdfbc92', '81dc9bdb52d04dc20036dbd8313ed055', '4', 75, 8, 6, '2023-06-25'),
(94, 'Norberto', '1945-08-09', 'Masculino', 4, 6.24880152730377700000, -75.56819753287763000000, 'norber_colombia@gmail.com', 'Norber', NULL, 3, '410c3a33ba6a196593f2871afd34d9b5', '81dc9bdb52d04dc20036dbd8313ed055', '2', 63, 8, 5, '2023-06-25');

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
(2430, 80, 65),
(2431, 80, 48),
(2432, 80, 82),
(2433, 80, 10),
(2434, 80, 68),
(2435, 80, 5),
(2436, 80, 3),
(2437, 80, 1),
(2438, 80, 83),
(2439, 80, 75),
(2440, 80, 56),
(2441, 80, 69),
(2442, 80, 4),
(2443, 80, 62),
(2444, 80, 60),
(2445, 80, 51),
(2446, 80, 6),
(2447, 80, 78),
(2448, 80, 49),
(2449, 80, 73),
(2450, 80, 45),
(2451, 80, 80),
(2452, 80, 71),
(2453, 94, 58),
(2454, 94, 56),
(2455, 94, 63),
(2456, 94, 62),
(2457, 94, 69),
(2458, 94, 9),
(2459, 94, 60),
(2460, 94, 71),
(2461, 93, 58),
(2462, 93, 45),
(2463, 93, 68),
(2464, 93, 61),
(2465, 93, 71),
(2466, 93, 51),
(2467, 93, 78),
(2468, 93, 56),
(2469, 12, 58),
(2470, 12, 75),
(2471, 12, 51),
(2472, 12, 55),
(2473, 12, 59),
(2474, 12, 68),
(2475, 12, 76),
(2476, 12, 78),
(2477, 12, 69),
(2478, 12, 56),
(2479, 12, 10),
(2480, 12, 2),
(2481, 12, 80),
(2482, 12, 77),
(2483, 12, 65),
(2484, 12, 70),
(2485, 80, 61);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `usuario_pregunta`
--
ALTER TABLE `usuario_pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2486;

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
