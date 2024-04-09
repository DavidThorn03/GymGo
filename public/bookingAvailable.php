<?php
require_once "templates/booking.php";
require_once "../UserClasses/customer.php";
if (isset($_POST['lessonTimeID'])) {
    if(isset($_SESSION['user'])) {
        $user = unserialize($_SESSION['user']);
        $count = 0;
        foreach ($lessons as $lesson) {
            foreach ($lesson->getLessonTimes() as $lessonTime) {
                if ($lessonTime->getLessonTimeID() == $_POST['lessonTimeID']) {
                    $newBooking = new BookedLesson(null);
                    $newBooking->makeBooking($user->getUserID(), $lessonTime);
                    $bookedLessons[] = $newBooking;
                    $_SESSION['bookedLessons'] = serialize($bookedLessons);
                    enterBooking($newBooking->getDate(), $lessonTime->getLessonTimeID(), $newBooking->getUserID());
                    header("Refresh:0");
                }
                $count++;
            }
        }
    }
    else{
        header("Location: login.php");
    }
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
                    getLessonsToGenerate(date("w"), $lessons);
                }
                else if(isset($_POST['MoreInfo'])){
                    foreach ($lessons as $lesson){
                        if($lesson->getLessonID() == $_POST['moreInfo']){
                            $_SESSION['lessonInfo'] = $lesson;
                            header("Location: bookingInfo.php");
                        }
                    }
                }
                else{
                    for ($i = 1; $i < 8; $i++) {
                        if (isset($_POST[$i])) {
                            getLessonsToGenerate($i, $lessons);
                        }
                    }
                }

                function getLessonsToGenerate($dayOfWeek, $lessons){
                    foreach ($lessons as $lesson) {
                        foreach ($lesson->getLessonTimes() as $lessonTime) {
                            if (isset($_SESSION['bookedLessons']) && sizeof(unserialize($_SESSION['bookedLessons']))){
                                $bookedLessons = unserialize($_SESSION['bookedLessons']);
                                foreach ($bookedLessons as $bookedLesson) {
                                    if ($lessonTime->getLessonTimeID() != $bookedLesson->getLessonTime()->getLessonTimeID() && $lessonTime->getDay() == $dayOfWeek) {
                                        generateLesson($lesson, $lessonTime->getLessonTimeID());
                                    }
                                }
                            }
                            else{
                                if ($lessonTime->getDay() == $dayOfWeek) {
                                    generateLesson($lesson, $lessonTime->getLessonTimeID());
                                }
                            }
                        }
                    }
                }
                function generateLesson($lesson, $lessonTimeID){
                    ?>
                    <div class="col-lg-6">
                        <div class="box">
                            <div class="job_content-box">
                                <div class="img-box">
                                    <img src="<?php echo $lesson->getImageLink(); ?>" alt="" width="300">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        <?php echo $lesson->getLessonName(); ?>
                                    </h5>
                                    <div class="detail-info">

                                        <h6>
                                            <span>Duration: <?php echo $lesson->getDurationMin(); ?> Minutes</span>
                                        </h6>
                                        <h6>
                                            <span>Number of places: <?php echo $lesson->getNumPlaces(); ?></span>
                                        </h6>
                                        <h6>
                                            <span>Trainer: <?php echo $lesson->getTrainer(); ?></span>
                                        </h6>
                                        <h6>
                                            <span>Time: <?php echo $lesson->getLessonTime($lessonTimeID)->getTime(); ?></span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="option-box">
                                <form method="get">
                                    <input type="hidden" name="lessonID" value="<?php echo $lesson->getLessonID(); ?>">
                                    <input type="submit" value="More Info" class="apply-btn">
                                </form>
                                &nbsp;&nbsp;
                                <form method="post">
                                    <input type="hidden" name="lessonTimeID" value="<?php echo $lessonTimeID; ?>">
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
<?php require_once "templates/footer.php";
?>
