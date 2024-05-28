<!DOCTYPE html>
<html dir="ltr" lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="icon" href="./public/group-1686550876.svg">
    <link rel="stylesheet" href="./index.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains Mono:wght@400&display=swap"
    />
    <title>Salvavidas | Login</title>
  </head>
  <body>
    <div class="welcome-emaillightmdlg">
      <div class="aplicacin-salvavidas-wrapper">
        <h1 class="aplicacin-salvavidas">Aplicación Salvavidas</h1>
      </div>
      <section class="main-container">
        <img
          class="illustration-icon"
          alt=""
          src="./public/illustration@2x.png"
        />

        <img
          class="main-container-child"
          loading="lazy"
          alt=""
          src="./public/group-1686550876.svg"
        />
      </section>
      <section class="login-container">
        <form class="frame-parent" action="../../controllers/controlador_login.php" method="post">
          <div class="frame-group">
            <div class="iniciar-sesin-wrapper">
              <h1 class="iniciar-sesin">Iniciar Sesión</h1>
              <?php if (isset($_GET['error'])): ?>
              <p class="aplicacin-salvavidas" style="font-size: 14px;"><?php echo htmlspecialchars($_GET['error']); ?></p>
              <?php endif; ?>
            </div>
            <button class="image-2-parent">
              <img class="image-2-icon" alt="" src="./public/image-2@2x.png" />

              <b class="continue-con-google">Continue con Google </b>
            </button>
          </div>
          <div class="o-iniciar-sesin-container">
            <span class="span">----------</span>
            <span class="o-iniciar-sesin">
              o Iniciar Sesión con usuario
            </span>
            <span class="span1">--------- </span>
          </div>
          <div class="frame-container">
              <div class="user-form-field-parent">
                <div class="user-form-field">
                  <div class="usuario">Usuario</div>
                  <div class="emailabccom-wrapper">
                    <input
                      class="emailabccom"
                      placeholder="nombre de usuario"
                      type="text" id="usuario" name="usuario" required
                    />
                  </div>
                </div>
                <div class="password-form-field">
                  <div class="password-container">
                      <div class="contrasea">Contraseña</div>
                      <div class="password-input">
                          <input
                              class="hidden-password"
                              placeholder="*****************"
                              type="password"
                              id="contrasenna" name="contrasenna"required
                          />
                          <!-- Botón para mostrar/ocultar contraseña -->
                          <span class="toggle-password" onclick="togglePassword()">
                              👁️
                          </span>
                      </div>
                  </div>
                  <div class="olvidaste-tu-contrasea-wrapper">
                      <div class="olvidaste-tu-contrasea">
                          ¿Olvidaste tu Contraseña?
                      </div>
                  </div>
                </div>
              </div>
              <button class="iniciar-sesin-container" type="submit">
                <div class="iniciar-sesin1">Iniciar Sesión</div>
              </button>
          </div>
        </form>
      </section>
    </div>
    <script>
      function togglePassword() {
          const passwordInput = document.getElementById('contrasenna');
          passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
      }
    </script>
  </body>
</html>
