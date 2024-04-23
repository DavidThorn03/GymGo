<?php
require_once "templates/header.php";
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
}
$lessons = unserialize($_SESSION['lessons']);

$bookedLessons = unserialize($_SESSION['bookedLessons']);
var_dump($bookedLessons);
if(isset($_POST['delete'])){
    $counter = 0;
    foreach ($bookedLessons as $bookedLesson){
        if($bookedLesson->getLessonTime()->getLessonTimeID() == $_POST['delete']){
            deleteBooking($bookedLesson->getUserID(), $bookedLesson->getLessonTime()->getLessonTimeID());
            foreach($lessons as $lesson){
                if($lesson->getLessonID() == $bookedLesson->getLessonTime()->getLessonID()){
                    $lesson->addLessonTime($bookedLesson->getLessonTime());
                    $_SESSION['lessons'] = serialize($lessons);
                    echo "<script>alert('Successfully cancled  " . $lesson->getLessonName() . "')</script>";
                }
            }
            array_splice($bookedLessons, $counter, 1);
            $_SESSION['bookedLessons'] = serialize($bookedLessons);
            header("Refresh:0");
        }
        $counter++;
    }
}
else if(isset($_GET['lessonID'])){
    $_SESSION['lessonID'] = $_GET['lessonID'];
    header("Location: bookingInfo.php");
}
?>
    <div class="heading_container heading_center">
        <a href="bookingAvailable.php">Back to available</a>
    </div>
    <section class="job_section layout_padding">
    <div class="container">
    <div class="heading_container heading_center">
        <h2>
            Lessons Booked
        </h2>
    </div>
    <div class="job_container">
    <div class="row">

<?php

foreach ($bookedLessons as $bookedLesson){
    foreach ($lessons as $lesson){
        if($lesson->getLessonID() == $bookedLesson->getLessonTime()->getLessonID()){
            generateBooking($bookedLesson, $lesson);
        }
    }
}
function generateBooking($bookedLesson, $lesson){
    ?>
    <div class="col-lg-6">
        <div class="box">
            <div class="job_content-box">
                <div class="img-box">
                    <img src="<?php echo $lesson->getImageLink(); ?>" alt="" width="300">
                </div>
                <div class="detail-box">
                    <h5>
                        <?php echo $lesson->getLessonName();?>
                    </h5>
                    <div class="detail-info">

                        <h6>
                            <span>Duration: <?php echo $lesson->getDurationMin(); ?> Minutes</span>
                        </h6>
                        <h6>
                            <span>Time: <?php echo $bookedLesson->getLessonTime()->getTime(); ?></span>
                        </h6>
                        <h6>
                            <span>Date: <?php echo $bookedLesson->getDate(); ?></span>
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
                    <input type="hidden" name="delete" value="<?php echo $bookedLesson->getLessonTime()->getLessonTimeID(); ?>">
                    <input type="submit" value="Delete" class="apply-btn">
                </form>
            </div>
        </div>
    </div>
<?php } ?>

        </div>
        </div>
        </div>
    </section>

<?php include "templates/footer.php"; ?>