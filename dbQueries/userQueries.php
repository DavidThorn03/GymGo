<?php
function createUser(){
if (isset($_POST['register'])) {
    require "../common.php";

    try {
        require_once "../src/DBconnection.php";

        $new_user = array(
            "Fname" => $_POST['firstname'],
            "Sname" => $_POST['lastname'],
            "DOB" => $_POST['date_of_birth'],
            "EirCode" => $_POST['eircode'],
            "Phone" => $_POST['phone'],
        );


        $sql = "INSERT INTO cust (Fname, Sname, DOB, EirCode, Phone) 
        VALUES (:Fname, :Sname, :DOB, :EirCode, :Phone)";

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

        echo "User successfully added";
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
}
function updateUser($user){
    require "../common.php";

    try {
        require_once "../src/DBconnection.php";

        $new_user = array(
            "Fname" => $_POST['firstname'],
            "Sname" => $_POST['lastname'],
            "DOB" => $_POST['date_of_birth'],
            "EirCode" => $_POST['eircode'],
            "Phone" => $_POST['phone'],
        );


        $sql = "UPDATE cust set Fname = :Fname, Sname = :Sname, DOB = :DOB, EirCode = :EirCode, Phone = ;Phone
        where UserID = :userID";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':Fname', $user["firstname"]);
        $statement->bindValue(':Sname', $user["lastname"]);
        $statement->bindValue(':DOB', $user["dob"]);
        $statement->bindValue(':EirCode', $user["eircode"]);
        $statement->bindValue(':Phone', $user["phone"]);
        $statement->bindValue(':userID', $user["id"]);
        $statement->execute($new_user);

        echo "User successfully added";
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
?>
