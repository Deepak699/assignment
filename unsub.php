<?php 
include "db.php";
if(isset($_GET['email'])){
$email = $_GET['email'];
$inactive = 0;
$unsub = $conn->query("UPDATE email SET is_active='$inactive' WHERE email='$email'" );
echo "<h1>Unsubbed succesfully</h1>";
echo "<h3>Now You will not get any mail Again</h3>";
}