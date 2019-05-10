<?php
require_once('Connections/lubu.php');
if(isset($_POST['btn-upload']))
{    
     
	$file 		= $_FILES['file']['name'];
    $file_loc 	= $_FILES['file']['tmp_name'];
	$file_size 	= $_FILES['file']['size'];
	$file_type 	= $_FILES['file']['type'];
	$agentname 	= $_GET['lokasi'];
	$folder		= "data/";
	
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	$final_file=str_replace(' ','-',$new_file_name);
	$nama_file	= $folder.$final_file;
	if(move_uploaded_file($file_loc,$folder.$final_file))
	{


		$myfile = fopen($nama_file, "r") or die("Unable to open file!");
		
		while(!feof($myfile))
		  {
		  $str 		= fgets($myfile);
		  $data 	= explode(",",$str);
		  $data2 	= explode(" ",$data[0]);
		  $tanggal	= $data2[0];
		  $jam		= $data2[1];
		  
			$date = $tanggal;
			$my_date = date('Y-m-d', strtotime($date));
		$WLevel = $data[1];
		//echo $tanggal."|".$my_date."<br>";
		//echo $tanggal."|".$jam."<br>";
	
	$a = "INSERT INTO ".$agentname." (ReceivedDate, ReceivedTime,SamplingDate,SamplingTime, WLevel) VALUES (";
	$b = "'".$my_date."','".$jam."','".$my_date."','".$jam."',".$WLevel; 
	$c = ");";
	$psql	= $a.$b.$c;
	
	/*
	$myfile = fopen("data.txt", "r") or die("Unable to open file!");
	$txt = $psql;
	fwrite($myfile, $txt);
	fclose($myfile);
	*/
	
	//echo $psql."<br>";
	//echo "nama tabel  ".$agentname;
	//PDO


try {
    $conn = new PDO("mysql:host=$hostname_lubu;dbname=$database_lubu", $username_lubu, $password_lubu);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // begin the transaction
    $conn->beginTransaction();
    // our SQL statements
    $conn->exec($psql);
    // commit the transaction
    $conn->commit();
    echo "New records created successfully";
	?>
	<script>
		alert('success');
        window.location.href='index.php?success';
        </script>
	<?php
    }
catch(PDOException $e)
    {
    // roll back the transaction if something failed
    $conn->rollback();
    echo "Error: " . $e->getMessage();
    }

$conn = null;
	 //end of 

		  }
		fclose($myfile);
		?>
		
		

		<?php
	}
	else
	{
		?>
		<script>
		alert('error while uploading file');
        window.location.href='index.php?fail';
        </script>
		<?php
	}
}
?>