<?php
use GalleryClasses\Image;

class session
{
    public function killSession()
    {
        //overwrite the current session array with an empty array.
        $_SESSION = [];
        //overwrite the session cookie with empty data too.
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(),
                '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();
    }

    public function forgetSession()
    {
        $this->killSession();
        exit;
    }
    public static function logout(){
        $bookedLessons = unserialize($_SESSION['bookedLessons']);
        $lessonTimes = unserialize($_SESSION['lessonTimes']);
        foreach ($bookedLessons as $bookedLesson){
            $lessonTimes[] = $bookedLesson->LessonTime;
        }
        $_SESSION['lessonTimes'] = serialize($lessonTimes);

        unset($_SESSION['user']);
        unset($_SESSION['bookedLessons']);
        header("Location: login.php");
    }
    public static function initialiseSessionItems(){

        require "../dbQueries/bookingQueries.php";
        require "../dbQueries/ImageQueries.php";
        require "../BookingClasses/Lesson.php";
        require "../BookingClasses/LessonTime.php";
        require "../GalleryClasses/Image.php";
        require "../BookingClasses/BookedLesson.php";

        if(!isset($_SESSION['images'])){
            $images = array();

            $imagesFromDB = getImages();

            foreach($imagesFromDB as $row){
                $images[] = new Image($row);
            }
            $_SESSION['images'] = serialize($images);
        }

        if(!isset($_SESSION['lessons'])) {
            $lessons = array();

            $lessonsFromDB = getLessonInfo();

            foreach ($lessonsFromDB as $row) {
                $lessons[] = new Lesson($row);
                if(isset($_SESSION['images'])) {
                    foreach ($images as $image) {
                        if ($image->getImageID() == $row["ImageID"]) {
                            $lessons[count($lessons) - 1]->setImage($image);
                        }
                    }
                }
            }
            $_SESSION['lessons'] = serialize($lessons);
        }

        if(!isset($_SESSION['lessonTimes'])) {
            $lessonTimes = array();
            $lessonTimesFromDB = getLessonTime();
            $counter = 0;

            foreach ($lessonTimesFromDB as $row) {
                foreach ($lessons as $lesson) {
                    if ($lesson->getLessonID() == $row["LessonID"]) {
                        $lessonTimes[] = new LessonTime($row);
                        $lessonTimes[$counter]->Lesson = $lesson;
                    }
                }
                $counter++;
            }
            $_SESSION['lessonTimes'] = serialize($lessonTimes);
        }
    }
    public static function initialiseUserSessionItems($userID){
        $lessonTimes = unserialize($_SESSION['lessonTimes']);
        if(!isset($_SESSION['bookedLessons'])) {
            $bookedLessons = array();
            $bookedLessonsFromDB = getBooking($userID);
            $outerCounter = 0;
            foreach ($bookedLessonsFromDB as $row) {
                $innerCounter = 0;
                foreach ($lessonTimes as $lessonTime) {
                    if ($lessonTime->getLessonTimeID() == $row["LessonTimeID"]) {
                        $bookedLessons[] = new BookedLesson($row);
                        $bookedLessons[$outerCounter]->LessonTime = $lessonTime;
                        array_splice($lessonTimes, $innerCounter, 1);
                        $_SESSION['lessonTimes'] = serialize($lessonTimes);
                    }
                    $innerCounter++;
                }
                $outerCounter++;
            }
            $_SESSION['bookedLessons'] = serialize($bookedLessons);
        }
    }
}
