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
                                    <div class="input-group-addon"><a href="javascript:;" class="product_add_button"><i class="fa fa-plus"></i> <strong>Adicionar Produto na Compra</strong></a></div>
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
                        </div>
                        <div class="box-footer">

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?php echo BASE_URL; ?>/assets/js/script_product.js"></script>