<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/customers"><i class="fa fa-users"></i> <?= $title; ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data <?= $title; ?></h3>
                        <a href="/customers/add" class="btn btn-primary btn-flat pull-right">
                            <i style="margin-right: 2px;" class="fa fa-plus"></i>
                            Add <?= $title; ?></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (session()->getFlashdata('successCustomer')) : ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <span>
                                    <i class="icon fa fa-check"></i>
                                    <?= session()->getFlashdata('successCustomer'); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($customers as $cus) :
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $i++; ?>
                                                </td>
                                                <td><?= $cus['full_name']; ?></td>
                                                <td><?= $cus['phone']; ?></td>
                                                <td><?= $cus['address']; ?></td>
                                                <td class="action">
                                                    <a href="/customers/edit/<?= $cus['id']; ?>" class="btn btn-flat btn-warning btn-sm"><i class="fa fa-edit"> Edit</i></a>
                                                    <?php if ($cus['id'] != 1) : ?>
                                                        <form action="/customers/<?= $cus['id']; ?>" method="post" class="">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger btn-flat btn-sm" onclick="return confirm('Apakah anda yakin?');"><i class="fa fa-trash"></i> Delete</button>
                                                        </form>

                                                    <?php endif; ?>
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