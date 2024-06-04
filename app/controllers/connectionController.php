<?php
require_once dirname(__DIR__,2)."/constantes/constantes.php";
require_once dirname(__DIR__,2)."/core/gestionFormulaire.php";
require_once dirname(__DIR__,2)."/core/gestionAuthentification.php";
require_once dirname(__DIR__,2)."/core/getInfoUser.php";
require_once dirname(__DIR__,2)."/core/gestionVue.php";
require_once dirname(__DIR__)."/models/userModel.php";

function connection() {
    $reglesConnection = [
        "pseudo" => [
          "require" => true,
          "max" => 255,
          "min" => 2,
          "unique"=> true
        ],
        "password" => [
            "require" => true,
            "max" => 72,
            "min" => 8
        ]
    ];
    $dataArrayClean = xssSecurity($_POST);
    $erreurs  = traitement($reglesConnection,$dataArrayClean);
    if (empty($erreurs)) {
        connecterUtilisateur($dataArrayClean['pseudo'],$dataArrayClean['password']);
    }
    
//rediriger l'utilisateur si il essaye de joindre la page connexion alors qu'il est déja connecté 
if (isset($_SESSION['utilisateur_id']) && est_connecte($_SESSION['utilisateur_id'])) {
    //recuperer les infos utilisateurs
    $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
    $args['utilisateur']= getInfoUser($_SESSION['utilisateur_id']);
    //si son compte est activé
    if ($utilisateur['UseActivated'] == 1 ) {
        // header('Location:'.BASE_URL.'profil.php');
        header('Location:'.BASE_URL);
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
}
// tentative mvc
function obtenir_pageInfos(): array
{
    return [
        'vue' => 'connection',
        'titre' => "Page de connection",
        'description' => "Description de la page de connexion..."
    ];
}

function index () {
  afficher_vue(obtenir_pageInfos(),'index');
}