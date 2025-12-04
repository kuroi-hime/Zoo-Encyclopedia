<?php
    include 'connexion.php';

    $nomHabitat = ucfirst($_POST['habitatName']);
    $descriptionHabitat = strtolower($_POST['habitatDescription']);
    $sql = "insert into Habitats (NomHab, Description_Hab) values ('$nomHabitat', '$descriptionHabitat')";
    $connexion->query($sql);
    header('location:../index.php');
?>