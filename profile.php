<?php
    session_start();
    include('includes/autoloader.inc.php');
    $user = new User();
    
    // Define variable
    $id = $_SESSION['id'];
    $title = "Profile";
    $active = "Profile";
    
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
    $fullname = $user->get_user($id)['Fullname'];
    $email = $user->get_user($id)['Email'];

?>

<!-- Header -->
<?php include_once('templates/header.php'); ?>

    <!-- Body -->
    <section id="home" class="my-5">
        <div class="container">
            <table class="table table-bordered w-50 m-auto">
                <tbody>
                    <tr>
                        <th scope="row" style="width: 10%;">Fullname: </th>
                        <td><?php echo $fullname; ?></td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 10%;">Email: </th>
                        <td><?php echo $email; ?></td>
                    </tr>
                    
                    
                </tbody>
            </table>
        </div>
    </section>

<!-- Footer -->
<?php include_once('templates/footer.php'); ?>