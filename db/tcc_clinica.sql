-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema tcc_clinica
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tcc_clinica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tcc_clinica` DEFAULT CHARACTER SET utf8 ;
USE `tcc_clinica` ;

-- -----------------------------------------------------
-- Table `tcc_clinica`.`profile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc_clinica`.`profile` ;

CREATE TABLE IF NOT EXISTS `tcc_clinica`.`profile` (
  `id_profile` INT NOT NULL AUTO_INCREMENT,
  `permissions` JSON NULL,
  `extra` JSON NULL,
  `name` VARCHAR(45) NULL,
  `is_active` TINYINT(1) NULL,
  PRIMARY KEY (`id_profile`),
  UNIQUE INDEX `id_profile_UNIQUE` (`id_profile` ASC) VISIBLE,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_clinica`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc_clinica`.`user` ;

CREATE TABLE IF NOT EXISTS `tcc_clinica`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `sex` VARCHAR(1) NULL,
  `picture` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `is_active` TINYINT(1) NULL,
  `document` VARCHAR(45) NULL,
  `birth_date` DATETIME NULL,
  `registration_date` DATETIME NULL,
  `id_profile` INT NOT NULL,
  PRIMARY KEY (`id_user`, `id_profile`),
  INDEX `fk_user_profile_idx` (`id_profile` ASC) VISIBLE,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
  UNIQUE INDEX `id_user_UNIQUE` (`id_user` ASC) VISIBLE,
  UNIQUE INDEX `document_UNIQUE` (`document` ASC) VISIBLE,
  CONSTRAINT `fk_user_profile`
    FOREIGN KEY (`id_profile`)
    REFERENCES `tcc_clinica`.`profile` (`id_profile`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_clinica`.`appoiment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tcc_clinica`.`appoiment` ;

CREATE TABLE IF NOT EXISTS `tcc_clinica`.`appoiment` (
  `id_appoiment` INT NOT NULL AUTO_INCREMENT,
  `booking_date` DATETIME NULL,
  `is_active` TINYINT(1) NULL,
  `id_psychologist` INT NOT NULL,
  `appointment_date` DATETIME NULL,
  `id_pacient` INT NOT NULL,
  `observation` VARCHAR(255) NULL,
  PRIMARY KEY (`id_appoiment`, `id_psychologist`, `id_pacient`),
  INDEX `fk_appoiment_user1_idx` (`id_psychologist` ASC) VISIBLE,
  INDEX `fk_appoiment_user2_idx` (`id_pacient` ASC) VISIBLE,
  UNIQUE INDEX `id_appoiment_UNIQUE` (`id_appoiment` ASC) VISIBLE,
  CONSTRAINT `fk_appoiment_user1`
    FOREIGN KEY (`id_psychologist`)
    REFERENCES `tcc_clinica`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_appoiment_user2`
    FOREIGN KEY (`id_pacient`)
    REFERENCES `tcc_clinica`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
