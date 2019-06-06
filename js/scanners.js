$(document).ready(function(){

var processing = '<td id="state" value="PROCESSING" style="padding-left: 20px"><div class="spinner-border text-muted"></div></td>';
var finished = '<td id="state" value="FINISHED" class="px-4"><i class="far fa-check-circle fa-lg" style="color:green;"></i></td>';
var ready = '<td id="state" value="READY" class="px-4"><i class="far fa-question-circle fa-lg" style="color: gray;"></i></td>';
var play = '<button class="btn-custom" id="play"><i class="fas fa-play"></i></button></a>';
var stop = '<button class="btn-custom" id="stop"><i class="fas fa-stop"></i></button>';
var replay = '<button class="btn-custom" id="replay"><i class="fas fa-redo-alt"></i></button></a>';
$("select").change(function(){
	
	if($("select").val() ==='custom')
	{
		$("input[type=checkbox]").not("#switchUdp").prop("disabled",false);
	}
	else
	{
		$("input[type=checkbox]").not("#switchUdp").prop("disabled",true);
		$("input[type=checkbox]").not("#switchUdp").prop("checked",false);
	}
});


$("#submitBtn").click(function(){
	$.ajax({
		type:"POST",
		data:{newScanner:true,
		name:$("#name").val(),
		target:$("#target").val(),
		technique:$("select").val(),
		urg:$("#checkUrg").is(":checked"),
		ack:$("#checkAck").is(":checked"),
		psh:$("#checkPsh").is(":checked"),
		rst:$("#checkRst").is(":checked"),
		syn:$("#checkSyn").is(":checked"),
		fin:$("#checkFin").is(":checked")
	},
		url:"scanner-processing.php",
		success: function(result,status,xhr){
			location.reload();	
		}
	});
});

$('div[id="btn-action"]').click(function(){
	
	var action = $(this).find(".btn-custom").attr('id');
	var state = $(this).closest('tr').find('td[id="state"]').attr('value');
	var id = $(this).closest('tr').attr('value');
	var obj = {'id_scanner':id,'state':state};

	if(action ==="play")
	{
		//replace status to PROCESSING
		$(this).closest('tr').find('td[id="state"]').replaceWith(processing);
		//replace action btn to STOP
		$(this).find(".btn-custom").replaceWith(stop);

	}	
	if(action === "stop")
	{
		//replace status to READY
		$(this).closest('tr').find('td[id="state"]').replaceWith(ready);
		//replace action btn to PLAY
		$(this).find(".btn-custom").replaceWith(play);
	}
	if(action === "replay")
	{
		//replace status to READY
		$(this).closest('tr').find('td[id="state"]').replaceWith(processing);
		//replace action btn to PLAY
		$(this).find(".btn-custom").replaceWith(stop);
	}
});

function updateScanner(id_scanner)
{
	alert("Update scanner: "+id_scanner);
}
function getContent(info)
{
    var queryString = {'info' : info};
    $.ajax(
        {
            type: 'POST',
            url: 'http://localhost/server.php',
            data: queryString,
            success: function(data){
                var obj = jQuery.parseJSON(data);
                updateScanner(obj.id_scanner);
                getContent(obj);
            }
        }
    );
}



});