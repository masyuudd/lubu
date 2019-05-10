<?php 

//$hil = array("ltoreh","talusatu","taludua","lubusatu","lubudua");

$hil = array("talusatu","taludua","ltoreh");


$skr  = date("Y-m-d");
$wkt  = date("H:00:00");
$las  = (int)date("H")-1;

require_once('Connections/conn.php'); 

		if ($las < 10)
		{$las = "0".$las;}	
$wkt2 = $las.":00:00";

/*
$skr 	= "2017-11-05";
$wkt 	= "13:00:00";
$wkt2 	= "12:00:00";
*/



$a = "INSERT INTO ";
$b = " (RID, ReceivedDate, ReceivedTime, DataType, StatusPort, SamplingDate, SamplingTime, Temperature, Humidity, Rain, Rain1, Rain2, Rain3, Rain4, WLevel, WLevel1, WLevel2, WLevel3, WLevel4) Select '0','";
$c  =  "' , '";
$ce = ",";
$d 	= "1', '0";
$e 	= ",0, 0, 0, 0 from dual WHERE NOT EXISTS (SELECT * FROM ";
$f	= " WHERE SamplingDate = '";
$g 	= " AND SamplingTime = '";
$h	= "');";

// SELECT * FROM `ltoreh` WHERE `SamplingDate` = '2017-02-13' and `SamplingTime` between '11:00:00' and '13:00:00'



?>

<?php
function msg($x)
{echo "test-".$x;}
?>


<?php
for ($x=0; $x<count($hil); $x++)
   {
//==============================

//echo $hil[$x]."=================================================== <br>";;
mysql_select_db($database_conn, $conn);
$query_latest = "SELECT * FROM $hil[$x] WHERE `SamplingDate` = '$skr' and `SamplingTime` between '$wkt2' and '$wkt'";
$latest = mysql_query($query_latest, $conn) or die(mysql_error());
$row_latest = mysql_fetch_assoc($latest);
$totalRows_latest = mysql_num_rows($latest);
//echo $query_latest;
 
 $sql 	= "";
 $fsql	= ""; 
 if ($totalRows_latest>0)
 {
 do { 
		
		$rdate	=	$row_latest['ReceivedDate'];
		$rtime	=	$row_latest['ReceivedTime'];
		$sdate	=	$row_latest['SamplingDate'];
		$stime	=	$row_latest['SamplingTime'];
		$awl	=	$row_latest['WLevel'];
		$atc	=	$row_latest['Rain'];
		$sql 	= 	$a.$hil[$x].$b.$rdate.$c.$rtime.$c.$d.$c.$sdate.$c.$stime."'".$ce."0, 0".$ce.$atc.",0, 0, 0, 0".$ce.$awl.$e.$hil[$x].$f.$sdate."'".$g.$stime.$h;
		$fsql	=	$fsql.$sql;
		echo "<br>".$fsql."<br><br>";
		/*
		echo $row_latest['RID']."|"; 
		echo $row_latest['ReceivedDate']."|"; 
		echo $row_latest['ReceivedTime']."|"; 
		echo "<br>";
		
		echo $row_latest['DataType']."|"; 
		echo $row_latest['StatusPort']."|"; 
		*/
		//echo "<br><br>";
		//echo $row_latest['SamplingDate']."|"; 
		//echo $row_latest['SamplingTime']."|"; 
		/*
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
*/		
} while ($row_latest = mysql_fetch_assoc($latest)); 

// haourly backup data 


// membuat nama file
$phile = date("Y_m_d")."_jam_".date("H").".txt";

// lokasi penyimpanan file
$my_file = "d:\\data\\$phile";
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file


$filename = "d:\\data\\$phile";

$somecontent = $fsql;

?>
 <form id="frm1" action="http://awlr.ombilinpower.co.id/dashboard/inserdb.php" method="post">
 <input name="data" type="hidden" value="<?php echo $fsql; ?>" />
 </form>
    <script>
		document.getElementById('frm1').submit();
	</script>

	<?php


// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {

    // In our example we're opening $filename in append mode.
    // The file pointer is at the bottom of the file hence
    // that's where $somecontent will go when we fwrite() it.
    if (!$handle = fopen($filename, 'a')) {
         echo "Cannot open file ($filename)";
         exit;
    }

    // Write $somecontent to our opened file.
    if (fwrite($handle, $somecontent) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit; 
    }

    echo "Success, wrote ($somecontent) to file ($filename)<br>";

    fclose($handle);

} else {
    echo "The file $filename is not writable";
}
 
//==============================



mysql_free_result($latest);
 }


 
	}
?>







 

