<?php require_once('Connections/lubu.php'); ?>
<?php

$flag = 0;

//cek data
mysql_select_db($database_lubu, $lubu);
$query_AgentType = "SELECT AgentID, AgentName, AgentType, Sungai, agent.Normal, agent.SiagaLower, agent.SiagaUpper, agent.CriticalLower, agent.AgentPhone FROM agent where Reference = 1 ORDER BY agent.AgentPhone ASC";
$AgentType = mysql_query($query_AgentType, $lubu) or die(mysql_error());
$row_AgentType = mysql_fetch_assoc($AgentType);
$totalRows_AgentType = mysql_num_rows($AgentType);


do{
			$table = $row_AgentType['AgentName'];
			mysql_select_db($database_lubu, $lubu);
			$query_received_date = "SELECT * FROM  $table  ORDER BY ReceivedDate DESC,ReceivedTime desc  LIMIT 0 , 1";
			$received_date = mysql_query($query_received_date, $lubu) or die(mysql_error());
			$row_received_date = mysql_fetch_assoc($received_date);
			$totalRows_received_date = mysql_num_rows($received_date);
			
			
			
			$waktu_awal	= $row_received_date['SamplingDate']." ".$row_received_date['SamplingTime'];
			$awal  		= strtotime($waktu_awal);
			$akhir 		= strtotime(date('Y-m-d H:i:00'));
			//$akhir 		= strtotime(date('2018-03-11 23:00:00'));
							
			$diff  		= $akhir - $awal;

			$hari		= floor($diff / (60 * 60 *24));
			$jam   		= floor($diff / (60 * 60))-($hari*24);
			$menit		= floor($diff/(60)) - ($hari*$jam*60*24);
			
			/*
			if ($jam == 2 ||$jam == 4 ||$jam == 6 || $jam == 8 ||$jam == 10 ||$jam == 12 ||$jam == 14 ||$jam == 16 ||$jam == 18 ||$jam == 20 ||$jam == 22 ||$jam == 24)
			*/
		
		if ($jam == 6 || $jam == 12 ||$jam == 18 ||$jam == 24)
		
			{ 
				//echo $table . " tidak mengirim data " . $hari . " hari ," . $jam . " jam <br>";
				$flag = 1;
			}
			
} while ($row_AgentType = mysql_fetch_assoc($AgentType));


if ($flag == 1)
{
	include "sendEmail-v156.php";
	include_once "simple_html_dom.php";
	 
	$to       = 'candra@lhe.co.id';
	$subject  = 'Reminder : '. date('Y-m-d H:i:s');

	$headers = "From: " . strip_tags($_POST['req-email']) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

	$message 	= file_get_html('http://localhost/email/resume.php');

	 
	// user dan password gmail
	$sender   = 'lubu.energi@gmail.com';
	$password = '//ombilin1234';
	 
	if(email_localhost($to, $subject, $message, $sender, $password))
		echo "Reminder". date('Y-m-d H:i:s');
	else
		echo "Email sending failed";
}

if ($flag == 0)
{echo "Data lengkap";}
?>