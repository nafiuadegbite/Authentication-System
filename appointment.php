<?php include_once('lib/header.php');
require_once('functions/alert.php');
if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && !($_SESSION['role'] == "Patient")) {
    // redirect to dashboard
    header("Location: index.php");
}
// include_once('lib/header.php');
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
}

echo $_SESSION['fullname'];

?>
<div class="container">
    <div class="row col-6">
        <h3>Appointment</h3>
    </div>
    <div class="row col-6">
        <p><strong>Welcome, Please fill the following details to book an appointment</strong></p>
    </div>
    <div class="row col-6">
        <p>All Fields are required</p>
    </div>
    <div class="row col-6">

        <form method="POST" action="processappointment.php">
            <p>
                <?php print_alert(); ?>
            </p>
            <p>
                <label>Date of appointment</label><br />
                <input <?php
                        if (isset($_SESSION['appointment_date'])) {
                            echo "value=" . $_SESSION['appointment_date'];
                        }
                        ?> type="date" class="form-control" name="appointment_date" />
            </p>
            <p>
                <label>Time of appointment</label><br />
                <input <?php
                        if (isset($_SESSION['appointment_time'])) {
                            echo "value=" . $_SESSION['appointment_time'];
                        }
                        ?> type="time" class="form-control" name="appointment_time" placeholder="Time of appointment" />
            </p>
            <p>
                <label>Nature of appointment</label><br />
                <select class="form-control" name="appointment_nature">
                    <option value="">Select One</option>
                    <option <?php
                            if (isset($_SESSION['appointment_nature']) && $_SESSION['appointment_nature'] == 'New Appointment') {
                                echo "selected";
                            }
                            ?>>New Appointment</option>
                    <option <?php
                            if (isset($_SESSION['appointment_nature']) && $_SESSION['appointment_nature'] == 'Follow-Up Appointment') {
                                echo "selected";
                            }
                            ?>>Follow-Up Appointment</option>
                </select>
            </p>

            <p>
                <label>Department</label><br />
                <select class="form-control" name="department">

                    <option value="">Select One</option>
                    <option <?php
                            if (isset($_SESSION['department']) && $_SESSION['department'] == 'Laboratory') {
                                echo "selected";
                            }
                            ?>>Laboratory</option>
                    <option <?php
                            if (isset($_SESSION['department']) && $_SESSION['department'] == 'X-ray') {
                                echo "selected";
                            }
                            ?>>X-ray</option>
                </select>
            </p>
            <p>
                <label class="label" for="complaint">Initial Complaint</label><br />
                <textarea <?php
                        if (isset($_SESSION['complaint'])) {
                            echo $_SESSION['complaint'];
                        }
                        ?> class="form-control" cols="30" name="complaint" placeholder="Please enter complaint" >
                </textarea>

            </p>
            <p>
                <button class="btn btn-sm btn-success" type="submit">Book Appointment</button>
            </p>
        </form>

    </div>

</div>
<?php include_once('lib/footer.php'); ?>