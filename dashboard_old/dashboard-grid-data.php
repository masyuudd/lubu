<?php
session_start();
?>
<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ffws";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


$agentname 	= $_SESSION["lokasi"];
echo $agentname;
echo "<br>";
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'ReceivedDate',
	1 =>'ReceivedTime',
	2 =>'SamplingDate', 
	3 =>'SamplingTime',
	4=> 'WLevel',
	5=> 'debit'
);

// getting total number records without any search
$sql = "SELECT ReceivedDate,ReceivedTime,SamplingDate, SamplingTime, (WLevel/100) as WLevel, ((WLevel*1.32)/100) as debit ";
$sql.=" FROM $agentname";

echo $sql;
echo "<br>";

$query=mysqli_query($conn, $sql) or die("dashboard-grid-data.php: get dashboards");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.




$sql = "SELECT ReceivedDate,ReceivedTime,SamplingDate, SamplingTime, (WLevel/100) as WLevel, ((WLevel*1.32)/100) as debit ";
$sql.=" FROM $agentname WHERE 1 = 1";
echo $sql;
echo "<br>";

// getting records as per search parameters
if( !empty($requestData['columns'][0]['search']['value']) ){   //name
	$sql.=" AND ReceivedDate LIKE '".$requestData['columns'][0]['search']['value']."%' ";
}
if( !empty($requestData['columns'][1]['search']['value']) ){   //name
	$sql.=" AND ReceivedTime LIKE '".$requestData['columns'][1]['search']['value']."%' ";
}
if( !empty($requestData['columns'][2]['search']['value']) ){   //name
	$sql.=" AND SamplingDate LIKE '".$requestData['columns'][2]['search']['value']."%' ";
}
if( !empty($requestData['columns'][3]['search']['value']) ){  //salary
	$sql.=" AND SamplingTime LIKE '".$requestData['columns'][3]['search']['value']."%' ";
}
if( !empty($requestData['columns'][4]['search']['value']) ){  //salary
	$sql.=" AND WLevel LIKE '".$requestData['columns'][4]['search']['value']."%' ";
}
if( !empty($requestData['columns'][5]['search']['value']) ){  //salary
	$sql.=" AND debit LIKE '".$requestData['columns'][5]['search']['value']."%' ";
}
$query=mysqli_query($conn, $sql) or die("dashboard-grid-data.php: get dashboards");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
	
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

$query=mysqli_query($conn, $sql) or die("dashboard-grid-data.php: get dashboards");

	


$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	$nestedData[] = $row["ReceivedDate"];
	$nestedData[] = $row["ReceivedTime"];
	$nestedData[] = $row["SamplingDate"];
	$nestedData[] = $row["SamplingTime"];
	$nestedData[] = $row["WLevel"];
	$nestedData[] = $row["debit"];
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
