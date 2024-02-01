<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?php $cashier = session()->get('name'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title; ?>
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-shopping-cart"></i> <?= $title; ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <form class="form-horizontal" action="/transaction" method="post">
                <div class="col-md-4">
                    <div class="info-box">

                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3">Date</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control pull-right" id="datepicker" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cashier" class="col-sm-3">Cashier</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="cashier" value="<?= $cashier; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3">Customer</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="customer" name="customer">
                                        <?php foreach ($customers as $customer) : ?>
                                            <option value="<?= $customer['id']; ?>" <?= ($customer['id'] == 1) ? 'selected' : ''; ?>><?= $customer['full_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="Barcode" class="col-sm-3">Barcode</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control barcode-transaction" id="barcode" name="barcode">
                                        <span class="input-group-btn">
                                            <button type="button" data-toggle="modal" data-target="#modal-transaction" class="btn btn-primary btn-flat">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Quantity" class="col-sm-3">Qty</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control qty-transaction" id="quantity" name="quantity" min="1">
                                    <input type="hidden" name="messageError" id="messageError" value="<?= session()->getFlashdata('error'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3"></label>
                                <div class="col-sm-9">
                                    <button class="btn btn-primary btn-flat add-transaction">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.info-box -->
                </div>
            </form>
            <!-- /.info-box-content -->
            <form class="form-horizontal" action="/transaction/proccess" method="post">
                <div class="col-md-4">
                    <div class="info-box">

                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3">

                                </label>
                                <div class="col-sm-9">
                                    <div class="text-right">
                                        <p>Invoice <span><?= $invoice; ?></span></p>
                                        <h2 class=""><?= 'Rp. ' . number_format($transactionTotal, 0, ',', '.'); ?></h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-12">
                    <div class="info-box box-body">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Barcode</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($transactionProduct as $add) :
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $add['items_barcode']; ?></td>
                                            <td><?= $add['product']; ?></td>
                                            <td><?= $add['price']; ?></td>
                                            <td><?= $add['qty_product']; ?></td>
                                            <td><?= $add['qty_product'] * $add['price']; ?></td>
                                            <td class="action">
                                                <button type="button" class="btn btn-danger btn-flat btn-sm" data-delete="<?= $add['items_barcode']; ?>" id="deleteProduct"><i class="fa fa-trash"></i></button>
                                                <a href="/transaction/edit/<?= $add['items_barcode']; ?>" data-toggle="modal" data-target="#modal-detail" class="btn btn-flat btn-warning btn-sm btn-detail"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="subtotal" class="col-sm-4">Sub Total</label>
                                <div class="col-sm-8">
                                    <input type="hidden" id="customer_id" name="customer_id">
                                    <input type="text" class="form-control text-right" id="subtotal" name="subtotal" value="<?= $transactionTotal; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Discount" class="col-sm-4">Discount</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control text-right" min="0" id="discount" name="discount" value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Grandtotal" class="col-sm-4">Grand Total</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control text-right" id="grandtotal" name="grandtotal" value="<?= $transactionTotal; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="cash" class="col-sm-3">Cash</label>
                                <div class="col-sm-9 pull-right">
                                    <input type="text" class="form-control input-lg text-right" id="cash" name="cash">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Change" class="col-sm-3">Change</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control text-right" id="change" name="change" value="0" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="note" class="col-sm-3">Note</label>
                                <div class="col-sm-9">
                                    <!-- create textarea with style fixed size -->
                                    <textarea style="resize: vertical;" class="form-control" rows="3" id="note" name="note"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-2">
                    <!-- create margin bottom btn -->
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-warning btn-flat btn-sm btn-block">Clear</button>
                        </div>
                        <br>
                        <br>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-flat btn-block">
                                <i class="fa fa-location-arrow"></i>
                                <span>Process Payment</span>
                            </button>

                        </div>

                    </div>

                </div>
            </form>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<div class="modal fade" id="modal-transaction">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
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
                                    <button type="button" data-barcode="<?= $item['barcode']; ?>" data-dismiss="modal" class="btn btn-flat btn-default btn-sm btn-product"><i class="fa fa-check"></i> Select</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection(); ?>