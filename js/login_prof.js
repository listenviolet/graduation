$(document).ready(function(){
    var user_teacher=document.getElementById("user_teacher");
    var span_teacher_email=document.getElementById("span_teacher_email");

    var pass_teacher=document.getElementById("pass_teacher");
    var span_teacher_password_null=document.getElementById("span_teacher_password_null");
    
    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function validate() {
      span_teacher_email.hidden=true;
      var email = user_teacher.value;
      console.log(email);

      if (validateEmail(email)==false) {
        span_teacher_email.hidden=false;
      }
    }

    function pass_validate(){
      span_teacher_password_null.hidden=true;
      var password=pass_teacher.value;
      if(password==""){
        span_teacher_password_null.hidden=false;
      }
    }

    user_teacher.addEventListener("focusout",validate,false);
    pass_teacher.addEventListener("focusout",pass_validate,false);
});