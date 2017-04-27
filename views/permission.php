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
                <div class="tab-pane active" id="tab1">Grupos</div>
                <div class="tab-pane" id="tab2">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Permissões</h3>
                        </div>
                        <div class="box-body">
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