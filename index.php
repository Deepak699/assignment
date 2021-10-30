<?php
session_start();
include __DIR__ . "/db.php";
$emptyEmail = '';
$emailError = '';
$emailalredyExist = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emptyEmail = "<div><span class='error'>Email is mandatory</span></div>";
    } else {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        // checking email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "<div class='error'>Invalid email format</div>";
        }

        //checking if email already exists or not
        if (empty($emailError)) {
            $stmt = $conn->prepare("SELECT * FROM email WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res->num_rows > 0) {
                $emailalredyExist = "<div class='error'>email address already exists</div>";
            } else {
                $_SESSION['email'] = $email;
                header('Location:otp.php');
            }
        }
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>


<form class="form" action="index.php" method="post" >
  <h2>Enter Email</h2>
  <?php echo $emptyEmail; ?>
<?php echo $emailError; ?>
<?php echo $emailalredyExist; ?>
  <p type="Email:"><input type="email" name="email"></input></p>
  <button type="submit" name="submit">Send Message</button>
</form>
</body>
</html>