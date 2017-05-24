$(document).ready(function(){
	var hws=document.getElementById("hws");
	var input_classid=document.getElementById("classid");
	var stu_classid=input_classid.value;
	var filesType=new Array();
	var filesSize=new Array();
	console.log(stu_classid);

	pageLoad();

	function pageLoad(){
		getFileNameArray(processGetFileInfo,errGetFileName);
	}

	function getFileNameArray(callback,errback){
		$.ajax({
			type:"GET",
			data:{"stu_classid":stu_classid},
			url:"../php/stu_get_hws.php",
			success:function(data){
				callback(data);
			},
			error:function(data){
				errback(data);
			}
		});
	}

	function processGetFileInfo(data){
		var filename_array=JSON.parse(data);
		var files_num=filename_array.length; //homework sum
		var Maximum=10;
		for(var arr_i=0;arr_i<files_num;arr_i++){
			filesType[arr_i]=new Array();
			filesSize[arr_i]=new Array();
			for(var arr_j=0;arr_j<Maximum;arr_j++){
				filesType[arr_i][arr_j]="";
				filesSize[arr_i][arr_j]="";
			}
		}
		var i;
		for(i=0;i<files_num;i++){
			//html---------------
			var k=-1;
			//console.log("in for:i:"+i);
			var xhttp=new XMLHttpRequest();
			xhttp.onreadystatechange=function(){
				console.log("onreadystatechange i:"+i);
				if(this.readyState==4 && this.status==200){
					//++k;
					console.log("k:"+k);
					praiseXML(this,++k,filename_array);
				}
			};
			console.log(filename_array[i]);
			currentfile_path="../xml/"+stu_classid+"/"+filename_array[i];
			console.log(currentfile_path);
			if(xhttp.open("GET",currentfile_path,true)){
				console.log("xhttp open.");
			}
			xhttp.send();
		}
	}

	function errGetFileName(data){
		console.log("err ajax");
	}
	
	function checkFile(uploadid){
		var upload_ele=document.getElementById(uploadid);
		var curr_filesize=upload_ele.files[0].size;
		console.log(curr_filesize);
		var index_upload=uploadid.indexOf("upload");
		var index_arrj=index_upload+6;
		var arr_i=uploadid.substring(0,index_upload);
		var arr_j=uploadid.substring(index_arrj);

		console.log("substring:i "+arr_i+" j:"+arr_j);

		if(filesSize[arr_i][arr_j]*1000<curr_filesize){
			alert("The file size exceeds the limit allowed and cannot be saved.");
			window.location.reload();
		}

		var curr_filename=upload_ele.value;
		console.log(curr_filename);
		var curr_filetype=curr_filename.substring(curr_filename.indexOf("."));
		console.log(curr_filetype);
		if(curr_filetype!==filesType[arr_i][arr_j]){
			alert("The file type is not allowed.");
			window.location.reload();
		}
	}

	function praiseXML(xml,k,filename_array){	
		console.log("in praise");
		var xmlDoc=xml.responseXML;
		var hwname=xmlDoc.getElementsByTagName("hwname")[0].childNodes[0].nodeValue;
		var hwtime=xmlDoc.getElementsByTagName("hwtime")[0];
		var hwstarttime=hwtime.childNodes[0].childNodes[0].nodeValue;
		var hwdeadline=hwtime.childNodes[1].childNodes[0].nodeValue;
		var hw_files_length=xmlDoc.getElementsByTagName("files")[0].childNodes.length;
		console.log("hwname:"+hwname+" hwstarttime:"+hwstarttime+" hwdeadline:"+hwdeadline+"files_length:"+hw_files_length);
		//-----------------------------
		var hw_form=document.createElement("form");
		var hw_name_h=document.createElement("h4");
		var hw_name_text=document.createTextNode(hwname);
		hw_name_h.appendChild(hw_name_text);
		var hw_name_label=document.createElement("label");
		var hw_starttime_div=document.createElement("div");
		var hw_deadline_div=document.createElement("div");
		var hw_submit=document.createElement("input");
		//--------------------------------------
		var hw_class=document.createElement("input");
		var hw_id=document.createElement("input");
		var hw_files_num=document.createElement("input");
		var hr=document.createElement("hr");
		var hw_name_hid=document.createElement("input");

		hw_name_hid.id="hw_name_hid"+k;
		hw_name_hid.name="hw_name_hid";
		hw_name_hid.type="text";
		hw_name_hid.value=hwname;

		hw_class.id="hw_class";
		hw_class.name="hw_class";
		hw_class.value=stu_classid;
		hw_class.type="hidden";

		hw_id.id="hw_id"+k;
		hw_id.name="hw_id";
		hw_id.type="hidden";
		hw_id.value=filename_array[k].substring(0,filename_array[k].indexOf("."));
		console.log("hw_id:"+hw_id.value);

		hw_files_num.id="hw_files_num"+k;
		hw_files_num.name="hw_files_num";
		hw_files_num.type="hidden";
		hw_files_num.value=hw_files_length;

		
		hw_form.id="hw_form"+k;
		hw_form.action="../php/stu_uploadhw.php";
		hw_form.method="post";
		hw_form.enctype="multipart/form-data";
		
		hw_name_label.for=hw_form.id;
		hw_name_label.innerHTML=hwname;

		hw_starttime_div.id="hw_starttime_div"+k;
		hw_starttime_div.name="hw_starttime_div"+k;
		hw_starttime_div.innerHTML="Start time: "+hwstarttime;

		hw_deadline_div.id="hw_deadline_div"+k;
		hw_deadline_div.name="hw_deadline_div"+k;
		hw_deadline_div.innerHTML="Deadline: "+hwdeadline;

		hw_submit.type="submit";
		//hw_submit.type="button";
		hw_submit.id="hw_submit"+k;
		hw_submit.name="hw_submit"+k;
		hw_submit.value="Save";
		hw_submit.className="btn btn-success";
		
		//hw_form.appendChild(hw_name_label);
		hw_form.appendChild(hw_name_h);
		hw_form.appendChild(hw_starttime_div);
		hw_form.appendChild(hw_deadline_div);
		hw_form.appendChild(hw_class);
		hw_form.appendChild(hw_id);
		hw_form.appendChild(hw_files_num);
		hw_form.appendChild(hw_name_hid);
		
		for(var j=0;j<hw_files_length;j++){
			//-------------------------------
			var hw_file_div=document.createElement("div");
			var filetype_div=document.createElement("div");
			var filesize_div=document.createElement("div");
			var upload=document.createElement("input");

			var upload_a=document.createElement("a");
			upload_a.className="btn btn-primary btn-file";
			var upload_span=document.createElement("span");
			upload_span.className="fileupload-new";
			var upload_text_span=document.createTextNode("Choose file");
			upload_span.appendChild(upload_text_span);

			filetype_div.id=k+"filetype_div"+j;
			filetype_div.name=k+"filetype_div"+j;
			

			filesize_div.id=k+"filesize_div"+j;
			filesize_div.name=k+"filesize_div"+j;
			
			upload.type="file";
			upload.id=k+"upload"+j;
			console.log("createElement upload id: "+upload.id);
			//upload.name=k+"upload"+j;
			upload.name="upload"+j;
			upload.addEventListener("change",function(){
				checkFile(this.id);
			});

			hw_file_div.id=k+"hw_file_div"+j;
			//hw_file_div.innerHTML="file "+(j+1)+": ";
			var hw_file_id=document.createElement("h5");
			var hw_file_text=document.createTextNode("file "+(j+1)+": ");
			hw_file_id.appendChild(hw_file_text);

			hw_file_div.appendChild(hw_file_id);
			hw_file_div.appendChild(filetype_div);
			hw_file_div.appendChild(filesize_div);

			upload_a.appendChild(upload_span);
			upload_a.appendChild(upload);
			//hw_file_div.appendChild(upload);
			hw_file_div.appendChild(upload_a);

			hw_form.appendChild(hw_file_div);

			//--------GET XML VALUE----------
			var hw_curr_file;
			hw_curr_file=xmlDoc.getElementsByTagName("files")[0].childNodes[j];
			var hw_curr_filetype=hw_curr_file.childNodes[0].childNodes[0].nodeValue;
			console.log("filetype:"+hw_curr_filetype);

			var hw_curr_filesize=hw_curr_file.childNodes[1].childNodes[0].nodeValue;
			console.log("filesize:"+hw_curr_filesize);

			filetype_div.innerHTML="File type: "+hw_curr_filetype;
			filesize_div.innerHTML="Maximum Size: "+hw_curr_filesize+"KB";

			filesType[k][j]=hw_curr_filetype;
			filesSize[k][j]=hw_curr_filesize;
		}
		hw_form.appendChild(hw_submit);
		hw_form.appendChild(hr);
		hws.appendChild(hw_form);
	}

	
});