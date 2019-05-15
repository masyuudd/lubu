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
	$agentname = $params['agentname'];

	$year 	= isset($params['year']) ? $params['year'] : '';

	

	$columns = array(
		0 => 'tahun',
		1 => 'bulan',
		2 => 'WLevel',
		3 => 'debit'
	);

	

	$where_condition = $sqlTot = $sqlRec = $order = "";

	if(!empty($year)){
		$where_condition .=	" WHERE YEAR( ReceivedDate ) = '".$year."'  ";
	}
	$sql_query = "SELECT YEAR( ReceivedDate ) AS tahun, MONTH( ReceivedDate ) AS bulan, AVG( WLevel ) AS WLevel, ( AVG( Wlevel ) ) * 1.32 AS debit FROM $agentname";
    
    $sqlTot .= $sql_query;
	$sqlRec .= $sql_query;
	
	if(isset($where_condition) && $where_condition != '') {
		$sqlTot .= $where_condition;
		$sqlRec .= $where_condition;
	}

	$order2 = "";
	
	if($params['iSortCol_0']=="0"){
		$order2 = ", bulan " .$params['sSortDir_0'];
	}
	

    $length = $params['iDisplayLength'];
    if($length > 0 ){
        $sqlRec .=  " GROUP BY tahun, bulan ORDER BY ". $columns[$params['iSortCol_0']]."   ".$params['sSortDir_0']."  ".$order2." LIMIT ".$params['iDisplayStart']." ,".$length." ";
    }else{
        $sqlRec .=  " GROUP BY tahun, bulan ORDER BY ". $columns[$params['iSortCol_0']]."   ".$params['sSortDir_0']." ".$order2." ";
    }
    $sqlTot .=  " GROUP BY tahun, bulan ORDER BY ". $columns[$params['iSortCol_0']]."   ".$params['sSortDir_0']." ".$order2." ";
    //  echo $sqlRec;
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
	