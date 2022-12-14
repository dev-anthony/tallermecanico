-- Tablas:
-- Rol
-- Alamcen
-- Empleado
-- Vehiculo

drop database if exists tallermecanico;

create database if not exists tallermecanico;

use tallermecanico;

create table if not exists rol (
  id_rol tinyint(5) not null auto_increment,
  tipo_rol varchar(30) not null,
  primary key (id_rol)
);

create table if not exists usuario (
  id_usuario int not null auto_increment,
  nombre_usuario varchar(255) not null,
  apellido_paterno varchar(255) not null,
  apellido_materno varchar(255),
  password text not null,
  primary key (id_usuario),
  id_rol tinyint(5),
  constraint fk_rol_usuario foreign key (id_rol) references rol (id_rol) on delete cascade on update cascade
);

create table if not exists almacen (
  id_almacen int not null auto_increment,
  nombre_refaccion varchar(255) not null,
  cantidad_refaccion int not null,
  precio_unitario int not null,
  precio_venta int not null,
  primary key (id_almacen),
  id_rol tinyint(5),
  constraint fk_rol_almacen foreign key (id_rol) references rol (id_rol) on delete cascade on update cascade
);

create table if not exists vehiculo (
  id_vehiculo int not null auto_increment,
  nombre_propietario varchar(255) not null,
  apellido_paterno varchar(255) not null,
  apellido_materno varchar(255) not null,
  marca_vehiculo varchar(100) not null,
  modelo_vehiculo varchar(100),
  matricula_vehiculo varchar(7),
  tipo_servicio varchar(255),
  primary key (id_vehiculo),
  id_usuario int,
  constraint fk_usuario_vehiculo foreign key (id_usuario) references usuario (id_usuario) on delete cascade on update cascade
);

insert into rol value (1, 'administrador');
insert into rol value (2, 'empleado');

insert into almacen value (null, 'retrovisor',      200,  200,  280,  1);
insert into almacen value (null, 'faros de niebla', 125,  328,  350,  1);
insert into almacen value (null, 'balatas',         55,   400,  525,  1);
insert into almacen value (null, 'caja de cambios', 25,   1200, 1800, 1);
insert into almacen value (null, 'neumaticos',      150,  1300, 1525, 1);

insert into usuario value (1, 'luis',     'mustaine', 'de la paz',  '1234', 1);
insert into usuario value (2, 'juanito',  'perez',    'martinez',   '1234', 2);
insert into usuario value (3, 'jose',     'flores',   'mendez',     '1234', 2);
insert into usuario value (4, 'manuel',   'medrano',  'ortiz',      '1234', 2);
insert into usuario value (5, 'ezequiel', 'madero',   'paz',        '1234', 2);

insert into vehiculo value (null, 'manuel',   'lopez',    'mendoza',  'audi',     'A1',           'AGSAG01',  'cambio de aceite',               4);
insert into vehiculo value (null, 'yuliana',  'martinez', 'orozco',   'jetta',    'Advance 110',  'MEXMX15',  'alineacion',                     3);
insert into vehiculo value (null, 'enrrique', 'sanchez',  'perez',    'bmw',      'Z4',           'GQRFG05',  'cambio de caja de transmision',  5);
insert into vehiculo value (null, 'manuel',   'lopez',    'mendoza',  'Honda',    'Accrod',       'UPIOQ84',  'cambio de amortiguadores',       2);