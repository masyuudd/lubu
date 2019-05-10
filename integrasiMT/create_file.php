<?php // connection
$hostname_map = "localhost";
$database_map = "dbtuts";
$username_map = "root";
$password_map = "";
$map = mysql_pconnect($hostname_map, $username_map, $password_map) or trigger_error(mysql_error(),E_USER_ERROR); 
?>

<?php // initial
date_default_timezone_set('Asia/Jakarta');
/*
$date 	= date("Y-m-d");
$jam   	= Date("H")-1;
*/


//=== testing
$date = "2017-02-19";
$jam   = "06";	
//===

$jam1  	= $jam.":00:00";
$jam2  	= $jam.":55:00";

$zstr 	= array();
$que	= "";


 
$das=array("awlr_tiro");


$arrlength=count($das);

for($x=0;$x<$arrlength;$x++)
{
mysql_select_db($database_map, $map);
$query_data = "SELECT * FROM $das[$x] WHERE $das[$x].SamplingDate= '$date' AND $das[$x].SamplingTime between '$jam1' and '$jam2' ";
$data = mysql_query($query_data, $map) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

$j=1;

//echo $query_data."<br>";

do { 

$str[$j] = "("
.$row_data['RID'].", '"
.$row_data['ReceivedDate']."', '"
.$row_data['ReceivedTime']."', "
.$row_data['DataType'].", '"
.$row_data['StatusPort']."', '"
.$row_data['SamplingDate']."', '"
.$row_data['SamplingTime']."', "
.$row_data['Temperature'].", "
.$row_data['Humidity'].", "
.$row_data['Rain'].", "
.$row_data['Rain1'].", "
.$row_data['Rain2'].", "
.$row_data['Rain3'].", "
.$row_data['Rain4'].", "
.$row_data['WLevel'].", "
.$row_data['WLevel1'].", "
.$row_data['WLevel2'].", "
.$row_data['WLevel3'].", "
.$row_data['WLevel4']."),";

echo $str[$j]."<br>";
$j=$j+1;
 
 } while ($row_data = mysql_fetch_assoc($data));
 
 $q1= "INSERT INTO $das[$x] (`RID`, `ReceivedDate`, `ReceivedTime`, `DataType`, `StatusPort`, `SamplingDate`, `SamplingTime`, `Temperature`, `Humidity`, `Rain`, `Rain1`, `Rain2`, `Rain3`, `Rain4`, `WLevel`, `WLevel1`, `WLevel2`, `WLevel3`, `WLevel4`) VALUES ";
 
	if(isset($str[12])) 
	{ 
		$str[12]	=	$str[12]."#";
		$str[12]	=	str_replace(",#", "; ", $str[12]);  
		$zstr[$x]	= 	$q1.$str[1].$str[2].$str[3].$str[4].$str[5].$str[6].$str[7].$str[8].$str[9].$str[10].$str[11].$str[12];
		$zstr[$x]	=	str_replace("#","",$zstr[$x]);
		$zstr[$x]	=	str_replace("(, '', '', , '', '', '', , , , , , , , , , , , ),","",$zstr[$x]);
		$que = $que.$zstr[$x]."#";
	}

}

mysql_free_result($data);

echo $q1;
echo "<br>";
?>



<?php // haourly backup data 

// membuat nama file
$phile = date("Y_m_d")."_jam_".$jam.".txt";

// lokasi penyimpanan file
$my_file = "d:\\data\\$phile";
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file


$filename = "d:\\data\\$phile";

$somecontent = $que;

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

    echo "Success, wrote ($somecontent) to file ($filename)";

    fclose($handle);

} else {
    echo "The file $filename is not writable";
}

?>
