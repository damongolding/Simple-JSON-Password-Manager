<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    
    <link href="css/style.css" rel="stylesheet" type="text/css">
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
</head>
<body>

	<header class="navbar">
		<div class="navbar-inner">
			<a href="#" class="brand">Password Manager</a>

		</div>
	</header>
	
	<div class="container-fluid">
	  <div class="row-fluid">
		  <!-- nav -->
		<div id="siteList" class="span3">
		  <ul class="nav" id="myTab">
			<li id="editSites" class="row-fluid">
				<a id="editBtn" class="btn btn-info span6" href="#">edit</a>
				<a href="#" id="addSite" class=" hasPop btn btn-success span6" data-toggle="popover" title="" data-content='<form id="addSiteBtn"><fieldset><input required="required" type="text" placeholder="SiteName" class="sitename"><input required="required" type="text" placeholder="Server name" class="servername"><input required="required" type="text" placeholder="Username" class="username"><input required="required" type="text" placeholder="Password" class="password"><button type="submit" class="btn">Submit</button></fieldset></form>' data-original-title="add a site">+ add</a>
			<!-- <a class="btn btn-success span6" href="#">+ add</a> -->			
			</li>
			<?php 
			
				foreach(glob('json/*{*.json}', GLOB_BRACE) as $file)   
				{  
					$JSON = file_get_contents($file,true);
					$data = json_decode($JSON,true); 

					$siteName = basename($file, ".json"); 
			
					echo "<li><a href='#" . $siteName . "'>" . $siteName ."<i class='icon-minus-sign'></i></a></li>";
				} 
					
			?>
		  </ul>
		</div>
		<!-- content -->
		<div id="contentList" class="span9">
		  <div class="tab-content">
		    
			    <?php
			    foreach(glob('json/*{*.json}', GLOB_BRACE) as $file)   
			    { 
				    $JSON = file_get_contents($file,true);
				    $data = json_decode($JSON,true); 
				    
				    $siteName = basename($file, ".json"); 

			    	echo "<div class='tab-pane' id='" . $siteName . "'>";
				    	
				    foreach($data as $server){
					    
			    		echo "<section class='row-fluid'>
								<div class='span12'>
									<div class='alert alert-info'><strong>" . $server['servername'] . "</strong></div>
									<div class='detail-container'>
										<div class='username pull-left'>
											<span>Username</span>" . $server['username'] . "
										</div>
										<div class='password pull-left'>
											<span>Password</span>" . $server['password'] . "
										</div>
									</div>
								</div>
							</section>";
						}
						echo "</div>";
					}
			    ?>
	  </div>
	</div>
	
	
	
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/app.js" type="text/javascript"></script>
	
	
    
</body>
</html>