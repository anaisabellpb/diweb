DROP DATABASE IF EXISTS fp_pro;

CREATE DATABASE IF NOT EXISTS fp_pro
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish2_ci;

USE fp_pro;

CREATE TABLE IF NOT EXISTS docentes
(
    nif CHAR(9) NOT NULL,   
    nombre VARCHAR(50) NOT NULL,
    edad TINYINT Not NULL,
    PRIMARY KEY pk_docentes (nif), 
    INDEX idx_docentes (nombre)
) ENGINE = innodb
COMMENT = "Tabla docentes: ENGINE Motor BBDD";


CREATE TABLE IF NOT EXISTS alumnos 
(
	nif CHAR (9) NOT NULL, 
    nombre VARCHAR(50) NOT NULL,
    fechanac DATE NOT NULL,
    pagado BOOLEAN NOT NULL,
    importe DECIMAL(5,2) NOT NULL,
    docentes_nif CHAR(9) NOT NULL,
    INDEX idx_alumnos (nombre),
    PRIMARY KEY pk_alumnos (nif),
    FOREIGN KEY fk_alumnos (docentes_nif) REFERENCES docentes(nif)
) ENGINE = innodb
COMMENT = "Tabla Relacionada alumnos";

DESCRIBE docentes;
DESCRIBE alumnos;

USE fp_pro;

INSERT INTO docentes (nif, nombre, edad)
VALUES 
("11111111A", "Juan Rodríguez", 48),
("22222222B", "Isabel Álvarez", 38),
("33333333C", "Adela Ruiz", 39);

SELECT * FROM docentes;

INSERT INTO alumnos (nif, nombre, fechanac, pagado, importe, docentes_nif)
VALUES 
("44444444D", "Alfonso Casillas", "1998-03-20", 1, 125.55, "11111111A"),
("55555555E", "Ana Pozo", "1989-08-24", 1, 125.55, "11111111A"),
("66666666C", "Marta Borrero", "1994-03-21", 0, 125.55, "11111111A");

SELECT * FROM alumnos;
