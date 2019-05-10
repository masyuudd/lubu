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
    $username 	= isset($params['username']) ? $params['username'] : '';
    // var_dump($_REQUEST);exit;
    $sql_query = "SELECT * FROM users WHERE username = '".$username."'";

    $queryTot = mysqli_query($con, $sql_query) or die("Database Error:". mysqli_error($con));

    $totalRecords = mysqli_num_rows($queryTot);

    if($totalRecords){
        $response = array(
            "status"          => false,   
            "message"         => "Username in use"
        );
    }else{
        $pass 	= isset($params['password']) ? $params['password'] : '';
        $password = md5($pass);
        $name 	= isset($params['name']) ? $params['name'] : '';
        $level 	= isset($params['level']) ? $params['level'] : '';

        $sql = "INSERT INTO users (username, password, name, level, isactive) 
        VALUES ('".$username."', '".$password."', '".$name."', '".$level."', '1')";

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
	// $password 	= isset($params['password']) ? $params['password'] : '';
	
	echo json_encode($response);
?>
	