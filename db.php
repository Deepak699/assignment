<?php
$conn = mysqli_connect('remotemysql.com', 'XZWkDlmO2L', '3q016iPIMR', 'XZWkDlmO2L');
if ($conn->connect_errno) {
    echo "Failed to connect" . $conn->connect_errno;
    exit();
}
