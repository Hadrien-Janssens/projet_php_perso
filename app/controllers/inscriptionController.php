<?php
require_once dirname(__DIR__,2)."/constantes/constantes.php";
require_once __DIR__."/../models/userModel.php";
require_once dirname(__DIR__,2)."/core/gestionFormulaire.php";
require_once dirname(__DIR__,2)."/core/gestionAuthentification.php";
require_once dirname(__DIR__,2)."/core/gestionVue.php";


function inscription () {
$reglesInscription = getReglesInscritpion();
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $dataArrayClean = xssSecurity($_POST);
    $erreurs = traitement($reglesInscription ,$dataArrayClean );
    if (empty($erreurs)) {
        try {
            createUser($dataArrayClean['pseudo'],$dataArrayClean['email'],$dataArrayClean['password']);
            header('Location:'.BASE_URL.'succesInscription');
            exit();
        } catch (Exception $e) {
            echo 'utilisateur déjà pris';
        }
    }
}
//rediriger l'utilisateur si il essaye de joindre la page inscription alors qu'il est déja connecté
if (isset($_SESSION['utilisateur_id']) && est_connecte($_SESSION['utilisateur_id'])) {
    header('Location:'.BASE_URL.'profil');
    exit();
}
}
//tentative mvc

function obtenir_pageInfos(): array
{
    return [
        'vue' => 'inscription',
        'titre' => "Page d'inscription",
        'description' => "Description de la page d'inscription..."
    ];
}

function index () {
  afficher_vue(obtenir_pageInfos(),'index');
}