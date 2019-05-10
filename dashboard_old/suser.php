<html>
  <head>

    <link href="setting/themes/base/jquery.ui.theme.css" rel="stylesheet" type="text/css" />
	<link href="setting/Scripts/jtable/themes/basic/jtable_basic.css" rel="stylesheet" type="text/css" />
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
    <script src="setting/Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
	
  </head>
  <body>
	<div id="userTableContainer" style="width: 100%;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#userTableContainer').jtable({
				title: 'Table of Q Users',
				actions: {
					listAction: 'suserget.php?action=list',
					createAction: 'suserget.php?action=create',
					updateAction: 'suserget.php?action=update',
					deleteAction: 'suserget.php?action=delete'
				},
				fields: {
					nouser: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					username: {
						title: 'username'
					},
					password: {
						title: 'password'
					},
					level: {
						title: 'level'
					},
					name: {
						title: 'name'
					}
				}
			});

			//Load person list from server
			$('#userTableContainer').jtable('load');

		});

	</script>
 
  </body>
</html>
