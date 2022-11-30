<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
  $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
     <title><?php echo $row['userEmail']; ?></title>
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../imagenes/logo2.png" />

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    
<link href="nno.css" rel="stylesheet" id="bootstrap-css" >

  </head>
  <body>

    <!-- NAVIGATION  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
    <img src="../imagenes/logo2.png" width="40" height="40" class="d-inline-block align-top" alt="">
    PEPSICO
  </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      </div>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <form class="form-inline my-2 my-lg-0">
            <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar producto" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
             </form>
            <button class="btn btn-danger my-2 my-sm-0 ml-2" onclick="window.location.href='logout.php'"  type="submit">Cerrar sesion</button>
         
      </div>
    </nav>



    <!-- TABLE  -->
		   <div class="container ">
		       <div class="row">
       <div class="col-sm-12">
         </div> 
    <div class="container mt-4" >
      <marquee id="name" scrollamount="15" direction="down" width="100%" height="15%" behavior="alternate" style="border:solid">
 
    <h1 id="name" style="color:blue;">PEPSICO</h1></marquee></marquee>
        <div class="row" >
            
            
            
            <?php include 'database.php'; 
            $pub = mysqli_query($con, "SELECT * FROM task order by name ASC");
            		while ($soli = mysqli_fetch_array($pub)) {
            		 	# code...
            		 	$a=$soli['name'];
            		 	$b=$soli['description'];
            		 	$c=$soli['img'];
            		 	$d=$soli['id'];
                  $e=$soli['precio'];
            		 
            		 	
            		 	?>
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-4" >
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card" style="Background-color:black;">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="<?php echo $c ?>" alt="card image"></p>
                                    <h4 class="card-title"><?php echo $a ?></h4>
                                    <p class="card-text" style="color:white;"><?php echo $b ?></p>
                                    <a href="#" class="btn btn-primary btn-sm" target=”_blank”><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card" style="Background-color:purple;">
                                <div class="card-body text-center mt-4">
                                    <h4 style="color:black;"><?php echo $a ?></h4>
                                    <p class="card-text"style="color:white; text-align: justify;">En PepsiCo nuestro objetivo es brindarte diferentes opciones de productos. Nuestro portafolio de alimentos y bebidas busca crear sonrisas en todos nuestros consumidores donde quiera que estén. </p>
                                 
                                               
                                         <?php echo $e ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Team member -->
      	  <?php
            		}
            		?>
    </div>
</section>
<!-- Team -->
<script  type="text/javascript" src="js/game.js"></script>
<script  type="text/javascript" src="js/game2.js"></script>
</body>
</html>