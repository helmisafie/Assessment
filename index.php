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

        function calculatePower($voltage, $current)
        {
            $power = $voltage * $current * 0.001; 
            return $power;
        }

        function calculateEnergy($power, $hour)
        {
            $energy = $power * $hour;
            return $energy;
        }

        function calculateTotalCharge($energy, $currentRate)
        {
            $totalCharge = $energy * ($currentRate / 100);
            return $totalCharge;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $voltage = $_POST['InputVoltage']; 
            $current = $_POST['InputCurrent']; 
            $currentRate = $_POST['InputCurrentRate']; 

            $hour = 1; 
            $totalHours = 24; 

            if (is_numeric($voltage) && is_numeric($current) && is_numeric($currentRate)) {
                $power = calculatePower($voltage, $current);
                $rate = $currentRate * 0.01; 

                echo "<br>Power: " . number_format($power, 5) . " kW";
                echo "<br>Rate: " . number_format($rate, 3) . " RM";

                echo "<table class='table'>";
                echo "<thead>";
                echo "<tr><th>#</th><th>Hour</th><th>Energy (kWh)</th><th>Total Charge (RM)</th></tr>";
                echo "</thead>";
                echo "<tbody>";

                for ($i = 1; $i <= $totalHours; $i++) {
                    $energy = calculateEnergy($power, $i);
                    $totalCharge = calculateTotalCharge($energy, $currentRate);

                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$i</td>";
                    echo "<td>" . number_format($energy, 5) . "</td>";
                    echo "<td>" . number_format($totalCharge, 2) . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "Invalid input. Please enter numeric values.";
            }
        }
        ?>
    </div>
</body>
</html>
