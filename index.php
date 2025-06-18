<?php

try {
    $dbh = new PDO("mysql:host=localhost;dbname=filmclub", "root", "");
    $sql = "SELECT * FROM film";
    $films = $dbh->query($sql);
    foreach ($films as $film) {
        print $film["id"] . " " . $film["titel"] . " " . $film['genre'] . "<br/>";
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
