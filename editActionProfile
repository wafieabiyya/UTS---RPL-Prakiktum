<?php
include 'assets/server/connection.php';

$idAdmin = $_POST['admin_id'];
$adminName = $_POST['admin_name'];
$adminUsername = $_POST['admin_username'];
$adminPhone = $_POST['admin_phone'];
$adminEmail = $_POST['admin_email'];
$adminPassword = $_POST['admin_password'];


mysqli_query($conn,"UPDATE adm SET admin_name = '$adminName', admin_username = '$adminUsername', admin_phone = '$adminPhone', admin_email = '$adminEmail', admin_password = '$adminPassword' WHERE admin_id = '$idAdmin'") or die(mysqli_error($conn));

echo "error: ". mysqli_error($conn);

header('location: dashboard.php');
?>