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
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('table.display').DataTable();
		} );
	</script>
	
	
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
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
			<?php require_once("helper/leftmenu.php")?>
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
                  <td><a href="wldb.php?lok=<?php echo $row_wlagent['AgentName']; ?>&name=<?php echo $row_wlagent['Sungai']; ?>"><?php echo $row_wlagent['AgentName']; ?></a></td>
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
				  <td><a href="rgdb_.php?tabel=<?php echo $row_rgagent['AgentName']; ?>&name=<?php echo $row_rgagent['Sungai']; ?>"><?php echo $row_rgagent['AgentName']; ?></a></td>
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
			
       </div>

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
			<span style="text-align:left;float:left">&copy; 2013 <a href="http://jiji262.github.io/Bootstrap_Metro_Dashboard/" alt="Bootstrap_Metro_Dashboard">Bootstrap Metro Dashboard</a></span>
			
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
<?php
mysql_free_result($wlagent);

mysql_free_result($rgagent);
?>
