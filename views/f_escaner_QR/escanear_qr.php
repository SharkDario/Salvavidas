<?php
require "../../controllers/controlador_inicio_1.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="../index.css" />
<link rel="icon" href="./public/group-1686550876.svg">
<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=JetBrains Mono:wght@400&display=swap"
/>
<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap"
/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<title>Salvavidas | Escanear QR</title>
<style>
    #escaner {
        width: 60%;
        height: auto;
        border: 8px solid black;
        border-radius: 10px;
        margin: 0 auto;
    }
    @keyframes parpadeo {
        0% { border-color: black; }
        50% { border-color: red; }
        100% { border-color: black; }
    }
    .parpadeo {
        animation: parpadeo 1s infinite;
    }
    #mensaje {
        text-align: center;
        font-size: 1.2em;
        color: red;
        display: none;
    }
</style>
</head>
<body class="stretched" data-menu-breakpoint="1200">
<div id="loader_corazon" class="loader_corazon"></div>
<div class="desktop bg-gradient-to-br from-orange-500 to-orange-700">
    <div class="bg-gradient-to-br from-orange-300 to-orange-500 rounded-3xl shadow-lg p-8 max-w-6xl w-full mx-auto">
        <h1 class="aplicacion-salvavidas animate-pulse">Escanear QR</h1>
        <video id="escaner"></video>
        <div id="mensaje">No se ha detectado ningún código QR</div>

        <script>
            // Obtener los elementos del video y el mensaje
            const video = document.getElementById('escaner');
            const mensaje = document.getElementById('mensaje');

            // Función para escanear el código QR
            function escanearCodigoQR() {
                navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
                    .then(function (stream) {
                        video.srcObject = stream;
                        video.play();
                        requestAnimationFrame(escanear);
                    })
                    .catch(function (error) {
                        console.error('Error al acceder a la cámara: ', error);
                    });
            }

            // Función para escanear continuamente
            function escanear() {
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                try {
                    const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                    const codigoQR = jsQR(imageData.data, canvas.width, canvas.height);
                    if (codigoQR) {
                        window.location.href = codigoQR.data;
                    } else {
                        // Mostrar borde parpadeante y mensaje si no se detecta un código QR
                        video.classList.add('parpadeo');
                        mensaje.style.display = 'block';
                        requestAnimationFrame(escanear); // Continuar escaneando
                    }
                } catch (error) {
                    console.error('Error al escanear el código QR: ', error);
                    requestAnimationFrame(escanear); // Continuar escaneando
                }
            }

            // Ejecutar la función para escanear el código QR
            escanearCodigoQR();
        </script>

        <!-- Incluir la biblioteca jsQR -->
        <script src="https://cdn.jsdelivr.net/npm/jsqr@1.0.0/dist/jsQR.js"></script>
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