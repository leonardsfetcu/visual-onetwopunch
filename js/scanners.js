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
		udp:$("#switchUdp").is(":checked"),
		urg:$("#checkUrg").is(":checked"),
		ack:$("#checkAck").is(":checked"),
		psh:$("#checkPsh").is(":checked"),
		rst:$("#checkRst").is(":checked"),
		syn:$("#checkSyn").is(":checked"),
		fin:$("#checkFin").is(":checked")
	},
		url:"scanner-processing.php",
		success: function(result,status,xhr)
		{
			if(result.length)
			{
				console.log("(submit btn) New Scanner: "+result);
			}	
			location.reload();
		}
	});
	
});

$(".modal-footer button[id='delete']").click(function(){
	var scannerId = $(this).val();
	$.ajax({
		type:'POST',
		url:'scanner-processing.php',
		data:{deleteScanner:'true',
		id:scannerId},
		success: function(data)
		{
			if(data.length)
			{
				console.log("(modal delete btn) Delete Scanner: "+data);		
			}	
			$("table tr[value='"+scannerId+"']").remove();
		}
	});
	
});

$('button[id="delete"]').click(function(){
	var scannerId = $(this).data('id');
     	$(".modal-footer button[id='delete']").val(scannerId);
     	$("#deleteModal").modal('show');
});

$('div[id="btn-action"]').click(function(){
	
	var action = $(this).find(".btn-custom").attr('id');
	var state = $(this).closest('tr').find('td[id="state"]').attr('value');
	var scannerId = $(this).closest('tr').attr('value');
	
	if(action ==="play")
	{
		var obj = {'id_scanner':scannerId,'state':'PROCESSING'};
		$.ajax(
			{
				type:"POST",
				data:{runScript:"true",
				runScriptScannerId:scannerId},
				url:"scanner-processing.php",
				success: function(data){
					if(data.length)
					{
						console.log("(play) Run Script: "+data);
					}	
				}
			});
		//replace status to PROCESSING
		$(this).closest('tr').find('td[id="state"]').replaceWith(processing);
		//replace action btn to STOP
		$(this).find(".btn-custom").replaceWith(stop);
		getContent(obj);

	}	
	if(action === "stop")
	{
		$.ajax({
			type:'POST',
			url:'scanner-processing.php',
			data:{killProcess:true,
				id_scanner:scannerId},
			success:function(data)
			{
				console.log("(stop) killProcess: "+data);
				$.ajax({
				type:'POST',
				url:'scanner-processing.php',
				data:{deleteHosts:'true',
				id:scannerId},
				success: function(data)
				{
					if(data.length)
					{
						console.log("(stop) Delete Hosts: "+data);
					}
				}
				});
			}
		});
		
	}
	if(action === "replay")
	{
		//replace status to READY
		$(this).closest('tr').find('td[id="state"]').replaceWith(processing);
		//replace action btn to STOP
		$(this).find(".btn-custom").replaceWith(stop);
		$('tr[id="row"][value="'+scannerId+'"] td[id="vulnerabilities"] div[id="low"]').width(0);
		$('tr[id="row"][value="'+scannerId+'"] td[id="vulnerabilities"] div[id="medium"]').width(0);
		$('tr[id="row"][value="'+scannerId+'"] td[id="vulnerabilities"] div[id="high"]').width(0);
		$('tr[id="row"][value="'+scannerId+'"] td[id="vulnerabilities"] div[id="critical"]').width(0);

		$.ajax({
			type:'POST',
			url:'scanner-processing.php',
			data:{deleteHosts:'true',
			id:scannerId},
			success: function(data)
			{
				if(data.length)
				{
					console.log("(replay) Delete Hosts: "+data);	
				}	
			}
		});
		$.ajax(
			{
				type:"POST",
				data:{runScript:"true",
				runScriptScannerId:scannerId},
				url:"scanner-processing.php",
				success: function(data){
					if(data.length)
					{
						console.log("(replay) Run Script: "+data);	
					}
				}
			});
		var param = {'state':'PROCESSING','id_scanner':scannerId};
		getContent(param);
	}
});

function updateScanner(id)
{
	$.ajax({
		type:'POST',
		url:'scanner-processing.php',
		data:{vulnUpdate:'true',
			id_scanner:id},
		success: function(data){
			try {
				var result = jQuery.parseJSON(data);
				if(result.state === "FINISHED")
				{
					//replace status to FINISHE
					$('tr[id="row"][value="'+id+'"] td[id="state"]').replaceWith(finished);
					//replace action btn to REPLAY
					$('tr[id="row"][value="'+id+'"] div[id="btn-action"] button').replaceWith(replay);
				}
				if(result.state === "PROCESSING")
				{
					//replace status to FINISHE
					$('tr[id="row"][value="'+id+'"] td[id="state"]').replaceWith(processing);
					//replace action btn to REPLAY
					$('tr[id="row"][value="'+id+'"] div[id="btn-action"] button').replaceWith(stop);
				}
				
				//add end time
				$('tr[id="row"][value="'+id+'"] td[id="end"]').text(result.end);
				//add vuln progressbar
				$('tr[id="row"][value="'+id+'"] td[id="vulnerabilities"] div[id="low"]').width(result.widthLow+'%');
				$('tr[id="row"][value="'+id+'"] td[id="vulnerabilities"] div[id="medium"]').width(result.widthMedium+'%');
				$('tr[id="row"][value="'+id+'"] td[id="vulnerabilities"] div[id="high"]').width(result.widthHigh+'%');
				$('tr[id="row"][value="'+id+'"] td[id="vulnerabilities"] div[id="critical"]').width(result.widthCritical+'%');
			}
			catch(e)
			{
				console.log("UpdateScanner: "+e.message);
			}
		}
	});
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
            	try{
            		var obj = jQuery.parseJSON(data);
	                updateScanner(obj.id_scanner)
	                getContent(obj);
            	}
            	catch(e)
            	{
            		console.log(e.message);
            	}
            }
        }
    );
}

});