-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-09-2026 a las 02:44:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alumnos`
--
CREATE DATABASE IF NOT EXISTS `alumnos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `alumnos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `idEstado` int(11) NOT NULL,
  `est_nombre` varchar(20) NOT NULL,
  `est_activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstado`, `est_nombre`, `est_activo`) VALUES
(1, 'En curso', 1),
(2, 'Regular', 1),
(3, 'Aprobado', 1),
(4, 'Promocionado', 1),
(5, 'Equivalencia', 1),
(6, 'Libre', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE `materias` (
  `idMateria` int(11) NOT NULL,
  `mat_nombre` varchar(60) NOT NULL,
  `mat_anio` int(11) NOT NULL,
  `mat_activo` tinyint(1) NOT NULL DEFAULT 1,
  `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idMateria`, `mat_nombre`, `mat_anio`, `mat_activo`, `idEstado`) VALUES
(1, 'Elementos de Programacion', 1, 0, 1),
(2, 'Matematica para informatica', 1, 1, 1),
(3, 'Analisis Matematico', 1, 1, 3),
(4, 'Programacion', 1, 1, 1),
(5, 'Algebra Lineal y Geometria Analitica', 1, 1, 1),
(6, 'PRUEBA', 3, 0, 3),
(7, '7', 0, 0, 5),
(8, 'PRUEBA22222', 1, 0, 6),
(9, 'aaa', 5, 0, 1),
(10, 'asdefg', 5, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `address`, `contact`, `email`, `password`, `rol`) VALUES
(1, 'Juan', 'Pérez', 'Av. Ejemplo 123', '387 555-1111', 'juan@gmail.com', '$2y$12$2buxK2UpA65e2aj4Wj.aQe/z0g6CAGpFr4zpZwximg1/9McRx96u6', 'usuario'),
(2, 'María', 'Gómez', 'Calle Principal 456', '387 555-2222', 'admin@gmail.com', '$2y$12$2buxK2UpA65e2aj4Wj.aQe/z0g6CAGpFr4zpZwximg1/9McRx96u6', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`idMateria`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `idMateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
