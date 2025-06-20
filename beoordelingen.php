<?php
try {
    $dbh = new PDO("mysql:host=localhost;dbname=filmclub", "root", "");
    $id = $_GET['id'];
    $sql = "SELECT * FROM film WHERE id = :id";
    $sqlBeoordeling = "SELECT * FROM beoordeling WHERE id = :id";

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $film = $stmt->fetch(PDO::FETCH_ASSOC);
    $beoordeling = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($film) {
        echo 'Titel: ' . $film["titel"] . "<br>" . "Genre: " . $film['genre'] . "<br/>";
        echo 'Beoordeling: ' . $beoordeling["cijfer"] . "<br/>";

    } else {
        echo "Film not found.";
    }
} catch (PDOException $e) {
    echo "Error is: " . $e->getMessage();
}

echo "<a href='index.php'>BACK</a>";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Film</title>
</head>
<body>



</body>
</html>
