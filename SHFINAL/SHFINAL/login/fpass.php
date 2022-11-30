<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if($user->is_logged_in()!="")
{
	$user->redirect('admin.php');
}

if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	
	$stmt = $user->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['userID']);
		$code = md5(uniqid(rand()));
		
		$stmt = $user->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		
		$message= "
				   Hola , $email
				   <br /><br />
				   Nos solicitaron restablecer su contraseña, si lo hace, simplemente haga clic en el siguiente enlace para restablecer su contraseña, si no, simplemente ignore                   este email,
				   <br /><br />
				   Haga clic en el siguiente enlace para restablecer su contraseña 
				   <br /><br />
				   <a href='https://kronoxrosales.000webhostapp.com/SHFINAL/login/resetpass.php?id=$id&code=$code'>Click aquí para restaurar tu contraseña</a>
				   <br /><br />
				   Gracias :)
				   ";
		$subject = "Restablecimiento de contrasena";
		
		$user->send_mail($email,$message,$subject);
		
		$msg = "<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					Hemos enviado un correo electrónico a $email.
                    Haga clic en el enlace de restablecimiento de contraseña en el correo electrónico para generar una nueva contraseña. 
			  	</div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Lo siento!</strong>  este email no se encuentra. 
			    </div>";
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Olvidaste tu contraseña</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body id="login">
    <div class="container">

      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Olvidaste tu contraseña</h2><hr />
        
        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
              	<div class='alert alert-info'>
			    Por favor, introduzca su dirección de correo electrónico. Recibirá un enlace para crear una nueva contraseña por correo electrónico.!
				</div>  
                <?php
			}
			?>
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Correo electronico" name="txtemail" required />
		</div>
     	<hr />
        <button class="btn btn-large" type="submit" name="btn-submit">Generar una nueva contraseña</button>
      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>