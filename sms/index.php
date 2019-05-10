<HTML>
<HEAD>
<TITLE>SMS Report</TITLE>

<script type="text/javascript" src="helper/js/jquery-1.5.min.js"></script>
	
		<script>

function timedRefresh(timeoutPeriod) {
    setTimeout("location.reload(true);",timeoutPeriod);
}
		
		</script>
		

</HEAD>
<body onload="JavaScript:timedRefresh(60000);">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
			<?php require_once "resume.php"; ?>
	</td>
  </tr>
  <tr>
    <td><?php //require_once "map.php"; ?></td>
  </tr>
</table>
<br>
<br>
  
</body>
</HTML>



