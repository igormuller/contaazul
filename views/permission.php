<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Permissões
            <small>Página de controle das Permissões dos Usuários</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><i class="fa fa-gears"></i> Permissões</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Grupo de permissões</a></li>
                <li><a href="#tab2" data-toggle="tab" aria-expanded="true">Permissões</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Grupo de Permissões</h3>
                        </div>
                        <div class="box-body">
                            <p><a href="<?php echo BASE_URL; ?>/permission/addPermissionGroup" class="btn btn-success" data-toggle="modal">Adicionar Grupo de Permissões</a></p>
                            <table class="table table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>Nome do Grupo</th>
                                    <th>Permissões</th>
                                    <th>Ação</th>
                                </tr>
                                <?php foreach ($permission_group_list as $pg): ?>
                                <tr>
                                    <td><?php echo $pg['id_permission_group']; ?></td>
                                    <td><?php echo $pg['name']; ?></td>
                                    <td><?php echo $pg['params']; ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>/permission/editPermissionGroup/<?php echo $pg['id_permission_group']; ?>" class="btn btn-success"><i class="fa fa-fw fa-pencil-square-o"></i></a>
                                        <a href="<?php echo BASE_URL; ?>/permission/deletePermissionGroup/<?php echo $pg['id_permission_group']; ?>" class="btn btn-danger" onclick="return confirm('Deseja remover o grupo de permissões?')"><i class="fa fa-fw fa-minus-square"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab2">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Permissões</h3>
                        </div>
                        <div class="box-body">
                            <p><a href="#modalAddPermission" class="btn btn-success" data-toggle="modal">Adicionar Permissão</a></p>
                            <table class="table table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>Permissão</th>
                                    <th>Ação</th>
                                </tr>
                                <?php foreach ($permission_list as $p): ?>
                                <tr>
                                    <td><?php echo $p['id_permission_param']; ?></td>
                                    <td><?php echo $p['name']; ?></td>
                                    <td>
                                        <a href="#modalEditPermission<?php echo $p['id_permission_param']; ?>" class="btn btn-success" data-toggle="modal"><i class="fa fa-fw fa-pencil-square-o"></i></a>
                                        <a href="<?php echo BASE_URL; ?>/permission/deletePermission/<?php echo $p['id_permission_param']; ?>" class="btn btn-danger" onclick="return confirm('Deseja remover a permissão?')"><i class="fa fa-fw fa-minus-square"></i></a>
                                    </td>
                                    <!--**************Modal Editar**************-->
                                    <div class="modal fade" id="modalEditPermission<?php echo $p['id_permission_param']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">x</span></button>
                                                        <h3 class="modal-title">Editar Permissão</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id_permission_param" value="<?php echo $p['id_permission_param']; ?>" />
                                                            <label>Permissão:</label>
                                                            <input type="text" name="permission_edit" value="<?php echo $p['name']; ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                                                        <input type="submit" value="Salvar" class="btn btn-primary" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--**************Fim Modal Editar**************-->
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Modal Adicionar Permissao -->
<div class="modal fade" id="modalAddPermission">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">x</span></button>
                    <h3 class="modal-title">Adicionar Permissão</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Permissão:</label>
                        <input type="text" name="permission_add" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                    <input type="submit" value="Salvar" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>
