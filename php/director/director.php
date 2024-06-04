<?php
include('../conection.php'); // Incluir archivo de conexión a la base de datos

// Obtener el número de registros por tipo de trámite
$conn = connection();
$sql = "SELECT tipo_tramite, COUNT(*) as cantidad FROM formulario GROUP BY tipo_tramite";
$result_tipo_tramite = $conn->query($sql);
$conn->close();

// Procesar los datos para el gráfico de tipo de trámite
$labels_tipo_tramite = [];
$data_tipo_tramite = [];
while ($row = $result_tipo_tramite->fetch_assoc()) {
    $labels_tipo_tramite[] = $row['tipo_tramite'];
    $data_tipo_tramite[] = $row['cantidad'];
}

// Obtener el número de registros por año y mes
$conn = connection();
$sql = "SELECT YEAR(fecha_ingreso) AS anio, MONTH(fecha_ingreso) AS mes, COUNT(*) as cantidad FROM formulario GROUP BY YEAR(fecha_ingreso), MONTH(fecha_ingreso)";
$result_registros_mes = $conn->query($sql);
$conn->close();

// Procesar los datos para el gráfico de registros por mes
$labels_registros_mes = [];
$data_registros_mes = [];
while ($row = $result_registros_mes->fetch_assoc()) {
    $labels_registros_mes[] = $row['anio'] . "-" . str_pad($row['mes'], 2, '0', STR_PAD_LEFT); // Formato año-mes
    $data_registros_mes[] = $row['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de actividades</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Estilo para tarjetas más pequeñas */
        .card {
            margin-bottom: 20px;
        }

        /* Estilo para separar por color cada sección del gráfico */
        .tipo-tramite-chart .chartjs-render-monitor .chartjs-doughnut-legend ul li span {
            display: inline-block;
            width: 12px;
            height: 12px;
            margin-right: 5px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include('navbar.php') ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Gráfico de Tipo de Trámite
                    </div>
                    <div class="card-body tipo-tramite-chart">
                        <canvas id="grafico_tipo_tramite" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Gráfico de Registros por Año y Mes
                    </div>
                    <div class="card-body">
                        <canvas id="grafico_registros_mes" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Datos para el gráfico de Tipo de Trámite
        var datosTipoTramite = {
            labels: <?php echo json_encode($labels_tipo_tramite); ?>,
            datasets: [{
                label: 'Cantidad',
                data: <?php echo json_encode($data_tipo_tramite); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Configuración común para ambos gráficos
        var opciones = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Creación del gráfico de Tipo de Trámite
        var ctx1 = document.getElementById('grafico_tipo_tramite').getContext('2d');
        var graficoTipoTramite = new Chart(ctx1, {
            type: 'doughnut',
            data: datosTipoTramite,
            options: opciones
        });

        // Datos para el gráfico de Registros por Año y Mes
        var datosRegistrosMes = {
            labels: <?php echo json_encode($labels_registros_mes); ?>,
            datasets: [{
                label: 'Cantidad',
                data: <?php echo json_encode($data_registros_mes); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Creación del gráfico de Registros por Año y Mes
        var ctx2 = document.getElementById('grafico_registros_mes').getContext('2d');
        var graficoRegistrosMes = new Chart(ctx2, {
            type: 'line',
            data: datosRegistrosMes,
            options: opciones
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
