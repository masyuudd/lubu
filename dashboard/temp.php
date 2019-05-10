<?php require_once('Connections/lubu.php'); ?>
<?php 
$agentname 	= $_GET['lokasi'];
//$type 		= $_GET['type'];
$sungai		= $_GET['name'];
//$tahun		= $_GET['tahun'];
//$bulan		= $_GET['bulan'];

?>
<?php
mysql_select_db($database_lubu, $lubu);
$query_mon = "SELECT YEAR( ReceivedDate ) AS ReceivedDate, month( ReceivedDate ) AS ReceivedTime, SamplingDate, Hour(SamplingTime) as SamplingTime , AVG( WLevel ) as WLevel , (AVG(Wlevel))*1.32 as debit FROM $agentname GROUP BY date( SamplingDate ),Hour(SamplingTime)";
$mon = mysql_query($query_mon, $lubu) or die(mysql_error());
$row_mon = mysql_fetch_assoc($mon);
$totalRows_mon = mysql_num_rows($mon);
 
mysql_select_db($database_lubu, $lubu);
$query_getformula = "SELECT * FROM tabelformula WHERE tabelformula.AgentID = '$agentname'";
$getformula = mysql_query($query_getformula, $lubu) or die(mysql_error());
$row_getformula = mysql_fetch_assoc($getformula);
$totalRows_getformula = mysql_num_rows($getformula);

$a=$row_getformula['a'];
$b=$row_getformula['b'];
$c=$row_getformula['c']; 

mysql_free_result($getformula);



 
 /*
$tipeday = "wldetail.php?type=daily&lokasi=".$agentname."&name=".$sungai;
$tipemon = "wldetail.php?type=monthly&lokasi=".$agentname."&name=".$sungai;
$tipeyer = "wldetail.php?type=yearly&lokasi=".$agentname."&name=".$sungai;
$tipewek = "wldetail.php?type=weekly&lokasi=".$agentname."&name=".$sungai;
*/

/* js untuk export tabel
jquery-1.12.4.js
jquery.dataTables.min.js
dataTables.buttons.min.js
buttons.flash.min.js
jszip.min.js
pdfmake.min.js
vfs_fonts.js
buttons.html5.min.js
buttons.print.min.js

css
jquery.dataTables.min.css
buttons.dataTables.min.css


*/
mysql_select_db($database_lubu, $lubu);
$query_dropdown_yr = "SELECT DISTINCT YEAR(ReceivedDate) as tahun FROM $agentname ORDER BY ReceivedDate DESC";
$select_year = mysql_query($query_dropdown_yr, $lubu) or die(mysql_error());
?>


<link rel="stylesheet" type="text/css" href="cssexp/buttons.dataTables.min.css">
<style>
.pstimbul {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.pstimbul .pstimbultext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: left;
    border-radius: 6px;
    padding: 5px 5;

    /* Position the pstimbul */
    position: absolute;
    z-index: 1;
}

.pstimbul:hover .pstimbultext {
    visibility: visible;
}
</style>

<script type="text/javascript" language="javascript" src="js/jquery-1.12.4.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>

<script type="text/javascript" language="javascript" src="jsexp/jquery-1.12.4.js"></script>
<script type="text/javascript" language="javascript" src="jsexp/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="jsexp/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="jsexp/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="jsexp/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="jsexp/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="jsexp/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="jsexp/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="jsexp/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		"aaSorting": [[0,'desc']]
    } );
} );
</script>

<script>
			function pungsi()
			{
			var x=document.getElementById("fbln");
			var y=document.getElementById("fthn");
			
			$(document).ready(function() {
		       var oTable = $('#example').dataTable();
			   
		       // Filter to rows with 'Webkit' in them, add a background colour and then
		       // remove the filter, thus highlighting the 'Webkit' rows only.
		       oTable.fnFilter('Webkit');
		       oTable.$('tr', {"filter": "applied"}).css('backgroundColor', 'blue');
		       oTable.fnFilter(y.value+x.value);
			   
			   
		     } )
			 }
			 ;
		</script>


<script>
	function fclear_sel()
	{

	$(document).ready(function() {
	   var oTable = $('#example').dataTable();
 
	   // Filter to rows with 'Webkit' in them, add a background colour and then
	   // remove the filter, thus highlighting the 'Webkit' rows only.
	   oTable.fnFilter('Webkit');
	   oTable.$('tr', {"filter": "applied"}).css('backgroundColor', 'blue');
	   oTable.fnFilter( '' );
	 } )
	 }
	 ;
</script>

<div class="row-fluid">

<select id="fthn" name="list" size="1" onChange="pungsi()">
   		<?php while ($row = mysql_fetch_assoc($select_year)) {
			
				echo '<option value="'.$row['tahun'].'">'.$row['tahun'].'</option>';
			}
		
		?>
   		<!--<option value="2019" selected="selected">2019</option>
		<option value="2018">2018</option>
		<option value="2017">2017</option>
		<option value="2016">2016</option>
		<option value="2015">2015</option>
		<option value="2014">2014</option>
		<option value="2013">2013</option>
		<option value="2012">2012</option>
		<option value="2011">2011</option>
		<option value="2010">2010</option>
		<option value="2009">2009</option>-->
</select>
	
<select id="fbln" name="list" size="1" onChange="pungsi()">
   		<option value="-01">Jan</option>
		<option value="-02">Feb</option>
		<option value="-03">Mar</option>
		<option value="-04">Apr</option>
		<option value="-05">May</option>
		<option value="-06">Jun</option>
		<option value="-07">Jul</option>
		<option value="-08">Aug</option>
		<option value="-09">Sep</option>
		<option value="-10">Okt</option>
		<option value="-11">Nop</option>
		<option value="-12">Des</option>
</select>
 
<label>
	<input name="btclear" type="button" id="btclear" onClick="fclear_sel()" value="Clear" />
</label>


<table id="example" class="display nowrap" cellspacing="0" width="100%">
  <thead>
  <tr>
	<th>SamplingDate</th>
	<th>SamplingTime</th>
	<th>H</th>
	<th>Q</th>
  </tr>
  </thead>
  <tbody>
  <?php do { ?>
    <tr>
      <td><?php echo $row_mon['SamplingDate']; ?></td>
      <td>
			<?php echo $row_mon['SamplingTime'].":00:00"; ?>
	  </td>
	  
      <td><?php echo number_format($row_mon['WLevel'],2,",","."); ?></td>
      <?php
	   $x = $row_mon['WLevel']/100;  
	  $d = $x+$a;
	  $da = pow($d,$b);
	  $e  = $c*$da;	
	  ?>
      <td>
		<div class="pstimbul">
		<div align = "center">
			<?php 
			echo number_format($e,2,",",".");
			?>
		</div>
		  <span class="pstimbultext">
			<?php echo "<br>"."a=".$a."<br>  b= ".$b."<br> c = ".$c; ?>
		  </span>
		</div>
	  </td>
    </tr>
    <?php } while ($row_mon = mysql_fetch_assoc($mon)); ?>
	</tbody>
</table>

</div>


<?php
mysql_free_result($mon);
?>
