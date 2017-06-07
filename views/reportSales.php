<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Relatório de Vendas
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/report"><i class="fa fa-bar-chart"></i> Relatório</a></li>
            <li class="active"><i class="fa fa-shopping-cart"></i> Vendas</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form method="GET" onsubmit="return openPopup(this)">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Cliente:</label>
                                        <input type="text" name="name_client" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Período:</label>
                                        <div class="input-daterange input-group">
                                            <input type="text" name="period1" class="datepicker form-control" />
                                            <span class="input-group-addon">até</span>
                                            <input type="text" name="period2" class="datepicker form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <select name="status" class="form-control">
                                            <option value="">Todos os Status</option>
                                            <?php foreach ($statuses as $statusKey => $statusValue): ?>
                                                <option value="<?php echo $statusKey; ?>"><?php echo $statusValue; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ordenação:</label>
                                        <select name="order" class="form-control">
                                            <option value="date_desc">Mais Recente</option>
                                            <option value="date_asc">Mais Antigo</option>
                                            <option value="status">Status da Venda</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-center">
                            <input type="submit" value="Gerar Relatório" class="btn btn-lg btn-primary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/masks.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/report_sales.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/bootstrap-datepicker.pt-BR.js"></script>