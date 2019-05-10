<?php require_once('Connections/lubu.php'); ?>
<?php
mysql_select_db($database_lubu, $lubu);
$query_cekdb = "SELECT * FROM tabelformula";
$cekdb = mysql_query($query_cekdb, $lubu) or die(mysql_error());
$row_cekdb = mysql_fetch_assoc($cekdb);
$totalRows_cekdb = mysql_num_rows($cekdb);
?>


<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>noagent</td>
    <td>AgentID</td>
    <td>tanggal</td>
    <td>a</td>
    <td>b</td>
    <td>c</td>
    <td>author</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_cekdb['noagent']; ?></td>
      <td><?php echo $row_cekdb['AgentID']; ?></td>
      <td><?php echo $row_cekdb['tanggal']; ?></td>
      <td><?php echo $row_cekdb['a']; ?></td>
      <td><?php echo $row_cekdb['b']; ?></td>
      <td><?php echo $row_cekdb['c']; ?></td>
      <td><?php echo $row_cekdb['author']; ?></td>
    </tr>
    <?php } while ($row_cekdb = mysql_fetch_assoc($cekdb)); ?>
</table>

<?php
mysql_free_result($cekdb);
?>
