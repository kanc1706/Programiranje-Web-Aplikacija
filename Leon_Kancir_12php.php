<?php
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['set_cookies'])) {
        setcookie("username", "Marko", time() + 3600, "/"); 
        setcookie("email", "marko@example.com", time() + 3600, "/"); 
        setcookie("last_visit", date("Y-m-d H:i:s"), time() + 3600, "/"); 
        setcookie("page_visits", 1, time() + 3600, "/"); 
        $message = "Kolačići su postavljeni!";
        
    } elseif (isset($_POST['clear_cookies'])) {
        setcookie("username", "", time() - 3600, "/");
        setcookie("email", "", time() - 3600, "/");
        setcookie("last_visit", "", time() - 3600, "/");
        setcookie("page_visits", "", time() - 3600, "/");
        $message = "Kolačići su obrisani!";
    }
}

if ($message) {
    header("Location: cookie_all_in_one.php?message=" . urlencode($message));
    exit();
}

if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Podaci iz kolačića</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            background-color: white;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .cookie-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .info-label {
            font-weight: bold;
            color: #495057;
        }
        
        .info-value {
            color: #6c757d;
        }
        
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 10px 5px;
        }
        
        .button:hover {
            background-color: #0056b3;
        }
        
        .no-cookies {
            text-align: center;
            color: #6c757d;
            padding: 40px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        
        .message {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .form-container {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Podaci iz kolačića</h1>
        
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($_COOKIE['username'])): ?>
            <div class="cookie-info">
                <h2>Podaci korisnika:</h2>
                <div class="info-item">
                    <span class="info-label">Korisničko ime:</span>
                    <span class="info-value"><?php echo htmlspecialchars($_COOKIE['username']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span>
                    <span class="info-value"><?php echo htmlspecialchars($_COOKIE['email']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Posljednja posjeta:</span>
                    <span class="info-value"><?php echo htmlspecialchars($_COOKIE['last_visit']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Broj posjeta:</span>
                    <span class="info-value"><?php echo htmlspecialchars($_COOKIE['page_visits']); ?></span>
                </div>
            </div>
        <?php else: ?>
            <div class="no-cookies">
                <h2>Nema podataka u kolačićima</h2>
                <p>Kolačići nisu postavljeni ili su istekli.</p>
            </div>
        <?php endif; ?>
        
        <div class="form-container">
            <form method="POST">
                <button type="submit" name="set_cookies" class="button">Postavi kolačiće</button>
                <button type="submit" name="clear_cookies" class="button">Obriši kolačiće</button>
            </form>
        </div>
    </div>
</body>
</html>
