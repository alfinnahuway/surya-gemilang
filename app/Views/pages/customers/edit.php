<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $secondTitle; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/customers"><i class="fa fa-users"></i> <?= $title; ?></a></li>
            <li class="active"><?= $secondTitle; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div style="display: flex; justify-content: center;" class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/customers/edit/<?= $customer['id']; ?>" method="post">
                                    <div class="box-body">
                                        <!-- text input -->
                                        <div class="form-group <?= ($validation->hasError('name')) ? 'has-error' : 'has-feedback' ?>">
                                            <label>Customer Name *</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter ..." value="<?= (set_value('name')) ? set_value('name') : $customer['full_name'] ?>">
                                            <span class="help-block">
                                                <?= $validation->getError('name'); ?>
                                            </span>
                                        </div>
                                        <div class="form-group <?= ($validation->hasError('phone')) ? 'has-error' : 'has-feedback' ?>">
                                            <label>Phone *</label>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter ..." value="<?= (set_value('phone')) ? set_value('phone') : $customer['phone'] ?>">
                                            <span class="help-block">
                                                <?= $validation->getError('phone'); ?>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label>Address *</label>
                                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter ..."><?= (set_value('address')) ? set_value('address') : $customer['address'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <a href="/customers" class="btn btn-default btn-flat">Back</a>
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