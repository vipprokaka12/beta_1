<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Demo Upload and Image in CI</title>
<link href="<?php echo base_url();?>public/css/style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<div id="gallery">
	<?php if (isset($images)):
			foreach($images as $image):	?>
			<div class="thumb">
				<a href="<?php echo $image['url']; ?>">
					<img src="<?php echo $image['thumb_url']; ?>" />
				</a>				
			</div>
		<?php endforeach; else: ?>
			<div id="blank_gallery">Please Upload an Image</div>
		<?php endif; ?>
</div>
<div id="upload">
<form action="<?php base_url();?>gallery" method="post" enctype="multipart/form-data">   
	<input type="file" name="img" />
	<input type="submit" name="ok" value="Upload" />	
</form>
</div>
</body>
</html>