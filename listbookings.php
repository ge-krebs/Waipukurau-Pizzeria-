<?php
include "header.php";
include "menu.php";
include "checksession.php";
checkUser();
?>

<style>
    table {
        font-family: 'Times New Roman', Times, serif;
    }
    td, th {
        border: 0.5px solid black;
    }
</style>

    <?php
    include "config.php"; //load in any variables
    $DBC = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE) or die();
    
    if (mysqli_connect_errno()) {
        echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
        exit;
    }
    
if (!isAdmin()) {
    $query = 'SELECT bookingID,customerID,telephone,bookingdate,people FROM booking WHERE customerID='.$_SESSION['userid'];
} else {
    $query = 'SELECT bookingID,customerID,telephone,bookingdate,people FROM booking';
}
$result = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($result); 
?>

    <!--Data for bookingdate, people, firstname, lastname, & telephone is assumed from the assignment brief-->
<div id="body">
    <div class="header">
        <div>      
        <h1>Current bookings</h1>
        </div>
    </div> 
    <div class="footer">
    <div class="article">
        <h2><a href="makebooking.php">[Make a booking]</a><a href="index.php">[Return to main page]</a></h2>
        
        <table><tr><th>Booking (date & time, people)</th><th>Customer(Telephone)</th><th>Action</th></tr>
        
        <?php
            if ($rowcount > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['bookingID'];
                    echo '<tr><td>'.$row['bookingdate'].' ('.$row['people'].')'.'</td><td>'.$row['telephone'].'</td>';
                    echo '<td><a href="viewbooking.php?id='.$id.'">[view]</a>';
                    echo '<a href="editbooking.php?id='.$id.'">[edit]</a>';
                    echo '<a href="deletebooking.php?id='.$id.'">[delete]</a></td>';
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
include "footer.php";
?>