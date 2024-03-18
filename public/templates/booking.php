<?php

use GalleryClasses\Image;

include "header.php";
    require "../dbQueries/bookingQueries.php";
    require "../dbQueries/ImageQueries.php";
    require "../BookingClasses/Lesson.php";
    require "../BookingClasses/LessonTime.php";
    require "../BookingClasses/BookedLesson.php";
    require "../GalleryClasses/Image.php";

    $images = array();

    $imagesFromDB = getImages();

    foreach($imagesFromDB as $row){
        $images[] = new Image($row);
    }

    $lessons = array();

    $lessonsFromDB = getLessonInfo();

    foreach ($lessonsFromDB as $row) {
        $lessons[] = new Lesson($row);
        foreach ($images as $image) {
            if ($image->getImageID() == $row["ImageID"]) {
                $lessons[count($lessons) - 1]->setImage($image);
            }
        }
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
