$(document).ready(function(){
	
	var button=document.getElementById("check");
	var input_result=document.getElementById("input_result");
	var download=document.getElementById("download");
	function pageLoad(){
		button.addEventListener("click",function(){
			var check_input=document.getElementById("check_input");
			var code=check_input.value;
			checkCode(code);
		});
	}

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
						downloadHw(code,downloadlist);
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

	function downloadHw(code,downloadlist){
		$.ajax({
			type:"GET",
			data:{"download_list":downloadlist},
			url:"../php/collect_download.php",
			success:function(data){
				var flag_info=JSON.parse(data);
					//alert(flag_info[0].flag);
					if(flag_info[0].flag==1){alert("Download successfully.");}
					else if(flag_info[0].flag==0){alert("Fail to download.");}
			},
			error:function(){
				alert("Error ajax!");
			}
		});
	}

	pageLoad();
});