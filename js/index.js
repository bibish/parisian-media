
$( document ).ready(function() {
    
	$(".menu-collapsed").click(function(){

		if ($(this).hasClass("menu-expanded")) {

			$("body").css({"position" : "fixed"});
			$(".next, .prev").hide();

		}else{

			$("body").css({"position" : "inherit"});
			$(".next, .prev").show();

		};


	})


});