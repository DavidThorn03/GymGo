<?php
require_once "templates/header.php";
require_once "../UserClasses/customer.php";
$lessons = unserialize($_SESSION['lessons']);

if (isset($_POST['lessonTimeID'])) {
    if(isset($_SESSION['user'])) {
        $user = unserialize($_SESSION['user']);
        $bookedLessons = unserialize($_SESSION['bookedLessons']);
        $count = 0;
        foreach ($lessons as $lesson) {
            foreach ($lesson->getLessonTimes() as $lessonTime) {
                if ($lessonTime->getLessonTimeID() == $_POST['lessonTimeID']) {
                    $newBooking = new BookedLesson(null);
                    $newBooking->makeBooking($user->getUserID(), $lessonTime);
                    $bookedLessons[] = $newBooking;
                    $_SESSION['bookedLessons'] = serialize($bookedLessons);
                    enterBooking($newBooking->getDate(), $lessonTime->getLessonTimeID(), $newBooking->getUserID());
                    $lesson->removeLessonTime($lessonTime);
                    $_SESSION['lessons'] = serialize($lessons);
                    echo "<script>alert('Successfully booked " . $lesson->getLessonName() . "')</script>";
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
else if(isset($_POST['day'])){
    $day = $_POST['day'];
    $day = date("w", strtotime("Sunday +$day days"));
}
else{
    $day = date("w");
}
?>
<div class="heading_container heading_center">
    <a href="bookingBooked.php">Go to booked</a>
</div>
<section class="job_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Lessons Available
            </h2>
        </div>
        <form method="post">
            <div class="lesson-buttons">
                <button type="submit" name=day class="btn-primary" value="1">Monday</button>
                <button type="submit" name=day class="btn-primary" value="2">Tuesday</button>
                <button type="submit" name=day class="btn-primary" value="3">Wednesday</button>
                <button type="submit" name=day class="btn-primary" value="4">Thursday</button>
                <button type="submit" name=day class="btn-primary" value="5">Friday</button>
                <button type="submit" name=day class="btn-primary" value="6">Saturday</button>
                <button type="submit" name=day class="btn-primary" value="7">Sunday</button>
            </div>
        </form>
        <div class="job_container">
            <h4 class="heading_container heading_center">
                <?php  if(!isset($_POST['day'])) {
                    echo date("l");
                    $day = date("w");
                }
                else{
                    $day = $_POST['day'];
                    echo date("l", strtotime("Sunday +$day days"));
                }?>
            </h4>
            <div class="row">

                <?php
                if(isset($_POST['MoreInfo'])){
                    foreach ($lessons as $lesson){
                        if($lesson->getLessonID() == $_POST['moreInfo']){
                            $_SESSION['lessonInfo'] = $lesson;
                            header("Location: bookingInfo.php");
                        }
                    }
                }
                getLessonsToGenerate($day, $lessons);

                function getLessonsToGenerate($dayOfWeek, $lessons){
                    foreach ($lessons as $lesson) {
                        foreach ($lesson->getLessonTimes() as $lessonTime) {
                            if ($lessonTime->getDay() == $dayOfWeek) {
                                generateLesson($lesson, $lessonTime->getLessonTimeID());
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
                                    <img src="<?php echo $lesson->getImageLink(); ?>" alt="">
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
