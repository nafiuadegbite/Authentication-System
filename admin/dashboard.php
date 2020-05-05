<?php include_once('../lib/header.php');
    require_once '../functions/alert.php';

if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
}
if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && !($_SESSION['role'] == "Super Admin")) {
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
            <a class="p-2 text-dark btn btn-success" href="../admin/create.php">Add User</a>
        </p>
        <p>
            <a class="p-2 text-dark btn btn-bg btn-outline-secondary" href="../admin/viewstaff.php">View All Staffs</a>
            <a class="p-2 text-dark btn btn-bg btn-outline-secondary" href="../admin/viewpatient.php">View All Patients</a>
        </p>
    </div>
</div>


<?php include_once('../lib/footer.php'); ?>
<?php

use Unirest\Request\Body;

$data = array('txref' => 'MC-1520443531487',
  'SECKEY' => 'FLWSECK_TEST-d29ee3694ed68adaec31aeb7f1c0a6b3-X' //secret key from pay button generated on rave dashboard
);



  // make request to endpoint using unirest.
  $headers = array('Content-Type' => 'application/json');
  $body = Unirest\Request\Body::json($data);
  $url = "https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/verify"; //please make sure to change this to production url when you go live

// Make `POST` request and handle response with unirest
  $response = Unirest\Request::post($url, $headers, $body);
  
  //check the status is success
  if ($response->body->data->status === "success" && $response->body->data->chargecode === "00") {
      //confirm that the amount is the amount you wanted to charge
      if ($response->body->data->amount === 100) {
          echo("Give value");
      }
  }

?>