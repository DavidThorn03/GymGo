-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema gymdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gymdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gymdb` DEFAULT CHARACTER SET utf8 ;
USE `gymdb` ;

-- -----------------------------------------------------
-- Table `gymdb`.`Gallary`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Gallary` (
  `ImageID` INT NOT NULL,
  `ImageLink` VARCHAR(45) NULL,
  PRIMARY KEY (`ImageID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Lessons`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Lessons` (
  `LessonID` INT NOT NULL,
  `LessonName` VARCHAR(45) NULL,
  `DurationMin` INT NULL,
  `NumPlaces` INT NULL,
  `Trainer` VARCHAR(45) NULL,
  `About` VARCHAR(500) NULL,
  `ImageID` INT NOT NULL,
  PRIMARY KEY (`LessonID`, `ImageID`),
  INDEX `fk_Lessons_Gallary1_idx` (`ImageID` ASC) VISIBLE,
  CONSTRAINT `fk_Lessons_Gallary1`
    FOREIGN KEY (`ImageID`)
    REFERENCES `gymdb`.`Gallary` (`ImageID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Lesson-Time`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Lesson-Time` (
  `LessonTimeID` INT NOT NULL,
  `Time` TIME NULL,
  `Day` INT NULL,
  `LessonID` INT NOT NULL,
  PRIMARY KEY (`LessonTimeID`, `LessonID`),
  INDEX `fk_Lesson-Time_Lessons_idx` (`LessonID` ASC) VISIBLE,
  CONSTRAINT `fk_Lesson-Time_Lessons`
    FOREIGN KEY (`LessonID`)
    REFERENCES `gymdb`.`Lessons` (`LessonID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`User` (
  `UserID` INT NOT NULL,
  `Email` VARCHAR(45) NULL,
  `Password` VARCHAR(45) NULL,
  PRIMARY KEY (`UserID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Booked-Lesson`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Booked-Lesson` (
  `BookedLessonID` INT NOT NULL,
  `LessonTimeID` INT NOT NULL,
  `UserID` INT NOT NULL,
  PRIMARY KEY (`BookedLessonID`, `LessonTimeID`, `UserID`),
  INDEX `fk_Booked-Lesson_Lesson-Time1_idx` (`LessonTimeID` ASC) VISIBLE,
  INDEX `fk_Booked-Lesson_User1_idx` (`UserID` ASC) VISIBLE,
  CONSTRAINT `fk_Booked-Lesson_Lesson-Time1`
    FOREIGN KEY (`LessonTimeID`)
    REFERENCES `gymdb`.`Lesson-Time` (`LessonTimeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Booked-Lesson_User1`
    FOREIGN KEY (`UserID`)
    REFERENCES `gymdb`.`User` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Admin` (
  `AdminID` INT NOT NULL,
  `UserID` INT NOT NULL,
  PRIMARY KEY (`AdminID`, `UserID`),
  CONSTRAINT `fk_Admin_User1`
    FOREIGN KEY (`UserID`)
    REFERENCES `gymdb`.`User` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Products` (
  `ProductID` INT NOT NULL,
  `ProductName` VARCHAR(45) NULL,
  `Price` FLOAT NULL,
  `Description` VARCHAR(500) NULL,
  `Size` VARCHAR(45) NULL,
  `Colour` VARCHAR(45) NULL,
  `ImageID` INT NOT NULL,
  PRIMARY KEY (`ProductID`, `ImageID`),
  INDEX `fk_Products_Gallary1_idx` (`ImageID` ASC) VISIBLE,
  CONSTRAINT `fk_Products_Gallary1`
    FOREIGN KEY (`ImageID`)
    REFERENCES `gymdb`.`Gallary` (`ImageID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Orders` (
  `UserID` INT NOT NULL,
  `ProductID` INT NOT NULL,
  `OrderTime` DATETIME NULL,
  PRIMARY KEY (`UserID`, `ProductID`),
  INDEX `fk_User_has_Products_Products2_idx` (`ProductID` ASC) VISIBLE,
  INDEX `fk_User_has_Products_User2_idx` (`UserID` ASC) VISIBLE,
  CONSTRAINT `fk_User_has_Products_User2`
    FOREIGN KEY (`UserID`)
    REFERENCES `gymdb`.`User` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Products_Products2`
    FOREIGN KEY (`ProductID`)
    REFERENCES `gymdb`.`Products` (`ProductID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Cust`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Cust` (
  `Fname` VARCHAR(45) NULL,
  `Sname` VARCHAR(45) NULL,
  `DOB` DATE NULL,
  `EirCode` VARCHAR(7) NULL,
  `Phone` INT NULL,
  `UserID` INT NOT NULL,
  PRIMARY KEY (`UserID`),
  CONSTRAINT `fk_Cust_User1`
    FOREIGN KEY (`UserID`)
    REFERENCES `gymdb`.`User` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
