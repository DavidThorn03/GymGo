<?php
function enterBooking($userId, $lessonTimeId){
    require "../common.php";
    try {
        require "../config.php";
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "INSERT INTO `booked-lesson` (bookedLessonID, lessonTimeID, userID) VALUES (AUTO_INCREMENT, :lessonTimeID, :userID)";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':lessonTimeID', $lessonTimeId, PDO::PARAM_INT);
        $statement->bindValue(':userID', $userId, PDO::PARAM_INT);
        $statement->execute();
    }
    catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function deleteBooking($bookingId){
    try {
        require "../config.php";
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "DELETE FROM `booked-Lessons` WHERE bookingID = :bookingID";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':bookingID', $bookingId, PDO::PARAM_INT);
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

        $sql = "SELECT * FROM lessons INNER JOIN gallary on lessons.ImageID = gallary.ImageID";

        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

        return $result;

    }
    catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function getLessonTime($day){
    try {
        require "../config.php";
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "SELECT * FROM `lesson-time` WHERE Day = :day";

        try {
            $connection = new PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $statement = $connection->prepare($sql);
        $statement->bindParam(':day', $day, PDO::PARAM_STR);
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

        try {
            $connection = new PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

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