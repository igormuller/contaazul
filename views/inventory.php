<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Estoque
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><i class="fa fa-download"></i> Estoque</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Estoque</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?php if ($permission_add): ?>
                                <p><a href="<?php echo BASE_URL; ?>/inventory/add" class="btn btn-success" data-toggle="modal">Adicionar Produto</a></p>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="busca" class="form-control" placeholder="Procurar..." data-type="search_inventory" />
                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Qtde</th>
                                <th>Qtde Min.</th>
                                <th>Ações</th>
                            </tr>
                            <?php foreach ($inventory_list as $p): ?>
                            <tr>
                                <td><?php echo $p['id_inventory']; ?></td>
                                <td><?php echo $p['name']; ?></td>
                                <td><?php echo "R$ ".number_format($p['price'],2,',','.'); ?></td>
                                <td><?php echo $p['qtd']; ?></td>
                                <td><?php echo $p['qtd_min']; ?></td>
                                <td></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
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