<?php
if (isset($_POST['register'])) {
    require "../common.php";

    try {
        require_once "../src/DBconnection.php";

        $new_user = array(
            "fname" => escape($_POST['firstname']),
            "sname" => escape($_POST['lastname']),
            "dob" => escape($_POST['date of birth']),
            "eircode" => escape($_POST['eircode']),
            "phone" => escape($_POST['phone']),
            "date" => date("Y-m-d H:m:s")//didnt see this in tutorial but its needed
        );

        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "users", implode(", ",
            array_keys($new_user)), ":" . implode(", :", array_keys($new_user)));


        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
require "../public/templates/header.php";
if (isset($_POST['submit']) && $statement){
    echo $new_user['firstname']. ' successfully added';
}
?>




<?php require "../public/templates/footer.php"; ?>