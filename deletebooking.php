<?php
include "checksession.php";
checkUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waipukurau Pizzeria - Delete a booking</title>
</head>
<body>
    <!--Data for bookingdate, people, firstname, lastname is assumed from the assignment brief-->
    <h1>Booking preview before deletion</h1>
    <h2><a href="viewbooking.html">[Return to the Bookings listing]</a><a href="index.html">[Return to the main page]</a></h2>

    <form action="">
        <fieldset>
            <legend>Booking detail #1</legend><br>
            <label for="bookingdate">Booking date & time:</label>
            <p style="margin-left: 20px;">2021-12-18 17:29:36</p> 
            <label for="firstname, lastname">Customer name:</label>
            <p style="margin-left: 20px;">Admin, Admin</p>
            <label for="people">Party size:</label>
            <p style="margin-left: 20px;">2</p>
        </fieldset>
        <h2>Are you sure you want to delete this booking?</h2>
        <input type="submit" value="Delete">
        <a href="viewbooking.html">[Cancel]</a>
    </form>

</body>
</html>