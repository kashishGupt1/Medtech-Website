<!doctype html>
<html>
<head>
    <title>sbrgmedtech.com &mdash; will be back soon</title>
    <meta charset="utf-8">
    <style type="text/css">
        body {font-size:16px; color:#777777; font-family:arial; text-align:center; background: #F3E9CA}
        h1 {font-size:54px; color:#555555; margin: 70px 0 50px 0;text-shadow: 3px 4px 5px rgba(0,0,0,0.2);}
		h2 {color: #DE6C5D; font-size: 32px; font-weight: bold; margin: -3px 0 39px;}
        details {width:50%; text-align:left; margin-left:auto;margin-right:auto;}
	</style>
</head>

<body>
    <h1>sbrgmedtech.com</h1>
	<h2>Upgrading site</h2> <span style="font-size: 26px;">we will be back soon </span><br>
	<h1>PHP v<span style="color:#1BC900"><?php echo ''.substr(phpversion(),0,6); ?></span></h1>
	<details>
    <?php		
		echo "max_execution_time = ".ini_get('max_execution_time')."<br>"; 
		echo "max_input_time = ".ini_get('max_input_time')."<br>";
		echo "memory_limit = ".ini_get('memory_limit')."<br>";
		echo "upload_max_filesize = ".ini_get('upload_max_filesize')."<br>";
		echo "post_max_size = ".ini_get('post_max_size')."<br>";
		echo "open_basedir = ".ini_get('open_basedir')."<br>";
		//echo "max_allowed_packet = ".ini_get('max_allowed_packet')."<br>";
	?>
	</details>
</body>
</html>

