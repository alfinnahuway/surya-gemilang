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
            <li><a href="/suppliers"><i class="fa fa-truck"></i> <?= $title; ?></a></li>
            <li class="active"><?= $secondTitle; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div style="display: flex; justify-content: center;" class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Monthly Recap Report</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/suppliers/edit/<?= $supplier['id']; ?>" method="post">
                                    <div class="box-body">
                                        <!-- text input -->
                                        <div class="form-group <?= ($validation->hasError('supplierName')) ? 'has-error' : 'has-feedback' ?>">
                                            <label>Supplier Name *</label>
                                            <input type="text" id="supplierName" name="supplierName" class="form-control" placeholder="Enter ..." value="<?= (set_value('supplierName')) ? set_value('supplierName') : $supplier['supplier_company'] ?>">
                                            <span class="help-block">
                                                <?= $validation->getError('supplierName'); ?>
                                            </span>
                                        </div>
                                        <div class="form-group <?= ($validation->hasError('phone')) ? 'has-error' : 'has-feedback' ?>">
                                            <label>Phone *</label>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter ..." value="<?= (set_value('phone')) ? set_value('phone') : $supplier['phone'] ?>">
                                            <span class="help-block">
                                                <?= $validation->getError('phone'); ?>
                                            </span>
                                        </div>
                                        <div class="form-group  <?= ($validation->hasError('address')) ? 'has-error' : 'has-feedback' ?>">
                                            <label>Address *</label>
                                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter ..."><?= (set_value('address')) ? set_value('address') : $supplier['address'] ?></textarea>
                                            <span class="help-block">
                                                <?= $validation->getError('address'); ?>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter ..."><?= (set_value('description')) ? set_value('description') : $supplier['description'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <a href="/suppliers" class="btn btn-default btn-flat">Back</a>
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