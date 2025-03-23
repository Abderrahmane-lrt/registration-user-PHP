<?php

session_start();
$is_exist = '';
require "config/connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM registration WHERE email = '$email'");
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && $password = $user['password']){
        $is_exist = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['firstName'];

        header("Location: index.php");
        exit();
    }else{
        $is_exist = false;
    }
}

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href=' https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css'>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel='stylesheet' href='style.css'>
    <title>Login</title>
</head>

<body>
    <?php
    if ($is_exist === true){
       echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Done .</strong> Welcome !' . $user['firstName'] . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    } 
    elseif ($is_exist === false){
      echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>ERROR </strong> Incorrect password or email !
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    
    ?>

    <div class='container' id='signIn'>
        <h1 class='form-title'>Sign In</h1>
        <form method='post'>
            <div class='input-group'>
                <i class='fas fa-envelope'></i>
                <input type='email' name='email' id='email' placeholder='Email' required>
                <label for='email'>Email</label>
            </div>
            <div class='input-group'>
                <i class='fas fa-lock'></i>
                <input type='password' name='password' id='password' placeholder='Password' required>
                <label for='password'>Password</label>
            </div>
            <p class='recover'>
                <a href='#'>Recover Password</a>
            </p>
            <input type='submit' class='btn' value='Sign In' name='signIn'>
        </form>
        <p class='or'>
            ---------or----------
        </p>
        <div class='icons'>
            <i class='fab fa-google'></i>
            <i class='fab fa-facebook'></i>
        </div>
        <div class='links'>
            <p>Don't have account yet?</p>
            <button id='signUpButton'><a href="signup.php" style="text-decoration: none;">Sign Up</a></button>
        </div>
    </div>
    <script src='script.js'></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>