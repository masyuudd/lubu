<?php require_once('Connections/lubu.php'); ?>
<?php
// ========================= muka air =====================================
mysql_select_db($database_lubu, $lubu);
$query_AgentType = "SELECT AgentID, AgentName, AgentType, Sungai, agent.Normal, agent.SiagaLower, agent.SiagaUpper, agent.CriticalLower, agent.AgentPhone FROM agent where Reference = 1 ORDER BY agent.AgentPhone ASC";
$AgentType = mysql_query($query_AgentType, $lubu) or die(mysql_error());
$row_AgentType = mysql_fetch_assoc($AgentType);
$totalRows_AgentType = mysql_num_rows($AgentType);


?>


<br>
	
	
<table border = "1" cellspacing="0" >
<thead>
  <tr>
    <td><div align="center"><strong>No</strong></div></td>
    <td><div align="center"><strong>Location</strong></div></td>
	<td><div align="center"><strong>Sampling Date </strong></div></td>
	<td><div align="center"><strong>Sampling Time </strong></div></td>
	<td><div align="center"><strong>Not received Data for:</strong></div></td>
  </tr>
 </thead>
 
 <tbody>
  <?php $no= 1; do 
  { 
  
  			

  ?>
  	  	
    <tr>
      <td><?php echo $no; $no=$no+1;?></td>
      <td><?php echo $row_AgentType['AgentName'];?></td>
	  <?php
			
	  	$table = $row_AgentType['AgentName'];
	  	mysql_select_db($database_lubu, $lubu);
		$query_received_date = "SELECT * FROM  $table  ORDER BY ReceivedDate DESC,ReceivedTime desc  LIMIT 0 , 1";
		$received_date = mysql_query($query_received_date, $lubu) or die(mysql_error());
		$row_received_date = mysql_fetch_assoc($received_date);
		$totalRows_received_date = mysql_num_rows($received_date);
	  ?>
	  
	  <td><?php echo $row_received_date['SamplingDate']; ?>	  </td>
	  <td><?php echo $row_received_date['SamplingTime']; ?>	  </td>
	  <td>
			<?php 			
			$waktu_awal = $row_received_date['SamplingDate']." ".$row_received_date['SamplingTime'];
			$awal  = strtotime($waktu_awal);
			$akhir = strtotime(date('Y-m-d H:i:00'));
							
			$diff  = $akhir - $awal;

			$hari	= floor($diff / (60 * 60 *24));
			$jam   	= floor($diff / (60 * 60))-($hari*24);
			$menit	= floor($diff/(60)) - ($hari*$jam*60*24);
			echo $hari. " days " . $jam .  ' Hours ';
			
			
			?>	  
	  </td>
	  
	  		
    </tr>

	
    <?php } while ($row_AgentType = mysql_fetch_assoc($AgentType)); ?>
</tbody>
</table>



<br>

<?php
mysql_free_result($AgentType);
mysql_free_result($received_date);
?>