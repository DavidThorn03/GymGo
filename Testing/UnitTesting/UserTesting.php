<?php
require_once '../../UserClasses/user.php';

// Test 1: Expected input
$user1 = new User(1, "test@example.com", "password123");
echo "Expected value for getUserID(): 1. Actual value: " . $user1->getUserID() . "\n";
echo "Expected value for getEmail(): test@example.com. Actual value: " . $user1->getEmail() . "\n";
echo "Expected value for getPassword(): password123. Actual value: " . $user1->getPassword() . "\n";

echo "\n";

// Test 2: Incorrect var types in constructor
$user2 = new User("user1", 123, 456); // All parameters are of incorrect types
echo "Expected value for getUserID(): . Actual value: " . $user2->getUserID() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getEmail(): . Actual value: " . $user2->getEmail() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getPassword(): . Actual value: " . $user2->getPassword() . "\n"; // Output will be empty or null due to constructor errors

echo "\n";

// Test 3: Null input
$user3 = new User(null, null, null); // All parameters are null
echo "Expected value for getUserID(): . Actual value: " . $user3->getUserID() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getEmail(): . Actual value: " . $user3->getEmail() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getPassword(): . Actual value: " . $user3->getPassword() . "\n"; // Output will be empty or null due to constructor errors

echo "\n";

// Test 4: Empty input
$user4 = new User("", "", ""); // All parameters are empty strings
echo "Expected value for getUserID(): . Actual value: " . $user4->getUserID() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getEmail(): . Actual value: " . $user4->getEmail() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getPassword(): . Actual value: " . $user4->getPassword() . "\n"; // Output will be empty or null due to constructor errors

echo "\n";

// Test 5: Extra parameters
$user5 = new User(1, "test@example.com", "password123", "extra"); // Additional parameter provided
echo "Expected value for getUserID(): 1. Actual value: " . $user5->getUserID() . "\n"; // Output will be as expected
echo "Expected value for getEmail(): test@example.com. Actual value: " . $user5->getEmail() . "\n"; // Output will be as expected
echo "Expected value for getPassword(): password123. Actual value: " . $user5->getPassword() . "\n"; // Output will be as expected
?>
