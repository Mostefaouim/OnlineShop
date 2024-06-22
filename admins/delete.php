<?php
include 'config.php';
$ID = $_GET['id'];
mysqli_query($conn, "DELETE FROM prod WHERE id = $ID");
header("location:product.php");
?>