<?php
session_start();
require_once '../dbQueries/productQueries.php';
require_once '../ProductClasses/Product.php';
$allProducts = getProducts(); // Get all products from the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/main.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">My Shop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="ShoppingCartManager.php">View Cart <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
<div class="container">
    <h1>Products</h1>
    <div class="row">
        <?php foreach ($allProducts as $productData): 
            $product = new Product($productData); ?>
            <div class="col-md-4">
                <h2><?= htmlspecialchars($product->getProductName()) ?></h2>
                <img src="<?= htmlspecialchars($product->getImageLink()) ?>" alt="<?= htmlspecialchars($product->getProductName()) ?>" style="width:100%;">
                <p><?= htmlspecialchars($product->getDescription()) ?></p>
                <p>$<?= htmlspecialchars($product->getPrice()) ?></p>
                <form action="ShoppingCartManager.php" method="post">
                    <input type="hidden" name="productID" value="<?= htmlspecialchars($product->getProductID()) ?>">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
