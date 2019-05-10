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
		0 => 'SamplingDate', 
		1 => 'WLevel',
		2 => 'WLevel'
	);

	

	$where_condition = $sqlTot = $sqlRec = $order = "";

	// if( !empty($params['search']['value']) ) {
	// 	$where_condition .=	" WHERE ";
	// 	$where_condition .= " ( post_title LIKE '%".$params['search']['value']."%' ";    
	// 	$where_condition .= " OR post_desc LIKE '%".$params['search']['value']."%' )";
	// }
	if(!empty($from) && !empty($to)){
		$where_condition .=	" WHERE (SamplingDate between '".$from."' AND '".$to."') ";
	}
	$sql_query = "SELECT YEAR( ReceivedDate ) AS ReceivedDate, month( ReceivedDate ) AS ReceivedTime, SamplingDate,SamplingTime, AVG( WLevel ) as WLevel , (AVG(Wlevel))*1.32 as debit FROM $agentname";
	$sqlTot .= $sql_query;
	$sqlRec .= $sql_query;
	
	if(isset($where_condition) && $where_condition != '') {
		$sqlTot .= $where_condition;
		$sqlRec .= $where_condition;
	}

	$length = $params['iDisplayLength'];
	if($length > 0 ){
		$sqlRec .=  " GROUP BY date( SamplingDate ) ORDER BY ". $columns[$params['iSortCol_0']]."   ".$params['sSortDir_0']."  LIMIT ".$params['iDisplayStart']." ,".$params['iDisplayLength']." ";
    }else{
        $sqlRec .=  " GROUP BY date( SamplingDate ) ORDER BY ". $columns[$params['iSortCol_0']]."   ".$params['sSortDir_0']." ";
	}
	
 	
	$sqlTot .= " GROUP BY date( SamplingDate )";
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
	