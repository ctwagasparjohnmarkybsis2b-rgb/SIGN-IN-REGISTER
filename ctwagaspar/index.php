<?php

require_once "config.php";
function h ( $str ) {
        return htmlspecialchars($str ?? '', ENT_QUOTES,'UTF-8');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === "POST" ) {
    $uname = $_POST["Uname"];
    $password = $_POST["password"];


   $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
   $stmt->bind_param('s', $uname);
   $stmt->execute();

   $result = $stmt->get_result();

   $user = $result->fetch_assoc();

   $stmt->close();

   if ($user && $password === $user['password']) {
  
      if ($user ['status'] !== "approved") {
        $errors[] = "Your account has not been approved by the admin";
   }else{
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];


    header('location: dashboard.php');

    exit;

      }

   }else{
    $errors[] = "Invalid Username or Password!";
   }

}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css" >
</head>
<body>
    <div class="container">

    <h1>Gaspar Pc Management System</h1>
    <h2>Sign In Now!</h2>
    <br>
    <?php foreach ($errors as $e): ?>
    <p style="color: red;"><?= h($e) ?></p>
    <?php endforeach; ?>
    <form action="" method="post">
        <label for="">Username:</label>
        <input type="text" name="Uname" id="" placeholder="Enter Username" required autofocus>
        <br><br>
        <label for="">Password:</label>
        <input type="password" name="password" id="" placeholder="Enter Password" required>
        <br><br>
        <input type="Submit" value="Sign In">
    </form>
    <br><br>
    <p>Dont Have an account? <a href="signup.php">Sign Up</a></p>

    </div>
</body>
</html>
