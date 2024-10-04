-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2024 a las 20:00:16
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
-- Base de datos: `planeacion`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `add_business_days` (`start_date` DATE, `days` INT) RETURNS DATE  BEGIN
    DECLARE i INT DEFAULT 0;
    DECLARE result_date DATE;
    
    SET result_date = start_date;
    
    WHILE i < days DO
        SET result_date = DATE_ADD(result_date, INTERVAL 1 DAY);
        IF DAYOFWEEK(result_date) BETWEEN 2 AND 6 THEN
            SET i = i + 1;
        END IF;
    END WHILE;
    
    RETURN result_date;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `folio` () RETURNS VARCHAR(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
    DECLARE anio_actual VARCHAR(4);
    DECLARE nuevo_folio VARCHAR(10);
    DECLARE max_folio INT;

    SET anio_actual = YEAR(CURRENT_DATE());

    -- Obtener el folio máximo del año actual
    SET max_folio = (SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(folio, '-', 1) AS UNSIGNED)), 0) 
                     FROM formulario 
                     WHERE SUBSTRING_INDEX(folio, '-', -1) = anio_actual);

    -- Generar el folio con el formato deseado
    SET nuevo_folio = CONCAT(LPAD(max_folio + 1, 3, '0'), '-', anio_actual);

    RETURN nuevo_folio;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `Id` int(11) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`Id`, `password`) VALUES
(1, '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `folio` varchar(11) NOT NULL,
  `nombre_propietario` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `numeroDireccion` varchar(5) NOT NULL,
  `tipo_tramite` varchar(100) NOT NULL,
  `fecha_ingreso` varchar(12) NOT NULL,
  `nombre_solicitante` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario_recibe` varchar(100) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_entrega_estimada` varchar(12) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `escrituras` varchar(255) DEFAULT NULL,
  `boleta_predial` varchar(100) DEFAULT NULL,
  `identificacion` varchar(255) NOT NULL,
  `estatus` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cord_lat` varchar(30) NOT NULL,
  `cord_long` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formulario`
--

INSERT INTO `formulario` (`folio`, `nombre_propietario`, `direccion`, `localidad`, `numeroDireccion`, `tipo_tramite`, `fecha_ingreso`, `nombre_solicitante`, `telefono`, `correo`, `usuario_recibe`, `observaciones`, `fecha_entrega_estimada`, `ubicacion`, `escrituras`, `boleta_predial`, `identificacion`, `estatus`, `created_at`, `updated_at`, `cord_lat`, `cord_long`) VALUES
('001-2024', 'JUANITA PERES', 'BAJA CALIFORNIA SUR', 'RINCON DE ROMOS', '', 'SUBDIVICION', '11-09-2024', 'RUBEN PEREZ', '4650001020', 'CORREO@PRUEBATEST', 'VENTANILLA', 'NADA', '25-09-2024', '775346.43, 2460299.03', 'archivos/001-2024/Captura de pantalla 2024-04-29 084212.png', 'archivos/001-2024/IMG-20240520-WA0001.jpg', 'archivos/001-2024/Captura de pantalla 2024-04-29 084212.png', 'verificador', '2024-09-11 17:40:49', '2024-09-11 17:41:01', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `nombre`, `usuario`, `password`, `nivel`) VALUES
(1, 'pedro', 'peter', 'perritos', 1),
(2, 'alfredo', 'alfred', 'varifica', 2),
(4, 'Bernardo', 'bigboss', 'bigboss', 6),
(5, 'Jairo', 'ceya', 'ceya123', 1),
(6, 'verificador', 'verificador', '123', 2),
(7, 'ventanilla', 'ventanilla', '123', 1),
(8, 'dasdas', 'dani123', '123', 2),
(9, 'nuevo', 'nuevo', '123', 5),
(10, '', '', '', 0),
(11, '', '', '', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`folio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
