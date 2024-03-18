<?php
require_once "templates/booking.php";

if(isset($_POST['delete'])){
    deleteBooking($_POST['delete']);
    foreach ($bookedLessons as $bookedLesson){
        if($bookedLesson->getBookedLessonID() == $_POST['delete']){
            array_splice($bookedLessons, array_search($bookedLesson, $bookedLessons), 1);
        }
    }
    header("Refresh:0");
}

if(isset($_POST['lessonTimeID'])){
    foreach ($lessonTimes as $lessonTime){
        if($lessonTime->getLessonTimeID() == $_POST['lessonTimeID']){
            $newBooking = new BookedLesson(null);
            $newBooking->makeBooking(2, $lessonTime);
            $newBooking->LessonTime = $lessonTime;
            enterBooking($newBooking->getDate(), $lessonTime->getLessonTimeID(), $newBooking->getUserID());
        }
    }
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
    generateBookings($bookedLesson);
}
function generateBookings($bookedLesson){
    ?>
    <div class="col-lg-6">
        <div class="box">
            <div class="job_content-box">
                <div class="img-box">
                    <img src="<?php echo $bookedLesson->LessonTime->Lesson->getImageLink(); ?>" alt="" width="300">
                </div>
                <div class="detail-box">
                    <h5>
                        <?php echo $bookedLesson->LessonTime->Lesson->getLessonName(); ?>
                    </h5>
                    <div class="detail-info">

                        <h6>
                            <span>Duration: <?php echo $bookedLesson->LessonTime->Lesson->getDurationMin(); ?> Minutes</span>
                        </h6>
                        <h6>
                            <span>Time: <?php echo $bookedLesson->LessonTime->getTime(); ?></span>
                        </h6>
                        <h6>
                            <span>Time: <?php echo $bookedLesson->getDate(); ?></span>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="option-box">
                <a href="bookingInfo.php">MoreInfo</a>
                <form method="post">
                    <input type="hidden" name="delete" value="<?php echo $bookedLesson->getBookedLessonID(); ?>">
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