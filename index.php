<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Calculate</title>
</head>
<body>
    <div class="container">
        <h1>Calculate</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <div class="form-group py-2">
            <label for="InputVoltage">Voltage</label>
            <input type="number" class="form-control" name="InputVoltage" step="any">
            <small id="" class="form-text">Voltage (V)</small>
        </div>
        <div class="form-group py-2">
            <label for="InputCurrent">Current</label>
            <input type="number" class="form-control" name="InputCurrent" step="any">
            <small id="" class="form-text">Ampere (A)</small>
        </div>
        <div class="form-group py-2">
            <label for="InputCurrentRate">Current Rate</label>
            <input type="number" class="form-control" name="InputCurrentRate" step="any">
            <small id="" class="form-text">sen/kWh</small>
        </div>
        <button type="submit" class="btn btn-primary p-2">Calculate</button>
    </form>
    <?php

        function calculateRates($voltage, $current, $currentRate)
        {

            
            echo '<table class="table">';
            echo '<tr><th><b>#<th>Hour</th><th>Energy (kWh)</th><th>TOTAL (RM)</th></tr>';
            // Calculations
            
            for ($hours = 1; $hours<=24; $hours++) {
                $power = ($voltage * $current)/1000;
                $energy = ($power * $hours * 1000)/1000;
                $total = $energy * ($currentRate/100);

                echo '<tr>';
                echo '<td><b>' . $hours . '</b></td>';
                echo '<td>' . $hours . '</td>';
                echo '<td>' . number_format($energy,5) . '</td>';
                echo '<td>' . (round($total,2) . '</td>');
                echo '</tr>';
            }
            
            echo '<div class="card p-4 mt-4 border-primary mb-3 style="max-width: 18rem "><h2>Power =' . number_format($power,5);
            echo '<br><h2>Rate: ' . number_format($currentRate,2); '</div>';
            echo '</table>';
           
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get user input
            $voltage = $_POST['InputVoltage']; // in volts
            $current = $_POST['InputCurrent']; // in amperes
            $currentRate = $_POST['InputCurrentRate']; // rate in percentage

            // Call the function
            calculateRates($voltage, $current, $currentRate);
        }

        
        ?>
</body>
</html>