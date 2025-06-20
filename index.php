<?php

try {
    $dbh = new PDO("mysql:host=localhost;dbname=filmclub", "root", "");
    $sqlFilm = "SELECT * FROM film";
    $films = $dbh->query($sqlFilm);
    $sqlBeoordeling = "SELECT * FROM beoordeling";
    $beoordelingen = $dbh->query($sqlBeoordeling);
    foreach ($films as $film) {
        echo $film["titel"] . "<br/>";
        echo "<a href='edit.php?id=" . $film["id"] . "'> Edit</a><br/>";
        echo "<a href='beoordelingen.php?id=" . $film["id"] . "'> Beoordeling</a><br/><br>";
    }
}
catch (PDOexception $e) {
    echo "Error is: " . $e-> etmessage();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="insert.php">INSERT FILMS</a>
</body>
</html>
