<?php
class Product
{
    private $productID;
    private $productName;
    private $description;
    private $price;
    private $imageLink;

    public function __construct($product){
        $this->productID = $product["ProductID"];
        $this->productName = $product["ProductName"];
        $this->description = $product["Description"];
        $this->price = $product["Price"];
       // $this->imageLink = $product["ImageLink"];
    }

    public function getProductID(){
        return $this->productID;
    }

    public function getProductName(){
        return $this->productName;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getImageLink(){
        if($this->imageLink != null){
            return $this->imageLink->getImageLink();
        }
    }

    public function getImage(){
        return $this->imageLink;
    }
    public function setImage($imageLink){
        $this->imageLink = $imageLink;
    }


    public function setProductID($productID){
        $this->productID = $productID;
    }

    public function setProductName($productName){
        $this->productName = $productName;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function setImageLink($imageLink){
        $this->imageLink = $imageLink;
    }

}
?>