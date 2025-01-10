-- Tema 09 y 10 del manual
-- crear BBDD (base de datos), Tablas y Relaciones
CREATE DATABASE IF NOT EXISTS simplificando
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish2_ci;
-- esto de aqui arriba para crear la base de datos
USE SIMPLIFICANDO;
-- luego tenemos que poner USE y el nombre de base de datos para entrar

--Borrar BBDD (Base de datos)
DROP DATABASE simplificando;

-- Crear Tablas: En primer lugar las principales, para borrar es al revés siendo la principal la última.
CREATE TABLE IF NOT EXISTS productos
(
    Referencia TINYINT UNSIGNED NOT NULL,   
    Descripcion VARCHAR(40) NOT NULL, --NOT FULL, no vacío
    Precio DECIMAL (5,2) NOT NULL,
    Stock INT UNSIGNED NULL,
    PRIMARY KEY pk_productos (Referencia),  
    INDEX idx_productos (Descripcion) 
)ENGINE = innodb
COMMENT = "Tabla productos: ENGINE Motor BBDD";

-- Tabla clientes
CREATE TABLE IF NOT EXISTS clientes
(
    Nif CHAR (9) NOT NULL,
    Nombre VARCHAR(40) NOT NULL,
    Genero BOOLEAN NULL,   --- Verdadero / Falso
    CodigoPostal INT NOT NULL,
    PRIMARY KEY pk_clientes (Nif),
    INDEX idx_clientes (Nombre),
    INDEX idx2_clientes (CodigoPostal)
)ENGINE = innodb
COMMENT = "Tabla Principal Clientes";

-- Tabla clientes
CREATE TABLE IF NOT EXISTS ventas
(
    Fecha DATE NOT NULL,
    Referencia TINYINT UNSIGNED NOT NULL,
    Nif CHAR(9) NOT NULL,
    PRIMARY KEY pk_ventas (Fecha, Referencia, Nif),
    FOREIGN KEY fk_productos (Referencia) 
        REFERENCES productos (Referencia),
    FOREIGN KEY fk_clientes (Nif) 
        REFERENCES clientes (Nif)
)ENGINE = innodb
COMMENT = "Tabla Relacionadas ventas";

-- Borrar tablas
-- 1º Borramos tablas relacionadas; y al final, las principales
-- Ejem simplificando: 
-- 1º DROP TABLE ventas;
-- 2º DROP TABLE productos;
-- 3º DROP DATABASE simplificando;

-- INSERT (TEMA 11 del manual de MySQL)
-- Sirve para insertar registros
-- 1º Se insertan registros en tablas principales
USE simplificando;

