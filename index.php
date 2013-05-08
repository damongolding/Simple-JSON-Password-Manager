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
			<ul class="nav">
			  <!--  <li class="active"><a href="#">Home</a></li>
			  <li><a href="#">Link</a></li>
			  <li><a href="#">Link</a></li>
			</ul> -->
		</div>
	</header>
	
	<div class="container-fluid">
	  <div class="row-fluid">
		  <!-- nav -->
		<div id="siteList" class="span3">
		  <ul class="nav" id="myTab">
			<li id="editSites" class="row-fluid">
				<a class="btn btn-info span6" href="#">edit</a>
				<a href="#" id="addSite" class=" hasPop btn btn-success span6" data-toggle="popover" title="" data-content='<form id="addSiteBtn"><fieldset><input required="required" type="text" placeholder="SiteName" class="sitename"><input required="required" type="text" placeholder="Server name" class="servername"><input required="required" type="text" placeholder="Username" class="username"><input required="required" type="text" placeholder="Password" class="password"><button type="submit" class="btn">Submit</button></fieldset></form>' data-original-title="add a site">+ add</a>
			<!-- <a class="btn btn-success span6" href="#">+ add</a> -->			
			</li>
			<?php 
			
				foreach(glob('json/*{*.json}', GLOB_BRACE) as $file)   
				{  
					$JSON = file_get_contents($file,true);
					$data = json_decode($JSON,true); 

					$siteName = basename($file, ".json"); 
			
					echo "<li><a href='#" . $siteName . "'>" . $siteName ."</a></li>";
				} 
					
			?>

		    <!-- <li class="active"><a href="#home">other</a></li>
		    <li><a href="#profile">Streamline</a></li>
		    <li><a href="#messages">Tetris</a></li>
		    <li><a href="#settings">blah</a></li> -->
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
	
	
	
	<script src="js/bootstrap.min.js"></script>
	<script>
	  $(function () {
		  
		$("#myTab li:nth-child(2),.tab-content .tab-pane:first-child").addClass("active");
		
		$('#myTab li:not(#editSites) a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		});
		
		$(".hasPop").popover({
			html : "true",
			placement : "bottom"
		})
				
		
		
		$(document).on("submit","#addSiteBtn",function(){
			
			var $this = $(this).children().children(),
				siteName = $this.eq(0).val(),
				serverName = $this.eq(1).val(),
				userName = $this.eq(2).val(),
				password = $this.eq(3).val();
				
				
			$.ajax({
				type:"POST",
				url:"fileHandler.php",
				data:{"siteName":siteName,"serverName":serverName,"userName":userName,"password":password,"addSite":"true"}
			})
		}).ajaxComplete(function(event, xhr, settings){
			console.log(xhr.responseText);
			if(xhr.responseText === "EXISTS"){
				alert("that files already EXISTS");
			}
			else if(xhr.responseText === "SUCCESS"){
				$(".hasPop").popover('hide');
			}
		});
		
		
});
	</script>
	
	
    
</body>
</html>