<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Film</title>
</head>
<body>
<form method="post" action="">
    <label for="titel">Titel</label>
    <input type="text" id="titel" name="titel" value="<?php echo htmlspecialchars($titel ?? ''); ?>">

    <label for="genre">Genre</label>
    <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($genre ?? ''); ?>">

    <input type="submit" name="send" value="verzenden">
</form>

<?php

try {
    $dbh = new PDO("mysql:host=localhost;dbname=filmclub", "root", "");
} catch (PDOException $e) {
    echo "Error is: " . $e->getMessage();
    exit();
}

$TITEL_REQUIRED = 'Titel invullen';
$GENRE_REQUIRED = 'Genre invullen';

$errors = [];
$inputs = [];

if (isset($_POST["send"])) {
    $titel = filter_input(INPUT_POST, 'titel', FILTER_SANITIZE_SPECIAL_CHARS);
    $titel = trim($titel);
    if (empty($titel)) {
        $errors['titel'] = $TITEL_REQUIRED;
    } else {
        $inputs['titel'] = $titel;
    }

    $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_SPECIAL_CHARS);
    $genre = trim($genre);
    if (empty($genre)) {
        $errors['genre'] = $GENRE_REQUIRED;
    } else {
        $inputs['genre'] = $genre;
    }

}

if (empty($errors) && isset($titel) && isset($genre)) {
    $sth = $dbh->prepare("SELECT COUNT(*) FROM film WHERE titel = :titel");
    $sth->bindParam(':titel', $titel);
    $sth->execute();

    $count = $sth->fetchColumn();

    if ($count > 0) {
        echo "The title already exists in the database.<br/>";
    } else {
        $sth = $dbh->prepare("INSERT INTO film (titel, genre) VALUES (:titel, :genre)");
        $sth->bindParam(':titel', $titel);
        $sth->bindParam(':genre', $genre);
        if ($sth->execute()) {
            echo "<p>Data inserted successfully!</p>";
            header("Location: index.php");
            exit();
        } else {
            echo "<p>Error: Unable to insert data into the database.</p>";
        }
    }
} else {
    echo "Missing inputs or validation errors.";
}

?>

<a href="index.php">BACK</a>
</body>
</html>
