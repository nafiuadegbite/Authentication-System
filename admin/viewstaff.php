<?php include_once('../lib/header.php');
require_once '../functions/alert.php';
require_once '../functions/appoint.php';

if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
}
if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && !($_SESSION['role'] == "Super Admin")) {
    header("Location: index.php");
}

?>

<div class="container">

    <h1 class="text-center">Medical List</h1><br>
    <?php 
    $medicalList = '';
    $allUsers= scandir("../db/users/");
    $countAllUsers= count($allUsers);

    for ($counter = 2; $counter < $countAllUsers; $counter++) {
        $userObject = json_decode(file_get_contents('../db/users/' . $allUsers[$counter]));
       if ($userObject->designation == "Medical Team (MT)") {
            $medicalList .= "
                    <tbody>
                        <tr>
                            <th scope='row'>$userObject->id</th>
                            <td>$userObject->first_name $userObject->last_name</td>
                            <td>$userObject->email</td>
                            <td>$userObject->gender</td>
                            <td>$userObject->designation</td>
                            <td>$userObject->department</td>
                            <td>$userObject->date</td>
                        </tr>
                    </tbody>
                        ";
       }
        
    } ?>

    <?php if(strlen($medicalList) > 0) { ?>
        <table class='table table-bordered'>
            <thead class='thead-dark'>
                <tr>
                <th scope='col'>No</th>
                <th scope='col'>Staff Name</th>
                <th scope='col'>Email</th>
                <th scope='col'>Gender</th>
                <th scope='col'>Designation</th>
                <th scope='col'>Department</th>
                <th scope='col'>Date of Registration</th>
                </tr>
            </thead>
            <?php echo $medicalList; ?>
        </table>
    <?php } else { ?>
        <p>No registered staffs</p>
    <?php } ?>
    

</div>
<?php include_once('../lib/footer.php'); ?>