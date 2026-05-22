<?php
$_user = "root";
$_password = "";
$_host = "localhost";
$_database = "commerce";

try {
    $conn = new PDO("mysql:host=$_host;dbname=$_database", $_user, $_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>