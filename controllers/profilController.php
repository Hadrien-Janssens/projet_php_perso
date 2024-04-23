<?php
require_once dirname(__DIR__)."/constantes/constantes.php";
    require_once __DIR__."/../core/gestionAuthentification.php";
    require_once dirname(__DIR__)."/core/getInfoUser.php";

    // gerer le cas ou l'utilisateur essaie detre sur cette page son avoir activer son compte



    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        deconnecter_utilisateur();
        header('Location:'. BASE_URL .'connexion.php');
        exit();
    }

    if (est_connecte($_SESSION['utilisateur_id'])) {
        $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
    }
    else {
        header('Location:'. BASE_URL .'connexion.php');
        exit();
    }