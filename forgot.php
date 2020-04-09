<?php   include_once 'lib/header.php';
        require_once 'functions/alert.php';

?>
    <h3>Forgot Password</h3>
    <p>Provide the email associated with your account</p>

    <form action="processforgot.php" method="post">
        <p>
            <?php
                print_alert(); 
            ?>
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
            <button type="submit">Send Reset Code</button>
        </p>
    </form>
<?php include_once 'lib/footer.php'; ?>