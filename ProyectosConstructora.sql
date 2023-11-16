CREATE DATABASE sgpc;
drop database sgpc;

CREATE TABLE TipoUsuario (
    idTu INT AUTO_INCREMENT PRIMARY KEY,
    rol VARCHAR(30) NOT NULL
);

CREATE TABLE Estado (
    codigo CHAR(5) PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL
);

CREATE TABLE Proyecto (
    idProyecto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    ubicacion VARCHAR(100) NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFinal DATE NOT NULL,
    estado CHAR(3) NOT NULL,
    FOREIGN KEY (estado) REFERENCES Estado(codigo)
);

CREATE TABLE Tarea (
    idTarea int auto_increment PRIMARY KEY,
    titulo VARCHAR(40) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    estado CHAR(3) NOT NULL,
    idProyecto INT NOT NULL,
    FOREIGN KEY (estado) REFERENCES Estado(codigo),
    FOREIGN KEY (idProyecto) REFERENCES Proyecto(idProyecto)
);


CREATE TABLE ProyectoTarea (
    idProyecto INT NOT NULL,
    idTarea int NOT NULL,
    fechaInicio DATE NOT NULL,
    fechaFinal DATE NOT NULL,
    PRIMARY KEY (idProyecto, idTarea),
    FOREIGN KEY (idProyecto) REFERENCES Proyecto(idProyecto),
    FOREIGN KEY (idTarea) REFERENCES Tarea(idTarea)
);


CREATE TABLE Usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    apellidoPat VARCHAR(50) NOT NULL,
    apellidoMat VARCHAR(50) NOT NULL,
    numTel CHAR(15) NOT NULL,
    email VARCHAR(256) NOT NULL,
    contrasena VARCHAR(30) NOT NULL,
    idTipoUsuario INT NOT NULL,
    FOREIGN KEY (idTipoUsuario) REFERENCES TipoUsuario(idTu)
);


CREATE TABLE UsuarioTarea (
    idUsuario INT NOT NULL,
    idTarea int NOT NULL,
    PRIMARY KEY (idUsuario, idTarea),
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario),
    FOREIGN KEY (idTarea) REFERENCES Tarea(idTarea)
);


CREATE TABLE Comentario (
    idComentario INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL,
    fechaComentario DATE NOT NULL,
    idUsuario INT NOT NULL,
    idTarea int NOT NULL,
    idProyecto INT NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario),
    FOREIGN KEY (idTarea) REFERENCES Tarea(idTarea),
    FOREIGN KEY (idProyecto) REFERENCES Proyecto(idProyecto)
);

CREATE TABLE UsuarioProyecto (
    idUsuario INT NOT NULL,
    idProyecto INT NOT NULL,
    PRIMARY KEY (idUsuario, idProyecto),
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario),
    FOREIGN KEY (idProyecto) REFERENCES Proyecto(idProyecto)
);

CREATE TABLE Modificacion (
    idModificacion INT AUTO_INCREMENT PRIMARY KEY,
    descripcionModificacion VARCHAR(200),
    fechaModificacion DATE NOT NULL,
    idProyecto INT,
    idTarea int,
    idUsuario INT NOT NULL,
    accion VARCHAR(10) NOT NULL,
    FOREIGN KEY (idProyecto) REFERENCES Proyecto(idProyecto),
    FOREIGN KEY (idTarea) REFERENCES Tarea(idTarea),
    FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);
-----------------------------------------------------------------------------------
INSERT INTO TipoUsuario (rol) VALUES ('Administrador'), ('Arquitecto'), ('Empleado');

INSERT INTO Estado (codigo, nombre) VALUES ('ACT','Activo'),('PEN','Pendiente'),('FIN','Finalizado'), ('CAN','Cancelado'), ('RET','Retrasado');

INSERT INTO Proyecto (nombre, descripcion, ubicacion, fechaInicio, fechaFinal, estado)
VALUES
  ('Construcción Hotel', 'Construcción de hotel 5 estrellas','Cancún', '2023-01-15', '2023-12-30', 'ACT'),
  ('Remodelación tienda', 'Remodelar tienda departamental', 'Guadalajara', '2023-02-20', '2023-08-15', 'PEN'),
  ('Ampliación fábrica', 'Ampliar capacidad de fábrica', 'Monterrey', '2023-03-01', '2024-02-28', 'ACT'),
  ('Mejora carretera', 'Mejoramiento carretera federal', 'Oaxaca', '2023-04-15', '2024-01-15', 'PEN'),
  ('Nuevo hospital', 'Construir hospital general', 'Puebla', '2023-05-20', '2024-11-20', 'ACT'),
  ('Remodelación escuela','Remodelar escuela primaria', 'Veracruz', '2023-06-01', '2023-12-15', 'PEN'),
  ('Puente peatonal', 'Construir puente peatonal', 'Guanajuato', '2023-07-10', '2024-02-28','ACT'),
  ('Centro cultural', 'Construir nuevo centro cultural', 'Jalisco', '2023-08-22', '2024-07-30', 'PEN'),  
  ('Parque industrial', 'Desarrollar parque industrial', 'Querétaro', '2023-09-15', '2024-06-30', 'ACT'),
  ('Biblioteca pública', 'Construir biblioteca pública', 'Chiapas', '2023-10-01', '2024-03-15', 'PEN');
  
INSERT INTO Tarea (titulo, descripcion, estado, idProyecto)
VALUES
  ('Cimentación', 'Cimentar terreno para hotel', 'ACT', 1),
  ('Electricidad', 'Cableado electrico tienda', 'PEN', 2),
  ('Compra materiales', 'Comprar materiales de construcción', 'ACT', 3),
  ('Revisión planos', 'Revisar planos carretera', 'PEN', 4),
  ('Equipamiento','Compra de equipo médico', 'ACT', 5),
  ('Pintura', 'Pintar aulas de la escuela', 'PEN', 6),
  ('Diseño', 'Diseño de puente peatonal', 'ACT', 7),
  ('Remodelación teatro','Remodelar teatro del centro cultural','PEN', 8),
  ('Limpieza terreno','Limpiar terreno para parque industrial','ACT', 9),
  ('Compra libros','Adquirir libros para biblioteca','PEN', 10);
  
INSERT INTO ProyectoTarea (idProyecto, idTarea, fechaInicio, fechaFinal)
VALUES
  (1, 1, '2023-01-20', '2023-02-15'),
  (2, 2, '2023-02-25', '2023-03-20'),
  (3, 3, '2023-03-05', '2023-04-05'),
  (4, 4, '2023-04-20', '2023-05-20'), 
  (5, 5, '2023-05-25', '2023-07-25'),
  (6, 6, '2023-06-10', '2023-07-10'),
  (7, 7, '2023-07-15', '2023-09-15'),
  (8, 8, '2023-09-01', '2023-10-30'),
  (9, 9, '2023-09-20', '2023-11-20'),
  (10, 10,'2023-10-10','2023-12-10');  

INSERT INTO Usuario (nombre, apellidoPat, apellidoMat, numTel, email, contrasena, idTipoUsuario)
VALUES
  ('Juan','Pérez','López','5566778899','juan@mail.com','1234abcd',1),
  ('Maria','Gonzalez','Martinez','5577884411','maria@mail.com','qwerty',2),
  ('Pedro','Sánchez','Gómez','5574821634','pedro@mail.com','5678efgh',3),
  ('Ana','Ruiz','Cortés','5511223344','ana@mail.com','asdzxc',3),
  ('Diego','Flores','Morales','5544332211','diego@mail.com','1234qwer',1),
  ('Laura','Cruz','Ortega','5522668800','laura@mail.com','zxcvasdf',2),
  ('Pablo','Muñoz','Diaz','5566778800','pablo@mail.com','asdf1234',3),
  ('Sofia','Vazquez','Ramos','5544332299','sofia@mail.com','4321dcba',3),
  ('Daniel','Torres','Hernandez','5533221100','daniel@mail.com','abcd1234',1),
  ('Valeria','Rivera','Guzman','5588776655','valeria@mail.com','hello123',2);
  
INSERT INTO UsuarioTarea (idUsuario, idTarea) 
VALUES
  (1,1),
  (2,3),
  (3,5),
  (4,7),
  (5,2),
  (6,6),
  (7,9),
  (8,4),
  (9,8),
  (10,10);
  
INSERT INTO Comentario (descripcion, fechaComentario, idUsuario, idTarea, idProyecto)
VALUES
  ('Cimentación finalizada', '2023-02-18', 1, 1, 1),
  ('Materiales comprados', '2023-04-08', 2, 3, 3),
  ('Pintura color amarillo', '2023-07-08', 3, 6, 6), 
  ('Puente con luces LED','2023-09-25',4,7,7),
  ('Cableado terminado','2023-03-15',5,2,2),
  ('Revisión finalizada','2023-05-25',8,4,4),
  ('Remodelación en proceso','2023-10-15',9,8,8),
  ('Compra de 5000 libros','2023-12-01',10,10,10),
  ('Limpieza de 10 hectáreas','2023-11-05',7,9,9),
  ('Compra de camas y equipos','2023-07-20',6,5,5);
  
INSERT INTO UsuarioProyecto (idUsuario, idProyecto)
VALUES
  (1,1),
  (2,3),
  (3,6),
  (4,7),
  (5,2),
  (6,5),
  (7,9),
  (8,4),
  (9,8),
  (10,10);

INSERT INTO Modificacion (descripcionModificacion, fechaModificacion, idProyecto, idUsuario, accion) 
VALUES
  ('Creación proyecto hotel', '2023-01-10', 1, 1, 'INSERT'),
  ('Actualización proyecto tienda', '2023-02-15', 2, 2, 'UPDATE'),
  ('Eliminación proyecto', '2023-03-05', null, 1, 'DELETE'),
  ('Creación tarea cimentación','2023-01-18', 1, 2, 'INSERT'),
  ('Actualización tarea electricidad','2023-02-20', null, 3, 'UPDATE'),  
  ('Eliminación tarea', '2023-03-02', null, 4,'DELETE'),
  ('Creación usuario Juan','2023-01-05', null, 1, 'INSERT'),
  ('Actualización usuario Maria','2023-02-10', null, 2,'UPDATE'),
  ('Eliminación usuario','2023-03-15', null, 3, 'DELETE'),
  ('Insert comentario cimentación','2023-02-18', 1, 1,'INSERT');

  insert into Comentario (descripcion, fechaComentario, idUsuario, idTarea, idProyecto) VALUES
  ('Comentario 1', '2023-03-23',3,5,6),
   ('Comentario 2', '2023-03-23',3,5,6),
    ('Comentario 3', '2023-04-23',3,5,6),
     ('Comentario 4', '2023-05-23',3,5,6),
      ('Comentario 5','2023-06-23',3,5,6),
       ('Comentario 6', '2023-07-23',3,5,6),
        ('Comentario 7', '2023-08-23',3,5,6),
         ('Comentario 8','2023-09-23',3,5,6);
-----------------------------------------------------------------------------------

SET_GLOBAL event_scheduler = ON;

DELIMITER //

CREATE EVENT actualizar_estado_tareas_event
ON SCHEDULE EVERY 1 MINUTE
DO
BEGIN
  UPDATE Tarea
  SET estado = 'RET'
  WHERE estado = 'ACT' AND idTarea IN (
    SELECT PT.idTarea
    FROM ProyectoTarea PT
    JOIN Tarea T ON PT.idTarea = T.idTarea
    WHERE PT.fechaFinal < CURDATE()
  );
END;

//

DELIMITER ;


DELIMITER //

CREATE EVENT actualizar_estado_proyecto_event
ON SCHEDULE EVERY 1 MINUTE
DO
BEGIN
  UPDATE Proyecto
  SET estado = 'RET'
  WHERE estado = 'ACT' AND fechaFinal < CURDATE();
  
END;

//

DELIMITER ;


------------------------------------
SET foreign_key_checks = 0;

-- Eliminar datos de las tablas
DELETE FROM Comentario;
DELETE FROM Modificacion;
DELETE FROM UsuarioProyecto;
DELETE FROM UsuarioTarea;
DELETE FROM ProyectoTarea;
DELETE FROM Tarea;
DELETE FROM Proyecto;
DELETE FROM Usuario;
DELETE FROM Estado;
DELETE FROM TipoUsuario;

-- Reactivar claves foráneas
SET foreign_key_checks = 1;