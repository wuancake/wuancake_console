        	
$(document).ready(function(){
	$(".icon-yanjing").mousedown(function(){
		$("#pswd").prop("type","text");
	});
	
	$(".icon-yanjing").mouseout(function(){
 		 $("#pswd").prop("type","password");
	});

});