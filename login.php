
<?php 
    session_start();
    if(isset($_POST['login'])){

        include_once('databaseconnection.php');
        $email=$_POST["email"];
        $password=$_POST['password'];


        $encriptpw=md5($password);

        
        $sql="SELECT * from users WHERE email='$email'&& password='$encriptpw'";
        $msg;
        $qry=mysqli_query($con->getConnection(),$sql);
        if($qry){
           $data= mysqli_fetch_assoc($qry);
          

           
           if( isset($data)){
            $_SESSION['user']=$data['name'];
            $_SESSION['userid']=$data['id'];
               //header('Location:index.php');

               $cookie_name = "remember_me_cookie";
               $cookie_value = $_SESSION['userid'];
               $cookie_expiry = time() + (30 * 24 * 60 * 60); // 30 days from now
               setcookie($cookie_name, $cookie_value, $cookie_expiry);
   
               $msg='Login sucessful';
           }

           else{
                $msg='Phone and password not matched';
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
    <title>Login </title>
    
    <link rel="stylesheet" href="cssforms.css">
</head>
<style>
    #msg1{
        font-size:22px;
        color:red;
    }
</style>
<body>
    <div class="container">
        <div class="heading">
            <div class="logo">


            </div>
          
        </div>
        <div class="form">
            <form name="myform" onsubmit="return validateForm()" action="" method="Post"  >
                <div class="title">Login</div>
              
                <input type="text" placeholder="email" class="inputs" name="email" id="email"><br>
                <input type="password" placeholder="Password" class="inputs" name="password" id="password"><br>
            
                <div class="button_sanga">
                    <div class="button">  <button type="submit" name="login" id="submit">Login</button></div>
                    <div class="link">Don't have an Account? <a href="userregistration.php">Register</a></a></div>

                </div>
                <p id="msg1"><?php if(isset($msg)){echo $msg;} if(isset($data)) {echo $data['name'];}?></p>
                <p ><?php echo'sesson id ='.$_SESSION['userid']?>

            </form>
        </div>
    </div>


    <script>
        /*function validateForm(){
          
            var email = document.forms["myform"]["email"].value;
            var password = document.forms["myform"]["password"].value;
           
            
            
           if(email==""||password==""){
           
                alert("Please enter both email and password");
                return false;


              
           }


        }*/
               
    </script>
    
</body>
</html>