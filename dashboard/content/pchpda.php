<?php require_once('Connections/lubu.php'); ?>
<?php
mysql_select_db($database_lubu, $lubu);
$query_wlagent = "SELECT agent.AgentID, agent.AgentName, agent.AgentPhone, agent.AgentLocation, agent.AgentType, agent.DAS, agent.Sungai, agent.LRain FROM agent WHERE agent.AgentType = 2";
$wlagent = mysql_query($query_wlagent, $lubu) or die(mysql_error());
$row_wlagent = mysql_fetch_assoc($wlagent);
$totalRows_wlagent = mysql_num_rows($wlagent);

mysql_select_db($database_lubu, $lubu);
$query_rgagent = "SELECT agent.AgentID, agent.AgentName, agent.AgentPhone, agent.AgentLocation, agent.AgentType, agent.DAS, agent.Sungai, agent.LRain FROM agent WHERE agent.AgentType = 0";
$rgagent = mysql_query($query_rgagent, $lubu) or die(mysql_error());
$row_rgagent = mysql_fetch_assoc($rgagent);
$totalRows_rgagent = mysql_num_rows($rgagent);
?>

<div class="box">
<div class="box-header">
<h2><i class="halflings-icon list-alt"></i><span class="break"></span>Pos Muka Air</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>				
</div>
		<div class="box-content">
		
            <table id="" class="display" cellspacing="0" width="100%">
              <thead>
			  <tr>
                <th>AgentID</th>
                <th>AgentName</th>
                <th>AgentPhone</th>
                <th>AgentLocation</th>
                <th>AgentType</th>
                <th>DAS</th>
                <th>Sungai</th>
                <th>LRain</th>
              </tr>
			  </thead>
			  <tbody>
              <?php do { ?>
                <tr>
                  <td><?php echo $row_wlagent['AgentID']; ?></td>
                  <td><a href="wldb_.php?lokasi=<?php echo $row_wlagent['AgentName']; ?>&name=<?php echo $row_wlagent['Sungai']; ?>"><?php echo $row_wlagent['AgentName']; ?></a></td>
                  <td><?php echo $row_wlagent['AgentPhone']; ?></td>
                  <td><?php echo $row_wlagent['AgentLocation']; ?></td>
                  <td><?php echo $row_wlagent['AgentType']; ?></td>
                  <td><?php echo $row_wlagent['DAS']; ?></td>
                  <td><?php echo $row_wlagent['Sungai']; ?></td>
                  <td><?php echo $row_wlagent['LRain']; ?></td>
                </tr>
                <?php } while ($row_wlagent = mysql_fetch_assoc($wlagent)); ?>
				</tbody>
            </table>
			</div>
</div>

			
<div class="box">
<div class="box-header">
<h2><i class="halflings-icon list-alt"></i><span class="break"></span>Pos Curah Hujan</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>				
</div>
			<div class="box-content"> <table id="" class="display" cellspacing="0" width="100%">
              <thead>
			  <tr>
                <th>AgentID</th>
                <th>AgentName</th>
                <th>AgentPhone</th>
                <th>AgentLocation</th>
                <th>AgentType</th>
                <th>DAS</th>
                <th>Sungai</th>
                <th>LRain</th>
              </tr>
			  </thead>
			  <tbody>
              <?php do { ?>
                <tr>
                  <td><?php echo $row_rgagent['AgentID']; ?></td>
				  <td><a href="rgdb.php?tabel=<?php echo $row_rgagent['AgentName']; ?>&name=<?php echo $row_rgagent['Sungai']; ?>"><?php echo $row_rgagent['AgentName']; ?></a></td>
                  <td><?php echo $row_rgagent['AgentPhone']; ?></td>
                  <td><?php echo $row_rgagent['AgentLocation']; ?></td>
                  <td><?php echo $row_rgagent['AgentType']; ?></td>
                  <td><?php echo $row_rgagent['DAS']; ?></td>
                  <td><?php echo $row_rgagent['Sungai']; ?></td>
                  <td><?php echo $row_rgagent['LRain']; ?></td>
                </tr>
                <?php } while ($row_rgagent = mysql_fetch_assoc($rgagent)); ?>
				</tbody>
            </table>
			
			
			
			
			</div>
</div>
<?php 
mysql_free_result($wlagent);
mysql_free_result($rgagent);
?>