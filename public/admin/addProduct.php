<?php require 'adminHeader.php';
require ('../../dbQueries/adminQueries.php');
require ('../../common.php');
if(isset($_POST['Submit'])) {
    $info = array();
    foreach($_POST as $input){
        $info[] = escape($input);
    }
    addProduct($info);
    header("Location: adminIndex.php");
}
?>


<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Add Product</h2>
        <label for="ProductID" >Product ID</label>
        <input name="ProductID" type="number" id="ProductID" class="form-control" required>
        <label for="ProductName">Name</label>
        <input name="ProductName" type="text" id="ProductName" class="form-control" required>
        <label for="Price" >Price</label>
        <input name="Price" type="number" id="Price" class="form-control" required>
        <label for="Description">Description</label>
        <input name="Description" type="text" id="Description" class="form-control" required>
        <label for="Size" >Size</label>
        <input name="Size" type="text" id="Size" class="form-control" required>
        <label for="Colour">Colour</label>
        <input name="Colour" type="text" id="Colour" class="form-control" required>
        <label for="ImageID">Image ID</label>
        <input name="ImageID" type="number" id="ImageID" class="form-control">
        <button name="Submit" class="button" type="submit">Add Product</button>
    </form>
</div>



<?php require 'adminFooter.php'; ?>

