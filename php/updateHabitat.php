<?php
    include 'connexion.php';

    $id = $_POST['id'];
    $nom = ucfirst($_POST['habitatName']);
    $description = strtolower($_POST['habitatDescription']);

    $sql = "update habitats set NomHab = '$nom', Description_Hab = '$description' where IdHab = $id";
    $connexion->query($sql);

    header('location:../index.php');
?>