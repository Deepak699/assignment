<?php session_start();
include "db.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $_POST['otp'];
    $inp = $_POST['otp'];
    if ($_SESSION['otp'] == $inp) {
        $stmt = $conn->prepare("INSERT INTO email(email,is_active) VALUES(?,?)");
        $stmt->bind_param('si', $email, $number);
        $email = $_SESSION['email'];
        $number = 1;
        $stmt->execute();
        header('Location:finalmessage.php');
    } else {
        echo "invalid otp";
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
        <label for="otp">Enter OTP here:</label>
        <input type="number" name="otp" id="">
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
 <?php
