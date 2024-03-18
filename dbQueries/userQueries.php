<?php
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
?>
