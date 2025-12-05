<?php
    include 'connexion.php';
    $id = $_GET['id'];
    $sql = "update Animaux set IdHab = NULL where IdHab = $id";
    $connexion->query($sql);
    $sql = "delete FROM Habitats where IdHab = $id";
    $connexion->query($sql);
    header('location:../index.php');
?>