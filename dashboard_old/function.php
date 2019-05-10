
<?php require_once('../Connections/lubu.php'); ?>
<?php
mysql_select_db($database_lubu, $lubu);
$query_getformula = "SELECT * FROM tabelformula WHERE tabelformula.AgentID = 'ltoreh'";
$getformula = mysql_query($query_getformula, $lubu) or die(mysql_error());
$row_getformula = mysql_fetch_assoc($getformula);
$totalRows_getformula = mysql_num_rows($getformula);

$a= $row_getformula['a'];
$b=$row_getformula['b'];
$c=$row_getformula['c']; 

$d= $a*$b*$c;
$hasil = pow(2,3);

echo $hasil;

mysql_free_result($getformula);
?>


