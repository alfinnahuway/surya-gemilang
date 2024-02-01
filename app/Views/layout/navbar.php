<?php

$path = explode('/', request()->getPath());
$session = session();
$name = $session->get('name');
$image = $session->get('image');
$role = $session->get('role');
?>


<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>G</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Surya</b>GEMILANG</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="../../image/users/<?= $image; ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= $name; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="../../image/users/<?= $image; ?>" class="img-circle" alt="User Image">

                            <p>
                                <?= $name . ' - ' . $role; ?>
                                <!-- <small>Member since Nov. 2012</small> -->
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="/logout" class="btn btn-default btn-flat">Logout</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>