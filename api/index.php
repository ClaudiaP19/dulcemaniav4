<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as DB;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
// Instantiate app
$app = AppFactory::create();
$app->setBasePath("/dulcemaniaV4/api/index.php");

// Add Error Handling Middleware
$app->addErrorMiddleware(true, false, false);

// Add route callbacks
$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write('Hello World');
    return $response;
});
$app->post('/login/{usuario}', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody()->getContents(),false);


    $user = DB::table('usuarios')
        ->leftJoin('perfiles','usuarios.id_perfil','=', 'perfiles.id_perfil')
        ->where('usuarios.nombre_usuario',$args['usuario'])
        ->first();
   // var_dump($user);
    $msg = new stdClass();
    $msg->mensaje = 'OK aceptado';

    if($user->password == $data->password){
         session_start(); 
        $msg->aceptado = true;
        $msg->id_perfil = $user->id_perfil;
        $msg->id_usuario = $user->id_usuario;
        $_SESSION['user'] = $user->nombre_usuario;
        $_SESSION['perfil'] = $user->id_perfil;
        $_SESSION['id_usuario'] = $user->id_usuario;
    }
    else{
        $msg->aceptado = false;
    }
    $response->getBody()->write(json_encode($msg));
    return $response;
});

$app->post('/insertar/', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody()->getContents(),false);


   $producto =  DB::table('productos')->insert(
    ['nombre'=>$data->nombre,
        'descripcion'=>$data->descripcion,
        'precio'=>$data->precio
        ]
    );
    // var_dump($user);
    $msg = new stdClass();
    $msg->mensaje = 'Error al guardar';

    if($producto){
        $msg->mensaje = 'producto guardado';
    }

    $response->getBody()->write(json_encode($msg));
    return $response;
});

$app->post('/delete_producto/', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody()->getContents(),false);

    $producto = DB::table('productos')
        ->where('id_producto',$data->id_producto)
        ->delete();

    // var_dump($user);
    $msg = new stdClass();
    $msg->mensaje = 'Error al eliminar';

    if($producto){
        $msg->mensaje = 'producto eliminado';
    }

    $response->getBody()->write(json_encode($msg));
    return $response;
});

$app->post('/update/', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody()->getContents(),false);

    $producto = DB::table('productos')
        ->where('id_producto',$data->id_producto)
       ->update(
        ['nombre'=>$data->nombre,
        'descripcion'=>$data->descripcion,
        'precio'=>$data->precio
        ]);


     //var_dump($data);
    $msg = new stdClass();
    $msg->mensaje = 'Error al actualizar';

    if($producto){
        $msg->mensaje = 'Producto actualizado';
    }

    $response->getBody()->write(json_encode($msg));
    return $response;
});
$app->post('/insertar_carrito/', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody()->getContents(),false);

    $producto = DB::table('productos')
        ->where('id_producto', $data->id_producto)
        ->first();

    $total = $producto->precio * $data->cantidad;

   $producto =  DB::table('carritos')->insert(
    ['id_producto'=>$data->id_producto,
        'id_usuario'=> $_SESSION['id_usuario'],
        'cantidad'=>$data->cantidad,
         'total' => $total
        ]
    );
    // var_dump($user);
    $msg = new stdClass();
    $msg->mensaje = 'Error al guardar';

    if($producto){
        $msg->mensaje = 'producto agregado al carrito';
    }

    $response->getBody()->write(json_encode($msg));
    return $response;

});

// Run application
$app->run();