<?php
if (isset($_POST['register'])) {
    require "../common.php";

    try {
        require_once "../src/DBconnection.php";

        $new_user = array(
            "fname" => $_POST['firstname'],
            "sname" => $_POST['lastname'],
            "dob" => $_POST['date_of_birth'],
            "eircode" => $_POST['eircode'],
            "phone" => $_POST['phone'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "date" => date("Y-m-d H:m:s")//didnt see this in tutorial but its needed
        );

        $sql = "INSERT INTO cust (Fname, Sname, DOB, EirCode, Phone) 
                VALUES (:fname, :sname, :dob, :eircode, :phone, )";

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

        echo "User successfully added";
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
?>
