<?php require 'adminHeader.php';
require ('../../dbQueries/adminQueries.php');
require ('../../common.php');
if(isset($_POST['Submit'])) {
    $productID = escape($_POST["ProductID"]);
    deleteProduct($productID);
    header("Location: adminIndex.php");
}
?>

<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Delete Product</h2>
        <label for="ProductID" >Product ID</label>
        <input name="ProductID" type="number" id="ProductID" class="form-control" required>
        <button name="Submit" class="button" type="submit">Delete Product</button>
    </form>
</div>



<?php require 'adminFooter.php'; ?>

