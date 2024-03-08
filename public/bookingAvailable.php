<?php
require_once "templates/booking.php";

?>
<br>
<form method="post">
    <input type="submit" name=1 value="Monday">
    <input type="submit" name=1 value="Tuesday">
    <input type="submit" name=1 value="Wednesday">
    <input type="submit" name=1 value="Thursday">
    <input type="submit" name=1 value="Friday">
    <input type="submit" name=1 value="Saturday">
    <input type="submit" name=1 value="Sunday">
    <br>
</form>
<?php
for($i = 0; $i < 7; $i++){
    if(isset($_POST[$i])){
        foreach ($lessonTimes as $lessonTime) {
            if($lessonTime->getDay() == $i){
                generateLesson($lessonTime);
            }
        }
    }
}
    function generateLesson($lessonTime){
    ?>
    Name: <?php echo $lessonTime->Lesson->getLessonName(); ?>
    <br>
    Duration: <?php echo $lessonTime->Lesson->getDurationMin(); ?> Minutes
    <br>
    Number of places: <?php echo $lessonTime->Lesson->getNumPlaces(); ?>
    <br>
    Trainer: <?php echo $lessonTime->Lesson->getTrainer(); ?>
    <br>
    Time: <?php echo $lessonTime->getTime(); ?>
    <br>
    Image(Link): <?php echo $lessonTime->Lesson->getImageLink();?>
    <br>
    <a href="bookingInfo.php">MoreInfo</a>
    <form method="post">
        <input type="hidden" name="lessonTimeID" value="<?php echo $lessonTime->getLessonTimeID(); ?>">
        <input type="submit" value="Book">
    </form>
    <br>
    <br>
<?php } ?>
<a href="index.php">Back to home</a>
