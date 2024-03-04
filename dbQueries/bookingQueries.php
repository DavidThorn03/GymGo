<?php
function enterBooking($userId, $lessonId)
{
    require "../common.php";

    try {
        require_once "../src/DBconnection.php";

        $new_booking = array(
            "userID" => $userId,
            "lessonID" => $lessonId
        );

        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "Booked-Lesson", implode(", ",
            array_keys($new_booking)), ":" . implode(", :", array_keys($new_booking)));

        $statement = $connection->prepare($sql);
        $statement->execute($new_booking);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function deleteBooking($bookingId){
    try {
        require_once '../src/DBconnection.php';
        $sql = "DELETE FROM `booked-Lessons` WHERE bookingID = :bookingID";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':bookingID', $bookingId, PDO::PARAM_INT);
        $statement->execute();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function getLessonInfo($lessonId){
    try {

        require_once "../src/DBconnection.php";

        $sql = "SELECT * FROM lessons INNER JOIN gallary on lessons.ImageID = gallary.ImageID ";

        $statement = $connection->prepare($sql);
        $statement->bindParam(':lessonID', $lessonId, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetchAll();

        return $result;

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function getLessonTime($day)
{
    try {
        require_once "../src/DBconnection.php";

        $sql = "SELECT * FROM `lesson-time` WHERE Day = :Day";

        $statement = $connection->prepare($sql);
        $statement->bindParam(':Day', $Day, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();

        return $result;

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function getBooking($lessonTimeId, $userId){
    try {
        require_once "../src/DBconnection.php";

        $sql = "SELECT * FROM `lesson-time` WHERE lessonID = :lessonID AND userID = :userID";

        $statement = $connection->prepare($sql);
        $statement->bindParam(':lessonTimeID', $lessonTimeId, PDO::PARAM_STR);
        $statement->bindParam(':userID', $userId, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
        $result = $result[0];
        return $result;

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

?>