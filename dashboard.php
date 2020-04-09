<?php include_once('lib/header.php');


if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
}
?>


<div class="container">
    <div class="column">
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
    </div>
</div>
<?php include_once('lib/footer.php'); ?>