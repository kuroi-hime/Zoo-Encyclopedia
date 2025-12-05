<?php
include 'connexion.php';

    $id = $_GET['id'];
    $sql = "delete from animaux where ID=$id";
    $connexion->query($sql);
    header('location:../index.php');
?>