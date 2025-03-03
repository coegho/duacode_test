CREATE TABLE Deportes (
    id SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(128) NOT NULL
);

CREATE TABLE Equipos (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(128) NULL,
    ciudad VARCHAR(128) NULL,
    deporte SMALLINT NULL REFERENCES Deportes(id),
    fecha_creacion TIMESTAMP
);

INSERT INTO Deportes (nombre)
VALUES ('Baloncesto'), ('Fútbol'), ('Balonmano'), ('Hockey'), ('Waterpolo');
