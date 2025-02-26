<?php
require_once '../../UserClasses/customer.php'; 

// Test 1
$customer1 = new Customer(1, "test@example.com", "password123", "John", "Doe", "1990-01-01", "A123", "123456789");
echo "Test 1:<br>";
echo "Expected value for getUserID(): 1. Actual value: " . $customer1->getUserID() . "<br>";
echo "Expected value for getEmail(): test@example.com. Actual value: " . $customer1->getEmail() .  "<br>";
echo "Expected value for getPassword(): password123. Actual value: " . $customer1->getPassword() . "<br>";
echo "Expected value for getFname(): John. Actual value: " . $customer1->getFname() . "<br>";
echo "Expected value for getSname(): Doe. Actual value: " . $customer1->getSname() . "<br>";
echo "Expected value for getDOB(): 1990-01-01. Actual value: " . $customer1->getDOB() . "<br>";
echo "Expected value for getEirCode(): A123. Actual value: " . $customer1->getEirCode() . "<br>";
echo "Expected value for getPhone(): 123456789. Actual value: " . $customer1->getPhone() . "<br><br>";

echo "\n";

// Test 2
$customer2 = new Customer(2, "another@example.com", "securepass", "Alice", "Smith", "1985-12-15", "B456", "987654321");
echo "Test 2:<br>";
echo "Expected value for getUserID(): 2. Actual value: " . $customer2->getUserID() . "<br>";
echo "Expected value for getEmail(): another@example.com. Actual value: " . $customer2->getEmail() . "<br>";
echo "Expected value for getPassword(): securepass. Actual value: " . $customer2->getPassword() . "<br>";
echo "Expected value for getFname(): Alice. Actual value: " . $customer2->getFname() . "<br>";
echo "Expected value for getSname(): Smith. Actual value: " . $customer2->getSname() . "<br>";
echo "Expected value for getDOB(): 1985-12-15. Actual value: " . $customer2->getDOB() . "<br>";
echo "Expected value for getEirCode(): B456. Actual value: " . $customer2->getEirCode() . "<br>";
echo "Expected value for getPhone(): 987654321. Actual value: " . $customer2->getPhone() . "<br><br>";

// Test 3
$customer3 = new Customer(3, "example@test.com", "password123", "Emily", "Johnson", "1992-08-20", "C789", "555123456");
echo "Test 3:<br>";
echo "Expected value for getUserID(): 3. Actual value: " . $customer3->getUserID() . "<br>";
echo "Expected value for getEmail(): example@test.com. Actual value: " . $customer3->getEmail() . "<br>";
echo "Expected value for getPassword(): password123. Actual value: " . $customer3->getPassword() . "<br>";
echo "Expected value for getFname(): Emily. Actual value: " . $customer3->getFname() . "<br>";
echo "Expected value for getSname(): Johnson. Actual value: " . $customer3->getSname() . "<br>";
echo "Expected value for getDOB(): 1992-08-20. Actual value: " . $customer3->getDOB() . "<br>";
echo "Expected value for getEirCode(): C789. Actual value: " . $customer3->getEirCode() . "<br>";
echo "Expected value for getPhone(): 555123456. Actual value: " . $customer3->getPhone() . "<br><br>";

// Test 4
$customer4 = new Customer(4, "testuser@example.com", "letmein", "Michael", "Brown", "1980-05-10", "D123", "999000999");
echo "Test 4:<br>";
echo "Expected value for getUserID(): 4. Actual value: " . $customer4->getUserID() . "<br>";
echo "Expected value for getEmail(): testuser@example.com. Actual value: " . $customer4->getEmail() . "<br>";
echo "Expected value for getPassword(): letmein. Actual value: " . $customer4->getPassword() . "<br>";
echo "Expected value for getFname(): Michael. Actual value: " . $customer4->getFname() . "<br>";
echo "Expected value for getSname(): Brown. Actual value: " . $customer4->getSname() . "<br>";
echo "Expected value for getDOB(): 1980-05-10. Actual value: " . $customer4->getDOB() . "<br>";
echo "Expected value for getEirCode(): D123. Actual value: " . $customer4->getEirCode() . "<br>";
echo "Expected value for getPhone(): 999000999. Actual value: " . $customer4->getPhone() . "<br><br>";




