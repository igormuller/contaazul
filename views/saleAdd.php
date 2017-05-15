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
                                    <input type="hidden" name="client_id" />
                                    <input type="text" id="client_add" name="nameClient" class="form-control" data-type="search_client" />
                                    <div class="input-group-addon"><a href="javascript:;" class="client_add_button"><i class="fa fa-plus"></i> <strong>Adicionar Cliente</strong></a></div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label>Data da venda: </label>
                                <input type="text" name="date_sale" class="form-control date" placeholder="dd/mm/YYYY" required />
                            </div>
                            <div class="form-group">
                                <label>Status: </label>
                                <select name="status" class="form-control">
                                    <option value="1">Nova</option>
                                    <option value="2">Em aprovação</option>
                                    <option value="3">Concluida</option>
                                    <option value="4">Cancelada</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Preço da venda: </label>
                                <input type="text" name="total_price" class="form-control money" disabled />
                            </div>
                            <hr>
                            <fieldset>
                                <legend><h4>Produtos</h4></legend>
                                <div class="input-group">
                                    <input type="hidden" name="product_id" />
                                    <input type="text" id="product_add" class="form-control" placeholder="Procurar..." data-type="search_inventory" />
                                    <div class="input-group-addon"><a href="javascript:;" class="product_add_button"><i class="fa fa-plus"></i> <strong>Adicionar Produto</strong></a></div>
                                </div>
                            </fieldset>
                            <table class="table table-condensed">
                                <tr>
                                    <th>#</th>
                                    <th>Produto</th>
                                    <th>Preço Unit.</th>
                                    <th>Quantidade</th>
                                    <th>Sub-Total</th>
                                </tr>
                            </table>
                            <hr>
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