<?php
require "../../BookingClasses/BookedLesson.php";
require "../../BookingClasses/LessonTime.php";

$lessonTimeCorrect = new LessonTime(array("LessonTimeID" => 1, "Day" => 1, "Time" => "10:00:00", "LessonID" => 1));

$bookedLesson1 = new BookedLesson(array("BookedLessonID" => 1, "UserID" => 1, "LessonTimeID" => 1, "Date" => "2020-12-25"));
$bookedLesson1->setLessonTime($lessonTimeCorrect);
echo "Expected value for getUserID(): 1. Actual value: " . $bookedLesson1->getUserID() . "<br>";
echo "Expected value for getDate(): 25-12-2020. Actual value: " . $bookedLesson1->getDate() . "<br>";
echo "Expected value for getLessonTime():";
var_dump($lessonTimeCorrect);
echo "<br>Actual value: ";
var_dump($bookedLesson1->getLessonTime());

echo "<br><br>";

$bookedLesson2 = new BookedLesson(array("BookedLessonID" => 2, "UserID" => 2, "LessonTimeID" => 1, "Date" => "2020-12-25"));
$bookedLesson2->setLessonTime($lessonTimeCorrect);
echo "Expected value for getUserID(): 2. Actual value: " . $bookedLesson2->getUserID() . "<br>";
echo "Expected value for getDate(): 25-12-2020. Actual value: " . $bookedLesson2->getDate() . "<br>";
echo "Expected value for getLessonTime():";
var_dump($lessonTimeCorrect);
echo "<br>Actual value: ";
var_dump($bookedLesson2->getLessonTime());

echo "<br><br>";

$bookedLesson3 = new BookedLesson(array("BookedLessonID" => 3, "UserID" => 3, "LessonTimeID" => 1, "Date" => "2020-12-25"));
$bookedLesson3->setLessonTime($lessonTimeCorrect);
echo "Expected value for getUserID(): 3. Actual value: " . $bookedLesson3->getUserID() . "<br>";
echo "Expected value for getDate(): 25-12-2020. Actual value: " . $bookedLesson3->getDate() . "<br>";
echo "Expected value for getLessonTime():";
var_dump($lessonTimeCorrect);
echo "<br>Actual value: ";
var_dump($bookedLesson3->getLessonTime());

echo "<br><br>";

$bookedLesson4 = new BookedLesson(null);
$bookedLesson4->makeBooking(4, $lessonTimeCorrect);
echo "Expected value for getUserID(): 4. Actual value: " . $bookedLesson4->getUserID() . "<br>";
echo "Expected value for getDate(): 25-12-2020. Actual value: " . $bookedLesson4->getDate() . "<br>";
echo "Expected value for getLessonTime():";
var_dump($lessonTimeCorrect);
echo "<br>Actual value: ";
var_dump($bookedLesson4->getLessonTime());

echo "<br><br>";

$bookedLesson5 = new BookedLesson(null);
$bookedLesson5->makeBooking(2, $lessonTimeCorrect);
echo "Expected value for getUserID(): 2. Actual value: " . $bookedLesson5->getUserID() . "<br>";
echo "Expected value for getDate(): 25-12-2020. Actual value: " . $bookedLesson5->getDate() . "<br>";
echo "Expected value for getLessonTime():";
var_dump($lessonTimeCorrect);
echo "<br>Actual value: ";
var_dump($bookedLesson5->getLessonTime());

?>





