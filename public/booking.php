<?php
    include "templates/header.php";
    require "../dbQueries/bookingQueries.php";
    require "../BookingClasses/Lesson.php";
    require "../BookingClasses/LessonTime.php";
    require "../BookingClasses/BookedLesson.php";


    $lessons = array();

    $lessonsFromDB = getLessonInfo();

    foreach ($lessonsFromDB as $row) {
        $lessons[] = new Lesson($row);
    }

    foreach ($lessons as $lesson) {
        generateLesson($lesson);
        echo "<br>";
    }

    $lessonTimes = array();
    $lessonTimesFromDB = getLessonTime(1);
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
    foreach ($lessonTimes as $lessonTime) {
        echo $lessonTime->getLessonTimeID();
        echo $lessonTime->getDay();
        echo $lessonTime->getTime();
        echo $lessonTime->Lesson->getLessonName();
    }

    $bookedLessons = array();
    $bookedLessonsFromDB = getBooking(2);
    $counter = 0;
    foreach ($bookedLessonsFromDB as $row) {
        foreach ($lessonTimes as $lessonTime) {
            if ($lessonTime->getLessonTimeID() == $row["LessonTimeID"]) {
                $bookedLessons[] = new BookedLesson($row);
                $bookedLessons[$counter]->LessonTime = $lessonTime;
            }
        }
        $counter++;
    }
    enterBooking(2, 1);
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

<?php
    function generate()
    {

    }

?>

<?php include "templates/footer.php"; ?>



