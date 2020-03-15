<?php
    session_start();
    include('includes/autoloader.inc.php');
    $user = new User();
    
    // Define variable
    $title = "Register";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST['register'])) {
            extract($_REQUEST);
            $register = $user->register_user($name, $username, $password, $email);
            if ($register) {
                // Registration Success
                echo 'Registration successful <a href="login">Click here</a> to login';
            } else {
                // Registration Failed
                echo "Registration failed. Email or Username already exits please try again";
            }
        }
    }
?>

<!-- Header -->
<?php include_once('templates/header.php'); ?>

    <!-- Body -->
    <section>
        <div class="container">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <label>Name: </label>
                    <input type="text" name="name" placeholder="Enter Name" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Username: </label>
                    <input type="text" name="username" placeholder="Enter Username" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Password: </label>
                    <input type="password" name="password" placeholder="Enter Password" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Email: </label>
                    <input type="email" name="email" placeholder="Enter Email" class="form-control" />
                </div>
                <input type="submit" name="register" value="Save" class="btn btn-primary section__button" />
            </form>
            <a href="login">Already registered! Click Here!</a>
        </div>
    </section>

<!-- Footer -->
<?php include_once('templates/footer.php'); ?>