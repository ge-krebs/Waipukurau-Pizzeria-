<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waipukurau Pizzeria - Cancel an order</title>
</head>
<body>
    
    <h1>Order preview before deletion</h1>
    <h2><a href="listorders.html">[Return to orders listing</a><a href="index.html">[Return to the main page]</a></h2>
    <form action="">
        <fieldset>
            <legend>Pizza order detail for order #9</legend>
            <label for="ordertime">Date & time ordered for:</label>
            <p style="margin-left: 20px;">2021-02-13 07:10:15</p>
            <label for="fullname">Customer name:</label> <!--check label name-->
            <p style="margin-left: 20px;">Sellers, Beverlly</p>
            <label for="extras">Extras:</label>
            <p style="margin-left: 20px;">Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
            <label for="pizza">Pizzas:</label> <!--check label name-->
            <p style="margin-left: 20px;">Pizza 9 x 1.</p>
        </fieldset>
        </form> 
        <h2>Are you sure you want to delete this order?</h2>
        <form action="">
            <input type="submit" label="Delete" name="deleteorder" id="deleteorder"><!--check label name-->
            <a href="listorders.html">[Cancel]</a>
        </form>
</body>
</html>