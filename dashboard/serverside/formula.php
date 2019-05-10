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
    
    if($params['act'] == 'read') {
        $columns = array(
            0 => 'AgentID',
            1 => 'tanggal',
            2 => 'a',
            3 => 'b',
            4 => 'c',
            5 => 'author'
        );

        $where_condition = $sqlTot = $sqlRec = $order = "";
          
        $sql_query = "SELECT * FROM tabelformula";
        
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
        
        $response = array(
            "draw"            => intval( $params['sEcho'] ),   
            "recordsTotal"    => intval( $totalRecords ),  
            "recordsFiltered" => intval($totalRecords),
            "data"            => $data
        );
    }else if($params['act'] == 'create'){
        $AgentID 	= isset($params['AgentID']) ? $params['AgentID'] : '';
        
        $sql_query  = "SELECT * FROM tabelformula WHERE AgentID = '".$AgentID."'";
        
        $queryTot = mysqli_query($con, $sql_query) or die("Database Error:". mysqli_error($con));

        $totalRecords = mysqli_num_rows($queryTot);

        if($totalRecords){
            $response = array(
                "status"          => false,   
                "message"         => "AgentID in use"
            );
        }else{
            $tanggal 	= isset($params['tanggal']) ? $params['tanggal'] : '';
            $a 	        = isset($params['a']) ? $params['a'] : '';
            $b 	        = isset($params['b']) ? $params['b'] : '';
            $c	        = isset($params['c']) ? $params['c'] : '';
            $author 	= isset($params['author']) ? $params['author'] : '';

            $sql = "INSERT INTO tabelformula (AgentID, tanggal, a, b, c, author) 
            VALUES ('".$AgentID."', '".$tanggal."', '".$a."', '".$b."', '".$c."', '".$author."')";

            $querySave = mysqli_query($con, $sql) or die("Database Error:". mysqli_error($con));
            if($querySave){
                $response = array(
                    "status"          => true,   
                    "message"         => "Data Successfully Saved"
                );
            }else{
                $response = array(
                    "status"          => false,   
                    "message"         => "Data Failed to save"
                );
            }
            
        }
    }else if($params['act'] == 'update'){
        $id 	    = isset($params['id']) ? $params['id'] : '';
        $AgentID 	= isset($params['AgentID']) ? $params['AgentID'] : '';

        $sql_query = "SELECT * FROM tabelformula WHERE AgentID = '".$AgentID."' and noagent != '".$id."' ";

        $queryTot = mysqli_query($con, $sql_query) or die("Database Error:". mysqli_error($con));

        $totalRecords = mysqli_num_rows($queryTot);
        
        if($totalRecords){
            $response = array(
                "status"          => false,   
                "message"         => "AgentID already in use"
            );
        }else{
            $tanggal 	= isset($params['tanggal']) ? $params['tanggal'] : '';
            $a 	        = isset($params['a']) ? $params['a'] : '';
            $b 	        = isset($params['b']) ? $params['b'] : '';
            $c	        = isset($params['c']) ? $params['c'] : '';
            $author 	= isset($params['author']) ? $params['author'] : '';

            $sql = "UPDATE tabelformula SET AgentID = '".$AgentID."',  tanggal = '".$tanggal."', a = '".$a."', b = '".$b."' , c = '".$c."', author = '".$author."'WHERE noagent = '".$id."' ";

            $queryUpdate = mysqli_query($con, $sql) or die("Database Error:". mysqli_error($con));
            
            if($queryUpdate){
                $response = array(
                    "status"          => true,   
                    "message"         => "Data Successfully Updated"
                );
            }else{
                $response = array(
                    "status"          => false,   
                    "message"         => "Data Failed to Update"
                );
            }
            
        }
    }else if($params['act'] == 'delete'){
        $id 	= isset($params['id']) ? $params['id'] : '';
        $sql    = "DELETE FROM tabelformula WHERE noagent = '".$id."' ";

        $queryDelete = mysqli_query($con, $sql) or die("Database Error:". mysqli_error($con));
        
        if($queryDelete){
             $response = array(
                "status"          => true,   
                "message"         => "Data Successfully Deleted"
            );
        }else{
            $response = array(
                "status"          => false,   
                "message"         => "Data Failed to Delete"
            );
        }
    }

	
	
	echo json_encode($response);
?>
	