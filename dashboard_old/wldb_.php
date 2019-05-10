<?php 
session_start();
require_once('Connections/lubu.php'); 
?>
<?php
$lokasi	= $_GET['lokasi'];
$name	= $_GET['name'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>PLTM LUBU</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- Datatables -->
	<script src="js/jquery-1.12.4.js"></script>
<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#dashboard-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"dashboard-grid-data.php", // json datasource
						error: function(){  // error handling
							$(".dashboard-grid-error").html("");
							$("#dashboard-grid").append('<tbody class="dashboard-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#dashboard-grid_processing").css("display","none");
							
						}
					}
				} );
				$("#dashboard-grid_filter").css("display","none");  // hiding global search box
				$('.search-input-text').on( 'keyup click', function () {   // for text boxes
					var i =$(this).attr('data-column');  // getting column index
					var v =$(this).val();  // getting search input value
					dataTable.columns(i).search(v).draw();
				} );
				$('.search-input-select').on( 'change', function () {   // for select box
					var i =$(this).attr('data-column');  
					var v =$(this).val();  
					dataTable.columns(i).search(v).draw();
				} );
				
				
				
			} );
		</script>
	
	
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	<link href="css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css">
	
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
    
</head>

<body id="dt_example">
		<!-- start: Header -->
		
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<?php require_once("helper\company.php")?>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
				<?php require_once("helper\headermenu.php");?>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php require_once("helper/leftmenu2.php")?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
	<!-- start: Content -->
	<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Dashboard</a></li>
	  </ul>


           

      		<h1><?php echo $name;?></h1>
			<a href>Daily </a> |<a href> Monthly </a>|<a href> Yearly</a>
			<hr>
			<table id="dashboard-grid"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ReceivedDate</th>
							<th>ReceivedTime</th>
							<th>SamplingDate</th>
							<th>SamplingTime</th>
							<th>Muka Air</th>
							<th>Debit</th>
						</tr>
					</thead>
					<thead>
						<tr>
							<td><input type="text" data-column="0"  class="search-input-text"></td>
							<th><input type="text" data-column="1"  class="search-input-text"></td>
							<th><input type="text" data-column="2"  class="search-input-text"></td>
							<th><input type="text" data-column="3"  class="search-input-text"></td>
							<th><input type="text" data-column="4"  class="search-input-text"></td>
							
						</tr>
					</thead>
			</table>
			
      <?php 
			/*
			require_once("helper/idxctn00.php");
			require_once("helper/idxctn0.php");
			require_once("helper/idxctn1.php");
			require_once("helper/idxctn2.php");
			require_once("helper/idxctn3.php");
			require_once("helper/idxctn4.php");
			*/
			?>
			<!--/row-->
			
     

	</div><!--/.fluid-container-->
	<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<footer>

		<p>
			<span style="text-align:left;float:left"><a href="http://jiji262.github.io/Bootstrap_Metro_Dashboard/" alt="Bootstrap_Metro_Dashboard">Bootstrap Metro Dashboard</a></span>
			
		</p>

	</footer>
	
	<!-- start: JavaScript-->

	<script src="js/jquery-1.9.1.min.js"></script>
	
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
	<script src="js/jquery-ui-1.10.0.custom.min.js"></script>

	<script src="js/jquery.ui.touch-punch.js"></script>

	<script src="js/modernizr.js"></script>

	<script src="js/bootstrap.min.js"></script>

	<script src="js/jquery.cookie.js"></script>

	<script src='js/fullcalendar.min.js'></script>

	<script src='js/jquery.dataTables.min.js'></script>

	<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	
	<script src="js/jquery.chosen.min.js"></script>

	<script src="js/jquery.uniform.min.js"></script>
	
	<script src="js/jquery.cleditor.min.js"></script>

	<script src="js/jquery.noty.js"></script>

	<script src="js/jquery.elfinder.min.js"></script>

	<script src="js/jquery.raty.min.js"></script>

	<script src="js/jquery.iphone.toggle.js"></script>

	<script src="js/jquery.uploadify-3.1.min.js"></script>

	<script src="js/jquery.gritter.min.js"></script>

	<script src="js/jquery.imagesloaded.js"></script>

	<script src="js/jquery.masonry.min.js"></script>

	<script src="js/jquery.knob.modified.js"></script>

	<script src="js/jquery.sparkline.min.js"></script>

	<script src="js/counter.js"></script>

	<script src="js/retina.js"></script>

	<script src="js/custom.js"></script>
	
	
	<!-- end: JavaScript-->
	
</body>
</html>

