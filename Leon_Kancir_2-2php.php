<?php
$naslov      = "PHP dokument — vježba 1c";
$autor       = "Leon Kancir";
$opis        = "Ova stranica nastavlja vježbu 1b i služi za uvježbavanje varijabli, ispisa i osnovnog CSS-a.";
$linkInfo    = "https://www.php.net";
$linkNatrag  = "vjezba1b.php";
?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Vježba 1c — nastavak na vjezba1b.php">
  <title><?php echo $naslov; ?></title>
  <style>
    :root { --bg:#0f172a; --card:#ffffff; --text:#111827; --muted:#6b7280; --accent:#2563eb; }
    *{ box-sizing:border-box }
    body{ margin:0; background:var(--bg); color:var(--text);
          font-family:system-ui,-apple-system,"Segoe UI",Roboto,sans-serif; }
    .wrap{ max-width:720px; margin:48px auto; background:var(--card); padding:32px;
           border-radius:16px; box-shadow:0 10px 30px rgba(0,0,0,.08); }
    h1{ margin:0 0 12px; font-size:2rem }
    p{ margin:0 0 14px; line-height:1.6 }
    .btn{ display:inline-block; padding:10px 16px; border:1px solid var(--accent);
          border-radius:10px; text-decoration:none }
    .btn:hover{ background:var(--accent); color:#fff }
    .muted{ color:var(--muted); font-size:.9rem; margin-top:8px }
    .row{ display:flex; gap:12px; flex-wrap:wrap; margin-top:10px }
  </style>
</head>
<body>
  <main class="wrap">
    <h1><?php echo $naslov; ?></h1>
    <p>Ovu stranicu izradio/la je Leon Kancir<strong><?php echo $autor; ?></strong>.</p>
    <p><?php echo $opis; ?></p>
    <div class="row">
      <a class="btn" href="<?php echo $linkInfo; ?>" target="_blank">Saznaj više o PHP-u</a>
      <a class="btn" href="<?php echo $linkNatrag; ?>">Natrag na vježba 1b</a>
    </div>
    <p class="muted">&copy; <?php echo date('Y'); ?> — Demo za PHP</p>
  </main>
</body>
</html>
<!-- Naziv datoteke: Leon_Kancir_2-2php.php -->