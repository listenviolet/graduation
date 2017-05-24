$(document).ready(function(){
	var i=1;
	var classesid = new Array();
	var deletelist = new Array();
	var class_num;
	function pageLoad(){
		getExistedClasses(processExistedClasses,errProcess);

		var add=document.getElementById("add");
		add.onclick=addClass;

		var submit=document.getElementById("submit");
		submit.onclick=classesArray;
	}
	function getExistedClasses(callback,errback){
		$.ajax({
			type:"GET",
			url:"../php/setupDB_classes.php",
			success:function(data){
				callback(data);
			},
			error:function(data){
				errback(data);
			}
		});
	}

	function processExistedClasses(data){
		var existedClasses=JSON.parse(data);
		console.log("success ajax");
		$.each(existedClasses,function(index,classinfo){
			console.log(index);
			console.log("id: " + classinfo.class_id);
			console.log("name: "+classinfo.class_name);
			console.log("csv: "+ classinfo.class_csv);
			addExistedClass(index,classinfo);
		});
	}

	function errProcess(err){
		console.log("error ajax");
	}


	function addExistedClass(index,classinfo){
		var class_id=classinfo.class_id;
		var class_name=classinfo.class_name;
		$("#existed").append("<div class='container' id='existed_div"+class_id+"'></div>");
		$("#existed_div"+class_id).append("<label for='existed_class_id"+class_id+"'>Class Name: </label>");
		$("#existed_div"+class_id).append("<input class='existed_classes_input' type='text' id='existed_class_id"+class_id+"' name='existed_class_id"+class_id+"' readOnly value="+class_name+"><br>");
		$("#existed_div"+class_id).append("<input class='btn btn-default' type='button' id='button_view"+class_id+"' name='button_view"+class_id+"' value='View Students List'>");
		//$("#existed_div"+index).append("<input type='file' id='button_update"+index+"' name='button_update"+index+"' value='Update'>");
		$("#existed_div"+class_id).append("<input class='btn btn-default' type='button' id='button_delete"+class_id+"' name='button_delete"+class_id+"' value='Delete'>");
		$("#existed_div"+class_id).append("<hr>");
		$("#button_view"+class_id).click(function(){
			viewStu(class_id);
		});
		$("#button_delete"+class_id).click(function(){
			deleteExist(class_id);
		});
	}

	function viewStu(class_id){
		alert("class_id");
	}

	function deleteExist(class_id){
		alert("Delete");
		deletelist.push(class_id);
		var existed=document.getElementById("existed");
		var existed_div=document.getElementById("existed_div"+class_id);
		existed.removeChild(existed_div);	
	}

	function addClass(){
		var classes=document.getElementById("classes");
		var div=document.createElement("div");
		var label=document.createElement("label");
		var inputClass_id=document.createElement("input");
		var br=document.createElement("br");
		
		var inputClass_csv=document.createElement("input");
		var delClass=document.createElement("input");
		var hr=document.createElement("hr");

		var file_a=document.createElement("a");
		file_a.className="btn btn-primary btn-file";
		var file_span=document.createElement("span");
		file_span.className="fileupload-new";
		var file_text_span=document.createTextNode("Select File");
		file_span.appendChild(file_text_span);
		var label_csv=document.createElement("label");

		div.id="class"+i;
		//div.innerHTML="Class "+i+" ";
		label.for="class_id"+i;
		label.innerHTML=i+". Class Name :";
		inputClass_id.type="text";
		inputClass_id.name="class_id"+i;
		inputClass_id.id="class_id"+i;

		classesid.push(inputClass_id.id);
		console.log(classesid);

		label_csv.for="class_csv"+i;
		label_csv.innerHTML="Upload the students csv file :";

		inputClass_csv.type="file";
		inputClass_csv.name="class_csv"+i;
		inputClass_csv.id="class_csv"+i;
		inputClass_csv.className="file-input";

		file_a.appendChild(file_span);
		file_a.appendChild(inputClass_csv);

		delClass.type="button";
		delClass.value="Delete";
		delClass.name="class_del";
		delClass.id="class_del"+i;
		delClass.className="btn btn-default";
		//$("#"+delClass.id).addClass("btn btn-default btn-lg");
		delClass.onclick=function classDel() {
			alert("Delete class"+inputClass_id.id);
			console.log(inputClass_id.id);

			var del_index=classesid.indexOf(inputClass_id.id);
			console.log(del_index);
			classesid.splice(del_index,1);
			console.log(classesid);
			
			classes.removeChild(div);
		};

		i=i+1;

		div.appendChild(label);
		div.appendChild(inputClass_id);
		div.appendChild(br);
		div.appendChild(label_csv);
		//div.appendChild(inputClass_csv);
		div.appendChild(file_a);
		div.appendChild(delClass);
		div.appendChild(hr);

		classes.appendChild(div);
	}

	function classesArray(){
		var classarray=document.getElementById("classarray");
		classarray.value=classesid;
		console.log(classesid);

		var deletearray = document.getElementById("deletearray");
		deletearray.value=deletelist;
		console.log(deletelist);
	}

	pageLoad();

});