<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=", initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Order</title>
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
    <link rel="stylesheet" href="style.css"/> 
</head>
<body style="background-repeat:repeat;">
    <?php
        $numCoffee  = $_POST["numCoffee"];
        $numCream = $_POST["numCream"];
        $numSugar = $_POST["numSugar"];
        $size = $_POST["sizeOption"];
        $slang = $_POST["slang"];

        // If user has submitted form using slang, this'll overwrite any values in the form above
        if ($slang == 'reg')
            $numSugar = $numCream = 1;
        if ($slang == 'dd')
            $numCream = $numSugar = 2;
        if ($slang == 'tt')
            $numCream = $numSugar = 3;
        if ($slang == 'bl')
            $numCream = $numSugar = 0;
        if ($slang == 'bs') {
            $numCream = 0;
            $numSugar = 1;
        }
        if ($slang == 'bss') {
            $numCream = 0;
            $numSugar = 2;
        }
        if ($slang == 'bsss') {
            $numCream = 0;
            $numSugar = 3;
        }

        echo "<h1 style='color: white; font-family: Arial, Helvetica, sans-serif;'>Great! Here's your Final Order:</h1>";

        for ($i = 0; $i < $numCoffee; $i++) {

            echo "<div class='finalOrderBox'>";

            echo displayCup($size);
            manualOrder($numSugar, $numCream);

            echo "</div>";
        }
        echo "<h4 style='color: white; font-family: Arial, Helvetica, sans-serif;'>" . priceCalculator($size, $numCoffee) . "</h4>";

        /* Function to add sugar and cream visuals based on user input.  */
        function manualOrder($numSugar, $numCream) {
            if ($numSugar != 0) {
                echo "<img src='img/plus.jpg'/>";
                for ($j = 0; $j < $numSugar; $j++)
                    echo "<img src='img/sugar.jpg'/>";
            }
            if ($numCream != 0) {
                echo "<img src='img/plus.jpg'/>";
                for ($j = 0; $j < $numCream; $j++) {
                    echo "<img src='img/cream.jpg'/>";
                }
            }
        }

        /* Function to display cup depending on size the user has chosen */
        function displayCup($size) {
            if ($size == 's') {
                return "<img class='sCoffee' src='img/cup.jpg'/>"; 
            }
            else if ($size == 'm') {
                return "<img class='mCoffee' src='img/cup.jpg'/>";
            }
            else if ($size == 'l') {
                return "<img class='lCoffee' src='img/cup.jpg'/>";
            }
            else {
                return "<img class='xlCoffee' src='img/cup.jpg'/>";
            }
        }

        /* Function to calculate price, using 13% tax addon. Small coffee $2 with $.50 increments for 
           each size increase */
        function priceCalculator($size, $numCoffee) {
            $price = 0;
            if ($size == 's') {
                 $price = 2 * $numCoffee * 1.13;
                 return ("Total Price: " . $numCoffee . " coffee(s) x C$2.00 (incl. tax) = $" . number_format($price, 2));
            }
            if ($size == 'm') {
                $price = 2.5 * $numCoffee * 1.13;
                return ("Total Price: " . $numCoffee . " coffee(s) x C$2.50 (incl. tax) = $" . number_format($price, 2));
            }
            if ($size == 'l') {
                $price = 3 * $numCoffee * 1.13;
                return ("Total Price: " . $numCoffee . " coffee(s) x C$3.00 (incl. tax) = $" . number_format($price, 2));
            }
            if ($size == 'xl') {
                $price = 3.5 * $numCoffee * 1.13;
                return ("Total Price: " . $numCoffee . " coffee(s) x C$3.50 (incl. tax) = $" . number_format($price, 2));
            }
        }
    ?>
</body>
</html>