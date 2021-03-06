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
                                    <input type="text" id="client_select" name="nameClient" class="form-control" data-type="search_client" />
                                    <div class="input-group-addon"><a href="javascript:;" class="client_add_button"><i class="fa fa-plus"></i> <strong>Adicionar Cliente Novo</strong></a></div>
                                </div>

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
                                <label>Total da venda: </label>
                                <input type="text" name="total_price" class="form-control money" disabled />
                            </div>
                            <hr>
                            <fieldset>
                                <legend><h4>Produtos</h4></legend>
                                <div class="input-group">
                                    <input type="hidden" name="product_id" />
                                    <input type="hidden" name="product_name" />
                                    <input type="hidden" name="product_price" />
                                    <input type="text" id="product_add" class="form-control" placeholder="Procurar..." data-type="search_inventory" />
                                    <div class="input-group-addon"><a href="javascript:;" class="product_add_button"><i class="fa fa-plus"></i> <strong>Adicionar Produto na Venda</strong></a></div>
                                </div>
                            </fieldset>
                            <table class="table table-condensed" id="products_table">
                                <tr>
                                    <th>#</th>
                                    <th>Produto</th>
                                    <th>Preço Unit.</th>
                                    <th>Quantidade</th>
                                    <th>Sub-Total</th>
                                    <th>Ações</th>
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
<script src="<?php echo BASE_URL; ?>/assets/js/script_client.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/script_product.js"></script>