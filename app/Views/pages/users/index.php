<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly Recap Report</h3>
                        <a href="/users/add" class="btn btn-primary btn-flat pull-right">Add <?= $title; ?></a>
                        <!-- create button position righ -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (session()->getFlashdata('successUsers')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('successUsers'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $user['name']; ?></td>
                                                <td><?= $user['email']; ?></td>
                                                <td><?= $user['role']; ?></td>
                                                <td class="text-centeri action">
                                                    <a href="/users/edit/<?= $user['id']; ?>" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i></a>
                                                    <?php if ($user['role'] == 'CASHIER') : ?>
                                                        <form action="/users/<?= $user['id']; ?>" method="post" class="d-inline">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger btn-flat" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    <?php endif;  ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                    <div class="box-footer">
                        <div class="row">

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>