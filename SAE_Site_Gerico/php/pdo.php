<?php
$host = "localhost";
$port = "8889";
$nombdd = "SAE_Gerico";
$utilisateur = "root";
$mdp = "";

try {

    $bdd = new PDO("mysql:host=$host;dbname=$nombdd;charset=utf8",$utilisateur,$mdp);
    $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ATTR_ERRMODE_EXCEPTION);
    echo "Connexion réussie";
}
catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage() . " (Code d'erreur : " . $e->getCode() . ")");
    }
    
?>