<?php
session_start();
include "db.php";
$emptyEmail = '';
$emailError = '';
$emailalredyExist = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emptyEmail = "<div class='error'>Email is mandatory</div>";
    } else {
        $email = $_POST["email"];
        // check if name only contains letters and whitespace
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "<div class='error'>Invalid email format</div>";
        }
        $res = $conn->query("SELECT * FROM email WHERE email = '$email'");
        if ($res->num_rows > 0) {
            $emailalredyExist = "email address alread exists";
        } else {
            $_SESSION['email'] = $email;
            header('Location:otp.php');
        }
    }
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>

    <form action="index.php" method="post">
    <?php echo $emptyEmail;
echo $emailError;
echo $emailalredyExist; ?>
        <label for="email">Email:</label>
        <input type="email" name="email" id="" placeholder="Email">
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
