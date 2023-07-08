<?php
 include_once('databaseconnection.php');
session_start();
if(isset($_GET['id'])){
    $contentid = $_GET['id'];
    
   
    $sql = "SELECT * FROM content  WHERE newsid = $contentid";
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
                $time=time();
                $user=$_SESSION['userid'];;

                $commentsql="INSERT INTO comment(user_id,news_id,comments,date,time)VALUES('$user','$contentid','$comment','$Date',$time)";
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


    <style>
        .textarea {
        height: 300px; /* Adjust the height as needed */
        resize: vertical; /* Allows vertical resizing */
}
    </style>
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
                    
                   <img src="Newsimage/<?php echo $result['imgsrc'];?>"
                   
                    
                    <p>
                    <?php echo $result['content'];?>"
                   
                    </p>
                </div>
                

                <form method="POST" name="commentform">
                    <div class="commentSection">
                        <div class="commentbox">
                        <textarea placeholder="Content" class="inputs textarea" name="content" required></textarea><br>
               
                        </div>
                        <div class="commentbutton">
                            <button type="submit" name="comment">Comment</button>
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

