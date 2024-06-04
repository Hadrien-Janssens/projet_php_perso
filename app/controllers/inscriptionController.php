<?php
require_once dirname(__DIR__)."/constantes/constantes.php";
require_once __DIR__."/../models/userModel.php";
require_once __DIR__."/../core/gestionFormulaire.php";
require_once dirname(__DIR__)."/core/gestionAuthentification.php";




if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $dataArrayClean = xssSecurity($_POST);
    $erreurs = traitement($reglesInscription ,$dataArrayClean );
    if (empty($erreurs)) {
        try {
            createUser($dataArrayClean['pseudo'],$dataArrayClean['email'],$dataArrayClean['password']);
            header('Location:'.BASE_URL.'succesInscription.php');
            exit();
        } catch (Exception $e) {
            echo 'utilisateur déjà pris';
        }
    }
}
//rediriger l'utilisateur si il essaye de joindre la page inscription alors qu'il est déja connecté
if (isset($_SESSION['utilisateur_id']) && est_connecte($_SESSION['utilisateur_id'])) {
    header('Location:'.BASE_URL.'profil.php');
    exit();
}