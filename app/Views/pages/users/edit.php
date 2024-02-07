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
                        <h3 class="box-title"><?= $secondTitle; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/users/edit/<?= $users['id']; ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="box-body">
                                        <!-- text input -->
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img src="../../../image/users/<?= $users['image']; ?>" class="img-thumbnail img-preview" alt="" id="userEditImage">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group <?= ($validation->hasError('name')) ? 'has-error' : 'has-feedback' ?>">
                                                    <label>Name *</label>
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter ..." value="<?= (set_value('name')) ? set_value('name') : $users['name'] ?>">
                                                    <span class="help-block">
                                                        <?= $validation->getError('name'); ?>
                                                    </span>
                                                </div>

                                                <div class="form-group <?= ($validation->hasError('email')) ? 'has-error' : 'has-feedback' ?>">
                                                    <label>Email *</label>
                                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter ..." value="<?= (set_value('email')) ? set_value('email') : $users['email'] ?>">
                                                    <span class="help-block">
                                                        <?= $validation->getError('email'); ?>
                                                    </span>
                                                </div>
                                                <div class="form-group <?= ($validation->hasError('editImage')) ? 'has-error' : 'has-feedback' ?>">
                                                    <input type="file" id="editImage" name="editImage">
                                                    <input type="hidden" value="<?= $users['image']; ?>" name="oldImage" id="oldImage">
                                                    <span class="help-block">
                                                        <?= $validation->getError('editImage'); ?>
                                                    </span>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group <?= ($validation->hasError('username')) ? 'has-error' : 'has-feedback' ?>">
                                            <label>Username *</label>
                                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter ..." value="<?= (set_value('username')) ? set_value('username') : $users['username'] ?>">
                                            <span class="help-block">
                                                <?= $validation->getError('username'); ?>
                                            </span>
                                        </div>
                                        <div class="form-group <?= ($validation->hasError('oldpassword')) ? 'has-error' : 'has-feedback' ?>">
                                            <label>Old Password</label>
                                            <input type="password" id="oldpassword" name="oldpassword" class="form-control" placeholder="Enter ..." value="<?= set_value('oldpassword'); ?>">
                                        </div>
                                        <div class="form-group <?= ($validation->hasError('password')) ? 'has-error' : 'has-feedback' ?>">
                                            <label>Password</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter ..." value="<?= set_value('password'); ?>">
                                        </div>
                                        <div class="form-group <?= ($validation->hasError('password_confirm')) ? 'has-error' : 'has-feedback' ?>">
                                            <label>Password Confirm</label>
                                            <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Enter ..." value="<?= set_value('password_confirm'); ?>">
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