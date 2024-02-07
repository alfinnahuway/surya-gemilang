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
            <li><a href="/customers"><i class="fa fa-pie-chart"></i> <?= $title; ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <div style="display: flex; justify-content: center;" class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data <?= $title; ?></h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">
                                <table id="reports" class="table table-bordered table-striped">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <form action="/reports/income/search" method="get">
                                                <div style="padding-left: 0;" class="form-group col-md-5">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="startDate" name="startDate" value="<?= isset($startDate); ?>">
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                <div style="padding-left: 0;" class="form-group col-md-5">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>

                                                        <input type="text" class="form-control pull-right dateReport" id="endDate" name="endDate" value="<?= isset($endDate); ?>">
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                <div style="padding: 0;" class="col-md-2">
                                                    <button type="submit" class="btn btn-primary btn-flat">Search</button>
                                                </div>
                                            </form>

                                        </div>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th class="text-right">Income</th>
                                            </tr>
                                        </thead>
                                        <tbody id="reportSearch">
                                            <?php $i = 1; ?>
                                            <?php foreach ($transaction as $t) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= date('d F Y', strtotime($t['date'])); ?></td>

                                                    <td class="text-right">
                                                        <?= number_format($t['sub_total'], 0, ',', '.'); ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-right">Total</th>
                                                <th class="text-right text-bold">
                                                    <?php
                                                    $total = 0;
                                                    foreach ($transaction as $t) {
                                                        $total += $t['sub_total'];
                                                    }
                                                    echo number_format($total, 0, ',', '.');
                                                    ?>
                                                </th>
                                        </tfoot>
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
<?= $this->endSection(); ?>