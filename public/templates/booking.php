<?php
use GalleryClasses\Image;

include "header.php";
    require "../dbQueries/bookingQueries.php";
    require "../dbQueries/ImageQueries.php";
    require "../BookingClasses/Lesson.php";
    require "../BookingClasses/LessonTime.php";
    require "../BookingClasses/BookedLesson.php";
    require "../GalleryClasses/Image.php";

    session_start();

    if(!isset($_SESSION['images'])){
        $images = array();

        $imagesFromDB = getImages();

        foreach($imagesFromDB as $row){
            $images[] = new Image($row);
        }
        $_SESSION['images'] = serialize($images);
    }
    else{
        $images[] = unserialize($_SESSION['images']);
    }

    if(!isset($_SESSION['lessons'])) {
        $lessons = array();

        $lessonsFromDB = getLessonInfo();

        foreach ($lessonsFromDB as $row) {
            $lessons[] = new Lesson($row);
            if(isset($_SESSION['images'])) {
                foreach ($images as $image) {
                    if ($image->getImageID() == $row["ImageID"]) {
                        $lessons[count($lessons) - 1]->setImage($image);
                    }
                }
            }
        }
        $_SESSION['lessons'] = serialize($lessons);
    }
    else{
        $lessons = $_SESSION['lessons'];
    }

    if(!isset($_SESSION['lessonTimes'])) {
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
        $_SESSION['lessonTimes'] = serialize($lessonTimes);
    }
    else{
        $lessonTimes = unserialize($_SESSION['lessonTimes']);
    }

    if(!isset($_SESSION['bookedLessons'])) {
        $bookedLessons = array();
        $bookedLessonsFromDB = getBooking(2);
        $outerCounter = 0;
        foreach ($bookedLessonsFromDB as $row) {
            $innerCounter = 0;
            foreach ($lessonTimes as $lessonTime) {
                if ($lessonTime->getLessonTimeID() == $row["LessonTimeID"]) {
                    $bookedLessons[] = new BookedLesson($row);
                    $bookedLessons[$outerCounter]->LessonTime = $lessonTime;
                    array_splice($lessonTimes, $innerCounter, 1);
                    $_SESSION['lessonTimes'] = serialize($lessonTimes);
                }
                $innerCounter++;
            }
            $outerCounter++;
        }
        $_SESSION['bookedLessons'] = serialize($bookedLessons);
    }
    else{
        $bookedLessons = unserialize($_SESSION['bookedLessons']);
    }
    ?>
    <a href="../bookingBooked.php">Booked</a>
    <a href="../bookingAvailable.php">Available</a>

    <br>
<?php
