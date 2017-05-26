<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Compras <small>Adicionar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/purchase"><i class="fa fa-download"></i> Compras</a></li>
            <li class="active"><i class="fa fa-plus"></i> Adicionar</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Valor Total</label>
                                <input type="text" class="form-control" name="total_price" id="total_price" disabled />
                            </div>
                            <fieldset>
                                <legend><h4>Produtos</h4></legend>
                                <div class="input-group">
                                    <input type="hidden" name="product_id" />
                                    <input type="hidden" name="product_name" />
                                    <input type="hidden" name="product_price" />
                                    <input type="text" id="product_add" class="form-control" placeholder="Procurar..." data-type="search_inventory" />
                                    <div class="input-group-addon"><a href="javascript:;" class="product_add_purchase"><i class="fa fa-plus"></i> <strong>Adicionar Produto na Compra</strong></a></div>
                                </div>
                                <br/>
                                <a href="javascript:;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalNewProduct">Novo Produto</a>
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
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-success" value="Salvar" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Modal Adicionar produto -->
<div class="modal fade" id="modalNewProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Adicionar novo Produto</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nome: </label>
                    <input type="text" name="nameNewProduct" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Qtde Mínima: </label>
                    <input type="text" name="qtd_minNewProduct" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveNewProduct">Salvar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Adicionar produto -->

<script src="<?php echo BASE_URL; ?>/assets/js/script_product_purchase.js"></script>