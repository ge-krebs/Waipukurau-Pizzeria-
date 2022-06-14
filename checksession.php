<?php
session_start();

//overrides for development purposes only - comment this out when testing the login
// $_SESSION['loggedin'] = 0;     
// $_SESSION['userid'] = 1; //this is the ID for the admin user  
// $_SESSION['username'] = 'Test';
//end of overrides

function isAdmin() {
  if (($_SESSION['role'] == 1) and ($_SESSION['userid'] == 1)) 
      return TRUE;
  else 
      return FALSE;
 }
 
//function to check if the user is logged else send to the login page 
function checkUser() {
    $_SESSION['URI'] = '';    
    if ($_SESSION['loggedin'] == 1)
       return TRUE;
    else {
       $_SESSION['URI'] = 'http://sql210.unaux.com'.$_SERVER['REQUEST_URI']; //save current url for redirect     
       header('Location: http://waipukupizzeria.unaux.com/login.php', true, 303); //redirects user to login page if not logged in
    }       
}
 
//checks login status and shows user message
function loginStatus() {
    $un = $_SESSION['email'];
    if ($_SESSION['loggedin'] == 1)
        echo "<h1>Logged in as $un</h1>";
    else
        echo "<h1>Logged out</h1>";
        $_SESSION['email'] = '';         
}

function getCustomerID(){
checkUser();
return $_SESSION['userid'];
}
 
//log a user in
function login($id,$email,$role) {
   //Redirect user 
   if ($_SESSION['loggedin'] == 0 and !empty($_SESSION['URI']))        
        $uri = $_SESSION['URI'];          
   else { 
     $_SESSION['URI'] =  'http://waipukupizzeria.unaux.com/index.php'; //redirects user to index once logged in       
     $uri = $_SESSION['URI'];           
   }  
   
   $_SESSION['role'] = $role;
   $_SESSION['loggedin'] = 1;        
   $_SESSION['userid'] = $id;   
   $_SESSION['email'] = $email; 
   $_SESSION['URI'] = ''; 
   header('Location: '.$uri, true, 303);        
}
 
//Logout function
function logout(){
  $_SESSION['loggedin'] = 0;
  $_SESSION['userid'] = -1;        
  $_SESSION['email'] = '';
  $_SESSION['URI'] = '';
  header('Location: http://waipukupizzeria.unaux.com/login.php', true, 303);    
}
?>