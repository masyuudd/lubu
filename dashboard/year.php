<?php require_once('Connections/lubu.php'); ?>
<?php 
$agentname 	= $_GET['lokasi'];
$type 		= $_GET['type'];
$sungai		= $_GET['name'];

?>
<?php
mysql_select_db($database_lubu, $lubu);
$query_mon = "SELECT YEAR( ReceivedDate ) AS tahun, MONTH( ReceivedDate ) AS bulan, AVG( WLevel ) AS WLevel, (
AVG( Wlevel )
) * 1.32 AS debit
FROM $agentname
GROUP BY MONTH( SamplingDate ) ";
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

mysql_select_db($database_lubu, $lubu);
$query_dropdown_yr = "SELECT DISTINCT(YEAR(ReceivedDate)) as tahun FROM $agentname ORDER BY ReceivedDate DESC";
$select_year = mysql_query($query_dropdown_yr, $lubu) or die(mysql_error());



?>


<link rel="stylesheet" type="text/css" href="cssexp/buttons.dataTables.min.css">

<script type="text/javascript" language="javascript" src="js/jquery-1.12.4.js"></script>
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
function cari(){
	dtinitialize();
	return false;
}
$(document).ready(function() {
	var startDate = new Date('01/01/2012');
	var FromEndDate = new Date();
	var ToEndDate = new Date();

	ToEndDate.setDate(ToEndDate.getDate()+365);
	$('#from').datepicker({
		weekStart: 1,
		startDate: '01/01/2017',
		endDate: FromEndDate, 
		autoclose: true
	})
	.on('changeDate', function(selected){
			startDate = new Date(selected.date.valueOf());
			startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
			$('#to').datepicker('setStartDate', startDate);
	}); 
	$('#to')
	.datepicker({

			weekStart: 1,
			startDate: startDate,
			endDate: ToEndDate,
			autoclose: true
	})
	.on('changeDate', function(selected){
			FromEndDate = new Date(selected.date.valueOf());
			FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
			$('#from').datepicker('setEndDate', FromEndDate);
	});
	dtinitialize();

} );

function dtinitialize() {

var a = "<?php echo $a; ?>";
var b = "<?php echo $b; ?>";
var c = "<?php echo $c; ?>";

var columns = [
	{ "data": "tahun","sClass": "ecol details-control align-center", searchable: false, orderable: true },
	{ "data": "bulan","sClass": "ecol details-control align-center", searchable: false, orderable: false },

	{ "data": "WLevel","sClass": "ecol align-center details-control" ,searchable: true, orderable: true ,"render": function(data,type,row) {

		edval=parseFloat(row.WLevel).toFixed(2);;

		return edval;
	}},
	{ "data": "WLevel","sClass": "ecol align-center details-control" ,searchable: true, orderable: true ,"render": function(data,type,row) {
		var x = parseFloat(row.WLevel)/100;  
		var d = x+parseFloat(a);
		var da = Math.pow(d,parseFloat(b));
		var e  = parseFloat(c)*da;	
		var edval = "";	
			edval = '<div class="pstimbul">'+
								'<div align = "center">'+ parseFloat(e).toFixed(2) +'</div>'+
								'<span class="pstimbultext">'+
									'<br> a : '+parseFloat(a)+'<br> b : '+parseFloat(b)+'<br>c : '+parseFloat(c)+
		  					'</span>'+
							'</div>';

		return edval;
	}}

];


xtab=generatesDatatable('post_list',columns,"serverside/yearly.php",true);
};


function generatesDatatable(cdiv,columns,dbsource ,tabnum, cari   ){
	var tahun = $("#tahun").val();

	var agentname = "<?php echo $agentname; ?>";
	var sungai = "<?php echo $sungai; ?>";
	var xtab=$('#'+cdiv).dataTable({
		dom: 'Blfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		"searching": false,
		"bProcessing": true,
		"bInfo": true,
		"ordering": true,
		"columns": columns ,
		"bServerSide":true,
		"aaSorting": [[0,'desc']],
		"bDestroy": true,//====> untuk reload data
		"sAjaxSource": dbsource,
		"iDisplayLength": 10,
		"rowCallback": function( row, data, iDisplayIndex ) {
			
			if (tabnum){
				var info = xtab.api().page.info();
				var page = info.page;
				var length = info.length;
				var index = (page * length + (iDisplayIndex +1));
			}
		},

		"fnInitComplete": function () {
			xtab.fnAdjustColumnSizing();
			
		},
		"createdRow": function (row, data, rowIndex) {
			// Per-cell function to do whatever needed with cells
			$.each($('td', row), function (colIndex) {
				// For example, adding data-* attributes to the cell
				$(this).attr('data-title', columns[colIndex]["data-title"]);
			});
		},
		'fnServerData': function (sSource, aoData, fnCallback) {
			
			aoData.push(
					{ name: 'agentname', value: agentname },
					{ name: 'sungai', value: sungai },
					{ name: 'year', value: tahun }
				);
		
			$.ajax({
								'dataType': 'json',
								'type': 'POST',
								'url': sSource,
								'data': aoData,
								'success': fnCallback
						});
		}
	});
	xtab.dataTable().fnSetFilteringDelay(1000);
	return xtab;


}
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
	<form class="form-inline">
		<div class="form-group">
			<label for="from">From :</label>
			<select id="tahun" name="tahun" size="1" class="form-control">
	 				<option value="">All</option>
					<?php while ($row = mysql_fetch_assoc($select_year)) {
							echo '<option value="'.$row['tahun'].'">'.$row['tahun'].'</option>';
						}
					?>
			</select>
		</div>
		<button type="button" onclick="cari()" class="btn btn-default">Search</button>
	</form>
	
	<table id="post_list" class="dataTable table table-striped" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Tahun</th>
				<th>Bulan</th>
				<th>H</th>
				<th>Q</th>
			</tr>
		</thead>
	
	</table>


</div>


<?php
mysql_free_result($mon);
?>
