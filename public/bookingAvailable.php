<?php
require_once "templates/booking.php";

if(isset($_POST['lessonTimeID'])){
    //if(isset($_SESSION['user'])){
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
        $count++;
    }
    header("Refresh:0");
    /*
    }
    else{
        header("Location: login.php");
    }
    */
}
else if(isset($_GET['lessonID'])){
    $_SESSION['lessonID'] = $_GET['lessonID'];
    header("Location: bookingInfo.php");

}
?>
<form method="post">
    <div class="lesson-buttons">
        <button type="submit" name=1 class="btn-primary">Monday</button>
        <button type="submit" name=2 class="btn-primary">Tuesday</button>
        <button type="submit" name=3 class="btn-primary">Wednesday</button>
        <button type="submit" name=4 class="btn-primary">Thursday</button>
        <button type="submit" name=5 class="btn-primary">Friday</button>
        <button type="submit" name=6 class="btn-primary">Saturday</button>
        <button type="submit" name=7 class="btn-primary">Sunday</button>
    </div>
</form>
<br>

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
                                <form method="get">
                                    <input type="hidden" name="lessonID" value="<?php echo $lessonTime->Lesson->getLessonID(); ?>">
                                    <input type="submit" value="More Info" class="apply-btn">
                                </form>
                                &nbsp;&nbsp;
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
