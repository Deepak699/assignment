<?php
$conn = mysqli_connect('localhost', 'root', '', 'rtcamp');
if ($conn->connect_errno) {
    echo "Failed to connect" . $conn->connect_errno;
    exit();
}
