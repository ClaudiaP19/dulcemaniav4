<?php
use Illuminate\Database\Capsule\Manager as DB;
require_once 'header.php';
require 'vendor\autoload.php';
require 'config\database.php';

$producto= DB::table('productos')
    ->where('id_producto',$_GET['id'])
    ->first();

echo <<<_FORM
  <section class="section">
    <div class="container">
      <h1 class="title">Actualizar producto número $producto->id_producto</h1>
            <form action="update_producto.php" method="POST">
                <div class="field">
                    <input id="id_producto" type="text" name="id_producto" value="{$producto->id_producto}" hidden>
                    <label class="label" for="nombre"> Nombre</label>
                   <input id="nombre" type="text" name="nombre" value="$producto->nombre" class="input is-primary">
                </div>
                <div class="field">
                    <label class="label" for="descripcion">Descripcion</label>
                   <textarea id="descripcion" type="text" name="descripcion" class="textarea is-primary">{$producto->descripcion}</textarea>
                </div>
                <div class="field">
                    <label class="label" for="precio">Precio</label>
                   <input id="precio" type="text" name="precio" value="$producto->precio" class="input is-primary">
                </div>
                <div class="field">
                    <div class="control">
                        <input class="button" type="button" value="Actualizar" onclick="update($producto->id_producto)">
                    </div>
                </div>
            </form>
            </div>
</section>
<script>
function update(id_producto) {

            axios.post(`api/index.php/update/`, {
                id_producto: id_producto,
                nombre: document.forms[0].nombre.value,
                descripcion: document.forms[0].descripcion.value,
                precio: document.forms[0].precio.value
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
        </script>
_FORM;
