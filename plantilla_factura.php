<?php
$fecha = date("d/m/Y");

// Colores corporativos (puedes cambiarlos)
$colorPrimario = "#2C3E50";
$colorSecundario = "#1ABC9C";
$colorGris = "#7F8C8D";
?>

<style>
body {
    font-family: 'Helvetica', Arial, sans-serif;
    font-size: 12px;
    color: #2c3e50;
    margin: 0;
    padding: 0;
}

.contenedor {
    padding: 20px 25px;
}

.encabezado {
    background: <?= $colorPrimario ?>;
    color: white;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    margin-bottom: 20px;
}

.encabezado h1 {
    margin: 0;
    font-size: 22px;
    font-weight: bold;
}

.section-titulo {
    font-size: 14px;
    color: <?= $colorPrimario ?>;
    margin-top: 20px;
    margin-bottom: 5px;
    font-weight: bold;
    border-left: 4px solid <?= $colorSecundario ?>;
    padding-left: 6px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 8px;
    font-size: 11px;
}

.table th {
    background: <?= $colorPrimario ?>;
    color: white;
    padding: 6px;
    text-align: center;
    font-weight: bold;
}

.table td {
    border-bottom: 1px solid #dcdcdc;
    padding: 6px;
}

.fila-pares {
    background: #f8f8f8;
}

.totales-container {
    margin-top: 20px;
    width: 50%;
    float: right;
}

.totales-container table {
    width: 100%;
    border-collapse: collapse;
}

.totales-container td {
    padding: 6px;
    font-size: 12px;
}

.totales-container tr td:nth-child(1) {
    color: <?= $colorPrimario ?>;
    font-weight: bold;
}

.total-final {
    background: <?= $colorSecundario ?>;
    color: white;
    font-weight: bold;
    padding: 8px;
    border-radius: 6px;
    text-align: right;
    font-size: 14px;
    margin-top: 10px;
}

.footer {
    margin-top: 60px;
    text-align: center;
    font-size: 10px;
    color: <?= $colorGris ?>;
}
</style>

<div class="contenedor">

    <div class="encabezado">
        <h1><?= ($tipo == "01") ? "FACTURA" : "COMPROBANTE DE CRÉDITO FISCAL" ?></h1>
        <p style="font-size: 12px; margin-top: 4px;">
            Fecha: <?= $fecha ?>
        </p>
    </div>

<!-- Datos del Emisor -->
<div>
    <div class="section-titulo">Datos del Emisor</div>
    <table style="width: 100%; font-size: 12px;">
        <tr>
            <td><strong>Nombre / Razón Social:</strong> <?= $_POST['emisor_nombre'] ?></td>
            <td><strong>Nombre Comercial:</strong> <?= $_POST['emisor_comercial'] ?></td>
        </tr>
        <tr>
            <td><strong>NIT:</strong> <?= $_POST['emisor_nit'] ?></td>
            <td><strong>NRC:</strong> <?= $_POST['emisor_nrc'] ?></td>
        </tr>
        <tr>
            <td><strong>Actividad Económica:</strong> <?= $_POST['emisor_actividad'] ?></td>
            <td><strong>Establecimiento:</strong> <?= $_POST['emisor_establecimiento'] ?></td>
        </tr>
        <tr>
            <td><strong>Dirección:</strong> <?= $_POST['emisor_direccion'] ?></td>
            <td><strong>Teléfono:</strong> <?= $_POST['emisor_tel'] ?></td>
        </tr>
        <tr>
            <td><strong>Correo:</strong> <?= $_POST['emisor_correo'] ?></td>
            <td></td>
        </tr>
    </table>
</div>


    <!-- Datos del Cliente -->
    <div>
        <div class="section-titulo">Datos del Cliente</div>
        <table style="width: 100%; font-size: 12px;">
            <tr>
                <td><strong>Nombre:</strong> <?= $_POST['cliente_nombre'] ?></td>
                <td><strong>Documento:</strong> <?= $_POST['cliente_doc'] ?></td>
            </tr>
            <tr>
                <td><strong>Teléfono:</strong> <?= $_POST['cliente_tel'] ?></td>
                <td></td>
            </tr>
        </table>
    </div>

    <!-- Detalle -->
    <div class="section-titulo">Detalle de Productos o Servicios</div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Cant</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>No Sujeta</th>
                <th>Exenta</th>
                <th>Gravada</th>
            </tr>
        </thead>

        <tbody>

        <?php for ($i = 0; $i < count($_POST['descripcion']); $i++): ?>
        <tr class="<?= $i % 2 == 0 ? 'fila-pares' : '' ?>">
            <td style="text-align:center;"><?= $i+1 ?></td>
            <td style="text-align:center;"><?= $_POST['cantidad'][$i] ?></td>
            <td style="text-align:center;"><?= $_POST['codigo'][$i] ?></td>
            <td><?= $_POST['descripcion'][$i] ?></td>
            <td style="text-align:right;">$<?= number_format($_POST['nosujeta'][$i] ?: 0, 2) ?></td>
            <td style="text-align:right;">$<?= number_format($_POST['exenta'][$i] ?: 0, 2) ?></td>
            <td style="text-align:right;">$<?= number_format($_POST['gravada'][$i] ?: 0, 2) ?></td>
        </tr>
        <?php endfor; ?>

        </tbody>
    </table>

    <!-- Totales -->
    <div class="totales-container">
        <table>
            <tr>
                <td>Total No Sujeta:</td>
                <td style="text-align:right;">$<?= number_format($sum_nosuj, 2) ?></td>
            </tr>
            <tr>
                <td>Total Exenta:</td>
                <td style="text-align:right;">$<?= number_format($sum_ex, 2) ?></td>
            </tr>
            <tr>
                <td>Total Gravada:</td>
                <td style="text-align:right;">$<?= number_format($sum_grav, 2) ?></td>
            </tr>
            <tr>
                <td>IVA (13%):</td>
                <td style="text-align:right;">$<?= number_format($iva, 2) ?></td>
            </tr>
            <tr>
                <td>Subtotal:</td>
                <td style="text-align:right;">$<?= number_format($subtotal, 2) ?></td>
            </tr>

            <?php if ($tipo == "03"): ?>
            <tr>
                <td>IVA Retenido (1%):</td>
                <td style="text-align:right;">$<?= number_format($iva_ret, 2) ?></td>
            </tr>
            <?php endif; ?>
        </table>

        <div class="total-final">
            TOTAL GENERAL: $<?= number_format($total, 2) ?>
        </div>
    </div>

    <div style="clear: both;"></div>

    <div class="footer">
        Documento generado automáticamente con DOMPDF — Desarrollo Web II
    </div>
</div>
