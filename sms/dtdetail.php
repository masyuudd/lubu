<?php
$agentname 	= $_POST['a'];
$sungai		= $_POST['b'];
$bulan		= $_POST['c'];

$months = array(1 => "Januari", 2 => "Feb.", 3 => "Mar.", 4 => "Apr.", 5 => "May", 6 => "Jun.", 7 => "Jul.", 8 => "Aug.", 9 => "Sep.", 10 => "Oct.", 11 => "Nov.", 12 => "Dec.");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/page.css">
<link rel="stylesheet" type="text/css" href="css/table.css">
<link rel="stylesheet" type="text/css" href="css/TableTools.css">


<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
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

		<script type="text/javascript" charset="utf-8">
		// ============
		function getdata() 
{
				$('#example').dataTable( {
				"sDom": 'T<"clear">lfrtip',
				"oTableTools": {
				"sSwfPath": "helper/media/copy_csv_xls_pdf.swf",
				"aButtons": [
                    "copy",
                    "csv",
					"xls",
                    "pdf",
                    "print",
                    {
                        "sExtends":    "text",
                        "sButtonText": "Export All",
                        "fnComplete": function ( nButton, oConfig, oFlash, sFlash ) {
                            $.ajax({
                                url: 'report_exporter.php',
                                dataType: 'json',
                                type: 'post',
                                data: $('#form1').serialize(),
                                error: function() {
                                    return true;
                                },
                                success: function(data) {
                                    if( data )
                                    {
                                        if (data.status == 'success') {
                                            $("#ExportedFileSection").show();
                                            $("#ExportedFile").attr("href", data.filename);
                                        }
                                    }
                                }
                            });
                        }
                    }
                ]
				},
					"bProcessing": true,
					"sPaginationType": "full_numbers",
					"bServerSide": true,
					"sAjaxSource": "dtmysql.php?a=<?php echo $agentname; ?>&b=<?php $bulan		= "2"; echo $bulan; ?>"
				} );
} 
		// ============
			$(document).ready(function() {
				$('#example').dataTable( {
				"sDom": 'T<"clear">lfrtip',
				"oTableTools": {
				"sSwfPath": "helper/media/copy_csv_xls_pdf.swf",
				"aButtons": [
                    "copy",
                    "csv",
					"xls",
                    "pdf",
                    "print"
                ]
				},
					"bProcessing": true,
					"sPaginationType": "full_numbers",
					"bServerSide": true,
					"sAjaxSource": "dtmysql.php?a=<?php echo $agentname; ?>&b=<?php echo $bulan; ?>"
				} );
			} );
			
			function fnShowHide( iCol )
			{
				/* Get the DataTables object again - this is not a recreation, just a get of the object */
				var oTable = $('#example').dataTable();
				
				var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
				oTable.fnSetColumnVis( iCol, bVis ? false : true );
			}
			
			function aclick()
			{
			fnShowHide(6);
			fnShowHide(7);
			fnShowHide(8);
			fnShowHide(9);		
			}
{
var xx = document.xx.cbtest;
xx.checked = true;
}
			
		</script>
<script type="text/javascript" charset="utf-8" src="js/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="js/TableTools.js"></script>
<title>Data Terkini</title>
<style type="text/css">
<!--
.style1 {font-size: xx-large}
.style2 {font-size: x-large}
-->
</style>
</head>

<body id="dt_example">



<form name= "cbx" id="cbx" >
<input name="wl" type="checkbox" onclick="fnShowHide(2);" value="wl" checked /> Water level |
<input name="Rainfall" type="checkbox" onclick="fnShowHide(3);" value="Rainfall" checked /> Rainfall |
<input name="Temp" type="checkbox" onclick="fnShowHide(4);" value="Temp" checked /> Temp. |
<input name="Humidity" type="checkbox" onclick="fnShowHide(5);" value="Humidity" checked /> Humidity |</br>


<input name="A1" type="checkbox" onclick="fnShowHide(6);" value="A1" checked /> A1 |
<input name="A2" type="checkbox" onclick="fnShowHide(7);" value="A2" checked /> A2 |
<input name="A3" type="checkbox" onclick="fnShowHide(8);" value="A3" checked /> A3 |
<input name="A4" type="checkbox" onclick="fnShowHide(9);" value="A4" checked /> A4 |
<input name="analog" type="checkbox" onclick="aclick();" value="analog" checked /> Analog |
</br>


<input name="D1" type="checkbox" onclick="fnShowHide(10);" value="D1" checked /> D1 |
<input name="D2" type="checkbox" onclick="fnShowHide(11);" value="D2" checked /> D2 |
<input name="D3" type="checkbox" onclick="fnShowHide(12);" value="D3" checked /> D3 |
<input name="D4" type="checkbox" onclick="fnShowHide(13);" value="D4" checked /> D4 |
<input name="D4" type="checkbox" onclick="fnShowHide(10);fnShowHide(11);fnShowHide(12);fnShowHide(13);" value="D4" checked /> Digital |

</form>
<br>
<br>

<select id="fthn" name="list" size="1" onchange="pungsi()">
   		<option value="2017">2017</option>
		<option value="2016">2016</option>
		<option value="2015">2015</option>
		<option value="2014" selected="selected">2014</option>
		<option value="2013">2013</option>
		<option value="2012">2012</option>
		<option value="2011">2011</option>
		<option value="2010">2010</option>
		<option value="2009">2009</option>
	</select>
	
	<select id="fbln" name="list" size="1" onchange="pungsi()">
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
		<input name="btclear" type="button" id="btclear" onclick="fclear_sel()" value="Clear" />
	</label>



<div align="center" class="style1"> <br />
  <span class="style2"><?php echo strtoupper($sungai); ?> </span>
</div>

 
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th width="10px">Sampling Date</th>
			<th width="10px">Sampling Time</th>
			<th width="7px">Water Level</th>
			<th width="7px">Rainfall</th>
			<th width="7px">Temp.</th>
			<th width="7px">Humidity</th>
			<th width="7px">A1</th>
			<th width="7px">A2</th>
			<th width="7px">A3</th>
			<th width="7px">A4</th>
			<th width="7px">D1</th>
			<th width="7px">D2</th>
			<th width="7px">D3</th>
			<th width="7px">D4</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="14" class="dataTables_empty">Loading data from server</td>
		</tr>
	</tbody>
</table>
</body>
</html>

