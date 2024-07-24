-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2024 a las 20:16:43
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
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `folio` varchar(11) NOT NULL,
  `nombre_propietario` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `tipo_tramite` varchar(100) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `nombre_solicitante` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario_recibe` varchar(100) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_entrega_estimada` date DEFAULT NULL,
  `coordenadas` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `imagen_referencia` varchar(255) DEFAULT NULL,
  `otro_contacto` varchar(100) DEFAULT NULL,
  `estatus` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formulario`
--

INSERT INTO `formulario` (`folio`, `nombre_propietario`, `direccion`, `localidad`, `tipo_tramite`, `fecha_ingreso`, `nombre_solicitante`, `telefono`, `correo`, `usuario_recibe`, `observaciones`, `fecha_entrega_estimada`, `coordenadas`, `ubicacion`, `imagen_referencia`, `otro_contacto`, `estatus`, `created_at`, `updated_at`) VALUES
('001-2024', 'PEDRO RUIZ DIAZ', 'AV CONSTITUCION DE 1917', 'RINCON DE ROMOS', 'Constancia', '2024-07-23', 'JOSU RD', '4651021211', 'CORREO@PRUEBATEST', 'PETER', 'NADA', '2024-08-06', NULL, '775980.58, 2460493.07', NULL, NULL, 'verificador', '2024-07-23 16:52:39', '2024-07-23 16:52:58'),
('002-2024', 'PEDRO RUIZ DIAZ', 'AV CONSTITUCION DE 1917', 'RINCON DE ROMOS', 'Número oficial', '2024-07-23', 'JOSU RD', '4651021211', 'CORREO@PRUEBATEST', 'PETER', 'ADSDSAD', '2024-08-06', NULL, NULL, NULL, NULL, 'ventanilla', '2024-07-23 18:03:24', '2024-07-23 18:03:24'),
('003-2024', 'DASDAS', 'PALACIOS COL NUEVA CALLE', 'LAS HORMIGAS', 'Número oficial', '2024-07-24', 'SOLICITANTE', '4658276451', 'RUBENPEREZ@TETSTETS', 'PETER', 'CASA GRANDE ALEJADA DE RINCON', '2024-08-07', NULL, '774578.93, 2463106.71', NULL, NULL, 'verificador', '2024-07-24 16:25:27', '2024-07-24 16:29:45'),
('004-2024', 'DASDAS', 'PALACIOS COL NUEVA CALLE', 'LAS HORMIGAS', 'Uso de Suelo', '2024-07-24', 'SOLICITANTE', '5764632878', 'RUBENPEREZ@TETSTETS', 'VENTANILLA', 'NINGUNA', '2024-08-07', NULL, '776653.35, 2460487.25', NULL, NULL, 'verificador', '2024-07-24 17:37:31', '2024-07-24 17:37:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_tramites`
--

CREATE TABLE `tabla_tramites` (
  `folio` int(11) NOT NULL,
  `nombre_propietario` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `tipo_tramite` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 'Bernardo', 'bigboss', 'planea', 6),
(5, 'Jairo', 'ceya', 'ceya123', 1),
(6, 'verificador', 'verificador', '123', 2),
(7, 'ventanilla', 'ventanilla', '123', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`folio`);

--
-- Indices de la tabla `tabla_tramites`
--
ALTER TABLE `tabla_tramites`
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
-- AUTO_INCREMENT de la tabla `tabla_tramites`
--
ALTER TABLE `tabla_tramites`
  MODIFY `folio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
