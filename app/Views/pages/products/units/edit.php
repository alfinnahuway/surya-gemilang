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
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Monthly Recap Report</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/products/units/edit/<?= $unit['id']; ?>" method="post">
                                    <div class="box-body">
                                        <!-- text input -->
                                        <div class="form-group <?= ($validation->hasError('unit')) ? 'has-error' : 'has-feedback' ?>">
                                            <label>Unit Name *</label>
                                            <input type="text" id="unit" name="unit" class="form-control" placeholder="Enter ..." value="<?= (set_value('unit')) ? set_value('unit') : $unit['name'] ?>">
                                            <span class="help-block">
                                                <?= $validation->getError('name'); ?>
                                            </span>
                                        </div>
                                        <div class="box-footer">
                                            <a href="/products/categories" class="btn btn-default btn-flat">Back</a>
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-primary btn-flat">Save</button>
                                                <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                                            </div>

                                        </div>
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
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