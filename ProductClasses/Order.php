<?php

class Order {
    private $userID;
    private $productID;
    private $orderTime;

    public function __construct($createOrder) {
        $this->userID = $createOrder["userID"];
        $this->productID = $createOrder["productID"];
        $this->orderTime = $createOrder["orderTime"];
    }

}
