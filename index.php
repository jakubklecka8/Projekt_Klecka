<?php

$db = new PDO('mysql:host=localhost;dbname=evidence_pojisteni', 'jakubklecka', '123456');
require_once('Vlozit.php');

function zobrazitDataZDatabaze($db) {
    $stmt = $db->prepare("SELECT * FROM pojisteni ORDER BY id DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jmeno = $_POST['jmeno'];
    $prijmeni = $_POST['prijmeni'];
    $vek = $_POST['vek'];
    $tel = $_POST['tel'];


    if (vlozitDoDatabaze($jmeno, $prijmeni, $vek, $tel, $db)) {
        echo "Data byla úspěšně vložena do databáze.";
    } else {
        echo "Chyba při vkládání dat do databáze.";
    }
}


$data = zobrazitDataZDatabaze($db);
?>
 <link rel="stylesheet" type="text/css" href="style.css"> 
<h2>Vytvoření Pojištěného</h2>
<form method="post" action="index.php">
    <label>Jméno: <input type="text" name="jmeno"></label><br>
    <label>Příjmení: <input type="text" name="prijmeni"></label><br>
    <label>Věk: <input type="text" name="vek"></label><br>
    <label>Telefonní číslo: <input type="text" name="tel"></label><br>
    <input type="submit" value="Vytvořit">
</form>

<h2>Seznam Pojištěných</h2>
<table>
    <thead>
        <tr>
            <th>Jméno</th>
            <th>Příjmení</th>
            <th>Věk</th>
            <th>Telefonní číslo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $pojisteny): ?>
            <tr>
                <td><?php echo $pojisteny['jmeno']; ?></td>
                <td><?php echo $pojisteny['prijmeni']; ?></td>
                <td><?php echo $pojisteny['vek']; ?></td>
                <td><?php echo $pojisteny['telefon']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>