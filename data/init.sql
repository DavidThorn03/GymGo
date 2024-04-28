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
-- -----------------------------------------------------
-- Schema gymdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gymdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gymdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `gymdb` ;

-- -----------------------------------------------------
-- Table `gymdb`.`Image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Image` (
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
  `ImageID` INT NULL,
  PRIMARY KEY (`LessonID`),
  INDEX `fk_Lessons_Image1_idx` (`ImageID` ASC) VISIBLE,
  CONSTRAINT `fk_Lessons_Image1`
    FOREIGN KEY (`ImageID`)
    REFERENCES `gymdb`.`Image` (`ImageID`)
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
  `UserID` INT NOT NULL AUTO_INCREMENT,
  `Email` VARCHAR(45) NULL,
  `Password` VARCHAR(120) NULL,
  PRIMARY KEY (`UserID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Booked-Lesson`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Booked-Lesson` (
  `BookedLessonID` INT NOT NULL AUTO_INCREMENT,
  `Date` DATE NULL,
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
  `ImageID` INT NULL,
  PRIMARY KEY (`ProductID`),
  INDEX `fk_Products_Image1_idx` (`ImageID` ASC) VISIBLE,
  CONSTRAINT `fk_Products_Image1`
    FOREIGN KEY (`ImageID`)
    REFERENCES `gymdb`.`Image` (`ImageID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Orders` (
  `UserID` INT NOT NULL,
  `Quantity` INT NOT NULL,
  `ProductID` INT NOT NULL,
  `OrderTime` DATETIME NULL,
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


use gymdb;
-- -----------------------------------------------------
-- Admin user
-- -----------------------------------------------------

insert into `user` (Email, `Password`) values ("admin@gmail.com", "$2y$10$p1.ZgpX2Hhig9.u5Aa52ce7zqBkRirCk9mlUEsBBZgJZjM7BETMXG");
insert into `admin` (AdminID, UserID) value (1, 1);

-- -----------------------------------------------------
-- Images
-- -----------------------------------------------------

insert into Image (ImageID, ImageLink) values 
(1, "../Images/Lessons/Spin.jpg"),
(2, "../Images/Lessons/Yoga.jpg"),
(3, "../Images/Lessons/Aerobics.jpg"),
(4, "../Images/Lessons/KickBoxing.jpg"),
(5, "../Images/Lessons/Gymnastics.jpg"),
(6, "../Images/Lessons/Crossfit.jpg"),
(7, "../Images/Lessons/ElderlyFitness.jpg"),
(8, "../Images/Lessons/KidsCrossfit.jpg"),
(9, "../Images/Products/dumbbells.jpg"),
(10, "../Images/Products/yoga.jpg"),
(11, "../Images/Products/resistanceb.jpg");

-- -----------------------------------------------------
-- Lessons
-- -----------------------------------------------------

insert into lessons (LessonID, LessonName, DurationMin, NumPlaces, Trainer, About, ImageID) values 
(1, "Spin", 60, 24, "Bob Ross", "Experience the exhilarating world of Spin at our gym. Harness the power of music and high-intensity cycling for a full-body workout. Join our dynamic classes led by expert instructors, pushing your limits in a supportive, energetic environment.", 1),
(2, "Yoga", 30, 24, "Daniel Connors", "Discover serenity and strength in our Yoga classes. Immerse yourself in a journey of mind-body connection, guided by experienced instructors. Whether you're a beginner or advanced practitioner, our classes offer a sanctuary for rejuvenation and self-discovery.", 2),
(3, "Aerobics", 20, 15, "Ann Sheeran", "Elevate your fitness with our Aerobics classes. Ignite your energy, improve cardiovascular health, and enhance endurance through dynamic routines. Our passionate instructors create a vibrant atmosphere, making every session a celebration of movement and vitality.", 3),
(4, "Kick boxing", 60, 30, "Tomas Smith", "Unleash your power with Kickboxing classes that blend martial arts and cardio. Learn proper techniques, build strength, and boost your confidence. Our classes provide a challenging yet fun environment, empowering you to conquer your fitness goals.", 4),
(5, "Gymnastics", 60, 25, "Denis O'Shea", "Explore the grace and strength of gymnastics in our dedicated classes. From fundamental skills to advanced techniques, our experienced coaches guide you through a journey of flexibility, balance, and agility. Join us to unleash your inner gymnast.", 5),
(6, "Crossfit", 45, 20, "Sarah Brown", "Embrace the intensity of Crossfit at our gym. Experience varied, high-intensity workouts that combine strength, cardio, and functional movements. Our supportive community and expert coaches ensure you reach new levels of fitness while enjoying the camaraderie.", 6),
(7, "Elderly fitness", 30, 15, "Sophie O'Neill", "Promote well-being and vitality through our Elderly Fitness classes. Tailored exercises focus on balance, flexibility, and strength, designed to enhance mobility and overall health. Join a welcoming community where staying active is a joyful journey.", 7),
(8, "Kids Crossfit", 30, 25, "Daren O'Brien", "Introduce your children to fitness through our Kids Crossfit classes. In a playful and encouraging environment, they'll develop agility, coordination, and strength. Our certified coaches make fitness fun, fostering a love for an active lifestyle from a young age.", 8);

-- -----------------------------------------------------
-- Lesson Times
-- -----------------------------------------------------

insert into `lesson-time` (LessonTimeID, `Time`, `Day`, LessonID) values
(1, '19:30', 1, 1), (2, '20:00', 3, 1), (3, '19:30', 5, 1),
(4, '18:30', 2, 2), (5, '18:30', 3, 2), (6, '14:00', 7, 2),
(7, '19:00', 1, 3), (8, '19:00', 4, 3), (9, '18:30', 5, 3),
(10, '19:00', 2, 4), (11, '20:00', 4, 4), (12, '19:00', 6, 4),
(13, '18:30', 3, 5), (14, '17:00', 6, 5), (15, '13:00', 7, 5),
(16, '20:00', 1, 6), (17, '20:00', 3, 6), (18, '18:30', 5, 6),
(19, '13:00', 2, 7), (20, '14:00', 4, 7), (21, '19:00', 6, 7),
(22, '16:30', 1, 8), (23, '17:00', 3, 8), (24, '12:00', 6, 8);

-- -----------------------------------------------------
-- Products
-- -----------------------------------------------------

INSERT INTO products (ProductID, ProductName, Price, Description, Size, Colour, ImageID) VALUES
(1, 'Dumbbells Set', 50, 'A set of adjustable weight dumbbells perfect for strength training at home.', 'Adjustable', 'Black', 9),
(2, 'Yoga Mat', 20, 'High-quality, non-slip yoga mat for all types of yoga and fitness exercises.', '68x24 inches', 'Purple', 10),
(3, 'Resistance Bands', 30, 'A set of 5 resistance bands with different strengths for a versatile workout.', '5-pack', 'Multicolor', 11);

