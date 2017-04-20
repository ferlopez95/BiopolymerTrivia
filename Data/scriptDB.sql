CREATE TABLE TablaUsos (
    id INT NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(30),
    puntos INT,
    PRIMARY KEY (id)
    
);

CREATE TABLE Estructuras (
    id INT NOT NULL AUTO_INCREMENT,
    pregunta VARCHAR(100) NOT NULL,
    correcta VARCHAR(100) NOT NULL,
    d1 VARCHAR(100) NOT NULL,
    d2 VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Usos (
    id INT NOT NULL AUTO_INCREMENT,
    pregunta VARCHAR(100) NOT NULL,
    correcta VARCHAR(100) NOT NULL,
    d1 VARCHAR(100) NOT NULL,
    d2 VARCHAR(100) NOT NULL,
    d3 VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Formaciones (
    id INT NOT NULL AUTO_INCREMENT,
    pregunta VARCHAR(100) NOT NULL,
    correcta VARCHAR(100) NOT NULL,
    d1 VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);



INSERT INTO Usos VALUES(NULL,'¿Cuáles son los usos de la Celulosa?','Materia prima, del papel, textiles y tejidos','Fuente de energía para humanos','Como detergente y abrasivo','Fertilizante y purificador de agua');
INSERT INTO Usos VALUES(NULL,'¿Cuáles son los usos de la Amilosa?','Almacenamiento de energía en plantas y aglomerante de agua','Creación de geles y azúcares.','Como detergente y abrasivo.','Creación de cosméticos y textiles.');
INSERT INTO Usos VALUES(NULL,'¿Cuáles son los usos del Glucógeno?','Almacenamiento de carbohidratos en animales','Materia prima del papel','Almacenamiento de glucosa en plantas','Transporta los carbohidratos en animales');
INSERT INTO Usos VALUES(NULL,'¿Cuáles son los usos del ácido Poliláctico?','Se utiliza en envases, materiales quirúrgicos y textiles.','Se utiliza como aditivo y resina.','Se utiliza para la fabricación de cables, juguetes y calzado.','Se utiliza para la fabricación de ventanas y tuberías.');
INSERT INTO Usos VALUES(NULL,'¿Cuáles son los usos del Quitosán?','Se utiliza en la industria alimentaria, en la cosmetica y en el tratamiento de aguas.','Se utiliza en la industria aeroespacial.','Se utiliza para la fabricación de plásticos','Se utiliza en la industria médica como la liberación de fármacos . ');