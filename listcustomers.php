<?php
include "checksession.php";
include "header.php";
include "menu.php";
checkUser();
?>
<script>

function searchResult(searchstr) {
  if (searchstr.length==0) {

    return;
  }
  xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    //take JSON text from the server and convert it to JavaScript objects
    //mbrs will become a two dimensional array of our customers much like 
    //a PHP associative array
      var mbrs = JSON.parse(this.responseText);              
      var tbl = document.getElementById("tblcustomers"); //find the table in the HTML
      
      //clear any existing rows from any previous searches
      //if this is not cleared rows will just keep being added
      var rowCount = tbl.rows.length;
      for (var i = 1; i < rowCount; i++) {
         //delete from the top - row 0 is the table header we keep
         tbl.deleteRow(1); 
      }      
      
      //populate the table
      //mbrs.length is the size of our array
      for (var i = 0; i < mbrs.length; i++) {
         var mbrid = mbrs[i]['customerID'];
         var fn    = mbrs[i]['firstname'];
         var ln    = mbrs[i]['lastname'];
      
         //concatenate our actions urls into a single string
         var urls  = '<a href="viewcustomer.php?id='+mbrid+'">[view]</a>';
             urls += '<a href="editcustomer.php?id='+mbrid+'">[edit]</a>';
             urls += '<a href="deletecustomer.php?id='+mbrid+'">[delete]</a>';
         
         //create a table row with three cells  
         tr = tbl.insertRow(-1);
         var tabCell = tr.insertCell(-1);
             tabCell.innerHTML = ln; //lastname
         var tabCell = tr.insertCell(-1);
             tabCell.innerHTML = fn; //firstname      
         var tabCell = tr.insertCell(-1);
             tabCell.innerHTML = urls; //action URLS            
        }
    }
  }
  //call our php file that will look for a customer or customers matchign the seachstring
  xmlhttp.open("GET","customersearch.php?sq="+searchstr,true);
  xmlhttp.send();
}
</script>


<?php
include "config.php"; //load in any variables
$DBC = mysqli_connect("127.0.0.1", DBUSER, DBPASSWORD, DBDATABASE);
 
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit;
}


if (!isAdmin()) {
  $query = 'SELECT customerID,firstname,lastname,email FROM customer WHERE customerID='.$_SESSION['userid'];
} else {
  $query = 'SELECT customerID,firstname,lastname FROM customer ORDER BY lastname';  
}

$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result); 
?>

<div id="body">
  <div class="header">
    <div>
    <h1>Customer List</h1>
    </div>
  </div>
  <div class="footer">
  <div class="article">
    <h2><a href='addcustomer.php'>[Create new Customer]</a><a href="index.php">[Return to main page]</a></h2>
    <form>
      <label for="lastname">Lastname: </label>
      <input id="lastname" type="text" size="30" 
            onkeyup="searchResult(this.value)" 
            onclick="javascript: this.value = ''" 
            placeholder="Start typing a last name">

    </form>
    <table id="tblcustomers" border="1">
    <thead><tr><th>Lastname</th><th>Firstname</th><th>actions</th></tr></thead>
    <?php
    //check if data available and loop through each customer. displays results in table.
    if ($rowcount > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['customerID'];
        echo '<tr><td>'.$row['firstname'].'</td><td>'.$row['lastname'].'</td>';
        echo '<td><a href="viewcustomer.php?id='.$id.'">[view]</a>';
        echo '<a href="editcustomer.php?id='.$id.'">[edit]</a>';
        echo '<a href="deletecustomer.php?id='.$id.'">[delete]</a></td>';
        echo '</tr>'.PHP_EOL;
      }
    }
    mysqli_free_result($result); 
    mysqli_close($DBC);
    ?>
    </table>
    </div>
    </div>
</div>
<?php
//----------- page content ends here
include "footer.php";
?>