
<?php

try
{
	//Open database connection
	$con = mysql_connect("localhost","root","");
	mysql_select_db("tfwsmg", $con);

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get records from database
		$result = mysql_query("SELECT * FROM tabelformula;");
		
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
				
		$result = mysql_query("INSERT INTO tabelformula(AgentID, tanggal, a, b, c, author) 
		VALUES('" . $_POST["AgentID"] . "', '"
		. $_POST["tanggal"] . "', '"
		. $_POST["a"] . "', '"
		. $_POST["b"] . "', '"
		. $_POST["c"] . "', '"
		. $_POST["author"] . "');" 	
		);
		
		
		//Get last inserted record (to return to jTable)
		//$result = mysql_query("SELECT * FROM tabelformula WHERE noagent = LAST_INSERT_ID();");
		$result = mysql_query("SELECT * FROM tabelformula WHERE noagent = LAST_INSERT_ID();");
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
		$result = mysql_query("UPDATE tabelformula SET AgentID = '" . $_POST["AgentID"] 
																 . "', tanggal = " . $_POST["tanggal"]
																 . "', a = " . $_POST["a"]
																 . "', b = " . $_POST["b"]
																 . "', c = " . $_POST["c"]
																 . "', author = " . $_POST["author"]
																 . " WHERE AgentID = " . $_POST["AgentID"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM tabelformula WHERE noagent = " . $_POST["noagent"] . ";");

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