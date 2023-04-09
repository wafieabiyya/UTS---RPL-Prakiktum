<?php 
include 'assets/server/connection.php';

$productName = $_POST['product_name'];
$productDescription = $_POST['product_description'];
$productCategory = $_POST['product_category'];
$productQuantity = $_POST['product_quantity'];
$productPrice = $_POST['product_price'];

$query = "INSERT INTO products VALUES 
('', '$productName', '$productDescription', '$productCategory', '$productQuantity', '$productPrice')";

mysqli_query($conn, $query);
header('location: addProduct.php');

 ?>