<?php require_once('Connections/lubu.php'); ?>
<?php
mysql_select_db($database_lubu, $lubu);
$query_ljoin = 
"	SELECT	".
"	    AAA.date_field	".
"	    ,IFNULL(a.WLevel,0) lubusatu	".
"		,IFNULL(b.WLevel,0) lubudua	".
"		,IFNULL(c.WLevel,0) lubutoreh	".
"		,IFNULL(d.WLevel,0) talusatu	".
"		,IFNULL(e.WLevel,0) taludua	".
"	FROM	".
"	(	".
"	    SELECT date_field	".
"	    FROM	".
"	    (	".
"	        SELECT MAKEDATE(YEAR('2017/02/01'),1) +	".
"	        INTERVAL (MONTH('2017/02/01')-1) MONTH +	".
"	        INTERVAL daynum DAY date_field	".
"	        FROM	".
"	        (	".
"	            SELECT t*10+u daynum FROM	".
"	            (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,	".
"	            (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3	".
"	            UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7	".
"	            UNION SELECT 8 UNION SELECT 9) B ORDER BY daynum	".
"	        ) AA	".
"	    ) AA WHERE MONTH(date_field) = MONTH('2017/02/01')	".
"	) AAA 	".
"	LEFT JOIN (SELECT SamplingDate,avg(WLevel) as WLevel FROM lubusatu group by SamplingDate	".
"				) a 	".
"	on datediff(aaa.date_field,a.SamplingDate)=0	".
"	LEFT JOIN (SELECT SamplingDate,avg(WLevel) as WLevel FROM lubudua group by SamplingDate	".
"				) b 	".
"	on datediff(aaa.date_field,b.SamplingDate)=0	".
"	LEFT JOIN (SELECT SamplingDate,avg(WLevel) as WLevel FROM ltoreh group by SamplingDate	".
"				) c 	".
"	on datediff(aaa.date_field,c.SamplingDate)=0	".
"	LEFT JOIN (SELECT SamplingDate,avg(WLevel) as WLevel FROM talusatu group by SamplingDate	".
"				) d 	".
"	on datediff(aaa.date_field,d.SamplingDate)=0	".
"	LEFT JOIN (SELECT SamplingDate,avg(WLevel) as WLevel FROM taludua group by SamplingDate	".
"				) e 	".
"	on datediff(aaa.date_field,e.SamplingDate)=0	;";



$ljoin = mysql_query($query_ljoin, $lubu) or die(mysql_error());
$row_ljoin = mysql_fetch_assoc($ljoin);
$totalRows_ljoin = mysql_num_rows($ljoin);
?>

<table>
<thead>
	<tr>
	<th>date_field</th>
	<th>lubusatu</th>
	<th>lubudua</th>
	<th>lubu Toreh</th>
	<th>Talusatu</th>
	<th>taludua</th>
</thead>
<tbody>
<?php do{ ?>
<tr>

<td><?php echo $row_ljoin['date_field'];?></td>
<td><?php echo $row_ljoin['lubusatu'];?></td>
	<td><?php echo $row_ljoin['lubudua'];?></td>
	<td><?php echo $row_ljoin['lubutoreh'];?></td>
	<td><?php echo $row_ljoin['talusatu'];?></td>
	<td><?php echo $row_ljoin['taludua'];?></td>
    <?php } while ($row_ljoin = mysql_fetch_assoc($ljoin)); ?>
</tr>
</tbody>

<?php
mysql_free_result($ljoin);
?>
