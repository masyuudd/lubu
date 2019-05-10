<?php require_once('Connections/lubu.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_lubu = 10;
$pageNum_lubu = 0;
if (isset($_GET['pageNum_lubu'])) {
  $pageNum_lubu = $_GET['pageNum_lubu'];
}
$startRow_lubu = $pageNum_lubu * $maxRows_lubu;

mysql_select_db($database_lubu, $lubu);
$query_lubu = "SELECT keureutoawlr.ReceivedDate, keureutoawlr.ReceivedTime, keureutoawlr.SamplingDate, keureutoawlr.SamplingTime, keureutoawlr.WLevel as H,(WLevel*1.32) as Q   FROM keureutoawlr";
$query_limit_lubu = sprintf("%s LIMIT %d, %d", $query_lubu, $startRow_lubu, $maxRows_lubu);
$lubu = mysql_query($query_limit_lubu, $lubu) or die(mysql_error());
$row_lubu = mysql_fetch_assoc($lubu);

if (isset($_GET['totalRows_lubu'])) {
  $totalRows_lubu = $_GET['totalRows_lubu'];
} else {
  $all_lubu = mysql_query($query_lubu);
  $totalRows_lubu = mysql_num_rows($all_lubu);
}
$totalPages_lubu = ceil($totalRows_lubu/$maxRows_lubu)-1;

$queryString_lubu = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_lubu") == false && 
        stristr($param, "totalRows_lubu") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_lubu = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_lubu = sprintf("&totalRows_lubu=%d%s", $totalRows_lubu, $queryString_lubu);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>ReceivedDate</td>
    <td>ReceivedTime</td>
    <td>SamplingDate</td>
    <td>SamplingTime</td>
    <td>H</td>
    <td>Q</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_lubu['ReceivedDate']; ?></td>
      <td><?php echo $row_lubu['ReceivedTime']; ?></td>
      <td><?php echo $row_lubu['SamplingDate']; ?></td>
      <td><?php echo $row_lubu['SamplingTime']; ?></td>
      <td><?php echo $row_lubu['H']; ?></td>
      <td><?php echo $row_lubu['Q']; ?></td>
    </tr>
    <?php } while ($row_lubu = mysql_fetch_assoc($lubu)); ?>
</table>

<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_lubu > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_lubu=%d%s", $currentPage, 0, $queryString_lubu); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_lubu > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_lubu=%d%s", $currentPage, max(0, $pageNum_lubu - 1), $queryString_lubu); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_lubu < $totalPages_lubu) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_lubu=%d%s", $currentPage, min($totalPages_lubu, $pageNum_lubu + 1), $queryString_lubu); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_lubu < $totalPages_lubu) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_lubu=%d%s", $currentPage, $totalPages_lubu, $queryString_lubu); ?>">Last</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($lubu);
?>
