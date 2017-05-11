<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Clientes
            <small>Editar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/client"><i class="fa fa-street-view"></i> Clientes</a></li>
            <li class="active"><i class="fa fa-pencil"></i> Editar</li>
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
                                <input type="text" name="name" class="form-control" value="<?php echo $client_info['name']; ?>" autofocus required />
                            </div>
                            <div class="form-group">
                                <label>E-mail: </label>
                                <input type="email" name="email" class="form-control" value="<?php echo $client_info['email']; ?>" />
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Telefone: </label>
                                        <input type="text" name="phone" class="form-control phone" value="<?php echo $client_info['phone']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>CEP: </label>
                                        <input type="text" name="address_zipcode" class="form-control zipcode" value="<?php echo $client_info['address_zipcode']; ?>" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Endereço: </label>
                                        <input type="text" name="address" class="form-control" value="<?php echo $client_info['address']; ?>" />
                                    </div>
                                    <div class="col-md-1">
                                        <label>Nº: </label>
                                        <input type="text" name="address_number" class="form-control" value="<?php echo $client_info['address_number']; ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Complemento: </label>
                                        <input type="text" name="address_comp" class="form-control" value="<?php echo $client_info['address_comp']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Bairro: </label>
                                        <input type="text" name="address_neigh" class="form-control" value="<?php echo $client_info['address_neigh']; ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Cidade: </label>
                                        <input type="text" name="address_city" class="form-control" value="<?php echo $client_info['address_city']; ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Estado: </label>
                                        <input type="text" name="address_state" class="form-control" value="<?php echo $client_info['address_state']; ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Pais: </label>
                                        <input type="text" name="address_country" class="form-control" value="<?php echo $client_info['address_country']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Estrelas: </label>
                                <select name="stars" class="form-control">
                                    <option value="1" <?php echo ($client_info['stars']==='1')? "selected":""; ?>>1 Estrela</option>
                                    <option value="2" <?php echo ($client_info['stars']==='2')? "selected":""; ?>>2 Estrela</option>
                                    <option value="3" <?php echo ($client_info['stars']==='3')? "selected":""; ?>>3 Estrela</option>
                                    <option value="4" <?php echo ($client_info['stars']==='4')? "selected":""; ?>>4 Estrela</option>
                                    <option value="5" <?php echo ($client_info['stars']==='5')? "selected":""; ?>>5 Estrela</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Observações:</label>
                                <textarea class="form-control" rows="3" name="internal_obs"><?php echo $client_info['internal_obs']; ?></textarea>
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