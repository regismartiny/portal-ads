-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema portalADS
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema portalADS
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `portalADS` DEFAULT CHARACTER SET utf8 ;
USE `portalADS` ;

-- -----------------------------------------------------
-- Table `portalADS`.`TipoUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portalADS`.`TipoUsuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portalADS`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portalADS`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `siapeMatricula` INT NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NULL,
  `senha` VARCHAR(100) NOT NULL,
  `status` TINYINT(1) NOT NULL,
  `TipoUsuario_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Usuarios_TipoUsuario_idx` (`TipoUsuario_id` ASC),
  CONSTRAINT `fk_Usuarios_TipoUsuario`
    FOREIGN KEY (`TipoUsuario_id`)
    REFERENCES `portalADS`.`TipoUsuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portalADS`.`CategoriaNoticia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portalADS`.`CategoriaNoticia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  `cor` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portalADS`.`Noticia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portalADS`.`Noticia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `conteudo` VARCHAR(2500) NOT NULL,
  `fonte` VARCHAR(200) NOT NULL,
  `imagem` VARCHAR(200) NULL,
  `status` CHAR(1) NOT NULL,
  `dataCadastro` DATE NOT NULL,
  `dataPublicacao` DATE NOT NULL,
  `Usuarios_id` INT NOT NULL,
  `CategoriaNoticia_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Noticias_Usuarios1_idx` (`Usuarios_id` ASC),
  INDEX `fk_Noticias_CategoriaNoticia1_idx` (`CategoriaNoticia_id` ASC),
  CONSTRAINT `fk_Noticias_Usuarios1`
    FOREIGN KEY (`Usuarios_id`)
    REFERENCES `portalADS`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Noticias_CategoriaNoticia1`
    FOREIGN KEY (`CategoriaNoticia_id`)
    REFERENCES `portalADS`.`CategoriaNoticia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
