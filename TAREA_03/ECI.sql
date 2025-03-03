-- DROP DATABASE IF EXISTS ECI; Borra la base de datos al completo
CREATE DATABASE ECI
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish2_ci;

USE ECI;

CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE, -- Emails únicos y obligatorios
    password VARCHAR(8) NOT NULL,       -- Contraseñas limitadas a 8 caracteres
    nombre VARCHAR(50) NOT NULL,        -- Nombre obligatorio
    apellido VARCHAR(50) NOT NULL,      -- Primer apellido obligatorio
    apellidos VARCHAR(50) NULL,         -- Segundo apellido opcional
    autonomo BOOLEAN NULL,              -- Autonomo opcional
    nif_cif VARCHAR(9) NULL             -- Solo números, opcional
);

