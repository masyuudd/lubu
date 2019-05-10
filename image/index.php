<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Easy and Simple Image Upload</title>
</head>
<body>
	<div>
	Uploaded Images:
	<?php
		include('conn.php');
		$query=mysqli_query($con,"select * from image_tb");
		while($row=mysqli_fetch_array($query)){
			?>
				<img src="<?php echo $row['img_location']; ?>" width="100" height="150" >
			<?php
		}
	?>
	</div>
	<div>
	<form method="POST" action="upload.php" enctype="multipart/form-data">
	<label>Image:</label><input type="file" name="image">
	<button type="submit">Upload</button>
	</form>
	</div>
</body>
</html>