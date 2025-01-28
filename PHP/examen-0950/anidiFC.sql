DROP DATABASE IF EXISTS anidiFC;

CREATE DATABASE IF NOT EXISTS anidiFC
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish2_ci;

USE anidiFC;

CREATE TABLE IF NOT EXISTS clubes 
(
	idclub TINYINT NOT NULL, 
    nombreclub VARCHAR(45) NULL,
    internacional BOOLEAN NULL,
    PRIMARY KEY pk_clubes (idclub),
    INDEX idx_clubes (nombreclub)
) ENGINE = innodb
COMMENT = "Tabla clubes: ENGINE Motor BBDD";

CREATE TABLE IF NOT EXISTS jugadores
(
    nif_nie CHAR(9) NOT NULL,   
    nombre VARCHAR(45) NOT NULL,
    edad TINYINT NULL,
    fincontrato DATE NOT NULL,
    posiciones VARCHAR(45) NULL,
    club TINYINT NOT NULL,
    INDEX idx_jugadores (nombre),
    PRIMARY KEY pk_jugadores (nif_nie), 
    FOREIGN KEY fk_jugadores (club) REFERENCES clubes (idclub)
) ENGINE = innodb
COMMENT = "Tabla Relacionada jugadores";


DESCRIBE clubes;
DESCRIBE jugadores;

USE anidiFC;

INSERT INTO clubes (idclub, nombreclub, internacional)
VALUES 
(1, "Real Madrid", 0),
(2, "Barcelona", 0),
(3, "Francia", 1);

SELECT * FROM clubes;

INSERT INTO jugadores (nif_nie, nombre, edad, fincontrato, posiciones, club)
VALUES 
("44444444D", "Casillas", 20,"2026-03-20", "portero",1 ),
("55555555E", "Roberto", 20,"2026-08-24", "defensa", 2),
("66666666C", "Kevin", 20,"2027-03-21", "centro", 3);

SELECT * FROM jugadores;
