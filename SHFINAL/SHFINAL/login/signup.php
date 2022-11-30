<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('admin.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);





      
	$code = md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Lo siento! !</strong>  el email ya existe , Porfavor prueba de nuevo
			  </div>
			  ";
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$code))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Hola $uname,
						<br /><br />
						Bienvenido a PEPSICO!<br/>
						Completa tu registro porfavor , haciendo click en el enlance<br/>
						<br /><br />
						<a href='https://kronoxrosales.000webhostapp.com/SHFINAL/login/verify.php?id=$id&code=$code'>Click aqui para activar tu cuenta :)</a>
						<br /><br />
						Gracias,";
						
			$subject = "Confirmar registro";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>boom!</strong>  Nosotros lo hemos enviado al email: $email.
					Porfavor haz click en el enlace de confirmacion del email para crear tu cuenta. 
			  		</div>
					";
		}
		else
		{
			echo "lo siento , Consulta no ejecutada...";
		}		
	
}}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>REGISTRARSE</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body id="login">
    <div class="container">
				<?php if(isset($msg)) echo $msg;  ?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">REGISTRARSE</h2><hr />
		<div class="form-group">
        <input type="text" class="form-control" placeholder="Nombre de usuario" name="txtuname" required />
		</div>
		<div class="form-group">
        <input type="email" class="form-control" placeholder="Correo electronico" name="txtemail" required />
		</div>
		<div class="form-group">
        <input type="password" class="form-control" placeholder="Contraseña" name="txtpass" required />
		</div>
       
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Registro</button>
        <a href="index.php" style="float:right;" class="btn btn-large">Iniciar sesion</a>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
  var onloadCallback = function() {
   grecaptcha.render('example3', {
          'sitekey' : 'your_site_key',
          'callback' : verifyCallback,
          'theme' : 'dark'
        });
  };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>
  </body>
</html>