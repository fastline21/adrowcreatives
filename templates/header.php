<?php $parseData = parse_ini_file('.env'); ?>
<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title><?php echo $title; ?> - <?php echo $parseData['SITE_TITLE']; ?></title>
        <script src="https://kit.fontawesome.com/fe72e476fd.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
        <link rel="stylesheet" href="./public/css/main.css" />
    </head>
    <body class="d-flex flex-column h-100">
        <?php
        if (!empty($_SESSION['login'])) {
            if ($_SESSION['loaded'] == true) {
                ?>
                <div id="loading" class="div__loading">
                    <video autoplay>
                        <source src="./public/video/adrow_logo.mp4" type="video/mp4" />
                    </video>
                </div>
                <?php
            }
            ?>
            
            <!-- Nav Menu Top -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow sticky-top">
                <a class="navbar-brand col-md-2 p-0" href="<?php echo $parseData['DOMAIN']; ?>">
                    <img src="./public/images/logo.png" class="img-fluid logo" alt="" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <span class="text-white"><?php echo $parseData['SITE_TITLE']; ?></span>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <span class="nav-link"><?php $user->get_fullname($id); ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="home?a=logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Nav Menu Sidebar -->
            <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link<?php echo $active == 'Home' ? ' active' : ''; ?>" href="<?php echo $parseData['DOMAIN']; ?>">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?php echo $active == 'Profile' ? ' active' : ''; ?>" href="<?php echo $parseData['DOMAIN']; ?>/profile">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?php echo $active == 'Product' ? ' active' : ''; ?>" href="<?php echo $parseData['DOMAIN']; ?>/product">Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?php echo $active == 'Print' ? ' active' : ''; ?>" href="<?php echo $parseData['DOMAIN']; ?>/print">Print</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
            <?php
        }
        ?>