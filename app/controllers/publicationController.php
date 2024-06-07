<?php
require_once dirname(__DIR__,2)."/core/getInfoUser.php";
require_once dirname(__DIR__,2)."/constantes/constantes.php";
require_once dirname(__DIR__,2)."/core/gestionFormulaire.php";
require_once dirname(__DIR__)."/models/postModel.php";

function publication() {
    echo "publication";
    
        $utilisateur = getInfoUser($_SESSION['utilisateur_id']);

        $dataArrayClean = xssSecurity($_POST);

        $userId = $utilisateur['UseId'];
        $comment = $dataArrayClean['comment'];
        try {
            createPost($userId, $comment);
        // Rediriger l'utilisateur vers la même page pour éviter la resoumission du formulaire

            header("Location: " . BASE_URL);


        } catch (\Throwable $th) {
            echo $th;
        }
    }