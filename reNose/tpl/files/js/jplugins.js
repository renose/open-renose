/* $(document)
	.ready(function() {
		$("li#test").ready(function(){
			$('#seiten').html('<p><img src="files/images/ajax-loader.gif" /></p>');
			var param = "Welt";
			$.ajax({
		    url : "http://google.de",
		    success: function(data) {
			$("#seiten").html(data);
	    	},
		    statusCode: {404: function() {
    			$("#seiten").text('Seite nicht gefunden');
			}}
		});
	});
}); */

$(function(){$('#menubox').tabs();});

function returnToLastPage() {
  /*document.location.href= "http://www.java2s.com"*/
  history.back();
}