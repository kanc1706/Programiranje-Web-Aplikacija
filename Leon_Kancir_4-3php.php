<?php
$word_count = 0;
$text = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'];
    $word_count = str_word_count($text);
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Brojač riječi</title>
</head>
<body>
    <form method="POST">
        <textarea name="text" rows="5" cols="50"><?php echo htmlspecialchars($text); ?></textarea><br><br>
        <input type="submit" value="Broj riječi">
    </form>
    
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>Broj riječi: <?php echo $word_count; ?></p>
    <?php endif; ?>
</body>
</html>
