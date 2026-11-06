<?php

require_once "config.php";
function h ( $str ) {
        return htmlspecialchars($str ?? '', ENT_QUOTES,'UTF-8');
}

$mess = [];
$errors = [];


if ($_SERVER['REQUEST_METHOD']==='POST') {

$uname = $_POST["Uname"];
$password = $_POST["password"];
$password2 = $_POST["password2"];

if ($password === $password2) {
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?,?)");
   $stmt->bind_param('ss', $uname, $password);


   if ($stmt->execute()) {
    $mess[] = "Registered Successfully, Wait for Approval";
} else {
    $errors[] = "Something Went Wrong Pls Try Again";
}
}
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css" >
</head>
<body>
    <div class="container">

    <h1>Gaspar Pc Management System</h1>
    <h2>Create Your Account</h2>
    <br>
    <?php foreach ($errors as $e): ?>
    <p style="color: red;"><?= h($e) ?></p>
    <?php endforeach; ?>
    <br><br>
    <?php foreach ($mess as $m): ?>
    <p style="color: green;"><?= h($m) ?></p>
    <?php endforeach; ?>
    <form action="" method="post">
        <label for="">Username:</label>
        <input type="text" name="Uname" id="" placeholder="Enter Username" required autofocus>
        <br><br>
        <label for="">Password:</label>
        <input type="password" name="password" id="" placeholder="Enter Password" required>
         <br><br>
        <label for="">Confirm Password:</label>
        <input type="password" name="password2" id="" placeholder="Confirm Password" required>
        <br><br>
        <input type="Submit" value="Register">
    </form>
    <br><br>
    <p>Have an account? <a href="index.php">Sign In</a></p>

    </div>
</body>
</html>
