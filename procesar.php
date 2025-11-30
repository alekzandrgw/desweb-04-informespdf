<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$tipo = $_POST['tipo_doc'];

// --- Cálculo de totales
$sum_nosuj = array_sum($_POST['nosujeta']);
$sum_ex = array_sum($_POST['exenta']);
$sum_grav = array_sum($_POST['gravada']);

$iva = $sum_grav * 0.13;
$subtotal = $sum_nosuj + $sum_ex + $sum_grav + $iva;

$iva_ret = 0;
if ($tipo == "03" && $sum_grav >= 100) {
    $iva_ret = $sum_grav * 0.01;
}

$total = $subtotal - $iva_ret;

// Cargar plantilla
ob_start();
include "plantilla_factura.php";
$html = ob_get_clean();

// Configurar Dompdf
$options = new Options();
$options->set('defaultFont', 'Helvetica');

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("documento.pdf", ["Attachment" => false]);
