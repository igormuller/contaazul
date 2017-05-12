<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Venda
            <small>Adicionar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/sale"><i class="fa fa-shopping-cart"></i> Vendas</a></li>
            <li class="active"><i class="fa fa-plus"></i> Adicionar</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php if (!empty($error_info)): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-warning"></i> Atenção!</h4>
                        <?php echo $error_info; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Cliente: </label>
                                <div class="input-group">
                                    <input type="text" id="buscaAdd" class="form-control" data-type="search_client" />
                                    <div class="input-group-addon"><a href="javascript:;" class="client_add_button"><i class="fa fa-plus"></i> <strong>Adicionar Cliente</strong></a></div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label>Data da venda: </label>
                                <input type="text" name="data_sale" class="form-control date" required />
                            </div>
                            <div class="form-group">
                                <label>Status: </label>
                                <select name="stars" class="form-control">
                                    <option value="1">Nova</option>
                                    <option value="2">Em aprovação</option>
                                    <option value="3">Concluida</option>
                                    <option value="4">Cancelada</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" value="Salvar" class="btn btn-success" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->