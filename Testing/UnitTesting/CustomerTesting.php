<?php
require_once '../../UserClasses/customer.php'; 

// Test 1: Expected input
$customer1 = new Customer(1, "test@example.com", "password123", "John", "Doe", "1990-01-01", "A123", "123456789");
echo "Expected value for getUserID(): 1. Actual value: " . $customer1->getUserID() . "\n";
echo "Expected value for getEmail(): test@example.com. Actual value: " . $customer1->getEmail() . "\n";
echo "Expected value for getPassword(): password123. Actual value: " . $customer1->getPassword() . "\n";
echo "Expected value for getFname(): John. Actual value: " . $customer1->getFname() . "\n";
echo "Expected value for getSname(): Doe. Actual value: " . $customer1->getSname() . "\n";
echo "Expected value for getDOB(): 1990-01-01. Actual value: " . $customer1->getDOB() . "\n";
echo "Expected value for getEirCode(): A123. Actual value: " . $customer1->getEirCode() . "\n";
echo "Expected value for getPhone(): 123456789. Actual value: " . $customer1->getPhone() . "\n";

echo "\n";

// Test 2: Incorrect var types in constructor
$customer2 = new Customer("user1", 123, 456, 789, 1011, "2020-01-01", "B456", "987654321");
echo "Expected value for getUserID(): . Actual value: " . $customer2->getUserID() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getEmail(): . Actual value: " . $customer2->getEmail() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getPassword(): . Actual value: " . $customer2->getPassword() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getFname(): . Actual value: " . $customer2->getFname() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getSname(): . Actual value: " . $customer2->getSname() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getDOB(): . Actual value: " . $customer2->getDOB() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getEirCode(): . Actual value: " . $customer2->getEirCode() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getPhone(): . Actual value: " . $customer2->getPhone() . "\n"; // Output will be empty or null due to constructor errors

echo "\n";

// Test 3: Null input
$customer3 = new Customer(null, null, null, null, null, null, null, null);
echo "Expected value for getUserID(): . Actual value: " . $customer3->getUserID() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getEmail(): . Actual value: " . $customer3->getEmail() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getPassword(): . Actual value: " . $customer3->getPassword() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getFname(): . Actual value: " . $customer3->getFname() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getSname(): . Actual value: " . $customer3->getSname() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getDOB(): . Actual value: " . $customer3->getDOB() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getEirCode(): . Actual value: " . $customer3->getEirCode() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getPhone(): . Actual value: " . $customer3->getPhone() . "\n"; // Output will be empty or null due to constructor errors

echo "\n";

// Test 4: Empty input
$customer4 = new Customer("", "", "", "", "", "", "", "");
echo "Expected value for getUserID(): . Actual value: " . $customer4->getUserID() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getEmail(): . Actual value: " . $customer4->getEmail() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getPassword(): . Actual value: " . $customer4->getPassword() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getFname(): . Actual value: " . $customer4->getFname() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getSname(): . Actual value: " . $customer4->getSname() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getDOB(): . Actual value: " . $customer4->getDOB() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getEirCode(): . Actual value: " . $customer4->getEirCode() . "\n"; // Output will be empty or null due to constructor errors
echo "Expected value for getPhone(): . Actual value: " . $customer4->getPhone() . "\n"; // Output will be empty or null due to constructor errors

echo "\n";


