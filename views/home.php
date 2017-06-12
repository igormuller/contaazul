<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Home
            <small>Página de controle do Conta Azul</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-home"></i> Home</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Resumo do dia - <?php echo date('d/m/Y'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-aqua-gradient"><i class="fa fa-shopping-cart"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Produtos Vendidos</span>
                                        <span class="info-box-number">50</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red-gradient"><i class="fa fa-download"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Valor Vendido</span>
                                        <span class="info-box-number">R$ 1500,54</span>
                                        <span class="info-box-more">Mais</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green-gradient"><i class="fa fa-street-view"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Despesas</span>
                                        <span class="info-box-number">R$ 500,47</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Receitas e Despesas do mês - <?php echo date('m/Y'); ?></h3>
                    </div>
                    <div class="box-body">
                        <canvas id="report_month"></canvas>
                    </div>
                    <div class="box-footer">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Status</h3>
                    </div>
                    <div class="box-body">
                        <canvas id="report_status"></canvas>
                    </div>
                    <div class="box-footer">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    var days_list = <?php echo json_encode($days_list); ?>;
    var sale_price = <?php echo json_encode($sale_price); ?>;
    var purchase_price = <?php echo json_encode($purchase_price); ?>
</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report_home.js"></script>