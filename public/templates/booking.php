<?php
    include "header.php";
    require "../dbQueries/bookingQueries.php";
    require "../BookingClasses/Lesson.php";
    require "../BookingClasses/LessonTime.php";

    $lessons = array();

    $lessonsFromDB = getLessonInfo();

    foreach ($lessonsFromDB as $row) {
        $lessons[] = new Lesson($row);
    }

    $lessonTimes = array();
    $lessonTimesFromDB = getLessonTime();
    $counter = 0;

    foreach ($lessonTimesFromDB as $row) {
        foreach ($lessons as $lesson) {
            if ($lesson->getLessonID() == $row["LessonID"]) {
                $lessonTimes[] = new LessonTime($row);
                $lessonTimes[$counter]->Lesson = $lesson;
            }
        }
        $counter++;
    }
    ?>
    <a href="../bookingBooked.php">Booked</a>
    <a href="../bookingAvailable.php">Available</a>

    <br>
<?php
