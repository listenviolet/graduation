$(document).ready(function(){
	function pageLoad(){
		getClasses(processGetClasses,errProcess);
	}
	
	function getClasses(callback,errback){
		$.ajax({
			type:"GET",
			url:"../php/setupDB_hw.php",
			success:function(data){
				callback(data);
			},
			error:function(data){
				errback(data);
			}
		});
	}

	function processGetClasses(data){
		var classes=JSON.parse(data);
		console.log("processGetClasses");
		$.each(classes,function(index,classinfo){
			console.log("id: "+classinfo.class_id);
			console.log("name: "+classinfo.class_name);
			showClasses(index,classinfo);
		});
	}

	function errProcess(err){
		console.log("error ajax");
	}

	function showClasses(index,classinfo){
		var class_id=classinfo.class_id;
		var class_name=classinfo.class_name;
		$("#hw").append("<div class='container' id='class_hw"+class_id+"' name='class_hw"+class_id+"'></div>");
		$("#class_hw"+class_id).append("<label for='input"+class_id+"'>Class Name: </label>");
		$("#class_hw"+class_id).append("<input type='text' id='input"+class_id+"' name='input"+class_id+"' value='"+class_name+"' readOnly>");
		$("#class_hw"+class_id).append("<input class='btn btn-default' type='button' id='sethw"+class_id+"' name='sethw"+class_id+"' value='Set Homeworks'>");
		$("#class_hw"+class_id).append("<hr>");
		$("#sethw"+class_id).click(function(){
			alert(class_id);
			turntoHwDetail(class_id);
		});
	}

	function turntoHwDetail(class_id){
		$.ajax({
			type:"GET",
			url:"../php/hw_detail.php",
			data:{"classid":class_id},
			success:function(data){
				alert(data);
			},
			error:function(data){
				errback(data);
			}
		});
	}

	pageLoad();
});