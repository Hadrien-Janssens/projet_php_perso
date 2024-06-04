<?php
require_once dirname(__DIR__)."/constantes/constantes.php";
    require_once __DIR__."/../core/gestionAuthentification.php";
    require_once dirname(__DIR__)."/core/getInfoUser.php";
    require_once dirname(__DIR__)."/models/userModel.php";
    require_once dirname(__DIR__)."/models/postModel.php";
    require_once dirname(__DIR__)."/core/gestionFormulaire.php";

// gerer le cas ou l'utilisateur essaie detre sur cette page son avoir activer son compte
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
        deconnecter_utilisateur();
        header('Location:'. BASE_URL .'connexion.php');
        exit();
    }

    if (est_connecte($_SESSION['utilisateur_id'])) {
        $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
        $posts = getUserPosts($_SESSION['utilisateur_id']);
    }
    else {
        header('Location:'. BASE_URL .'connexion.php');
        exit();
    }

// modifier son avatar-----------------------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['img-form'])) {
       
    $path = dirname(__DIR__).'/uploads/';

        move_uploaded_file($_FILES['img']['tmp_name'], "./uploads/" . basename($_FILES['img']['name']));
        $imgPath = "/uploads/" . basename($_FILES['img']['name']);

        saveImgToDb($utilisateur['UseId'],$imgPath );
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    // modifier son nom-----------------------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name-form'])) {
  
        updateUser($utilisateur['UseId'], "UsePseudo", $_POST['name']);

            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

    // modifier son mail-----------------------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mail-form'])) {
        $erreur = traitement($reglesChangementEmail, $_POST);
        if (empty($erreur )) {
            # code...
            updateUser($utilisateur['UseId'], "UseEmail", $_POST['email']);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        }
            // supprimer son compte-----------------------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete-account'])) {
     
        deleteUser($utilisateur['UseId']);
        deconnecter_utilisateur();
        header("Location: index.php" );
        exit;
        

        }


// gerer le like ------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST) && isset($_POST["like"])) {
    // $_POST['like'] etant l'ID du post 
    likePost($utilisateur['UseId'],$_POST['like']);

      // Rediriger l'utilisateur vers la même page pour éviter la resoumission du formulaire
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
// gerer le dislike ------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST) && isset($_POST["dislike"])) {
    // $_POST['dislike'] etant l'ID du post 
    dislikePost($utilisateur['UseId'],$_POST['dislike']);
      // Rediriger l'utilisateur vers la même page pour éviter la resoumission du formulaire

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
        