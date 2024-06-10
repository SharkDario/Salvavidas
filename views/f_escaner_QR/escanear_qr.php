<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../index.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=JetBrains Mono:wght@400&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="assets/plugins/qrCode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    </style>
    <title>Salvavidas | Escanear QR</title>
  </head>
  <body class="stretched" data-menu-breakpoint="1200" >
      <div class="desktop bg-gradient-to-br from-orange-500 to-orange-700">
        <div class="bg-gradient-to-br from-orange-300 to-orange-500 rounded-3xl shadow-lg p-8 max-w-6xl w-full mx-auto">
          <h1 class="aplicacion-salvavidas animate-pulse">Escanear QR</h1>
            <div class="centered_1">
              <a id="btn-scan-qr" href="#"></a>
              <canvas id="qr-canvas" class="img-fluid"></canvas>
            </div>
        </div>
      </div>
      <script src="assets/js/index.js"></script>

  </body>
</html>
