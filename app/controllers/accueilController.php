<?php

// require_once dirname(__DIR__,1)."/views/templates/header.php";
require_once dirname(__DIR__,2)."/constantes/constantes.php";
require_once dirname(__DIR__,2)."/core/gestionFormulaire.php";
require_once dirname(__DIR__)."/models/postModel.php";
require_once dirname(__DIR__)."/models/userModel.php";
require_once dirname(__DIR__,2)."/core/gestionVue.php";
require_once dirname(__DIR__,2)."/core/gestionAuthentification.php";



if (!isset(($_SESSION['utilisateur_id'])) || !est_connecte($_SESSION['utilisateur_id'])) {
    // $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
    // $posts = getUserPosts($_SESSION['utilisateur_id']);
    header('Location:'. BASE_URL .'connection');
    exit();
}


$posts = getPosts();

// gerer le like 
// if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST) && isset($_POST["like"])) {
//     // $_POST['like'] etant l'ID du post 
//     likePost($utilisateur['UseId'],$_POST['like']);

//       // Rediriger l'utilisateur vers la même page pour éviter la resoumission du formulaire
//     header("Location: " . $_SERVER['PHP_SELF']);
//     exit;
// }
// // gerer le dislike 
// if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST) && isset($_POST["dislike"])) {
//     // $_POST['dislike'] etant l'ID du post 
//     dislikePost($utilisateur['UseId'],$_POST['dislike']);
//       // Rediriger l'utilisateur vers la même page pour éviter la resoumission du formulaire

//     header("Location: " . $_SERVER['PHP_SELF']);
//     exit;
// }

// tentative mvc


function obtenir_pageInfos(): array
{
    return [
        'vue' => 'accueil',
        'titre' => "Page d'Accueil",
        'description' => "Description de la page d'accueil..."
    ];
}

function index () {
  $args['posts'] = getPosts();
  afficher_vue(obtenir_pageInfos(),'index',$args);
}

function deconnecter_utilisateur() {
    session_destroy();
    header('Location:'. BASE_URL.'connection');
    exit();

}