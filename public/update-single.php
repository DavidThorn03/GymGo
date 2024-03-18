
<?php
$user = array("userid"=>"2", "Fname"=>"David", "Sname"=>"Thornton", "Phone"=>"0861234567");
    require "../common.php";
    if (isset($_POST['submit'])) {
        try {
            require_once '../src/DBconnection.php';
            $user =[
                "userid" => escape($_POST['userid']),
                "Fname" => escape($_POST['Fname']),
                "Sname" => escape($_POST['Sname']),
                "Phone" => escape($_POST['Phone'])
            ];
            $sql = "UPDATE cust SET userid = :userid, Fname = :Fname, Sname = :Sname, Phone = :Phone WHERE userid = :userid";

            $statement = $connection->prepare($sql);
            $statement->execute($user);
        }
        catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    if (isset($_GET['id'])) {
        try {
            require_once '../src/DBconnection.php';
            $id = $_GET['id'];
            $sql = "SELECT userid, Fname, Sname, Phone FROM cust WHERE userid = :userid";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':userid', $id);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    else {
        echo "Something went wrong!";
        exit;
    }
?>
<?php require "templates/header.php"; ?>

    <h2>Edit a user</h2>
    <form method="post">

        <?php foreach ($user as $key => $value) : ?>
            <label for="<?php echo $key; ?>"> <?php echo ucfirst($key); ?> </label>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
                   value="<?php echo escape($value); ?>">
            <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <?php endforeach; ?>

        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="index.php">Back to home</a>
<?php require "templates/footer.php"; ?>