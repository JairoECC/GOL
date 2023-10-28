-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2023 a las 04:38:12
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `goleadores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `jug_id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `goles` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`jug_id`, `nombre`, `goles`) VALUES
(27, 'Cristiano', 14),
(28, 'Pepe', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador2`
--

CREATE TABLE `jugador2` (
  `jug_id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `asistencia` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugador2`
--

INSERT INTO `jugador2` (`jug_id`, `nombre`, `asistencia`) VALUES
(5, 'Jairo', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador3`
--

CREATE TABLE `jugador3` (
  `jug_id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tar_ama` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugador3`
--

INSERT INTO `jugador3` (`jug_id`, `nombre`, `tar_ama`) VALUES
(5, 'Pepe', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador4`
--

CREATE TABLE `jugador4` (
  `jug_id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tar_roj` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugador4`
--

INSERT INTO `jugador4` (`jug_id`, `nombre`, `tar_roj`) VALUES
(6, 'pepe', 12),
(9, 'kaka', 3),
(10, 'casemiro', 3),
(11, 'walcok', 4),
(15, 'Sanchez', 12),
(16, 'Julio', 4),
(18, 'jairo', 13),
(20, 'lol', 4),
(21, 'jairo', 34),
(23, 'peidj', 12),
(24, 'dsfvsd', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `nombre_usu` varchar(100) DEFAULT NULL,
  `email_usu` varchar(100) DEFAULT NULL,
  `password_usu` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `nombre_usu`, `email_usu`, `password_usu`) VALUES
(1, 'jairo', 'jairo@gmail.com', 'nose'),
(2, 'Pepe', 'pepequinta@ga', 'jajaj');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`jug_id`);

--
-- Indices de la tabla `jugador2`
--
ALTER TABLE `jugador2`
  ADD PRIMARY KEY (`jug_id`);

--
-- Indices de la tabla `jugador3`
--
ALTER TABLE `jugador3`
  ADD PRIMARY KEY (`jug_id`);

--
-- Indices de la tabla `jugador4`
--
ALTER TABLE `jugador4`
  ADD PRIMARY KEY (`jug_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `jug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `jugador2`
--
ALTER TABLE `jugador2`
  MODIFY `jug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `jugador3`
--
ALTER TABLE `jugador3`
  MODIFY `jug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `jugador4`
--
ALTER TABLE `jugador4`
  MODIFY `jug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
