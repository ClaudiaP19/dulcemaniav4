<?php
use Illuminate\Database\Capsule\Manager as DB;
require_once 'header.php';
require 'vendor\autoload.php';
require 'config\database.php';

DB::table('productos')->insert(
    ['nombre'=>$_POST['nombre'],
        'descripcion'=>$_POST['descripcion'],
        'precio'=>$_POST['precio']
        ]
);

echo "Producto guardado
<a href='productos.php' class='button is-warning'>Regresar</a>
";