<?php
require_once '../../UserClasses/user.php';

// Test 1
$user1 = new User(1, "test@example.com", "password123");
echo "Test 1:<br>";
echo "Expected value for getUserID(): 1. Actual value: " . $user1->getUserID() . "<br>";
echo "Expected value for getEmail(): test@example.com. Actual value: " . $user1->getEmail() . "<br>";
echo "Expected value for getPassword(): password123. Actual value: " . $user1->getPassword() . "<br><br>";

echo "\n";

// Test 2
$user2 = new User(2, "another@example.com", "securepass");
echo "Test 2:<br>";
echo "Expected value for getUserID(): 2. Actual value: " . $user2->getUserID() . "<br>";
echo "Expected value for getEmail(): another@example.com. Actual value: " . $user2->getEmail() . "<br>";
echo "Expected value for getPassword(): securepass. Actual value: " . $user2->getPassword() . "<br><br>";

// Test 3
$user3 = new User(3, "example@test.com", "password456");
echo "Test 3:<br>";
echo "Expected value for getUserID(): 3. Actual value: " . $user3->getUserID() . "<br>";
echo "Expected value for getEmail(): example@test.com. Actual value: " . $user3->getEmail() . "<br>";
echo "Expected value for getPassword(): password456. Actual value: " . $user3->getPassword() . "<br><br>";

// Test 4
$user4 = new User(4, "testuser@example.com", "letmein");
echo "Test 4:<br>";
echo "Expected value for getUserID(): 4. Actual value: " . $user4->getUserID() . "<br>";
echo "Expected value for getEmail(): testuser@example.com. Actual value: " . $user4->getEmail() . "<br>";
echo "Expected value for getPassword(): letmein. Actual value: " . $user4->getPassword() . "<br><br>";