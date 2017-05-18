$(document).ready(function(){
    var email_teacher=document.getElementById("email_teacher");
    var span_teacher_email=document.getElementById("span_teacher_email");

    var name_teacher=document.getElementById("name_teacher");
    var span_teacher_name=document.getElementById("span_teacher_name");

    var pass_teacher=document.getElementById("pass_teacher");
    var span_teacher_password_length=document.getElementById("span_teacher_password_length");
    var span_teacher_password_format=document.getElementById("span_teacher_password_format");

    var pass_rp_teacher=document.getElementById("pass_rp_teacher");
    var span_teacher_password_rp=document.getElementById("span_teacher_password_rp");

    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function validate() {
      span_teacher_email.hidden=true;
      var email = email_teacher.value;
      console.log(email);

      if (validateEmail(email)==false) {
        span_teacher_email.hidden=false;
      }
    }

    function name_validate(){
      span_teacher_name.hidden=true;
      var name=name_teacher.value;
      if(name==""){
        span_teacher_name.hidden=false;
      }
    }
    
    function pass_validate(){
      span_teacher_password_length.hidden=true;
      span_teacher_password_special.hidden=true;
      span_teacher_password_format.hidden=true;
      var password=pass_teacher.value;
      console.log(password);
      var reg=/^[A-Za-z0-9]+$/;
      var reg_number=/[0-9]/;
      var reg_small=/[a-z]/;
      var reg_big=/[A-Z]/;
      var number=reg_number.test(password);
      var small= reg_small.test(password);
      var big=reg_big.test(password);
      //var combine=number+small+big;

      if(password.length<6 || password.length>10) {
        span_teacher_password_length.hidden=false;
      }
      else if(reg.test(password)==false){
        span_teacher_password_special.hidden=false;
      }
      else if((number+small)!=2 && (number+big)!=2){
        span_teacher_password_format.hidden=false;
      }
    }

    function rp_pass_validate(){
      span_teacher_password_rp.hidden=true;
      rp_password=pass_rp_teacher.value;
      password=pass_teacher.value;
      if(password!=rp_password){
        span_teacher_password_rp.hidden=false;
      }
    }

    email_teacher.addEventListener("focusout",validate,false);

    name_teacher.addEventListener("focusout",name_validate,false);

    pass_teacher.addEventListener("focusout",pass_validate,false);
    
    pass_rp_teacher.addEventListener("focusout",rp_pass_validate,false);
});