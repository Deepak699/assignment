<?php
session_start();
$email = $_SESSION['email'];
$digits = 5;
$otp = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
$to_email = $email;
$subject = "OTP Verification";
$body = "<div>$otp</div>";
$headers = "From: nathanideepak7@gmail.com\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";

if (mail($to_email, $subject, $body, $headers)) {
    // echo "OTP successfully sent to $to_email...";
    $_SESSION['otp'] = $otp;
    header('Location:otpForm.php');

} else {
    echo "Email sending failed...";
}
