-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-10-2024 a las 17:20:31
-- Versión del servidor: 10.8.8-MariaDB-1:10.8.8+maria~ubu2204
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_superheroes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `superheroes`
--

CREATE TABLE `superheroes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `velocidad` int(11) DEFAULT 5,
  `evolucion` varchar(15) NOT NULL DEFAULT 'Principiante'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `superheroes`
--

INSERT INTO `superheroes` (`id`, `nombre`, `created_at`, `updated_at`, `velocidad`, `evolucion`) VALUES
(30, 'La Masa', '2021-01-13 19:59:43', '0000-00-00 00:00:00', 3, 'Principiante'),
(83, 'Mafalda', '2022-01-11 07:58:23', '0000-00-00 00:00:00', 5, 'Principiante'),
(93, 'Superman', '2022-01-12 09:07:05', '2022-11-30 10:17:35', 100, 'Principiante');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `superheroes`
--
ALTER TABLE `superheroes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_evolucion` (`evolucion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `superheroes`
--
ALTER TABLE `superheroes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `superheroes`
--
ALTER TABLE `superheroes`
  ADD CONSTRAINT `fk_evolucion` FOREIGN KEY (`evolucion`) REFERENCES `evolucion` (`evolucion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
