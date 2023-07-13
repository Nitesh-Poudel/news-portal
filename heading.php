<?PHP 

include_once('databaseconnection.php');

   
$task = isset($_SESSION['userid']) ? 'logout' : 'login';

?>
<!DOCTYPE html>
<html lang="en">

<body>
<div class="head">
        <div class="heading">
              <h1><b>f</b>
             
            <font color="red">.</font> 
            <font family="times new roman"><span>कान्छिपुर<span></font>   
            </h1>
           
        </div>

        <div class="dateTime">
          <div id="date"><h3></h3></div>
          <div id="time"><h3></h3></div>
          
        </div>
      
    </div>

    <div class="links">
      <div class="simplelink">
        <a  href="index.php">Home</a>
        <a  href="#">About us</a>
        <a  href="#">Contact us</a>
      </div>
       
      <div class="advancelink">
        
        <?php 
         $userResult = null;
          $canPost=null;
         if (isset($_SESSION['userid'])) {
             $userId = $_SESSION['userid'];
             $userQuery = mysqli_query($con, "SELECT role FROM users WHERE id = $userId");
             $userResult = mysqli_fetch_assoc($userQuery);


             if ($userResult && $userResult['role'] == 'content_creator') {
              echo '<a href="newsupload.php">Upload News</a>';
          }
         }
        
        ?>


          
          <a href="<?php echo $task?>.php"><?php echo $task?></a>
        
        </div>
          
         
        
      
    </div>   
    
  
</body>
</html>