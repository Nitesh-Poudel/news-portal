<?PHP 

include_once('databaseconnection.php');

   
$task = isset($_SESSION['userid']) ?  "logout" :  "Login";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      .links{}
      .links a{color:purple}
    </style>
  </head>



<body>
  <div class="head">
    <div class="heading">
      <img src="icons\logo.png" >
    </div>

    <div class="dateTime">
      <div id="date"><h3></h3></div>
      <div id="time"><h3></h3></div>
    </div>


  </div>

  <div class="links">
    <div class="catagory">
       <b><a href="newscatagory.php?catagory=politices">Politices</a></b>
       <b><a href="newscatagory.php?catagory=socialissue">Social Issue</a></b>
       <b><a href="newscatagory.php?catagory=sports">Sports</a></b>
       <b><a href="newscatagory.php?catagory=business">Business</a></b>
      </div>

    <div class="advancelink">
        
      <?php 
       $userResult = null;
        $canPost=null;
       if (isset($_SESSION['userid'])) {
           $userId = $_SESSION['userid'];
           $userQuery = mysqli_query($con->getConnection(), "SELECT role FROM users WHERE id = $userId");
           $userResult = mysqli_fetch_assoc($userQuery);

           if ($userResult && $userResult['role'] == 'content_creator') {
            echo '<a href="newsupload.php">Upload News</a>';
        }
       }
        
      ?>


          
        <a href="<?php echo $task?>.php"><?php echo $task?></a>
        
      </div>
  </div>   
    
  <script>
        // Define the function to update the time
        function updateTime() {
            var now = new Date();
            var todaydate = document.getElementById("date");
            var nowtime = document.getElementById("time");

            todaydate.innerHTML = now.toDateString();
            nowtime.innerHTML = now.toLocaleTimeString();
        }

        // Call the updateTime() function every second
        setInterval(updateTime, 1000);
    </script>
</body>
</html>