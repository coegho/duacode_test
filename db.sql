CREATE TABLE Deportes (
    id SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(128) NOT NULL
);

CREATE TABLE Equipos (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(128) NOT NULL,
    ciudad VARCHAR(128) NULL,
    deporte SMALLINT NOT NULL REFERENCES Deportes(id),
    fecha_creacion DATE NOT NULL
);

CREATE TABLE Jugadores (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    equipo_id INT NOT NULL REFERENCES Equipos(id),
    nombre VARCHAR(128) NOT NULL,
    numero TINYINT NOT NULL,
    fecha_nacimiento DATE NULL,
    capitan BOOLEAN NOT NULL DEFAULT 0
);

INSERT INTO Deportes (nombre)
VALUES ('Baloncesto'), ('Fútbol'), ('Balonmano'), ('Hockey'), ('Waterpolo');
