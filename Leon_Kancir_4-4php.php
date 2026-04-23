<?php
function isPrime($number) {
    if ($number <= 1) {
        return false;
    }
    
    for ($i = 2; $i < $number; $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }
    
    return true;
}

$primes = array();
for ($n = 2; $n < 100; $n++) {
    if (isPrime($n)) {
        $primes[] = $n;
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Prosti brojevi</title>
</head>
<body>
    <h1>Prosti brojevi manji od 100:</h1>
    
    <p>
        <?php
        foreach ($primes as $prime) {
            echo $prime . " ";
        }
        ?>
    </p>
    
    <h2>Provjera pojedinačnog broja:</h2>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $number = $_POST['number'];
        $result = isPrime($number);
        
        if ($result) {
            echo "<p>Broj $number je prost.</p>";
        } else {
            echo "<p>Broj $number nije prost.</p>";
        }
    }
    ?>
    
    <form method="POST">
        <input type="number" name="number" min="1" required>
        <input type="submit" value="Provjeri">
    </form>
</body>
</html>
