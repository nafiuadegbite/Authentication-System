<?php include_once('lib/header.php');
require_once 'functions/alert.php';
require_once 'functions/appoint.php';

if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
}
if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && !($_SESSION['role'] == "Medical Team (MT)")) {
    header("Location: index.php");
}

?>

<div class="container">

    <h1 class="text-center">Appointment List</h1><br>
    <?php 
    $appointmentList = '';
    $allAppointment = scandir("db/appointments/");
    $countAllAppointment = count($allAppointment);

    for ($counter = 2; $counter < $countAllAppointment; $counter++) {
        $appointmentObject = json_decode(file_get_contents('db/appointments/' . $allAppointment[$counter]));
        $appointmentList .= "
                <tbody>
                    <tr>
                        <th scope='row'>$appointmentObject->id</th>
                        <td>$appointmentObject->patient_name</td>
                        <td>$appointmentObject->appointment_nature</td>
                        <td>$appointmentObject->appointment_date</td>
                        <td>$appointmentObject->appointment_time</td>
                        <td>$appointmentObject->department</td>
                        <td>$appointmentObject->complaint</td>
                    </tr>
                </tbody>
            ";
    } ?>

    <?php if(strlen($appointmentList) > 0) { ?>
        <table class='table table-bordered'>
            <thead class='thead-dark'>
                <tr>
                <th scope='col'>No</th>
                <th scope='col'>Patient Name</th>
                <th scope='col'>Nature of Appointment</th>
                <th scope='col'>Date of Appointment</th>
                <th scope='col'>Time of Appointment</th>
                <th scope='col'>Department</th>
                <th scope='col'>Complaint</th>
                </tr>
            </thead>
            <?php echo $appointmentList; ?>
        </table>
    <?php } else { ?>
        <p>You have no pending appointments</p>
    <?php } ?>
    

</div>
<?php include_once('lib/footer.php'); ?>