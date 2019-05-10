<?php
	
	//db details
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'tfwsmg';

    //connect and select db
    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	
	
	$sql_query = "SELECT * FROM agent";
    
    $queryRecords = mysqli_query($con, $sql_query) or die("Error to Get the Post details.");
	
	while( $row = $queryRecords->fetch_assoc() ) {
        $x = array('id' => $row['AgentName'] , 'text' => $row['AgentName']); 
		$data[] = $x;
	}	

	echo json_encode($data);
?>
	