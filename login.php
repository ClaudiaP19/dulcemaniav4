<?php
use Illuminate\Database\Capsule\Manager as DB;
require_once 'header.php';
require 'vendor\autoload.php';
require  'config\database.php';

$user = DB::table('usuarios')
    ->leftJoin('perfiles','usuarios.id_perfil','=', 'perfiles.id_perfil')
    ->where('nombre_usuario',$_POST['usuario'])->first();

$mensaje = '';
if($user and $user->password == $_POST['password']){
        $_SESSION['user'] = $user->nombre_usuario;
        $_SESSION['perfil'] = $user->id_perfil;
    $_SESSION['id_usuario'] = $user->id_usuario;
    if($user->id_perfil == 1){

        $mensaje ="<h1>Bienvenido {$user->nombre_perfil}: {$user->nombre_usuario}</h1><br><form action='productos.php' method='post'>
                <input id='id_usuario' type='text' name='id_usuario' value='{$user->id_usuario}' hidden>
                <input class='button' type='submit' value='Productos en existencia'></form>";
    }
    else{
        $mensaje = "<h1>Bienvenido {$user->nombre_perfil}: {$user->nombre_usuario}</h1><br><form action='index.php' method='post'>
                <input id='id_usuario' type='text' name='id_usuario' value='{$user->id_usuario}' hidden>
                <input class='button' type='submit' value='Consultar productos'>
            </form>";


    }
}
else{
    $mensaje = "<h1>Usuario y contraseña erroneos, por favor verifique y vuelva autentificarse </h1>
    <br>
    <a href='index.html'>Regresar</a>";
}

echo $mensaje;