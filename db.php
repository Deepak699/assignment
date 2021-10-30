<?php
include __DIR__ . "\config.php";
$conn = mysqli_connect(getenv('HOST'), getenv('USERNAME'), getenv('PASSWORD'), getenv('DBNAME'));
if ($conn->connect_errno) {
    echo "Failed to connect" . $conn->connect_errno;
    exit();
}
