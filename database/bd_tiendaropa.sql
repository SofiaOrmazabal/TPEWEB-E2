-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2022 a las 02:35:10
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
-- Base de datos: `bd_tiendaropa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `namecategory` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id_category`, `namecategory`) VALUES
(7, 'Remera'),
(8, 'Pantalones'),
(9, 'Accesorios'),
(10, 'Sweater');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `size` text NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id_product`, `description`, `price`, `size`, `id_category`) VALUES
(37, 'Top flores', 3450, 'S', 7),
(39, 'Top tul', 5600, 'M', 7),
(40, 'Jogger azul', 8760, 'L', 8),
(42, 'Gorra', 2870, 'U', 9),
(44, 'Sobretodo blanco', 17640, 'L', 10),
(45, 'Sobretodo azul', 17640, 'M', 10),
(46, 'Cinturon cuero', 3769, '48', 9),
(48, 'Vestido Floreado', 4, 'U', 10),
(59, 'Prueba BD post', 656565, '77', 9),
(60, 'remera', 1575, 'U', 7),
(61, 'Collar', 2430, 'U', 10),
(62, 'Collar', 2430, 'U', 9),
(63, 'Aritos', 145, 'U', 9),
(64, 'Pantalon lino', 6590, 'L', 8),
(65, 'Pantalon fibrana', 5590, 'M', 8),
(66, 'Pantalon bali', 9990, 'S', 8),
(67, 'Remera Bali', 3000, 'S', 7),
(68, 'Buzo de hilo', 10600, 'M', 10),
(69, 'Buzo de peluche', 8900, 'L', 10),
(70, 'Buzo oversize', 15000, 'U', 10),
(71, 'Blusa lina', 5000, 'U', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID_user` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID_user`, `email`, `password`) VALUES
(13, 'sofia@gmail.com', '$2y$10$tkeaCTfPQOr1wffH3b0oqe.dhYUdL.zFeIl7XxP5UrUQRi8HH7KEu'),
(14, 'ormazabal@gmail.com', '$2y$10$EOhyo.JLVo.N51mcxYwWH.MYZwq19xNSBh4mOIkp0DgjWC7KQzeGS'),
(15, 'hola@gmail.com', '$2y$10$jTFOjWe/jWQ4hUryretL3eiraUCfTGmM2zDa39pQWQf3yOMSR5Efy');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_category` (`id_category`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
