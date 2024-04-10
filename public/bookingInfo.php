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
                                <span><?php echo $lesson->getLessonName(); ?></span>
                            </h2>
                        </div>
                        <p>
                            <span>Duration: <?php echo $lesson->getDurationMin(); ?> Minutes</span>
                            <br>
                            <br>
                            <span>Number of places: <?php echo $lesson->getNumPlaces(); ?></span>
                            <br>
                            <br>
                            <span>Trainer: <?php echo $lesson->getTrainer(); ?></span>
                            <br>
                            <br>
                            <span>About: <?php echo $lesson->getAbout(); ?></span>
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
