$(document).ready(function(){
    var user_student=document.getElementById("user_student");
    var span_student_email=document.getElementById("span_student_email");

    var pass_student=document.getElementById("pass_student");
    var span_student_password_null=document.getElementById("span_student_password_null");
    
    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function validate() {
      span_student_email.hidden=true;
      var email = user_student.value;
      console.log(email);

      if (validateEmail(email)==false) {
        span_student_email.hidden=false;
      }
    }

    function pass_validate(){
      span_student_password_null.hidden=true;
      var password=pass_student.value;
      if(password==""){
        span_student_password_null.hidden=false;
      }
    }

    user_student.addEventListener("focusout",validate,false);
    pass_student.addEventListener("focusout",pass_validate,false);
});