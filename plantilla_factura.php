<?php
$fecha = date("d/m/Y");

// Colores corporativos
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
    width: 10
