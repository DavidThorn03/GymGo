<?php
    include "templates/header.php";
    require "../dbQueries/bookingQueries.php";
    require "../BookingClasses/Lesson.php";
    require "../BookingClasses/LessonTime.php";


    // Initialise lessons as lessons array
    $lessons = array();

    //if($lessons = null) {
    $lessonsFromDB = getLessonInfo(1);

    foreach ($lessonsFromDB as $row) {
        $lessons[] = new Lesson($row);
    }
    //}
    foreach ($lessons as $lesson) {
        generateLesson($lesson);
        echo "<br>";
    }


    //initialise lessonTimes as lessonTimes array
    $lessonTimes = array();
    $lessonTimesFromDB = getLessonTime(1);

    foreach ($lessonTimesFromDB as $row) {
        foreach ($lessons as $lesson) {
            if ($lesson->getLessonID() == $row["LessonID"]) {
                $lessonTimes[] = new LessonTime($lesson, $row);
            }
        }
    }
    foreach ($lessonTimes as $lessonTime) {
        echo $lessonTime->getLessonTimeID();
        echo $lessonTime->getDay();
        echo $lessonTime->getTime();
    }

    $bookedLessons = array();
    $bookedLessonsFromDB = getBookedLessons(1);
    foreach ($bookedLessionsFromDB as $row) {
        foreach ($lessonTimes as $lessonTime) {
            if ($lessonTime->getLessonTimeID() == $row["LessonTimeID"]) {
                $bookedLessons[] = new BookedLesson($lessonTime, $row);
            }
        }
    }
    var_dump($bookedLessons);
    function generateLesson($lesson){
        ?>
        Name: <?php echo $lesson->getLessonName(); ?>
            <br>
        Duration: <?php echo $lesson->getDurationMin(); ?> Minutes
            <br>
        Number of places: <?php echo $lesson->getNumPlaces(); ?>
            <br>
        Trainer: <?php echo $lesson->getTrainer(); ?>
            <br>
        About: <?php echo $lesson->getAbout(); ?>
            <br>
        Image(Link): <?php echo $lesson->getImageLink();?>
            <br>
        <?php } ?>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>



