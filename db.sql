CREATE TABLE formulario (
    folio INT  PRIMARY KEY,
    nombre_propietario VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    localidad VARCHAR(100) NOT NULL,
    tipo_tramite VARCHAR(100) NOT NULL,
    fecha_ingreso DATE NOT NULL,
    nombre_solicitante VARCHAR(100) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    usuario_recibe VARCHAR(100) NOT NULL,
    observaciones TEXT,
    fecha_entrega_estimada DATE,
    coordenadas VARCHAR(255), -- Nuevo campos agregados
    ubicacion_geologica VARCHAR(255),
    imagen_referencia VARCHAR(255),
    estatus VARCHAR(30),
    otro_contacto VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS tabla_tramites (
    folio INT AUTO_INCREMENT PRIMARY KEY,
    nombre_propietario VARCHAR(100),
    direccion VARCHAR(255),
    localidad VARCHAR(100),
    tipo_tramite VARCHAR(100),
    telefono VARCHAR(15),
    correo VARCHAR(100),
    observaciones TEXT
);



-- Creación de la función para calcular la fecha con 10 días hábiles adicionales
DELIMITER //

CREATE FUNCTION add_business_days(start_date DATE, days INT)
RETURNS DATE
BEGIN
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
END//

DELIMITER ;

-- Actualización de los registros en la tabla formulario para calcular la fecha de entrega estimada
UPDATE formulario
SET fecha_entrega_estimada = add_business_days(fecha_ingreso, 10);
