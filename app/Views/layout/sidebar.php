<?php

$path = explode('/', request()->getPath());
$session = session();
$name = $session->get('name');
$image = $session->get('image');
$role = $session->get('role');

?>


<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../../image/users/<?= $image; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $name; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?= $role; ?></a>
            </div>
        </div>


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?= ($path[0] === 'dashboard') ? 'active' : '' ?>">
                <a href="/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="<?= ($path[0] === 'suppliers') ? 'active' : '' ?>">
                <a href="/suppliers">
                    <i class="fa fa-truck"></i>
                    <span>Suppliers</span>
                    <!-- <span class="pull-right-container">
                        <span class="label label-primary pull-right">4</span>
                    </span> -->
                </a>
            </li>
            <li class="<?= ($path[0] === 'customers') ? 'active' : '' ?>">
                <a href="/customers">
                    <i class="fa fa-users"></i>
                    <span>Customers</span>
                </a>
            </li>

            <li class="<?= ($path[0] === 'transaction') ? 'active' : '' ?>">
                <a href="/transaction">
                    <i class="fa  fa-shopping-cart"></i>
                    <span>Transaction</span>

                </a>

            </li>

            <?php if ($role == 'ADMIN') : ?>
                <li class="header">MASTER</li>
                <li class="<?= ($path[0] === 'users') ? 'active' : '' ?>">
                    <a href="/users">
                        <i class="fa fa-user"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="treeview <?= ($path[0] === 'products') ? 'active' : '' ?>">
                    <a href="#">
                        <i class="fa fa-archive"></i>
                        <span>Products</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?= (count($path) > 1) && ($path[1] === 'categories') ? 'active' : ''  ?>"><a href="/products/categories"><i class="fa fa-circle-o"></i> Categories</a></li>
                        <li class="<?= (count($path) > 1) && ($path[1] === 'units') ? 'active' : ''  ?>"><a href="/products/units"><i class="fa fa-circle-o"></i> Units</a></li>
                        <li class="<?= (count($path) > 1) && ($path[1] === 'items') ? 'active' : ''  ?>"><a href="/products/items"><i class="fa fa-circle-o"></i> Items</a></li>
                    </ul>
                </li>
                <li class="treeview <?= ($path[0] === 'reports') ? 'active' : '' ?>">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Reports</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?= (count($path) > 1) && ($path[1] === 'transaction') ? 'active' : ''  ?>"><a href="/reports/transaction"><i class="fa fa-circle-o"></i> Report Transaction</a></li>
                        <li class="<?= (count($path) > 1) && ($path[1] === 'income') ? 'active' : ''  ?>"><a href="/reports/income"><i class="fa fa-circle-o"></i> Report Income</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>