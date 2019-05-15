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

	$from 	= isset($params['from']) ? $params['from'] : '';
	$to 	= isset($params['to']) ? $params['to'] : '';

	

	$columns = array(
		0 => 'ReceivedDate',
		1 => 'ReceivedTime',
		2 => 'SamplingDate',
		3 => 'SamplingTime', 
		4 => 'WLevel',
		5 => 'WLevel'
	);

	

	$where_condition = $sqlTot = $sqlRec = $order = "";

	if(!empty($from) && !empty($to)){
		$where_condition .=	" WHERE (SamplingDate between '".$from."' AND '".$to."') ";
	}
	$sql_query = "SELECT ReceivedDate, ReceivedTime, SamplingDate,SamplingTime, WLevel , Wlevel*1.32 as debit FROM $agentname";
    
    $sqlTot .= $sql_query;
	$sqlRec .= $sql_query;
	
	if(isset($where_condition) && $where_condition != '') {
		$sqlTot .= $where_condition;
		$sqlRec .= $where_condition;
	}

	$order2 = "";
	if($params['iSortCol_0']=="0"){
		$order2 = ", ReceivedTime " .$params['sSortDir_0'];
	}else if($params['iSortCol_0']=="2"){
		$order2 = ", SamplingTime " .$params['sSortDir_0'];
	}

    $length = $params['iDisplayLength'];
    if($length > 0 ){
        $sqlRec .=  " ORDER BY ". $columns[$params['iSortCol_0']]."   ".$params['sSortDir_0']."  ".$order2 ." LIMIT ".$params['iDisplayStart']." ,".$length." ";
    }else{
        $sqlRec .=  " ORDER BY ". $columns[$params['iSortCol_0']]."   ".$params['sSortDir_0']." ".$order2 ." ";
    }
    $sqlTot .=  " ORDER BY ". $columns[$params['iSortCol_0']]."   ".$params['sSortDir_0']." ";
	// var_dump($sqlRec);exit;
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
	