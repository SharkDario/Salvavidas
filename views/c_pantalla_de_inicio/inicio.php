<?php
require "../../controllers/controlador_inicio_1.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="./public/group-1686550876.svg">
    <link rel="stylesheet" href="../index.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=JetBrains Mono:wght@400&display=swap"
    />
    <title>Salvavidas | Inicio</title>
  </head>
  <body>
      
      <div class="desktop bg-gradient-to-br from-orange-300 to-orange-500">
          <section class="aplicacion-salvavidas-parent">
              <h1 class="aplicacion-salvavidas animate-pulse">
                  Salvavidas
              </h1>
              <?php
              if ($usuario->get_sexo() == "hombre") {
                  ?>
              <h2 class="bienvenido">¡Bienvenido <?php echo $usuario->get_nombre_completo(); ?>!</h2>
              <?php
              } else {
                  ?>
              <h2 class="bienvenido">¡Bienvenida <?php echo $usuario->get_nombre_completo(); ?>!</h2>
              <?php
              }
              ?>
          </section>
          <form action="../../controllers/controlador_inicio_2.php" method="post">
              <input type="hidden" id="nombre_usuario" name="nombre_usuario" value="<?php $usu_usuario?>">
              <input type="hidden" id="usuario_objeto" name="usuario_objeto" value="<?php $usuario?>">
              <input type="hidden" id="usuario_puesto" name="usuario_puesto" value="<?php $puesto_usuario?>">
            
            <div class="desktop-inner">
              <button class="button_1" id="escanear_qr" name="escanear_qr" type="submit">
                  <span class="span_1">ESCANEAR QR</span>
              </button>
            </div>
            
            <div class="desktop-inner">
                <button class="button_1" id="lista_pacientes" name="lista_pacientes" type="submit">
                    <span class="span_1">LISTA DE PACIENTES</span>
                </button>
            </div>
            
            <?php
            if ($puesto_usuario['puesto'] == "Médico") {
            ?>
            <div class="desktop-inner">
                <button class="button_1" id="registrar_paciente" name="registrar_paciente" type="submit">
                    <span class="span_1">REGISTRAR PACIENTE</span>
                </button>
            </div>
            
            <div class="desktop-inner">
                <button class="button_1" id="lista_epicrisis" name="lista_epicrisis" type="submit">
                    <span class="span_1">LISTA DE EPICRISIS</span>
                </button>
            </div>

            <div class="desktop-inner">
                <button class="button_1" id="analisis" name="analisis" type="submit">
                    <span class="span_1">ANÁLISIS DE DATOS</span>
                </button>
            </div>
            
            <?php
            } else {
                ?>
            
            <div class="desktop-inner">
                <button class="button_1" id="agregar_seguimiento" name="agregar_seguimiento" type="submit">
                    <span class="span_1">AGREGAR SEGUIMIENTO</span>
                </button>
            </div>
            
            <?php
            }
            ?>
          </form>
      </div>
  </body>
</html>
