<?php
require "../../BookingClasses/BookedLesson.php";
require "../../BookingClasses/LessonTime.php";

//for testing Booked Lesson class
$lessonTimeCorrect = new LessonTime(array("LessonTimeID" => 1, "Day" => 1, "Time" => "10:00:00"));
$lessonTimeIncorrect = new LessonTime(array("LessonTimeID" => "larry", "Day" => "Tuesday", "Time" => 11.30));

//expected input test
echo "Expected input test\n \n";
$bookedLesson1 = new BookedLesson(array("BookedLessonID" => 1, "UserID" => 1, "LessonTimeID" => 1, "Date" => "2020-12-25"));
$bookedLesson1->setLessonTime($lessonTimeCorrect);
echo "Expected value for getUserID(): 1. Actual value: " . $bookedLesson1->getUserID() . "\n";
echo "Expected value for getDate(): 25-12-2020. Actual value: " . $bookedLesson1->getDate() . "\n";
echo "Expected value for getLessonTime():";
var_dump($lessonTimeCorrect);
echo "Actual value: ";
var_dump($bookedLesson1->getLessonTime());

echo "\n";

$newBooking1 = new BookedLesson(null);
$newBooking1->makeBooking(1, $lessonTimeCorrect);
echo "Expected value for getUserID(): 1. Actual value: " . $newBooking1->getUserID() . "\n";
echo "Expected value for getDate(): next mondays date. Actual value: " . $newBooking1->getDate() . "\n";
echo "Expected value for getLessonTime():";
var_dump($lessonTimeCorrect);
echo "Actual value: ";
var_dump($newBooking1->getLessonTime());

echo "\n";
//make on pre initialised booking
echo "Make on pre initialised booking\n \n";
$bookedLesson4 = new BookedLesson(array("BookedLessonID" => 1, "UserID" => 1, "LessonTimeID" => 1, "Date" => "2020-12-25"));
$bookedLesson4->setLessonTime($lessonTimeCorrect);
$bookedLesson4->makeBooking(2, $lessonTimeCorrect);
echo "Expected value for getUserID(): 2. Actual value: " . $bookedLesson4->getUserID() . "\n";
echo "Expected value for getDate(): next mondays date. Actual value: " . $bookedLesson4->getDate() . "\n";
echo "Expected value for getLessonTime():";
var_dump($lessonTimeCorrect);
echo "Actual value: ";
var_dump($bookedLesson4->getLessonTime());

echo "\n";
//incorrect var types in array test
echo "Incorrect var types in array test\n \n";
$bookedLesson2 = new BookedLesson(array("BookedLessonID" => "larry", "UserID" => "user1", "LessonTimeID" => "lesson1", "Date" => "larry"));
$bookedLesson2->setLessonTime($lessonTimeIncorrect);
echo "Expected value for getUserID(): user1. Actual value: " . $bookedLesson2->getUserID() . "\n";//will still run although this will break code running
try{
    echo "Expected value for getDate(): Larry. Actual value: " . $bookedLesson2->getDate() . "\n";//code will break as cant convert to date format
}
catch(Exception $e){
    echo "Attempt to generate date lead to fatal exception: " . $e->getMessage() . "\n";//code will break as cant convert to date format
}
echo "Expected value for getLessonTime():";
var_dump($lessonTimeIncorrect);
echo "Actual value: ";
var_dump($bookedLesson2->getLessonTime());

echo "\n";
//null input test
echo "Null input test\n \n";
$bookedLesson3 = new BookedLesson(null);//wont generate errors as this is how new booking is made
$bookedLesson3->setLessonTime($lessonTimeCorrect);
echo "Expected value for getUserID(): . Actual value: " . $bookedLesson3->getUserID() . "\n";//returning null since constructor didnt function
echo "Expected value for getDate(): . Actual value: " . $bookedLesson3->getDate() . "\n";//returning null since constructor didnt function
echo "Expected value for getLessonTime():";
var_dump($lessonTimeCorrect);
echo "Actual value: ";
var_dump($bookedLesson3->getLessonTime());

echo "\n";

$newBooking3 = new BookedLesson(null);
$newBooking3->makeBooking(null, null);//will generate fatal error as null is converted to date
echo "Expected value for getUserID(): . Actual value: " . $newBooking3->getUserID() . "\n";//returning null since constructor didnt function
echo "Expected value for getDate(): . Actual value: " . $newBooking3->getDate() . "\n";//returning null since constructor didnt function
echo "Expected value for getLessonTime(): . Actual value: ";
var_dump($newBooking3->getLessonTime());//returning null since constructor didnt function
?>





