$(document).ready(function(){
    var user_student=document.getElementById("user_student");
    var pass_student=document.getElementById("pass_student");
    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    function validate() {
      var vali_msg=document.getElementById("vali_msg");
      vali_msg.value="";
      var email = user_student.value;
      console.log(email);

      if (validateEmail(email)) {
        user_student.style.color="black";
      } else {
        user_student.value="Not valid";
        user_student.style.color="red";
      }
    }

    function color(){
      user_student.style.color="black";
    }

    user_student.addEventListener("focusout",validate,false);
    user_student.addEventListener("focusin",color,false);
});