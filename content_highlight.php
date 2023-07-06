<?php
 include_once('databaseconnection.php');
session_start();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
   
    $sql = "SELECT * FROM content  WHERE newsid = $id";
    $qry = mysqli_query($con, $sql);

    if($qry) {
        $result = mysqli_fetch_assoc($qry);
    } else {
        echo 'Error retrieving content from the database.';
    }
    
} else {
    echo 'No ID parameter provided';
}
?>






/*comment posting*/
<?php
    if(isset($_POST['comment'])){
        $comment=$_POST['comment_text'];
        if($comment!=''){
            if($_SESSION['userid']){
                
                
                
                $Date=date(" Y M d ");
                $user=$_SESSION['userid'];

                $contentid=$result['content_id'];
                $commentsql="INSERT INTO comments(commenter_id,content_id,comments,date)VALUES('$user','$contentid','$comment','$Date')";
                $commentquery=mysqli_query($con,$commentsql);

                if($commentquery){
                    echo "Comment sucessful";
                }
                }
            }
            else{
                header('location:login.php');
            }
        }
    

?>


<?php/*


if(isset($_GET['id'])){
    $id = $_GET['id'];
    
   
    $sqlcmt = "SELECT * FROM comments  WHERE newsid = $id";
    $commentss = mysqli_query($con, $sqlcmt);

    if($commentss) {
        $comments = mysqli_fetch_assoc($commentss);
    } else {
        echo 'Error retrieving content from the database.';
    }
    
} else {
    echo 'No ID parameter provided';
}
*/?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $result['title'];?></title>


    <link rel="stylesheet" a href="css/landingCss/master.css">
    <link rel="stylesheet" a href="css/landingCss/head.css">
    <link rel="stylesheet" a href="css/landingCss/container.css">
    <link rel="stylesheet" a href="css/landingCss/content.css">
    <link rel="stylesheet" a href="css/landingCss/dash_left.css">
    <link rel="stylesheet" a href="css/content_highlight.css">
</head>
<body>
<div class="head">
        <div class="heading">
            <h1>Somthing.News  </h1>
            <div class="addpost"><a href="newsupload.php">Upload News</a></div>
        </div>
           <div class="dateTime">
                <div id="date"><h3></h3></div>
                <div id="slogan"><h3>Stay Ahead with Us</h3></div>
                <div id="time"><h3></h3></div>
           </div>
           <div class="border"></div>
    </div>
    <div class="container">
        <div class="left">

           
            

        </div>
        <div class="mid">
            <div class="lmid">
                
            </div>
            <div class="mmid">
                <div class="heading">
                    <h1><?php echo $result['title'];?></h1>
                    <p><?php echo $result['date'];?></p>
                </div>
               
                <div class="headimg">
                    
                    <p><img src="Newsimage/<?php echo $result['imgsrc'];?>"<p>
                   
                    
                    <p>
                        <?php 
                            echo $result['content'];
                        ?>
                    </p>
                </div>
                

                <form method="POST" name="commentform">
                    <div class="commentSection">
                        <div class="commentbox">
                            <input type="text" name="comment_text">
                        </div>
                        <div class="commentbutton">
                            <button type="submit" name="comment">Comment</button>
                        </div>
                    </div>
                </form>




                <div class="comment_list">
                    <h1 style="fontsize:26px;">Comments</h1>
                    <?php
                    if(mysqli_num_rows($comments) > 0){
                        while($data3 = mysqli_fetch_assoc($result)){
                            echo '
                                <p>'.$data2['name'].''.$data3['comment'].'.</p> 
                            ';
                        }
                    }
                ?>
                </div>
            </div>
        
            <div class="rmid">
                
            </div>

        </div>
        <div class="right">

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

