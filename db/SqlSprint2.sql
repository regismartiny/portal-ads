-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema portal-ads
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema portal-ads
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `portal-ads` DEFAULT CHARACTER SET utf8 ;
USE `portal-ads` ;

-- -----------------------------------------------------
-- Table `portal-ads`.`TipoUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal-ads`.`TipoUsuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portal-ads`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal-ads`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `siapeMatricula` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NULL,
  `senha` VARCHAR(100) NOT NULL,
  `status` TINYINT(1) NOT NULL,
  `TipoUsuario_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Usuarios_TipoUsuario_idx` (`TipoUsuario_id` ASC),
  UNIQUE INDEX `siapeMatricula_UNIQUE` (`siapeMatricula` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_Usuarios_TipoUsuario`
    FOREIGN KEY (`TipoUsuario_id`)
    REFERENCES `portal-ads`.`TipoUsuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portal-ads`.`CategoriaNoticia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal-ads`.`CategoriaNoticia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  `cor` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portal-ads`.`Noticia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal-ads`.`Noticia` (
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
    REFERENCES `portal-ads`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Noticias_CategoriaNoticia1`
    FOREIGN KEY (`CategoriaNoticia_id`)
    REFERENCES `portal-ads`.`CategoriaNoticia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portal-ads`.`InformacaoDoCurso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal-ads`.`InformacaoDoCurso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `conteudo` VARCHAR(10000) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
