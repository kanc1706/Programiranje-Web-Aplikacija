<?php
$average = '';
$final_grade = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $midterm1 = isset($_POST['midterm1']) ? floatval($_POST['midterm1']) : 0;
    $midterm2 = isset($_POST['midterm2']) ? floatval($_POST['midterm2']) : 0;
    
   
    if ($midterm1 < 1 || $midterm1 > 5 || $midterm2 < 1 || $midterm2 > 5) {
        $error = 'Ocjene moraju biti između 1 i 5!';
    } else {
      
        if ($midterm1 < 2 || $midterm2 < 2) {
            $final_grade = 1; 
            $average = ($midterm1 + $midterm2) / 2;
        } else {
            
            $average = ($midterm1 + $midterm2) / 2;
            
           
            if ($average >= 4.5) {
                $final_grade = 5;
            } elseif ($average >= 3.5) {
                $final_grade = 4;
            } elseif ($average >= 2.5) {
                $final_grade = 3;
            } elseif ($average >= 1.5) {
                $final_grade = 2;
            } else {
                $final_grade = 1;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator ocjena</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            min-height: 100vh;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        h1 {
            color: #2d3436;
            text-align: center;
            margin-bottom: 10px;
            font-size: 2em;
        }
        
        .subtitle {
            text-align: center;
            color: #636e72;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2d3436;
            font-size: 1.1em;
        }
        
        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #dfe6e9;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        input[type="number"]:focus {
            outline: none;
            border-color: #74b9ff;
            box-shadow: 0 0 0 3px rgba(116, 185, 255, 0.1);
        }
        
        .submit-btn {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(116, 185, 255, 0.3);
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(116, 185, 255, 0.4);
        }
        
        .result-card {
            margin-top: 30px;
            padding: 25px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            border-left: 5px solid #74b9ff;
        }
        
        .result-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }
        
        .result-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .result-label {
            font-weight: 600;
            color: #495057;
        }
        
        .result-value {
            font-size: 1.2em;
            font-weight: bold;
            color: #2d3436;
        }
        
        .grade-negative {
            color: #e74c3c;
        }
        
        .grade-positive {
            color: #27ae60;
        }
        
        .error {
            background: #fee;
            color: #e74c3c;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 4px solid #e74c3c;
            text-align: center;
        }
        
        .info-box {
            background: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }
        
        .info-box h3 {
            color: #1565c0;
            margin-top: 0;
            margin-bottom: 10px;
        }
        
        .info-box ul {
            margin: 0;
            padding-left: 20px;
            color: #424242;
        }
        
        .info-box li {
            margin-bottom: 5px;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 10px;
            }
            
            h1 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kalkulator ocjena</h1>
        <p class="subtitle">Izračun prosječne i konačne ocjene kolegija</p>
        
        <div class="info-box">
            <h3>Pravila ocjenjivanja:</h3>
            <ul>
                <li>Ocjene moraju biti u rasponu od 1 do 5</li>
                <li>Ako je jedan od kolokvija negativan (ocjena < 2), konačna ocjena je 1</li>
                <li>Prosjek se računa kao aritmetička sredina obaju kolokvija</li>
            </ul>
        </div>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="midterm1">Ocjena prvog kolokvija:</label>
                <input type="number" name="midterm1" id="midterm1" min="1" max="5" step="0.1" required>
            </div>
            
            <div class="form-group">
                <label for="midterm2">Ocjena drugog kolokvija:</label>
                <input type="number" name="midterm2" id="midterm2" min="1" max="5" step="0.1" required>
            </div>
            
            <button type="submit" class="submit-btn">Izračunaj ocjene</button>
        </form>
        
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($average !== '' && $final_grade !== ''): ?>
            <div class="result-card">
                <div class="result-item">
                    <span class="result-label">Prosjek ocjena:</span>
                    <span class="result-value"><?php echo number_format($average, 2); ?></span>
                </div>
                <div class="result-item">
                    <span class="result-label">Konačna ocjena:</span>
                    <span class="result-value <?php echo ($final_grade < 2) ? 'grade-negative' : 'grade-positive'; ?>">
                        <?php echo $final_grade; ?>
                    </span>
                </div>
                <div class="result-item">
                    <span class="result-label">Status:</span>
                    <span class="result-value">
                        <?php echo ($final_grade < 2) ? 'NEGATIVAN' : 'POZITIVAN'; ?>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
