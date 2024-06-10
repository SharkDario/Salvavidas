# Salvavidas
Se trata de automatizar el trabajo del enfermero y del médico con respecto al paciente ya que con una pulsera que contenga un QR en la tablet se destaque la planilla de los datos del paciente. Esta aplicación por ahora solo se aplica en sala de riesgo o terapia intensiva.

Modelo - Vista - Controlador

POO - PHP - JavaScript - MySQL

El archivo bd_salvavidas.rar
Contiene el archivo de la base de datos hasta el momento de su entrega, sea primera, segunda, tercera o cuarta.
La cual debería ser cargada en su localhost.

El archivo .htaccess:
RewriteEngine On
RewriteRule ^$ /salvavidas/views/a_landing_page/landing_page.html [L,R=301]
