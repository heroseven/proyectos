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
<html>
<head>

	<title>jQuery UI Datepicker: Style (or Highlight) Specific Dates</title>
	<link href="bower_components/blitzer/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
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
	<div id="contenedor">
		<div id="datepicker"></div>
		<div id="box_intervalos">
			<form id="formulario" action='' method='post'></form>
		</div>





</form>

	</div>
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