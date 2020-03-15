<?php
    session_start();
    include('includes/autoloader.inc.php');
    $user = new User();
    $id = $_SESSION['id'];
    
    if (!$user->get_session()) {
        header("location: login");
    } else {
        header("location: home");
    }
?>