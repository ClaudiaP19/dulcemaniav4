<?php
use Illuminate\Database\Capsule\Manager as DB;
require_once 'header.php';
require 'vendor\autoload.php';
require 'config\database.php';

DB::table('productos')
    ->where('id_producto',$_GET['id'])->delete();

echo "Se elimino el producto con el id:{$_GET['id']}
<a href='productos.php' class='button is-warning'>Regresar</a>
";