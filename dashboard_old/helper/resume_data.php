<?php
mysql_select_db($database_lubu, $lubu);
$query_lasthour = "SELECT SamplingDate, SamplingTime,WLevel FROM $agentname ORDER BY ReceivedDate DESC,ReceivedTime desc  LIMIT 0 , 12";
$lasthour = mysql_query($query_lasthour, $lubu) or die(mysql_error());
$row_lasthour = mysql_fetch_assoc($lasthour);
$totalRows_lasthour = mysql_num_rows($lasthour);

$i=0;
$jmlhour=0;
$wlbox = "";
$lastdate="";
	  do { 
	  		$lastdate=$row_lasthour['SamplingDate']."\t"; 
         	//echo $row_lasthour['SamplingTime']."\t";
         	//echo $row_lasthour['WLevel']."<br>";
			$wlbox = $wlbox.$row_lasthour['WLevel'].",";
			$jmlhour = $jmlhour+$row_lasthour['WLevel'];
			$i=$i+1;
    } while ($row_lasthour = mysql_fetch_assoc($lasthour)); 
	
$wlbox = substr($wlbox,0,-1);

$newdate = strtotime ( '-1 day' , strtotime ( $lastdate ) ) ;
$newdate = date ( 'Y-m-j' , $newdate ); 	

mysql_select_db($database_lubu, $lubu);
$query_minusday = "SELECT SamplingDate, SamplingTime, WLevel FROM $agentname WHERE SamplingDate = '$newdate' group by hour(SamplingTime)";
$minusday = mysql_query($query_minusday, $lubu) or die(mysql_error());
$row_minusday = mysql_fetch_assoc($minusday);
$totalRows_minusday = mysql_num_rows($minusday);

$minusdaytgl = array();
$minusdayjam = array();
$minusdaypda = array();
$minusdayjml = 0;
$minusdayavg = 0;
$minusdaybox = "";
$i=0;
do{
$minusdaytgl[$i]=$row_minusday['SamplingDate'];
$minusdayjam[$i]=$row_minusday['SamplingTime'];
$minusdaypda[$i]=$row_minusday['WLevel'];
$minusdayjml 	= $minusdayjml+$minusdaypda[$i];
$minusdaybox 	= $minusdaybox.$row_minusday['WLevel'].",";

$i=$i+1;
} while ($row_minusday = mysql_fetch_assoc($minusday));


$minusdayavg = $minusdayjml/$totalRows_minusday;
$minusdaybox = substr($minusdaybox,0,-1);


$newdateweek = strtotime ( '-1 week' , strtotime ( $lastdate ) ) ;
$newdateweek = date ( 'Y-m-j' , $newdateweek );

mysql_select_db($database_lubu, $lubu);
$query_minusweek = "SELECT SamplingDate, SamplingTime, WLevel FROM $agentname WHERE SamplingDate between '$newdateweek' and '$lastdate' group by day(SamplingDate)";
$minusweek = mysql_query($query_minusweek, $lubu) or die(mysql_error());
$row_minusweek = mysql_fetch_assoc($minusweek);
$totalRows_minusweek = mysql_num_rows($minusweek);

$minusweektgl = array();
$minusweekjam = array();
$minusweekpda = array();
$minusweekjml = 0;
$minusweekavg = 0;
$minusweekbox = "";
$i=0;
do{
$minusweektgl[$i]=$row_minusweek['SamplingDate'];
$minusweekjam[$i]=$row_minusweek['SamplingTime'];
$minusweekpda[$i]=$row_minusweek['WLevel'];
$minusweekjml 	= $minusweekjml+$minusweekpda[$i];
$minusweekbox 	= $minusweekbox.$row_minusweek['WLevel'].",";

$i=$i+1;
} while ($row_minusweek = mysql_fetch_assoc($minusweek));


$minusweekavg = $minusweekjml/$totalRows_minusweek;
$minusweekbox = substr($minusweekbox,0,-1);


$newdatemonth = strtotime ( '-1 month' , strtotime ( $lastdate ) ) ;
$newdatemonth = date ( 'Y-m-j' , $newdatemonth );
mysql_select_db($database_lubu, $lubu);
$query_minusmonth = "SELECT SamplingDate, SamplingTime, WLevel FROM $agentname WHERE SamplingDate between '$newdatemonth' and '$lastdate' group by day(SamplingDate)";
$minusmonth = mysql_query($query_minusmonth, $lubu) or die(mysql_error());
$row_minusmonth = mysql_fetch_assoc($minusmonth);
$totalRows_minusmonth = mysql_num_rows($minusmonth);

$minusmonthtgl = array();
$minusmonthjam = array();
$minusmonthpda = array();
$minusmonthjml = 0;
$minusmonthavg = 0;
$minusmonthbox = "";
$i=0;
do{
$minusmonthtgl[$i]=$row_minusmonth['SamplingDate'];
$minusmonthjam[$i]=$row_minusmonth['SamplingTime'];
$minusmonthpda[$i]=$row_minusmonth['WLevel'];
$minusmonthjml 	= $minusmonthjml+$minusmonthpda[$i];
$minusmonthbox 	= $minusmonthbox.$row_minusmonth['WLevel'].",";

$i=$i+1;
} while ($row_minusmonth = mysql_fetch_assoc($minusmonth));


$minusmonthavg = $minusmonthjml/$totalRows_minusmonth;
$minusmonthbox = substr($minusmonthbox,0,-1);


?>

		
		
			<div class="row-fluid">
				
				<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
					<div class="boxchart"><?php echo $wlbox; ?></div>
					<div class="number"><?php echo number_format($jmlhour/12,1); ?></div>
					<div class="title">Rata-rata H <br> dalam 1 jam</div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>	
				</div>
				<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
					<div class="boxchart"><?php echo $minusdaybox; ?></div>
					<div class="number"><?php echo number_format($minusdayavg,1); ?></i></div>
					<div class="title">Rata-rata H <br> 1 hari sebelum</div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>
				</div>
				<div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
					<div class="boxchart"><?php echo $minusweekbox; ?></div>
					<div class="number"><?php echo number_format($minusweekavg,1); ?></div>
					<div class="title">Rata-rata H <br> dalam 1 minggu </div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>
				</div>
				<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
					<div class="boxchart"><?php echo $minusmonthbox; ?></div>
					<div class="number"><?php echo number_format($minusmonthavg,1); ?></div>
					<div class="title">Rata-rata H <br> dalam 1 bulan</div>
					<div class="footer">
						<a href="#"> read full report</a>
					</div>
				</div>	
				
			</div>		
<?php
mysql_free_result($lasthour);

mysql_free_result($minusday);
?>
		
