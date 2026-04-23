<?php
$result = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = isset($_POST['a']) ? floatval($_POST['a']) : 0;
    $b = isset($_POST['b']) ? floatval($_POST['b']) : 0;
    
    if (is_numeric($_POST['a']) && is_numeric($_POST['b'])) {
        $c = (3 * $a - $b) / 2;
        $result = "c = (3 × $a - $b) ÷ 2 = $c";
    } else {
        $error = 'Molimo unesite važeće brojeve.';
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
        
        button {
            background-color: #0066cc;
            color: white;
            padding: 8px 20px;
            border: none;
            cursor: pointer;
            font-size: 14px;
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
        
        .formula {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 4px solid #0066cc;
        }
    </style>
</head>
<body>
    <h1>Kalkulator</h1>
    
    <div class="formula">
        <strong>Formula:</strong> c = (3a - b) / 2
    </div>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="a">Unesite vrijednost za a:</label>
            <input type="number" name="a" id="a" step="any" required>
        </div>
        
        <div class="form-group">
            <label for="b">Unesite vrijednost za b:</label>
            <input type="number" name="b" id="b" step="any" required>
        </div>
        
        <button type="submit">Izračunaj</button>
    </form>
    
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if ($result): ?>
        <div class="result">
            <h3>Rezultat:</h3>
            <?php echo $result; ?>
        </div>
    <?php endif; ?>
</body>
</html>
