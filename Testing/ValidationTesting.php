<?php
require_once "../src/session.php";
require "../UserClasses/customer.php";
session_start();
session::initialiseSessionItems();
if(!isset($_SESSION['bookedLessons'])) {
    $user = new Customer(2, "user@gmail.com", "password", "John", "Doe", "01/01/2000", "D01 123", "0871234567");
    session::initialiseUserSessionItems($user);
}

//validation for booking a lesson
echo "Validation Testing for booking a lesson<br> <br>";

//functions to test lesson booking
function bookLesson($lessons, $user, $bookedLessons){
    foreach ($lessons as $lesson) {
        foreach ($lesson->getLessonTimes() as $lessonTime) {
            if ($lessonTime->getLessonTimeID() == $_POST['lessonTimeID']) {
                $newBooking = new BookedLesson(null);
                if(is_object($user)) {//added to avoid fatial error in testing
                    $newBooking->makeBooking($user->getUserID(), $lessonTime);
                    $bookedLessons[] = $newBooking;
                    echo "Lesson with time id " . $newBooking->getLessonTime()->getLessonTimeID() . " booked successfully <br>";//extra for testing
                }
                else{
                    echo "Error as user info not found <br>";//extra for testing
                }
                //$_SESSION['bookedLessons'] = serialize($bookedLessons); //this is commented out as it is not needed for testing
                //enterBooking($newBooking->getDate(), $lessonTime->getLessonTimeID(), $newBooking->getUserID()); // this is commented out as it is not needed for testing
                //$lesson->removeLessonTime($lessonTime);
                //$_SESSION['lessons'] = serialize($lessons);// this is commented out as it is not needed for testing
                //header("Refresh:0"); // this is commented out as it is not needed for testing
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




//validation testing for canceling a lesson
echo "<br><br> Testing for canceling a booking<br> <br>";


//function to test cancel booking
function removeBooking($bookedLessons, $lessons){
    $counter = 0;
    foreach ($bookedLessons as $bookedLesson){
        if($bookedLesson->getLessonTime()->getLessonTimeID() == $_POST['delete']){
            //deleteBooking($bookedLesson->getUserID(), $bookedLesson->getLessonTime()->getLessonTimeID()); //this is commented out as it is not needed for testing
            foreach($lessons as $lesson){
                if($lesson->getLessonID() == $bookedLesson->getLessonTime()->getLessonID()){
                    $lesson->addLessonTime($bookedLesson->getLessonTime());
                    //$_SESSION['lessons'] = serialize($lessons); //this is commented out as it is not needed for testing
                    $user = unserialize($_SESSION['user']);
                    if(is_object($user)) {//added to avoid fatial error in testing
                        $user->setNumBookings($user->getNumBookings() - 1);
                        //$_SESSION['user'] = serialize($user); //this is commented out as it is not needed for testing
                        echo "Booking with time id " . $bookedLesson->getLessonTime()->getLessonTimeID() . " and user id " . $bookedLesson->getUserID() . " canceled successfully <br>";//extra for testing
                    }
                    else{
                        echo "Error as user info not found <br>";//extra for testing
                    }
                    //$_SESSION['user'] = serialize($user); //this is commented out as it is not needed for testing
                }
            }
            array_splice($bookedLessons, $counter, 1);
            //$_SESSION['bookedLessons'] = serialize($bookedLessons); //this is commented out as it is not needed for testing
            //header("Refresh:0"); //this is commented out as it is not needed for testing
        }
        $counter++;
    }
}
function generateBookedLessons($bookedLessons, $lessons){//added as function for re-usability in testing
    foreach ($bookedLessons as $bookedLesson) {
        foreach ($lessons as $lesson) {
            if ($lesson->getLessonID() == $bookedLesson->getLessonTime()->getLessonID()) {
                //generateBooking($bookedLesson, $lesson); //this is commented out as it is not needed for testing
                echo "Booking with time id " . $bookedLesson->getLessonTime()->getLessonTimeID() . " and user id " . $bookedLesson->getUserID() . " generated <br>";//extra for testing
                $ids[] = $bookedLesson->getLessonTime()->getLessonTimeID();
            }
        }
    }
    return $ids;
}

/*
 * Test 1: As expected
 * Expected: Lesson will be canceled successfully
 */
echo "Test 1: As expected <br>";
$user = new Customer(2, "user@gmail.com", "password", "John", "Doe", "01/01/2000", "D01 123", "0871234567");
$_SESSION['user'] = serialize($user);
$lessons = unserialize($_SESSION['lessons']);
$bookedLessons = unserialize($_SESSION['bookedLessons']);

//booked lessons are associated with lessons and shown
$ids = generateBookedLessons($bookedLessons, $lessons);

//user selects a booking to cancel
$_POST["delete"] = $ids[0];
removeBooking($bookedLessons, $lessons);


/*
 * Test 2: With empty arrays
 * Expected: No lessons generated
 *          error as no ids to cancel
 * Result: Errors as expected
 */
echo "<br>Test 2: With empty arrays <br>";
$user = new Customer(2, "user@gmail.com", "password", "John", "Doe", "01/01/2000", "D01 123", "0871234567");
$_SESSION['user'] = serialize($user);
$lessons = array();//empty array
$bookedLessons = array();

//booked lessons are associated with lessons and shown
$ids = generateBookedLessons($bookedLessons, $lessons);//empty arrays so no lessons associated and no ids available

//user selects a booking to cancel
$_POST["delete"] = $ids[0]; // no ids available
removeBooking($bookedLessons, $lessons);//errors as post is empty


/*
 * Test 3: with missing booked lesson id
 * Expected: lessons will generate but no lesson will be canceled
 * Result: As expected
 */
echo "<br>Test 3: with missing booked lesson id <br>";
$user = new Customer(2, "user@gmail.com", "password", "John", "Doe", "01/01/2000", "D01 123", "0871234567");
$_SESSION['user'] = serialize($user);
$lessons = unserialize($_SESSION['lessons']);
$bookedLessons = unserialize($_SESSION['bookedLessons']);

//booked lessons are associated with lessons and shown
$ids = generateBookedLessons($bookedLessons, $lessons);

//user selects a booking to cancel
$_POST["delete"] = 11111000000000;// not a valid id
removeBooking($bookedLessons, $lessons);//no lesson canceled as id is not found


/*
 * Test 4: with missing user
 * Expected: lessons will generate but cancel booking will cause errors
 * Result: As expected
 */
echo "<br>Test 4: with missing user <br>";
$user = null;//no user
$_SESSION['user'] = serialize($user);
$lessons = unserialize($_SESSION['lessons']);
$bookedLessons = unserialize($_SESSION['bookedLessons']);

//booked lessons are associated with lessons and shown
$ids = generateBookedLessons($bookedLessons, $lessons);

//user selects a booking to cancel
$_POST["delete"] = $ids[0];
removeBooking($bookedLessons, $lessons);//errors as user is null


//handle cart

$cart = new ShoppingCart();

// Test 1 Add Product
echo "Test 1 Add Product<br>";
$_POST = ['productID' => '1', 'action' => 'add'];
$cart->handleCartActions();
echo "Cart should have 1 item of product ID 1: " . $cart->getQuantity(1) . "<br><br>";

// Test 2 Increase Quantity
echo "Test 2 Increase Quantity<br>";
$_POST = ['productID' => '1', 'action' => 'increase', 'quantity' => '2'];
$cart->handleCartActions();
echo "Cart should have 3 items of product ID 1: " . $cart->getQuantity(1) . "<br><br>";

// Test 3 Update Product
echo "Test 3 Update Product<br>";
$_POST = ['productID' => '1', 'action' => 'update', 'quantity' => '5'];
$cart->handleCartActions();
echo "Cart should have 5 items of product ID 1: " . $cart->getQuantity(1) . "<br><br>";

// Test 4 Decrease Quantity
echo "Test 4 Decrease Quantity<br>";
$_POST = ['productID' => '1', 'action' => 'decrease', 'quantity' => '1'];
$cart->handleCartActions();
echo "Cart should have 4 items of product ID 1: " . $cart->getQuantity(1) . "<br><br>";

// Test 5 Remove Product
echo "Test 5 Remove Product<br>";
$_POST = ['productID' => '1', 'action' => 'remove'];
$cart->handleCartActions();
echo "Cart should have 0 items of product ID 1: " . $cart->getQuantity(1) . "<br><br>";

// Test 6 Missing Product ID
echo "Test 6 Missing Product ID<br>";
$_POST = ['action' => 'add', 'quantity' => '1'];
$cart->handleCartActions();
echo "Attempt to add with missing product ID, fail.<br><br>";

// Test 7 String Instead of Integer for Product ID
echo "Test 7 String Instead of Integer for Product ID<br>";
$_POST = ['productID' => 'one', 'action' => 'add', 'quantity' => '1'];
$cart->handleCartActions();
echo "Attempt to add with non integer product ID, fail.<br><br>";

// Test 8 Validating action
echo "Test 8 Unrecognized action used<br>";
$_POST = ['productID' => '1', 'action' => 'test', 'quantity' => '1'];
$cart->handleCartActions();
echo "Attempt to add with unrecognized action, fail.<br><br>";

// Display the cart just to see if all works
$cart->displayCart();


?>