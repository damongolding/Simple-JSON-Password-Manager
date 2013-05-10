var app = {
	init:function(){
		$("#myTab li:nth-child(2),.tab-content .tab-pane:first-child").addClass("active");
		
		$('#myTab li:not(#editSites) a').on("click",this.deleteSite);
		
		$(".hasPop").popover({
			html : "true",
			placement : "bottom"
		});
		
		this.bind();
	},
	
	bind:function(){
		
		$(document).on("submit","#addSiteBtn",function(){
		
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
				resultMsg = result.result;			
				
			switch(result.selector)
			{
				case("addSite"):
					if(resultMsg === "SUCCESS"){
						
					}else if(resultMsg === "EXISTS"){
						alert("that files already EXISTS");
					}
				break;
				
				case("deleteSite"):
					if(resultMsg === "SUCCESS"){
							
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
				selector = "deleteSite";
			
			app.ajaxCall(selector,siteName);
		}
		else{
			$(this).tab('show');
		}
	},
	ajaxCall:function(selector,siteName,serverName,userName,password){
		$.ajax({
			type:"POST",
			url:"fileHandler.php",
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