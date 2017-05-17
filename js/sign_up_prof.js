$(document).ready(function(){
    var email_teacher=document.getElementById("email_teacher");
    var pass_teacher=document.getElementById("pass_teacher");
    var pass_rp_teacher=document.getElementById("pass_rp_teacher");
    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function validate() {
      var vali_msg=document.getElementById("vali_msg");
      vali_msg.value="";
      var email = email_teacher.value;
      console.log(email);

      if (validateEmail(email)) {
        email_teacher.style.color="black";
      } else {
        email_teacher.value="Not valid";
        email_teacher.style.color="red";
      }
    }

    function color(){
      email_teacher.style.color="black";
    }
    
    email_teacher.addEventListener("focusout",validate,false);
    email_teacher.addEventListener("focusin",color,false);
});