$(document).ready(function(){
    var user_teacher=document.getElementById("user_teacher");
    var pass_teacher=document.getElementById("pass_teacher");
    
    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function validate() {
      var vali_msg=document.getElementById("vali_msg");
      vali_msg.value="";
      var email = user_teacher.value;
      console.log(email);

      if (validateEmail(email)) {
        user_teacher.style.color="black";
      } else {
        user_teacher.value="Not valid";
        user_teacher.style.color="red";
      }
    }

    function color(){
      user_teacher.style.color="black";
    }
    user_teacher.addEventListener("focusout",validate,false);
    user_teacher.addEventListener("focusin",color,false);
});