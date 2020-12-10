<?php
use Illuminate\Database\Capsule\Manager as DB;
require_once 'header.php';
require 'vendor\autoload.php';
require 'config\database.php';

$productos= DB::table('productos')
    ->get();

echo <<<_FORM
<form action="insert.php" method="post" id='form_insertar'>
                <label for='nombre'>Nombre</label>
                <input id="nombre" type="text" name="nombre" size="50">
                 <label for='descripcion'>Descripcion</label>
                 <input id="descripcion" type="textarea" name="descripcion" size="80">
                  <label for='precio'>Precio</label>
                  <input id="precio" type="text" name="precio" size="3">
                <input class="button is-success" type="button" value="Guardar Producto" onclick="insertar()">
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
        <td><button class="button is-danger" onclick="delete_producto($fila->id_producto)">ELIMINAR</button></td>
        <td>
            <a class="button is-warning" href="update.php?id={$fila->id_producto}">ACTUALIZAR</a>  
        </td>
        </tr>
        
_ROW;

}
echo  "
</tbody>
</table>
<script>
        function update(id_calificacion) {

            axios.post(`api/index.php/update/`, {
                id_calificacion: id_calificacion,
                calificacion: document.getElementById('calificacion-'+id_calificacion).value
            })
                .then(resp=> {
                    location.reload();
                    alert(resp.data.mensaje);
                })
                .catch(function (error) {
                    alert('Error');
                    console.log(error);
                });
        };
        function delete_producto(id_producto) {
            axios.post(`api/index.php/delete_producto/`, {
                id_producto: id_producto,
            })
                .then(resp=> {
                    location.reload();
                    console.log(resp.data);
                    alert(resp.data.mensaje);
                })
                .catch(function (error) {
                    location.reload();
                    alert('Error');
                    console.log(error);
                });
        }

        function insertar() {
            console.log( document.forms[0]);
            axios.post(`api/index.php/insertar/`, {
                nombre: document.forms[0].nombre.value,
                descripcion: document.forms[0].descripcion.value,
                precio: document.forms[0].precio.value
            })
                .then(resp=> {
                    location.reload();
                    alert('Guardado');

                })
                .catch(function (error) {
                    alert('Error');
                    console.log(error);
                });
        }
    </script>

";