<?php
ob_start();
session_start();
ini_set("session.cookie_httponly", 1);
?>

<html lang = "en">

<head>
 <link href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel = "stylesheet">
 <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>

 <style>
 body {
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #ADABAB;
}

.form-signin {
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
    color: #017572;
}

.form-signin .form-signin-heading,
.form-signin .checkbox {
    margin-bottom: 10px;
}

.form-signin .checkbox {
    font-weight: normal;
}

.form-signin .form-control {
    position: relative;
    height: auto;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    padding: 10px;
    font-size: 16px;
}

.form-signin .form-control:focus {
    z-index: 2;
}

.form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    border-color:#017572;
}

.form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-color:#017572;
}

h2{
    text-align: center;
    color: #017572;
}
</style>
</head>

<body>

  <h2>Enter your credentials and start making millions today!</h2>


</body>

<div class = "container">

   <form id="signup" class = "form-signin" role = "form"
   action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
   ?>" method = "post">
   <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
   <input id="uname" type = "text" class = "form-control"
   name = "username" placeholder = "Enter your email address"
   required autofocus><br>
   <input id="pword" type = "password" class = "form-control"
   name = "password" placeholder = "Enter your password" required>
   <input id="rpword" type="password" class="form-control" placeholder="Re-enter your password">
   <button class = "btn btn-lg btn-primary btn-block" type = "submit"
   name = "login">Create</button>

</form>
</div>

<script>
$( document ).ready(function() {

   $("#signup").submit(
    //this function calls a php file that saves the register try in a text-file
   
/*    */

    function saveDB(e){
        writeLog();
       if($("#pword").val()==$("#rpword").val())
       {
        var email = $("#uname").val();
        //if it is an email
        if (validateForm(email)!=false)
        {
            //thanks
            if(validatePass($("#pword").val())!=false)
            {
                    
                  e.preventDefault();

                  var postData =
                  {
                      username : email,
                      password : $("#pword").val()    
                  };
                  $.ajax({
                    type: "POST",
                    url: "/save_user_info.php",
                    data: postData,
                    success: function(data)
                    {
                        if(data=="Message has been sent")
                        {
                          alert("Check your mailbox an activate your account in order to be able to earn millions");
                          window.location.href="/index.php";
                        }
                        else
                          if(data=="Message could not be sent.")
                             alert("There was a problem sending your verification e-mail. Try again later");
                          else
                            alert("Username already existing in the database, try something else");
                    }
                  });
              }

        }//if its not email
        else
        {
            alert("email field MUST contain a valid email address!");
        }
    }
    else
    {
        alert("The passwords you entered do not match. so sorry");
    }
    
});

   function validateForm(email) 
   {
     var x = email;
     var atpos = x.indexOf("@");
     var dotpos = x.lastIndexOf(".");
     if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length ) {
         return false;
     }
    }
    function validatePass(pass)
    {
        if(pass.length<6)
        {
         alert("Password has to be at least 6 characters");
          return false;
        }
        if(pass==$("#uname").val())
        {
          alert("Password cannot be the same as the username");
          return false;
        }
        var re = /[0-9]/;

        if(!re.test(pass))
        {
          alert("Password must contain at least one number (0-9)");
          return false;
        }

        re = /[a-z]/;
        if(!re.test(pass)) {
          alert("Password must contain at least one lowercase letter (a-z)");
          return false;
        }

        re = /[A-Z]/;
        if(!re.test(pass)) {
          alert("Password must contain at least one lowercase letter (A-Z)");
          return false;
        }

        return true;

    }

    function writeLog(){
        var successfull = "no";
        if($("#pword").val()==$("#rpword").val())
       {
            var email = $("#uname").val();
            if (validateForm(email)!=false && validatePass($("#pword").val())!=false)
            {   
                successfull = "yes";
           }
        }
         var logData =
            {
              username : email,
              password : $("#pword").val(),    
              secondPassword :$("#rpword").val(),
              success : successfull
          };
        $.ajax({
            type: "POST",
            url: "/log_register.php",
            data: logData,
            success: function(data){
                if(data=="ok"){
                    alert("your attempt was logged");
                }
             else
                 alert("error in logging function");
         }
        });
    }


});
</script>

