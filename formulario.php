<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Factura / CCF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
<div class="container mt-4">
    <h2 class="mb-3">Generación de Factura / CCF</h2>

    <form action="procesar.php" method="POST">

        <!-- Tipo de documento -->
        <div class="mb-3">
            <label class="form-label">Tipo de Documento</label>
            <select name="tipo_doc" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="01">01 - Factura (Consumidor Final)</option>
                <option value="03">03 - Comprobante de Crédito Fiscal</option>
            </select>
        </div>

        <h4 class="mt-4">Datos del Emisor</h4>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label>Nombre / Razón Social</label>
                <input type="text" name="emisor_nombre" class="form-control" required>
            </div>
            <div class="col-md-3 mb-2">
                <label>NIT</label>
                <input type="text" name="emisor_nit" class="form-control" required>
            </div>
            <div class="col-md-3 mb-2">
                <label>NRC</label>
                <input type="text" name="emisor_nrc" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-2">
                <label>Actividad Económica</label>
                <input type="text" name="emisor_actividad" class="form-control">
            </div>
            <div class="col-md-6 mb-2">
                <label>Dirección</label>
                <input type="text" name="emisor_direccion" class="form-control" required>
            </div>
        </div>

        <div class="row">
    <div class="col-md-3 mb-2">
        <label>Teléfono</label>
        <input type="text" name="emisor_tel" class="form-control">
    </div>
    <div class="col-md-3 mb-2">
        <label>Correo</label>
        <input type="email" name="emisor_correo" class="form-control">
    </div>
    <div class="col-md-3 mb-2">
        <label>Nombre Comercial</label>
        <input type="text" name="emisor_comercial" class="form-control">
    </div>
    <div class="col-md-3 mb-2">
        <label>Establecimiento</label>
        <input type="text" name="emisor_establecimiento" class="form-control">
    </div>
</div>

        <h4 class="mt-4">Datos del Cliente</h4>
        <div class="row">
            <div class="col-md-6 mb-2">
                <label>Nombre / Razón Social</label>
                <input type="text" name="cliente_nombre" class="form-control" required>
            </div>
            <div class="col-md-3 mb-2">
                <label>Documento (NIT o DUI)</label>
                <input type="text" name="cliente_doc" class="form-control" required>
            </div>
            <div class="col-md-3 mb-2">
                <label>Teléfono</label>
                <input type="text" name="cliente_tel" class="form-control">
            </div>
        </div>

        <h4 class="mt-4">Ítems de la Factura</h4>

        <table class="table table-bordered" id="tablaItems">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Cant.</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>No Sujeta</th>
                    <th>Exenta</th>
                    <th>Gravada</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <button type="button" class="btn btn-secondary" onclick="agregarItem()">Agregar Ítem</button>

        <br><br>
        <button class="btn btn-primary">Generar PDF</button>

    </form>
</div>

<script>
let contador = 1;

function agregarItem() {
    const tabla = document.querySelector('#tablaItems tbody');
    let row = `
        <tr>
            <td>${contador}</td>
            <td><input type="number" name="cantidad[]" step="0.01" class="form-control" required></td>
            <td><input type="text" name="codigo[]" class="form-control"></td>
            <td><input type="text" name="descripcion[]" class="form-control" required></td>
            <td><input type="number" name="precio[]" step="0.01" class="form-control" required></td>

            <td><input type="number" name="nosujeta[]" step="0.01" class="form-control categoria"></td>
            <td><input type="number" name="exenta[]" step="0.01" class="form-control categoria"></td>
            <td><input type="number" name="gravada[]" step="0.01" class="form-control categoria"></td>
        </tr>
    `;

    tabla.insertAdjacentHTML('beforeend', row);
    contador++;

    // Evitar que pongan valores en más de una categoría
    document.querySelectorAll('.categoria').forEach(input => {
        input.addEventListener('input', function () {
            let tr = this.closest('tr');
            tr.querySelectorAll('.categoria').forEach(c => {
                if (c !== this) c.value = "";
            });
        });
    });
}
</script>

</body>
</html>
