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
                            <?php foreach ($inventory_list as $il): ?>
                            <tr>
                                <td><?php echo $il['id_inventory']; ?></td>
                                <td><?php echo $il['name']; ?></td>
                                <td><?php echo "R$ ".number_format($il['price'],2,',','.'); ?></td>
                                <td>
                                    <?php if ($il['qtd'] < $il['qtd_min']) {
                                            echo "<span class='text text-danger'>".$il['qtd']."</span>";
                                        } else {
                                            echo $il['qtd'];
                                        }
                                    ?>                                    
                                </td>
                                <td><?php echo $il['qtd_min']; ?></td>
                                <td>
                                    <?php if ($permission_edit): ?>
                                        <a href="<?php echo BASE_URL; ?>/inventory/edit/<?php echo $il['id_inventory']; ?>" class="btn btn-success"><i class="fa fa-fw fa-pencil-square-o"></i></a>
                                        <a href="<?php echo BASE_URL; ?>/inventory/delete/<?php echo $il['id_inventory']; ?>" class="btn btn-danger" onclick="return confirm('Deseja remover o produto?')"><i class="fa fa-fw fa-minus-square"></i></a>
                                    <?php else: ?>
                                        <a href="<?php echo BASE_URL; ?>/inventory/view/<?php echo $il['id_inventory']; ?>" class="btn btn-primary"><i class="fa fa-fw fa-eye"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="box-footer">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="<?php echo ($p=='1')? 'disabled':''; ?>"><a href="<?php echo BASE_URL; ?>/inventory?p=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                                <?php for ($q=1; $q <= $p_count; $q++): ?>
                                <li class="<?php echo ($q==$p)? 'active':''; ?>"><a href="<?php echo BASE_URL; ?>/inventory?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
                                <?php endfor; ?>
                                <li class="<?php echo ($p==$p_count)? 'disabled':''; ?>"><a href="<?php echo BASE_URL; ?>/inventory?p=<?php echo $p_count; ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->