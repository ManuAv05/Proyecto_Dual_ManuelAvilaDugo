-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-03-2025 a las 09:31:56
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
-- Base de datos: `proyecto_catálogo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categría`
--

CREATE TABLE `categría` (
  `ID_Categoria` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categría`
--

INSERT INTO `categría` (`ID_Categoria`, `Nombre`, `Descripcion`) VALUES
(3, 'Perfume Nicho', 'Casas de perfumes que solo se dedican a vender perfumes'),
(4, 'Perfume de Diseñador', 'son perfumes diseñados para gustar, fáciles de llevar y que siguen una tendencia en común');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diseñador`
--

CREATE TABLE `diseñador` (
  `ID_Diseñador` int(11) NOT NULL,
  `Nombre_Marca` varchar(50) NOT NULL,
  `Descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `diseñador`
--

INSERT INTO `diseñador` (`ID_Diseñador`, `Nombre_Marca`, `Descripcion`) VALUES
(4, 'Lorenzo Pazzaglia', 'Diseñador Italiano'),
(5, 'Initio', 'Casa de perfumes francesa'),
(6, 'Jean Paul Gaultier\'s', 'Perfumes tipicos por la forma de estos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_Producto` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripción` varchar(250) NOT NULL,
  `Precio` int(5) NOT NULL,
  `ID_Categoria` int(11) NOT NULL,
  `ID_Diseñador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_Producto`, `Nombre`, `Descripción`, `Precio`, `ID_Categoria`, `ID_Diseñador`) VALUES
(16, 'Summer Hummer', 'Perufme de verano ', 145, 3, 4),
(17, 'Le male elixir', 'Perfume iconico', 80, 4, 6),
(18, 'Le male elixir', 'Perfume iconico', 80, 4, 6),
(27, 'Van Py Rhum', 'Perfume de mojito', 145, 3, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categría`
--
ALTER TABLE `categría`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indices de la tabla `diseñador`
--
ALTER TABLE `diseñador`
  ADD PRIMARY KEY (`ID_Diseñador`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `fk_categoria` (`ID_Categoria`),
  ADD KEY `fk_diseñador` (`ID_Diseñador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categría`
--
ALTER TABLE `categría`
  MODIFY `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `diseñador`
--
ALTER TABLE `diseñador`
  MODIFY `ID_Diseñador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`ID_Categoria`) REFERENCES `categría` (`ID_Categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_diseñador` FOREIGN KEY (`ID_Diseñador`) REFERENCES `diseñador` (`ID_Diseñador`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
