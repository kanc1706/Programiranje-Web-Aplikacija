<?php
$cars = array("Audi", "BMW", "Renault", "Citroen");
$selected_car = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_vehicle']) && !empty($_POST['new_vehicle'])) {
        $new_vehicle = trim($_POST['new_vehicle']);
        if (!in_array($new_vehicle, $cars)) {
            $cars[] = $new_vehicle;
            $message = "Vozilo '$new_vehicle' je dodano na listu!";
        } else {
            $message = "Vozilo '$new_vehicle' već postoji na listi!";
        }
    }
    
    if (isset($_POST['select_vehicle']) && !empty($_POST['vehicle'])) {
        $selected_car = $_POST['vehicle'];
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista vozila</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            background-color: white;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .section {
            margin-bottom: 40px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        
        h1, h2 {
            color: #333;
            margin-bottom: 20px;
        }
        
        ul {
            list-style-type: none;
            padding: 0;
        }
        
        li {
            padding: 10px;
            margin: 5px 0;
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 4px;
        }
        
        .selected {
            background-color: #e3f2fd;
            border-color: #2196f3;
            font-weight: bold;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input[type="text"], select {
            width: 200px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        
        button {
            background-color: #2196f3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        
        button:hover {
            background-color: #1976d2;
        }
        
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            background-color: #f0f8ff;
            border: 1px solid #b3d9ff;
            color: #0066cc;
        }
        
        .selected-display {
            margin-top: 20px;
            padding: 15px;
            background-color: #e8f5e8;
            border: 1px solid #4caf50;
            border-radius: 4px;
            color: #2e7d32;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista vozila</h1>
        
        <div class="section">
            <h2>Trenutna lista vozila:</h2>
            <ul>
                <?php foreach ($cars as $car): ?>
                    <li class="<?php echo ($car == $selected_car) ? 'selected' : ''; ?>">
                        <?php echo htmlspecialchars($car); ?>
                        <?php if ($car == $selected_car): ?>
                            ✓ (Odabrano)
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="section">
            <h2>Odaberite vozilo:</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="vehicle">Izaberite vozilo:</label>
                    <select name="vehicle" id="vehicle" required>
                        <option value="">-- Odaberite vozilo --</option>
                        <?php foreach ($cars as $car): ?>
                            <option value="<?php echo htmlspecialchars($car); ?>" <?php echo ($car == $selected_car) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($car); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="select_vehicle">Prikaži vozilo</button>
            </form>
        </div>
        
        <div class="section">
            <h2>Dodajte novo vozilo:</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="new_vehicle">Naziv vozila:</label>
                    <input type="text" name="new_vehicle" id="new_vehicle" required>
                </div>
                <button type="submit" name="add_vehicle">Dodaj vozilo</button>
            </form>
        </div>
        
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if ($selected_car): ?>
            <div class="selected-display">
                Odabrano vozilo: <?php echo htmlspecialchars($selected_car); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
