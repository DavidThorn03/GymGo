<?php
require "templates/header.php";
$lessons = unserialize($_SESSION['lessons']);
foreach ($lessons as $lesson) {
    if($lesson->getLessonID() == $_SESSION['lessonID']){
        generateLesson($lesson);
    }
}
function generateLesson($lesson){
        ?>
    <section class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                <?php echo $lesson->getLessonName(); ?>
                            </h2>
                        </div>
                        <p>
                            Duration: <?php echo $lesson->getDurationMin(); ?> Minutes
                            <br>
                            <br>
                            Number of places: <?php echo $lesson->getNumPlaces(); ?>
                            <br>
                            <br>
                            Trainer: <?php echo $lesson->getTrainer(); ?>
                            <br>
                            <br>
                            About: <?php echo $lesson->getAbout(); ?>
                            <br>
                        </p>
                        <a href="bookingAvailable.php" class="apply-btn">Back to Lessons</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="<?php echo $lesson->getImageLink();?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<?php
require "templates/footer.php"
?>
