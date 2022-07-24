-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-07-2022 a las 21:16:35
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
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE productos (
  ID int(11) NOT NULL,
  nombre varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  sepa varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  descripcion text COLLATE utf8_spanish_ci NOT NULL,
  precio decimal(10,3) NOT NULL,
  id_categoria int(11) NOT NULL,
  activo int(11) NOT NULL,
  producto int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO productos ("ID", nombre, sepa, descripcion, precio, id_categoria, activo, producto) VALUES
(1, 'Petirrojo', 'Merlot', 'vino tinto', '27.000', 1, NULL, 245726),
(2, 'Posta Pizzela', 'Malbec', 'Vino Tinto', '50.000', 1, NULL, 933404),
(3, 'Marques de villa de leyva', 'Cabernet Sauvignon', 'vino tinto', '50.000', 1, NULL, 948930),
(4, 'Don melchor', 'Cabernet sauvignon', 'vino tinto', '50.000', 1, NULL, 543152),
(5, 'Purple angel', 'Carmenere', 'vino tinto', '50.000', 1, NULL, 330628),
(6, 'Muga', 'Tempranillo', 'vino tinto', '50.000', 2, NULL, 692159),
(7, 'Chateu st michelle', 'Cabernet sauvignon', 'vino tinto', '50.000', 2, NULL, 323324),
(8, 'Maison castel gran reserva', 'Cabernet sauvignon', 'vino tinto', '50.000', 2, NULL, 191880),
(9, 'santa margherita', 'Pinot grigio', 'vino blanco', '50.000', 2, NULL, 257609),
(10, 'Montes alpha M', '80% Cabernet Sauvignon', 'vino tinto', '50.000', 2, NULL, 782699),
(11, 'Angelica zapata', 'Malbec', 'vino tinto', '50.000', 3, NULL, 850550),
(12, 'Gran enemigo', 'Malbec', 'vino tinto', '50.000', 3, NULL, 652132),
(13, 'Zuccardi serie A', 'Malbec', 'vino tinto', '50.000', 3, NULL, 438553),
(14, 'Cerro verde', 'Merlot', 'vino tinto', '50.000', 3, NULL, 178631),
(15, 'Codice', 'Tempranillo', 'vino tinto', '50.000', 3, NULL, 265178);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
