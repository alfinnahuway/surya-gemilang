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
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Monthly Recap Report</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/products/items/add" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="col-md-6">
                                            <!-- text input -->
                                            <div class="form-group <?= ($validation->hasError('item')) ? 'has-error' : 'has-feedback' ?>">
                                                <label>Product Name *</label>
                                                <input type="text" id="item" name="item" class="form-control" placeholder="Enter ..." value="<?= set_value('item') ?>">
                                                <span class="help-block">
                                                    <?= $validation->getError('item'); ?>
                                                </span>
                                            </div>
                                            <div class="form-group <?= ($validation->hasError('category')) ? 'has-error' : 'has-feedback' ?>">
                                                <label>Category *</label>
                                                <select class="form-control select2" style="width: 100%" id="category" name="category">
                                                    <option value="">Pilih Category</option>
                                                    <?php foreach ($categories as $category) : ?>
                                                        <option value="<?= $category['id']; ?>" <?= (set_value('category') == $category['id']) ? 'selected' : ''; ?>><?= $category['category']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="help-block">
                                                    <?= $validation->getError('category'); ?>
                                                </span>
                                            </div>
                                            <div class="form-group <?= ($validation->hasError('supplier')) ? 'has-error' : 'has-feedback' ?>">
                                                <label>Supplier *</label>
                                                <select class="form-control select2" style="width: 100%" id="supplier" name="supplier">
                                                    <option value="">Pilih supplier</option>
                                                    <?php foreach ($suppliers as $supplier) : ?>
                                                        <option value="<?= $supplier['id']; ?>" <?= (set_value('supplier') == $supplier['id']) ? 'selected' : ''; ?>><?= $supplier['supplier_company']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="help-block">
                                                    <?= $validation->getError('supplier'); ?>
                                                </span>
                                            </div>

                                            <label for="product_image">File input</label>
                                            <div class="form-group <?= ($validation->hasError('product_image')) ? 'has-error' : 'has-feedback' ?>">
                                                <div class="col-sm-4" style="padding-left: 0;">
                                                    <img src="../../../image/products/default_product.jpg" class="img-thumbnail img-preview" alt="">
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="file" id="product_image" name="product_image">
                                                    <span class="help-block">
                                                        <?= $validation->getError('product_image'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group <?= ($validation->hasError('stock')) ? 'has-error' : 'has-feedback' ?>">
                                                <label>Stock *</label>
                                                <input type="number" min="1" id="stock" name="stock" class="form-control" placeholder="Enter ..." value="<?= set_value('stock') ?>">
                                                <span class="help-block">
                                                    <?= $validation->getError('stock'); ?>
                                                </span>
                                            </div>
                                            <div class="form-group <?= ($validation->hasError('unit')) ? 'has-error' : 'has-feedback' ?>">
                                                <label>Unit *</label>
                                                <select class="form-control select2" style="width: 100%" id="unit" name="unit">
                                                    <option value="">Pilih unit</option>
                                                    <?php foreach ($units as $unit) : ?>
                                                        <option value="<?= $unit['id']; ?>" <?= (set_value('unit') == $unit['id']) ? 'selected' : ''; ?>><?= $unit['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="help-block">
                                                    <?= $validation->getError('unit'); ?>
                                                </span>
                                            </div>
                                            <div class="form-group <?= ($validation->hasError('price')) ? 'has-error' : 'has-feedback' ?>">
                                                <label>Price *</label>
                                                <input type="number" min="0" id="price" name="price" class="form-control" placeholder="Enter ..." value="<?= set_value('price') ?>">
                                                <span class="help-block">
                                                    <?= $validation->getError('price'); ?>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="3"><?= set_value('description'); ?></textarea>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="box-footer">
                                        <a href="/products/items" class="btn btn-default btn-flat">Back</a>
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