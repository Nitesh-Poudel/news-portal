<div class="container">
        <div class="left">
            

            <div class="left_container">
                <form method="POST" name="search">
                    <div class="searchmenue">

                    <input type="text" placeholder="Search.." id="search" name="searchCatagory">



                    <button type="submit" name="search">Search</button>

           


                </form>

            </div>


            <div class="tranding-list">
                <?php
                 if(isset($_GET['catagory'])){

                    $catagory=$_GET['catagory'];
                    echo'<h1>'.$catagory.'</h1>';
                }
                else{
                    echo'<h1>Tranding News</h1>';
                }

                ?>

                <div class="tnws">
                    <div class="t_img">

                    </div>
                    <div class="tnews">
                        <?php
                        $tsql='';
                            if(isset($_GET['catagory'])){

                                $catagory=$_GET['catagory'];
                                $tsql="Select * from content  where category = '$catagory'" ;
                            }
                            else{
                              $tsql="Select * from content  ORDER BY extra DESC" ;
                            }
                              $tresult= mysqli_query($con->getConnection(),$tsql);
                              $count=0;
                              while($tdata=mysqli_fetch_assoc($tresult)){

                                if($count==5){
                                    break;
                                }
                                else{
                                    $count++;
                                    echo '<ul type="none">
                                    <li>
                                       <h3> <a href="content_highlight.php?id=' .$tdata['newsid'] . '&catagory='.$tdata['category'].'">' . $tdata['title'] . '</a></h3>
                                    </li>
                                    
                                </ul>';
                                }
                            
                               
                              }
                              ?>
                    
                    </div>
                </div>
        
            </div>
            
        </div>
            

    </div>