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
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="cssexp/buttons.dataTables.min.css">
	<!-- end: CSS -->
	<link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">	
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style" href="css/custom.css" rel="stylesheet">
	<!-- end: Favicon -->
	<script type="text/javascript" language="javascript" src="js/jquery-1.12.4.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.validate.js"></script>
	<script type="text/javascript" language="javascript" src="js/bootbox.min.js"></script>
	
	<script src='js/jquery.dataTables.min.js'></script>
	<script src='js/fnSetFilteringDelay.js'></script>
	<script src="js/bootstrap.min.js"></script>
	
    
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
							<span>USERS</span>
						</a>
						
						<div class="topnav-right">
							<a class="btn-add" data-toggle="modal" data-target="#AddNew">Add New </a>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12">
					<table id="post_list" class="dataTable table table-striped" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>username</th>
								<th>name</th>
								<th>level</th>
								<th>status</th>
								<th></th>
							</tr>
						</thead>
					
					</table>
					</div>
				</div>
			</div>

			<!-- Modal Add New User -->
			<div id="AddNew" class="modal fade md-form success" role="dialog" style="display: none;">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add New User</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" id="form0"> 
							<div class="control-group" id="fieldName">
								<label class="control-label">Name</label>
								<div class="controls">
									<input type="text" id="name" name="name" placeholder="Name">
									<span class="help-block" id="fName"></span>
								</div>
							</div>
							<div class="control-group" id="fieldUsername">
								<label class="control-label">Username</label>
								<div class="controls">
									<input type="text" id="username" name="username" placeholder="Username">
									<span class="help-block" id="fUsername"></span>
								</div>
							</div>
							<div class="control-group" id="fieldPassword">
								<label class="control-label">Password</label>
								<div class="controls">
									<input type="password" id="password" name="password" placeholder="Password">
									<span class="help-block" id="fPassword"></span>
								</div>
							</div>
							<div class="control-group" id="fieldConfirmPassword">
								<label class="control-label">Confirm Password</label>
								<div class="controls">
									<input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
									<span class="help-block" id="fConfirmPassword"></span>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Level</label>
								<div class="controls">
									<select class="form-control" name="level" id="level">
										<option value="operator" >Operator</option>
										<option value="admin" >Administrator</option> 
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
						<h4 class="modal-title">Edit User</h4>
					</div>
					<div class="modal-body">
						<div class="tabbable"> <!-- Only required for left/right tabs -->
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab1" data-toggle="tab">Profile</a></li>
								<li><a href="#tab2" data-toggle="tab">Password</a></li>
							</ul>
							<div class="tab-content">
								
								<div class="tab-pane active" id="tab1">
									<form class="form-horizontal" id="form1">
										<input type="hidden" id="id" name="id"> 
										<div class="control-group" id="fieldName1">
											<label class="control-label">Name</label>
											<div class="controls">
												<input type="text" id="name1" name="name1" placeholder="Name">
												<span class="help-block" id="fName1"></span>
											</div>
										</div>

										<div class="control-group" id="fieldUsername1">
											<label class="control-label">Username</label>
											<div class="controls">
												<input type="text" id="username1" name="username1" placeholder="Username">
												<span class="help-block" id="fUsername1"></span>
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">Level</label>
											<div class="controls">
												<select class="form-control" name="level1" id="level1">
													<option value="operator" >Operator</option>
													<option value="admin" >Administrator</option> 
												</select>
											</div>
										</div>

										<div class="control-group">
											<div class="controls">
												<label class="checkbox">
													<input type="checkbox" name="isactive" id="isactive"> Active
												</label>
											</div>
										</div>
										
									</form>

									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-primary" onclick="update('profile')">Submit</button>
									</div>
								</div>
								<div class="tab-pane" id="tab2">
									<form class="form-horizontal" id="form2"> 
										<div class="control-group" id="fieldPassword1">
											<label class="control-label">Password</label>
											<div class="controls">
												<input type="password" id="password1" name="password1" placeholder="Password">
												<span class="help-block" id="fPassword1"></span>
											</div>
										</div>

										<div class="control-group" id="fieldConfirmPassword1">
											<label class="control-label">Confirm Password</label>
											<div class="controls">
												<input type="password" id="confirm_password1" name="confirm_password1" placeholder="Confirm Password">
												<span class="help-block" id="fConfirmPassword1"></span>
											</div>
										</div>									
									</form>

									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-primary" onclick="update('password')">Submit</button>
									</div>
								</div>

								
							</div>
						</div>
						
					
					</div>
					
					</div>

				</div>
			</div>

		
		</div>
	</div>
		
	
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2019 PT. OMBILIN ELECTRIC POWER</span>
			
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
					{ "data": "username","sClass": "ecol  align-center", searchable: false, orderable: true },
					{ "data": "name","sClass": "ecol  align-center", searchable: false, orderable: true },
					{ "data": "level","sClass": "ecol  align-center", searchable: false, orderable: true },
					{ "data": "status","sClass": "ecol  align-center", searchable: false, orderable: true ,"render": function(data,type,row) {
						var edval = "";
						if(row.isactive == 1){
							edval='<span class="label label-success">Active</span>';
						}else{
							edval='<span class="label label-important">Inactive</span>';
						}
					
						return edval;
					}},
					{ "data": "id","sClass": "ecol align-center " ,searchable: true, orderable: true ,"render": function(data,type,row) {
						var param = [];
						param.push(row);
						edval='<a class="btn btn-xs btn-warning btn-outline btnEdit"><img src="icon/pencil.png"></a>'+
									'<a class="btn btn-xs btn-warning btn-outline" onclick="hapus('+row.id+')"><img src="icon/trashcan.png"></a>';
						return edval;
					}}
				];


				xtab=generatesDatatable('post_list',columns,"serverside/users.php",true);
			};
		function update(obj){
	
			if(obj == 'profile'){
				if (validateForm(1)){
					$("#form1").submit();
				}
			}else if(obj == 'password'){
				if (validateForm(2)){
					$("#form2").submit();
				}
			}
		}

		$(function(){
        $("#save").click( function(e) {
           
            if (validateForm(0)){
                $("#form0").submit();
            }
        });
				
    });

		$(document).ready(function () {
			jQuery.validator.addMethod("noSpace", function(value, element) { 
				return value.indexOf(" ") < 0 && value != ""; 
			}, "No space");
		
		
			$('#form0').validate({
				rules : {
					username :{
							required    : true,
							noSpace 	: true,
							minlength	: 5
					},
					name :{
							required    : true
					},
					password :{
							required : true,
							minlength	: 6
					},
					confirm_password :{
							required : true,
							equalTo: "#password"
					}
				},
				
				messages: {
					username :{
							required    : "This field is required",
							noSpace 	: "No space"
					},
					name :{
							required    : "This field is required"
					},
					password :{
							required    : "This field is required"
					},
					confirm_password :{
							required    : "This field is required"
					}
				},
				errorPlacement: function(error, element) {
					if(element.attr("name") == "username") {
						$('#fUsername').html(error);
						$('#fieldUsername').addClass('has-error');
					}
				
					if(element.attr("name") == "name") {
						$('#fName').html(error);
						$('#fieldName').addClass('has-error');
					}
			

					if(element.attr("name") == "password") {
						$('#fPassword').html(error);
						$('#fieldPassword').addClass('has-error');
					}

					if(element.attr("name") == "confirm_password") {
						$('#fConfirmPassword').html(error);
						$('#fieldConfirmPassword').addClass('has-error');
					}
				
				}
			});
		
			//Form0 Submit
			$("#form0").submit(function(e){ 
				var username = $('#form0').find('input[name="username"]').val();
				var name = $('#form0').find('input[name="name"]').val();
				var level = $('#form0').find('select[name="level"]').val();
				var pass = $('#form0').find('input[name="password"]').val();

				var data = [];
				// console.log(data); 
				data.push(
					{ name: 'username', value: username },
					{ name: 'name', value: name },
					{ name: 'level', value: level },
					{ name: 'password', value: pass }
				);
					$.ajax( {
						'dataType': 'json',
											'type': 'POST',
											'url': 'serverside/adduser.php',
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
				var username 	= $('#form1').find('input[name="username1"]').val();
				var name 			= $('#form1').find('input[name="name1"]').val();
				var level 		= $('#form1').find('select[name="level1"]').val();

				var checked 	= $('#isactive').prop('checked')
				var isactive 	= 0;
				if(checked){
					isactive 		= 1;
				}

				var data = [];
				
				data.push(
					{ name: 'id', value: id },
					{ name: 'obj', value: 'profile' },
					{ name: 'username', value: username },
					{ name: 'name', value: name },
					{ name: 'level', value: level },
					{ name: 'isactive', value: isactive }
				);

				console.log(checked);
					$.ajax( {
						'dataType': 'json',
						'type': 'POST',
						'url': 'serverside/updateuser.php',
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

			$('#form2').validate({
				rules : {
					password1 :{
							required : true,
							minlength	: 6
					},
					confirm_password1 :{
							required : true,
							equalTo: "#password1"
					}
				},
				
				messages: {
					password1 :{
							required    : "This field is required"
					},
					confirm_password1 :{
							required    : "This field is required"
					}
				},
				errorPlacement: function(error, element) {
					if(element.attr("name") == "password1") {
						$('#fPassword1').html(error);
						$('#fieldPassword1').addClass('has-error');
					}

					if(element.attr("name") == "confirm_password1") {
						$('#fConfirmPassword1').html(error);
						$('#fieldConfirmPassword1').addClass('has-error');
					}
				
				}
			});
			
			//Form2 Submit
			$("#form2").submit(function(e){ 
				var id = $('#form1').find('input[name="id"]').val();
				var pass = $('#form2').find('input[name="password1"]').val();

				var data = [];
				// console.log(pass); 
				data.push(
					{ name: 'id', value: id },
					{ name: 'obj', value: 'password' },
					{ name: 'password', value: pass }
				);
					$.ajax( {
						'dataType': 'json',
						'type': 'POST',
						'url': 'serverside/updateuser.php',
						'data': data,
						success: function (res) {
							// console.log(res);
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
				$("#ModalEdit").modal('show');
				
				$('#form1').find('input[name="id"]').val(data.id);
				$('#form1').find('input[name="username1"]').val(data.username);
				$('#form1').find('input[name="name1"]').val(data.name);
				$('#form1').find('select[name="level1"]').val(data.level);
			
				if(data.isactive == 1){
					$('#isactive').prop('checked', true);
				}else{
					$('#isactive').prop('checked', false);
				}
				

				$('#fieldName1').removeClass('has-error');
				$('#fieldUsername1').removeClass('has-error');
				$('#fieldPassword1').removeClass('has-error');
				$('#fieldConfirmPassword1').removeClass('has-error');

				$('#form1').find('input[name="id"]').val(data.id);
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
										{ name: 'obj', value: 'delete' }
									);

									$.ajax( {
										'dataType': 'json',
										'type': 'POST',
										'url': 'serverside/updateuser.php',
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

input.error{
	border-color: #dd4b39 !important;
}

label.error{
	color: #dd4b39;
}
</style>


