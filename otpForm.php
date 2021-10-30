<?php session_start();
include __DIR__ . "/db.php";
$invalidotp = "<div class='error'>Invalid OTP</div>";
if (isset($_SESSION['active'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $inp = $_POST['otp'];
        if ($_SESSION['otp'] == $inp) {
            $stmt = $conn->prepare("INSERT INTO email(email,is_active) VALUES(?,?)");
            $stmt->bind_param('si', $email, $number);
            $email = $_SESSION['email'];
            $number = 1;
            $stmt->execute();
            header('Location:finalmessage.php');
        } else {?>
            <html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>


<form class="form" action="" method="post" >
  <h2>Enter OTP</h2>
  <?php echo $invalidotp; ?>
  <p type="OTP:"><input type="number" name="otp"></input></p>
  <button type="submit" name="submit">Verify OTP</button>
</form>
</body>
</html>
        <?php }
    }} else {
    header('Location:index.php');
}?>
      <html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>


<form class="form" action="" method="post" >
  <h2>Enter OTP</h2>
  <p type="OTP:"><input type="number" name="otp"></input></p>
  <button type="submit" name="submit">Verify OTP</button>
</form>
</body>
</html>