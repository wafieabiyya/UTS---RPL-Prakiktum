<?php

include 'assets/server/connection.php';

$idProduct = $_POST['id_product'];
$productName = $_POST['product_name'];
$productDescription = $_POST['product_description'];
$productCategory = $_POST['product_category'];
$productQuantity = $_POST['product_quantity'];
$productPrice = $_POST['product_price'];

mysqli_query($conn, "UPDATE products SET product_name = '$productName', product_description = '$productDescription', product_category = '$productCategory', product_quantity = '$productQuantity', product_price = '$productPrice' WHERE id_product = '$idProduct'") or die(mysqli_errno($conn));

header('location: dashboard.php');
