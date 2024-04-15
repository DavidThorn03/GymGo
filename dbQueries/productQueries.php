<?php

function getProducts(){
    require "../config.php"; 
    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * FROM products"; 

        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
    }
    catch(PDOException $error){
        echo $sql . "<br>" . $error->getMessage();
    }
}

function getProductById($productId) {
    require "../config.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * FROM products WHERE ProductID = :productId";

        $statement = $connection->prepare($sql);
        $statement->bindParam(':productId', $productId, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}



function getOrderDetailsForUser($userID) {
    require "../config.php";

    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT o.UserID, o.ProductID, p.ProductName, o.Quantity, o.OrderTime
                FROM orders as o
                JOIN products as p ON o.ProductID = p.ProductID
                WHERE o.UserID = :userID
                ORDER BY o.OrderTime DESC
                LIMIT 50";  

        $statement = $connection->prepare($sql);
        $statement->bindValue(':userID', $userID, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}





function submitOrder($userID, $productID, $quantity, $orderTime){
    require "../config.php"; 

    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "INSERT INTO orders (UserID, ProductID, Quantity, OrderTime) VALUES (:userID, :productID, :quantity, :orderTime)";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':userID', $userID, PDO::PARAM_INT);
        $statement->bindValue(':productID', $productID, PDO::PARAM_INT);
        $statement->bindValue(':quantity', $quantity, PDO::PARAM_INT); 
        $statement->bindValue(':orderTime', $orderTime, PDO::PARAM_STR);
        $statement->execute();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

?>
