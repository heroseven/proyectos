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
$id=$_POST["expertoid"];

$sql = "SELECT distinct i.intervaloasignado
FROM horarios h
right JOIN intervalos i ON h.intervalo = i.idintervalo
WHERE h.estado=1 and h.fecha ='$dia' and  h.idexperto='$id'
order by i.idintervalo";
mysql_select_db('paul');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
$i=0;
if(mysql_num_rows($retval)){
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
	
	
	    
    $lista[$i]=$row['intervaloasignado'];
    $i=$i+1;
} 
echo json_encode($lista);	

}else{
	echo json_encode("noexiste");
}




mysql_close($conn);


?>


