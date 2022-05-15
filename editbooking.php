<?php
include "checksession.php";
checkUser();
loginStatus(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waipukurau Pizzeria - Edit a booking</title>
    <!--CSS Stylesheet for datetime picker (flatpickr)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>
<body>

    <h1>Edit a booking</h1>
    <h2><a href="listbookings.html">[Return to the bookings listing]</a><a href="index.html">[Return to the main menu]</a></h2>
    <h2>Booking made for test</h2>
    <form>
        <!--Fields are not required as the customer may wish to only change one field-->
        <label for="editbookingdate">Booking date & time:</label>
        <input type="datetime-local" name="editbookingdate" id="editbookingdate"><br><br>
        <label for="telephone">Contact number:</label>
        <input type="tel" id="telephone" name="telephone" placeholder="###-###-####" maxlength="12" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"><br><br> 
        <label for="people">Party size (# people, 1-10)</label>
        <input type="number" id="people" name="people" min="1" max="10"><br><br>
        <input type="Submit" value="Update"> <!--Temporary submit button-->
        <a href="editbooking.html">[Cancel]</a>
    </form>

    <!--JavaScript for datetime picker (flatpickr)-->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        config = {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today" //Added min date of today to prevent user from booking previous date
        }
        flatpickr("input[type=datetime-local]", config);
    </script>
</body>
</html>