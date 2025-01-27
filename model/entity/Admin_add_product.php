<?php


namespace model\entity;

class Admin_add_product extends BaseEntity {
    private $title;
    private $brand;
    private $category;
    private $description;
    private $image_path;
    private $price;
    private $stock;


    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand){
        $this->brand = $brand;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category){
        $this->category = $category;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getImagePath() {
        return $this->image_path;
    }

    public function setImagePath($image_path){
        $this->image_path = $image_path;
    }
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }


    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock){
        $this->stock = $stock;
    }

}