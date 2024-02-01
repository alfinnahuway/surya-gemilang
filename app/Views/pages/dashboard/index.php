<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title; ?>
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-exchange"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Transaction Today</span>
                        <span class="info-box-number"><?= $transactionCount['count']; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->


            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon  bg-green color-palette"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sales Product</span>
                        <span class="info-box-number"><?= $productSalesToday; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-light-blue-active color-palette"><i class="fa fa-line-chart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Income Today</span>
                        <span class="info-box-number"><?= number_format($transactionSubTotal, 0, ',', '.'); ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">New Members</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Jumlah Barang & Penjualan Barang</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body ">

                        <div id="barChart" style="height:400px;"></div>

                        <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <!-- ./box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                    <h5 class="description-header">$35,210.43</h5>
                                    <span class="description-text">TOTAL REVENUE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                    <h5 class="description-header">$10,390.90</h5>
                                    <span class="description-text">TOTAL COST</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                    <h5 class="description-header">$24,813.53</h5>
                                    <span class="description-text">TOTAL PROFIT</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block">
                                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                    <h5 class="description-header">1200</h5>
                                    <span class="description-text">GOAL COMPLETIONS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
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

<script type="text/javascript" src="https://fastly.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script>
    var dom = document.getElementById("barChart");
    var myChart = echarts.init(dom, null, {
        renderer: "canvas",
        useDirtyRect: false,
    });
    var app = {};

    var option;
    option = {
        xAxis: {
            //  font size 10
            axisLabel: {
                fontSize: 10,
                // rotate 45 degree
                rotate: 45,
                // padding between label and axis
                padding: [0, 0, 0, 0],
            },

            data: [<?php
                    foreach ($categories as $categor) {
                        echo "'" . $categor['category'] . "',";
                    }
                    ?>]

        },
        yAxis: {

        },
        dataGroupId: "",
        animationDurationUpdate: 500,
        series: {
            type: "bar",
            id: "sales",
            data: [
                <?php
                foreach ($dataCount as $count) {
                    echo "{value:" . $count['value'] . ",groupId:'" . $count['groupId'] . "'},";
                }
                ?>
            ],

            universalTransition: {
                enabled: true,
                divideShape: "clone",
            },
        },
    };
    const drilldownData = [<?php foreach ($dataProduct as $dp) {
                                echo "{dataGroupId:'" . $dp['dataGroupId'] . "',data:[";
                                foreach ($dp['data'] as $d) {
                                    echo "['" . $d['product'] . "'," . $d['qty_product'] . "],";
                                }
                                echo "]},";
                            } ?>

    ];

    myChart.on("click", function(event) {
        if (event.data) {
            var subData = drilldownData.find(function(data) {
                return data.dataGroupId === event.data.groupId;
            });
            if (!subData) {
                return;
            }
            myChart.setOption({
                xAxis: {
                    data: subData.data.map(function(item) {
                        return item[0];
                    }),
                },
                series: {
                    type: "bar",
                    id: "sales",
                    dataGroupId: subData.dataGroupId,
                    data: subData.data.map(function(item) {
                        return item[1];
                    }),
                    universalTransition: {
                        enabled: true,
                        divideShape: "clone",
                    },

                },
                graphic: [{
                    type: "text",
                    left: 50,
                    top: 20,
                    style: {
                        text: "Back",
                        fontSize: 18,
                    },
                    onclick: function() {
                        myChart.setOption(option);
                    },
                }, ],
            });
        }
    });

    if (option && typeof option === "object") {
        myChart.setOption(option);
    }

    window.addEventListener("resize", myChart.resize);
</script>
<?= $this->endSection(); ?>