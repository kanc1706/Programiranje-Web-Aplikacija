<?php
$message = '';
$message_class = '';
$random_number = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guess = isset($_POST['guess']) ? intval($_POST['guess']) : 0;
    $random_number = rand(1, 9);
    
    if ($guess == $random_number) {
        $message = 'Pogodak, probaj ponovo!';
        $message_class = 'success';
    } else {
        $message = 'Krivo, probaj ponovo!';
        $message_class = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogodi broj</title>
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
        
        .success {
            color: green;
            margin-top: 15px;
            font-weight: bold;
        }
        
        .error {
            color: red;
            margin-top: 15px;
            font-weight: bold;
        }
        
        .info {
            margin-top: 15px;
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 4px solid #0066cc;
        }
        
        h1 {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <h1>Pogodi broj</h1>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="guess">Unesite broj (1-9):</label>
            <input type="number" name="guess" id="guess" min="1" max="9" required>
        </div>
        
        <button type="submit">Pogodi</button>
    </form>
    
    <?php if ($message): ?>
        <div class="<?php echo $message_class; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <?php if ($message): ?>
        <div class="info">
            <strong>Zamišljeni broj je <?php echo $random_number; ?></strong>
        </div>
    <?php endif; ?>
</body>
</html>
