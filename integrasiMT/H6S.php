<?php
$hdr = getallheaders();
$username="h6s";
$password="h6s";
$hdr["Authorization"] = "Basic aDZzOmg2cw==";
$authval = "Basic ".base64_encode($username.":".$password);
$_POST["site"] = "doisp";

echo $authval . "<br>";
echo "aut :" . $hdr["Authorization"] . "<br>";

// check if basic authentication header is match with username password protection
//echo "testing-".$username."--".$password;
if ($hdr["Authorization"]==$authval)
{
	echo "H6S Handler"."<br>";
	//Check if the method is POST
	if ($_SERVER["REQUEST_METHOD"]=="POST")
	{
		// check if form contains site, file
		$site = "";
		$data = "";
		if ($_POST["site"])
		{
			$site = $_POST["site"];
		}
		echo "ini nama filenya<br>".$_FILES["file"]["tmp_name"];
		
		if (!empty($_FILES))
		{
			$ctn=file($_FILES["file"]["tmp_name"]);
			$path=dirname(__FILE__);
			echo "<br>halo ini pathnya<br>";
			echo $path;
			
			$tpath="http://awlr.ombilinpower.co.id/data/".DIRECTORY_SEPARATOR.$_FILES["file"]["name"];
			echo "<br>halo ini tpathnya<br>";
			echo $tpath;
			$targetFile=$path.DIRECTORY_SEPARATOR."DataUpload".DIRECTORY_SEPARATOR.$_FILES["file"]["name"];
			
			echo "<br><br>halo ini target pathnya<br>";
			echo $targetFile;
			echo "<br>";
			
			
			$path=$path.DIRECTORY_SEPARATOR."DataUpload";
			//echo $path."\n";
			//echo $tpath."\n";
			//echo "File length: ".sizeof($ctn)." lines. $ctn\n";
			//foreach ($ctn as $v)
			//{
				//echo $v;
			//	file_put_contents($targetFile, $v, FILE_APPEND | LOCK_EX);
			//}
			//rename($_FILES["file"]["tmp_name"],$path.DIRECTORY_SEPARATOR."DataUpload".DIRECTORY_SEPARATOR.$_FILES["file"]["name"]);
			unlink($tpath);
			rename($_FILES["file"]["tmp_name"],$tpath);
			//file_put_contents($file, $person, FILE_APPEND | LOCK_EX);
			

		}
	}
	else
	{
		echo "H6S:Error Post";
	}
}
else
{
	echo "H6S:auth error";
}
?>
