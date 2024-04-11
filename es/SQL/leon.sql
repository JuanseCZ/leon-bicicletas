DROP DATABASE IF EXISTS leonbicicletas;

CREATE DATABASE leonbicicletas;

USE leonbicicletas;

CREATE TABLE auditoria (
    idAud int primary key auto_increment,
    accion varchar(300),
    fecha datetime default now()
);


create table empleados (
idEmple int primary key auto_increment,
nomEmple varchar(45),
apeEmple varchar(45),
isadmin int(1),
usr varchar(45),
passwd varchar(100)
);

DELIMITER //
DROP PROCEDURE IF EXISTS cEmple//
CREATE PROCEDURE cEmple (nombre varchar(45), apellido varchar(45), permisos int(1), usuario varchar(45), contrasena varchar(100))
BEGIN
INSERT INTO empleados (nomEmple, apeEmple, isadmin, usr, passwd)
VALUES (nombre, apellido, usuario, permisos, contrasena);
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS rEmple//
CREATE PROCEDURE rEmple (id int)
BEGIN
SELECT nomEmple, apeEmple, usr
FROM empleados
WHERE idEmple = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS uEmple//
CREATE PROCEDURE uEmple (id int, nombre varchar(45), apellido varchar(45), permisos int(1), usuario varchar(45), contrasena varchar(100))
BEGIN
UPDATE empleados
SET nomEmple = nombre, apeEmple = apellido, isadmin = permisos, usr = usuario, passwd = contrasena
WHERE idEmple = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dEmple//
CREATE PROCEDURE dEmple (id int)
BEGIN
DELETE FROM empleados
WHERE idEmple = id;
END//
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerEmple;
CREATE TRIGGER triggerEmple
	BEFORE DELETE ON empleados
    FOR EACH ROW 
BEGIN
	INSERT INTO auditoria VALUES(
    CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó el empleado: ', OLD.idEmple, ' - ', OLD.nomEmple,', de la tabla empleado'));
END $$
DELIMITER ;

-- --------------------------------------------------------

create table producto (
idProd int primary key auto_increment,
nomProd varchar(45),
imgProd varchar(45),
descripcionProd varchar(200),
precioProd int(10),
stock int(10),
idCat int(10)
);

DELIMITER //
DROP PROCEDURE IF EXISTS cProd//
CREATE PROCEDURE cProd (nombre varchar(45), img varchar(45), descripcion varchar(200), precio int(10), cantidad int(10), categoria int(10))
BEGIN
INSERT INTO producto (nomProd, imgProd, descripcionProd, precioProd, stock, idCat)
VALUES (nombre, img, descripcion, precio, cantidad, categoria);
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS rProd//
CREATE PROCEDURE rProd (id int)
BEGIN
SELECT *
FROM producto
WHERE idProd = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS uProd//
CREATE PROCEDURE uProd (id int, nombre varchar(45), img varchar(45), descripcion varchar(200), precio varchar(10), cantidad int(10), idCategoria int(10))
BEGIN
UPDATE producto
SET nomProd = nombre, imgProd = img, descripcionProd = descripcion, precioProd = precio, stock = cantidad, idCat = idCategoria
WHERE idProd = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dProd//
CREATE PROCEDURE dProd (id int)
BEGIN
DELETE FROM producto
WHERE idProd = id;
END//
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerProd;
CREATE TRIGGER triggerProd
	BEFORE DELETE ON producto
    FOR EACH ROW 
BEGIN
	INSERT INTO auditoria VALUES(
    CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó el producto: ', OLD.idProd, ' - ', OLD.nomProd,', de la tabla producto'));
END $$
DELIMITER ;

-- --------------------------------------------------------

create table categoria (
idCat int primary key auto_increment,
nomCat varchar(45),
descripcionCat varchar(100)
);

DELIMITER //
DROP PROCEDURE IF EXISTS cCat//
CREATE PROCEDURE cCat (nombre varchar(45), descripcion varchar(100))
BEGIN
INSERT INTO categoria (nomCat, descripcionCat)
VALUES (nombre, descripcion);
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS rCat//
CREATE PROCEDURE rCat (id int)
BEGIN
SELECT *
FROM categoria
WHERE idCat = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS uCat//
CREATE PROCEDURE uCat (id int, nombre varchar(45), descripcion varchar(100))
BEGIN
UPDATE categoria
SET nomCat = nombre, descripcionCat = descripcion
WHERE idCat = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dCat//
CREATE PROCEDURE dCat (id int)
BEGIN
DELETE FROM categoria
WHERE idCat = id;
END//
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerCat;
CREATE TRIGGER triggerCat
	BEFORE DELETE ON categoria
    FOR EACH ROW 
BEGIN
	INSERT INTO auditoria VALUES(
    CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó la categoria: ', OLD.idCat, ' - ', OLD.nomCat,', de la tabla categoria'));
END $$
DELIMITER ;

-- --------------------------------------------------------

create table clientes (
idCli int primary key auto_increment,
nomCli varchar(45),
apeCli varchar(45),
telCli varchar(15),
correo varchar(45)
);

DELIMITER //
DROP PROCEDURE IF EXISTS cCli//
CREATE PROCEDURE cCli (nombre varchar(45), apellido varchar(45), telefono varchar(15), email varchar(45))
BEGIN
INSERT INTO clientes (nomCli, apeCli, telCli, correo)
VALUES (nombre, apellido, telefono, email);
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS rCli//
CREATE PROCEDURE rCli (id int)
BEGIN
SELECT *
FROM clientes
WHERE idCli = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS uCli//
CREATE PROCEDURE uCli (id int, nombre varchar(45), apellido varchar(45), telefono varchar(15), email varchar(45))
BEGIN
UPDATE clientes
SET nomCli = nombre, apeCli = apellido, telCli = telefono, correo = email
WHERE idCli = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dCli//
CREATE PROCEDURE dCli (id int)
BEGIN
DELETE FROM clientes
WHERE idCli = id;
END//
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerCli;
CREATE TRIGGER triggerCli
	BEFORE DELETE ON clientes
    FOR EACH ROW 
BEGIN
	INSERT INTO auditoria VALUES(
    CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó el clientes: ', OLD.idCli, ' - ', OLD.nomCli,', de la tabla clientes'));
END $$
DELIMITER ;

-- --------------------------------------------------------

CREATE TABLE detalle (
    idDet int primary key auto_increment,
    idCot int(10),
    idProd int(10),
    precio decimal(20,2),
    cantidadProd int(10),
    totalProd decimal(60,2)
);

DELIMITER //
DROP PROCEDURE IF EXISTS cDetalle//
CREATE PROCEDURE cDetalle(ticket INT(10), producto INT(10), precio decimal(20,2), unidadesProd INT(10), total INT(10))
BEGIN
  INSERT INTO detalle (idCot, idProd, precio, cantidadProd, totalProd)
  VALUES (ticket, producto, precio, unidadesProd, total);
END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS rDetalle//
CREATE PROCEDURE LeerDetalle(id INT(10))
BEGIN
  SELECT * FROM detalle WHERE idDet = id;
END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS uDetalle//
CREATE PROCEDURE uDetalle(ticket INT(10), producto INT(10), precio decimal(20,2), unidadesProd INT(10), total INT(10))
BEGIN
  UPDATE detalle
  SET idCot = ticket, idProd = producto, precio = precio, cantidadProd = unidadesProd, totalProd = total
  WHERE idDet = id;
END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dDetalle//
CREATE PROCEDURE dDetalle(id INT(10))
BEGIN
  DELETE FROM detalle
  WHERE idDetalle = id;
END //
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerDetalle;
CREATE TRIGGER triggerDetalle
	BEFORE DELETE ON detalle
    FOR EACH ROW 
BEGIN
	INSERT INTO auditoria VALUES(
    CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó el detalle de orden: ', OLD.idDet,', de la tabla detalle'));
END $$
DELIMITER ;


-- --------------------------------------------------------

create table contacto (
idContact int primary key auto_increment,
nombre varchar (45) not null,
telefono varchar(15) not null,
correo varchar(45),
texto varchar(500) not null
);

DELIMITER //
DROP PROCEDURE IF EXISTS cContacto//
CREATE PROCEDURE cContacto(nombre VARCHAR(45), telefono VARCHAR(15), email VARCHAR(45), textoContacto VARCHAR(500))
BEGIN
    INSERT INTO contacto (nombre, telefono, correo, texto)
    VALUES (nombre, telefono, email, textoContacto);
END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS rContacto//
CREATE PROCEDURE rContacto(id INT(10))
BEGIN
    SELECT * FROM contacto WHERE idContact = id;
END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS uContacto//
CREATE PROCEDURE uContacto(id INT, nombre VARCHAR(45), telefono VARCHAR(15), email VARCHAR(45), textoContacto VARCHAR(500))
BEGIN
    UPDATE contacto
    SET nombre = nombre, telefono = telefono, correo = email, texto = textoContacto
    WHERE idContact = id;
END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dContacto//
CREATE PROCEDURE dContacto(id INT)
BEGIN
    DELETE FROM contacto WHERE idContact = id;
END //
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerContact;
CREATE TRIGGER triggerContact
	BEFORE DELETE ON contacto
    FOR EACH ROW 
BEGIN
	INSERT INTO auditoria VALUES(
    CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó el contacto: ', OLD.idContact, ' - ', OLD.nombre,', de la tabla contacto'));
END $$
DELIMITER ;


-- --------------------------------------------------------

CREATE TABLE cotizaciones (
    idCot int primary key auto_increment,
    fecha datetime default now(),
    nomCot varchar(45) not null,
    telCot varchar(15) not null,
    correo varchar(45) not null,
    total decimal(60,2),
    estado varchar(45) default 'Pendiente'
);

DELIMITER //
DROP PROCEDURE IF EXISTS cCot//
CREATE PROCEDURE cCot(cotizacion int, nombre VARCHAR(45), telefono VARCHAR(15), email VARCHAR(45), total decimal(60,2), estado VARCHAR(45))
BEGIN
    INSERT INTO cotizaciones (idCot, nomCot, telCot, correo, total, estado)
    VALUES (cotizacion, nombre, telefono, email, total, estado);
END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS rCot//
CREATE PROCEDURE rCot(id INT(10))
BEGIN
    SELECT * FROM cotizaciones WHERE idCot = id;
END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS uCot//
CREATE PROCEDURE uCot(cotizacion int, nombre VARCHAR(45), telefono VARCHAR(15), email VARCHAR(45), total decimal(60,2), estado VARCHAR(45))
BEGIN
    UPDATE cotizaciones
    SET idCot = cotizacion, nomCot = nombre, telCot = telefono, correo = email, total = total, estado = estado
    WHERE idCot = id;
END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dCot//
CREATE PROCEDURE dCot(id INT)
BEGIN
    DELETE FROM cotizaciones WHERE idCot = id;
END //
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerContact;
CREATE TRIGGER triggerContact
	BEFORE DELETE ON cotizaciones
    FOR EACH ROW 
BEGIN
	INSERT INTO auditoria VALUES(
    CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó la cotización: ', OLD.idCot, ' - ', OLD.nomCot,', de la tabla contacto'));
END $$
DELIMITER ;































