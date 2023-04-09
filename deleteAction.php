<?php
    include('assets/server/connection.php');
    $id = $_GET['id_product'];
    
    $query = "DELETE FROM products WHERE id_product = '$id'";
    mysqli_query($conn, $query);

    header("location: dashboard.php");
    die();
?>