<?php 
session_start();
if(!isset($_SESSION['username'])){
 header("Location:index.php");}
 ?>
 <html lang = "en">

 <head>
    <title>You entered the castle</title>
    <link href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel = "stylesheet">
    <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
    <style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ADABAB;
         }
         .firstRow{
            background-color: yellow;
         }
         .regularRow{
            background-color: grey;

         }
         #theTextArea{
            width: 100%;
         }
         .postBtn{
            font-size: 25;
         }
         th, td {
            border: 1px solid black;
            overflow: hidden;
        }
}
    </style>
</head>
<body>
<div class="container">
    
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <h1><?php echo "Welcome ".($_SESSION['username']);?> </h1>
        </div>

        <div class="col-sm-2">
            <a onclick='logout()'>Log Out</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <table  class="table" id ="postsTable">
                <tbody>
                    <tr class="firstRow">
                        <th>Username</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th>Pic</th>
                        <?php if(isset($_SESSION['admin'])){echo "<th>magic</th>";} ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
   
<!--     <div class ="row">
        <div class="col-sm-8  col-sm-offset-2">
           <textarea id="theTextArea" rows="5"> </textarea>
       </div>
   </div> -->

   <div class ="row">
        <div class="col-sm-8  col-sm-offset-2">
            <form id="inputForm" method="post" enctype="multipart/form-data" role="form">
                <div class="form-group">
                    <label for="text">Message: </label>
                    <textarea id="theTextArea" name="post"  rows="4"> </textarea>
                </div>

                <div class="form-group">
                    <label for="text">Image: </label>
                    <input id ="picInput" name="image" type="file" />
                </div>

                <button type = "submit">Post</button>

            </form>
        </div>
    </div> 
    
<!--     <div class="row">
        <div class="col-sm-5  col-sm-offset-2 postBtn">
            <a onclick='post()'>Post</a>
        </div>
    </div> -->

</div>

</body>
</html>
</div>
<script>



$( document ).ready(function() {
    loadPosts();

    $("form#inputForm").submit(function(){
        console.log("inside submit trigger");
        post();
    });
});

function loadPosts(){
    $.ajax({
    type: "POST",
    url: "get_posts.php",
    data:"bla",
    success: function(data){

        var parsed = JSON.parse(data);
        var firstArray = parsed[0];
        for(var i=0;i<parsed.length;i++){
            theObject = parsed[i];
            var stringToBeAppended = '<tr class="regularRow"><td>'+theObject.username+' </td><td>'+theObject.date+' </td><td>'+theObject.post+'</td><td>';
          
            //if retrieved object has image also add the link
            if(theObject.fileName){
                var fileString = '<a href ="uploads/'+theObject.fileName+'">View File</td>';
                // stringToBeAppended.concat(fileString);
                stringToBeAppended += fileString;
            }
            else{
                var noFileString = 'No file</td>';
               // stringToBeAppended.concat(noFileString);
                stringToBeAppended += noFileString;

            }
             <?php if(isset($_SESSION['admin'])){
                echo "stringToBeAppended += '<td><a href=deletePost?id='+theObject.id+' >Delete</td>';";
              } ?>
            var closeRowString = '</tr>'
            // stringToBeAppended.concat(closeRowString);
            stringToBeAppended += closeRowString;

            // console.log("string: "+stringToBeAppended);
            $("#postsTable").find('tbody').append($(stringToBeAppended));
        }
   }
});
}

function post()
{


  var stringPost = $( "#theTextArea" ).val();

  //client side check of file extension
  var thePicture = $("#picInput").val();

  var picsplit = thePicture.split('.');

  // file extension
  var fromso = thePicture.split('.')[thePicture.split('.').length - 1].toLowerCase();

  //first client-side file extension check
  if (picsplit.length>1) {
    if (fromso!=='jpg'&&fromso!=='jpeg'&&fromso!=='png'&&fromso!=='gif'){
      alert('not an image, not posted');
      return;
    } 
  }

  //only post new post if message isn't null
  // alert (stringPost+". Length is "+ stringPost.length);
  if (stringPost.length > 5 && stringPost.length < 255) {
    //check if post is not only empty spaces
    if (stringPost.match(/[a-z]/i)) {

      //then get the all form
      var form = document.getElementById('inputForm');
      //create a FormData with all the values in the form
      var formData = new FormData (form);
     

      //TO DELETE -those fields can be modified- 
      // formData.append("ip", "<?php echo $_SERVER['REMOTE_ADDR']?>");
      // formData.append("username", "<?php echo($_SESSION['username']);?>");

      $.ajax({
        type: "POST",
        url: "save_post.php",
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false ,  // tell jQuery not to set contentType
        success: function(data){
          //loadPosts();
          alert("data is"+data);
        }
      }); 
    }
    else{
      alert("Write something!");
    }
  }
  else{
    alert("Write something!");
  }
}


function logout()
{
 $.ajax({
    type: "POST",
    url: "logout_users.php",
    data:"bla",
    success: function(data){
        if(data=="logged out"){
            window.location.href="index.php";
        }

        else{
            console.log("did not work");
       }       
   }
});
}

</script>
