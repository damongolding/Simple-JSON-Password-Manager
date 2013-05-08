var app = {
	init:function(){
		$("#myTab li:nth-child(2),.tab-content .tab-pane:first-child").addClass("active");
		
		$('#myTab li:not(#editSites) a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		});
		
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
				password = $this.eq(3).val();
		
			$.ajax({
				type:"POST",
				url:"fileHandler.php",
				data:{"siteName":siteName,"serverName":serverName,"userName":userName,"password":password,"selector":"addSite"}
			})
		}).ajaxComplete(function(event, xhr, settings){
			if(xhr.responseText === "EXISTS"){
				alert("that files already EXISTS");
			}
			else if(xhr.responseText === "MISSING"){
				alert("that files already EXISTS");
			}
			else if(xhr.responseText === "SUCCESS"){
				$(".hasPop").popover('hide');
			}
		});
	}
}

$(function () {
	app.init();
});