<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Clientes
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><i class="fa fa-street-view"></i> Clientes</li>
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
                                <?php if ($permission_edit): ?>
                                <p><a href="<?php echo BASE_URL; ?>/client/add" class="btn btn-success" data-toggle="modal">Adicionar Cliente</a></p>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="search_client" class="form-control" placeholder="Procurar..." data-type="search_client" />
                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Cidade</th>
                                <th>Estrelas</th>
                                <th>Ações</th>
                            </tr>
                            <?php foreach ($client_list as $c): ?>
                                <tr>
                                    <td><?php echo $c['id_client']; ?></td>
                                    <td><?php echo $c['name']; ?></td>
                                    <td><?php echo $c['phone']; ?></td>
                                    <td><?php echo $c['address_city']; ?></td>
                                    <td><?php echo $c['stars']; ?></td>
                                    <td>
                                        <?php if ($permission_edit): ?>
                                            <a href="<?php echo BASE_URL; ?>/client/edit/<?php echo $c['id_client']; ?>" class="btn btn-success"><i class="fa fa-fw fa-pencil-square-o"></i></a>
                                            <a href="<?php echo BASE_URL; ?>/client/delete/<?php echo $c['id_client']; ?>" class="btn btn-danger" onclick="return confirm('Deseja remover o cliente?')"><i class="fa fa-fw fa-minus-square"></i></a>
                                        <?php else: ?>
                                            <a href="<?php echo BASE_URL; ?>/client/view/<?php echo $c['id_client']; ?>" class="btn btn-primary"><i class="fa fa-fw fa-eye"></i></a>
                                        <?php endif; ?>


                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="box-footer">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="<?php echo ($p=='1')? 'disabled':''; ?>"><a href="<?php echo BASE_URL; ?>/client/?p=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                                <?php for ($q=1; $q <= $p_count; $q++): ?>
                                <li class="<?php echo ($q==$p)? 'active':''; ?>"><a href="<?php echo BASE_URL; ?>/client?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
                                <?php endfor; ?>
                                <li class="<?php echo ($p==$p_count)? 'disabled':''; ?>"><a href="<?php echo BASE_URL; ?>/client?p=<?php echo $p_count; ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
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
<script src="<?php echo BASE_URL; ?>/assets/js/script_client.js"></script>