<?php
$fecha = date("d/m/Y");
?>

<style>
body { font-family: Arial; font-size: 12px; }
.table { width: 100%; border-collapse: collapse; }
.table th, .table td { border: 1px solid #000; padding: 4px; }
.encabezado { text-align: center; margin-bottom: 15px; }
</style>

<h2 class="encabezado">
    <?= ($tipo == "01") ? "FACTURA" : "COMPROBANTE DE CRÉDITO FISCAL" ?>
</h2>

<p><strong>Fecha:</strong> <?= $fecha ?></p>

<h3>Datos del Emisor</h3>
<p>
<strong>Nombre:</strong> <?= $_POST['emisor_nombre'] ?><br>
<strong>NIT:</strong> <?= $_POST['emisor_nit'] ?><br>
<strong>NRC:</strong> <?= $_POST['emisor_nrc'] ?><br>
<strong>Dirección:</strong> <?= $_POST['emisor_direccion'] ?><br>
</p>

<h3>Datos del Cliente</h3>
<p>
<strong>Nombre:</strong> <?= $_POST['cliente_nombre'] ?><br>
<strong>Documento:</strong> <?= $_POST['cliente_doc'] ?><br>
<strong>Teléfono:</strong> <?= $_POST['cliente_tel'] ?><br>
</p>

<h3>Detalle</h3>

<table class="table">
<thead>
<tr>
    <th>#</th><th>Cant</th><th>Código</th><th>Descripción</th>
    <th>No Sujeta</th><th>Exenta</th><th>Gravada</th>
</tr>
</thead>
<tbody>

<?php for ($i = 0; $i < count($_POST['descripcion']); $i++): ?>
<tr>
    <td><?= $i+1 ?></td>
    <td><?= $_POST['cantidad'][$i] ?></td>
    <td><?= $_POST['codigo'][$i] ?></td>
    <td><?= $_POST['descripcion'][$i] ?></td>
    <td><?= $_POST['nosujeta'][$i] ?></td>
    <td><?= $_POST['exenta'][$i] ?></td>
    <td><?= $_POST['gravada'][$i] ?></td>
</tr>
<?php endfor; ?>

</tbody>
</table>

<h3>Totales</h3>

<p>
<strong>Suma No Sujeta:</strong> $<?= number_format($sum_nosuj, 2) ?><br>
<strong>Suma Exenta:</strong> $<?= number_format($sum_ex, 2) ?><br>
<strong>Suma Gravada:</strong> $<?= number_format($sum_grav, 2) ?><br>
<strong>IVA (13%):</strong> $<?= number_format($iva, 2) ?><br>
<strong>Subtotal:</strong> $<?= number_format($subtotal, 2) ?><br>

<?php if ($tipo == "03"): ?>
<strong>IVA Retenido (1%):</strong> $<?= number_format($iva_ret, 2) ?><br>
<?php endif; ?>

<strong>TOTAL GENERAL:</strong> $<?= number_format($total, 2) ?>
</p>
