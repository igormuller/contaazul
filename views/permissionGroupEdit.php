<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Permissões
            <small>Editar Grupo de Permissões</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/permission"><i class="fa fa-gears"></i> Permissões</a></li>
            <li class="active"><i class="fa fa-pencil"></i> Editar</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form method="POST">
                        <div class="box-header">
                            <h3 class="box-title">Editar Grupo de Permissões</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Grupo de Permissões:</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $group_info['name']; ?>" />
                            </div>
                            <label>Permissões:</label>
                            <div class="form-group">
                                <?php $pgroup = explode(',', $group_info['params']);
                                foreach ($permission_list as $p): ?>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="permissions[]" value="<?php echo $p['id_permission_param']; ?>" <?php echo (in_array($p['id_permission_param'], $pgroup))? "checked":""; ?> /><?php echo $p['name']; ?>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" value="Salvar" class="btn btn-primary"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>       
    </section>
</div>