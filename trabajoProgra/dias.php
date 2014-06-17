<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}


$dia=$_POST["dia"];


$sql = "SELECT intervalo FROM horarios where fecha='$dia'";
mysql_select_db('paul');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
$i=0;

while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{

    
    $lista[$i]=$row['intervalo'];
    $i=$i+1;
} 

echo json_encode($lista);


mysql_close($conn);


?>


