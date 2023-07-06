<?php 
    session_start();
    include_once('databaseconnection.php');
    

    $sql='';$result='';$data='';
    $sql="Select * from content ORDER BY newsid DESC" ;
    $result= mysqli_query($con,$sql);
    $data= mysqli_fetch_assoc($result);


    if(isset($_POST['search'])){
    $newscatagory=$_POST['searchCatagory'];
    if($newscatagory!=''){
        $sql="Select * from content where category='$newscatagory' ORDER BY content_id DESC" ;
        $result= mysqli_query($con,$sql);
        $data= mysqli_fetch_assoc($result);
    

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
    <link rel="stylesheet" a href="css/landingCss/master.css">
    <link rel="stylesheet" a href="css/landingCss/head.css">
    <link rel="stylesheet" a href="css/landingCss/container.css">
    <link rel="stylesheet" a href="css/landingCss/content.css">
    <link rel="stylesheet" a href="css/landingCss/dash_left.css">
    <link rel="stylesheet" a href="css/landingCss/topnews.css">
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

            <form method="POST" name="search">
                <div class="searchmenue">

                <select name="searchCatagory" id="searchCatagory">
                    <option value="">Search.........</option>
                    <option value="Technology">Technology</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Health">Health</option>
                   
                    <option value="International">International</option>
                    <option value="Sports">Sports</option>
                    
                    <option value="Business">Business</option>

                </select>
                
               
                        
                            <button type="submit" name="search">Search</button>
                        
                    </div>
                    
                
            </form>
            

        </div>
        <div class="mid">
            <div class="lmid">
                
            </div>
            <div class="mmid">
                <a href="<?php echo'content_hightlight.php?id='.$data2['content_id']?>"><div class="heading">
                    <h1><?php echo $data['title'];?></h1>
                    <p><?php echo $data['date'];?></p>
                </div>
               
                <div class="headimg">
                    
                    <p><img src="Newsimage/<?php echo $data['imgsrc'];?>"<p>
                   
                    
                    <p>
                        <?php 
                            echo $data['content'];
                        ?>
                    </p>
                </div></a>



                <?php
                    if(mysqli_num_rows($result) > 0){
                        while($data2 = mysqli_fetch_assoc($result)){
                            echo '
                                <a href="content_highlight.php?id='.$data2['newsid'].'"><div class="topnews">
                                    <div class="topnewsimg">
                                    <img src="newsimage/'.$data2['imgsrc'].'">
                                </div>
                            </a>

                                <a href="content_highlight.php?id='.$data2['newsid'].'"><div class="topnews_news">
                                    <div class="heading"><h5>'.$data2['title'].'</h5></div>
                                    <div class="shortly_news">'.$data2['content'].'</div>
                                </div></a>

                            </div>
                            ';
                        }
                    }
                ?>




    
                
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

