<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}


$fecha=$_POST["fecha"];


$sql = "SELECT fecha FROM horarios where fecha='$fecha'";
mysql_select_db('paul');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
if(mysql_num_rows($retval)){
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{	

		echo "EMP ID :{$row['fecha']}  <br> ";
	
} } else{
		echo "no hay nada";
}
mysql_close($conn);


?>


