CREATE TABLE `sisalmacen`.`area` 
(
	`idArea` INT NOT NULL AUTO_INCREMENT , 
    `nombreArea` VARCHAR(50) NOT NULL , 
    `estadoArea` TINYINT NOT NULL , 
    PRIMARY KEY (`idArea`)
);

CREATE TABLE `sisalmacen`.`cargo` 
(
	`idCargo` INT NOT NULL AUTO_INCREMENT , 
    `nombreCargo` VARCHAR(50) NOT NULL , 
    `estadoCargo` TINYINT NOT NULL , 
    PRIMARY KEY (`idCargo`)
);

CREATE TABLE `sisalmacen`.`empleado` 
(
	`idEmpleado` INT NOT NULL AUTO_INCREMENT ,
    `idCargo` INT NOT NULL ,
    `idArea` INT NOT NULL ,
    `nombres` VARCHAR(50) NOT NULL ,
    `apellidos` VARCHAR(50) NOT NULL ,
    `direccion` VARCHAR(100) NOT NULL ,
    `telefono` CHAR(9) NOT NULL ,
    `dni` CHAR(8) NOT NULL ,
    `email` VARCHAR(30) NOT NULL ,
    `created_user_id` DATETIME NOT NULL ,
    `date_created` DATETIME NOT NULL ,
    `update_user_id` DATETIME NOT NULL ,
    `date_update` DATETIME NOT NULL ,
    `estadoEmpleado` TINYINT NOT NULL , 
    PRIMARY KEY (`idEmpleado`),
    FOREIGN KEY (`idCargo`) REFERENCES `sisalmacen`.`cargo` (`idCargo`),
    FOREIGN KEY (`idArea`) REFERENCES `sisalmacen`.`area` (`idArea`)
);

CREATE TABLE `sisalmacen`.`usuario` 
(
	`idUsuario` INT NOT NULL AUTO_INCREMENT ,
    `idEmpleado` INT NOT NULL ,
    `tipoUsuario` VARCHAR(30) NOT NULL ,
    `usuario` VARCHAR(30) NOT NULL ,
    `clave` VARCHAR(30) NOT NULL , 
    `estadoUsuario` TINYINT NOT NULL , 
    `created_user_id` DATETIME NOT NULL ,
    `date_created` DATETIME NOT NULL ,
    `update_user_id` DATETIME NOT NULL ,
    `date_update` DATETIME NOT NULL ,
    PRIMARY KEY (`idUsuario`),
    FOREIGN KEY (`idEmpleado`) REFERENCES `sisalmacen`.`empleado` (`idEmpleado`)
);

CREATE TABLE `sisalmacen`.`requerimiento` 
(
	`idRequerimiento` INT NOT NULL AUTO_INCREMENT ,
    `idUsuario` INT NOT NULL ,
    `observacion` TEXT NOT NULL ,
    `estadoRequerimiento` TINYINT NOT NULL , 
    `created_user_id` DATETIME NOT NULL ,
    `date_created` DATETIME NOT NULL ,
    `update_user_id` DATETIME NOT NULL ,
    `date_update` DATETIME NOT NULL ,
    PRIMARY KEY (`idRequerimiento`),
    FOREIGN KEY (`idUsuario`) REFERENCES `sisalmacen`.`usuario` (`idUsuario`)
);

CREATE TABLE `sisalmacen`.`tipo_mov` 
(
	`idTipoMov` INT NOT NULL AUTO_INCREMENT , 
    `nombreTipoMov` VARCHAR(50) NOT NULL , 
    `estadoTipoMov` TINYINT NOT NULL , 
    PRIMARY KEY (`idTipoMov`)
);

CREATE TABLE `sisalmacen`.`movimiento` 
(
	`idMovimiento` INT NOT NULL AUTO_INCREMENT , 
    `nombreMovimento` VARCHAR(50) NOT NULL , 
    `estadoMovimiento` TINYINT NOT NULL , 
    PRIMARY KEY (`idMovimiento`)
);

CREATE TABLE `sisalmacen`.`mov_almacen` 
(
	`idMovAlmacen` INT NOT NULL AUTO_INCREMENT ,
    `tipoMov` VARCHAR(30) NOT NULL ,
    `movimiento` VARCHAR(30) NOT NULL ,
    `fechaMov` DATE NOT NULL ,
    `tipoDoc` VARCHAR(30) NOT NULL ,
    `numDoc` CHAR(11) NOT NULL ,
    `nombreRazon` VARCHAR(50) NOT NULL ,
    `idRequerimiento` INT NULL ,
    `pecosa` INT NULL ,
    `pdf` BLOB NULL ,
    `observacionMov` TEXT NOT NULL ,    
    `estadoMov` TINYINT NOT NULL , 
    `created_user_id` INT NOT NULL ,
    `date_created` DATETIME NOT NULL ,
    `update_user_id` INT NOT NULL ,
    `date_update` DATETIME NOT NULL ,
    PRIMARY KEY (`idMovAlmacen`)
);

CREATE TABLE `sisalmacen`.`categoria` 
(
	`idCategoria` INT NOT NULL AUTO_INCREMENT , 
    `nombreCategoria` VARCHAR(50) NOT NULL , 
    `estadoCategoria` TINYINT NOT NULL , 
    PRIMARY KEY (`idCategoria`)
);

CREATE TABLE `sisalmacen`.`marca` 
(
	`idMarca` INT NOT NULL AUTO_INCREMENT , 
    `nombreMarca` VARCHAR(50) NOT NULL , 
    `estadoMarca` TINYINT NOT NULL , 
    PRIMARY KEY (`idMarca`)
);

CREATE TABLE `sisalmacen`.`producto` 
(
	`idProducto` INT NOT NULL AUTO_INCREMENT ,
    `idCategoria` INT NOT NULL ,
    `idMarca` INT NOT NULL ,
    `nombreProducto` VARCHAR(50) NOT NULL ,
    `precio` DOUBLE NOT NULL ,
    `stockMin` INT NOT NULL ,
    `stockMax` INT NOT NULL ,
    `descripcion` TEXT NOT NULL ,    
    `estadoProducto` TINYINT NOT NULL , 
    `created_user_id` DATETIME NOT NULL ,
    `date_created` DATETIME NOT NULL ,
    `update_user_id` DATETIME NOT NULL ,
    `date_update` DATETIME NOT NULL ,
    PRIMARY KEY (`idProducto`),
    FOREIGN KEY (`idCategoria`) REFERENCES `sisalmacen`.`categoria` (`idCategoria`),
    FOREIGN KEY (`idMarca`) REFERENCES `sisalmacen`.`marca` (`idMarca`)
);

CREATE TABLE `sisalmacen`.`detalle_mov_almacen` 
(
	`idMovAlmacen` INT NOT NULL ,
    `idProducto` INT NOT NULL ,
    `cantidad` INT NOT NULL ,
    `created_user_id` INT NOT NULL ,
    `date_created` DATETIME NOT NULL ,
    `update_user_id` INT NOT NULL ,
    `date_update` DATETIME NOT NULL
);

CREATE TABLE `sisalmacen`.`detalle_requerimiento` 
(
	`idRequerimiento` INT NOT NULL ,
    `idProducto` INT NOT NULL ,
    `cantidad` INT NOT NULL ,
    `created_user_id` INT NOT NULL ,
    `date_created` DATETIME NOT NULL ,
    `update_user_id` INT NOT NULL ,
    `date_update` DATETIME NOT NULL
);