-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Lessons`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Lessons` (
  `LessonID` INT NOT NULL,
  `LessonName` VARCHAR(45) NULL,
  `DurationMin` INT NULL,
  `NumPlaces` INT NULL,
  `Trainer` VARCHAR(45) NULL,
  `About` VARCHAR(500) NULL,
  `ImageLink` VARCHAR(45) NULL,
  PRIMARY KEY (`LessonID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Lesson-Time`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Lesson-Time` (
  `LessonTimeID` INT NOT NULL,
  `Time` DATETIME NULL,
  `LessonID` INT NOT NULL,
  PRIMARY KEY (`LessonTimeID`, `LessonID`),
  INDEX `fk_Lesson-Time_Lessons_idx` (`LessonID` ASC) VISIBLE,
  CONSTRAINT `fk_Lesson-Time_Lessons`
    FOREIGN KEY (`LessonID`)
    REFERENCES `mydb`.`Lessons` (`LessonID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`User` (
  `UserID` INT NOT NULL,
  `FirstName` VARCHAR(45) NULL,
  `Surname` VARCHAR(45) NULL,
  `DateOfBirth` DATE NULL,
  `EirCode` VARCHAR(7) NULL,
  `Phone` INT NULL,
  `Email` VARCHAR(45) NULL,
  `Password` VARCHAR(45) NULL,
  PRIMARY KEY (`UserID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Booked-Lesson`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Booked-Lesson` (
  `BookedLessonID` INT NOT NULL,
  `LessonTimeID` INT NOT NULL,
  `User_UserID` INT NOT NULL,
  PRIMARY KEY (`BookedLessonID`, `LessonTimeID`, `User_UserID`),
  INDEX `fk_Booked-Lesson_Lesson-Time1_idx` (`LessonTimeID` ASC) VISIBLE,
  INDEX `fk_Booked-Lesson_User1_idx` (`User_UserID` ASC) VISIBLE,
  CONSTRAINT `fk_Booked-Lesson_Lesson-Time1`
    FOREIGN KEY (`LessonTimeID`)
    REFERENCES `mydb`.`Lesson-Time` (`LessonTimeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Booked-Lesson_User1`
    FOREIGN KEY (`User_UserID`)
    REFERENCES `mydb`.`User` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Gallary`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Gallary` (
  `ImageID` INT NOT NULL,
  `ImageLink` VARCHAR(45) NULL,
  PRIMARY KEY (`ImageID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Admin` (
  `adminID` INT NOT NULL,
  `AdminEmail` VARCHAR(45) NULL,
  `AdminPassword` VARCHAR(45) NULL,
  PRIMARY KEY (`adminID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Products` (
  `ProductID` INT NOT NULL,
  `ProductName` VARCHAR(45) NULL,
  `Price` FLOAT NULL,
  `Description` VARCHAR(500) NULL,
  `Size` VARCHAR(45) NULL,
  `Colour` VARCHAR(45) NULL,
  `ImageLink` VARCHAR(45) NULL,
  PRIMARY KEY (`ProductID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Cart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Cart` (
  `UserID` INT NOT NULL,
  `ProductID` INT NOT NULL,
  PRIMARY KEY (`UserID`, `ProductID`),
  INDEX `fk_User_has_Products_Products1_idx` (`ProductID` ASC) VISIBLE,
  INDEX `fk_User_has_Products_User1_idx` (`UserID` ASC) VISIBLE,
  CONSTRAINT `fk_User_has_Products_User1`
    FOREIGN KEY (`UserID`)
    REFERENCES `mydb`.`User` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Products_Products1`
    FOREIGN KEY (`ProductID`)
    REFERENCES `mydb`.`Products` (`ProductID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Orders` (
  `UserID` INT NOT NULL,
  `ProductID` INT NOT NULL,
  `OrderTime` DATETIME NULL,
  PRIMARY KEY (`UserID`, `ProductID`),
  INDEX `fk_User_has_Products_Products2_idx` (`ProductID` ASC) VISIBLE,
  INDEX `fk_User_has_Products_User2_idx` (`UserID` ASC) VISIBLE,
  CONSTRAINT `fk_User_has_Products_User2`
    FOREIGN KEY (`UserID`)
    REFERENCES `mydb`.`User` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Products_Products2`
    FOREIGN KEY (`ProductID`)
    REFERENCES `mydb`.`Products` (`ProductID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
