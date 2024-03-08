<?php
require "templates/header.php";
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
    <a href="templates/booking.php">Back To Booking</a>
<?php } ?>

<?php
require "templates/footer.php"
?>
