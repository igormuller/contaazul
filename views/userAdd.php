<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuário
            <small>Adicionar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/user"><i class="fa fa-user"></i> Usuários</a></li>
            <li class="active"><i class="fa fa-user-plus"></i> Adicionar</li>
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
                    <form method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nome: </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>E-mail: </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="email" name="email" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Senha: </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="password" name="password" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Grupo de Permissões: </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="id_group" class="form-control">
                                            <option value="0">Selecione...</option>
                                            <?php foreach ($group_list as $gl): ?>
                                            <option value="<?php echo $gl['id_permission_group']; ?>"><?php echo $gl['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" value="Salvar" class="btn btn-success" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->