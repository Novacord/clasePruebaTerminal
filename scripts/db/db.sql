
USE prueba;
CREATE TABLE Person(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(80) NOT NULL,
    apellido1 VARCHAR(100) NOT NULL,
    apellido2 VARCHAR(100) NULL,
    DNI VARCHAR(10) NOT NULL
);

CREATE TABLE coches(
    matricula VARCHAR(7) NOT NULL PRIMARY KEY,
    marca VARCHAR(45) NOT NULL,
    modelo VARCHAR(45) NOT NULL,
    caballos INT(11) NOT NULL
);


CREATE TABLE coche_vs_persona(
  Coche_Matricula VARCHAR(7),
  Persona_id INT(11) 
);

ALTER TABLE coche_vs_persona
ADD CONSTRAINT Person_id
FOREIGN KEY (Persona_id) REFERENCES Person(id);

ALTER TABLE coche_vs_persona
ADD CONSTRAINT Coche_Matricula
FOREIGN KEY (Coche_Matricula) REFERENCES coches(matricula);