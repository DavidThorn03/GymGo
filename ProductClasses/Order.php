<?php

class Order {
    private $orderDate;
    private $userID;
    private $orderID;
    private $productID;
    private $quantity;

    public function __construct($orderDetails){
        if ($orderDetails != null) {
            $this->orderDate = $orderDetails["OrderDate"];
            $this->orderID = $orderDetails["OrderID"];
            $this->userID = $orderDetails["UserID"];
            $this->productID = $orderDetails["ProductID"];
            $this->quantity = $orderDetails["Quantity"];
        }
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getOrderDate() {
        $date = new DateTime($this->orderDate);
        return $date->format('Y-m-d');
    }

    public function getOrderID() {
        return $this->orderID;
    }

    public function getProductID() {
        return $this->productID;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setOrderDate($orderDate) {
        $this->orderDate = $orderDate;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    public function setProductID($productID) {
        $this->productID = $productID;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

}
?>
