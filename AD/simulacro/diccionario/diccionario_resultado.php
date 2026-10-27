<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    var_export($_POST);
for ($i=1; $i <=3 ; $i++) { 
    $es  = "espanol" .$i;
    $en = "ingles" .$i;
    $$es = $_POST[$es];
     $$en = $_POST[$en];
      echo $$es . " = " .$$en . "<br/>";   // 3. enseñarlo
}
    ?>
</body>
</html>