<?php
require_once dirname(__DIR__)."/constantes/constantes.php";
require_once dirname(__DIR__)."/core/gestionCodeActivation.php";
require_once dirname(__DIR__)."/core/getInfoUser.php";
require_once dirname(__DIR__)."/core/envoyerMail.php";
require_once dirname(__DIR__)."/core/gestionAuthentification.php";
require_once dirname(__DIR__)."/models/VerificationCodeModel.php";
require_once dirname(__DIR__)."/core/gestionFormulaire.php";

//redirige vers l'accueil si pas autorisé
if (!isset($_SESSION['verifierIdentite'])) {
    header('Location:'.BASE_URL.'index.php');
        exit();
} 
// quand un code est envoyer avec le formulaire de verification
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    //traitement des données reçues par le formulaire de code
    if (isset($_POST['formVerificationIdentitie'])) {
        $dataArrayClean = xssSecurity($_POST);
        $erreurs  = traitement($reglesVerificationCode,$dataArrayClean);  
  
    //recuperer le code d'activation de la DB
    $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
    //si le code est valide
    if (empty($erreurs) && verifieCodeActivation($utilisateur['UseCodeActivation'], $dataArrayClean['verification_code'])) {
        //supprimer variable de session et active le compte
       $verifierIdentite =  $_SESSION['verifierIdentite'];
       unset($_SESSION['verifierIdentite']);
       //activer le compte
       activerCompte($verifierIdentite['UseId']);
       header('Location:'.BASE_URL.'profil.php');
       exit();
        }
    }
    //permettre la genaration d'un code
    if (isset($_POST['formEnvoyerCode'])) {
        $_SESSION['verifierIdentite']['envoyerCode']=true; 
        //supprimer la $_POST pour eviter l'envoie de code a chaque rechargement de page
        unset($_POST['formEnvoyerCode']);      
    }
}

//si pas de formulaire soumis, genere un code et l'envoie pas mail
if ($_SESSION['verifierIdentite']['envoyerCode']) {
    $utilisateur = getInfoUser($_SESSION['utilisateur_id']);
    $destinataire = $utilisateur['UseEmail'];
    $code = generateCode(5);
    stockerCodeActivation($_SESSION['verifierIdentite']['UseId'],$code);
    if (simulationMail($code)) {
        $messageMail =  "Un code été envoyé à : $destinataire 📬";
    } 
    if (envoyerMail('php-projet','postmaster@hadrien-janssens.com',$code,$destinataire)) {
        $messageMail =  "un code a été envoyé sur votre boite mail 📬";
    } 

    $_SESSION['verifierIdentite']['envoyerCode']=false;
}


?>