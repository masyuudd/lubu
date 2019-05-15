<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
require_once('Connections/lubu.php');
// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>

<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "operator";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
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
	
	
	<!-- start: CSS -->
	
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link id="bootstrap-style" href="css/font-awesome.min.css" rel="stylesheet">
	
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="bootstrap-style" href="css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style" href="css/custom.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	<!-- end: CSS -->
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	
	
	<script type="text/javascript" language="javascript" src="js/jquery-1.12.4.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.validate.js"></script>
	<script type="text/javascript" language="javascript" src="js/bootbox.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/inputmask/inputmask.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/inputmask/jquery.inputmask.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/inputmask/inputmask.numeric.extensions.min.js"></script>
	
	
	<script src='js/jquery.dataTables.min.js'></script>
	<script src='js/fnSetFilteringDelay.js'></script>
	<script src="js/bootstrap.min.js"></script>

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
				<?php require_once("helper/company.php")?>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
				<?php require_once("helper/headermenu.php");?>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	
	<!-- start: Header -->
	
	<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<!-- <?php require_once("helper/leftmenu2.php")?> -->
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div class="container">
				<div class="row">
					<div class="topnav">
						
						<a class="title" href="#home">
							<span>Table of Q Formula </span> 
						</a>
						
						<div class="topnav-right">
							<a class="btn-add" data-toggle="modal" id="btnAdd">Add New </a>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12">
					<table id="post_list" class="dataTable table table-striped" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>AgentID </i></th>
								<th>Date</th>
								<th>a</th>
								<th>b</th>
								<th>c</th>
								<th>Author</th>
								<th></th>
							</tr>
						</thead>
					
					</table>
					</div>
				</div>
			</div>
			<!--/.fluid-container-->

			<!-- Modal Add New User -->
			<div id="AddNew" class="modal fade md-form success" role="dialog" style="display: none;">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add New Formula</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" id="form0"> 
							<div class="control-group" id="fieldAgentID">
								<label class="control-label">AgentID</label>
								<div class="controls">
									<select class="agent" id="AgentID" name="AgentID" >
										<option value=""></option>
									</select>
								</div>
								
							</div>
							<div class="control-group" id="fieldTanggal">
								<label class="control-label">Tanggal</label>
								<div class="controls">
									<input type="text" id="tanggal" name="tanggal" class="datepicker">
									<span class="help-block" id="fTanggal"></span>
								</div>
							</div>
							<div class="control-group" id="fieldA">
								<label class="control-label">a</label>
								<div class="controls">
									<input type="text" id="a" name="a" class="decimal">
									<span class="help-block" id="fA"></span>
								</div>
							</div>
							<div class="control-group" id="fieldB">
								<label class="control-label">b</label>
								<div class="controls">
									<input type="text" id="b" name="b" class="decimal">
									<span class="help-block" id="fB"></span>
								</div>
							</div>
							<div class="control-group" id="fieldC">
								<label class="control-label">c</label>
								<div class="controls">
									<input type="text" id="c" name="c" class="decimal">
									<span class="help-block" id="fC"></span>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Author</label>
								<div class="controls">
									<select class="form-control" name="author" id="author">
										<option value=""></option>
										<option value="Lubu energi" >Lubu energi</option>
										<option value="Pusair Bandung" >Pusair Bandung</option> 
									</select>
								</div>
							</div>
							
						</form>
					
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary" id="save">Submit</button>
					</div>
					</div>

				</div>
			</div>

			<!-- Modal Edit User -->
			<div id="ModalEdit" class="modal fade md-form success" role="dialog" style="display: none;">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Edit Formula</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" id="form1">
								<input type="hidden" id="id" name="id"> 
									
								<div class="control-group" id="fieldAgentID1">
									<label class="control-label">AgentID</label>
									<div class="controls">
										<select class="agent" id="AgentID1" name="AgentID1" >
											
										</select>
										<span class="help-block" id="fAgentID1"></span>
									</div>
								</div>
									
								<div class="control-group" id="fieldTanggal1">
									<label class="control-label">Tanggal</label>
									<div class="controls">
										<input type="text" id="tanggal1" name="tanggal1" class="datepicker">
										<span class="help-block" id="fTanggal1"></span>
									</div>
								</div>
									
								<div class="control-group" id="fieldA1">
									<label class="control-label">a</label>
									<div class="controls">
										<input type="text" id="a1" name="a1" class="decimal">
										<span class="help-block" id="fA1"></span>
									</div>
								</div>
									
								<div class="control-group" id="fieldB1">
									<label class="control-label">b</label>
									<div class="controls">
										<input type="text" id="b1" name="b1" class="decimal">
										<span class="help-block" id="fB1"></span>
									</div>
								</div>
									
								<div class="control-group" id="fieldC1">
									<label class="control-label">c</label>
									<div class="controls">
										<input type="text" id="c1" name="c1" class="decimal">
										<span class="help-block" id="fC1"></span>
									</div>
								</div>

								<div class="control-group" id="fieldAuthor1">
									<label class="control-label">Author</label>
									<div class="controls">
										<select class="form-control" name="author1" id="author1">
											<option value="Lubu energi" >Lubu energi</option>
											<option value="Pusair Bandung" >Pusair Bandung</option> 
										</select>
										<span class="help-block" id="fAuthor1"></span>
									</div>
								</div>
											
							</form>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-primary" id="update">Submit</button>
						</div>
					</div>

				</div>
			</div>
	
		</div><!--/#content.span10-->
	</div><!--/fluid-row-->
		
	
	
	<div class="clearfix"></div>
	
	<footer>
	
	<script type="text/javascript" language="javascript" src="js/bootstrap-datepicker.min.js"></script>
		<p>
			<span style="text-align:left;float:left"><a href="http://jiji262.github.io/Bootstrap_Metro_Dashboard/" alt="Bootstrap_Metro_Dashboard">Bootstrap Metro Dashboard</a></span>
			
		</p>

	</footer>
	
	<script type="text/javascript">
		
		function validateForm(i) {
        var validator = $( "#form"+i ).validate();//==>nama form
				if (validator.form()) {
					// submit with AJAX
					return true;
				}else{
					validator.focusInvalid();
					return false;
				}
    }

		
		function dtinitialize() {
				var columns = [
					{ "data": "AgentID","sClass": "ecol  align-center", searchable: false, orderable: true },
					{ "data": "tanggal","sClass": "ecol  align-center", searchable: false, orderable: true },
					{ "data": "a","sClass": "ecol  align-center", searchable: false, orderable: true },
					{ "data": "b","sClass": "ecol  align-center", searchable: false, orderable: true },
					{ "data": "c","sClass": "ecol  align-center", searchable: false, orderable: true },
					{ "data": "author","sClass": "ecol  align-center", searchable: false, orderable: true },
				
					{ "data": "noagent","sClass": "ecol align-center " ,searchable: true, orderable: true ,"render": function(data,type,row) {
						var param = [];
						param.push(row);
						edval='<a class="btn btn-xs btn-warning btn-outline btnEdit"><img src="icon/pencil.png"></a>'+
									'<a class="btn btn-xs btn-warning btn-outline" onclick="hapus('+row.id+')"><img src="icon/trashcan.png"></a>';
						return edval;
					}}
				];


				xtab=generatesDatatable('post_list',columns,"serverside/formula.php",true);
			};
	

		$(function(){
			$("#btnAdd").click( function(e) { 
				$("#AddNew").modal('show');
			});

      $("#save").click( function(e) {
        if (validateForm(0)){
            $("#form0").submit();
        }
      });
			$("#update").click( function(e) {
        if (validateForm(1)){
            $("#form1").submit();
        }
      });	
				
    });

		$(document).ready(function () {
			$('.datepicker').datepicker({
				autoclose: true
			});
			$(".decimal").inputmask({
        alias:"decimal",       
        allowMinus:false    
    	}); 
			$.ajax( {
						'dataType': 'json',
						'type': 'GET',
						'url': 'serverside/agent.php',
						success: function (res) {
							$.each(res, function(i, opt) {   
								// console.log(opt.key);
									$('.agent')
											.append($("<option></option>")
																	.attr("value",opt.id)
																	.text(opt.text)); 
							});
						}
			});

			jQuery.validator.addMethod("noSpace", function(value, element) { 
				return value.indexOf(" ") < 0 && value != ""; 
			}, "No space");
		
		
			$('#form0').validate({
				rules : {
					AgentID :{
							required    : true
					},
					tanggal :{
							required    : true
					},
					a :{
							required : true
					},
					b :{
							required : true
					},
					c :{
							required : true
					},
					author :{
							required : true
					}
				}
			});
		
			//Form0 Submit
			$("#form0").submit(function(e){ 
				var AgentID = $('#form0').find('select[name="AgentID"]').val();
				var tanggal = $('#form0').find('input[name="tanggal"]').val();
				var a 			= $('#form0').find('input[name="a"]').val();
				var b 			= $('#form0').find('input[name="b"]').val();
				var c 			= $('#form0').find('input[name="c"]').val();
				var author 	= $('#form0').find('select[name="author"]').val();

				var data = [];
				
				data.push(
					{ name: 'act', value: 'create' },
					{ name: 'AgentID', value: AgentID },
					{ name: 'tanggal', value: tanggal },
					{ name: 'a', value: a },
					{ name: 'b', value: b },
					{ name: 'c', value: c },
					{ name: 'author', value: author }
				);
			
				$.ajax( {
						'dataType': 'json',
						'type': 'POST',
						'url': 'serverside/formula.php',
						'data': data,
						success: function (res) {
							$('#AddNew').modal('toggle');
							if(res.status){
								bootbox.alert({ 
										title: '<div class="i-box"><i class="material-icons">&#xE876;</i></div>', 
										message: '<h4>Great!</h4> <p>'+res.message+'</p>',
										className: "md-alert success",
										callback: function (result) {
											dtinitialize();
										}
								});
								
							}else{
								bootbox.alert({
									title: '<div class="i-box"><i class="material-icons">&#xE5CD;</i></div>',
									message: '<h4>Oops!</h4> <p>'+res.message+'</p>',
									className: "md-alert error",
									callback: function (result) {
										dtinitialize();
									}
								});
							}
						}
				});
				return false;
			});

			$('#form1').validate({
				rules : {
					username1 :{
							required    : true,
							noSpace 	: true,
							minlength	: 5
					},
					name1 :{
							required    : true
					}
				},
				
				messages: {
					username1 :{
							required    : "This field is required",
							noSpace 		: "No space"
					},
					name1 :{
							required    : "This field is required"
					}
				},
				errorPlacement: function(error, element) {
					if(element.attr("name") == "username1") {
						$('#fUsername1').html(error);
						$('#fieldUsername1').addClass('has-error');
					}
				
					if(element.attr("name") == "name1") {
						$('#fName1').html(error);
						$('#fieldName1').addClass('has-error');
					}
				
				}
			});

			//Form1 Submit
			$("#form1").submit(function(e){ 
				var id 				= $('#form1').find('input[name="id"]').val();
				var AgentID 	= $('#form1').find('select[name="AgentID1"]').val();
				var tanggal 	= $('#form1').find('input[name="tanggal1"]').val();
				var a 				= $('#form1').find('input[name="a1"]').val();
				var b 				= $('#form1').find('input[name="b1"]').val();
				var c 				= $('#form1').find('input[name="c1"]').val();
				var author		= $('#form1').find('select[name="author1"]').val();

				var data 			= [];
				
				data.push(
					{ name: 'id', value: id },
					{ name: 'act', value: 'update' },
					{ name: 'AgentID', value: AgentID },
					{ name: 'tanggal', value: tanggal },
					{ name: 'a', value: a },
					{ name: 'b', value: b },
					{ name: 'c', value: c },
					{ name: 'author', value: author }
				);
				
				$.ajax( {
						'dataType': 'json',
						'type': 'POST',
						'url': 'serverside/formula.php',
						'data': data,
						success: function (res) {
						
							$('#ModalEdit').modal('hide');
							if(res.status){
								bootbox.alert({ 
										title: '<div class="i-box"><i class="material-icons">&#xE876;</i></div>', 
										message: '<h4>Great!</h4> <p>'+res.message+'</p>',
										className: "md-alert success",
										callback: function (result) {
											dtinitialize();
										}
								});
								
							}else{
								bootbox.alert({
									title: '<div class="i-box"><i class="material-icons">&#xE5CD;</i></div>',
									message: '<h4>Oops!</h4> <p>'+res.message+'</p>',
									className: "md-alert error",
									callback: function (result) {
										dtinitialize();
									}
								});
							}
						}
				});
				return false;
			});

			dtinitialize();
			

			var table = $('#post_list').DataTable();
			$('#post_list tbody').on('click', 'td a.btnEdit', function () {
						var tr = $(this).closest('tr');
						var row = table.row( tr );
						edit(row.data());
						
			});

		});
		
		function generatesDatatable(cdiv,columns,dbsource ,tabnum, cari   ){
				var xtab=$('#'+cdiv).dataTable({
					"lengthChange": false,
					"searching": false,
					"bProcessing": true,
					"bInfo": false,
					"ordering": true,
					"columns": columns ,
					"bServerSide":true,
					"aaSorting": [[0,'asc']],
					"bDestroy": true,//====> untuk reload data
					"sAjaxSource": dbsource,
					// "iDisplayLength": 10,
					"paging": false,
					"rowCallback": function( row, data, iDisplayIndex ) {
						
						if (tabnum){
							var info = xtab.api().page.info();
							var page = info.page;
							var length = info.length;
							var index = (page * length + (iDisplayIndex +1));
							// $('td:eq(0)', row).html('');
						}
					},

					"fnInitComplete": function () {
						xtab.fnAdjustColumnSizing();
						
					},
					"createdRow": function (row, data, rowIndex) {
						// console.log(data);
						// Per-cell function to do whatever needed with cells
						$.each($('td', row), function (colIndex) {
							// For example, adding data-* attributes to the cell
							$(this).attr('data-title', columns[colIndex]["data-title"]);
						});
					},
					'fnServerData': function (sSource, aoData, fnCallback) {
						aoData.push(
							{ name: 'act', value: 'read' }
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
	
	
			function edit(data){
				console.log(data);
				$("#ModalEdit").modal('show');
				
				$('#form1').find('input[name="id"]').val(data.noagent);
				$('#form1').find('select[name="AgentID1"]').val(data.AgentID);
				$('#form1').find('input[name="tanggal1"]').val(data.tanggal);
				$('#form1').find('input[name="a1"]').val(data.a);
				$('#form1').find('input[name="b1"]').val(data.b);
				$('#form1').find('input[name="c1"]').val(data.c);
				$('#form1').find('select[name="author1"]').val(data.author);				

				$('#fieldAgentID1').removeClass('has-error');
				$('#fieldTanggal1').removeClass('has-error');
				$('#fieldA1').removeClass('has-error');
				$('#fieldB1').removeClass('has-error');
				$('#fieldC1').removeClass('has-error');
				$('#fieldAuthor1').removeClass('has-error');
			}

			function hapus(id){
				bootbox.confirm({
						title: '<i class="fa">&#xf071;</i>',
						message: "<h4>Warning!</h4><p>Are you sure want to delete this ?</p>",
						className: 'md-alert warning',
						buttons: {
								confirm: {
										label: 'Yes',
										className: 'btn-success'
								},
								cancel: {
										label: 'No',
										className: 'btn-danger'
								}
						},
						callback: function (result) {
								if(result){
									var data = [];
									data.push(
										{ name: 'id', value: id },
										{ name: 'act', value: 'delete' }
									);

									$.ajax( {
										'dataType': 'json',
										'type': 'POST',
										'url': 'serverside/formula.php',
										'data': data,
										success: function (res) {
											if(res.status){
												bootbox.alert({ 
														title: '<div class="i-box"><i class="material-icons">&#xE876;</i></div>', 
														message: '<h4>Great!</h4> <p>'+res.message+'</p>',
														className: "md-alert success",
														callback: function (result) {
															dtinitialize();
														}
												});
												
											}else{
												bootbox.alert({
													title: '<div class="i-box"><i class="material-icons">&#xE5CD;</i></div>',
													message: '<h4>Oops!</h4> <p>'+res.message+'</p>',
													className: "md-alert error",
													callback: function (result) {
														dtinitialize();
													}
												});
											}
										}
									});
								}
						}
				});
			}
	
	</script>

</body>
</html>
<style>
.container{
	padding-top: 20px;
}
.topnav a.btn-add{
	background-color: #fda002;
	color: white;
	cursor: pointer;
}
.topnav a.btn-add:hover{
	background-color: #ddd;
	color: black;
}

/* .control-group.has-error label{
    font-weight: bold;
	color: #dd4b39;
} */

input.error, select.error{
	border-color: #dd4b39 !important;
}

label.error{
	color: #dd4b39;
}

.control-label{
	font-weight: bold;
}
</style>

