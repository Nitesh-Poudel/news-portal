<?php
    include_once('databaseconnection.php');
    if($con){

        $con->insert('users',['name'=>'Saroj','email'=>'saroj@yahoo.com','role'=>'reader','password'=>'asdfghjkl']);
        echo'connected';

    }
    else{
        echo'not_connected';
    }
?>