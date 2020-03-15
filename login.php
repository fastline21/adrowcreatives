<?php
    session_start();
    include('includes/autoloader.inc.php');
    $user = new User();

    // Define variable
    $title = "Login";
    $siteTitle = "Adrow Inventory";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST['login'])) {
            extract($_REQUEST);
            $login = $user->login_user($username, $password);
            if ($login) {
                // Login Success
                header("location: home");

                // For loading per login
                $_SESSION['loaded'] = true;
            } else {
                // Login Failed
                $errorMessage = "Wrong username or password";
            }
        }
    }
?>

<!-- Header -->
<?php include_once('templates/header.php'); ?>

    <!-- Body -->
    <?php
    if (isset($errorMessage)) {
        ?>
        <!-- Error Message Popup -->
        <div id="errorLogin" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content border-0">
                    <div class="modal-body text-center">
                        <i class="fas fa-exclamation-triangle logo__warning"></i>
                        <p class="text-center mt-3 mb-0"><?php echo $errorMessage; ?></p>
                    </div>
                    <button type="button" class="btn btn-danger btn-block button__error" data-dismiss="modal">Dismiss</button>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    
    <!-- Login right background -->
    <div class="login__background--right"></div>

    <section id="login" class="h-50 my-auto">
        <div class="container-fluid">
            <div class="row">

                <!-- Login left -->
                <div class="col my-auto">
                    <img src="./public/images/logo.png" class="img-fluid logo__login" />
                </div>

                <!-- Login right -->
                <div class="col my-auto">
                    <div class="w-50 mx-auto login__right">
                        <form method="POST" name="login" action="<?php echo htmlspecialchars($parseData['DOMAIN'] . '/' . pathinfo($_SERVER["PHP_SELF"])['filename']);?>">
                            <div class="form-group">
                                <label class="section__label section__label--login">Username:</label>
                                <input type="text" name="username" placeholder="Enter Username" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="section__label section__label--login">Password:</label>
                                <input type="password" name="password" placeholder="Enter Password" class="form-control" />
                            </div>
                            <input type="submit" name="login" value="Login" class="btn btn-primary btn-block section__button" />
                        </form>
                        <a href="register">Create new user</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Footer -->
<?php include_once('templates/footer.php'); ?>