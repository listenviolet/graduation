$(document).ready(function(){
	var input_classid=document.getElementById("classid");
	var classid=input_classid.value;
	var hw_lists=document.getElementById("hw-lists");

	function pageLoad(){
		getClassName(classid);
		console.log("classid in pageload:"+classid);
		getHwLists(processGetHwLists,errGetHwLists);
	}

	function getClassName(classid){
		$.ajax({
			type:"GET",
			data:{"class_id":classid},
			url:"../php/get_class_name.php",
			success:function(data){
				var classinfo;
				classinfo=JSON.parse(data);
				var classname=classinfo[0].classname;
				$("#class_name").append("<h2>For Class  "+"<span style='color:#4169E1'>"+classname+"</span></h2>");
			},
			error:function(){
				alert("Error ajax!");
			}
		});
	}

	function getHwLists(processGetHwLists,errGetHwLists){
		$.ajax({
			type:"GET",
			data:{"classid":classid},
			url:"../php/collect_get_hwlists.php",
			success:function(data){
				processGetHwLists(data);
			},
			error:function(data){
				errGetHwLists(data);
			}
		});
	}

	function processGetHwLists(data){
		var filename_array=JSON.parse(data);
		var files_num=filename_array.length;
		console.log("filename_array:"+filename_array[0]);
		var i;
		for(i=0;i<files_num;i++){
			filename=filename_array[i];
			var dir_file=filename.substring(0,filename.indexOf("."));
		    console.log("processGetHwLists dir_file:"+dir_file);
			loadXMLDoc(filename);	
			//getStuList(classid,dir_file,processGetStuList,errGetStuList);
		}
	}

	function loadXMLDoc(filename) {
		var xmlhttp = new XMLHttpRequest();
	  	xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	var dir_file=filename.substring(0,filename.indexOf("."));
		    	console.log("loadXMLDoc dir_file:"+dir_file);
		    	showHwName(this,dir_file);
		    	getStuList(classid,dir_file,processGetStuList,errGetStuList);
		    }
		};
	  	xmlhttp.open("GET", "../xml/"+classid+"/"+filename, true);
	  	xmlhttp.send();
	}

	function showHwName(xml,k){
	  	xmlDoc = xml.responseXML;
	  	var hwname=xmlDoc.getElementsByTagName("hwname")[0].childNodes[0].nodeValue;
		var hwtime=xmlDoc.getElementsByTagName("hwtime")[0];
		var hwstarttime=hwtime.childNodes[0].childNodes[0].nodeValue;
		var hwdeadline=hwtime.childNodes[1].childNodes[0].nodeValue;
		console.log("k: "+k);
		console.log("showHwName:");
	  	console.log("hwname:"+hwname+" hwstarttime:"+hwstarttime+" hwdeadline:"+hwdeadline);

	  	var card=document.createElement("div");
	  	var card_header=document.createElement("div");
	  	var card_h=document.createElement("h4");
	  	var card_a_text=document.createTextNode(hwname);
	  	//card_h.appendChild(card_t);
	  	var card_a=document.createElement("a");
	  	var card_body=document.createElement("div");

	  	card.className="card";
		card.id="card"+k;
		card_header.className="card-header";
		card_header.setAttribute("role", "tab");
		card_header.id="heading"+k;
		card_h.className="mb-0";
		card_a.setAttribute("data-toggle","collapse");
		card_a.setAttribute("data-parent","#hw-lists");
		card_a.href="#collapse"+k;
		card_a.setAttribute("aria-expanded","false");
		card_a.setAttribute("aria-controls","collapse"+k);
		card_a.appendChild(card_a_text);
		card_body.id="collapse"+k;
		card_body.className="collapse";
		card_body.setAttribute("role","tabpanel");
		card_body.setAttribute("aria-labelledby","heading"+k);

	  	var form_hw = document.createElement("form");
	  	//var form_hw = document.createElement("div");
		//var hw_name_h=document.createElement("h4");
		//var hw_name_text=document.createTextNode(hwname);
		//hw_name_h.appendChild(hw_name_text);
		var label_starttime=document.createElement("label");
		var label_deadline=document.createElement("label");
		var input_starttime=document.createElement("input");
		var input_deadline=document.createElement("input");
		var download_list=document.createElement("input");

		//form_hw.id="form_hw"+k;
		//form_hw.className="container";
		form_hw.id="form_hw"+k;
		form_hw.action="../php/collect_download_form.php";
		form_hw.method="post";
		form_hw.enctype="multipart/form-data";
		//form_hw.onsubmit="function(){getDownloadList(k)}";
		//form_hw.onsubmit="function(){myFunction()}";
		//form_hw.addEventListener('submit',myFunction(k));
		function myFunction(k){
			alert("onsubmit"+k);
		}
		label_starttime.for="starttime"+k;
		label_starttime.innerHTML="Starttime :";

		input_starttime.id="starttime"+k;
		input_starttime.name="starttime";
		input_starttime.type="text";
		input_starttime.value=hwstarttime;

		label_deadline.for="deadline"+k;
		label_deadline.innerHTML="Deadline :";

		input_deadline.id="deadline"+k;
		input_deadline.name="deadline";
		input_deadline.type="text";
		input_deadline.value=hwdeadline;

		download_list.id="download_list"+k;
		download_list.name="download_list";
		download_list.type="hidden";

		//form_hw.appendChild(hw_name_h);
		form_hw.appendChild(label_starttime);
		form_hw.appendChild(input_starttime);
		form_hw.appendChild(label_deadline);
		form_hw.appendChild(input_deadline);
		form_hw.appendChild(download_list);

		card_body.appendChild(form_hw);
		card_h.appendChild(card_a);
		card_header.appendChild(card_h);
		card.appendChild(card_header);
		card.appendChild(card_body);
		hw_lists.appendChild(card);
	}



	function getStuList(classid,dir_file,processGetStuList,errGetStuList){
		console.log("getStuList dir_file:"+dir_file);
		$.ajax({
			type:"GET",
			data:{"classid":classid,"dir_file":dir_file},
			url:"../php/collect_get_stulist.php",
			success:function(data){
				console.log("getStuList success dir_file:"+dir_file);
				processGetStuList(data,dir_file);
			},
			error:function(data){
				errGetStuList(data);
			}
		});
	}

	function processGetStuList(data,dir_file){
		console.log("success get stu list");
		console.log("processGetStuList dir_file:"+dir_file);
		
		$("#form_hw"+dir_file).append("<table class='table table-responsive' id='table"+dir_file+"'></table>");
		$("#table"+dir_file).append("<tr><th>#</th><th>E-Mail</th><th>Name</th><th>Choose All<input type='checkbox' name='checkall' id='checkall"+dir_file+"'></th></tr>")
		

		var stu_list=JSON.parse(data);
		$.each(stu_list,function(index,listinfo){
			console.log("email: "+listinfo.email);
			console.log("name: "+listinfo.name);
			console.log("hwpath: "+listinfo.hwpath);
			showStuList(index,listinfo,dir_file);
		});

		$("#checkall"+dir_file).off("click").click(function(){
			console.log("this.checked:");
			console.log(this.checked);
			$('input[name="hwfile'+dir_file+'"]').attr("checked",this.checked);
			console.log("hwfile click:");
		});
		var $hwfile=$("input[name='hwfile"+dir_file+"']");
		$hwfile.click(function(){
			console.log("hwfile click");
			$("#checkall"+dir_file).attr("checked",$hwfile.length==$("input[name='hwfile"+dir_file+"']:checked").length ? true : false);
		});

		//$("#form_hw"+dir_file).append("<input id='download"+dir_file+"' type='button' class='btn btn-success' value='Download'>");
		$("#form_hw"+dir_file).append("<button type='submit' id='download"+dir_file+"' class='btn btn-success'>"+"<i class='glyphicon glyphicon-download'></i> Download</button>");
		$("#form_hw"+dir_file).append("<hr>");
		$("#form_hw"+dir_file).submit(function(){
			var downloadlist = [];
			alert("dir_file:"+dir_file);
			$.each($("input[name='hwfile"+dir_file+"']:checked"),function(){
				downloadlist.push($(this).val());
			});
			alert("downloadlist:");
			alert(downloadlist);
			$("#download_list"+dir_file).val(downloadlist);
		});
	}

	function getDownloadList(dir_file){
		$.each($("input[name='hwfile"+dir_file+"']:checked"),function(){
			downloadlist.push($(this).val());
		});
		console.log("downloadlist:");
		alert(downloadlist);
	}

	function showStuList(index,listinfo,dir_file){
		var email=listinfo.email;
		var name=listinfo.name;
		var hwpath=listinfo.hwpath;
		console.log("in show dir_file:"+dir_file);
		$("#table"+dir_file).append("<tr><td>"+(index+1)+"</td><td>"+email+"</td><td>"+name+"</td><td><input type='checkbox' name='hwfile"+dir_file+"' value='"+hwpath+"'></td></tr>");
	}

	function errGetStuList(data){
		alert("error ajax");
	}

	function errGetHwLists(data){
		alert("error ajax");
	}

	pageLoad();
});