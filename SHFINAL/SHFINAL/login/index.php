<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('admin.php');
}

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
 
	
   

	if($user_login->login($email,$upass))
	{
		$user_login->redirect('home.php');
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>INICIAR SESION PEPSICO</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
    <link rel="icon" type="image/png" href="../imagenes/logo2.png" />
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body id="login">
      

      
    <div class="container">
		<?php 
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Lo siento!</strong>Esta cuenta no esta activa ve a tu inbox para activarla
			</div>
            <?php
		}
		?>
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Credenciales equivocadas!</strong> 
			</div>
            <?php
		}
		?>
		

		
        <h2 class="form-signin-heading">INICIAR SESION</h2><hr />
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Correo electronico" name="txtemail" required />
        </div>
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Contraseña" class="col-sm-2 col-form-label" name="txtupass" required />
        </div>
        <div class="g-recaptcha" data-sitekey="6Ld1SRkjAAAAAAtSLGbNUWopqZyc1yYYfiWD7Qzq" hidden></div>
     	<hr />
        <button class="btn btn-large" type="submit" name="btn-login">Inicio de sesion</button>
        <a href="signup.php" style="float:right;" class="btn btn-large">Registro</a><hr />
        <div id="Power-Contenedor">
        <a href="fpass.php" id="Anyadir-Rutina-btn">Olvidaste tu contraseña ? </a>
        </div>
      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
   <script src="https://www.google.com/recaptcha/enterprise.js?render=6Ld1SRkjAAAAAAtSLGbNUWopqZyc1yYYfiWD7Qzq"></script>
<script>
grecaptcha.enterprise.ready(function() {
    grecaptcha.enterprise.execute('6Ld1SRkjAAAAAAtSLGbNUWopqZyc1yYYfiWD7Qzq', {action: 'login'}).then(function(token) {
       ...
    });
});
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
  </body>
</html>
