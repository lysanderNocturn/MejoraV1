-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2024 a las 18:06:52
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
    
    SET anio_actual = YEAR(CURRENT_DATE());
    
    -- Generar el folio con el formato deseado
    SET nuevo_folio = CONCAT(LPAD((SELECT COALESCE(MAX(folio), 0) FROM formulario) + 1,3, '0'), '-', anio_actual);
    
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
  `ubicacion_geologica` varchar(255) DEFAULT NULL,
  `imagen_referencia` varchar(255) DEFAULT NULL,
  `otro_contacto` varchar(100) DEFAULT NULL,
  `estatus` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formulario`
--

INSERT INTO `formulario` (`folio`, `nombre_propietario`, `direccion`, `localidad`, `tipo_tramite`, `fecha_ingreso`, `nombre_solicitante`, `telefono`, `correo`, `usuario_recibe`, `observaciones`, `fecha_entrega_estimada`, `coordenadas`, `ubicacion_geologica`, `imagen_referencia`, `otro_contacto`, `estatus`, `created_at`, `updated_at`) VALUES
('001-2020', 'Juan Pérez', 'Calle 123', 'Ciudad A', 'Constancia', '2024-01-09', 'Pedro López', '1234567890', 'juan@example.com', 'Usuario1', 'Observaciones...', '2022-02-15', '123.456, -78.910', 'Ubicación A', 'imagen1.jpg', 'Otro contacto', 'En proceso', '2024-05-30 18:57:01', '2024-06-03 19:21:19'),
('001-2023', 'Carlos Rodríguez', 'Calle Principal', 'Ciudad C', 'Subdivisión', '2024-01-17', 'Luisa Sánchez', '555444333', 'carlos@example.com', 'Usuario3', 'Observaciones...', '2023-06-20', '555.444, -77.888', 'Ubicación C', 'imagen3.jpg', 'Otro contacto', 'En espera', '2024-05-30 18:57:01', '2024-06-03 19:21:36'),
('001-2024', 'Laura Martín', 'Calle Central', 'Ciudad D', 'Número Oficial', '2024-04-05', 'David Hernández', '777888999', 'laura@example.com', 'Usuario4', 'Observaciones...', '2024-05-05', '777.888, -99.111', 'Ubicación D', 'imagen4.jpg', 'Otro contacto', 'En proceso', '2024-05-30 18:57:01', '2024-05-30 18:57:01'),
('002-2020', 'María Gómez', 'Av. Principal', 'Ciudad B', 'Uso de Suelo', '2022-03-10', 'Ana Martínez', '0987654321', 'maria@example.com', 'Usuario2', 'Observaciones...', '2022-04-10', '987.654, -32.109', 'Ubicación B', 'imagen2.jpg', 'Otro contacto', 'Completado', '2024-05-30 18:57:01', '2024-05-30 18:57:01'),
('002-2022', 'José López', 'Av. Oeste', 'Ciudad G', 'Subdivisión', '2024-11-08', 'Sofía Rodríguez', '222333444', 'jose@example.com', 'Usuario7', 'Observaciones...', '2022-12-08', '222.333, -66.777', 'Ubicación G', 'imagen7.jpg', 'Otro contacto', 'Completado', '2024-05-30 18:57:01', '2024-06-03 19:21:50'),
('002-2024', 'Pedro García', 'Av. Norte', 'Ciudad E', 'Constancia', '2024-07-12', 'Elena Pérez', '666555444', 'pedro@example.com', 'Usuario5', 'Observaciones...', '2024-08-12', '666.555, -22.333', 'Ubicación E', 'imagen5.jpg', 'Otro contacto', 'Completado', '2024-05-30 18:57:01', '2024-05-30 18:57:01'),
('003-2023', 'Marcela Torres', 'Calle Este', 'Ciudad H', 'Número Oficial', '2023-02-18', 'Javier Pérez', '999888777', 'marcela@example.com', 'Usuario8', 'Observaciones...', '2023-03-18', '999.888, -11.222', 'Ubicación H', 'imagen8.jpg', 'Otro contacto', 'En espera', '2024-05-30 18:57:01', '2024-05-30 18:57:01'),
('003-2024', 'Ana Ruiz', 'Calle Sur', 'Ciudad F', 'Uso de Suelo', '2024-09-30', 'Mario Gutiérrez', '333222111', 'ana@example.com', 'Usuario6', 'Observaciones...', '2024-10-30', '333.222, -44.555', 'Ubicación F', 'imagen6.jpg', 'Otro contacto', 'En espera', '2024-05-30 18:57:01', '2024-05-30 18:57:01'),
('004-2024', 'Lucía Soto', 'Av. Sur', 'Ciudad I', 'Constancia', '2024-06-25', 'Carolina Martínez', '111222333', 'lucia@example.com', 'Usuario9', 'Observaciones...', '2024-07-25', '111.222, -33.444', 'Ubicación I', 'imagen9.jpg', 'Otro contacto', 'En proceso', '2024-05-30 18:57:01', '2024-05-30 18:57:01'),
('005-2024', 'Ricardo Vargas', 'Calle Norte', 'Ciudad J', 'Constancia', '2024-08-14', 'Gabriela Hernández', '777666555', 'ricardo@example.com', 'Usuario10', 'Observaciones...', '2024-09-14', '777.666, -55.777', 'Ubicación J', 'imagen10.jpg', 'Otro contacto', 'Completado', '2024-05-30 18:57:01', '2024-05-30 18:57:01'),
('006-2024', 'pepe', 'muy lejos', 'rincon de romos', 'Constancia', '2024-05-30', 'hernesto', '4652871629', 'correo@coreo.com', 'peter', 'nada', '2024-06-13', NULL, NULL, NULL, NULL, 'verificador', '2024-05-30 19:50:49', '2024-05-30 19:50:49'),
('007-2024', 'juan', 'mujeres ilustres', 'Ags', 'Subdivision', '2024-05-30', 'juan', '476353716', 'correo@coreo.com', 'peter', 'nada', '2024-06-13', NULL, NULL, NULL, NULL, 'verificador', '2024-05-30 19:54:00', '2024-05-30 19:54:00'),
('009-2024', 'propietario', 'calle adolfo lopez #417', 'rincon de romos', 'Uso de Suelo', '2024-06-03', 'solicitante', '4651029182', 'correo@prueba.test', 'peter', 'ninguna', '2024-06-17', NULL, NULL, NULL, NULL, 'verificador', '2024-06-03 18:56:31', '2024-06-03 18:56:31'),
('010-2024', 'propietario', 'calle adolfo lopez #417', 'rincon de romos', 'Constancia', '2024-06-03', 'solicitante', '4651021512', 'correo@prueba.test', 'peter', 'nada', '2024-06-17', NULL, NULL, NULL, NULL, 'verificador', '2024-06-03 19:30:43', '2024-06-03 19:30:43');

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
(4, 'Bernardo', 'bigboss', 'planea', 6);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
