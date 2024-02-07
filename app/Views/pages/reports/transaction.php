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

                                            <div style="padding-left: 0;" class="form-group col-md-5">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>

                                                    <input type="text" class="form-control pull-right dateReport" id="datepicker" name="dateReport">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <div class="form-group col-md-5">
                                                <select class="form-control select2" id="customerReport" name="customerReport">
                                                    <option value="">Pilih supplier</option>
                                                    <?php foreach ($customer as $cs) : ?>
                                                        <option value="<?= $cs['id']; ?>" <?= (set_value('customer') == $cs['id']) ? 'selected' : ''; ?>><?= $cs['full_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div style="padding: 0;" class="col-md-2">
                                                <button type="button" class="btn btn-primary btn-flat" id="searchReport">Search</button>
                                            </div>

                                        </div>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Invoice</th>
                                                <th>Date</th>
                                                <th>Customer</th>
                                                <th class="text-right">Total Transaction</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="reportSearch">
                                            <?php
                                            $i = 1;
                                            foreach ($transaction as $tsr) : ?>
                                                <tr>
                                                    <td>
                                                        <?= $i++; ?>
                                                    </td>
                                                    <td>
                                                        <?= $tsr['invoice']; ?>
                                                    </td>
                                                    <td>
                                                        <?=
                                                        date('d M Y', strtotime($tsr['created_at']));
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?= $tsr['full_name']; ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?= number_format($tsr['sub_total'], 0, ',', '.'); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <button type="button" data-invoice="<?= $tsr['invoice']; ?>" data-date="<?= date('d/m/Y', strtotime($tsr['created_at'])); ?>" data-fullname="<?= $tsr['full_name']; ?>" data-cashiername="<?= $tsr['name']; ?>" data-total="<?= number_format($tsr['total'], 0, ',', '.'); ?>" data-discount="<?= $tsr['discount']; ?>" data-subtotal="<?= number_format($tsr['sub_total'], 0, ',', '.'); ?>" data-cash="<?= number_format($tsr['cash'], 0, ',', '.'); ?>" data-change="<?= number_format($tsr['change'], 0, ',', '.'); ?>" data-note="<?= $tsr['note']; ?>" class="btn btn-sm btn-flat detailTransaction">
                                                            <i class="fa fa-eye"></i>
                                                            Detail
                                                        </button>
                                                        <a href="/transaction/printout/<?= $tsr['invoice']; ?>" target="_blank" class="btn btn-sm btn-flat btn-success">
                                                            <i class="glyphicon glyphicon-print"></i>
                                                            Print
                                                        </a>
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
<div class="modal fade" id="modalTransactionReport">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> Detail Transaction
                            <small class="pull-right">Date: <span class="date-transaction"></small>
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <div class="modal-body">

                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Cashier
                        <address>
                            <strong><span class="cashier-transaction"></span></strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: info@almasaeedstudio.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        Customer
                        <address>
                            <strong><span class="customer-transaction"></strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (555) 539-1037<br>
                            Email: john.doe@example.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice <span class="invoice-transaction"></span></b><br>
                        <br>
                        <b>Order ID:</b> 4F3S8J<br>
                        <b>Payment Due:</b> <span class="date-transaction"></span><br>
                        <b>Account:</b> 968-34567
                    </div>
                    <!-- /.col -->
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Barcode</th>
                            <th>Product</th>
                            <th>Unit</th>
                            <th class="text-right">Qty</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody id="reportContent">
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>

                <div class="row">
                    <div class="col-xs-6">
                        <p class="lead">Note:</p>
                        <span class="note-transaction"></span>
                    </div>
                    <div class="col-xs-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td class="text-right">Sub Total</td>
                                    <td class="text-right">Rp. <span class="total-transaction"></span></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Discount</td>
                                    <td class="text-right">Rp. <span class="discount-transaction"></span></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Grand Total</td>
                                    <td class="text-right">Rp. <span class="subtotal-transaction"></span></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Cash</td>
                                    <td class="text-right">Rp. <span class="cash-transaction"></span></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Change</td>
                                    <td class="text-right">Rp. <span class="change-transaction"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection(); ?>