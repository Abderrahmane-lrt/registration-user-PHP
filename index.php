<?php 
session_start();
if (!isset($_SESSION['user_id'])){
  header("Location: login.php");
  exit();
}
require "config/connect.php";

$stmt = $conn->prepare("SELECT * FROM registration WHERE id = ? ");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();


?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap.css">
  <title>Home page</title>
</head>
<body>
    <?= "<h1 class='bg-success text-white text-center txt-bold'>Welcome $user[firstName] </h1>" ?>
    <a href="logout.php">logout</a>
</body>
</html>