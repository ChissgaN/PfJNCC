-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2024 a las 09:21:14
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
-- Base de datos: `universidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `materia` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `materia`) VALUES
(1, 'Arte'),
(2, 'Ciencias'),
(3, 'Fisica'),
(4, 'Matematicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'administrador'),
(2, 'maestro'),
(3, 'alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `address` varchar(80) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `materias_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `surname`, `email`, `password`, `address`, `rol_id`, `date`, `materias_id`, `status_id`) VALUES
(3, 'Admin', 'Admin', 'admin@admin', '$2y$10$zpB0XoivJCh6DNZLNGJjE.dxquhieHlIptjzu/hVKyS7bpwAWu3UW', 'ahi mero 2.0', 1, '2023-11-11', NULL, 1),
(5, 'Maestro', 'Maestro', 'maestro@maestro', '$2y$10$p4HyHBRaV04b0UAxTxLE7ezJepneu/nj3rBX94j4/jkk7abiPNGTG', 'ahi mero 2.0', 2, '2023-12-07', 1, 1),
(6, 'Proof', 'Proof', 'proof@edit', '$2y$10$C6Rcu09Whqn5K.GjtpKLBOVSL6hwxfuSjg2/1up89Ktx.mWVC6ZwO', 'En el fin del mundo', 1, '2023-11-11', 2, 1),
(8, 'Alumno', 'Uno', 'alumno@uno', '$2y$10$k3cbF9.PwmaviPL0g01Adu5NlMlajzR6OItHeCrawCx/kvUzTBTdq', 'Xibalba', 3, '2023-12-07', 1, 1),
(9, 'Alumno', 'Dos', 'alumno@dos', '$2y$10$pJpisdKBdFHpKWXJkTEoI.D0ki0rR87CxeA4h4gjRQ5fIq5OTOJo2', 'Sivar', 3, '2023-11-11', 2, 1),
(10, 'Alumno', 'Tres', 'alumno@tres', '$2y$10$Kl/2kq68f0Db.WbIoXqQ4uYBUjBy1kuKEqzRaZkZ8HqQG9Zx8.Vum', 'Ameri', 3, '2023-07-25', 3, 1),
(11, 'Alumno', 'Cuatro', 'alumno@cuatro', '$2y$10$MXLfq2U7GvXjoS08ToPPEOvOuLKsEHqID3HvavSkQjTbHiklV.3Yq', 'asdfgh', 3, '2023-12-25', 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `usuarios_roles_fk` (`rol_id`),
  ADD KEY `usuarios_estados_fk` (`status_id`),
  ADD KEY `usuarios_materias_fk` (`materias_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_estados_fk` FOREIGN KEY (`status_id`) REFERENCES `estados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_materias_fk` FOREIGN KEY (`materias_id`) REFERENCES `materias` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuarios_roles_fk` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
