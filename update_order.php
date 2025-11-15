<?php
session_start();
include "db.php";

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

if(isset($_GET['id'])){
    $orderId = intval($_GET['id']);
    $stmt = $conn->prepare("UPDATE orders SET status='Completed' WHERE id=?");
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $stmt->close();
}

header("Location: admin_dashboard.php");
exit;
?>
