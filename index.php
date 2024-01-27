<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numbers = $_POST["numbers"];
    $function = $_POST["function"];

    // Sanitize and validate input
    $number_array = explode(" ", filter_var($numbers, FILTER_SANITIZE_STRING));
    $number_array = array_filter($number_array, 'is_numeric');

    // Function for each operation
    function calculateSum($array) {
        return array_sum($array);
    }

    function calculateAverage($array) {
        return count($array) > 0 ? array_sum($array) / count($array) : "Error: Division by zero";
    }

    // Perform the selected calculation based on the chosen function
    switch ($function) {
        case 1: // AutoSum
            $result = calculateSum($number_array);
            break;
        case 2: // Average
            $result = calculateAverage($number_array);
            break;
        case 3: // Max
            $result = max($number_array);
            break;
        case 4: // Min
            $result = min($number_array);
            break;
        default:
            $result = "Invalid function";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./styles/styles.css">
    <title>Excel Functions</title>
</head>

<body>
    <div>
        <h3>Excel Functions</h3>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="numbers">Enter numbers with space:</label>
            <input type="text" name="numbers" id="numbers" required aria-label="Numbers"><br><br>
            <label for="function">Select function:</label><br>
            <input type="radio" name="function" id="autosum" value="1" checked aria-label="AutoSum">
            <label for="autosum">AutoSum</label><br>
            <input type="radio" name="function" id="average" value="2" aria-label="Average">
            <label for="average">Average</label><br>
            <input type="radio" name="function" id="max" value="3" aria-label="Max">
            <label for="max">Max</label><br>
            <input type="radio" name="function" id="min" value="4" aria-label="Min">
            <label for="min">Min</label><br><br>
            <input type="submit" value="Calculate" style="background-color: red; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">
        </form>
        <?php
        if (isset($result)) {
            echo "Result: $result";
        }
        ?>
    </div>
</body>

</html>
