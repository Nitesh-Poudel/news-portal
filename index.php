<?php 
    session_start();
    include_once('databaseconnection.php');
   
   

    $sql='';$result='';$data='';
    $sql="Select * from content ORDER BY newsid DESC" ;
    $result= mysqli_query($con->getConnection(),$sql);
    $data= mysqli_fetch_assoc($result);


    if(isset($_POST['searchCatagory'])){
    $newscatagory=$_POST['searchCatagory'];
    if($newscatagory!=''){
        $sql="SELECT * FROM content
            WHERE title LIKE '%$newscatagory'"; 
            $result= mysqli_query($con->getConnection(),$sql);
        $data= mysqli_fetch_assoc($result);

            if(!$data){
                $data ="sry no search result found";
            }

    

    }

   
}
?>


   


<html>
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>version 1.1</title>

    <link rel="stylesheet" a href="css/landingCss/head.css">

   

    <link rel="stylesheet" a href="css/landingCss/Indexnew.css">
   
</head>
<body>
        <?php 
            include_once('header.php');
            include_once('left.php');
            
     
            ?>

        
    
          
        <div class="mid">
             
            <div class="mmid">
                <div class="mathiko">
                        <div class="heading">
                            <a href="<?php echo'content_highlight.php?id='.$data['newsid']?>
                            <h1><?php echo $data['title'];?></h1>
                            <p><?php echo $data['date'];?></p>
                        </div>
                        <div class  ="newscontent">
                            <h3>
                                <?php 
                                 
                                ?>
                            </h3>

                        <div class="headimg">

                            <p><img src="Newsimage/<?php echo $data['imgsrc'];?>"<p>



                        </div>
                </div>  

                
                


                <?php
                    if(mysqli_num_rows($result) > 0){
                        while($data2 = mysqli_fetch_assoc($result)){
                            echo '
                            <a href="content_highlight.php?catagory='.$data2['category'].'&id='.$data2['newsid'].'">
                                
                                <div class="topnews">
                                    <div class="topnewsimg">
                                        <img src="newsimage/'.$data2['imgsrc'].'">
                                    </div>
                            

                             
                                <div class="topnews_news">
                                    <div class="heading"><h5>'.$data2['title'].'</h5></div>
                                    <div class="shortly_news"><p>'.$data2['content'].'</p></div>
                                </div>
                            

                                </div>
                            </a>
                            ';
                        }
                    }
                ?>




    
                
            </div>
        
            

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

