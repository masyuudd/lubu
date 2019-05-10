<?php // ambil dan baca file

date_default_timezone_set('Asia/Jakarta');
$date 	= date("Y-m-d");
$jam   	= Date("H")-1;
$jam1  	= $jam.":00:00";
$jam2  	= $jam.":55:00";
$zstr 	= array();
$que	= "";

//=== testing
$date = "2013-04-23";
$jam   = "06";	
//===

$phile = date("Y_m_d")."_jam_".$jam.".txt";

//lokasi file C:\ffws\UpLoadArea\H6Data\\
$file = fopen("C:\\ffws\\UpLoadArea\\H6Data\\$phile", "r") or exit("Unable to open file!");

$temp=fgets($file);

fclose($file);

?>


<?php // insert db

// db connection
$con=mysqli_connect("localhost","root","","doisp");

$sql = array();

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$st = $temp;
//echo $st;

$st=str_replace("\'","'",$st);
//echo $st;

$sql = explode("#",$st);

$arrlength=count($sql);


for($x=0;$x<$arrlength-1;$x++)
{

if (mysqli_query($con,$sql[$x]))
  {
  echo "successfully"."<br>";
  echo $sql[$x];
  echo "<br><br>";
  }
else
  {
  echo "Error " . mysqli_error($result);
  echo "<br><br>";
  echo $sql[$x];
  
  }

}


?>
