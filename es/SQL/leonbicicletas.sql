DROP DATABASE IF EXISTS leonbicicletas;

CREATE DATABASE leonbicicletas;

USE leonbicicletas;

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

-- --------------------------------------------------------

CREATE TABLE detalle (
    idDet int primary key auto_increment,
    idCot int(10),
    idProd int(10),
    precio decimal(20,2),
    cantidadProd int(10),
    totalProd decimal(60,2)
);

-- --------------------------------------------------------

CREATE TABLE auditoria (
    idAud int primary key auto_increment,
    accion varchar(500),
    fecha datetime default now()
);

-- --------------------------------------------------------

create table empleados (
idEmple int primary key auto_increment,
nomEmple varchar(45),
apeEmple varchar(45),
isadmin int(1),
usr varchar(45),
passwd varchar(300)
);

-- --------------------------------------------------------

create table productos (
idProd int primary key auto_increment,
nomProd varchar(45),
imgProd varchar(45),
descripcionProd varchar(200),
precio int(10),
stock int(10),
idCat int(10)
);

-- --------------------------------------------------------

create table categoria (
idCat int primary key auto_increment,
nomCat varchar(45),
descripcionCat varchar(100)
);

-- --------------------------------------------------------

create table clientes (
idCli int primary key auto_increment,
nomCli varchar(45),
apeCli varchar(45),
telCli varchar(15),
correo varchar(45)
);

-- --------------------------------------------------------

create table contacto (
idContact int primary key auto_increment,
nombre varchar (45) not null,
telefono varchar(15) not null,
correo varchar(45),
texto varchar(500) not null
);

-- --------------------------------------------------------

create table prodEn (        
    idProd int primary key auto_increment,
    nomProd varchar(45),
    imgProd varchar(45),
    descripcionProd varchar(200),
    precio int(10),
    stock int(10),
    idCat int(10)
)
