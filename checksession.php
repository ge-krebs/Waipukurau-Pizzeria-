<?php
session_start();
 
//function to check if the user is logged else send to the login page 
function checkUser() {
    $_SESSION['URI'] = '';    
    if ($_SESSION['loggedin'] == 1)
       return TRUE;
    else {
       $_SESSION['URI'] = 'http://localhost'.$_SERVER['REQUEST_URI']; //save current url for redirect     
       header('Location: http://localhost/Waipukurau-Pizzeria-BIT608/login.php', true, 303);       
    }       
}
 
//just to show we are logged in
function loginStatus() {
    $un = $_SESSION['email']; //This line is causing error....
    if ($_SESSION['loggedin'] == 1)     
        echo "<h2>Logged in as $un</h2>";
    else
        echo "<h2>Logged out</h2>";            
}
 
//log a user in
function login($id,$email) {
   //simple redirect if a user tries to access a page they have not logged in to
   if ($_SESSION['loggedin'] == 0 and !empty($_SESSION['URI']))        
        $uri = $_SESSION['URI'];          
   else { 
     $_SESSION['URI'] =  'http://localhost/Waipukurau-Pizzeria-BIT608/index.php';         
     $uri = $_SESSION['URI'];           
   }  
   
   $_SESSION['loggedin'] = 1;        
   $_SESSION['userid'] = $id;   
   $_SESSION['email'] = $username; 
   $_SESSION['URI'] = ''; 
   header('Location: '.$uri, true, 303);        
}
 
//simple logout function
function logout(){
  $_SESSION['loggedin'] = 0;
  $_SESSION['userid'] = -1;        
  $_SESSION['email'] = '';
  $_SESSION['URI'] = '';
  header('Location: http://localhost/Waipukurau-Pizzeria-BIT608/login.php', true, 303);    
}
?>