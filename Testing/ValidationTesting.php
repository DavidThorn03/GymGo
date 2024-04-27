<?php
require_once "../src/session.php";
require "../UserClasses/customer.php";
require "../ProductClasses/ShoppingCart.php";
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


//validation testing for adding/updating cart

echo "<br><br> Testing for adding/updating cart<br> <br>";

//functions to test adding to cart


/*
 * Test 1: As expected
 * Expected: Product will be added to cart successfully
 */
echo "Test 1: As expected <br>";

//user selects a product to add to cart
$cart = new ShoppingCart();
$_POST['productID'] = 1;
$_POST['action'] = 'add';
echo "Product with id 1 selected to with action add.<br>";//extra for testing
$cart->handleCartActions();

//system displays product added to cart
$cart->getProductDetails();
$found = false;
foreach($cart->getProductDetails() as $product){
    echo "Product with id " . $product->getProductID() . " added to cart successfully <br>";//extra for testing
    $found = true;
}
if(!$found){
    echo "Product not found in cart <br>";//extra for testing
}
unset($_SESSION['quantities']);//clear cart for next test


/*
 * Test 2: With out of range product id
 * Expected: No product added to cart
 *          error as no product id to add
 * Result: Errors as expected
 */

echo "<br>Test 2: With empty arrays <br>";

//user selects a product to add to cart
$cart = new ShoppingCart();
$_POST['productID'] = 5;//invalid id
$_POST['action'] = 'add';
echo "Product with id 5 selected to with action add.<br>";
$cart->handleCartActions();//errors as id is out of range

//system displays product added to cart
$cart->getProductDetails();//no products to display
$found = false;
foreach($cart->getProductDetails() as $product){//loop to see if product is added
    echo "Product with id " . $product->getProductID() . " added to cart successfully <br>";//extra for testing
    $found = true;
}
if(!$found){
    echo "Product not found in cart <br>";//extra for testing
}
unset($_SESSION['quantities']);//clear cart for next test


/*
 * Test 3: Incorrect action
 * Expected: No product added to cart
 * Result: As expected
 */
echo "<br>Test 3: Incorrect action <br>";

//user selects a product to add to cart
$cart = new ShoppingCart();
$_POST['productID'] = 1;
$_POST['action'] = 'wrong';//incorrect action
echo "Product with id 1 selected to with action wrong.<br>";
$cart->handleCartActions();//error as action is incorrect

//system displays product added to cart
$cart->getProductDetails();//no products to display
$found = false;
foreach($cart->getProductDetails() as $product){//loop to see if product is added
    echo "Product with id " . $product->getProductID() . " added to cart successfully <br>";//extra for testing
    $found = true;
}
if(!$found){
    echo "Product not found in cart <br>";//extra for testing
}
unset($_SESSION['quantities']);//clear cart for next test


/*
 * Test 4: Update missing product id
 * Expected: No product to update
 *         product with id is added as new product
 * Result: As expected
 */
echo "<br>Test 4: Update missing product id <br>";

//set product id to update
$cart = new ShoppingCart();
$_SESSION['quantities'][1] = 1;//set product id to update

//user selects a product to update in cart
$_POST['productID'] = 3;//doesnt match in cart
$_POST['action'] = 'update';
echo "Product with id 3 selected to with action update.<br>";
$cart->handleCartActions();//errors as product id doesnt match

//system displays product added to cart
$cart->getProductDetails();//no products to display
$found = false;
foreach($cart->getProductDetails() as $product){//loop to see if product is added
    echo "Product with id " . $product->getProductID() . " added to cart successfully <br>";//extra for testing
    $found = true;
}
if(!$found){
    echo "Product not found in cart <br>";//extra for testing
}
unset($_SESSION['quantities']);//clear cart for next test




/*
 * Test 5: With unset products array
 * Expected: No product added to cart
 *          error as no product id to add
 * Result: Errors as expected
 */
echo "<br>Test 5: With empty arrays <br>";

//unset products array
$products = unserialize($_SESSION['products']);//to re-add later
unset($_SESSION['products']);


//user selects a product to add to cart
$cart = new ShoppingCart();
$_POST['productID'] = 1;
$_POST['action'] = 'add';
echo "Product with id 1 selected to with action add.<br>";//extra for testing
$cart->handleCartActions();//errors as no products available

//system displays product added to cart
$cart->getProductDetails();//no products to display
$found = false;
foreach($cart->getProductDetails() as $product){//loop to see if product is added
    echo "Product with id " . $product->getProductID() . " added to cart successfully <br>";//extra for testing
    $found = true;
}
if(!$found){
    echo "Product not found in cart <br>";//extra for testing
}
unset($_SESSION['quantities']);//clear cart for next test
$_SESSION['products'] = serialize($products);//re-add products array




session::forgetSession();
unset($_POST);
?>