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
    Genero BOOLEAN NULL,   
    CodigoPostal INT NOT NULL,
    PRIMARY KEY pk_clientes (Nif),
    INDEX idx_clientes (Nombre),
    INDEX idx2_clientes (CodigoPostal)
)ENGINE = innodb
COMMENT = "Tabla Principal Clientes";

-- Tabla clientes
CREATE TABLE IF NOT EXISTS ventas
(
    NumTiket INT AUTO_INCREMENT, 
    Fecha DATE NOT NULL,
    Referencia TINYINT UNSIGNED NOT NULL,
    Nif CHAR(9) NOT NULL,
    INDEX idx_ventas (NumTiket), 
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

-- Si se van a meter datos en TODOS los campos, no hace falta ponerlos
INSERT INTO productos
VALUES (234, "Rotulador Rojo", 0.85, 2);
INSERT INTO productos (Referencia, Descripcion, Precio)
VALUES (112, "Rotulador Negro", 0.85);

INSERT INTO clientes (Nif, Nombre, Genero, CodigoPostal)
VALUES
("11111111A", "Ana", 1, 41702),
("22222222B", "Maria José", 1, 41013),
("33333333C", "Alfonso", 0, 41927);

INSERT INTO ventas (Fecha, Referencia, Nif)
VALUES
("2024-01-10", 234, "11111111A"),
("2024-01-10", 112, "33333333C"),
("2024-01-10", 234, "22222222B");

-- UPDATE
-- Actualizar datos de las tablas
-- Ej: Modificación datos de cliente
UPDATE clientes
SET nombre = "Ana Pozo"
WHERE Nif = "11111111A";

-- Si queremos cambiar dos campos, y usamos un campo único para ello
UPDATE ventas
SET Fecha = "2024-01-09",
Referencia = 112
WHERE NumTiket = 3;

-- DELETE borrar un campo de una tabla
DELETE FROM ventas 
WHERE NumTiket = 3;