<?php
require "../UserClasses/customer.php";

//set user to use methods

$user = new Customer(2, "user@gmail.com", "password", "John", "Doe", "01/01/2000", "D01 123", "0871234567");

/* Testing for wooden
 * From 0 - 5
 * Expected: Wooden will be generated
 */
echo "Testing for wooden <br><br>";
echo "Between 0 - 5 <br>";
$user->setNumBookings(0);
echo "When set to 0: " . $user->getBadge() . "<br>";
$user->setNumBookings(3);
echo "When set to 3: " . $user->getBadge() . "<br>";
$user->setNumBookings(5);
echo "When set to 5: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(6);
echo "When set to 6 should be out of wooden range. <br>Result: " . $user->getBadge() . "<br><br>";


/* Testing for stone
 * From 6 - 10
 * Expected: Stone will be generated
 */
echo "<br>Testing for Stone <br><br>";
echo "Between 6 - 10 <br>";
$user->setNumBookings(5);
echo "When set to 5 should be out of stone range. <br>Results: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(6);
echo "When set to 6: " . $user->getBadge() . "<br>";
$user->setNumBookings(8);
echo "When set to 8: " . $user->getBadge() . "<br>";
$user->setNumBookings(10);
echo "When set to 10: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(11);
echo "When set to 11 should be out of stone range. <br>Result: " . $user->getBadge() . "<br><br>";


/* Testing for Iron
 * From 11 - 15
 * Expected: Iron will be generated
 */
echo "<br>Testing for Iron <br><br>";
echo "Between 11 - 15 <br>";
$user->setNumBookings(10);
echo "When set to 10 should be out of iron range. <br>Result: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(11);
echo "When set to 11: " . $user->getBadge() . "<br>";
$user->setNumBookings(13);
echo "When set to 13: " . $user->getBadge() . "<br>";
$user->setNumBookings(15);
echo "When set to 15: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(16);
echo "When set to 16 should be out of iron range. <br>Result: " . $user->getBadge() . "<br><br>";


/* Testing for Bronze
 * From 16 - 20
 * Expected: Bronze will be generated
 */
echo "<br>Testing for Bronze <br><br>";
echo "Between 16 - 20 <br>";
$user->setNumBookings(15);
echo "When set to 15 should be out of bronze range. <br>Result: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(16);
echo "When set to 16: " . $user->getBadge() . "<br>";
$user->setNumBookings(18);
echo "When set to 18: " . $user->getBadge() . "<br>";
$user->setNumBookings(20);
echo "When set to 20: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(21);
echo "When set to 21 should be out of bronze range. <br>Result: " . $user->getBadge() . "<br><br>";


/* Testing for Silver
 * From 21 - 25
 * Expected: Silver will be generated
 */
echo "<br>Testing for Silver <br><br>";
echo "Between 21 - 25 <br>";
$user->setNumBookings(20);
echo "When set to 20 should be out of silver range. <br>Result: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(21);
echo "When set to 21: " . $user->getBadge() . "<br>";
$user->setNumBookings(23);
echo "When set to 23: " . $user->getBadge() . "<br>";
$user->setNumBookings(25);
echo "When set to 25: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(26);
echo "When set to 26 should be out of silver range. <br>Result: " . $user->getBadge() . "<br><br>";


/* Testing for Gold
 * From 26 - 30
 * Expected: Gold will be generated
 */
echo "<br>Testing for Gold <br><br>";
echo "Between 26 - 30 <br>";
$user->setNumBookings(25);
echo "When set to 25 should be out of gold range. <br>Result: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(26);
echo "When set to 26: " . $user->getBadge() . "<br>";
$user->setNumBookings(28);
echo "When set to 28: " . $user->getBadge() . "<br>";
$user->setNumBookings(30);
echo "When set to 30: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(31);
echo "When set to 31 should be out of gold range. <br>Result: " . $user->getBadge() . "<br><br>";


/* Testing for Platinum
 * From 31 - 35
 * Expected: Platinum will be generated
 */
echo "<br>Testing for Platinum <br><br>";
echo "Between 31 - 35 <br>";
$user->setNumBookings(30);
echo "When set to 30 should be out of platinum range. <br>Result: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(31);
echo "When set to 31: " . $user->getBadge() . "<br>";
$user->setNumBookings(33);
echo "When set to 33: " . $user->getBadge() . "<br>";
$user->setNumBookings(35);
echo "When set to 35: " . $user->getBadge() . "<br><br>";
$user->setNumBookings(36);
echo "When set to 36 should be out of platinum range. <br>Result: " . $user->getBadge() . "<br><br>";


/* Testing for Diamond
 * Greater than 35
 * Expected: Diamond will be generated
 */
echo "<br>Testing for Diamond <br><br>";
echo "Greater then 35<br>";
$user->setNumBookings(35);
echo "When set to 35: should be out of diamond range. <br>Result " . $user->getBadge() . "<br><br>";
$user->setNumBookings(36);
echo "When set to 36: " . $user->getBadge() . "<br>";
$user->setNumBookings(38);
echo "When set to 10000: " . $user->getBadge() . "<br>";
$user->setNumBookings(10000);


