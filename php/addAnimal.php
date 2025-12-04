<?php
    include 'connexion.php';

    $image = $_POST['habitatImg'];
    $nom = $_POST['animalName'];
    $regime = $_POST['animalSpecies'];
    $idHab = $_POST['animalHabitat'];
    
    $sql = "insert into Animaux (Nom, Type_alimentaire, Image, IdHab) values ('$nom', '$regime', '$image', $idHab)";
    $connexion->query($sql);
    header('location:../index.php');
?>