<?php

// Get the list of all products
function getProductList($conn){
  if ($conn) {
  $results = null;
  try {
    $query = "SELECT * from Products";
    $results = $conn->query($query);
  } catch(PDOException $e){
    echo "There was a database error!";
  }
  }
  return $results;
}

// Save new product to the database
function saveProduct($conn,$product){
  $name = $product->get_name();
  $weight = $product->get_weight();
  $length = $product->get_length();
  $width = $product->get_width();
  $height = $product->get_height();
  $image = $product->get_image();

  
  if ($conn) {
  
  try {
    $query = "INSERT into Products (name,weight,length,width,height,image) VALUES ('{$name}',{$weight},{$length},{$width},{$height},'{$image}')";
    $conn->query($query);
   
  } catch(PDOException $e){
    echo "There was a database error!";
  }
  }  
}

// Product definition
class Product {
  private $name;
  private $length;
  private $width;
  private $height;
  private $weight;
  private $image;

  function __construct($name,$weight,$length,$width,$height,$image){
    $this->name = $name;
    $this->length = $length;
    $this->width = $width;
    $this->height = $height;
    $this->weight = $weight;
    $this->image = $image;
  }

  function get_name(){
    return $this->name;
  }

  function set_name($name) {
    $this->name = $name;
  }
  
  function get_length(){
    return $this->length;
  }

  function set_length($length) {
    $this->length = $length;
  }
  function get_width(){
    return $this->width;
  }

  function set_width($width) {
    $this->width = $width;
  }
  
  function get_height(){
    return $this->height;
  }

  function set_height($height) {
    $this->height = $height;
  }
  
  function get_weight(){
    return $this->weight;
  }

  function set_weight($weight) {
    $this->weight = $weight;
  }

  function get_image(){
    return $this->image;
  }

  function set_image($image_url){
    $this->image = $image_url;
  }
}

function addProduct($conn,$name,$weight,$length,$width,$height,$image){
  $new_product = new Product($name,$weight,$length,$width,$height,$image);
  saveProduct($conn,$new_product);
}

?>