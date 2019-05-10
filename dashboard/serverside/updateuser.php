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
    $id 	= isset($params['id']) ? $params['id'] : '';
    $obj 	= isset($params['obj']) ? $params['obj'] : '';
    
    // var_dump($obj);exit;

    if($obj == 'profile'){
        $username 	= isset($params['username']) ? $params['username'] : '';

        $sql_query = "SELECT * FROM users WHERE username = '".$username."' and id != '".$id."' ";

        $queryTot = mysqli_query($con, $sql_query) or die("Database Error:". mysqli_error($con));

        $totalRecords = mysqli_num_rows($queryTot);
        
        if($totalRecords){
            $response = array(
                "status"          => false,   
                "message"         => "Username in use"
            );
        }else{
            $name 	    = isset($params['name']) ? $params['name'] : '';
            $level 	    = isset($params['level']) ? $params['level'] : '';
            $isactive 	= isset($params['isactive']) ? $params['isactive'] : '';

            $sql = "UPDATE users SET name = '".$name."',  username = '".$username."', level = '".$level."', isactive = '".$isactive."' WHERE id = '".$id."' ";

            $queryUpdate = mysqli_query($con, $sql) or die("Database Error:". mysqli_error($con));
            // var_dump($sql);exit;
            
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
    }else if($obj == 'password'){
        $pass 	= isset($params['password']) ? $params['password'] : '';
        $password = md5($pass);

        $sql = "UPDATE users SET password = '".$password."' WHERE id = '".$id."' ";
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
    }else if($obj == 'delete'){
        $sql = "DELETE FROM users WHERE id = '".$id."' ";
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
	