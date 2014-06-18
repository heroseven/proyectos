

<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}



$sql = "SELECT idexperto, nombre from experto";
mysql_select_db('paul');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=0;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    $ids[$i]=$row['idexperto'];
    $nombres[$i] = $row['nombre'];
    $i=$i+1;
} 
mysql_close($conn);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="bower_components/bootstrapassets/ico/favicon.ico">

    <title>Oficina en la nube</title>

    <!-- Bootstrap core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=PT+Serif+Caption' rel='stylesheet' type='text/css'>
    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://localhost/proyectos/trabajoProgra/expertos.php">Oficina en la nube</a>
        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Contraseña" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Entrar</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->

    <div class="jumbotron">
      <div class="container">
        <h1 class="heroHeading">Oficina en la nube</h1>
        
        <div id="concepto"><h3>Plataforma para que las empresas puedan ofrecer sus servicios de asesoría usando videochat.</h3>
          <p><a class="btn btn-primary btn-lg" role="button">Aprender más &raquo;</a></p>

        </div>
        
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">

<?php for($i=0;$i<count($ids);$i++){ ?>

<div class="col-md-4">
          <h2><?php echo $nombres[$i] ?></h2>
          <p><?php echo $nombres[$i] ?></p>
          <p><a class="btn btn-default" href="solicitar.php?id=<?php echo $ids[$i] ?>" role="button">Solicitar</a></p>
        </div>


<?php } ?>


        
     
      </div>

      <hr>

      <footer>
        <p>&copy; Oficina en la nube 2014</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    
  </body>
</html>
