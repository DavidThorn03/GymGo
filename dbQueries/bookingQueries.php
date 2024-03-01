<?php
function enterBooking($userId, $lessonId)
{
    require "../common.php";

    try {
        require_once "../src/DBconnection.php";

        $new_booking = array(
            "userId" => $userId,
            "lessonId" => $lessonId
        );

        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "Booked-Lesson", implode(", ",
            array_keys($new_booking)), ":" . implode(", :", array_keys($new_booking)));

        $statement = $connection->prepare($sql);
        $statement->execute($new_booking);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}


?>