<?php require_once('Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_conn, $conn);
$query_time = "SELECT * FROM datasampling";
$time = mysql_query($query_time, $conn) or die(mysql_error());
$row_time = mysql_fetch_assoc($time);
$totalRows_time = mysql_num_rows($time);

$i = 0;
do
{
	$samplingtime[$i] = $row_time['SamplingTime'];
	//echo $samplingtime[$i];
	$i = $i+1;
	}
while ($row_time = mysql_fetch_assoc($time));

mysql_select_db($database_conn, $conn);
$query_hari = "SELECT calendar_table.dt FROM calendar_table WHERE calendar_table.dt Between '2017-01-01' and '2017-12-31'";
$hari = mysql_query($query_hari, $conn) or die(mysql_error());
$row_hari = mysql_fetch_assoc($hari);
$totalRows_hari = mysql_num_rows($hari);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1" cellpadding="1" cellspacing="1">
  <tr>
    <td>No</td>
    <td>Sampling Date</td>
    <td>Sampling Time</td>
    <td>Queries</td>
    <td>Status</td>
  </tr>
  
  <?php 
  
    // Create connection
	$conn = new mysqli($hostname_conn, $username_conn, $password_conn, $database_conn);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
  
  
  $k = 1;
  do { ?>
     <?php
      for ($j=0;$j<$totalRows_time;$j++)
	  {
	  ?>
    <tr>
      <td><?php echo $k; ?></td>
      <td><?php echo $row_hari['dt']; ?></td>
      <td><?php echo $samplingtime[$j];?></td>
      <td>
	  		<?php 
			$sql = "insert into wldata (noid, SamplingDate, SampingTime,WL) values ($k,'$row_hari[dt]','$samplingtime[$j]',0);";
			echo $sql; 
			$k=$k+1;
			?>
      </td>
      <td>
		  <?php 
          if ($conn->multi_query($sql) === TRUE) {
			echo "New records created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		
		  ?>
      </td>
    </tr>
    <?php
      }
	  ?>
    <?php } while ($row_hari = mysql_fetch_assoc($hari)); 
	$conn->close();
	?>
</table>
</body>
</html>
<?php
mysql_free_result($time);

mysql_free_result($hari);
?>
