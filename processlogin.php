<?php session_start();
require_once 'functions/user.php';
require_once 'functions/alert.php';
require_once 'functions/redirect.php';
require_once 'functions/email.php';
require_once 'functions/token.php';

date_default_timezone_get('Africa/Lagos');

$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;
$last_login = date('Y-m-d H:i:s');

$_SESSION['email'] = $email;
$_SESSION['last_login'] = $last_login;

if ($errorCount > 0) {
    // Display proper messages to the user
    // Give more accurate to the user

    $session_error = "You have " . $errorCount . " error";
    if($errorCount > 1) {
        $session_error .= "s";
    }

    $session_error .= " in your form submission";
    set_alert('error', $session_error);

    redirect_to("login.php");
} else {
    $currentUser = find_user($email);
        if($currentUser) {
            
            $userString = file_get_contents("db/users/".$currentUser->email . ".json");
            $userObject = json_decode($userString);
            $passwordFromDB = $currentUser->password;

            $passwordFromUser = password_verify($password, $passwordFromDB);

            if($passwordFromDB == $passwordFromUser) {
                $_SESSION['loggedIn'] = $currentUser->id;
                $_SESSION['email'] = $currentUser->email;
                $_SESSION['fullname'] = $currentUser->first_name . " " . $currentUser->last_name;
                $_SESSION['role'] = $currentUser->designation;
                $_SESSION['date'] = $currentUser->date;
                $_SESSION['last_login'] = $last_login;
                redirect_to("dashboard.php");
                die();
            } 
        }
    set_alert('error', "Invalid Email or Password");
    redirect_to("login.php");
    die();
}