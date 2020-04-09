<?php require_once 'alert.php';
require_once 'redirect.php';

function send_mail($subject = "", $message = "", $email = "") {
    $headers = "From: no-reply@hng.ng" . "\r\n" . 
    "CC: nafiu@hng.ng";

    $try = mail($email,$subject,$message,$headers);

    if($try) {
        set_alert('message', "Password Reset has been sent to your email: " . $email);
        redirect_to("login.php");
    } else {
        set_alert('error', "Something went wrong, could not send password reset to: " . $email);
        redirect_to("forgot.php");
    }
}