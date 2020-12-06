<?php
use Illuminate\Database\Capsule\Manager as DB;
require_once 'header.php';
require 'vendor\autoload.php';
require 'config\database.php';

$productos= DB::table('productos')
    ->get();

echo <<<_FORM
<form action="insert.php" method="post">
                <label for='nombre'>Nombre</label>
                <input id="nombre" type="text" name="nombre" size="50">
                 <label for='descripcion'>Descripcion</label>
                 <input id="descripcion" type="textarea" name="descripcion" size="80">
                  <label for='precio'>Precio</label>
                  <input id="precio" type="text" name="precio" size="3">
                <input class="button is-success" type="submit" value="Guardar Producto">
            </form>

_FORM;
echo <<<_TABLE

<table class="table">
<thead>
    <th>#ID</th>
    <th>Titulo</th>
    <th>Descripcion</th>
    <th>Precio</th>
    <th colspan="2">Operaciones</th>
</thead>

<tbody>
_TABLE;
foreach ($productos as $fila){
    echo <<<_ROW
    <tr>
    
        <th> <input id="id_producto" type="text" name="id_producto" value="{$fila->id_producto}" hidden>$fila->id_producto</th>
        <td><center>$fila->nombre</center></td>
        <th  class="control">{$fila->descripcion}</th>
        <td><center>$fila->precio</center></td>
        <td><a class="button is-danger" href="delete.php?id={$fila->id_producto}">ELIMINAR</a></td>
        <td>
            <a class="button is-warning" href="update.php?id={$fila->id_producto}">ACTUALIZAR</a>  
        </td>
        </tr>
        
_ROW;

}
echo  "
</tbody>
</table>

";