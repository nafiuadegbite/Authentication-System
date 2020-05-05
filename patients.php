<?php include_once('lib/header.php');
    require_once 'functions/alert.php';
    require_once 'functions/redirect.php';

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
            <form>
                <script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                <button class="p-2 text-dark btn btn-bg btn-outline-secondary" type="button" onClick="payWithRave()">Pay Bill</button>
            </form>
            <!-- <a class="p-2 text-dark btn btn-bg btn-outline-secondary" href="paybill.php">Pay Bills</a> -->
            <a class="p-2 text-dark btn btn-bg btn-outline-secondary" href="appointment.php">Book Appointment</a>
        </p>
    </div>
</div>

<script>
    const API_publicKey = "FLWPUBK_TEST-e36a3a696905694672a28951b0e964a4-X";

    function payWithRave() {
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: "user@example.com",
            amount: 2000,
            customer_phone: "234099940409",
            currency: "NGN",
            txref: "rave-123456",
            meta: [{
                metaname: "flightID",
                metavalue: "AP1234"
            }],
            onclose: function() {},
            callback: function(response) {
                var txref = response.data.txRef; // collect txRef returned and pass to a                    server page to complete status check.
                console.log("This is the response returned after a charge", response);
                if (
                    response.data.chargeResponseCode == "00" ||
                    response.data.chargeResponseCode == "0"
                ) {
                    set_alert("Transaction Successful");
                    redirect_to("patients.php");
                } else {
                    set_alert("error", "Transaction unsuccessful");
                    redirect_to("patients.php");
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }
</script>
<?php include_once('lib/footer.php'); ?>