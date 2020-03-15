<?php
    session_start();
    include('includes/autoloader.inc.php');
    $user = new User();
    
    // Define variable
    $id = $_SESSION['id'];
    $title = "Home";
    $active = "Home";
    
    // If not login the user
    if (!$user->get_session()) {
        header("location: login");
    }

    // Logout button
    if (isset($_GET['a'])) {
        if ($_GET['a'] == 'logout') {
            $user->user_logout();
            header("location: login");
        }
    }
?>

<!-- Header -->
<?php include_once('templates/header.php'); ?>

    <!-- Body -->
    <section id="home" class="my-5">
        <div class="container">
            <h1>Hello <?php $user->get_fullname($id); ?></h1>
        </div>
    </section>

<!-- Footer -->
<?php include_once('templates/footer.php'); ?>

<!-- For loading per login -->
<?php $_SESSION['loaded'] = false; ?>