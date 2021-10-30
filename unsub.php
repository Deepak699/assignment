<?php
include __DIR__ . "/db.php";
include __DIR__ . "/config.php";
if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $inactive = 0;
    $stmt1 = $conn->prepare("SELECT * FROM email WHERE email=?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $res = $stmt1->get_result();
    $data = $res->fetch_assoc();
    if ($data['is_active'] == 1) {
        $stmt = $conn->prepare("UPDATE email SET is_active=? WHERE email=?");
        $stmt->bind_param('bs', $inactive, $email);
        $stmt->execute();
        ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="finalmsg">
        <h1 class="h1unsub" style="margin-left: 150px;margin-top:123px;font-size:50px">Unsubbed succesfully</h1>
        <h3 class="h3sub">Now You will not get any mail Again</h3>
    </div>
</body>
</html>
<?php
} else {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="finalmsg">
        <h1 class="h1unsub" style="margin-left: 150px;margin-top:123px;font-size:50px">Already Unsubbed</h1>
        <h3 class="h3sub"></h3>
    </div>
</body>
</html>
  <?php }
}
