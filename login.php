<?php   include_once 'lib/header.php';
        require_once 'functions/alert.php';

if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
    header("Location: dashboard.php");
}
?>

    
    <h3>Login</h3>

    <p>
        <?php
            print_alert();
        ?>
    </p>

    <form method="POST" action="processlogin.php">
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
        <button type="submit">Login</button>
    </p>
</form>
<?php include_once 'lib/footer.php'; ?>