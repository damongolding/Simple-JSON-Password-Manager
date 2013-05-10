var app = {
	init:function(){
		$("#myTab li:nth-child(2),.tab-content .tab-pane:first-child").addClass("active");
		
		$(document).on("click","#myTab li:not(#editSites) a",this.deleteSite);
		
		$(".hasPop").popover({
			html : "true",
			placement : "bottom"
		});
		
		this.bind();
	},
	
	bind:function(){
		
		$(document).on("submit","#addSiteBtn",function(e){
			e.preventDefault();
		
			var $this = $(this).children().children(),
				siteName = $this.eq(0).val(),
				serverName = $this.eq(1).val(),
				userName = $this.eq(2).val(),
				password = $this.eq(3).val(),
				selector = "addSite";
				
				app.ajaxCall(selector,siteName,serverName,userName,password);
		
		})
		
		.on("click","#editBtn",function(){
			if($(this).hasClass("edit"))
			{
				$("#myTab li:not(#editSites)").add($(this)).removeClass("edit");
			}
			else
			{
				$("#myTab li:not(#editSites)").add($(this)).addClass("edit");
			}
		})
		
		.on("click","#editSites .icon-minus-sign",function(){
			var $this = $(this),
				siteName = $this.closest("a").text(),
				serverName = $this.eq(1).val(),
				userName = $this.eq(2).val(),
				password = $this.eq(3).val();
		})
		
		.ajaxComplete(function(event, xhr, settings){
			
			var result = $.parseJSON(xhr.responseText),
				resultMsg = result.result,
				newSite = "<li><a href='#" + result.sitename + "'>" + result.sitename + "<i class='icon-minus-sign'></i></a></li>",
				newServer = "<div class='tab-pane' id='" + result.sitename + "'><section class='row-fluid'><div class='span12'><div class='alert alert-info'><strong>" + result.servername + "</strong></div><div class='detail-container'><div class='username pull-left'><span>Username</span>" + result.username + "</div><div class='password pull-left'><span>Password</span>" + result.password + "</div></div></div></section></div>";		
				
			switch(result.selector)
			{
				case("addSite"):
					if(resultMsg === "SUCCESS"){
						$("#myTab").append(newSite);
						$(".tab-content").append(newServer);
						$(".hasPop").popover('hide');
					}else if(resultMsg === "EXISTS"){
						alert("that files already EXISTS");
					}
				break;
				
				case("deleteSite"):
					if(resultMsg === "SUCCESS"){
						$(".edit a").each(function(){
							if($(this).attr("href") === "#" + result.sitename){
								$(this).parent().remove();
								$("#" + result.sitename).remove();
							}
						})
					}else if(resultMsg === "MISSING"){
						alert("that doesn't seem to exists");
					}
				break;
				
				case("addServer"):
					if(resultMsg === "SUCCESS"){
								
					}else if(resultMsg === "EXISTS"){
						alert("that files already EXISTS");
					}
				break;
				
				case("deleteServer"):
					if(resultMsg === "SUCCESS"){
							
					}else if(resultMsg === "MISSING"){
						alert("that doesn't seem to exists");
					}
				break;
			}
		});
	},
	deleteSite:function(e){
		e.preventDefault();
		
		if($("#editBtn").hasClass("edit")){
			var siteName = $(this).text(),
				selector = "deleteSite",
				deleteSite = confirm ("Are you sure you want to delete this site and all it's details?");
				
				if(deleteSite){
					app.ajaxCall(selector,siteName);
				}
			
		}
		else{
			$(this).tab('show');
		}
	},
	ajaxCall:function(selector,siteName,serverName,userName,password){
		$.ajax({
			type:"POST",
			url:"class/fileHandler.class.php",
			data:{
				"siteName":siteName,
				"serverName":serverName,
				"userName":userName,
				"password":password,
				"selector":selector
				}
			});
		}
	}

$(function () {
	app.init();
});