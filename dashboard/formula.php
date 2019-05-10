<html>
  <head>

    <link href="setting/themes/base/jquery.ui.theme.css" rel="stylesheet" type="text/css" />
	<link href="setting/scripts/jtable/themes/basic/jtable_basic.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
    jQuery.browser = {};
    (function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();
</script>
    <script src="setting/scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="setting/scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
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
  </head>
  <body>
	<div id="formulaTableContainer" style="width: 100%;"></div>
  </body>
</html>
