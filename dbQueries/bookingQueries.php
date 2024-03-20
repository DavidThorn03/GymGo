<?php
require "../common.php";

function enterBooking($date, $lessonTimeID, $userID){
    try {
        require "../config.php";
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "INSERT INTO `booked-lesson` (`Date`, LessonTimeID, UserID) VALUES (:date, :lessonTimeID, :userID)";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':date', $date, PDO::PARAM_STR);
        $statement->bindValue(':lessonTimeID', $lessonTimeID, PDO::PARAM_INT);
        $statement->bindValue(':userID', $userID, PDO::PARAM_INT);
        $statement->execute();
    }
    catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function deleteBooking($userID, $lessonTimeID){
    try {
        require "../config.php";
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "DELETE FROM `booked-Lesson` where userID = :userID AND LessonTimeID = :lessonTimeID";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':lessonTimeID', $lessonTimeID, PDO::PARAM_INT);
        $statement->bindValue(':userID', $userID, PDO::PARAM_INT);
        $statement->execute();
    }
    catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function getLessonInfo(){
    try {
        require "../config.php";
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "SELECT * FROM lessons";

        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

        return $result;

    }
    catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function getLessonTime(){
    try {
        require "../config.php";
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "SELECT * FROM `lesson-time` order by Time desc";

        $statement = $connection->prepare($sql);
        //$statement->bindParam(':day', $day, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();

        return $result;

    }
    catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function getBooking($userId){
    try {
        require "../config.php";
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "SELECT * FROM `booked-lesson` WHERE UserID = :userID";

        $statement = $connection->prepare($sql);
        $statement->bindParam(':userID', $userId, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
        
        return $result;

    }
    catch(PDOException $error){
        echo $sql . "<br>" . $error->getMessage();
    }
}

?>