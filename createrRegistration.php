<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creater Registration</title>
    <link rel="stylesheet"href="css/forms.css">
    <style>
        label{
            color:grey;
        }
        .form .input{
          
    border:none;
    outline:none;
    
    width:300px;
    border-radius: 4px;
    font-size:14px;
    margin-block:8px;
        }
    </style>
</head>
<body>
    <div class="container">
       
        <div class="form">

            <form action="" name="myform" onsubmit="return validateForm)" method="post" enctype="multipart/form-data">
                <div class="title">Additional Information</div>


                <table>
                    <tr>
                        <td><label for="pp">Passport Size Photo<label></td>
                        <td><input type="file"accept=".jpg,.jpge" placeholder="Date of Birth" class="inputs" id="pp" name="dob"  required><br></td>
                    </tr>

                    <tr>
                        <td><label for="dob">Date of Birth:</label></td>
                        <td>  <input type="date" id="dob" placeholder="Date of Birth" class="inputs" name="dob"  required></td>
                    </tr>
                         
                   
                    
                    <tr>                     
                        <td><label for="taddress">Temprory Adderess: </label></td>
                        <td> <input type="text" id="taddress" placeholder="Temprory Address" class="inputs" name="taddress" required></td>
                    </tr>

                    <tr>

                        <td><label for="paddress">Permanent Adderess: </label></td>
                        <td><input type="text" id="paddress" placeholder="Permanent Address" class="inputs" name="taddress" required></td>
               
                    </tr>
                    <tr rowspan="2">
                        <td>
                            <select name="education" class="inputs">
                                <option value="" selected disabled id="nullvalue">Academic Qualification</option>
                                <option value="SEE/SLC">SEE/SLC</option>
                                <option value="10+2">10+2</option>
                                <option value="Bachlor">Bachlor</option>
                                <option value="masters">Masters</option>
                                <option value="PHD">PHD</option>
                            </select>
                        </td>      
                    </tr> 
                    
                    <tr>
                        <td><label for="cship">Citizenship<label></td>
                        <td>    <input type="file"accept=".jpg,.jpge" id="cship" class="inputs" name="citizenship"  required></td>
                
                    </tr>


                    <tr>
                        <td><label for="ectfikat">Educational Certificate<label></td>
                        <td>    <input type="file" id="ectfikat" accept=".jpg,.jpge"  class="inputs" name="certificate"  required></td>
                    </tr>


                    <tr>
                        <td><label for="cv">Educational Certificate<label></td>
                        <td>    <input type="file" id="cv" accept=".docs,.pdf"  class="inputs" name="cv"  required></td>
                    </tr>



                    

                </table>
                <div class="button_sanga">


                    <div class="button">  <button type="submit" name="submit" id="submit">Register</button></div>
                    <div class="link">Already have account? <a href="login.html">Login</a></a></div>

                </div>
                <div class="msg"><p id="error">  </p></div>

           
            </form>
        </div>
    </div>
    <script>
        function validateForm(){
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
 
         
           
        }

    </script>
    
</body>
</html>