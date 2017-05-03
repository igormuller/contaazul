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
                    <div class="box-header">
                        <h3 class="box-title">Clientes</h3>
                    </div>
                    <div class="box-body">
                        <?php if ($permission_edit): ?>
                        <p><a href="<?php echo BASE_URL; ?>/client/add" class="btn btn-success" data-toggle="modal">Adicionar Cliente</a></p>
                        <?php endif; ?>
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
                                        <a href="<?php echo BASE_URL; ?>/client/edit/<?php echo $c['id_user']; ?>" class="btn btn-success"><i class="fa fa-fw fa-pencil-square-o"></i></a>
                                        <a href="<?php echo BASE_URL; ?>/client/delete/<?php echo $c['id_user']; ?>" class="btn btn-danger" onclick="return confirm('Deseja remover o usuário?')"><i class="fa fa-fw fa-minus-square"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="box-footer">
                        footer
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->