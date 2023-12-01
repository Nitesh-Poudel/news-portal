<?php
     include_once('session.php');
   
    $_SESSION['userid'];
   
    include_once ('databaseconnection.php');
    //create database
    $sqlCreateTable = "
CREATE TABLE IF NOT EXISTS content (
    newsid INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    content  VARCHAR(5000) NOT NULL,
    imgsrc VARCHAR(150) NOT NULL,
    createrid VARCHAR(255), NOT NULL,
    date VARCHAR(100), NOT NULL

)";


if(!$sqlCreateTable){
    echo "Can't create database";
}

else{

    //to 
    if(isset($_POST['upload'])){
            
            if(isset($_FILES['image'])){
                    $imgname=$_FILES['image']['name'];
                    $imgtemp=$_FILES['image']['tmp_name'];
                    $imgtype=$_FILES['image']['type'];
                
                    $extension=pathinfo($imgname, PATHINFO_EXTENSION);
                    $datee=date('Ymdhis');
                    
                    $replaced = str_replace(' ','a',$datee);
                    $newname='613'.'.'.$replaced.'.'.$extension;
                
                
                
                    $a=move_uploaded_file($imgtemp,"Newsimage/".$newname);
            }
          
          
          
          
            $title=$_POST['title'];
      
            $category=$_POST['category'];
            $content=$_POST['content'];
            $imgsrc=$newname;
            $authorid=$_SESSION['user'];


            $Date=date(" Y M d ");
          
          
            if($title!=''&&$Date!=''&&$authorid!=''&&$imgsrc!=''&&$category!=''){
                $sql = "INSERT INTO content(title, category, content, imgsrc, createrid, date)
                VALUES ('$title', '$category', '$content', '$newname', '".$_SESSION['userid']."', '$Date')";
        
              
                $qry=mysqli_query($con->getConnection(),$sql);
                if($qry){
                    header("landing.php");
                }
        
              
            }


    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload_Article<?php echo$_SESSION['userid'];?></title>
  
    <style>
       .heading{
        margin:0px;
        padding:0px;
       }
    </style>
    <link rel="stylesheet"a href="css/newsUpload.css">
    <link rel="stylesheet"a href="css/landingCss/head.css">
</head>

<body>
    <?php
        include_once('header.php');
    ?>
    <div class="container">
    
        <div class="form">
            <form name="myform" method="Post" enctype="multipart/form-data">
                <div class="title">Upload Your Article</div>
                <input type="text" placeholder="Title" class="inputs" name="title" id="title" required><br>
                <select class="inputs" name="category">
                    <option value="" disabled selected>Choose a Category</option>
                    <option value="Plolitics">Category 1</option>
                    <option value="Business">Business</option>
                    <option value="Sports">Sports </option>
                    <option value="Social Issue">Social Issue </option>
                    <option value="Politices">Politices </option>
                    <option value="Entertainment">Entertainment</option>
                    
                    <option value="Technology">Technology</option>
                    <option value="Health and science">Health and science</option>
               
                </select><br>
                <textarea placeholder="Content" class="inputs textarea" name="content" required></textarea><br>
                <input type="file" class="inputs" name="image" accept="image/*"><br>
                <div class="button_sanga">
                    <div class="button">
                        <button type="submit" name="upload" id="submit">Upload Post</button>
                    </div>
                   
                </div>
                 </form>
        </div>
    </div>
</body>
</html>
