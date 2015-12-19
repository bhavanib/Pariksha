<?php
 
 
function SignIn() 
{ 
    session_start(); //starting the session for user profile page 
    //if(!empty($_POST['user']) AND !empty($row['pass'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text 
    //{ 
        if($_POST['user']=="a" AND $_POST['pass']=="abcd") 
        { 
            echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE..."; 
            header("Location: http://www.goobe.hostei.com/index.php");
        } 
        else 
        { 
            echo "SORRY... YOU ENTERED WRONG ID AND PASSWORD... PLEASE RETRY..."; 
        } 
    //} 
} 
 
 
if(isset($_POST['submit'])) 
{ 
    SignIn(); 
} 
 
 
?>