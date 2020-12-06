<?php
use Illuminate\Database\Capsule\Manager as DB;
require_once 'header.php';
require 'vendor\autoload.php';
require 'config\database.php';

DB::table('productos')
 ->where('id_producto',$_POST['id_producto'])
 ->update(
    ['nombre'=>$_POST['nombre'],
        'descripcion'=>$_POST['descripcion'],
        'precio'=>$_POST['precio']
        ]
);
echo "Producto guardado
<a href='productos.php' class='button is-warning'>Regresar a productos</a>
";


