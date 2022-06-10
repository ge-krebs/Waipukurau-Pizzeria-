<?php
//For debugging purposes, shows POST data, has been commented out as not in use
//echo "<pre>"; var_dump($_POST); echo "</pre>";
include "header.php";
include "menu.php";
include "checksession.php";

//For debugging purposes, shows array of session, has been commented out
//echo "<pre>"; var_dump($_SESSION); echo "</pre>";
 
//simple logout
if (isset($_POST['logout'])) logout();
 
if (isset($_POST['login']) and !empty($_POST['login']) and ($_POST['login'] == 'Login')) {
    include "config.php"; //load in any variables
    $DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE) or die();
 
//validate incoming data - only the first field is done for you in this example - rest is up to you to do
//firstname
    $error = 0; //clear our error flag
    $msg = 'Error: ';
    if (isset($_POST['email']) and !empty($_POST['email']) and is_string($_POST['email'])) {
       $un = htmlspecialchars(stripslashes(trim($_POST['email'])));  
       $username = (strlen($un)>32)?substr($un,1,32):$un; //check length and clip if too big       
    } else {
       $error++; //bump the error flag
       $msg .= 'Invalid email '; //append error message
       $username = '';  
    } 
                    
//password  - normally we avoid altering a password apart from whitespace on the ends   
    if (isset($_POST['password']) and !empty($_POST['password']) and is_string($_POST['password'])) {
        $password = trim($_POST['password']);    
    } else {
        $error++;
        $msg .= 'Invalid password ';
        $password = '';
    }        
       
//This should be done with prepared statements!!
    if ($error == 0) {
        $query = "SELECT customerID,password,role FROM customer WHERE email = '$username'";
        $result = mysqli_query($DBC,$query);     
        if (mysqli_num_rows($result) == 1) { //found the user
            $row = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            mysqli_close($DBC); //close the connection once done
  //this line would be added to the registermember.php to make a password hash before storing it
  //$hash = password_hash($password); 
  //this line would be used if our user password was stored as a hashed password
  //if (password_verify($password, $row['password'])) {           
    if ($password === $row['password']) //using plaintext for demonstration only!            
        login($row['customerID'],$username,$row['role']);
        } echo "<h2>Login fail</h2>".PHP_EOL;   
    } else { 
      echo "<h2>$msg</h2>".PHP_EOL;
    }      
}
?>
  <div id="body">
    <div class="header">
    <div>
      <h1>Login</h1>
    </div>
    </div>
    <div class="footer">
    <div class="article">
      <?php loginStatus(); ?>
      <form method="POST" action="login.php">
        <p>
          <label for="email">Email: </label>
          <input type="text" id="email" name="email" maxlength="32"> 
        </p> 
        <p>
          <label for="password">Password: </label>
          <input type="password" id="password" name="password" maxlength="32"> 
        </p> 
        
        <input type="submit" name="login" value="Login">
        <input type="submit" name="logout" value="Logout">   
      </form>
    </div>
    </div>
  </div>

<?php
include "footer.php";
?>