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


        <div style="display: flex; justify-content: center;" class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly Recap Report</h3>
                        <a href="/products/categories/add" class="btn btn-primary btn-flat pull-right">Add Category</a>
                        <!-- create button position righ -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Categories</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($categories as $category) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $category['category'] ?></td>
                                                <td class="action">
                                                    <a href="/products/categories/edit/<?= $category['id']; ?>" class="btn btn-flat btn-warning btn-sm"><i class="fa fa-edit"> Edit</i></a>
                                                    <form action="/products/categories/<?= $category['id']; ?>" method="post" class="">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger btn-flat btn-sm" onclick="return confirm('Apakah anda yakin?');"><i class="fa fa-trash"></i> Delete</button>
                                                    </form>
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