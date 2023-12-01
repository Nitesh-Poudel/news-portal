

<?php
    session_start();
 include_once('databaseconnection.php');


if(isset($_GET['id'])){
    $contentid = $_GET['id'];
    $content_catagory='News';
  
   
    $sql = "SELECT * FROM content  WHERE newsid = $contentid";
    $qry = mysqli_query($con->getConnection(), $sql);

    if($qry) {

          
      
    
        $result = mysqli_fetch_assoc($qry);

        $trendsql = "UPDATE content SET extra = extra + 1 WHERE newsid = $contentid";
        $trendqry = mysqli_query($con->getConnection(), $trendsql);
    } else {
        echo 'Error retrieving content from the database.';
    }
    
} else {
    echo 'No ID parameter provided';
}
?>







<?php
    if(isset($_POST['comment'])){
        include_once('session.php');

        if(isset($_SESSION['userid'])){
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
    
    }}
    

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $result['title'];?></title>


    
    <link rel="stylesheet" a href="css/landingCss/head.css">
    <link rel="stylesheet" a href="css/landingCss/Indexnew.css">
    <link rel="stylesheet" a href="css/landingCss/content_highlight.php">
   
<style>
    body{height:auto}
    .content-container{box-shadow:5px 3px 18px 0px #000000;width:90%;display:flex;flex-direction:column;align-items:center;overflow:scroll;padding:0px;height:100vh;border-radius:10px}
    

    .newsarticle{width:90%;box-shadow:5px 3px 18px 0px #000000;margin-top:0px}
    .content-heading{width:100%;overflow:hidden; text-overflow: ellipsis;word-wrap: break-word;margin-top:75px}
    .content-heading{font-size:45px;height:auto;border-radius:8px;text-align:center}
    .content-image{width:100%;overflow:hidden;border:1px solid #aca8a8;;margin:20px 0px;display:flex;justify-content:center}
    .content-image img{width:50%;display:flex;justify-items:center;margin:10px;border-radius:5px}
    .content-news{margin:20px}


    .commentSection{width:100%;box-shadow:5px 3px 18px 0px #000000;height:100px;margin-top:80px;display:flex;flex-direction:column;juhstify-content:center;padding-top:30px;align-items:center;}
    .docomment{width:90%;height:100px;}
    form{margin:20px auto}
    #comment{width: 85%;
        padding: 10px 0px; 
        border: 1px solid #ccc; 
        border-radius: 5px; 
        margin-bottom: 10px; 
        font-size: 16px;
        outline: none; 
    }
    #cmtbutton{ padding: 10px 5px; }
    button{padding:0px 5px;}

    .seecomment{width:100%;height:500px;padding-top:50px;text-align:enter}
    .seecomment li{width:100%;padding-top:10px;}


    </style>
 
</head>
<body>
 
    
    <?php 
            include_once('header.php');
            include_once('left.php')
        ?>
           
        <div class="content-container">
                <div class="newsarticle">
                    <div class="content-heading"><b><?php echo$result['title']?><b></div>
                    <div class="content-image"><img src="Newsimage/<?php echo$result['imgsrc']?>" alt=""></div>
                    <div class="content-news"><p><?php echo$result['content']?><p/></div>
                    <div class="commentSection">
                        <div class="docomment">
                            <form action="POST">
                                <button type="submit" name="like">Like</button>
                                <label for="comment">Comment</label><br>
                                <input type="text" id="comment"name="comment">
                                <button type="submit" name="comment" id="cmtbutton">Comment</button>
                            </form>
                        </div>
                    </div>

                    <div class="seecomment">
                        <h1>COMMENTS</h1>
                        <ul type="none">
                        <?php
                            $contentid = $_GET['id'];
                            $seeqry=mysqli_query($con->getConnection(),"SELECT * from comment c JOIN users u ON c.user_id=u.id WHERE news_id=$contentid");

                            while($comments=mysqli_fetch_assoc($seeqry)){
                                echo
                                
                                '<li> <b>'.$comments['name'].'</b>'.$comments['comments'].'</li>';
                                   
                                  
                                
                            }
                                
                            
                        ?>
                      </ul>

                    </div>
                </div>




            </div>

                


            

        </div>       




               
            
        
       
        
    
                        
   

    
</body>
</html>

