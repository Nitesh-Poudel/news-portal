<?php
    session_start();
    $button='';
    include_once('databaseconnection.php');
    //if(isset($_POST['post'])){
        $sqlpost="SELECT * FROM Users u JOIN  content c ON u.id=c.createrid ORDER BY newsid DESC";


        $qrypost=mysqli_query($con, $sqlpost);
        $title='Title';
        $category='Catagory';
        $date='Date';
        $author='Author';
        $edit='Edit';
        $delete='Delete';
        $sn=1
        

    //}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Control</title>
    <link rel="stylesheet" a href="css/landingCss/head.css">
    <link rel="stylesheet" a href="css/adminpannel.css">
    <style>
        #sn{
            font-size:20px;
            
        }
    </style>
</head>
<body>
    <?php
        include_once('heading.php');
    ?>
    <div class="navbar">
        <form method="POST">
            <button type="submit" name="post" id="btn">Post</button>
            <button type="submit" name="Catagory " id="btn">Catagory</button>
            <button type="submit" name="user" id="btn">User</button>
        </form>
    </div>

    <div class="container">
       
        <div class="table">
        <div class="msg"><h1>Welcome to Admin Pannel</h1></div>
            <table>
            <?php
                echo '
                    <tr id="topic">
                    
                        <th>SN</th>
                        <th>'.$title.'</th>
                        <th>'.$category.'</th>
                        <th>'.$author.'</th>
                        <th>'.$date.'</th>
                        <th >'.$edit.'</th>
                        <th >'.$delete.'</th>
                    </tr>';

                if(mysqli_num_rows($qrypost) > 0) {
                    while($data = mysqli_fetch_assoc($qrypost)) {
                        echo '
                            
                            <tr>
                            <a href="content_highlight.php?id='.$data['newsid'].'">
                                <td id="sn">'.$sn++.'</td>
                                <td>'.$data['title'].'</td>
                                <td>'.$data['category'].'</td>
                                <td>'.$data['name'].'</td>
                                <td>'.$data['date'].'</td>
                                <td id="edit">'.$edit.'</td>
                                <td id="delete">'.$delete.'</td>
                            </a></tr>';
                    }
                }
            ?>
                <a href="content_highlight.php?id='.$data['newsid']">helki</a>
            </table>
        </div>

    </div>
    
</body>
</html>