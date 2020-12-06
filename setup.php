<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>

    <h3>Setting up...</h3>

<?php // Example 26-3: setup.php
    require_once 'functions.php';

    createTable('productos',
        'id_producto INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
                  nombre VARCHAR(60),
                  descripcion VARCHAR(200),
                  precio VARCHAR(60)
                 ');


    createTable('carritos',
        'id_carrito INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                   id_producto INT,
                   id_usuario INT,
                   cantidad INT,
                   total INT
                  ');

    createTable('perfiles',
        'id_perfil INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                  nombre_perfil VARCHAR(30)');

    createTable('usuarios',
        'id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                  nombre_usuario VARCHAR(50),
                  password VARCHAR(50),
                  id_perfil INT(11)
                 ');
?>

    <br>...done.
  </body>
</html>
