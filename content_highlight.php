

<?php
 include_once('session.php');
 include_once('databaseconnection.php');


if(isset($_GET['id'])){
    $contentid = $_GET['id'];

  
   
    $sql = "SELECT * FROM content  WHERE newsid = $contentid";
    $qry = mysqli_query($con, $sql);

    if($qry) {

          
      
    
        $result = mysqli_fetch_assoc($qry);

        $trendsql = "UPDATE content SET extra = extra + 1 WHERE newsid = $contentid";
        $trendqry = mysqli_query($con, $trendsql);
    } else {
        echo 'Error retrieving content from the database.';
    }
    
} else {
    echo 'No ID parameter provided';
}
?>







<?php
    if(isset($_POST['cmt'])){
        $comment=$_POST['comment'];
        if($comment!=''){
            
                
                
                
                $Date=date(" Y M d ");
                $time=time();
                $user=$_SESSION['userid'];

                $commentsql="INSERT INTO comment(user_id,news_id,comments,date,time)VALUES('$user','$contentid','$comment','$Date',$time)";
                $commentquery=mysqli_query($con,$commentsql);

                if($commentquery){
                    $trendsql = "UPDATE content SET extra = extra +3  WHERE newsid = $contentid";
                    $trendqry = mysqli_query($con, $trendsql);
              
                   
                }
                else{
                    echo "Comment unsucess";
                }
            
            
                
            
                
        }
        else{
            echo "Enter comment";
        }
    
    }
    

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $result['title'];?></title>


    <link rel="stylesheet" a href="css/landingCss/master.css">
    <link rel="stylesheet" a href="css/landingCss/head.css">
    <link rel="stylesheet" a href="csss/landingCss/container.css">
    <link rel="stylesheet" a href="csss/landingCss/content.css">
    <link rel="stylesheet" a href="css/landingCss/dash_left.css">
    <link rel="stylesheet" a href="css/content_highlight.css">
    <link rel="stylesheet" a href="css/landingCss/Indexnew.css">


    <style>
        .textarea {
        height: 300px; /* Adjust the height as needed */
        resize: vertical; /* Allows vertical resizing */
}
    </style>
</head>
<body>
    <?php include_once('heading.php');?>
    
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
                    <h3 id="content"><?php echo $result['content'];?>"</h3>
                </div>
               
                <div class="headimg">
                    
                   <img src="Newsimage/<?php echo $result['imgsrc'];?>">
                   
                  
                </div>
                

                <form method="POST" name="commentform">
                    <div class="commentSection">
                        <div class="commentbox">
                        <textarea placeholder="Comment" class="inputs textarea" name="comment" required></textarea><br>
               
                        </div>
                        <div class="button">

                            <div class="like">
                                <a href="like.php">like</a>
                            </div>


                            <div class="commentbutton">
                                <button type="submit" name="cmt">Comment</button>
                            </div>

                          

                        </div>
                    </div>
                </form>




                <div class="comment_list">
                    <h1 style="fontsize:26px;">Comments</h1>
                    <div class="comment_list">

                        <?php
                            $cmtsql= "SELECT * FROM comment WHERE news_id = $contentid";
                            $commentQuery = mysqli_query($con,$cmtsql);
                            if (mysqli_num_rows($commentQuery) > 0) {
                                while ($commentResult = mysqli_fetch_assoc($commentQuery)) {
                                    $userId = $commentResult['user_id'];
                                    $userQuery = mysqli_query($con, "SELECT name FROM users WHERE id = $userId");
                                    $userResult = mysqli_fetch_assoc($userQuery);
                                    $comment = $commentResult['comments'];
                                    $time = $commentResult['time'];
                                    $formattedTime = date('Y-m-d H:i:s', $time);
                            ?>
                                    <div class="comment">
                                        <div class="cmtr_name"><p><?php echo $userResult['name']; ?></p></div>
                                        <div class="cmt"><p><?php echo $comment; ?></p></div>
                                        <div class="cmt_date"><p><?php echo $formattedTime; ?></p></div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "No comments found.";
                            }
                        ?>
                    </div>

                   
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

