-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2024 a las 19:06:53
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
-- Base de datos: `distribuidos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contraseña`) VALUES
(1, 'gonzales', 'gonzales', NULL),
(2, 'daniel', 'gonzd6619@gmail.com', '$2y$10$08EDGwnirYD50b0y8T7HbuNxKCuf7pp5jW8eGj6bg6g8Sew.EhTFy'),
(3, 'jhon', 'jhonxshinobu@gmail.com', '$2y$10$JAyJ9bIITX/qLk9q7jbM.ei5z0DNLlbn4Y/O2srCgX4pf7sHsjdr2'),
(4, 'rene', 'jhoncristhiangonzales@gmail.com', '$2y$10$hfTIVqQz/y.AKdkEb57dhOp0SJU7vEKKgGaAsHYIqMty.hhLHokiO'),
(5, 'teodocia', 'gonzd6619@gmail.com', '$2y$10$nak6.pTp0mWqryD1npC4fenZkxmXKM/aCDtZcJHrGDkIAu6QuARBG'),
(6, 'nani', 'joel1234@gmail.com', '$2y$10$z0.U58BP1FE2DfhIJrvX3u4FsNclf1icfVrKKJbEP8UdfVsvTLpHW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
