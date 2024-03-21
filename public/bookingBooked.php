<?php
require_once "templates/booking.php";

if(isset($_POST['delete'])){
    $counter = 0;
    foreach ($bookedLessons as $bookedLesson){
        if($bookedLesson->LessonTime->getLessonTimeID() == $_POST['delete']){
            deleteBooking($bookedLesson->getUserID(), $bookedLesson->LessonTime->getLessonTimeID());
            $lessonTimes[] = $bookedLesson->LessonTime;
            array_splice($bookedLessons, $counter, 1);
            $_SESSION['bookedLessons'] = serialize($bookedLessons);
            $_SESSION['lessonTimes'] = serialize($lessonTimes);
        }
        $counter++;
    }
    header("Refresh:0");
}
else if(isset($_POST['MoreInfo'])){
    foreach ($lessons as $lesson){
        if($lesson->getLessonID() == $_POST['moreInfo']){
            $_SESSION['lessonInfo'] = $lesson;
            header("Location: bookingInfo.php");
        }
    }
    header("Location: bookingInfo.php");
}
?>

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
    generateBooking($bookedLesson);
}
function generateBooking($bookedLesson){
    ?>
    <div class="col-lg-6">
        <div class="box">
            <div class="job_content-box">
                <div class="img-box">
                    <img src="<?php echo $bookedLesson->LessonTime->Lesson->getImageLink(); ?>" alt="" width="300">
                </div>
                <div class="detail-box">
                    <h5>
                        <?php echo $bookedLesson->LessonTime->Lesson->getLessonName();?>
                    </h5>
                    <div class="detail-info">

                        <h6>
                            <span>Duration: <?php echo $bookedLesson->LessonTime->Lesson->getDurationMin(); ?> Minutes</span>
                        </h6>
                        <h6>
                            <span>Time: <?php echo $bookedLesson->LessonTime->getTime(); ?></span>
                        </h6>
                        <h6>
                            <span>Date: <?php echo $bookedLesson->getDate(); ?></span>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="option-box">
                <a href="bookingInfo.php">MoreInfo</a>
                <form method="post">
                    <input type="hidden" name="delete" value="<?php echo $bookedLesson->LessonTime->getLessonTimeID(); ?>">
                    <input type="submit" value="Delete">
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