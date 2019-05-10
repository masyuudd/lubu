<?php require_once('Connections/lubu.php'); ?>
<?php
// ========================= muka air =====================================
mysql_select_db($database_lubu, $lubu);
$query_AgentType = "SELECT AgentID, AgentName, AgentType, Sungai, agent.Normal, agent.SiagaLower, agent.SiagaUpper, agent.CriticalLower, agent.AgentPhone FROM agent ORDER BY agent.AgentPhone ASC";
$AgentType = mysql_query($query_AgentType, $lubu) or die(mysql_error());
$row_AgentType = mysql_fetch_assoc($AgentType);
$totalRows_AgentType = mysql_num_rows($AgentType);


?>

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').dataTable({
		         "aaSorting": [[3,'desc'], [4,'desc']],
		       });
		} );
	</script>

	

	
	
<style type="text/css">
<!--
button {
    border: 0;
    padding: 0;
    display: inline;
    background: none;
    text-decoration: none;
	text-align:left;
    color: blue;
}
button:hover {
    cursor: pointer;
}
.style1 {font-size: xx-large}
.style2 {font-size: x-large}
-->
</style>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%">&nbsp;</td>
    <td>&nbsp;
	
	
<table id="" class="display">
<thead>
  <tr bgcolor="">
    <td><div align="center"><strong>No</strong></div></td>
    <td><div align="center"><strong>Location</strong></div></td>
	<td><div align="center"><strong>Sampling Date </strong></div></td>
	<td><div align="center"><strong>Sampling Time </strong></div></td>
	<td><div align="center"><strong>Not received Data for:</strong></div></td>
	<td><div align="center"><strong> Status </strong></div></td>
  </tr>
 </thead>
 
 <tbody>
  <?php $no= 1; do { 
  
  			if ($row_AgentType['AgentType']=='0')
				{
					$tipe_pos = "Curah Hujan";
					$redir	= "#";
			
				}
			if ($row_AgentType['AgentType']=='1')
				{
					$tipe_pos = "Klimatologi";
					$redir	= "#";
			
				}
			if ($row_AgentType['AgentType']=='2')
				{
					$tipe_pos = "POS Duga Air";
					$redir	= "wldetail.php?type=daily&lokasi=".$row_AgentType['AgentName']."&name=".$row_AgentType['Sungai'];
			
				}
			if ($row_AgentType['AgentType']=='3')
				{
					$tipe_pos = "Campuran";
					$redir	= "#";
			
				}

  ?>
  	  	
    <tr>
      <td><?php echo $no; $no=$no+1;?></td>
      <td>
	  <form id="form1" name="form1" method="post" action=<?php echo $redir; ?>>
        <input name="a" type="hidden" id="a" value="<?php echo $row_AgentType['AgentName']; ?>" />
		<input name="b" type="hidden" id="b" value="<?php echo $row_AgentType['Sungai']; ?>" />
		<input name="c" type="hidden" id="c" value="<?php echo intval(substr($row_received_date['ReceivedDate'],5,2)); ?>" />
          	<button><?php echo $row_AgentType['AgentName']; ?></button>
      </form>
	  </td>
      
  
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
			$date1 = strtotime($row_received_date['ReceivedDate']);
			$datelate = strtotime(date("Y-m-d"))-$date1;
			//$datelate = round($datelate/86400);
			$datelate 	= $datelate/(3600);
			$daylate	= round($datelate/24); 
			$tg1 = $datelate%24;
			echo $daylate." Days, ".$tg1." Hours";
			?>	  
	  </td>
	  
	  		<?php
			
			$ma 	= $row_received_date['WLevel']/100;
			$normal	= $row_AgentType['Normal'];
			$s1		= $row_AgentType['SiagaLower'];
			$s2		= $row_AgentType['SiagaUpper'];
			$s3		= $row_AgentType['CriticalLower'];
						
			if ($row_AgentType['AgentType']=='2')
	  		{
			if($ma <= $normal)
				{ 
					?>
			<td bgcolor=<?php echo "#0066CC" ?> > <strong><?php echo $ma." / Normal" ?></strong> </td>
			<?php 
				};
			if(($normal < $ma) AND ($ma<=$s1)) 
				{ 
					?>
			<td bgcolor=<?php echo "#009900" ?> > <strong><?php echo $ma." / Siaga-1" ?></strong> </td>
			<?php 
				};
			if(($s1 < $ma) AND ($ma<=$s2)) 
				{ 
					?>
			<td bgcolor=<?php echo "#FFCC00" ?> > <strong><?php echo $ma." / Siaga-2" ?></strong> </td>
			<?php 
				};
			if(($s2 < $ma) AND ($ma<=$s3)) 
				{ 
					?>
			<td bgcolor=<?php echo "#FF9900" ?> > <strong><?php echo $ma." / Siaga-3" ?></strong> </td>
			<?php 
				};
			if($ma>$s3) 
			{ 
			?>
			<td bgcolor=<?php echo "#FF3333" ?> > <strong><?php echo $ma." / BAHAYA" ?></strong> </td>
			<?php
				
			};
			};
			
			
			if ($row_AgentType['AgentType']=='0')
	  		{
			?>
			<td > <strong><?php echo $row_received_date['Rain']; ?></strong> </td>
			<?php
			};
			
			if ($row_AgentType['AgentType']=='1')
	  		{
			?>
			<td > <strong><?php echo "-" ?></strong> </td>
			<?php
			}
						
			
			?>
    </tr>

	
    <?php } while ($row_AgentType = mysql_fetch_assoc($AgentType)); ?>
</tbody>
</table>

	
	</td>
  </tr>
</table>

<br>

<?php
mysql_free_result($AgentType);
mysql_free_result($received_date);
?>