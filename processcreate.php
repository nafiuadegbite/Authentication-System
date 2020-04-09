<?php session_start();
    require_once 'functions/user.php';


// Collecting the data
date_default_timezone_get('Africa/Lagos');

$errorCount = 0;

$first_name = !empty($_POST['first_name']) && preg_match("/^[a-zA-Z ]*$/", $_POST['first_name']) && strlen($_POST['first_name']) > 2 ? test_input($_POST['first_name']) : $errorCount++;
$last_name = !empty($_POST['last_name']) && preg_match("/^[a-zA-Z ]*$/", $_POST['last_name']) && strlen($_POST['last_name']) > 2 ? test_input($_POST['last_name']) : $errorCount++;
$email = !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && strlen($_POST['email']) > 5 ? test_input($_POST['email']) : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;
$gender = $_POST['gender'] != "" ? $_POST['gender'] : $errorCount++;
$designation = $_POST['designation'] != "" ? $_POST['designation'] : $errorCount++;
$department = $_POST['department'] != "" ? $_POST['department'] : $errorCount++;
$date = date('Y-m-d H:i:s');


$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;



if ($errorCount > 0) {
    $session_error = "You have " . $errorCount . " error";
    if($errorCount > 1) {
        $session_error .= "s";
    }

    $session_error .= " in your form submission";
    $_SESSION['error'] = $session_error;

    header("Location: register.php");
} else {

    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);
    $newUserId = ($countAllUsers - 1);

    $userObject = [
        'id'=>$newUserId,
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'email'=>$email,
        'password'=>password_hash($password, PASSWORD_DEFAULT),
        'gender'=>$gender,
        'designation'=>$designation,
        'department'=>$department,
        'date'=>$date
    ];

    $userExists = find_user($email);
    
        if($userExists) {
            $_SESSION["error"] = "Registration Failed, User already exists";
            header("Location: create.php");
            die();
        }

    save_user($userObject);
    set_alert('message', "User " .$first_name. " successfully created");
    header("Location: dashboard.php");
 }
