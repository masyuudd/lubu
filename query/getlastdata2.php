 

<?php

$hil = array("ltoreh","talusatu","taludua","lubusatu","lubudua");

$a = "INSERT INTO ";
$b = " (RID, ReceivedDate, ReceivedTime, DataType, StatusPort, SamplingDate, SamplingTime, Temperature, Humidity, Rain, Rain1, Rain2, Rain3, Rain4, WLevel, WLevel1, WLevel2, WLevel3, WLevel4) Select '0','";
$c  =  "' , '";
$ce = ",";
$d 	= "1', '0";
$e 	= ",0, 0, 0, 0 from dual WHERE NOT EXISTS (SELECT * FROM ";
$f	= " WHERE ReceivedDate = '";
$g 	= " AND ReceivedTime = '";
$h	= "');";


?>


<?php
function getlatest($x)
{
require_once('Connections/conn.php');	


$skr  = date("Y-m-d");
$wkt  = date("H:00:00");
$las  = (int)date("H")-1;
		//$las = 9;
		if ($las < 10)
		{$las = "0".$las;}	
$wkt2 = $las.":00:00";

$skr 	= "2017-11-05";
$wkt 	= "13:00:00";
$wkt2 	= "12:00:00";


if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_conn, $conn);
$query_latest = "SELECT * FROM taludua WHERE `SamplingDate` = '$skr' and `SamplingTime` between '$wkt2' and '$wkt'";
$latest = mysql_query($query_latest, $conn) or die(mysql_error());
$row_latest = mysql_fetch_assoc($latest);
$totalRows_latest = mysql_num_rows($latest);
echo $query_latest;
?>


  <?php do { 
		
		$sql = $a.$ishil.$b.$rdate.$c.$rtime.$c.$d.$c.$mtgl.$c.$mhour.":".$timeline[$i].":00'".$ce."0, 0".$ce.$atc[$i].",0, 0, 0, 0".$ce.$awl[$i].$e.$ishil.$f.$rdate."'".$g.$rtime.$h;
		echo $row_latest['RID']."|"; 
		echo $row_latest['ReceivedDate']."|"; 
		echo $row_latest['ReceivedTime']."|"; 
		echo $row_latest['DataType']."|"; 
		echo $row_latest['StatusPort']."|"; 
		echo $row_latest['SamplingDate']."|"; 
		echo $row_latest['SamplingTime']."|"; 
		echo $row_latest['Temperature']."|"; 
		echo $row_latest['Humidity']."|"; 
		echo $row_latest['Rain']."|"; 
		echo $row_latest['Rain1']."|"; 
		echo $row_latest['Rain2']."|"; 
		echo $row_latest['Rain3']."|"; 
		echo $row_latest['Rain4']."|"; 
		echo $row_latest['WLevel']."|"; 
		echo $row_latest['WLevel1']."|"; 
		echo $row_latest['WLevel2']."|"; 
		echo $row_latest['WLevel3']."|"; 
		echo $row_latest['WLevel4']."|<br>"; 
} while ($row_latest = mysql_fetch_assoc($latest)); 

mysql_free_result($latest);
}
?>


<?php
for ($x=0; $x<count($hil); $x++)
   {
	echo $hil[$x];
	getlatest($hil[$x]);
	}
?>



