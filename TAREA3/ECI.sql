DROP DATABASE IF EXISTS ECI;
CREATE DATABASE ECI;
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish2_ci;

USE ECI;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(8) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NULL,
    autonomo BOOLEAN NULL,
    nif_cif INT NOT NULL,
    PRIMARY KEY pk_usuarios (id)
)ENGINE = innodb
COMMENT = "Tabla usuarios contiene datos de registro";

DESCRIBE usuarios;

USE ECI;

INSERT INTO usuarios (email, password, nombre, apellido, apellidos, autonomo, nif_cif)
VALUES ('juan.perez@example.com', 'Cont@123', 'Juan', 'Pérez', 'Gómez', 0, '123456788');
INSERT INTO usuarios (email, password, nombre, apellido, apellidos, autonomo, nif_cif)
VALUES ('bea.perez@example.com', 'Cont@222', 'Bea', 'Rúiz', 'Gómez', 1, '123456789');

SELECT * FROM usuarios;

UPDATE usuarios
SET password = 'Cont@111', 'Juan Carlos', 'Pérez Sánchez', 'Gómez', 0, '123456788'
WHERE email = 'juan.perez@example.com';

DELETE FROM usuarios
WHERE email = 'juan.perez@example.com';
