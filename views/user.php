<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuários
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><i class="fa fa-user"></i> Usuários</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <p><a href="<?php echo BASE_URL; ?>/user/add" class="btn btn-success" data-toggle="modal">Adicionar Usuário</a></p>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Grupo</th>
                                <th>Ações</th>
                            </tr>
                            <?php foreach ($user_list as $u): ?>
                            <tr>
                                <td><?php echo $u['id_user']; ?></td>
                                <td><?php echo $u['image']; ?></td>
                                <td><?php echo $u['name']; ?></td>
                                <td><?php echo $u['email']; ?></td>
                                <td><?php echo $u['name_group']; ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/user/edit/<?php echo $u['id_user']; ?>" class="btn btn-success"><i class="fa fa-fw fa-pencil-square-o"></i></a>
                                    <a href="<?php echo BASE_URL; ?>/user/delete/<?php echo $u['id_user']; ?>" class="btn btn-danger" onclick="return confirm('Deseja remover o usuário?')"><i class="fa fa-fw fa-minus-square"></i></a>
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