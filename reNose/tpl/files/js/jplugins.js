$(document).ready(function(){

    jQuery("div#navigation ul").ready(function(){
		$("#content").append('<p><img src="tpl/files/images/ajax-loader.gif" style="position:absolute;right:5px;top:5px;" /></p>');
		var path = jQuery("#path").attr("href");
		var params=document.URL.replace(path, "").replace(".html", "");
		if (params == "") {params = "home"};
	
		$.ajax({
		    type: "GET",
	    	url : "functions/getPage.php",
		    data: "id=" + params,
			success: function(data) {
			    $("#content").html(data);
			}
	    });
    });


    $("div#navigation ul li a").click(function(){
		//var param = ($(this).attr('id').replace("pageid_", ""));
		$("#content").append('<p><img src="tpl/files/images/ajax-loader.gif" style="position:absolute;right:5px;top:5px;" /></p>');
	
		/*$.ajax({
	    	type: "GET",
		    url : "functions/getPage.php",
		    data: "id="+param,
	    	success: function(data) {
				$("#content").html(data);
		    },
		    statusCode: {404: function() {
				$("#content").text('Seite nicht gefunden');
			}}
	    });*/
    });
    
});

function returnToLastPage() {
    /*document.location.href= "http://www.java2s.com"*/
    history.back();
}


jQuery.fn.alertbox = function(options) {
    var defaults = {
    };
    var options = jQuery.extend(defaults, options);

    return this.each(function() {
	var obj = jQuery(this);
	var objheight = obj.height();
	var objwidth = obj.width();
	var screenwidth = (window.innerWidth / 2) - (objwidth / 2);
	var screenheight = (window.innerHeight / 2) - (objheight / 2);

	obj.ready(function(){
	    obj.css({
		"display" : "block",
		"top" : "" + screenheight + "px",
		"left" : "" + screenwidth + "px",
		"visibility" : "visible"
	    })
	    ;
	});

	jQuery("input#closealertbox").click(function(){
	    jQuery("div.alertbox").fadeOut();
	    jQuery("div.overlay").fadeOut();
	    return false;
	});
	jQuery("div.overlay").click(function(){
	    jQuery("div.alertbox").fadeOut();
	    jQuery("div.overlay").fadeOut();
	    return false;
	});
    });
}


$(function(){
    $('.alertbox').alertbox();
});

