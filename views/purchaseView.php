<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Compras <small>Ver</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/purchase"><i class="fa fa-download"></i> Compras</a></li>
            <li class="active"><i class="fa fa-eye"></i> Ver</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Valor Total</label>
                            <input type="text" class="form-control" name="total_price" value="<?php echo "R$ ".number_format($purchase['total_price'],2,',','.'); ?>" disabled />
                        </div>
                        <fieldset>
                            <legend><h4>Produtos</h4></legend>
                            <table class="table table-condensed" id="products_table">
                                <tr>
                                    <th>#</th>
                                    <th>Produto</th>
                                    <th>Preço Unit.</th>
                                    <th>Quantidade</th>
                                    <th>Sub-Total</th>
                                </tr>
                                <?php foreach ($purchase['products'] as $p): ?>
                                    <tr>
                                        <td><?php echo $p['id_inventory']; ?></td>
                                        <td><?php echo $p['name']; ?></td>
                                        <td><?php echo "R$ ".number_format($p['purchase_price'],2,',','.'); ?></td>
                                        <td><?php echo $p['qtd']; ?></td>
                                        <td><?php echo "R$ ".number_format($p['subtotal'],2,',','.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </fieldset>
                    </div>
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
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" id="saveNewProduct">Salvar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Adicionar produto -->