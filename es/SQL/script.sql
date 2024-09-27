DROP DATABASE IF EXISTS leonbicicletas;

CREATE DATABASE leonbicicletas;

USE leonbicicletas;

CREATE TABLE auditoria
(
    idAud  int primary key auto_increment,
    accion varchar(300),
    fecha  datetime default now()
);


create table empleados
(
    idEmple  int primary key auto_increment,
    nomEmple varchar(45),
    apeEmple varchar(45),
    isadmin  int(1),
    usr      varchar(45),
    passwd   varchar(100)
);

DELIMITER //
DROP PROCEDURE IF EXISTS cEmple//
CREATE PROCEDURE cEmple(nombre varchar(45), apellido varchar(45), permisos int(1), usuario varchar(45),
                        contrasena varchar(100))
BEGIN
    INSERT INTO empleados (nomEmple, apeEmple, isadmin, usr, passwd)
    VALUES (nombre, apellido, usuario, permisos, contrasena);
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS rEmple//
CREATE PROCEDURE rEmple(id int)
BEGIN
    SELECT nomEmple, apeEmple, usr
    FROM empleados
    WHERE idEmple = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS uEmple//
CREATE PROCEDURE uEmple(id int, nombre varchar(45), apellido varchar(45), permisos int(1), usuario varchar(45),
                        contrasena varchar(100))
BEGIN
    UPDATE empleados
    SET nomEmple = nombre,
        apeEmple = apellido,
        isadmin  = permisos,
        usr      = usuario,
        passwd   = contrasena
    WHERE idEmple = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dEmple//
CREATE PROCEDURE dEmple(id int)
BEGIN
    DELETE
    FROM empleados
    WHERE idEmple = id;
END//
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerEmple;
CREATE TRIGGER triggerEmple
    BEFORE DELETE
    ON empleados
    FOR EACH ROW
BEGIN
    INSERT INTO auditoria
    VALUES (CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó el empleado: ', OLD.idEmple,
                   ' - ', OLD.nomEmple, ', de la tabla empleado'));
END $$
DELIMITER ;

-- --------------------------------------------------------

create table productos
(
    idProd          int primary key auto_increment,
    nomProd         varchar(45),
    imgProd         varchar(45),
    descripcionProd varchar(200),
    precio          int(10),
    stock           int(10),
    idCat           int(10)
);

-- SELECT * FROM productos
DELIMITER //
DROP PROCEDURE IF EXISTS AllProd //
CREATE PROCEDURE AllProd()
BEGIN
    SELECT idProd          as identifier,
           nomProd         as nombre,
           imgProd         as imagen,
           descripcionProd as descripcion,
           precio          as valor,
           stock           as cantidad,
           idCat           as categoria
    FROM productos;
END//
DELIMITER ;

-- Last 3 products
DELIMITER //
DROP PROCEDURE IF EXISTS lastProd //
CREATE PROCEDURE lastProd()
BEGIN
    SELECT idProd          as identifier,
           nomProd         as nombre,
           imgProd         as imagen,
           descripcionProd as descripcion,
           precio          as valor,
           stock           as cantidad,
           idCat           as categoria
    FROM productos
    ORDER BY idProd DESC
    LIMIT 3;
END//
DELIMITER ;

-- Ver Producto
DELIMITER //
DROP PROCEDURE IF EXISTS verProducto //
CREATE PROCEDURE verProducto(productID int)
BEGIN
    SELECT idProd          as identifier,
           nomProd         as nombre,
           imgProd         as imagen,
           descripcionProd as descripcion,
           precio          as valor,
           stock           as cantidad
    FROM productos
    WHERE idProd = productID;
END//
DELIMITER ;


DELIMITER //
DROP PROCEDURE IF EXISTS cProd//
CREATE PROCEDURE cProd(nombre varchar(45), img varchar(45), descripcion varchar(200), precio int(10), cantidad int(10),
                       categoria int(10))
BEGIN
    INSERT INTO productos (nomProd, imgProd, descripcionProd, precio, stock, idCat)
    VALUES (nombre, img, descripcion, precio, cantidad, categoria);
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS rProd//
CREATE PROCEDURE rProd(id int)
BEGIN
    SELECT *
    FROM productos
    WHERE idProd = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS uProd//
CREATE PROCEDURE uProd(id int, nombre varchar(45), img varchar(45), descripcion varchar(200), precio varchar(10),
                       cantidad int(10), idCategoria int(10))
BEGIN
    UPDATE productos
    SET nomProd         = nombre,
        imgProd         = img,
        descripcionProd = descripcion,
        precio          = precio,
        stock           = cantidad,
        idCat           = idCategoria
    WHERE idProd = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dProd//
CREATE PROCEDURE dProd(id int)
BEGIN
    DELETE
    FROM productos
    WHERE idProd = id;
END//
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerProd;
CREATE TRIGGER triggerProd
    BEFORE DELETE
    ON productos
    FOR EACH ROW
BEGIN
    INSERT INTO auditoria
    VALUES (CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó el producto: ', OLD.idProd,
                   ' - ', OLD.nomProd, ', de la tabla producto'));
END $$
DELIMITER ;

-- --------------------------------------------------------

create table categoria
(
    idCat          int primary key auto_increment,
    nomCat         varchar(45),
    descripcionCat varchar(100)
);

DELIMITER //
DROP PROCEDURE IF EXISTS cCat//
CREATE PROCEDURE cCat(nombre varchar(45), descripcion varchar(100))
BEGIN
    INSERT INTO categoria (nomCat, descripcionCat)
    VALUES (nombre, descripcion);
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS rCat//
CREATE PROCEDURE rCat(id int)
BEGIN
    SELECT *
    FROM categoria
    WHERE idCat = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS uCat//
CREATE PROCEDURE uCat(id int, nombre varchar(45), descripcion varchar(100))
BEGIN
    UPDATE categoria
    SET nomCat         = nombre,
        descripcionCat = descripcion
    WHERE idCat = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dCat//
CREATE PROCEDURE dCat(id int)
BEGIN
    DELETE
    FROM categoria
    WHERE idCat = id;
END//
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerCat;
CREATE TRIGGER triggerCat
    BEFORE DELETE
    ON categoria
    FOR EACH ROW
BEGIN
    INSERT INTO auditoria
    VALUES (CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó la categoria: ', OLD.idCat,
                   ' - ', OLD.nomCat, ', de la tabla categoria'));
END $$
DELIMITER ;

-- --------------------------------------------------------

create table clientes
(
    idCli  int primary key auto_increment,
    nomCli varchar(45),
    apeCli varchar(45),
    telCli varchar(15),
    correo varchar(45)
);

DELIMITER //
DROP PROCEDURE IF EXISTS cCli//
CREATE PROCEDURE cCli(nombre varchar(45), apellido varchar(45), telefono varchar(15), email varchar(45))
BEGIN
    INSERT INTO clientes (nomCli, apeCli, telCli, correo)
    VALUES (nombre, apellido, telefono, email);
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS rCli//
CREATE PROCEDURE rCli(id int)
BEGIN
    SELECT *
    FROM clientes
    WHERE idCli = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS uCli//
CREATE PROCEDURE uCli(id int, nombre varchar(45), apellido varchar(45), telefono varchar(15), email varchar(45))
BEGIN
    UPDATE clientes
    SET nomCli = nombre,
        apeCli = apellido,
        telCli = telefono,
        correo = email
    WHERE idCli = id;
END//
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dCli//
CREATE PROCEDURE dCli(id int)
BEGIN
    DELETE
    FROM clientes
    WHERE idCli = id;
END//
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerCli;
CREATE TRIGGER triggerCli
    BEFORE DELETE
    ON clientes
    FOR EACH ROW
BEGIN
    INSERT INTO auditoria
    VALUES (CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó el clientes: ', OLD.idCli,
                   ' - ', OLD.nomCli, ', de la tabla clientes'));
END $$
DELIMITER ;

-- --------------------------------------------------------

CREATE TABLE detalle
(
    idDet        int primary key auto_increment,
    idCot        int(10),
    idProd       int(10),
    precio       decimal(20, 2),
    cantidadProd int(10),
    totalProd    decimal(60, 2)
);

-- Insert detalle
DELIMITER //
DROP PROCEDURE IF EXISTS detail//
CREATE PROCEDURE detail(ticket INT(10), producto INT(10), costo decimal(20, 2), unidadesProd INT(10),
                        totalDetalle INT(10))
BEGIN
    INSERT INTO detalle (idCot, idProd, precio, cantidadProd, totalProd)
    VALUES (ticket, producto, costo, unidadesProd, totalDetalle);
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
CREATE PROCEDURE uDetalle(id INT(10), ticket INT(10), producto INT(10), precio decimal(20, 2), unidadesProd INT(10),
                          total INT(10))
BEGIN
    UPDATE detalle
    SET idCot        = ticket,
        idProd       = producto,
        precio       = precio,
        cantidadProd = unidadesProd,
        totalProd    = total
    WHERE idDet = id;
END //
DELIMITER ;

DELIMITER //
DROP PROCEDURE IF EXISTS dDetalle//
CREATE PROCEDURE dDetalle(id INT(10))
BEGIN
    DELETE
    FROM detalle
    WHERE idDet = id;
END //
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS triggerDetalle;
CREATE TRIGGER triggerDetalle
    BEFORE DELETE
    ON detalle
    FOR EACH ROW
BEGIN
    INSERT INTO auditoria
    VALUES (CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó el detalle de orden: ',
                   OLD.idDet, ', de la tabla detalle'));
END $$
DELIMITER ;


-- --------------------------------------------------------

create table contacto
(
    idContact int primary key auto_increment,
    nombre    varchar(45)  not null,
    telefono  varchar(15)  not null,
    correo    varchar(45),
    texto     varchar(500) not null
);

-- Insert contacto
DELIMITER //
DROP PROCEDURE IF EXISTS contacto//
CREATE PROCEDURE contacto(nomContacto VARCHAR(45), telContacto VARCHAR(15), email VARCHAR(45),
                          textoContacto VARCHAR(500))
BEGIN
    INSERT INTO contacto (nombre, telefono, correo, texto)
    VALUES (nomContacto, telContacto, email, textoContacto);
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
CREATE PROCEDURE uContacto(id INT, nombre VARCHAR(45), telefono VARCHAR(15), email VARCHAR(45),
                           textoContacto VARCHAR(500))
BEGIN
    UPDATE contacto
    SET nombre   = nombre,
        telefono = telefono,
        correo   = email,
        texto    = textoContacto
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
    BEFORE DELETE
    ON contacto
    FOR EACH ROW
BEGIN
    INSERT INTO auditoria
    VALUES (CONCAT('Modificacion realizada por ', USER(), ' el dia ', NOW(), '. Se eliminó el contacto: ',
                   OLD.idContact, ' - ', OLD.nombre, ', de la tabla contacto'));
END $$
DELIMITER ;


-- --------------------------------------------------------

CREATE TABLE cotizaciones
(
    idCot  int primary key auto_increment,
    fecha  datetime    default now(),
    nomCot varchar(45) not null,
    telCot varchar(15) not null,
    correo varchar(45) not null,
    total  decimal(60, 2),
    estado varchar(45) default 'Pendiente'
);
SELECT LAST_INSERT_ID();

-- Insert cotizacion
DELIMITER //
DROP PROCEDURE IF EXISTS enviar//
CREATE PROCEDURE enviar(nombre VARCHAR(45), telefono VARCHAR(15), email VARCHAR(45), totalOrden decimal(60, 2))
BEGIN
    INSERT INTO cotizaciones (nomCot, telCot, correo, total)
    VALUES (nombre, telefono, email, totalOrden);
END //
DELIMITER ;

-- Last id 
DELIMITER //
DROP PROCEDURE IF EXISTS LastId//
CREATE PROCEDURE lastId()
BEGIN
    SELECT MAX(idCot) AS identifier FROM cotizaciones;
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
CREATE PROCEDURE uCot(id INT(10), cotizacion int, nombre VARCHAR(45), telefono VARCHAR(15), email VARCHAR(45),
                      total decimal(60, 2), estado VARCHAR(45))
BEGIN
    UPDATE cotizaciones
    SET idCot  = cotizacion,
        nomCot = nombre,
        telCot = telefono,
        correo = email,
        total  = total,
        estado = estado
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


INSERT INTO productos (nomProd, imgProd, descripcionProd, precio, stock, idCat)
VALUES ('Bicicleta de montaña 26x4.50', 'bike2.jpeg',
        'Bicicleta de montaña 26x4.5 con marco de aluminio en color azul claro componentes Shimano y frenos de disco.',
        17990, 5, 1),
       ('Bicicleta de ruta 700x28', 'bike3.jpeg',
        'Bicicleta de ruta 700x28 con marco de aluminio en color verde claro componentes Shimano y frenos de disco.',
        15663, 7, 1),
       ('Bicicleta de montaña 29x2.125', 'bike4.jpeg',
        'Bicicleta de montaña 29x2.125 con marco de aluminio en color azul claro componentes Shimano y frenos de disco.',
        8399, 13, 1),
       ('Bicicleta de ruta 700x23', 'bike5.jpeg',
        'Bicicleta de ruta 700x23 con marco de aluminio en color blanco componentes Shimano y frenos de aluminio shimano. ',
        9499, 6, 1),
       ('Bicicleta tipo balona 20x2.125', 'bike6.jpeg',
        'Bicicleta tipo balona 20x2.125 con marco metálico en color rojo componentes Shimano y freno retro pedal.',
        3599, 29, 1),
       ('Rin 26x2.125', 'refaccion1.jpeg', 'Par de rines rodada 26 de 36 rayos con aro de aluminio.', 590, 36, 3),
       ('Juegos de frenos de disco', 'refaccion2.jpeg',
        'Juego freno de disco: incluye maza trasera, delantera, par de discos mediada 160" y manivelas de aluminio.',
        1295, 19, 3),
       ('Juegos de cambios', 'refaccion3.jpeg', 'Juego de cambios marca Shimano 21 velocidades y manivelas de freno.',
        610, 31, 3),
       ('Cámara R29', 'refaccion4.jpeg',
        'Cámara rodada 29 x 2.10 con válvula americana a 64mm de bronce con liquido antiponchaduras incluido.', 230,
        239, 3),
       ('Llantas 29 X 2.35', 'refaccion5.jpeg', 'Llanta 29x2.30 tubeless mtb todo terreno.', 1550, 18, 3),
       ('Eje centro Octalink', 'refaccion6.jpeg',
        'Eje de centro 68mm de balero sellado con rasurado octalink para un mejor agarre.', 460, 21, 3),
       ('Pedales 1/2 Aluminio', 'refaccion7.jpeg', 'Par de pedales de 1/2 con cuerpo de aluminio y rodamiento sellado',
        599, 37, 3),
       ('Asiento mtb', 'refaccion8.jpeg', 'Asiento de gel con recubrimiento de piel sintética sin abrazadera.', 485, 16,
        3),
       ('Parches', 'refaccion9.jpeg', 'Caja de parches 48 piezas vulcanizado en frio.', 40, 102, 3),
       ('Cables', 'refaccion10.jpeg', 'Juego de cables acerado mtb delantero, trasero y forro con teflon.', 115, 1018,
        3),
       ('Casco', 'accesorio1.jpeg',
        'Casco para mtb o cross con cubierta de fibra de carbono, ventilación y ajuste 360º.', 825, 11, 2),
       ('Linterna', 'accesorio2.jpeg',
        'Linterna recargable de 1500 lúmenes con cambio de intensidad, estrobo y claxon integrado.', 389, 9, 2),
       ('Bolsa', 'accesorio3.jpeg', 'Bolsa impermeable universal con soporte para celulares.', 390, 15, 2),
       ('Diablos', 'accesorio4.jpeg', 'Diablos traseros con cuerpo de aluminio torneado.', 135, 24, 2),
       ('Corneta', 'accesorio5.jpeg', 'Corneta de acero con abrazadera ajustable a múltiples posiciones.', 145, 25, 2),
       ('Engrasado general', 'servicio8.jpeg',
        'Engrasado completo de rodamientos, incluye ambos rines, centro, horquilla, limpieza de componentes y cuadro',
        390, 100000, 4),
       ('Ajuste de freno', 'servicio13.jpeg', 'Ajuste de frenos, incluye cables y lubricación de lineas', 150, 100000,
        4),
       ('Ajuste de cambio', 'servicio14.jpeg', 'Ajuste de cambios, incluye cables y lubricación de lineas', 150, 100000,
        4),
       ('Nivelación', 'servicio9.jpeg', 'Nivelación de rin', 120, 100000, 4),
       ('Desponchado y carga de líquido antiponchaduras', 'servicio15.jpeg',
        'Desponchado con parches de alta calidad de vulcanizado en frío y carga de liquido sellador', 140, 100000, 4);

INSERT INTO categoria (nomCat, descripcionCat)
VALUES ('Bicicletas', 'Bicicletas completas y armadas'),
       ('Accesorios', 'Accesorios para ti y para tú bicicleta'),
       ('Refacciones', 'Refacciones y repuestos para bicicletas'),
       ('Servicios', 'Servicios de taller y mantenimiento para bicicletas');

INSERT INTO empleados (nomEmple, apeEmple, isadmin, usr, passwd)
VALUES ('Juan', 'Cardona', '1', 'root',
        '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2' -- yH!44@I!3AFI
       ),
       ('Eduardo', 'Nuñez', '1', 'jnunez01', '5b112d8e1dcb00581a6f61d3d15611bf' -- %nT5&2N6JRN6
       ),
       ('Hugo', 'Chaparro', '1', 'hchaparro01', 'e0b00ad8dbc8da960037c2638ca9cd54' -- uCSEyZ74228%
       ),
       ('Luis', 'Perez', '0', 'luisp', '1bd9e55d25f043417c98d2516185592b' -- R3Z$B!7spD9i
       ),
       ('Maria', 'Gonzalez', '0', 'mariag', '94bcba1f3c979123429e3a72d1b336e2' -- nat5%$A&7y4y
       ),
       ('Pedro', 'Garcia', '0', 'pedrog', '	a4d8e8af54e200b745f70df292b94a10' -- 92hSAO8sr#oD
       );
