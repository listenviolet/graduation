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
		$("#collect_class").append("<form class='container' id='class"+class_id+"' action = '../pages/collect_hw.php' method='post' enctype='multipart/form-data'></div>");
		$("#class"+class_id).append("<label for='input"+class_id+"'>Class Name: </label>");
		$("#class"+class_id).append("<input type='text' id='input"+class_id+"' name='input"+class_id+"' value='"+class_name+"' readOnly>");
		$("#class"+class_id).append("<input type='hidden' id='classid"+class_id+"' name='classid' value='"+class_id+"'>");
		$("#class"+class_id).append("<input class='btn btn-success' type='submit' id='enterclass"+class_id+"' name='enterclass"+class_id+"' value='Collect Homework'>");
		$("#class"+class_id).append("<hr>");
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