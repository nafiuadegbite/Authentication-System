<?php include_once('lib/header.php');
    require_once 'functions/alert.php';

if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
}
if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && !($_SESSION['role'] == "Patient")) {
    header("Location: index.php");
}
?>


<div class="container">
    <div class="column">
        <p>
            <?php
                print_alert();
            ?>
        </p>
        <h3>Dashboard</h3>
        <hr>
        <p>Welcome, <?php echo $_SESSION['fullname']; ?></p>
        <hr>
        <p>Your ID is <?php echo $_SESSION['loggedIn']; ?></p>
        <hr>
        <p>You are logged in as (<?php echo $_SESSION['role']; ?>)</p>
        <hr>
        <p>Date of registration: <strong> <?php echo $_SESSION['date']; ?> </strong></p>
        <hr>
        <p>Last login date: <strong> 
                                <?php
                                    if (isset($_SESSION['last_login'])) {
                                        echo $_SESSION['last_login'];
                                    }
                                ?>
                            </strong>
        </p>
        <p>
            <a class="p-2 text-dark btn btn-bg btn-outline-secondary" href="paybill.php">Pay Bills</a>
            <a class="p-2 text-dark btn btn-bg btn-outline-secondary" href="appointment.php">Book Appointment</a>
        </p>
    </div>
</div>
<?php include_once('lib/footer.php'); ?>