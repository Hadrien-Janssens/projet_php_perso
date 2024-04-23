<?php
require_once dirname(__DIR__)."/constantes/constantes.php";
require_once __DIR__."/../models/userModel.php";
require_once __DIR__."/../core/gestionFormulaire.php";
require_once __DIR__."/../core/gestionAuthentification.php";
require_once dirname(__DIR__)."/core/getInfoUser.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $dataArrayClean = xssSecurity($_POST);
    $erreurs  = traitement($reglesConnection,$dataArrayClean);
    if (empty($erreurs)) {
         connecterUtilisateur($dataArrayClean['pseudo'],$dataArrayClean['password']);
    }
}
//rediriger l'utilisateur si il essaye de joindre la page connexion alors qu'il est déja connecté 
if (isset($_SESSION['utilisateur_id']) && est_connecte($_SESSION['utilisateur_id'])) {
    //recuperer les infos utilisateurs
    $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
    //si son compte est activé
    if ($utilisateur['UseActivated'] == 1 ) {
        header('Location:'.BASE_URL.'profil.php');
        exit();
    }
    //si son compte n'est pas activé
    else {
        $verifierIdentite = [
            "UseId" => $utilisateur['UseId'],
            "UseEmail" => $utilisateur['UseEmail'],
            "urlRedirection" => BASE_URL."profil.php",
            "envoyerCode" => true
        ];
        

        $_SESSION['verifierIdentite']= $verifierIdentite;
        header('Location:'.BASE_URL.'verificationIdentite.php');
        exit();
    }
}