<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Password manager</title>
	
	<link href="css/style.css" rel="stylesheet" type="text/css">

	
</head>
<body>
	<form method="POST" action="password_protect.php">
	  <input type="TEXT" name="pass" <?php if($error) echo "class='error'"; ?> ></input>
	  <i class="icon-arrow-right"></i>
	  <input class="btn" type="hidden" name="submit"></input>
	</form>
	
	
</body>
</html>


