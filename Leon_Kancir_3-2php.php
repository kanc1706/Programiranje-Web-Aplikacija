<?php
$result = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : 0;
    $num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';
    
    if (is_numeric($_POST['num1']) && is_numeric($_POST['num2'])) {
        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                $formula = "$num1 + $num2 = $result";
                break;
            case 'subtract':
                $result = $num1 - $num2;
                $formula = "$num1 - $num2 = $result";
                break;
            case 'multiply':
                $result = $num1 * $num2;
                $formula = "$num1 × $num2 = $result";
                break;
            case 'divide':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                    $formula = "$num1 ÷ $num2 = $result";
                } else {
                    $error = 'Dijeljenje s nulom nije moguće!';
                }
                break;
            default:
                $error = 'Molimo odaberite operaciju!';
        }
    } else {
        $error = 'Molimo unesite važeće brojeve!';
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            background-color: white;
        }
        
        form {
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: normal;
        }
        
        input[type="number"] {
            width: 200px;
            padding: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        
        .button-group {
            margin-top: 20px;
        }
        
        button {
            background-color: #0066cc;
            color: white;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
            margin-bottom: 5px;
        }
        
        button:hover {
            background-color: #0052a3;
        }
        
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f0f8ff;
            border: 1px solid #cce6ff;
            border-radius: 5px;
        }
        
        .error {
            color: red;
            margin-top: 10px;
        }
        
        h1 {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <h1>Kalkulator</h1>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="num1">Prvi broj:</label>
            <input type="number" name="num1" id="num1" step="any" required>
        </div>
        
        <div class="form-group">
            <label for="num2">Drugi broj:</label>
            <input type="number" name="num2" id="num2" step="any" required>
        </div>
        
        <div class="button-group">
            <button type="submit" name="operation" value="add">+</button>
            <button type="submit" name="operation" value="subtract">-</button>
            <button type="submit" name="operation" value="multiply">×</button>
            <button type="submit" name="operation" value="divide">÷</button>
        </div>
    </form>
    
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if ($result !== '' && isset($formula)): ?>
        <div class="result">
            <h3>Rezultat:</h3>
            <?php echo $formula; ?>
        </div>
    <?php endif; ?>
</body>
</html>
