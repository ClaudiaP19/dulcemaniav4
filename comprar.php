<?php
use Illuminate\Database\Capsule\Manager as DB;
require_once 'header.php';
require 'vendor\autoload.php';
require 'config\database.php';
if (isset($_SESSION['user'])) {

    $producto = DB::table('productos')
        ->where('id_producto', $_POST['id_producto'])
        ->first();

    $total = $producto->precio * $_POST['cantidad'];
    echo $total;
    DB::table('carritos')
        ->insert(
            [
                'id_producto' => $producto->id_producto,
                'id_usuario' => $_SESSION['id_usuario'],
                'cantidad' => $_POST['cantidad'],
                'total' => $total
            ]
        );
    echo "Producto guardado
<a href='index.php' class='button is-warning'>Regresar</a>
";

}
else {
    echo "Debe de estar loguado para comprar
<a href='index.php' class='button is-warning'>Regresar</a>";
}
