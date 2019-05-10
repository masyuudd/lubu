<html>
  <head>

    <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	
	<link href="Scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
	
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
	
  </head>
  <body>
	<div id="formulaTableContainer" style="width: 100%;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#formulaTableContainer').jtable({
				title: 'Table of Q Formula',
				actions: {
					listAction: 'formulaget.php?action=list',
					createAction: 'formulaget.php?action=create',
					updateAction: 'formulaget.php?action=update',
					deleteAction: 'formulaget.php?action=delete'
				},
				fields: {
					noagent: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					AgentID: {
						title: 'AgentID'
					},
					tanggal: {
						title: 'Date'
					},
					a: {
						title: 'a'
					},
					b: {
						title: 'b'
					},
					c: {
						title: 'c'
					},
					author: {
						title: 'author'
					}
				}
			});

			//Load person list from server
			$('#formulaTableContainer').jtable('load');

		});

	</script>
 
  </body>
</html>
