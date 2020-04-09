<?php   include_once '../lib/header.php';
        require_once '../functions/alert.php';

if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && !($_SESSION['role'] == "Super Admin")) {
    header("Location: dashboard.php");
}


?>
<div class="container">
    <div class="row">
        <h3>Register</h3>
    </div>
    <div class="row">
        <p><strong>Welcome Super Admin, Add User</strong></p>
    </div>
    <div class="row">
        <p>All Fields are required</p>
    </div>
    <div class="row">
        <form method="POST" action="processregister.php"> 
            <p>
                <?php
                    print_alert();
                ?>
            </p>


            <p>
                <label for="">First Name</label><br>
                <input 
                    <?php
                        if (isset($_SESSION['first_name'])) {
                            echo "value=" . $_SESSION['first_name'];
                        }
                    ?> 
                    type="text" value="" name="first_name" placeholder="First Name" id="">
            </p>
            <p>
                <label for="">Last Name</label><br>
                <input
                    <?php
                        if (isset($_SESSION['last_name'])) {
                            echo "value=" . $_SESSION['last_name'];
                        }
                    ?> 
                
                type="text" name="last_name" placeholder="Last Name" id="">
            </p>
            <p>
                <label for="">Email</label><br>
                <input 
                    <?php
                        if (isset($_SESSION['email'])) {
                            echo "value=" . $_SESSION['email'];
                        }
                    ?> 
                
                type="email" name="email" placeholder="Email" id="">
            </p>
            <p>
                <label for="">Password</label><br>
                <input type="password" name="password" placeholder="Password" id="">
            </p>
            <p>
                <label for="">Gender</label><br>
                <select name="gender" id="">
                    <option value="">Select One</option>
                    <option 
                    <?php
                        if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male') {
                            echo "selected";
                        }
                    ?>
                    
                    value="Male">Male</option>
                    <option
                    <?php
                        if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female') {
                            echo "selected";
                        }
                    ?>
                    
                    value="Female">Female</option>
                </select>
            </p>
            <hr>

            <p>
                <label for="">Designation</label><br>
                <select name="designation" id="">
                    <option value="">Select One</option>
                    <option
                    <?php
                        if (isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team (MT)') {
                            echo "selected";
                        }
                    ?>
                    
                    value="Medical Team (MT)">Medical Team (MT)</option>
                    <option
                    <?php
                        if (isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patients') {
                            echo "selected";
                        }
                    ?>
                    
                    value="Patients">Patients</option>
                </select>
            </p>
            <p>
                <label for="">Department</label><br>
                <input 
                    <?php
                        if (isset($_SESSION['department'])) {
                            echo "value=" . $_SESSION['department'];
                        }
                    ?> 
                
                type="text" name="department" id="" placeholder="Department">
            </p>
            <p>
                <button type="submit">Register</button>
            </p>
        </form>
    </div>
</div>

<?php include_once '../lib/footer.php'; ?>