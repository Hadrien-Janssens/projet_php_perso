<?php
require_once dirname(__DIR__,2)."/core/getInfoUser.php";
require_once dirname(__DIR__,2)."/constantes/constantes.php";
require_once dirname(__DIR__,2)."/core/gestionFormulaire.php";
require_once dirname(__DIR__)."/models/postModel.php";


function dislike($chemin) {

    $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
  
        // $_POST['dislike'] etant l'ID du post 
        dislikePost($utilisateur['UseId'],$_POST['dislike']);
          // Rediriger l'utilisateur vers la même page pour éviter la resoumission du formulaire
    
          header("Location: /" . $chemin  );
          exit();
    
}