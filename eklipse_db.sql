-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2026 a las 10:35:04
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
-- Base de datos: `eklipse_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bazkideak`
--

CREATE TABLE `bazkideak` (
  `bazkide_id` int(11) NOT NULL,
  `izena` varchar(100) NOT NULL,
  `abizenak` varchar(100) NOT NULL,
  `nan_dni` varchar(20) NOT NULL,
  `helbide_elektronikoa` varchar(150) NOT NULL,
  `telefono_zenbakia` varchar(20) DEFAULT NULL,
  `jaiotze_data` date NOT NULL,
  `alta_data` timestamp NOT NULL DEFAULT current_timestamp(),
  `aktibo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bez_motak`
--

CREATE TABLE `bez_motak` (
  `bez_id` int(11) NOT NULL,
  `ehunekoa` decimal(5,2) NOT NULL,
  `deskribapena` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ekitaldiak`
--

CREATE TABLE `ekitaldiak` (
  `ekitaldi_id` int(11) NOT NULL,
  `izena` varchar(100) NOT NULL,
  `ekitaldi_data` datetime NOT NULL,
  `edukiera_maximoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produktuak`
--

CREATE TABLE `produktuak` (
  `produktua_id` int(11) NOT NULL,
  `izena` varchar(100) NOT NULL,
  `kategoria` enum('Alkohola','Freskagarria','Janaria','Merchandising','Beste bat') NOT NULL,
  `oinarrizko_prezioa` decimal(10,2) NOT NULL,
  `bez_id` int(11) NOT NULL,
  `uneko_stocka` int(11) DEFAULT 0,
  `gutxieneko_stocka` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salmentak`
--

CREATE TABLE `salmentak` (
  `salmenta_id` int(11) NOT NULL,
  `tpv_id` int(11) NOT NULL,
  `bazkide_id` int(11) DEFAULT NULL,
  `salmenta_data` timestamp NOT NULL DEFAULT current_timestamp(),
  `oinarri_zergapea` decimal(10,2) NOT NULL,
  `bez_totala` decimal(10,2) NOT NULL,
  `prezio_totala` decimal(10,2) NOT NULL,
  `ordainketa_mota` enum('Eskudirutan','Txartela','Bizum','Mistoa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salmenta_enptizioak`
--

CREATE TABLE `salmenta_enptizioak` (
  `enptizio_id` int(11) NOT NULL,
  `salmenta_id` int(11) NOT NULL,
  `produktua_id` int(11) NOT NULL,
  `kantitatea` int(11) NOT NULL,
  `unitate_prezioa_oinarria` decimal(10,2) NOT NULL,
  `bez_ehunekoa` decimal(5,2) NOT NULL,
  `azpitotala` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sarrerak`
--

CREATE TABLE `sarrerak` (
  `sarrera_id` int(11) NOT NULL,
  `ekitaldi_id` int(11) NOT NULL,
  `salmenta_id` int(11) NOT NULL,
  `erreserba_id` int(11) DEFAULT NULL,
  `qr_kodea` varchar(255) NOT NULL,
  `sarrera_mota` enum('Arrunta','VIP','Aurretiarra','Zerrenda') NOT NULL,
  `kontsumizioa_barne` tinyint(1) DEFAULT 1,
  `Sarrera_egoera` enum('Erabili_gabea','Sartuta','Ezeztatua') DEFAULT 'Erabili_gabea',
  `sarrera_data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_mugimenduak`
--

CREATE TABLE `stock_mugimenduak` (
  `mugimendua_id` int(11) NOT NULL,
  `produktua_id` int(11) NOT NULL,
  `mota` enum('Hornitzaile_Sarrera','Barra_Banaketa','Hondatzea_Haustura','Doitzea') NOT NULL,
  `kantitatea` int(11) NOT NULL,
  `jatorri_kokapena` varchar(50) DEFAULT NULL,
  `helburu_kokapena` varchar(50) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpv_terminalak`
--

CREATE TABLE `tpv_terminalak` (
  `tpv_id` int(11) NOT NULL,
  `barra_izena` varchar(50) NOT NULL,
  `kokapena` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vip_erreserbak`
--

CREATE TABLE `vip_erreserbak` (
  `erreserba_id` int(11) NOT NULL,
  `ekitaldi_id` int(11) NOT NULL,
  `bazkide_id` int(11) DEFAULT NULL,
  `bezero_izena` varchar(100) NOT NULL,
  `kontaktuko_telefonoa` varchar(20) NOT NULL,
  `vip_eremua` varchar(20) NOT NULL,
  `baimendutako_pertsonak` int(11) NOT NULL,
  `gutxieneko_kontsumoa` decimal(10,2) DEFAULT 0.00,
  `erreserba_prezioa` decimal(10,2) NOT NULL,
  `egoera` enum('Zain','Baieztatua','Ezeztatua','Osatua') DEFAULT 'Zain'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bazkideak`
--
ALTER TABLE `bazkideak`
  ADD PRIMARY KEY (`bazkide_id`),
  ADD UNIQUE KEY `nan_dni` (`nan_dni`),
  ADD UNIQUE KEY `helbide_elektronikoa` (`helbide_elektronikoa`);

--
-- Indices de la tabla `bez_motak`
--
ALTER TABLE `bez_motak`
  ADD PRIMARY KEY (`bez_id`);

--
-- Indices de la tabla `ekitaldiak`
--
ALTER TABLE `ekitaldiak`
  ADD PRIMARY KEY (`ekitaldi_id`);

--
-- Indices de la tabla `produktuak`
--
ALTER TABLE `produktuak`
  ADD PRIMARY KEY (`produktua_id`),
  ADD KEY `bez_id` (`bez_id`);

--
-- Indices de la tabla `salmentak`
--
ALTER TABLE `salmentak`
  ADD PRIMARY KEY (`salmenta_id`),
  ADD KEY `tpv_id` (`tpv_id`),
  ADD KEY `bazkide_id` (`bazkide_id`);

--
-- Indices de la tabla `salmenta_enptizioak`
--
ALTER TABLE `salmenta_enptizioak`
  ADD PRIMARY KEY (`enptizio_id`),
  ADD KEY `salmenta_id` (`salmenta_id`),
  ADD KEY `produktua_id` (`produktua_id`);

--
-- Indices de la tabla `sarrerak`
--
ALTER TABLE `sarrerak`
  ADD PRIMARY KEY (`sarrera_id`),
  ADD UNIQUE KEY `qr_kodea` (`qr_kodea`),
  ADD KEY `ekitaldi_id` (`ekitaldi_id`),
  ADD KEY `salmenta_id` (`salmenta_id`),
  ADD KEY `erreserba_id` (`erreserba_id`);

--
-- Indices de la tabla `stock_mugimenduak`
--
ALTER TABLE `stock_mugimenduak`
  ADD PRIMARY KEY (`mugimendua_id`),
  ADD KEY `produktua_id` (`produktua_id`);

--
-- Indices de la tabla `tpv_terminalak`
--
ALTER TABLE `tpv_terminalak`
  ADD PRIMARY KEY (`tpv_id`);

--
-- Indices de la tabla `vip_erreserbak`
--
ALTER TABLE `vip_erreserbak`
  ADD PRIMARY KEY (`erreserba_id`),
  ADD KEY `ekitaldi_id` (`ekitaldi_id`),
  ADD KEY `bazkide_id` (`bazkide_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bazkideak`
--
ALTER TABLE `bazkideak`
  MODIFY `bazkide_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bez_motak`
--
ALTER TABLE `bez_motak`
  MODIFY `bez_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ekitaldiak`
--
ALTER TABLE `ekitaldiak`
  MODIFY `ekitaldi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `produktuak`
--
ALTER TABLE `produktuak`
  MODIFY `produktua_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salmentak`
--
ALTER TABLE `salmentak`
  MODIFY `salmenta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salmenta_enptizioak`
--
ALTER TABLE `salmenta_enptizioak`
  MODIFY `enptizio_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sarrerak`
--
ALTER TABLE `sarrerak`
  MODIFY `sarrera_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stock_mugimenduak`
--
ALTER TABLE `stock_mugimenduak`
  MODIFY `mugimendua_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tpv_terminalak`
--
ALTER TABLE `tpv_terminalak`
  MODIFY `tpv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vip_erreserbak`
--
ALTER TABLE `vip_erreserbak`
  MODIFY `erreserba_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `produktuak`
--
ALTER TABLE `produktuak`
  ADD CONSTRAINT `produktuak_ibfk_1` FOREIGN KEY (`bez_id`) REFERENCES `bez_motak` (`bez_id`);

--
-- Filtros para la tabla `salmentak`
--
ALTER TABLE `salmentak`
  ADD CONSTRAINT `salmentak_ibfk_1` FOREIGN KEY (`tpv_id`) REFERENCES `tpv_terminalak` (`tpv_id`),
  ADD CONSTRAINT `salmentak_ibfk_2` FOREIGN KEY (`bazkide_id`) REFERENCES `bazkideak` (`bazkide_id`);

--
-- Filtros para la tabla `salmenta_enptizioak`
--
ALTER TABLE `salmenta_enptizioak`
  ADD CONSTRAINT `salmenta_enptizioak_ibfk_1` FOREIGN KEY (`salmenta_id`) REFERENCES `salmentak` (`salmenta_id`),
  ADD CONSTRAINT `salmenta_enptizioak_ibfk_2` FOREIGN KEY (`produktua_id`) REFERENCES `produktuak` (`produktua_id`);

--
-- Filtros para la tabla `sarrerak`
--
ALTER TABLE `sarrerak`
  ADD CONSTRAINT `sarrerak_ibfk_1` FOREIGN KEY (`ekitaldi_id`) REFERENCES `ekitaldiak` (`ekitaldi_id`),
  ADD CONSTRAINT `sarrerak_ibfk_2` FOREIGN KEY (`salmenta_id`) REFERENCES `salmentak` (`salmenta_id`),
  ADD CONSTRAINT `sarrerak_ibfk_3` FOREIGN KEY (`erreserba_id`) REFERENCES `vip_erreserbak` (`erreserba_id`);

--
-- Filtros para la tabla `stock_mugimenduak`
--
ALTER TABLE `stock_mugimenduak`
  ADD CONSTRAINT `stock_mugimenduak_ibfk_1` FOREIGN KEY (`produktua_id`) REFERENCES `produktuak` (`produktua_id`);

--
-- Filtros para la tabla `vip_erreserbak`
--
ALTER TABLE `vip_erreserbak`
  ADD CONSTRAINT `vip_erreserbak_ibfk_1` FOREIGN KEY (`ekitaldi_id`) REFERENCES `ekitaldiak` (`ekitaldi_id`),
  ADD CONSTRAINT `vip_erreserbak_ibfk_2` FOREIGN KEY (`bazkide_id`) REFERENCES `bazkideak` (`bazkide_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
