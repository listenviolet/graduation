$(document).ready(function(){	
	var button=document.getElementById("check");                 //button
	var input_result=document.getElementById("input_result");    //the value of this input element shows whether the homework exists or not
	var download=document.getElementById("download");            //submit button
	var download_list=document.getElementById("download_list");  //to submit the download paths to php

	function pageLoad(){
		button.addEventListener("click",function(){
			var check_input=document.getElementById("check_input");
			var code=check_input.value;
			checkCode(code);
		});
	}

	//Check whether the homework exists or not and show the result
	//If exists, push the homework path to downloadlist array
	function checkCode(code){
		$.ajax({
			type:"GET",
			data:{"code":code},
			url:"../php/check.php",
			success:function(data){
				var check_hw;
				var downloadlist = [];
				check_hw=JSON.parse(data);
				var check_result=check_hw[0].flag;
				var email=check_hw[0].student_email;
				var hw_path=check_hw[0].hw_path;
				if(check_result==1){
					input_result.value=email+" homework exists";
					$("#download").prop("disabled",false);
					$("#download").click(function(){
						downloadlist.push(hw_path);
						downloadHw(downloadlist);
					});
				}
				else if(check_result==0){
					input_result.value="Not Exists";
				}
				
			},
			error:function(){
				alert("Error ajax!");
			}
		});
	}

	function downloadHw(downloadlist){
		download_list.value=downloadlist;
	}

	pageLoad();
});