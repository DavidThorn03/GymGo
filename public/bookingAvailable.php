<?php
require_once "templates/booking.php";

if(isset($_POST['lessonTimeID'])){
    $count = 0;
    foreach ($lessonTimes as $lessonTime){
        if($lessonTime->getLessonTimeID() == $_POST['lessonTimeID']){
            $newBooking = new BookedLesson(null);
            $newBooking->makeBooking(2, $lessonTime);
            $newBooking->LessonTime = $lessonTime;
            $bookedLessons[] = $newBooking;
            $_SESSION['bookedLessons'] = serialize($bookedLessons);
            enterBooking($newBooking->getDate(), $lessonTime->getLessonTimeID(), $newBooking->getUserID());
            array_splice($lessonTimes, $count , 1);
            $_SESSION['lessonTimes'] = serialize($lessonTimes);
        }
        header("Refresh:0");
        $count++;
    }
}
?>
<form method="post">
    <input type="submit" name=1 value="Monday">
    <input type="submit" name=2 value="Tuesday">
    <input type="submit" name=3 value="Wednesday">
    <input type="submit" name=4 value="Thursday">
    <input type="submit" name=5 value="Friday">
    <input type="submit" name=6 value="Saturday">
    <input type="submit" name=7 value="Sunday">
    <br>
</form>

<section class="job_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Lessons Available
            </h2>
        </div>
        <div class="job_container">
            <h4 class="job_heading">
                <?php echo date("l");?>
            </h4>
            <div class="row">

                <?php
                if (count($_POST) == 0) {
                    foreach ($lessonTimes as $lessonTime) {
                        if ($lessonTime->getDay() == date("w")) {
                            generateLesson($lessonTime);
                        }
                    }
                }
                else{
                    for ($i = 1; $i < 8; $i++) {
                        if (isset($_POST[$i])) {
                            foreach ($lessonTimes as $lessonTime) {
                                if ($lessonTime->getDay() == $i) {
                                    generateLesson($lessonTime);
                                    $day = date("l", strtotime("Sunday +" . $i . " days"));
                                }
                            }
                        }
                    }
                }
                function generateLesson($lessonTime){
                    ?>
                    <div class="col-lg-6">
                        <div class="box">
                            <div class="job_content-box">
                                <div class="img-box">
                                    <img src="<?php echo $lessonTime->Lesson->getImageLink(); ?>" alt="" width="300">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        <?php echo $lessonTime->Lesson->getLessonName(); ?>
                                    </h5>
                                    <div class="detail-info">

                                        <h6>
                                            <span>Duration: <?php echo $lessonTime->Lesson->getDurationMin(); ?> Minutes</span>
                                        </h6>
                                        <h6>
                                            <span>Number of places: <?php echo $lessonTime->Lesson->getNumPlaces(); ?></span>
                                        </h6>
                                        <h6>
                                            <span>Trainer: <?php echo $lessonTime->Lesson->getTrainer(); ?></span>
                                        </h6>
                                        <h6>
                                            <span>Time: <?php echo $lessonTime->getTime(); ?></span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="option-box">
                                <a href="bookingInfo.php">MoreInfo</a>
                                <form method="post">
                                    <input type="hidden" name="lessonTimeID" value="<?php echo $lessonTime->getLessonTimeID(); ?>">
                                    <input type="submit" value="Book" class="apply-btn">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</section>
<?php require_once "templates/footer.php"; ?>
