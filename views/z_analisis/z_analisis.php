<?php 
require "../../controllers/controlador_inicio_1.php";

require_once __DIR__ . '/../../models/Base_de_datos.php';
$base_de_datos = new Base_de_datos();
$pacientes_fuman = $base_de_datos->select_all("vista_pacientes_fuman_sin_cancer_pulmon", "*", false);
$pacientes_cancer = $base_de_datos->select_all("vista_pacientes_con_cancer_pulmon", "*");
$frecuencia_fumar = [];
$cancer_pulmon = [];

foreach ($pacientes_fuman as $paciente) {
    $cancer_pulmon[] = 0;
    $frecuencia_fumar[] = $paciente['frecuencia_fuma'];
}
foreach ($pacientes_cancer as $paciente) {
    $cancer_pulmon[] = 1;
    $frecuencia_fumar[] = $paciente['frecuencia_fuma'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./public/group-1686550876.svg" type="image/svg+xml">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../index.css" />

    <!-- Font Imports -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains Mono:wght@300;400;500;600;700&display=swap" />
    <!-- script de SweetAlert2 -->
    <script src="https://unpkg.com/sweetalert2@9.5.3/dist/sweetalert2.all.min.js"></script>

    <!-- Core Style -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Icons -->
    <link rel="stylesheet" href="css/font-icons.css">

    <!-- Plugins/Components CSS -->
    <link rel="stylesheet" href="css/components/bs-datatable.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Document Title
    ============================================= -->
    <title>Salvavidas | Correlación Lineal</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="stretched" data-menu-breakpoint="1200">
    <div id="loader_corazon" class="loader_corazon"></div>
        <div class="desktop bg-gradient-to-br from-orange-500 to-orange-700">
	        <div id="wrapper" class="bg-gradient-to-br from-orange-500 to-orange-700">
	
	            <section id="content" class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-3xl shadow-lg p-8 max-w-2xl w-full mx-auto">
			
                    <h1 class="aplicacion-salvavidas animate-pulse" style="font-size: 20px">Gráfico de Correlación Lineal</h1>
                    <p>Frecuencia de fumar por semana y presencia de cáncer de pulmón.</p>
                    <canvas id="scatterChart" width="400" height="400"></canvas>

                    <script>
                        // Frecuencia de fumar por semana y presencia de cáncer de pulmón
                        const frecuencia_fumar = <?php echo json_encode($frecuencia_fumar); ?>;
                        const cancer_pulmon = <?php echo json_encode($cancer_pulmon); ?>;
                        
                        // Calcular el coeficiente de correlación lineal
                        const media_fumar = frecuencia_fumar.reduce((a, b) => a + b, 0) / frecuencia_fumar.length;
                        const media_cancer = cancer_pulmon.reduce((a, b) => a + b, 0) / cancer_pulmon.length;

                        let covarianza = 0;
                        for (let i = 0; i < frecuencia_fumar.length; i++) {
                            covarianza += (frecuencia_fumar[i] - media_fumar) * (cancer_pulmon[i] - media_cancer);
                        }
                        covarianza /= frecuencia_fumar.length;

                        const varianza_fumar = frecuencia_fumar.reduce((a, b) => a + Math.pow(b - media_fumar, 2), 0) / frecuencia_fumar.length;

                        const pendiente = covarianza / varianza_fumar;

                        console.log("Pendiente (Coeficiente de correlación lineal):", pendiente);

                        // Crear un gráfico de dispersión
                        const scatterChart = new Chart(document.getElementById('scatterChart'), {
                            type: 'scatter',
                            data: {
                                datasets: [{
                                    label: 'Fumar vs. Cáncer de Pulmón',
                                    data: frecuencia_fumar.map((value, index) => ({ x: value, y: cancer_pulmon[index] })),
                                    backgroundColor: 'rgba(75, 192, 192, 0.5)'
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        type: 'linear',
                                        position: 'bottom',
                                        title: {
                                            display: true,
                                            text: 'Frecuencia de fumar por semana',
                                            font: {
                                                weight: 'bold' // Hacer el texto de la etiqueta en negrita
                                            }
                                        }
                                    },
                                    y: {
                                        type: 'linear',
                                        title: {
                                            display: true,
                                            text: 'Presencia de cáncer de pulmón (0 = No, 1 = Sí)',
                                            font: {
                                                weight: 'bold' // Hacer el texto de la etiqueta en negrita
                                            }
                                        }
                                    }
                                }
                            }
                        });

                        // Agregar la línea de regresión lineal al gráfico
                        const xValues = frecuencia_fumar;
                        const yValues = cancer_pulmon;
                        const x_mean = xValues.reduce((a, b) => a + b) / xValues.length;
                        const y_mean = yValues.reduce((a, b) => a + b) / yValues.length;

                        let numerator = 0;
                        let denominator = 0;
                        for (let i = 0; i < xValues.length; i++) {
                            numerator += (xValues[i] - x_mean) * (yValues[i] - y_mean);
                            denominator += (xValues[i] - x_mean) ** 2;
                        }
                        const slope = numerator / denominator;
                        const intercept = y_mean - slope * x_mean;

                        scatterChart.data.datasets.push({
                            label: 'Línea de Regresión Lineal',
                            type: 'line',
                            data: [
                                { x: Math.min(...xValues), y: slope * Math.min(...xValues) + intercept },
                                { x: Math.max(...xValues), y: slope * Math.max(...xValues) + intercept }
                            ],
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            fill: false
                        });

                        scatterChart.update();
                    </script>
                </section>
            </div>
            
        </div>
    <script>
        // Muestra el loader cuando la página empieza a cargarse
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("loader_corazon").style.display = "block";
        });
        // Oculta el loader cuando la carga de la página se completa
        window.addEventListener("load", function() {
            document.getElementById("loader_corazon").style.display = "none";
        });
	
    </script>
</body>
</html>
