<?php
require_once "templates/booking.php";

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

foreach ($bookedLessons as $bookedLesson){
    generateBookings($bookedLesson);
}
if(isset($_POST['delete'])){
    echo $_POST['delete'];
    deleteBooking($_POST['delete']);
    header("Refresh:0");
}
if(isset($_POST['lessonTimeID'])){
    foreach ($lessonTimes as $lessonTime){
        if($lessonTime->getLessonTimeID() == $_POST['lessonTimeID']){
            $newBooking = new BookedLesson(null);
            $newBooking->makeBooking(2, $lessonTime);
            $newBooking->LessonTime = $lessonTime;
            enterBooking($newBooking->getDate(), $lessonTime->getLessonTimeID(), $newBooking->getUserID());
        }
    }
    header("Refresh:0");
}
function generateBookings($bookedLesson){
    ?>
    Name: <?php echo $bookedLesson->LessonTime->Lesson->getLessonName(); ?>
    <br>
    Duration: <?php echo $bookedLesson->LessonTime->Lesson->getDurationMin(); ?> Minutes
    <br>
    Start Time: <?php echo $bookedLesson->LessonTime->getTime(); ?>
    <br>
    Start Date: <?php echo $bookedLesson->getDate(); ?>
    <br>
    <img src= "<?php echo $bookedLesson->LessonTime->Lesson->getImageLink() ?>" alt="Image" width="300px" length="300px">
    <br>
    <a href="bookingInfo.php">MoreInfo</a>
    <form method="post">
        <input type="hidden" name="delete" value="<?php echo $bookedLesson->getBookedLessonID(); ?>">
        <input type="submit" value="Delete">
    </form>
    <br>
    <br>
<?php } ?>

<?php include "templates/footer.php"; ?>