<?php session_start();
    require_once 'functions/user.php';
    require_once 'functions/appoint.php';

$errorCount = 0;

$appointment_date = $_POST['appointment_date'] != "" ? $_POST['appointment_date'] : $errorCount++;
$appointment_time = $_POST['appointment_time'] != "" ? $_POST['appointment_time'] : $errorCount++;
$appointment_nature = $_POST['appointment_nature'] != "" ? $_POST['appointment_nature'] : $errorCount++;
$department = $_POST['department'] != "" ? $_POST['department'] : $errorCount++;
$complaint = $_POST['complaint'] != "" ? $_POST['complaint'] : $errorCount++;
$fullname = $_SESSION['fullname'];

$_SESSION['appointment_date'] = $appointment_date;
$_SESSION['appointment_time'] = $appointment_time;
$_SESSION['appointment_nature'] = $appointment_nature;
$_SESSION['department'] = $department;
$_SESSION['complaint'] = $complaint;

if ($errorCount > 0) {
    $session_error = "You have " . $errorCount . " error";
    if($errorCount > 1) {
        $session_error .= "s";
    }

    $session_error .= " in your form submission";
    $_SESSION['error'] = $session_error;

    header("Location: appointment.php");
} else {

    $allAppointments = scandir("db/appointments/");
    $countAllAppointments = count($allAppointments);
    $appointmentId = ($countAllAppointments - 1);

    $appointmentObject = [
        'id'=>$appointmentId,
        'appointment_date'=>$appointment_date,
        'appointment_time'=>$appointment_time,
        'appointment_nature'=>$appointment_nature,
        'department'=>$department,
        'complaint'=>$complaint,
        'patient_name'=>$fullname
    ];

    save_appointment($appointmentObject);

    unset($_SESSION['appointment_date']);
    unset($_SESSION['appointment_time']);
    unset($_SESSION['appointment_nature']);
    unset($_SESSION['department']);
    unset($_SESSION['complaint']);

    set_alert('message', "You appointment has been successfully booked to " . $department . " department");
    header("Location: patients.php");
 }

