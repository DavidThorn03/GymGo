<?php
require "../common.php";
function createUser(){
if (isset($_POST['register'])) {
    //require "../common.php";

    try {
        require "../src/DBconnection.php";

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

    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
}
function updateUser($user){
    try {
        require "../src/DBconnection.php";

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

    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
function getUserInfo($id){
    //require "../common.php";
    try {
        require '../src/DBconnection.php';
        $sql = "SELECT * FROM cust inner join user on cust.userid = user.userid WHERE cust.userid = :userid";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':userid', $id);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
