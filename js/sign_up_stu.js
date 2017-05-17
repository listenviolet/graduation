$(document).ready(function(){
    var email_student=document.getElementById("email_student");
    //var pass_student=document.getElementById("pass_student");
    //var pass_rp_teacher=document.getElementById("pass_rp_teacher");
    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function validate() {
      var vali_msg=document.getElementById("vali_msg");
      vali_msg.value="";
      var email = email_student.value;
      console.log(email);

      if (validateEmail(email)) {
        email_student.style.color="black";
      } else {
        email_student.value="Not valid";
        email_student.style.color="red";
      }
    }

    function color(){
      email_student.style.color="black";
    }
    
    email_student.addEventListener("focusout",validate,false);
    email_student.addEventListener("focusin",color,false);
});