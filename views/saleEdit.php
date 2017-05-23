<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Venda
            <small>Editar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/sale"><i class="fa fa-shopping-cart"></i> Vendas</a></li>
            <li class="active"><i class="fa fa-pencil"></i> Editar</li>
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
                    <div class="box-body">
                        <strong>Cliente:</strong>
                        <p><?php echo $sale_info['info']['client_name']; ?></p>
                        <strong>Data:</strong>
                        <p><?php echo date('d/m/Y - H:i:s', strtotime($sale_info['info']['date_sale'])); ?></p>
                        <strong>Preço total:</strong>
                        <p>R$ <?php echo number_format($sale_info['info']['total_price'],2,',','.'); ?></p>
                        <strong>Status:</strong>
                        <?php if ($permission_edit): ?>
                        <form method="POST">
                        <p><select name="status" class="form-control">
                            <?php foreach ($statuses as $statuskey => $statusvalue): ?>
                            <option value="<?php echo $statuskey; ?>" <?php echo ($sale_info['info']['status'] == $statuskey)? "selected" : ""; ?>><?php echo $statusvalue; ?></option>
                            <?php endforeach; ?>
                        </select></p>
                        <p><input type="submit" value="Salvar" class="btn btn-success" /></p>
                        <form>
                        <?php else: ?>
                        <p><?php echo $statuses[$sale_info['info']['status']]; ?></p>
                        <?php endif; ?>
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Preço Uni.</th>
                                <th>Total</th>
                            </tr>
                            <?php foreach ($sale_info['products'] as $prod): ?>
                                <tr>
                                    <td><?php echo $prod['id_inventory']; ?></td>
                                    <td><?php echo $prod['name']; ?></td>
                                    <td><?php echo $prod['qtd']; ?></td>
                                    <td>R$ <?php echo number_format($prod['sale_price'],2,',','.'); ?></td>
                                    <td>R$ <?php echo number_format($prod['sale_price'] * $prod['qtd'],2,',','.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->