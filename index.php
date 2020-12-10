<?php // Example 26-4: index.php
use Illuminate\Database\Capsule\Manager as DB;
session_start();
require_once 'header.php';
require 'vendor\autoload.php';
require 'config\database.php';

$productos = DB::table('productos')->get();

  if ($loggedin) echo " $user, estas logueado";
  else           echo ' Inicia sesión para comprar';

?>
</div>
<section class="section center">
    <div class="container">
      <h1 class="title">Productos</h1>
        <div class="columns is-mobile">
            <?php
            foreach ($productos as $producto){
                echo "<div class='column'>
                        <figure class='image is-200x200px'>
                          <img src='images/$producto->id_producto.jpg'>
                        </figure>
                        <h2 class='title'>$producto->nombre</h2>
                        <p>$producto->descripcion</p>
                        <button class='button is-info'>$$producto->precio</button>
                        
                        <form action='comprar.php' method='post'>
                           <input id='id_producto' type='id_producto' name='id_producto' value='$producto->id_producto' hidden>
                            <input id='cantidad' type='number' name='cantidad' placeholder='cantidad' required>
                            <input class='button is-success' type='button' value='COMPRAR' onclick='comprar()'>
                        </form></div>
                        
                        ";

            }
            ?>
        </div>

    </div>
  </section>
<?php
  echo <<<_END
  
    <div data-role="footer" class="has-background-warning">
      <h4>Sistema web para venta de mesas de dulces</i></h4>
    </div>
    <script>
        function comprar() {
            console.log( document.forms[0]);
            axios.post(`api/index.php/insertar_carrito/`, {
                cantidad: document.forms[0].cantidad.value,
                id_producto: document.forms[0].id_producto.value
            })
                .then(resp=> {
                    location.reload();
                    alert('Producto agregado');

                })
                .catch(function (error) {
                    alert('Error');
                    console.log(error);
                });
        }
    </script>
  </body>
</html>
_END;
?>
