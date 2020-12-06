<?php // Example 26-5: signup.php
  require_once 'header.php';

echo <<<_END
  <script>
    function checkUser(user)
    {
      if (user.value == '')
      {
        $('#used').html('&nbsp;')
        return
      }

      $.post
      (
        'checkuser.php',
        { user : user.value },
        function(data)
        {
          $('#used').html(data)
        }
      )
    }
  </script>  
_END;

  $error = $user = $pass = "";
  if (isset($_SESSION['user'])) destroySession();

  if (isset($_POST['user']))
  {

    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "")
      $error = 'Not all fields were entered<br><br>';
    else
    {
      $result = queryMysql("SELECT * FROM usuarios WHERE nombre_usuario='$user'");

      if ($result->num_rows)
        $error = 'That username already exists<br><br>';
      else
      {
      //  echo "INSERT INTO `usuarios` (`nombre_usuario`, `password`, `id_perfil`) VALUES('$user', '$pass', '2')";
        queryMysql("INSERT INTO `usuarios` (`nombre_usuario`, `password`, `id_perfil`) VALUES('$user', '$pass', '2')");
        die('<h4>Account created</h4>Please Log in.</div></body></html>');
      }
    }
  }

echo <<<_END
<div class="box">
    <div class="columns is-centered is-2">
        <div class="column is-half">
            <div class="notification is-info">
                <h1>REGÍSTRATE EN DULCE-MANIA</h1>
            </div>
      <form method='post' action='signup.php'>$error
      <div data-role='fieldcontain'>
        <label></label>
        Please enter your details to sign up
      </div>
      <div data-role='fieldcontain'>
        <label>Username</label>
        <input type='text' maxlength='16' name='user' value='$user'
          onBlur='checkUser(this)'>
        <label></label><div id='used'>&nbsp;</div>
      </div>
      <div data-role='fieldcontain'>
        <label>Password</label>
        <input type='text' maxlength='16' name='pass' value='$pass'>
      </div>
      <div data-role='fieldcontain'>
        <label></label>
        <input data-transition='slide' type='submit' value='Sign Up'>
      </div>
    </div>
    </div>
    </div>
  </body>
</html>
_END;
?>
