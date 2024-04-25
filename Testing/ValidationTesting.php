<?php
require_once "../src/session.php";
require "../UserClasses/customer.php";
session_start();
session::initialiseSessionItems();
session::initialiseUserSessionItems(2);
//validation for booking a lesson

//functions to test lesson booking
function bookLesson($lessons, $user, $bookedLessons){
    foreach ($lessons as $lesson) {
        foreach ($lesson->getLessonTimes() as $lessonTime) {
            if ($lessonTime->getLessonTimeID() == $_POST['lessonTimeID']) {
                $newBooking = new BookedLesson(null);
                $newBooking->makeBooking($user->getUserID(), $lessonTime);
                $bookedLessons[] = $newBooking;
                //$_SESSION['bookedLessons'] = serialize($bookedLessons); //this is commented out as it is not needed for testing
                //enterBooking($newBooking->getDate(), $lessonTime->getLessonTimeID(), $newBooking->getUserID()); // this is commented out as it is not needed for testing
                $lesson->removeLessonTime($lessonTime);
                //$_SESSION['lessons'] = serialize($lessons);// this is commented out as it is not needed for testing
                //echo "<script>alert('Successfully booked " . $lesson->getLessonName() . "')</script>"; // this is commented out as it is not needed for testing
                //header("Refresh:0"); // this is commented out as it is not needed for testing
                echo "Lesson with time id " . $newBooking->getLessonTime()->getLessonTimeID() . " booked successfully <br>";//extra for testing
            }
        }
    }
}

function getLessonsToGenerate($dayOfWeek, $lessons){
    foreach ($lessons as $lesson) {
        foreach ($lesson->getLessonTimes() as $lessonTime) {
            if ($lessonTime->getDay() == $dayOfWeek) {
                //generateLesson($lesson, $lessonTime->getLessonTimeID()); // this is commented out as it is not needed for testing
                echo "Lesson generated with time id " . $lessonTime->getLessonTimeID() . "<br>";//extra for testing
                $ids[] = $lessonTime->getLessonTimeID();//extra for testing
            }
        }
    }
    return $ids;//extra for testing
}

/*
 * Test 1: As expected
 * Expected: Lesson will generate and be booked successfully
 */
echo "Test 1: As expected <br>";
$lessons = unserialize($_SESSION['lessons']);
$user = new Customer(2, "user@gmail.com", "password", "John", "Doe", "01/01/2000", "D01 123", "0871234567");
$bookedLessons = array();

//user enters day they want to select, 1 - 7
$ids = getLessonsToGenerate(1, $lessons);

//user selects a lesson time to book
$_POST['lessonTimeID'] = $ids[0];
bookLesson($lessons, $user, $bookedLessons);


/*
 * Test 2: With empty arrays
 * Expected: No lessons generated
 *          error as no ids to book
 * Result: Errors as expected
 */
echo "<br>Test 2: With empty arrays <br>";
$lessons = array();//empty array
$user = new Customer(2, "user@gmail.com", "password", "John", "Doe", "01/01/2000", "D01 123", "0871234567");
$bookedLessons = array();

//user enters day they want to select, 1 - 7
$ids = getLessonsToGenerate(2, $lessons);//empty array so no lessons generated and no ids available

//user selects a lesson time to book
$_POST['lessonTimeID'] = $ids[0]; // no ids available
bookLesson($lessons, $user, $bookedLessons);//errors as post is empty

/*
 * Test 3: with missing lesson id
 * Expected: lessons will generate but no lesson will be booked
 * Result: As expected
 */
echo "<br>Test 3: with missing lesson id <br>";
$lessons = unserialize($_SESSION['lessons']);
$user = new Customer(2, "user@gmail.com", "password", "John", "Doe", "01/01/2000", "D01 123", "0871234567");
$bookedLessons = array();

//user enters day they want to select, 1 - 7
$ids = getLessonsToGenerate(3, $lessons);

//user selects a lesson time to book
$_POST['lessonTimeID'] =  11111000000000;// not a valid id
bookLesson($lessons, $user, $bookedLessons);//no lesson booked as id is not found


/*
 * Test 4: with missing user
 * Expected: lessons will generate but book lesson will cause errors
 * Result: As expected
 */
echo "<br>Test 4: with missing user <br>";
$lessons = unserialize($_SESSION['lessons']);
$user = null;//no user
$bookedLessons = array();

//user enters day they want to select, 1 - 7
$ids = getLessonsToGenerate(4, $lessons);

//user selects a lesson time to book
$_POST['lessonTimeID'] = $ids[0];
bookLesson($lessons, $user, $bookedLessons);//errors as user is null

?>