$(document).ready(function(){
    var email_student=document.getElementById("email_student");
    var span_student_email=document.getElementById("span_student_email");  //The warming. Defult:hidden

    var name_student=document.getElementById("name_student");
    var span_student_name=document.getElementById("span_student_name");  //The warming. Defult:hidden
 
    var pass_student=document.getElementById("pass_student");
    var span_student_password_length=document.getElementById("span_student_password_length");  //The warming. Defult:hidden
    var span_student_password_format=document.getElementById("span_student_password_format");  //The warming. Defult:hidden

    var pass_rp_student=document.getElementById("pass_rp_student");
    var span_student_password_rp=document.getElementById("span_student_password_rp");  //The warming. Defult:hidden

    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function validate() {
      span_student_email.hidden=true;
      var email = email_student.value;
      console.log(email);

      if (validateEmail(email)==false) {
        span_student_email.hidden=false;
      }
    }

    function name_validate(){
      span_student_name.hidden=true;
      var name=name_student.value;
      if(name==""){
        span_student_name.hidden=false;
      }
    }
    
    function pass_validate(){
      span_student_password_length.hidden=true;
      span_student_password_special.hidden=true;
      span_student_password_format.hidden=true;
      var password=pass_student.value;
      console.log(password);
      var reg=/^[A-Za-z0-9]+$/;  //Contains A-Z,a-z and 0-9
      var reg_number=/[0-9]/;
      var reg_small=/[a-z]/;
      var reg_big=/[A-Z]/;
      var number=reg_number.test(password);
      var small= reg_small.test(password);
      var big=reg_big.test(password);
      //var combine=number+small+big;

      if(password.length<=6 || password.length>10) {  //The password is required to have 6-10 characters
        span_student_password_length.hidden=false;
      }
      else if(reg.test(password)==false){
        span_student_password_special.hidden=false;  //The password can only be letters or numbers
      }
      else if((number+small)!=2 && (number+big)!=2){  //The password should contain two types of the upper-case letters, lower-case letters and the numbers.
        span_student_password_format.hidden=false;
      }
    }

    //Check whether the passord and the repeat password inputs are same
    function rp_pass_validate(){
      span_student_password_rp.hidden=true;
      rp_password=pass_rp_student.value;
      password=pass_student.value;
      if(password!=rp_password){
        span_student_password_rp.hidden=false;
      }
    }

    email_student.addEventListener("focusout",validate,false);

    name_student.addEventListener("focusout",name_validate,false);

    pass_student.addEventListener("focusout",pass_validate,false);
    
    pass_rp_student.addEventListener("focusout",rp_pass_validate,false);
});