$(document).ready(function(){

$("#submitBtn").click(function(){
	$.ajax({
		type:"POST",
		data:{msg:"da"},
		url:"scanner-processing.php",
		success: function(result,status,xhr){
			console.log("result: " + result);
			console.log("status: " + status);
			console.log("xhr: " + xhr);
		}
	});
});

$(".btn-custom").click(function(){
	var button = this.id.split("-",2);
	$.ajax({
		type: "POST",
		data:{action:button[0],
			id_scanner:button[1]},
		url:"scanner-processing.php",
		success: function(result,status,xhr){
			console.log(result);
		}
	});
});
});