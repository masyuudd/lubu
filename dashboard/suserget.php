
<?php

try
{
	//Open database connection
	$con = mysql_connect("localhost","hydrocom_ffws","hydrosix292");
	mysql_select_db("tfwsmg", $con);

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get records from database
		$result = mysql_query("SELECT * FROM users;");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		//Insert record into database
				
		$result = mysql_query("INSERT INTO users(username, password, level, name) 
		VALUES('" . $_POST["username"] . "', '"
		. $_POST["password"] . "', '"
		. $_POST["level"] . "', '"
		. $_POST["name"] . "');" 	
		);
		
		
		//Get last inserted record (to return to jTable)
		//$result = mysql_query("SELECT * FROM users WHERE nouser = LAST_INSERT_ID();");
		$result = mysql_query("SELECT * FROM users WHERE nouser = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
		
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE users SET username = '" . $_POST["username"] 
																 . "', password = " . $_POST["password"]
																 . "', a = " . $_POST["level"]
																 . "', b = " . $_POST["name"]
																 . " WHERE username = " . $_POST["username"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM users WHERE nouser = " . $_POST["nouser"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>