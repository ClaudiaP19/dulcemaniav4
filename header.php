<?php // Example 26-2: header.php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
echo <<<_INIT
<!DOCTYPE html> 
<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'> 
    <link rel='stylesheet' href='node_modules/bulma/css/bulma.min.css'>

_INIT;

  require_once 'functions.php';

  $userstr = 'Bienvenido a DULCE-MANIA';
  $loggedin = FALSE;
  $perfil = 2;
  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = "Logueado como: $user";
    $perfil     = $_SESSION['perfil'];
  }
 

echo <<<_MAIN
    <title>DULCE-MANIA: $userstr</title>
  </head>
  <body>
  <nav class="section center" style="background-image: url('images/fondo.jpg'); background-size: cover; background-repeat: no-repeat, repeat;">
    <div class="container">
      <h1 class="title">
        DULCE MANIA
      </h1>
      <p class="subtitle is-warning" >
        La Mesa De Dulces Que Siempre Soñaste
      </p>
      <h1>$userstr</h1>
   


_MAIN;

  if ($loggedin)
  {

    
echo <<<_LOGGEDIN
        <div class="section buttons center">
          <a class="button is-info"  href="index.php" >Princial</a>
          <a class="button is-success"  href="carrito.php" >Mi carrito</a>
          <a class="button is-warning" href="logout.php">Cerrar sesion</a>
       
  
_LOGGEDIN;
if($perfil==1){
       
       echo <<<_LOGGEDIN
         <a href='productos.php' class='button is-primary'>Lista de productos</a>

_LOGGEDIN;
    }
  }
  else
  {
echo <<<_GUEST
        <div class="section buttons center">
           <a class="button is-info"  href="index.php" >Princial</a>
          <a href="signup.php" class="button is-primary">Registrate</a>
          <a href="login.html" class="button is-danger">Inicia sesión</a>
         
        
_GUEST;
  }

  echo " </div>
         </div></nav>";
?>

