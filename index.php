<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="number" name="num01" placeholder="Number 1" required>
        <select name="operator">
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="number" name="num02" placeholder="Number 2" required>
        <button>Calculate</button>
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //grab data from form
            $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
            $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
            //$operator = filter_input(INPUT_POST, "operator", FILTER_SANITIZE_STRING);
            $operator = htmlspecialchars($_POST["operator"]);

            //error handlers
            $error = false;

            if(empty($num01) || empty($num02) || empty($operator)){
                echo "<p class='calc-error'> Please fill in all fields.</p>";
                $error = true;
            }

            if(!is_numeric($num01) || !is_numeric($num02)){
                echo "<p class='calc-error'> Please enter valid numbers.</p>";
                $error = true;
            }

            //calculate
            if(!$error){
                $result = 0;
                switch($operator){
                    case "add":
                        $result = $num01 + $num02;
                        break;
                    case "subtract":
                        $result = $num01 - $num02;
                        break;
                    case "multiply":
                        $result = $num01 * $num02;
                        break;
                    case "divide":
                        if($num02 == 0){
                            echo "<p class='calc-error'> Cannot divide by zero.</p>";
                            exit();
                        }
                        $result = $num01 / $num02;
                        break;
                    default:
                        echo "<p class='calc-error'> Something's wrong.</p>";
                        exit();
                }
                echo "<p class='calc-result'> Result: $result </p>";  
            }
        }
    ?>
</body>
</html>