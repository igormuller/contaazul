<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Compras
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><i class="fa fa-download"></i> Compras</li>
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
                                    <p><a href="<?php echo BASE_URL; ?>/purchase/add" class="btn btn-success" data-toggle="modal">Adicionar Compra</a></p>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="busca" class="form-control" placeholder="Procurar..." data-type="search_purchase" />
                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="<?php echo ($p=='1')? 'disabled':''; ?>"><a href="<?php echo BASE_URL; ?>/purchases?p=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                                <?php for ($q=1; $q <= $p_count; $q++): ?>
                                    <li class="<?php echo ($q==$p)? 'active':''; ?>"><a href="<?php echo BASE_URL; ?>/purchases?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
                                <?php endfor; ?>
                                <li class="<?php echo ($p==$p_count)? 'disabled':''; ?>"><a href="<?php echo BASE_URL; ?>/purchases?p=<?php echo $p_count; ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
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