<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Islas de PHP dentro de HTML</title>
</head>
<body>
  <h1>Islas de PHP</h1>

  <ul>
    <?php for ($i = 1; $i <= 3; $i++): ?>
      <li>Elemento numero <?php echo $i; ?></li>
    <?php endfor; ?>
  </ul>
</body>
</html>
