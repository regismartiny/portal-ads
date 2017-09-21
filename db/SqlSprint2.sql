USE `portal-ads` ;

-- -----------------------------------------------------
-- Table `portal-ads`.`InformacaoDoCurso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portal-ads`.`InformacaoDoCurso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `conteudo` VARCHAR(10000) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;