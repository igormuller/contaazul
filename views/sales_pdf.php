<h1>Relatório de Vendas</h1>
<fieldset>
    <?php
    if (isset($filters['client_name']) && !empty($filters['client_name'])) {
        echo "<strong>Filtrado pelo cliente:</strong> ".$filters['client_name']."<br/>";
    }
    if (isset($filters['period1']) && !empty($filters['period1'])) {
        echo "<strong>No período:</strong> ".$filters['period1']." até ".$filters['period2']."<br/>";
    }
    if (isset($filters['status']) && !empty($filters['status'])) {
        echo "<strong>Com status:</strong> ".$statuses[$filters['status']]."<br/>";
    }
    ?>
</fieldset>
<table>
    <tr>
        <th>#</th>
        <th>Cliente</th>
        <th>Data Venda</th>
        <th>Status</th>
        <th>Total</th>
    </tr>
    <?php foreach ($sale_list as $sitem): ?>
        <tr>
            <td><?php echo $sitem['id_sale']; ?></td>
            <td><?php echo $sitem['name']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($sitem['date_sale'])); ?></td>
            <td><?php echo $statuses[$sitem['status']]; ?></td>
            <td>R$ <?php echo number_format($sitem['total_price'],2,',','.'); ?></td>
        </tr>
    <?php endforeach; ?>
</table>