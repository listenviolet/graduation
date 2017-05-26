$(document).ready(function(){
    var email_teacher=document.getElementById("email_teacher");
    var span_teacher_email=document.getElementById("span_teacher_email"); //The warming. Defult:hidden

    var name_teacher=document.getElementById("name_teacher");
    var span_teacher_name=document.getElementById("span_teacher_name");  //The warming. Defult:hidden

    var pass_teacher=document.getElementById("pass_teacher");
    var span_teacher_password_length=document.getElementById("span_teacher_password_length"); //The warming. Defult:hidden
    var span_teacher_password_format=document.getElementById("span_teacher_password_format"); //The warming. Defult:hidden

    var pass_rp_teacher=document.getElementById("pass_rp_teacher");
    var span_teacher_password_rp=document.getElementById("span_teacher_password_rp");  //The warming. Defult:hidden

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
      var reg=/^[A-Za-z0-9]+$/;  //Contains A-Z,a-z and 0-9
      var reg_number=/[0-9]/;
      var reg_small=/[a-z]/;
      var reg_big=/[A-Z]/;
      var number=reg_number.test(password);
      var small= reg_small.test(password);
      var big=reg_big.test(password);

      if(password.length<=6 || password.length>10) {  //The password is required to have 6-10 characters
        span_teacher_password_length.hidden=false;
      }
      else if(reg.test(password)==false){             //The password can only be letters or numbers
        span_teacher_password_special.hidden=false;
      }
      else if((number+small)!=2 && (number+big)!=2){  //The password should contain two types of the upper-case letters, lower-case letters and the numbers.
        span_teacher_password_format.hidden=false;
      }
    }

    //Check whether the passord and the repeat password inputs are same
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