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
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly Recap Report</h3>
                        <a href="/products/items/add" class="btn btn-primary btn-flat pull-right">Add <?= $title; ?></a>
                        <!-- create button position righ -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (session()->getFlashdata('successItem')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('successItem'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Barcode</th>
                                            <th>Product</th>
                                            <th>Category</th>
                                            <th class="text-right">Stock</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($items as $item) : ?>
                                            <tr>

                                                <td><?= $item['barcode'] ?></td>
                                                <td><?= $item['product'] ?></td>
                                                <td><?= $item['category'] ?></td>
                                                <td class="text-right"><?= $item['stock'] ?></td>
                                                <td class="text-right"><?= 'Rp. ' . number_format($item['price'], 0, ',', '.') ?></td>
                                                <td class="action">
                                                    <button type="button" data-date="<?= $item['created_at']; ?>" data-barcode="<?= $item['barcode']; ?>" data-category="<?= $item['category']; ?>" data-product="<?= $item['product']; ?>" data-name="<?= $item['name']; ?>" data-stock="<?= $item['stock'];  ?>" data-image="<?= $item['product_image']; ?>" data-price="<?= $item['price']; ?>" data-description="<?= $item['description']; ?>" data-toggle="modal" data-target="#modal-detail" class="btn btn-flat btn-default btn-sm btn-detail"><i class="fa fa-eye"></i> Detail</button>
                                                    <a href="/products/items/edit/<?= $item['barcode']; ?>" class="btn btn-flat btn-warning btn-sm"><i class="fa fa-edit"> Edit</i></a>
                                                    <form action="/products/items/<?= $item['barcode']; ?>" method="post" class="">
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


<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">


                <table>
                    <tr>
                        <td colspan="2" rowspan="9" class="data-table">
                            <img style="width: 150px;" src="../../../image/products/default_product.jpg" class="img-thumbnail img-preview imageProduct-modal" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td class="data-table">Date Product</td>
                        <td class="double-dot">:</td>
                        <td><span class="date-modal"></span></td>
                    </tr>
                    <tr>
                        <td class="data-table">Barcode</td>
                        <td class="double-dot">:</td>
                        <td><span class="barcode-modal"></span></td>
                    </tr>
                    <tr>
                        <td class="data-table">Category</td>
                        <td class="double-dot">:</td>
                        <td><span class="category-modal"></span></td>
                    </tr>
                    <tr>
                        <td class="data-table">Product</td>
                        <td class="double-dot">:</td>
                        <td><span class="product-modal"></span></td>
                    </tr>
                    <tr>
                        <td class="data-table">Unit</td>
                        <td class="double-dot">:</td>
                        <td><span class="unit-modal"></span></td>
                    </tr>
                    <tr>
                        <td class="data-table">Stock</td>
                        <td class="double-dot">:</td>
                        <td><span class="stock-modal"></span></td>
                    </tr>
                    <tr>
                        <td class="data-table">Price</td>
                        <td class="double-dot">:</td>
                        <td><span class="price-modal"></span></td>
                    </tr>
                    <tr>
                        <td class="data-table">Description</td>
                        <td class="double-dot">:</td>
                        <td><span class="description-modal"></span></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection(); ?>