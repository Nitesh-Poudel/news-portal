<?php
// SQL code to create the "users" table
$sqlCreateTable = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(20) NOT NULL,
    role VARCHAR(50) NOT NULL,
    password VARCHAR(150) NOT NULL,
    extra VARCHAR(255)
)";

// Execute the SQL code to create the table
include_once('databaseconnection.php');
mysqli_query($con, $sqlCreateTable) or die("Table creation failed: ");

$msg;
if (isset($_POST['submit'])) {
    $name = ucwords($_POST['fullname']);
    $email = $_POST['email'];
    $role = $_POST['user_type'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if ($name!='' && $email != '' && $role != '' && $password != '' && $cpassword != '') {
        if ($cpassword == $password) {
            $sql = "INSERT INTO users(name, email, role, password, extra)
                    VALUES('$name', '$email', '$role', '$password', '')";

            $qry = mysqli_query($con, $sql) or die("Data insert Error");
            if ($qry) {
               if($role=='content_creator'){
                header('location:createrRegistration.php');
               }
               if($role=='reader'){
                header('location:login.php');
               }
            } else {
                $msg = 'Something went wrong';
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
    <title>UserRegistration</title>
    <link rel="stylesheet"href="css/forms.css">
    <link rel="stylesheet"href="css/head.css">
</head>
<body>
    <div class="container">
    <div class="heading">
            <h1>Somthing.News</h1>
        </div>


        <div class="form">
            <form action="" name="myform" onsubmit="return validateForm()" method="post">
                <div class="title">Register</div>
                <input type="text" placeholder="Full name" class="inputs" name="fullname"  ><br>
                <input type="email" placeholder="email" class="inputs" name="email" ><br>
               
                <select name="user_type" class="inputs">
            <option value="" selected disabled id="nullvalue">Register yourself as...</option>
            <option value="content_creator">Content Creator</option>
            <option value="reader">Reader</option>
        </select><br>
                <input type="text" placeholder="Password" class="inputs" name="password" ><br>
                <input type="password" placeholder="Conform Password" class="inputs" name="cpassword" ><br>
                <div class="button_sanga">
                    <div class="button">  <button type="submit" name="submit" id="submit">Register</button></div>
                    <div class="link">Already have account? <a href="login.html">Login</a></a></div>

                </div>
                <div class="msg"><p id="error">  </p></div>

           
            </form>
            
        </div>
    </div>
    <script>
        /*function validateForm(){
            var name = document.forms['myform']["fullname"].value;
            var email = document.forms["myform"]["email"].value;
            var password = document.forms["myform"]["password"].value;
            var cpassword = document.forms["myform"]["cpassword"].value;
            
           if(name==""||email==""||password==""||cpassword==""){
                document.getElementById("error").innerHTML="Please enter every detail";
                alert("Please enter every detail");
                return false;
            }

            if(password!=cpassword){
                alert("Paswword not matched");
                return false;
           }

           if (/^[a-zA-Z]+$/.test(name)!=true) {
            alert("Name can content only alphabets");
            return true;
   
            }

            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)!=true){
                alert("Not a email");
            return false;
            }

            //Password validation need more then 4 character
            var pLength=password.length;
            if(pLength<=4){
                alert("password too short");
                return false;
            }
 
         
           
        }*/

    </script>
    
</body>
</html>