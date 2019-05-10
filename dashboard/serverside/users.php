<?php
	
	//db details
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'tfwsmg';

    //connect and select db
    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;
	
	$columns = array(
		0 => 'username',
		1 => 'name',
		2 => 'level'
	);

	

	$where_condition = $sqlTot = $sqlRec = $order = "";

	
	$sql_query = "SELECT * FROM users";
    
    $sqlTot .= $sql_query;
	$sqlRec .= $sql_query;
	
	if(isset($where_condition) && $where_condition != '') {
		$sqlTot .= $where_condition;
		$sqlRec .= $where_condition;
    }
    
    $sqlRec .=  " ORDER BY ". $columns[$params['iSortCol_0']]."   ".$params['sSortDir_0']." ";
    
    $sqlTot .=  " ORDER BY ". $columns[$params['iSortCol_0']]."   ".$params['sSortDir_0']." ";
    
	$queryTot = mysqli_query($con, $sqlTot) or die("Database Error:". mysqli_error($con));

	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($con, $sqlRec) or die("Error to Get the Post details.");
	
	while( $row = $queryRecords->fetch_assoc() ) { 
		$data[] = $row;
	}	
	
	$json_data = array(
		"draw"            => intval( $params['sEcho'] ),   
		"recordsTotal"    => intval( $totalRecords ),  
		"recordsFiltered" => intval($totalRecords),
		"data"            => $data
	);
	
	echo json_encode($json_data);
?>
	