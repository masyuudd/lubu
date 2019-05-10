
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<title>Editor example - Responsive table extension</title>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="css/select.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="css/editor.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="resources/demo.css">
	<style type="text/css" class="init">
	
	</style>
	<script type="text/javascript" language="javascript" src="js/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="js/dataTables.responsive.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="js/dataTables.buttons.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="js/dataTables.select.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="js/dataTables.editor.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="resources/syntax/shCore.js">
	</script>
	<script type="text/javascript" language="javascript" src="resources/demo.js">
	</script>
	<script type="text/javascript" language="javascript" src="resources/editor-demo.js">
	</script>
	<script type="text/javascript" language="javascript" class="init">
	


var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
	editor = new $.fn.dataTable.Editor( {
		ajax: "app/staff.php",
		table: "#example",
		fields: [ {
				label: "First name:",
				name: "first_name"
			}, {
				label: "Last name:",
				name: "last_name"
			}, {
				label: "Position:",
				name: "position"
			}, {
				label: "Office:",
				name: "office"
			}, {
				label: "Extension:",
				name: "extn"
			}, {
				label: "Start date:",
				name: "start_date",
				type: "datetime"
			}, {
				label: "Salary:",
				name: "salary"
			}
		]
	} );

	$('#example').DataTable( {
		dom: "Bfrtip",
		ajax: "app/staff.php",
		columns: [
			{ data: null, render: function ( data, type, row ) {
				// Combine the first and last names into a single table field
				return data.first_name+' '+data.last_name;
			} },
			{ data: "position" },
			{ data: "office" },
			{ data: "extn" },
			{ data: "start_date" },
			{ data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
		],
		select: true,
		buttons: [
			{ extend: "create", editor: editor },
			{ extend: "edit",   editor: editor },
			{ extend: "remove", editor: editor }
		]
	} );
} );



	</script>

	</head>
<body class="dt-example">
	<div class="container">
		<h1>Responsive</h1>
			<div class="demo-html"></div>
			<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Extn.</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Extn.</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</tfoot>
			</table>
	</div>
	</body>
</html>