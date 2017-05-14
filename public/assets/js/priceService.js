function setPrice(serviceId, solicitudId){
	var price = $("#price" + serviceId).val();
	var u = '/admin/update/REST/price?' + 'serviceId=' + serviceId + '&solicitudId=' + solicitudId + '&price=' + price;

	$.ajax({
		url : u,
		beforeSend : function(){
			$("#button" + serviceId).css("opacity","0");
			$("#alertSuccess" + serviceId).css("display","none");
			$("#alertFail" + serviceId).css("display","none");
		},
		success : function(data){

			if (data.ok) {
				$("#alertSuccess" + serviceId).css("display","inline-block");
			} else {
				$("#alertFail" + serviceId).css("display","inline-block");
			}
		},
		error : function(error){
			$("#alertFail" + serviceId).css("display","inline-block");
		},
		complete : function(){
			$("#button" + serviceId).css("opacity","1");
		}
	});

}

function setStatus(solicitudId){
	var u = '/admin/update/REST/status?solicitudId=' + solicitudId + '&status=' + $("#status").val();

	$.ajax({
		url : u,
		beforeSend : function(){
			$("#buttonStatus" + solicitudId).css("opacity","0");
			$("#alertStatusSuccess" + solicitudId).css("display","none");
			$("#alertStatusFail" + solicitudId).css("display","none");
		},
		success : function(data){

			if (data.ok) {
				$("#alertStatusSuccess" + solicitudId).css("display","inline-block");
			} else {
				$("#alertStatusFail" + solicitudId).css("display","inline-block");
			}
		},
		error : function(error){
			$("#alertStatusFail" + solicitudId).css("display","inline-block");
		},
		complete : function(){
			$("#buttonStatus" + solicitudId).css("opacity","1");
		}
	});

}



