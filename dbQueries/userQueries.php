<?php
//require "../common.php";

function createUser($user) {
    require "../src/DBconnection.php";
    try {
        // 1. Insert into 'User' table
        $sql = "INSERT INTO user (Email, Password) VALUES (:email, :password)";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':email', $user->getEmail());
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $statement->bindValue(':password', $hashedPassword);
        $statement->execute();

        // 2. Get the ID of the newly inserted user
        $userId = $connection->lastInsertId();

        // 3. Insert into 'Cust' table
        $sql = "INSERT INTO cust (Fname, Sname, DOB, EirCode, Phone, UserID) 
                VALUES (:Fname, :Sname, :DOB, :EirCode, :Phone, :UserID)";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':Fname', $user->getFname());
        $statement->bindValue(':Sname', $user->getSname());
        $statement->bindValue(':DOB', $user->getDOB());
        $statement->bindValue(':EirCode', $user->getEirCode());
        $statement->bindValue(':Phone', $user->getPhone());
        $statement->bindValue(':UserID', $userId);
        $statement->execute();

        return $userId;
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
function updateUser($user){
    require "../src/DBconnection.php";

    try {
        $sql = "UPDATE cust set Fname = :Fname, Sname = :Sname, DOB = :DOB, EirCode = :EirCode, Phone = :Phone
        where UserID = :userID";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':Fname', $user["Fname"]);
        $statement->bindValue(':Sname', $user["Sname"]);
        $statement->bindValue(':DOB', $user["DOB"]);
        $statement->bindValue(':EirCode', $user["EirCode"]);
        $statement->bindValue(':Phone', $user["Phone"]);
        $statement->bindValue(':userID', $user["UserID"]);
        $statement->execute();
        echo "User updated successfully";
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
function getUserInfo($email){
    require "../src/DBconnection.php";

    try {
        $sql = "SELECT * FROM cust inner join user on cust.UserID = user.UserID where email = :email";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
function checkLogin($email, $userpassword){
    require "../src/DBconnection.php";
    try {
        $sql = "SELECT Password FROM user WHERE Email = :email";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if($user == false){
            return false;
        }
        else {
            if (password_verify($userpassword, $user['Password'])) {
                return true;
            }
            else {
                return false;
            }
        }
    } catch (PDOException $error) {
        return false;
    }
}


function emailExists($email) {
    require "../src/DBconnection.php";

    try {
        $sql = "SELECT COUNT(*) FROM user WHERE Email = :email";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->execute();

        $result = $statement->fetchColumn();
        return $result; // Return true if the email exists, false otherwise

    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
        return false; // Handle the error appropriately
        }
}
?>