<?php
   ob_start();
   session_start();
   ini_set("session.cookie_httponly", 1);
?>

<html lang = "en">

   <head>
      <title>Welcome to the castle of the sugar daddies</title>
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
      <div class = "container form-signin">

         <?php
           /* $msg = '';

            if (isset($_POST['login']) && !empty($_POST['username'])
               && !empty($_POST['password'])) {

                  if(isset($_POST['idiot'])) {
                    if($_POST['idiot'] == 'idiotValue') {
                      header("Location:http://www.youareanidiot.org/");
                    }
                  }


               if ($_POST['username'] == 'vespa' &&
                  $_POST['password'] == '50') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'vespa';

                  echo 'You have entered valid use name and password';
               }else {
                  $msg = 'Wrong username or password';
               }
            }*/
         ?>
      </div> <!-- /container -->

      <div class = "container">

         <form id="signup" class = "form-signin" role = "form"
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input id="uname" type = "text" class = "form-control"
               name = "username" placeholder = ""
               required autofocus></br>
            <input id="pword" type = "password" class = "form-control"
               name = "password" placeholder = "" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit"
               name = "login">Login</button>
            <!-- <input type="checkbox" name="idiot" value="idiotValue">Check to login with your Facebook Account -->
            <br>
            <a href="/register.php">Create new user</a>
         </form>



      </div>

      <script>

            
         $( document ).ready(function() {

         $("#signup").submit(
            function saveDB(e){
               e.preventDefault();
               var postData =
               {
                  username : $("#uname").val(),
                  password : $("#pword").val(),
                  
               };
        /* var posting = $.post("/save_user_info.php", postData); */

         $.ajax({
                type: "POST",
                url: "/get_user_data.php",
                data: postData,
                success: function(data){
                    if(data=="yass")
                        window.location.href="/main.php";
                    else
                     alert(data);
                }
            });
      
         
      }

      );
   /* */

});

      </script>

      
   </body>
</html>
