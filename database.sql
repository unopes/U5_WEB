create database examenfinal;
use examenfinal;

create table viajes(
	ID INT primary KEY auto_increment,
    NOMBRE VARCHAR(100),
    DESCRIPCION VARCHAR(5000),
    PRECIO FLOAT
);

TRUNCATE TABLE viajes;

SELECT * FROM viajes;

DELETE FROM viajes WHERE ID = 1;