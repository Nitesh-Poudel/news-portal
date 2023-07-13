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
        $sql="Select * from content where category='$newscatagory' ORDER BY newsid DESC" ;
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

    <link rel="stylesheet" a href="css/landingCss/head.css">

    <link rel="stylesheet" a href="csss/landingCss/content.css">

    <link rel="stylesheet" a href="css/landingCss/Indexnew.css">
   
</head>
<body>
    <?php include_once('heading.php')?>


    
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
                    <option value="Politices">Politices</option>
                    <option value="Social Issue">Social Issue</option>
                    <option value="Business">Business</option>

                </select>
                
               
                        
                            <button type="submit" name="search">Search</button>
                        
                    </div>
                    
                
            </form>
            <div class="tranding-list">
            <h1>Tranding News</h1>

            <div class="tnews">
                <div class="t_img">
                    
                </div>
                <div class="tnews">
                    <?php
                          $tsql="Select title from content  ORDER BY extra DESC" ;
                          $tresult= mysqli_query($con,$tsql);
                          while($tdata=mysqli_fetch_assoc($tresult)){
                           
                            echo '<ul type="none">
                                <li>'.$tdata['title'].'</a><li><ul>
                            ';
                          }

                    ?>
                </div>
            </div>
            </div>
            
            
            

        </div>
        <div class="mid">
            
            <div class="mmid">
                <a href="<?php echo'content_highlight.php?id='.$data['newsid']?>">
                <div class="heading">
                    <h1><?php echo $data['title'];?></h1>
                    <p><?php echo $data['date'];?></p>
                </div>
                <div class  ="newscontent">
                    <h3>
                        <?php 
                            echo $data['content'];
                        ?>
                    </h3>
                
                <div class="headimg">
                    
                    <p><img src="Newsimage/<?php echo $data['imgsrc'];?>"<p>
                   
                    
                   
                </div></a>
                </div>


                <?php
                    if(mysqli_num_rows($result) > 0){
                        while($data2 = mysqli_fetch_assoc($result)){
                            echo '
                            <a href="content_highlight.php?id='.$data2['newsid'].'">
                                
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

