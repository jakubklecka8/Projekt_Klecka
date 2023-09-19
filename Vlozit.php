<?php

function vlozitDoDatabaze($jmeno, $prijmeni, $vek, $tel, $db) {
    $stmt = $db->prepare("INSERT INTO pojisteni (jmeno, prijmeni, vek, telefon) VALUES (:jmeno, :prijmeni, :vek, :tel)");
    $stmt->bindParam(':jmeno', $jmeno);
    $stmt->bindParam(':prijmeni', $prijmeni);
    $stmt->bindParam(':vek', $vek);
    $stmt->bindParam(':tel', $tel);

    if ($stmt->execute()) {
        return true; 
    } else {
        return false; 
    }
}
?>