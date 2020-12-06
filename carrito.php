<?php
use Illuminate\Database\Capsule\Manager as DB;
require_once 'header.php';
require 'vendor\autoload.php';
require 'config\database.php';

$productos= DB::table('carritos')
    ->leftJoin('productos','productos.id_producto','=','carritos.id_producto')
    ->where('id_usuario',$_SESSION['id_usuario'])
    ->get();
$total_compra =DB::table('carritos')
    ->leftJoin('productos','productos.id_producto','=','carritos.id_producto')
    ->where('id_usuario',$_SESSION['id_usuario'])->sum('total');
$total_compra = number_format($total_compra,1);
echo <<<_TABLE

<table class="table">
<thead>
    <th>#ID</th>
    <th>PRODUCTO</th>
    <th>PRECIO UNITARIO</th>
    <th>CANTIDAD</th>
    <th colspan="2">TOTAL</th>
</thead>
<tfoot>
    <tr>
        <th>Total de compra:</th>
        <th>$total_compra</th>
    </tr>
</tfoot>

<tbody>
_TABLE;
foreach ($productos as $fila){
    echo <<<_ROW
    <tr>
    
        <th> <input id="id_producto" type="text" name="id_producto" value="{$fila->id_carrito}" hidden>$fila->id_carrito</th>
        <td><center>$fila->nombre</center></td>
        <th  class="control">{$fila->precio}</th>
        <td><center>$fila->cantidad</center></td>
        <td><center>$fila->total</center></td>
     
        </tr>
        
_ROW;

}
echo  "
</tbody>
</table>

";