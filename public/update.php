<?php
require_once "../common.php";
require_once "../src/DBconnection.php";
require "../dbQueries/userQueries.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userID = $_POST['userID'];
    $fname = $_POST['Fname'];
    $sname = $_POST['Sname'];
    $dob = $_POST['DOB'];
    $eirCode = $_POST['EirCode'];
    $phone = $_POST['Phone'];

    try {
        $sql = "UPDATE cust SET Fname = :fname, Sname = :sname, DOB = :dob, EirCode = :eirCode, Phone = :phone WHERE UserID = :userID";
        $statement = $connection->prepare($sql);
        $statement->execute([
            ':fname' => $fname,
            ':sname' => $sname,
            ':dob' => $dob,
            ':eirCode' => $eirCode,
            ':phone' => $phone,
            ':userID' => $userID
        ]);
        echo "Customer details updated successfully";
    } catch (PDOException $error) {
        echo "Error updating customer details: " . $error->getMessage();
    }
}
?>

<?php require "templates/header.php"; ?>
<h2>Update users</h2>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Age</th>
        <th>Location</th>
        <th>Date</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row){ ?>
        <tr>
            <td><?php echo escape($row["id"]); ?></td>
            <td><?php echo escape($row["firstname"]); ?></td>
            <td><?php echo escape($row["lastname"]); ?></td>
            <td><?php echo escape($row["email"]); ?></td>
            <td><?php echo escape($row["age"]); ?></td>
            <td><?php echo escape($row["location"]); ?></td>
            <td><?php echo escape($row["date"]); ?> </td>
            <td><a href="update-single.php?id=<?php echo escape($row["id"]);
                ?>">Edit</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<a href="index.php">Back to home</a>
<?php require "templates/footer.php"; ?>
