<?php
//require "../common.php";

function createUser($user){
    require "../src/DBconnection.php";
    require "../UserClasses/Customer.php";

    try {
        $sql = "INSERT INTO cust (Email, Password, Fname, Sname, DOB, EirCode, Phone) 
        VALUES (:Fname, :Sname, :DOB, :EirCode, :Phone)";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':Email', $user->getEmail());
        $statement->bindValue(':Password', $user->getPassword());
        $statement->bindValue(':Fname', $user->getFname());
        $statement->bindValue(':Sname', $user->getSname());
        $statement->bindValue(':DOB', $user->getDOB());
        $statement->bindValue(':EirCode', $user->getEirCode());
        $statement->bindValue(':Phone', $user->getPhone());
        $statement->bindValue(':userID', $user->getUserID());
        $statement->execute();
        echo "User added successfully";
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
        $sql = "SELECT * FROM cust inner join user on cust.userid = user.userid WHERE user.email = :email";
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
        $sql = "SELECT count(*) FROM user WHERE Email = :email and Password = :password";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $userpassword);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user['count(*)'];
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
