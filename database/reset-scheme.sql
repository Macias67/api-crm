-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema api-crm
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `api-crm` ;

-- -----------------------------------------------------
-- Schema api-crm
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `api-crm` DEFAULT CHARACTER SET utf8 ;
USE `api-crm` ;

-- -----------------------------------------------------
-- Table `api-crm`.`ec_departamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ec_departamentos` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `area` VARCHAR(100) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `area_UNIQUE` (`area` ASC)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `api-crm`.`ec_oficinas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ec_oficinas` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `calle` VARCHAR(45) NOT NULL COMMENT '',
  `numero` VARCHAR(45) NOT NULL COMMENT '',
  `colonia` VARCHAR(45) NOT NULL COMMENT '',
  `cp` VARCHAR(6) NOT NULL COMMENT '',
  `ciudad` VARCHAR(45) NOT NULL COMMENT '',
  `estado` VARCHAR(45) NOT NULL COMMENT '',
  `latitud` VARCHAR(150) NOT NULL COMMENT '',
  `longitud` VARCHAR(150) NOT NULL COMMENT '',
  `telefonos` VARCHAR(200) NOT NULL COMMENT '',
  `email` VARCHAR(60) NOT NULL COMMENT '',
  `online` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  `created_at` DATETIME NULL DEFAULT NULL COMMENT '',
  `updated_at` DATETIME NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `api-crm`.`usr_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`usr_usuarios` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(45) NOT NULL COMMENT '',
  `apellido` VARCHAR(45) NOT NULL COMMENT '',
  `ejecutivo` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `avatar` VARCHAR(100) NOT NULL COMMENT '',
  `online` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  `email` VARCHAR(60) NOT NULL COMMENT '',
  `password` VARCHAR(100) NOT NULL COMMENT '',
  `remember_token` VARCHAR(100) NULL COMMENT '',
  `created_at` DATETIME NULL DEFAULT NULL COMMENT '',
  `updated_at` DATETIME NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '',
  INDEX `login_idx` (`email` ASC, `password` ASC, `ejecutivo` ASC)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `api-crm`.`ec_ejecutivos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ec_ejecutivos` (
  `id` INT(10) UNSIGNED NOT NULL COMMENT '',
  `oficina_id` INT(10) UNSIGNED NOT NULL COMMENT '',
  `departamento_id` INT(10) UNSIGNED NOT NULL COMMENT '',
  `color` VARCHAR(45) NOT NULL COMMENT '',
  `class` VARCHAR(45) NOT NULL COMMENT '',
  `created_at` DATETIME NULL DEFAULT NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  INDEX `oficina_idx` (`oficina_id` ASC)  COMMENT '',
  INDEX `departamento_idx` (`departamento_id` ASC)  COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  CONSTRAINT `ec_ejecutivos_oficinas_fk`
    FOREIGN KEY (`oficina_id`)
    REFERENCES `api-crm`.`ec_oficinas` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `ec_ejecutivos_departamentos_fk`
    FOREIGN KEY (`departamento_id`)
    REFERENCES `api-crm`.`ec_departamentos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `ec_ejecutivos_user_app_fk`
    FOREIGN KEY (`id`)
    REFERENCES `api-crm`.`usr_usuarios` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `api-crm`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`password_resets` (
  `email` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '',
  `token` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '',
  `created_at` TIMESTAMP NULL COMMENT '',
  INDEX `password_resets_email_index` (`email` ASC)  COMMENT '',
  INDEX `password_resets_token_index` (`token` ASC)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `api-crm`.`ec_permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ec_permisos` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '',
  `display_name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT '',
  `description` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT '',
  `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT '',
  `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `permissions_name_unique` (`name` ASC)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `api-crm`.`ec_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ec_roles` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '',
  `display_name` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT '',
  `description` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL COMMENT '',
  `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT '',
  `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `roles_name_unique` (`name` ASC)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `api-crm`.`ec_permisos_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ec_permisos_roles` (
  `permission_id` INT(10) UNSIGNED NOT NULL COMMENT '',
  `role_id` INT(10) UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`permission_id`, `role_id`)  COMMENT '',
  INDEX `permission_role_role_id_foreign` (`role_id` ASC)  COMMENT '',
  CONSTRAINT `permission_role_permission_id_foreign`
    FOREIGN KEY (`permission_id`)
    REFERENCES `api-crm`.`ec_permisos` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign`
    FOREIGN KEY (`role_id`)
    REFERENCES `api-crm`.`ec_roles` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `api-crm`.`ec_roles_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ec_roles_user` (
  `user_id` INT(10) UNSIGNED NOT NULL COMMENT '',
  `role_id` INT(10) UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`user_id`, `role_id`)  COMMENT '',
  INDEX `role_user_role_id_foreign` (`role_id` ASC)  COMMENT '',
  CONSTRAINT `role_user_role_id_foreign`
    FOREIGN KEY (`role_id`)
    REFERENCES `api-crm`.`ec_roles` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign`
    FOREIGN KEY (`user_id`)
    REFERENCES `api-crm`.`usr_usuarios` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `api-crm`.`cl_clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cl_clientes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `razonsocial` VARCHAR(100) NOT NULL COMMENT '',
  `rfc` VARCHAR(13) NOT NULL COMMENT '',
  `prospecto` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `distribuidor` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `email` VARCHAR(60) NOT NULL COMMENT '',
  `telefono` VARCHAR(14) NOT NULL COMMENT '',
  `telefono2` VARCHAR(14) NOT NULL COMMENT '',
  `calle` VARCHAR(45) NOT NULL COMMENT '',
  `noexterior` VARCHAR(45) NOT NULL COMMENT '',
  `nointerior` VARCHAR(45) NOT NULL COMMENT '',
  `colonia` VARCHAR(45) NOT NULL COMMENT '',
  `cp` VARCHAR(6) NOT NULL COMMENT '',
  `ciudad` VARCHAR(45) NOT NULL COMMENT '',
  `municipio` VARCHAR(45) NOT NULL COMMENT '',
  `estado` VARCHAR(45) NOT NULL COMMENT '',
  `pais` VARCHAR(45) NOT NULL COMMENT '',
  `online` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `razonsocial_UNIQUE` (`razonsocial` ASC)  COMMENT '',
  UNIQUE INDEX `rfc_UNIQUE` (`rfc` ASC)  COMMENT '',
  INDEX `email_INDEX` (`email` ASC)  COMMENT '',
  INDEX `prospecto_INDEX` (`prospecto` ASC)  COMMENT '',
  INDEX `distribuidor_INDEX` (`distribuidor` ASC)  COMMENT '',
  INDEX `online_INDEX` (`online` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cl_contactos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cl_contactos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_cliente` INT UNSIGNED NOT NULL COMMENT '',
  `telefono` VARCHAR(45) NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cl_contactos_clientes_fk_idx` (`id_cliente` ASC)  COMMENT '',
  CONSTRAINT `cl_contactos_clientes_fk`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `api-crm`.`cl_clientes` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `cl_contactos_user_app_fk`
    FOREIGN KEY (`id`)
    REFERENCES `api-crm`.`usr_usuarios` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`ct_cotizacion_estatus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ct_cotizacion_estatus` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `estatus` VARCHAR(45) NOT NULL COMMENT '',
  `class` VARCHAR(45) NOT NULL COMMENT '',
  `color` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `estatus_UNIQUE` (`estatus` ASC)  COMMENT '',
  UNIQUE INDEX `color_UNIQUE` (`color` ASC)  COMMENT '',
  UNIQUE INDEX `class_UNIQUE` (`class` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`ct_cotizacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ct_cotizacion` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `cliente_id` INT UNSIGNED NOT NULL COMMENT '',
  `ejecutivo_id` INT UNSIGNED NOT NULL COMMENT '',
  `contacto_id` INT UNSIGNED NOT NULL COMMENT '',
  `oficina_id` INT UNSIGNED NOT NULL COMMENT '',
  `estatus_id` INT UNSIGNED NOT NULL COMMENT '',
  `vencimiento` DATE NOT NULL COMMENT '',
  `cxc` TINYINT(1) NOT NULL COMMENT '',
  `subtotal` FLOAT(2) UNSIGNED NOT NULL COMMENT '',
  `iva` FLOAT(2) UNSIGNED NOT NULL COMMENT '',
  `abono` FLOAT(2) NOT NULL COMMENT '',
  `total` FLOAT(2) UNSIGNED NOT NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `ct_cotizacion_clientes_fk_idx` (`cliente_id` ASC)  COMMENT '',
  INDEX `ct_cotizacion_ejecutivo_fk_idx` (`ejecutivo_id` ASC)  COMMENT '',
  INDEX `ct_cotizacion_contacto_fk_idx` (`contacto_id` ASC)  COMMENT '',
  INDEX `ct_cotizacion_oficna_fk_idx` (`oficina_id` ASC)  COMMENT '',
  INDEX `ct_cotizacion_estatus_fk_idx` (`estatus_id` ASC)  COMMENT '',
  CONSTRAINT `ct_cotizacion_clientes_fk`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `api-crm`.`cl_clientes` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `ct_cotizacion_ejecutivos_fk`
    FOREIGN KEY (`ejecutivo_id`)
    REFERENCES `api-crm`.`ec_ejecutivos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `ct_cotizacion_contactos_fk`
    FOREIGN KEY (`contacto_id`)
    REFERENCES `api-crm`.`cl_contactos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `ct_cotizacion_oficinas_fk`
    FOREIGN KEY (`oficina_id`)
    REFERENCES `api-crm`.`ec_oficinas` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `ct_cotizacion_estatus_fk`
    FOREIGN KEY (`estatus_id`)
    REFERENCES `api-crm`.`ct_cotizacion_estatus` (`id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`ec_bancos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ec_bancos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `banco` VARCHAR(45) NOT NULL COMMENT '',
  `sucursal` VARCHAR(45) NOT NULL COMMENT '',
  `cta` VARCHAR(45) NOT NULL COMMENT '',
  `titular` VARCHAR(60) NOT NULL COMMENT '',
  `cib` VARCHAR(18) NOT NULL COMMENT '',
  `online` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`ec_unidad_productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ec_unidad_productos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `unidad` VARCHAR(45) NOT NULL COMMENT '',
  `plural` VARCHAR(45) NOT NULL COMMENT '',
  `abreviatura` VARCHAR(45) NOT NULL COMMENT '',
  `online` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`ec_productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ec_productos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `codigo` VARCHAR(20) NOT NULL COMMENT '',
  `producto` VARCHAR(100) NOT NULL COMMENT '',
  `descripcion` TEXT NOT NULL COMMENT '',
  `id_unidad` INT UNSIGNED NOT NULL COMMENT '',
  `precio` FLOAT(2) NOT NULL COMMENT '',
  `online` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC)  COMMENT '',
  UNIQUE INDEX `producto_UNIQUE` (`producto` ASC)  COMMENT '',
  INDEX `unidad_INDEX` (`id_unidad` ASC)  COMMENT '',
  CONSTRAINT `producto_unidad_fk`
    FOREIGN KEY (`id_unidad`)
    REFERENCES `api-crm`.`ec_unidad_productos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`ct_cotizacion_productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ct_cotizacion_productos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_cotizacion` INT UNSIGNED NOT NULL COMMENT '',
  `id_producto` INT UNSIGNED NOT NULL COMMENT '',
  `cantidad` INT UNSIGNED NOT NULL COMMENT '',
  `precio` FLOAT(2) UNSIGNED NOT NULL COMMENT '',
  `descuento` FLOAT(2) UNSIGNED NOT NULL COMMENT '',
  `subtotal` FLOAT(2) UNSIGNED NOT NULL COMMENT '',
  `iva` FLOAT(2) UNSIGNED NOT NULL COMMENT '',
  `total` FLOAT(2) UNSIGNED NOT NULL COMMENT '',
  `habilitado` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cotizacion_producto_idx` (`id_producto` ASC)  COMMENT '',
  INDEX `producto_cotizacion_idx` (`id_cotizacion` ASC)  COMMENT '',
  CONSTRAINT `cotizacion_producto_fk`
    FOREIGN KEY (`id_producto`)
    REFERENCES `api-crm`.`ec_productos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `productos_cotizacion_fk`
    FOREIGN KEY (`id_cotizacion`)
    REFERENCES `api-crm`.`ct_cotizacion` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`ct_cotizacion_bancos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ct_cotizacion_bancos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_cotizacion` INT UNSIGNED NOT NULL COMMENT '',
  `id_banco` INT UNSIGNED NOT NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cotizacion_INDEX` (`id_cotizacion` ASC)  COMMENT '',
  INDEX `banco_INDEX` (`id_banco` ASC)  COMMENT '',
  CONSTRAINT `cotizacion_bancos_fk`
    FOREIGN KEY (`id_cotizacion`)
    REFERENCES `api-crm`.`ct_cotizacion` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `bancos_banco_fk`
    FOREIGN KEY (`id_banco`)
    REFERENCES `api-crm`.`ec_bancos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`ct_cotizacion_pagos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ct_cotizacion_pagos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `cotizacion_id` INT UNSIGNED NOT NULL COMMENT '',
  `contacto_id` INT UNSIGNED NOT NULL COMMENT '',
  `cantidad` FLOAT(2) NOT NULL COMMENT '',
  `tipo` ENUM('abono', 'total') NOT NULL DEFAULT 'abono' COMMENT '',
  `comentario` TEXT(250) NULL COMMENT '',
  `valido` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `revisado` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  INDEX `cotizacion_id_idx` (`cotizacion_id` ASC)  COMMENT '',
  INDEX `contacto_id_idx` (`contacto_id` ASC)  COMMENT '',
  CONSTRAINT `ct_cotizacion_parcialidades_fk`
    FOREIGN KEY (`cotizacion_id`)
    REFERENCES `api-crm`.`ct_cotizacion` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `ct_cotizacion_parcialidades_contacto_fk`
    FOREIGN KEY (`contacto_id`)
    REFERENCES `api-crm`.`cl_contactos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`ct_cotizacion_comprobantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ct_cotizacion_comprobantes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `pago_id` INT UNSIGNED NOT NULL COMMENT '',
  `download_url` VARCHAR(250) NOT NULL COMMENT '',
  `content_type` VARCHAR(150) NOT NULL COMMENT '',
  `full_path` VARCHAR(150) NOT NULL COMMENT '',
  `md5hash` VARCHAR(150) NOT NULL COMMENT '',
  `name` VARCHAR(250) NOT NULL COMMENT '',
  `size` INT NOT NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `pago_id_idx` (`pago_id` ASC)  COMMENT '',
  CONSTRAINT `ct_cotizacion_pago_comprobante_fk`
    FOREIGN KEY (`pago_id`)
    REFERENCES `api-crm`.`ct_cotizacion_pagos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_caso_estatus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_caso_estatus` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `estatus` VARCHAR(45) NOT NULL COMMENT '',
  `class` VARCHAR(45) NOT NULL COMMENT '',
  `color` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `estatus_UNIQUE` (`estatus` ASC)  COMMENT '',
  UNIQUE INDEX `class_UNIQUE` (`class` ASC)  COMMENT '',
  UNIQUE INDEX `color_UNIQUE` (`color` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_caso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_caso` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `cliente_id` INT UNSIGNED NOT NULL COMMENT '',
  `estatus_id` INT UNSIGNED NOT NULL COMMENT '',
  `asignado` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `avance` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '',
  `fecha_inicio` DATETIME NULL DEFAULT NULL COMMENT '',
  `fecha_tentativa_precierre` DATETIME NULL DEFAULT NULL COMMENT '',
  `fecha_precierre` DATETIME NULL DEFAULT NULL COMMENT '',
  `fecha_cierre` DATETIME NULL DEFAULT NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cs_caso_cliente_id_idx` (`cliente_id` ASC)  COMMENT '',
  INDEX `cs_caso_estatus_id_idx` (`estatus_id` ASC)  COMMENT '',
  INDEX `cs_caso_asignado` (`asignado` ASC)  COMMENT '',
  CONSTRAINT `cs_caso_cliente_fk`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `api-crm`.`cl_clientes` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `cs_caso_estatus_fk`
    FOREIGN KEY (`estatus_id`)
    REFERENCES `api-crm`.`cs_caso_estatus` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_caso_cotizacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_caso_cotizacion` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `caso_id` INT UNSIGNED NOT NULL COMMENT '',
  `cotizacion_id` INT UNSIGNED NOT NULL COMMENT '',
  `fecha_validacion` DATETIME NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cs_caso_cotizacion_caso_id_idx` (`caso_id` ASC)  COMMENT '',
  INDEX `cs_caso_cotizacion_cotizacion_id_idx` (`cotizacion_id` ASC)  COMMENT '',
  UNIQUE INDEX `caso_id_UNIQUE` (`caso_id` ASC)  COMMENT '',
  UNIQUE INDEX `cotizacion_id_UNIQUE` (`cotizacion_id` ASC)  COMMENT '',
  CONSTRAINT `cs_caso_cotizacion_caso_id_fk`
    FOREIGN KEY (`caso_id`)
    REFERENCES `api-crm`.`cs_caso` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `cs_caso_cotizacion_cotizacion_id_fk`
    FOREIGN KEY (`cotizacion_id`)
    REFERENCES `api-crm`.`ct_cotizacion` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_caso_lider`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_caso_lider` (
  `caso_id` INT UNSIGNED NOT NULL COMMENT '',
  `ejecutivo_lider_id` INT UNSIGNED NOT NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  INDEX `cs_caso_lider_ejecutivo_id_idx` (`ejecutivo_lider_id` ASC)  COMMENT '',
  PRIMARY KEY (`caso_id`)  COMMENT '',
  CONSTRAINT `cs_caso_lider_ejecutivo_fk`
    FOREIGN KEY (`ejecutivo_lider_id`)
    REFERENCES `api-crm`.`ec_ejecutivos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `cs_caso_lider_caso_fk`
    FOREIGN KEY (`caso_id`)
    REFERENCES `api-crm`.`cs_caso` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_caso_reasignacion_lider`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_caso_reasignacion_lider` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `caso_id` INT UNSIGNED NOT NULL COMMENT '',
  `lider_old` INT UNSIGNED NOT NULL COMMENT '',
  `lider_new` INT UNSIGNED NOT NULL COMMENT '',
  `motivo` TEXT NOT NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cs_caso_reasignacion_old` (`lider_old` ASC)  COMMENT '',
  INDEX `cs_caso_reasignacion_new` (`lider_new` ASC)  COMMENT '',
  INDEX `cs_caso_reasignacion_caso_id` (`caso_id` ASC)  COMMENT '',
  CONSTRAINT `cs_caso_reasignaicion_lider_old_fk`
    FOREIGN KEY (`lider_old`)
    REFERENCES `api-crm`.`ec_ejecutivos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `cs_caso_reasignaicion_lider_new_fk`
    FOREIGN KEY (`lider_new`)
    REFERENCES `api-crm`.`ec_ejecutivos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `cs_caso_reasignaicion_caso_fk`
    FOREIGN KEY (`caso_id`)
    REFERENCES `api-crm`.`cs_caso` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_tarea_estatus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_tarea_estatus` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `estatus` VARCHAR(45) NOT NULL COMMENT '',
  `class` VARCHAR(45) NOT NULL COMMENT '',
  `color` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `estatus_UNIQUE` (`estatus` ASC)  COMMENT '',
  UNIQUE INDEX `class_UNIQUE` (`class` ASC)  COMMENT '',
  UNIQUE INDEX `color_UNIQUE` (`color` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_tarea`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_tarea` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_caso` INT UNSIGNED NOT NULL COMMENT '',
  `id_ejecutivo` INT UNSIGNED NOT NULL COMMENT '',
  `id_estatus` INT UNSIGNED NOT NULL COMMENT '',
  `titulo` VARCHAR(140) NOT NULL COMMENT '',
  `descripcion` TEXT NOT NULL COMMENT '',
  `avance` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '',
  `fecha_inicio` DATETIME NULL COMMENT '',
  `fecha_tentativa_cierre` DATETIME NULL COMMENT '',
  `fecha_cierre` DATETIME NULL COMMENT '',
  `duracion_tentativa_segundos` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '',
  `duracion_real_segundos` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '',
  `activo` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  INDEX `cs_tarea_caso_id_idx` (`id_caso` ASC)  COMMENT '',
  INDEX `cs_tarea_ejecutivo_id_idx` (`id_ejecutivo` ASC)  COMMENT '',
  INDEX `cs_tarea_estatus_id_idx` (`id_estatus` ASC)  COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cs_tarea_habilitado_idx` (`activo` ASC)  COMMENT '',
  INDEX `cs_tarea_titulo_idx` (`titulo` ASC, `activo` ASC)  COMMENT '',
  INDEX `cs_tarea_avance_idx` (`avance` ASC)  COMMENT '',
  CONSTRAINT `cs_tarea_caso_fk`
    FOREIGN KEY (`id_caso`)
    REFERENCES `api-crm`.`cs_caso` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `cs_tarea_ejecutivo_fk`
    FOREIGN KEY (`id_ejecutivo`)
    REFERENCES `api-crm`.`ec_ejecutivos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `cs_tarea_estatus_fk`
    FOREIGN KEY (`id_estatus`)
    REFERENCES `api-crm`.`cs_tarea_estatus` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_nota`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_nota` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_tarea` INT UNSIGNED NOT NULL COMMENT '',
  `nota` TEXT NOT NULL COMMENT '',
  `publico` TINYINT(1) NOT NULL COMMENT '',
  `avance` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '',
  `habilitado` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cs_nota_tarea_idx` (`id_tarea` ASC)  COMMENT '',
  INDEX `cs_nota_publico_idx` (`publico` ASC)  COMMENT '',
  INDEX `cs_nota_habilitado_idx` (`habilitado` ASC)  COMMENT '',
  CONSTRAINT `cs_nota_tarea_fk`
    FOREIGN KEY (`id_tarea`)
    REFERENCES `api-crm`.`cs_tarea` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_nota_archivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_nota_archivo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_nota` INT UNSIGNED NOT NULL COMMENT '',
  `download_url` VARCHAR(250) NOT NULL COMMENT '',
  `content_type` VARCHAR(150) NOT NULL COMMENT '',
  `full_path` VARCHAR(150) NOT NULL COMMENT '',
  `md5hash` VARCHAR(150) NOT NULL COMMENT '',
  `name` VARCHAR(250) NOT NULL COMMENT '',
  `size` INT NOT NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cs_nota_archivo_id_nota_idx` (`id_nota` ASC)  COMMENT '',
  CONSTRAINT `cs_nota_archivo_nota_fk`
    FOREIGN KEY (`id_nota`)
    REFERENCES `api-crm`.`cs_nota` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`pl_poliza`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`pl_poliza` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_tarea_tiempos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_tarea_tiempos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_tarea` INT UNSIGNED NOT NULL COMMENT '',
  `fecha_inicio` DATETIME NOT NULL COMMENT '',
  `fecha_fin` DATETIME NOT NULL COMMENT '',
  `duracion_segundos` INT UNSIGNED NOT NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cs_tarea_actividad_id_tarea` (`id_tarea` ASC)  COMMENT '',
  INDEX `cs_tarea_actividad_fecha_inicio` (`fecha_inicio` ASC)  COMMENT '',
  CONSTRAINT `cs_tarea_actividad_tarea_actividad_fg`
    FOREIGN KEY (`id_tarea`)
    REFERENCES `api-crm`.`cs_tarea` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`ag_agenda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`ag_agenda` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `ejecutivo_id` INT UNSIGNED NOT NULL COMMENT '',
  `titulo` VARCHAR(140) NOT NULL COMMENT '',
  `descripcion` TEXT NOT NULL COMMENT '',
  `allDay` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `start` DATETIME NOT NULL COMMENT '',
  `end` DATETIME NOT NULL COMMENT '',
  `duracion_segundos` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '',
  `url` VARCHAR(145) NULL COMMENT '',
  `notificado` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `ag_agenda_ejecutivo_idx` (`ejecutivo_id` ASC)  COMMENT '',
  INDEX `ag_agenda_start_idx` (`start` ASC, `end` ASC)  COMMENT '',
  CONSTRAINT `ag_agenda_ejecutio_fk`
    FOREIGN KEY (`ejecutivo_id`)
    REFERENCES `api-crm`.`ec_ejecutivos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`usr_usuario_tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`usr_usuario_tokens` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_usuario` INT UNSIGNED NOT NULL COMMENT '',
  `token` VARCHAR(250) NOT NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `token_UNIQUE` (`token` ASC)  COMMENT '',
  INDEX `usr_usuarios_token_usuario` (`id_usuario` ASC)  COMMENT '',
  CONSTRAINT `usr_usuarios_tokens`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `api-crm`.`usr_usuarios` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_tarea_agenda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_tarea_agenda` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_tarea` INT UNSIGNED NOT NULL COMMENT '',
  `start` DATETIME NOT NULL COMMENT '',
  `end` DATETIME NOT NULL COMMENT '',
  `duracion_segundos` INT UNSIGNED NOT NULL COMMENT '',
  `notificado` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `ag_agenda_tarea_id_tarea_idx` (`id_tarea` ASC)  COMMENT '',
  INDEX `ag_agenda_tarea_starend_indx` (`start` ASC, `end` ASC)  COMMENT '',
  CONSTRAINT `ag_agenda_tarea_tarea_fk`
    FOREIGN KEY (`id_tarea`)
    REFERENCES `api-crm`.`cs_tarea` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_caso_encuesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_caso_encuesta` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_caso` INT UNSIGNED NOT NULL COMMENT '',
  `id_contacto` INT UNSIGNED NULL COMMENT '',
  `respondida` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `respuestas_json` TEXT NULL COMMENT '',
  `puntaje` FLOAT(2) NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cs_caso_encuesta_id_caso_idx` (`id_caso` ASC)  COMMENT '',
  INDEX `cs_caso_encuesta_id_contacto_idx` (`id_contacto` ASC)  COMMENT '',
  UNIQUE INDEX `id_caso_UNIQUE` (`id_caso` ASC)  COMMENT '',
  CONSTRAINT `cs_caso_encuesta_caso`
    FOREIGN KEY (`id_caso`)
    REFERENCES `api-crm`.`cs_caso` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `cs_caso_encuesta_contacto`
    FOREIGN KEY (`id_contacto`)
    REFERENCES `api-crm`.`cl_contactos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `api-crm`.`cs_tarea_reasignacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `api-crm`.`cs_tarea_reasignacion` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_tarea` INT UNSIGNED NOT NULL COMMENT '',
  `ejecutivo_old` INT UNSIGNED NOT NULL COMMENT '',
  `ejecutivo_new` INT UNSIGNED NOT NULL COMMENT '',
  `motivo` TEXT NOT NULL COMMENT '',
  `created_at` DATETIME NULL COMMENT '',
  `updated_at` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `cs_tarea_actividad_id_tarea` (`id_tarea` ASC)  COMMENT '',
  INDEX `cs_tarea_actividad_fecha_inicio` (`ejecutivo_old` ASC)  COMMENT '',
  CONSTRAINT `cs_tarea_actividad_tarea_actividad_fg0`
    FOREIGN KEY (`id_tarea`)
    REFERENCES `api-crm`.`cs_tarea` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
