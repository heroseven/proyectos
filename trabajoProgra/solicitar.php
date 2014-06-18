<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$experto= $_GET["id"];

$sql = "SELECT MIN( fecha ) a, MAX( fecha ) b FROM horarios WHERE idexperto ='$experto' AND estado =1";
mysql_select_db('paul');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    $inicio= $row['a'];
     $fin = $row['b'];
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

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="bower_components/blitzer/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <style>
		.dp-highlight .ui-state-default {
			background: red;
			color: #FFF;
		}
		#contenedor{
			margin:0 auto;
			width:800px;
		
		}
		#box_intervalos{
			width:350px;
			height: 300px;
			background-color: #ddd;
			display:inline;
			float:left;
		}
		#datepicker{
			display:inline;
			float:left;
			margin-right:5px;
		}
		
	</style>
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
          <a class="navbar-brand" href="#">Oficina en la nube</a>
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
     <div id="contenedor">
		<div id="datepicker"></div>
		<div id="box_intervalos">
			<form id="formulario" action='' method='post'></form>
		</div>


	</div>

    </div>
    </div>

      <hr>

      <footer>
        <p>&copy; Company 2014</p>
      </footer>
    </div> <!-- /container -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
  <script>
		/*
		 * jQuery UI Datepicker: Style (or Highlight) Specific Dates
		 * http://salman-w.blogspot.com/2013/01/jquery-ui-datepicker-examples.html
		 */




		$(function() {
			
		var inicioFormato=$.datepicker.parseDate('yy-mm-dd', "<?php echo $inicio ?>");
		var finFormato=$.datepicker.parseDate('yy-mm-dd', "<?php echo $fin ?>");
			$("#datepicker").datepicker({

				dateFormat: "yy-mm-dd",
				beforeShowDay: function(date) {
					return [true, date >= inicioFormato && date <= finFormato ? "dp-highlight" : ""];

				},onSelect: function(date){
				


            		 $.post('dias.php',{dia:date, expertoid:<?php echo $experto ?>}, function(respuesta){
                		

                		lista= JSON.parse(respuesta);
                		
                	if(lista =="noexiste"){
                			$('#formulario').html("<h2>Formulario</h2>");
                			$('#formulario').append("No hay horarios disponibles.");
                			


                		}else{
                		$('#formulario').html("<h2>Formulario</h2>");
                			
                		for(var i in lista){
                		$('#formulario').append("<br/><input type='checkbox' name='"
								+lista[i]+ "'>"+lista[i]+"</br>");
                		console.log(lista[i]);
                		}
						$('#formulario').append("<input type='submit' value='Enviar'>");

					}
				    	}).fail(function(){
				        alert('error');

				            });
              
					
				}
					

			});
		});
	</script>
  </body>
</html>