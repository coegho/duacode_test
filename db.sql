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

INSERT INTO Deportes (nombre)
VALUES ('Baloncesto'), ('Fútbol'), ('Balonmano'), ('Hockey'), ('Waterpolo');
