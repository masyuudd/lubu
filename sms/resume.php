<?php require_once('helper/Connections/map.php'); ?>
<?php
// ========================= muka air =====================================
mysql_select_db($database_map, $map);
$query_AgentType = "SELECT AgentID, AgentName, AgentType, Sungai, agent.Normal, agent.SiagaLower, agent.SiagaUpper, agent.CriticalLower, agent.AgentPhone FROM agent ORDER BY agent.AgentPhone ASC";
$AgentType = mysql_query($query_AgentType, $map) or die(mysql_error());
$row_AgentType = mysql_fetch_assoc($AgentType);
$totalRows_AgentType = mysql_num_rows($AgentType);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/page.css">
<link rel="stylesheet" type="text/css" href="css/table.css">

<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').dataTable();
		} );
	</script>

<title>Data Terkini</title>
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
</head>

<body id="dt_example">

<div align="center" class="style1"> <br />
  <span class="style2">SMS Report </span><br />
 </div>
<table id="example" class="display">
<thead>
  <tr bgcolor="#0099CC">
    <td><div align="center"><strong>No</strong></div></td>
    <td><div align="center"><strong>Lokasi</strong></div></td>
	<td><div align="center"><strong>Jenis POS </strong></div></td>
	<td><div align="center"><strong>Received Date </strong></div></td>
	<td><div align="center"><strong>Received Time </strong></div></td>
	<td><div align="center"><strong>Mobile Number </strong></div></td>
	<td><div align="center"><strong> Status </strong></div></td>
  </tr>
 </thead>
 
 <tbody>
  <?php $no= 1; do { ?>
  	  	
    <tr>
      <td><?php echo $no; $no=$no+1;?></td>
      <td><form id="form1" name="form1" method="post" action="dtdetail.php">
        <input name="a" type="hidden" id="a" value="<?php echo $row_AgentType['AgentName']; ?>" />
		<input name="b" type="hidden" id="b" value="<?php echo $row_AgentType['Sungai']; ?>" />
		<input name="c" type="hidden" id="c" value="<?php echo intval(substr($row_received_date['ReceivedDate'],5,2)); ?>" />
          	<button><?php echo $row_AgentType['AgentName']; ?></button>
      </form>
	  </td>
      
  
	  <td><?php
			if ($row_AgentType['AgentType']=='0')
				{echo "Curah Hujan";}
			if ($row_AgentType['AgentType']=='1')
				{echo "Klimatologi";}
			if ($row_AgentType['AgentType']=='2')
				{echo "POS Duga Air";}
			if ($row_AgentType['AgentType']=='3')
				{echo "POS Hujan";}
		 
	  	$table = $row_AgentType['AgentName'];
	  	mysql_select_db($database_map, $map);
		$query_received_date = "SELECT * FROM  $table  ORDER BY ReceivedDate DESC,ReceivedTime desc  LIMIT 0 , 1";
		$received_date = mysql_query($query_received_date, $map) or die(mysql_error());
		$row_received_date = mysql_fetch_assoc($received_date);
		$totalRows_received_date = mysql_num_rows($received_date);

	  ?></td>
	  <td><?php echo $row_received_date['ReceivedDate']; ?>	  </td>
	  <td><?php echo $row_received_date['ReceivedTime']; ?>	  </td>
	  <td><?php echo $row_AgentType['AgentPhone']; ?>  </td>
	  
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
</body>
</html>
<?php
mysql_free_result($AgentType);


mysql_free_result($received_date);
?>