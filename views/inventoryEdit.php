<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Produto
            <small>Editar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/inventory"><i class="fa fa-download"></i> Estoque</a></li>
            <li class="active"><i class="fa fa-plus"></i> Editar</li>
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
                        <div class="box-header">
                            <h3 class="box-title">Editar produto</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nome: </label>
                                <input type="text" name="name" class="form-control" value="<?php echo $inventory_info['name']; ?>" required />
                            </div>
                            <div class="form-group">
                                <label>Preço: </label>
                                <input type="text" name="price" class="form-control money" value="<?php echo $inventory_info['price']; ?>" required />
                            </div>
                            <div class="form-group">
                                <label>Quantidade: </label>
                                <input type="number" name="qtd" class="form-control" value="<?php echo $inventory_info['qtd']; ?>" required />
                            </div>
                            <div class="form-group">
                                <label>Quantidade Mínima: </label>
                                <input type="number" name="qtd_min" class="form-control" value="<?php echo $inventory_info['qtd_min']; ?>" required />
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

